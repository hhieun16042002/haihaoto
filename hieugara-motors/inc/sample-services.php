<?php
/**
 * Auto-populate sample garage services for Hiếu Gara
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_populate_sample_services() {
    if (get_option('hieugara_services_imported')) {
        return;
    }

    // 1. Taxonomies
    $categories = array(
        'dong-son'   => 'Đồng Sơn Ô Tô',
        'bao-duong'  => 'Bảo Dưỡng Định Kỳ',
        'may-gam'    => 'Sửa Máy - Gầm',
        'dien-lanh'  => 'Điện - Điều Hòa',
        'detailing'  => 'Chăm Sóc Xe & Detailing',
        'bao-hiem'   => 'Cứu Hộ & Bảo Hiểm'
    );

    $term_ids = array();
    foreach ($categories as $slug => $name) {
        $term = term_exists($slug, 'service_category');
        if (!$term) {
            $created = wp_insert_term($name, 'service_category', array('slug' => $slug));
            if (!is_wp_error($created)) {
                $term_ids[$slug] = $created['term_id'];
            }
        } else {
            $term_ids[$slug] = is_array($term) ? $term['term_id'] : $term;
        }
    }

    // 2. Sample Services list
    $services = array(
        array(
            'title'     => 'Đồng Sơn Ô Tô & Phục Hồi Xe Tai Nạn Công Nghệ Cao',
            'category'  => 'dong-son',
            'badge'     => 'THẾ MẠNH SỐ 1',
            'price'     => 'từ 400.000 đ / chi tiết',
            'duration'  => 'Lấy ngay sau 4 - 8 tiếng',
            'warranty'  => 'Bảo hành 24 tháng',
            'features'  => "Hệ thống phòng sơn sấy khép kín tiêu chuẩn Ý\nSử dụng sơn Dupont, PPG cao cấp chuẩn mã màu zin 100%\nBảo hành bong tróc rộp sơn lên đến 2 năm\nMiễn phí đánh bóng toàn bộ xe sau khi sơn",
            'image'     => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&q=80',
            'content'   => 'Hiếu Gara tự hào sở hữu dây chuyền đồng sơn ô tô công nghệ cao với phòng sơn sấy tiêu chuẩn Châu Âu. Đội ngũ thợ gò hàn và pha sơn có trên 10 năm kinh nghiệm, khôi phục nguyên trạng form xe từ những vết móp xước nhỏ đến những xe bị tai nạn va chạm nặng. Cam kết không bay màu, bóng sâu và đồng đều với màu sơn gốc.'
        ),
        array(
            'title'     => 'Bảo Dưỡng Định Kỳ Đa Cấp 30 Hạng Mục An Toàn',
            'category'  => 'bao-duong',
            'badge'     => 'TIẾT KIỆM 30% SO VỚI HÃNG',
            'price'     => 'từ 650.000 đ / lần',
            'duration'  => '45 - 90 phút',
            'warranty'  => 'Bảo hành phụ tùng 12 tháng',
            'features'  => "Miễn phí kiểm tra 30 hạng mục an toàn gầm phanh\nThay dầu máy, lọc nhớt chính hãng Castrol / Mobil 1\nVệ sinh lọc gió động cơ, lọc gió điều hòa miễn phí\nKiểm tra ắc quy, nước làm mát, dầu phanh bằng máy đo chuyên dụng",
            'image'     => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=800&q=80',
            'content'   => 'Dịch vụ bảo dưỡng định kỳ các cấp (5.000km, 10.000km, 20.000km, 40.000km, 80.000km) theo đúng tiêu chuẩn khuyến nghị của nhà sản xuất Toyota, Hyundai, Kia, Honda, Mazda, Ford, Mercedes, BMW. Quy trình rõ ràng, minh bạch, kiểm tra xe trước - báo giá chi tiết - khách đồng ý mới làm.'
        ),
        array(
            'title'     => 'Chẩn Đoán & Sửa Chữa Động Cơ - Khung Gầm - Hộp Số',
            'category'  => 'may-gam',
            'badge'     => 'THỢ BẬC CAO',
            'price'     => 'Khảo sát báo giá miễn phí',
            'duration'  => '1 - 3 ngày tùy mức độ',
            'warranty'  => 'Bảo hành 12 tháng hoặc 20.000 km',
            'features'  => "Máy đọc lỗi chuyên sâu ECU quét sạch mã lỗi\nXử lý dứt điểm tiếng kêu lục cục dưới gầm xe\nĐại tu động cơ, hộp số tự động, hộp số CVT\nCăn chỉnh độ chụm góc đặt bánh xe điện tử",
            'image'     => 'https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?w=800&q=80',
            'content'   => 'Đội ngũ kỹ thuật viên máy gầm giàu kinh nghiệm xử lý dứt điểm các hiện tượng rung lắc, hao dầu máy, tiếng gõ động cơ hoặc tay lái bị lệch. Phụ tùng thay thế nguồn gốc rõ ràng, khách hàng được tận mắt kiểm tra phụ tùng cũ và phụ tùng mới trước khi lắp đặt.'
        ),
        array(
            'title'     => 'Bảo Dưỡng & Sửa Chữa Hệ Thống Điện - Điều Hòa Ô Tô',
            'category'  => 'dien-lanh',
            'badge'     => 'MÁT SÂU TỨC THÌ',
            'price'     => 'từ 350.000 đ',
            'duration'  => '1 - 2 tiếng',
            'warranty'  => 'Bảo hành lốc lạnh 12 tháng',
            'features'  => "Vệ sinh dàn lạnh nội soi không cần tháo taplo\nNạp gas lạnh tinh khiết R134a/R1234yf chuẩn áp suất\nXử lý triệt để mùi hôi chua trong khoang lái\nKiểm tra rò rỉ đường ống gas bằng máy dò chuyên dụng",
            'image'     => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80',
            'content'   => 'Khắc phục triệt để các bệnh điều hòa ô tô: đóng ngắt liên tục, chỉ có gió không có hơi mát, mùi hôi khó chịu hoặc xe chỉ mát khi chạy nhanh. Đo nhiệt độ cửa gió thực tế trước và sau khi làm để khách hàng kiểm chứng chất lượng mát sâu.'
        ),
        array(
            'title'     => 'Chăm Sóc Xe Detailing: Phủ Ceramic, Dán Phim & PPF',
            'category'  => 'detailing',
            'badge'     => 'LÀM ĐẸP TOÀN DIỆN',
            'price'     => 'từ 1.200.000 đ',
            'duration'  => 'Trong ngày',
            'warranty'  => 'Bảo hành bong tróc 5 - 10 năm',
            'features'  => "Phủ bóng Ceramic 9H siêu kháng nước và hóa chất\nDán phim cách nhiệt chính hãng 3M Crystalline, Inmax\nDán PPF bảo vệ chống xước hõm cửa, đèn pha, mặt ca-lăng\nDọn nội thất hơi nước nóng khử khuẩn 99%",
            'image'     => 'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?w=800&q=80',
            'content'   => 'Phòng Detailing chuyên biệt với hệ thống chiếu sáng chuẩn quốc tế, giúp phát hiện và xử lý từng vết xước xoáy trên thân xe. Sử dụng hóa chất chăm sóc xe cao cấp từ Sonax, Meguiar, 3M, đảm bảo khoang lái sạch sẽ và ngoại thất sáng bóng như xe mới rời showroom.'
        ),
        array(
            'title'     => 'Cứu Hộ Ô Tô 24/7 & Giám Định Bồi Thường Bảo Hiểm',
            'category'  => 'bao-hiem',
            'badge'     => 'HỖ TRỢ THỦ TỤC TRỌN GÓI',
            'price'     => 'Miễn phí thủ tục bảo hiểm',
            'duration'  => 'Hỗ trợ 24/7',
            'warranty'  => 'Cam kết bồi thường 100% quyền lợi',
            'features'  => "Xe cứu hộ sàn trượt có mặt sau 15 - 30 phút\nLiên kết hầu hết các hãng bảo hiểm: Bảo Việt, PVI, PTI, PJICO...\nHỗ trợ hồ sơ khai báo bảo hiểm thân vỏ từ A-Z\nKhách hàng không phải ứng tiền trước khi sửa chữa",
            'image'     => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=800&q=80',
            'content'   => 'Khi xe gặp sự cố va quẹt hoặc chết máy trên đường, chỉ cần gọi ngay hotline cứu hộ của Hiếu Gara. Chúng tôi điều xe kéo sàn trượt tới hỗ trợ kịp thời, đồng thời giám định viên sẽ hướng dẫn làm thủ tục hồ sơ bồi thường bảo hiểm thân vỏ nhanh gọn, không lo phiền hà giấy tờ.'
        )
    );

    foreach ($services as $srv) {
        $existing = get_page_by_title($srv['title'], OBJECT, 'garage_service');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $srv['title'],
                'post_content' => $srv['content'],
                'post_status'  => 'publish',
                'post_type'    => 'garage_service'
            ));

            if ($post_id && !is_wp_error($post_id)) {
                if (isset($term_ids[$srv['category']])) {
                    wp_set_object_terms($post_id, (int)$term_ids[$srv['category']], 'service_category');
                }

                update_post_meta($post_id, '_garage_price_from', $srv['price']);
                update_post_meta($post_id, '_garage_badge', $srv['badge']);
                update_post_meta($post_id, '_garage_duration', $srv['duration']);
                update_post_meta($post_id, '_garage_warranty', $srv['warranty']);
                update_post_meta($post_id, '_garage_features', $srv['features']);
            }
        }
    }

    update_option('hieugara_services_imported', 1);
}
add_action('after_switch_theme', 'hieugara_populate_sample_services');

