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
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th>게시판</th>
        <td colspan="3">
            <?= esc($board['board_name'] ?? '') ?>
            (<?= esc($board['board_code'] ?? '') ?>)
        </td>
    </tr>
    <tr>
        <th>제목</th>
        <td>
            <?php if (!empty($board['header_id']) && !empty($headersMap[$board['header_id']])): ?>
                <?php $header = $headersMap[$board['header_id']]; ?>
                [ <?= esc($header['header_name']) ?> ]
            <?php endif; ?>
            <?= esc($board['title'] ?? '') ?>
        </td>
        <th>등록일시</th>
        <td><?= esc($board['created_at'] ?? '') ?></td>
    </tr>
    <tr>
        <th>작성자</th>
        <td><?= esc($board['writer'] ?? '') ?></td>
        <th>아이피</th>
        <td><?= esc($board['ip'] ?? '') ?></td>
    </tr>

    <!-- 담당자 (extra_fields: manager) -->
    <?php if ($hasManager): ?>
        <tr>
            <th>담당자</th>
            <td colspan="3"><?= esc($board['manager'] ?? '') ?></td>
        </tr>
    <?php endif; ?>

    <!-- 키워드 (extra_fields: keyword) -->
    <?php if ($hasKeyword && !empty($board['keywords'])): ?>
        <tr>
            <th>키워드</th>
            <td colspan="3">
                <?php foreach (explode(',', $board['keywords']) as $keyword): ?>
                    <?php $keyword = trim($keyword); ?>
                    <?php if ($keyword): ?>
                        <span style="display:inline-block; padding:2px 8px; border:1px solid #ddd;
                                 border-radius:10px; font-size:11px; color:#1A56C4;
                                 background:#EEF4FF; margin-right:4px;">
                        #<?= esc($keyword) ?>
                    </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
        </tr>
    <?php endif; ?>

    <!-- 이벤트 기간 (extra_fields: event_date) -->
    <?php if ($hasEventDate): ?>
        <tr>
            <th>이벤트 기간</th>
            <td colspan="3">
                <?php if (!empty($board['event_start']) && !empty($board['event_end'])): ?>
                    <?= esc(date('Y-m-d', strtotime($board['event_start']))) ?>
                    ~
                    <?= esc(date('Y-m-d', strtotime($board['event_end']))) ?>
                    <?php
                    $now = date('Y-m-d');
                    if ($now < $board['event_start']) {
                        echo '<span class="label label-default" style="margin-left:8px;">대기</span>';
                    } elseif ($now > $board['event_end']) {
                        echo '<span class="label label-danger" style="margin-left:8px;">종료</span>';
                    } else {
                        echo '<span class="label label-success" style="margin-left:8px;">진행중</span>';
                    }
                    ?>
                <?php else: ?>
                    <span class="text-muted">-</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endif; ?>

    <tr>
        <th>공지여부</th>
        <td><?= ($board['is_notice'] ?? 'N') === 'Y' ? '공지' : '미공지' ?></td>
        <th>노출여부</th>
        <td><?= ($board['is_use'] ?? 'N') === 'Y' ? '노출' : '미노출' ?></td>
    </tr>

    <!-- 메인 노출 (공통) -->
    <tr>
        <th>메인 노출</th>
        <td><?= ($board['is_main'] ?? 'N') === 'Y' ? '노출' : '미노출' ?></td>
        <th>조회수</th>
        <td><?= number_format($board['hit'] ?? 0) ?></td>
    </tr>

    <!-- 별점 (공통) -->
    <tr>
        <th>별점</th>
        <td colspan="3">
            <div class="view-starRating" data-score="<?= (int)($board['rating'] ?? 0) ?>"></div>
        </td>
    </tr>

    <!-- 첨부파일 -->
    <?php if (!empty($files)): ?>
        <tr>
            <th>첨부파일</th>
            <td colspan="3">
                <?php foreach ($files as $file): ?>
                    <div style="margin-bottom:4px;">
                        <?php if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file['file_name'])): ?>
                            <img src="<?= base_url($file['file_path']) ?>"
                                 style="max-width:120px; max-height:80px; object-fit:cover;
                                    border:1px solid #ddd; border-radius:4px; margin-right:6px;">
                        <?php endif; ?>
                        <a href="<?= base_url($file['file_path']) ?>" target="_blank">
                            <?= esc($file['file_name']) ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </td>
        </tr>
    <?php endif; ?>

    <tr>
        <th>내용</th>
        <td colspan="3">
            <?= esc($board['content'] ?? '', 'raw') ?>
        </td>
    </tr>
    </tbody>
</table>

<script>
    $(function() {
        $('.view-starRating').raty({
            readOnly: true,
            score: function() { return $(this).data('score'); },
            starType: 'i'
        });
    });
</script>