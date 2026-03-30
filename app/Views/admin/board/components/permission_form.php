<?php
/**
 * 게시판 권한 설정 UI 컴포넌트
 * app/Views/admin/board/components/permission_form.php
 *
 * 필요 변수:
 *   $boardCode    string  — 게시판 코드
 *   $boardType    string  — 게시판 타입 (D/G/E/Q)
 *   $permMap      array   — JyBoardPermissionsModel::getPermissionMap() 결과
 *   $memberGrades array   — jy_settings 에서 가져온 회원 등급 목록 [{code, name}]
 *   $adminPositions array — jy_settings 에서 가져온 관리자 직책 목록 [{code, name}]
 *   $listCount    int     — 현재 목록 표시 수
 */

use App\Models\JyBoardPermissionsModel;

$actions  = JyBoardPermissionsModel::ACTIONS;
$isQType  = ($boardType === 'Q');

// reply 는 Q타입에서만 표시
if (!$isQType) {
    unset($actions['reply']);
}

// 컬럼 헤더 목록 구성
// key: targetKey ('guest' | 'member_grade_코드' | 'admin_position_코드')
$columns = [];
$columns['guest'] = '비회원';
foreach ($memberGrades as $g) {
    $columns['member_grade_' . $g['code']] = $g['name'];
}
foreach ($adminPositions as $p) {
    $columns['admin_position_' . $p['code']] = $p['name'];
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">권한 설정</h4>
    </div>
    <div class="panel-body">

        <!-- 목록 표시 수 -->
        <div class="form-group">
            <label class="col-sm-2 control-label">목록 표시 수</label>
            <div class="col-sm-10">
                <select name="list_count" class="form-control input-sm" style="width:100px">
                    <?php foreach ([10, 20, 30, 50, 100] as $n): ?>
                        <option value="<?= $n ?>" <?= (int)$listCount === $n ? 'selected' : '' ?>>
                            <?= $n ?>개
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <hr>

        <!-- 권한 테이블 -->
        <div class="table-responsive">
            <table class="table table-bordered table-condensed text-center" id="permissionTable">
                <thead>
                <tr>
                    <th rowspan="2" class="text-left" style="vertical-align:middle;min-width:80px">권한 항목</th>
                    <th>비회원</th>
                    <?php if (!empty($memberGrades)): ?>
                        <th colspan="<?= count($memberGrades) ?>">회원 등급</th>
                    <?php endif; ?>
                    <?php if (!empty($adminPositions)): ?>
                        <th colspan="<?= count($adminPositions) ?>">관리자 직책</th>
                    <?php endif; ?>
                </tr>
                <tr>
                    <!-- 비회원 빈칸 (rowspan으로 이미 차지) -->
                    <?php
                    // 비회원은 rowspan=2 로 위에서 처리했으므로 여기선 등급/직책만
                    foreach ($memberGrades as $g): ?>
                        <th style="min-width:70px"><?= esc($g['name']) ?></th>
                    <?php endforeach; ?>
                    <?php foreach ($adminPositions as $p): ?>
                        <th style="min-width:70px"><?= esc($p['name']) ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($actions as $actionKey => $actionLabel): ?>
                    <tr>
                        <td class="text-left"><?= $actionLabel ?></td>
                        <?php foreach ($columns as $colKey => $colLabel):
                            // 현재 저장된 값 — 없으면 기본값 적용
                            $defaultAllow = in_array($actionKey, ['list','read']) ? 1 : 0;
                            $isChecked    = $permMap[$actionKey][$colKey] ?? $defaultAllow;
                            ?>
                            <td>
                                <input type="checkbox"
                                       name="permissions[<?= $actionKey ?>][<?= $colKey ?>]"
                                       value="1"
                                    <?= $isChecked ? 'checked' : '' ?>>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->

        <!-- 전체선택 편의 버튼 -->
        <div class="text-right" style="margin-top:8px">
            <button type="button" class="btn btn-xs btn-default" id="btnPermAllCheck">전체 허용</button>
            <button type="button" class="btn btn-xs btn-default" id="btnPermAllUncheck">전체 거부</button>
        </div>

    </div><!-- /.panel-body -->
</div><!-- /.panel -->

<script>
    $(function () {
        // 전체 허용
        $('#btnPermAllCheck').on('click', function () {
            $('#permissionTable input[type=checkbox]').prop('checked', true);
        });
        // 전체 거부
        $('#btnPermAllUncheck').on('click', function () {
            $('#permissionTable input[type=checkbox]').prop('checked', false);
        });
    });
</script>