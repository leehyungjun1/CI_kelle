<!-- 공통 푸터 -->
<div class="m-footer">
    <div class="m-footer-info">
        <?= esc($footerInfo->company_name ?? '') ?> | 대표: <?= esc($footerInfo->ceo_name ?? '') ?><br>
        사업자등록번호: <?= esc($footerInfo->business_number ?? '') ?><br>
        주소: 서울 성동구 성수일로4길 25 서울숲코오롱디지털타워 20층<br><br>
        대표전화: <?= esc($footerInfo->phone ?? '') ?><br>
        개인정보관리책임자:  <?= esc($footerInfo->ceo_name ?? '') ?> (<?= esc($footerInfo->email ?? '') ?>)
    </div>
    <div class="m-footer-copy">Copyright © Korea Lifelong Edu management center. ALL Rights Reserved.</div>
    <div class="m-footer-sns">
        <a href="#"><img src="<?= base_url('images/banner/main_kakao.png') ?>" alt="카카오" /></a>
        <a href="#"><img src="<?= base_url('images/banner/main_naver.png') ?>" alt="네이버" /></a>
        <a href="#"><img src="<?= base_url('images/banner/main_bolt.png') ?>" alt="볼트" /></a>
        <a href="#"><img src="<?= base_url('images/banner/main_carrot.png') ?>" alt="당근" /></a>
        <a href="#"><img src="<?= base_url('images/banner/main_insta.png') ?>" alt="인스타" /></a>
        <a href="#"><img src="<?= base_url('images/banner/main_youtube.png') ?>" alt="유튜브" /></a>
        <a href="#"><img src="<?= base_url('images/banner/main_tictok.png') ?>" alt="틱톡" /></a>
    </div>
</div>