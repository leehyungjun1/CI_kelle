<?php
// extra_fields 파싱
$extraFields  = json_decode($boardSetting['extra_fields'] ?? '{}', true) ?? [];
$hasManager   = !empty($extraFields['manager']);
$hasRating    = !empty($extraFields['rating']);
$hasKeyword   = !empty($extraFields['keyword']);
$hasEventDate = !empty($extraFields['event_date']);
$hasIsMain    = !empty($extraFields['is_main']);
?>
<table class="table table-cols">
    <colgroup>
        <col class="width-sm">
        <col>
        <col class="width-sm">
        <col class="width-3xl">
    </colgroup>
    <tbody>
    <tr>
        <th class="require">게시판</th>
        <td <?= ($mode != 'article') ? 'colspan="3"' : '' ?>>
            <?php if (!empty($article['id']) && !empty($article['board_id'])): ?>
                <strong><?= esc($article['board_code']) ?></strong>
                <input type="hidden" name="board_id" value="<?= esc($article['board_id']) ?>">
            <?php else: ?>
                <?php if ($mode === 'article'): ?>
                    <select name="board_id" id="board_id" class="form-control">
                        <?php foreach ($boardLists as $board): ?>
                            <option value="<?= esc($board['board_id']) ?>"
                                <?= $board_id == $board['board_id'] ? 'selected' : '' ?>>
                                <?= esc($board['name']) ?>(<?= esc($board['board_id']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php elseif ($mode === 'replies'): ?>
                    <?= esc($board['board_name'] ?? '') ?> ( <?= esc($board['board_code'] ?? '') ?> )
                    <input type="hidden" name="replies_id" value="<?= esc($article['id']) ?>">
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <?php if ($mode === 'article'): ?>
            <th>노출 여부</th>
            <td>
                <label class="radio-inline"><input type="radio" name="use_yn" value="Y" <?= ($article['is_use'] ?? 'Y') === 'Y' ? 'checked' : '' ?>>노출</label>
                <label class="radio-inline"><input type="radio" name="use_yn" value="N" <?= ($article['is_use'] ?? '') === 'N' ? 'checked' : '' ?>>미노출</label>
            </td>
        <?php endif; ?>
    </tr>

    <!-- 말머리 -->
    <?php if (!empty($headers)): ?>
        <tr>
            <th>말머리</th>
            <td colspan="3">
                <select name="header_id" class="form-control">
                    <option value="">말머리 선택</option>
                    <?php foreach ($headers as $header): ?>
                        <option value="<?= esc($header['id']) ?>"
                            <?= ($article['header_id'] ?? '') == $header['id'] ? 'selected' : '' ?>
                                style="background:<?= esc($header['badge_color']) ?>; color:<?= esc($header['text_color']) ?>">
                            <?= esc($header['header_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    <?php endif; ?>

    <tr>
        <th class="require">제목</th>
        <td colspan="3">
            <input type="text" name="title" id="title" class="form-control width-5xl"
                   value="<?= esc($article['title'] ?? '') ?>">
        </td>
    </tr>

    <tr>
        <th>작성자</th>
        <td>
            <label class="radio-inline">
                <input type="radio" name="writer_type" value="admin"
                    <?= ($article['writer_type'] ?? 'admin') === 'admin' ? 'checked' : '' ?>>관리자
            </label>
            <label class="radio-inline">
                <input type="radio" name="writer_type" value="guest"
                    <?= ($article['writer_type'] ?? '') === 'guest' ? 'checked' : '' ?>>비회원
            </label>
        </td>
        <?php if ($hasIsMain): ?>
            <th>메인 노출</th>
            <td>
                <label class="radio-inline"><input type="radio" name="is_main" value="Y" <?= ($article['is_main'] ?? 'Y') === 'Y' ? 'checked' : '' ?>>노출</label>
                <label class="radio-inline"><input type="radio" name="is_main" value="N" <?= ($article['is_main'] ?? '') === 'N' ? 'checked' : '' ?>>미노출</label>
            </td>
        <?php else: ?>
            <td colspan="2"></td>
        <?php endif; ?>
    </tr>

    <tr>
        <th>이름</th>
        <td>
            <input type="text" name="writer" id="writer" class="form-control width-sm"
                   value="<?= esc($article['writer'] ?? '') ?>">
        </td>
        <?php if ($hasRating): ?>
            <th>별점</th>
            <td>
                <div class="starRating"></div>
                <input type="hidden" name="rating" id="rating" value="<?= (int)($article['rating'] ?? 0) ?>">
            </td>
        <?php else: ?>
            <td colspan="2"></td>
        <?php endif; ?>
    </tr>

    <?php if ($hasManager): ?>
        <tr>
            <th>담당자</th>
            <td colspan="3">
                <input type="text" name="manager" class="form-control width-sm"
                       value="<?= esc($article['manager'] ?? '') ?>"
                       placeholder="담당자명">
            </td>
        </tr>
    <?php endif; ?>

    <?php if ($hasKeyword): ?>
        <tr>
            <th>키워드 태그</th>
            <td colspan="3">
                <input type="text" name="keywords" class="form-control width-3xl"
                       value="<?= esc($article['keywords'] ?? '') ?>"
                       placeholder="쉼표로 구분 (예: 사회복지사,학점은행제)">
                <div class="notice-info mgt5">쉼표(,)로 구분하여 입력하세요.</div>
            </td>
        </tr>
    <?php endif; ?>

    <?php if ($hasEventDate): ?>
        <tr>
            <th>이벤트 기간</th>
            <td colspan="3">
                <?= dateRangePicker([
                    'name'  => 'event_date[]',
                    'start' => $article['event_start'] ?? date('Y-m-d'),
                    'end'   => $article['event_end']   ?? date('Y-m-d', strtotime('+7 days')),
                ]) ?>
            </td>
        </tr>
    <?php endif; ?>

    <tr>
        <th>파일첨부</th>
        <td colspan="3">
            <ul id="uploadBox" class="upload-box">
                <?php foreach ($files as $index => $file): ?>
                    <li class="upload-item form-inline mgb5">
                        <input type="hidden" name="file_ids[]" value="<?= esc($file['id']) ?>">
                        <label class="btn btn-gray btn-sm upload-label">
                            찾아보기
                            <input type="file" name="upfiles[<?= esc($file['id']) ?>]" style="display:none;">
                        </label>
                        <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">
                            <?= esc($file['file_name']) ?>
                        </span>
                        <label class="checkbox-inline btn btn-white btn-icon-minus btn-sm" style="margin-left:5px;">
                            <input type="checkbox" name="delFile[<?= $index ?>]" value="<?= esc($file['id']) ?>">
                            삭제
                        </label>
                    </li>
                <?php endforeach; ?>
                <li class="upload-item form-inline mgb5">
                    <label class="btn btn-gray btn-sm upload-label">
                        찾아보기
                        <input type="file" name="upfiles[]" style="display:none;">
                    </label>
                    <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">선택된 파일 없음</span>
                    <a class="btn btn-white btn-icon-plus addUploadBtn btn-sm" style="margin-left:5px;">추가</a>
                </li>
            </ul>
            <input type="hidden" id="fileCnt" value="1">
        </td>
    </tr>

    <tr>
        <th>내용</th>
        <td colspan="3">
            <div class="mgb5">
                <?php if ($mode === 'article'): ?>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="is_notice" id="is_notice" value="Y"
                            <?= ($article['is_notice'] ?? '') === 'Y' ? 'checked' : '' ?>>
                        공지사항
                    </label>
                <?php endif; ?>
                <label class="checkbox-inline">
                    <input type="checkbox" name="secret" id="secret" value="Y"
                        <?= ($article['secret'] ?? '') === 'Y' ? 'checked' : '' ?>>
                    비밀글
                </label>
            </div>
            <div class="mgt5">
                <textarea name="content" id="editor" rows="10"
                          style="width:100%; height:300px;"><?= esc($article['content'] ?? '', 'raw') ?></textarea>
            </div>
        </td>
    </tr>
    </tbody>
</table>