<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>코드 관리 (트리)<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="page-header">
        <h3>코드 관리</h3>
    </div>

    <div class="code-tree-wrap">
        <!-- ── 왼쪽: 트리 패널 ── -->
        <div class="code-tree-panel">
            <div class="code-tree-header">
                <span>코드 구조</span>
            </div>
            <div class="code-tree-body" id="codeTree">
                <?php foreach ($depth1 as $d1): ?>
                    <div class="tree-depth1" data-code="<?= esc($d1['code']) ?>">
                        <div class="tree-node tree-node-d1" data-code="<?= esc($d1['code']) ?>" data-name="<?= esc($d1['code_name']) ?>" data-depth="1">
                            <i class="fa fa-folder tree-folder"></i>
                            <span><?= esc($d1['code_name']) ?></span>
                            <span class="tree-code text-muted"><?= esc($d1['code']) ?></span>
                            <button type="button" class="btn-tree-add" data-parent="<?= esc($d1['code']) ?>" data-depth="2" title="하위 추가">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="tree-children" id="children-<?= esc($d1['code']) ?>">
                            <?php foreach ($depth2 as $d2): ?>
                                <?php if (substr($d2['code'], 0, 3) === $d1['code']): ?>
                                    <div class="tree-depth2" data-code="<?= esc($d2['code']) ?>">
                                        <div class="tree-node tree-node-d2" data-code="<?= esc($d2['code']) ?>" data-name="<?= esc($d2['code_name']) ?>" data-depth="2">
                                            <i class="fa fa-folder-open tree-folder"></i>
                                            <span><?= esc($d2['code_name']) ?></span>
                                            <span class="tree-code text-muted"><?= esc($d2['code']) ?></span>
                                            <button type="button" class="btn-tree-add" data-parent="<?= esc($d2['code']) ?>" data-depth="3" title="항목 추가">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ── 오른쪽: 편집 패널 ── -->
        <div class="code-edit-panel">
            <!-- 기본 안내 -->
            <div id="editGuide" class="code-edit-guide">
                <i class="fa fa-hand-o-left" style="font-size:24px; color:#ccc;"></i>
                <p>왼쪽 트리에서 항목을 선택하세요.</p>
            </div>

            <!-- 선택된 노드 편집 -->
            <div id="editPanel" style="display:none;">
                <div class="code-edit-title" id="editTitle"></div>

                <!-- 선택된 노드 자체 편집 -->
                <div class="table-title" style="margin-top:0;">선택 항목 정보</div>
                <table class="table table-cols">
                    <colgroup>
                        <col class="width-sm"><col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>코드번호</th>
                        <td>
                            <strong id="editCode" class="font-eng"></strong>
                        </td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td>
                            <input type="text" id="editName" class="form-control width-lg" placeholder="이름 입력">
                        </td>
                    </tr>
                    <tr>
                        <th>사용여부</th>
                        <td>
                            <label class="radio-inline">
                                <input type="radio" name="editUseYn" value="Y" checked>사용
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="editUseYn" value="N">미사용
                            </label>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="table-action clearfix" style="margin-bottom:16px;">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" id="btnEditSave">이름 저장</button>
                        <button type="button" class="btn btn-white" id="btnEditDelete">삭제</button>
                    </div>
                </div>

                <!-- 하위 항목 목록 -->
                <div id="childrenPanel">
                    <div class="table-title" id="childrenTitle">하위 항목</div>
                    <table class="table table-rows" id="childTable">
                        <thead>
                        <tr>
                            <th class="width-2xs">순서</th>
                            <th class="width-2xs">번호</th>
                            <th class="width-sm">코드번호</th>
                            <th>항목명</th>
                            <th class="width-sm">사용설정</th>
                            <th class="width-sm">삭제</th>
                        </tr>
                        </thead>
                        <tbody id="childTbody">
                        </tbody>
                    </table>
                    <div class="table-action clearfix">
                        <div class="pull-left">
                            <button type="button" class="btn btn-white" id="btnAddChild">항목 추가</button>
                            <button type="button" class="btn btn-white" id="btnChildSave">하위 항목 저장</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        /* ── 트리 레이아웃 ── */
        .code-tree-wrap {
            display: flex;
            gap: 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            min-height: 500px;
        }
        .code-tree-panel {
            width: 280px;
            flex-shrink: 0;
            border-right: 1px solid #ddd;
            background: #fafafa;
            overflow-y: auto;
        }
        .code-tree-header {
            padding: 10px 14px;
            background: #f0f0f0;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
            font-weight: bold;
            color: #555;
        }
        .code-tree-body { padding: 8px 0; }

        /* ── 트리 노드 ── */
        .tree-node {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 13px;
            color: #333;
            transition: background .15s;
            position: relative;
        }
        .tree-node:hover { background: #eef4ff; }
        .tree-node.active { background: #ddeeff; font-weight: bold; }
        .tree-node-d1 { padding-left: 10px; }
        .tree-node-d2 { padding-left: 28px; }
        .tree-folder { color: #f0a500; font-size: 13px; }
        .tree-code {
            font-size: 10px;
            color: #aaa;
            margin-left: 2px;
        }
        .btn-tree-add {
            margin-left: auto;
            background: none;
            border: 1px solid #ddd;
            border-radius: 3px;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #666;
            cursor: pointer;
            flex-shrink: 0;
            opacity: 0;
            transition: opacity .15s;
        }
        .tree-node:hover .btn-tree-add { opacity: 1; }
        .btn-tree-add:hover { background: #1A56C4; color: #fff; border-color: #1A56C4; }

        /* ── 편집 패널 ── */
        .code-edit-panel {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
        }
        .code-edit-guide {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 300px;
            color: #bbb;
            gap: 12px;
            font-size: 14px;
        }
        .code-edit-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #1A56C4;
        }

        /* ── 하위 항목 테이블 ── */
        #childTbody .drag-handle {
            cursor: move;
            color: #aaa;
            font-size: 16px;
        }
        #childTbody tr.warning { background: #fffde7; }
    </style>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            let currentNode  = null; // { code, name, depth, id }
            let currentDepth = 0;

            // ── 트리 노드 클릭 ──
            $(document).on('click', '.tree-node', function(e) {
                if ($(e.target).hasClass('btn-tree-add') || $(e.target).closest('.btn-tree-add').length) return;

                $('.tree-node').removeClass('active');
                $(this).addClass('active');

                currentNode = {
                    code:  $(this).data('code'),
                    name:  $(this).data('name'),
                    depth: $(this).data('depth'),
                };
                currentDepth = currentNode.depth;

                showEditPanel(currentNode);
            });

            // ── 편집 패널 표시 ──
            function showEditPanel(node) {
                $('#editGuide').hide();
                $('#editPanel').show();

                $('#editCode').text(node.code);
                $('#editName').val(node.name);
                $('input[name="editUseYn"][value="Y"]').prop('checked', true);

                const depthLabel = node.depth === 1 ? '구분' : node.depth === 2 ? '코드 그룹' : '항목';
                $('#editTitle').text(`[${depthLabel}] ${node.name}`);

                // depth3는 하위 패널 숨김
                if (node.depth === 3) {
                    $('#childrenPanel').hide();
                } else {
                    $('#childrenPanel').show();
                    $('#childrenTitle').text(node.depth === 1 ? '하위 코드 그룹' : '하위 항목');
                    loadChildren(node.code, node.depth);
                }
            }

            // ── 하위 항목 로드 ──
            function loadChildren(parentCode, depth) {
                const childDepth = depth + 1;
                const codeLen    = childDepth === 2 ? 6 : 9;

                $.get('<?= base_url('admin/policy/code_children') ?>', {
                    parent: parentCode,
                    len:    codeLen
                }, function(res) {
                    if (res.status === 'success') {
                        renderChildren(res.data);
                    }
                });
            }

            // ── 하위 항목 렌더링 ──
            function renderChildren(items) {
                const $tbody = $('#childTbody');
                $tbody.empty();
                items.forEach(function(item, i) {
                    $tbody.append(makeChildRow(item, i + 1));
                });
                initSortable();
            }

            function makeChildRow(item, num) {
                return `
            <tr class="${!item.id ? 'warning' : ''}" data-id="${item.id || ''}">
                <td class="center">
                    <span class="drag-handle"><i class="fa fa-bars"></i></span>
                </td>
                <td class="center row-num">${num}</td>
                <td class="center">
                    <span class="text-muted" style="font-size:11px;">${item.code || '자동생성'}</span>
                    <input type="hidden" name="child_id[]"   value="${item.id || ''}">
                    <input type="hidden" name="child_code[]" value="${item.code || ''}">
                </td>
                <td>
                    <input type="text" name="child_name[]"
                           value="${escHtml(item.code_name || '')}"
                           class="form-control" placeholder="항목명">
                </td>
                <td class="center">
                    <select name="child_use[]" class="form-control">
                        <option value="Y" ${item.use_yn === 'Y' ? 'selected' : ''}>사용</option>
                        <option value="N" ${item.use_yn === 'N' ? 'selected' : ''}>미사용</option>
                    </select>
                </td>
                <td class="center">
                    <button type="button" class="btn btn-white btn-sm btn-icon-minus btn-del-child">삭제</button>
                </td>
            </tr>
        `;
            }

            function initSortable() {
                $('#childTbody').sortable({
                    handle: '.drag-handle',
                    axis:   'y',
                    update: function() {
                        $('#childTbody tr').each(function(i) {
                            $(this).find('.row-num').text(i + 1);
                        });
                    }
                });
            }

            // ── 하위 항목 추가 버튼 ──
            $('#btnAddChild').on('click', function() {
                const num = $('#childTbody tr').length + 1;
                $('#childTbody').append(makeChildRow({ id: '', code: '', code_name: '', use_yn: 'Y' }, num));
                initSortable();
            });

            // ── 하위 항목 삭제 ──
            $(document).on('click', '.btn-del-child', function() {
                const $row = $(this).closest('tr');
                const id   = $row.data('id');

                if (id) {
                    if (!confirm('삭제하시겠습니까?')) return;
                    $.post('<?= base_url('admin/policy/code_delete') ?>', {
                        id: id,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    }, function(res) {
                        if (res.status === 'success') {
                            $row.remove();
                            reindexChildren();
                        } else {
                            alert(res.message);
                        }
                    });
                } else {
                    $row.remove();
                    reindexChildren();
                }
            });

            function reindexChildren() {
                $('#childTbody tr').each(function(i) {
                    $(this).find('.row-num').text(i + 1);
                });
            }

            // ── 선택 항목 이름 저장 ──
            $('#btnEditSave').on('click', function() {
                if (!currentNode) return;
                const name  = $.trim($('#editName').val());
                const useYn = $('input[name="editUseYn"]:checked').val();
                if (!name) { alert('이름을 입력하세요.'); return; }

                $.post('<?= base_url('admin/policy/code_node_save') ?>', {
                    code:   currentNode.code,
                    name:   name,
                    use_yn: useYn,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                }, function(res) {
                    if (res.status === 'success') {
                        // 트리 노드 이름 업데이트
                        $(`.tree-node[data-code="${currentNode.code}"] span:first-of-type`).text(name);
                        $(`.tree-node[data-code="${currentNode.code}"]`).data('name', name);
                        currentNode.name = name;
                        $('#editTitle').text(`[${currentNode.depth === 1 ? '구분' : currentNode.depth === 2 ? '코드 그룹' : '항목'}] ${name}`);
                        alert(res.message);
                    } else {
                        alert(res.message);
                    }
                });
            });

            // ── 선택 항목 삭제 ──
            $('#btnEditDelete').on('click', function() {
                if (!currentNode) return;
                if (!confirm(`"${currentNode.name}" 을(를) 삭제하시겠습니까?\n하위 항목도 모두 삭제됩니다.`)) return;

                $.post('<?= base_url('admin/policy/code_node_delete') ?>', {
                    code:  currentNode.code,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                }, function(res) {
                    if (res.status === 'success') {
                        // 트리에서 제거
                        $(`.tree-node[data-code="${currentNode.code}"]`).closest('[data-code]').remove();
                        $('#editGuide').show();
                        $('#editPanel').hide();
                        currentNode = null;
                    } else {
                        alert(res.message);
                    }
                });
            });

            // ── 하위 항목 저장 ──
            $('#btnChildSave').on('click', function() {
                if (!currentNode) return;

                const rows = [];
                $('#childTbody tr').each(function(i) {
                    const name = $.trim($(this).find('input[name="child_name[]"]').val());
                    if (!name) return;
                    rows.push({
                        id:        $(this).data('id') || '',
                        code:      $(this).find('input[name="child_code[]"]').val() || '',
                        code_name: name,
                        use_yn:    $(this).find('select[name="child_use[]"]').val(),
                        order_no:  i + 1,
                    });
                });

                if (rows.length === 0) { alert('저장할 항목이 없습니다.'); return; }

                $.ajax({
                    url:    '<?= base_url('admin/policy/code_save') ?>',
                    method: 'POST',
                    data: {
                        rows:   JSON.stringify(rows),
                        depth2: currentNode.code,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            dialog_alert(res.message, '알림', {
                                callback: function() {
                                    loadChildren(currentNode.code, currentNode.depth);
                                    // depth2 추가 시 트리도 업데이트
                                    if (currentNode.depth === 1) {
                                        reloadTree();
                                    }
                                }
                            });
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });

            // ── 트리 + 버튼으로 하위 추가 ──
            $(document).on('click', '.btn-tree-add', function(e) {
                e.stopPropagation();
                const parent = $(this).data('parent');
                const depth  = parseInt($(this).data('depth'));

                // 해당 노드 클릭 효과
                const $node = $(`.tree-node[data-code="${parent}"]`);
                $('.tree-node').removeClass('active');
                $node.addClass('active');

                currentNode = {
                    code:  parent,
                    name:  $node.data('name'),
                    depth: depth - 1,
                };
                currentDepth = depth - 1;

                showEditPanel(currentNode);
                // 하위 항목 추가 버튼 자동 클릭
                setTimeout(() => $('#btnAddChild').trigger('click'), 200);
            });

            // ── 트리 전체 새로고침 ──
            function reloadTree() {
                $.get('<?= base_url('admin/policy/code_tree_data') ?>', function(res) {
                    if (res.status === 'success') {
                        renderTree(res.data);
                    }
                });
            }

            function renderTree(data) {
                const $tree = $('#codeTree');
                $tree.empty();
                data.depth1.forEach(function(d1) {
                    let d2Html = '';
                    data.depth2.filter(d => d.code.startsWith(d1.code)).forEach(function(d2) {
                        d2Html += `
                    <div class="tree-depth2" data-code="${d2.code}">
                        <div class="tree-node tree-node-d2"
                             data-code="${d2.code}" data-name="${escHtml(d2.code_name)}" data-depth="2">
                            <i class="fa fa-folder-open tree-folder"></i>
                            <span>${escHtml(d2.code_name)}</span>
                            <span class="tree-code text-muted">${d2.code}</span>
                            <button type="button" class="btn-tree-add"
                                    data-parent="${d2.code}" data-depth="3">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>`;
                    });
                    $tree.append(`
                <div class="tree-depth1" data-code="${d1.code}">
                    <div class="tree-node tree-node-d1"
                         data-code="${d1.code}" data-name="${escHtml(d1.code_name)}" data-depth="1">
                        <i class="fa fa-folder tree-folder"></i>
                        <span>${escHtml(d1.code_name)}</span>
                        <span class="tree-code text-muted">${d1.code}</span>
                        <button type="button" class="btn-tree-add"
                                data-parent="${d1.code}" data-depth="2">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="tree-children">${d2Html}</div>
                </div>
            `);
                });
            }

            function escHtml(str) {
                return String(str)
                    .replace(/&/g,'&amp;').replace(/</g,'&lt;')
                    .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
            }

        });
    </script>
<?= $this->endSection() ?>