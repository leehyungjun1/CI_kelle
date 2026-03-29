<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>게시글 보기<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="<?= base_url('css/admin/lib/edit.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="page-header">
        <h3><?=esc($board['board_name'] ?? '') ?> 게시글 보기</h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list"
                   onclick="goList('<?= base_url('admin/board/article_list/'.esc($board['board_code'])) ?>')">
            <input type="button" value="수정" class="btn btn-white"
                   onclick="goList('<?= base_url('admin/board/article_register/'.esc($board['board_code']).'/'.esc($board['id'])) ?>')">
            <?php if ($board['parent_id'] == 0): ?>
                <input type="button" value="답변" class="btn btn-white"
                       onclick="goList('<?= base_url('admin/board/replies_register/'.esc($board['board_code']).'/'.esc($board['id'])) ?>')">
            <?php endif; ?>
            <input type="button" value="삭제" class="btn btn-white js-btn-delete">
        </div>
    </div>

    <div class="table-title">게시글 보기</div>
    <?= $this->include('components/board/view') ?>

    <div class="text-center mgt10">
        <a href="<?= base_url('admin/board/article_list/'.esc($board['board_code'])) ?>"
           class="btn btn-white">목록가기</a>
    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).on('click', '.js-btn-delete', function() {
            handleAdminAction(
                '<?= base_url('admin/board/article_delete/'.esc($board['board_code'])) ?>',
                '삭제하시겠습니까?',
                'delete',
                [<?= esc($board['id']) ?>],
                '<?= base_url('admin/board/article_list/'.esc($board['board_code'])) ?>'
            );
        });
    </script>
<?= $this->endSection() ?>