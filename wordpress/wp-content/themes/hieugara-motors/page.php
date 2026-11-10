<?php
/**
 * The template for displaying all single pages
 *
 * @package HieuGara_Motors
 */

get_header();

$banner_url = function_exists('hieugara_get_current_page_banner') ? hieugara_get_current_page_banner() : (get_template_directory_uri() . '/assets/images/banners/banner-default.jpg');
?>

<main id="primary" class="site-main page-standard">

<?php while (have_posts()) : the_post(); ?>

    <section class="portal-hero-header" style="background-image: url('<?php echo esc_url($banner_url); ?>');">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
            <h1 class="portal-page-title"><?php the_title(); ?></h1>
        </div>
    </section>

    <section class="page-content-section" style="padding: 60px 0 80px; background: #ffffff;">
        <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
            <?php if (current_user_can('edit_pages')) : ?>
                <div style="background: #141414; border-left: 4px solid #C5A880; border-radius: 6px; padding: 12px 18px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <span style="color: #cbd5e1; font-size: 13.5px;"><i class="fa-solid fa-gear" style="color: #C5A880;"></i> Bạn đang xem trang với tư cách Quản trị viên.</span>
                    <a href="<?php echo esc_url(get_edit_post_link()); ?>" style="background: #C5A880; color: #141414; padding: 7px 16px; border-radius: 4px; font-weight: 700; font-size: 13px; text-decoration: none;">
                        <i class="fa-solid fa-pen"></i> Chỉnh sửa trang
                    </a>
                </div>
            <?php endif; ?>

            <article class="entry-content" style="font-size: 1.05rem; line-height: 1.85; color: #334155;">
                <?php the_content(); ?>
            </article>
        </div>
    </section>

<?php endwhile; ?>

</main>

<?php
get_footer();

