<?php
/**
 * Main Index template for Hà Thành Garage
 *
 * @package HaThanh_Garage
 */

get_header();
?>

<div class="container" style="padding: 60px 20px;">
  <h1 style="font-family:var(--font-heading); font-size:2.5rem; text-transform:uppercase; margin-bottom:30px;">
    Tin Tức & Cẩm Nang Chăm Sóc Xe Hà Thành
  </h1>

  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:30px;">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        ?>
        <article style="background:#fff; border:1px solid var(--border-color); border-radius:12px; overflow:hidden; box-shadow:var(--shadow-sm);">
          <?php if (has_post_thumbnail()) : ?>
            <div style="height:200px; overflow:hidden;">
              <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:100%; object-fit:cover;')); ?>
            </div>
          <?php endif; ?>
          <div style="padding:20px;">
            <h2 style="font-size:1.25rem; font-family:var(--font-heading); margin-bottom:10px;">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p style="color:var(--text-muted); font-size:0.875rem; margin-bottom:14px;">
              <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
            </p>
            <a href="<?php the_permalink(); ?>" style="color:var(--accent-red); font-weight:700; font-size:0.875rem;">
              Đọc tiếp <i class="fa fa-arrow-right"></i>
            </a>
          </div>
        </article>
        <?php
      endwhile;
    else :
      echo '<p>Chưa có bài viết nào.</p>';
    endif;
    ?>
  </div>
</div>

<?php
get_footer();
