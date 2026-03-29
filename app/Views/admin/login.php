<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>관리자 로그인</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin/lib/common.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin/login.css') ?>">
</head>
<body>

<div class="login-wrap">
    <div class="login-box">

        <!-- 로고 -->
        <div class="login-logo">
            <?php if (file_exists(FCPATH . 'images/logo.png')): ?>
                <img src="<?= base_url('images/logo.png') ?>" alt="로고">
            <?php else: ?>
                <div class="login-logo-text">KLLE</div>
                <div class="login-logo-sub">한국평생교육센터</div>
            <?php endif; ?>
        </div>

        <div class="login-title">관리자 로그인</div>

        <!-- 에러 메시지 -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="login-error">
                <i class="fa fa-exclamation-circle"></i>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <!-- 로그인 폼 -->
        <form action="<?= site_url('admin/login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="login-form-group">
                <label for="admin_id">아이디</label>
                <div class="input-wrap">
                    <i class="fa fa-user"></i>
                    <input type="text" id="admin_id" name="admin_id"
                           value="<?= old('admin_id') ?>"
                           placeholder="아이디를 입력하세요" required autofocus>
                </div>
            </div>
            <div class="login-form-group">
                <label for="password">비밀번호</label>
                <div class="input-wrap">
                    <i class="fa fa-lock"></i>
                    <input type="password" id="password" name="password"
                           placeholder="비밀번호를 입력하세요" required>
                </div>
            </div>
            <button type="submit" class="login-btn">로그인</button>
        </form>

    </div>
</div>

</body>
</html>