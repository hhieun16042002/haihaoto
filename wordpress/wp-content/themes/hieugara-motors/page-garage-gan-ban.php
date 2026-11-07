<?php
/**
 * Template Name: Mạng Lưới Garage Gần Bạn (Carpla Workshop Network)
 * The template for displaying the nationwide garage locator.
 *
 * @package HieuGara_Motors
 */

get_header();

$workshops = [
    [
        'id'        => 'gara-hai-ha',
        'city'      => 'hai-duong',
        'city_name' => 'Hải Dương (Trụ Sở Chính)',
        'name'      => 'Ôtô Hải Hà (Trung Tâm Dịch Vụ Kỹ Thuật Chính)',
        'address'   => 'Km3+500 Đường Nguyễn Lương Bằng, Phường Bình Hàn, Thành phố Hải Dương',
        'phone'     => '0911.211.996',
        'hotline'   => '02203 892 207',
        'hours'     => '07:30 - 18:30 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '28 Cầu nâng thủy lực',
        'paint'     => '4 Buồng sơn sấy Axalta Đức',
        'services'  => ['Bảo dưỡng định kỳ', 'Đại tu động cơ & hộp số', 'Cân chỉnh 3D Hunter', 'Đồng sơn sấy hấp', 'Cứu hộ 24/7', 'Dịch vụ đối tác VinFast'],
        'map_link'  => 'https://maps.google.com/?cid=15399047910545937753',
    ],
];
?>

<main id="primary" class="site-main page-network-portal">

    <!-- Page Breadcrumb & Header -->
    <section class="portal-hero-header">
        <div class="container">
            <div class="portal-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span>/</span>
                <span class="current"><?php _e('Hệ thống garage gần bạn', 'hieugara-motors'); ?></span>
            </div>
            <h1 class="portal-page-title"><?php _e('Hệ Thống Xưởng Dịch Vụ Ô Tô Ôtô Hải Hà', 'hieugara-motors'); ?></h1>
            <p class="portal-page-subtitle">
                <?php _e('Mạng lưới cơ sở xưởng dịch vụ phủ rộng tại Hà Nội, TP. Hồ Chí Minh và Đà Nẵng với trang thiết bị đồng bộ, đáp ứng tiêu chuẩn khắt khe nhất của các hãng xe.', 'hieugara-motors'); ?>
            </p>
        </div>
    </section>

    <!-- Network List & Filter Section -->
    <section class="network-listing-section" style="padding: 50px 0 80px; background: #ffffff;">
        <div class="container">

            <!-- Filter Tabs by City -->
            <div class="city-filter-bar">
                <span class="filter-label"><i class="fa-solid fa-filter"></i> Lọc theo khu vực:</span>
                <div class="filter-btn-group">
                    <button type="button" class="city-filter-btn active" data-city="all">Tất Cả (<?php echo count($workshops); ?>)</button>
                    <button type="button" class="city-filter-btn" data-city="hai-duong">Hải Dương (1)</button>
                    <button type="button" class="city-filter-btn" data-city="hanoi">Hà Nội (3)</button>
                    <button type="button" class="city-filter-btn" data-city="hcm">TP. Hồ Chí Minh (2)</button>
                    <button type="button" class="city-filter-btn" data-city="danang">Đà Nẵng (1)</button>
                </div>
            </div>

            <!-- Workshop Cards Grid -->
            <div class="network-workshops-grid">
                <?php foreach ($workshops as $ws): ?>
                    <article class="workshop-full-card" data-city="<?php echo esc_attr($ws['city']); ?>">
                        <div class="ws-card-header">
                            <div>
                                <span class="ws-city-tag"><?php echo esc_html($ws['city_name']); ?></span>
                                <h3 class="ws-title"><?php echo esc_html($ws['name']); ?></h3>
                            </div>
                            <span class="ws-status-badge">
                                <span class="badge-dot"></span> Đang Mở Cửa
                            </span>
                        </div>

                        <div class="ws-address-row">
                            <i class="fa-solid fa-location-dot" style="color: #D92D20;"></i>
                            <span><?php echo esc_html($ws['address']); ?></span>
                        </div>

                        <div class="ws-specs-row">
                            <div class="spec-pill"><i class="fa-solid fa-warehouse"></i> <?php echo esc_html($ws['bays']); ?></div>
                            <div class="spec-pill"><i class="fa-solid fa-paint-roller"></i> <?php echo esc_html($ws['paint']); ?></div>
                            <div class="spec-pill"><i class="fa-regular fa-clock"></i> <?php echo esc_html($ws['hours']); ?></div>
                        </div>

                        <div class="ws-services-chips">
                            <strong>Dịch vụ hỗ trợ:</strong>
                            <div class="chips-wrap">
                                <?php foreach ($ws['services'] as $svc): ?>
                                    <span class="service-chip"><?php echo esc_html($svc); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="ws-actions-row">
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $ws['phone'])); ?>" class="btn-carpla btn-carpla-outline">
                                <i class="fa-solid fa-phone"></i> Gọi xưởng: <?php echo esc_html($ws['phone']); ?>
                            </a>
                            <a href="<?php echo esc_url($ws['map_link']); ?>" target="_blank" rel="noopener" class="btn-carpla btn-carpla-primary" style="background: #D4B996; color: #141414;">
                                <i class="fa-solid fa-diamond-turn-right"></i> Chỉ đường Google Maps
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</main>

<script>
jQuery(document).ready(function($) {
    $('.city-filter-btn').on('click', function() {
        var city = $(this).data('city');
        $('.city-filter-btn').removeClass('active');
        $(this).addClass('active');

        if (city === 'all') {
            $('.workshop-full-card').fadeIn(200);
        } else {
            $('.workshop-full-card').each(function() {
                if ($(this).data('city') === city) {
                    $(this).fadeIn(200);
                } else {
                    $(this).fadeOut(150);
                }
            });
        }
    });
});
</script>

<?php
get_footer();
