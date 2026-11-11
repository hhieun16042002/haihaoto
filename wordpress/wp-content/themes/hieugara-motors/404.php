<?php
/**
 * The template for displaying 404 pages (Not Found)
 * Đức Trí 226 Style Hero Banner + Comprehensive Navigation & Emergency Hotline
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

$banner_bg = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : hieugara_get_page_banner_url('default');
?>

<!-- =========================================================================
     HERO BANNER (Đức Trí 226 Style: Nền ảnh xưởng sắc nét + Dark Overlay)
     ========================================================================= -->
<section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_bg); ?>');">
    <div class="container">
        <nav class="portal-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span class="sep">/</span>
            <span class="current">404</span>
        </nav>
        <h1 class="portal-page-title"><?php _e('404 - KHÔNG TÌM THẤY TRANG', 'hieugara-motors'); ?></h1>
        <p class="portal-page-subtitle">
            <?php _e('Rất tiếc! Trang bạn đang tìm kiếm không tồn tại, đã bị xóa hoặc đường dẫn đã thay đổi.', 'hieugara-motors'); ?>
        </p>
    </div>
</section>

<!-- =========================================================================
     404 MAIN CONTENT & HELPFUL QUICK NAVIGATION
     ========================================================================= -->
<main id="primary" class="site-main page-404-content" style="padding: 70px 0 90px; background: #F8FAFC;">
    <div class="container" style="max-width: 960px; margin: 0 auto; padding: 0 20px; text-align: center;">

        <!-- 404 Big Number & Illustration Box -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-top: 4px solid #C5A880; border-radius: 12px; padding: 50px 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.04);">
            
            <div style="font-family: 'Be Vietnam Pro', sans-serif; font-size: clamp(4rem, 10vw, 7.5rem); font-weight: 900; line-height: 1; color: #141414; letter-spacing: -2px; margin-bottom: 12px;">
                <span style="color: #8C6239;">4</span><span style="color: #C5A880;">0</span><span style="color: #8C6239;">4</span>
            </div>

            <span style="display: inline-block; background: #F4ECE1; color: #8C6239; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.78rem; font-weight: 800; padding: 5px 18px; border-radius: 20px; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 18px;">
                TRANG YÊU CẦU KHÔNG TỒN TẠI
            </span>

            <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: clamp(1.3rem, 2.5vw, 1.75rem); font-weight: 800; color: #141414; margin: 0 0 16px; text-transform: uppercase;">
                BẠN ĐANG TÌM KIẾM THÔNG TIN GÌ TẠI Ô TÔ HẢI HÀ?
            </h2>

            <p style="font-size: 1rem; color: #64748b; line-height: 1.7; max-width: 680px; margin: 0 auto 32px;">
                Đừng lo lắng! Bạn có thể tìm kiếm nhanh dịch vụ, phụ tùng, hoặc sử dụng các lối tắt bên dưới để tiếp tục truy cập các chuyên mục chính của Gara.
            </p>

            <!-- Search Form -->
            <div style="max-width: 580px; margin: 0 auto 36px;">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" style="display: flex; gap: 8px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; padding: 4px;">
                    <input type="search" class="search-field" placeholder="<?php esc_attr_e('Tìm dịch vụ, phụ kiện, bảng giá...', 'hieugara-motors'); ?>" value="<?php echo get_search_query(); ?>" name="s" style="flex: 1; border: none; background: transparent; padding: 12px 16px; font-size: 0.95rem; font-family: 'Be Vietnam Pro', sans-serif; outline: none; color: #1e293b;" required />
                    <button type="submit" class="search-submit" style="background: #8C6239; color: #ffffff; border: none; padding: 12px 24px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.9rem; font-weight: 800; text-transform: uppercase; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Tìm Kiếm</span>
                    </button>
                </form>
            </div>

            <!-- Quick Navigation Shortcuts -->
            <div style="border-top: 1px solid #f1f5f9; padding-top: 30px; margin-bottom: 32px;">
                <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.8rem; font-weight: 800; color: #8C6239; letter-spacing: 1px; text-transform: uppercase; display: block; margin-bottom: 16px;">
                    LỐI TẮT TRUY CẬP NHANH
                </span>
                
                <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" style="background: #0f172a; color: #ffffff; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-house"></i> Trang Chủ
                    </a>
                    <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>" style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-wrench"></i> Dịch Vụ Gara
                    </a>
                    <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>" style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-toolbox"></i> Phụ Kiện Ô Tô
                    </a>
                    <a href="<?php echo esc_url(home_url('/bang-gia/')); ?>" style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-calculator"></i> Bảng Giá &amp; Dự Toán
                    </a>
                    <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>" style="background: #f1f5f9; color: #1e293b; border: 1px solid #cbd5e1; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-users"></i> Về Chúng Tôi
                    </a>
                    <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" style="background: #C5A880; color: #141414; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-phone"></i> Liên Hệ Trực Tiếp
                    </a>
                </div>
            </div>

            <!-- Emergency Support & Hotline Assistance -->
            <div style="background: #FBF8F3; border: 1px dashed #D4B996; border-radius: 8px; padding: 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; text-align: left;">
                <div>
                    <strong style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1rem; color: #141414; display: block; margin-bottom: 4px;">
                        CẦN HỖ TRỢ KỸ THUẬT HOẶC CỨU HỘ KHẨN CẤP?
                    </strong>
                    <span style="font-size: 0.88rem; color: #5F6368;">
                        Đội ngũ kỹ thuật viên Ô Tô Hải Hà luôn túc trực 24/7 để hỗ trợ quý khách.
                    </span>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="tel:<?php echo esc_attr($rescue_clean); ?>" style="background: #D92D20; color: #ffffff; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; text-transform: uppercase;">
                        <i class="fa-solid fa-phone-volume"></i> Cứu Hộ: <?php echo esc_html($rescue_phone); ?>
                    </a>
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.85rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; text-transform: uppercase;">
                        <i class="fa-solid fa-comment-dots"></i> Chat Zalo
                    </a>
                </div>
            </div>

        </div>

    </div>
</main>

<?php
get_footer();

