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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        var KAKAO_KEY  = '<?= KAKAO_MAP_KEY ?>';
        var CENTER_LAT = <?= CENTER_LAT ?>;
        var CENTER_LNG = <?= CENTER_LNG ?>;
    </script>
<?= $this->endSection() ?>