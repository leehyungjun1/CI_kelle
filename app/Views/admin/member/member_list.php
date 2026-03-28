<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>회원 리스트<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <!-- 페이지 헤더 -->
    <div class="page-header">
        <h3>회원 리스트</h3>
        <div class="btn-group">
        <input type="button" class="btn btn-white" value="+ 회원 등록" onclick="location.href='<?= base_url('admin/member/member_register') ?>'">
        </div>
    </div>

    <!-- 검색 폼 -->
    <form id="frmSearchBase" method="get" class="content-form js-search-form">
        <input type="hidden" name="searchFl" value="y">

        <div class="table-title">회원 검색</div>
        <div class="search-detail-box">
            <table class="table table-cols">
                <colgroup>
                    <col class="width-md"><col class="width-2xl">
                    <col class="width-md"><col class="width-3xl">
                </colgroup>
                <tbody>
                <tr>
                    <th>검색어</th>
                    <td colspan="3">
                        <select name="key" class="form-control">
                            <option value="userid">아이디</option>
                            <option value="name">이름</option>
                            <option value="email">이메일</option>
                            <option value="mobile">휴대폰번호</option>
                        </select>
                        <select name="searchKind" class="form-control">
                            <option value="equalSearch">전체일치</option>
                            <option value="fullLikeSearch">부분포함</option>
                        </select>
                        <input type="text" name="keyword" value="<?= esc($get['keyword'] ?? '') ?>"
                               class="form-control" placeholder="검색어를 입력하세요">
                    </td>
                </tr>
                <tr>
                    <th>회원등급</th>
                    <td>
                        <select name="groupSno" class="form-control">
                            <option value="">전체</option>
                            <?php foreach ($grades ?? [] as $grade): ?>
                                <option value="<?= $grade['id'] ?>"
                                    <?= ($get['groupSno'] ?? '') == $grade['id'] ? 'selected' : '' ?>>
                                    <?= esc($grade['grade_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th>가입승인</th>
                    <td>
                        <?php foreach (['' => '전체', 'Y' => '승인', 'N' => '미승인'] as $val => $label): ?>
                            <label class="radio-inline">
                                <input type="radio" name="regist_YN" value="<?= $val ?>"
                                    <?= ($get['regist_YN'] ?? '') === $val ? 'checked' : '' ?>>
                                <?= $label ?>
                            </label>
                        <?php endforeach; ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="table-btn">
                <button type="submit" class="btn btn-lg btn-black">검색</button>
            </div>
        </div>
    </form>

    <!-- 목록 -->
    <form id="frmList" method="get">
        <div class="table-header clearfix">
            <div class="pull-left">
                검색 <strong><?= $searchCount ?? 0 ?></strong>명 /
                전체 <strong><?= $totalCount ?? 0 ?></strong>명
            </div>
            <div class="pull-right">
                <select name="sort" class="form-control">
                    <option value="created_at desc">회원가입일↓</option>
                    <option value="created_at asc">회원가입일↑</option>
                    <option value="name desc">이름↓</option>
                    <option value="name asc">이름↑</option>
                </select>
                <select name="pageNum" class="form-control">
                    <?php foreach ([10, 20, 30, 50, 100] as $num): ?>
                        <option value="<?= $num ?>"><?= $num ?>개 보기</option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <table class="table table-rows">
            <thead>
            <tr>
                <th><input type="checkbox" id="chk_all" class="js-checkall" data-target-name="chk"></th>
                <th>번호</th>
                <th>아이디 / 닉네임</th>
                <th>이름</th>
                <th>등급</th>
                <th>마일리지</th>
                <th>예치금</th>
                <th>주문건수</th>
                <th>주문금액</th>
                <th>가입일</th>
                <th>최종로그인</th>
                <th>가입승인</th>
                <th>정보수정</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($members)): ?>
                <?php foreach ($members as $idx => $member): ?>
                    <tr class="center">
                        <td><input type="checkbox" name="chk[]" value="<?= $member['id'] ?>"></td>
                        <td><?= $startNum-- ?></td>
                        <td><?= esc($member['userid']) ?> / <?= esc($member['nickname'] ?? '') ?></td>
                        <td><?= esc($member['name'] ?? '') ?></td>
                        <td><?= esc($member['group_name'] ?? '') ?></td>
                        <td><?= number_format($member['mileage'] ?? 0) ?></td>
                        <td><?= number_format($member['emoney'] ?? 0) ?></td>
                        <td><?= number_format($member['order_cnt'] ?? 0) ?></td>
                        <td><?= number_format($member['order_price'] ?? 0) ?></td>
                        <td><?= $member['created_at'] ?? '' ?></td>
                        <td><?= $member['last_login'] ?? '' ?></td>
                        <td><?= $member['regist_YN'] ?? '' ?></td>
                        <td>
                            <button type="button" class="btn btn-white btn-sm"
                                    onclick="location.href='<?= base_url('admin/member/member_register/' . $member['id']) ?>'">
                                수정
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13" class="center">검색된 회원이 없습니다.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <!-- 하단 버튼 -->
        <div class="table-action">
            <div class="pull-left">
                <button type="button" class="btn btn-white" id="btnApply">선택 가입승인</button>
                <button type="button" class="btn btn-white" id="btnDelete">선택 탈퇴처리</button>
            </div>
            <div class="pull-right">
                <button type="button" class="btn btn-white">엑셀다운로드</button>
            </div>
        </div>

        <!-- 페이징 -->
        <div class="center" style="margin-top:15px;">
            <?= $pager->links() ?>
        </div>
    </form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('script/jy_share/list.js') ?>"></script>
<?= $this->endSection() ?>