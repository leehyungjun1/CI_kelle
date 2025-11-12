<?php echo $this->extend('layouts/admin_sub') ?>

<?php echo $this->section('content') ?>
    <form id="frm" action="<?= url_to('policy_save') ?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($data->id ?? '') ?>">

        <div class="page-header js-affix affix-top" style="width: 1634px;">
            <h3>기본 정보 설정</h3>
            <input type="submit" value="저장" class="btn btn-red btn-register">
        </div>

        <div class="table-title"> 홈페이지 기본 정보 </div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col class="width-xl">
                <col class="width-md">
                <col>
            </colgroup>
            <tbody><tr>
                <th class="require">홈페이지명</th>
                <td class="form-inline"><input type="text" name="site_name" value="<?= old('site_name', $data->site_name ?? '') ?>" class="form-control width-lg"></td>
                <th class="">홈페이지영문명</th>
                <td class="form-inline "><input type="text" name="site_name_en" value="<?= old('site_name_en', $data->site_name_en ?? '') ?>" class="form-control width-lg"></td>
            </tr>
            <tr>
                <th>상단타이틀</th>
                <td class="form-inline">
                    <input type="text" name="top_title" value="<?= old('top_title', $data->top_title ?? '') ?>" class="form-control width-lg">

                </td>
                <th>파비콘</th>
                <td class="form-inline">
                    <input type="file" name="favicon_path">
                    <?php if($data->favicon_path) : ?><img src="<?= base_url('uploads/' . esc($data->favicon_path)) ?>" alt="파비콘 미리보기" width="16" height="16"> <?php endif; ?>
                    <div class="notice-info">이미지사이즈 16x16 pixel, 파일형식 ico로 등록해야 합니다</div>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="table-title gd-help-manual">회사 정보</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col class="width-xl">
                <col class="width-md">
                <col>
            </colgroup>
            <tbody><tr>
                <th>상호(회사명)</th>
                <td class="form-inline">
                    <input type="text" name="company_name" value="<?= old('company_name', $data->company_name ?? '') ?>" class="form-control width-md">
                </td>
                <th>사업자등록번호</th>
                <td class="form-inline">
                    <div style="position: relative;">
                        <input type="text" name="business_number[]" value="<?= esc($business_number[0]) ?>" maxlength="3" class="form-control js-number-only width-3xs"> -
                        <input type="text" name="business_number[]" value="<?= esc($business_number[1]) ?>" maxlength="2" class="form-control js-number-only width-3xs"> -
                        <input type="text" name="business_number[]" value="<?= esc($business_number[2]) ?>" maxlength="5" class="form-control js-number-only width-3xs">
                    </div>
                    <div class="notice-info">
                        사업자번호를 입력하면 쇼핑몰 하단 푸터에 자동으로 사업자정보 공개페이지가 연결됩니다.
                        <a href="https://www.ftc.go.kr/www/contents.do?key=5375" target="_black" class="btn-link">통신판매사업자 정보 공개페이지 &gt;</a>
                    </div>
                </td>
            </tr>
            <tr>
                <th>대표자명</th>
                <td colspan="3" class="form-inline"><input type="text" name="ceo_name" value="<?=esc($data->ceo_name ?? '') ?>" class="form-control width-lg"></td>
            </tr>
            <tr>
                <th>업태</th>
                <td class="form-inline"> <input type="text" name="business_type" value="<?=esc($data->business_type ?? '') ?>" class="form-control width-lg"> </td>
                <th>종목</th> <td class="form-inline"> <input type="text" name="business_item" value="<?=esc($data->business_item ?? '') ?>" class="form-control width-lg">
                </td>
            </tr>
            <tr>
                <th class="require">대표 이메일</th>
                <td colspan="3" class="form-inline">
                <?= email_input('email_id', 'email_domain', old('email_id', $data->email ?? '')) ?>
                </td>
            </tr>
            <tr>
                <th>사업장 주소</th>
                <td colspan="3">
                    <div class="form-inline mgb5" style="position: relative;">
                        <input type="text" name="zipcode" value="<?=esc($data->zipcode ?? '') ?>" id="zonecode" maxlength="5" class="form-control width-2xs">
                        <span id="zipcodeText" class="number display-none">()</span>
                        <input type="button" onclick="postcode_search('zonecode', 'address', 'address2');" value="우편번호찾기" class="btn btn-gray btn-sm">
                    </div>
                    <div class="form-inline">
                        <input type="text" name="address" id="address" value="<?=esc($data->address ?? '') ?>" class="form-control width-2xl">
                        <input type="text" name="address_detail" id="address2" value="<?=esc($data->address_detail ?? '') ?>" class="form-control width-2xl">
                    </div>
                </td>
            </tr>
            <tr>
                <th>대표전화</th>
                <td class="form-inline" style="position: relative;"><input type="text" name="phone" value="<?=old('phone', $data->phone ?? '') ?>" maxlength="13" class="form-control js-tel-only width-md"></td>
                <th>팩스번호</th>
                <td class="form-inline" style="position: relative;"><input type="text" name="fax" value="<?=old('phone', $data->fax ?? '') ?>" maxlength="13" class="form-control js-tel-only width-md"></td>
            </tr>
            </tbody>
        </table>
        <div class="table-title gd-help-manual"> 고객센터 </div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col class="width-2xl">
                <col class="width-md">
                <col>
            </colgroup>
            <tbody><tr>
                <th>전화번호</th>
                <td class="form-inline">
                    <div class="mgb5"><input type="text" name="cs_phone1" value="<?= old('cs_phone1', $data->cs_phone1 ?? '') ?>" maxlength="13" class="form-control js-tel-only width-md"></div>
                    <div><input type="text" name="cs_phone2" value="<?=old('cs_phone2', $data->cs_phone2 ?? '') ?>" maxlength="15" class="form-control js-tel-only width-md"></div>
                </td>
                <th>팩스번호</th>
                <td class="form-inline" style="position: relative;"><input type="text" name="cs_fax" value="<?=old('phone', $data->cs_fax ?? '') ?>" maxlength="15" class="form-control js-tel-only width-md"></td>
            </tr>
            <tr>
                <th>이메일</th>
                <td colspan="3" class="form-inline">
                <?= email_input('cs_email_id', 'cs_email_domain', old('cs_email_id', $data->cs_email ?? '')) ?>
                </td>
            </tr>
            <tr>
                <th>운영시간</th>
                <td colspan="3" class="form-inline">
                    <textarea name="business_hours" rows="4" class="form-control width-2xl"><?=old('business_hours',$data->business_hours ?? '') ?></textarea>
                </td>
            </tr>
            </tbody></table>

        <div class="table-title gd-help-manual">
            회사소개 내용 수정
            <a href="http://manual.godomall5.godomall.com/data/manual_view.php?category=policy__basic___base_info#회사소개내용수정" target="_blank" class="link-help">페이지 도움말</a></div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col>
            </colgroup>
            <tbody><tr>
                <th>회사소개 내용</th>
                <td class="form-inline">
                    <div id="editor"></div>
                </td>
            </tr>
            </tbody></table>


    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const editor = new toastui.Editor({
                el: document.querySelector('#editor'),
                height: '400px',
                initialEditType: 'wysiwyg',
                previewStyle: 'vertical',
                hooks: {
                    addImageBlobHook: (blob, callback) => {
                        const formData = new FormData();
                        formData.append('file', blob);

                        fetch("<?= site_url('common/uploads/image') ?>", {
                            method: 'POST',
                            body: formData
                        })
                            .then(res => res.json())
                            .then(data => {
                                if(data.url){
                                    callback(data.url, 'alt text');
                                } else {
                                    alert(data.error?.message || '업로드 실패');
                                }
                            })
                            .catch(() => alert('업로드 실패'));
                        return false;
                    }
                }
            });
        });

        $(document).ready(function () {
            $('input[name="business_number[]"]').on('input', function () {
                const maxLength = $(this).attr('maxlength');
                const valueLength = $(this).val().length;

                // 글자 수가 maxlength만큼 채워졌을 때
                if (valueLength >= maxLength) {
                    // 다음 input으로 포커스 이동
                    $(this).nextAll('input[name="business_number[]"]').first().focus();
                }
            });

            $(document).on("input", ".js-tel-only", function (e) {
                const isBackspace = e.originalEvent && e.originalEvent.inputType === "deleteContentBackward";
                let value = $(this).val().replace(/[^0-9]/g, ''); // 숫자만

                // 빈 값이면 바로 리턴
                if (value === '') {
                    $(this).val('');
                    return;
                }

                // 백스페이스 입력 중일 때는 바로 리턴 (하이픈 재삽입 방지)
                if (isBackspace) {
                    return;
                }

                let formatted = value;
                if (/^02/.test(value)) {
                    if (value.length <= 5) {
                        formatted = value.replace(/^(\d{2})(\d{0,3})/, '$1-$2');
                    } else if (value.length <= 9) {
                        formatted = value.replace(/^(\d{2})(\d{3,4})(\d{0,4})/, '$1-$2-$3');
                    } else {
                        formatted = value.substring(0, 10).replace(/^(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
                    }
                } else if (/^1[568]\d{2}/.test(value) && value.length >= 5) {
                    formatted = value.replace(/^(\d{4})(\d{0,4})/, '$1-$2');
                } else if (/^050\d/.test(value)) {
                    formatted = value.replace(/^(\d{4})(\d{3,4})(\d{0,4})/, '$1-$2-$3');
                } else if (/^0\d{2}/.test(value)) {
                    if (value.length <= 7) {
                        formatted = value.replace(/^(\d{3})(\d{0,4})/, '$1-$2');
                    } else {
                        formatted = value.replace(/^(\d{3})(\d{3,4})(\d{0,4})/, '$1-$2-$3');
                    }
                } else if (/^01\d/.test(value)) {
                    formatted = value.replace(/^(\d{3})(\d{3,4})(\d{0,4})/, '$1-$2-$3');
                }

                $(this).val(formatted);
            });
        });

    </script>

<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<?php echo $this->endSection() ?>

<style>
    .ck-editor__editable_inline {
        min-height: 400px !important;
        height: 400px !important;
    }
</style>
