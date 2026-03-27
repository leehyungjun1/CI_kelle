<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>기본 정보 설정<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form id="frm" action="<?= url_to('policy_save') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($data->id ?? '') ?>">

        <div class="page-header">
            <h3>기본 정보 설정</h3>
            <div class="btn-group">
                <input type="button" value="저장" class="btn btn-red btn-register">
            </div>
        </div>

        <!-- ── 홈페이지 기본 정보 ── -->
        <div class="table-title">홈페이지 기본 정보</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody>
            <tr>
                <th class="require">홈페이지명</th>
                <td>
                    <input type="text" name="site_name"
                           value="<?= old('site_name', $data->site_name ?? '') ?>"
                           class="form-control width-sm">
                </td>
                <th>홈페이지영문명</th>
                <td>
                    <input type="text" name="site_name_en"
                           value="<?= old('site_name_en', $data->site_name_en ?? '') ?>"
                           class="form-control width-sm">
                </td>
            </tr>
            <tr>
                <th>상단타이틀</th>
                <td>
                    <input type="text" name="top_title"
                           value="<?= old('top_title', $data->top_title ?? '') ?>"
                           class="form-control width-sm">
                </td>
                <th>파비콘</th>
                <td>
                    <label class="btn btn-gray btn-sm upload-label">
                        찾아보기
                        <input type="file" name="favicon_path" style="display:none;">
                    </label>
                    <?php if (!empty($data->favicon_path)): ?>
                        <img src="<?= base_url('uploads/'.esc($data->favicon_path)) ?>"
                             alt="파비콘" width="16" height="16" style="margin-left:8px;">
                    <?php endif; ?>
                    <div class="notice-info">이미지사이즈 16x16 pixel, 파일형식 ico로 등록해야 합니다.</div>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- ── 회사 정보 ── -->
        <div class="table-title">회사 정보</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody>
            <tr>
                <th>상호(회사명)</th>
                <td>
                    <input type="text" name="company_name"
                           value="<?= old('company_name', $data->company_name ?? '') ?>"
                           class="form-control width-sm">
                </td>
                <th>사업자등록번호</th>
                <td>
                    <?php
                    // 배열로 저장된 번호를 하이픈으로 합치기
                    $fullBusiNo = implode('-', array_filter([
                        $business_number[0] ?? '',
                        $business_number[1] ?? '',
                        $business_number[2] ?? '',
                    ]));
                    ?>
                    <?= busino_input($fullBusiNo) ?>
                    <div class="notice-info">
                        사업자번호를 입력하면 푸터에 자동으로 사업자정보 공개페이지가 연결됩니다.
                        <a href="https://www.ftc.go.kr/www/contents.do?key=5375" target="_blank" class="btn-link">
                            통신판매사업자 정보 공개페이지 &gt;
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <th>대표자명</th>
                <td colspan="3">
                    <input type="text" name="ceo_name"
                           value="<?= esc($data->ceo_name ?? '') ?>"
                           class="form-control width-sm">
                </td>
            </tr>
            <tr>
                <th>업태</th>
                <td>
                    <input type="text" name="business_type"
                           value="<?= esc($data->business_type ?? '') ?>"
                           class="form-control width-sm">
                </td>
                <th>종목</th>
                <td>
                    <input type="text" name="business_item"
                           value="<?= esc($data->business_item ?? '') ?>"
                           class="form-control width-sm">
                </td>
            </tr>
            <tr>
                <th class="require">대표 이메일</th>
                <td colspan="3">
                    <?= email_input('email_id', 'email_domain', old('email_id', $data->email ?? '')) ?>
                </td>
            </tr>
            <tr>
                <th>사업장 주소</th>
                <td colspan="3">
                    <?= address_input('zonecode', 'address', 'address2',
                        $data->zipcode ?? '',
                        $data->address ?? '',
                        $data->address_detail ?? ''
                    ) ?>
                </td>
            </tr>
            <tr>
                <th>대표전화</th>
                <td>
                    <input type="text" name="phone"
                           value="<?= old('phone', $data->phone ?? '') ?>"
                           maxlength="13" class="form-control js-tel width-md">
                </td>
                <th>팩스번호</th>
                <td>
                    <input type="text" name="fax"
                           value="<?= old('fax', $data->fax ?? '') ?>"
                           maxlength="13" class="form-control js-tel width-md">
                </td>
            </tr>
            </tbody>
        </table>

        <!-- ── 고객센터 ── -->
        <div class="table-title">고객센터</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-sm">
                <col class="width-3xl">
                <col class="width-sm">
                <col class="">
            </colgroup>
            <tbody>
            <tr>
                <th>전화번호</th>
                <td>
                    <div class="mgb5">
                        <input type="text" name="cs_phone1"
                               value="<?= old('cs_phone1', $data->cs_phone1 ?? '') ?>"
                               maxlength="13" class="form-control js-tel width-md">
                    </div>
                    <div>
                        <input type="text" name="cs_phone2"
                               value="<?= old('cs_phone2', $data->cs_phone2 ?? '') ?>"
                               maxlength="15" class="form-control js-tel width-md">
                    </div>
                </td>
                <th>팩스번호</th>
                <td>
                    <input type="text" name="cs_fax"
                           value="<?= old('cs_fax', $data->cs_fax ?? '') ?>"
                           maxlength="15" class="form-control js-tel width-md">
                </td>
            </tr>
            <tr>
                <th>이메일</th>
                <td colspan="3">
                    <?= email_input('cs_email_id', 'cs_email_domain', old('cs_email_id', $data->cs_email ?? '')) ?>
                </td>
            </tr>
            <tr>
                <th>운영시간</th>
                <td colspan="3">
                    <textarea name="business_hours" rows="4" class="form-control width-2xl"><?= old('business_hours', $data->business_hours ?? '') ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- ── 회사소개 ── -->
        <div class="table-title">회사소개 내용</div>
        <table class="table table-cols">
            <colgroup>
                <col class="width-md">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th>회사소개 내용</th>
                <td>
                    <div id="editor"></div>
                </td>
            </tr>
            </tbody>
        </table>

    </form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        $(document).ready(function() {
            // ── 토스트 에디터 ──
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
                                if (data.url) {
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
    </script>
<?= $this->endSection() ?>