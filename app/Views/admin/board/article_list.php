<?php echo $this->extend('layouts/admin_sub') ?>

<?php echo $this->section('content') ?>
<div class="page-header js-affix affix-top">
    <h3>게시글 관리 </h3>
    <input type="button" value="등록" class="btn btn-red-line" onClick='goList("<?= base_url("admin/board/article_register/{$board_id}") ?>")'>
</div>
<form id="frmSearchBase" method="get" class="content-form js-search-form js-form-enter-submit">
    <input type="hidden" name="sort" value="" id="searchsort">
    <input type="hidden" name="searchFl" value="y">
    <input type="hidden" name="pageNum" value="10">
    <div class="table-title gd-help-manual">게시글 관리</div>
    <div class="search-detail-box form-inline">
        <input type="hidden" name="detailSearch" value="">
        <table class="table table-cols">
            <colgroup>
                <col class="width-xs">
                <col class="width-2xl">
                <col class="width-xs">
                <col class="width-3xl">
            </colgroup>
            <tbody>
                <tr>
                    <th>게시판</th>
                    <td>
                        <select class="form-control" id="board_id" name="board_id">
                            <?php foreach ($boardLists as $board): ?>
                                <option value="<?=esc($board['board_id']) ?>" <? if($board_id == $board['board_id'] ) :?> selected <? endif;?>><?=esc($board['name'])?>(<?=esc($board['board_id'])?>)</option>
                            <? endforeach; ?>
                        </select>
                    </td>
                    <th>말머리</th>
                    <td>

                    </td>
                </tr>
                <tr>
                    <th>검색어</th>
                    <td colspan="3">
                        <select class=" form-control" id="key" name="key">
                            <option value="title" <?=(($_GET['key'] ?? '') === 'title')? 'selected' : '' ?>>제목</option>
                            <option value="name" <?=(($_GET['key'] ?? '') === 'name') ? 'selected' : '' ?>>이름</option>
                            <option value="nickname" <?=(($_GET['key'] ?? '') === 'nickname')? 'selected' : '' ?>>닉네임</option>
                            <option value="phone" <?=(($_GET['key'] ?? '') === 'phone')? 'selected' : '' ?>>내용</option>
                        </select>
                        <select class=" form-control " id="searchKind" name="searchKind">
                            <option value="equalSearch" <?=(($_GET['searchKind'] ?? '') === 'equalSearch')? 'selected' : '' ?>>검색어 전체일치</option>
                            <option value="fullLikeSearch" <?=(($_GET['searchKind'] ?? '') === 'fullLikeSearch')? 'selected' : '' ?>>검색어 부분포함</option>
                        </select>
                        <input type="text" name="keyword" value="<?=($_GET['keyword'] ?? '');?>" class="form-control width-xl" placeholder="검색어 전체를 정확히 입력하세요.">
                    </td>
                </tr>

                <tr>
                    <th>일자</th>
                    <td colspan="3">
                        <div class="date-filter-wrapper d-flex align-items-center gap-2">
                            <select class=" form-control " name="dateKind">
                                <option value="created_at" <?=(($_GET['dateKind'] ?? '') === 'created_at')? 'selected' : '' ?>>등록일</option>
                                <option value="updated_at" <?=(($_GET['dateKind'] ?? '') === 'updated_at')? 'selected' : '' ?>>수정일</option>
                            </select>
                            <?= dateRangePicker([
                                'name' => 'entryDt[]',
                                'start' => date('Y-m-d', strtotime('-6 days')),
                                'end' => date('Y-m-d'),
                                'periods' => [
                                    ['label'=>'오늘','value'=>0],
                                    ['label'=>'7일','value'=>6,'active'=>true],
                                    ['label'=>'15일','value'=>14],
                                    ['label'=>'1개월','value'=>29],
                                    ['label'=>'3개월','value'=>89],
                                    ['label'=>'전체','value'=>-1],
                                ]
                            ]) ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table-btn">
        <input type="submit" value="검색" class="btn btn-lg btn-black js-search-button">
    </div>
</form>

<form id="frmList" action="" method="get" target="ifrmProcess">
    <div class="table-header form-inline">
        <div class="pull-left">
            검색
            <strong><?=number_format($boards['totalSearch']) ?></strong>
            명 / 전체
            <strong><?=number_format($boards['totalCount']) ?></strong>
            명
        </div>
    </div>

    <table class="table table-rows">
        <thead>
        <tr>
            <th class="width-2xs">
                <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
            </th>
            <th class="width-2xs">번호</th>
            <th>제목</th>
            <th class="width-sm">작성자</th>
            <th class="width-sm">작성일</th>
            <th class="width-2xs">조회</th>
            <th class="width-sm">답변상태</th>
            <th class="width-sm">답변일</th>
            <th class="width-sm">수정/답변</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($boards['boardData'])) : ?>
            <?php
            $startNo = $boards['totalSearch'] - (($boards['page'] - 1) * $boards['perPage']);
            ?>
            <?php foreach($boards['boardData'] as $board) : ?>
                <tr class="center" data-member-no="<?=esc($board['id'] ?? '') ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?=esc($board['id'] ?? '') ?>">
                    </td>
                    <td class="font-num"><span class="number js-layer-crm hand"><?= $startNo-- ?></span></td>
                    <td align="left">

                        <span class="font-eng js-layer-crm hand"><a href="<?=base_url('admin/board/article_view/'.esc($board_id).'/'.esc($board['id']));?>"?><?= replyIndent($board['depth']) ?> <?=esc($board['title'] ?? '') ?></a></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($board['writer'] ?? '') ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc(date('Y-m-d', strtotime($board['created_at']))) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc(number_format($board['hit'] ?? 0)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc(number_format($board['reply'] ?? 0)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($board['type_name'] ?? '') ?> </span></td>
                    <td>
                        <button type="button" class="btn btn-white btn-sm btnModify" onClick=goList('<?= base_url("admin/board/article_register/".esc($board_id)."/".$board['id']) ?>')>수정</button>
                        <?php if($board['parent_id'] == 0) : ?>
                        <button type="button" class="btn btn-white btn-sm btnModify" onClick=goList('<?= base_url("admin/board/replies_register/".esc($board_id)."/".$board['id']) ?>')>답변</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td class="center" colspan="9">검색된 정보가 없습니다.</td></tr>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="table-action clearfix">
        <div class="pull-left">
            <button type="button" class="btn btn-white" id="btnDelete">선택 게시판 삭제</button>
        </div>
    </div>

    <div class="center">
        <nav>
            <?= $boards['pager']->links() ?>
        </nav>
    </div>
</form>

<style>
    .date-filter-wrapper {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .date-range-picker .input-group {
        width: 130px;
    }

    .btn-group.js-dateperiod label {
        margin-right: 2px;
    }
</style>

<script>
    $(document).on("change", "#board_id", function() {
        url = $(this).find("option:selected").val();
        goList("<?= base_url('admin/board/article_list') ?>/"+url);
    });


    $(document).on("click", "#btnDelete", function() {
        handleAdminAction("<?=base_url('admin/board/article_delete/'.$board_id) ?>",
            '선택된 게시물을 삭제하시겠습니까?',
        );
    });
</script>

<?php echo $this->endSection() ?>



