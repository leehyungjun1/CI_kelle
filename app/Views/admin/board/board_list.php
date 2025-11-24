<?php echo $this->extend('layouts/admin_sub') ?>

<?php echo $this->section('content') ?>
<div class="page-header js-affix affix-top" style="width: 1634px;">
    <h3>게시판 리스트 </h3>
    <input type="button" value="게시판 만들기" class="btn btn-red-line" onClick='goList("<?= base_url("admin/board/board_register") ?>")'>
</div>
<form id="frmSearchBase" method="get" class="content-form js-search-form js-form-enter-submit">
    <input type="hidden" name="sort" value="" id="searchsort">
    <input type="hidden" name="searchFl" value="y">
    <input type="hidden" name="pageNum" value="10">
    <div class="table-title gd-help-manual">게시판 검색</div>
    <div class="search-detail-box form-inline">
        <input type="hidden" name="detailSearch" value="">
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col class="width-5xl">
            </colgroup>
            <tbody>
            <tr>
                <th>검색어</th>
                <td colspan="3">
                    <select class=" form-control" id="key" name="key">
                        <option value="userid" <?=(($_GET['key'] ?? '') === 'userid') ? 'selected' : '' ?>>아이디</option>
                        <option value="name" <?=(($_GET['key'] ?? '') === 'name') ? 'selected' : '' ?>>이름</option>
                    </select>
                    <select class=" form-control " id="searchKind" name="searchKind">
                        <option value="equalSearch" <?=(($_GET['searchKind'] ?? '') === 'equalSearch')? 'selected' : '' ?>>검색어 전체일치</option>
                        <option value="fullLikeSearch" <?=(($_GET['searchKind'] ?? '') === 'fullLikeSearch')? 'selected' : '' ?>>검색어 부분포함</option>
                    </select>
                    <input type="text" name="keyword" value="<?=($_GET['keyword'] ?? '');?>" class="form-control width-xl" placeholder="검색어 전체를 정확히 입력하세요.">
                </td>
            </tr>
            <tr>
                <th>유형</th>
                <td>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="type" value="" checked="checked"> 전체 </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="type" value="D" <?=(isset($_GET['type']) && $_GET['type'] == 'Y') ? 'checked' : '' ?>>
                        일반형
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="type" value="D" <?=(isset($_GET['type']) && $_GET['type'] == 'Y') ? 'checked' : '' ?>>
                        갤러리형
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="type" value="D" <?=(isset($_GET['type']) && $_GET['type'] == 'Y') ? 'checked' : '' ?>>
                        이벤트형
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="type" value="D" <?=(isset($_GET['type']) && $_GET['type'] == 'Y') ? 'checked' : '' ?>>
                        1:1문의형
                    </label>
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
            <strong><?=number_format($searchCount) ?></strong>
            명 / 전체
            <strong><?=number_format($totalCount) ?></strong>
            명
        </div>
    </div>

    <table class="table table-rows">
        <colgroup>
            <col class="width-xs">
            <col class="width-xs">
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>
                <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
            </th>
            <th>번호</th>
            <th>아이디</th>
            <th>이름</th>
            <th>신규게시글</th>
            <th>전체게시글</th>
            <th>미답변</th>
            <th>유형</th>
            <th>정보수정</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($boards)) : ?>
            <?php
            $startNo = $searchCount - (($page - 1) * $perPage);
            ?>
            <?php foreach($boards as $i => $board) : ?>
                <tr class="center" data-member-no="<?=esc($board['id'] ?? '') ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?=esc($board['id'] ?? '') ?>">
                    </td>
                    <td class="font-num"><span class="number js-layer-crm hand"><?= $startNo - $i ?></span></td>
                    <td><span class="font-eng js-layer-crm hand"><a href="<?=base_url('admin/board/article_list/'.$board['board_id'] ?? '')?>"><?=esc($board['board_id'] ?? '') ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($board['name'] ?? '') ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc(number_format($board['new'] ?? 0)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc(number_format($board['total'] ?? 0)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc(number_format($board['reply'] ?? 0)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($board['type_name'] ?? '') ?> </span></td>
                    <td><button type="button" class="btn btn-white btn-sm btnModify" onClick=goList('<?= base_url("admin/board/board_register/{$board['id']}") ?>')>수정</button></td>
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

    <div class="center"><nav><ul class="pagination pagination-sm"></ul></nav></div>
</form>

<script>
    $(document).on("click", "#btnDelete", function() {
        handleAdminAction("<?=base_url('admin/board/board_delete') ?>",
            '선택된 게시물을 삭제하시겠습니까?',
        );
    });
</script>


<?php echo $this->endSection() ?>



