<html lang="ko"><head>
    <meta charset="utf-8">
    <title></title>
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
    <link type="text/css" href="/css/gd_share/jquery-ui.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/style.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/flags.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/jquery.countdownTimer.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/gd_share/gd5-style.css?ts=<?= time() ?>" rel="stylesheet">
    <link type="text/css" href="/css/admin-custom.css?ts=<?= time() ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap Dialog JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.alphanum/1.0.24/jquery.alphanum.min.js"></script>
    <script type="text/javascript" src="/script/gd_share/bootstrap/bootstrap-filestyle.min.js?ts=1757583214"></script>

<!--    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>-->
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css">
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.7/underscore-min.js"></script>

    <script src="/script/jy_share/lib.js"></script>
    <script src="/script/jy_share/common.js"></script>

    <script>
        console.log("Underscore 로드 확인:", typeof _);
        // 여기서 _가 object/ function인지 확인
    </script>

    <script>
        $(document).on('click', '.js-adminmenu-toggle', function (e) {
            if (!$('#content-wrap > .js-adminmenu-toggle').length) {
                $('#content-wrap').prepend($(this).clone().addClass('active'));
            } else {
                $('#content-wrap > .js-adminmenu-toggle').toggleClass('active');
            }
            $('body').toggleClass('menu-no-border');
            $(window).trigger('resize');
        });

        $(document).on('click', '.js-listgroup-toggle', function (e) {
            $(this).toggleClass('active');
            var menu = $('#menu .panel-heading').not('.active');

            if ($(this).hasClass('active')) {
                menu.removeClass('menu-icon-minus');
                menu.addClass('menu-icon-plus');
                menu.next('.list-group').hide();
            } else {
                menu.removeClass('menu-icon-plus');
                menu.addClass('menu-icon-minus');
                menu.next('.list-group').show();
            }
        });
    </script>
</head>
<body class="policy base-info layout-basic">

<?php if (session()->has('error')): ?>
    <script>
        alert(<?= json_encode(session('error')) ?>);
    </script>
<?php endif; ?>


