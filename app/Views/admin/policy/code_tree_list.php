<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>코드 관리<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="page-header">
        <h3>코드 관리</h3>
        <div class="btn-group">
            <button type="button" class="btn btn-red" id="btnAddRoot">
                <i class="fa fa-plus"></i> 최상위 코드 추가
            </button>
        </div>
    </div>

    <div class="row">
        <!-- ── 트리 목록 ──────────────────────────────────────────── -->
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>코드 트리</strong>
                    <small class="text-muted" style="margin-left:8px">
                        같은 레벨 내에서 드래그하여 순서를 변경할 수 있습니다.
                    </small>
                </div>
                <div class="panel-body" style="padding:10px">
                    <div id="codeTree">
                        <?php foreach ($tree as $d1): ?>
                            <div class="tree-depth1" data-id="<?= $d1['id'] ?>">

                                <!-- depth1 행 -->
                                <div class="tree-row tree-row-d1 <?= $d1['use_yn'] === 'N' ? 'text-muted' : '' ?>"
                                     data-id="<?= $d1['id'] ?>"
                                     data-depth="1"
                                     data-parent="">
                                    <span class="tree-handle d1-handle"><i class="fa fa-bars"></i></span>
                                    <span class="tree-toggle" data-target="sub_<?= $d1['id'] ?>">
                                <i class="fa fa-caret-down"></i>
                            </span>
                                    <span class="tree-code"><?= esc($d1['code']) ?></span>
                                    <span class="tree-name"><?= esc($d1['code_name']) ?></span>
                                    <?php if ($d1['use_yn'] === 'N'): ?>
                                        <span class="label label-default" style="font-size:11px">미사용</span>
                                    <?php endif; ?>
                                    <span class="tree-actions">
                                <button type="button" class="btn btn-xs btn-default btn-add-child"
                                        data-id="<?= $d1['id'] ?>" data-depth="1">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-default btn-edit"
                                        data-id="<?= $d1['id'] ?>">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-default btn-delete"
                                        data-id="<?= $d1['id'] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </span>
                                </div>

                                <!-- depth2 목록 -->
                                <div class="tree-children" id="sub_<?= $d1['id'] ?>">
                                    <ul class="sortable-list" data-depth="2" data-parent="<?= $d1['id'] ?>">
                                        <?php foreach ($d1['children'] as $d2): ?>
                                            <li class="tree-depth2" data-id="<?= $d2['id'] ?>">

                                                <div class="tree-row tree-row-d2 <?= $d2['use_yn'] === 'N' ? 'text-muted' : '' ?>"
                                                     data-id="<?= $d2['id'] ?>"
                                                     data-depth="2"
                                                     data-parent="<?= $d1['id'] ?>">
                                                    <span class="tree-handle"><i class="fa fa-bars"></i></span>
                                                    <span class="tree-toggle" data-target="sub_<?= $d2['id'] ?>">
                                        <i class="fa fa-caret-down"></i>
                                    </span>
                                                    <span class="tree-code"><?= esc($d2['code']) ?></span>
                                                    <span class="tree-name"><?= esc($d2['code_name']) ?></span>
                                                    <?php if ($d2['use_yn'] === 'N'): ?>
                                                        <span class="label label-default" style="font-size:11px">미사용</span>
                                                    <?php endif; ?>
                                                    <span class="tree-actions">
                                        <button type="button" class="btn btn-xs btn-default btn-add-child"
                                                data-id="<?= $d2['id'] ?>" data-depth="2">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-default btn-edit"
                                                data-id="<?= $d2['id'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-default btn-delete"
                                                data-id="<?= $d2['id'] ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </span>
                                                </div>

                                                <!-- depth3 목록 -->
                                                <div class="tree-children" id="sub_<?= $d2['id'] ?>">
                                                    <ul class="sortable-list" data-depth="3" data-parent="<?= $d2['id'] ?>">
                                                        <?php foreach ($d2['children'] as $d3): ?>
                                                            <li class="tree-depth3" data-id="<?= $d3['id'] ?>">
                                                                <div class="tree-row tree-row-d3 <?= $d3['use_yn'] === 'N' ? 'text-muted' : '' ?>"
                                                                     data-id="<?= $d3['id'] ?>"
                                                                     data-depth="3"
                                                                     data-parent="<?= $d2['id'] ?>">
                                                                    <span class="tree-handle"><i class="fa fa-bars"></i></span>
                                                                    <span class="tree-code"><?= esc($d3['code']) ?></span>
                                                                    <span class="tree-name"><?= esc($d3['code_name']) ?></span>
                                                                    <?php if ($d3['use_yn'] === 'N'): ?>
                                                                        <span class="label label-default" style="font-size:11px">미사용</span>
                                                                    <?php endif; ?>
                                                                    <span class="tree-actions">
                                                <button type="button" class="btn btn-xs btn-default btn-edit"
                                                        data-id="<?= $d3['id'] ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-default btn-delete"
                                                        data-id="<?= $d3['id'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </span>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>

                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                            </div><!-- /.tree-depth1 -->
                        <?php endforeach; ?>

                        <!-- depth1 sortable wrapper -->
                        <ul id="sortableRoot" class="sortable-list" data-depth="1" data-parent=""
                            style="list-style:none; padding:0; margin:0; position:absolute; top:0; left:0; width:100%; pointer-events:none; opacity:0;">
                            <?php foreach ($tree as $d1): ?>
                                <li data-id="<?= $d1['id'] ?>"></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── 등록/수정 폼 ───────────────────────────────────────── -->
        <div class="col-md-5">
            <div class="panel panel-default" id="formPanel">
                <div class="panel-heading">
                    <strong id="formTitle">코드 등록</strong>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="fId">
                    <input type="hidden" id="fParentId">
                    <input type="hidden" id="fDepth" value="1">

                    <table class="table table-cols">
                        <tbody>
                        <tr id="rowParentCode" style="display:none">
                            <th>상위 코드</th>
                            <td>
                                <span id="fParentInfo" class="text-muted"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>코드값</th>
                            <td>
                                <span id="fCodePreview" class="text-muted">자동 생성</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="require">코드명</th>
                            <td>
                                <input type="text" id="fCodeName" class="form-control" maxlength="50">
                            </td>
                        </tr>
                        <tr>
                            <th>사용여부</th>
                            <td>
                                <label class="radio-inline">
                                    <input type="radio" name="fUseYn" value="Y" checked> 사용
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="fUseYn" value="N"> 미사용
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="text-right">
                        <button type="button" class="btn btn-default" id="btnFormReset">취소</button>
                        <button type="button" class="btn btn-red" id="btnFormSave">저장</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #codeTree { position: relative; }
        .tree-depth1 { margin-bottom: 4px; }
        .tree-row {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 8px;
            border-radius: 4px;
            background: #f9f9f9;
            border: 1px solid #e8e8e8;
            cursor: default;
        }
        .tree-row-d1 { background: #f0f4ff; border-color: #c8d8f8; font-weight: bold; }
        .tree-row-d2 { margin-left: 20px; background: #f9f9f9; }
        .tree-row-d3 { margin-left: 40px; background: #fff; font-size: 13px; }

        .tree-handle { cursor: grab; color: #aaa; padding: 0 4px; }
        .tree-handle:active { cursor: grabbing; }
        .tree-toggle { cursor: pointer; color: #888; width: 14px; }
        .tree-code { color: #888; font-size: 12px; min-width: 80px; }
        .tree-name { flex: 1; }
        .tree-actions { margin-left: auto; display: flex; gap: 3px; opacity: 0; transition: opacity 0.1s; }
        .tree-row:hover .tree-actions { opacity: 1; }

        .tree-children { }
        .sortable-list { list-style: none; padding: 0; margin: 4px 0 0 0; }
        .sortable-list li { margin-bottom: 3px; }

        /* 드래그 중 스타일 */
        .ui-sortable-helper { box-shadow: 0 2px 8px rgba(0,0,0,0.15); opacity: 0.9; }
        .ui-sortable-placeholder { border: 2px dashed #c8d8f8 !important; background: #f0f4ff !important; height: 36px !important; }
    </style>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        var SAVE_URL    = '<?= site_url('admin/policy/code/save') ?>';
        var DELETE_URL  = '<?= site_url('admin/policy/code/delete') ?>';
        var REORDER_URL = '<?= site_url('admin/policy/code/reorder') ?>';
        var GET_URL     = '<?= site_url('admin/policy/code/get') ?>';

        $(function () {

            // ── 드래그앤드롭 (같은 레벨 내에서만) ──────────────────────
            function initSortable() {
                $('.sortable-list').sortable({
                    handle: '.tree-handle',
                    axis: 'y',
                    connectWith: false, // 다른 레벨로 이동 불가
                    placeholder: 'ui-sortable-placeholder',
                    tolerance: 'pointer',
                    stop: function (e, ui) {
                        var $list  = $(this);
                        var orders = [];
                        $list.find('> li').each(function (i) {
                            orders.push({ id: $(this).data('id'), order_no: i + 1 });
                        });
                        $.post(REORDER_URL, { orders: orders }, function (res) {
                            if (res.status !== 'success') alert(res.message);
                        });
                    }
                });
            }
            initSortable();

            // ── 하위 펼치기/접기 ────────────────────────────────────────
            $(document).on('click', '.tree-toggle', function () {
                var target = $(this).data('target');
                $('#' + target).slideToggle(150);
                $(this).find('i').toggleClass('fa-caret-down fa-caret-right');
            });

            // ── 최상위 코드 추가 ────────────────────────────────────────
            $('#btnAddRoot').on('click', function () {
                resetForm();
                $('#fDepth').val(1);
                $('#rowParentCode').hide();
                $('#formTitle').text('최상위 코드 등록');
            });

            // ── 하위 코드 추가 ──────────────────────────────────────────
            $(document).on('click', '.btn-add-child', function () {
                var parentId   = $(this).data('id');
                var parentDepth = parseInt($(this).data('depth'));

                if (parentDepth >= 3) {
                    alert('3단계까지만 등록 가능합니다.');
                    return;
                }

                var parentCode = $(this).closest('.tree-row').find('.tree-code').text().trim();
                var parentName = $(this).closest('.tree-row').find('.tree-name').text().trim();

                resetForm();
                $('#fParentId').val(parentId);
                $('#fDepth').val(parentDepth + 1);
                $('#fParentInfo').text(parentCode + ' ' + parentName);
                $('#rowParentCode').show();
                $('#formTitle').text('하위 코드 등록');
                $('#fCodeName').focus();
            });

            // ── 수정 ────────────────────────────────────────────────────
            $(document).on('click', '.btn-edit', function () {
                var id = $(this).data('id');
                $.get(GET_URL, { id: id }, function (res) {
                    if (res.status !== 'success') return;
                    var d = res.data;

                    resetForm();
                    $('#fId').val(d.id);
                    $('#fParentId').val(d.parent_id || '');
                    $('#fDepth').val(d.depth);
                    $('#fCodeName').val(d.code_name);
                    $('#fCodePreview').text(d.code);
                    $('[name="fUseYn"][value="' + d.use_yn + '"]').prop('checked', true);

                    if (d.parent_id) {
                        $('#rowParentCode').show();
                    }
                    $('#formTitle').text('코드 수정');
                    $('#fCodeName').focus();
                });
            });

            // ── 삭제 ────────────────────────────────────────────────────
            $(document).on('click', '.btn-delete', function () {
                if (!confirm('삭제하시겠습니까?\n하위 코드가 있으면 삭제되지 않습니다.')) return;
                var id = $(this).data('id');
                $.post(DELETE_URL, { id: id }, function (res) {
                    if (res.status === 'success') {
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                });
            });

            // ── 저장 ────────────────────────────────────────────────────
            $('#btnFormSave').on('click', function () {
                var codeName = $.trim($('#fCodeName').val());
                if (!codeName) {
                    alert('코드명을 입력해주세요.');
                    $('#fCodeName').focus();
                    return;
                }

                var data = {
                    id:        $('#fId').val(),
                    parent_id: $('#fParentId').val(),
                    depth:     $('#fDepth').val(),
                    code_name: codeName,
                    use_yn:    $('[name="fUseYn"]:checked').val(),
                };

                $.post(SAVE_URL, data, function (res) {
                    if (res.status === 'success') {
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                });
            });

            // ── 취소 ────────────────────────────────────────────────────
            $('#btnFormReset').on('click', resetForm);

            function resetForm() {
                $('#fId').val('');
                $('#fParentId').val('');
                $('#fDepth').val(1);
                $('#fCodeName').val('');
                $('#fCodePreview').text('자동 생성');
                $('#fParentInfo').text('');
                $('#rowParentCode').hide();
                $('[name="fUseYn"][value="Y"]').prop('checked', true);
                $('#formTitle').text('코드 등록');
            }

        });
    </script>
<?= $this->endSection() ?>