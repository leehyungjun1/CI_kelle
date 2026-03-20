/* ═══════════════════════════════════════
   common.js - 한국평생교육센터 공통 스크립트
   ═══════════════════════════════════════ */

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
const statNums = document.querySelectorAll('.stat-num[data-target]');
const statObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            countUp(entry.target);
            statObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });
statNums.forEach(el => statObserver.observe(el));

// ── 롤링 배너 (무한 루프) ──
const rollingList = document.getElementById('rollingList');
if (rollingList) {
    const rollingItems = Array.from(rollingList.querySelectorAll('.rolling-item'));
    const itemHeight = 36;
    rollingItems.forEach(item => rollingList.appendChild(item.cloneNode(true)));
    let rollingCurrent = 0;
    setInterval(() => {
        rollingCurrent++;
        rollingList.style.transition = 'transform 0.4s ease';
        rollingList.style.transform = `translateY(-${rollingCurrent * itemHeight}px)`;
        if (rollingCurrent >= rollingItems.length) {
            setTimeout(() => {
                rollingList.style.transition = 'none';
                rollingCurrent = 0;
                rollingList.style.transform = 'translateY(0)';
            }, 400);
        }
    }, 2500);
}