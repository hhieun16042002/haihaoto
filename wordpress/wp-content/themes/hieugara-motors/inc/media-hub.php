<?php
/**
 * Ôtô Hải Hà - Thư Viện Ảnh Gara (Visual Categorized Media & Image Hub)
 * Quản lý tập trung toàn bộ hình ảnh của website theo đúng nhóm & vị trí hiển thị:
 * 1. Logo & Nhận Diện Thương Hiệu (Đổi tại đây tự động đổi toàn web)
 * 2. Trang Chủ (Slider, 4 Banner Năng Lực, Gallery Hình Ảnh Ôtô Hải Hà, Phụ Kiện, Logo Hãng Xe)
 * 3. Dịch Vụ Gara (8 Thẻ Trang Dịch Vụ & 6 Mảng Dịch Vụ Lớn + Các Mục Con)
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

// =========================================================================
// 1. HELPER FUNCTIONS FOR FRONTEND TEMPLATES
// =========================================================================

/**
 * Get Site Logo URL (Header, Mobile Drawer, Footer, Favicon)
 */
function hieugara_get_site_logo() {
    $version = defined('HIEUGARA_THEME_VERSION') ? HIEUGARA_THEME_VERSION : '5.7.4';
    $default = get_template_directory_uri() . '/assets/images/haiha-logo.png?v=' . $version;
    $saved   = get_option('hieugara_site_logo', '');
    return !empty($saved) ? $saved : $default;
}

/**
 * Get 3 Images for "Về ÔTÔ HẢI HÀ & SỨ MỆNH" (KOBAC CARS Style Section on Homepage)
 */
function hieugara_get_about_kobac_images() {
    $about_uri = get_template_directory_uri() . '/assets/images/about';
    $defaults  = array(
        'img_1' => $about_uri . '/haiha-about-facade.jpg',
        'img_2' => $about_uri . '/haiha-about-workshop.jpg',
        'img_3' => $about_uri . '/haiha-about-paintbooth.jpg',
    );
    $saved = get_option('hieugara_about_kobac_images', array());
    if (empty($saved) || !is_array($saved)) {
        return $defaults;
    }
    return array(
        'img_1' => !empty($saved['img_1']) ? $saved['img_1'] : $defaults['img_1'],
        'img_2' => !empty($saved['img_2']) ? $saved['img_2'] : $defaults['img_2'],
        'img_3' => !empty($saved['img_3']) ? $saved['img_3'] : $defaults['img_3'],
    );
}

/**
 * Get 4 Panoramic Banners on Homepage
 */
function hieugara_get_default_pano_banners() {
    $theme_uri   = get_template_directory_uri();
    $shiftup_img = $theme_uri . '/assets/images/shiftup';
    $slider_img  = $theme_uri . '/assets/images/slider';

    return array(
        1 => array(
            'title'      => 'SỬA CHỮA Ô TÔ',
            'desc'       => 'Sửa chữa động cơ, hệ thống điện, máy gầm, hệ thống lái, hệ thống chiếu sáng…',
            'img'        => $shiftup_img . '/banner-1.jpg?v=5.8.1',
            'img_mobile' => $shiftup_img . '/tech-about.jpg?v=5.8.1',
            'link'       => home_url('/dich-vu/sua-chua-o-to/'),
        ),
        2 => array(
            'title'      => 'BẢO DƯỠNG ĐỊNH KỲ',
            'desc'       => 'Thay nhớt, kiểm tra tổng quát, vệ sinh lọc gió, kim phun…',
            'img'        => $shiftup_img . '/banner-2.jpg?v=5.8.1',
            'img_mobile' => $shiftup_img . '/slide-2.jpg',
            'link'       => home_url('/dich-vu/bao-duong-o-to/'),
        ),
        3 => array(
            'title'      => 'THÂN VỎ ĐỒNG SƠN',
            'desc'       => 'Phục hồi hình dạng, sơn dặm, sơn toàn bộ xe với chất lượng bảo hành trọn đời',
            'img'        => $shiftup_img . '/banner-3.jpg?v=5.8.1',
            'img_mobile' => $slider_img . '/slide-son-xe.jpg',
            'link'       => home_url('/dich-vu/dong-son-o-to/'),
        ),
        4 => array(
            'title'      => 'CHĂM SÓC XE',
            'desc'       => 'Vệ sinh nội thất, rửa xe chăm sóc ngoại thất, dán phim cách nhiệt, dán decal đổi màu xe...',
            'img'        => $shiftup_img . '/banner-4.jpg?v=5.8.1',
            'img_mobile' => $slider_img . '/slide-detailing.jpg',
            'link'       => home_url('/dich-vu/cham-soc-nang-cap-o-to/'),
        ),
    );
}

function hieugara_get_pano_banners() {
    $defaults = hieugara_get_default_pano_banners();
    $saved    = get_option('hieugara_pano_banners', array());
    if (empty($saved) || !is_array($saved)) {
        return $defaults;
    }
    $result = array();
    foreach ($defaults as $k => $def) {
        $result[$k] = array(
            'title'      => !empty($saved[$k]['title']) ? $saved[$k]['title'] : $def['title'],
            'desc'       => !empty($saved[$k]['desc']) ? $saved[$k]['desc'] : $def['desc'],
            'img'        => !empty($saved[$k]['img']) ? $saved[$k]['img'] : $def['img'],
            'img_mobile' => !empty($saved[$k]['img_mobile']) ? $saved[$k]['img_mobile'] : (!empty($saved[$k]['img']) ? $saved[$k]['img'] : $def['img_mobile']),
            'link'       => !empty($saved[$k]['link']) ? $saved[$k]['link'] : $def['link'],
        );
    }
    return $result;
}

/**
 * Get Accessories Slider Items on Homepage
 */
