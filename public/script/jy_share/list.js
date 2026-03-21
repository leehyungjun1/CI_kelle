// ── pageNum 변경 시 자동 검색 ──

/* 페이지 수 변경될 때 */
$(document).on('change', 'select[name="pageNum"]', function() {
    $(this).closest('form').submit();
});

// ── sort 변경 시 자동 검색 ──
$(document).on('change', 'select[name="sort"]', function() {
    $(this).closest('form').submit();
});