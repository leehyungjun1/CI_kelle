$(document).ready(function() {
    // 사이드 메뉴 토글
    $(document).on('click', '.js-adminmenu-toggle', function () {
        if (!$('#content-wrap > .js-adminmenu-toggle').length) {
            $('#content-wrap').prepend($(this).clone().addClass('active'));
        } else {
            $('#content-wrap > .js-adminmenu-toggle').toggleClass('active');
        }
        $('body').toggleClass('menu-no-border');
        $(window).trigger('resize');
    });

    // 메뉴 그룹 접기/펼치기
    $(document).on('click', '.js-listgroup-toggle', function () {
        $(this).toggleClass('active');
        var $headings = $('#menu .panel-heading').not('.active');
        if ($(this).hasClass('active')) {
            $headings.removeClass('menu-icon-minus').addClass('menu-icon-plus');
            $headings.next('.list-group').hide();
        } else {
            $headings.removeClass('menu-icon-plus').addClass('menu-icon-minus');
            $headings.next('.list-group').show();
        }
    });


    $(document).on("click", ".btn-register", function(e) {
        e.preventDefault();
        // ── 에디터 내용 반영 ──
        try {
            if (typeof oEditors !== "undefined"
                && typeof oEditors.getById !== "undefined"
                && oEditors.getById["editor"]) {
                oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
            }
        } catch(err) {
            console.log('editor error:', err);
        }

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
                    dialog_alert(res.message, '알림', {
                        callback: function() {
                            location.href = res.url;
                        }
                    });
                } else {
                    // 기존 에러 메시지 초기화
                    $('.field-error').remove();
                    $('.is-error').removeClass('is-error');

                    if (res.type === 'field') {
                        // 필드 아래 표시
                        $.each(res.message, function(field, msg) {
                            var $input = $('[name="' + field + '"]');
                            if ($input.length) {
                                $input.addClass('is-error');
                                // input의 가장 가까운 td 안에 추가
                                $input.closest('td').append('<p class="field-error">' + msg + '</p>');
                            } else {
                                $("#frm").prepend('<p class="field-error">' + msg + '</p>');
                            }
                        });
                    } else {
                        // 모달로 표시
                        let msg = typeof res.message === 'object'
                            ? Object.values(res.message).join('\n')
                            : res.message;
                        dialog_alert(msg, '알림');
                    }
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

    // 전화번호 입력 부분
    $('input.js-tel').on('input', function() {
        let val = this.value.replace(/\D/g, ''); // 숫자만
        let formatted = '';

        if (val.length <= 3) {
            formatted = val;
        } else if (val.length <= 6) {
            formatted = val.slice(0, 3) + '-' + val.slice(3);
        } else if (val.length <= 10) {
            formatted = val.slice(0, 3) + '-' + val.slice(3, 6) + '-' + val.slice(6);
        } else {
            formatted = val.slice(0, 3) + '-' + val.slice(3, 7) + '-' + val.slice(7, 11);
        }

        this.value = formatted;
    });

// blur 이벤트는 제거해도 됨 (input에서 이미 처리)
    $('input.js-tel').off('focus blur');

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

    // ── 사업자번호 자동 포맷 (000-00-00000) ──
    $(document).on('input', 'input.js-busino', function() {
        let val = this.value.replace(/\D/g, '');
        let formatted = '';

        if (val.length <= 3) {
            formatted = val;
        } else if (val.length <= 5) {
            formatted = val.slice(0, 3) + '-' + val.slice(3);
        } else {
            formatted = val.slice(0, 3) + '-' + val.slice(3, 5) + '-' + val.slice(5, 10);
        }

        this.value = formatted;
    });

    $("#sort").on('change', function() {
        $("#searchsort").val($(this).val());
        $(".js-search-button").click();
    });

    $('input.js-datepicker, .js-datepicker input').datepicker({ dateFormat: 'yy-mm-dd' });

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
    var files = $(":file")
        .not('.no-filestyle')
        .not('.upload-label input');
    if (files.length > 0 && typeof files.filestyle === 'function') {
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

/* 리스트 전체 체크 TRUE / FALSE */
$(document).on("change", "#chk_all", function () {
    const checked = $(this).is(':checked');
    $('input[name="chk[]"]').prop('checked', checked);
});

$(document).on('change', '.upload-label input[type="file"]', function() {
    const fileName = this.files[0] ? this.files[0].name : '선택된 파일 없음';
    $(this).closest('li').find('.upload-filename').text(fileName);
});

$(document).on('change', 'input[name="chk[]"]', function () {
    const total = $('input[name="chk[]"]').length;
    const checked = $('input[name="chk[]"]:checked').length;
    $('#chk_all').prop('checked', total === checked);
});


function handleAdminAction(action , confirmMsg, mode ='delete', ids = null, callbackUrl = null) {
    if (!ids) {
        const checked = $('input[name="chk[]"]:checked');
        if (checked.length === 0) {
            alert('선택된 체크박스가 없습니다.');
            return false;
        }
        ids = checked.map(function() {
            return $(this).val();
        }).get();
    }

    dialog_confirm(confirmMsg, function (result) {
        if(result) {
            $.ajax({
                method: "POST",
                url: action,
                data: {ids: ids, action: action, mode: mode},
                success: function (res) {
                    if (res.status === 'success') {
                        dialog_alert(res.message, '알림', {
                            callback: function() {
                                if(callbackUrl) {
                                    location.href = callbackUrl;
                                }  else {
                                    location.reload();
                                }
                            }
                        });
                    } else {
                        alert(res.message || '처리 중 오류가 발생했습니다.');
                    }
                },
                error: function () {
                    alert('서버 통신 중 오류가 발생했습니다.');
                }
            });
        }
    });
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


$(document).on("click", ".addUploadBtn", function() {
    // 현재 개수 파악해서 id 중복 방지
    const count = $("#uploadBox li").length;

    if(count > 10) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }

    const newItem = $(`
    <li class="upload-item form-inline mgb5">
        <label class="btn btn-gray btn-sm upload-label">
            찾아보기
            <input type="file" name="upfiles[]" style="display:none;" class="no-filestyle">
        </label>
        <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">선택된 파일 없음</span>
        <a class="btn btn-white btn-icon-minus btn-sm minusUploadBtn" style="margin-left:5px;">삭제</a>
    </li>
`);

    $("#uploadBox").append(newItem);
});

$(document).on('change', '.email-select', function() {
    let selected = $(this).val();
    let $emailDomain = $(this).closest('.email-wrap').find('.email-domain');
    if (selected !== '') {
        $emailDomain.val(selected).prop('readonly', true);
    } else {
        $emailDomain.val('').prop('readonly', false);
    }
});

$(document).on("click", ".minusUploadBtn", function() {
    $("#uploadBox li:last").remove();
});

// ── datepicker 한글 설정 ──
$.datepicker.setDefaults({
    dateFormat: 'yy-mm-dd',
    prevText: '이전',
    nextText: '다음',
    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
    monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
    dayNames: ['일','월','화','수','목','금','토'],
    dayNamesShort: ['일','월','화','수','목','금','토'],
    dayNamesMin: ['일','월','화','수','목','금','토'],
    showMonthAfterYear: true,
    yearSuffix: '년'
});

// datepicker 초기화
$('input.js-datepicker, .js-datepicker input').datepicker();





