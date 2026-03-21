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
        $key         = trim($get['key']        ?? '');
        $searchKind  = trim($get['searchKind'] ?? '');
        $keyword     = trim($get['keyword']    ?? '');
        $allowedKeys = ['name', 'email', 'userid', 'nickname', 'mobile', 'phone'];

        $totalCount = $model->countAllResults(false);

        if (!empty($key) && !empty($searchKind) && !empty($keyword) && in_array($key, $allowedKeys)) {
            if ($searchKind === 'equalSearch') {
                $model->where($key, $keyword);
            } elseif ($searchKind === 'fullLikeSearch') {
                $model->like($key, '%' . $keyword . '%');
            }
        }

        // 정렬
        $sort = trim($get['sort'] ?? '');
        if (!empty($sort)) {
            $parts  = explode(' ', $sort);
            $column = $parts[0] ?? 'created_at';
            $order  = strtolower($parts[1] ?? 'desc');
            $model->orderBy($column, $order);
        } else {
            $model->orderBy('created_at', 'desc');
        }

        // ── makePaging 하나로 처리 ──
        $paging = $this->makePaging($model, $get);

        return $this->render('admin/member/member_list', [
            'gnbActive'  => 'member',
            'sideActive' => 'member_list',
            'sideMenu'   => 'admin/menu/member_menu',
            'breadcrumb' => ['회원', '회원 관리', '회원 리스트'],
            'members'    => $paging['items'],
            'grades'     => $gradeModel->findAll(),
            'totalCount' => $totalCount,
            'get'        => $get,
            ...$paging['meta'],
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
        $mode = $data['mode'] ?? 'create';

        // ── Validation 규칙 ──
        $rules = [
            'userid' => [
                'label' => '아이디',
                'rules' => 'required|min_length[4]|max_length[20]|alpha_numeric',
                'errors' => [
                    'required'    => '아이디를 입력해주세요.',
                    'min_length'  => '아이디는 4자 이상이어야 합니다.',
                    'alpha_numeric' => '아이디는 영문/숫자만 가능합니다.',
                ]
            ],
            'name' => [
                'label' => '이름',
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => '이름을 입력해주세요.',
                ]
            ],
            'password' => [
                'label' => '비밀번호',
                'rules' => $mode === 'create' ? 'required|min_length[10]|max_length[16]' : 'permit_empty|min_length[10]|max_length[16]',
                'errors' => [
                    'required'   => '비밀번호를 입력해주세요.',
                    'min_length' => '비밀번호는 10자 이상이어야 합니다.',
                    'max_length' => '비밀번호는 16자 이하이어야 합니다.',
                ]
            ],
            'memPwRe' => [
                'label' => '비밀번호 확인',
                'rules' => $mode === 'create' ? 'required|matches[password]' : 'permit_empty|matches[password]',
                'errors' => [
                    'required' => '비밀번호 확인을 입력해주세요.',
                    'matches'  => '비밀번호가 일치하지 않습니다.',
                ]
            ],
        ];

        // 수정 모드일 때 아이디 규칙 제외
        if ($mode === 'edit') {
            unset($rules['userid']);
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'type'    => 'field',
                'message' => $this->validator->getErrors(),
            ]);
        }

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
                'email1'    => $data['email1'] ?? '',
                'email2'    => $data['email2'] ?? '',
                'mail_YN'   => $data['mail_YN'] ?? '',
                'mobile'    => $data['mobile'] ?? '',
                'sms_YN'    => $data['sms_YN'] ?? '',
                'postcode'  => $data['postcode'] ?? '',
                'address1'  => $data['address1'] ?? '',
                'address2'  => $data['address2'] ?? '',
                'phone'     => $data['phone'] ?? '',
                'grade'    => $data['grade']     ?? '',
                'regist_YN'=> $data['regist_YN'] ?? 'Y',
            ];

            // 비밀번호 암호화
            if (!empty($data['password'])) {
                $saveData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            // 수정 모드
            if ($mode === 'edit' && !empty($data['id'])) {
                $saveData['id'] = $data['id'];
            }

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
