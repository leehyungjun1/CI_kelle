<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?><?= esc($pageTitle) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form action="<?= site_url('admin/policy/submit') ?>" method="post" id="frm" enctype="multipart/form-data">
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

        <!-- 기본정보 -->
        <div class="table-title">기본정보</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm"><col class="width-3xl">
                <col class="width-sm"><col class="">
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
                    <input type="text" name="name" value="<?= esc($admin['name'] ?? '') ?>"
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
                    <input type="text" name="phone" value="<?= esc($admin['phone'] ?? '') ?>"
                           maxlength="13" class="form-control js-tel width-sm">
                </td>
                <th>우수 플래너.</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="is_best" value="Y" <?=(!isset($admin['is_best']) || $admin['is_best'] == "Y") ? "checked" : '' ?>>예 </label>
                    <label class="radio-inline"><input type="radio" name="is_best" value="N" <?=(isset($admin['is_best']) && $admin['is_best'] == "N") ? "checked" : '' ?>>아니오</label>
                </td>
            </tr>

            <tr>
                <th>승인여부</th>
                <td>
                    <label class="radio-inline"><input type="radio" name="regist_YN" value="Y" <?=(!isset($admin['regist_YN']) || $admin['regist_YN'] == "Y") ? "checked" : '' ?>>승인 </label>
                    <label class="radio-inline"><input type="radio" name="regist_YN" value="N" <?=(isset($admin['regist_YN']) && $admin['regist_YN'] == "N") ? "checked" : '' ?>>미승인</label>
                </td>
                <th>직원 형태</th>
                <td>
                    <select name="employee_kind" class="form-control">
                        <option value="">----</option>
                        <option value="Y" <?= ($admin['employee_kind'] == "Y" ) ? 'selected' : '' ?>>정직원</option>
                        <option value="R" <?= ($admin['employee_kind'] == "R" ) ? 'selected' : '' ?>>퇴사</option>
                    </select>
                </td>
            </tr>
            
            </tbody>
        </table>

        <!-- 추가정보 -->
        <div class="table-title">추가정보</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm"><col class="width-3xl">
                <col class="width-sm"><col class="">
            </colgroup>
            <tbody>
            <tr>
                <th>제목</th>
                <td colspan="3">
                    <input type="text" name="title" value="<?= esc($admin['title'] ?? '') ?>"
                           class="form-control width-sm" placeholder="예: 학습 플래너">
                </td>                
            </tr>
            <tr>
                <th>프로필 사진</th>
                <td>
                    <div class="form-inline mgb5">
                        <label class="btn btn-gray btn-sm upload-label">
                            찾아보기
                            <input type="file" name="profile_path" accept="image/*" style="display:none;">
                        </label>
                        <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">선택된 파일 없음</span>
                    </div>
                    <?php if (!empty($admin['profile_path'])): ?>
                        <div class="mgt5">
                            <img id="profilePreview" src="<?= base_url($admin['profile_path']) ?>" alt="프로필"
                                 style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:1px solid #ddd;">
                        </div>
                    <?php else: ?>
                        <div class="mgt5" id="profilePreviewWrap" style="display:none;">
                            <img id="profilePreview" src="" alt="프로필"
                                 style="width:80px; height:80px; border-radius:50%; object-fit:cover; border:1px solid #ddd;">
                        </div>
                    <?php endif; ?>
                    <div class="notice-info mgt5">권장 크기: 200x200px, JPG/PNG</div>
                </td>
                <th>자기소개</th>
                <td>
                    <textarea name="relations" rows="5" cols="" class="form-control width90p js-maxlength"><?= esc($admin['relations'] ?? '') ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- 담당 교육과정 -->
        <div class="table-title">담당 교육과정</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm"><col>
            </colgroup>
            <tbody>
            <tr>
                <th>담당 과정</th>
                <td>
                    <?php if (!empty($courseCodes['depth2'])): ?>
                        <?php
                        $depth3ByParent = [];
                        foreach ($courseCodes['depth3'] as $d3) {
                            $parent = substr($d3['code'], 0, 6);
                            $depth3ByParent[$parent][] = $d3;
                        }
                        ?>
                        <div class="course-field-wrap">
                            <?php foreach ($courseCodes['depth2'] as $d2): ?>
                                <div class="course-group">
                                    <label class="course-parent">
                                        <input type="checkbox" class="chk-parent"
                                               data-parent="<?= esc($d2['code']) ?>"
                                               value="<?= esc($d2['code']) ?>">
                                        <strong><?= esc($d2['code_name']) ?></strong>
                                    </label>
                                    <?php if (!empty($depth3ByParent[$d2['code']])): ?>
                                        <div class="course-children" data-group="<?= esc($d2['code']) ?>">
                                            <?php foreach ($depth3ByParent[$d2['code']] as $d3): ?>
                                                <label class="course-child">
                                                    <input type="checkbox" name="field_codes[]"
                                                           class="chk-child"
                                                           data-parent="<?= esc($d2['code']) ?>"
                                                           value="<?= esc($d3['code']) ?>"
                                                        <?= in_array($d3['code'], $adminCodes ?? []) ? 'checked' : '' ?>>
                                                    <?= esc($d3['code_name']) ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span class="text-muted">등록된 교육과정이 없습니다.</span>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        </table>

    </form>
<?= $this->endSection() ?>