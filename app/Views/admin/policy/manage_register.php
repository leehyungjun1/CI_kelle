<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form action="<?= site_url('admin/policy/submit') ?>" method="post" id="frm">
    <?=csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($admin['id']) ?>">
    <div class="page-header js-affix affix-top">
        <h3>관리자 등록 </h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/policy/manage") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <div class="table-title gd-help-manual"> 기본정보 </div>
    <div class="form-inline">
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
                    <span>
                        <? if($admin['admin_id']) : ?>
                            <strong><?=$admin['admin_id'] ?? '';?></strong>
                        <? else : ?>
                            <input type="text" name="admin_id" id="admin_id" value="<?=$admin['admin_id'] ?? '';?>" class="form-control error">
                            <button type="button" id="overlap_memId" class="btn btn-gray btn-sm">중복확인</button>
                        <? endif; ?>
                    </span>
                </td>
                <th class="require">비밀번호</th>
                <td>
                    <span title="비밀번호를 입력해주세요!" style="position: relative;">
                        <input type="password" name="password" value="" class="form-control width-sm js-maxlength" placeholder="비밀번호입력" maxlength="16">&nbsp;
                        <input type="password" name="password_confirmation" value="" class="form-control width-sm js-maxlength" placeholder="비밀번호확인" maxlength="16" style="margin-left: 40px">
                    </span>
                </td>
            </tr>
            <tr>
                <th class="require">이름</th>
                <td>
                    <span><input type="text" name="name" id="memNm" value="<?=$admin['name'] ?? '' ?>" class="form-control width-sm" data-pattern="gdMemberNmGlobal" maxlength="20"></span>
                </td>
                <th>부서</th>
                <td>
                    <div class="form-inline mgb5">
                        <select name="department_code">
                            <option value="">----</option>
                            <?php foreach ($codes['102001'] as $code): ?>
                                <option value="<?= esc($code['code']) ?>" <?php if(esc($code['code']) == $admin['department_code']) : ?> selected <?php endif; ?>><?= esc($code['code_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>

            </tr>
            <tr>
                <th>직원</th>
                <td>
                    <div class="form-inline mgb5">
                        <select name="position_code">
                            <option value="">----</option>
                            <?php foreach ($codes['102002'] as $code): ?>
                                <option value="<?= esc($code['code']) ?>" <?php if(esc($code['code']) == $admin['position_code']) : ?> selected <?php endif; ?>><?= esc($code['code_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>
                <th>직책</th>
                <td>
                    <div class="form-inline mgb5">
                        <select name="duty_code">
                            <option value="">----</option>
                            <?php foreach ($codes['102003'] as $code): ?>
                                <option value="<?= esc($code['code']) ?>" <?php if(esc($code['code']) == $admin['duty_code']) : ?> selected <?php endif; ?>><?= esc($code['code_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th>전화번호</th>
                <td>
                    <div class="form-inline">
                        <span title="전화번호를 입력해주세요!" style="position: relative;">
                        <input type="text" name="phone" value="<?=esc($admin['phone'] ?? '')?>" maxlength="12" class="form-control js-number-only width-md">
                    </div>
                </td>
                <th>관리자 레벨</th>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
<?php echo $this->endSection() ?>
