<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyAdmin;

class AdminController extends BaseController {
    public function index() {
        return view('admin/login');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'GET') {
            return view('admin/login');
        }

        $session = session();
        $admin_id = $this->request->getPost('admin_id');
        $password = $this->request->getPost('password');
        $adminModel = new JyAdmin();
        $admin = $adminModel->where('admin_id', $admin_id)->first();

        if (!password_verify($password, $admin['password'])) {
             return redirect()->back()->with('error', '비밀번호가 올바르지 않습니다.');
        }

         $session->set([
            'admin_id' => $admin['admin_id'],
            'admin_name' => $admin['name'],
            'is_admin_logged_in' => true
        ]);

         return redirect()->to('/admin/dashboard');
    }

    public function dashboard() {
        log_message('debug', '대시보드 세션 ID: ' . session_id());
        log_message('debug', '세션 로그인 여부: ' . (session()->get('is_admin_logged_in') ? 'YES' : 'NO'));
        log_message('debug', '세션 관리자명: ' . session()->get('admin_name'));

        if (!session()->get('is_admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', '로그인이 필요합니다.');
        }

        return view('admin/dashboard', [
            'admin_name' => session()->get('admin_name')
        ]);
    }
}
