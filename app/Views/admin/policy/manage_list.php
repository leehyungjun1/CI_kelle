<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>운영자 관리<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="page-header">
        <h3>운영자 관리</h3>
        <div class="btn-group">
            <input type="button" value="+ 운영자 등록" class="btn btn-white"
                   onclick="goList('<?= base_url('admin/policy/manage_register') ?>')">
        </div>
    </div>

    <form id="frmSearchBase" method="get" class="content-form js-search-form js-form-enter-submit">
        <input type="hidden" name="sort" value="" id="searchsort">
        <input type="hidden" name="searchFl" value="y">
        <input type="hidden" name="pageNum" value="10">
        <div class="table-title">운영 검색</div>
        <div class="search-detail-box form-inline">
            <table class="table table-cols">
                <colgroup>
                    <col class="width-sm">
                    <col class="width-3xl">
                    <col class="width-sm">
                    <col class="width-3xl">
                </colgroup>
                <tbody>
                <tr>
                    <th>검색어</th>
                    <td colspan="3">
                        <select class="form-control" name="key">
                            <option value="admin_id" <?= (($_GET['key'] ?? '') === 'admin_id') ? 'selected' : '' ?>>아이디</option>
                            <option value="name"     <?= (($_GET['key'] ?? '') === 'name')     ? 'selected' : '' ?>>이름</option>
                            <option value="phone"    <?= (($_GET['key'] ?? '') === 'phone')    ? 'selected' : '' ?>>전화번호</option>
                        </select>
                        <select class="form-control" name="searchKind">
                            <option value="equalSearch"    <?= (($_GET['searchKind'] ?? '') === 'equalSearch')    ? 'selected' : '' ?>>전체일치</option>
                            <option value="fullLikeSearch" <?= (($_GET['searchKind'] ?? '') === 'fullLikeSearch') ? 'selected' : '' ?>>부분포함</option>
                        </select>
                        <input type="text" name="keyword" value="<?= esc($_GET['keyword'] ?? '') ?>"
                               class="form-control width-xl" placeholder="검색어를 입력하세요.">
                    </td>
                </tr>
                <tr>
                    <th>승인여부</th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="regist_YN" value=""
                                <?= !isset($_GET['regist_YN']) || $_GET['regist_YN'] === '' ? 'checked' : '' ?>>전체
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="regist_YN" value="Y"
                                <?= (($_GET['regist_YN'] ?? '') === 'Y') ? 'checked' : '' ?>>승인
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="regist_YN" value="N"
                                <?= (($_GET['regist_YN'] ?? '') === 'N') ? 'checked' : '' ?>>미승인
                        </label>
                    </td>
                    <th>부서</th>
                    <td>
                        <select name="department_code" class="form-control">
                            <option value="">----</option>
                            <?php foreach ($codes['102001'] as $code): ?>
                                <option value="<?= esc($code['code']) ?>"
                                    <?= (($_GET['department_code'] ?? '') === $code['code']) ? 'selected' : '' ?>>
                                    <?= esc($code['code_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>직급</th>
                    <td>
                        <select name="position_code" class="form-control">
                            <option value="">----</option>
                            <?php foreach ($codes['102002'] as $code): ?>
                                <option value="<?= esc($code['code']) ?>"
                                    <?= (($_GET['position_code'] ?? '') === $code['code']) ? 'selected' : '' ?>>
                                    <?= esc($code['code_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th>직책</th>
                    <td>
                        <select name="duty_code" class="form-control">
                            <option value="">----</option>
                            <?php foreach ($codes['102003'] as $code): ?>
                                <option value="<?= esc($code['code']) ?>"
                                    <?= (($_GET['duty_code'] ?? '') === $code['code']) ? 'selected' : '' ?>>
                                    <?= esc($code['code_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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
                검색 <strong><?= number_format($searchCount ?? 0) ?></strong>명 /
                전체 <strong><?= number_format($totalCount ?? 0) ?></strong>명
            </div>
            <div class="pull-right">
                <select name="pageNum" class="form-control">
                    <?php foreach ([10, 20, 30, 50] as $num): ?>
                        <option value="<?= $num ?>"
                            <?= (int)($perPage ?? 10) === $num ? 'selected' : '' ?>>
                            <?= $num ?>개 보기
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <table class="table table-rows">
            <thead>
            <tr>
                <th class="width-2xs">
                    <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
                </th>
                <th class="width-2xs">번호</th>
                <th>아이디</th>
                <th>이름</th>
                <th>부서</th>
                <th>직급</th>
                <th>직책</th>
                <th>연락처</th>
                <th>등록일</th>
                <th class="width-sm">수정/삭제</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($admins)): ?>
                <?php
                $startNo = $searchCount - (($page - 1) * $perPage);
                ?>
                <?php foreach ($admins as $i => $admin): ?>
                    <tr class="center">
                        <td>
                            <input type="checkbox" name="chk[]" value="<?= esc($admin['id'] ?? '') ?>">
                        </td>
                        <td class="font-num"><?= $startNo - $i ?></td>
                        <td><?= esc($admin['admin_id'] ?? '') ?></td>
                        <td><?= esc($admin['name'] ?? '') ?></td>
                        <td><?= esc($jySetting->getCodeName($admin['department_code'] ?? null)) ?></td>
                        <td><?= esc($jySetting->getCodeName($admin['position_code'] ?? null)) ?></td>
                        <td><?= esc($jySetting->getCodeName($admin['duty_code'] ?? null)) ?></td>
                        <td><?= esc($admin['phone'] ?? '') ?></td>
                        <td><?= esc(date('Y-m-d', strtotime($admin['created_at'] ?? 'now'))) ?></td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm"
                                    onclick="goList('<?= base_url('admin/policy/manage_register/'.esc($admin['id'] ?? '')) ?>')">
                                수정
                            </button>
                            <button type="button" class="btn btn-white btn-sm js-btn-delete"
                                    data-id="<?= esc($admin['id'] ?? '') ?>">
                                삭제
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td class="center" colspan="10">검색된 정보가 없습니다.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="table-action clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-white" id="btnApply">선택 승인</button>
                <button type="button" class="btn btn-white" id="btnDelete">선택 삭제</button>
            </div>
        </div>

        <div class="center">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    </form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {
            // ── 선택 승인 ──
            $('#btnApply').on('click', function() {
                handleAdminAction(
                    '<?= base_url('admin/policy/manage_action') ?>',
                    '선택된 관리자를 승인하시겠습니까?',
                    'approve'
                );
            });

            // ── 선택 삭제 ──
            $('#btnDelete').on('click', function() {
                handleAdminAction(
                    '<?= base_url('admin/policy/manage_action') ?>',
                    '선택된 관리자를 삭제하시겠습니까?'
                );
            });

            // ── 개별 삭제 ──
            $(document).on('click', '.js-btn-delete', function() {
                const id = $(this).data('id');
                handleAdminAction(
                    '<?= base_url('admin/policy/manage_action') ?>',
                    '해당 관리자를 삭제하시겠습니까?',
                    'delete',
                    [id]
                );
            });
        });
    </script>
<?= $this->endSection() ?>