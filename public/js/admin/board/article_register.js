var oEditors = [];

$(document).ready(function() {

    // ── 스마트 에디터 ──
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,  // 전역 oEditors 사용
        elPlaceHolder: "editor",
        sSkinURI: "/editor/SmartEditor2Skin.html",
        htParams: {
            bUseToolbar: true,
            bUseVerticalResizer: true,
            bUseModeChanger: true,
            fOnBeforeUnload: function() {},
            fOnAppLoad: function() {}
        },
        fCreator: "createSEditor2"
    });

    // ── 게시판 변경 시 이동 ──
    $(document).on("change", "#board_id", function() {
        var url = $(this).find("option:selected").val();
        goList("/admin/board/article_register/" + url);
    });

    // ── 별점 raty.js ──
    if (typeof $.fn.raty !== 'undefined') {
        const rating = parseInt($('#articleData').data('rating')) || 0;
        $('.starRating').raty({
            score: rating,
            starType: 'i',
            starOn:  'fa fa-star',
            starOff: 'fa fa-star-o',
            click: function(score) {
                $('#rating').val(score);
            }
        });
    }

});
