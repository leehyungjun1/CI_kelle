$(function () {
    /* ----------------------------
    1. 실시간 상담신청 롤링
    -----------------------------*/
    const $scrollInner = $(".scroll-inner");
    const $table = $scrollInner.find(".consult-table");
    const $rows = $table.find("tbody tr");
    const rowHeight = $rows.first().outerHeight();
    const interval = 2500; // 2.5초마다 롤링

    function roll() {
        $scrollInner.css({
            transform: `translateY(-${rowHeight}px)`,
            transition: "transform 0.6s ease"
        });

        setTimeout(() => {
            const $firstRow = $table.find("tbody tr").first();
            $table.find("tbody").append($firstRow);
            $scrollInner.css({
                transform: "translateY(0)",
                transition: "none"
            });
        }, 700);
    }

    setInterval(roll, interval);

    $('#footerToggle').on('click', function() {
        $(this).toggleClass('active');
        $('#footerInfo').toggleClass('active');
    });

});