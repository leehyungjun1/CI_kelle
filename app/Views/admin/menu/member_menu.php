<div class="menu-header member">
    <h2>회원</h2>
</div>
<div class="panel ">
    <div class="panel-heading menu-icon-minus active">회원 관리</div>
    <ul class="list-group">
        <li class="list-group-item <?= is_active('admin/member/member_list') ?>"><a href="<?=base_url('admin/member/member_list') ?>">회원 리스트</a></li>
        <li class="list-group-item <?= is_active('admin/member/member_register') ?>"><a href="<?=base_url('admin/member/member_register') ?>">회원 등록</a></li>
        <li class="list-group-item ">
            <a href="excel_member_up.php">회원 엑셀 업로드</a></li>
        <li class="list-group-item ">
            <a href="member_join.php">회원 가입 정책 관리</a></li>
        <li class="list-group-item ">
            <a href="member_joinitem.php">회원 가입 항목 관리</a></li>
        <li class="list-group-item ">
            <a href="member_group_list.php">회원 등급 관리</a></li>
        <li class="list-group-item ">
            <a href="member_group_appraisal_config.php">회원등급 평가방법 설정</a></li>
        <li class="list-group-item ">
            <a href="member_batch_approval_with_group.php">가입승인/등급변경</a></li>
        <li class="list-group-item ">
            <a href="member_modify_event_list.php">회원정보 이벤트</a></li>
        <li class="list-group-item ">
            <a href="member_join_event_config.php">회원가입 이벤트</a></li>
        <li class="list-group-item ">
            <a href="member_sleep.php">휴면 회원 정책</a></li>
        <li class="list-group-item ">
            <a href="member_sleep_list.php">휴면 회원 관리</a></li>
        <li class="list-group-item ">
            <a href="hackout_list.php">회원 탈퇴 / 삭제 관리</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">마일리지 / 예치금 관리</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="member_mileage_basic.php">마일리지 기본 설정</a></li>
        <li class="list-group-item ">
            <a href="member_mileage_use.php">마일리지 사용 설정</a></li>
        <li class="list-group-item ">
            <a href="member_mileage_give.php">마일리지 지급 설정</a></li>
        <li class="list-group-item ">
            <a href="member_batch_mileage_list.php">마일리지 지급/차감</a></li>
        <li class="list-group-item ">
            <a href="member_deposit_config.php">예치금 설정</a></li>
        <li class="list-group-item ">
            <a href="member_batch_deposit_list.php">예치금 지급/차감</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">CRM 그룹 관리</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="crm_group_list.php">CRM 그룹 리스트</a></li>
        <li class="list-group-item ">
            <a href="crm_group_create.php">CRM 그룹 등록</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">카카오 친구톡</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="kakao_friend_talk.php">카카오 친구톡</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">카카오 알림톡</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="kakao_alrim_setting.php">카카오 알림톡 설정</a></li>
        <li class="list-group-item ">
            <a href="kakao_alrim_template.php">카카오 알림톡 템플릿 설정</a></li>
        <li class="list-group-item ">
            <a href="kakao_alrim_log.php">카카오 알림톡 발송 내역 보기</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">SMS 관리</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="sms_auto.php">SMS 설정</a></li>
        <li class="list-group-item ">
            <a href="sms_send.php">개별/전체 SMS 발송</a></li>
        <li class="list-group-item ">
            <a href="sms_log.php">SMS 발송 내역 보기</a></li>
        <li class="list-group-item ">
            <a href="sms_charge.php">SMS 포인트 충전</a></li>
        <li class="list-group-item ">
            <a href="sms080_config">080 수신거부 설정</a></li>
        <li class="list-group-item ">
            <a href="sms080_list.php">080 수신거부 리스트</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">메일 관리</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="stibee.php">이메일 마케팅</a></li>
        <li class="list-group-item ">
            <a href="mail_config_pmail.php">대량 메일 설정</a></li>
        <li class="list-group-item ">
            <a href="mail_send_pmail.php">대량 메일 발송</a></li>
        <li class="list-group-item ">
            <a href="mail_send.php">개별/전체 메일 발송</a></li>
        <li class="list-group-item ">
            <a href="mail_config_auto.php">자동 메일 설정</a></li>
        <li class="list-group-item ">
            <a href="mail_log_list.php">메일 발송 내역 보기</a></li>
    </ul>
    <div class="panel-heading menu-icon-minus ">간편 로그인</div>
    <ul class="list-group">
        <li class="list-group-item ">
            <a href="payco_login_config.php">페이코 아이디 로그인 설정</a></li>
        <li class="list-group-item ">
            <a href="naver_login_config.php">네이버 아이디 로그인 설정</a></li>
        <li class="list-group-item ">
            <a href="kakao_login_config.php">카카오 아이디 로그인 설정</a></li>
        <li class="list-group-item ">
            <a href="google_login_config.php">구글 아이디 로그인 설정</a></li>
    </ul>
</div>`