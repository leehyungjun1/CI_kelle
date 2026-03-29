<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JyAdmin;

class AdminController extends BaseController {
    public function index() {
        if (!session()->get('is_admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        return redirect()->to('/admin/dashboard');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'GET') {
            // 이미 로그인되어 있으면 대시보드로
            $admin = session()->get('admin');
            if ($admin && !empty($admin['logged_in'])) {
                return redirect()->to(base_url('admin/dashboard'));
            }
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

        session()->set('admin', [
            'id'            => $admin['id'],
            'admin_id'      => $admin['admin_id'],
            'name'          => $admin['name'],
            'position_code' => $admin['position_code'],
            'logged_in'     => true
        ]);
         return redirect()->to('/admin/dashboard');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    public function dashboard() {

        if (!session()->get('admin.logged_in')) {
            return redirect()->to('/admin/login')->with('error', '로그인이 필요합니다.');
        }

        return view('admin/dashboard', [
            'admin_name' => session()->get('admin_name')
        ]);
    }
}
