<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* 전체 기본 설정 */
        body {
            margin: 0;
            padding: 0;
            font-family: "Noto Sans KR", sans-serif;
            background: #ffffff;
        }

        /* 공통 레이아웃 wrapper */
        .layout-container {
            width: 1290px;
            margin: 0 auto; /* 가운데 정렬 핵심 */
        }
        .header-top {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height:57px;
            border-bottom: solid 1px #D9D9D9;
        }

        .edu-badge {
            display: flex;
            align-items: center;
            text-align:left;
            font-size: 12px;
        }

        .edu-badge_text {
            margin-left: 8px;
            line-height: 1.3;
            text-align:left;
        }

        .edu-badge_line {
            font-weight: 500;
        }

        .header {
            height:85px;
            align-items: center;
        }

        .header-inner {
            width: 1290px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;

        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding:0 70px;
            flex: 0 0 auto;
        }

        .gnb {
            flex: 1;
        }
        .gnb ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            width:85%;
        }

        .gnb ul li {
            position: relative;

        }

        .gnb a {
            font-family: Pretendard, sans-serif;
            font-size: 17px;
            font-weight: 600;
            color: #222;
            text-decoration: none;
        }

        /* 뱃지 스타일 */
        .badge {
            position: absolute;
            top: -22px;
            left: 50%;
            transform: translateX(-50%);
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            border-radius: 20px;
            white-space: nowrap;

            animation: badgeBounce 1.8s ease-in-out infinite;
        }

        .badge.red {
            background: #ff3b30;
        }

        .badge.purple {
            background: #6c44ff;
        }


        .search-wrap {
            width: 100%;
            text-align: center;
            margin-top: 50px;
            font-family: "Pretendard", sans-serif;
        }

        /* 검색 박스 */
        .search-box {
            width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 40px;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            box-shadow: 0px 4px 14px rgba(0,0,0,0.07);
            position: relative;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 14px 20px;
            font-size: 17px;
            color: #444;
        }

        .search-box input::placeholder {
            color: #b8b8b8;
        }

        .btn-search {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            border: none;
            box-shadow: 0px 3px 7px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-search img {
            width: 22px;
            height: auto;
        }

        /* 인기 검색어 */
        .popular-search {
            margin-top: 18px;
            font-size: 15px;
            color: #222;
        }

        .popular-search .title {
            font-weight: 600;
            margin-right: 8px;
        }

        .popular-search .tags {
            display: inline-block;
        }

        .popular-search .tags a {
            color: #8a8a8a;
            margin: 0 6px;
            text-decoration: none;
            font-size: 15px;
        }

        @keyframes badgeBounce {
            0%   { transform: translateX(-50%) translateY(0); }
            50%  { transform: translateX(-50%) translateY(-6px); }
            100% { transform: translateX(-50%) translateY(0); }
        }
    </style>
</head>
<body>
<header>
    <div class="layout-container">
        <div class="header-top">
            <div class="edu-badge">
                <img src="/images/korea_mark.png" alt="교육부 로고">
                <div class="edu-badge_text">
                    <div class="edu-badge_line">교육부 평가 인정</div>
                    <div class="edu-badge_line">교육기관 소속 학습 설계·상담·관리 센터</div>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-inner">
                <div class="logo-box"><img src="/images/logo.jpg" alt="한국평생교육관리센터 KLLE"></div>
                <!-- 메뉴 -->
                <nav class="gnb">
                    <ul>
                        <li><a href="#">센터소개</a></li>
                        <li class="with-badge">
                            <a href="#">교육과정</a>
                            <span class="badge red">수강료 장학혜택 제공</span>
                        </li>
                        <li class="with-badge">
                            <a href="#">학습자 후기</a>
                            <span class="badge purple">생생한 이벤트 진행중!</span>
                        </li>
                        <li><a href="#">알림·소식</a></li>
                        <li><a href="#">정보마당</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="mainBanner">
            <img src="images/main_banner.png" />
        </div>
        <div class="search-wrap">
            <div class="search-box">
                <input type="text" placeholder="궁금한 내용을 입력해 주세요.">
                <button class="btn-search">
                    <img src="images/search_btn.png" alt="검색">
                </button>
            </div>

            <div class="popular-search">
                <span class="title">인기 검색어 👀</span>
                <div class="tags">
                    <a href="#">#정사서 2급</a>
                    <a href="#">#사회복지사 2급</a>
                    <a href="#">#대학교 편입</a>
                    <a href="#">#보육교사 2급</a>
                    <a href="#">#상담심리교육대학원 진학</a>
                    <a href="#">#수능</a>
                </div>
            </div>
        </div>

    </div>
</header>

</body>
</html>