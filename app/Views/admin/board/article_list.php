<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

    <div class="page-header">
        <h3>게시글 관리</h3>
        <div class="btn-group">
            <input type="button" value="+ 등록" class="btn btn-white"
                   onclick="goList('<?= base_url('admin/board/article_register/'.$board_id) ?>')">
        </div>
    </div>

    <form id="frmSearchBase" method="get" class="content-form js-search-form js-form-enter-submit">
        <input type="hidden" name="sort" value="" id="searchsort">
        <input type="hidden" name="searchFl" value="y">
        <input type="hidden" name="pageNum" value="<?= esc($filters['pageNum'] ?? 10) ?>">
        <div class="table-title">게시글 관리</div>
        <div class="search-detail-box form-inline">
            <table class="table table-cols">
                <colgroup>
                    <col class="width-xs">
                    <col class="width-2xl">
                    <col class="width-xs">
                    <col class="width-3xl">
                </colgroup>
                <tbody>
                <tr>
                    <th>게시판</th>
                    <td>
                        <select class="form-control" id="board_id" name="board_id">
                            <?php foreach ($boardLists as $board): ?>
                                <option value="<?= esc($board['board_id']) ?>"
                                    <?= $board_id == $board['board_id'] ? 'selected' : '' ?>>
                                    <?= esc($board['name']) ?>(<?= esc($board['board_id']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th>말머리</th>
                    <td>
                        <?php if (!empty($headers)): ?>
                            <select name="header_id" class="form-control">
                                <option value="">전체</option>
                                <?php foreach ($headers as $header): ?>
                                    <option value="<?= esc($header['id']) ?>"
                                        <?= (string)($filters['header_id'] ?? '') === (string)$header['id'] ? 'selected' : '' ?>
                                            style="background:<?= esc($header['badge_color']) ?>; color:<?= esc($header['text_color']) ?>">
                                        <?= esc($header['header_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span class="text-muted">말머리 없음</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>검색어</th>
                    <td colspan="3">
                        <select class="form-control" name="key">
                            <option value="title"    <?= ($filters['key'] ?? '') === 'title'    ? 'selected' : '' ?>>제목</option>
                            <option value="writer"   <?= ($filters['key'] ?? '') === 'writer'   ? 'selected' : '' ?>>작성자</option>
                            <option value="content"  <?= ($filters['key'] ?? '') === 'content'  ? 'selected' : '' ?>>내용</option>
                        </select>
                        <select class="form-control" name="searchKind">
                            <option value="equalSearch"    <?= ($filters['searchKind'] ?? '') === 'equalSearch'    ? 'selected' : '' ?>>전체일치</option>
                            <option value="fullLikeSearch" <?= ($filters['searchKind'] ?? '') === 'fullLikeSearch' ? 'selected' : '' ?>>부분포함</option>
                        </select>
                        <input type="text" name="keyword" value="<?= esc($filters['keyword'] ?? '') ?>"
                               class="form-control width-xl" placeholder="검색어를 입력하세요.">
                    </td>
                </tr>
                <tr>
                    <th>일자</th>
                    <td colspan="3">
                        <div class="date-filter-wrapper">
                            <select class="form-control" name="dateKind">
                                <option value="created_at" <?= ($filters['dateKind'] ?? '') === 'created_at' ? 'selected' : '' ?>>등록일</option>
                                <option value="updated_at" <?= ($filters['dateKind'] ?? '') === 'updated_at' ? 'selected' : '' ?>>수정일</option>
                            </select>
                            <?= dateRangePicker([
                                'name'    => 'entryDt[]',
                                'start'   => date('Y-m-d', strtotime('-6 days')),
                                'end'     => date('Y-m-d'),
                                'periods' => [
                                    ['label' => '오늘',   'value' => 0],
                                    ['label' => '7일',    'value' => 6, 'active' => true],
                                    ['label' => '15일',   'value' => 14],
                                    ['label' => '1개월',  'value' => 29],
                                    ['label' => '3개월',  'value' => 89],
                                    ['label' => '전체',   'value' => -1],
                                ]
                            ]) ?>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="table-btn">
            <input type="submit" value="검색" class="btn btn-lg btn-black js-search-button">
        </div>
    </form>

    <form id="frmList" action="" method="get" target="ifrmProcess">
        <div class="table-header form-inline">
            <div class="pull-left">
                검색 <strong><?= number_format($boards['totalSearch']) ?></strong> 건 /
                전체 <strong><?= number_format($boards['totalCount']) ?></strong> 건
            </div>
            <div class="pull-right">
                <select name="pageNum" class="form-control">
                    <?php foreach ([10, 20, 30, 50, 100] as $num): ?>
                        <option value="<?= $num ?>"
                            <?= (int)($filters['pageNum'] ?? 10) === $num ? 'selected' : '' ?>>
                            <?= $num ?>개 보기
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- ── 타입별 리스트 ── -->
        <?php
        $type = $boardSetting['type'] ?? 'D';
        switch ($type) {
            case 'G': echo view('components/board/list_gallery', get_defined_vars()); break;
            case 'E': echo view('components/board/list_event',   get_defined_vars()); break;
            case 'Q': echo view('components/board/list_qa',      get_defined_vars()); break;
            default:  echo view('components/board/list_default', get_defined_vars()); break;
        }
        ?>

        <div class="table-action clearfix">
            <div class="pull-left">
                <button type="button" class="btn btn-white" id="btnDelete">선택 게시글 삭제</button>
            </div>
        </div>

        <div class="center">
            <nav>
                <?= $boards['pager']->links() ?>
            </nav>
        </div>
    </form>

    <style>
        .date-filter-wrapper { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
        .date-range-picker .input-group { width: 130px; }
        .btn-group.js-dateperiod label { margin-right: 2px; }
    </style>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).on("change", "#board_id", function() {
            goList("<?= base_url('admin/board/article_list') ?>/" + $(this).find("option:selected").val());
        });

        $(document).on("click", "#btnDelete", function() {
            handleAdminAction(
                "<?= base_url('admin/board/article_delete/'.$board_id) ?>",
                '선택된 게시물을 삭제하시겠습니까?'
            );
        });
    </script>
<?= $this->endSection() ?>