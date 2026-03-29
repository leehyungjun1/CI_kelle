<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>관리자 로그인</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('css/gd_share/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/admin/lib/common.css') ?>">
    <style>
        html, body {
            height: 100%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Noto Sans KR', sans-serif;
        }
        .login-wrap {
            width: 100%;
            max-width: 400px;
            padding: 16px;
        }
        .login-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 40px 32px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-logo img {
            max-width: 180px;
            height: auto;
        }
        .login-logo-text {
            font-size: 20px;
            font-weight: 700;
            color: #1A56C4;
            letter-spacing: -0.5px;
        }
        .login-logo-sub {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }
        .login-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 24px;
        }
        .login-form-group {
            margin-bottom: 14px;
        }
        .login-form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }
        .login-form-group .input-wrap {
            position: relative;
        }
        .login-form-group .input-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 14px;
        }
        .login-form-group input {
            width: 100%;
            height: 42px;
            padding: 0 12px 0 36px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color .2s;
            box-sizing: border-box;
        }
        .login-form-group input:focus {
            border-color: #1A56C4;
            box-shadow: 0 0 0 2px rgba(26,86,196,0.1);
        }
        .login-btn {
            width: 100%;
            height: 44px;
            background: #1A56C4;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: background .2s;
        }
        .login-btn:hover { background: #0d3a8e; }
        .login-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13px;
            color: #DC2626;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── 모바일 ── */
        @media (max-width: 480px) {
            .login-box { padding: 32px 20px; }
        }
    </style>
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