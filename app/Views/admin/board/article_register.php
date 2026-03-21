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
    <script>
        $(document).ready(function() {

            // ── 스마트 에디터 ──
            var oEditors = [];
            nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: "editor",
                sSkinURI: "/editor/SmartEditor2Skin.html",
                htParams: {
                    bUseToolbar: true,
                    bUseVerticalResizer: true,
                    bUseModeChanger: true,
                    fOnBeforeUnload: function() {},
                    fOnAppLoad: function() {}
                },
                fCreator: "createSEditor2"
            });

            // ── 저장 시 에디터 내용 반영 ──
            $(document).on('click', '.btn-register', function(e) {
                e.preventDefault();
                if (typeof oEditors !== "undefined" && oEditors.getById["editor"]) {
                    oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
                }
                // common.js의 btn-register 핸들러 실행
                $("#frm").trigger('submit-form');
            });

            // ── 게시판 변경 시 이동 ──
            $(document).on("change", "#board_id", function() {
                var url = $(this).find("option:selected").val();
                goList("<?= base_url('admin/board/article_register') ?>/" + url);
            });

            // ── 별점 raty.js ──
            if (typeof $.fn.raty !== 'undefined') {
                $('.starRating').raty({
                    score: <?= (int)($article['rating'] ?? 0) ?>,
                    starType: 'i',
                    starOn:  'fa fa-star',
                    starOff: 'fa fa-star-o',
                    click: function(score) {
                        $('#rating').val(score);
                    }
                });
            }

        });
    </script>
<?= $this->endSection() ?>