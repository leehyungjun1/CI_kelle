<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyUser;
use App\Models\JyUserGrade;
use CodeIgniter\HTTP\ResponseInterface;

class MemberController extends BaseController
{
    public function member_list()
    {
        helper('form_component');
        $model = new JyUser();
        $gradeModel = new JyUserGrade();
        $grades = $gradeModel->findAll();

        $get = $this->request->getGet();

        $key = trim($get['key'] ?? '');
        $searchKind = trim($get['searchKind'] ?? '');
        $keyword = trim($get['keyword'] ?? '');

        $allowedKeys = ['name', 'email', 'userid','nickname','mobile','phone'];
        $totalCount = $model->countAllResults(false);

        if(!empty($get['key']) && !empty($get['searchKind']) && !empty($get['keyword']) && in_array($key, $allowedKeys)){
            if($searchKind == 'equalSearch'){
                $model->where($key, $keyword);
            } else if($searchKind == 'fullLikeSearch'){
                $model->like($key, '%'.$keyword.'%');
            }
        }

        $searchCount = $model->countAllResults(false);

        $sort = trim($get['sort'] ?? '');
        if(!empty($sort)){
            $parts = explode(" ", $sort);
            $column = $parts[0] ?? 'created_at';
            $order = $parts[1] ?? 'desc';
            $model->orderBy($column, $order);
        } else {
            $model->orderBy("created_at", "desc");
        }


        $data['members'] = $model->paginate(50); // 한 페이지 50개
        $data['pager']   = $model->pager;
        $data['get']     = $get;
        $data['grades']  = $grades;

        $data['totalCount'] = $totalCount;
        $data['searchCount'] = $searchCount;

        return view('admin/member/member_list', $data);
    }

    public function member_register($id = null)
    {
        $model = new JyUser();
        $userGradeModel = new JyUserGrade();
        $userGrades = $userGradeModel->findAll();

        $mode = 'create';
        $user = [];

        if($id) {
            $user = $model->find($id);
            $mode = 'edit';
        } else {
            $user = null;
        }

        return view('admin/member/member_register', ['user' => $user, 'mode' => $mode, 'userGrades' => $userGrades]);
    }

    public function member_register_save() {
        $data = $this->request->getPost();
        $email = make_email($data['email1'] ?? '', $data['email2'] ?? '');

        if ($email === null) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '유효하지 않은 이메일입니다.'
            ]);
        }

        $model = new UserModel();
        try {
            $saveData = [
                'id'        => $data['id'] ?? '',
                'userid'    => $data['userid'] ?? '',
                'name'      => $data['name'] ?? '',
                'nickname'  => $data['nickname'] ?? '',
                'password'  => $data['password'] ?? '',
                'email'     => $email ?? '',
                'mail_YN'   => $data['mail_YN'] ?? '',
                'mobile'    => $data['mobile'] ?? '',
                'sms_YN'    => $data['sms_YN'] ?? '',
                'postcode'  => $data['postcode'] ?? '',
                'address1'  => $data['address1'] ?? '',
                'address2'  => $data['address2'] ?? '',
                'phone'     => $data['phone'] ?? '',
            ];
            
            $model->save($saveData);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '저장되었습니다.'
            ]);

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => '저장에 실패했습니다.'
            ]);
        }
    }
}
