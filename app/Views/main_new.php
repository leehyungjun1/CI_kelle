<?= $this->include('layouts/header') ?>

<script src="<?= base_url('js/main_new.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('css/main.css') ?>">

<div class="container">
    <div class="main-visual-wrap">
        <!-- 메인 배너 -->
        <div id="mainTopBanner" class="swiper mainTopBanner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a class="item switch_item" href="#"><img src="/images/banner/banner1.jpg" alt="배너1"></a>
                </div>
                <div class="swiper-slide">
                    <a class="item switch_item" href="#"><img src="/images/banner/banner2.jpg" alt="배너2"></a>
                </div>
                <div class="swiper-slide">
                    <a class="item switch_item" href="#"><img src="/images/banner/banner3.jpg" alt="배너3"></a>
                </div>
            </div>

            <div class="swiper-button-next main-next"></div>
            <div class="swiper-button-prev main-prev"></div>
        </div>

        <div class="top-course-box">
            <div class="top-course-header">
                <span class="top-badge">TOP 5</span>
                <div class="header-row">
                    <strong class="title">
                        <span class="popular">인기</span> 교육 과정 🚀
                    </strong>
                    <span class="date">2025. 10. 17 기준</span>
                </div>
                <div class="header-line"></div>
            </div>

            <ul class="top-course-list">
                <li>
                    <span class="rank">1</span>
                    <span class="name"><i class="arrow up"></i>정사서 2급</span>
                    <a href="#" class="link">자세히보기 > </a>
                </li>
                <li>
                    <span class="rank red">2</span>
                    <span class="name"><i class="arrow down"></i>사회복지사 2급</span>
                    <a href="#" class="link">자세히보기 > </a>
                </li>
                <li>
                    <span class="rank blue">3</span>
                    <span class="name"><i class="arrow down"></i>대학교 편입</span>
                    <a href="#" class="link">자세히보기 > </a>
                </li>
                <li>
                    <span class="rank red">4</span>
                    <span class="name"><i class="arrow up"></i>보육교사 2급</span>
                    <a href="#" class="link">자세히보기 > </a>
                </li>
                <li>
                    <span class="rank gray">5</span>
                    <span class="name"><i class="arrow up"></i>상담심리교육대학원 진학</span>
                    <a href="#" class="link">자세히보기 > </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <hr class="dotted-line">

        <section class="consult-wrap">
            <div class="consult-inner">
                <!-- 왼쪽: 상담현황 테이블 -->
                <div class="consult-left">
                    <div class="consult-header">
                        <div class="consult-title">
                            <span class="line1">실시간</span>
                            <span class="line2">상담신청 현황 💬</span>
                        </div>

                        <div class="consult-count-box">
                            <div class="consult-count-inner">
                                <div class="count-title">오늘</div>
                                <div class="count-number today">56명</div>
                            </div>
                            <div class="divider"></div>
                            <div class="consult-count-inner">
                                <div class="count-title">누적 학습자</div>
                                <div class="count-number total">26,321명</div>
                            </div>
                        </div>
                    </div>

                    <div class="consult-table-wrap">
                        <table class="consult-table">
                            <thead>
                            <tr>
                                <th>상태</th>
                                <th>성함</th>
                                <th>과정</th>
                                <th>날짜</th>
                            </tr>
                            </thead>
                        </table>

                        <!-- 롤링되는 부분 -->
                        <div class="scroll-box">
                            <div class="scroll-inner">
                                <table class="consult-table">
                                    <tbody>
                                    <tr><td><span class="status wait">대기</span></td><td>이*진</td><td>정사서 2급</td><td>2025-10-17</td></tr>
                                    <tr><td><span class="status wait">대기</span></td><td>김*영</td><td>사회복지사 2급</td><td>2025-10-17</td></tr>
                                    <tr><td><span class="status wait">대기</span></td><td>전*찬</td><td>대학교 편입 상담</td><td>2025-10-17</td></tr>
                                    <tr><td><span class="status done">완료</span></td><td>최*진</td><td>보육교사 2급</td><td>2025-10-17</td></tr>
                                    <tr><td><span class="status done">완료</span></td><td>김*연</td><td>평생교육교사 1급</td><td>2025-10-17</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 오른쪽: 상담문의 -->
                <div class="consult-right">
                    <h3>
                        교육과정<br>
                        <span>상담 문의사항 <img src="/images/icon/icon_tel.png" alt="전화 아이콘">️</span>
                    </h3>
                    <p class="phone">02-2295-2616</p>
                    <p class="desc">평일 10:00~19:00 (점심 13:00~14:00)</p>

                    <ul class="note">
                        <li>* 카톡/예약 상담은 저녁, 주말에도 가능합니다.</li>
                        <li>* 학습설계·상담·관리 등 모든 상담 비용은 일체 없습니다.</li>
                    </ul>

                    <div class="btn-box horizontal">
                        <a href="#" class="btn kakao">
                            <div class="btn-text">
                                <span class="sub">1:1 실시간 채팅 상담</span>
                                <strong class="main">카카오톡 상담</strong>
                            </div>
                            <img src="/images/icon/icon_kakao.png" alt="kakao">
                        </a>

                        <a href="#" class="btn naver">
                            <div class="btn-text">
                                <span class="sub">원하는 날짜/시간 예약 상담</span>
                                <strong class="main">네이버 예약 상담</strong>
                            </div>
                            <img src="/images/icon/icon_naver.png" alt="naver">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="content-story">
    <div class="review-slider-wrap">
        <div class="swiper-button-prev review-prev"></div>
        <div class="swiper myReviewSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="review-card" style="border:solid 1px;">
                        <img src="/images/banner/edu/banner1.jpg" alt="">
                        <div class="review-info">
                            <span class="tag blue">사회복지사 2급</span>
                            <h4>김○영 <span>학습자님</span></h4>
                            <p>상담해주시는 분도 너무 친절하시고 장학지원혜택으로 싸게 교육받을 수 있었어요!</p>
                            <div class="badges">
                                <span>💛 만족해요</span>
                                <span>📚 강의 종류가 다양해요</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="review-card">
                        <img src="/images/banner/edu/banner2.jpg" alt="">
                        <div class="review-info">
                            <span class="tag yellow">바리스타</span>
                            <h4>전○찬 <span>학습자님</span></h4>
                            <p>상담이 빠르고 강의도 체계적으로 구성되어 있었어요!</p>
                            <div class="badges">
                                <span>💛 만족해요</span>
                                <span>😊 추천하고 싶어요</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="review-card">
                        <img src="/images/banner/edu/banner3.jpg" alt="">
                        <div class="review-info">
                            <span class="tag green">보육교사</span>
                            <h4>박○희 <span>학습자님</span></h4>
                            <p>상담부터 수강까지 모두 만족스러웠습니다!</p>
                            <div class="badges">
                                <span>💛 만족해요</span>
                                <span>📚 강의가 다양해요</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="review-card">
                        <img src="/images/banner/edu/banner4.jpg" alt="">
                        <div class="review-info">
                            <span class="tag green">보육교사</span>
                            <h4>박○희 <span>학습자님</span></h4>
                            <p>상담부터 수강까지 모두 만족스러웠습니다!</p>
                            <div class="badges">
                                <span>💛 만족해요</span>
                                <span>📚 강의가 다양해요</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="review-card">
                        <img src="/images/banner/edu/banner5.jpg" alt="">
                        <div class="review-info">
                            <span class="tag green">보육교사</span>
                            <h4>박○희 <span>학습자님</span></h4>
                            <p>상담부터 수강까지 모두 만족스러웠습니다!</p>
                            <div class="badges">
                                <span>💛 만족해요</span>
                                <span>📚 강의가 다양해요</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 필요하면 더 추가 -->
            </div>
        </div>
        <div class="swiper-button-next review-next"></div>
    </div>
