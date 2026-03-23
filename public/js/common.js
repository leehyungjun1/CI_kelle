$(document).ready(function() {

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
            if (val.length <= 5) {
                formatted = val.slice(0, 2) + '-' + val.slice(2);
            } else if (val.length <= 9) {
                formatted = val.slice(0, 2) + '-' + val.slice(2, 5) + '-' + val.slice(5);
            } else {
                formatted = val.slice(0, 2) + '-' + val.slice(2, 6) + '-' + val.slice(6, 10);
            }
        } else {
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

    // ── 목록으로 이동 ──
    window.goList = function(url) {
        location.href = url;
    };

    const statNums = document.querySelectorAll('.stat-num[data-target]');
    if (statNums.length > 0) {
        statNums.forEach(el => countUp(el));
    }
});

// ── 숫자 카운트업 애니메이션 ──
function countUp(el) {
    const target = parseInt(el.dataset.target);
    const suffix = el.dataset.suffix || '';
    const duration = 2000;
    const steps = 60;
    const stepTime = duration / steps;
    let current = 0;
    const increment = target / steps;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        el.textContent = Math.floor(current).toLocaleString() + suffix;
    }, stepTime);
}