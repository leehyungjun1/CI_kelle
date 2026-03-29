<?= $this->extend('layout/front/main') ?>

<?= $this->section('title') ?>학습자 후기<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <style>
        /* ── 후기 페이지 ── */
        .review-page { padding: 0; }

        /* ── 페이지 헤더 ── */
        .review-page-header {
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
        .review-page-back {
            font-size: 18px;
            color: var(--text-mid);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
        }
        .review-page-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ── 이달의 우수 후기 ── */
        .featured-section {
            padding: 20px 16px;
            background: #fff;
            border-bottom: 8px solid var(--bg-light);
        }
        .featured-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .featured-title em {
            color: var(--blue);
            font-style: normal;
        }
        .featured-slider-wrap {
            position: relative;
            overflow: hidden;
        }
        .featured-slider {
            display: flex;
            transition: transform 0.4s ease;
            gap: 12px;
        }
        .featured-slide {
            min-width: calc(70% - 6px);
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }
        .featured-slide-inner {
            display: flex;
            gap: 0;
            height: 260px;
        }
        .featured-info {
            flex: 1;
            padding: 18px;
            display: flex;
            flex-direction: column;
        }
        .featured-header-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
            align-self: flex-start;
        }
        .featured-writer {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .featured-manager {
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 8px;
        }
        .featured-stars {
            font-size: 13px;
            color: #e74c3c;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .featured-stars span {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 13px;
        }
        .featured-content {
            font-size: 13px;
            color: var(--text-mid);
            line-height: 1.7;
            flex: 1;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
        .featured-date {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 10px;
        }
        .featured-img {
            width: 45%;
            flex-shrink: 0;
            overflow: hidden;
            background: var(--bg-light);
        }
        .featured-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .featured-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 12px;
        }
        .featured-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--border);
            cursor: pointer;
            transition: background .2s;
        }
        .featured-dots span.active { background: var(--blue); }

        /* ── KLLE REVIEW 섹션 ── */
        .klle-review-section {
            padding: 20px 16px;
            background: #fff;
            border-bottom: 8px solid var(--bg-light);
        }
        .klle-review-title {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }
        .klle-review-sub {
            font-size: 13px;
            color: var(--text-gray);
            margin-bottom: 14px;
        }

        /* 롤링 시스템 표시 */
        .rolling-status {
            background: var(--bg-light);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .rolling-status::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #4CAF50;
            flex-shrink: 0;
        }

        /* 갤러리 그리드 */
        .review-gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4px;
            margin-bottom: 14px;
        }
        .review-gallery-item {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            cursor: pointer;
            background: var(--bg-light);
        }
        .review-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s;
        }
        .review-gallery-item:hover img { transform: scale(1.05); }
        .review-gallery-more {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        /* ── 검색 필터 ── */
        .review-filter {
            padding: 14px 16px;
            background: #fff;
            border-bottom: 1px solid var(--border);
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        .review-filter select {
            height: 36px;
            padding: 0 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-mid);
            background: #fff;
            outline: none;
        }
        .review-filter-input-wrap {
            flex: 1;
            display: flex;
            gap: 6px;
        }
        .review-filter input {
            flex: 1;
            height: 36px;
            padding: 0 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 13px;
            outline: none;
        }
        .review-filter-btn {
            height: 36px;
            padding: 0 16px;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            flex-shrink: 0;
        }

        /* 키워드 태그 */
        .filter-tags {
            padding: 10px 16px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            background: #fff;
            border-bottom: 8px solid var(--bg-light);
        }
        .filter-tag {
            padding: 4px 12px;
            border: 1px solid var(--border);
            border-radius: 20px;
            font-size: 12px;
            color: var(--text-mid);
            cursor: pointer;
            transition: all .2s;
        }
        .filter-tag.active,
        .filter-tag:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: #EEF4FF;
        }

        /* ── 리스트 섹션 ── */
        .review-list-section {
            background: #fff;
            padding: 0 16px;
        }
        .review-list-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: background .15s;
        }
        .review-list-item:last-child { border-bottom: none; }
        .review-list-item:hover { background: var(--bg-light); margin: 0 -16px; padding: 14px 16px; }
        .review-list-thumb {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: var(--bg-light);
        }
        .review-list-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .review-list-no-thumb {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 20px;
        }
        .review-list-info { flex: 1; min-width: 0; }
        .review-list-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            margin-bottom: 4px;
        }
        .review-list-meta {
            font-size: 12px;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .review-list-date {
            font-size: 12px;
            color: var(--text-light);
            flex-shrink: 0;
            margin-left: auto;
        }

        /* ── 더보기 버튼 ── */
        .review-more-btn {
            display: block;
            width: calc(100% - 32px);
            margin: 16px 16px;
            padding: 14px;
            text-align: center;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-mid);
            background: #fff;
            cursor: pointer;
            transition: all .2s;
        }
        .review-more-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        /* ── 후기 작성하기 ── */
        .review-write-btn {
            display: block;
            width: 100%;
            padding: 18px;
            text-align: center;
            background: var(--blue-dark);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            border: none;
        }
        .review-write-btn:hover { background: var(--blue); color: #fff; }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="review-page">

        <!-- 페이지 헤더 -->
        <div class="review-page-header">
            <a href="javascript:history.back()" class="review-page-back">
                ← 학습자 후기
            </a>
        </div>

        <!-- ── 이달의 우수 후기 ── -->
        <?php if (!empty($featured)): ?>
            <div class="featured-section">
                <div class="featured-title">
                    이달의 우수 <em>학습자</em> 후기
                </div>
                <div class="featured-slider-wrap">
                    <div class="featured-slider" id="featuredSlider">
                        <?php foreach ($featured as $i => $item): ?>
                            <div class="featured-slide">
                                <div class="featured-slide-inner">
                                    <div class="featured-info">
                                        <?php
                                        $header = $headersMap[$item['header_id'] ?? 0] ?? null;
                                        if ($header):
                                            ?>
                                            <span class="featured-header-badge" style="
                                                background: <?= esc($header['badge_color']) ?>1a;
                                                color: <?= esc($header['badge_color']) ?>;
                                                border: 1px solid <?= esc($header['badge_color']) ?>40;">
                                    <?= esc($header['header_name']) ?>
                                </span>
                                        <?php endif; ?>
                                        <div class="featured-writer">🎓 <?= esc($item['writer'] ?? '학습자') ?>님</div>
                                        <div class="featured-manager">담당자 <?= esc($item['manager'] ?? '홍길동') ?></div>
                                        <div class="featured-stars">
                                            <?php
                                            $rating = (int)($item['rating'] ?? 0);
                                            echo str_repeat('❤️', min($rating, 5));
                                            ?>
                                            <span><?= number_format($rating, 1) ?></span>
                                        </div>
                                        <div class="featured-content">
                                            <?= nl2br(esc($item['content'] ?? '')) ?>
                                        </div>
                                        <div class="featured-date">
                                            <?= esc(date('y.m.d', strtotime($item['created_at']))) ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($item['thumb'])): ?>
                                        <div class="featured-img">
                                            <img src="<?= base_url($item['thumb']) ?>" alt="후기 이미지">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="featured-dots" id="featuredDots">
                    <?php foreach ($featured as $i => $item): ?>
                        <span class="<?= $i === 0 ? 'active' : '' ?>"></span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- ── KLLE REVIEW ── -->
        <div class="klle-review-section">
            <div class="klle-review-title">KLLE REVIEW</div>
            <div class="klle-review-sub">센터 학습자님 리얼 후기</div>
            <div class="rolling-status">클린 리뷰 시스템이 작동 중입니다.</div>

            <!-- 갤러리 그리드 (이미지 있는 후기 최대 5개) -->
            <?php
            $galleryItems = array_filter($reviews, fn($r) => !empty($r['thumb']));
            $galleryItems = array_slice(array_values($galleryItems), 0, 5);
            ?>
            <?php if (!empty($galleryItems)): ?>
                <div class="review-gallery">
                    <?php foreach ($galleryItems as $i => $item): ?>
                        <?php if ($i < 4): ?>
                            <div class="review-gallery-item"
                                 onclick="location.href='<?= base_url('review/'.esc($item['id'])) ?>'">
                                <img src="<?= base_url($item['thumb']) ?>" alt="<?= esc($item['title']) ?>">
                            </div>
                        <?php elseif ($i === 4): ?>
                            <div class="review-gallery-item"
                                 onclick="location.href='<?= base_url('review') ?>'">
                                <img src="<?= base_url($item['thumb']) ?>" alt="더보기">
                                <div class="review-gallery-more">+ 더보기</div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- ── 검색 필터 ── -->
        <form id="frmSearch" method="get" action="<?= base_url('review') ?>">
            <div class="review-filter">
                <?php if (!empty($headers)): ?>
                    <select name="header_id" onchange="this.form.submit()">
                        <option value="">과정 전체</option>
                        <?php foreach ($headers as $header): ?>
                            <option value="<?= esc($header['id']) ?>"
                                <?= (string)($headerId ?? '') === (string)$header['id'] ? 'selected' : '' ?>>
                                <?= esc($header['header_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <div class="review-filter-input-wrap">
                    <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>"
                           placeholder="검색어를 입력해주세요.">
                    <button type="submit" class="review-filter-btn">검색</button>
                </div>
            </div>

            <!-- 키워드 태그 -->
            <?php if (!empty($headers)): ?>
                <div class="filter-tags">
                    <?php foreach ($headers as $header): ?>
                        <a href="<?= base_url('review?header_id='.(int)$header['id']) ?>"
                           class="filter-tag <?= (string)($headerId ?? '') === (string)$header['id'] ? 'active' : '' ?>">
                            <?= esc($header['header_name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </form>

        <!-- ── 리스트 ── -->
        <div class="review-list-section" id="reviewList">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-list-item"
                         onclick="location.href='<?= base_url('review/'.esc($review['id'])) ?>'">
                        <div class="review-list-thumb">
                            <?php if (!empty($review['thumb'])): ?>
                                <img src="<?= base_url($review['thumb']) ?>" alt="후기">
                            <?php else: ?>
                                <div class="review-list-no-thumb">📝</div>
                            <?php endif; ?>
                        </div>
                        <div class="review-list-info">
                            <div class="review-list-title"><?= esc($review['title']) ?></div>
                            <div class="review-list-meta">
                                <?= esc($review['writer'] ?? '') ?>
                                <?php if (!empty($review['manager'])): ?>
                                    <span style="color:var(--border)">|</span>
                                    담당자 <?= esc($review['manager']) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="review-list-date">
                            <?= esc(date('y.m.d', strtotime($review['created_at']))) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align:center; padding:40px 0; color:var(--text-gray);">
                    등록된 후기가 없습니다.
                </div>
            <?php endif; ?>
        </div>

        <!-- 더보기 버튼 -->
        <?php if ($page < $totalPage): ?>
            <button class="review-more-btn" id="btnMoreReview"
                    data-page="<?= $page ?>"
                    data-header-id="<?= esc($headerId ?? '') ?>"
                    data-keyword="<?= esc($keyword ?? '') ?>">
                더 보기
            </button>
        <?php endif; ?>

        <!-- 후기 작성하기 -->
        <a href="<?= base_url('review/write') ?>" class="review-write-btn">
            후기 작성하기
        </a>

    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            // ── 우수 후기 슬라이더 ──
            const $slider = $('#featuredSlider');
            const $dots   = $('#featuredDots span');
            let current   = 0;
            const total   = $dots.length;

            function updateFeatured(idx) {
                current = (idx + total) % total;
                const slideWidth = $('.featured-slide').outerWidth(true);
                $slider.css('transform', 'translateX(-' + (current * (slideWidth + 12)) + 'px)');
                $dots.removeClass('active').eq(current).addClass('active');
            }

            $dots.on('click', function() {
                updateFeatured($(this).index());
            });

            if (total > 1) {
                setInterval(() => updateFeatured(current + 1), 4000);
            }

            // ── 더보기 ──
            $('#btnMoreReview').on('click', function() {
                const $btn     = $(this);
                const page     = parseInt($btn.data('page')) + 1;
                const headerId = $btn.data('header-id');
                const keyword  = $btn.data('keyword');

                $btn.text('불러오는 중...').prop('disabled', true);

                $.get('<?= base_url('review/load_more') ?>', {
                    page:      page,
                    header_id: headerId,
                    keyword:   keyword
                }, function(res) {
                    if (res.status === 'success') {
                        res.reviews.forEach(function(review) {
                            const thumb = review.thumb
                                ? '<img src="<?= base_url() ?>' + review.thumb + '" alt="후기">'
                                : '<div class="review-list-no-thumb">📝</div>';

                            const date = review.created_at.substring(2, 10).replace(/-/g, '.');

                            $('#reviewList').append(`
                        <div class="review-list-item" onclick="location.href='<?= base_url('review/') ?>${review.id}'">
                            <div class="review-list-thumb">${thumb}</div>
                            <div class="review-list-info">
                                <div class="review-list-title">${review.title}</div>
                                <div class="review-list-meta">${review.writer || ''}</div>
                            </div>
                            <div class="review-list-date">${date}</div>
                        </div>
                    `);
                        });

                        $btn.data('page', page);

                        if (!res.hasMore) {
                            $btn.remove();
                        } else {
                            $btn.text('더 보기').prop('disabled', false);
                        }
                    }
                });
            });

        });

        function filterByHeader(el) {
            document.querySelector('select[name=header_id]').value = el.dataset.id;
            document.getElementById('frmSearch').submit();
        }
    </script>
<?= $this->endSection() ?>