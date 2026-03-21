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
        $model      = new JyUser();
        $gradeModel = new JyUserGrade();
        $get        = $this->request->getGet();

        // 검색 조건
        $key        = trim($get['key']        ?? '');
        $searchKind = trim($get['searchKind'] ?? '');
        $keyword    = trim($get['keyword']    ?? '');
        $allowedKeys = ['name', 'email', 'userid', 'nickname', 'mobile', 'phone'];

        $totalCount = $model->countAllResults(false);

        if (!empty($key) && !empty($searchKind) && !empty($keyword) && in_array($key, $allowedKeys)) {
            if ($searchKind === 'equalSearch') {
                $model->where($key, $keyword);
            } elseif ($searchKind === 'fullLikeSearch') {
                $model->like($key, '%' . $keyword . '%');
            }
        }

        $searchCount = $model->countAllResults(false);

        // 정렬
        $sort = trim($get['sort'] ?? '');
        if (!empty($sort)) {
            $parts  = explode(' ', $sort);
            $column = $parts[0] ?? 'created_at';
            $order  = $parts[1] ?? 'desc';
            $model->orderBy($column, $order);
        } else {
            $model->orderBy('created_at', 'desc');
        }

        return $this->render('admin/member/member_list', [
            'gnbActive'   => 'member',
            'sideActive'  => 'member_list',
            'sideMenu'    => 'admin/menu/member_menu',
            'breadcrumb'  => ['회원', '회원 관리', '회원 리스트'],
            'members'     => $model->paginate(50),
            'pager'       => $model->pager,
            'grades'      => $gradeModel->findAll(),
            'totalCount'  => $totalCount,
            'searchCount' => $searchCount,
            'get'         => $get,
        ]);
    }

    public function member_register($id = null)
    {
        $model          = new JyUser();
        $userGradeModel = new JyUserGrade();

        $mode = $id ? 'edit' : 'create';
        $user = $id ? $model->find($id) : null;

        return $this->render('admin/member/member_register', [
            'gnbActive'  => 'member',
            'sideActive' => 'member_register',
            'sideMenu'   => 'admin/menu/member_menu',
            'breadcrumb' => ['회원', '회원 관리', $mode === 'edit' ? '회원 수정' : '회원 등록'],
            'mode'       => $mode,
            'user'       => $user,
            'userGrades' => $userGradeModel->findAll(),
        ]);
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

        $userModel = new JyUser();
        try {
            $saveData = [
                'id'        => $data['id'] ?? '',
                'userid'    => $data['userid'] ?? '',
                'name'      => $data['name'] ?? '',
                'nickname'  => $data['nickname'] ?? '',
                'password'  => $data['password'] ?? '',
                'email1'    => $data['email1'] ?? '',
                'email2'    => $data['email2'] ?? '',
                'mail_YN'   => $data['mail_YN'] ?? '',
                'mobile'    => $data['mobile'] ?? '',
                'sms_YN'    => $data['sms_YN'] ?? '',
                'postcode'  => $data['postcode'] ?? '',
                'address1'  => $data['address1'] ?? '',
                'address2'  => $data['address2'] ?? '',
                'phone'     => $data['phone'] ?? '',
            ];

            $userModel->save($saveData);

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
