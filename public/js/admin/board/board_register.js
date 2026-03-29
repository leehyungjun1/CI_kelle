
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
    });
