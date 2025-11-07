<?php echo $this->extend('layouts/admin_sub') ?>
<?php echo $this->section('content') ?>

<form id="frm" action="<?= url_to('member_save') ?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
    <?=csrf_field() ?>
    <div class="page-header js-affix affix-top" style="width: 1634px;">
        <h3>회원 등록 </h3>
        <div class="btn-group">
            <input type="button" value="목록" class="btn btn-white btn-icon-list" onclick=goList('<?= base_url("admin/member/member_list") ?>')>
            <input type="button" value="저장" class="btn btn-red btn-register">
        </div>
    </div>
    <input type="hidden" name="mode" id="mode" value="<?=$mode ?>">
    <input type="hidden" name="id" value="<?=$user['id'] ?>">
    <div class="table-title gd-help-manual"> 기본정보 </div>
    <div class="form-inline">
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody><tr>
                <th>회원구분</th>
                <td colspan="3">
                    <label class="radio-inline"><input type="radio" name="member_type" value="personal" data-target=".div-business" <?=(!isset($user['member_type']) || $user['member_type']=='personal') ? 'checked' : ''?>>개인회원</label>
                    <label class="radio-inline"><input type="radio" name="member_type" value="business" data-target=".div-business" <?=(isset($user['member_type']) && $user['member_type']=='business') ? 'checked' : ''?>>사업자회원</label>
                </td>
            </tr>
            <tr>
                <th>등급</th>
                <td>
                    <select class="form-control " id="groupSno" name="grade">
                        <option value="">등급선택</option>
                        <?php foreach ($userGrades as $grade): ?>
                            <option value="<?= esc($grade['id']) ?>"
                                <?= (isset($user['grade']) && $user['grade'] == $grade['id']) ? 'selected' : '' ?>>
                                <?= esc($grade['grade_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <th>승인</th>
                <td>
                    <div class="radio">
                        <label class="radio-inline"><input type="radio" name="regist_YN" value="Y" <?=(!isset($user['regist_YN']) || $user['regist_YN'] == "Y") ? "checked" : '' ?>>승인 </label>
                        <label class="radio-inline"><input type="radio" name="regist_YN" value="N" <?=(isset($user['regist_YN']) && $user['regist_YN'] == "N") ? "checked" : '' ?>>미승인</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="require">아이디</th>
                <td>
                    <span>
                        <? if($user['userid']) : ?>
                            <strong><?=$user['userid'] ?? '';?></strong>
                        <? else : ?>
                        <input type="text" name="userid" id="userid" value="<?=$user['userid'] ?? '';?>" class="form-control error">
                        <button type="button" id="overlap_memId" class="btn btn-gray btn-sm">중복확인</button>
                        <? endif; ?>
                    </span>
                </td>
                <th>닉네임</th>
                <td>
                    <span><input type="text" name="nickname" id="nickNm" value="<?=$user['nickname'] ?? '' ?>" class="form-control width-sm error"></span>
                    <button type="button" id="overlap_nickNm" class="btn btn-gray btn-sm">중복확인</button>
                </td>
            </tr>
            <tr>
                <th class="require">이름</th>
                <td colspan="1">
                    <span><input type="text" name="name" id="memNm" value="<?=$user['name'] ?? '' ?>" class="form-control width-sm" data-pattern="gdMemberNmGlobal" maxlength="20"></span>
                </td>
                <th class="require">비밀번호</th>
                <td>
                    <span title="비밀번호를 입력해주세요!" style="position: relative;">
                        <input type="password" name="password" value="" class="form-control width-sm js-maxlength" placeholder="비밀번호입력" maxlength="16">&nbsp;
                        <input type="password" name="memPwRe" value="" class="form-control width-sm js-maxlength" placeholder="비밀번호확인" maxlength="16" style="margin-left: 40px">
                    </span>
                    <p class="notice-danger notice-info">*영문대문자/영문소문자/숫자/특수문자 중 2개 이상 포함, 10~16자리 이하로 설정할 수 있습니다.</p>            </td>
            </tr>
            <tr>
                <th>이메일</th>
                <td>
                    <div class="form-inline mgb5">
                        <?= email_input('email1', 'email2', old('email1', $user['email1'] ?? ''), old('email2', $user['email2'] ?? '')) ?>
                        <button type="button" id="overlap_email" class="btn btn-gray btn-sm">중복확인</button>
                    </div>
                    <div class="form-inline">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="mail_YN" value="Y" <?=(isset($user['mail_YN']) && $user['mail_YN'] == "Y") ? "checked" : "" ;?> data-default=""> 정보/이벤트 MAIL 수신에 동의합니다. </label>
                    </div>
                    <p class="notice-danger notice-info">*수신동의설정 안내메일의 자동발송여부에 따라 회원정보의 수신동의설정 변경 시 해당 회원에게 안내메일이 자동 발송됩니다.</p>
                </td>
                <th>이메일<br>수신동의/거부일</th>
                <td>거부 : -            </td>
            </tr>
            <tr>
                <th>휴대폰번호</th>
                <td>
                    <div class="form-inline mgb5">
                        <span title="휴대폰번호를 입력해주세요!" style="position: relative;">
                        <input type="text" name="mobile" value="<?=$user['mobile'] ?? ''?>" maxlength="12" class="form-control js-number-only width-md">
                    </span>
                    </div>
                    <div class="form-inline">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="sms_YN" value="Y" <?=(isset($user['sms_YN']) && $user['sms_YN'] == "Y") ? "checked" : "" ;?>> 정보/이벤트 SMS 수신에 동의합니다.
                        </label>
                    </div>
                    <p class="notice-danger notice-info">*수신동의설정 안내메일의 자동발송여부에 따라 회원정보의 수신동의설정 변경 시 해당 회원에게 SMS가 자동 발송됩니다.</p>
                </td>
                <th>SMS<br>수신동의/거부일</th>
                <td>거부 : -            </td>
            </tr>
            <tr>
                <th>주소</th>
                <td colspan="3">
                    <?= address_input('postcode', 'address1', 'address2',$user['postcode'] ?? '',$user['address1'] ?? '',$user['address2'] ?? '') ?>
                </td>
            </tr>
            <tr>
                <th>전화번호</th>
                <td colspan="3">
                    <div class="form-inline">
                        <span title="전화번호를 입력해주세요!" style="position: relative;">
                        <input type="text" name="phone" value="<?=$user['phone'] ?? ''?>" maxlength="12" class="form-control js-number-only width-md">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="table-title div-business gd-help-manual display-none">사업자정보</div>
    <div class="input_wrap form-inline div-business display-none">
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody><tr>
                <th>상호</th>
                <td>
                <span title="회사명를 입력해주세요!" style="position: relative;">
                    <input type="text" name="company" class="form-control ignore" value="" maxlength="50" data-pattern="gdMemberNmGlobal">
                <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 50</span></span>
                    <span id="companyMsg" class="input_error_msg"></span>
                </td>
                <th>사업자번호</th>
                <td>
                <span title="사업자번호를 입력해주세요!" style="position: relative;">
                    <input type="text" name="busiNo[]" size="3" maxlength="3" class="form-control js-number ignore" value="">
                    -
                    <input type="text" name="busiNo[]" size="2" maxlength="2" class="form-control js-number ignore" value="">
                    -
                    <input type="text" name="busiNo[]" size="5" maxlength="5" class="form-control js-number ignore" value="">
                    <input type="hidden" id="busiNo" name="fullBusiNo" class="error ignore" value="" data-overlap-businofl="y" data-charlen="10" data-oldbusino="">
                                        <button type="button" id="overlap_busiNo" class="btn btn-gray btn-sm">중복확인</button>
                                        <button type="button" id="find_busiNo" class="btn btn-gray btn-sm">사업자번호 조회</button>
                <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 3</span><span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 2</span><span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 5</span></span>
                </td>
            </tr>
            <tr>
                <th>대표자명</th>
                <td class="input_area" colspan="3">
                <span title="대표자를 입력해주세요!" style="position: relative;">
                    <input type="text" name="ceo" class="form-control ignore" value="" data-pattern="gdEngKor" maxlength="20">
                <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 20</span></span>
                </td>

            </tr>
            <tr>
                <th>업태</th>
                <td>
                <span title="업태를 입력해주세요!" style="position: relative;">
                    <input type="text" name="service" class="form-control ignore" value="" data-pattern="gdEngKor" maxlength="30">
                <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 30</span></span>
                </td>
                <th>종목</th>
                <td>
                <span title="종목을 입력해주세요!" style="position: relative;">
                    <input type="text" name="item" class="form-control ignore" value="" data-pattern="gdEngKor" maxlength="30">
                <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 30</span></span>
                </td>
            </tr>
            <tr>
                <th>사업장 주소</th>
                <td class="input_area" colspan="3">
                    <div class="form-inline mgb5">
                    <span title="우편번호를 입력해주세요!" style="position: relative;">
                        <input type="text" size="7" maxlength="5" name="comZonecode" class="form-control ignore" value="">
                        <input type="hidden" name="comZipcode" value="" class="ignore">
                        <span id="comZipcodeText" class="number display-none">()
                        </span>
                    <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -5px; left: 5px;"><em>0</em> / 5</span></span>
                        <input type="button" onclick="postcode_search('comZonecode', 'comAddress', 'comZipcode');" value="우편번호찾기" class="btn btn-sm btn-gray ignore">
                    </div>
                    <div>
                    <span title="주소를 입력해주세요!">
                        <input type="text" name="comAddress" class="form-control width-2xl ignore" value="">
                    </span>
                        <span title="상세주소를 입력해주세요!">
                        <input type="text" name="comAddressSub" class="form-control width-2xl ignore" value="">
                    </span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>사업자등록증</th>
                <td class="input_area" colspan="3">
                    <div class="form-inline">
                        <input type="file" id="companyCertification" name="companyCertification" class="form-control ignore" accept="image/*, application/pdf" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);"><div class="bootstrap-filestyle input-group"><span class="group-span-filestyle input-group-btn" tabindex="0"><label for="companyCertification" class="btn btn-gray btn-sm"><span class="buttonText">찾아보기</span></label></span><input type="text" class="form-control input-sm" placeholder="" disabled=""> </div>
                    </div>
                    <div class="notice-info mgt10">
                        파일 업로드 최대 사이즈는 2MB 입니다.<br>
                    </div>
                </td>
            </tr>
            </tbody></table>
    </div>
    <iframe id="downloadFrame" style="display:none;"></iframe>
    <script>
        $('input[name="member_type"]').on('change', function () {
            if ($(this).val() === 'business') {
                $(".div-business").removeClass("display-none");
            } else {
                $(".div-business").addClass("display-none");
            }
        });

        $(document).on('change', '.js-certification-checkbox', function(e) {
            var checkbox = this;
            if (checkbox.checked) {
                dialog_confirm('등록된 사업자등록증을 삭제하시겠습니까? 회원정보 최종 저장 시 삭제되며, 복구가 불가합니다.', function(result) {
                    if (!result) {
                        checkbox.checked = false;
                    }
                }, '경고');
            }
        });

        $('#companyCertification').change(function (e) {
            const $fileInput = $('input[name="companyCertification"]');
            const file = $fileInput[0].files[0];
            const fileMaxSize = certificationMaxFileSize || 2; // MB
            const allowedExt = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];

            // 확장자 검사
            const ext = file.name.split('.').pop().toLowerCase();
            if (!allowedExt.includes(ext)) {
                e.target.value = '';
                dialog_alert('등록이 불가한 파일 형식입니다. 이미지(jpg, jpeg, png, gif, bmp, webp, svg) 및 pdf 파일만 업로드 가능합니다.');
                return;
            }

            // 파일 크기 검사
            const fileSizeMB = file.size / (1024 * 1024);
            if (fileSizeMB > fileMaxSize) {
                e.target.value = '';
                dialog_alert('파일은 최대 ' + fileMaxSize.toString() + 'MB 이하로만 등록 가능합니다.');
            }
        });
    </script>
    <div class="table-title gd-help-manual">부가정보 <a href="http://manual.godomall5.godomall.com/data/manual_view.php?category=member__member___member_register#부가정보" target="_blank" class="link-help">페이지 도움말</a></div>
    <div class="input_wrap form-inline">
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody><tr>
                <th>팩스번호</th>
                <td>
                <span title="팩스번호를 입력해주세요!" style="position: relative;">
                    <input type="text" name="fax" value="" maxlength="12" class="form-control js-number-only width-md">
                <span class="bootstrap-maxlength" style="display: none; position: absolute; white-space: nowrap; z-index: 999; top: -12.4781px; left: 155px;"><em>0</em> / 12</span></span>
                </td>
                <th>직업</th>
                <td class="input_area" colspan="3">
                    <select class="form-control " id="job" name="job"><option value="">선택</option><option value="01002001">학생</option><option value="01002002">컴퓨터전문직</option><option value="01002003">회사원</option><option value="01002004">전업주부</option><option value="01002005">건축/토목</option><option value="01002006">금융업</option><option value="01002007">교수직</option><option value="01002008">공무원</option><option value="01002009">의료계</option><option value="01002010">법조계</option><option value="01002011">언론/출판</option><option value="01002012">자영업</option><option value="01002013">방송/연예/예술</option><option value="01002014">기타</option></select>            </td>
            </tr>
            <tr>
                <th>성별</th>
                <td>
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
                    <select class="form-control " id="calendarFl" name="calendarFl"><option value="">선택</option><option value="s">양력</option><option value="l">음력</option></select>                <span title="생일을 입력해주세요!">
                    <input type="text" class="js-datepicker form-control" name="birthDt" value="">
                </span>
                </td>
            </tr>
            <tr>
                <th>결혼여부</th>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="marriFl" value="n" data-target="input[name=marriDate]">
                        미혼
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="marriFl" value="y" data-target="input[name=marriDate]">
                        기혼
                    </label>
                </td>
                <th>결혼기념일</th>
                <td>
                <span title="결혼기념일을 입력해주세요!">
                    <input type="text" class="js-datepicker form-control" name="marriDate" value="">
                </span>
                </td>
            </tr>
            <tr>
                <th>추천인아이디<button type="button" class="btn btn-xs js-tooltip" title="&quot;회원 &amp;gt; 마일리지 / 예치금 관리 &amp;gt; 마일리지 지급 설정&quot;에서 추천인 등록 시 마일리지 지급 설정 가능" data-placement="right" data-width=""><span title="" class="icon-tooltip"></span></button></th>
                <td>
                <span id="recomm" title="추천인 아이디를 입력해주세요!">
                                            <input type="text" name="recommId" id="recommId" class="form-control error" value="">
                        <input type="hidden" name="chkRecommendId" value="">
                        <input type="button" id="btnRecommendCheck" value="확인" class="btn btn-gray btn-sm">
                                    </span>
                    <span id="recommIdMsg" class="input_error_msg"></span>

                </td>
                <th>추천받은횟수</th>
                <td>0회</td>
            </tr>
            <tr>
                <th>관심분야<button type="button" class="btn btn-xs js-tooltip" title="&quot;기본설정&gt;기본정책&gt;코드관리&quot;에서 항목수정/추가 가능" data-placement="right" data-width=""><span title="" class="icon-tooltip"></span></button></th>
                <td class="input_area" colspan="3">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001001">화장품/향수/미용품
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001002">컴퓨터/SW
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001003">의류/패션잡화
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001004">생활/주방용품
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001005">보석/시계/악세사리
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001006">가전/카메라
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="interest[]" value="01001007">서적/음반/비디오
                    </label>
                </td>
            </tr>
            <tr>
                <th>개인정보유효기간<button type="button" class="btn btn-xs js-tooltip" title="설정한 기간 이후 해당 회원의 정보를 휴면회원으로 전환" data-placement="right" data-width=""><span title="" class="icon-tooltip"></span></button></th>
                <td class="input_area" colspan="3">
                    <label class="radio-inline">
                        <input type="radio" name="expirationFl" value="1" checked="checked">
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
                        <input type="radio" name="expirationFl" value="999">
                        탈퇴 시                 </label>
                </td>
            </tr>
            <tr>
                <th>남기는 말씀</th>
                <td class="input_area" colspan="3">
                <span title="메모를 작성해 주세요!">
                <textarea name="memo" rows="5" cols="" class="form-control width90p js-maxlength"></textarea>
                </span>
                </td>
            </tr>
            </tbody></table>
    </div>


    <div class="table-title gd-help-manual">
        개인정보 수집·이용 선택동의 내역
        <a href="http://manual.godomall5.godomall.com/data/manual_view.php?category=member__member___member_register#개인정보수집·이용선택동의내역" target="_blank" class="link-help">페이지 도움말</a></div>
    <div class="form-inline">
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col>
            </colgroup>
            <tbody><tr>
                <th>개인정보<br>수집·이용</th>
                <td>
                    사용안함            </td>
            </tr>
            <tr>
                <th>개인정보 취급위탁</th>
                <td>
                    사용안함            </td>
            </tr>
            <tr>
                <th>개인정보<br>제3자 제공</th>
                <td>
                    사용안함            </td>
            </tr>
            </tbody></table>
    </div>
</form>

<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<?php echo $this->endSection() ?>
