<?= $this->extend('layout/front/main') ?>

<?= $this->section('title') ?>홈 - 한국평생교육센터 KLLE<?= $this->endSection() ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

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

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>