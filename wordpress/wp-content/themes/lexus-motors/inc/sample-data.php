<?php
/**
 * Auto-populate sample Lexus vehicle data upon theme activation
 *
 * @package Lexus_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function lexus_populate_sample_vehicles() {
    // Only run if flag is not set
    if (get_option('lexus_sample_data_imported')) {
        return;
    }

    // 1. Create Segments
    $segments = array(
        'sedan'       => 'Sedan',
        'suv'         => 'SUV',
        'electrified' => 'Hybrid & Xe Điện'
    );

    $term_ids = array();
    foreach ($segments as $slug => $name) {
        $term = term_exists($slug, 'vehicle_segment');
        if (!$term) {
            $created = wp_insert_term($name, 'vehicle_segment', array('slug' => $slug));
            if (!is_wp_error($created)) {
                $term_ids[$slug] = $created['term_id'];
            }
        } else {
            $term_ids[$slug] = is_array($term) ? $term['term_id'] : $term;
        }
    }

    // 2. Sample Lexus Vehicles
    $sample_cars = array(
        array(
            'title'        => 'Lexus RX 350 Luxury',
            'segment'      => 'suv',
            'badge'        => 'BÁN CHẠY NHẤT',
            'tagline'      => 'Đỉnh cao SUV hạng sang, biểu tượng của sự tiên phong',
            'price'        => '3430000000',
            'engine'       => '2.4L Turbo 4 xi-lanh thẳng hàng',
            'horsepower'   => '275 HP @ 6.000 rpm',
            'torque'       => '430 Nm @ 1.700 - 3.600 rpm',
            'acceleration' => '7.6 giây (0-100 km/h)',
            'transmission' => 'Tự động 8 cấp Direct-Shift',
            'fuel'         => '8.9L / 100km',
            'content'      => 'Lexus RX thế hệ mới sở hữu thiết kế hình con thoi không viền mang tính biểu tượng, khoang nội thất lấy cảm hứng từ triết lý Tazuna, hệ thống an toàn Lexus Safety System+ 3.0 tiên tiến nhất cùng khả năng vận hành hứng khởi đầy phấn khích.',
            'colors'       => "Trắng Sonic Quartz | #f5f5f7 | https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=900&q=80\nĐen Sonic Agate | #111111 | https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&q=80\nXám Sonic Chrome | #4a4a4a | https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900&q=80\nĐỏ Red Mica | #8b0000 | https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=900&q=80"
        ),
        array(
            'title'        => 'Lexus ES 250 F SPORT',
            'segment'      => 'sedan',
            'badge'        => 'THỂ THAO & SANG TRỌNG',
            'tagline'      => 'Sedan hạng sang lịch lãm với tinh thần thể thao bứt phá',
            'price'        => '2710000000',
            'engine'       => '2.5L 4 xi-lanh thẳng hàng DOHC Dual VVT-i',
            'horsepower'   => '204 HP @ 6.600 rpm',
            'torque'       => '243 Nm @ 4.000 - 5.000 rpm',
            'acceleration' => '8.9 giây (0-100 km/h)',
            'transmission' => 'Tự động 8 cấp Direct-Shift',
            'fuel'         => '7.1L / 100km',
            'content'      => 'Lexus ES kết hợp hài hòa giữa sự êm ái cách âm tuyệt đối và phong cách thể thao F SPORT đặc trưng với lưới tản nhiệt hình con thoi dạng lưới tổ ong, la-zăng 19 inch đa chấu màu đen mờ và ghế thể thao ôm sát.',
            'colors'       => "Trắng White Nova | #ffffff | https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900&q=80\nĐen Sonic Black | #0d0d0d | https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&q=80\nXanh Heat Blue | #003366 | https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=900&q=80"
        ),
        array(
            'title'        => 'Lexus LX 600 VIP',
            'segment'      => 'suv',
            'badge'        => 'CHUYÊN CƠ MẶT ĐẤT',
            'tagline'      => 'Uy quyền tối thượng, vị thế dẫn đầu phân khúc SUV cỡ lớn',
            'price'        => '9210000000',
            'engine'       => '3.5L V6 Tăng áp kép (Twin-Turbo)',
            'horsepower'   => '409 HP @ 5.200 rpm',
            'torque'       => '650 Nm @ 2.000 - 3.600 rpm',
            'acceleration' => '6.9 giây (0-100 km/h)',
            'transmission' => 'Tự động 10 cấp Direct-Shift',
            'fuel'         => '12.1L / 100km',
            'content'      => 'Lexus LX 600 VIP là mẫu SUV đầu bảng với cấu hình 4 chỗ độc bản dành cho thương gia. Hàng ghế sau thương gia ngả tới 48 độ với tính năng massage Ottoman, màn hình giải trí độc lập và hệ thống âm thanh vòm 25 loa Mark Levinson đỉnh cao.',
            'colors'       => "Đen Sonic Agate | #111111 | https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&q=80\nTrắng Sonic Quartz | #f4f4f6 | https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=900&q=80\nBạc Manganese Luster | #71717a | https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900&q=80"
        ),
        array(
            'title'        => 'Lexus NX 350h Electrified',
            'segment'      => 'electrified',
            'badge'        => 'HYBRID TIÊN PHONG',
            'tagline'      => 'SUV đô thị năng động với hệ truyền động Hybrid tự sạc thông minh',
            'price'        => '3130000000',
            'engine'       => '2.5L Hybrid (Xăng kết hợp Mô-tơ điện tự sạc)',
            'horsepower'   => '240 HP tổng công suất',
            'torque'       => '270 Nm (động cơ) + 391 Nm (mô-tơ điện)',
            'acceleration' => '7.7 giây (0-100 km/h)',
            'transmission' => 'Hộp số vô cấp E-CVT điều khiển điện tử',
            'fuel'         => '5.6L / 100km',
            'content'      => 'Lexus NX 350h đại diện cho kỷ nguyên điện hóa của Lexus. Khả năng vận hành êm ái tĩnh lặng tuyệt đối ở dải tốc độ thấp kết hợp mức tiêu thụ nhiên liệu ấn tượng chỉ 5.6 lít / 100km, mang lại trải nghiệm lái xe tinh tế và thân thiện với môi trường.',
            'colors'       => "Xanh Terrane Khaki | #2d382e | https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=900&q=80\nTrắng Sonic Quartz | #ffffff | https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900&q=80\nXám Sonic Titanium | #6b7280 | https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&q=80"
        ),
        array(
            'title'        => 'Lexus LS 500h Flagship',
            'segment'      => 'sedan',
            'badge'        => 'KIỆT TÁC THỦ CÔNG',
            'tagline'      => 'Sedan đầu bảng hội tụ tinh hoa chế tác thủ công Takumi',
            'price'        => '8360000000',
            'engine'       => 'Multi-Stage Hybrid 3.5L V6 Dual VVT-i',
            'horsepower'   => '354 HP tổng công suất',
            'torque'       => '350 Nm @ 5.100 rpm',
            'acceleration' => '5.4 giây (0-100 km/h)',
            'transmission' => 'Multi-Stage Hybrid (kết hợp 4 cấp và CVT)',
            'fuel'         => '6.7L / 100km',
            'content'      => 'Lexus LS 500h là biểu tượng tối thượng của dòng sedan hạng sang Nhật Bản. Ốp cửa bằng kính Kiriko cắt thủ công và nếp gấp lụa Origami tạo nên không gian nghệ thuật độc nhất vô nhị trên thế giới.',
            'colors'       => "Đen Graphite Black | #0a0a0a | https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=900&q=80\nBạc Sonic Silver | #9ca3af | https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=900&q=80\nĐỏ Deep Red Mica | #581845 | https://images.unsplash.com/photo-1511919884226-fd3cad34687c?w=900&q=80"
        )
    );

    foreach ($sample_cars as $car) {
        $existing = get_page_by_title($car['title'], OBJECT, 'lexus_vehicle');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $car['title'],
                'post_content' => $car['content'],
                'post_status'  => 'publish',
                'post_type'    => 'lexus_vehicle'
            ));

            if ($post_id && !is_wp_error($post_id)) {
                // Assign taxonomy
                if (isset($term_ids[$car['segment']])) {
                    wp_set_object_terms($post_id, (int)$term_ids[$car['segment']], 'vehicle_segment');
                }

                // Update meta
                update_post_meta($post_id, '_lexus_price', $car['price']);
                update_post_meta($post_id, '_lexus_badge', $car['badge']);
                update_post_meta($post_id, '_lexus_tagline', $car['tagline']);
                update_post_meta($post_id, '_lexus_engine', $car['engine']);
                update_post_meta($post_id, '_lexus_horsepower', $car['horsepower']);
                update_post_meta($post_id, '_lexus_torque', $car['torque']);
                update_post_meta($post_id, '_lexus_acceleration', $car['acceleration']);
                update_post_meta($post_id, '_lexus_transmission', $car['transmission']);
                update_post_meta($post_id, '_lexus_fuel_economy', $car['fuel']);
                update_post_meta($post_id, '_lexus_colors_data', $car['colors']);
                update_post_meta($post_id, '_lexus_brochure_url', '#');
            }
        }
    }

    update_option('lexus_sample_data_imported', 1);
}
add_action('after_switch_theme', 'lexus_populate_sample_vehicles');

