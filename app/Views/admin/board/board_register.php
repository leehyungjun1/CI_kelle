<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form action="<?= site_url('admin/board/submit') ?>" method="post" id="frm">
    <?=csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($board['id'] ?? '') ?>">
    <div class="page-header js-affix affix-top">
        <h3>게시판 등록 </h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/board/board_list") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <div class="table-title gd-help-manual"> 기본설정 </div>
    <div class="form-inline">
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-2xl">
                <col class="width-sm">
                <col class="width-3xl">
            </colgroup>
            <tbody>
            <tr>
                <th class="require">아이디</th>
                <td>
                    <span>
                        <? if($board['board_id'] != null) : ?>
                            <strong><?=$board['board_id'] ?? '';?></strong>
                        <? else : ?>
                            <input type="text" name="board_id" id="board_id" value="<?=$board['board_id'] ?? '';?>" class="form-control error">
                            <button type="button" id="overlap_memId" class="btn btn-gray btn-sm">중복확인</button>
                        <? endif; ?>
                    </span>
                </td>
                <th>사용여부</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="use_yn" value="Y" checked="checked">사용</label>
                    <label class="radio-inline"><input type="radio" name="use_yn" value="N">미사용</label>
                </td>
            </tr>
            <tr>
                <th class="require">게시판명</th>
                <td colspan="3">
                    <span><input type="text" name="name" id="memNm" value="<?=$board['name'] ?? '' ?>" class="form-control width-sm" maxlength="20"></span>
                </td>
            </tr>
            <tr>
                <th class="require">유형</th>
                <td  colspan="3" class="form-inline">
                    <div style="display:flex;">
                        <div class="pull-left" style="padding-right:15px">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="D" checked="checked">일반형
                                <div class="mgt10"><img src="/img/board/type_default.png"></div>
                            </label>
                        </div>
                        <div class="pull-left" style="padding-right:15px">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="G">갤러리형
                                <div class="mgt10"><img src="/img/board/type_gallery.png"></div>
                            </label>
                        </div>
                        <div class="pull-left" style="padding-right:15px">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="E">이벤트형
                                <div class="mgt10"><img src="/img/board/type_event.png"></div>
                            </label>
                        </div>
                        <div class="pull-left" style="padding-right:15px">
                            <label class="radio-inline">
                                <input type="radio" name="type" value="Q">1:1 문의형
                                <div class="mgt10"><img src="/img/board/type_qa.png"></div>
                            </label>
                        </div>
                    </div>
                    <div class="notice-info">
                        1:1 문의형 게시판은 댓글 기능이 제공되지 않습니다.
                    </div>
                </td>
            </tr>
            <tr>
                <th>말머리 기능</th>
                <td colspan="3">
                    <input type="checkbox" name="is_category" value="Y" id="is_category" /> 말머리 사용
                    <div id="categoryBox" style="display:none; padding-top:10px;">
                        <table class="table table-cols">
                            <colgroup>
                                <col class="width-sm">
                                <col>
                            </colgroup>
                            <tbody><tr>
                                <th>말머리 타이틀</th>
                                <td>
                                    <input type="text" name="bdCategoryTitle" class="form-control" value="">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    말머리 입력
                                </th>
                                <td>
                                    <table class="table table-cols categoryTable">
                                        <colgroup>
                                            <col class="width-2xl">
                                        </colgroup>
                                        <tbody id="categoryTbody">
                                        <tr>
                                            <th>말머리명</th>
                                        </tr>
                                        <tr>
                                            <td class="form-inline">
                                                <input type="text" name="header_name[]" class="form-control js-add-field-category" size="40" value="공유">
                                                <input type="color" name="badge_color[]" class="form-control" value="#ff0000" style="width: 50px; padding: 0; border: none;">
                                                <input type="checkbox" name="is_use[]" value="Y" checked/> 사용여부
                                                <button type="button" class="btn btn-sm btn-white btn-icon-plus btn-add-category">추가</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
<script>
    $(document).on("click", ".btn-add-category", function () {
        $("#categoryTbody").append(`
        <tr>
            <td class="form-inline">
                <input type="text" name="header_name[]" class="form-control js-add-field-category" size="40" value="">
                <input type="color" name="badge_color[]" class="form-control color-picker" value="#ff0000" style="width: 50px; padding: 0; border: none;">
                 <input type="checkbox" name="is_use[]" value="Y" checked /> 사용여부
                <button type="button" class="btn btn-sm btn-white btn-icon-minus btn-del-category">삭제</button>
            </td>
        </tr>
    `);
    });

    // 삭제 버튼
    $(document).on("click", ".btn-del-category", function () {
        $(this).closest("tr").remove();
    });

    $(document).on("change", "#is_category", function () {
        if ($(this).is(":checked")) {
            $("#categoryBox").show();
        } else {
            $("#categoryBox").hide();
        }
    });
</script>

<?php echo $this->endSection() ?>
