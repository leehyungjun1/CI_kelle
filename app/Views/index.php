<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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

        /* 헤더 영역 */
        header {
            width: 100%;
            border-bottom: 1px solid #e6e6e6;
            background: #ffffff;
        }

        .header-inner {
            width: 1290px;
            height: 110px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* 오른쪽 검증 로고 영역 */
        .moe-right {
            text-align: right;
            font-size: 12px;
            color: #444;
            line-height: 1.4;
        }

        /* 간단한 메뉴 */
        nav {
            display: flex;
            gap: 70px;
            font-size: 16px;
            font-weight: 700;
        }
        nav span {
            font-family: "Pretendard", sans-serif;
            font-weight: 700;
            font-size: 14px;
        }


        nav a {
            text-decoration: none;
            color: #222;
        }

        nav a:hover {
            color: #005aff;
        }

        /* 콘텐츠 (임시) */
        .content {
            padding: 20px 0;
            min-height: 400px;
            background: #f9fafb;
        }
    </style>


</head>
<body>
<header>
    <div class="header-inner">
        <div class="left-area">
            <img src="/img/klle-logo.png" alt="KLLE 로고" height="60">
        </div>

        <nav>
            <span><a href="#">센터소개</a></span>
            <span><a href="#">교육과정</a></span>
            <span><a href="#">학습자 후기</a></span>
            <span><a href="#">알림·소식</a></span>
            <span><a href="#">정보마당</a></span>
        </nav>

        <div class="moe-right">
            <img src="/img/moe-logo.png" alt="교육부 로고" height="52"><br>
            교육부 평가 인증<br>교육기관 소속 학습 설계·상담·관리 센터
        </div>
    </div>
</header>

</body>
</html>