<table class="table table-rows">
    <thead>
    <tr>
        <th class="width-2xs">
            <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
        </th>
        <th class="width-2xs">번호</th>
        <th>제목</th>
        <th class="width-sm">작성자</th>
        <th class="width-sm">등록일</th>
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
            <tr class="center">
                <td>
                    <input type="checkbox" name="chk[]" value="<?= esc($board['id'] ?? '') ?>">
                </td>
                <td class="font-num"><?= $startNo-- ?></td>
                <td class="td-left">
                    <a href="<?= base_url('admin/board/article_view/'.esc($board_id).'/'.esc($board['id'])) ?>">
                        <?php if ($board['depth'] > 0): ?>
                            <span class="text-muted" style="margin-right:5px;">└ 답변</span>
                        <?php endif; ?>
                        <?php if ($board['is_secret'] === 'Y'): ?>
                            <i class="fa fa-lock" style="color:#999; margin-right:4px;"></i>
                        <?php endif; ?>
                        <?= esc($board['title'] ?? '') ?>
                    </a>
                </td>
                <td><?= esc($board['writer'] ?? '') ?></td>
                <td><?= esc(date('Y-m-d', strtotime($board['created_at']))) ?></td>
                <td><?= number_format($board['hit'] ?? 0) ?></td>
                <td>
                    <?php if ($board['depth'] > 0): ?>
                        <span class="label label-success">답변완료</span>
                    <?php elseif ($board['reply'] > 0): ?>
                        <span class="label label-success">답변완료</span>
                    <?php else: ?>
                        <span class="label label-danger">미답변</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($board['reply'] > 0 && !empty($board['reply_at'])): ?>
                        <?= esc(date('Y-m-d', strtotime($board['reply_at']))) ?>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-white btn-sm"
                            onclick="goList('<?= base_url('admin/board/article_register/'.esc($board_id).'/'.$board['id']) ?>')">
                        수정
                    </button>
                    <?php if ($board['parent_id'] == 0 && $board['reply'] == 0): ?>
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