<?php
/**
 * Template Name: Dịch Vụ Xe VinFast
 * Description: Trang giới thiệu dịch vụ đối tác chính thức VinFast tại Hải Phòng & Hải Dương
 *
 * @package HieuGara_Motors
 */

get_header();

$theme_uri     = get_template_directory_uri();
$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = '02203 892 207';
$hotline_clean = '02203892207';
$vinfast_logo  = $theme_uri . '/assets/images/brands/vinfast.svg';
$sign_photo    = $theme_uri . '/assets/images/about/bien-vinfast-service-haiha.jpg';
$facade_photo  = $theme_uri . '/assets/images/about/haiha-about-facade.jpg';
$current_url   = home_url('/dich-vu/xe-vinfast/');
?>

<!-- JSON-LD SEO Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "AutoRepair",
      "@id": "<?php echo esc_url(home_url('/#autorepair')); ?>",
      "name": "Ô Tô Hải Hà - Xưởng Dịch Vụ VinFast",
      "url": "<?php echo esc_url($current_url); ?>",
      "logo": "<?php echo esc_url($theme_uri . '/assets/images/haiha-logo.png'); ?>",
      "image": "<?php echo esc_url($sign_photo); ?>",
      "telephone": "+84-220-3892-207",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "KM3+500 Nguyễn Lương Bằng",
        "addressLocality": "Hải Dương",
        "addressRegion": "Hải Dương",
        "addressCountry": "VN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 20.9359722,
        "longitude": 106.2953139
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
          "opens": "07:30",
          "closes": "18:00"
        }
      ]
    },
    {
      "@type": "Service",
      "serviceType": "Sửa chữa và bảo dưỡng xe VinFast",
      "provider": {
        "@type": "AutoRepair",
        "name": "Ô Tô Hải Hà"
      },
      "areaServed": ["Hải Dương", "Miền Bắc"],
      "description": "Ô Tô Hải Hà – đối tác dịch vụ VinFast tại KM3+500 Nguyễn Lương Bằng. Phụ tùng chính hãng, bảo dưỡng, sửa chữa, đồng sơn xe VinFast. Đặt lịch ngay.",
      "url": "<?php echo esc_url($current_url); ?>"
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Trang chủ",
          "item": "<?php echo esc_url(home_url('/')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Dịch vụ",
          "item": "<?php echo esc_url(home_url('/dich-vu/')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "Dịch vụ xe VinFast",
          "item": "<?php echo esc_url($current_url); ?>"
        }
      ]
    }
  ]
}
</script>

