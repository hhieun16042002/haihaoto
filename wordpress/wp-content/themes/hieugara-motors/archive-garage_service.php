<?php
/**
 * Archive Template for Garage Services (/dich-vu/)
 * Content structured after Prestige Automobile Services, adapted for Ôtô Hải Hà
 * keeping the existing HieuGara Motors layout.
 *
 * @package HieuGara_Motors
 */

get_header();

$theme_uri    = get_template_directory_uri();
$gallery_img  = $theme_uri . '/assets/images/gallery';
$rescue_phone = get_option('hieugara_rescue_phone', '0911 211 996');

$prestige_services = array(
    array(
        'title' => 'BẢO DƯỠNG Ô TÔ',
        'badge' => 'TIÊU CHUẨN HÃNG',
        'desc'  => 'Việc bảo dưỡng – bảo trì xe định kỳ không chỉ mang lại sự an toàn mà còn kéo dài tuổi thọ và hiệu suất hoạt động của xe. Tại Ôtô Hải Hà, chúng tôi thực hiện việc bảo trì và bảo dưỡng với quy trình chuyên nghiệp, sử dụng phụ tùng chính hãng theo đúng tiêu chuẩn từ nhà sản xuất, giúp phòng ngừa hỏng hóc, kéo dài tuổi thọ và giữ vững giá trị xe.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('bao-duong-o-to', $gallery_img . '/haiha-gallery-4.jpg') : $gallery_img . '/haiha-gallery-4.jpg',
        'link'  => home_url('/dich-vu/bao-duong-o-to/')
    ),
    array(
        'title' => 'SỬA CHỮA XE TOÀN DIỆN',
        'badge' => 'CHẨN ĐOÁN CHUYÊN SÂU',
        'desc'  => 'Từ những vấn đề phức tạp nhất của động cơ, hộp số, hệ thống điện đến các sửa chữa thông thường ở các bộ phận như gầm bệ, phanh… Đội ngũ kỹ thuật viên giàu kinh nghiệm của Ôtô Hải Hà cùng cơ sở vật chất hiện đại sẽ luôn “bắt đúng bệnh, sửa đúng chỗ”, giúp phục hồi hiệu suất và mang lại sự an tâm tuyệt đối cho bạn.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('sua-chua-o-to', $gallery_img . '/haiha-gallery-1.jpg') : $gallery_img . '/haiha-gallery-1.jpg',
        'link'  => home_url('/dich-vu/sua-chua-o-to/')
    ),
    array(
        'title' => 'SỬA CHỮA THÂN VỎ – ĐỒNG SƠN',
        'badge' => 'PHÒNG SƠN TIÊU CHUẨN',
        'desc'  => 'Phục hồi vẻ đẹp nguyên bản và đẳng cấp cho chiếc xe của bạn. Với đội ngũ tay nghề cao, thiết bị hiện đại, công nghệ pha màu sơn vi tính và phòng sơn tiêu chuẩn, chúng tôi cam kết xử lý mọi vết trầy xước, móp méo, trả lại diện mạo hoàn hảo, không một tì vết.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('dong-son-o-to', $gallery_img . '/haiha-gallery-2.jpg') : $gallery_img . '/haiha-gallery-2.jpg',
        'link'  => home_url('/dich-vu/dong-son-o-to/')
    ),
    array(
        'title' => 'SỬA CHỮA XE BẢO HIỂM',
        'badge' => 'ĐỐI TÁC BẢO HIỂM',
        'desc'  => 'Giảm bớt gánh nặng thủ tục khi xe gặp sự cố. Ôtô Hải Hà là đối tác của nhiều công ty bảo hiểm lớn, hỗ trợ bạn toàn bộ quy trình từ tư vấn, giám định đến hoàn thiện hồ sơ, đảm bảo trải nghiệm dịch vụ liền mạch, nhanh chóng và minh bạch giúp đem lại sự yên tâm và hài lòng tuyệt đối cho khách hàng.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('bao-hiem-va-bao-hanh-o-to', $gallery_img . '/haiha-gallery-6.jpg') : $gallery_img . '/haiha-gallery-6.jpg',
        'link'  => home_url('/dich-vu/bao-hiem-va-bao-hanh-o-to/')
    ),
    array(
        'title' => 'NÂNG CẤP NỘI – NGOẠI THẤT',
        'badge' => 'PHỤ KIỆN CHÍNH HÃNG',
        'desc'  => 'Thể hiện cá tính và nâng tầm trải nghiệm. Tại Ôtô Hải Hà, chúng tôi cung cấp các giải pháp nâng cấp đa dạng như dán phim PPF, độ body kit, màn hình Android, camera 360, hệ thống âm thanh, bọc ghế da cao cấp… Biến chiếc xe của bạn trở nên độc đáo, tiện nghi và cá nhân hóa hơn bao giờ hết.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('phu-kien-va-nang-cap-o-to', $gallery_img . '/haiha-gallery-7.jpg') : $gallery_img . '/haiha-gallery-7.jpg',
        'link'  => home_url('/dich-vu/phu-kien-va-nang-cap-o-to/')
    ),
    array(
        'title' => 'CHĂM SÓC NỘI – NGOẠI THẤT',
        'badge' => 'AUTO DETAILING',
        'desc'  => 'Mang lại vẻ sạch bóng và bền đẹp với thời gian. Tại Ôtô Hải Hà có đầy đủ các dịch vụ chăm sóc chi tiết như: đánh bóng, hiệu chỉnh bề mặt sơn, phủ ceramic, vệ sinh khoang máy, dọn nội thất, khử mùi diệt khuẩn… giúp bảo vệ và giữ cho không gian chiếc xe luôn trong trạng thái như mới.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('cham-soc-nang-cap-o-to', $gallery_img . '/haiha-gallery-5.jpg') : $gallery_img . '/haiha-gallery-5.jpg',
        'link'  => home_url('/dich-vu/cham-soc-nang-cap-o-to/')
    ),
    array(
        'title' => 'CỨU HỘ XE 24/7',
        'badge' => 'HỖ TRỢ KHẨN CẤP 24/7',
        'desc'  => 'An tâm trên mọi hành trình! Ôtô Hải Hà cung cấp dịch vụ cứu hộ 24/7 để đưa xe của bạn về trung tâm chúng tôi an toàn khi gặp sự cố. Chỉ cần gọi hotline: ' . $rescue_phone . '. Chúng tôi sẽ có mặt hỗ trợ bạn ngay lập tức!',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('cuu-ho-giao-thong-o-to', $gallery_img . '/haiha-gallery-3.jpg') : $gallery_img . '/haiha-gallery-3.jpg',
        'link'  => home_url('/dich-vu/cuu-ho-giao-thong-o-to/')
    ),
    array(
        'title' => 'HỖ TRỢ ĐĂNG KIỂM XE',
        'badge' => 'NHANH CHÓNG & THUẬN LỢI',
        'desc'  => 'Tiết kiệm tối đa thời gian và công sức của bạn. Chúng tôi sẽ kiểm tra, chuẩn bị và khắc phục tất cả các hạng mục cần thiết để xe đáp ứng tiêu chuẩn đăng kiểm, đồng thời hỗ trợ bạn thực hiện thủ tục, đảm bảo toàn bộ quá trình diễn ra thuận lợi và nhanh chóng.',
        'img'   => function_exists('hieugara_get_service_image') ? hieugara_get_service_image('dich-vu-dang-kiem-o-to', $gallery_img . '/haiha-gallery-9.jpg') : $gallery_img . '/haiha-gallery-9.jpg',
        'link'  => home_url('/dich-vu/dich-vu-dang-kiem-o-to/')
    ),
);
?>

