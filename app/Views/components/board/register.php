<table class="table table-cols">
    <colgroup>
        <col class="width10p">
        <col>
        <col class="width-sm">
        <col class="width-3xl">
    </colgroup>
    <tbody>
    <tr>
        <th class="require">게시판</th>
        <td <? if($mode != 'article') : ?> colspan="3" <? endif; ?>>
            <?php if (esc($article['id']) && esc($article['board_id'])): ?>
                <strong><?= $article['board_id'] ?></strong>
                <input type="hidden" name="board_id" value="<?=esc($article['board_id']) ?>">
            <?php else : ?>
                <? if($mode === 'article') : ?>
                <span>
                        <select name="board_id" id="board_id">
                            <?php foreach ($boardLists as $board): ?>
                                <option value="<?=esc($board['board_id']) ?>" <?php if($board_id == $board['board_id']) : ?>selected <?php endif;?>><?=esc($board['name'])?>(<?=esc($board['board_id'])?>)</option>
                            <? endforeach; ?>
                        </select>
                    </span>
                <? elseif($mode === 'replies') : ?>
                    <?=esc($board['board_name'] ?? '') ?> ( <?=esc($board['board_code'] ?? '') ?> )
                    <input type="hidden" name="replies_id" value="<?=esc($article['id']) ?>" >
                <? endif; ?>
            <?php endif; ?>
        </td>
        <? if($mode === 'article') : ?>
        <th>노출 여부</th>
        <td>
            <label class="radio-inline"><input type="radio" name="use_yn" value="Y" checked>노출</label>
            <label class="radio-inline"><input type="radio" name="use_yn" value="N">미노출</label>
        </td>
        <? endif; ?>
    </tr>
    <tr>
        <th class="require">제목</th>
        <td colspan="3">
            <input type="text" name="title" id="title" class="form-control" value="<?=$article['title'] ?? '' ?>">
        </td>
    </tr>
    <tr>
        <th>파일첨부</th>
        <td class="form-inline" colspan="3">
            <ul class="pdl0" id="uploadBox">
                <li class="form-inline mgb5">
                    <input type="file" name="upfiles[]" id="filestyle-0">
                    <a class="btn btn-white btn-icon-plus addUploadBtn btn-sm">추가</a>
                </li>
            </ul>
            <input type="hidden" id="fileCnt" value="1" />
        </td>
    </tr>
    <tr>
        <th>내용</th>
        <td class="form-inline" colspan="3">
            <div>
                <? if($mode === 'article') : ?>
                    <input type="checkbox" name="is_notice" id="is_notice" value="Y" <?= ($article['is_notice'] ?? '') === 'Y' ? 'checked' : '' ?>>
                    <label for="is_notice" class="mgr20">공지사항</label>
                <? endif ;?>
                <input type="checkbox" name="secret" id="secret" value="Y" <?= ($article['secret'] ?? '') === 'Y' ? 'checked' : '' ?>>
                <label for="secret">비밀글</label>
            </div>
            <div class="mgt5">
                <textarea name="content" id="editor" rows="10" cols="100" style="width:100%; height:300px;">
                    <?= esc($article['content'] ?? '') ?>
                </textarea>
            </div>
        </td>
    </tr>
    </tbody>
</table>