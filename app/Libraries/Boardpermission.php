<?php

namespace App\Libraries;

use App\Models\JyBoardPermissionsModel;

class BoardPermission
{
    protected JyBoardPermissionsModel $model;

    public function __construct()
    {
        $this->model = new JyBoardPermissionsModel();
    }

    /**
     * 현재 사용자가 해당 action 을 할 수 있는지 확인
     */
    public function can(string $action, string $boardCode): bool
    {
        return $this->model->canDo(
            $boardCode,
            $action,
            $this->isAdmin(),
            $this->isMember(),
            $this->getGradeCode()
        );
    }

    /**
     * 뷰 버튼 제어용 전체 action 맵
     * 반환: ['list'=>true, 'read'=>true, 'write'=>false, ...]
     */
    public function getActionMap(string $boardCode): array
    {
        $map = [];
        foreach (array_keys(JyBoardPermissionsModel::ACTIONS) as $action) {
            $map[$action] = $this->can($action, $boardCode);
        }
        return $map;
    }

    /**
     * 권한 없을 때 처리
     */
    public function deny(string $type = 'redirect'): never
    {
        if ($type === 'json') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['result' => 'fail', 'msg' => '권한이 없습니다.']);
            exit;
        }
        session()->setFlashdata('error', '권한이 없습니다.');
        header('Location: ' . (previous_url() ?: base_url()));
        exit;
    }

    public function isAdmin(): bool
    {
        return !empty(session()->get('admin_id'));
    }

    public function isMember(): bool
    {
        return !empty(session()->get('member_id'));
    }

    private function getGradeCode(): ?string
    {
        $memberId = session()->get('member_id');
        if (!$memberId) return null;

        $member = model('JyMembersModel')->find($memberId);
        return $member['grade_code'] ?? null;
    }
}