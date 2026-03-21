$(document).on("click", "#btnDelete", function() {
    handleAdminAction("<?=base_url('admin/board/board_delete') ?>",
        '선택된 게시물을 삭제하시겠습니까?',
    );
});