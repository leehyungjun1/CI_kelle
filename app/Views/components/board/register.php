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
                <label class="radio-inline"><input type="radio" name="is_use" value="Y" <?= ($article['is_use'] ?? 'Y') === 'Y' ? 'checked' : '' ?>>노출</label>
                <label class="radio-inline"><input type="radio" name="is_use" value="N" <?= ($article['is_use'] ?? '') === 'N' ? 'checked' : '' ?>>미노출</label>
            </td>
        <?php endif; ?>
    </tr>
    <tr>
        <th class="require">제목</th>
        <td <?php if (empty($headers)): ?> colspan="3" <? endif; ?>>
            <input type="text" name="title" id="title" class="form-control width-3xl"
                   value="<?= esc($article['title'] ?? '') ?>">
        </td>
        <?php if (!empty($headers)): ?>
        <th>말머리</th>
        <td>
            <select name="header_id" class="form-control" style="width:auto;">
                <option value="">선택안함</option>
                <?php foreach ($headers as $header): ?>
                    <option value="<?= esc($header['id']) ?>"
                            data-bg="<?= esc($header['badge_color']) ?>"
                            data-color="<?= esc($header['text_color']) ?>"
                        <?= (string)($article['header_id'] ?? '') === (string)$header['id'] ? 'selected' : '' ?>>
                        <?= esc($header['header_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <span id="headerPreview" class="mgl5"></span>
        </td>
        <?php endif; ?>
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
        <th>메인 노출</th>
        <td>
            <label class="radio-inline">
                <input type="radio" name="is_main" value="Y"
                    <?= ($article['is_main'] ?? 'Y') === 'Y' ? 'checked' : '' ?>>노출
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_main" value="N"
                    <?= ($article['is_main'] ?? '') === 'N' ? 'checked' : '' ?>>미노출
            </label>
        </td>
    </tr>
    <tr>
        <th>키워드</th>
        <td>
            <input type="text" name="keywords" class="form-control width-3xl"
                   value="<?= esc($article['keywords'] ?? '') ?>"
                   placeholder="쉼표(,)로 구분 예) 학점은행제, 사회복지사">
        </td>
        <th>상태</th>
        <td>
            <?php
            $currentStatus = array_filter(
                explode(',', $article['status'] ?? '')
            );
            ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="status[]" value="popular"
                    <?= in_array('popular', $currentStatus) ? 'checked' : '' ?>>
                인기
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="status[]" value="recommend"
                    <?= in_array('recommend', $currentStatus) ? 'checked' : '' ?>>
                추천
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="status[]" value="new"
                    <?= in_array('new', $currentStatus) ? 'checked' : '' ?>>
                신규
            </label>
        </td>
    </tr>
    <tr>
        <th>이름</th>
        <td>
            <input type="text" name="writer" id="writer" class="form-control width-sm"
                   value="<?= esc($article['writer'] ?? '') ?>">
        </td>
        <th>별점</th>
        <td>
            <div id="articleData" data-rating="<?= (int)($article['rating'] ?? 0) ?>" style="display:none;"></div>
            <div class="starRating"></div>
            <input type="hidden" name="rating" id="rating" value="<?= (int)($article['rating'] ?? 0) ?>">
        </td>
    </tr>
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
                        <label class="checkbox-inline" style="margin-left:5px;">
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
                    <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">
                선택된 파일 없음
            </span>
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