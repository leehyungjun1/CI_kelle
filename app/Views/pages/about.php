<?= $this->extend('layout/front/main') ?>
<?= $this->section('content') ?>

<?php
define('KAKAO_MAP_KEY', 'YOUR_KAKAO_JS_KEY');
define('CENTER_LAT', 37.5443);
define('CENTER_LNG', 127.0557);
?>

    <div id="about-page">

        <!-- ===================================================
             SECTION 1. 히어로
        =================================================== -->
        <section class="about-hero">
            <div class="hero-bg">
                <img src="/img/about/hero_bg.jpg" alt="한국평생교육관리센터" class="hero-img">
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-content">
                <p class="hero-sub">한국평생교육관리센터</p>
                <h1 class="hero-title">학점은행제,<br>혼자 고민하지 마세요</h1>
                <p class="hero-desc">한국평생교육관리센터가<br>처음부터 끝까지 함께합니다.</p>
                <a href="#about-intro" class="hero-scroll"><i class="fa fa-chevron-down"></i></a>
            </div>
        </section>

        <!-- ===================================================
             SECTION 2. 소개 텍스트
        =================================================== -->
        <section class="about-intro" id="about-intro">
            <div class="container">
                <div class="intro-text">
                    <p>많은 학습자들이<br>어디서부터 어떻게 시작해야 할지 몰라<br>시간과 비용을 낭비합니다.</p>
                    <p>한국평생교육관리센터는<br>단순한 안내가 아닌</p>
                    <p>학습자의 상황에 맞춰<br>처음부터 끝까지 함께 관리합니다.</p>
                </div>
            </div>
        </section>

        <!-- ===================================================
             SECTION 3. 6단계 완성 플로우
        =================================================== -->
        <section class="about-flow">
            <div class="container">
                <div class="section-head flow-section-head">
                    <span class="section-sub">상담부터 수료까지</span>
                    <div class="section-title">6단계 완성 플로우</div>
                    <p class="section-desc">처음부터 끝까지 함께 하겠습니다.</p>
                </div>

                <?php
                $flows = [
                    [
                        'path'   => 'M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h14z',
                        'title'  => '상담 및 설계',
                        'desc'   => '1:1 상담 및<br>맞춤 학습계획 설계',
                        'active' => true,
                    ],
                    [
                        'path'   => 'M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m-6 9l2 2 4-4',
                        'title'  => '학습계획 점검',
                        'desc'   => '기간, 비용, 효율 등<br>학습자 입장에서 최종 점검',
                        'active' => false,
                    ],
                    [
                        'path'   => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 3a4 4 0 1 0 0 8 4 4 0 0 0 0-8z',
                        'title'  => '수강신청',
                        'desc'   => '수강신청 및 필요<br>학습자료 제공',
                        'active' => false,
                    ],
                    [
                        'path'   => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 3a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75',
                        'title'  => '1:1 관리',
                        'desc'   => '수업, 과제, 시험 등<br>전문 담당자와 일정<br>밀착 소통 관리',
                        'active' => false,
                    ],
                    [
                        'path'   => 'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 2v6h6M16 13H8M16 17H8M10 9H8',
                        'title'  => '행정절차',
                        'desc'   => '학습자등록, 학점/학위 등<br>학점은행제 행정절차 안내',
                        'active' => false,
                    ],
                    [
                        'path'   => 'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z',
                        'title'  => '목표 달성',
                        'desc'   => '학위, 자격증 발급 등<br>목표 과정 마무리',
                        'active' => false,
                    ],
                ];
                $total = count($flows);
                ?>

                <!-- 1행 01~03 -->
                <div class="flow-row">
                    <?php foreach (array_slice($flows, 0, 3) as $i => $flow):
                        $num    = $i + 1;
                        $isLast = ($num === 3);
                        ?>
                        <div class="flow-item">
                            <div class="flow-icon-row">
                                <div class="flow-circle <?= $flow['active'] ? 'flow-circle--active' : '' ?>">
                                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none"
                                         stroke="<?= $flow['active'] ? '#fff' : '#4a7ee6' ?>"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="<?= $flow['path'] ?>"/>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="flow-title"><?= $flow['title'] ?></h3>
                            <p class="flow-desc"><?= $flow['desc'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- 2행 04~06 -->
                <div class="flow-row">
                    <?php foreach (array_slice($flows, 3, 3) as $i => $flow):
                        $num    = $i + 4;
                        $isLast = ($num === $total);
                        ?>
                        <div class="flow-item">
                            <div class="flow-icon-row">
                                <div class="flow-circle <?= $flow['active'] ? 'flow-circle--active' : '' ?>">
                                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none"
                                         stroke="<?= $flow['active'] ? '#fff' : '#4a7ee6' ?>"
                                         stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="<?= $flow['path'] ?>"/>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="flow-title"><?= $flow['title'] ?></h3>
                            <p class="flow-desc"><?= $flow['desc'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>

        <!-- ===================================================
             SECTION 4. 실제 학습자들의 이야기
        =================================================== -->
        <section class="about-reviews">
            <div class="container">
                <div class="section-head">
                    <h2 class="section-title">실제 학습자들의 이야기</h2>
                    <p class="section-desc">실제 후기가 증명합니다.</p>
                </div>

                <?php if (!empty($reviews)): ?>
                    <div class="review-stack">
                        <?php foreach ($reviews as $i => $review): ?>
                            <div class="review-card review-card--<?= $i ?>">
                                <div class="review-header">
                                    <span class="review-author"><?= esc($review['writer'] ?? '학습자') ?></span>
                                    <span class="review-role">학습자님</span>
                                    <span class="review-manager">| 담당자 000</span>
                                </div>
                                <?php if (!empty($review['rating'])): ?>
                                    <div class="review-rating">
                                        <?php for ($s = 1; $s <= 5; $s++): ?>
                                            <i class="fa fa-heart <?= $s <= $review['rating'] ? 'filled' : '' ?>"></i>
                                        <?php endfor; ?>
                                        <span><?= number_format($review['rating'], 1) ?></span>
                                    </div>
                                <?php endif; ?>
                                <p class="review-content"><?= esc(strip_tags($review['content'] ?? '')) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted">등록된 후기가 없습니다.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- ===================================================
             SECTION 5. 전문 담당자
        =================================================== -->
        <section class="about-manager">
            <div class="manager-inner">
                <div class="manager-img">
                    <img src="/images/pages/about/manager_bg.jpg" alt="전문 담당자">
                </div>
                <div class="manager-text">
                    <h2>전문 담당자가 함께 합니다</h2>
                    <p>경험과 노하우를 갖춘 담당자가<br>1:1로 상담을 도와드립니다</p>
                </div>
            </div>
        </section>

        <!-- ===================================================
             SECTION 6. CTA
        =================================================== -->
        <section class="about-cta">
            <div class="cta-logo">
                <img src="/images/pages/about/logo.jpg" alt="KLLE 한국평생교육관리센터">
            </div>
            <p class="cta-text">
                어렵고 복잡한 학점은행제,<br>
                학습자들이 보다 쉽게 활용할 수 있도록<br>
                시작과 끝을 돕겠습니다.
            </p>
            <div class="cta-btns">
                <a href="https://talk.naver.com/" target="_blank" class="btn-cta btn-cta--white">네이버 예약 상담</a>
                <a href="https://open.kakao.com/" target="_blank" class="btn-cta btn-cta--yellow">카카오톡 상담</a>
            </div>
        </section>

        <!-- ===================================================
             SECTION 7. 오시는 길
        =================================================== -->
        <section class="about-location">
            <div class="container">
                <div id="kakaoMap"></div>
                <div class="map-btn-wrap">
                    <a href="https://map.kakao.com/link/map/한국평생교육관리센터,<?= CENTER_LAT ?>,<?= CENTER_LNG ?>"
                       target="_blank" class="btn-map">
                        <i class="fa fa-map-marker"></i> 지도에서 보기
                    </a>
                </div>
                <ul class="location-info">
                    <li>
                        <img src="<?= base_url('images/pages/about/Address.png') ?>" alt="주소" class="location-icon">
                        <div>
                            <strong>오시는 길</strong>
                            <p>서울 성동구 성수일로4길 25 서울숲코오롱디지털타워 20층</p>
                        </div>
                    </li>
                    <li>
                        <img src="<?= base_url('images/pages/about/Time.png') ?>" alt="업무시간" class="location-icon">
                        <div>
                            <strong>업무시간</strong>
                            <p>월-금 10:00-19:00 / 점심시간 13:00-14:00 (공휴일 휴무)</p>
                        </div>
                    </li>
                    <li>
                        <img src="<?= base_url('images/pages/about/Phone.png') ?>" alt="문의전화" class="location-icon">
                        <div>
                            <strong>문의전화</strong>
                            <p>02-2295-2616 | 평일 10:00-19:00 (점심시간 13:00-14:00)</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

    </div>

    <style>
        /* ── 공통 ─────────────────────────────────────── */
        #about-page { font-family: 'Noto Sans KR', sans-serif; color: #222; }
        #about-page .container { max-width: 860px; margin: 0 auto; padding: 0 20px; }
        #about-page .section-head { text-align: center; margin-bottom: 40px; }
        #about-page .section-sub   { font-size: 13px; color: #4a7ee6; font-weight: 600; letter-spacing: 1px; }
        #about-page .section-title { font-size: 24px; font-weight: 800; }
        #about-page .section-desc  { font-size: 14px; color: #888; margin: 0; }

        /* ── 히어로 ──────────────────────────────────── */
        .about-hero {
            position: relative; height: 480px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; color: #fff; text-align: center;
        }
        .hero-bg { position: absolute; inset: 0; }
        .hero-img { width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(20,50,120,0.6) 100%);
        }
        .hero-content { position: relative; z-index: 1; padding: 0 20px; }
        .hero-sub   { font-size: 12px; letter-spacing: 2px; opacity: 0.85; margin-bottom: 10px; }
        .hero-title { font-size: 30px; font-weight: 900; line-height: 1.45; margin-bottom: 14px; text-shadow: 0 2px 10px rgba(0,0,0,0.25); }
        .hero-desc  { font-size: 15px; line-height: 1.8; opacity: 0.9; margin-bottom: 28px; }
        .hero-scroll {
            display: inline-flex; align-items: center; justify-content: center;
            width: 38px; height: 38px; border: 2px solid rgba(255,255,255,0.55);
            border-radius: 50%; color: #fff; text-decoration: none;
            animation: bounce 1.6s infinite;
        }
        @keyframes bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(6px)} }

        /* ── 소개 ────────────────────────────────────── */
        .about-intro { padding: 64px 0; background: #fff; }
        .intro-text  { max-width: 500px; }
        .intro-text p { font-size: 16px; line-height: 1.6; color: #8F8F8F; margin-bottom: 18px; }
        .intro-text p:last-child { margin-bottom: 0; }

        /* ── 플로우 ──────────────────────────────────── */
        .about-flow { padding: 64px 0; background: #fff; }

        /* 플로우 section-head: flex column + gap으로 간격 제어 */
        #about-page .about-flow .flow-section-head {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0px;              /* 요소 간 간격 — 여기서만 조절 */
            text-align: left;
            margin-bottom: 40px;
        }
        #about-page .about-flow .flow-section-head * {
            margin: 0 !important;  /* 브라우저/Bootstrap 기본 margin 전부 제거 */
            padding: 0 !important;
        }

        #about-page .about-flow .section-sub {
            color:#000000;
        }

        #about-page .about-flow .section-title {
            line-height:0.9;
            color:#183A9E;
        }

        /* 설명 텍스트는 타이틀과 조금 더 띄움 */
        #about-page .about-flow .flow-section-head .section-desc {
            margin-top: 8px !important;
        }

        /* flow-row: 가운데 가로선 */
        .flow-row {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin-bottom: 40px;
            position: relative;
        }
        .flow-row:last-child { margin-bottom: 0; }

        /* 아이콘 중앙을 가로지르는 선 */
        .flow-row::before {
            content: '';
            position: absolute;
            top: 34px;   /* flow-circle 높이(68px)의 절반 */
            left: 10%;
            right: 10%;
            height: 1.5px;
            background: #c8d8f0;
            z-index: 0;
        }

        .flow-item {
            flex: 1;
            max-width: 220px;
            text-align: center;
            padding: 0 4px;
            position: relative;
            z-index: 1;
        }

        .flow-icon-row {
            display: flex;
            justify-content: center;
            margin-bottom: 12px;
        }

        .flow-circle {
            position: relative;
            z-index: 2;
            width: 68px; height: 68px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #c8d8f0;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(74,126,230,0.1);
        }
        .flow-circle--active {
            background: #4a7ee6;
            border-color: #4a7ee6;
            box-shadow: 0 4px 16px rgba(74,126,230,0.35);
        }

        .flow-title { font-size: 22px; font-weight: 700; color: #183A9E; margin-bottom: 6px; margin-top: 0; }
        .flow-desc  { font-size: 16px; color: #656565; line-height: 1.3; margin: 0; letter-spacing: -0.8px}

        /* ── 후기 ────────────────────────────────────── */
        .about-reviews { padding: 64px 0; background: #fff; }
        .review-stack  { max-width: 580px; margin: 0 auto; }
        .review-card {
            background: #fff; border: 1.5px solid #e2eaf8;
            border-radius: 14px; padding: 22px 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .review-card--0 { position: relative; z-index: 3; margin-left: 0; }
        .review-card--1 { position: relative; z-index: 2; margin-left: 40px; margin-top: -6px; opacity: 0.65; transform: scale(0.98); transform-origin: top left; }
        .review-card--2 { position: relative; z-index: 1; margin-left: 70px; margin-top: -6px; opacity: 0.35; transform: scale(0.96); transform-origin: top left; }
        .review-header  { display: flex; align-items: center; gap: 5px; margin-bottom: 6px; flex-wrap: wrap; }
        .review-author  { font-weight: 700; font-size: 14px; color: #222; }
        .review-role    { font-size: 12px; color: #888; }
        .review-manager { font-size: 12px; color: #bbb; }
        .review-rating  { display: flex; align-items: center; gap: 2px; margin-bottom: 8px; }
        .review-rating .fa-heart        { color: #ddd; font-size: 13px; }
        .review-rating .fa-heart.filled { color: #ff6b8a; }
        .review-rating span { font-size: 12px; color: #888; margin-left: 4px; }
        .review-content { font-size: 13px; line-height: 1.75; color: #444; }

        /* ── 담당자 ──────────────────────────────────── */
        .about-manager { background: #f7f9ff; }
        .manager-inner { display: flex; min-height: 320px; flex-wrap: wrap; }
        .manager-img   { flex: 1; min-width: 260px; min-height: 260px; padding:5px; overflow: hidden; }
        .manager-img img { width: 100%; height: 100%; object-fit: cover; }
        .manager-text  {
            flex: 1; min-width: 260px;
            display: flex; flex-direction: column; justify-content: center;
            padding: 44px 36px; background: #fff;
        }
        .manager-text h2 { font-size: 20px; font-weight: 800; margin-bottom: 12px; }
        .manager-text p  { font-size: 14px; line-height: 1.8; color: #555; margin-bottom: 24px; }
        .btn-consult {
            display: inline-block; background: #4a7ee6; color: #fff;
            padding: 11px 26px; border-radius: 8px;
            font-size: 13px; font-weight: 600; text-decoration: none;
            align-self: flex-start; transition: background 0.2s;
        }
        .btn-consult:hover { background: #2355c8; color: #fff; }

        /* ── 오시는 길 ──────────────────────────────── */
        .about-location { padding: 64px 0; background: #fff; }
        #kakaoMap { width: 100%; height: 300px; border-radius: 12px; overflow: hidden; background: #eef2ff; margin-bottom: 16px; }
        .map-btn-wrap { text-align: center; margin-bottom: 36px; }
        .btn-map {
            display: inline-block; border: 1.5px solid #4a7ee6; color: #4a7ee6;
            padding: 9px 22px; border-radius: 8px; font-size: 13px;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-map:hover { background: #4a7ee6; color: #fff; }
        .location-info { list-style: none; padding: 0; margin: 0; }
        .location-info li {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 4px 0;
            border-bottom: 1px solid #eee;
            margin-top: 15px;
        }
        .location-info li:last-child { border-bottom: none; }
        .location-icon {
            width: 32px;
            height: 32px;
            object-fit: contain;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .location-info strong {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #222;
            margin-bottom: 5px;
        }
        .location-info p {
            font-size: 14px;
            color: #666;
            margin: 0;
            line-height: 1.6;
        }

        /* ── CTA ─────────────────────────────────────── */
        .about-cta {
            border-top: 2px solid #eee;  /* 구분선 추가 */
            background: #fff;
            padding: 60px 20px;
            text-align: center;
            color: #222;
        }
        .cta-logo img {
            height: 36px;
            filter: none;  /* brightness invert 제거 */
        }
        .cta-text {
            font-size: 21px;
            line-height: 1.6;
            color: #000;
            margin: 60px 0;
        }
        .btn-cta {
            display: inline-block !important;
            padding: 13px 30px !important;
            border-radius: 50px !important;
            font-size: 14px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: all 0.2s;
        }
        .btn-cta--white {
            background: #fff !important;
            color: #222 !important;
            border: 1.5px solid #ddd !important;
        }
        .btn-cta--yellow {
            background: #4a7ee6 !important;
            color: #fff !important;
            border: none !important;
        }
        .btn-cta--white:hover  { background: #f5f5f5 !important; color: #222 !important; }
        .btn-cta--yellow:hover { background: #2355c8 !important; color: #fff !important; }


        /* ── 담당자 ──────────────────────────────────── */
        .about-manager { background: #fff; }
        .manager-inner {
            display: flex;
            flex-direction: column;  /* 가로 → 세로 */
        }
        .manager-img {
            width: 100%;
            height: 280px;
            overflow: hidden;
        }
        .manager-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            object-position: center top;  /* 상단 기준으로 크롭 */
        }
        .manager-text {
            padding: 32px 24px;
            background: #fff;
        }
        .manager-text h2 {
            font-size: 20px; font-weight: 800;
            color: #183A9E;
            margin-bottom: 10px;
        }
        .manager-text p {
            font-size: 15px; line-height: 1.8;
            color: #555; margin-bottom: 24px;
        }
        .btn-consult {
            display: inline-block; background: #4a7ee6; color: #fff;
            padding: 11px 26px; border-radius: 8px;
            font-size: 13px; font-weight: 600; text-decoration: none;
            transition: background 0.2s;
        }
        .btn-consult:hover { background: #2355c8; color: #fff; }

        /* ── 반응형 ──────────────────────────────────── */
        @media (max-width: 640px) {
            .hero-title { font-size: 24px; }
            .flow-row   { flex-wrap: wrap; justify-content: center; gap: 16px; }
            .flow-row::before { display: none; }
            .flow-item  { max-width: calc(33.333% - 12px); min-width: 90px; }
            .manager-inner { flex-direction: column; }
            .manager-text  { padding: 28px 20px; }
            .review-card--1 { margin-left: 24px; }
            .review-card--2 { margin-left: 44px; }
        }
    </style>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        var KAKAO_KEY = '<?= KAKAO_MAP_KEY ?>';
        if (KAKAO_KEY && KAKAO_KEY !== 'YOUR_KAKAO_JS_KEY') {
            var s = document.createElement('script');
            s.src = 'https://dapi.kakao.com/v2/maps/sdk.js?appkey=' + KAKAO_KEY + '&autoload=false';
            s.onload = function () {
                kakao.maps.load(function () {
                    var map = new kakao.maps.Map(document.getElementById('kakaoMap'), {
                        center: new kakao.maps.LatLng(<?= CENTER_LAT ?>, <?= CENTER_LNG ?>),
                        level: 4
                    });
                    var marker = new kakao.maps.Marker({
                        position: new kakao.maps.LatLng(<?= CENTER_LAT ?>, <?= CENTER_LNG ?>),
                        map: map
                    });
                    new kakao.maps.InfoWindow({
                        content: '<div style="padding:7px 12px;font-size:13px;font-weight:700;">한국평생교육관리센터</div>'
                    }).open(map, marker);
                });
            };
            document.head.appendChild(s);
        } else {
            document.getElementById('kakaoMap').innerHTML =
                '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#4a7ee6;font-size:13px;">' +
                '<i class="fa fa-map-marker" style="margin-right:6px;"></i>카카오맵 API 키를 입력해주세요.</div>';
        }
    </script>
<?= $this->endSection() ?>