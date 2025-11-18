<?php echo $this->extend('layouts/admin_sub') ?>

<?php echo $this->section('content') ?>
<div class="page-header js-affix affix-top">
    <h3>운영자 관리</h3>
    <input type="button" value="운영자 등록" class="btn btn-red-line" onClick='goList("<?= base_url("admin/policy/manage_register") ?>")'>
</div>
<form id="frmSearchBase" method="get" class="content-form js-search-form js-form-enter-submit">
    <input type="hidden" name="sort" value="" id="searchsort">
    <input type="hidden" name="searchFl" value="y">
    <input type="hidden" name="pageNum" value="10">
    <div class="table-title gd-help-manual">운영 검색</div>
    <div class="search-detail-box form-inline">
        <input type="hidden" name="detailSearch" value="">
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col class="width-2xl">
                <col class="width-md">
                <col class="width-3xl">
            </colgroup>
            <tbody>
            <tr>
                <th>검색어</th>
                <td colspan="3">
                    <select class=" form-control" id="key" name="key">
                        <option value="admin_id" <?=(($_GET['key'] ?? '') === 'admin_id') ? 'selected' : '' ?>>아이디</option>
                        <option value="name" <?=(($_GET['key'] ?? '') === 'name') ? 'selected' : '' ?>>이름</option>
                        <option value="phone" <?=(($_GET['key'] ?? '') === 'phone')? 'selected' : '' ?>>전화번호</option>
                    </select>
                    <select class=" form-control " id="searchKind" name="searchKind">
                        <option value="equalSearch" <?=(($_GET['searchKind'] ?? '') === 'equalSearch')? 'selected' : '' ?>>검색어 전체일치</option>
                        <option value="fullLikeSearch" <?=(($_GET['searchKind'] ?? '') === 'fullLikeSearch')? 'selected' : '' ?>>검색어 부분포함</option>
                    </select>
                    <input type="text" name="keyword" value="<?=($_GET['keyword'] ?? '');?>" class="form-control width-xl" placeholder="검색어 전체를 정확히 입력하세요.">
                </td>
            </tr>
            <tr>

            </tr>
            <tr>
                <th>직원여부</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="regist_YN" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="regist_YN" value="Y" <?=(isset($_GET['regist_YN']) && $_GET['regist_YN'] == 'Y') ? 'checked' : '' ?>>
                        승인
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="regist_YN" value="N" <?=(isset($_GET['regist_YN']) && $_GET['regist_YN'] == 'N') ? 'checked' : '' ?>>
                        미승인
                    </label>
                </td>
                <th>부서</th>
                <td>
                    <select name="department_code">
                        <option value="">----</option>
                        <?php foreach ($codes['102001'] as $code): ?>
                            <option value="<?= esc($code['code']) ?>">
                                <?= esc($code['code_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>직급</th>
                <td>
                    <select name="position_code">
                        <option value="">----</option>
                        <?php foreach ($codes['102002'] as $code): ?>
                            <option value="<?= esc($code['code']) ?>">
                                <?= esc($code['code_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <th>직책</th>
                <td><select name="duty_code">
                        <option value="">----</option>
                        <?php foreach ($codes['102003'] as $code): ?>
                            <option value="<?= esc($code['code']) ?>">
                                <?= esc($code['code_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select></td>
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
            <strong><?=number_format($searchCount ?? 0) ?></strong>
            명 / 전체
            <strong><?=number_format($totalCount ?? 0) ?></strong>
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
            <th>부서</th>
            <th>직원</th>
            <th>직급</th>
            <th>연락처</th>
            <th>등록일</th>
            <th>정보수정</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($admins)) : ?>
            <?php
            $startNo = $searchCount - (($page - 1) * $perPage);
            ?>
            <?php foreach($admins as $i => $admin) : ?>
                <tr class="center" data-member-no="<?=esc($admin['id'] ?? '') ?>">
                    <td>
                        <input type="checkbox" name="chk[]" value="<?=esc($admin['id'] ?? '') ?>">
                    </td>
                    <td class="font-num"><span class="number js-layer-crm hand"><?= $startNo - $i ?></span></td>
                    <td><span class="font-eng js-layer-crm hand"><?=esc($admin['admin_id'] ?? '') ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($admin['name'] ?? '') ?></span></td>
                    <td><span class="js-layer-crm hand"><?= esc($jySetting->getCodeName($admin['department_code'] ?? null)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?= esc($jySetting->getCodeName($admin['position_code'] ?? null)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?= esc($jySetting->getCodeName($admin['duty_code'] ?? null)) ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($admin['phone'] ?? '') ?></span></td>
                    <td><span class="js-layer-crm hand"><?=esc($admin['created_at'] ?? '') ?></span></td>
                    <td>
                        <?php $adminId = (is_array($admin) && isset($admin['id'])) ? $admin['id'] : ''; ?>
                        <button
                                type="button"
                                class="btn btn-white btn-sm btnModify"
                                onclick="goList('<?= base_url('admin/policy/manage_register/' . $adminId) ?>')">
                            수정
                        </button>

                        <button
                                type="button"
                                class="btn btn-white btn-sm btnModify"
                                onclick="goList('<?= base_url('admin/policy/manage_register/' . $adminId) ?>')">
                            삭제
                        </button>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td class="center" colspan="10">검색된 정보가 없습니다.</td></tr>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="table-action clearfix">
        <div class="pull-left">
            <button type="button" class="btn btn-white" id="btnApply">선택 승인</button>
            <button type="button" class="btn btn-white" id="btnDelete">선택 삭제처리</button>
        </div>
        <div class="pull-right">
            
        </div>
    </div>

    <div class="center">
        <?= $pager->links('default', 'default_full') ?>
    </div>

    <div class="center"><nav><ul class="pagination pagination-sm"></ul></nav></div>
</form>
<script>
    $(document).ready(function () {
        $('#chk_all').on('change', function () {
            const checked = $(this).is(':checked');
            $('input[name="chk[]"]').prop('checked', checked);
        });

        $(document).on('change', 'input[name="chk[]"]', function () {
            const total = $('input[name="chk[]"]').length;
            const checked = $('input[name="chk[]"]:checked').length;
            $('#chk_all').prop('checked', total === checked);
        });

        //function handleAdminAction(action, confirmMsg, successMsg) {
        //    const checked = $('input[name="chk[]"]:checked');
        //    if (checked.length === 0) {
        //        alert('선택된 관리자가 없습니다.');
        //        return false;
        //    }
        //
        //    const ids = checked.map(function() {
        //        return $(this).val();
        //    }).get();
        //
        //    dialog_confirm(confirmMsg, function (result) {
        //        if(result) {
        //            $.ajax({
        //                method: "POST",
        //                url: "<?php //= base_url('admin/policy/manage_action') ?>//",
        //                data: {ids: ids, action: action},
        //                success: function (res) {
        //                    if (res.status === 'success') {
        //                        alert(res.message);
        //                        setTimeout(() => location.reload(), 1500);
        //                    } else {
        //                        alert(res.message || '처리 중 오류가 발생했습니다.');
        //                    }
        //                },
        //                error: function () {
        //                    alert('서버 통신 중 오류가 발생했습니다.');
        //                }
        //            });
        //        }
        //    });
        //}

        $("#btnApply").on("click", function() {
            handleAdminAction(
                '<?=base_url("admin/policy/manage_action") ?>',
                '선택된 관리자를 승인하시겠습니까?',
                'approve',
            );
        });

        $("#btnDelete").on("click", function() {
            handleAdminAction(
                '<?=base_url("admin/policy/manage_action") ?>',
                '선택된 관리자를 삭제하시겠습니까?',
            );
        });
    });

</script>
<?php echo $this->endSection() ?>



