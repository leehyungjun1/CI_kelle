<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form action="<?= site_url('admin/board/article_submit') ?>" method="post" id="frm">
    <?=csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($article['id'] ?? '') ?>">
    <div class="page-header js-affix affix-top">
        <h3><?=esc($pageTitle) ?></h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/board/article_list") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <div class="table-title gd-help-manual"> <?=esc($pageTitle) ?> </div>
    <div>
        <table class="table table-cols">
            <colgroup>
                <col class="width10p">
                <col>
                <col class="width-sm">
                <col class="width-3xl">
            </colgroup>
            <tbody>
            <tr>
                <th class="require">게시판</th>
                <td>
                    <?php if (esc($article['id']) && esc($article['board_id'])): ?>
                        <strong><?= $article['board_id'] ?></strong>
                    <?php else : ?>
                    <span>
                        <select name="board_id" id="board_id">
                            <?php foreach ($boardLists as $board): ?>
                                <option value="<?=esc($board['board_id']) ?>" <?php if($board_id == $board['board_id']) : ?>selected <?php endif;?>><?=esc($board['name'])?>(<?=esc($board['board_id'])?>)</option>
                            <? endforeach; ?>
                        </select>
                    </span>
                    <?php endif; ?>
                </td>
                <th>노출 여부</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="use_yn" value="Y" checked>노출</label>
                    <label class="radio-inline"><input type="radio" name="use_yn" value="N">미노출</label>
                </td>
            </tr>
            <tr>
                <th class="require">제목</th>
                <td colspan="3">
                    <input type="text" name="title" id="title" class="form-control" value="<?=$article['title'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <th>파일첨부</th>
                <td class="form-inline" colspan="3">
                    <ul class="pdl0" id="uploadBox">
                        <li class="form-inline mgb5">
                            <input type="file" name="upfiles[]" id="filestyle-0">
                            <a class="btn btn-white btn-icon-plus addUploadBtn btn-sm">추가</a>
                        </li>
                    </ul>
                    <input type="hidden" id="fileCnt" value="1" />
                </td>
            </tr>
            <tr>
                <th>내용</th>
                <td class="form-inline" colspan="3">
                    <div>
                        <input type="checkbox" name="is_notice" id="is_notice" value="Y" <?= ($article['is_notice'] ?? '') === 'Y' ? 'checked' : '' ?>>
                        <label for="is_notice" class="mgr20">공지사항</label>
                        <input type="checkbox" name="secret" id="secret" value="Y" <?= ($article['secret'] ?? '') === 'Y' ? 'checked' : '' ?>>
                        <label for="secret">비밀글</label>
                    </div>
                    <div class="mgt5">
                        <textarea name="content" id="editor" rows="10" cols="100" style="width:100%; height:300px;">
                            <?= esc($article['content'] ?? '') ?>
                        </textarea>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="text-center">
            <button class="btn btn-white" type="button" onclick="goList('<?= base_url('admin/board/article_list') ?>/<?= esc($article['board_id'] ?? '') ?>')">목록가기</button>
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



</script>


<?php echo $this->endSection() ?>
