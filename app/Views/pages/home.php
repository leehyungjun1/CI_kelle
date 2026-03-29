<?= $this->extend('layout/front/main') ?>

<?= $this->section('title') ?>홈 - 한국평생교육센터 KLLE<?= $this->endSection() ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <!-- 히어로 배너 -->
    <div class="m-hero" id="heroSlider">
        <?php if (!empty($banners)): ?>
            <?php foreach ($banners as $i => $banner): ?>
                <div class="hero-slide <?= $i === 0 ? 'active' : '' ?>"
                     style="background: linear-gradient(to bottom,
                             rgba(0,0,0,0.1) 0%,
                             rgba(0,0,0,0.05) 40%,
                             rgba(0,0,0,0.35) 100%),
                             url('<?= base_url($banner['image_path']) ?>') center/cover no-repeat;">
                    <div class="m-hero-content">
                        <div class="m-hero-title"><?= nl2br($banner['title']) ?></div>
                        <?php if (!empty($banner['description'])): ?>
                            <div class="m-hero-desc"><?= nl2br(esc($banner['description'])) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- 배너 없을 때 기본 슬라이드 -->
            <div class="hero-slide active"
                 style="background: linear-gradient(to bottom,rgba(0,0,0,0.1) 0%,rgba(0,0,0,0.35) 100%), #1A56C4;">
                <div class="m-hero-content">
                    <div class="m-hero-title">한국평생교육센터</div>
                    <div class="m-hero-desc">신뢰할 수 있는 평생교육 파트너</div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- 히어로 dots -->
    <div class="m-hero-dots" id="heroDots">
        <?php
        $dotCount = !empty($banners) ? count($banners) : 1;
        for ($i = 0; $i < $dotCount; $i++):
            ?>
            <span class="<?= $i === 0 ? 'active' : '' ?>"></span>
        <?php endfor; ?>
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
            <?php if (!empty($notices)): ?>
                <?php foreach ($notices as $notice): ?>
                    <li class="m-notice-item">
                        <?php
                        $headerId = $notice['header_id'] ?? null;
                        $header   = $noticeHeadersMap[$headerId] ?? null;
                        ?>
                        <?php if ($header): ?>
                            <span class="m-nbadge" style="
                                    background: <?= esc($header['badge_color']) ?>;
                                    color: <?= esc($header['text_color']) ?>;
                                    border: 1px solid <?= esc($header['badge_color']) ?>;
                                    "><?= esc($header['header_name']) ?></span>
                        <?php else: ?>
                            <span class="m-nbadge nb-new">공고</span>
                        <?php endif; ?>
                        <span class="m-notice-text"><?= esc($notice['title']) ?></span>
                        <span class="m-notice-arrow">›</span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="m-notice-item">
                    <span class="m-notice-text">등록된 알림사항이 없습니다.</span>
                </li>
            <?php endif; ?>
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
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $i => $review): ?>
                        <div class="review-slide <?= $i === 0 ? 'active' : '' ?>">
                            <div class="review-img-wrap">
                                <img src="<?= !empty($review['file_path'])
                                    ? base_url($review['file_path'])
                                    : base_url('images/review/default.jpg') ?>" alt="후기">
                                <?php
                                $headerId = $review['header_id'] ?? null;
                                $header   = $reviewHeadersMap[$headerId] ?? null;
                                ?>
                                <?php if ($header): ?>
                                    <span class="review-tag" style="
                                            background: <?= esc($header['badge_color']) ?>;
                                            color: <?= esc($header['text_color'] ?? '#ffffff') ?>;
                                            "><?= esc($header['header_name']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="review-stars">
                                <?php
                                $rating = (int)($review['rating'] ?? 0);
                                echo str_repeat('❤️', min($rating, 5));
                                ?>
                                <span><?= $rating ?></span>
                            </div>
                            <div class="review-name"><?= esc($review['writer'] ?? '학습자') ?>님</div>
                            <div class="review-text"><?= purify($review['content'] ?? '') ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="review-slide active">
                        <div class="review-text" style="text-align:center; padding:40px 0;">
                            등록된 후기가 없습니다.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="review-dots" id="reviewDots">
            <?php
            $reviewCount = !empty($reviews) ? count($reviews) : 1;
            for ($i = 0; $i < $reviewCount; $i++):
                ?>
                <span class="<?= $i === 0 ? 'active' : '' ?>"></span>
            <?php endfor; ?>
        </div>
    </div>
    <div class="m-divider"></div>

    <!-- 이달의 우수 플래너 -->
    <div class="m-section">
        <div style="text-align:center; margin-bottom:20px;">
            <div class="m-sec-title">이달의 우수 플래너 🥇</div>
            <div class="m-notice-label"><?= esc($planers['title'] ?? '') ?></div>
        </div>
        <div class="planner-card">
            <div class="planner-photo">
                <img src="<?= !empty($planers['profile_path'])
                    ? base_url($planers['profile_path'])
                    : base_url('images/banner/planner.jpg') ?>" alt="플래너 사진">
            </div>
            <div class="planner-info">
                <div class="planner-name"><?= esc($planers['name'] ?? '') ?></div>
                <div class="planner-quote"><?= nl2br($planers['relations'] ?? '') ?></div>
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

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>