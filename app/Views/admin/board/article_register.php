<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form action="<?= site_url('admin/board/submit') ?>" method="post" id="frm">
    <?=csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($board['id'] ?? '') ?>">
    <div class="page-header js-affix affix-top">
        <h3>게시글 등록 </h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/board/board_list") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <div class="table-title gd-help-manual"> 게시글 등록 </div>
    <div>
        <table class="table table-cols">
            <colgroup>
                <col class="width10p">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th class="require">게시판</th>
                <td>
                    <span>
                        <select name="board_setting_id" >
                            <?php foreach ($boardLists as $board): ?>
                                <option value="<?=esc($board['board_id']) ?>" ><?=esc($board['name'])?>(<?=esc($board['board_id'])?>)</option>
                            <? endforeach; ?>
                        </select>
                    </span>
                </td>
            </tr>
            <tr>
                <th class="require">제목</th>
                <td>
                    <input type="text" name="title" id="title" class="form-control" value="<?=$board['title'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <th>파일첨부</th>
                <td class="form-inline">
                    <ul class="pdl0" id="uploadBox">
                        <li class="form-inline mgb5">
                            <input type="file" name="upfiles[]" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                            <a class="btn btn-white btn-icon-plus addUploadBtn btn-sm">추가</a>
                        </li>

                        <li class="form-inline mgb5">
                            <input type="file" name="upfiles[]" id="filestyle-1" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                            <a class="btn btn-white btn-icon-minus minusUploadBtn btn-sm">삭제</a>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>내용</th>
                <td class="form-inline">

                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
<?php echo $this->endSection() ?>
