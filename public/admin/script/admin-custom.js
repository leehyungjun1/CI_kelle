$(document).ready(function() {
    const $toggle = $('#headerSubMenuManager');
    const $menu = $('.gnb-dropdown-menu');

    // 처음엔 메뉴 숨기기
    $menu.hide();

    // 클릭 시 토글
    $toggle.on('click', function(e) {
        e.preventDefault(); // 링크 이동 방지
        $menu.stop(true, true).slideToggle(200); // 메뉴 슬라이드 토글
        $(this).toggleClass('active'); // (선택) 토글 상태 표시용 클래스
    });

    // 바깥 클릭 시 닫기
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#headerSubMenuManager, .gnb-dropdown-menu').length) {
            $menu.slideUp(200);
            $toggle.removeClass('active');
        }
    });
});