<?php echo $this->extend('layouts/admin') ?>

<?php echo $this->section('content') ?>
    <!-- 쇼핑몰 서비스 정보 내용 시작 -->
    <div class="row main-layout main-header reform mgt-33">
        <div class="wrap">
            <div class="layout-left">
                <h1>
                    <a href="policy/base_info.php">홈페이지 만들기</a>
                    <a href="policy/base_info.php"><small><?= esc($host ?? '') ?></small>
                    </a>
                </h1>
            </div>
        </div>
    </div>

    <div class="main-layout main-content reform">
        <div class="content-main">

        </div>
    </div>
<?php echo $this->endSection() ?>