<?php echo $this->extend('layouts/admin_sub') ?>

<?php echo $this->section('content') ?>
<div class="page-header js-affix affix-top" style="width: 1634px;">
    <h3>회원 리스트</h3>
    <input type="button" value="회원 등록" class="btn btn-red-line" onClick='goList("<?= base_url("admin/member/member_register") ?>")'>
</div>
<form id="frmSearchBase" method="get" class="content-form js-search-form js-form-enter-submit">
    <input type="hidden" name="sort" value="" id="searchsort">
    <input type="hidden" name="searchFl" value="y">
    <input type="hidden" name="pageNum" value="10">
    <div class="table-title gd-help-manual">회원 검색</div>
    <div class="search-detail-box form-inline">
        <input type="hidden" name="detailSearch" value="">
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col class="width-2xl">
                <col class="width-md">
                <col class="width-3xl">
            </colgroup>
            <tbody>
            <tr>
                <th>검색어</th>
                <td colspan="3">
                    <select class=" form-control" id="key" name="key">
                        <option value="userid" <?=(($_GET['key'] ?? '') === 'userid') ? 'selected' : '' ?>>아이디</option>
                        <option value="name" <?=(($_GET['key'] ?? '') === 'name') ? 'selected' : '' ?>>이름</option>
                        <option value="nickname" <?=(($_GET['key'] ?? '') === 'nickname')? 'selected' : '' ?>>닉네임</option>
                        <option value="email" <?=(($_GET['key'] ?? '') === 'email')? 'selected' : '' ?>>이메일</option>
                        <option value="mobile" <?=(($_GET['key'] ?? '') === 'mobile')? 'selected' : '' ?>>휴대폰번호</option>
                        <option value="phone" <?=(($_GET['key'] ?? '') === 'phone')? 'selected' : '' ?>>전화번호</option>
                        <option value="__disable5" disabled="">==========</option>
                        <option value="company">회사명</option>
                        <option value="busiNo">사업자등록번호</option>
                        <option value="ceo">대표자명</option>
                        <option value="__disable8" disabled="">==========</option>
                        <option value="recommId">추천인아이디</option>
                        <option value="fax">팩스번호</option>
                    </select>
                    <select class=" form-control " id="searchKind" name="searchKind">
                        <option value="equalSearch" <?=(($_GET['searchKind'] ?? '') === 'equalSearch')? 'selected' : '' ?>>검색어 전체일치</option>
                        <option value="fullLikeSearch" <?=(($_GET['searchKind'] ?? '') === 'fullLikeSearch')? 'selected' : '' ?>>검색어 부분포함</option>
                    </select>
                    <input type="text" name="keyword" value="<?=($_GET['keyword'] ?? '');?>" class="form-control width-xl" placeholder="검색어 전체를 정확히 입력하세요.">
                </td>
            </tr>
            <tr>
                <th>회원등급</th>
                <td>
                    <select class="form-control " id="groupSno" name="groupSno">
                        <option value="">등급</option>
                        <?php foreach($grades as $grade) : ?>
                            <option value="<?= $grade['id'] ?>" <?=(isset($get['groupSno']) && $get['groupSno'] == $grade['id']) ? 'selected' : '' ?>><?=$grade['grade_name'];?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <th>회원구분</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="member_type" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="member_type" value="personal" <?= (isset($_GET['member_type']) && $_GET['member_type'] == 'personal') ? 'checked' : '' ?>>
                        개인회원
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="member_type" value="business"<?=(isset($_GET['member_type']) && $_GET['member_type'] == 'business') ? 'checked' : '' ?>>
                        사업자회원
                    </label>
                </td>
            </tr>
            <tr>
                <th>가입승인</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="regist_YN" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="regist_YN" value="Y" <?=(isset($_GET['regist_YN']) && $_GET['regist_YN'] == 'Y') ? 'checked' : '' ?>>
                        승인
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="regist_YN" value="N" <?=(isset($_GET['regist_YN']) && $_GET['regist_YN'] == 'N') ? 'checked' : '' ?>>
                        미승인
                    </label>
                </td>
                <th>회원가입일</th>
                <td>
                    <?= dateRangePicker([
                        'name' => 'entryDt[]',
                        'start' => '2025-09-27',
                        'end' => '2025-10-03',
                        'periods' => [
                            ['label'=>'오늘','value'=>0],
                            ['label'=>'7일','value'=>6,'active'=>true],
                            ['label'=>'15일','value'=>14],
                            ['label'=>'1개월','value'=>29],
                            ['label'=>'3개월','value'=>89],
                            ['label'=>'전체','value'=>-1],
                        ]
                    ]) ?>
                </td>
            </tr>
            </tbody>
            <tbody class="js-search-detail" style="display: none;">
            <tr>
                <th>방문횟수</th>
                <td>
                    <input type="text" class="form-control" name="loginCnt[]" size="7" value="">
                    회 ~
                    <input type="text" class="form-control" name="loginCnt[]" size="7" value="">
                    회
                </td>
                <th>최종로그인일</th>
                <td>
                    <div class="input-group js-datepicker">
                        <input type="text" class="form-control" placeholder="" name="lastLoginDt[]" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                    ~
                    <div class="input-group js-datepicker">
                        <input type="text" class="form-control" placeholder="" name="lastLoginDt[]" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>마일리지</th>
                <td>
                    <input type="text" class="form-control js-number" name="mileage[]" size="7" value="">
                    원 ~
                    <input type="text" class="form-control js-number" name="mileage[]" size="7" value="">
                    원
                </td>
                <th>예치금</th>
                <td>
                    <input type="text" class="form-control js-number" name="deposit[]" size="7" value="">
                    원 ~
                    <input type="text" class="form-control js-number" name="deposit[]" size="7" value="">
                    원
                </td>
            </tr>
            <tr>
                <th>상품주문건수</th>
                <td>
                    <input type="text" class="form-control js-number" name="saleCnt[]" size="7" value="">
                    건 ~
                    <input type="text" class="form-control js-number" name="saleCnt[]" size="7" value="">
                    건
                </td>
                <th>주문금액</th>
                <td>
                    <input type="text" class="form-control js-number" name="saleAmt[]" size="7" value="">
                    원 ~
                    <input type="text" class="form-control js-number" name="saleAmt[]" size="7" value="">
                    원
                </td>
            </tr>
            <tr>
                <th>SMS수신동의</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="smsFl" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="smsFl" value="y">
                        수신
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="smsFl" value="n">
                        수신거부
                    </label>
                </td>
                <th>메일수신동의</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="maillingFl" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="maillingFl" value="y">
                        수신
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="maillingFl" value="n">
                        수신거부
                    </label>
                </td>
            </tr>
            <tr>
                <th>가입경로</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="entryPath" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="entryPath" value="pc">
                        PC
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="entryPath" value="mobile">
                        모바일
                    </label>
                </td>
                <th>장기 미로그인</th>
                <td>
                    <input type="text" class="form-control js-number" name="novisit" size="7" value="">
                    일 이상 로그인하지 않은 회원
                </td>
            </tr>
            <tr>
                <th>성별</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="sexFl" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexFl" value="m">
                        남자
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexFl" value="w">
                        여자
                    </label>
                </td>
                <th>생일</th>
                <td>
                    <div class="input-group">
                        <label>
                            <input type="checkbox" id="birthCheckFl" name="birthFl" value="">
                            특정일 검색
                        </label>
                    </div>
                    <select class="form-control " id="calendarFl" name="calendarFl"><option value="">전체</option><option value="s">양력</option><option value="l">음력</option></select>                <div class="input-group js-datepicker-month" style="position: relative;">
                        <input type="text" id="birthDt1" class="form-control js-number" placeholder="" name="birthDt[]" value="" maxlength="10">
                        <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 10</span></div>
                    <div class="input-group js-datepicker firstdate">
                        <input type="hidden" id="yBirthDt1" class="form-control" placeholder="" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                    <div class="input-group seconddate"> ~ </div>
                    <div class="input-group js-datepicker-month seconddate" style="position: relative;">
                        <input type="text" id="birthDt2" class="form-control js-number seconddate" placeholder="" name="birthDt[]" value="" maxlength="10">
                        <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 10</span></div>
                    <div class="input-group js-datepicker seconddate">
                        <input type="hidden" id="yBirthDt2" class="form-control seconddate" placeholder="" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>결혼여부</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="marriFl" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="marriFl" value="n">
                        미혼
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="marriFl" value="y">
                        기혼
                    </label>
                </td>
                <th>결혼기념일</th>
                <td>
                    <div class="input-group js-datepicker">
                        <input type="text" class="form-control" placeholder="" name="marriDate[]" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                    ~
                    <div class="input-group js-datepicker">
                        <input type="text" class="form-control" placeholder="" name="marriDate[]" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>개인정보유효기간</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="expirationFl" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="expirationFl" value="1">
                        1년
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="expirationFl" value="3">
                        3년
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="expirationFl" value="5">
                        5년
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="expirationFl" id="expirationNone" value="999">
                        탈퇴 시
                    </label>
                </td>
                <th>휴면 전환 예정 회원</th>
                <td>
                    <label class="checkbox-inline mgl10">
                        <input type="checkbox" id="dormantMemberExpected" name="dormantMemberExpected" value="">
                        휴면 전환
                        <select class="form-control " id="expirationDay" name="expirationDay" disabled="true"><option value="7">7</option><option value="30">30</option><option value="60">60</option></select>일 전 회원
                    </label>
                </td>
            </tr>
            <tr>
                <th>연결계정</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="" checked="checked">
                        전체
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="payco">
                        페이코
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="facebook">
                        페이스북
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="naver">
                        네이버
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="kakao">
                        카카오
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="apple">
                        애플
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="connectSns" value="google">
                        구글
                    </label>
                </td>
                <th>휴면해제일</th>
                <td>
                    <div class="input-group js-datepicker">
                        <input type="text" class="form-control" placeholder="" name="sleepWakeDt[]" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                    ~
                    <div class="input-group js-datepicker">
                        <input type="text" class="form-control" placeholder="" name="sleepWakeDt[]" value="">
                        <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-sm btn-link js-search-toggle bold">상세검색
            <span>펼침</span>
        </button>
    </div>
    <div class="table-btn">
        <input type="submit" value="검색" class="btn btn-lg btn-black js-search-button">
    </div>

    <script type="text/javascript">
        //검색어 변경 될 때 placeHolder 교체 및 검색 종류 변환 및 검색 종류 변환
        var arrSearchKey = ['all', 'memId', 'memNm', 'nickNm', 'email', 'cellPhone', 'phone', 'ceo', 'fax', 'recommId'];

        function checkDormant() {
            if($('input:checkbox[name="dormantMemberExpected"]').val() == 'y') {
                $('#dormantMemberExpected').prop('checked', true);
                $('input[name="novisit"]').attr('disabled', true);
                $("#expirationDay").attr('disabled', false);
            }
        }
        function getMonthFormatDate(date) {
            var today = new Date();
            var month = date.substring(0, 2);
            var day = date.substring(month.length, date.length);
            var maxDate = 31;

            if(month.length == 1) month = '0' + month;
            if(day.length == 1) day = '0' + day;
            if(date.length <= 2) day = '01';

            if(month == 4 || month == 6 || month == 9 || month == 11) {
                maxDate = 30;
            } else if(month == 2) {
                maxDate = 29;
            }

            if(month > 12) {
                today.getMonth() >= 9 ? (month = today.getMonth() + 1) : (month = '0' + (today.getMonth() + 1))
                today.getDate() >= 10 ? day = today.getDate() : day = '0' + today.getDate()
            } else if(day > maxDate) {
                day = maxDate;
            }

            if (month == '00')  month = '01';
            if (day == '00')    day = '01';

            return month + '-' + day;
        }

        function getYearFormatDate(date) {
            var today = new Date();
            var year = date.substring(0, 4);
            var month = date.substr(year.length, 2);
            var day = date.substring((year.length + month.length), date.length);
            var maxDate = 31;

            if(month.length == 1) month = '0' + month;
            if(day.length == 1) day = '0' + day;
            if(date.length <= 6) day = '01';

            if(month == 4 || month == 6 || month == 9 || month == 11) {
                maxDate = 30;
            } else if(month == 2) {
                ((year%4 == 0 && year%100 != 0) || year%400 == 0) ? maxDate = 29 : maxDate = 28
            }

            if(month > 12) {
                year = today.getFullYear();
                today.getMonth() >= 9 ? (month = today.getMonth() + 1) : (month = '0' + (today.getMonth() + 1))
                today.getDate() >= 10 ? day = today.getDate() : day = '0' + today.getDate()
            } else if(day > maxDate) {
                day = maxDate;
            }

            if (year == '0000') year = '0001';
            if (month == '00')  month = '01';
            if (day == '00')    day = '01';

            return year + '-' + month + '-' + day;
        }

        function checkBirthFl() {
            if($('input:checkbox[name="birthFl"]').val() == 'y') {
                $('#birthCheckFl').prop('checked', true);
                $('.seconddate').hide();
                $('.seconddate').val('');
            }
        }

        $(document).ready(function () {

            $(".btnModify").on("click", function() {
               $(this).
            });


        });
    </script>