function hieugara_get_default_accessories_items() {
    $acc_img_uri = get_template_directory_uri() . '/assets/images/accessories';
    return array(
        1 => array(
            'enable'    => '1',
            'title'     => 'Camera hành trình 70mai A810S 4K HDR Omni (Sony Starvis 2)',
            'img'       => $acc_img_uri . '/vietmap-c61-pro.jpg',
            'price'     => '3.690.000',
            'old_price' => '4.200.000',
            'badge'     => 'BÁN CHẠY',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        2 => array(
            'enable'    => '1',
            'title'     => 'Máy bơm lốp ô tô không dây Michelin M2567 Tự Ngắt Thông Minh',
            'img'       => $acc_img_uri . '/michelin-bom-lop.jpg',
            'price'     => '1.180.000',
            'old_price' => '1.450.000',
            'badge'     => 'MICHELIN',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        3 => array(
            'enable'    => '1',
            'title'     => 'Cảm biến áp suất lốp Steelmate TPMS M10 hiển thị LCD Solar',
            'img'       => $acc_img_uri . '/steelmate-tpms.jpg',
            'price'     => '2.250.000',
            'old_price' => '2.600.000',
            'badge'     => 'STEELMATE',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        4 => array(
            'enable'    => '1',
            'title'     => 'Máy hút bụi cầm tay ô tô không dây Bosch BHN16L lực hút cực mạnh HEPA',
            'img'       => $acc_img_uri . '/bosch-may-hut-bui.jpg',
            'price'     => '1.850.000',
            'old_price' => '2.190.000',
            'badge'     => 'BOSCH CHÍNH HÃNG',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        5 => array(
            'enable'    => '1',
            'title'     => 'Bộ kích nổ ắc quy ô tô khẩn cấp Stanley 12V kiêm sạc dự phòng',
            'img'       => $acc_img_uri . '/stanley-kich-binh.jpg',
            'price'     => '1.450.000',
            'old_price' => '1.790.000',
            'badge'     => 'CỨU HỘ KHẨN CẤP',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        6 => array(
            'enable'    => '1',
            'title'     => 'Màn hình thông minh Android Zestech Z500 tích hợp Giọng nói Kiki',
            'img'       => $acc_img_uri . '/zestech-z500.jpg',
            'price'     => '8.500.000',
            'old_price' => '9.500.000',
            'badge'     => 'ZESTECH',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        7 => array(
            'enable'    => '1',
            'title'     => 'Màn Hình Android Elliview S4 Basic [3GB/32GB + Camera 360 Sony]',
            'img'       => $acc_img_uri . '/elliview-s4.jpg',
            'price'     => '12.800.000',
            'old_price' => '14.500.000',
            'badge'     => 'TẶNG CAM 360',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        8 => array(
            'enable'    => '1',
            'title'     => 'Tẩu sạc nhanh ô tô Baseus Digital Display 65W sạc Laptop & Điện thoại',
            'img'       => $acc_img_uri . '/baseus-tau-sac.jpg',
            'price'     => '390.000',
            'old_price' => '490.000',
            'badge'     => 'BASEUS 65W',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        9 => array(
            'enable'    => '1',
            'title'     => 'Giá đỡ điện thoại ô tô kiêm sạc không dây Baseus cảm ứng tự động 15W',
            'img'       => $acc_img_uri . '/baseus-gia-do.jpg',
            'price'     => '420.000',
            'old_price' => '550.000',
            'badge'     => 'SẠC KHÔNG DÂY',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        10 => array(
            'enable'    => '1',
            'title'     => 'Máy lọc không khí ô tô Philips GoPure GP5211 khử mùi kháng khuẩn',
            'img'       => $acc_img_uri . '/philips-loc-khong-khi.jpg',
            'price'     => '2.490.000',
            'old_price' => '2.890.000',
            'badge'     => 'PHILIPS',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        11 => array(
            'enable'    => '1',
            'title'     => 'Bạt phủ ô tô 3 lớp tráng nhôm cách nhiệt chống nóng, mưa đá',
            'img'       => $acc_img_uri . '/bat-phu-oto.jpg',
            'price'     => '550.000',
            'old_price' => '750.000',
            'badge'     => 'CHỐNG NẮNG 100%',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        12 => array(
            'enable'    => '1',
            'title'     => 'Gối tựa đầu & đệm tựa lưng cao su non công thái học ô tô',
            'img'       => $acc_img_uri . '/goi-tua-dau-oto.jpg',
            'price'     => '450.000',
            'old_price' => '590.000',
            'badge'     => 'CAO SU NON',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        13 => array(
            'enable'    => '1',
            'title'     => 'Bọc vô lăng ô tô da bò thật vân sợi carbon chống trơn trượt',
            'img'       => $acc_img_uri . '/boc-vo-lang.jpg',
            'price'     => '350.000',
            'old_price' => '450.000',
            'badge'     => 'DA CAO CẤP',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        14 => array(
            'enable'    => '1',
            'title'     => 'Nước hoa ô tô cao cấp kẹp cửa gió điều hòa Etonner / Areon',
            'img'       => $acc_img_uri . '/nuoc-hoa-oto.jpg',
            'price'     => '320.000',
            'old_price' => '420.000',
            'badge'     => 'HƯƠNG TỰ NHIÊN',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        15 => array(
            'enable'    => '1',
            'title'     => 'Dung dịch rửa xe không chạm và vệ sinh nội thất ô tô Ekokemika 3M',
            'img'       => $acc_img_uri . '/dung-dich-cham-soc-xe.jpg',
            'price'     => '280.000',
            'old_price' => '350.000',
            'badge'     => 'CHĂM SÓC XE',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
        16 => array(
            'enable'    => '1',
            'title'     => 'Búa thoát hiểm đa năng 4 trong 1 kiêm đèn pin SOS và dao cắt dây đai',
            'img'       => $acc_img_uri . '/bua-thoat-hiem.jpg',
            'price'     => '190.000',
            'old_price' => '250.000',
            'badge'     => 'AN TOÀN ÔTÔ',
            'link'      => 'https://meta.vn/phu-kien-oto/',
        ),
    );
}

function hieugara_get_accessories_items() {
    $defaults = hieugara_get_default_accessories_items();
    $saved    = get_option('hieugara_accessories_items');
    if ($saved === false || !is_array($saved) || count($saved) < 4) {
        return $defaults;
    }
    $items = array();
    foreach ($saved as $k => $it) {
        if (!empty($it['title']) || !empty($it['img'])) {
            $items[$k] = array(
                'enable'    => isset($it['enable']) ? (string)$it['enable'] : '1',
                'title'     => sanitize_text_field($it['title'] ?? ''),
                'img'       => esc_url_raw($it['img'] ?? ''),
                'price'     => sanitize_text_field($it['price'] ?? ''),
                'old_price' => sanitize_text_field($it['old_price'] ?? ''),
                'badge'     => sanitize_text_field($it['badge'] ?? ''),
                'link'      => !empty($it['link']) ? esc_url_raw($it['link']) : 'https://meta.vn/phu-kien-oto/',
            );
        }
    }
    return !empty($items) ? $items : $defaults;
}

/**
 * Get Custom Service Image by Key (for 8 Service Cards, 6 Category Hubs, and Sub-services)
 */
function hieugara_get_service_image($key, $default_url = '') {
    $saved = get_option('hieugara_service_images', array());
    if (is_array($saved) && !empty($saved[$key])) {
        return $saved[$key];
    }
    return $default_url;
}

/**
 * Structured Definition of the 6 Major Service Groups & Their Sub-Services
 */
function hieugara_get_service_groups_tree() {
    $gallery_img = get_template_directory_uri() . '/assets/images/gallery';
    return array(
        'bao-duong-o-to' => array(
            'group_title' => '01. BẢO DƯỠNG Ô TÔ',
            'group_desc'  => 'Ảnh đại diện nhóm Bảo dưỡng ô tô & 5 hạng mục bảo dưỡng con',
            'default_img' => $gallery_img . '/haiha-gallery-4.jpg',
            'children'    => array(
                'bao-duong-dinh-ky'               => array('title' => 'Bảo dưỡng định kỳ theo số km (5k - 40k km)', 'default_img' => $gallery_img . '/haiha-gallery-4.jpg'),
                'thay-dau-va-loc-o-to'            => array('title' => 'Thay dầu & lọc dầu chính hãng OEM', 'default_img' => $gallery_img . '/haiha-gallery-4.jpg'),
                'kiem-tra-va-bao-duong-tong-quat' => array('title' => 'Kiểm tra & bảo dưỡng tổng quát 45 hạng mục', 'default_img' => $gallery_img . '/haiha-gallery-1.jpg'),
            ),
        ),
        'sua-chua-o-to' => array(
            'group_title' => '02. SỬA CHỮA Ô TÔ',
            'group_desc'  => 'Ảnh đại diện nhóm Sửa chữa ô tô chuyên sâu & 6 hạng mục sửa chữa con',
            'default_img' => $gallery_img . '/haiha-gallery-1.jpg',
            'children'    => array(
                'sua-chua-dong-co'                 => array('title' => 'Sửa chữa & đại tu động cơ chuyên sâu', 'default_img' => $gallery_img . '/haiha-gallery-1.jpg'),
                'sua-chua-hop-so-va-truyen-dong'   => array('title' => 'Sửa chữa hộp số tự động & truyền động', 'default_img' => $gallery_img . '/haiha-gallery-1.jpg'),
                'sua-chua-he-thong-phanh'          => array('title' => 'Sửa chữa hệ thống phanh ABS', 'default_img' => $gallery_img . '/haiha-gallery-10.jpg'),
                'sua-chua-gam-va-he-thong-treo'    => array('title' => 'Sửa chữa gầm & hệ thống treo giảm xóc', 'default_img' => $gallery_img . '/haiha-gallery-7.jpg'),
                'sua-chua-he-thong-lai'            => array('title' => 'Sửa chữa hệ thống lái & cân chỉnh thước lái 3D', 'default_img' => $gallery_img . '/haiha-gallery-9.jpg'),
                'sua-chua-he-thong-xa-va-khi-thai' => array('title' => 'Sửa chữa hệ thống xả & khí thải Catalytic', 'default_img' => $gallery_img . '/haiha-gallery-4.jpg'),
            ),
        ),
        'dien-o-to-dieu-hoa' => array(
            'group_title' => '03. ĐIỆN Ô TÔ & ĐIỀU HÒA',
            'group_desc'  => 'Ảnh đại diện nhóm Điện - Điện tử ECU - Điều hòa & 4 hạng mục con',
            'default_img' => $gallery_img . '/haiha-gallery-11.jpg',
            'children'    => array(
                'sua-chua-dien-o-to'       => array('title' => 'Sửa chữa điện ô tô & điện thân xe', 'default_img' => $gallery_img . '/haiha-gallery-1.jpg'),
                'sua-chua-dien-tu-va-ecu'  => array('title' => 'Kiểm tra, coding & sửa hộp đen ECU Châu Âu', 'default_img' => $gallery_img . '/haiha-gallery-11.jpg'),
                'sua-chua-dieu-hoa-o-to'   => array('title' => 'Sửa chữa & nạp gas điều hòa nội soi', 'default_img' => $gallery_img . '/haiha-gallery-4.jpg'),
                'he-thong-lam-mat-o-to'    => array('title' => 'Chẩn đoán lỗi máy & hệ thống làm mát két nước', 'default_img' => $gallery_img . '/haiha-gallery-1.jpg'),
            ),
        ),
        'dong-son-o-to' => array(
            'group_title' => '04. ĐỒNG SƠN & THÂN VỎ',
            'group_desc'  => 'Ảnh đại diện nhóm Đồng sơn phòng sấy & 4 hạng mục con',
            'default_img' => $gallery_img . '/haiha-gallery-2.jpg',
            'children'    => array(
                'son-o-to'                   => array('title' => 'Sơn ô tô phòng sấy vi tính tiêu chuẩn Châu Âu', 'default_img' => $gallery_img . '/haiha-gallery-8.jpg'),
                'go-han-va-sua-chua-than-vo' => array('title' => 'Gò hàn & phục hồi sửa chữa thân vỏ', 'default_img' => $gallery_img . '/haiha-gallery-2.jpg'),
                'sua-chua-kinh-va-den-o-to'  => array('title' => 'Sửa chữa kính & phục hồi đánh bóng đèn ô tô', 'default_img' => $gallery_img . '/haiha-gallery-6.jpg'),
                'sua-chua-o-to-sau-va-cham'  => array('title' => 'Phục hồi xe sau tai nạn va chạm', 'default_img' => $gallery_img . '/haiha-gallery-6.jpg'),
            ),
        ),
        'cham-soc-nang-cap-o-to' => array(
            'group_title' => '05. CHĂM SÓC & NÂNG CẤP XE',
            'group_desc'  => 'Ảnh đại diện nhóm Chăm sóc Detailing - Độ xe & 6 hạng mục con',
            'default_img' => $gallery_img . '/haiha-gallery-5.jpg',
            'children'    => array(
                'cham-soc-va-lam-dep-xe-detailing' => array('title' => 'Detailing chăm sóc làm đẹp xe toàn diện', 'default_img' => $gallery_img . '/haiha-gallery-5.jpg'),
                've-sinh-noi-that-o-to'            => array('title' => 'Vệ sinh nội thất & khoang máy hơi nước nóng', 'default_img' => $gallery_img . '/haiha-gallery-5.jpg'),
                'danh-bong-va-phu-ceramic'         => array('title' => 'Đánh bóng hiệu chỉnh sơn & phủ Ceramic 9H', 'default_img' => $gallery_img . '/haiha-gallery-6.jpg'),
                'phu-kien-va-nang-cap-o-to'        => array('title' => 'Nâng cấp nội – ngoại thất & Phụ kiện thông minh', 'default_img' => $gallery_img . '/haiha-gallery-7.jpg'),
                'nang-cap-anh-sang-va-am-thanh'    => array('title' => 'Nâng cấp ánh sáng Bi-LED/Laser & Âm thanh', 'default_img' => $gallery_img . '/haiha-gallery-11.jpg'),
                'phim-cach-nhiet-va-ppf'           => array('title' => 'Dán phim cách nhiệt chính hãng & Wrap PPF', 'default_img' => $gallery_img . '/haiha-gallery-5.jpg'),
            ),
        ),
        'cuu-ho-ho-tro-o-to' => array(
            'group_title' => '06. HỖ TRỢ, BẢO HIỂM & CỨU HỘ 24/7',
            'group_desc'  => 'Ảnh đại diện nhóm Cứu hộ 24/7 - Bảo hiểm - Đăng kiểm & 6 hạng mục con',
            'default_img' => $gallery_img . '/haiha-gallery-3.jpg',
            'children'    => array(
                'cuu-ho-giao-thong-o-to'      => array('title' => 'Cứu hộ giao thông ô tô sàn trượt 24/7', 'default_img' => $gallery_img . '/haiha-gallery-3.jpg'),
                'bao-hiem-va-bao-hanh-o-to'   => array('title' => 'Sửa chữa xe bảo hiểm & Bảo lãnh viện phí thân vỏ', 'default_img' => $gallery_img . '/haiha-gallery-6.jpg'),
                'dich-vu-dang-kiem-o-to'      => array('title' => 'Kiểm tra kỹ thuật & Hỗ trợ đăng kiểm ô tô trọn gói', 'default_img' => $gallery_img . '/haiha-gallery-9.jpg'),
                'kiem-tra-xe-cu-truoc-khi-mua'=> array('title' => 'Kiểm tra test tổng thể xe cũ trước khi mua', 'default_img' => $gallery_img . '/haiha-gallery-10.jpg'),
                'sua-chua-o-to-luu-dong'      => array('title' => 'Sửa chữa & kích bình ắc quy lưu động tận nơi', 'default_img' => $gallery_img . '/haiha-gallery-3.jpg'),
                'bao-duong-xe-doanh-nghiep'   => array('title' => 'Bảo dưỡng đội xe doanh nghiệp theo hợp đồng', 'default_img' => $gallery_img . '/haiha-gallery-4.jpg'),
            ),
        ),
    );
}

// =========================================================================
// 2. REGISTER MEDIA FOLDER TAXONOMY FOR WORDPRESS MEDIA LIBRARY (upload.php)
// =========================================================================
function hieugara_register_media_folder_taxonomy() {
    register_taxonomy('garage_media_folder', array('attachment'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'          => 'Nhóm Ảnh Gara',
            'singular_name' => 'Nhóm Ảnh',
            'menu_name'     => '🗂️ Chia Nhóm Ảnh',
            'all_items'     => 'Tất cả nhóm ảnh',
            'parent_item'   => 'Nhóm cha',
            'add_new_item'  => 'Thêm nhóm ảnh mới',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
    ));
}
add_action('init', 'hieugara_register_media_folder_taxonomy');

// Seed default folder structure in `garage_media_folder` once
function hieugara_seed_media_folders() {
    if (get_option('hieugara_media_folders_seeded_v1')) {
        return;
    }
    if (!taxonomy_exists('garage_media_folder')) {
        return;
    }

    // 1. Logo
    if (!term_exists('Logo & Nhận Diện Thương Hiệu', 'garage_media_folder')) {
        wp_insert_term('1. Logo & Nhận Diện Thương Hiệu', 'garage_media_folder', array('slug' => 'logo-thuong-hieu'));
    }

    // 2. Trang Chủ + Subfolders
    $home_term = term_exists('trang-chu', 'garage_media_folder');
    if (!$home_term) {
        $home_term = wp_insert_term('2. Trang Chủ (Homepage)', 'garage_media_folder', array('slug' => 'trang-chu'));
    }
    $home_parent_id = is_array($home_term) ? $home_term['term_id'] : (int) $home_term;
    if ($home_parent_id && !is_wp_error($home_term)) {
        $home_subs = array(
            'home-slider'      => '2.1. Banner Slider Đầu Trang',
            'home-pano'        => '2.2. 4 Ảnh Năng Lực Xưởng',
            'home-gallery'     => '2.3. Gallery Hình Ảnh Ôtô Hải Hà',
            'home-accessories' => '2.4. Phụ Kiện Ôtô Chính Hãng',
            'home-brands'      => '2.5. Logo Các Dòng Xe Phục Vụ',
        );
        foreach ($home_subs as $s_slug => $s_name) {
            if (!term_exists($s_slug, 'garage_media_folder')) {
                wp_insert_term($s_name, 'garage_media_folder', array('slug' => $s_slug, 'parent' => $home_parent_id));
            }
        }
    }

    // 3. Dịch Vụ Gara (6 Mảng Lớn)
    $srv_term = term_exists('dich-vu-gara', 'garage_media_folder');
    if (!$srv_term) {
        $srv_term = wp_insert_term('3. Dịch Vụ Gara (6 Mảng Lớn)', 'garage_media_folder', array('slug' => 'dich-vu-gara'));
    }
    $srv_parent_id = is_array($srv_term) ? $srv_term['term_id'] : (int) $srv_term;
    if ($srv_parent_id && !is_wp_error($srv_term)) {
        $srv_subs = array(
            'srv-01-bao-duong' => '01. Bảo Dưỡng Ô Tô',
            'srv-02-sua-chua'  => '02. Sửa Chữa Ô Tô',
            'srv-03-dien-lanh' => '03. Điện Ô Tô & Điều Hòa',
            'srv-04-dong-son'  => '04. Đồng Sơn & Thân Vỏ',
            'srv-05-cham-soc'  => '05. Chăm Sóc & Nâng Cấp',
            'srv-06-cuu-ho'    => '06. Hỗ Trợ, Bảo Hiểm & Cứu Hộ',
        );
        foreach ($srv_subs as $s_slug => $s_name) {
            if (!term_exists($s_slug, 'garage_media_folder')) {
                wp_insert_term($s_name, 'garage_media_folder', array('slug' => $s_slug, 'parent' => $srv_parent_id));
            }
        }
    }

    update_option('hieugara_media_folders_seeded_v1', '1');
}
add_action('admin_init', 'hieugara_seed_media_folders');

// Add folder filter dropdown to standard WordPress Media Library (upload.php)
function hieugara_add_media_folder_filter() {
    global $pagenow;
    if ($pagenow !== 'upload.php') {
        return;
    }
    $selected = isset($_GET['garage_media_folder']) ? sanitize_text_field($_GET['garage_media_folder']) : '';
    wp_dropdown_categories(array(
        'show_option_all' => '📁 Tất cả Nhóm Ảnh Gara',
        'taxonomy'        => 'garage_media_folder',
        'name'            => 'garage_media_folder',
        'orderby'         => 'name',
        'selected'        => $selected,
        'hierarchical'    => true,
        'value_field'     => 'slug',
        'hide_empty'      => false,
    ));
}
add_action('restrict_manage_posts', 'hieugara_add_media_folder_filter');

// Display a top banner on `upload.php` linking directly to the Visual Categorized Image Hub
function hieugara_upload_page_top_banner() {
    global $pagenow;
    if ($pagenow !== 'upload.php') {
        return;
    }
    ?>
    <div class="notice notice-info" style="border-left: 4px solid #1d4ed8; padding: 14px 20px; background: #fff8f6; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-top: 15px;">
        <div>
            <strong style="font-size: 1rem; color: #0c1e3a; display: block; margin-bottom: 4px;">
                🖼️ QUẢN LÝ ẢNH THEO NHÓM &amp; VỊ TRÍ HIỂN THỊ TRÊN WEBSITE ÔTÔ HẢI HÀ
            </strong>
            <span style="color: #475569; font-size: 0.9rem;">
                Muốn đổi nhanh <strong>Logo quán, Ảnh Trang Chủ (Slider, 4 Banner, Gallery, Phụ kiện)</strong> hoặc <strong>Ảnh 6 Mảng Dịch Vụ &amp; Mục Con</strong>? Hãy mở trình Quản Lý Ảnh Theo Nhóm để thay ảnh trực quan!
            </span>
        </div>
        <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-media-hub')); ?>" class="button button-primary button-hero" style="background: #1d4ed8; border-color: #1d4ed8; font-weight: 700;">
            <span class="dashicons dashicons-images-alt2" style="margin-top: 4px;"></span> MỞ THƯ VIỆN ẢNH THEO NHÓM WEB
        </a>
    </div>
    <?php
}
add_action('admin_notices', 'hieugara_upload_page_top_banner');

// =========================================================================
// 3. REGISTER VISUAL MEDIA HUB MENU & HANDLE SAVING
// =========================================================================
function hieugara_register_media_hub_menu() {
    add_menu_page(
        'Thư Viện Ảnh Gara',
        '🖼️ Thư Viện Ảnh Gara',
        'manage_options',
        'hieugara-media-hub',
        'hieugara_render_media_hub_page',
        'dashicons-format-gallery',
        35
    );

    add_submenu_page(
        'hieugara-media-hub',
        'Quản Lý Ảnh Theo Nhóm Web',
        '🗂️ Ảnh Theo Nhóm Web',
        'manage_options',
        'hieugara-media-hub',
        'hieugara_render_media_hub_page'
    );

    add_submenu_page(
        'hieugara-media-hub',
        'Tất Cả File Media Tải Lên',
        '📁 Kho File Media (Upload)',
        'manage_options',
        'upload.php'
    );
}
add_action('admin_menu', 'hieugara_register_media_hub_menu', 9);

function hieugara_media_hub_assets($hook) {
    if ($hook !== 'toplevel_page_hieugara-media-hub') {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'hieugara_media_hub_assets');

function hieugara_handle_media_hub_save() {
    if (!isset($_POST['hieugara_media_hub_nonce']) || !wp_verify_nonce($_POST['hieugara_media_hub_nonce'], 'hieugara_save_media_hub')) {
        return;
    }
    if (!current_user_can('manage_options')) {
        return;
    }

    // 1. Save Site Logo
    if (isset($_POST['hieugara_site_logo'])) {
        update_option('hieugara_site_logo', esc_url_raw($_POST['hieugara_site_logo']));
    }

    // 2. Save Hero Slider Slides
    if (isset($_POST['hieugara_slider_slides']) && is_array($_POST['hieugara_slider_slides'])) {
        $clean_slides = array();
        foreach ($_POST['hieugara_slider_slides'] as $idx => $s) {
            $clean_slides[$idx] = array(
                'enable'   => isset($s['enable']) ? '1' : '0',
                'eyebrow'  => sanitize_text_field($s['eyebrow'] ?? ''),
                'title'    => sanitize_text_field($s['title'] ?? ''),
                'nav_tab'  => sanitize_text_field($s['nav_tab'] ?? ''),
                'desc'     => sanitize_textarea_field($s['desc'] ?? ''),
                'btn_text' => sanitize_text_field($s['btn_text'] ?? ''),
                'btn_url'  => esc_url_raw($s['btn_url'] ?? ''),
                'image'    => esc_url_raw($s['image'] ?? ''),
            );
        }
        update_option('hieugara_slider_slides', $clean_slides);
    }

    // 3. Save 4 Panoramic Banners
    if (isset($_POST['hieugara_pano_banners']) && is_array($_POST['hieugara_pano_banners'])) {
        $clean_pano = array();
        foreach ($_POST['hieugara_pano_banners'] as $idx => $p) {
            $clean_pano[$idx] = array(
                'title'      => sanitize_text_field($p['title'] ?? ''),
                'desc'       => sanitize_textarea_field($p['desc'] ?? ''),
                'img'        => esc_url_raw($p['img'] ?? ''),
                'img_mobile' => esc_url_raw($p['img_mobile'] ?? ''),
                'link'       => esc_url_raw($p['link'] ?? ''),
            );
        }
        update_option('hieugara_pano_banners', $clean_pano);
    }

    // 4. Save 3 Images of "Về ÔTÔ HẢI HÀ & SỨ MỆNH"
    if (isset($_POST['hieugara_about_kobac_images']) && is_array($_POST['hieugara_about_kobac_images'])) {
        $raw_ab = $_POST['hieugara_about_kobac_images'];
        update_option('hieugara_about_kobac_images', array(
            'img_1' => esc_url_raw($raw_ab['img_1'] ?? ''),
            'img_2' => esc_url_raw($raw_ab['img_2'] ?? ''),
            'img_3' => esc_url_raw($raw_ab['img_3'] ?? ''),
        ));
    }

    // 4B. Save Gallery Items (if posted)
    if (isset($_POST['hieugara_gallery_items']) && is_array($_POST['hieugara_gallery_items'])) {
        $clean_gal = array();
        foreach ($_POST['hieugara_gallery_items'] as $k => $g) {
            if (!empty($g['img']) || !empty($g['title'])) {
                $clean_gal[$k] = array(
                    'enable' => isset($g['enable']) ? '1' : '0',
                    'img'    => esc_url_raw($g['img'] ?? ''),
                    'title'  => sanitize_text_field($g['title'] ?? ''),
                );
            }
        }
        update_option('hieugara_gallery_items', $clean_gal);
    }

    // 5. Save Accessories Items
    if (isset($_POST['hieugara_accessories_items']) && is_array($_POST['hieugara_accessories_items'])) {
        $clean_acc = array();
        foreach ($_POST['hieugara_accessories_items'] as $k => $a) {
            if (!empty($a['img']) || !empty($a['title'])) {
                $clean_acc[$k] = array(
                    'enable'    => isset($a['enable']) ? '1' : '0',
                    'title'     => sanitize_text_field($a['title'] ?? ''),
                    'img'       => esc_url_raw($a['img'] ?? ''),
                    'price'     => sanitize_text_field($a['price'] ?? ''),
                    'old_price' => sanitize_text_field($a['old_price'] ?? ''),
                    'badge'     => sanitize_text_field($a['badge'] ?? ''),
                    'link'      => esc_url_raw($a['link'] ?? ''),
                );
            }
        }
        update_option('hieugara_accessories_items', $clean_acc);
    }

    // 6. Save Service Images (6 Major Groups + All Sub-services)
    if (isset($_POST['hieugara_service_images']) && is_array($_POST['hieugara_service_images'])) {
        $clean_srv_imgs = array();
        foreach ($_POST['hieugara_service_images'] as $s_key => $s_url) {
            $clean_url = esc_url_raw($s_url);
            if (!empty($clean_url)) {
                $clean_srv_imgs[sanitize_key($s_key)] = $clean_url;
                // Also sync to CPT post meta `_garage_custom_image` if a post with this slug exists
                $srv_post = get_page_by_path(sanitize_key($s_key), OBJECT, 'garage_service');
                if ($srv_post) {
                    update_post_meta($srv_post->ID, '_garage_custom_image', $clean_url);
                }
            }
        }
        update_option('hieugara_service_images', $clean_srv_imgs);
    }

    // Purge page cache immediately
    if (function_exists('hieugara_purge_page_cache')) {
        hieugara_purge_page_cache();
    }

    $active_tab = isset($_POST['active_hub_tab']) ? sanitize_key($_POST['active_hub_tab']) : 'tab-logo';
    wp_safe_redirect(admin_url('admin.php?page=hieugara-media-hub&saved=1&tab=' . $active_tab));
    exit;
}
add_action('admin_init', 'hieugara_handle_media_hub_save');

// =========================================================================
// 4. RENDER VISUAL CATEGORIZED MEDIA HUB PAGE
// =========================================================================
function hieugara_render_media_hub_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $site_logo       = hieugara_get_site_logo();
    $slides          = function_exists('hieugara_get_slides') ? hieugara_get_slides() : array();
    $pano_banners    = hieugara_get_pano_banners();
    $gallery_items   = function_exists('hieugara_get_gallery_items') ? hieugara_get_gallery_items() : array();
    $accessories     = hieugara_get_accessories_items();
    $service_groups  = hieugara_get_service_groups_tree();
    $active_tab      = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'tab-logo';
    ?>
    <style>
        .haiha-media-hub-wrap { max-width: 1380px; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .haiha-hub-header { background: linear-gradient(135deg, #0c1e3a, #1e293b); color: #fff; padding: 26px 32px; border-radius: 10px; border-bottom: 4px solid #1d4ed8; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 24px; box-shadow: 0 10px 25px rgba(15,23,42,0.12); }
        .haiha-hub-header h1 { color: #fff; margin: 0 0 6px; font-size: 1.55rem; font-weight: 800; display: flex; align-items: center; gap: 10px; }
        .haiha-hub-header p { margin: 0; color: #cbd5e1; font-size: 0.92rem; }
        .haiha-hub-tabs { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; }
        .haiha-tab-btn { background: #ffffff; border: 1.5px solid #cbd5e1; color: #1e293b; padding: 12px 22px; border-radius: 8px; font-size: 0.95rem; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; }
        .haiha-tab-btn:hover { border-color: #1d4ed8; color: #1d4ed8; }
        .haiha-tab-btn.is-active { background: #1d4ed8; border-color: #1d4ed8; color: #ffffff; box-shadow: 0 4px 14px rgba(29, 78, 216,0.3); }
        .haiha-tab-pane { display: none; }
        .haiha-tab-pane.is-active { display: block; }
        .haiha-folder-box { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 28px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .haiha-folder-head { background: #f8fafc; padding: 16px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .haiha-folder-head h2 { margin: 0; font-size: 1.1rem; font-weight: 800; color: #0c1e3a; display: flex; align-items: center; gap: 8px; }
        .haiha-folder-body { padding: 24px; }
        .haiha-cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 20px; }
        .haiha-img-card { border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; background: #fff; display: flex; flex-direction: column; gap: 10px; transition: box-shadow 0.2s; }
        .haiha-img-card:hover { box-shadow: 0 6px 18px rgba(15,23,42,0.08); border-color: #cbd5e1; }
        .haiha-img-thumb { width: 100%; height: 160px; background: #0c1e3a; border-radius: 6px; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center; }
        .haiha-img-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .haiha-img-card label { font-size: 0.8rem; font-weight: 700; color: #475569; display: block; margin-bottom: 3px; }
        .haiha-img-card input[type="text"] { width: 100%; font-size: 0.85rem; padding: 7px 10px; border: 1px solid #cbd5e1; border-radius: 5px; }
        .haiha-sticky-save { position: sticky; bottom: 16px; background: #0c1e3a; color: #fff; padding: 16px 28px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 30px rgba(0,0,0,0.28); z-index: 999; border-left: 5px solid #1d4ed8; margin-top: 24px; }
        .haiha-subcat-pill { display: inline-block; background: #fff0ed; color: #1d4ed8; border: 1px solid #ffd4cc; font-size: 0.75rem; font-weight: 700; padding: 2px 10px; border-radius: 999px; }
    </style>

    <div class="wrap haiha-media-hub-wrap">
        <div class="haiha-hub-header">
            <div>
                <h1><span class="dashicons dashicons-format-gallery" style="color: #1d4ed8; font-size: 28px; width: 28px; height: 28px;"></span> THƯ VIỆN ẢNH GARA ÔTÔ HẢI HÀ (CHIA THEO NHÓM WEBSITE)</h1>
                <p>Toàn bộ hình ảnh của quán được chia sẵn theo từng nhóm: <strong>Logo Nhận Diện</strong> • <strong>Trang Chủ (4 Mục Con)</strong> • <strong>Dịch Vụ (6 Mảng Lớn &amp; Các Mục Con)</strong>. Thay ảnh tại đây sẽ tự động cập nhật trực tiếp ngoài website!</p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo esc_url(admin_url('upload.php')); ?>" class="button button-secondary" style="font-weight: 600;">
                    📁 Mở Kho File Media Gốc
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button button-primary" style="background: #1d4ed8; border-color: #1d4ed8; font-weight: 700;">
                    🚗 Xem Trang Chủ ↗
                </a>
            </div>
        </div>

        <?php if (isset($_GET['saved']) && $_GET['saved'] == '1') : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #22c55e; padding: 12px 18px; margin-bottom: 20px;">
                <p style="margin: 0; font-weight: 700; color: #166534; font-size: 0.95rem;">
                    ✅ ĐÃ LƯU THƯ VIỆN ẢNH GARA &amp; TỰ ĐỘNG CẬP NHẬT RA WEBSITE THÀNH CÔNG!
                </p>
            </div>
        <?php endif; ?>

        <!-- Folder Category Tabs -->
        <div class="haiha-hub-tabs">
            <button type="button" class="haiha-tab-btn <?php echo $active_tab === 'tab-logo' ? 'is-active' : ''; ?>" data-tab="tab-logo">
                🏷️ 1. Ảnh Logo &amp; Nhận Diện Thương Hiệu
            </button>
            <button type="button" class="haiha-tab-btn <?php echo $active_tab === 'tab-home' ? 'is-active' : ''; ?>" data-tab="tab-home">
                🏠 2. Ảnh Trang Chủ (Slider, 4 Banner, Gallery, Phụ Kiện)
            </button>
            <button type="button" class="haiha-tab-btn <?php echo $active_tab === 'tab-services' ? 'is-active' : ''; ?>" data-tab="tab-services">
                🔧 3. Ảnh Dịch Vụ (Chia Theo 6 Mảng Lớn &amp; Các Mục Con)
            </button>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field('hieugara_save_media_hub', 'hieugara_media_hub_nonce'); ?>
            <input type="hidden" name="active_hub_tab" id="active_hub_tab_input" value="<?php echo esc_attr($active_tab); ?>">

            <!-- =========================================================================
                 TAB 1: ẢNH LOGO & NHẬN DIỆN THƯƠNG HIỆU
                 ========================================================================= -->
            <div class="haiha-tab-pane <?php echo $active_tab === 'tab-logo' ? 'is-active' : ''; ?>" id="tab-logo">
                <div class="haiha-folder-box">
                    <div class="haiha-folder-head">
                        <h2><span class="dashicons dashicons-awards" style="color: #1d4ed8;"></span> 1. Ảnh Logo Ôtô Hải Hà (Tự động đồng bộ Header, Mobile Menu, Footer &amp; Icon Tab Web)</h2>
                        <span class="haiha-subcat-pill">Đổi 1 nơi – Tự động thay toàn web</span>
                    </div>
                    <div class="haiha-folder-body">
                        <div style="display: flex; align-items: center; gap: 28px; flex-wrap: wrap;">
                            <div style="width: 140px; height: 140px; border-radius: 14px; background: #0c1e3a; border: 2px solid #1d4ed8; display: flex; align-items: center; justify-content: center; padding: 14px;">
                                <img src="<?php echo esc_url($site_logo); ?>" id="preview-site-logo" alt="Logo Ôtô Hải Hà" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            </div>
                            <div style="flex: 1; min-width: 280px;">
                                <p style="margin-top: 0; color: #334155; font-size: 0.95rem; line-height: 1.6;">
                                    Đây là <strong>Logo chính thức của Ôtô Hải Hà</strong>. Khi bạn chọn ảnh mới tại đây và bấm Lưu, toàn bộ Logo ở <strong>Thanh đầu trang (Header), Menu Điện thoại, Chân trang (Footer) và Biểu tượng trang web (Favicon)</strong> sẽ tự động thay đổi theo ngay lập tức.
                                </p>
                                <div style="display: flex; gap: 10px; align-items: center; max-width: 680px;">
                                    <input type="text" name="hieugara_site_logo" id="input-site-logo" value="<?php echo esc_attr($site_logo); ?>" class="regular-text" style="flex: 1; padding: 8px 12px;">
                                    <button type="button" class="button button-primary hub-pick-img-btn" data-input="#input-site-logo" data-preview="#preview-site-logo" style="background: #1d4ed8; border-color: #1d4ed8; font-weight: 700;">
                                        <span class="dashicons dashicons-upload" style="margin-top: 3px;"></span> Tải Lên / Đổi Ảnh Logo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 TAB 2: ẢNH TRANG CHỦ (VỀ ÔTÔ HẢI HÀ, SLIDER, 4 BANNER, PHỤ KIỆN)
                 ========================================================================= -->
            <?php $kobac_imgs = hieugara_get_about_kobac_images(); ?>
            <div class="haiha-tab-pane <?php echo $active_tab === 'tab-home' ? 'is-active' : ''; ?>" id="tab-home">

                <!-- 2.1: 3 ẢNH KHỐI "VỀ ÔTÔ HẢI HÀ & SỨ MỆNH" -->
                <div class="haiha-folder-box">
                    <div class="haiha-folder-head">
                        <h2><span class="dashicons dashicons-awards" style="color: #1d4ed8;"></span> Mục 2.1: 3 Ảnh Khối "Về Ôtô Hải Hà &amp; Sứ Mệnh" Trên Trang Chủ</h2>
                        <span class="haiha-subcat-pill">Trang Chủ &rarr; Về Ôtô Hải Hà</span>
                    </div>
                    <div class="haiha-folder-body">
                        <div class="haiha-cards-grid">
                            <?php
                            $about_labels = array(
                                'img_1' => 'Ảnh 1: Mặt Tiền Trung Tâm Ôtô Hải Hà (Cột Phải - Về Ôtô Hải Hà)',
                                'img_2' => 'Ảnh 2: Toàn Cảnh Khu Xưởng Dịch Vụ (Cột Trái - Sứ Mệnh)',
                                'img_3' => 'Ảnh 3: Phòng Sơn Sấy Hồng Ngoại (Ảnh Phụ Nổi - Sứ Mệnh)',
                            );
                            foreach ($about_labels as $ab_key => $ab_label) :
                                $ab_url = $kobac_imgs[$ab_key] ?? '';
                            ?>
                                <div class="haiha-img-card">
                                    <div class="haiha-img-thumb">
                                        <img src="<?php echo esc_url($ab_url); ?>" id="prev-kobac-<?php echo esc_attr($ab_key); ?>" alt="">
                                    </div>
                                    <div>
                                        <label><?php echo esc_html($ab_label); ?>:</label>
                                        <div style="display: flex; gap: 6px;">
                                            <input type="text" name="hieugara_about_kobac_images[<?php echo esc_attr($ab_key); ?>]" id="inp-kobac-<?php echo esc_attr($ab_key); ?>" value="<?php echo esc_attr($ab_url); ?>">
                                            <button type="button" class="button hub-pick-img-btn" data-input="#inp-kobac-<?php echo esc_attr($ab_key); ?>" data-preview="#prev-kobac-<?php echo esc_attr($ab_key); ?>">Đổi ảnh</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- 2.2: 4 ẢNH BANNER SLIDER ĐẦU TRANG -->
                <div class="haiha-folder-box">
                    <div class="haiha-folder-head">
                        <h2><span class="dashicons dashicons-slides" style="color: #1d4ed8;"></span> Mục 2.2: 4 Ảnh Banner Slider Đầu Trang Chủ</h2>
                        <span class="haiha-subcat-pill">Trang Chủ &rarr; Hero Slider</span>
                    </div>
                    <div class="haiha-folder-body">
                        <div class="haiha-cards-grid">
                            <?php foreach ($slides as $s_idx => $s) : ?>
                                <div class="haiha-img-card">
                                    <div class="haiha-img-thumb">
                                        <img src="<?php echo esc_url($s['image']); ?>" id="prev-slide-<?php echo esc_attr($s_idx); ?>" alt="">
                                    </div>
                                    <input type="hidden" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][enable]" value="<?php echo esc_attr($s['enable']); ?>">
                                    <input type="hidden" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][eyebrow]" value="<?php echo esc_attr($s['eyebrow']); ?>">
                                    <input type="hidden" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][nav_tab]" value="<?php echo esc_attr($s['nav_tab']); ?>">
                                    <input type="hidden" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][btn_text]" value="<?php echo esc_attr($s['btn_text']); ?>">
                                    <input type="hidden" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][btn_url]" value="<?php echo esc_attr($s['btn_url']); ?>">
                                    <div>
                                        <label>Tiêu đề Slide <?php echo esc_html($s_idx); ?>:</label>
                                        <input type="text" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][title]" value="<?php echo esc_attr($s['title']); ?>">
                                    </div>
                                    <div>
                                        <label>Mô tả ngắn:</label>
                                        <input type="text" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][desc]" value="<?php echo esc_attr($s['desc']); ?>">
                                    </div>
                                    <div>
                                        <label>Ảnh nền Slide <?php echo esc_html($s_idx); ?>:</label>
                                        <div style="display: flex; gap: 6px;">
                                            <input type="text" name="hieugara_slider_slides[<?php echo esc_attr($s_idx); ?>][image]" id="inp-slide-<?php echo esc_attr($s_idx); ?>" value="<?php echo esc_attr($s['image']); ?>">
                                            <button type="button" class="button hub-pick-img-btn" data-input="#inp-slide-<?php echo esc_attr($s_idx); ?>" data-preview="#prev-slide-<?php echo esc_attr($s_idx); ?>">Đổi ảnh</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- 2.3: 4 CỘT ẢNH NĂNG LỰC XƯỞNG (SỬA CHỮA, BẢO DƯỠNG, ĐỒNG SƠN, CHĂM SÓC XE) -->
                <div class="haiha-folder-box">
                    <div class="haiha-folder-head">
                        <h2><span class="dashicons dashicons-columns" style="color: #1d4ed8;"></span> Mục 2.3: 4 Ảnh Năng Lực Xưởng (Sửa Chữa, Bảo Dưỡng, Đồng Sơn, Chăm Sóc Xe)</h2>
                        <span class="haiha-subcat-pill">Trang Chủ &rarr; 4 Cột Ảnh Lớn</span>
                    </div>
                    <div class="haiha-folder-body">
                        <div class="haiha-cards-grid">
                            <?php foreach ($pano_banners as $p_idx => $p) : ?>
                                <div class="haiha-img-card">
                                    <div class="haiha-img-thumb">
                                        <img src="<?php echo esc_url($p['img']); ?>" id="prev-pano-<?php echo esc_attr($p_idx); ?>" alt="">
                                    </div>
                                    <input type="hidden" name="hieugara_pano_banners[<?php echo esc_attr($p_idx); ?>][link]" value="<?php echo esc_attr($p['link']); ?>">
                                    <input type="hidden" name="hieugara_pano_banners[<?php echo esc_attr($p_idx); ?>][img_mobile]" value="<?php echo esc_attr($p['img_mobile']); ?>">
                                    <div>
                                        <label>Tiêu đề cột <?php echo esc_html($p_idx); ?>:</label>
                                        <input type="text" name="hieugara_pano_banners[<?php echo esc_attr($p_idx); ?>][title]" value="<?php echo esc_attr($p['title']); ?>">
                                    </div>
                                    <div>
                                        <label>Mô tả khi rê chuột:</label>
                                        <input type="text" name="hieugara_pano_banners[<?php echo esc_attr($p_idx); ?>][desc]" value="<?php echo esc_attr($p['desc']); ?>">
                                    </div>
                                    <div>
                                        <label>Ảnh nền cột <?php echo esc_html($p_idx); ?>:</label>
                                        <div style="display: flex; gap: 6px;">
                                            <input type="text" name="hieugara_pano_banners[<?php echo esc_attr($p_idx); ?>][img]" id="inp-pano-<?php echo esc_attr($p_idx); ?>" value="<?php echo esc_attr($p['img']); ?>">
                                            <button type="button" class="button hub-pick-img-btn" data-input="#inp-pano-<?php echo esc_attr($p_idx); ?>" data-preview="#prev-pano-<?php echo esc_attr($p_idx); ?>">Đổi ảnh</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- 2.4: ẢNH PHỤ KIỆN ÔTÔ CHÍNH HÃNG -->
                <div class="haiha-folder-box">
                    <div class="haiha-folder-head">
                        <h2><span class="dashicons dashicons-cart" style="color: #1d4ed8;"></span> Mục 2.4: Ảnh Phụ Kiện Ôtô Chính Hãng (Thanh Trượt Sản Phẩm Trang Chủ)</h2>
                        <div style="display: flex; gap: 8px;">
                            <a href="<?php echo esc_url(admin_url('admin.php?page=hieugara-accessories-crud')); ?>" class="button" style="background: #C5A880; color: #141414; font-weight: 700; border: none;">
                                🛍️ Mở Quản Lý Phụ Kiện (Full CRUD)
                            </a>
                            <button type="button" class="button button-primary" id="hub-add-acc-btn" style="background: #0c1e3a; border-color: #0c1e3a;">
                                + Thêm Phụ Kiện Mới
                            </button>
                        </div>
                    </div>
                    <div class="haiha-folder-body">
                        <div class="haiha-cards-grid" id="hub-acc-grid">
                            <?php foreach ($accessories as $a_key => $acc) : ?>
                                <div class="haiha-img-card">
                                    <div class="haiha-img-thumb">
                                        <img src="<?php echo esc_url($acc['img']); ?>" id="prev-acc-<?php echo esc_attr($a_key); ?>" alt="">
                                    </div>
                                    <input type="hidden" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][badge]" value="<?php echo esc_attr($acc['badge']); ?>">
                                    <input type="hidden" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][old_price]" value="<?php echo esc_attr($acc['old_price']); ?>">
                                    <input type="hidden" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][link]" value="<?php echo esc_attr($acc['link']); ?>">
                                    <div>
                                        <label>Tên phụ kiện:</label>
                                        <input type="text" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][title]" value="<?php echo esc_attr($acc['title']); ?>">
                                    </div>
                                    <div>
                                        <label>Giá bán (VNĐ):</label>
                                        <input type="text" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][price]" value="<?php echo esc_attr($acc['price']); ?>">
                                    </div>
                                    <div>
                                        <label>Ảnh sản phẩm:</label>
                                        <div style="display: flex; gap: 6px;">
                                            <input type="text" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][img]" id="inp-acc-<?php echo esc_attr($a_key); ?>" value="<?php echo esc_attr($acc['img']); ?>">
                                            <button type="button" class="button hub-pick-img-btn" data-input="#inp-acc-<?php echo esc_attr($a_key); ?>" data-preview="#prev-acc-<?php echo esc_attr($a_key); ?>">Đổi ảnh</button>
                                        </div>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 6px; border-top: 1px solid #f1f5f9;">
                                        <label style="margin: 0; display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
                                            <input type="checkbox" name="hieugara_accessories_items[<?php echo esc_attr($a_key); ?>][enable]" value="1" <?php checked('1', $acc['enable'] ?? '1'); ?>> Hiển thị
                                        </label>
                                        <button type="button" class="button-link hub-remove-card-btn" style="color: #dc2626; font-weight: 600; text-decoration: none;">🗑️ Xóa</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- =========================================================================
                 TAB 3: ẢNH DỊCH VỤ (CHIA THEO 6 MẢNG LỚN & CÁC MỤC CON)
                 ========================================================================= -->
            <div class="haiha-tab-pane <?php echo $active_tab === 'tab-services' ? 'is-active' : ''; ?>" id="tab-services">
                <?php foreach ($service_groups as $group_slug => $group_info) :
                    $group_current_img = hieugara_get_service_image($group_slug, $group_info['default_img']);
                ?>
                    <div class="haiha-folder-box">
                        <div class="haiha-folder-head">
                            <h2><span class="dashicons dashicons-category" style="color: #1d4ed8;"></span> <?php echo esc_html($group_info['group_title']); ?></h2>
                            <span class="haiha-subcat-pill"><?php echo count($group_info['children']); ?> dịch vụ con trong mảng này</span>
                        </div>
                        <div class="haiha-folder-body">
                            <div class="haiha-cards-grid">
                                <!-- Ảnh Đại Diện Của Mảng Lớn -->
                                <div class="haiha-img-card" style="border: 2px solid #1d4ed8; background: #fff8f6;">
                                    <div class="haiha-img-thumb">
                                        <img src="<?php echo esc_url($group_current_img); ?>" id="prev-srv-<?php echo esc_attr($group_slug); ?>" alt="">
                                    </div>
                                    <div>
                                        <span class="haiha-subcat-pill" style="margin-bottom: 6px;">ẢNH CHÍNH CỦA MẢNG LỚN</span>
                                        <label style="color: #0c1e3a; font-size: 0.88rem;"><?php echo esc_html($group_info['group_title']); ?></label>
                                    </div>
                                    <div style="margin-top: auto;">
                                        <label>Đường dẫn ảnh đại diện mảng:</label>
                                        <div style="display: flex; gap: 6px;">
                                            <input type="text" name="hieugara_service_images[<?php echo esc_attr($group_slug); ?>]" id="inp-srv-<?php echo esc_attr($group_slug); ?>" value="<?php echo esc_attr($group_current_img); ?>">
                                            <button type="button" class="button button-primary hub-pick-img-btn" data-input="#inp-srv-<?php echo esc_attr($group_slug); ?>" data-preview="#prev-srv-<?php echo esc_attr($group_slug); ?>" style="background: #1d4ed8; border-color: #1d4ed8;">Đổi ảnh</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Các Dịch Vụ Con Thuộc Mảng Này -->
                                <?php foreach ($group_info['children'] as $child_slug => $child_info) :
                                    $child_current_img = hieugara_get_service_image($child_slug, $child_info['default_img']);
                                ?>
                                    <div class="haiha-img-card">
                                        <div class="haiha-img-thumb">
                                            <img src="<?php echo esc_url($child_current_img); ?>" id="prev-srv-<?php echo esc_attr($child_slug); ?>" alt="">
                                        </div>
                                        <div>
                                            <span style="font-size: 0.72rem; color: #64748b; font-weight: 700; text-transform: uppercase;">Mục con thuộc <?php echo esc_html($group_info['group_title']); ?></span>
                                            <label style="color: #0c1e3a; font-size: 0.86rem; margin-top: 2px;"><?php echo esc_html($child_info['title']); ?></label>
                                        </div>
                                        <div style="margin-top: auto;">
                                            <label>Đường dẫn ảnh mục con:</label>
                                            <div style="display: flex; gap: 6px;">
                                                <input type="text" name="hieugara_service_images[<?php echo esc_attr($child_slug); ?>]" id="inp-srv-<?php echo esc_attr($child_slug); ?>" value="<?php echo esc_attr($child_current_img); ?>">
                                                <button type="button" class="button hub-pick-img-btn" data-input="#inp-srv-<?php echo esc_attr($child_slug); ?>" data-preview="#prev-srv-<?php echo esc_attr($child_slug); ?>">Đổi ảnh</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Sticky Save Bar -->
            <div class="haiha-sticky-save">
                <div>
                    <strong style="font-size: 1rem; display: block;">💾 LƯU THƯ VIỆN ẢNH GARA &amp; CẬP NHẬT RA WEBSITE</strong>
                    <span style="font-size: 0.84rem; color: #cbd5e1;">Mọi thay đổi về Logo, Ảnh Trang Chủ, Gallery, Phụ Kiện và 6 Mảng Dịch Vụ sẽ có hiệu lực ngay lập tức.</span>
                </div>
                <button type="submit" class="button button-primary button-hero" style="background: #1d4ed8; border-color: #1d4ed8; font-weight: 800; font-size: 0.98rem;">
                    LƯU TẤT CẢ HÌNH ẢNH NGAY
                </button>
            </div>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // 1. Switch Tabs
        $('.haiha-tab-btn').on('click', function() {
            var tabId = $(this).data('tab');
            $('.haiha-tab-btn').removeClass('is-active');
            $(this).addClass('is-active');
            $('.haiha-tab-pane').removeClass('is-active');
            $('#' + tabId).addClass('is-active');
            $('#active_hub_tab_input').val(tabId);
        });

        // 2. Universal Media Picker for Any Slot
        $(document).on('click', '.hub-pick-img-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var inputSel = $btn.data('input');
            var prevSel = $btn.data('preview');

            var frame = wp.media({
                title: 'Chọn hoặc Tải Ảnh Lên Thư Viện Ảnh Gara',
                button: { text: 'Sử dụng hình ảnh này' },
                multiple: false
            }).on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $(inputSel).val(attachment.url);
                $(prevSel).attr('src', attachment.url);
            }).open();
        });

        // 3. Remove Card (Gallery / Accessories)
        $(document).on('click', '.hub-remove-card-btn', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa mục hình ảnh này không?')) {
                $(this).closest('.haiha-img-card').fadeOut(200, function() {
                    $(this).remove();
                });
            }
        });

        // 4. Add New Gallery Card
        $('#hub-add-gallery-btn').on('click', function() {
            var uid = 'gal_' + Date.now();
            var cardHtml = `
            <div class="haiha-img-card hub-gallery-card">
                <div class="haiha-img-thumb">
                    <img src="" id="prev-${uid}" alt="">
                </div>
                <div>
                    <label>Mô tả / Chú thích ảnh:</label>
                    <input type="text" name="hieugara_gallery_items[${uid}][title]" value="Hình ảnh xưởng dịch vụ Ôtô Hải Hà">
                </div>
                <div>
                    <label>Đường dẫn ảnh:</label>
                    <div style="display: flex; gap: 6px;">
                        <input type="text" name="hieugara_gallery_items[${uid}][img]" id="inp-${uid}" value="">
                        <button type="button" class="button hub-pick-img-btn" data-input="#inp-${uid}" data-preview="#prev-${uid}">Chọn ảnh</button>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 6px; border-top: 1px solid #f1f5f9;">
                    <label style="margin: 0; display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
                        <input type="checkbox" name="hieugara_gallery_items[${uid}][enable]" value="1" checked> Hiển thị
                    </label>
                    <button type="button" class="button-link hub-remove-card-btn" style="color: #dc2626; font-weight: 600; text-decoration: none;">🗑️ Xóa ảnh</button>
                </div>
            </div>`;
            $('#hub-gallery-grid').append(cardHtml);
        });

        // 5. Add New Accessory Card
        $('#hub-add-acc-btn').on('click', function() {
            var uid = 'acc_' + Date.now();
            var cardHtml = `
            <div class="haiha-img-card">
                <div class="haiha-img-thumb">
                    <img src="" id="prev-${uid}" alt="">
                </div>
                <input type="hidden" name="hieugara_accessories_items[${uid}][badge]" value="CHÍNH HÃNG">
                <input type="hidden" name="hieugara_accessories_items[${uid}][old_price]" value="">
                <input type="hidden" name="hieugara_accessories_items[${uid}][link]" value="<?php echo esc_url(home_url('/bang-gia/#phu-kien')); ?>">
                <div>
                    <label>Tên phụ kiện:</label>
                    <input type="text" name="hieugara_accessories_items[${uid}][title]" value="Phụ kiện chính hãng mới">
                </div>
                <div>
                    <label>Giá bán (VNĐ):</label>
                    <input type="text" name="hieugara_accessories_items[${uid}][price]" value="Liên hệ">
                </div>
                <div>
                    <label>Ảnh sản phẩm:</label>
                    <div style="display: flex; gap: 6px;">
                        <input type="text" name="hieugara_accessories_items[${uid}][img]" id="inp-${uid}" value="">
                        <button type="button" class="button hub-pick-img-btn" data-input="#inp-${uid}" data-preview="#prev-${uid}">Chọn ảnh</button>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 6px; border-top: 1px solid #f1f5f9;">
                    <label style="margin: 0; display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
                        <input type="checkbox" name="hieugara_accessories_items[${uid}][enable]" value="1" checked> Hiển thị
                    </label>
                    <button type="button" class="button-link hub-remove-card-btn" style="color: #dc2626; font-weight: 600; text-decoration: none;">🗑️ Xóa</button>
                </div>
            </div>`;
            $('#hub-acc-grid').append(cardHtml);
        });
    });
    </script>
    <?php
}

