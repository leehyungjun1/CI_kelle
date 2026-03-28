<div class="gallery-wrap">
    <?php if (!empty($boards['boardData'])): ?>
        <?php foreach ($boards['boardData'] as $board): ?>
            <div class="gallery-card"
                 onclick="goList('<?= base_url('admin/board/article_view/'.esc($board_id).'/'.esc($board['id'])) ?>')">
                <div class="gallery-thumb">
                    <?php if (!empty($board['file_path'])): ?>
                        <img src="<?= base_url($board['file_path']) ?>" alt="<?= esc($board['title']) ?>">
                    <?php else: ?>
                        <div class="gallery-no-img">
                            <i class="fa fa-image"></i>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($board['header_id']) && !empty($headersMap[$board['header_id']])): ?>
                        <?php $header = $headersMap[$board['header_id']]; ?>
                        <span class="gallery-badge" style="background:<?= esc($header['badge_color']) ?>; color:<?= esc($header['text_color']) ?>;">
                            <?= esc($header['header_name']) ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="gallery-info">
                    <div class="gallery-title"><?= esc($board['title'] ?? '') ?></div>
                    <?php if (!empty($board['keywords'])): ?>
                        <div class="gallery-keywords">
                            <?php foreach (explode(',', $board['keywords']) as $keyword): ?>
                                <?php $keyword = trim($keyword); ?>
                                <?php if ($keyword): ?>
                                    <span class="gallery-keyword">#<?= esc($keyword) ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="gallery-meta">
                        <span><?= esc($board['writer'] ?? '') ?></span>
                        <span><?= esc(date('Y-m-d', strtotime($board['created_at']))) ?></span>
                        <span>조회 <?= number_format($board['hit'] ?? 0) ?></span>
                    </div>
                    <div class="gallery-actions">
                        <button type="button" class="btn btn-white btn-sm"
                                onclick="event.stopPropagation(); goList('<?= base_url('admin/board/article_register/'.esc($board_id).'/'.$board['id']) ?>')">
                            수정
                        </button>
                        <input type="checkbox" name="chk[]" value="<?= esc($board['id']) ?>"
                               onclick="event.stopPropagation()">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="gallery-empty">검색된 정보가 없습니다.</div>
    <?php endif; ?>
</div>

<style>
    .gallery-wrap {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        padding: 15px 0;
    }
    .gallery-card {
        border: 1px solid #e6e6e6;
        border-radius: 6px;
        overflow: hidden;
        cursor: pointer;
        transition: box-shadow 0.2s;
        background: #fff;
    }
    .gallery-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
    .gallery-thumb {
        width: 100%;
        height: 160px;
        background: #f6f6f6;
        overflow: hidden;
        position: relative;
    }
    .gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .gallery-no-img {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        font-size: 40px; color: #ccc;
    }
    .gallery-badge {
        position: absolute; top: 8px; left: 8px;
        font-size: 11px; font-weight: 600;
        padding: 2px 8px; border-radius: 3px;
    }
    .gallery-info { padding: 10px; }
    .gallery-title {
        font-size: 13px; font-weight: bold; color: #333;
        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
        margin-bottom: 6px;
    }
    .gallery-meta {
        font-size: 11px; color: #999;
        display: flex; gap: 8px; margin-bottom: 8px;
    }
    .gallery-actions {
        display: flex; align-items: center; justify-content: space-between;
    }
    .gallery-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 40px 0;
        color: #999;
    }
    .gallery-keywords {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 6px;
    }
    .gallery-keyword {
        font-size: 11px;
        color: #1A56C4;
        background: #EEF4FF;
        padding: 1px 6px;
        border-radius: 10px;
    }
</style>