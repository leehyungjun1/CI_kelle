<html lang="ko"><head>
    <meta charset="utf-8">
    <title><?= esc($title ?? '관리자 페이지') ?></title>
    <meta name="robots" content="noindex">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="cleartype" content="on">

    <!-- Latest compiled and minified CSS -->
    <link type="text/css" href="/css/gd_share/bootstrap.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/bootstrap-datetimepicker.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/bootstrap-datetimepicker-standalone.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/bootstrap-dialog.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/scr/gd_shareipt/jquery/jquery-ui/jquery-ui.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/style.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/non-responsive.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/flags.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/jquery.countdownTimer.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/gd5-style.css?ts=<?= time() ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="/script/underscore/underscore-min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery-ui/jquery-ui.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/bootstrap/bootstrap.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/moment/moment.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/numeral/numeral.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/bootstrap/bootstrap-datetimepicker.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/bootstrap/bootstrap-dialog.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/bootstrap/bootstrap-filestyle.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/copyclipboard/ZeroClipboard.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/copyclipboard/clipboard.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/copyclipboard/clipboard-2.0.0.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery-browser/dist/jquery.browser.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery.serialize-object.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery.countdownTimer.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/validation/jquery.validate.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/validation/localization/messages_ko.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/validation/additional-methods.min.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/datasaver/jquery.DataSaver.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery.number_only.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/jquery/jquery-cookie/jquery.cookie.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/common2.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/common.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/schedule.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/admin_panel_api.js?ts=1757583214"></script>
    <script type="text/javascript" src="/script/gd_board_common.js"></script>
    <script type="text/javascript" src="/script/jquery/jquery.multi_select_box.js"></script>
    <script type="text/javascript" src="/admin_assets/script/admin-custom.js?ts=1750664389"></script>
</head>
<body class="base index layout-fluid menu-no-border breadcrumb-no-header">

<div id="container-wrap" class="container-fluid pd0">
    <div id="container" class="row">
        <div id="header" class="col-xs-12">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-inner">
                        <div class="gnb">
                            <ul class="list-inline">
                                <li class="no-bar">
                                    <div class="dropdown">
                                        <!--js-btn-layer-sub-menu-->
                                        <a href="#" class="dropdown-toggle gnb-idinfo" id="headerSubMenuManager" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                            <span><?= esc(session('admin_name') ?? '관리자') ?></span>
                                            <span>님 (</span>
                                            <span class="manager-id"><?= esc(session('admin_id') ?? 'admin') ?></span>
                                            <span>)</span>
                                        </a>
                                        <ul class="dropdown-menu gnb-dropdown-menu" aria-labelledby="headerSubMenuManager">
                                            <li class="dropdown-item"><a href="https://gdadmin-unpobby20.godomall.com:443/policy/manage_register.php?sno=1">운영자정보</a></li>
                                            <li class="dropdown-item"><a href="<?=base_url('admin/logout') ?>">로그아웃</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="devide"></li>
                                <li class="no-bar" style="margin-left:20px;">
                                    <span class="dropdown" style="margin: 0; padding: 0;">
                                        <a href="http://unpobby20.godomall.com/" class="gnb-myshop" id="headerMyShop" target="_blank">내홈페이지</a>
                                    </span>
                                </li>
                                <li class="devide"></li>
                            </ul>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav reform">
                            <li class="active"><a href="<?= base_url('admin/policy/manage') ?>">기본설정</a></li>
                            <li class=""><a href="<?=base_url('admin/member/member_list') ?>">회원</a></li>
                            <li class=""><a href="<?=base_url('admin/board/board_list') ?>">게시판</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
        </div>
    </div>
    <div id="content-wrap">
        <div class="container-fluid pd0">
            <div id="content" class="row">
                <div class="col-xs-12">

                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>
    <div id="footer" class="col-xs-12">

    </div>
</div>
</div>

</body>
</html>