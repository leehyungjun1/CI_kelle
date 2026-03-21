<!-- admin/menu/board_menu.php -->
<div class="menu-header member">
    <h2>게시판</h2>
</div>
<div class="panel">
    <div class="panel-heading menu-icon-minus <?= ($gnbActive ?? '') === 'board' ? 'active' : '' ?>">
        게시판 관리
    </div>
    <ul class="list-group">
        <li class="list-group-item <?= ($sideActive ?? '') === 'board_list' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/board/board_list') ?>">게시판 리스트</a>
        </li>
        <li class="list-group-item <?= ($sideActive ?? '') === 'article_list' ? 'active' : '' ?>">
            <a href="<?= base_url('admin/board/article_list') ?>">게시글 관리</a>
        </li>
    </ul>
</div>