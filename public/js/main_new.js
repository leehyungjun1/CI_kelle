$(function () {
    new Swiper(".mainTopBanner", {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        speed: 800,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".main-next",
            prevEl: ".main-prev",
        },
        effect: "slide",
    });

    const myReview = new Swiper(".myReviewSwiper", {
        slidesPerView: 3,        // 화면에 3장
        spaceBetween: -30,        // 카드 간격
        loop: true,
        centeredSlides: true,    // 👈 가운데 기준 정렬
        speed: 700,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".review-next",
            prevEl: ".review-prev",
        },
    });
});