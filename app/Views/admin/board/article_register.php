<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>게시글 등록<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form action="<?= site_url('admin/board/article_submit') ?>" method="post" id="frm" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($article['id'] ?? '') ?>">
        <input type="hidden" name="board_code" value="<?= esc($article['board_code'] ?? '') ?>">

        <div class="page-header">
            <h3><?= esc($pageTitle) ?></h3>
            <div class="btn-group">
                <input type="button" value="목록" class="btn btn-white btn-icon-list"
                       onclick="goList('<?= base_url('admin/board/article_list/'.esc($article['board_code'] ?? '')) ?>')">
                <input type="button" value="저장" class="btn btn-red btn-register">
            </div>
        </div>

        <div class="table-title"><?= esc($pageTitle) ?></div>
        <div>
            <?= $this->include('components/board/register') ?>
            <div class="text-center mgt10">
                <button class="btn btn-white" type="button"
                        onclick="goList('<?= base_url('admin/board/article_list/'.esc($article['board_code'] ?? '')) ?>')">
                    목록가기
                </button>
            </div>
        </div>
    </form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/editor/js/service/HuskyEZCreator.js"></script>
<?= $this->endSection() ?>