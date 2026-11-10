<?php
/**
 * Template Name: Về Chúng Tôi (About Hiếu Gara Service)
 * The template for displaying the company about page.
 * 100% Dynamic & Editable from WordPress Admin (WYSIWYG, Blocks, Custom Photos & Alignments)
 *
 * @package HieuGara_Motors
 */

get_header();

$about_p_title     = get_option('hieugara_about_page_title', 'Ôtô Hải Hà: 31 Năm Giữ Trọn Chữ Tâm Với Nghề');
$about_p_subtitle  = get_option('hieugara_about_page_subtitle', '');
$about_show_story  = get_option('hieugara_about_show_story', '1');
$about_show_commit = get_option('hieugara_about_show_commitments', '1');
$about_years_exp   = get_option('hieugara_about_years_exp', '31+');
$about_staff_count = get_option('hieugara_about_staff_count', '80+');
$about_parts_rate  = get_option('hieugara_about_parts_rate', '100%');
?>

<style>
/* Rich WYSIWYG Content & WordPress Media Alignment */
.about-wysiwyg-content {
    font-size: 1.08rem;
    line-height: 1.9;
    color: #334155;
    font-family: 'Be Vietnam Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.about-wysiwyg-content::after {
    content: "";
    display: table;
    clear: both;
}
.about-wysiwyg-content p {
    margin-bottom: 22px;
    font-size: 1.08rem;
    line-height: 1.9;
    color: #334155;
}
.about-wysiwyg-content p.lead {
    font-size: 1.2rem;
    line-height: 1.85;
    color: #0f172a;
    font-weight: 500;
}
.about-wysiwyg-content h2 {
    font-size: 1.85rem;
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
.about-wysiwyg-content h3 {
    font-size: 1.45rem;
    font-weight: 700;
    color: #1e293b;
    margin: 32px 0 16px;
    line-height: 1.4;
}
.about-wysiwyg-content h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #334155;
    margin: 24px 0 12px;
}
.about-wysiwyg-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    display: inline-block;
}
.about-wysiwyg-content figure {
    margin: 28px 0;
}
.about-wysiwyg-content figcaption {
    font-size: 0.9rem;
    color: #64748b;
    text-align: center;
    font-style: italic;
    margin-top: 10px;
}

/* WordPress Media Alignment Floats */
.about-wysiwyg-content .alignleft,
.about-wysiwyg-content figure.alignleft {
    float: left;
    margin: 8px 32px 24px 0;
    max-width: 50%;
}
.about-wysiwyg-content .alignright,
.about-wysiwyg-content figure.alignright {
    float: right;
    margin: 8px 0 24px 32px;
    max-width: 50%;
}
.about-wysiwyg-content .aligncenter,
.about-wysiwyg-content figure.aligncenter {
    display: block;
    margin: 32px auto;
    text-align: center;
    clear: both;
}
.about-wysiwyg-content .aligncenter img {
    margin: 0 auto;
}

/* Gallery Block */
.about-wysiwyg-content .wp-block-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin: 32px 0;
    padding: 0;
    list-style: none;
}
.about-wysiwyg-content .wp-block-gallery .wp-block-image {
    flex: 1 1 calc(33.333% - 16px);
    margin: 0;
}
.about-wysiwyg-content .wp-block-gallery img {
    width: 100%;
    height: 240px;
    object-fit: cover;
}

/* Quotes & Lists */
.about-wysiwyg-content blockquote {
    border-left: 4px solid #C5A880;
    background: #f8fafc;
    padding: 20px 28px;
    font-weight: 600;
    color: #0f172a;
    font-size: 1.15rem;
    line-height: 1.7;
    margin: 32px 0;
    border-radius: 0 8px 8px 0;
    font-style: italic;
}
.about-wysiwyg-content ul, 
.about-wysiwyg-content ol {
    margin: 18px 0 24px 32px;
    color: #334155;
    line-height: 1.85;
}
.about-wysiwyg-content li {
    margin-bottom: 8px;
}

@media (max-width: 768px) {
    .about-wysiwyg-content .alignleft,
    .about-wysiwyg-content figure.alignleft,
    .about-wysiwyg-content .alignright,
    .about-wysiwyg-content figure.alignright {
        float: none;
        max-width: 100%;
        margin: 20px 0;
    }
    .about-wysiwyg-content .wp-block-gallery .wp-block-image {
        flex: 1 1 100%;
    }
}
</style>

