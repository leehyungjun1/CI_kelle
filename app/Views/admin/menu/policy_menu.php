<div class="menu-header policy">
    <h2>기본설정</h2>
</div>
<div class="panel ">
    <div class="panel-heading menu-icon-minus ">기본정책</div>
    <ul class="list-group">
        <li class="list-group-item <?= is_active('admin/policy/base_info') ?> "><a href="<?=base_url('admin/policy/base_info') ?>">기본 정보 설정</a></li>
        <li class="list-group-item"><a href="<?=base_url('admin/policy/agreement') ?>">약관 / 개인정보처리방침</a></li>
        <li class="list-group-item"><a href="<?=base_url('admin/policy/without') ?>">이용 / 탈퇴 안내</a></li>
        <li class="list-group-item"><a href="<?=base_url('admin/policy/code') ?>">코드 관리</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus active">관리 정책</div>
    <ul class="list-group">
        <li class="list-group-item <?= is_active('admin/policy/manage') ?>"><a href="<?=base_url('admin/policy/manage') ?>">운영자 관리</a></li>
    </ul>
</div>