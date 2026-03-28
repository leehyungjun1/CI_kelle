<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> | 관리자</title>

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/raty/2.7.0/jquery.raty.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/bootstrap-datetimepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/bootstrap-dialog.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/jquery-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/common/private_common.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin/lib/common.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/form.css') ?>">

    <?php
    $listCssFile = FCPATH . 'css/admin/lib/list.css';
    if (!empty($pagePath) && file_exists($listCssFile) && str_contains($pagePath, '_list')):
        ?>
        <link rel="stylesheet" href="<?= base_url('css/admin/lib/list.css') ?>">
    <?php endif; ?>

    <?php
    $editCssFile = FCPATH . 'css/admin/lib/edit.css';
    if (!empty($pagePath) && file_exists($editCssFile) && str_contains($pagePath, '_register')):
        ?>
        <link rel="stylesheet" href="<?= base_url('css/admin/lib/edit.css') ?>">
    <?php endif; ?>

    <?= $this->renderSection('css') ?>

    <?php
    $pageCssFile = FCPATH . 'css' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $pagePath ?? '') . '.css';
    if (!empty($pagePath) && file_exists($pageCssFile)):
        ?>
        <link rel="stylesheet" href="<?= base_url('css/' . $pagePath . '.css') ?>">
    <?php endif; ?>
</head>
<body class="<?= $bodyClass ?? '' ?>">

<div id="container-wrap">

    <!-- 상단 헤더 -->
    <?= $this->include('admin/layouts/header') ?>

    <!-- 메인 영역 -->
    <div id="content-wrap">

        <!-- 메뉴 오버레이 (모바일) -->
        <div class="menu-overlay" id="menuOverlay"></div>

        <!-- 좌측 사이드 메뉴 -->
        <div id="menu">
            <div class="js-adminmenu-toggle"></div>
            <div class="js-listgroup-toggle"></div>
            <?= $this->include($sideMenu ?? 'admin/layouts/menu_default') ?>
        </div>

        <!-- 우측 콘텐츠 -->
        <div id="content">

            <!-- 브레드크럼 + 햄버거 -->
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                <button class="btn-hamburger" id="btnHamburger" type="button">
                    <span></span>
                </button>
                <?php if (!empty($breadcrumb)): ?>
                    <ol class="breadcrumb clearfix" style="margin:0; flex:1;">
                        <?php foreach ($breadcrumb as $item): ?>
                            <li><?= esc($item) ?></li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
            </div>

            <!-- 페이지 콘텐츠 -->
            <?= $this->renderSection('content') ?>
        </div>

    </div>

    <!-- 푸터 -->
    <div id="footer">
        <div class="footer"></div>
    </div>

</div>

<iframe name="ifrmProcess" src="/blank.php" width="0" height="0" class="display-none"></iframe>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-filestyle@1/src/bootstrap-filestyle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/underscore@1.13.6/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raty/2.7.0/jquery.raty.min.js"></script>
<script src="<?= base_url('script/jy_share/lib.js') ?>"></script>
<script src="<?= base_url('script/jy_share/common.js') ?>"></script>

<script>
    $(document).ready(function() {
        // 햄버거 버튼
        $('#btnHamburger').on('click', function() {
            $('#menu').toggleClass('menu-open');
            $('#menuOverlay').toggleClass('active');
        });
        // 오버레이 클릭 시 닫기
        $('#menuOverlay').on('click', function() {
            $('#menu').removeClass('menu-open');
            $('#menuOverlay').removeClass('active');
        });
        // 메뉴 링크 클릭 시 모바일 자동 닫기
        $('#menu a').on('click', function() {
            if ($(window).width() <= 1024) {
                $('#menu').removeClass('menu-open');
                $('#menuOverlay').removeClass('active');
            }
        });
    });
</script>

<?= $this->renderSection('js') ?>
<?php
$pageJsFile = FCPATH . 'js' . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $pagePath ?? '') . '.js';
if (!empty($pagePath) && file_exists($pageJsFile)):
    ?>
    <script src="<?= base_url('js/' . $pagePath . '.js') ?>"></script>
<?php endif; ?>

</body>
</html>