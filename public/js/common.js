$(document).ready(function() {

    // ── 사이드 메뉴 전체 열기/닫기 ──
    $(document).on('click', '.js-adminmenu-toggle', function () {
        if (!$('#content-wrap > .js-adminmenu-toggle').length) {
            $('#content-wrap').prepend($(this).clone().addClass('active'));
        } else {
            $('#content-wrap > .js-adminmenu-toggle').toggleClass('active');
        }
        $('body').toggleClass('menu-no-border');
        $(window).trigger('resize');
    });

    // ── 메뉴 그룹 접기/펼치기 ──
    $(document).on('click', '.js-listgroup-toggle', function () {
        $(this).toggleClass('active');
        var $headings = $('#menu .panel-heading');
        if ($(this).hasClass('active')) {
            $headings.removeClass('menu-icon-minus').addClass('menu-icon-plus');
            $headings.next('.list-group').hide();
        } else {
            $headings.removeClass('menu-icon-plus').addClass('menu-icon-minus');
            $headings.next('.list-group').show();
        }
    });

    // ── 저장 버튼 ──
    $(document).on("click", ".btn-register", function(e) {
        e.preventDefault();
        if (typeof oEditors !== "undefined" && oEditors.getById["editor"]) {
            oEditors.getById["editor"].exec("UPDATE_CONTENTS_FIELD", []);
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
            contentType: false,
            success: function(res) {
                if (res.status === 'success') {
                    dialog_alert(res.message, '알림', {
                        callback: function() {
                            location.href = res.url;
                        }
                    });
                } else {
                    let errorMsg = '';
                    for (let key in res.message) {
                        errorMsg += res.message[key] + "\n";
                    }
                    alert(errorMsg);
                }
            },
            error: function() {
                $("#message").html('<div class="alert alert-danger">저장 중 오류가 발생했습니다.</div>');
            }
        });
    });

    // ── 숫자 + 하이픈만 입력 ──
    $('input.js-number').on('input', function() {
        this.value = this.value.replace(/[^0-9\-]/g, '');
    });

    // ── 숫자만 입력 ──
    $('input.js-number-only').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // ── 전화번호 실시간 자동 포맷 ──
    $('input.js-tel').on('input', function() {
        let val = this.value.replace(/\D/g, '');
        let formatted = '';

        if (val.startsWith('02')) {
            // 서울 지역번호 (02)
            if (val.length <= 5) {
                formatted = val.slice(0, 2) + '-' + val.slice(2);
            } else if (val.length <= 9) {
                formatted = val.slice(0, 2) + '-' + val.slice(2, 5) + '-' + val.slice(5);
            } else {
                formatted = val.slice(0, 2) + '-' + val.slice(2, 6) + '-' + val.slice(6, 10);
            }
        } else {
            // 휴대폰 및 일반 지역번호 (3자리)
            if (val.length <= 3) {
                formatted = val;
            } else if (val.length <= 6) {
                formatted = val.slice(0, 3) + '-' + val.slice(3);
            } else if (val.length <= 10) {
                formatted = val.slice(0, 3) + '-' + val.slice(3, 6) + '-' + val.slice(6);
            } else {
                formatted = val.slice(0, 3) + '-' + val.slice(3, 7) + '-' + val.slice(7, 11);
            }
        }

        this.value = formatted;
    });

    // ── 이메일 도메인 셀렉트 ──
    $(document).on('change', '.email-select', function() {
        let selected = $(this).val();
        let $emailDomain = $(this).closest('.email-wrap').find('.email-domain');
        if (selected !== '') {
            $emailDomain.val(selected).prop('readonly', true);
        } else {
            $emailDomain.val('').prop('readonly', false);
        }
    });

    // ── 정렬 셀렉트 ──
    $("#sort").on('change', function() {
        $("#searchsort").val($(this).val());
        $(".js-search-button").click();
    });

    // ── 날짜 피커 ──
    $('.js-datepicker input').datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('.js-datepicker .btn-icon-calendar').on('click', function() {
        $(this).closest('.js-datepicker').find('input').focus();
    });

    // ── 기간 선택 시 날짜 자동 계산 ──
    $('.js-dateperiod input[type=radio]').on('change', function() {
        const $periodGroup = $(this).closest('.js-dateperiod');
        const targetName = $periodGroup.data('target-name');
        const $inputs = $('input[name="' + targetName + '"]');
        const days = parseInt($(this).val());

        if ($inputs.length < 2) return;

        const formatDate = date =>
            date.getFullYear() + '-' +
            String(date.getMonth() + 1).padStart(2, '0') + '-' +
            String(date.getDate()).padStart(2, '0');

        let endDate = $inputs.eq(1).val() ? new Date($inputs.eq(1).val()) : new Date();
        let startDate = new Date(endDate);

        if (days < 0) {
            $inputs.eq(0).val('');
            $inputs.eq(1).val('');
        } else {
            startDate.setDate(endDate.getDate() - days);
            $inputs.eq(0).val(formatDate(startDate));
            $inputs.eq(1).val(formatDate(endDate));
        }

        $periodGroup.find('label').removeClass('active');
        $(this).closest('label').addClass('active');
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

    // ── 검색 상세 토글 ──
    $('.js-search-toggle').on('click', function(e) {
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
});

// ── 파일 스타일 초기화 ──
function init_file_style() {
    var files = $(":file").not('.no-filestyle');
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
    if (files.length > 0 && typeof files.filestyle === 'function') {
        files.filestyle('destroy');
    }
}

// ── 리스트 전체 체크 ──
$(document).on("change", "#chk_all", function() {
    $('input[name="chk[]"]').prop('checked', $(this).is(':checked'));
});

$(document).on('change', 'input[name="chk[]"]', function() {
    const total = $('input[name="chk[]"]').length;
    const checked = $('input[name="chk[]"]:checked').length;
    $('#chk_all').prop('checked', total === checked);
});

// ── 어드민 액션 (삭제/승인 등) ──
function handleAdminAction(action, confirmMsg, mode = 'delete', ids = null, callbackUrl = null) {
    if (!ids) {
        const checked = $('input[name="chk[]"]:checked');
        if (checked.length === 0) {
            alert('선택된 체크박스가 없습니다.');
            return false;
        }
        ids = checked.map(function() { return $(this).val(); }).get();
    }

    dialog_confirm(confirmMsg, function(result) {
        if (result) {
            $.ajax({
                method: "POST",
                url: action,
                data: { ids: ids, action: action, mode: mode },
                success: function(res) {
                    if (res.status === 'success') {
                        dialog_alert(res.message, '알림', {
                            callback: function() {
                                callbackUrl ? location.href = callbackUrl : location.reload();
                            }
                        });
                    } else {
                        alert(res.message || '처리 중 오류가 발생했습니다.');
                    }
                },
                error: function() {
                    alert('서버 통신 중 오류가 발생했습니다.');
                }
            });
        }
    });
}

// ── 우편번호 검색 ──
function postcode_search(zipcode, address1, address2) {
    new daum.Postcode({
        oncomplete: function(data) {
            $("#" + zipcode).val(data.zonecode);
            $("#" + address1).val(data.address);
            $("#" + address2).val('');
        }
    }).open();
}

// ── 목록으로 이동 ──
function goList(url) {
    location.href = url;
}

// ── 파일 업로드 추가/삭제 ──
$(document).on("click", ".addUploadBtn", function() {
    const count = $("#uploadBox li").length;
    if (count > 10) {
        alert("최대 10개까지만 가능합니다.");
        return false;
    }
    const newItem = $(`
        <li class="form-inline mgb5">
            <input type="file" name="upfiles[]" id="filestyle-${count}">
            <a class="btn btn-white btn-icon-minus minusUploadBtn btn-sm">삭제</a>
        </li>
    `);
    $("#uploadBox").append(newItem);
    init_file_style();
});

$(document).on("click", ".minusUploadBtn", function() {
    $("#uploadBox li:last").remove();
});