<main id="primary" class="site-main page-about-portal">

<?php while (have_posts()) : the_post(); ?>

    <!-- Page Breadcrumb & Header (Universal Hero Banner) -->
    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url(hieugara_get_current_page_banner()); ?>');">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Về chúng tôi', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php echo esc_html($about_p_title); ?></h1>
            <?php if (!empty($about_p_subtitle)) : ?>
            <p class="portal-page-subtitle">
                <?php echo nl2br(esc_html($about_p_subtitle)); ?>
            </p>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($about_show_story === '1') : ?>
    <!-- Company Story & Mission (100% Dynamic from WordPress Editor) -->
    <section class="about-story-section" id="su-kien" style="padding: 60px 0 75px; background: #ffffff;">
        <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 0 20px;">

            <?php if (current_user_can('edit_pages')) : ?>
                <!-- Admin Quick Edit Toolbar -->
                <div class="about-admin-bar" style="background: #141414; border: 1px solid #334155; border-left: 4px solid #C5A880; border-radius: 8px; padding: 14px 20px; margin-bottom: 35px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 22px;">⚙️</span>
                        <div>
                            <strong style="color: #C5A880; font-size: 14px; display: block; font-family: 'Be Vietnam Pro', sans-serif;">QUẢN TRỊ VIÊN: TÙY BIẾN NỘI DUNG &amp; ẢNH TRANG NÀY</strong>
                            <span style="color: #94a3b8; font-size: 13px;">Bạn có thể viết thêm bài, chèn thêm ảnh, căn trái/phải/giữa hoặc thêm album ảnh như một dịch vụ.</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(get_edit_post_link()); ?>" style="background: #C5A880; color: #141414; padding: 10px 20px; border-radius: 6px; font-weight: 800; font-size: 13.5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-family: 'Be Vietnam Pro', sans-serif; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-pen-to-square"></i> Mở Trình Soạn Thảo Để Sửa
                    </a>
                </div>
            <?php endif; ?>

            <div class="about-main-wrapper">
                
                <!-- Story Tag & Subheader -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #f1f5f9;">
                    <span class="story-tag" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(197, 168, 128, 0.12); color: #C5A880; border: 1px solid rgba(197, 168, 128, 0.3); padding: 6px 14px; border-radius: 4px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.8rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;">
                        HÀNH TRÌNH <?php echo esc_html($about_years_exp); ?> NĂM (1995 — <?php echo date('Y'); ?>)
                    </span>
                    <div style="display: flex; gap: 16px; align-items: center;">
                        <a href="tel:02203892207" style="color: #334155; text-decoration: none; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fa-solid fa-phone-volume" style="color: #C5A880;"></i> 02203 892 207
                        </a>
                    </div>
                </div>

                <!-- WordPress Editor Content (WYSIWYG: text, images, alignments, galleries) -->
                <article class="about-wysiwyg-content entry-content" style="margin-bottom: 45px;">
                    <?php 
                    $page_content = get_the_content();
                    if (!empty(trim($page_content))) {
                        the_content();
                    } else {
                        // Fallback in case content is completely blank
                        echo '<p class="lead">Năm 1995, nhà sáng lập ông <strong>Nguyễn Hải Hà</strong> đặt những viên gạch đầu tiên cho Ôtô Hải Hà với một niềm tin giản dị: <em>mỗi chiếc xe đều xứng đáng được chăm sóc bằng cái tâm của người thợ</em>. 31 năm đã trôi qua, niềm tin ấy vẫn là kim chỉ nam trong từng công việc chúng tôi làm mỗi ngày.</p>';
                    }
                    ?>
                </article>

                <!-- Highlights Row (Key Statistics - Light Luxury Style) -->
                <div class="about-highlights-row" style="background: #FBF8F3; border: 1px solid #E2E8F0; border-top: 3px solid #C5A880; border-radius: 8px; padding: 26px 18px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.04);">
                    <div class="hl-item">
                        <strong style="display: block; font-size: 2.2rem; color: #8C6239; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; line-height: 1.2;"><?php echo esc_html($about_years_exp); ?></strong>
                        <span style="font-size: 0.83rem; color: #475569; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Năm đồng hành (1995-<?php echo date('Y'); ?>)</span>
                    </div>
                    <div class="hl-item">
                        <strong style="display: block; font-size: 2.2rem; color: #8C6239; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; line-height: 1.2;"><?php echo esc_html($about_staff_count); ?></strong>
                        <span style="font-size: 0.83rem; color: #475569; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Nhân sự tận tâm &amp; tay nghề cao</span>
                    </div>
                    <div class="hl-item">
                        <strong style="display: block; font-size: 2.2rem; color: #8C6239; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; line-height: 1.2;"><?php echo esc_html($about_parts_rate); ?></strong>
                        <span style="font-size: 0.83rem; color: #475569; text-transform: uppercase; letter-spacing: 0.3px; font-weight: 600;">Phụ tùng chính hãng &amp; bảo hành chuẩn</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($about_show_commit === '1') : ?>
    <!-- 5 Cam Kết "Vàng" -->
    <section class="commitments-section" id="tieu-chuan">
        <div class="container">
            <div class="section-header">
                <div class="section-pill"><?php _e('NGUYÊN TẮC HOẠT ĐỘNG', 'hieugara-motors'); ?></div>
                <h2 class="section-title"><?php _e('5 Cam Kết "Vàng" Từ Ôtô Hải Hà', 'hieugara-motors'); ?></h2>
                <p class="section-desc" style="max-width: 960px;">
                    <?php _e('Kim chỉ nam trong mọi hoạt động tiếp nhận xe và phục vụ khách hàng trên toàn bộ hệ thống xưởng.', 'hieugara-motors'); ?>
                </p>
            </div>

            <div class="commitments-grid">
                <?php
                $commits_list = array(
                    1 => array(
                        'num'   => '01',
                        'title' => 'Phụ Tùng Chính Hãng',
                        'desc'  => 'Mọi linh kiện, dầu nhớt và phụ tùng thay thế đều có tem kiểm định, hóa đơn xuất xứ rõ ràng.'
                    ),
                    2 => array(
                        'num'   => '02',
                        'title' => 'Báo Giá Chuẩn &amp; Không Phát Sinh',
                        'desc'  => 'Khách hàng duyệt bảng kê chi tiết phụ tùng và công thợ trước khi tiến hành. Tuyệt đối không phát sinh chi phí khi chưa được đồng ý.'
                    ),
                    3 => array(
                        'num'   => '03',
                        'title' => 'Bảo Hành Dài Hạn Minh Bạch',
                        'desc'  => 'Cam kết chất lượng bằng văn bản và phiếu bảo hành chính thức.'
                    ),
                    4 => array(
                        'num'   => '04',
                        'title' => 'Đúng Hẹn Bàn Giao Xe',
                        'desc'  => 'Quy trình thi công được giám sát chặt chẽ trên bảng điều độ khoang xưởng, đảm bảo xe được bàn giao đúng giờ đã hẹn.'
                    ),
                    5 => array(
                        'num'   => '05',
                        'title' => 'Đồng Hành Trọn Vẹn 24/7',
                        'desc'  => 'Hỗ trợ cứu hộ giao thông khẩn cấp, nhắc hẹn bảo dưỡng định kỳ và hỗ trợ thủ tục giám định bảo hiểm thân vỏ miễn phí trọn gói.'
                    ),
                );

                foreach ($commits_list as $c_idx => $c_item) :
                    $c_bg = function_exists('hieugara_get_commit_bg') ? hieugara_get_commit_bg($c_idx) : '';
                ?>
                <div class="commit-card has-bg-banner">
                    <?php if (!empty($c_bg)) : ?>
                        <div class="commit-card-bg" style="background-image: url('<?php echo esc_url($c_bg); ?>');" aria-hidden="true"></div>
                        <div class="commit-card-overlay" aria-hidden="true"></div>
                    <?php endif; ?>
                    <div class="commit-card-content">
                        <div class="commit-num"><?php echo esc_html($c_item['num']); ?></div>
                        <h4><?php echo wp_kses_post($c_item['title']); ?></h4>
                        <p><?php echo esc_html($c_item['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div style="text-align: center; margin-top: 48px;">
                <a href="tel:02203892207" class="btn-carpla btn-carpla-primary" style="padding: 14px 36px; font-weight: 800; background: #8C6239; color: #ffffff; border-radius: 6px; box-shadow: 0 4px 14px rgba(140, 98, 57, 0.25);">
                    <i class="fa-solid fa-phone-volume"></i> <?php _e('GỌI TƯ VẤN DỊCH VỤ: 02203 892 207', 'hieugara-motors'); ?>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php endwhile; ?>

</main>

<?php
get_footer();
