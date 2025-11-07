$(document).ready(function(){
    switchable({
        $element: $('#slides'),
        effect: 'slide',       // 'fade'도 가능
        animateSpeed: 1200,    // ← 전환 속도 (기본 500 → 1200ms)
        interval: 5000,        // ← 다음 슬라이드로 넘어가기까지 시간 (기본 2000 → 5000ms)
        autoPlay: true,        // 자동 재생
        showNav: true,         // 네비게이션(1,2,3,4)
        showPage: true,        // Prev / Next 버튼
        pauseOnHover: true,    // 마우스 올리면 일시정지
        loop: true             // (이 버전엔 내부적으로 무한 반복 구현되어 있음)
    });
});