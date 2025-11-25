<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>유저 로그인</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
<div class="card p-4 shadow" style="width: 360px;">
    <h3 class="text-center mb-4">유저 로그인</h3>
    <form action="<?= site_url('member/login') ?>" method="post">
        <div class="mb-3">
            <label for="userid" class="form-label">아이디</label>
            <input type="text" id="userid" name="userid" class="form-control" placeholder="아이디 입력" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">비밀번호</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="비밀번호 입력" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">로그인</button>
    </form>
</div>
</body>
</html>