<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>한국평생교육센터 KLLE</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /* ── 기본 리셋 ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #1A56C4;
            --blue-dark: #0d3a8e;
            --text-dark: #111827;
            --text-mid: #374151;
            --text-gray: #6B7280;
            --text-light: #9CA3AF;
            --border: #E5E7EB;
            --bg-light: #F3F4F6;
            --radius: 8px;
            --shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        html, body {
            font-family: 'Noto Sans KR', sans-serif;
            color: var(--text-dark);
            background: #f5f5f5;
            font-size: 14px;
            line-height: 1.6;
        }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }

        /* ── PC 레이아웃 ── */
        .pc-wrap {
            display: flex;
            justify-content: center;
            max-width: 1120px;
            margin: 0 auto;
        }

        /* ── 왼쪽 패널 ── */
        .left-panel {
            width: 560px;
            flex-shrink: 0;
            padding: 91px 40px 60px 60px;
            background: #f5f5f5;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow: hidden;
        }
        .left-logo { width: 286px; height: 61.04px; margin-bottom: 48px; }
        /* ── 텍스트 슬라이드업 애니메이션 ── */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .left-tagline {
            font-family: 'Pretendard', sans-serif;
            font-size: 18px; font-weight: 400;
            color: var(--text-gray);
            margin-bottom: 10px; line-height: 27px;
            opacity: 0;
            animation: slideUp 0.7s ease forwards;
            animation-delay: 0.2s;
        }
        .left-title {
            font-family: 'Pretendard', sans-serif;
            font-size: 40px; font-weight: 700;
            color: #1e2d4d;
            line-height: 50px; letter-spacing: -1.6px;
            opacity: 0;
            animation: slideUp 0.7s ease forwards;
            animation-delay: 0.5s;
        }
        .left-title-blue {
            font-family: 'Pretendard', sans-serif;
            font-size: 40px; font-weight: 700;
            color: var(--blue);
            line-height: 50px; letter-spacing: -1.6px;
            margin-bottom: 180px;
            opacity: 0;
            animation: slideUp 0.7s ease forwards;
            animation-delay: 0.8s;
        }
        .left-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            width: 100%; max-width: 423px; height: 131px;
            background: rgba(237,237,237,0.88);
            border-radius: 10px; overflow: hidden;
            margin-bottom: 40px;
        }
        .stat-col { text-align: center; padding: 28px 10px; }
        .stat-num { font-size: 25px; font-weight: 900; color: var(--blue); letter-spacing: -1px; }
        .stat-label { font-size: 12px; color: var(--text-gray); margin-top: 6px; }
        .left-sns { display: flex; gap: 10px; flex-wrap: wrap; }

        /* ── 오른쪽 패널 ── */
        .right-panel {
            width: 560px; flex-shrink: 0;
            background: white; border-left: 1px solid #ccc;
        }

        /* ── 반응형 ── */
        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; border-left: none; }
        }

        /* ── 모바일 헤더 ── */
        .m-header {
            background: white; border-bottom: 1px solid var(--border);
            position: sticky; top: 0; z-index: 100;
        }
        .m-header-inner {
            display: flex; flex-direction: column; align-items: center;
            padding: 12px 14px 0;
        }
        .m-logo { display: flex; align-items: center; gap: 8px; margin-bottom: 10px; }
        .m-logo-ring {
            width: 32px; height: 32px; border-radius: 50%;
            border: 2.5px solid var(--blue); position: relative; overflow: hidden;
        }
        .m-logo-ring::before {
            content: ''; position: absolute; inset: 0;
            background: conic-gradient(var(--blue) 0deg 260deg, transparent 260deg);
        }
        .m-logo-ring::after {
            content: ''; position: absolute; inset: 5px;
            background: white; border-radius: 50%;
        }
        .m-logo-txt .ko { font-size: 13px; font-weight: 700; }
        .m-logo-txt .en { font-size: 9px; color: var(--blue); font-weight: 600; }
        .m-nav { display: flex; width: 100%; justify-content: center; gap: 24px; padding: 0 16px; }
        .m-nav a {
            font-family: 'Pretendard', sans-serif;
            font-size: 19px; font-weight: 500; color: var(--text-mid);
            height: 30px; display: flex; align-items: center;
            border-bottom: 2px solid transparent; white-space: nowrap;
            transition: color .2s, border-color .2s;
        }
        .m-nav a:hover { color: var(--blue); border-bottom: 2px solid var(--blue); }
        .m-nav a.active { color: var(--blue); font-weight: 700; border-bottom: 2px solid var(--blue); }

        /* ── 히어로 배너 ── */
        .m-hero { position: relative; height: 380px; overflow: hidden; }
        .hero-slide {
            position: absolute; inset: 0;
            opacity: 0; transition: opacity 0.6s ease;
        }
        .hero-slide.active { opacity: 1; }
        .m-hero-content {
            position: relative; z-index: 2;
            padding: 80px 24px 0; text-align: center;
        }
        .m-hero-title {
            font-size: 30px; font-weight: 900; color: white;
            line-height: 1.35; text-shadow: 0 2px 8px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }
        .m-hero-desc { font-size: 13px; color: rgba(255,255,255,0.9); line-height: 1.9; }
        .m-hero-dots {
            display: flex; justify-content: center; gap: 8px;
            padding: 10px 0; background: white;
        }
        .m-hero-dots span {
            width: 10px; height: 10px; border-radius: 50%;
            background: var(--border); cursor: pointer; transition: background .2s;
        }
        .m-hero-dots span.active { background: var(--blue); }

        /* ── 퀵바 ── */
        .m-qbar {
            background: white; padding: 0 0 14px;
        }
        .m-qbar-row1 {
            width: 100%; margin-bottom: 12px; padding: 10px 20px;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .m-qbar-row2 {
            display: flex; align-items: center; gap: 10px;
            padding: 0 20px 14px;
            box-shadow: 0 4px 8px -2px rgba(0,0,0,0.08);
        }

        /* 롤링 배너 */
        .rolling-wrap { width: 100%; height: 36px; overflow: hidden; position: relative; }
        .rolling-list { position: absolute; width: 100%; transition: transform 0.4s ease; }
        .rolling-item { height: 36px; display: flex; align-items: center; width: 100%; }
        .m-chip {
            font-family: 'Pretendard', sans-serif;
            font-size: 14px; font-weight: 500; color: #5D5D5D;
            padding: 2px 10px; border-radius: 20px; border: 1px solid #aaa;
            flex-shrink: 0;
        }
        .m-chip-divider { color: #ccc; font-size: 13px; flex-shrink: 0; padding: 0 6px; }
        .m-chip-name {
            flex: 0 0 50px; text-align: center; padding: 0 4px; white-space: nowrap;
            font-family: 'Pretendard', sans-serif; font-size: 14px; font-weight: 500; color: #5D5D5D;
        }
        .m-chip-qual {
            flex: 1; text-align: center; padding: 0 4px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
            font-family: 'Pretendard', sans-serif; font-size: 14px; font-weight: 500; color: #5D5D5D;
        }
        .m-chip-date {
            flex-shrink: 0; white-space: nowrap; padding: 0 4px;
            font-family: 'Pretendard', sans-serif; font-size: 14px; font-weight: 500; color: #5D5D5D;
        }

        /* 연락처 & 전화 */
        .m-contact-icons { display: flex; gap: 12px; }
        .m-ci { display: flex; flex-direction: column; align-items: center; gap: 5px; }
        .m-ci-img { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; }
        .m-ci-txt { font-size: 12px; color: var(--text-mid); text-align: center; white-space: nowrap; }
        .m-phone { margin-left: auto; }
        .m-phone-num {
            font-family: 'Pretendard', sans-serif;
            font-size: 22px; font-weight: 800; color: var(--text-dark);
            letter-spacing: -0.5px; white-space: nowrap;
            display: flex; align-items: center; gap: 6px;
        }
        .m-phone-num i { font-size: 18px; }
        .m-phone-sub { font-size: 14px; color: var(--text-gray); margin-top: 3px; letter-spacing: -1px; }
        @media (max-width: 560px) {
            .m-ci-txt { display: none; }
            .m-phone-sub { white-space: nowrap; font-size: 9px; }
        }

        /* ── 공통 섹션 ── */
        .m-section { padding: 18px 14px; background: white; }
        .m-divider { height: 8px; background: var(--bg-light); }
        .m-sec-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
        .m-sec-title { font-size: 25px; font-weight: 700; }
        .m-sec-more { font-size: 14px; color: var(--text-gray); }
        .m-notice-label { font-size: 18px; color: #626262; font-weight: 600; margin-bottom: 8px; }

        /* ── 자주 찾는 메뉴 ── */
        .m-qmenu-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 8px; max-width: 394px; margin: 0 auto; }
        .m-qmenu-item { display: flex; flex-direction: column; align-items: center; gap: 8px; cursor: pointer; }
        .m-qmenu-item:hover { opacity: 0.8; }
        .m-qmenu-icon { width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #EEF4FF; }
        .m-qmenu-img { width: 48px; height: 48px; object-fit: cover; }
        .m-qmenu-label { font-size: 18px; font-weight: 600; color: var(--text-dark); }

        /* ── 알림사항 ── */
        .m-notice-list { display: flex; flex-direction: column; }
        .m-notice-item {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 0; border-bottom: 1px solid var(--border); cursor: pointer;
        }
        .m-notice-item:last-child { border-bottom: none; }
        .m-nbadge { font-size: 14px; font-weight: 700; padding: 3px 10px; border-radius: 10px; flex-shrink: 0; }
        .nb-hot { background: #FEF2F2; color: #E53935; }
        .nb-new { background: #EFF6FF; color: var(--blue); }
        .m-notice-text { flex: 1; font-size: 18px; color: var(--text-mid); overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
        .m-notice-arrow { font-size: 14px; color: #ccc; flex-shrink: 0; }

        /* ── 학습자 후기 슬라이더 ── */
        .review-slider-wrap { position: relative; overflow: hidden; padding: 10px 0 20px; }
        .review-slider { display: flex; align-items: center; justify-content: center; position: relative; height: 320px; }
        .review-slide {
            position: absolute; width: 65%; background: white;
            border-radius: 12px; border: 1px solid var(--border);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 14px; transition: all 0.4s ease;
            opacity: 0; pointer-events: none;
        }
        .review-slide.active { transform: translateX(0) scale(1); opacity: 1; z-index: 3; pointer-events: auto; }
        .review-slide.prev { transform: translateX(-68%) scale(0.82); opacity: 0.6; z-index: 2; }
        .review-slide.next { transform: translateX(68%) scale(0.82); opacity: 0.6; z-index: 2; }
        .review-img-wrap { position: relative; width: 100%; height: 160px; border-radius: 8px; overflow: hidden; margin-bottom: 10px; background: var(--bg-light); }
        .review-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .review-tag {
            position: absolute; top: 8px; left: 8px; background: white;
            font-size: 11px; font-weight: 600; color: var(--text-dark);
            padding: 3px 10px; border-radius: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        }
        .review-stars { font-size: 12px; color: #e74c3c; margin-bottom: 4px; }
        .review-stars span { color: var(--text-dark); font-weight: 700; }
        .review-name { font-size: 13px; font-weight: 700; margin-bottom: 6px; }
        .review-text { font-size: 12px; color: var(--text-mid); line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .review-dots { display: flex; justify-content: center; gap: 6px; margin-top: 8px; }
        .review-dots span { width: 8px; height: 8px; border-radius: 50%; background: var(--border); cursor: pointer; transition: background .2s; }
        .review-dots span.active { background: var(--blue); }

        /* ── 이달의 우수 플래너 ── */
        .planner-card { display: flex; gap: 20px; align-items: flex-start; }
        .planner-photo { width: 240px; height: 300px; border-radius: 10px; overflow: hidden; flex-shrink: 0; background: var(--bg-light); border: 1px solid var(--border); }
        .planner-photo img { width: 100%; height: 100%; object-fit: cover; }
        @media (max-width: 560px) { .planner-photo { width: 44vw; height: calc(44vw * 1.25); } }
        .planner-info {
            flex: 1;
            padding-top: 10px;
            display: flex;
            flex-direction: column;
            height: 300px;
        }
        @media (max-width: 560px) { .planner-info { height: calc(44vw * 1.25); } }
        .planner-name { font-size: 22px; font-weight: 700; margin-bottom: 14px; letter-spacing: 4px; }
        .planner-quote { font-size: 16px; color: var(--text-mid); line-height: 1.6; flex: 1; }
        .planner-btns { display: flex; gap: 10px; margin-top: auto; }
        .btn-outline { flex: 1; text-align: center; padding: 10px 0; border-radius: 6px; border: 1px solid var(--border); font-size: 14px; font-weight: 600; color: var(--text-dark); }
        .btn-solid { flex: 1; text-align: center; padding: 10px 0; border-radius: 6px; background: var(--blue); font-size: 14px; font-weight: 600; color: white; }

        /* ── 교육정보 ── */
        .edu-scroll { display: flex; overflow-x: auto; padding-bottom: 4px; scrollbar-width: none; scroll-snap-type: x mandatory; }
        .edu-scroll::-webkit-scrollbar { display: none; }
        .edu-card { min-width: 100%; border-radius: 10px; overflow: hidden; border: 1px solid var(--border); flex-shrink: 0; scroll-snap-align: start; }
        .edu-thumb { width: 100%; height: 160px; background: var(--bg-light); }
        .edu-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .edu-body { padding: 12px 14px; }
        .edu-title { font-size: 16px; font-weight: 700; margin-bottom: 4px; }
        .edu-desc { font-size: 14px; color: var(--text-gray); }
        .edu-dots { display: flex; justify-content: center; gap: 6px; margin-top: 14px; }
        .edu-dots span { width: 8px; height: 8px; border-radius: 50%; background: var(--border); cursor: pointer; }
        .edu-dots span.active { background: var(--blue); }

        /* ── 푸터 ── */
        .m-footer { background: #f5f5f5; padding: 24px 16px 30px; }
        .m-footer-info { font-size: 12px; line-height: 1.9; color: var(--text-gray); margin-bottom: 12px; }
        .m-footer-copy { font-size: 11px; color: var(--text-gray); margin-bottom: 16px; }
        .m-footer-sns { display: flex; gap: 8px; flex-wrap: wrap; }
        .m-footer-sns a img { width: 34px; height: 34px; border-radius: 50%; object-fit: cover; }
    </style>
</head>
<body>
<div class="pc-wrap">

    <!-- ── 왼쪽 패널 ── -->
    <div class="left-panel">
        <div class="left-logo">
            <img src="logo.png" alt="한국평생교육센터 KLLE" width="286" height="60" />
        </div>
        <div class="left-tagline">어렵고 복잡한 학점은행제<br>시작부터 목표 달성까지!</div>
        <div class="left-title">신뢰할 수 있는 파트너</div>
        <div class="left-title-blue">한국평생교육센터</div>
        <div class="left-stats">
            <div class="stat-col">
                <div class="stat-num" data-target="26321" data-suffix="">0</div>
                <div class="stat-label">누적 상담신청</div>
            </div>
            <div class="stat-col">
                <div class="stat-num" data-target="98" data-suffix="%">0%</div>
                <div class="stat-label">목적 달성률</div>
            </div>
            <div class="stat-col">
                <div class="stat-num" data-target="102395" data-suffix="">0</div>
                <div class="stat-label">누적 학습자</div>
            </div>
        </div>
        <div class="left-sns">
            <a href="#"><img src="<?= base_url('images/banner/main_kakao.png') ?>" alt="카카오" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
            <a href="#"><img src="<?= base_url('images/banner/main_naver.png') ?>" alt="네이버" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
            <a href="#"><img src="<?= base_url('images/banner/main_bolt.png') ?>" alt="볼트" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
            <a href="#"><img src="<?= base_url('images/banner/main_carrot.png') ?>" alt="당근" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
            <a href="#"><img src="<?= base_url('images/banner/main_insta.png') ?>" alt="인스타그램" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
            <a href="#"><img src="<?= base_url('images/banner/main_youtube.png') ?>" alt="유튜브" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
            <a href="#"><img src="<?= base_url('images/banner/main_tictok.png') ?>" alt="틱톡" width="34" height="34" style="border-radius:50%;object-fit:cover;" /></a>
        </div>
    </div>

    <!-- ── 오른쪽 패널 ── -->
    <div class="right-panel">

        <!-- 헤더 -->
        <div class="m-header">
            <div class="m-header-inner">
                <div class="m-logo">
                    <div class="m-logo-ring"></div>
                    <div class="m-logo-txt">
                        <div class="ko">한국평생교육센터</div>
                        <div class="en">KLLE &nbsp; Lifelong Education Center</div>
                    </div>
                </div>
                <nav class="m-nav">
                    <a href="#" class="active">홈</a>
                    <a href="#">학점은행제</a>
                    <a href="#">교육과정</a>
                    <a href="#">후기</a>
                    <a href="#">플래너</a>
                </nav>
            </div>
        </div>

        <!-- 히어로 배너 -->
        <div class="m-hero" id="heroSlider">
            <div class="hero-slide active" style="background:linear-gradient(to bottom,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.05) 40%,rgba(0,0,0,0.35) 100%),url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80') center/cover no-repeat;">
                <div class="m-hero-content">
                    <div class="m-hero-title">신뢰할 수 있는<br>평생교육 파트너</div>
                    <div class="m-hero-desc">평생교육을 바로 알고, 학습자를 위해 진심으로 일하는 전문가<br>우리는 한국평생교육관리센터 입니다.</div>
                </div>
            </div>
            <div class="hero-slide" style="background:linear-gradient(to bottom,rgba(0,0,0,0.15) 0%,rgba(0,0,0,0.05) 40%,rgba(0,0,0,0.4) 100%),url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&q=80') center/cover no-repeat;">
                <div class="m-hero-content">
                    <div class="m-hero-title">학점은행제<br>전문 상담센터</div>
                    <div class="m-hero-desc">목표 달성을 위한 체계적인 커리큘럼<br>전문 플래너와 함께 시작하세요.</div>
                </div>
            </div>
            <div class="hero-slide" style="background:linear-gradient(to bottom,rgba(0,0,0,0.15) 0%,rgba(0,0,0,0.05) 40%,rgba(0,0,0,0.4) 100%),url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&q=80') center/cover no-repeat;">
                <div class="m-hero-content">
                    <div class="m-hero-title">누적 학습자<br>102,395명</div>
                    <div class="m-hero-desc">98% 목적 달성률, 26,321건 누적 상담<br>검증된 교육 파트너를 만나보세요.</div>
                </div>
            </div>
        </div>
        <div class="m-hero-dots" id="heroDots">
            <span class="active"></span><span></span><span></span>
        </div>

        <!-- 퀵바 -->
        <div class="m-qbar">
            <div class="m-qbar-row1">
                <div class="rolling-wrap">
                    <div class="rolling-list" id="rollingList">
                        <div class="rolling-item"><span class="m-chip">대기</span><span class="m-chip-divider">|</span><span class="m-chip-name">이*진</span><span class="m-chip-divider">|</span><span class="m-chip-qual">정사서 2급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-07</span></div>
                        <div class="rolling-item"><span class="m-chip">완료</span><span class="m-chip-divider">|</span><span class="m-chip-name">김*수</span><span class="m-chip-divider">|</span><span class="m-chip-qual">사회복지사 1급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-06</span></div>
                        <div class="rolling-item"><span class="m-chip">진행</span><span class="m-chip-divider">|</span><span class="m-chip-name">박*영</span><span class="m-chip-divider">|</span><span class="m-chip-qual">보육교사 2급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-05</span></div>
                        <div class="rolling-item"><span class="m-chip">완료</span><span class="m-chip-divider">|</span><span class="m-chip-name">최*희</span><span class="m-chip-divider">|</span><span class="m-chip-qual">학사학위 취득</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-04</span></div>
                        <div class="rolling-item"><span class="m-chip">대기</span><span class="m-chip-divider">|</span><span class="m-chip-name">정*민</span><span class="m-chip-divider">|</span><span class="m-chip-qual">평생교육사 2급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-03</span></div>
                        <div class="rolling-item"><span class="m-chip">완료</span><span class="m-chip-divider">|</span><span class="m-chip-name">윤*호</span><span class="m-chip-divider">|</span><span class="m-chip-qual">사회복지사 2급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-02</span></div>
                        <div class="rolling-item"><span class="m-chip">진행</span><span class="m-chip-divider">|</span><span class="m-chip-name">강*연</span><span class="m-chip-divider">|</span><span class="m-chip-qual">보육교사 1급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-02-01</span></div>
                        <div class="rolling-item"><span class="m-chip">완료</span><span class="m-chip-divider">|</span><span class="m-chip-name">오*준</span><span class="m-chip-divider">|</span><span class="m-chip-qual">학점은행제 학사</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-01-31</span></div>
                        <div class="rolling-item"><span class="m-chip">대기</span><span class="m-chip-divider">|</span><span class="m-chip-name">임*서</span><span class="m-chip-divider">|</span><span class="m-chip-qual">정사서 1급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-01-30</span></div>
                        <div class="rolling-item"><span class="m-chip">완료</span><span class="m-chip-divider">|</span><span class="m-chip-name">한*나</span><span class="m-chip-divider">|</span><span class="m-chip-qual">사회복지사 1급</span><span class="m-chip-divider">|</span><span class="m-chip-date">2025-01-29</span></div>
                    </div>
                </div>
            </div>
            <div class="m-qbar-row2">
                <div class="m-contact-icons">
                    <div class="m-ci">
                        <img src="<?= base_url('images/banner/main_naver.png') ?>" alt="네이버" class="m-ci-img" />
                        <div class="m-ci-txt">네이버 예약 상담</div>
                    </div>
                    <div class="m-ci">
                        <img src="<?= base_url('images/banner/main_kakao.png') ?>" alt="카카오" class="m-ci-img" />
                        <div class="m-ci-txt">1:1 카카오톡 상담</div>
                    </div>
                </div>
                <div class="m-phone">
                    <div class="m-phone-num">
                        <i class="fa-solid fa-phone"></i> 02-2295-2616
                    </div>
                    <div class="m-phone-sub">
                        <img src="<?= base_url('images/banner/timer.png') ?>" alt="시간" width="14" height="14" style="vertical-align:middle;margin-right:4px;" />
                        평일 10 ~ 19시 / 점심 13 ~ 14시 (주말·공휴일 휴무)
                    </div>
                </div>
            </div>
        </div>

        <!-- 자주 찾는 메뉴 -->
        <div class="m-section">
            <div class="m-sec-header">
                <div class="m-sec-title">자주 찾는 메뉴</div>
            </div>
            <div class="m-qmenu-grid">
                <div class="m-qmenu-item">
                    <div class="m-qmenu-icon"><img src="<?= base_url('images/banner/favorite_banner1.png') ?>" alt="교육과정" class="m-qmenu-img" /></div>
                    <div class="m-qmenu-label">교육과정</div>
                </div>
                <div class="m-qmenu-item">
                    <div class="m-qmenu-icon"><img src="<?= base_url('images/banner/favorite_banner2.png') ?>" alt="학습자후기" class="m-qmenu-img" /></div>
                    <div class="m-qmenu-label">학습자후기</div>
                </div>
                <div class="m-qmenu-item">
                    <div class="m-qmenu-icon"><img src="<?= base_url('images/banner/favorite_banner3.png') ?>" alt="플래너" class="m-qmenu-img" /></div>
                    <div class="m-qmenu-label">플래너</div>
                </div>
            </div>
        </div>
        <div class="m-divider"></div>

        <!-- 알림사항 -->
        <div class="m-section">
            <div class="m-sec-header">
                <div>
                    <div class="m-sec-title">알림사항</div>
                    <div class="m-notice-label">한국평생교육센터의 알림 소식</div>
                </div>
                <a href="#" class="m-sec-more">더보기 →</a>
            </div>
            <ul class="m-notice-list">
                <li class="m-notice-item">
                    <span class="m-nbadge nb-hot">중요</span>
                    <span class="m-notice-text">학점은행제 관련 사설 학습플래너 이용 주의</span>
                    <span class="m-notice-arrow">›</span>
                </li>
                <li class="m-notice-item">
                    <span class="m-nbadge nb-new">공고</span>
                    <span class="m-notice-text">2026년 학점은행제 학습자 등록 및 각종 신청 접...</span>
                    <span class="m-notice-arrow">›</span>
                </li>
                <li class="m-notice-item">
                    <span class="m-nbadge nb-new">공고</span>
                    <span class="m-notice-text">2026년도 제 24회 사회복지사 1급 국가 시험 시...</span>
                    <span class="m-notice-arrow">›</span>
                </li>
            </ul>
        </div>
        <div class="m-divider"></div>

        <!-- 학습자 후기 -->
        <div class="m-section">
            <div class="m-sec-header">
                <div>
                    <div class="m-sec-title">학습자 후기</div>
                    <div class="m-notice-label">실제 학습자의 후기 모음</div>
                </div>
                <a href="#" class="m-sec-more">자세히보기 →</a>
            </div>
            <div class="review-slider-wrap">
                <div class="review-slider" id="reviewSlider">
                    <div class="review-slide">
                        <div class="review-img-wrap">
                            <img src="<?= base_url('images/review/review1.jpg') ?>" alt="후기1" />
                            <span class="review-tag">사회복지사</span>
                        </div>
                        <div class="review-stars">❤️❤️❤️❤️❤️ <span>4.5</span></div>
                        <div class="review-name">🎓 조용현 학습자님</div>
                        <div class="review-text">우선 끝까지 침착하게 친절히 응대해주셔서 저도 잘 모르는 분야인 학은제를 잘 끝냈다고 생각해요...</div>
                    </div>
                    <div class="review-slide">
                        <div class="review-img-wrap">
                            <img src="<?= base_url('images/review/review2.jpg') ?>" alt="후기2" />
                            <span class="review-tag">학점은행제</span>
                        </div>
                        <div class="review-stars">❤️❤️❤️❤️❤️ <span>4.5</span></div>
                        <div class="review-name">🎓 김현진 학습자님</div>
                        <div class="review-text">팀장님 덕분에 자주~~~ 혼자서 했으면 정말 힘들었을 것 같아요. 감사합니다...</div>
                    </div>
                    <div class="review-slide">
                        <div class="review-img-wrap">
                            <img src="<?= base_url('images/review/review3.jpg') ?>" alt="후기3" />
                            <span class="review-tag">보육교사</span>
                        </div>
                        <div class="review-stars">❤️❤️❤️❤️❤️ <span>5.0</span></div>
                        <div class="review-name">🎓 박지현 학습자님</div>
                        <div class="review-text">체계적인 커리큘럼 덕분에 단기간에 목표를 달성할 수 있었어요. 정말 감사합니다...</div>
                    </div>
                </div>
            </div>
            <div class="review-dots" id="reviewDots">
                <span class="active"></span><span></span><span></span>
            </div>
        </div>
        <div class="m-divider"></div>

        <!-- 이달의 우수 플래너 -->
        <div class="m-section">
            <div style="text-align:center; margin-bottom:20px;">
                <div class="m-sec-title">이달의 우수 플래너 🥇</div>
                <div class="m-notice-label">가나라다라</div>
            </div>
            <div class="planner-card">
                <div class="planner-photo">
                    <img src="<?= base_url('images/banner/planner.jpg') ?>" alt="플래너 사진" />
                </div>
                <div class="planner-info">
                    <div class="planner-name">이 &nbsp; 름</div>
                    <div class="planner-quote">"나를 어필하는 한마디"</div>
                    <div class="planner-btns">
                        <a href="#" class="btn-outline">자세히 보기</a>
                        <a href="#" class="btn-solid">상담하기</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-divider"></div>

        <!-- 교육정보 -->
        <div class="m-section">
            <div class="m-sec-header">
                <div>
                    <div class="m-sec-title">교육정보</div>
                    <div class="m-notice-label">센터 인증! 전문가가 알려주는 교육정보</div>
                </div>
                <a href="#" class="m-sec-more">자세히보기 →</a>
            </div>
            <div class="edu-scroll">
                <div class="edu-card">
                    <div class="edu-thumb"><img src="<?= base_url('images/edu/edu1.jpg') ?>" alt="교육1" /></div>
                    <div class="edu-body"><div class="edu-title">칼럼 제목</div><div class="edu-desc">칼럼 내용 한 줄</div></div>
                </div>
                <div class="edu-card">
                    <div class="edu-thumb"><img src="<?= base_url('images/edu/edu2.jpg') ?>" alt="교육2" /></div>
                    <div class="edu-body"><div class="edu-title">칼럼 제목</div><div class="edu-desc">칼럼 내용 한 줄</div></div>
                </div>
                <div class="edu-card">
                    <div class="edu-thumb"><img src="<?= base_url('images/edu/edu3.jpg') ?>" alt="교육3" /></div>
                    <div class="edu-body"><div class="edu-title">칼럼 제목</div><div class="edu-desc">칼럼 내용 한 줄</div></div>
                </div>
            </div>
            <div class="edu-dots">
                <span class="active"></span><span></span><span></span>
            </div>
        </div>
        <div class="m-divider"></div>

        <!-- 푸터 -->
        <div class="m-footer">
            <div class="m-footer-info">
                (주)한국평생교육관리센터 | 대표: 이준희<br>
                사업자등록번호: 778-10-02605<br>
                주소: 서울 성동구 성수일로4길 25 서울숲코오롱디지털타워 20층<br><br>
                대표전화: 02-2295-2616<br>
                개인정보관리책임자: 이준희 (kileseongsu@gmail.com)
            </div>
            <div class="m-footer-copy">Copyright © Korea Lifelong Edu management center. ALL Rights Reserved.</div>
            <div class="m-footer-sns">
                <a href="#"><img src="<?= base_url('images/banner/main_kakao.png') ?>" alt="카카오" /></a>
                <a href="#"><img src="<?= base_url('images/banner/main_naver.png') ?>" alt="네이버" /></a>
                <a href="#"><img src="<?= base_url('images/banner/main_bolt.png') ?>" alt="볼트" /></a>
                <a href="#"><img src="<?= base_url('images/banner/main_carrot.png') ?>" alt="당근" /></a>
                <a href="#"><img src="<?= base_url('images/banner/main_insta.png') ?>" alt="인스타" /></a>
                <a href="#"><img src="<?= base_url('images/banner/main_youtube.png') ?>" alt="유튜브" /></a>
                <a href="#"><img src="<?= base_url('images/banner/main_tictok.png') ?>" alt="틱톡" /></a>
            </div>
        </div>

    </div>
</div>

<script>
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

    // IntersectionObserver로 화면에 보일 때 시작
    const statNums = document.querySelectorAll('.stat-num[data-target]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                countUp(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    statNums.forEach(el => observer.observe(el));
    const rollingList = document.getElementById('rollingList');
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

    // ── 히어로 슬라이더 ──
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('#heroDots span');
    let heroCurrent = 0;
    function updateHero() {
        heroSlides.forEach((s, i) => s.classList.toggle('active', i === heroCurrent));
        heroDots.forEach((d, i) => d.classList.toggle('active', i === heroCurrent));
    }
    heroDots.forEach((d, i) => d.addEventListener('click', () => { heroCurrent = i; updateHero(); }));
    setInterval(() => { heroCurrent = (heroCurrent + 1) % heroSlides.length; updateHero(); }, 4000);

    // ── 학습자 후기 슬라이더 ──
    const reviewSlides = document.querySelectorAll('.review-slide');
    const reviewDots = document.querySelectorAll('#reviewDots span');
    let reviewCurrent = 0;
    function updateReview() {
        reviewSlides.forEach((s, i) => {
            s.classList.remove('active', 'prev', 'next');
            if (i === reviewCurrent) s.classList.add('active');
            else if (i === (reviewCurrent - 1 + reviewSlides.length) % reviewSlides.length) s.classList.add('prev');
            else s.classList.add('next');
        });
        reviewDots.forEach((d, i) => d.classList.toggle('active', i === reviewCurrent));
    }
    reviewDots.forEach((d, i) => d.addEventListener('click', () => { reviewCurrent = i; updateReview(); }));
    setInterval(() => { reviewCurrent = (reviewCurrent + 1) % reviewSlides.length; updateReview(); }, 3500);
    updateReview();

    // ── 교육정보 슬라이더 ──
    const eduScroll = document.querySelector('.edu-scroll');
    const eduDots = document.querySelectorAll('.edu-dots span');
    let eduCurrent = 0;
    function updateEdu(idx) {
        eduCurrent = idx;
        eduScroll.scrollTo({ left: eduScroll.offsetWidth * idx, behavior: 'smooth' });
        eduDots.forEach((d, i) => d.classList.toggle('active', i === idx));
    }
    eduDots.forEach((d, i) => d.addEventListener('click', () => updateEdu(i)));
    eduScroll.addEventListener('scroll', () => {
        const idx = Math.round(eduScroll.scrollLeft / eduScroll.offsetWidth);
        eduDots.forEach((d, i) => d.classList.toggle('active', i === idx));
    });
    setInterval(() => { updateEdu((eduCurrent + 1) % eduDots.length); }, 4000);
</script>
</body>
</html>