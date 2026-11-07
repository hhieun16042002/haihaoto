<?php
/**
 * Template Name: Phụ Kiện Ô Tô Chính Hãng (META.vn & Hải Hà Workshop)
 * Description: Dedicated accessories catalog page featuring genuine car accessories divided into clear category sections with live category filtering, search, and booking integration.
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = function_exists('hieugara_get_hotline_phone') ? hieugara_get_hotline_phone() : '0911 211 996';

// Get categories & grouped accessories
$categories = function_exists('hieugara_get_accessories_categories') ? hieugara_get_accessories_categories() : array();
$grouped_accessories = function_exists('hieugara_get_accessories_grouped_by_category') ? hieugara_get_accessories_grouped_by_category() : array();

// Total count
$total_products = 0;
foreach ($grouped_accessories as $g) {
    $total_products += count($g['items']);
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
                    Cam kết 100% chính hãng phân phối META.vn từ Zestech, Michelin, Steelmate, Bosch, Philips, Baseus, Stanley. Bảo hành điện tử chính hãng &amp; hỗ trợ kỹ thuật, lắp đặt tiêu chuẩn tại xưởng Ôtô Hải Hà.
                </p>

                <!-- Value Props Badges -->
                <div class="phukien-value-props">
                    <div class="prop-item">
                        <i class="fa-solid fa-shield-halved text-gold"></i>
                        <span>100% Chính Hãng META.vn</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-award text-gold"></i>
                        <span>Bảo Hành 1 Đổi 1 Đến 36 Tháng</span>
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

            <!-- Controls: Category Sticky Tabs + Live Search -->
            <div class="phukien-controls-bar" id="phukienStickyNav">
                <!-- Filter Tabs -->
                <div class="phukien-tabs-nav" id="phukienTabsNav" role="tablist">
                    <button type="button" class="tab-btn <?php echo $initial_cat === 'all' ? 'active' : ''; ?>" data-category="all" title="Xem tất cả các danh mục">
                        <i class="fa-solid fa-border-all"></i>
                        <span>Tất Cả (<?php echo esc_html($total_products); ?>)</span>
                    </button>
                    <?php foreach ($categories as $cat_key => $c_info) : 
                        $count = isset($grouped_accessories[$cat_key]['items']) ? count($grouped_accessories[$cat_key]['items']) : 0;
                    ?>
                        <button type="button" class="tab-btn <?php echo $initial_cat === $cat_key ? 'active' : ''; ?>" data-category="<?php echo esc_attr($cat_key); ?>" title="<?php echo esc_attr($c_info['name']); ?>">
                            <i class="<?php echo esc_attr($c_info['icon']); ?>"></i>
                            <span><?php echo esc_html($c_info['short_name']); ?> (<?php echo esc_html($count); ?>)</span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Instant Search Filter -->
                <div class="phukien-search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="search" id="phukienSearchInput" placeholder="Tìm tên phụ kiện (vd: michelin, camera, 70mai, zestech, bosch...)" autocomplete="off">
                    <button type="button" id="phukienClearSearch" class="clear-search-btn" title="Xóa tìm kiếm" style="display: none;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>

            <!-- Categories Sections Container -->
            <div class="phukien-categories-container" id="phukienCategoriesContainer">

                <?php foreach ($grouped_accessories as $cat_key => $group_data) : 
                    $meta = $group_data['meta'];
                    $items = $group_data['items'];
                    if (empty($items)) continue;
                ?>
                    <section class="phukien-cat-section" id="cat-<?php echo esc_attr($cat_key); ?>" data-cat-id="<?php echo esc_attr($cat_key); ?>">
                        <!-- Section Header -->
                        <div class="phukien-cat-header">
                            <div class="phukien-cat-header-left">
                                <span class="phukien-cat-index"><?php echo esc_html($meta['index_num']); ?></span>
                                <div class="phukien-cat-title-wrap">
                                    <div class="phukien-cat-eyebrow">
                                        <i class="<?php echo esc_attr($meta['icon']); ?>"></i>
                                        <span><?php echo esc_html($meta['eyebrow']); ?></span>
                                    </div>
                                    <h2 class="phukien-cat-title"><?php echo esc_html($meta['name']); ?></h2>
                                </div>
                            </div>
                            <div class="phukien-cat-header-right">
                                <span class="phukien-cat-count-badge" data-count-orig="<?php echo count($items); ?>">
                                    <?php echo count($items); ?> sản phẩm
                                </span>
                                <a href="#phukienStickyNav" class="phukien-back-to-top" title="Lên đầu danh mục">
                                    <i class="fa-solid fa-arrow-up"></i> Đầu mục
                                </a>
                            </div>
                        </div>

                        <!-- Section Description -->
                        <p class="phukien-cat-desc"><?php echo esc_html($meta['desc']); ?></p>

                        <!-- Sub-categories pills if available -->
                        <?php if (!empty($meta['children'])) : ?>
                            <div class="phukien-subcats-pills" data-parent-cat="<?php echo esc_attr($cat_key); ?>">
                                <span class="subcat-label"><i class="fa-solid fa-layer-group text-gold mr-1"></i> Nhóm phụ kiện:</span>
                                <button type="button" class="subcat-pill active" data-subcat="all">Tất cả (<?php echo count($items); ?>)</button>
                                <?php foreach ($meta['children'] as $child) : 
                                    $child_count = 0;
                                    foreach ($items as $it) {
                                        if (!empty($it['child_cat']) && $it['child_cat'] === $child['slug']) {
                                            $child_count++;
                                        }
                                    }
                                ?>
                                    <button type="button" class="subcat-pill" data-subcat="<?php echo esc_attr($child['slug']); ?>">
                                        <?php echo esc_html($child['name']); ?> <?php echo $child_count > 0 ? '(' . $child_count . ')' : ''; ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Products Grid for this category -->
                        <div class="phukien-products-grid">
                            <?php foreach ($items as $item) : 
                                $title = $item['title'];
                                $img = function_exists('hieugara_normalize_local_media_urls') ? hieugara_normalize_local_media_urls($item['img']) : $item['img'];
                                $price = $item['price'];
                                $old_price = !empty($item['old_price']) ? $item['old_price'] : '';
                                $badge = !empty($item['badge']) ? $item['badge'] : 'CHÍNH HÃNG';
                                $link = !empty($item['link']) ? $item['link'] : home_url('/phu-kien-oto/' . ($item['slug'] ?? '') . '/');
                                $brand = !empty($item['brand']) ? $item['brand'] : 'Chính Hãng';
                                $child_cat = !empty($item['child_cat']) ? $item['child_cat'] : '';
                                $child_name = !empty($item['child_name']) ? $item['child_name'] : '';
                            ?>
                                <article class="phukien-card" data-category="<?php echo esc_attr($cat_key); ?>" data-child="<?php echo esc_attr($child_cat); ?>" data-title="<?php echo esc_attr(mb_strtolower($title . ' ' . $brand, 'UTF-8')); ?>">
                                    <!-- Badge -->
                                    <?php if (!empty($badge)) : ?>
                                        <span class="phukien-card-badge"><?php echo esc_html($badge); ?></span>
                                    <?php endif; ?>

                                    <!-- Image Box (100% INTERNAL LINK TO SINGLE POST) -->
                                    <a href="<?php echo esc_url($link); ?>" class="phukien-card-img-wrap" title="<?php echo esc_attr($title); ?>">
                                        <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                                    </a>

                                    <!-- Card Body -->
                                    <div class="phukien-card-body">
                                        <div class="phukien-card-cat-label">
                                            <span><?php echo esc_html($meta['short_name']); ?></span>
                                            <?php if (!empty($child_name)) : ?>
                                                <span class="child-tag">&bull; <?php echo esc_html($child_name); ?></span>
                                            <?php elseif (!empty($brand)) : ?>
                                                <span class="brand-tag">&bull; <?php echo esc_html($brand); ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <h3 class="phukien-card-title">
                                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>">
                                                <?php echo esc_html($title); ?>
                                            </a>
                                        </h3>

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
                                            <?php if (strpos($link, 'tel:') === 0) : ?>
                                                <a href="tel:0911211996" class="btn-pk-book" title="Gọi tư vấn phụ kiện này" style="width: 100%; text-align: center; background: #D4B996; color: #141414; padding: 10px 14px; border-radius: 6px; font-weight: 700; text-decoration: none;">
                                                    <i class="fa-solid fa-phone mr-1"></i> Gọi Tư Vấn Báo Giá
                                                </a>
                                            <?php else : ?>
                                                <a href="<?php echo esc_url($link); ?>" class="btn-pk-detail" title="Xem thông số kỹ thuật &amp; mô tả">
                                                    Chi Tiết
                                                </a>
                                                <a href="tel:0911211996" class="btn-pk-book" title="Gọi tư vấn phụ kiện này" style="background: #D4B996; color: #141414;">
                                                    <i class="fa-solid fa-phone mr-1"></i> Tư Vấn
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
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
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" class="btn-consult-zalo">
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
    var sections = document.querySelectorAll('.phukien-cat-section');
    var searchInput = document.getElementById('phukienSearchInput');
    var clearBtn = document.getElementById('phukienClearSearch');
    var emptyState = document.getElementById('phukienEmptyState');
    var resetBtn = document.getElementById('btnResetFilter');

    var currentCat = '<?php echo esc_js($initial_cat); ?>';
    var currentSearch = '';

    function filterCatalog() {
        var totalVisibleCards = 0;
        var searchLower = currentSearch.trim().toLowerCase();

        sections.forEach(function(sec) {
            var catId = sec.getAttribute('data-cat-id');
            var cards = sec.querySelectorAll('.phukien-card');
            var catMatchesFilter = (currentCat === 'all' || catId === currentCat);

            if (!catMatchesFilter) {
                sec.style.display = 'none';
                return;
            }

            var activeSubcat = sec.getAttribute('data-active-subcat') || 'all';
            var visibleInSec = 0;
            cards.forEach(function(card) {
                var title = card.getAttribute('data-title') || '';
                var cardChild = card.getAttribute('data-child') || '';
                var matchSearch = (!searchLower || title.indexOf(searchLower) !== -1);
                var matchSubcat = (activeSubcat === 'all' || cardChild === activeSubcat);

                if (matchSearch && matchSubcat) {
                    card.style.display = '';
                    visibleInSec++;
                    totalVisibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            // If searching or filtering subcats and this section has 0 matching cards, hide whole section if searching
            if (visibleInSec === 0 && searchLower) {
                sec.style.display = 'none';
            } else {
                sec.style.display = '';
                var countBadge = sec.querySelector('.phukien-cat-count-badge');
                if (countBadge) {
                    var orig = countBadge.getAttribute('data-count-orig');
                    countBadge.textContent = (searchLower || activeSubcat !== 'all') ? (visibleInSec + ' sản phẩm') : (orig + ' sản phẩm');
                }
            }
        });

        if (emptyState) {
            emptyState.style.display = (totalVisibleCards === 0) ? 'block' : 'none';
        }
    }

    // Subcategory pill clicks inside sections
    var subcatPills = document.querySelectorAll('.subcat-pill');
    subcatPills.forEach(function(pill) {
        pill.addEventListener('click', function() {
            var sec = this.closest('.phukien-cat-section');
            if (!sec) return;
            var subcat = this.getAttribute('data-subcat');
            sec.setAttribute('data-active-subcat', subcat);

            var parentPills = sec.querySelectorAll('.subcat-pill');
            parentPills.forEach(function(p) { p.classList.remove('active'); });
            this.classList.add('active');

            filterCatalog();
        });
    });

    // Tab Clicks
    tabs.forEach(function(btn) {
        btn.addEventListener('click', function() {
            tabs.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            currentCat = this.getAttribute('data-category');
            filterCatalog();

            // If a specific category is clicked, smoothly scroll to it if all categories visible
            if (currentCat !== 'all') {
                var targetSec = document.getElementById('cat-' + currentCat);
                if (targetSec) {
                    var stickyNav = document.getElementById('phukienStickyNav');
                    var navHeight = stickyNav ? stickyNav.offsetHeight + 90 : 120;
                    var topPos = targetSec.getBoundingClientRect().top + window.pageYOffset - navHeight;
                    window.scrollTo({ top: topPos, behavior: 'smooth' });
                }
            }
        });
    });

    // Search Input
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value;
            if (clearBtn) {
                clearBtn.style.display = currentSearch ? 'flex' : 'none';
            }
            filterCatalog();
        });
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            if (searchInput) {
                searchInput.value = '';
                currentSearch = '';
                this.style.display = 'none';
                filterCatalog();
                searchInput.focus();
            }
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            currentCat = 'all';
            currentSearch = '';
            if (searchInput) searchInput.value = '';
            if (clearBtn) clearBtn.style.display = 'none';
            tabs.forEach(function(b) {
                b.classList.toggle('active', b.getAttribute('data-category') === 'all');
            });
            filterCatalog();
        });
    }

    // Initial check for hash in URL (e.g. /phu-kien/#cat-bom-lop-tpms)
    if (window.location.hash) {
        var hash = window.location.hash.replace('#cat-', '').replace('#', '');
        var matchedBtn = document.querySelector('#phukienTabsNav .tab-btn[data-category="' + hash + '"]');
        if (matchedBtn) {
            matchedBtn.click();
        }
    } else {
        filterCatalog();
    }
});
</script>

<?php get_footer(); ?>
