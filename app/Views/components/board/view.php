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
        <td colspan="3"><?=esc($board['ip'] ?? '') ?></td>
    </tr>
    <tr>
        <th>내용</th>
        <td colspan="3" style="margin:0px"><?= esc($board['content'] ?? '', 'raw') ?></td>
    </tr>
    </tbody>
</table>