<div id="container-wrap" class="container-fluid">
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
                                            <li class="dropdown-item"><a href="https://gdadmin-unpobby20.godomall.com:443/base/login_ps.php?mode=logout">로그아웃</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="devide"></li>
                                <li class="no-bar" style="margin-left:20px;">
                                    <span class="dropdown" style="margin: 0; padding: 0;">
                                        <a href="/" class="gnb-myshop" id="headerMyShop" target="_blank">내홈페이지</a>
                                    </span>
                                </li>
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

            <ol class="breadcrumb text-small clearfix">
                <li>기본설정</li>
                <li>기본정책</li>
                <li>기본 정보 설정</li>
            </ol>

            <script type="text/javascript">
                $(document).ready(function () {
                    $(window).click(function () {
                        var $headerSearchMenuList = $('#headerSearchMenuList').closest('div');
                        if ($headerSearchMenuList.hasClass('display-none') === false) {
                            $headerSearchMenuList.addClass('display-none');
                        }
                    });

                    $('.endDatetime').datetimepicker().on('dp.show', function (e) {
                        var dateNow = new Date();
                        $(this).children().val(moment(dateNow).hours(23).minutes(59).format("YYYY-MM-DD HH:mm"));
                    });
                });
            </script>
        </div>

        <div id="content-wrap">
            <div id="menu">
                <!-- close/open -->
                <div class="js-adminmenu-toggle"></div>
                <div class="js-listgroup-toggle"></div>
                <!-- //close/open -->
                <?php
                $uri = service('uri');
                $segments = $uri->getSegments();
                if(isset($segments[1])){
                    $menuFile = "admin/menu/{$segments[1]}_menu";
                    if (is_file(APPPATH . "Views/{$menuFile}.php")) {
                        echo view($menuFile);
                    }
                }
                ?>
            </div>
            <div id="content" class="row">
                <div class="col-xs-12">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
        <div id="footer" class="col-xs-12">

            <div id="legalRequirementsContainer"></div>

            <script>
                $(function(){
                    /* 리사이징 관련 변수 설정 */
                    var header_h = $('#header').outerHeight();
                    var location_h = $('#header .breadcrumb').outerHeight();
                    var pageheader_h = $('.page-header').outerHeight();
                    var sub_h = header_h + location_h + 76;
                    const expireDay = 7;

                    function resizeContents() {
                        if ($('#legalRequirements_iframe').hasClass('sub_type')) {
                            if ($('#legalRequirements_iframe').hasClass('on')) {
                                var ly_sub_h3 = ($(window).height())-pageheader_h;
                                $("#legalRequirements_iframe").css({'height': ly_sub_h3});
                            }else{
                                var ly_sub_h2 = ($(window).height())-sub_h;
                                $("#legalRequirements_iframe").css({'height': ly_sub_h2});
                            }
                        }else{
                            if ($('#legalRequirements_iframe').hasClass('on')) {
                                $("#legalRequirements_iframe").css('height', '100%');
                            }else{
                                var ly_h = ($(window).height())-header_h;
                                $("#legalRequirements_iframe").css('height', ly_h);
                            }
                        }
                    }

                    $(window).scroll(function() {
                        var position = $(window).scrollTop();
                        if ($('#legalRequirements_iframe').hasClass('sub_type')) {
                            var ly_sub_h = ($(window).height())-59;
                            if(position >= 130) {
                                $("#legalRequirements_iframe").addClass('on');
                                $("#legalRequirements_iframe").addClass('active');
                                $("#legalRequirements_iframe").css({'height': ly_sub_h, 'top': 59});
                            }else{
                                $("#legalRequirements_iframe").removeClass('on');
                                $("#legalRequirements_iframe").removeClass('active');
                                resizeContents();
                                $(".sub_type").css('top', sub_h);

                                if(1 <= position <= 129){
                                    $("#legalRequirements_iframe").css({'height': ly_sub_h});
                                    $(".sub_type").css('top', sub_h-position);
                                }else{
                                    var ly_sub_h2 = ($(window).height())-sub_h;
                                    $("#legalRequirements_iframe").css({'height': ly_sub_h2});
                                }
                            }
                        }else{
                            if(position >= 1) {
                                $("#legalRequirements_iframe").addClass('on');
                                $("#legalRequirements_iframe").css({'height': '100%', 'top': '0px'});
                            } else {
                                $("#legalRequirements_iframe").removeClass('on');
                                resizeContents();
                                $("#legalRequirements_iframe").css('top', header_h);
                            }
                        }
                    });

                    // iframe 동적 생성 함수
                    function createIframe() {
                        const iframe = `
                <iframe id="legalRequirements_iframe"
                    src="/share/layer_legal_requirements_guide.php"
                    frameborder="0"
                    scrolling="no"
                    style="position: fixed; right: 0; top: 0; z-index:3000; background-color: #fff;
                    box-shadow: 0px 20px 24px -4px #10182814, 0px 8px 8px -4px #10182808"
                    width="400px"
                    height="100%"
                    class="${'' ? '' : 'sub_type'}">
                </iframe>
            `;
                        $('#legalRequirementsContainer').html(iframe);

                        // iframe 크기 조정
                        $(window).resize(resizeContents);
                        resizeContents();

                        // iframe 위치 조정
                        if ($('#legalRequirements_iframe').hasClass('sub_type')) {
                            $(".sub_type").css('top', sub_h);
                        }else{
                            $("#legalRequirements_iframe").css('top', header_h);
                        }
                    }

                    var displayFl = 'false';
                    if ($.cookie('legalRequirements_displayFl') === 'true') {
                        createIframe();
                    } else if ($.cookie('legalRequirements_displayFl') !== 'false' && (displayFl === 'true')) {
                        createIframe();
                    }

                    // 버튼 클릭 시에 iframe 생성
                    $('.btn_setting').on('click', function() {
                        if ($('#legalRequirements_iframe').length === 0) {
                            createIframe();
                        }
                        $('#legalRequirements_iframe').show();
                        $.cookie('legalRequirements_displayFl', 'true', {expires: expireDay, path: '/'});
                    });

                    // iframe 닫기 이벤트
                    $(window).on('message', function (event) {
                        if (event.originalEvent.data.action === 'closeIframe') {
                            $('#legalRequirements_iframe').hide();
                            $.cookie('legalRequirements_displayFl', 'false', {expires: expireDay, path: '/'});

                            if (event.originalEvent.data.dismissChecked === true) {
                                $('.btn_setting').hide();
                            }
                        }
                    });
                });
            </script>


            <div class="footer">
            </div>
        </div>
    </div>
</div>
<iframe name="ifrmProcess" src="/blank.php" width="100%" height="200" class="display-none"></iframe>
<script type="text/javascript">
    $(function(){
        adminPanelApiAjax('policy', 'basic', 'base_info');
        // 탑버튼 클릭
        /*$(document).on("click", "a[href=#top]", function(e) {
            $('html body').animate({scrollTop: 0}, 'fast');
        });*/

        // 스크롤 최하단시 탑아이콘 출력 (실제 컨텐츠 $('#content > .col-xs-12').height())
        /*$(window).scroll(function() {
            if ($(window).height() < $(document).height()) {
                if ($(window).scrollTop() >= 1) {
                    $("#gnbTopAnchor").slideDown(150);
                } else {
                    $("#gnbTopAnchor").slideUp(100);
                }
            }
        });*/

        $('#gnbAnchor').css('display','block');

        // 탑버튼 클릭
        $(document).on("click", "a[href=#top]", function(e) {
            $('html body').animate({scrollTop: 0}, 'fast');
            $('.scrollDown').css('display','block');
            $('.scrollTop').css('display','none');
        });

        // 다운버튼 클릭
        $(document).on("click", "a[href=#down]", function(e) {
            $('html body').animate({scrollTop: $(document).scrollTop($(document).height())}, 'fast');
            $('.scrollDown').css('display','none');
            $('.scrollTop').css('display','block');
        });

        $(window).scroll(function() {
            if($(window).scrollTop() >= 1){
                // 탑,다운버튼 노출
                $('.scrollTop').css('display','block');
                $('.scrollDown').css('display','block');

            }else{
                $('.scrollTop').css('display','none');
            }

            if (Math.round($(window).scrollTop()) >= $(document).height() - $(window).height()) {
                $('.scrollDown').css('display','none');
            }
        });
    });
</script>


</body></html>