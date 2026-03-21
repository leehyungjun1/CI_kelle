<!-- 회원 관리 메뉴 -->
<div class="menu-header member">
    <h2>회원</h2>
</div>

<div class="panel">
    <div class="panel-heading menu-icon-minus active">회원 관리</div>
    <ul class="list-group">
        <li class="list-group-item <?= ($sideActive ?? '') === 'member_list'     ? 'active' : '' ?>">
            <a href="<?= base_url('admin/member/member_list') ?>">회원 리스트</a>
        </li>
        <li class="list-group-item <?= ($sideActive ?? '') === 'member_register' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/member/member_register') ?>">회원 등록</a>
        </li>
    </ul>

    <div class="panel-heading menu-icon-minus">마일리지 / 예치금 관리</div>
    <ul class="list-group">
        <li class="list-group-item"><a href="#">마일리지 기본 설정</a></li>
        <li class="list-group-item"><a href="#">예치금 설정</a></li>
    </ul>
</div>