<!-- Portal Hero Banner -->
<section class="portal-hero-header">
    <div class="container">
        <div class="portal-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
            <span>/</span>
            <span class="current"><?php _e('Dịch vụ', 'hieugara-motors'); ?></span>
        </div>
        <h1 class="portal-page-title"><?php _e('DỊCH VỤ TẠI ÔTÔ HẢI HÀ', 'hieugara-motors'); ?></h1>
        <p class="portal-page-subtitle" style="max-width: 920px; margin-bottom: 12px;">
            <strong>Ôtô Hải Hà</strong> là trung tâm bảo dưỡng và sửa chữa ô tô cao cấp tọa lạc tại Km 53+300 Quốc lộ 5 (Chiều Hà Nội – Hải Phòng), Phường Cẩm Thượng, TP. Hải Dương. Chúng tôi cam kết cung cấp những dịch vụ tốt nhất để duy trì và nâng cao hiệu suất tối đa của mỗi chiếc xe.
        </p>
        <p class="portal-page-subtitle" style="max-width: 920px;">
            Với đội ngũ kỹ thuật viên giàu kinh nghiệm từng làm việc trong các hãng xe danh tiếng, hạ tầng trang thiết bị hiện đại được đầu tư bài bản, phụ tùng và linh kiện chính hãng cùng chi phí tiết kiệm tối ưu nhất cho khách hàng. Đến với <strong>Ôtô Hải Hà</strong>, mọi vấn đề về xe luôn xử lý nhanh chóng, quy trình chuyên nghiệp và tận tâm.
        </p>
    </div>
</section>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: #f8fafc; min-height: 70vh;">
    <div class="container">

        <div class="services-grid">
            <?php foreach ($prestige_services as $srv) : ?>
                <article class="service-card">
                    <?php if (!empty($srv['badge'])) : ?>
                        <span class="service-badge"><?php echo esc_html($srv['badge']); ?></span>
                    <?php endif; ?>

                    <div class="service-media">
                        <a href="<?php echo esc_url($srv['link']); ?>">
                            <img src="<?php echo esc_url($srv['img']); ?>" alt="<?php echo esc_attr($srv['title']); ?>" loading="lazy">
                        </a>
                    </div>

                    <div class="service-body" style="display: flex; flex-direction: column; flex: 1;">
                        <h2 class="service-title">
                            <a href="<?php echo esc_url($srv['link']); ?>"><?php echo esc_html($srv['title']); ?></a>
                        </h2>

                        <p style="font-size: 0.9rem; color: #475569; line-height: 1.65; margin-bottom: 22px; flex: 1;">
                            <?php echo esc_html($srv['desc']); ?>
                        </p>

                        <div class="service-card-footer" style="margin-top: auto;">
                            <a href="<?php echo esc_url($srv['link']); ?>" class="btn-gara btn-gara-outline-red">
                                <?php _e('Xem thêm', 'hieugara-motors'); ?> &rarr;
                            </a>
                            <a href="<?php echo esc_url(home_url('/dat-lich/?service=' . urlencode($srv['title']))); ?>" class="btn-gara btn-gara-red">
                                <i class="fa fa-calendar-check"></i> <?php _e('YÊU CẦU HỖ TRỢ', 'hieugara-motors'); ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<?php
get_footer();
