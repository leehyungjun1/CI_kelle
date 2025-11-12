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
                    <label class="radio-inline"><input type="radio" name="use_yn" value="" checked="checked">전체</label>
                    <label class="radio-inline"><input type="radio" name="use_yn" value="Y">사용</label>
                    <label class="radio-inline"><input type="radio" name="use_yn" value="N">미사용</label>
                </td>
            </tr>
            <tr>
                <th class="require">게시판명</th>
                <td colspan="3">
                    <span><input type="text" name="name" id="memNm" value="<?=$board['name'] ?? '' ?>" class="form-control width-sm" data-pattern="gdMemberNmGlobal" maxlength="20"></span>
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
            </tbody>
        </table>
    </div>
</form>
<?php echo $this->endSection() ?>
