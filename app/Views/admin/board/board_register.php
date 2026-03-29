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
                    <td colspan="3">
                        <input type="text" name="name" value="<?= esc($board['name'] ?? '') ?>"
                               class="form-control width-sm" maxlength="20">
                    </td>
                </tr>
                <tr>
                    <th class="require">유형</th>
                    <td colspan="3">
                        <div style="display:flex; gap:20px;">
                            <?php foreach ([
                                               'D' => ['label' => '일반형',    'img' => 'type_default'],
                                               'G' => ['label' => '갤러리형',  'img' => 'type_gallery'],
                                               'E' => ['label' => '이벤트형',  'img' => 'type_event'],
                                               'Q' => ['label' => '1:1 문의형','img' => 'type_qa'],
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
                <tr>
                    <th>추가 필드</th>
                    <td colspan="3">
                        <?php
                        $extraFields = json_decode($board['extra_fields'] ?? '{}', true) ?? [];
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
                <th>말머리 기능</th>
                <td colspan="3">
                    <!-- 미체크 시 N 전송 -->
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
                                            <label class="checkbox-inline">
                                                <select name="header_is_use[]" class="form-control">
                                                    <option value="Y" <?= ($header['is_use'] ?? 'Y') === 'Y' ? 'selected' : '' ?>>사용</option>
                                                    <option value="N" <?= ($header['is_use'] ?? '') === 'N' ? 'selected' : '' ?>>미사용</option>
                                                </select>
                                            </label>
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
                                        <input type="color" name="badge_color[]"
                                               value="#ff0000"
                                               style="width:50px; padding:0; border:none; cursor:pointer;">
                                    </td>
                                    <td>
                                        <input type="color" name="text_color[]"
                                               value="#ffffff"
                                               style="width:50px; padding:0; border:none; cursor:pointer;">
                                    </td>
                                    <td>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="is_use[]" value="Y" checked>
                                            사용
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
    </form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            // ── 말머리 초기 상태 ──
            if ($('#is_category').is(':checked')) {
                $('#categoryBox').show();
                $('#categoryBox input, #categoryBox select').prop('disabled', false);
            } else {
                $('#categoryBox').hide();
                $('#categoryBox input, #categoryBox select').prop('disabled', true);
            }

            // ── 말머리 토글 ──
            $(document).on('change', '#is_category', function() {
                if ($(this).is(':checked')) {
                    $('#categoryBox').slideDown();
                    $('#categoryBox input, #categoryBox select').prop('disabled', false);
                } else {
                    $('#categoryBox').slideUp();
                    $('#categoryBox input, #categoryBox select').prop('disabled', true);
                }
            });

            // ── 말머리 추가 ──
            $(document).on('click', '.btn-add-category', function() {
                $('#categoryTbody').append(`
            <tr>
                <td>
                    <input type="text" name="header_name[]" class="form-control" placeholder="말머리명" value="">
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
                    <button type="button" class="btn btn-sm btn-white btn-icon-minus btn-del-category">삭제</button>
                </td>
            </tr>
        `);
            });

            // ── 말머리 삭제 ──
            $(document).on('click', '.btn-del-category', function() {
                $(this).closest('tr').remove();
            });

            // ── 색상 미리보기 ──
            $(document).on('input', 'input[name="badge_color[]"], input[name="text_color[]"]', function() {
                const $row      = $(this).closest('tr');
                const bgColor   = $row.find('input[name="badge_color[]"]').val();
                const textColor = $row.find('input[name="text_color[]"]').val();
                const name      = $row.find('input[name="header_name[]"]').val() || '미리보기';

                let $preview = $row.find('.badge-preview');
                if (!$preview.length) {
                    $row.find('td:first').append('<span class="badge-preview"></span>');
                    $preview = $row.find('.badge-preview');
                }
                $preview.css({
                    background: bgColor,
                    color: textColor,
                    padding: '2px 8px',
                    borderRadius: '3px',
                    fontSize: '11px',
                    marginLeft: '5px',
                    display: 'inline-block',
                }).text(name);
            });

        });
    </script>
<?= $this->endSection() ?>