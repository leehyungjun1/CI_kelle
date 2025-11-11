<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-logo" id="footerToggle">
            <img src="/images/logo_gray.png" alt="한국평생교육관리센터 로고">
            <span class="arrow">▶</span>
        </div>

        <div class="footer-info" id="footerInfo">
            <strong><?= esc($footerInfo->company_name ?? '') ?></strong><br>
            <?= esc($footerInfo->address ?? '') ?> <?= esc($footerInfo->address_detail ?? '') ?><br>
            대표: <?= esc($footerInfo->ceo_name ?? '') ?> | 사업자번호: <?= esc($footerInfo->business_number ?? '') ?> | 대표전화: <?= esc($footerInfo->phone ?? '') ?><br>
            개인정보관리책임자: <?= esc($footerInfo->ceo_name ?? '') ?> (<?= esc($footerInfo->email ?? '') ?>)<br>
            <p class="copy">COPYRIGHT (C) Korea Lifelong Edu management center. ALL RIGHTS RESERVED.</p>
        </div>
    </div>
</footer>


</body>
</html>