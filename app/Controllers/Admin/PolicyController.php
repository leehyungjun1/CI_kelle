<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyAdmin;
use App\Models\JySetting;
use App\Models\JySiteInfo;
use Config\Services;

class PolicyController extends BaseController
{
    public function base_info($id = null) {
        $model = new JySiteInfo();
        if ($id) {
            // 수정 모드
            $data = $model->find($id);

            if (!$data) {
                echo "<script>
                    alert('데이터가 없습니다.');
                    window.history.back();
                </script>";
                return; // 이후 코드 실행 방지
            }
        } else {
            // 새로 만들기 모드
            $data = null; // 또는 기본값 배열
        }

        return view('admin/policy/base_info', ['data' => $data]);
    }

    public function base_info_save() {
        $data = $this->request->getPost();
        $file = $this->request->getFile('favicon_path');
        $newName = '';

        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
        }

        $rules = [
            'site_name' => [
                'label' => '사이트 이름',
                'rules' => 'required|min_length[3]|max_length[50]',
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => implode(', ', $this->validator->getErrors())
            ]);
        }

        $mailId     = trim($data['email_id'] ?? '');
        $mailDomain = trim($data['email_domain'] ?? '');
        $email = '';
        if($mailId && $mailDomain) {
            $email = $mailId . '@' . $mailDomain;

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "유효하지 않은 이메일: $email"
                ]);
            }
        }

        $cs_mailId     = trim($data['cs_email_id'] ?? '');
        $cs_mailDomain = trim($data['cs_email_domain'] ?? '');
        $cs_email = '';
        if($cs_mailId && $cs_mailDomain) {
            $cs_email = $cs_mailId . '@' . $cs_mailDomain;

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "유효하지 않은 이메일: $cs_email"
                ]);
            }
        }

        $model = new JySiteInfo();

        try {
            $saveData = [
                'site_name'    => $data['site_name'] ?? '',
                'site_name_en' => $data['site_name_en'] ?? '',
                'top_title'    => $data['top_title'] ?? '',
                'favicon_path' => $newName ?? '',
                'business_number' => implode('-', $data['business_number'] ?? []),
                'ceo_name'      => $data['ceo_name'] ?? '',
                'business_type' => $data['business_type'] ?? '',
                'business_item' => $data['business_item'] ?? '',
                'email'         => $email,
                'zipcode'       => $data['zipcode'] ?? '',
                'address'       => $data['address'] ?? '',
                'address_detail'    => $data['address_detail'] ?? '',
                'phone'         => $data['phone'] ?? '',
                'fax'           => $data['fax'] ?? '',
                'cs_phone1'     => $data['cs_phone1'] ?? '',
                'cs_phone2'     => $data['cs_phone2'] ?? '',
                'cs_fax'        => $data['cs_fax'] ?? '',
                'cs_address1'   => $data['cs_address1'] ?? '',
                'business_hours'    => $data['business_hours'] ?? '',
            ];

            if (isset($data['id']) && is_numeric($data['id'])) {
                $saveData['id'] = (int)$data['id'];
            }

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

    public function manage() {
        $adminModel = new JyAdmin();
        $jySettingModel = new JySetting();
        $prefixes = ['102001','102002','102003'];

        $codes = $jySettingModel->getCodesByPrefixes($prefixes);

        $filters = [
            'key'               => $this->request->getGet('key'),
            'searchKind'        => $this->request->getGet('searchKind'),
            'keyword'           => $this->request->getGet('keyword'),
            'regist_YN'         => $this->request->getGet('regist_YN'),
            'department_code'   => $this->request->getGet('department_code'),
            'position_code'     => $this->request->getGet('position_code'),
            'duty_code'         => $this->request->getGet('duty_code'),
        ];
        $perPage = (int)($filters['pageNum'] ?? 10);
        $page = (int)($this->request->getVar('page') ?? 1);

        $admins = $adminModel->getAdminsList($filters)->orderBY('id','desc')->paginate($perPage, 'default', $page);

        $totalCount = $adminModel->countAllResults(false);
        $searchCount = count($admins);
        $pager = $adminModel->pager;

        return view ('admin/policy/manage_list',[
            'admins'    => $admins,
            'pager'     => $pager,
            'page'      => $page,
            'perPage'   => $perPage,
            'totalCount'    => $totalCount,
            'searchCount'   => $searchCount,
            'codes'     => $codes,
            'jySetting' => $jySettingModel
        ]);
    }

    public function manage_register($id = null) {

        $adminModel = new JyAdmin();
        $jySettingModel = new JySetting();

        $prefixes = ['102001','102002','102003'];
        $codes = $jySettingModel->getCodesByPrefixes($prefixes);

        if($id) {
            $admin = $adminModel->find($id);
            if(!$admin) {
                return redirect()->to('/admin/policy/manage')->with('error','해당 관리자를 찾을 수 없습니다.');
            }
            $pageTitle  = "관리자 정보 수정";
        } else {
            $admin = [
                'id' => '',
                'admin_id' => '',
                'email' => '',
                'password' => '',
                'name'  => '',
                'department_code' => '',
                'position_code' => '',
                'duty_code' => '',
                'phone' => ''
            ];
            $pageTitle = "신규 관리자 등록";
        }

        return view ('admin/policy/manage_register', [
            'admin' => $admin,
            'codes' => $codes,
            'jySetting' => $jySettingModel,
            'pageTitle' => $pageTitle
        ]);
    }

    public function submit() {
        $adminModel = new JyAdmin();
        $id = $this->request->getPost('id');

        $password = $this->request->getPost('password');
        $password_confirmation = $this->request->getPost('password_confirmation');

        $data = [
            'name'  => $this->request->getPost('name'),
            'department_code'  => $this->request->getPost('department_code'),
            'position_code'  => $this->request->getPost('position_code'),
            'duty_code'  => $this->request->getPost('duty_code'),
            'phone'  => $this->request->getPost('phone')
        ];

        try {
            if ($id) {
                $admin = $adminModel->find($id);
                if (!$admin) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => '해당 관리자 정보를 찾을 수 없습니다.'
                    ]);
                }

                if($password) {
                    if($password && $password !== $password_confirmation) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => '비밀번호와 비밀번호 확인이 일치하지 않습니다.'
                        ]);
                    }
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                }

                $adminModel->update($id, $data);
                $message = '관리자 정보가 수정되었습니다.';
            } else {
                $data['admin_id'] = $this->request->getPost('admin_id');

                if (empty($password) || empty($password_confirmation)) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => '신규 등록 시 비밀번호를 입력해야 합니다.'
                    ]);
                }

                if ($password !== $password_confirmation) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => '비밀번호 확인이 일치하지 않습니다.'
                    ]);
                }

                $data['password'] = password_hash($password, PASSWORD_DEFAULT);

                $exists = $adminModel->where('admin_id', $data['admin_id'])->first();
                if ($exists) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => '이미 존재하는 관리자 아이디입니다.'
                    ]);
                }

                $adminModel->insert($data);
                $message = '새 관리자가 등록되었습니다.';
            }

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '오류: ' . $e->getMessage()
            ]);
        }
    }

    public function manage_action() {
        $ids = $this->request->getPost('ids');
        $action = $this->request->getPost('action');

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => '선택된 회원이 없습니다.'
            ]);
        }

        $adminModel = new JyAdmin();
        $db = \Config\Database::connect();
        switch ($action) {
            case 'approve':
                // 승인 처리
                $adminModel->whereIn('id', $ids)
                    ->update(null, [
                        'regist_YN' => 'Y',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                $affected = $db->affectedRows();
                $message = $affected . '명의 관리자가 승인되었습니다.';
                break;

            case 'delete':
                // Soft Delete (deleted_at 자동 설정)
                $adminModel->whereIn('id', $ids)->delete();
                $affected = $db->affectedRows();
                $message = $affected . '명의 관리자가 삭제되었습니다.';
                break;

            default:
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => '잘못된 요청입니다.'
                ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $message
        ]);
    }
}