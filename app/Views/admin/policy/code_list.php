<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>코드 관리<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="page-header">
        <h3>코드 관리</h3>
        <div class="btn-group">
            <input type="button" value="저장" class="btn btn-red" id="btnSave">
        </div>
    </div>

    <div class="table-title">코드 관리</div>

    <!-- ── 필터 ── -->
    <table class="table table-cols">
        <colgroup>
            <col class="width-sm">
            <col class="width-2xl">
            <col class="width-sm">
            <col class="width-2xl">
        </colgroup>
        <tbody>
        <tr>
            <th>구분</th>
            <td>
                <select id="selDepth1" class="form-control">
                    <option value="">선택</option>
                    <?php foreach ($depth1 as $code): ?>
                        <option value="<?= esc($code['code']) ?>">
                            <?= esc($code['code_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <th>코드 그룹 선택</th>
            <td>
                <select id="selDepth2" class="form-control" disabled>
                    <option value="">선택</option>
                </select>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- ── 코드 리스트 ── -->
    <div id="codeListWrap" style="display:none;">
        <table class="table table-rows" id="codeTable">
            <thead>
            <tr>
                <th class="width-2xs">순서</th>
                <th class="width-2xs">번호</th>
                <th class="width-sm">코드번호</th>
                <th>항목명</th>
                <th class="width-sm">사용설정</th>
                <th class="width-sm">추가/삭제</th>
            </tr>
            </thead>
            <tbody id="codeTbody">
            </tbody>
        </table>
    </div>

    <!-- ── 안내 ── -->
    <div id="codeGuide" class="center" style="padding:40px 0; color:#999;">
        구분과 코드 그룹을 선택하세요.
    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            let currentDepth2 = '';
            let selectedRow   = null;

            // ── 구분(depth1) 변경 ──
            $('#selDepth1').on('change', function() {
                const depth1 = $(this).val();
                $('#selDepth2').html('<option value="">선택</option>').prop('disabled', true);
                $('#codeListWrap').hide();
                $('#codeGuide').show();
                currentDepth2 = '';

                if (!depth1) return;

                $.get('<?= base_url('admin/policy/code_group') ?>', { depth1 }, function(res) {
                    if (res.status === 'success' && res.data.length > 0) {
                        res.data.forEach(function(item) {
                            $('#selDepth2').append(`<option value="${item.code}">${item.code_name}</option>`);
                        });
                        $('#selDepth2').prop('disabled', false);
                    }
                });
            });

            // ── 코드 그룹(depth2) 변경 ──
            $('#selDepth2').on('change', function() {
                currentDepth2 = $(this).val();
                selectedRow   = null;
                if (!currentDepth2) {
                    $('#codeListWrap').hide();
                    $('#codeGuide').show();
                    return;
                }
                loadCodes(currentDepth2);
            });

            // ── 코드 목록 로드 ──
            function loadCodes(depth2) {
                $.get('<?= base_url('admin/policy/code_items') ?>', { depth2 }, function(res) {
                    if (res.status === 'success') {
                        renderCodes(res.data);
                        $('#codeListWrap').show();
                        $('#codeGuide').hide();
                    }
                });
            }

            // ── 코드 렌더링 ──
            function renderCodes(items) {
                const $tbody = $('#codeTbody');
                $tbody.empty();
                if (items.length === 0) {
                    appendEmptyRow();
                    return;
                }
                items.forEach(function(item, i) {
                    $tbody.append(makeRow(item, i + 1, i === 0));
                });
            }

            function appendEmptyRow() {
                $('#codeTbody').append(makeRow({ id: '', code: '', code_name: '', use_yn: 'Y' }, 1, true));
            }

            function makeRow(item, num, isFirst) {
                const btn = isFirst
                    ? `<button type="button" class="btn btn-white btn-sm btn-icon-plus btn-add-code">추가</button>`
                    : `<button type="button" class="btn btn-white btn-sm btn-icon-minus btn-del-code">삭제</button>`;
                return `
            <tr class="center ${!item.id ? 'warning' : ''}" data-id="${item.id || ''}">
                <td>
                    <span class="drag-handle" style="cursor:move; color:#aaa; font-size:16px;">
                        <i class="fa fa-bars"></i>
                    </span>
                </td>
                <td class="row-num">${num}</td>
                <td>
                    <span class="text-muted" style="font-size:12px;">${item.code || '자동생성'}</span>
                    <input type="hidden" name="code_id[]"  value="${item.id || ''}">
                    <input type="hidden" name="code_val[]" value="${item.code || ''}">
                </td>
                <td class="td-left">
                    <input type="text" name="code_name[]"
                           value="${escHtml(item.code_name || '')}"
                           class="form-control width-2xl" placeholder="항목명 입력">
                </td>
                <td>
                    <select name="use_yn[]" class="form-control">
                        <option value="Y" ${item.use_yn === 'Y' ? 'selected' : ''}>사용</option>
                        <option value="N" ${item.use_yn === 'N' ? 'selected' : ''}>미사용</option>
                    </select>
                </td>
                <td>${btn}</td>
            </tr>
        `;
            }



            // ── 추가 ──
            $(document).on('click', '.btn-add-code', function() {
                const num = $('#codeTbody tr').length + 1;
                $('#codeTbody').append(makeRow({ id: '', code: '', code_name: '', use_yn: 'Y' }, num, false));
                reindexRows();
            });

            // ── 삭제 ──
            $(document).on('click', '.btn-del-code', function() {
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
                            reindexRows();
                            if ($('#codeTbody tr').length === 0) appendEmptyRow();
                        } else {
                            alert(res.message);
                        }
                    });
                } else {
                    $row.remove();
                    reindexRows();
                    if ($('#codeTbody tr').length === 0) appendEmptyRow();
                }
            });

            // ── 드래그 앤 드롭 정렬 ──
            $('#codeTbody').sortable({
                handle: '.drag-handle',
                axis: 'y',
                update: function() {
                    reindexRows();
                }
            });

            function reindexRows() {
                $('#codeTbody tr').each(function(i) {
                    $(this).find('.row-num').text(i + 1);
                    // 첫 번째 행만 추가 버튼, 나머지는 삭제 버튼
                    const $btnTd = $(this).find('td:last');
                    if (i === 0) {
                        $btnTd.html('<button type="button" class="btn btn-white btn-sm btn-icon-plus btn-add-code">추가</button>');
                    } else {
                        if (!$btnTd.find('.btn-del-code').length) {
                            $btnTd.html('<button type="button" class="btn btn-white btn-sm btn-icon-minus btn-del-code">삭제</button>');
                        }
                    }
                });
            }

            // ── 저장 ──
            $('#btnSave').on('click', function() {
                if (!currentDepth2) {
                    alert('코드 그룹을 선택해주세요.');
                    return;
                }

                const rows = [];
                $('#codeTbody tr').each(function(i) {
                    const $row    = $(this);
                    const name    = $.trim($row.find('input[name="code_name[]"]').val());
                    if (!name) return;
                    rows.push({
                        id:        $row.data('id') || '',
                        code:      $row.find('input[name="code_val[]"]').val() || '',
                        code_name: name,
                        use_yn:    $row.find('select[name="use_yn[]"]').val(),
                        order_no:  i + 1,
                    });
                });

                if (rows.length === 0) {
                    alert('저장할 항목이 없습니다.');
                    return;
                }

                $.ajax({
                    url:    '<?= base_url('admin/policy/code_save') ?>',
                    method: 'POST',
                    data: {
                        rows:   JSON.stringify(rows),
                        depth2: currentDepth2,
                        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            dialog_alert(res.message, '알림', {
                                callback: function() { loadCodes(currentDepth2); }
                            });
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });

            function escHtml(str) {
                return String(str)
                    .replace(/&/g,'&amp;')
                    .replace(/</g,'&lt;')
                    .replace(/>/g,'&gt;')
                    .replace(/"/g,'&quot;');
            }

        });
    </script>
<?= $this->endSection() ?>