
    $(document).on("click", ".btn-add-category", function () {
        $("#categoryTbody").append(`
            <tr>
                <td class="form-inline">
                    <input type="text" name="header_name[]" class="form-control js-add-field-category" size="40" value="">
                    <input type="color" name="badge_color[]" class="form-control color-picker" value="#ff0000" style="width: 50px; padding: 0; border: none;">
                     <input type="checkbox" name="is_use[]" value="Y" checked /> 사용여부
                    <button type="button" class="btn btn-sm btn-white btn-icon-minus btn-del-category">삭제</button>
                </td>
            </tr>
        `);
    });

    // 삭제 버튼
    $(document).on("click", ".btn-del-category", function () {
        $(this).closest("tr").remove();
    });

    $(document).on("change", "#is_category", function () {
        if ($(this).is(":checked")) {
            $("#categoryBox").show();
        } else {
            $("#categoryBox").hide();
        }
    });
