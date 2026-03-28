<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?><?= esc($pageTitle) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form action="<?= site_url('admin/policy/submit') ?>" method="post" id="frm">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($admin['id']) ?>">

        <div class="page-header">
            <h3><?= esc($pageTitle) ?></h3>
            <div class="btn-group">
                <input type="button" value="목록" class="btn btn-white btn-icon-list"
                       onclick="goList('<?= base_url('admin/policy/manage') ?>')">
                <input type="button" value="저장" class="btn btn-red btn-register">
            </div>
        </div>

        <div class="table-title">기본정보</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody>
            <tr>
                <th class="require">아이디</th>
                <td>
                    <?php if (!empty($admin['admin_id'])): ?>
                        <strong><?= esc($admin['admin_id']) ?></strong>
                    <?php else: ?>
                        <input type="text" name="admin_id" id="admin_id"
                               value="<?= esc($admin['admin_id'] ?? '') ?>"
                               class="form-control width-sm">
                        <button type="button" id="overlap_memId" class="btn btn-gray btn-sm">중복확인</button>
                    <?php endif; ?>
                </td>
                <th class="require">비밀번호</th>
                <td>
                    <div class="form-inline">
                        <input type="password" name="password" value=""
                               class="form-control width-sm" placeholder="비밀번호입력" maxlength="16">
                        <input type="password" name="password_confirmation" value=""
                               class="form-control width-sm" placeholder="비밀번호확인" maxlength="16"
                               style="margin-left:10px;">
                    </div>
                </td>
            </tr>
            <tr>
                <th class="require">이름</th>
                <td>
                    <input type="text" name="name"
                           value="<?= esc($admin['name'] ?? '') ?>"
                           class="form-control width-sm" maxlength="20">
                </td>
                <th>부서</th>
                <td>
                    <select name="department_code" class="form-control">
                        <option value="">----</option>
                        <?php foreach ($codes['102001'] as $code): ?>
                            <option value="<?= esc($code['code']) ?>"
                                <?= ($code['code'] == ($admin['department_code'] ?? '')) ? 'selected' : '' ?>>
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
                                <?= ($code['code'] == ($admin['position_code'] ?? '')) ? 'selected' : '' ?>>
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
                                <?= ($code['code'] == ($admin['duty_code'] ?? '')) ? 'selected' : '' ?>>
                                <?= esc($code['code_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>전화번호</th>
                <td>
                    <input type="text" name="phone"
                           value="<?= esc($admin['phone'] ?? '') ?>"
                           maxlength="13" class="form-control js-tel width-sm">
                </td>
                <th>관리자 레벨</th>
                <td></td>
            </tr>
            </tbody>
        </table>
    </form>

<?= $this->endSection() ?>