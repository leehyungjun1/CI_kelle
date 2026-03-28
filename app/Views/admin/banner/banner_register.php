<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?><?= esc($pageTitle) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form id="frm" action="<?= site_url('admin/banner/banner_submit') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="group_id" value="<?= esc($group_id) ?>">
        <input type="hidden" id="deleteIds" name="delete_ids[]" value="">

        <div class="page-header">
            <h3><?= esc($pageTitle) ?></h3>
            <div class="btn-group">
                <input type="button" value="목록" class="btn btn-white btn-icon-list"
                       onclick="goList('<?= base_url('admin/banner/banner_list') ?>')">
                <input type="button" value="슬라이드 추가" class="btn btn-white" id="btnAddSlide">
                <input type="button" value="저장" class="btn btn-red btn-register">
            </div>
        </div>

        <div class="table-title">
            슬라이드 배너 편집
            <span style="font-size:12px; color:#999; font-weight:normal; margin-left:8px;">
            드래그로 순서를 변경할 수 있습니다.
        </span>
        </div>

        <!-- 슬라이드 목록 -->
        <div id="slideList">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="slide-item" data-index="<?= $i ?>">
                    <input type="hidden" name="banner_id[<?= $i ?>]" value="<?= esc($banner['id'] ?? '') ?>">
                    <input type="hidden" name="keep_image[<?= $i ?>]" class="keep-image" value="<?= esc($banner['image_path'] ?? '') ?>">

                    <div class="slide-header">
                        <span class="drag-handle"><i class="fa fa-bars"></i></span>
                        <span class="slide-num">슬라이드 <?= $i + 1 ?></span>
                        <div class="slide-header-right">
                            <label class="radio-inline">
                                <input type="radio" name="is_use[<?= $i ?>]" value="Y"
                                    <?= ($banner['is_use'] ?? 'Y') === 'Y' ? 'checked' : '' ?>>사용
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_use[<?= $i ?>]" value="N"
                                    <?= ($banner['is_use'] ?? '') === 'N' ? 'checked' : '' ?>>미사용
                            </label>
                            <input type="number" name="order_no[<?= $i ?>]"
                                   value="<?= esc($banner['order_no'] ?? $i + 1) ?>"
                                   class="form-control" style="width:55px; display:inline-block; text-align:center;">
                            <button type="button" class="btn btn-white btn-sm btn-remove-slide"
                                    data-id="<?= esc($banner['id'] ?? '') ?>">
                                <i class="fa fa-times"></i> 삭제
                            </button>
                        </div>
                    </div>

                    <div class="slide-body">
                        <table class="table table-cols">
                            <colgroup>
                                <col class="width-sm">
                                <col class="width-3xl">
                                <col class="width-sm">
                                <col class="">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th class="require">타이틀</th>
                                <td>
                                    <input type="text" name="title[<?= $i ?>]"
                                           value="<?= esc($banner['title'] ?? '') ?>"
                                           class="form-control width-3xl slide-title"
                                           placeholder="슬라이드 타이틀">
                                </td>
                                <th>링크 URL</th>
                                <td>
                                    <input type="text" name="link_url[<?= $i ?>]"
                                           value="<?= esc($banner['link_url'] ?? '') ?>"
                                           class="form-control width-3xl"
                                           placeholder="https://example.com">
                                </td>
                            </tr>
                            <tr>
                                <th>내용</th>
                                <td colspan="3">
                            <textarea name="description[<?= $i ?>]" rows="2"
                                      class="form-control width-3xl slide-desc"
                                      placeholder="슬라이드 부제목 또는 내용"><?= esc($banner['description'] ?? '') ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>배경 이미지</th>
                                <td colspan="3">
                                    <div class="form-inline mgb5">
                                        <label class="btn btn-gray btn-sm upload-label">
                                            찾아보기
                                            <input type="file" name="image_file[<?= $i ?>]"
                                                   accept="image/*" style="display:none;"
                                                   class="slide-image-input">
                                        </label>
                                        <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">
                                    <?= !empty($banner['image_path']) ? basename($banner['image_path']) : '선택된 파일 없음' ?>
                                </span>
                                    </div>
                                    <?php if (!empty($banner['image_path'])): ?>
                                        <div class="current-image mgt5">
                                            <img src="<?= base_url($banner['image_path']) ?>"
                                                 class="slide-preview-img"
                                                 style="max-width:200px; max-height:100px; object-fit:cover;
                                                border:1px solid #ddd; border-radius:4px;">
                                            <div style="font-size:11px; color:#999; margin-top:3px;">현재 이미지</div>
                                        </div>
                                    <?php else: ?>
                                        <div class="current-image mgt5" style="display:none;">
                                            <img src="" class="slide-preview-img"
                                                 style="max-width:200px; max-height:100px; object-fit:cover;
                                                border:1px solid #ddd; border-radius:4px;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="notice-info mgt5">권장 크기: 1200 x 500px, JPG/PNG/WEBP</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- 미리보기 -->
                        <div class="slide-preview" style="
                                position:relative; height:120px; border-radius:6px; overflow:hidden;
                                background:#f6f6f6 <?= !empty($banner['image_path']) ? 'url('.base_url($banner['image_path']).')' : '' ?> center/cover no-repeat;
                                margin-top:8px; border:1px solid #ddd;">
                            <div style="position:absolute; inset:0; background:rgba(0,0,0,0.3);"></div>
                            <div style="position:relative; z-index:2; padding:20px; color:#fff; text-shadow:0 1px 4px rgba(0,0,0,0.5);">
                                <div class="preview-title" style="font-size:16px; font-weight:700;">
                                    <?= esc($banner['title'] ?? '타이틀') ?>
                                </div>
                                <div class="preview-desc" style="font-size:12px; opacity:0.9; margin-top:4px;">
                                    <?= esc($banner['description'] ?? '내용') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </form>

    <!-- 슬라이드 템플릿 (JS용) -->
    <script type="text/template" id="slideTpl">
        <div class="slide-item" data-index="__INDEX__">
            <input type="hidden" name="banner_id[__INDEX__]" value="">
            <input type="hidden" name="keep_image[__INDEX__]" class="keep-image" value="">
            <div class="slide-header">
                <span class="drag-handle"><i class="fa fa-bars"></i></span>
                <span class="slide-num">슬라이드 __NUM__</span>
                <div class="slide-header-right">
                    <label class="radio-inline">
                        <input type="radio" name="is_use[__INDEX__]" value="Y" checked>사용
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_use[__INDEX__]" value="N">미사용
                    </label>
                    <input type="number" name="order_no[__INDEX__]" value="__ORDER__"
                           class="form-control" style="width:55px; display:inline-block; text-align:center;">
                    <button type="button" class="btn btn-white btn-sm btn-remove-slide" data-id="">
                        <i class="fa fa-times"></i> 삭제
                    </button>
                </div>
            </div>
            <div class="slide-body">
                <table class="table table-cols">
                    <colgroup>
                        <col class="width-sm"><col class="width-3xl">
                        <col class="width-sm"><col class="">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th class="require">타이틀</th>
                        <td>
                            <input type="text" name="title[__INDEX__]" value=""
                                   class="form-control width-3xl slide-title" placeholder="슬라이드 타이틀">
                        </td>
                        <th>링크 URL</th>
                        <td>
                            <input type="text" name="link_url[__INDEX__]" value=""
                                   class="form-control width-3xl" placeholder="https://example.com">
                        </td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td colspan="3">
                    <textarea name="description[__INDEX__]" rows="2"
                              class="form-control width-3xl slide-desc"
                              placeholder="슬라이드 부제목 또는 내용"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>배경 이미지</th>
                        <td colspan="3">
                            <div class="form-inline mgb5">
                                <label class="btn btn-gray btn-sm upload-label">
                                    찾아보기
                                    <input type="file" name="image_file[__INDEX__]"
                                           accept="image/*" style="display:none;" class="slide-image-input">
                                </label>
                                <span class="upload-filename text-muted" style="margin-left:5px; font-size:12px;">선택된 파일 없음</span>
                            </div>
                            <div class="current-image mgt5" style="display:none;">
                                <img src="" class="slide-preview-img"
                                     style="max-width:200px; max-height:100px; object-fit:cover;
                                    border:1px solid #ddd; border-radius:4px;">
                            </div>
                            <div class="notice-info mgt5">권장 크기: 1200 x 500px, JPG/PNG/WEBP</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="slide-preview" style="
            position:relative; height:120px; border-radius:6px; overflow:hidden;
            background:#f6f6f6 center/cover no-repeat;
            margin-top:8px; border:1px solid #ddd;">
                    <div style="position:absolute; inset:0; background:rgba(0,0,0,0.3);"></div>
                    <div style="position:relative; z-index:2; padding:20px; color:#fff; text-shadow:0 1px 4px rgba(0,0,0,0.5);">
                        <div class="preview-title" style="font-size:16px; font-weight:700;">타이틀</div>
                        <div class="preview-desc" style="font-size:12px; opacity:0.9; margin-top:4px;">내용</div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <style>
        .slide-item {
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 16px;
            background: #fff;
        }
        .slide-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            background: #f8f8f8;
            border-bottom: 1px solid #ddd;
            border-radius: 6px 6px 0 0;
        }
        .slide-header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .slide-num {
            font-weight: bold;
            color: #444;
            font-size: 13px;
        }
        .drag-handle {
            cursor: move;
            color: #aaa;
            font-size: 16px;
            padding: 0 4px;
        }
        .drag-handle:hover { color: #666; }
        .slide-body { padding: 15px; }
        .slide-body .table-cols { margin-bottom: 0; }
    </style>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            let deleteIds = [];

            // ── 드래그 앤 드롭 ──
            $('#slideList').sortable({
                handle: '.drag-handle',
                update: function() {
                    reindexSlides();
                }
            });

            // ── 슬라이드 추가 ──
            $('#btnAddSlide').on('click', function() {
                const count = $('#slideList .slide-item').length;
                const tpl   = $('#slideTpl').html()
                    .replace(/__INDEX__/g, count)
                    .replace(/__NUM__/g, count + 1)
                    .replace(/__ORDER__/g, count + 1);
                $('#slideList').append(tpl);
            });

            // ── 슬라이드 삭제 ──
            $(document).on('click', '.btn-remove-slide', function() {
                const $item = $(this).closest('.slide-item');
                const id    = $(this).data('id');

                if ($('#slideList .slide-item').length <= 1) {
                    alert('최소 1개의 슬라이드는 있어야 합니다.');
                    return;
                }

                if (id) deleteIds.push(id);
                $item.remove();
                reindexSlides();
            });

            // ── 이미지 선택 시 미리보기 ──
            $(document).on('change', '.slide-image-input', function() {
                const file  = this.files[0];
                if (!file) return;

                const $item = $(this).closest('.slide-item');
                $item.find('.upload-filename').text(file.name);

                const reader = new FileReader();
                reader.onload = function(e) {
                    $item.find('.slide-preview-img').attr('src', e.target.result);
                    $item.find('.current-image').show();
                    $item.find('.slide-preview').css('background-image', 'url(' + e.target.result + ')');
                    $item.find('.keep-image').val('');
                };
                reader.readAsDataURL(file);
            });

            // ── 타이틀/내용 실시간 미리보기 ──
            $(document).on('input', '.slide-title', function() {
                $(this).closest('.slide-item').find('.preview-title').text($(this).val() || '타이틀');
            });
            $(document).on('input', '.slide-desc', function() {
                $(this).closest('.slide-item').find('.preview-desc').text($(this).val() || '내용');
            });

            // ── 저장 시 삭제 ID 세팅 ──
            $(document).on('click', '.btn-register', function() {
                $('input[name="delete_ids[]"]').remove();
                deleteIds.forEach(function(id) {
                    $('<input>').attr({type:'hidden', name:'delete_ids[]', value:id}).appendTo('#frm');
                });
            });

            // ── 인덱스 재정렬 ──
            function reindexSlides() {
                $('#slideList .slide-item').each(function(i) {
                    const $item = $(this);
                    $item.attr('data-index', i);
                    $item.find('.slide-num').text('슬라이드 ' + (i + 1));

                    // name 속성 인덱스 교체
                    $item.find('[name]').each(function() {
                        const name = $(this).attr('name');
                        $(this).attr('name', name.replace(/\[\d+\]/, '[' + i + ']'));
                    });

                    // 순서 번호 업데이트
                    $item.find('input[name^="order_no"]').val(i + 1);
                });
            }

        });
    </script>
<?= $this->endSection() ?>