</form>

<form id="frmList" action="" method="get" target="ifrmProcess">
    <div class="table-header form-inline">
        <div class="pull-left">
            검색
            <strong><?=number_format($searchCount) ?></strong>
            명 / 전체
            <strong><?=number_format($totalCount) ?></strong>
            명
        </div>
        <div class="pull-right">
            <div>
                <select name="sort" class="form-control" id="sort">
                    <option value="created_at desc" <?=(( $get['sort'] ?? '') === 'created_at desc') ? 'selected' : '' ?>>회원가입일↓</option>
                    <option value="created_at asc" <?=(( $get['sort'] ?? '') === 'created_at asc') ? 'selected' : '' ?>>회원가입일↑</option>
                    <option value="last_login desc" <?=(( $get['sort'] ?? '') === 'last_login desc') ? 'selected' : '' ?>>최종로그인↓</option>
                    <option value="last_login asc" <?=(( $get['sort'] ?? '') === 'last_login asc') ? 'selected' : '' ?>>최종로그인↑</option>
                    <option value="accountCnt desc" <?=(( $get['sort'] ?? '') === 'accountCnt desc') ? 'selected' : '' ?>>방문횟수↓</option>
                    <option value="accountCnt asc" <?=(( $get['sort'] ?? '') === 'accountCnt asc') ? 'selected' : '' ?>>방문횟수↑</option>
                    <option value="name desc" <?=(( $get['sort'] ?? '') === 'name desc') ? 'selected' : '' ?>>이름↓</option>
                    <option value="name asc" <?=(( $get['sort'] ?? '') === 'name asc') ? 'selected' : '' ?>>이름↑</option>
                    <option value="userid desc" <?=(( $get['sort'] ?? '') === 'userid desc') ? 'selected' : '' ?>>아이디↓</option>
                    <option value="userid asc" <?=(( $get['sort'] ?? '') === 'userid asc') ? 'selected' : '' ?>>아이디↑</option>
                    <option value="mileage desc" <?=(( $get['sort'] ?? '') === 'mileage desc') ? 'selected' : '' ?>>마일리지↓</option>
                    <option value="mileage asc" <?=(( $get['sort'] ?? '') === 'mileage asc') ? 'selected' : '' ?>>마일리지↑</option>
                    <option value="emoney desc" <?=(( $get['sort'] ?? '') === 'emoney desc') ? 'selected' : '' ?>>예치금↓</option>
                    <option value="emoney asc" <?=(( $get['sort'] ?? '') === 'emoney asc') ? 'selected' : '' ?>>예치금↑</option>
                    <option value="orderPrice desc" <?=(( $get['sort'] ?? '') === 'orderPrice desc') ? 'selected' : '' ?>>주문금액↓</option>
                    <option value="orderPrice asc" <?=(( $get['sort'] ?? '') === 'orderPrice asc') ? 'selected' : '' ?>>주문금액↑</option>
                </select>&nbsp;
                <select class=" js-page-number form-control" id="pageNum" name="pageNum"><option value="10" selected="selected">10개 보기</option><option value="20">20개 보기</option><option value="30">30개 보기</option><option value="40">40개 보기</option><option value="50">50개 보기</option><option value="60">60개 보기</option><option value="70">70개 보기</option><option value="80">80개 보기</option><option value="90">90개 보기</option><option value="100">100개 보기</option><option value="200">200개 보기</option><option value="300">300개 보기</option><option value="500">500개 보기</option></select>                <!--<button type="button" class="btn btn-sm btn-default" id="btnGrid">GRID</button>-->
            </div>
        </div>
    </div>

    <table class="table table-rows">
        <colgroup>
            <col class="width-xs">
            <col class="width-xs">
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>
                <input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk">
            </th>
            <th>번호</th>
            <th>아이디/닉네임</th>
            <th>이름</th>
            <th>등급</th>
            <th>마일리지</th>
            <th>예치금</th>
            <th>상품주문건수</th>
            <th>주문금액</th>
            <th>회원가입일</th>
            <th>최종로그인</th>
            <th>가입승인</th>
            <th>메일/SMS 발송</th>
            <th>정보수정</th>
        </tr>
        </thead>
        <tbody>
            <?php if(!empty($members)) : ?>
                <?php foreach($members as $i => $member) : ?>
                    <tr class="center" data-member-no="<?=esc($member['id'] ?? '') ?>">
                        <td>
                            <input type="checkbox" name="chk[]" value="<?=esc($member['id'] ?? '') ?>">
                        </td>
                        <td class="font-num"><span class="number js-layer-crm hand"><?=$i +1 ?></span></td>
                        <td><span class="font-eng js-layer-crm hand"><?=esc($member['userid'] ?? '') ?> / <?=esc($member['nickname'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['name'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['grade'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['mileage'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['emoney'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['orderCnt'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['orderPrice'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['created_at'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['last_login'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['regist_YN'] ?? '') ?></span></td>
                        <td><span class="js-layer-crm hand"><?=esc($member['mail_YN'] ?? '') ?> / <?=esc($member['sms_YN'] ?? '') ?></span></td>
                        <td><button type="button" class="btn btn-white btn-sm btnModify" onClick=goList('<?= base_url("admin/member/member_register/{$member['id']}") ?>')>수정</button></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td class="center" colspan="14">검색된 정보가 없습니다.</td></tr>
            <?php endif; ?>

        </tbody>
    </table>

    <div class="table-action clearfix">
        <div class="pull-left">
            <button type="button" class="btn btn-white" id="btnApply">선택 가입승인</button>
            <button type="button" class="btn btn-white" id="btnDelete">선택 탈퇴처리</button>
        </div>
        <div class="pull-right">
            <button type="button" class="btn btn-white icon_notice_gray js-service-privacy-download" data-target-form="frmSearchBase" data-search-count="0" data-total-count="0" data-target-list-form="frmList" data-target-list-sno="chk">개인정보수집 동의상태 변경내역
            </button>
            <button type="button" class="btn btn-white btn-icon-excel js-excel-download" data-target-form="frmSearchBase" data-search-count="0" data-total-count="11" data-target-list-form="frmList" data-target-list-sno="chk">엑셀다운로드
            </button>
        </div>

    </div>

    <div class="center"><nav><ul class="pagination pagination-sm"></ul></nav></div>
</form>

<?php echo $this->endSection() ?>



