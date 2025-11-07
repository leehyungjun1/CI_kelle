$(document).ready(function() {
    $(".btn-register").on("click", function(e) {
        e.preventDefault();
        var $form = $("#frm");
        var formData = new FormData($form[0]);
        var actionUrl = $form.attr("action");

        $.ajax({
            url: actionUrl,
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType:false,
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                } else {
                    // 배열 형태 메시지를 보기 좋게 변환
                    let errorMsg = '';
                    for (let key in res.message) {
                        errorMsg += res.message[key] + "\n";
                    }
                    alert(errorMsg);
                }
            },
            error: function(xhr, status, error) {
                $("#message").html('<div class="alert alert-danger">저장 중 오류가 발생했습니다.</div>');
            }
        });
    });


    // 숫자만 입력하기 원하는 경우
    $('input.js-number').on('input', function() {
        // 숫자(0-9)와 하이픈(-)만 남기고 나머지는 제거
        this.value = this.value.replace(/[^0-9\-]/g, '');
    });

    // 숫자만 입력하기 원하는 경우 ,(쉼표) .(콤마) -(마이너스) 입력안됨
    $('input.js-number-only').on('input', function() {
        // 숫자(0-9)만 남기고 나머지는 제거
        this.value = this.value.replace(/[^0-9]/g, '');
    });

// 전화번호만 입력하기 원하는 경우
    if ($('input.js-tel').length > 0) {
        $('input.js-tel').each(function () {
            // 일반전화 /^(0(2|3[1-3]|4[1-4]|5[1-5]|6[1-4]))-(\d{3,4})-(\d{4})$/
            // 휴대전화 /^(?:(010-\d{4})|(01[1|6|7|8|9]-\d{3,4}))-(\d{4})$/
        });
    }

// 포커스 인 시 숫자만 보여주기
    $('input.js-tel').on('focus', function() {
        this.value = this.value.replace(/-/g, '');
    });

    // 포커스 아웃 시 자동 포맷
    $('input.js-tel').on('blur', function() {
        let val = this.value.replace(/\D/g, ''); // 숫자만
        let formatted = '';

        if(val.length < 4) {
            formatted = val;
        } else if(val.length < 7) {
            formatted = val.slice(0,3) + '-' + val.slice(3);
        } else if(val.length <= 10) {
            formatted = val.slice(0,3) + '-' + val.slice(3,7) + '-' + val.slice(7);
        } else {
            formatted = val.slice(0,3) + '-' + val.slice(3,7) + '-' + val.slice(7,11);
        }

        this.value = formatted;
    });

    // 입력 중에는 숫자만
    $('input.js-tel').on('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    //이메일 주소 셀렉트시 변경되게.
    $('.email_select').on('change', function() {
        let selected = $(this).val();
        let $emailDomain = $(this).closest('td').find('.email_domain');

        if(selected !== "") {
            $emailDomain.val(selected).prop('readonly',true);
        } else {
            $emailDomain.val('').prop('readonly',false);
        }
    });

    $("#sort").on('change', function() {
        $("#searchsort").val($(this).val());
        $(".js-search-button").click();
    });

    $('.js-datepicker input').datepicker({
        dateFormat: 'yy-mm-dd' // '2025-09-27' 형식
    });

    // 달력 아이콘 클릭 시 input focus
    $('.js-datepicker .btn-icon-calendar').on('click', function(){
        $(this).closest('.js-datepicker').find('input').focus();
    });

    // 기간 선택 시 날짜 자동 계산
    $('.js-dateperiod input[type=radio]').on('change', function() {
        const $periodGroup = $(this).closest('.js-dateperiod');
        const targetName = $periodGroup.data('target-name'); // entryDt[]
        const $inputs = $('input[name="' + targetName + '"]'); // 시작/종료일 두 개
        const days = parseInt($(this).val());
        // 날짜 input이 두 개 있을 때만 처리
        if ($inputs.length < 2) return;

        const $startInput = $inputs.eq(0); // 시작일
        const $endInput = $inputs.eq(1);   // 종료일

        // 종료일을 기준으로 계산하되, 없으면 오늘 날짜로 대체
        let endDateStr = $endInput.val();
        let endDate = endDateStr ? new Date(endDateStr) : new Date();
        let startDate = new Date(endDate);

        // 날짜 포맷 함수
        const formatDate = date =>
            date.getFullYear() + '-' +
            String(date.getMonth() + 1).padStart(2, '0') + '-' +
            String(date.getDate()).padStart(2, '0');

        if (days < 0) {
            // 전체 기간: 날짜 필드를 비우되, 다음 선택에서 정상 동작하도록
            $inputs.eq(0).val('');
            $inputs.eq(1).val('');
        } else {
            startDate.setDate(endDate.getDate() - days);
            $inputs.eq(0).val(formatDate(startDate)); // 시작일
            $inputs.eq(1).val(formatDate(endDate));   // 종료일
        }

        // active 표시
        $periodGroup.find('label').removeClass('active');
        $(this).closest('label').addClass('active');
    });

    $('.js-search-toggle').on('click', function (e) {
        var $form = $(this).closest('form');
        var $tbodyObj = $form.find('.js-search-detail');
        var $inputObj = $form.find('input[name=detailSearch]');
        var $inputVal = $inputObj.val();

        if (e.isTrigger == undefined) $inputObj.val($inputVal == 'y' ? 'n' : 'y');
        if ($inputObj.val() == 'y') {
            $tbodyObj.show();
            $(this).find('span').text('닫힘');
            $(this).addClass('opened');
        } else {
            $tbodyObj.hide();
            $(this).find('span').text('펼침');
            $(this).removeClass('opened');
        }
    });




    init_file_style();
})

function init_file_style() {
    var files = $(":file").not('.no-filestyle');
    if (files.length > 0) {
        files.filestyle({
            icon: false,
            buttonText: '찾아보기',
            buttonName: 'btn-gray',
            buttonBefore: true,
            size: 'sm'
        });
    }
}

function init_file_style_destroy() {
    var files = $(":file").not('.no-filestyle');
    if (files.length > 0) {
        files.filestyle('destroy');
    }
}




function postcode_search(zipcode, address1, address2) {
    new daum.Postcode({
        oncomplete: function(data) {
            $("#"+zipcode).val(data.zonecode);
            $("#"+address1).val(data.address);
            $("#"+address2).val('');
        }
    }).open();
}

function goList(url) {
    location.href=url;
}




