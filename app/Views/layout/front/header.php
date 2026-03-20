<!-- 공통 헤더 (로고 + 네비게이션) -->
<div class="m-header">
    <div class="m-header-inner">
        <div class="m-logo">
            <div class="m-logo-ring"></div>
            <div class="m-logo-txt">
                <div class="ko">한국평생교육센터</div>
                <div class="en">KLLE &nbsp; Lifelong Education Center</div>
            </div>
        </div>
        <nav class="m-nav">
            <a href="<?= base_url('/') ?>"          class="<?= $active === 'home'     ? 'active' : '' ?>">홈</a>
            <a href="<?= base_url('credit') ?>"     class="<?= $active === 'credit'   ? 'active' : '' ?>">학점은행제</a>
            <a href="<?= base_url('course') ?>"     class="<?= $active === 'course'   ? 'active' : '' ?>">교육과정</a>
            <a href="<?= base_url('review') ?>"     class="<?= $active === 'review'   ? 'active' : '' ?>">후기</a>
            <a href="<?= base_url('planner') ?>"    class="<?= $active === 'planner'  ? 'active' : '' ?>">플래너</a>
        </nav>
    </div>
</div>