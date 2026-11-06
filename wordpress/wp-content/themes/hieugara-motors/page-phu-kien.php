<?php
/**
 * Template Name: Phụ Kiện Ô Tô Chính Hãng (META.vn & Hải Hà Workshop)
 * Description: Dedicated accessories catalog page featuring genuine car accessories with live category filtering, search, and booking integration.
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = function_exists('hieugara_get_hotline_phone') ? hieugara_get_hotline_phone() : '02 203 892 207';

$accessories = function_exists('hieugara_get_native_accessories') ? hieugara_get_native_accessories() : array();
if (empty($accessories)) {
    $raw_accessories = function_exists('hieugara_get_accessories_items') ? hieugara_get_accessories_items() : array();
    foreach ($raw_accessories as $k => $a_it) {
        if (!empty($a_it['enable'])) {
            $t_lower = mb_strtolower($a_it['title'] . ' ' . ($a_it['badge'] ?? ''), 'UTF-8');
            $cat = 'noi-that';
            if (strpos($t_lower, 'màn hình') !== false || strpos($t_lower, 'camera') !== false || strpos($t_lower, 'zestech') !== false || strpos($t_lower, 'elliview') !== false || strpos($t_lower, '70mai') !== false) {
                $cat = 'man-hinh';
            } elseif (strpos($t_lower, 'bơm') !== false || strpos($t_lower, 'áp suất') !== false || strpos($t_lower, 'tpms') !== false || strpos($t_lower, 'michelin') !== false || strpos($t_lower, 'steelmate') !== false) {
                $cat = 'bom-lop';
            } elseif (strpos($t_lower, 'kích') !== false || strpos($t_lower, 'hút bụi') !== false || strpos($t_lower, 'búa') !== false || strpos($t_lower, 'stanley') !== false || strpos($t_lower, 'bosch') !== false) {
                $cat = 'cuu-ho';
            }
            $a_it['cat'] = $cat;
            $a_it['id'] = $k;
            $accessories[] = $a_it;
        }
    }
}

$initial_cat = isset($_GET['cat']) ? sanitize_key($_GET['cat']) : 'all';
?>

<main id="primary" class="site-main page-phu-kien-portal">

    <!-- Hero Header -->
    <section class="phukien-hero-section">
        <div class="container">
            <nav class="phukien-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <span class="current"><?php _e('Phụ kiện ô tô chính hãng', 'hieugara-motors'); ?></span>
            </nav>

            <div class="phukien-hero-content text-center">
                <div class="phukien-eyebrow">
                    <span class="eyebrow-dot"></span>
                    <span>HỆ THỐNG PHỤ KIỆN Ô TÔ CHÍNH HÃNG HẢI HÀ &bull; PHÂN PHỐI META.VN</span>
                </div>
                <h1 class="phukien-title">
                    <span>PHỤ KIỆN &amp; ĐỒ CHƠI XE HƠI</span> <span class="text-gold">CHÍNH HÃNG</span>
                </h1>
                <p class="phukien-subtitle">
                    Cam kết 100% chính hãng từ các thương hiệu hàng đầu: Zestech, Michelin, Steelmate, Bosch, Philips, Baseus, Stanley. Bảo hành điện tử chính hãng &amp; hỗ trợ lắp đặt trực tiếp tại xưởng Ôtô Hải Hà.
                </p>

                <!-- Value Props Badges -->
                <div class="phukien-value-props">
                    <div class="prop-item">
                        <i class="fa-solid fa-shield-halved text-gold"></i>
                        <span>100% Chính Hãng META.vn</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-award text-gold"></i>
                        <span>Bảo Hành 1 Đổi 1 Đến 24 Tháng</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-screwdriver-wrench text-gold"></i>
                        <span>Hỗ Trợ Lắp Đặt Tại Xưởng</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-truck-fast text-gold"></i>
                        <span>Giao Hàng Toàn Quốc COD</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalog Main Area -->
    <section class="phukien-catalog-section">
        <div class="container">

            <!-- Controls: Category Tabs + Live Search -->
            <div class="phukien-controls-bar">
                <!-- Filter Tabs -->
                <div class="phukien-tabs-nav" id="phukienTabsNav" role="tablist">
                    <button type="button" class="tab-btn <?php echo $initial_cat === 'all' ? 'active' : ''; ?>" data-category="all">
                        <i class="fa-solid fa-border-all"></i>
                        <span>Tất Cả (<?php echo count($accessories); ?>)</span>
                    </button>
                    <button type="button" class="tab-btn <?php echo $initial_cat === 'man-hinh' ? 'active' : ''; ?>" data-category="man-hinh">
                        <i class="fa-solid fa-mobile-screen"></i>
                        <span>Màn Hình &amp; Camera 4K</span>
                    </button>
                    <button type="button" class="tab-btn <?php echo $initial_cat === 'bom-lop' ? 'active' : ''; ?>" data-category="bom-lop">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Bơm Lốp &amp; TPMS</span>
                    </button>
                    <button type="button" class="tab-btn <?php echo $initial_cat === 'cuu-ho' ? 'active' : ''; ?>" data-category="cuu-ho">
                        <i class="fa-solid fa-bolt"></i>
                        <span>Cứu Hộ &amp; Hút Bụi</span>
                    </button>
                    <button type="button" class="tab-btn <?php echo $initial_cat === 'noi-that' ? 'active' : ''; ?>" data-category="noi-that">
                        <i class="fa-solid fa-car-side"></i>
                        <span>Nội Thất &amp; Tiện Ích</span>
                    </button>
                </div>

                <!-- Instant Search Filter -->
                <div class="phukien-search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="search" id="phukienSearchInput" placeholder="Tìm tên phụ kiện (vd: michelin, camera, zestech...)" autocomplete="off">
                    <button type="button" id="phukienClearSearch" class="clear-search-btn" title="Xóa tìm kiếm" style="display: none;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="phukien-products-grid" id="phukienProductsGrid">
                <?php foreach ($accessories as $item) : 
                    $cat = $item['cat'] ?? 'noi-that';
                    $title = $item['title'];
                    $img = $item['img'];
                    $price = $item['price'];
                    $old_price = !empty($item['old_price']) ? $item['old_price'] : '';
                    $badge = !empty($item['badge']) ? $item['badge'] : 'CHÍNH HÃNG';
                    $link = !empty($item['link']) ? $item['link'] : 'https://meta.vn/phu-kien-oto/';
                ?>
                    <article class="phukien-card" data-category="<?php echo esc_attr($cat); ?>" data-title="<?php echo esc_attr(mb_strtolower($title, 'UTF-8')); ?>">
                        <!-- Badge -->
                        <?php if (!empty($badge)) : ?>
                            <span class="phukien-card-badge"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>

                        <!-- Image Box -->
                        <a href="<?php echo esc_url($link); ?>" class="phukien-card-img-wrap" title="<?php echo esc_attr($title); ?>">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                        </a>

                        <!-- Card Body -->
                        <div class="phukien-card-body">
                            <div class="phukien-card-cat-label">
                                <?php 
                                    if ($cat === 'man-hinh') echo 'MÀN HÌNH & CAMERA Ô TÔ';
                                    elseif ($cat === 'bom-lop') echo 'CẢM BIẾN & BƠM LỐP CHUYÊN DỤNG';
                                    elseif ($cat === 'cuu-ho') echo 'CỨU HỘ & VỆ SINH Ô TÔ';
                                    else echo 'PHỤ KIỆN & TIỆN ÍCH XE HƠI';
                                ?>
                            </div>
                            <h2 class="phukien-card-title">
                                <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>">
                                    <?php echo esc_html($title); ?>
                                </a>
                            </h2>

                            <!-- Pricing -->
                            <div class="phukien-card-pricing">
                                <span class="price-current"><?php echo esc_html($price); ?> <sup>đ</sup></span>
                                <?php if (!empty($old_price)) : ?>
                                    <span class="price-old"><?php echo esc_html($old_price); ?> <sup>đ</sup></span>
                                <?php endif; ?>
                            </div>

                            <div class="phukien-card-guarantee">
                                <i class="fa-solid fa-circle-check text-green mr-1"></i> Sẵn hàng tại Hải Hà &bull; Hỗ trợ lắp đặt
                            </div>

                            <!-- Actions -->
                            <div class="phukien-card-actions">
                                <a href="<?php echo esc_url($link); ?>" class="btn-pk-detail" title="Xem chi tiết kỹ thuật">
                                    Chi Tiết
                                </a>
                                <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode('Lắp đặt phụ kiện: ' . $title))); ?>" class="btn-pk-book" title="Đặt lịch lắp đặt phụ kiện này">
                                    <i class="fa-regular fa-calendar-check mr-1"></i> Đặt Lịch
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Empty State for Search / Filter -->
            <div id="phukienEmptyState" class="phukien-empty-state" style="display: none;">
                <div class="empty-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h3>Không tìm thấy phụ kiện phù hợp</h3>
                <p>Hãy thử tìm bằng từ khóa khác hoặc liên hệ hotline để đặt hàng theo yêu cầu riêng của xe.</p>
                <button type="button" class="btn-reset-filter" id="btnResetFilter">Xem tất cả phụ kiện</button>
            </div>

        </div>
    </section>

    <!-- Consultation CTA Section -->
    <section class="phukien-consult-section">
        <div class="container">
            <div class="consult-box">
                <div class="consult-content">
                    <span class="consult-pill">TƯ VẤN KỸ THUẬT MIỄN PHÍ</span>
                    <h2>Bạn Cần Tư Vấn Phụ Kiện Phù Hợp Với Dòng Xe Của Mình?</h2>
                    <p>Mỗi dòng xe có thông số giắc cắm, kích thước màn hình và chuẩn điện áp riêng biệt. Đội ngũ kỹ thuật viên của Ôtô Hải Hà sẵn sàng tư vấn chi tiết giải pháp nâng cấp tối ưu nhất.</p>
                </div>
                <div class="consult-buttons">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="btn-consult-hotline">
                        <i class="fa-solid fa-phone-volume"></i>
                        <span>Hotline: <strong><?php echo esc_html($rescue_phone); ?></strong></span>
                    </a>
                    <a href="https://zalo.me/0915041989" target="_blank" rel="noopener" class="btn-consult-zalo">
                        <i class="fa-solid fa-comment-dots"></i>
                        <span>Zalo Kỹ Thuật Viên</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tabs = document.querySelectorAll('#phukienTabsNav .tab-btn');
    var cards = document.querySelectorAll('.phukien-card');
    var searchInput = document.getElementById('phukienSearchInput');
    var clearBtn = document.getElementById('phukienClearSearch');
    var emptyState = document.getElementById('phukienEmptyState');
    var resetBtn = document.getElementById('btnResetFilter');

    var currentCat = '<?php echo esc_js($initial_cat); ?>';
    var currentSearch = '';

    function filterCards() {
        var visibleCount = 0;
        var searchLower = currentSearch.trim().toLowerCase();

        cards.forEach(function(card) {
            var cardCat = card.getAttribute('data-category');
            var cardTitle = card.getAttribute('data-title') || '';

            var matchCat = (currentCat === 'all' || cardCat === currentCat);
            var matchSearch = (!searchLower || cardTitle.indexOf(searchLower) !== -1);

            if (matchCat && matchSearch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (emptyState) {
            emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
    }

    tabs.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            tabs.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            currentCat = btn.getAttribute('data-category');
            filterCards();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value;
            if (clearBtn) {
                clearBtn.style.display = currentSearch ? 'flex' : 'none';
            }
            filterCards();
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            currentSearch = '';
            clearBtn.style.display = 'none';
            filterCards();
            searchInput.focus();
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            currentCat = 'all';
            currentSearch = '';
            if (searchInput) searchInput.value = '';
            if (clearBtn) clearBtn.style.display = 'none';
            tabs.forEach(function(b) {
                if (b.getAttribute('data-category') === 'all') b.classList.add('active');
                else b.classList.remove('active');
            });
            filterCards();
        });
    }

    // Initial check
    if (currentCat !== 'all') {
        filterCards();
    }
});
</script>

<?php
get_footer();

