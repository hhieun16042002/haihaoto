<?php
/**
 * Template Name: Trang Liên Hệ
 * Description: Trang Liên Hệ duy nhất và toàn diện của Ô Tô Hải Hà
 * 100% Dynamic & Editable from WordPress Admin (WYSIWYG, Blocks, Form, Map & Contacts)
 *
 * @package HieuGara_Motors
 */

get_header();

$banner_url  = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : (function_exists('hieugara_get_page_banner_url') ? hieugara_get_page_banner_url('contact') : (get_template_directory_uri() . '/assets/images/banners/banner-lien-he.jpg'));
$page_title  = get_the_title();
$main_phone  = '02203 892 207';
$rescue_num  = get_option('hieugara_rescue_phone', '0911 211 996');
$email_addr  = get_option('hieugara_topbar_email', 'thanhotohaiha@gmail.com');
$address_txt = 'Km3+500 Đường Nguyễn Lương Bằng, Phường Bình Hàn, Thành phố Hải Dương';
$map_link    = 'https://maps.google.com/?cid=15399047910545937753';
?>

<style>
/* Scoped Styling for Contact Page */
.page-contact-portal {
    background: #f8fafc;
    font-family: 'Be Vietnam Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #1e293b;
}

/* Main 2-Column Section */
.contact-main-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    margin-top: 36px;
    margin-bottom: 50px;
    align-items: stretch;
}
.contact-box-panel {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 36px 32px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
}
.contact-panel-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.contact-panel-desc {
    font-size: 0.94rem;
    color: #64748b;
    line-height: 1.65;
    margin: 0 0 24px;
}

