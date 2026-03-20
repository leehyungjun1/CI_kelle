<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? '한국평생교육센터 KLLE' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('css/common.css') ?>" />
    <?= $css ?? '' ?>
</head>
<body>
<div class="pc-wrap">

    <!-- ── 왼쪽 패널 (공통) ── -->
    <?= view('layout/front/left_panel') ?>

    <!-- ── 오른쪽 패널 ── -->
    <div class="right-panel">

        <!-- 공통 헤더 -->
        <?= view('layout/font/header', ['active' => $active ?? 'home']) ?>

        <!-- 페이지별 콘텐츠 -->
        <?= $content ?>

    </div>
</div>

<!-- 공통 JS -->
<script src="<?= base_url('js/common.js') ?>"></script>
<?= $js ?? '' ?>
</body>
</html>