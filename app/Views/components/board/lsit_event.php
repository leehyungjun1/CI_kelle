<table class="table table-rows">
    <thead>
    <tr>
        <th class="width-2xs">
            <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
        </th>
        <th class="width-2xs">번호</th>
        <th>제목</th>
        <th class="width-sm">작성자</th>
        <th class="width-sm">이벤트 기간</th>
        <th class="width-sm">등록일</th>
        <th class="width-2xs">조회</th>
        <th class="width-xs">상태</th>
        <th class="width-sm">수정</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($boards['boardData'])): ?>
        <?php
        $startNo = $boards['totalSearch'] - (($boards['page'] - 1) * $boards['perPage']);
        ?>
        <?php foreach ($boards['boardData'] as $board): ?>
            <tr class="center">
                <td>
                    <input type="checkbox" name="chk[]" value="<?= esc($board['id'] ?? '') ?>">
                </td>
                <td class="font-num"><?= $startNo-- ?></td>
                <td class="td-left">
                    <a href="<?= base_url('admin/board/article_view/'.esc($board_id).'/'.esc($board['id'])) ?>">
                        <?php if (!empty($board['header_id']) && !empty($headersMap[$board['header_id']])): ?>
                            <?php $header = $headersMap[$board['header_id']]; ?>
                            <span style="background:<?= esc($header['badge_color']) ?>;
                                color:<?= esc($header['text_color']) ?>;
                                padding:1px 6px; border-radius:3px;
                                font-size:11px; margin-right:5px;">
                                <?= esc($header['header_name']) ?>
                            </span>
                        <?php endif; ?>
                        <?= esc($board['title'] ?? '') ?>
                    </a>
                </td>
                <td><?= esc($board['writer'] ?? '') ?></td>
                <td>
                    <?php if (!empty($board['event_start']) && !empty($board['event_end'])): ?>
                        <?= esc(date('Y-m-d', strtotime($board['event_start']))) ?> ~
                        <?= esc(date('Y-m-d', strtotime($board['event_end']))) ?>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td><?= esc(date('Y-m-d', strtotime($board['created_at']))) ?></td>
                <td><?= number_format($board['hit'] ?? 0) ?></td>
                <td>
                    <?php
                    $status = $board['is_use'] ?? 'N';
                    $now = date('Y-m-d');
                    if (!empty($board['event_start']) && !empty($board['event_end'])) {
                        if ($now < $board['event_start']) {
                            echo '<span class="label label-default">대기</span>';
                        } elseif ($now > $board['event_end']) {
                            echo '<span class="label label-danger">종료</span>';
                        } else {
                            echo '<span class="label label-success">진행중</span>';
                        }
                    } else {
                        echo $status === 'Y'
                            ? '<span class="label label-success">노출</span>'
                            : '<span class="label label-default">미노출</span>';
                    }
                    ?>
                </td>
                <td>
                    <button type="button" class="btn btn-white btn-sm"
                            onclick="goList('<?= base_url('admin/board/article_register/'.esc($board_id).'/'.$board['id']) ?>')">
                        수정
                    </button>
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