/* Right Details Panel */
.contact-detail-row {
    display: flex;
    gap: 14px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.contact-detail-icon {
    width: 38px;
    height: 38px;
    border-radius: 6px;
    background: #FBF8F3;
    border: 1px solid #e2e8f0;
    color: #8C6239;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.contact-detail-info strong {
    display: block;
    font-size: 0.95rem;
    color: #0f172a;
    margin-bottom: 4px;
}
.contact-detail-info span,
.contact-detail-info a {
    font-size: 0.92rem;
    color: #475569;
    text-decoration: none;
    line-height: 1.5;
}
.contact-detail-info a:hover {
    color: #8C6239;
    text-decoration: underline;
}

/* Google Map Embed */
.contact-map-frame {
    width: 100%;
    height: 380px;
    border: 0;
    border-radius: 6px;
}
.btn-gmap-direct {
    background: #C5A880;
    color: #141414;
    border: 1px solid #C5A880;
    padding: 13px 20px;
    border-radius: 6px;
    font-size: 0.92rem;
    font-weight: 800;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    letter-spacing: 0.5px;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(197, 168, 128, 0.25);
}
.btn-call-direct:hover,
.btn-gmap-direct:hover {
    background: #8C6239;
    border-color: #8C6239;
    color: #ffffff;
    box-shadow: 0 6px 18px rgba(140, 98, 57, 0.35);
}

/* WYSIWYG Article Container */
.contact-wysiwyg-content {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 36px 32px;
    margin-bottom: 50px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    font-size: 1.05rem;
    line-height: 1.85;
    color: #334155;
}
.contact-wysiwyg-content h2,
.contact-wysiwyg-content h3 {
    color: #0f172a;
    margin-top: 24px;
    margin-bottom: 14px;
    font-weight: 800;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .contact-main-grid {
        grid-template-columns: 1fr;
        margin-top: 24px;
        gap: 24px;
    }
}
@media (max-width: 768px) {
    .portal-hero-header {
        padding: 42px 14px 36px !important;
    }
    .portal-breadcrumb {
        font-size: clamp(0.64rem, 2.7vw, 0.78rem) !important;
        letter-spacing: 0.4px !important;
        gap: 5px !important;
        margin-bottom: 12px !important;
        flex-wrap: nowrap !important;
        white-space: nowrap !important;
        justify-content: center !important;
        line-height: 1.3 !important;
    }
    .portal-breadcrumb a,
    .portal-breadcrumb span,
    .portal-breadcrumb .current {
        white-space: nowrap !important;
        display: inline-block !important;
    }
    .portal-page-title {
        white-space: nowrap !important;
        font-size: clamp(1.2rem, 5.2vw, 1.85rem) !important;
        line-height: 1.25 !important;
        margin: 0 auto !important;
    }
    .contact-box-panel {
        padding: 24px 18px;
    }
    .contact-map-frame {
        height: 280px;
    }
}
</style>

<main id="primary" class="site-main page-contact-portal">

<?php while (have_posts()) : the_post(); ?>

    <!-- Page Breadcrumb & Header (Universal Hero Banner) -->
    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_url); ?>');">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Liên hệ', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php echo esc_html($page_title); ?></h1>
        </div>
    </section>

    <!-- Content Body -->
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

        <!-- Admin Quick Edit Toolbar -->
        <?php if (current_user_can('edit_pages')) : ?>
            <div style="background: #141414; border: 1px solid #334155; border-left: 4px solid #C5A880; border-radius: 8px; padding: 14px 20px; margin-top: 24px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 24px;">📍</span>
                    <div>
                        <strong style="color: #C5A880; font-size: 14px; display: block; font-family: 'Be Vietnam Pro', sans-serif;">QUẢN TRỊ VIÊN: SOẠN THẢO VÀ CẬP NHẬT TRANG LIÊN HỆ</strong>
                        <span style="color: #94a3b8; font-size: 13px;">Bạn có thể bổ sung thông tin phòng ban, hình ảnh xưởng, thay đổi số điện thoại hoặc biểu mẫu qua trình soạn thảo WordPress.</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(get_edit_post_link()); ?>" style="background: #C5A880; color: #141414; padding: 10px 20px; border-radius: 6px; font-weight: 800; font-size: 13.5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-family: 'Be Vietnam Pro', sans-serif; text-transform: uppercase; letter-spacing: 0.5px;">
                    <i class="fa-solid fa-pen-to-square"></i> Mở Trình Soạn Thảo Để Sửa
                </a>
            </div>
        <?php endif; ?>

        <!-- Main 2-Column: Thông Tin Trụ Sở & Bản Đồ Chỉ Đường -->
        <div class="contact-main-grid">

            <!-- Cột trái: Thông Tin Chi Tiết Trụ Sở & Đối Tác -->
            <div class="contact-box-panel">
                <h2 class="contact-panel-title">
                    Thông Tin Trụ Sở Ô Tô Hải Hà
                </h2>
                <p class="contact-panel-desc">
                    Hơn 31 năm đồng hành và chăm sóc hàng chục nghìn lượt xe hơi tại khu vực miền Bắc. Quý khách vui lòng liên hệ trực tiếp qua số điện thoại hoặc Zalo bên dưới để được phục vụ nhanh nhất.
                </p>

                <!-- Địa chỉ -->
                <div class="contact-detail-row">
                    <div class="contact-detail-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="contact-detail-info">
                        <strong>Địa chỉ trụ sở xưởng chính:</strong>
                        <span><?php echo esc_html($address_txt); ?></span>
                    </div>
                </div>

                <!-- Giờ làm việc -->
                <div class="contact-detail-row">
                    <div class="contact-detail-icon"><i class="fa-regular fa-clock"></i></div>
                    <div class="contact-detail-info">
                        <strong>Giờ phục vụ:</strong>
                        <span>07:30 - 18:30 (Thứ Hai đến Chủ Nhật)</span><br>
                        <span style="color: #D92D20; font-weight: 700;"><i class="fa-solid fa-truck-pickup"></i> Cứu hộ giao thông: Phục vụ 24/7 xuyên đêm</span>
                    </div>
                </div>

                <!-- Điện thoại & Hotline -->
                <div class="contact-detail-row">
                    <div class="contact-detail-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="contact-detail-info">
                        <strong>Điện thoại liên hệ trực tiếp:</strong>
                        <span>Tổng đài tư vấn: <a href="tel:02203892207"><strong>02203 892 207</strong></a></span><br>
                        <span>Hotline cứu hộ: <a href="tel:0911211996" style="color: #D92D20;"><strong>0911 211 996</strong></a></span>
                    </div>
                </div>

                <!-- Email & Kênh số -->
                <div class="contact-detail-row">
                    <div class="contact-detail-icon"><i class="fa-solid fa-globe"></i></div>
                    <div class="contact-detail-info">
                        <strong>Kênh kết nối nhanh:</strong>
                        <span>Email: <a href="mailto:<?php echo esc_attr($email_addr); ?>"><?php echo esc_html($email_addr); ?></a></span><br>
                        <span>Chat Zalo kỹ thuật: <a href="https://zalo.me/0911211996" target="_blank" rel="noopener"><strong>0911 211 996</strong></a></span>
                    </div>
                </div>

                <!-- Nút liên hệ trực tiếp không cần form -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 20px; margin-bottom: 20px;">
                    <a href="tel:02203892207" class="btn-call-direct" style="background: #C5A880; color: #141414; border: 1px solid #C5A880; padding: 12px 14px; border-radius: 6px; font-weight: 800; font-size: 0.88rem; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.25s ease; box-shadow: 0 4px 14px rgba(197, 168, 128, 0.25);">
                        <i class="fa-solid fa-phone-volume"></i> Gọi 02203 892 207
                    </a>
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 12px 14px; border-radius: 6px; font-weight: 700; font-size: 0.88rem; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fa-solid fa-comment-dots"></i> Chat Zalo Kỹ Thuật
                    </a>
                </div>



            </div>

            <!-- Cột phải: Bản Đồ Chỉ Đường Đến Gara Ô Tô Hải Hà -->
            <div class="contact-box-panel" style="display: flex; flex-direction: column;">
                <div class="contact-map-header" style="margin-bottom: 16px;">
                    <h2 class="contact-panel-title" style="margin: 0;">
                        Bản Đồ Chỉ Đường
                    </h2>
                </div>
                
                <div style="flex: 1; min-height: 400px; border-radius: 6px; overflow: hidden; border: 1px solid #cbd5e1; margin-bottom: 16px;">
                    <iframe 
                        class="contact-map-frame"
                        style="width: 100%; height: 100%; min-height: 400px; border: 0;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.4116602473237!2d106.292738975968!3d20.935977190957903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31359b66f542968b%3A0xd5b45cb9b6b0359!2zR2FyYSDDlCB0w7QgSOG6o2kgSMOg!5e0!3m2!1svi!2s!4v1794282058564!5m2!1svi!2s"
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin"
                        title="Bản đồ chỉ đường Gara Ô Tô Hải Hà">
                    </iframe>
                </div>

                <a href="<?php echo esc_url($map_link); ?>" target="_blank" rel="noopener" class="btn-gmap-direct">
                    <i class="fa-solid fa-diamond-turn-right"></i> Mở Google Maps Chỉ Đường
                </a>
            </div>

        </div>

        <!-- WordPress Editor Content (WYSIWYG: text, images, alignments, custom descriptions) -->
        <?php 
        $editor_content = get_the_content();
        if (!empty(trim($editor_content))) : 
        ?>
            <article class="contact-wysiwyg-content entry-content">
                <?php the_content(); ?>
            </article>
        <?php endif; ?>

    </div>

<?php endwhile; ?>

</main>

<?php
get_footer();
