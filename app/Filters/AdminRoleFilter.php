<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminRoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $admin        = session()->get('admin');
        $positionCode = $admin['position_code'] ?? '';

        // 플래너 접근 제한 경로
        $restrictedPaths = [
            'admin/policy',
            'admin/board/board_register',
            'admin/board/submit',
        ];

        if ($positionCode === '102002002') {
            $currentPath = $request->getPath();
            foreach ($restrictedPaths as $path) {
                if (str_starts_with($currentPath, $path)) {
                    session()->setFlashdata('error', '접근 권한이 없습니다.');
                    return redirect()->back();
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}