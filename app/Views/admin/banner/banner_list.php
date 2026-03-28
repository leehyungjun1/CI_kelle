<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>배너 관리<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="page-header">
        <h3>배너 관리</h3>
        <div class="btn-group">
            <input type="button" value="+ 배너 등록" class="btn btn-white"
                   onclick="goList('<?= base_url('admin/banner/banner_register') ?>')">
        </div>
    </div>

    <form id="frmList">
        <div class="table-header form-inline">
            <div class="pull-left">
                전체 <strong><?= number_format(count($groups ?? [])) ?></strong>개의 배너 그룹
            </div>
        </div>

        <table class="table table-rows">
            <thead>
            <tr>
                <th class="width-2xs">
                    <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
                </th>
                <th class="width-2xs">그룹 ID</th>
                <th>대표 타이틀</th>
                <th class="width-xs">슬라이드 수</th>
                <th class="width-xs">사용 중</th>
                <th class="width-sm">등록일</th>
                <th class="width-sm">관리</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($groups)): ?>
                <?php foreach ($groups as $group): ?>
                    <tr class="center">
                        <td>
                            <input type="checkbox" name="chk[]" value="<?= esc($group['group_id']) ?>">
                        </td>
                        <td class="font-num"><?= esc($group['group_id']) ?></td>
                        <td class="td-left">
                            <a href="<?= base_url('admin/banner/banner_register/'.esc($group['group_id'])) ?>">
                                <?= esc($group['first_title'] ?? '-') ?>
                            </a>
                        </td>
                        <td><?= esc($group['slide_count']) ?>개</td>
                        <td><?= esc($group['use_count']) ?>개</td>
                        <td><?= esc(date('Y-m-d', strtotime($group['created_at']))) ?></td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm"
                                    onclick="goList('<?= base_url('admin/banner/banner_register/'.esc($group['group_id'])) ?>')">
                                수정
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td class="center" colspan="7">등록된 배너가 없습니다.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="table-action clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-white" id="btnDelete">선택 삭제</button>
            </div>
        </div>
    </form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {
            $('#btnDelete').on('click', function() {
                handleAdminAction(
                    '<?= base_url('admin/banner/banner_delete') ?>',
                    '선택된 배너 그룹을 삭제하시겠습니까?'
                );
            });
        });
    </script>
<?= $this->endSection() ?>