<?= $this->extend('layout/front/main') ?>

<?= $this->section('title') ?><?= esc($review['title']) ?><?= $this->endSection() ?>

<?= $this->section('css') ?>
    <style>
        /* ── 후기 상세 ── */
        .review-detail { background: #fff; }

        /* ── 페이지 헤더 ── */
        .review-detail-header {
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
        .review-detail-back {
            font-size: 14px;
            color: var(--text-mid);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .review-detail-page-title {
            font-size: 14px;
            color: var(--text-gray);
        }

        /* ── 이미지 슬라이더 ── */
        .review-img-slider {
            position: relative;
            background: #f0f0f0;
            overflow: hidden;
        }
        .review-img-slides {
            display: flex;
            transition: transform 0.3s ease;
        }
        .review-img-slide {
            min-width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
        }
        .review-img-slide img {
            width: 100%;
            max-height: 480px;
            object-fit: contain;
        }
        .review-img-dots {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 6px;
        }
        .review-img-dots span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: background .2s;
        }
        .review-img-dots span.active { background: #fff; }

        /* ── 후기 메타 정보 ── */
        .review-meta {
            padding: 16px;
            border-bottom: 1px solid var(--border);
        }
        .review-meta-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .review-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .review-meta-writer {
            font-size: 13px;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .review-meta-writer strong {
            color: var(--text-dark);
            font-weight: 600;
        }
        .review-meta-date {
            font-size: 12px;
            color: var(--text-light);
            flex-shrink: 0;
        }
        .review-header-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 20px;
            margin-bottom: 8px;
        }

        /* ── 본문 ── */
        .review-body {
            padding: 20px 16px;
            font-size: 14px;
            color: var(--text-mid);
            line-height: 1.8;
            border-bottom: 8px solid var(--bg-light);
            min-height: 150px;
        }

        /* ── 담당자 카드 ── */
        .review-manager-card {
            padding: 20px 16px;
            border-bottom: 1px solid var(--border);
        }
        .review-manager-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-align: center;
        }
        .review-manager-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--bg-light);
            border: 1px solid var(--border);
            flex-shrink: 0;
        }
        .review-manager-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .review-manager-no-photo {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--text-light);
        }
        .review-manager-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
        }
        .review-manager-label {
            font-size: 12px;
            color: var(--blue);
            font-weight: 600;
            margin-bottom: 2px;
        }

        /* ── 하단 버튼 ── */
        .review-detail-footer {
            padding: 16px;
            display: flex;
            gap: 8px;
            justify-content: center;
        }
        .review-detail-btn {
            padding: 10px 24px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-mid);
            background: #fff;
            cursor: pointer;
            text-align: center;
        }
        .review-detail-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="review-detail">

        <!-- 페이지 헤더 -->
        <div class="review-detail-header">
            <a href="<?= base_url('review') ?>" class="review-detail-back">
                ← 학습자 후기
            </a>
        </div>

        <!-- ── 이미지 슬라이더 ── -->
        <?php if (!empty($files)): ?>
            <?php
            $imageFiles = array_filter($files, fn($f) =>
            preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $f['file_name'])
            );
            $imageFiles = array_values($imageFiles);
            ?>
            <?php if (!empty($imageFiles)): ?>
                <div class="review-img-slider">
                    <div class="review-img-slides" id="imgSlides">
                        <?php foreach ($imageFiles as $file): ?>
                            <div class="review-img-slide">
                                <img src="<?= base_url($file['file_path']) ?>"
                                     alt="<?= esc($file['file_name']) ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($imageFiles) > 1): ?>
                        <div class="review-img-dots" id="imgDots">
                            <?php foreach ($imageFiles as $i => $file): ?>
                                <span class="<?= $i === 0 ? 'active' : '' ?>"></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- ── 메타 정보 ── -->
        <div class="review-meta">
            <?php if (!empty($header)): ?>
                <div class="review-header-badge"
                     style="background:<?= esc($header['badge_color']) ?>1a;
                         color:<?= esc($header['badge_color']) ?>;
                         border:1px solid <?= esc($header['badge_color']) ?>40;">
                    <?= esc($header['header_name']) ?>
                </div>
            <?php endif; ?>
            <div class="review-meta-title"><?= esc($review['title']) ?></div>
            <div class="review-meta-row">
                <div class="review-meta-writer">
                    <strong><?= esc($review['writer'] ?? '작성자') ?></strong>
                    <?php if (!empty($review['manager'])): ?>
                        <span style="color:var(--border)">|</span>
                        담당자 <?= esc($review['manager']) ?>
                    <?php endif; ?>
                </div>
                <div class="review-meta-date">
                    <?= esc(date('y.m.d', strtotime($review['created_at']))) ?>
                </div>
            </div>
        </div>

        <!-- ── 본문 ── -->
        <div class="review-body">
            <?= nl2br($review['content'] ?? '') ?>
        </div>

        <!-- ── 담당자 카드 ── -->
        <?php if (!empty($review['manager'])): ?>
            <div class="review-manager-card">
                <div class="review-manager-inner">
                    <div class="review-manager-photo">
                        <div class="review-manager-no-photo">👤</div>
                    </div>
                    <div>
                        <div class="review-manager-label">담당자 이름</div>
                        <div class="review-manager-name"><?= esc($review['manager']) ?></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- ── 하단 버튼 ── -->
        <div class="review-detail-footer">
            <a href="<?= base_url('review') ?>" class="review-detail-btn">목록</a>
        </div>

    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            // ── 이미지 슬라이더 ──
            const $slides = $('#imgSlides');
            const $dots   = $('#imgDots span');
            let current   = 0;
            const total   = $dots.length;

            if (total > 1) {
                $dots.on('click', function() {
                    current = $(this).index();
                    update();
                });

                // 터치 스와이프
                let startX = 0;
                $slides[0].addEventListener('touchstart', e => {
                    startX = e.touches[0].clientX;
                });
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