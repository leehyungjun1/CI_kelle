<?= $this->extend('layout/front/main') ?>

<?= $this->section('title') ?><?= esc($course['title']) ?><?= $this->endSection() ?>

<?= $this->section('css') ?>
    <style>
        /* ── 교육과정 상세 ── */
        .curriculum-detail { background: #fff; }

        /* ── 페이지 헤더 ── */
        .curriculum-detail-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .curriculum-detail-back {
            font-size: 14px;
            color: var(--text-mid);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ── 대표 이미지 ── */
        .curriculum-detail-img-wrap {
            width: 100%;
            background: var(--bg-light);
            overflow: hidden;
        }
        .curriculum-detail-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
        }
        .curriculum-detail-img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1A56C4 0%, #0d3a8e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 48px;
        }

        /* ── 이미지 슬라이더 (여러 장일 때) ── */
        .detail-img-slider { position: relative; overflow: hidden; }
        .detail-img-slides { display: flex; transition: transform 0.3s ease; }
        .detail-img-slide  { min-width: 100%; flex-shrink: 0; }
        .detail-img-dots {
            position: absolute; bottom: 10px; left: 0; right: 0;
            display: flex; justify-content: center; gap: 6px;
        }
        .detail-img-dots span {
            width: 6px; height: 6px; border-radius: 50%;
            background: rgba(255,255,255,0.5); cursor: pointer;
        }
        .detail-img-dots span.active { background: #fff; }

        /* ── 메타 정보 ── */
        .curriculum-detail-meta {
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }
        .curriculum-detail-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 20px;
            margin-bottom: 8px;
        }
        .curriculum-detail-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.4;
            margin-bottom: 10px;
        }
        .curriculum-detail-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 10px;
        }
        .curriculum-detail-tag {
            font-size: 12px;
            color: var(--blue);
            background: #EEF4FF;
            padding: 3px 10px;
            border-radius: 12px;
            font-weight: 500;
        }
        .curriculum-detail-info-row {
            display: flex;
            gap: 12px;
            font-size: 12px;
            color: var(--text-gray);
        }

        /* ── 본문 ── */
        .curriculum-detail-body {
            padding: 20px 16px;
            font-size: 14px;
            color: var(--text-mid);
            line-height: 1.8;
            border-bottom: 8px solid var(--bg-light);
            min-height: 150px;
        }

        /* ── 첨부파일 ── */
        .curriculum-detail-files {
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }
        .curriculum-detail-files-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }
        .curriculum-detail-file-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
            color: var(--text-mid);
        }
        .curriculum-detail-file-item:last-child { border-bottom: none; }
        .curriculum-detail-file-item i { color: var(--blue); }

        /* ── 하단 버튼 ── */
        .curriculum-detail-footer {
            padding: 16px;
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .curriculum-detail-btn {
            flex: 1;
            padding: 12px;
            text-align: center;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-mid);
            background: #fff;
            cursor: pointer;
        }
        .curriculum-detail-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
        }
        .curriculum-detail-btn-primary {
            background: var(--blue);
            border-color: var(--blue);
            color: #fff;
        }
        .curriculum-detail-btn-primary:hover {
            background: var(--blue-dark);
            border-color: var(--blue-dark);
            color: #fff;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="curriculum-detail">

        <!-- 페이지 헤더 -->
        <div class="curriculum-detail-header">
            <a href="<?= base_url('curriculum') ?>" class="curriculum-detail-back">
                ← 교육과정
            </a>
        </div>

        <!-- ── 이미지 ── -->
        <?php
        $imageFiles = array_filter($files ?? [], fn($f) =>
        preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $f['file_name'])
        );
        $imageFiles = array_values($imageFiles);
        ?>
        <?php if (!empty($imageFiles)): ?>
            <div class="detail-img-slider curriculum-detail-img-wrap">
                <div class="detail-img-slides" id="detailImgSlides">
                    <?php foreach ($imageFiles as $file): ?>
                        <div class="detail-img-slide">
                            <img src="<?= base_url($file['file_path']) ?>"
                                 alt="<?= esc($file['file_name']) ?>"
                                 class="curriculum-detail-img">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($imageFiles) > 1): ?>
                    <div class="detail-img-dots" id="detailImgDots">
                        <?php foreach ($imageFiles as $i => $file): ?>
                            <span class="<?= $i === 0 ? 'active' : '' ?>"></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="curriculum-detail-img-wrap">
                <div class="curriculum-detail-img-placeholder">
                    <i class="fa fa-graduation-cap"></i>
                </div>
            </div>
        <?php endif; ?>

        <!-- ── 메타 정보 ── -->
        <div class="curriculum-detail-meta">
            <?php if (!empty($header)): ?>
                <div class="curriculum-detail-badge"
                     style="background:<?= esc($header['badge_color']) ?>1a;
                         color:<?= esc($header['badge_color']) ?>;
                         border:1px solid <?= esc($header['badge_color']) ?>40;">
                    <?= esc($header['header_name']) ?>
                </div>
            <?php endif; ?>

            <div class="curriculum-detail-title"><?= esc($course['title']) ?></div>

            <?php if (!empty($course['keywords'])): ?>
                <div class="curriculum-detail-tags">
                    <?php foreach (explode(',', $course['keywords']) as $tag): ?>
                        <?php $tag = trim($tag); ?>
                        <?php if ($tag): ?>
                            <span class="curriculum-detail-tag"><?= esc($tag) ?></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="curriculum-detail-info-row">
                <span>조회 <?= number_format($course['hit'] ?? 0) ?></span>
                <span><?= esc(date('Y.m.d', strtotime($course['created_at']))) ?></span>
            </div>
        </div>

        <!-- ── 본문 ── -->
        <div class="curriculum-detail-body">
            <?= esc($course['content'] ?? '', 'raw') ?>
        </div>

        <!-- ── 첨부파일 (이미지 제외) ── -->
        <?php
        $otherFiles = array_filter($files ?? [], fn($f) =>
        !preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $f['file_name'])
        );
        ?>
        <?php if (!empty($otherFiles)): ?>
            <div class="curriculum-detail-files">
                <div class="curriculum-detail-files-title">첨부파일</div>
                <?php foreach ($otherFiles as $file): ?>
                    <div class="curriculum-detail-file-item">
                        <i class="fa fa-paperclip"></i>
                        <a href="<?= base_url($file['file_path']) ?>" target="_blank">
                            <?= esc($file['file_name']) ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- ── 하단 버튼 ── -->
        <div class="curriculum-detail-footer">
            <a href="<?= base_url('curriculum') ?>" class="curriculum-detail-btn">목록</a>
            <a href="<?= base_url('counsel') ?>" class="curriculum-detail-btn curriculum-detail-btn-primary">
                상담 신청하기
            </a>
        </div>

    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            // ── 이미지 슬라이더 ──
            const $slides = $('#detailImgSlides');
            const $dots   = $('#detailImgDots span');
            let current   = 0;
            const total   = $dots.length;

            if (total > 1) {
                $dots.on('click', function() {
                    current = $(this).index();
                    update();
                });

                let startX = 0;
                $slides[0].addEventListener('touchstart', e => { startX = e.touches[0].clientX; });
                $slides[0].addEventListener('touchend', e => {
                    const diff = startX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 50) {
                        current = diff > 0
                            ? Math.min(current + 1, total - 1)
                            : Math.max(current - 1, 0);
                        update();
                    }
                });
            }

            function update() {
                $slides.css('transform', 'translateX(-' + (current * 100) + '%)');
                $dots.removeClass('active').eq(current).addClass('active');
            }

        });
    </script>
<?= $this->endSection() ?>