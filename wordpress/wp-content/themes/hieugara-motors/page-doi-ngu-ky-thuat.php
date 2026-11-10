<?php
/**
 * Template Name: Đội Ngũ Kỹ Thuật
 * Description: Trang giới thiệu đội ngũ kỹ thuật viên & kỹ sư Ô Tô Hải Hà
 * 100% Dynamic & Editable from WordPress Admin (WYSIWYG, Blocks, Custom Photos & Alignments)
 *
 * @package HieuGara_Motors
 */

get_header();

$banner_url      = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : (function_exists('hieugara_get_page_banner_url') ? hieugara_get_page_banner_url('about') : (get_template_directory_uri() . '/assets/images/banners/banner-ve-chung-toi.jpg'));
$page_title      = get_the_title();
$about_years_exp = get_option('hieugara_about_years_exp', '31+');
$about_staff_count = get_option('hieugara_about_staff_count', '80+');
?>

<style>
/* Rich WYSIWYG Content & WordPress Media Alignment */
.team-wysiwyg-content {
    font-size: 1.06rem;
    line-height: 1.9;
    color: #334155;
    font-family: 'Be Vietnam Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.team-wysiwyg-content::after {
    content: "";
    display: table;
    clear: both;
}
.team-wysiwyg-content p {
    margin-bottom: 22px;
    font-size: 1.06rem;
    line-height: 1.9;
    color: #334155;
}
.team-wysiwyg-content p.lead {
    font-size: 1.18rem;
    line-height: 1.85;
    color: #0f172a;
    font-weight: 500;
}
.team-wysiwyg-content h2 {
    font-size: 1.75rem;
    font-weight: 800;
    color: #141414;
    margin: 40px 0 20px;
    line-height: 1.35;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding-bottom: 8px;
    border-bottom: 3px solid #C5A880;
    display: inline-block;
}
.team-wysiwyg-content h3 {
    font-size: 1.35rem;
    font-weight: 700;
    color: #1e293b;
    margin: 30px 0 14px;
    line-height: 1.4;
}
.team-wysiwyg-content h4 {
    font-size: 1.15rem;
    font-weight: 700;
    color: #334155;
    margin: 22px 0 10px;
}
.team-wysiwyg-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    display: inline-block;
}
.team-wysiwyg-content figure {
    margin: 28px 0;
}
.team-wysiwyg-content figcaption {
    font-size: 0.88rem;
    color: #64748b;
    text-align: center;
    font-style: italic;
    margin-top: 10px;
}

/* WordPress Media Alignment Floats */
.team-wysiwyg-content .alignleft,
.team-wysiwyg-content figure.alignleft {
    float: left;
    margin: 8px 32px 24px 0;
    max-width: 50%;
}
.team-wysiwyg-content .alignright,
.team-wysiwyg-content figure.alignright {
    float: right;
    margin: 8px 0 24px 32px;
    max-width: 50%;
}
.team-wysiwyg-content .aligncenter,
.team-wysiwyg-content figure.aligncenter {
    display: block;
    margin: 28px auto;
    text-align: center;
    clear: both;
}

.team-wysiwyg-content ul,
.team-wysiwyg-content ol {
    margin: 0 0 26px 24px;
    padding: 0;
}
.team-wysiwyg-content li {
    margin-bottom: 10px;
    line-height: 1.8;
}

/* Team Grid Component */
.team-pillars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin: 35px 0 45px;
}
.team-pillar-card {
    background: #ffffff;
    border: 1px solid #E2E8F0;
    border-top: 3px solid #C5A880;
    border-radius: 8px;
    padding: 26px 22px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.team-pillar-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}
.team-pillar-icon {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    background: rgba(197, 168, 128, 0.15);
    color: #8C6239;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin-bottom: 16px;
}
.team-pillar-card h4 {
    font-size: 1.1rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px;
    text-transform: uppercase;
}
.team-pillar-card p {
    font-size: 0.92rem;
    color: #64748b;
    line-height: 1.65;
    margin: 0;
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
        font-size: clamp(1.4rem, 5.5vw, 1.85rem) !important;
        line-height: 1.25 !important;
        margin: 0 auto !important;
    }
    .team-wysiwyg-content .alignleft,
    .team-wysiwyg-content figure.alignleft,
    .team-wysiwyg-content .alignright,
    .team-wysiwyg-content figure.alignright {
        float: none;
        max-width: 100%;
        margin: 16px 0;
    }
    .team-pillars-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<main id="primary" class="site-main page-team-portal">

