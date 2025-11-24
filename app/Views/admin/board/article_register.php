<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form action="<?= site_url('admin/board/article_submit') ?>" method="post" id="frm" enctype="multipart/form-data">
    <?=csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($article['id'] ?? '') ?>">
    <input type="hidden" name="board_code" value="<?= esc($article['board_code'] ?? '') ?>">

    <div class="page-header js-affix affix-top">
        <h3><?=esc($pageTitle) ?></h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/board/article_list") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <div class="table-title gd-help-manual"> <?=esc($pageTitle) ?> </div>
    <div>
        <?= $this->include('components/board/register') ?>
        <div class="text-center">
            <button class="btn btn-white" type="button" onclick="goList('<?= base_url('admin/board/article_list') ?>/<?= esc($article['board_code'] ?? '') ?>')">목록가기</button>
        </div>
    </div>
</form>

<script src="/editor/js/service/HuskyEZCreator.js"></script>
<script>
    var oEditors = [];

    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "editor", // textarea id
        sSkinURI: "/editor/SmartEditor2Skin.html",
        htParams: {
            // 툴바 이미지/파일 업로드 버튼 활성
            bUseToolbar : true,
            bUseVerticalResizer : true,
            bUseModeChanger : true,
            fOnBeforeUnload : function(){},
            fOnAppLoad : function() {

            }
        },
        fCreator: "createSEditor2"
    });

    function submitContents() {
        oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []); // textarea에 반영
        document.forms[0].submit();
    }

    $(document).on("change", "#board_id", function() {
        var url = $(this).find("option:selected").val();
        goList("<?= base_url('admin/board/article_register') ?>/"+url);
    });

    $('.starRating').raty({
        score: <?= $article['rating'] ?? 0 ?>,
        starType: 'i', // 또는 이미지 사용 가능
        click: function (score) {
            $('#rating').val(score); // 선택한 별점을 hidden input에 저장
        }
    });

</script>


<?php echo $this->endSection() ?>
