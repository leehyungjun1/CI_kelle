<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>
<div class="page-header js-affix affix-top">
    <h3>게시글 보기</h3>
</div>
<style>
    p{margin:0px !important;}
</style>
<div class="table-title gd-help-manual">게시글 보기 </div>
<?= $this->include('components/board/view') ?>
<div class="text-center">
    <a href="<?=base_url('admin/board/article_list/'.$board['board_code']) ?>" class="btn btn-white">목록</a>
    <a href="<?=base_url('admin/board/article_register/'.$board['board_code'].'/'.$board['id']) ?>" class="btn btn-white">수정</a>
    <a href="<?=base_url('admin/board/replies_register/'.$board['board_code'].'/'.$board['id']) ?>" class="btn btn-white">답변</a>
    <span class="btn btn-white js-btn-delete">삭제</span>
</div>
<script>
    $(document).on("click", ".js-btn-delete", function() {
        handleAdminAction('/admin/board/article_delete', '삭제하시겠습니까?', 'delete', [<?=esc($board['id'])?>], '/admin/board/article_list/<?=esc($board['board_id'])?>');
    });
</script>
<?php echo $this->endSection() ?>
