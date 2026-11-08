<?php
/**
 * Template Name: Phụ Kiện Ô Tô Chính Hãng (Danh Mục Phụ Kiện Hải Hà)
 * Description: Dedicated accessories category portal showcasing workshop-grade accessory categories with zero product clutter.
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = function_exists('hieugara_get_rescue_phone') ? hieugara_get_rescue_phone() : '0911 211 996';
$hotline_phone = function_exists('hieugara_get_hotline_phone') ? hieugara_get_hotline_phone() : '02203 892 207';
$rescue_clean  = preg_replace('/[^0-9]/', '', $rescue_phone);
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline_phone);

// 7 core workshop accessory categories
$categories = array(
    'man-hinh-va-giai-tri' => array(
        'index_num' => '01',
        'id'        => 'man-hinh-va-giai-tri',
        'name'      => 'Màn Hình & Giải Trí Thông Minh',
        'short_name'=> 'Màn Hình & Giải Trí',
        'eyebrow'   => 'CÔNG NGHỆ THÔNG MINH TRÊN XE',
        'icon'      => 'fa-solid fa-tv',
        'desc'      => 'Nâng tầm tiện nghi khoang lái với màn hình Android độ nét cao, Android Box cắm giắc Zin biến màn hình nguyên bản thành thông minh, kết nối Apple CarPlay và hệ thống âm thanh xe hơi.',
        'brands'    => 'Zestech, Gotech, Bravigo, Teyes, Blaupunkt',
        'subitems'  => array(
            'Màn hình Android 2K liền khối'          => 'Độ phân giải 2K sắc nét, đa nhiệm mượt mà, tích hợp bản đồ Vietmap Live cảnh báo tốc độ.',
            'Android Box chuyển đổi màn Zin'        => 'Cắm cổng USB biến màn hình nguyên bản theo xe thành màn thông minh trong 30 giây, không ảnh hưởng bảo hành hãng.',
            'Màn hình liền Camera 360 toàn cảnh'     => 'Giải pháp tích hợp 2 trong 1: Màn hình giải trí sắc nét kết hợp 4 mắt cam ghi hình 360 độ.',
            'Nâng cấp loa cánh & Sub gầm ghế'        => 'Tăng cường dải âm bass sâu lắng, cải thiện độ chi tiết âm thanh cho khoang xe.'
        )
    ),
    'camera-o-to' => array(
        'index_num' => '02',
        'id'        => 'camera-o-to',
        'name'      => 'Hệ Thống Camera Ô Tô Toàn Diện',
        'short_name'=> 'Camera Ô Tô',
        'eyebrow'   => 'QUAN SÁT & GHI HÌNH AN TÂM',
        'icon'      => 'fa-solid fa-video',
        'desc'      => 'Trang bị mắt thần cho xế cưng giúp lái xe tự tin, lưu lại bằng chứng hành trình sắc nét cả ngày lẫn đêm và loại bỏ hoàn toàn các điểm mù nguy hiểm.',
        'brands'    => '70mai, Vietmap, Xiaomi, Safeview, OledPro',
        'subitems'  => array(
            'Camera hành trình 4K trước & sau'       => 'Ghi hình 4K Ultra HD sắc nét, cảm biến ban đêm Sony Starvis, tích hợp GPS hiển thị tốc độ.',
            'Camera 360 độ toàn cảnh 3D'            => 'Góc nhìn giả lập 3D từ trên cao, đánh lái theo vô lăng, xóa tan mọi góc khuất khi đỗ xe.',
            'Camera cập lề gương phụ'                => 'Hỗ trợ căn chỉnh bánh trước, chống cạ mâm và quẹt lốp khi đi vào đường hẹp hoặc cập vỉa hè.',
            'Camera lùi AHD góc rộng chống nước'    => 'Góc quan sát 170 độ, hình ảnh rõ nét trong đêm tối và trời mưa gió đạt chuẩn IP68.'
        )
    ),
    'an-toan-o-to' => array(
        'index_num' => '03',
        'id'        => 'an-toan-o-to',
        'name'      => 'Hệ Thống Thiết Bị An Toàn',
        'short_name'=> 'Hệ Thống An Toàn',
        'eyebrow'   => 'BẢO VỆ CHỦ ĐỘNG & CẢNH BÁO SỚM',
        'icon'      => 'fa-solid fa-shield-halved',
        'desc'      => 'Các trang bị an toàn chủ động tối quan trọng giúp người lái phát hiện sớm nguy cơ nổ lốp, phát hiện vật cản điểm mù và kiểm soát tốc độ tối ưu trên cao tốc.',
        'brands'    => 'Steelmate, Carevent, Icar, Vietmap, Fobo',
        'subitems'  => array(
            'Cảm biến áp suất lốp (TPMS)'            => 'Giám sát áp suất và nhiệt độ 4 bánh xe theo thời gian thực, cảnh báo ngay khi xì hơi hoặc quá nhiệt.',
            'Cảnh báo điểm mù Radar (BSD)'           => 'Sóng radar quét làn đường phía sau, cảnh báo phương tiện vượt qua gương chiếu hậu và âm thanh.',
            'Màn hình hiển thị kính lái (HUD)'       => 'Chiếu thông số tốc độ xe, vòng tua máy và biển báo giao thông trực tiếp lên kính lái.',
            'Cảm biến va chạm tiến & lùi'            => 'Hệ thống mắt cảm biến cảnh báo khoảng cách vật cản, hỗ trợ đỗ xe an toàn trong không gian chật.'
        )
    ),
    'phim-va-bao-ve-son' => array(
        'index_num' => '04',
        'id'        => 'phim-va-bao-ve-son',
        'name'      => 'Phim Cách Nhiệt & Bảo Vệ Sơn',
        'short_name'=> 'Phim & Bảo Vệ Sơn',
        'eyebrow'   => 'CÁCH NHIỆT & GIỮ TRỌN NƯỚC SƠN',
        'icon'      => 'fa-solid fa-sun',
        'desc'      => 'Dán phim cách nhiệt ngăn chặn 99% tia UV độc hại và dán phim PPF chống trầy xước, bảo vệ sức khỏe hành khách và duy trì giá trị xe nguyên bản.',
        'brands'    => '3M Crystalline, Llumar, Cool N Lite, TeckWrap',
        'subitems'  => array(
            'Dán phim cách nhiệt 3M Crystalline'     => 'Công nghệ quang học 200 lớp độc quyền chống nóng đỉnh cao, không cản sóng GPS và điện thoại.',
            'Dán phim bảo vệ sơn PPF TPU'           => 'Màng phim dẻo dai tự phục hồi vết xước xoáy dưới ánh nắng, chống đá văng trầy xước nước sơn.',
            'Phủ bóng Ceramic 9H đa lớp'            => 'Tạo hiệu ứng lá sen chống bám nước, tăng độ bóng sâu và bảo vệ lớp sơn bóng khỏi hóa chất, axit mưa.',
            'Dán cách âm & chống ồn khoang xe'      => 'Vật liệu chống ồn tiêu chuẩn Châu Âu dập tắt rung động kim loại, giảm tiếng ồn từ lốp và gầm xe.'
        )
    ),
    'noi-that-o-to' => array(
        'index_num' => '05',
        'id'        => 'noi-that-o-to',
        'name'      => 'Nâng Cấp & Chăm Sóc Nội Thất',
        'short_name'=> 'Nội Thất Ô Tô',
        'eyebrow'   => 'SANG TRỌNG • SẠCH SẼ • ÊM ÁI',
        'icon'      => 'fa-solid fa-couch',
        'desc'      => 'Tân trang không gian khoang xe với chất liệu da cao cấp may thủ công, thảm lót sàn chuẩn form không mùi và hệ thống đèn viền LED kiến tạo phong cách cá nhân.',
        'brands'    => 'Kata, Lavor, Nappa Auto, Sparco',
        'subitems'  => array(
            'Bọc ghế da Nappa & Microfiber'          => 'May thủ công chuẩn form từng dòng xe, chất da mềm mịn thoáng khí, không gây mùi hôi khó chịu.',
            'Thảm lót sàn đúc tràn viền TPE'         => 'Chất liệu nhựa nguyên sinh không mùi, thiết kế 3D ôm sát sàn xe, chống thấm nước và dễ dàng vệ sinh.',
            'Khâu bọc da vô lăng thủ công'           => 'Cầm nắm êm ái, bám tay chống trơn trượt, may chỉ viền thể thao tinh tế theo màu xe.',
            'Đèn LED viền nội thất Ambient Light'    => 'Hệ thống 64 màu ánh sáng dịu mắt, đổi màu theo nhạc và điều khiển tiện lợi qua smartphone.'
        )
    ),
    'ngoai-that-va-den' => array(
        'index_num' => '06',
        'id'        => 'ngoai-that-va-den',
        'name'      => 'Ngoại Thất & Nâng Cấp Ánh Sáng',
        'short_name'=> 'Ngoại Thất & Đèn',
        'eyebrow'   => 'TẦM NHÌN SÁNG VƯỢT TRỘI & TIỆN NGHI',
        'icon'      => 'fa-solid fa-lightbulb',
        'desc'      => 'Cải thiện hiệu năng chiếu sáng ban đêm an toàn và trang bị các tiện ích đóng mở cửa, cốp xe thông minh như những dòng xe hạng sang.',
        'brands'    => 'X-Light, Titan, GTR, Henvvei, Perfectcar',
        'subitems'  => array(
            'Nâng cấp Bi LED & Bi Laser tăng sáng'  => 'Tăng độ sáng gấp 3-5 lần bóng zin, đường cắt ánh sáng văn minh không gây chói mắt xe đối diện.',
            'Độ cốp điện thông minh & Đá cốp'       => 'Đóng mở cốp nhẹ nhàng bằng nút bấm, remote hoặc cảm biến đá chân khi đang mang vác đồ nặng.',
            'Cửa hít tự động êm ái'                 => 'Hít cửa nhẹ nhàng, êm ru không cần dùng lực đóng mạnh, đảm bảo an toàn tuyệt đối cho người ngồi sau.',
            'Bạt phủ cách nhiệt & Nẹp chống trầy'   => 'Bạt phủ chống nóng 3 lớp tráng bạc, vè che mưa viền inox và nẹp chống trầy cốp sau.'
        )
    ),
    'tien-ich-o-to' => array(
        'index_num' => '07',
        'id'        => 'tien-ich-o-to',
        'name'      => 'Trang Bị Tiện Ích Xe Hơi',
        'short_name'=> 'Tiện Ích Ô Tô',
        'eyebrow'   => 'THIẾT YẾU CHO MỌI HÀNH TRÌNH',
        'icon'      => 'fa-solid fa-toolbox',
        'desc'      => 'Bộ trang bị tiện ích không thể thiếu trên mọi chiếc ô tô, giúp xử lý nhanh các tình huống khẩn cấp trên đường và giữ khoang xe luôn sạch sẽ, trong lành.',
        'brands'    => 'Michelin, Baseus, Philips, Anker, Xiaomi',
        'subitems'  => array(
            'Máy bơm lốp điện tử tự ngắt'            => 'Bơm khỏe, cài đặt áp suất điện tử tự ngắt khi đủ cân, tích hợp đèn LED cứu hộ ban đêm.',
            'Bộ kích bình ắc quy khẩn cấp'          => 'Khởi động động cơ ngay lập tức khi ắc quy hết điện giữa đường, kiêm sạc dự phòng điện thoại.',
            'Tẩu sạc nhanh PD/QC 65W & MagSafe'      => 'Công suất sạc nhanh cho điện thoại và laptop, giá đỡ tự động hít chắc chắn khi xe đi vào đường xóc.',
            'Máy lọc không khí & Khử mùi Ozone'      => 'Màng lọc than hoạt tính loại bỏ bụi mịn PM2.5, khử mùi ẩm mốc, khói thuốc và mùi xe mới.'
        )
    )
);

$total_cats = count($categories);
?>

<main id="primary" class="site-main page-phu-kien-portal">

    <!-- Hero Header -->
    <section class="phukien-hero-section">
        <div class="container">
            <nav class="phukien-breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a>
                <span class="sep">/</span>
                <span class="current"><?php _e('Danh mục phụ kiện ô tô', 'hieugara-motors'); ?></span>
            </nav>

            <div class="phukien-hero-content text-center">
                <div class="phukien-eyebrow">
                    <span class="eyebrow-dot"></span>
                    <span>HỆ THỐNG DANH MỤC PHỤ KIỆN &amp; ĐỒ CHƠI Ô TÔ CHÍNH HÃNG HẢI HÀ</span>
                </div>
                <h1 class="phukien-title">
                    <span>DANH MỤC PHỤ KIỆN Ô TÔ</span> <span class="text-gold">CHÍNH HÃNG</span>
                </h1>
                <p class="phukien-subtitle">
                    Phân phối và lắp đặt hoàn thiện phụ kiện xe hơi theo tiêu chuẩn xưởng dịch vụ. Cam kết 100% phụ kiện chính hãng, cắm giắc Zin không cắt trích dây điện, giữ nguyên chế độ bảo hành hãng cho từng dòng xe.
                </p>

                <!-- Value Props Badges -->
                <div class="phukien-value-props">
                    <div class="prop-item">
                        <i class="fa-solid fa-shield-halved text-gold"></i>
                        <span>100% Phụ Kiện Chuẩn Hãng</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-award text-gold"></i>
                        <span>Bảo Hành Điện Tử Đến 36 Tháng</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-screwdriver-wrench text-gold"></i>
                        <span>Lắp Đặt Chuẩn Zin Theo Xe</span>
                    </div>
                    <div class="prop-item">
                        <i class="fa-solid fa-phone-volume text-gold"></i>
                        <span>Tư Vấn &amp; Báo Giá 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview Categories Grid (Top Navigation Cards) -->
    <section style="padding: 40px 0 20px; background: #0f1114; border-bottom: 1px solid rgba(255,255,255,0.08);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 28px;">
                <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.75rem; font-weight: 800; color: #C5A880; letter-spacing: 2px; text-transform: uppercase;">DANH MỤC CHUYÊN SÂU</span>
                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: clamp(1.4rem, 2.5vw, 1.85rem); font-weight: 800; color: #ffffff; margin: 6px 0 0; text-transform: uppercase;">
                    7 Danh Mục Phụ Kiện Chính Tại Ôtô Hải Hà
                </h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px;">
                <?php foreach ($categories as $cat_key => $c_data) : ?>
                    <a href="#cat-<?php echo esc_attr($cat_key); ?>" style="display: flex; flex-direction: column; background: #1a1c22; border: 1px solid rgba(197, 168, 128, 0.2); border-radius: 8px; padding: 20px 22px; text-decoration: none; transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s; position: relative;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.5rem; font-weight: 800; color: #C5A880; line-height: 1;"><?php echo esc_html($c_data['index_num']); ?></span>
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(197, 168, 128, 0.12); display: flex; align-items: center; justify-content: center;">
                                <i class="<?php echo esc_attr($c_data['icon']); ?>" style="color: #C5A880; font-size: 1.15rem;"></i>
                            </div>
                        </div>
                        <h3 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0 0 6px 0; line-height: 1.35;">
                            <?php echo esc_html($c_data['short_name']); ?>
                        </h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0; line-height: 1.5; flex-grow: 1;">
                            <?php echo esc_html($c_data['eyebrow']); ?>
                        </p>
                        <div style="margin-top: 14px; font-size: 0.82rem; font-weight: 700; color: #C5A880; display: inline-flex; align-items: center; gap: 6px;">
                            <span>Xem chi tiết danh mục</span> &darr;
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Main Categories Showcase Section -->
    <section class="phukien-catalog-section" style="padding: 50px 0 80px; background: #F8FAFC;">
        <div class="container">

            <div style="display: flex; flex-direction: column; gap: 40px;">
                <?php foreach ($categories as $cat_key => $c) : ?>
                    <section class="phukien-cat-section" id="cat-<?php echo esc_attr($cat_key); ?>" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 36px 36px 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); scroll-margin-top: 90px;">
                        
                        <!-- Header of Category -->
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 22px; margin-bottom: 24px;">
                            <div style="display: flex; gap: 16px; align-items: center;">
                                <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 2.4rem; font-weight: 800; color: #C5A880; line-height: 1;"><?php echo esc_html($c['index_num']); ?></span>
                                <div>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.72rem; font-weight: 800; color: #C5A880; letter-spacing: 1.5px; text-transform: uppercase;">
                                        <i class="<?php echo esc_attr($c['icon']); ?>"></i> <?php echo esc_html($c['eyebrow']); ?>
                                    </span>
                                    <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: clamp(1.4rem, 2.5vw, 1.85rem); font-weight: 800; color: #141414; margin: 4px 0 0; text-transform: uppercase;">
                                        <?php echo esc_html($c['name']); ?>
                                    </h2>
                                </div>
                            </div>

                            <!-- Emergency / Hotline Call Action -->
                            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                                <a href="tel:<?php echo esc_attr($hotline_clean); ?>" style="background: #141414; color: #C5A880; border: 1px solid #C5A880; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-phone"></i> <?php echo esc_html($hotline_phone); ?>
                                </a>
                                <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 10px 18px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.88rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-comment-dots"></i> Chat Zalo
                                </a>
                            </div>
                        </div>

                        <!-- Description -->
                        <p style="font-size: 1.05rem; line-height: 1.85; color: #334155; margin-bottom: 26px;">
                            <?php echo esc_html($c['desc']); ?>
                        </p>

                        <!-- Key Sub-Items in this Category -->
                        <div style="margin-bottom: 28px;">
                            <h4 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.95rem; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-layer-group" style="color: #C5A880;"></i>
                                Các Hạng Mục Trang Bị &amp; Nâng Cấp Thuộc Danh Mục:
                            </h4>

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                                <?php foreach ($c['subitems'] as $item_title => $item_desc) : ?>
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #C5A880; border-radius: 6px; padding: 16px 18px;">
                                        <div style="font-family: 'Be Vietnam Pro', sans-serif; font-weight: 800; font-size: 0.95rem; color: #1e293b; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                                            <i class="fa-solid fa-circle-check" style="color: #16A34A; font-size: 0.9rem;"></i>
                                            <span><?php echo esc_html($item_title); ?></span>
                                        </div>
                                        <p style="font-size: 0.88rem; color: #64748b; margin: 0; line-height: 1.6;">
                                            <?php echo esc_html($item_desc); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Standards & Warranty Box -->
                        <div style="background: #fdfbf7; border: 1px solid #fed7aa; border-radius: 8px; padding: 18px 22px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                            <div style="font-size: 0.88rem; color: #78350F; line-height: 1.6;">
                                <strong style="color: #9A3412;">🌟 Thương hiệu liên kết chính hãng:</strong> <?php echo esc_html($c['brands']); ?>.<br>
                                <strong style="color: #9A3412;">🛠️ Tiêu chuẩn xưởng Ôtô Hải Hà:</strong> Cắm giắc Zin 100% không cắt dây &bull; Bảo hành điện tử 12-36 tháng &bull; Hỗ trợ căn chỉnh trọn đời xe.
                            </div>
                            <div>
                                <a href="tel:02203892207" style="background: #D4B996; color: #141414; padding: 10px 20px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-weight: 800; font-size: 0.88rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; text-transform: uppercase;">
                                    <i class="fa-solid fa-phone-volume"></i> Nhận Báo Giá Theo Xe
                                </a>
                            </div>
                        </div>

                    </section>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- Consultation CTA Section -->
    <section class="phukien-consult-section" style="padding: 60px 0; background: #141414; border-top: 3px solid #C5A880;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 24px;">
                <div style="max-width: 750px;">
                    <span style="display: inline-block; background: rgba(197,168,128,0.15); color: #C5A880; border: 1px solid rgba(197,168,128,0.3); padding: 4px 12px; border-radius: 4px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 10px;">
                        TƯ VẤN KỸ THUẬT &amp; THÔNG SỐ XE MIỄN PHÍ
                    </span>
                    <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: clamp(1.4rem, 2.8vw, 2rem); font-weight: 800; color: #ffffff; margin: 0 0 10px; line-height: 1.35;">
                        Bạn Cần Tư Vấn Danh Mục Phụ Kiện Phù Hợp Với Dòng Xe Của Mình?
                    </h2>
                    <p style="font-size: 0.98rem; color: #94a3b8; margin: 0; line-height: 1.7;">
                        Mỗi dòng xe (Sedan, SUV, Bán tải, Xe điện VinFast...) có thông số giắc cắm, giao tiếp CAN-Bus và điện áp riêng biệt. Đội ngũ kỹ thuật viên Ôtô Hải Hà hỗ trợ khảo sát, tư vấn cấu hình và báo giá chuẩn xác nhất.
                    </p>
                </div>
                <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                    <a href="tel:02203892207" style="background: #C5A880; color: #141414; padding: 14px 26px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.95rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; text-transform: uppercase;">
                        <i class="fa-solid fa-phone-volume"></i> 02203 892 207
                    </a>
                    <a href="https://zalo.me/0911211996" target="_blank" rel="noopener" style="background: #0068FF; color: #ffffff; padding: 14px 24px; border-radius: 6px; font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.95rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-comment-dots"></i> Chat Zalo Kỹ Thuật
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
