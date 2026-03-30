<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JySetting;

class CodeController extends BaseController
{
    protected JySetting $model;

    public function __construct()
    {
        $this->model = new JySetting();
    }

    // ── 트리 화면 ────────────────────────────────────────────────
    public function index()
    {
        $tree = $this->model->getTree();

        return $this->render('admin/policy/code_tree_list', [
            'gnbActive'  => 'policy',
            'sideActive' => 'code_tree',
            'sideMenu'   => 'admin/menu/policy_menu',
            'breadcrumb' => ['관리 정책', '코드 관리'],
            'tree'       => $tree,
        ]);
    }

    // ── 코드 저장 (등록/수정) ────────────────────────────────────
    public function save()
    {
        $id       = $this->request->getPost('id');
        $parentId = $this->request->getPost('parent_id') ?: null;
        $codeName = trim($this->request->getPost('code_name'));
        $useYn    = $this->request->getPost('use_yn') ?? 'Y';

        if (empty($codeName)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '코드명을 입력해주세요.',
            ]);
        }

        if ($id) {
            // 수정
            $this->model->update($id, [
                'code_name' => $codeName,
                'use_yn'    => $useYn,
            ]);
            $message = '수정되었습니다.';
        } else {
            // 등록 — 코드 자동 생성
            $code  = $this->model->generateCode($parentId ? (int)$parentId : null);
            $depth = $parentId
                ? (($this->model->find($parentId)['depth'] ?? 1) + 1)
                : 1;

            // 최대 3단계 제한
            if ($depth > 3) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => '3단계까지만 등록 가능합니다.',
                ]);
            }

            // order_no: 같은 부모 내 마지막 + 1
            $lastOrder = $this->model
                ->where('parent_id', $parentId)
                ->orderBy('order_no', 'desc')
                ->first();

            $this->model->insert([
                'code'      => $code,
                'parent_id' => $parentId,
                'depth'     => $depth,
                'code_name' => $codeName,
                'use_yn'    => $useYn,
                'order_no'  => $lastOrder ? $lastOrder['order_no'] + 1 : 1,
            ]);
            $message = '등록되었습니다.';
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => $message,
        ]);
    }

    // ── 코드 삭제 ────────────────────────────────────────────────
    public function delete()
    {
        $id = $this->request->getPost('id');

        // 자식이 있으면 삭제 불가
        $children = $this->model->where('parent_id', $id)->countAllResults();
        if ($children > 0) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '하위 코드가 있어 삭제할 수 없습니다.',
            ]);
        }

        $this->model->delete($id);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => '삭제되었습니다.',
        ]);
    }

    // ── 드래그앤드롭 순서 변경 ───────────────────────────────────
    public function reorder()
    {
        // $orders = [['id'=>1,'order_no'=>1], ['id'=>2,'order_no'=>2], ...]
        $orders = $this->request->getPost('orders') ?? [];

        if (empty($orders)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '순서 데이터가 없습니다.',
            ]);
        }

        $result = $this->model->updateOrder($orders);

        return $this->response->setJSON([
            'status'  => $result ? 'success' : 'error',
            'message' => $result ? '순서가 변경되었습니다.' : '순서 변경 중 오류가 발생했습니다.',
        ]);
    }

    // ── 코드 단건 조회 (수정 폼용) ──────────────────────────────
    public function get()
    {
        $id  = $this->request->getGet('id');
        $row = $this->model->find($id);

        if (!$row) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => '코드를 찾을 수 없습니다.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $row,
        ]);
    }
}