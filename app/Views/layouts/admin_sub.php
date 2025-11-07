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
    <link type="text/css" href="/css/gd_share/non-responsive.css?ts=<?= time() ?>" rel="stylesheet">
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
                            <li class="active">
                                <a href="<?= base_url('admin/policy/manage') ?>" id="menu_policy" style="width:89.615384615385px;">기본설정                                                                </a>
                            </li>
                            <li class="">
                                <a href="/member/member_list.php" id="menu_member" style="width:89.615384615385px;">회원                                                                </a>
                            </li>
                            <li class="">
                                <a href="/board/board_list.php" id="menu_board" style="width:89.615384615385px;">게시판                                                                </a>
                            </li>
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
                    $('#dropDownFavoriteMenu').on('show.bs.dropdown', function () {
                        var dropdown_container = $(this);
                        var dropdown_menu = dropdown_container.find('.dropdown-menu');
                        $.ajax('../base/main_setting_ps.php', {
                            method: "post",
                            data: {mode: gd_main_layer.favorite_menu.get_id},
                            global_complete: false,
                            success: function () {
                                if (arguments[0].success === 'OK') {
                                    var result = arguments[0].result;
                                    if (result.length > 0) {
                                        var html = [];
                                        $.each(result, function (idx, item) {
                                            var menuName = 'none';
                                            var menuLink = '';
                                            if (typeof item.tName === 'string') {
                                                menuName = item.tName;
                                            } else if (typeof item.sName === 'string') {
                                                menuName = item.sName;
                                            } else if (typeof item.fName === 'string') {
                                                menuName = item.fName;
                                            }
                                            if (typeof item.tUrl === 'string') {
                                                menuLink = '/' + item.tUrl;
                                            } else if (typeof item.sUrl === 'string') {
                                                menuLink = '/' + item.sUrl;
                                            } else {
                                                menuLink = '/index.php';
                                            }
                                            if (typeof item.fCode === 'string') {
                                                menuLink = item.fCode + menuLink;
                                            }
                                            // html.push('<li role="separator" class="divider"></li>');
                                            html.push('<li class="dropdown-item"><a href="../' + menuLink + '">' + menuName + '</a></li>');
                                        });
                                        dropdown_menu.find('li:gt(0)').remove();
                                        dropdown_menu.append(html.join(''));
                                    } else {
                                        if (dropdown_menu.find('.dropdown-noitem').length == 0) {
                                            dropdown_menu.find('li:gt(0)').remove();
                                            dropdown_menu.append('<li class="dropdown-noitem">자주쓰는 메뉴를<br>설정해주세요.</li>');
                                        }
                                    }
                                } else {
                                    console.log(arguments);
                                }
                            }
                        });
                    });

                    $('#dropDownOrderPresentation').on('show.bs.dropdown', function () {
                        var dropdown_container = $(this);
                        $.ajax('../base/main_setting_ps.php', {
                            method: "post",
                            data: {mode: gd_main_layer.order_presentation.get_id},
                            global_complete: false,
                            success: function () {
                                if (arguments[0].success === 'OK') {
                                    var result = arguments[0].result;
                                    if (result.length > 0) {
                                        var html = [];
                                        $.each(result, function (idx, item) {
                                            // html.push('<li role="separator" class="divider"></li>');
                                            html.push('<li class="dropdown-item"><a href="' + item.link + '">' + item.name + '<span class="dropdown-item-val"><span class="text-red">' + item.count + '</span>건</span></a></li>');
                                        });
                                        var dropdown_menu = dropdown_container.find('.dropdown-menu');
                                        dropdown_menu.find('li:gt(0)').remove();
                                        dropdown_menu.append(html.join(''));
                                    }
                                } else {
                                    console.log(arguments);
                                }
                            }
                        });
                    });

                    $('.js-setting-presentation').click(function () {
                        $.post('/share/layer_presentation_setting.php', {mode: gd_main_layer.presentation.id}, function (data) {
                            var options = {title: gd_main_layer.presentation.title, message: $(data), size: _bootstrap_dialog.SIZE_WIDE};
                            _bootstrap_dialog.show(options);
                        });
                    });

                    $('.js-setting-cs').bind('click', function () {
                        $.post('/share/layer_cs_setting.php', null, function (data) {
                            _bootstrap_dialog.show({
                                title: '문의/답변관리 조회설정 ',
                                message: $(data)
                            });
                        });
                    });

                    $('.js-setting-order').bind('click', function () {
                        var layer_id = this.dataset.role;
                        var title = (layer_id === gd_main_layer.order_presentation.id) ? gd_main_layer.order_presentation.title : gd_main_layer.order_setting.title;
                        $.post('../base/layer_order_setting.php', {mode: layer_id}, function (data) {
                            var options = {title: title, message: $(data)};
                            _bootstrap_dialog.show(options);
                        });
                    });

                    $('.js-setting-favorite-menu').bind('click', function () {
                        $.post('/share/layer_favorite_menu.php', {mode: gd_main_layer.favorite_menu.id}, function (data) {
                            var options = {title: gd_main_layer.favorite_menu.title, message: $(data), size: _bootstrap_dialog.SIZE_WIDE};
                            _bootstrap_dialog.show(options);
                        });
                    });

                    $('#headerSearchType').change(function () {
                        if (this.value === 'member') {
                            layer_member_search();
                            document.getElementById('headerSearchType').options[0].selected = true;
                        }
                    });

                    $('#headerSearchKeyword').keyup(function (e) {
                        if (e.keyCode === 13 && this.value.length > 1) {
                            $.ajax('../base/main_setting_ps.php', {
                                method: "post",
                                global_complete: false,
                                data: {mode: "searchMenu", keyword: this.value},
                                success: function () {
                                    var result = arguments[0].result;
                                    var optionHtml = [];
                                    $.each(result, function (idx, item) {
                                        if (item.tName === 'Web FTP') {
                                            var link = item.tUrl;
                                        } else {
                                            var link = '../' + item.fCode + '/' + item.tUrl;
                                        }
                                        optionHtml.push('<option value="' + link + '">' + item.tName + '</option>');
                                    });
                                    var $headerSearchMenuList = $('#headerSearchMenuList');
                                    $headerSearchMenuList.closest('div').removeClass('display-none');
                                    $headerSearchMenuList.find('option').remove();
                                    if (optionHtml.length == 0) {
                                        $headerSearchMenuList.append('<option>검색된 메뉴가 없습니다.</option>');
                                    } else {
                                        $headerSearchMenuList.append(optionHtml.join(''));
                                    }
                                }
                            });
                        }
                    });

                    $('#headerSearchMenuList').on('click', function () {
                        location.href = this.value;
                    });

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
            <script>
                $(function(){
                    // 검색버튼 클릭시
                    $("#goseller_search_btn").on('click',function (){
                        var gosellerSearchWord = $("#goseller_search_box").val().toUpperCase();
                        // 검색어 유지를 위해 로컬스토리지에 저장
                        localStorage.setItem("gosellerSearchWord", gosellerSearchWord);

                        $(".video_list").hide();
                        $(".no_result").hide();

                        $.each($(".video_list"), function () {
                            var v_list = $(this).find('.txt').text().toUpperCase();
                            var menuTitle = $(this).find('#video_menu').text().toUpperCase();

                            // 메뉴명을 제외한 콘텐츠 제목+추가설명
                            v_list = v_list.replace(menuTitle, '');

                            if (v_list.match(gosellerSearchWord)) {
                                $(this).show();
                            }
                        });

                        if ($(".video_list:visible").length === 0) {
                            $(".no_result").show();
                        }
                    });

                    // 검색어 입력후 엔터시
                    $('#goseller_search_box').keyup(function(e) {
                        if (e.keyCode == 13) {
                            $('#goseller_search_btn').trigger('click');
                        }
                    });

                    // open_layer
                    $('.btn_goseller').on('click',function(){
                        if (!localStorage.getItem('gosellerSearchWord')) {
                            $("#goseller_search_box").prop('value','');
                            $("#goseller_search_btn").trigger('click');
                            $(".no_result").hide();
                        }

                        $('.ly_goseller').show();
                        var data = {
                            'mode': 'saveGosellerDisplayConfig',
                            'key': 'displayFl',
                            'val': 'true'
                        }
                        $.ajax('/base/layer_goseller_guide_ps.php', {type: "post", data: data});
                    });

                    // goseller 검색 인풋 텍스트 지우기 버튼 211201 고셀러TV 추가
                    $('#goseller_search_box').focusin(function() {
                        $('.btn_goseller_erase').css({'display':'inline-block'});
                    });

                    $('#goseller_search_box').focusout(function() {
                        if ($('#goseller_search_box').val() == '') {
                            $('.btn_goseller_erase').css({'display':'none'});
                        } else {
                            $('.btn_goseller_erase').css({'display':'inline-block'});
                        }
                    });

                    // goseller 검색 인풋 텍스트 삭제 211201 고셀러TV 추가
                    $('.btn_goseller_erase').on('click',function(){
                        $(this).closest('div').find('input').val("");
                        $(this).css({'display':'none'});
                    });

                    // close_layer
                    $('.btn_close').on('click',function(){
                        if (localStorage.getItem('gosellerSearchWord')) {
                            localStorage.removeItem('gosellerSearchWord');
                        }
                        $('.ly_goseller').hide();
                        var data = {
                            'mode': 'saveGosellerDisplayConfig',
                            'key': 'displayFl',
                            'val': 'false'
                        }
                        $.ajax('/base/layer_goseller_guide_ps.php', {type: "post", data: data});
                    });

                    // 검색어 유지
                    if (localStorage.getItem('gosellerSearchWord')) {
                        $("#goseller_search_box").attr('value',localStorage.getItem('gosellerSearchWord'));
                        $("#goseller_search_btn").trigger('click');
                    }
                });
            </script>
            <!-- // 211201 고셀러TV 추가 -->

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
            <script type="text/javascript">
                <!--
                $(document).ready(function () {

                    $.ajax('../base/main_setting_ps.php', {
                        method: "post",
                        data: {mode: 'orderPresentationNew'},
                        global_complete: false,
                        beforeSend: function () {
                            $('.js-oder-count-new').addClass('display-none')
                        },
                        success: function () {
                            if (arguments[0].success === 'OK') {
                                var result = arguments[0].result;
                                if (result === true) {
                                    $('.js-oder-count-new').removeClass('display-none');
                                }
                            }
                        }
                    });
                });
                //-->
            </script>
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