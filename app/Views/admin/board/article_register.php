<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form action="<?= site_url('admin/board/article_submit') ?>" method="post" id="frm">
    <?=csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($board['id'] ?? '') ?>">
    <div class="page-header js-affix affix-top">
        <h3>게시글 등록 </h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/board/board_list") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <div class="table-title gd-help-manual"> 게시글 등록 </div>
    <div>
        <table class="table table-cols">
            <colgroup>
                <col class="width10p">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th class="require">게시판</th>
                <td>
                    <span>
                        <select name="board_setting_id" >
                            <?php foreach ($boardLists as $board): ?>
                                <option value="<?=esc($board['board_id']) ?>" ><?=esc($board['name'])?>(<?=esc($board['board_id'])?>)</option>
                            <? endforeach; ?>
                        </select>
                    </span>
                </td>
            </tr>
            <tr>
                <th class="require">제목</th>
                <td>
                    <input type="text" name="title" id="title" class="form-control" value="<?=$board['title'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <th>파일첨부</th>
                <td class="form-inline">
                    <ul class="pdl0" id="uploadBox">
                        <li class="form-inline mgb5">
                            <input type="file" name="upfiles[]" id="filestyle-0">
                            <a class="btn btn-white btn-icon-plus addUploadBtn btn-sm">추가</a>
                        </li>

                        <li class="form-inline mgb5">
                            <input type="file" name="upfiles[]" id="filestyle-1">
                            <a class="btn btn-white btn-icon-minus minusUploadBtn btn-sm">삭제</a>
                        </li>
                    </ul>
                    <input type="hidden" id="fileCnt" value="1" />
                </td>
            </tr>
            <tr>
                <th>내용</th>
                <td class="form-inline">
                    <textarea name="content" id="editor" rows="10" cols="100" style="width:100%; height:300px;"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
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

    function openEditorFileUpload() {
        window.open('/editor/upload', 'fileUpload', 'width=500,height=300');
    }
</script>


<?php echo $this->endSection() ?>
