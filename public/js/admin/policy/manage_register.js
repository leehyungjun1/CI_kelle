$(document).ready(function() {

    // ── 초기 상태 반영 ──
    $('.chk-parent').each(function() {
        syncParent($(this).data('parent'));
    });
    $('.chk-child:checked').each(function() {
        $(this).closest('.course-child').addClass('checked');
    });

    // ── 중분류 체크 → 소분류 전체 체크/해제 ──
    $(document).on('change', '.chk-parent', function() {
        const parent  = $(this).data('parent');
        const checked = $(this).is(':checked');
        $(`.chk-child[data-parent="${parent}"]`).prop('checked', checked)
            .closest('.course-child').toggleClass('checked', checked);
        syncParent(parent);
    });

    // ── 소분류 체크 → 중분류 상태 업데이트 ──
    $(document).on('change', '.chk-child', function() {
        const parent = $(this).data('parent');
        $(this).closest('.course-child').toggleClass('checked', $(this).is(':checked'));
        syncParent(parent);
    });

    function syncParent(parent) {
        const $children = $(`.chk-child[data-parent="${parent}"]`);
        const total     = $children.length;
        const checked   = $children.filter(':checked').length;
        const $parent   = $(`.chk-parent[data-parent="${parent}"]`);
        $parent.prop({ checked: checked === total && total > 0, indeterminate: checked > 0 && checked < total });
    }

    // ── 프로필 미리보기 ──
    $(document).on('change', 'input[name="profile_path"]', function() {
        const file = this.files[0];
        if (!file) return;
        $(this).closest('td').find('.upload-filename').text(file.name);
        const reader = new FileReader();
        reader.onload = e => {
            $('#profilePreview').attr('src', e.target.result);
            $('#profilePreviewWrap').show();
        };
        reader.readAsDataURL(file);
    });

});