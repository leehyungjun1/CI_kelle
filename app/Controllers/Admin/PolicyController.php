<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyAdmin;
use App\Models\JySetting;
use App\Models\JySiteInfo;
use App\Entities\SiteInfo;

class PolicyController extends BaseController
{
    public function base_register($id = null)
    {
        $model = new JySiteInfo();
        $data  = $model->find(1);

        if (!$data) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '데이터가 없습니다.'
            ]);
        }

        $businessParts   = explode('-', $data->business_number ?? '--');
        $business_number = array_pad($businessParts, 3, '');

        return $this->render('admin/policy/base_register', [
            'gnbActive'       => 'policy',
            'sideActive'      => 'base_register',
            'sideMenu'        => 'admin/menu/policy_menu',
            'breadcrumb'      => ['기본설정', '기본정책', '기본 정보 설정'],
            'data'            => $data,
            'business_number' => $business_number,
        ]);
    }

    public function base_register_save()
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('favicon_path');
        $newName = '';

        // ── 파비콘 업로드 ──
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
        }

        // ── 유효성 검사 ──
        if (!$this->validate(['site_name' => 'required|min_length[2]|max_length[50]'])) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => implode(', ', $this->validator->getErrors())
            ]);
        }

        // ── 이메일 조합 ──
        $email    = $this->combineEmail($post['email_id'] ?? '', $post['email_domain'] ?? '');
        $cs_email = $this->combineEmail($post['cs_email_id'] ?? '', $post['cs_email_domain'] ?? '');

        if ($email === false) {
            return $this->response->setJSON(['status' => 'error', 'message' => '유효하지 않은 대표 이메일입니다.']);
        }
        if ($cs_email === false) {
            return $this->response->setJSON(['status' => 'error', 'message' => '유효하지 않은 고객센터 이메일입니다.']);
        }

        // ── 저장 ──
        try {
            $model    = new JySiteInfo();
            $saveData = new SiteInfo([
                'site_name'       => $post['site_name']      ?? '',
                'site_name_en'    => $post['site_name_en']   ?? '',
                'top_title'       => $post['top_title']      ?? '',
                'company_name'    => $post['company_name']   ?? '',
                'business_number' => $post['fullBusiNo']     ?? '',  // ← busino_input
                'ceo_name'        => $post['ceo_name']       ?? '',
                'business_type'   => $post['business_type']  ?? '',
                'business_item'   => $post['business_item']  ?? '',
                'email'           => $email,
                'zipcode'         => $post['zipcode']        ?? '',
                'address'         => $post['address']        ?? '',
                'address_detail'  => $post['address_detail'] ?? '',
                'phone'           => $post['phone']          ?? '',
                'fax'             => $post['fax']            ?? '',
                'cs_phone1'       => $post['cs_phone1']      ?? '',
                'cs_phone2'       => $post['cs_phone2']      ?? '',
                'cs_fax'          => $post['cs_fax']         ?? '',
                'cs_email'        => $cs_email,
                'business_hours'  => $post['business_hours'] ?? '',
            ]);

            if (!empty($post['id'])) {
                $saveData->id = (int)$post['id'];
            }
            if (!empty($newName)) {
                $saveData->favicon_path = $newName;
            }

            $model->save($saveData);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => '저장되었습니다.',
                'url'     => base_url('admin/policy/base_register'),
            ]);

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '저장에 실패했습니다.'
            ]);
        }
    }

    // ── 이메일 조합 헬퍼 ──
    private function combineEmail(string $id, string $domain): string|false
    {
        $id     = trim($id);
        $domain = trim($domain);
        if (!$id || !$domain) return '';
        $email = $id . '@' . $domain;
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
    }

    public function manage()
    {
        $adminModel     = new JyAdmin();
        $jySettingModel = new JySetting();

        $prefixes = ['102001', '102002', '102003'];
        $codes    = $jySettingModel->getCodesByPrefixes($prefixes);

        $get = $this->request->getGet();
        $filters = [
            'key'             => $get['key']             ?? '',
            'searchKind'      => $get['searchKind']      ?? '',
            'keyword'         => $get['keyword']         ?? '',
            'regist_YN'       => $get['regist_YN']       ?? '',
            'department_code' => $get['department_code'] ?? '',
            'position_code'   => $get['position_code']   ?? '',
            'duty_code'       => $get['duty_code']       ?? '',
        ];

        $perPage     = (int)($get['pageNum'] ?? 10);
        $currentPage = (int)($get['page']    ?? 1);

        $admins      = $adminModel->getAdminsList($filters)->orderBy('id', 'desc')->paginate($perPage, 'default', $currentPage);
        $totalCount  = $adminModel->countAllResults(false);
        $searchCount = count($admins);

        return $this->render('admin/policy/manage_list', [
            'gnbActive'   => 'manage',
            'sideActive'  => 'manage',
            'sideMenu'    => 'admin/menu/policy_menu',
            'breadcrumb'  => ['기본설정', '관리 정책', '운영자 관리'],
            'admins'      => $admins,
            'pager'       => $adminModel->pager,
            'page'        => $currentPage,
            'perPage'     => $perPage,
            'totalCount'  => $totalCount,
            'searchCount' => $searchCount,
            'codes'       => $codes,
            'jySetting'   => $jySettingModel,
        ]);
    }

    public function manage_register($id = null)
    {
        $adminModel      = new JyAdmin();
        $jySettingModel  = new JySetting();
        $adminFieldModel = new \App\Models\JyAdminField();

        $prefixes = ['102001', '102002', '102003'];
        $codes    = $jySettingModel->getCodesByPrefixes($prefixes);

        // ── 103 교육과정 계층 구조 ──
        $courseCodes = $jySettingModel->getCourseCodes();

        $mode  = $id ? 'edit' : 'create';
        $admin = $id ? $adminModel->find($id) : [
            'id'              => '',
            'admin_id'        => '',
            'name'            => '',
            'department_code' => '',
            'position_code'   => '',
            'duty_code'       => '',
            'phone'           => '',
            'title'           => '',
            'relations'       => '',
            'profile_path'    => '',
        ];

        if ($id && !$admin) {
            return redirect()->to('/admin/policy/manage')
                ->with('error', '해당 관리자를 찾을 수 없습니다.');
        }

        // ── 기존 담당 코드 ──
        $adminCodes = $id ? $adminFieldModel->getCodesByAdmin((int)$id) : [];

        $pageTitle = $mode === 'edit' ? '관리자 정보 수정' : '신규 관리자 등록';

        return $this->render('admin/policy/manage_register', [
            'gnbActive'   => 'manage',
            'sideActive'  => 'manage',
            'sideMenu'    => 'admin/menu/policy_menu',
            'breadcrumb'  => ['기본설정', '관리 정책', $pageTitle],
            'admin'       => $admin,
            'codes'       => $codes,
            'courseCodes' => $courseCodes,
            'adminCodes'  => $adminCodes,
            'pageTitle'   => $pageTitle,
            'mode'        => $mode,
        ]);
    }

    public function submit()
    {
        $adminModel = new JyAdmin();
        $adminFieldModel = new \App\Models\JyAdminField();
        $id         = $this->request->getPost('id');
        $password   = $this->request->getPost('password');
        $pwConfirm  = $this->request->getPost('password_confirmation');

        $data = [
            'name'            => $this->request->getPost('name'),
            'department_code' => $this->request->getPost('department_code'),
            'position_code'   => $this->request->getPost('position_code'),
            'duty_code'       => $this->request->getPost('duty_code'),
            'phone'           => $this->request->getPost('phone'),
            'title'           => $this->request->getPost('title'),
            'relations'       => $this->request->getPost('relations'),
        ];

        // ── 프로필 사진 업로드 ──
        $file = $this->request->getFile('profile_path');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/profile', $newName);
            $data['profile_path'] = 'uploads/profile/' . $newName;
        }


        try {
            if ($id) {
                $admin = $adminModel->find($id);
                if (!$admin) {
                    return $this->response->setJSON(['status' => 'error', 'message' => '해당 관리자를 찾을 수 없습니다.']);
                }
                if ($password) {
                    if ($password !== $pwConfirm) {
                        return $this->response->setJSON(['status' => 'error', 'message' => '비밀번호가 일치하지 않습니다.']);
                    }
                    $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                }
                $adminModel->update($id, $data);
                $savedId = $id;
                $message = '관리자 정보가 수정되었습니다.';
            } else {
                $data['admin_id'] = $this->request->getPost('admin_id');

                if (empty($password) || empty($pwConfirm)) {
                    return $this->response->setJSON(['status' => 'error', 'message' => '비밀번호를 입력해주세요.']);
                }
                if ($password !== $pwConfirm) {
                    return $this->response->setJSON(['status' => 'error', 'message' => '비밀번호가 일치하지 않습니다.']);
                }
                if ($adminModel->where('admin_id', $data['admin_id'])->first()) {
                    return $this->response->setJSON(['status' => 'error', 'message' => '이미 존재하는 관리자 아이디입니다.']);
                }

                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
                $adminModel->insert($data);
                $savedId = $adminModel->getInsertID();
                $message = '새 관리자가 등록되었습니다.';
            }

            // ── 담당 교육과정 저장 ──
            $fieldCodes = $this->request->getPost('field_codes') ?? [];
            $adminFieldModel->saveByAdmin((int)$savedId, $fieldCodes);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => $message,
                'url'     => base_url('admin/policy/manage'),
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => '오류: ' . $e->getMessage()]);
        }
    }

    public function manage_action()
    {
        $ids  = $this->request->getPost('ids');
        $mode = $this->request->getPost('mode');

        if (empty($ids) || !is_array($ids)) {
            return $this->response->setJSON(['status' => 'error', 'message' => '선택된 항목이 없습니다.']);
        }

        $adminModel = new JyAdmin();
        $db         = \Config\Database::connect();

        switch ($mode) {
            case 'approve':
                $adminModel->whereIn('id', $ids)->update(null, [
                    'regist_YN'  => 'Y',
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $message = $db->affectedRows() . '명의 관리자가 승인되었습니다.';
                break;
            case 'delete':
                $adminModel->whereIn('id', $ids)->delete();
                $message = $db->affectedRows() . '명의 관리자가 삭제되었습니다.';
                break;
            default:
                return $this->response->setJSON(['status' => 'error', 'message' => '잘못된 요청입니다.']);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => $message]);
    }
}