<?php while (have_posts()) : the_post(); ?>

    <!-- Page Breadcrumb & Header (Universal Hero Banner) -->
    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_url); ?>');">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <a href="<?php echo esc_url(home_url('/ve-chung-toi/')); ?>"><?php _e('Giới thiệu', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Đội ngũ kỹ thuật', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php echo esc_html($page_title); ?></h1>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="team-content-section" style="padding: 60px 0 85px; background: #ffffff;">
        <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">

            <?php if (current_user_can('edit_pages')) : ?>
                <!-- Admin Quick Edit Toolbar -->
                <div class="about-admin-bar" style="background: #141414; border: 1px solid #334155; border-left: 4px solid #C5A880; border-radius: 8px; padding: 14px 20px; margin-bottom: 35px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 24px;">👨‍🔧</span>
                        <div>
                            <strong style="color: #C5A880; font-size: 14px; display: block; font-family: 'Be Vietnam Pro', sans-serif;">QUẢN TRỊ VIÊN: SOẠN THẢO VÀ CẬP NHẬT TRANG ĐỘI NGŨ KỸ THUẬT</strong>
                            <span style="color: #94a3b8; font-size: 13px;">Bạn có thể viết thêm chi tiết, bổ sung hình ảnh thợ thực tế, chứng chỉ hoặc danh sách thành viên trực tiếp qua trình soạn thảo WordPress.</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(get_edit_post_link()); ?>" style="background: #C5A880; color: #141414; padding: 10px 20px; border-radius: 6px; font-weight: 800; font-size: 13.5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-family: 'Be Vietnam Pro', sans-serif; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-pen-to-square"></i> Mở Trình Soạn Thảo Để Sửa
                    </a>
                </div>
            <?php endif; ?>

            <div class="team-main-wrapper">
                
                <!-- Story Tag & Contact Hotline -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #f1f5f9;">
                    <span class="story-tag" style="display: inline-flex; align-items: center; background: rgba(197, 168, 128, 0.12); color: #8C6239; border: 1px solid rgba(197, 168, 128, 0.35); padding: 6px 14px; border-radius: 4px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.8rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;">
                        Tay nghề người thợ
                    </span>
                    <div style="display: flex; gap: 16px; align-items: center;">
                        <a href="tel:02203892207" style="color: #334155; text-decoration: none; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-phone-volume" style="color: #C5A880;"></i> 02203 892 207
                        </a>
                    </div>
                </div>

                <!-- WordPress Editor Content (WYSIWYG: text, images, alignments, galleries) -->
                <article class="team-wysiwyg-content entry-content" style="margin-bottom: 45px;">
                    <?php 
                    $page_content = get_the_content();
                    if (!empty(trim($page_content))) {
                        the_content();
                    } else {
                        // Fallback starter content
                        echo '<p class="lead">Tại Ô Tô Hải Hà, con người là giá trị cốt lõi làm nên uy tín 31 năm. Đội ngũ kỹ sư, kỹ thuật viên của chúng tôi không chỉ vững vàng chuyên môn cơ khí ô tô truyền thống mà còn liên tục được đào tạo bài bản về công nghệ chẩn đoán ECU hiện đại và kỹ thuật xe điện VinFast.</p>';
                    }
                    ?>
                </article>

                <!-- Highlights Row (Key Statistics - Light Luxury Style) -->
                <div class="team-highlights-row" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; background: #FBF8F3; border: 1px solid #E2E8F0; border-top: 3px solid #C5A880; border-radius: 8px; padding: 26px 18px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.04); margin-bottom: 0;">
                    <div class="hl-item">
                        <strong style="display: block; font-size: 2.2rem; color: #8C6239; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; line-height: 1.2;"><?php echo esc_html($about_years_exp); ?></strong>
                        <span style="font-size: 0.83rem; color: #475569; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600; white-space: nowrap;">Năm kinh nghiệm kỹ thuật</span>
                    </div>
                    <div class="hl-item" style="border-left: 1px solid #E2E8F0;">
                        <strong style="display: block; font-size: 2.2rem; color: #8C6239; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; line-height: 1.2;"><?php echo esc_html($about_staff_count); ?></strong>
                        <span style="font-size: 0.83rem; color: #475569; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600; white-space: nowrap;">Kỹ sư &amp; Kỹ thuật viên</span>
                    </div>
                    <div class="hl-item" style="border-left: 1px solid #E2E8F0;">
                        <strong style="display: block; font-size: 2.2rem; color: #8C6239; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; line-height: 1.2;">100%</strong>
                        <span style="font-size: 0.83rem; color: #475569; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600; white-space: nowrap;">Được đào tạo chuẩn quy trình</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php endwhile; ?>

</main>

<?php
get_footer();

