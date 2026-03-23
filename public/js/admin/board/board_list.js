$(document).ready(function() {
    $(document).on("click", "#btnDelete", function() {
        const deleteUrl = $('#pageData').data('delete-url');
        handleAdminAction(
            deleteUrl,
            '선택된 게시판을 삭제하시겠습니까?'
        );
    });
});