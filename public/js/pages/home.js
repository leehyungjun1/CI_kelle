// ── 롤링 배너 ──
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

// ── 히어로 슬라이더 ──
const heroSlides = document.querySelectorAll('.hero-slide');
const heroDots   = document.querySelectorAll('#heroDots span');
let heroCurrent  = 0;
function updateHero() {
    heroSlides.forEach((s, i) => s.classList.toggle('active', i === heroCurrent));
    heroDots.forEach((d, i)   => d.classList.toggle('active', i === heroCurrent));
}
heroDots.forEach((d, i) => d.addEventListener('click', () => { heroCurrent = i; updateHero(); }));
if (heroSlides.length > 0) {
    setInterval(() => { heroCurrent = (heroCurrent + 1) % heroSlides.length; updateHero(); }, 4000);
}

// ── 학습자 후기 슬라이더 ──
const reviewSlides  = document.querySelectorAll('.review-slide');
const reviewDots    = document.querySelectorAll('#reviewDots span');
let reviewCurrent   = 0;
function updateReview() {
    reviewSlides.forEach((s, i) => {
        s.classList.remove('active', 'prev', 'next');
        if (i === reviewCurrent) {
            s.classList.add('active');
        } else if (i === (reviewCurrent - 1 + reviewSlides.length) % reviewSlides.length) {
            s.classList.add('prev');
        } else {
            s.classList.add('next');
        }
    });
    reviewDots.forEach((d, i) => d.classList.toggle('active', i === reviewCurrent));
}
reviewDots.forEach((d, i) => d.addEventListener('click', () => { reviewCurrent = i; updateReview(); }));
if (reviewSlides.length > 0) {
    setInterval(() => { reviewCurrent = (reviewCurrent + 1) % reviewSlides.length; updateReview(); }, 3500);
    updateReview();
}

// ── 교육정보 슬라이더 ──
const eduScroll = document.querySelector('.edu-scroll');
const eduDots   = document.querySelectorAll('.edu-dots span');
let eduCurrent  = 0;
function updateEdu(idx) {
    eduCurrent = idx;
    eduScroll.scrollTo({ left: eduScroll.offsetWidth * idx, behavior: 'smooth' });
    eduDots.forEach((d, i) => d.classList.toggle('active', i === idx));
}
if (eduScroll) {
    eduDots.forEach((d, i) => d.addEventListener('click', () => updateEdu(i)));
    eduScroll.addEventListener('scroll', () => {
        const idx = Math.round(eduScroll.scrollLeft / eduScroll.offsetWidth);
        eduDots.forEach((d, i) => d.classList.toggle('active', i === idx));
    });
    if (eduDots.length > 0) {
        setInterval(() => { updateEdu((eduCurrent + 1) % eduDots.length); }, 4000);
    }
}