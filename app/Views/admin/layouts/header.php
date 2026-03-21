<!-- 상단 헤더 -->
<div id="header">
    <nav class="navbar">
        <div class="container-fluid">

            <!-- 왼쪽: GNB 탭 메뉴 -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav reform">
                    <li class="<?= ($gnbActive ?? '') === 'policy' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/policy/manage') ?>">기본설정</a>
                    </li>
                    <li class="<?= ($gnbActive ?? '') === 'member' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/member/member_list') ?>">회원</a>
                    </li>
                    <li class="<?= ($gnbActive ?? '') === 'board' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/board/board_list') ?>">게시판</a>
                    </li>
                </ul>
            </div>

            <!-- 오른쪽: 관리자 정보 -->
            <div class="navbar-inner">
                <div class="gnb">
                    <ul class="list-inline">
                        <li class="no-bar">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle gnb-idinfo" data-toggle="dropdown">
                                    관리자님 (<span class="manager-id">admin</span>)
                                </a>
                                <ul class="dropdown-menu gnb-dropdown-menu">
                                    <li><a href="<?= base_url('admin/policy/manage') ?>">운영자정보</a></li>
                                    <li><a href="<?= base_url('admin/logout') ?>">로그아웃</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="devide"></li>
                        <li class="no-bar">
                            <a href="/" class="gnb-myshop" target="_blank">내홈페이지</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>
</div>