<main id="primary" class="site-main vinfast-service-portal">

    <!-- BREADCRUMB -->
    <nav class="vinfast-breadcrumb-bar" aria-label="Breadcrumb">
        <div class="container">
            <ol class="vinfast-breadcrumb-list">
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li class="sep">/</li>
                <li><a href="<?php echo esc_url(home_url('/dich-vu/')); ?>">Dịch vụ</a></li>
                <li class="sep">/</li>
                <li class="current" aria-current="page">Dịch vụ xe VinFast</li>
            </ol>
        </div>
    </nav>

    <!-- SECTION 1: HERO -->
    <section class="vinfast-hero-section">
        <div class="container">
            <div class="vinfast-hero-grid">
                <div class="vinfast-hero-text">
                    <div class="vinfast-partner-pill">
                        <span>XƯỞNG DỊCH VỤ VINFAST TẠI HẢI DƯƠNG</span>
                    </div>
                    <h1 class="vinfast-hero-title">Dịch vụ sửa chữa và bảo dưỡng xe VinFast tại Hải Dương</h1>
                    <p class="vinfast-hero-lead">
                        Từ tháng 08/2026, Ô Tô Hải Hà chính thức hợp tác với VinFast, cung cấp phụ tùng chính hãng và dịch vụ sửa chữa, bảo dưỡng, đồng sơn cho xe VinFast. Đội ngũ kỹ thuật viên được đào tạo bài bản, phục vụ tận tâm mọi dòng xe VinFast.
                    </p>
                    <div class="vinfast-hero-cta-row">
                        <a href="tel:0911211996" class="vf-btn vf-btn-primary">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span>Tư vấn kỹ thuật: 0911 211 996</span>
                        </a>
                        <a href="tel:<?php echo esc_attr($hotline_clean); ?>" class="vf-btn vf-btn-outline">
                            <i class="fa-solid fa-headset"></i>
                            <span>Tổng đài: <?php echo esc_html($hotline_phone); ?></span>
                        </a>
                    </div>
                </div>

                <div class="vinfast-hero-media">
                    <div class="vf-media-frame">
                        <img src="<?php echo esc_url($sign_photo); ?>" alt="Biển VinFast Service tại gara Ô Tô Hải Hà" class="vf-sign-img" width="600" height="420" loading="eager">
                        <div class="vf-media-badge">
                            <span class="vf-badge-sub">ĐỐI TÁC DỊCH VỤ CHÍNH THỨC</span>
                            <strong class="vf-badge-brand">VINFAST SERVICE</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: VỀ HỢP TÁC VỚI VINFAST -->
    <section class="vinfast-about-partnership-section">
        <div class="container">
            <div class="vf-section-header text-center">
                <span class="vf-section-sub">CHÍNH HÃNG &amp; TIÊU CHUẨN KỸ THUẬT</span>
                <h2 class="vf-section-title">Về hợp tác với VinFast</h2>
            </div>
            <div class="vf-partnership-box">
                <div class="vf-partnership-content">
                    <p class="vf-partnership-paragraph">
                        Từ tháng <strong>08/2026</strong>, Ô Tô Hải Hà chính thức hợp tác với VinFast, cung cấp phụ tùng chính hãng và dịch vụ sửa chữa, bảo dưỡng, đồng sơn cho xe VinFast. Đội ngũ của chúng tôi kết hợp 31 năm kinh nghiệm sửa chữa với kỹ thuật viên xe điện được đào tạo bài bản, phục vụ mọi dòng xe xăng, dầu, điện và hybrid.
                    </p>
                    <p class="vf-partnership-paragraph">
                        Sự kết hợp giữa <strong>31 năm kinh nghiệm kỹ thuật cơ khí gầm máy</strong> của Ô Tô Hải Hà và quy trình tiêu chuẩn chính hãng mang đến chất lượng dịch vụ an tâm và minh bạch tuyệt đối cho mọi chủ xe VinFast.
                    </p>
                </div>
                <div class="vf-partnership-pills-row">
                    <div class="vf-trust-chip">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Phụ tùng chính hãng VinFast</span>
                    </div>
                    <div class="vf-trust-chip">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Kỹ thuật viên xe điện</span>
                    </div>
                    <div class="vf-trust-chip">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Bảo dưỡng, sửa chữa, đồng sơn</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: CÁC DÒNG XE PHỤC VỤ -->
    <section class="vinfast-models-section">
        <div class="container">
            <div class="vf-section-header text-center">
                <span class="vf-section-sub">DANH MỤC XE VINFAST</span>
                <h2 class="vf-section-title">Các dòng xe phục vụ</h2>
                <p class="vf-section-desc">Tiếp nhận bảo dưỡng, chẩn đoán điện và sửa chữa thân vỏ cho toàn bộ dải sản phẩm VinFast hiện hành.</p>
            </div>

            <?php
            $models = array(
                array('code' => 'VF 3',       'desc' => 'Mini e-SUV đô thị năng động, thời thượng'),
                array('code' => 'VF 5',       'desc' => 'A-SUV điện cỡ nhỏ, tiện dụng & linh hoạt hàng ngày'),
                array('code' => 'VF 6',       'desc' => 'B-SUV điện tinh tế, tiện nghi công nghệ thông minh'),
                array('code' => 'VF 7',       'desc' => 'C-SUV điện thể thao, dẫn động 4 bánh uy lực'),
                array('code' => 'VF 8',       'desc' => 'D-SUV điện toàn cầu hạng D, đẳng cấp & an toàn 5 sao'),
                array('code' => 'VF 9',       'desc' => 'E-SUV điện 7 chỗ cỡ lớn sang trọng nhất của VinFast'),
                array('code' => 'Limo Green', 'desc' => 'Dòng xe dịch vụ xanh & chuyên chở hành khách cao cấp'),
            );
            ?>

            <div class="vf-models-grid">
                <?php foreach ($models as $m) : ?>
                <div class="vf-model-card">
                    <div class="vf-model-badge">VINFAST</div>
                    <h3 class="vf-model-name"><?php echo esc_html($m['code']); ?></h3>
                    <p class="vf-model-desc"><?php echo esc_html($m['desc']); ?></p>
                    <a href="<?php echo esc_url(home_url('/dat-lich/?model=' . urlencode('VinFast ' . $m['code']))); ?>" class="vf-model-link">
                        <span>Đặt lịch xe này</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 4: DỊCH VỤ CHO XE VINFAST -->
    <section class="vinfast-services-section">
        <div class="container">
            <div class="vf-section-header text-center">
                <span class="vf-section-sub">QUY TRÌNH KỸ THUẬT TIÊU CHUẨN</span>
                <h2 class="vf-section-title">Dịch vụ cho xe VinFast</h2>
                <p class="vf-section-desc">Các hạng mục dịch vụ chuyên nghiệp được thực hiện bằng thiết bị chuyên dụng và phụ tùng chuẩn hãng.</p>
            </div>

            <?php
            $services = array(
                array(
                    'icon'  => 'fa-screwdriver-wrench',
                    'title' => 'Bảo dưỡng định kỳ',
                    'desc'  => 'Kiểm tra tổng quát theo đúng cấp KM của VinFast: hệ thống gầm, nước làm mát pin & động cơ, lọc gió cabin, dầu phanh.'
                ),
                array(
                    'icon'  => 'fa-bolt-lightning',
                    'title' => 'Kiểm tra hệ thống điện',
                    'desc'  => 'Chẩn đoán quét lỗi ECU, cập nhật phần mềm, đo kiểm mạch điện cao áp, hệ thống chiếu sáng và cảm biến ADAS thông minh.'
                ),
                array(
                    'icon'  => 'fa-circle-dot',
                    'title' => 'Phanh và lốp',
                    'desc'  => 'Cân bằng động lốp, cân chỉnh độ chụm lái 3D chuyên sâu, thay má phanh chính hãng chịu tải trọng lớn của xe điện.'
                ),
                array(
                    'icon'  => 'fa-snowflake',
                    'title' => 'Điều hòa',
                    'desc'  => 'Nội soi bảo dưỡng giàn lạnh, nạp môi chất lạnh R134a/R1234yf chuẩn hãng, khử mùi và thay thế màng lọc than hoạt tính PM2.5.'
                ),
                array(
                    'icon'  => 'fa-paint-roller',
                    'title' => 'Đồng sơn và phục hồi thân vỏ',
                    'desc'  => 'Phục hồi va chạm thân vỏ, căn chỉnh khung gầm xe, sơn sấy hấp phòng kín Axalta chuẩn mã màu nguyên bản VinFast.'
                ),
                array(
                    'icon'  => 'fa-boxes-stacked',
                    'title' => 'Phụ tùng chính hãng',
                    'desc'  => 'Cung cấp 100% phụ tùng thay thế nguồn gốc VinFast chính hãng: càng A, rô-tuyn, giảm xóc, kính chắn gió, cảm biến.'
                ),
            );
            ?>

            <div class="vf-services-grid">
                <?php foreach ($services as $srv) : ?>
                <div class="vf-service-card">
                    <div class="vf-srv-icon">
                        <i class="fa-solid <?php echo esc_attr($srv['icon']); ?>"></i>
                    </div>
                    <h3 class="vf-srv-title"><?php echo esc_html($srv['title']); ?></h3>
                    <p class="vf-srv-desc"><?php echo esc_html($srv['desc']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 5: VÌ SAO CHỌN Ô TÔ HẢI HÀ -->
    <section class="vinfast-why-choose-section">
        <div class="container">
            <div class="vf-section-header text-center">
                <span class="vf-section-sub">CAM KẾT CHẤT LƯỢNG</span>
                <h2 class="vf-section-title">Vì sao chọn Ô Tô Hải Hà</h2>
            </div>

            <div class="vf-why-grid">
                <div class="vf-why-card">
                    <div class="vf-why-num">01</div>
                    <h3 class="vf-why-title">31 năm kinh nghiệm</h3>
                    <p class="vf-why-desc">Thành lập từ 1995, Ô Tô Hải Hà sở hữu bề dày kỹ thuật vững chắc qua hơn 3 thập kỷ sửa chữa và chăm sóc hàng trăm nghìn lượt xe.</p>
                </div>

                <div class="vf-why-card">
                    <div class="vf-why-num">02</div>
                    <h3 class="vf-why-title">Kỹ thuật viên xe điện</h3>
                    <p class="vf-why-desc">Đội ngũ kỹ thuật viên được đào tạo chuyên sâu về an toàn điện cao áp và quy chuẩn bảo dưỡng hệ thống xe điện thế hệ mới.</p>
                </div>

                <div class="vf-why-card">
                    <div class="vf-why-num">03</div>
                    <h3 class="vf-why-title">Phụ tùng chính hãng</h3>
                    <p class="vf-why-desc">Cam kết sử dụng 100% phụ tùng, dầu nhớt và vật tư đạt chuẩn phê duyệt từ VinFast, có hóa đơn chứng từ xuất xứ rõ ràng.</p>
                </div>

                <div class="vf-why-card">
                    <div class="vf-why-num">04</div>
                    <h3 class="vf-why-title">Báo giá minh bạch</h3>
                    <p class="vf-why-desc">Khám xe kỹ lưỡng, lên lệnh sửa chữa chi tiết và báo giá công khai trước khi thi công. Tuyệt đối không phát sinh phụ phí ẩn.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: FAQ ACCORDION -->
    <section class="vinfast-faq-section" id="faq">
        <div class="container">
            <div class="vf-section-header text-center">
                <span class="vf-section-sub">GIẢI ĐÁP THẮC MẮC</span>
                <h2 class="vf-section-title">Câu hỏi thường gặp</h2>
                <p class="vf-section-desc">Các thắc mắc phổ biến của khách hàng khi đưa xe VinFast đến bảo dưỡng tại xưởng.</p>
            </div>

            <div class="vf-faq-accordion" role="region" aria-label="FAQ Accordion">
                <!-- Q1 -->
                <div class="vf-faq-item">
                    <button class="vf-faq-trigger" aria-expanded="false" aria-controls="faq-ans-1" id="faq-q-1">
                        <span class="vf-faq-q-text">Ô Tô Hải Hà sửa được những dòng xe VinFast nào?</span>
                        <span class="vf-faq-icon" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <div class="vf-faq-body" id="faq-ans-1" role="region" aria-labelledby="faq-q-1" hidden>
                        <div class="vf-faq-answer">
                            <p class="vf-placeholder-note">[Chờ Ô Tô Hải Hà bổ sung câu trả lời chính thức]</p>
                        </div>
                    </div>
                </div>

                <!-- Q2 -->
                <div class="vf-faq-item">
                    <button class="vf-faq-trigger" aria-expanded="false" aria-controls="faq-ans-2" id="faq-q-2">
                        <span class="vf-faq-q-text">Phụ tùng thay thế có phải chính hãng VinFast không?</span>
                        <span class="vf-faq-icon" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <div class="vf-faq-body" id="faq-ans-2" role="region" aria-labelledby="faq-q-2" hidden>
                        <div class="vf-faq-answer">
                            <p class="vf-placeholder-note">[Chờ Ô Tô Hải Hà bổ sung câu trả lời chính thức]</p>
                        </div>
                    </div>
                </div>

                <!-- Q3 -->
                <div class="vf-faq-item">
                    <button class="vf-faq-trigger" aria-expanded="false" aria-controls="faq-ans-3" id="faq-q-3">
                        <span class="vf-faq-q-text">Bảo dưỡng tại Ô Tô Hải Hà có ảnh hưởng đến bảo hành xe không?</span>
                        <span class="vf-faq-icon" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <div class="vf-faq-body" id="faq-ans-3" role="region" aria-labelledby="faq-q-3" hidden>
                        <div class="vf-faq-answer">
                            <p class="vf-placeholder-note">[Chờ Ô Tô Hải Hà bổ sung câu trả lời chính thức]</p>
                        </div>
                    </div>
                </div>

                <!-- Q4 -->
                <div class="vf-faq-item">
                    <button class="vf-faq-trigger" aria-expanded="false" aria-controls="faq-ans-4" id="faq-q-4">
                        <span class="vf-faq-q-text">Gara có xe cứu hộ cho xe điện không?</span>
                        <span class="vf-faq-icon" aria-hidden="true"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <div class="vf-faq-body" id="faq-ans-4" role="region" aria-labelledby="faq-q-4" hidden>
                        <div class="vf-faq-answer">
                            <p class="vf-placeholder-note">[Chờ Ô Tô Hải Hà bổ sung câu trả lời chính thức]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: CONTACT & MAP -->
    <section class="vinfast-booking-map-section" id="tiep-nhan">
        <div class="container">
            <div class="vf-section-header text-center">
                <span class="vf-section-sub">TIẾP NHẬN TRỰC TIẾP</span>
                <h2 class="vf-section-title">Tư vấn kỹ thuật &amp; Chỉ đường đến xưởng</h2>
            </div>

            <div class="vf-booking-map-grid">
                <!-- Left: Contact & Support Card -->
                <div class="vf-booking-card" style="display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="vf-booking-card-head">
                        <span class="vf-badge-gold">TIẾP NHẬN ƯU TIÊN</span>
                        <h3>Trung Tâm Dịch Vụ Xe VinFast Hải Hà</h3>
                        <p>Xưởng chuẩn bị sẵn khoang kỹ thuật chuyên biệt cho xe điện và xe xăng VinFast. Quý khách vui lòng liên hệ hotline để được phục vụ nhanh nhất.</p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 14px; margin: 20px 0;">
                        <a href="tel:<?php echo esc_attr($hotline_clean); ?>" class="vf-btn vf-btn-primary" style="justify-content: center; padding: 16px; font-size: 1.05rem;">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span>Hotline Kỹ Thuật: <?php echo esc_html($hotline_phone); ?></span>
                        </a>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)); ?>" class="vf-btn" style="justify-content: center; padding: 14px; background: #D92D20; color: #FFFFFF; font-weight: 700;">
                            <i class="fa-solid fa-truck-pickup"></i>
                            <span>Cứu Hộ Pin &amp; Kéo Xe 24/7: <?php echo esc_html($rescue_phone); ?></span>
                        </a>
                        <a href="https://zalo.me/<?php echo esc_attr($hotline_clean); ?>" target="_blank" rel="noopener" class="vf-btn vf-btn-outline" style="justify-content: center; padding: 14px;">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span>Nhắn Tin Kỹ Thuật Viên Qua Zalo</span>
                        </a>
                    </div>

                    <div style="background: rgba(212, 185, 150, 0.15); border-left: 3px solid #D4B996; padding: 12px 16px; border-radius: 6px;">
                        <small style="color: #4b5563; line-height: 1.5; display: block;">
                            <strong style="color: #141414;">Cam kết dịch vụ:</strong> 100% phụ tùng xe VinFast chính hãng, kỹ thuật viên có chứng chỉ xe điện, bảo hành điện tử minh bạch.
                        </small>
                    </div>
                </div>

                <!-- Right: Map Card -->
                <div class="vf-map-card">
                    <div class="vf-map-head">
                        <span class="vf-badge-outline"><i class="fa-solid fa-location-dot"></i> ĐỊA CHỈ TRUNG TÂM</span>
                        <h3>Ô Tô Hải Hà – Trụ sở chính</h3>
                        <p class="vf-map-address">
                            <strong>Địa chỉ:</strong> KM3+500 Nguyễn Lương Bằng, Hải Dương<br>
                            <strong>Cứu hộ 24/7 &amp; Hotline:</strong> <a href="tel:02203892207">02203 892 207</a> | <a href="tel:0911211996">0911 211 996</a><br>
                            <strong>Giờ làm việc:</strong> Thứ 2 – Chủ Nhật: 07:30 – 18:00
                        </p>
                    </div>
                    <div class="vf-map-frame-wrap">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3726.4117844346224!2d106.2953139!3d20.9359722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31359b66f542968b%3A0xd5b45cb9b6b0359!2zR2FyYSDDlCB0w7QgSOG6o2kgSMOg!5e0!3m2!1svi!2s!4v1793862274528!5m2!1svi!2s" 
                            width="100%" 
                            height="340" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="strict-origin-when-cross-origin"
                            title="Bản đồ vị trí gara Ô Tô Hải Hà">
                        </iframe>
                    </div>
                    <div class="vf-map-actions">
                        <a href="https://maps.google.com/?cid=962452285112173913" target="_blank" rel="noopener" class="vf-btn vf-btn-outline vf-btn-sm">
                            <i class="fa-solid fa-diamond-turn-right"></i>
                            <span>Mở chỉ đường trên Google Maps</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Vanilla JS for FAQ Accordion -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var triggers = document.querySelectorAll('.vf-faq-trigger');
    triggers.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            var body = document.getElementById(this.getAttribute('aria-controls'));
            
            // Toggle current
            this.setAttribute('aria-expanded', !expanded);
            if (body) {
                if (expanded) {
                    body.setAttribute('hidden', '');
                } else {
                    body.removeAttribute('hidden');
                }
            }
        });
    });
});
</script>

<?php
get_footer();
