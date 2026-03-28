<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyBanner;

class BannerController extends BaseController
{
    // ── 배너 그룹 목록 ──
    public function banner_list()
    {
        $model  = new JyBanner();
        $groups = $model->getGroupList();

        return $this->render('admin/banner/banner_list', [
            'gnbActive'  => 'banner',
            'sideActive' => 'banner_list',
            'sideMenu'   => 'admin/menu/policy_menu',
            'breadcrumb' => ['기본설정', '관리 정책', '배너 관리'],
            'groups'     => $groups,
        ]);
    }

    // ── 배너 그룹 등록/수정 ──
    public function banner_register($group_id = null)
    {
        $model   = new JyBanner();
        $mode    = $group_id ? 'edit' : 'create';
        $banners = [];

        if ($group_id) {
            $banners = $model->getByGroup((int)$group_id);
            if (empty($banners)) {
                return redirect()->to('/admin/banner/banner_list')
                    ->with('error', '해당 배너 그룹을 찾을 수 없습니다.');
            }
        } else {
            // 신규 - 빈 슬라이드 1개로 시작
            $group_id = $model->nextGroupId();
            $banners  = [[
                'id'          => '',
                'group_id'    => $group_id,
                'title'       => '',
                'description' => '',
                'image_path'  => '',
                'link_url'    => '',
                'order_no'    => 1,
                'is_use'      => 'Y',
            ]];
        }

        $pageTitle = $mode === 'edit' ? '배너 수정' : '배너 등록';

        return $this->render('admin/banner/banner_register', [
            'gnbActive'  => 'banner',
            'sideActive' => 'banner_list',
            'sideMenu'   => 'admin/menu/policy_menu',
            'breadcrumb' => ['기본설정', '관리 정책', '배너 관리', $pageTitle],
            'banners'    => $banners,
            'group_id'   => $group_id,
            'mode'       => $mode,
            'pageTitle'  => $pageTitle,
        ]);
    }

    // ── 배너 저장 (그룹 전체) ──
    public function banner_submit()
    {
        $model    = new JyBanner();
        $post     = $this->request->getPost();
        $group_id = (int)($post['group_id'] ?? 0);
        $files    = $this->request->getFiles();

        if (!$group_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => '잘못된 요청입니다.']);
        }

        $titles      = $post['title']       ?? [];
        $descs       = $post['description'] ?? [];
        $links       = $post['link_url']    ?? [];
        $orders      = $post['order_no']    ?? [];
        $isUses      = $post['is_use']      ?? [];
        $ids         = $post['banner_id']   ?? [];
        $imageFiles  = $files['image_file'] ?? [];
        $keepImages  = $post['keep_image']  ?? [];

        try {
            $usedIds = [];

            foreach ($titles as $i => $title) {
                if (trim($title) === '') continue;

                $bannerId  = $ids[$i]    ?? null;
                $imagePath = $keepImages[$i] ?? '';

                // ── 이미지 업로드 처리 ──
                if (!empty($imageFiles[$i]) && $imageFiles[$i]->isValid() && !$imageFiles[$i]->hasMoved()) {
                    $newName   = $imageFiles[$i]->getRandomName();
                    $imageFiles[$i]->move(WRITEPATH . 'uploads/banner', $newName);
                    $imagePath = 'uploads/banner/' . $newName;
                }

                $data = [
                    'group_id'    => $group_id,
                    'title'       => $title,
                    'description' => $descs[$i]   ?? '',
                    'link_url'    => $links[$i]    ?? '',
                    'order_no'    => (int)($orders[$i] ?? $i + 1),
                    'is_use'      => $isUses[$i]   ?? 'Y',
                ];

                if (!empty($imagePath)) {
                    $data['image_path'] = $imagePath;
                }

                if ($bannerId) {
                    $model->update($bannerId, $data);
                    $usedIds[] = (int)$bannerId;
                } else {
                    $model->insert($data);
                    $usedIds[] = $model->getInsertID();
                }
            }

            // ── 삭제된 슬라이드 처리 ──
            $deleteIds = $post['delete_ids'] ?? [];
            if (!empty($deleteIds)) {
                $model->whereIn('id', $deleteIds)->delete();
            }

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => '배너가 저장되었습니다.',
                'url'     => base_url('admin/banner/banner_list'),
            ]);

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '저장에 실패했습니다.',
            ]);
        }
    }

    // ── 배너 그룹 삭제 ──
    public function banner_delete()
    {
        $groupIds = $this->request->getPost('ids');
        if (empty($groupIds) || !is_array($groupIds)) {
            return $this->response->setJSON(['status' => 'error', 'message' => '선택된 항목이 없습니다.']);
        }

        $model = new JyBanner();
        $model->whereIn('group_id', $groupIds)->delete();

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => count($groupIds) . '개의 배너 그룹이 삭제되었습니다.',
        ]);
    }
}