
    // 삭제 버튼
    $(document).on("click", ".btn-del-category", function () {
        $(this).closest("tr").remove();
    });
    $(document).ready(function() {
        // ── 말머리 초기 상태 ──
        if ($('#is_category').is(':checked')) {
            $('#categoryBox').show();
            $('#categoryBox input, #categoryBox select').prop('disabled', false);
        } else {
            $('#categoryBox').hide();
            $('#categoryBox input, #categoryBox select').prop('disabled', true);
        }

        // ── 말머리 토글 ──
        $(document).on('change', '#is_category', function() {
            if ($(this).is(':checked')) {
                $('#categoryBox').slideDown();
                $('#categoryBox input, #categoryBox select').prop('disabled', false);
            } else {
                $('#categoryBox').slideUp();
                $('#categoryBox input, #categoryBox select').prop('disabled', true);
            }
        });

        // ── 말머리 추가 ──
        $(document).on('click', '.btn-add-category', function() {
            $('#categoryTbody').append(`
                <tr>
                    <td><input type="text" name="header_name[]" class="form-control" placeholder="말머리명"></td>
                    <td><input type="color" name="badge_color[]" value="#ff0000" style="width:50px; padding:0; border:none; cursor:pointer;"></td>
                    <td><input type="color" name="text_color[]" value="#ffffff" style="width:50px; padding:0; border:none; cursor:pointer;"></td>
                    <td>
                        <select name="header_is_use[]" class="form-control">
                            <option value="Y">사용</option>
                            <option value="N">미사용</option>
                        </select>
                    </td>
                    <td><button type="button" class="btn btn-sm btn-white btn-icon-minus btn-del-category">삭제</button></td>
                </tr>
            `);
        });

        // ── 말머리 삭제 ──
        $(document).on('click', '.btn-del-category', function() {
            $(this).closest('tr').remove();
        });

        // ── 색상 미리보기 ──
        $(document).on('input', 'input[name="badge_color[]"], input[name="text_color[]"]', function() {
            const $row      = $(this).closest('tr');
            const bgColor   = $row.find('input[name="badge_color[]"]').val();
            const textColor = $row.find('input[name="text_color[]"]').val();
            const name      = $row.find('input[name="header_name[]"]').val() || '미리보기';

            let $preview = $row.find('.badge-preview');
            if (!$preview.length) {
                $row.find('td:first').append('<span class="badge-preview"></span>');
                $preview = $row.find('.badge-preview');
            }
            $preview.css({
                background: bgColor,
                color: textColor,
                padding: '2px 8px',
                borderRadius: '3px',
                fontSize: '11px',
                marginLeft: '5px',
                display: 'inline-block',
            }).text(name);
        });

        // ── 유형 변경 시 권한 행 토글 ───────────────────────────────
        $('[name="type"]').on('change', function () {
            var isQ = $(this).val() === 'Q';
            $('.perm-reply-row').toggle(isQ);
            $('.perm-comment-row').toggle(!isQ);
        });

        // ── 권한 모드 라디오 변경 → grade 박스 토글 ─────────────────
        $('.perm-mode-radio').on('change', function () {
            var action = $(this).data('action');
            var mode   = $(this).val();
            $('#gradeBox_' + action).toggle(mode === 'grade');
        });

        // ── 등급 드롭다운 → 태그 추가 ───────────────────────────────
        $('.perm-grade-select').on('change', function () {
            var action    = $(this).data('action');
            var code      = $(this).val();
            var name      = $(this).find('option:selected').text().trim();
            var $tagsWrap = $('#gradeTags_' + action);

            if (!code) return;

            // 중복 방지
            if ($tagsWrap.find('[data-code="' + code + '"]').length) {
                $(this).val('');
                return;
            }

            var tag = '<span class="label label-default perm-grade-tag" '
                + 'data-code="' + code + '" '
                + 'style="font-size:12px; padding:4px 8px; cursor:pointer;">'
                + name
                + ' <i class="fa fa-times" style="margin-left:4px;"></i>'
                + '<input type="hidden" '
                + 'name="permissions[' + action + '][grades][]" '
                + 'value="' + code + '">'
                + '</span>';

            $tagsWrap.append(tag);
            $(this).val(''); // 선택 초기화
        });

        // ── 태그 클릭 → 제거 ────────────────────────────────────────
        $(document).on('click', '.perm-grade-tag', function () {
            $(this).remove();
        });

        // ── 전체 버튼 → 모든 등급 추가 ──────────────────────────────
        $('.perm-grade-all').on('click', function () {
            var action    = $(this).data('action');
            var $select   = $('#gradeSelect_' + action);
            var $tagsWrap = $('#gradeTags_' + action);

            $tagsWrap.empty();

            $select.find('option[value!=""]').each(function () {
                var code = $(this).val();
                var name = $(this).text().trim();

                var tag = '<span class="label label-default perm-grade-tag" '
                    + 'data-code="' + code + '" '
                    + 'style="font-size:12px; padding:4px 8px; cursor:pointer;">'
                    + name
                    + ' <i class="fa fa-times" style="margin-left:4px;"></i>'
                    + '<input type="hidden" '
                    + 'name="permissions[' + action + '][grades][]" '
                    + 'value="' + code + '">'
                    + '</span>';

                $tagsWrap.append(tag);
            });
        });
    });
