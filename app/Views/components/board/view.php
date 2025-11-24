<table class="table table-cols">
    <colgroup>
        <col class="width-md">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th>게시판</th>
        <td colspan="3"><?=esc($board['board_name'] ?? '') ?> ( <?=esc($board['board_code'] ?? '') ?> )</td>
    </tr>
    <tr>
        <th>제목</th>
        <td><?=esc($board['title'] ?? '') ?></td>
        <th>등록시간</th>
        <td><?=esc($board['created_at'] ?? '') ?></td>
    </tr>
    <tr>
        <th>작성자</th>
        <td class="width50p">
            <?=esc($board['writer'] ?? '') ?>
        </td>
        <th class="width-md">아이피</th>
        <td><?=esc($board['ip'] ?? '') ?></td>
    </tr>
    <tr>
        <th>메인진열여부</th>
        <td class="width50p">
            <?=($board['is_use'] == 'Y')? "진열" : "미진열" ?>
        </td>
        <th class="width-md">공지여부</th>
        <td><?=($board['is_notice'] == 'Y')? "공지" : "미공지" ?></td>
    </tr>
    <tr>
        <th>별점</th>
        <td class="width50p">
            <div class="view-starRating" data-score="<?= (int)($board['rating'] ?? 0) ?>"></div>
        </td>
        <th class="width-md">조회수</th>
        <td><?= (int)($board['hit'] ?? 0) ?></td>
    </tr>
    <tr>
        <th>내용</th>
        <td colspan="3" style="margin:0px">
            <?php foreach ($files as $file): ?>
                <div>
                    <a href="<?= base_url($file['file_path']) ?>" target="_blank">
                        <?= esc($file['file_name']) ?>
                    </a>
                    <input type="checkbox" name="delete_files[]" value="<?= $file['id'] ?>"> 삭제
                </div>
            <?php endforeach; ?>

            <?= esc($board['content'] ?? '', 'raw') ?></td>
    </tr>
    </tbody>
</table>
<script>
    $(function () {
        $('.view-starRating').raty({
            readOnly: true,
            score: function() {
                return $(this).data('score');
            },
            starType: 'i'
        });
    });
</script>