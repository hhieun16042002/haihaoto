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
        'name'      => 'Gara Ô Tô Hải Hà (Trung Tâm Dịch Vụ Chính)',
        'address'   => 'Trung tâm chẩn đoán, sửa chữa máy gầm, điều hòa & phòng sơn sấy hấp ô tô Hải Hà',
        'phone'     => '0911.211.996',
        'hotline'   => '02203 892 207',
        'hours'     => '07:30 - 18:30 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '28 Cầu nâng thủy lực',
        'paint'     => '4 Buồng sơn sấy Axalta Đức',
        'services'  => ['Bảo dưỡng định kỳ', 'Đại tu động cơ & hộp số', 'Cân chỉnh 3D Hunter', 'Đồng sơn sấy hấp', 'Cứu hộ 24/7'],
        'map_link'  => 'https://maps.google.com/?cid=15399047910545937753',
    ],
    [
        'id'        => 'tay-ho',
        'city'      => 'hanoi',
        'city_name' => 'Hà Nội',
        'name'      => 'Cơ sở 2: Xưởng Tây Hồ',
        'address'   => 'Số 685 đường Lạc Long Quân, P. Phú Thượng, Q. Tây Hồ, Hà Nội',
        'phone'     => '0123.456.789',
        'hotline'   => '0123 456 789',
        'hours'     => '08:00 - 18:00 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '10 Cầu nâng',
        'paint'     => '2 Buồng sơn sấy',
        'services'  => ['Bảo dưỡng định kỳ', 'Đồng sơn nhanh', 'Máy gầm', 'Cứu hộ 24/7'],
        'map_link'  => 'https://maps.google.com/?q=685+Lac+Long+Quan+Ha+Noi',
    ],
    [
        'id'        => 'long-bien',
        'city'      => 'hanoi',
        'city_name' => 'Hà Nội',
        'name'      => 'Cơ sở 3: Xưởng Long Biên',
        'address'   => 'Số 390 đường Nguyễn Văn Cừ, P. Bồ Đề, Q. Long Biên, Hà Nội',
        'phone'     => '0123.456.789',
        'hotline'   => '0123 456 789',
        'hours'     => '08:00 - 18:00 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '12 Cầu nâng',
        'paint'     => '2 Buồng sơn sấy',
        'services'  => ['Bảo dưỡng định kỳ', 'Đồng sơn sấy hấp', 'Đại tu máy gầm', 'Bảo hiểm thân vỏ'],
        'map_link'  => 'https://maps.google.com/?q=390+Nguyen+Van+Cu+Ha+Noi',
    ],
    [
        'id'        => 'ha-dong',
        'city'      => 'hanoi',
        'city_name' => 'Hà Nội',
        'name'      => 'Cơ sở 4: Xưởng Hà Đông',
        'address'   => 'Số 102 đường Quang Trung, P. Quang Trung, Q. Hà Đông, Hà Nội',
        'phone'     => '0123.456.789',
        'hotline'   => '0123 456 789',
        'hours'     => '08:00 - 18:00 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '14 Cầu nâng',
        'paint'     => '2 Buồng sơn sấy',
        'services'  => ['Bảo dưỡng định kỳ', 'Đồng sơn sấy hấp', 'Căn chỉnh thước lái 3D', 'Detailing'],
        'map_link'  => 'https://maps.google.com/?q=102+Quang+Trung+Ha+Dong',
    ],
    [
        'id'        => 'tan-binh',
        'city'      => 'hcm',
        'city_name' => 'TP. Hồ Chí Minh',
        'name'      => 'Cơ sở 5: Xưởng Tân Bình - Nam Sài Gòn',
        'address'   => 'Số 18 đường Cộng Hòa, Phường 4, Quận Tân Bình, TP. Hồ Chí Minh',
        'phone'     => '0123.456.789',
        'hotline'   => '0123 456 789',
        'hours'     => '08:00 - 18:30 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '18 Cầu nâng thủy lực',
        'paint'     => '4 Buồng sơn sấy khép kín',
        'services'  => ['Bảo dưỡng định kỳ', 'Đại tu động cơ hộp số', 'Đồng sơn sấy hấp', 'Detailing PPF', 'Bảo hiểm thân vỏ'],
        'map_link'  => 'https://maps.google.com/?q=18+Cong+Hoa+Tan+Binh',
    ],
    [
        'id'        => 'quan-7',
        'city'      => 'hcm',
        'city_name' => 'TP. Hồ Chí Minh',
        'name'      => 'Cơ sở 6: Xưởng Quận 7',
        'address'   => 'Số 55 đường Nguyễn Thị Thập, P. Tân Phú, Quận 7, TP. Hồ Chí Minh',
        'phone'     => '0123.456.789',
        'hotline'   => '0123 456 789',
        'hours'     => '08:00 - 18:00 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '12 Cầu nâng',
        'paint'     => '2 Buồng sơn sấy',
        'services'  => ['Bảo dưỡng định kỳ', 'Đồng sơn nhanh', 'Điện - Điều hòa', 'Dán phim 3M'],
        'map_link'  => 'https://maps.google.com/?q=55+Nguyen+Thi+Thap+Quan+7',
    ],
    [
        'id'        => 'da-nang',
        'city'      => 'danang',
        'city_name' => 'Đà Nẵng',
        'name'      => 'Cơ sở 7: Xưởng Đà Nẵng',
        'address'   => 'Số 240 đường Nguyễn Tri Phương, P. Thạc Gián, Q. Thanh Khê, Đà Nẵng',
        'phone'     => '0123.456.789',
        'hotline'   => '0123 456 789',
        'hours'     => '08:00 - 18:00 (Cả Thứ 7 & Chủ Nhật)',
        'bays'      => '10 Cầu nâng',
        'paint'     => '2 Buồng sơn sấy',
        'services'  => ['Bảo dưỡng định kỳ', 'Đồng sơn sấy hấp', 'Máy gầm', 'Cứu hộ miền Trung'],
        'map_link'  => 'https://maps.google.com/?q=240+Nguyen+Tri+Phuong+Da+Nang',
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
            <h1 class="portal-page-title"><?php _e('Hệ Thống Xưởng Dịch Vụ Ô Tô Hải Hà ÔTô', 'hieugara-motors'); ?></h1>
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
                <span class="filter-label"><i class="fa fa-filter"></i> Lọc theo khu vực:</span>
                <div class="filter-btn-group">
                    <button type="button" class="city-filter-btn active" data-city="all">Tất Cả (<?php echo count($workshops); ?>)</button>
                    <button type="button" class="city-filter-btn" data-city="hanoi">Hà Nội (4)</button>
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
                            <i class="fa fa-location-dot" style="color: var(--brand-red);"></i>
                            <span><?php echo esc_html($ws['address']); ?></span>
                        </div>

                        <div class="ws-specs-row">
                            <div class="spec-pill"><i class="fa fa-warehouse"></i> <?php echo esc_html($ws['bays']); ?></div>
                            <div class="spec-pill"><i class="fa fa-paint-roller"></i> <?php echo esc_html($ws['paint']); ?></div>
                            <div class="spec-pill"><i class="fa fa-clock"></i> <?php echo esc_html($ws['hours']); ?></div>
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
                                <i class="fa fa-phone"></i> Gọi xưởng: <?php echo esc_html($ws['phone']); ?>
                            </a>
                            <a href="<?php echo esc_url(home_url('/dat-lich/?branch=' . urlencode($ws['name']))); ?>" class="btn-carpla btn-carpla-primary">
                                <i class="fa fa-calendar-check"></i> Đặt lịch tại xưởng này
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
