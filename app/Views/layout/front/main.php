<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $this->renderSection('title') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('css/common.css') ?>" />
    <?= $this->renderSection('css') ?>
    <?php
    $pageCssFile = FCPATH . 'css' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $pagePath ?? '') . '.css';
    if (!empty($pagePath) && file_exists($pageCssFile)):
        ?>
        <link rel="stylesheet" href="<?= base_url('css/' . $pagePath . '.css') ?>" />
    <?php endif; ?>
</head>
<body>
<div class="pc-wrap">

    <!-- ── 왼쪽 패널 (공통) ── -->
    <?= $this->include('layout/front/left_panel') ?>

    <!-- ── 오른쪽 패널 ── -->
    <div class="right-panel">

        <!-- 공통 헤더 -->
        <?= $this->include('layout/front/header', ['active' => $active ?? 'home']) ?>

        <!-- 페이지별 콘텐츠 -->
        <?= $this->renderSection('content') ?>

        <!-- 공통 푸터 -->
        <?= $this->include('layout/front/footer') ?>

    </div>
</div>

<!-- 공통 JS -->
<script src="<?= base_url('js/common.js') ?>"></script>
<?= $this->renderSection('js') ?>
<?php
$pageJsFile = FCPATH . 'js' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $pagePath ?? '') . '.js';
if (!empty($pagePath) && file_exists($pageJsFile)):
    ?>
    <script src="<?= base_url('js/' . $pagePath . '.js') ?>"></script>
<?php endif; ?>
</body>
</html>