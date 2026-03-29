<?= $this->extend('layout/front/main') ?>

<?= $this->section('title') ?>교육과정<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <style>
        /* ── 교육과정 페이지 ── */
        .curriculum-page { background: #fff; }

        /* ── 페이지 헤더 ── */
        .curriculum-header {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .curriculum-header-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ── 신규 및 인기과정 슬라이더 ── */
        .featured-section {
            padding: 16px;
            background: #fff;
            border-bottom: 8px solid var(--bg-light);
        }
        .featured-section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        .featured-slider-wrap {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            border: 2px solid var(--gray);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .featured-slides {
            display: flex;
            transition: transform 0.4s ease;
        }
        .featured-slide {
            min-width: 100%;
            flex-shrink: 0;
        }
        .featured-slide-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            background: var(--bg-light);
        }
        .featured-slide-img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1A56C4 0%, #0d3a8e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 40px;
        }
        .featured-slide-info {
            padding: 14px;
        }
        .featured-slide-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .featured-slide-header {
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 8px;
        }
        .featured-slide-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 10px;
        }
        .featured-slide-tag {
            font-size: 11px;
            color: var(--blue);
            background: #EEF4FF;
            padding: 2px 8px;
            border-radius: 10px;
        }
        .featured-slide-btn {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
            background: #fff;
            cursor: pointer;
        }
        .featured-slide-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
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

        /* ── 검색바 ── */
        .curriculum-search {
            padding: 14px 16px;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }
        .curriculum-search-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid var(--border);
            border-radius: 24px;
            padding: 8px 14px;
            background: #fff;
            transition: border-color .2s;
        }
        .curriculum-search-wrap:focus-within {
            border-color: var(--blue);
        }
        .curriculum-search-wrap i {
            color: var(--text-gray);
            font-size: 14px;
        }
        .curriculum-search-wrap input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 14px;
            color: var(--text-dark);
            background: transparent;
        }

        /* ── 말머리 필터 탭 ── */
        .curriculum-tabs {
            padding: 10px 16px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            background: #fff;
            border-bottom: 8px solid var(--bg-light);
        }
        .curriculum-tab {
            padding: 5px 14px;
            border: 1px solid var(--border);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-mid);
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }
        .curriculum-tab.active,
        .curriculum-tab:hover {
            border-color: var(--blue);
            color: #fff;
            background: var(--blue);
        }

        /* ── 과정 그리드 ── */
        .curriculum-grid-section {
            padding: 16px;
            background: #fff;
        }
        .curriculum-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .curriculum-card {
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: box-shadow .2s;
            background: #fff;
        }
        .curriculum-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .curriculum-card-img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
            background: var(--bg-light);
        }
        .curriculum-card-img-placeholder {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, #1A56C4 0%, #0d3a8e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 28px;
        }
        .curriculum-card-body { padding: 10px; }
        .curriculum-card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .curriculum-card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 3px;
        }
        .curriculum-card-tag {
            font-size: 10px;
            color: var(--blue);
            background: #EEF4FF;
            padding: 1px 6px;
            border-radius: 8px;
        }

        /* ── 더보기 ── */
        .curriculum-more-btn {
            display: block;
            width: calc(100% - 32px);
            margin: 0 16px 16px;
            padding: 13px;
            text-align: center;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-mid);
            background: #fff;
            cursor: pointer;
        }
        .curriculum-more-btn:hover {
            border-color: var(--blue);
            color: var(--blue);
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="curriculum-page">

        <!-- 페이지 헤더 -->
        <div class="curriculum-header">
            <div class="curriculum-header-title">신규 및 인기과정</div>
        </div>

        <!-- ── 신규 및 인기과정 ── -->
        <?php if (!empty($featured)): ?>
            <div class="featured-section">
                <div class="featured-slider-wrap">
                    <div class="featured-slides" id="featuredSlides">
                        <?php foreach ($featured as $i => $item): ?>
                            <div class="featured-slide">
                                <?php if (!empty($item['thumb'])): ?>
                                    <img src="<?= base_url($item['thumb']) ?>"
                                         alt="<?= esc($item['title']) ?>"
                                         class="featured-slide-img">
                                <?php else: ?>
                                    <div class="featured-slide-img-placeholder">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="featured-slide-info">
                                    <?php if (!empty($item['header_id']) && !empty($headersMap[$item['header_id']])): ?>
                                        <div class="featured-slide-header">
                                            <?= esc($headersMap[$item['header_id']]['header_name']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="featured-slide-title"><?= esc($item['title']) ?></div>
                                    <?php if (!empty($item['keywords'])): ?>
                                        <div class="featured-slide-tags">
                                            <?php foreach (explode(',', $item['keywords']) as $tag): ?>
                                                <?php $tag = trim($tag); ?>
                                                <?php if ($tag): ?>
                                                    <span class="featured-slide-tag"><?= esc($tag) ?></span>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?= base_url('curriculum/'.esc($item['id'])) ?>"
                                       class="featured-slide-btn">자세히보기</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if (count($featured) > 1): ?>
                    <div class="featured-dots" id="featuredDots">
                        <?php foreach ($featured as $i => $item): ?>
                            <span class="<?= $i === 0 ? 'active' : '' ?>"></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- ── 검색바 ── -->
        <form id="frmSearch" method="get" action="<?= base_url('curriculum') ?>">
            <div class="curriculum-search">
                <div class="curriculum-search-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" name="keyword"
                           value="<?= esc($keyword ?? '') ?>"
                           placeholder="교육과정 검색">
                </div>
            </div>

            <!-- ── 말머리 필터 탭 ── -->
            <?php if (!empty($headers)): ?>
                <div class="curriculum-tabs">
                    <a href="<?= base_url('curriculum') ?>"
                       class="curriculum-tab <?= empty($headerId) ? 'active' : '' ?>">
                        전체
                    </a>
                    <?php foreach ($headers as $header): ?>
                        <a href="<?= base_url('curriculum?header_id='.(int)$header['id']) ?>"
                           class="curriculum-tab <?= (string)($headerId ?? '') === (string)$header['id'] ? 'active' : '' ?>">
                            <?= esc($header['header_name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </form>

        <!-- ── 과정 그리드 ── -->
        <div class="curriculum-grid-section">
            <div class="curriculum-grid" id="curriculumGrid">
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <div class="curriculum-card"
                             onclick="location.href='<?= base_url('curriculum/'.esc($course['id'])) ?>'">
                            <?php if (!empty($course['thumb'])): ?>
                                <img src="<?= base_url($course['thumb']) ?>"
                                     alt="<?= esc($course['title']) ?>"
                                     class="curriculum-card-img">
                            <?php else: ?>
                                <div class="curriculum-card-img-placeholder">
                                    <i class="fa fa-book"></i>
                                </div>
                            <?php endif; ?>
                            <div class="curriculum-card-body">
                                <div class="curriculum-card-title"><?= esc($course['title']) ?></div>
                                <?php if (!empty($course['keywords'])): ?>
                                    <div class="curriculum-card-tags">
                                        <?php foreach (explode(',', $course['keywords']) as $tag): ?>
                                            <?php $tag = trim($tag); ?>
                                            <?php if ($tag): ?>
                                                <span class="curriculum-card-tag"><?= esc($tag) ?></span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column:1/-1; text-align:center; padding:40px 0; color:var(--text-gray);">
                        등록된 교육과정이 없습니다.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 더보기 -->
        <?php if ($page < $totalPage): ?>
            <button class="curriculum-more-btn" id="btnMoreCurriculum"
                    data-page="<?= $page ?>"
                    data-header-id="<?= esc($headerId ?? '') ?>"
                    data-keyword="<?= esc($keyword ?? '') ?>">
                더 보기
            </button>
        <?php endif; ?>

    </div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function() {

            // ── 신규 인기과정 슬라이더 ──
            const $slides = $('#featuredSlides');
            const $dots   = $('#featuredDots span');
            let current   = 0;
            const total   = $dots.length;

            function updateSlide(idx) {
                current = (idx + total) % total;
                $slides.css('transform', 'translateX(-' + (current * 100) + '%)');
                $dots.removeClass('active').eq(current).addClass('active');
            }

            $dots.on('click', function() { updateSlide($(this).index()); });

            if (total > 1) {
                setInterval(() => updateSlide(current + 1), 4000);

                // 터치 스와이프
                let startX = 0;
                $slides[0].addEventListener('touchstart', e => { startX = e.touches[0].clientX; });
                $slides[0].addEventListener('touchend', e => {
                    const diff = startX - e.changedTouches[0].clientX;
                    if (Math.abs(diff) > 50) updateSlide(diff > 0 ? current + 1 : current - 1);
                });
            }

            // ── 더보기 ──
            $('#btnMoreCurriculum').on('click', function() {
                const $btn     = $(this);
                const page     = parseInt($btn.data('page')) + 1;
                const headerId = $btn.data('header-id');
                const keyword  = $btn.data('keyword');

                $btn.text('불러오는 중...').prop('disabled', true);

                $.get('<?= base_url('curriculum/load_more') ?>', {
                    page:      page,
                    header_id: headerId,
                    keyword:   keyword,
                }, function(res) {
                    if (res.status === 'success') {
                        res.courses.forEach(function(course) {
                            const thumb = course.thumb
                                ? `<img src="<?= base_url() ?>${course.thumb}" alt="${course.title}" class="curriculum-card-img">`
                                : `<div class="curriculum-card-img-placeholder"><i class="fa fa-book"></i></div>`;

                            let tags = '';
                            if (course.keywords) {
                                course.keywords.split(',').forEach(function(tag) {
                                    tag = tag.trim();
                                    if (tag) tags += `<span class="curriculum-card-tag">${tag}</span>`;
                                });
                            }

                            $('#curriculumGrid').append(`
                        <div class="curriculum-card"
                             onclick="location.href='<?= base_url('curriculum/') ?>${course.id}'">
                            ${thumb}
                            <div class="curriculum-card-body">
                                <div class="curriculum-card-title">${course.title}</div>
                                ${tags ? `<div class="curriculum-card-tags">${tags}</div>` : ''}
                            </div>
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
    </script>
<?= $this->endSection() ?>