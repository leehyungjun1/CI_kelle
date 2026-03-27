<table class="table table-rows">
    <thead>
    <tr>
        <th class="width-2xs">
            <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
        </th>
        <th class="width-2xs">번호</th>
        <th>제목</th>
        <th class="width-sm">작성자</th>
        <th class="width-sm">작성일</th>
        <th class="width-2xs">조회</th>
        <th class="width-sm">답변상태</th>
        <th class="width-sm">답변일</th>
        <th class="width-sm">수정/답변</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($boards['boardData'])): ?>
        <?php
        $startNo = $boards['totalSearch'] - (($boards['page'] - 1) * $boards['perPage']);
        ?>
        <?php foreach ($boards['boardData'] as $board): ?>
            <tr class="center" data-member-no="<?= esc($board['id'] ?? '') ?>">
                <td>
                    <input type="checkbox" name="chk[]" value="<?= esc($board['id'] ?? '') ?>">
                </td>
                <td class="font-num">
                    <span class="number js-layer-crm hand"><?= $startNo-- ?></span>
                </td>
                <td class="td-left">
                    <span class="font-eng js-layer-crm hand">
                        <a href="<?= base_url('admin/board/article_view/'.esc($board_id).'/'.esc($board['id'])) ?>">
                            <?php if (!empty($board['header_id']) && !empty($headersMap[$board['header_id']])): ?>
                                <?php $header = $headersMap[$board['header_id']]; ?>
                                <span style="background:<?= esc($header['badge_color']) ?>;
                                    color:<?= esc($header['text_color']) ?>;
                                    padding:1px 6px;
                                    border-radius:3px;
                                    font-size:11px;
                                    margin-right:5px;">
                                    <?= esc($header['header_name']) ?>
                                </span>
                            <?php endif; ?>
                            <?= replyIndent($board['depth']) ?>
                            <?= esc($board['title'] ?? '') ?>
                        </a>
                    </span>
                </td>
                <td><span class="js-layer-crm hand"><?= esc($board['writer'] ?? '') ?></span></td>
                <td><span class="js-layer-crm hand"><?= esc(date('Y-m-d', strtotime($board['created_at']))) ?></span></td>
                <td><span class="js-layer-crm hand"><?= esc(number_format($board['hit'] ?? 0)) ?></span></td>
                <td><span class="js-layer-crm hand"><?= esc(number_format($board['reply'] ?? 0)) ?></span></td>
                <td><span class="js-layer-crm hand"><?= esc($board['type_name'] ?? '') ?></span></td>
                <td>
                    <button type="button" class="btn btn-white btn-sm"
                            onclick="goList('<?= base_url('admin/board/article_register/'.esc($board_id).'/'.$board['id']) ?>')">
                        수정
                    </button>
                    <?php if ($board['parent_id'] == 0): ?>
                        <button type="button" class="btn btn-white btn-sm"
                                onclick="goList('<?= base_url('admin/board/replies_register/'.esc($board_id).'/'.$board['id']) ?>')">
                            답변
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td class="center" colspan="9">검색된 정보가 없습니다.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>