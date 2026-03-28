<div class="menu-header policy">
    <h2>기본설정</h2>
</div>
<div class="panel">
    <div class="panel-heading menu-icon-minus <?= ($gnbActive ?? '') === 'policy' ? 'active' : '' ?>">
        기본정책
    </div>
    <ul class="list-group">
        <li class="list-group-item <?= ($sideActive ?? '') === 'base_register' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/policy/base_register') ?>">기본 정보 설정</a>
        </li>
        <li class="list-group-item <?= ($sideActive ?? '') === 'agreement' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/policy/agreement') ?>">약관 / 개인정보처리방침</a>
        </li>
        <li class="list-group-item <?= ($sideActive ?? '') === 'without' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/policy/without') ?>">이용 / 탈퇴 안내</a>
        </li>
        <li class="list-group-item <?= ($sideActive ?? '') === 'code' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/policy/code') ?>">코드 관리</a>
        </li>
    </ul>
    <div class="panel-heading menu-icon-minus <?= ($gnbActive ?? '') === 'manage' ? 'active' : '' ?>">
        관리 정책
    </div>
    <ul class="list-group">
        <li class="list-group-item <?= ($sideActive ?? '') === 'manage' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/policy/manage') ?>">운영자 관리</a>
        </li>
        <li class="list-group-item <?= ($sideActive ?? '') === 'banner_list' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/banner/banner_list') ?>">배너 관리</a>
        </li>
    </ul>
</div>