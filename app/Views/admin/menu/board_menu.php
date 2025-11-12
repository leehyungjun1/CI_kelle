<div class="menu-header policy">
    <h2>게시판</h2>
</div>
<div class="panel ">
    <div class="panel-heading menu-icon-minus ">게시판 관리</div>
    <ul class="list-group">
        <li class="list-group-item <?= is_active('admin/board/board_list') ?> "><a href="<?=base_url('admin/board/board_list') ?>">게시판 리스트</a></li>
        <li class="list-group-item <?= is_active('admin/board/board_register') ?>"><a href="<?=base_url('admin/board/board_register') ?>">게시판 등록</a></li>
        <li class="list-group-item <?= is_active('admin/board/article_list') ?>"><a href="<?=base_url('admin/board/article_list') ?>">게시글 관리</a></li>
    </ul>
</div>