</div>
<div>
    <section class="social-hub">
        <div class="social-hub__inner">
            <div class="social-hub__title">
                <h3>한국평생교육관리센터 <span class="emoji">🎓</span></h3>
                <p>소통 창구를 한눈에!</p>
            </div>

            <div class="social-hub__divider" aria-hidden="true"></div>

            <ul class="social-hub__list">
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_kakao.jpg" alt="카카오톡 채널"></span><span class="label">카카오톡 채널</span></a></li>
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_naver_cafe.jpg" alt="네이버 카페"></span><span class="label">네이버 카페</span></a></li>
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_naver_blog.jpg" alt="네이버 블로그"></span><span class="label">네이버 블로그</span></a></li>
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_carrot.jpg" alt="당근마켓"></span><span class="label">당근마켓</span></a></li>
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_insta.jpg" alt="인스타"></span><span class="label">인스타</span></a></li>
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_youtube.jpg" alt="유튜브"></span><span class="label">유튜브</span></a></li>
                <li><a href="#"><span class="icon"><img src="/images/icon/icon_tiktok.jpg" alt="틱톡"></span><span class="label">틱톡</span></a></li>
            </ul>
        </div>
    </section>
</div>
<div class="container">
    <section class="notice-partners">
        <div class="notice-box">
            <div class="notice-header">
                <h3>센터 알림사항 📌</h3>
                <a href="#" class="more">더보기 <span>＋</span></a>
            </div>
            <ul class="notice-list">
                <li>
                    <a href="#">한국교육심사평가원 공지 안내</a>
                    <span class="date">2025.12.30</span>
                </li>
                <li>
                    <a href="#">[이벤트] 우수 평생교육 학습사례 공모</a>
                    <span class="date">2025.12.30</span>
                </li>
                <li>
                    <a href="#">[학점은행제] 2023년 2월(전기) 학위신청자</a>
                    <span class="date">2025.12.30</span>
                </li>
                <li>
                    <a href="#">[독학학위제] 2023년 독학사 시험일정</a>
                    <span class="date">2025.12.30</span>
                </li>
                <li>
                    <a href="#">[학점은행제] 교육원 & 불법 대행업체</a>
                    <span class="date">2025.12.30</span>
                </li>
            </ul>
        </div>

        <div class="partners-box">
            <div class="partners-header">
                <h3>함께하는 기관 🏢</h3>
            </div>
            <div class="partners-slider">
                <button class="btn-prev">〈</button>
                <div class="partner-item">
                    <img src="/images/logo-lifelong.png" alt="평생교육이용권 로고" />
                    <h4>한국평생교육관리센터</h4>
                    <p>[독학학위제] 2023년 독학사 시험일정<br>[독학학위제] 2023년 독학사 시험일정</p>
                </div>
                <button class="btn-next">〉</button>
            </div>
        </div>
    </section>
</div>

<?= $this->include('layouts/footer') ?>
