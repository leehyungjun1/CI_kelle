<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?><?= esc($pageTitle ?? '게시판 등록') ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form action="<?= site_url('admin/board/submit') ?>" method="post" id="frm">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($board['id'] ?? '') ?>">

        <div class="page-header">
            <h3><?= esc($pageTitle ?? '게시판 등록') ?></h3>
            <div class="btn-group">
                <input type="button" value="목록" class="btn btn-white btn-icon-list"
                       onclick="goList('<?= base_url('admin/board/board_list') ?>')">
                <input type="button" value="저장" class="btn btn-red btn-register">
            </div>
        </div>

        <div class="table-title">기본설정</div>
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
                        <?php if (!empty($board['board_id'])): ?>
                            <strong><?= esc($board['board_id']) ?></strong>
                        <?php else: ?>
                            <input type="text" name="board_id" id="board_id"
                                   value="" class="form-control">
                            <button type="button" id="overlap_boardId" class="btn btn-gray btn-sm">중복확인</button>
                        <?php endif; ?>
                    </td>
                    <th>사용여부</th>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="use_yn" value="Y"
                                <?= ($board['use_yn'] ?? 'Y') === 'Y' ? 'checked' : '' ?>>사용
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="use_yn" value="N"
                                <?= ($board['use_yn'] ?? '') === 'N' ? 'checked' : '' ?>>미사용
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="require">게시판명</th>
                    <td>
                        <input type="text" name="name" value="<?= esc($board['name'] ?? '') ?>"
                               class="form-control width-sm" maxlength="20">
                    </td>
                    <th>리스트 목록수</th>
                    <td>
                        <div class="form-group">
                            <select name="list_count" class="form-control input-sm" style="width:100px">
                                <?php foreach ([10, 20, 30, 50, 100] as $n): ?>
                                    <option value="<?= $n ?>" <?= (int)($board['list_count'] ?? 20) == $n ? 'selected' : '' ?>>
                                        <?= $n ?>개
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="require">유형</th>
                    <td colspan="3">
                        <div style="display:flex; gap:20px;">
                            <?php foreach ([
                                               'D' => ['label' => '일반형',     'img' => 'type_default'],
                                               'G' => ['label' => '갤러리형',   'img' => 'type_gallery'],
                                               'E' => ['label' => '이벤트형',   'img' => 'type_event'],
                                               'Q' => ['label' => '1:1 문의형', 'img' => 'type_qa'],
                                           ] as $value => $info): ?>
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="<?= $value ?>"
                                        <?= ($board['type'] ?? 'D') === $value ? 'checked' : '' ?>>
                                    <?= $info['label'] ?>
                                    <div class="mgt10">
                                        <img src="/img/board/<?= $info['img'] ?>.png">
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="notice-info mgt10">
                            1:1 문의형 게시판은 댓글 기능이 제공되지 않습니다.
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>추가 필드</th>
                    <td colspan="3">
                        <?php
                        $extraFields  = json_decode($board['extra_fields'] ?? '{}', true) ?? [];
                        $fieldOptions = [
                            'manager'    => '담당자',
                            'rating'     => '별점',
                            'keyword'    => '키워드 태그',
                            'event_date' => '이벤트 기간',
                            'is_main'    => '메인 노출',
                        ];
                        ?>
                        <?php foreach ($fieldOptions as $key => $label): ?>
                            <label class="checkbox-inline" style="margin-right:16px;">
                                <input type="checkbox"
                                       name="extra_fields[<?= $key ?>]"
                                       value="1"
                                    <?= !empty($extraFields[$key]) ? 'checked' : '' ?>>
                                <?= $label ?>
                            </label>
                        <?php endforeach; ?>
                        <div class="notice-info mgt5">
                            체크한 항목이 게시글 등록/수정 폼에 표시됩니다.
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>말머리 기능</th>
                    <td colspan="3">
                        <input type="hidden" name="is_category" value="N">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="is_category" value="Y" id="is_category"
                                <?= ($board['is_category'] ?? 'N') === 'Y' ? 'checked' : '' ?>>
                            말머리 사용
                        </label>

                        <div id="categoryBox" style="display:none; padding-top:10px;">
                            <table class="table table-cols">
                                <colgroup>
                                    <col class="width-sm">
                                    <col>
                                    <col class="width-sm">
                                    <col class="width-sm">
                                    <col class="width-sm">
                                </colgroup>
                                <tbody id="categoryTbody">
                                <tr>
                                    <th>말머리명</th>
                                    <th>배경색</th>
                                    <th>글자색</th>
                                    <th>사용여부</th>
                                    <th>관리</th>
                                </tr>
                                <?php if (!empty($headers)): ?>
                                    <?php foreach ($headers as $header): ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="category_id[]" value="<?= esc($header['id']) ?>">
                                                <input type="text" name="header_name[]" class="form-control"
                                                       value="<?= esc($header['header_name']) ?>" placeholder="말머리명">
                                            </td>
                                            <td>
                                                <input type="color" name="badge_color[]"
                                                       value="<?= esc($header['badge_color'] ?? '#ff0000') ?>"
                                                       style="width:50px; padding:0; border:none; cursor:pointer;">
                                            </td>
                                            <td>
                                                <input type="color" name="text_color[]"
                                                       value="<?= esc($header['text_color'] ?? '#ffffff') ?>"
                                                       style="width:50px; padding:0; border:none; cursor:pointer;">
                                            </td>
                                            <td>
                                                <select name="header_is_use[]" class="form-control">
                                                    <option value="Y" <?= ($header['is_use'] ?? 'Y') === 'Y' ? 'selected' : '' ?>>사용</option>
                                                    <option value="N" <?= ($header['is_use'] ?? '') === 'N' ? 'selected' : '' ?>>미사용</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-white btn-icon-minus btn-del-category">삭제</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="header_name[]" class="form-control"
                                                   placeholder="말머리명" value="">
                                        </td>
                                        <td>
                                            <input type="color" name="badge_color[]" value="#ff0000"
                                                   style="width:50px; padding:0; border:none; cursor:pointer;">
                                        </td>
                                        <td>
                                            <input type="color" name="text_color[]" value="#ffffff"
                                                   style="width:50px; padding:0; border:none; cursor:pointer;">
                                        </td>
                                        <td>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="is_use[]" value="Y" checked> 사용
                                            </label>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-white btn-icon-plus btn-add-category">추가</button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- ====================================================
             권한 설정
        ===================================================== -->
        <?php
        use App\Models\JyBoardPermissionsModel;

        $actions   = JyBoardPermissionsModel::ACTIONS;
        $modes     = JyBoardPermissionsModel::MODES;
        $boardType = $board['type'] ?? 'D';

        // Q타입 아니면 reply 제외
        if ($boardType !== 'Q') unset($actions['reply']);
        // Q타입이면 comment 제외
        if ($boardType === 'Q') unset($actions['comment']);
        ?>

        <div class="table-title" style="margin-top:30px">권한 설정</div>
        <div>
            <table class="table table-cols" id="permissionTable">
                <colgroup>
                    <col class="width-sm">
                    <col>
                </colgroup>
                <tbody>
                <?php foreach ($actions as $actionKey => $actionLabel): ?>
                    <?php
                    $perm        = $permMap[$actionKey] ?? ['mode' => 'all', 'grades' => []];
                    $currentMode = $perm['mode'];
                    $currentGrades = $perm['grades']; // 배열
                    ?>
                    <tr <?= $actionKey === 'reply' ? 'class="perm-reply-row"' : '' ?>
                        <?= $actionKey === 'comment' ? 'class="perm-comment-row"' : '' ?>>
                        <th><?= $actionLabel ?></th>
                        <td>
                            <div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">

                                <?php foreach ($modes as $modeKey => $modeLabel): ?>
                                    <label class="radio-inline" style="margin-right:4px; white-space:nowrap; flex-shrink:0;">
                                        <input type="radio"
                                               name="permissions[<?= $actionKey ?>][mode]"
                                               value="<?= $modeKey ?>"
                                               class="perm-mode-radio"
                                               data-action="<?= $actionKey ?>"
                                            <?= $currentMode === $modeKey ? 'checked' : '' ?>>
                                        <?= $modeLabel ?>
                                    </label>
                                <?php endforeach; ?>

                                <!-- 특정 회원등급 선택 영역 -->
                                <div class="perm-grade-box"
                                     id="gradeBox_<?= $actionKey ?>"
                                     style="display:<?= $currentMode === 'grade' ? 'flex' : 'none' ?>;
                                             align-items:center; gap:6px; margin-left:6px; flex:1; min-width:0;">
                                    <!-- 전체 버튼 -->
                                    <button type="button"
                                            class="btn btn-xs btn-default perm-grade-all"
                                            data-action="<?= $actionKey ?>">전체</button>
                                    <!-- 등급 선택 드롭다운 -->
                                    <select class="form-control input-sm perm-grade-select"
                                            id="gradeSelect_<?= $actionKey ?>"
                                            style="width:150px"
                                            data-action="<?= $actionKey ?>">
                                        <option value="">회원등급 선택</option>
                                        <?php foreach ($memberGrades as $g): ?>
                                            <option value="<?= esc($g['code']) ?>">
                                                <?= esc($g['code_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- 선택된 등급 태그 목록 -->
                                    <div class="perm-grade-tags" id="gradeTags_<?= $actionKey ?>"
                                         style="display:flex; gap:4px; flex-wrap:wrap; align-items:center; flex:1;">
                                        <?php foreach ($currentGrades as $gradeCode):
                                            // 등급명 찾기
                                            $gradeName = '';
                                            foreach ($memberGrades as $g) {
                                                if ($g['code'] === $gradeCode) {
                                                    $gradeName = $g['code_name'];
                                                    break;
                                                }
                                            }
                                            if (!$gradeName) continue;
                                            ?>
                                            <span class="label label-default perm-grade-tag"
                                                  data-code="<?= esc($gradeCode) ?>"
                                                  style="font-size:12px; padding:4px 8px; cursor:pointer;">
                                        <?= esc($gradeName) ?>
                                        <i class="fa fa-times" style="margin-left:4px;"></i>
                                        <input type="hidden"
                                               name="permissions[<?= $actionKey ?>][grades][]"
                                               value="<?= esc($gradeCode) ?>">
                                    </span>
                                        <?php endforeach; ?>
                                    </div>



                                </div><!-- /.perm-grade-box -->

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </form>

<?= $this->endSection() ?>