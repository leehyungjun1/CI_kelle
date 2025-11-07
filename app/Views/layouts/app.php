<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>한국평생교육관리센터</title>
    <link rel="stylesheet" href="<?= base_url('/css/style.css') ?>">
</head>
<body>

<header class="header">
    <div class="container">
        <h1 class="logo">한국평생교육관리센터</h1>
        <nav class="nav">
            <ul>
                <li><a href="<?= base_url('about') ?>">센터소개</a></li>
                <li><a href="<?= base_url('education') ?>">교육과정</a></li>
                <li><a href="<?= base_url('/') ?>">학습자 후기</a></li>
                <li><a href="<?= base_url('news') ?>">알림·소식</a></li>
                <li><a href="<?= base_url('contact') ?>">정보마당</a></li>
            </ul>
        </nav>
    </div>
</header>

<?= $this->renderSection('content') ?>

<script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>