$(document).ready(function() {
    $('input[name="member_type"]').on('change', function () {
        if ($(this).val() === 'business') {
            $(".div-business").removeClass("display-none");
        } else {
            $(".div-business").addClass("display-none");
        }
    });

    $(document).on('change', '.js-certification-checkbox', function(e) {
        var checkbox = this;
        if (checkbox.checked) {
            dialog_confirm('등록된 사업자등록증을 삭제하시겠습니까? 회원정보 최종 저장 시 삭제되며, 복구가 불가합니다.', function(result) {
                if (!result) {
                    checkbox.checked = false;
                }
            }, '경고');
        }
    });

    $('#companyCertification').change(function (e) {
        const $fileInput = $('input[name="companyCertification"]');
        const file = $fileInput[0].files[0];
        const fileMaxSize = certificationMaxFileSize || 2; // MB
        const allowedExt = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];

        // 확장자 검사
        const ext = file.name.split('.').pop().toLowerCase();
        if (!allowedExt.includes(ext)) {
            e.target.value = '';
            dialog_alert('등록이 불가한 파일 형식입니다. 이미지(jpg, jpeg, png, gif, bmp, webp, svg) 및 pdf 파일만 업로드 가능합니다.');
            return;
        }

        // 파일 크기 검사
        const fileSizeMB = file.size / (1024 * 1024);
        if (fileSizeMB > fileMaxSize) {
            e.target.value = '';
            dialog_alert('파일은 최대 ' + fileMaxSize.toString() + 'MB 이하로만 등록 가능합니다.');
        }
    });
});