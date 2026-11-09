<?php
/**
 * Sample Accessories Data & Seeder for Ôtô Hải Hà
 * Genuine Accessories Catalog Division - Ôtô Hải Hà Workshop
 * Native 'garage_accessory' Post Type - 100% Internal URLs & Full Admin CRUD
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return 7 Core Accessory Categories with metadata (Dynamic from DB with fallback)
 */
function hieugara_get_accessories_categories() {
    $defaults = array(
        'man-hinh-va-giai-tri' => array(
            'id'          => 'man-hinh-va-giai-tri',
            'name'        => 'Màn hình và giải trí',
            'short_name'  => 'Màn Hình & Giải Trí',
            'icon'        => 'fa-solid fa-tv',
            'index_num'   => '01',
            'eyebrow'     => 'CÔNG NGHỆ THÔNG MINH TRÊN XE',
            'desc'        => 'Màn hình Android sắc nét, Android box biến màn zin thành thông minh, kết nối Apple CarPlay không dây tiện lợi.'
        ),
        'camera-o-to' => array(
            'id'          => 'camera-o-to',
            'name'        => 'Camera',
            'short_name'  => 'Camera Ô Tô',
            'icon'        => 'fa-solid fa-video',
            'index_num'   => '02',
            'eyebrow'     => 'QUAN SÁT & GHI HÌNH TOÀN DIỆN',
            'desc'        => 'Camera hành trình 4K sắc nét, hệ thống camera 360 độ toàn cảnh không góc chết và camera lùi AHD ban đêm chống nước IP68.'
        ),
        'an-toan-o-to' => array(
            'id'          => 'an-toan-o-to',
            'name'        => 'An toàn',
            'short_name'  => 'Hệ Thống An Toàn',
            'icon'        => 'fa-solid fa-shield-halved',
            'index_num'   => '03',
            'eyebrow'     => 'BẢO VỆ CHỦ ĐỘNG & CẢNH BÁO',
            'desc'        => 'Cảm biến áp suất lốp TPMS năng lượng mặt trời, cảm biến lùi, cảnh báo điểm mù radar và màn hình hiển thị HUD kính lái.'
        ),
        'phim-va-bao-ve-son' => array(
            'id'          => 'phim-va-bao-ve-son',
            'name'        => 'Phim và bảo vệ sơn',
            'short_name'  => 'Phim & Bảo Vệ Sơn',
            'icon'        => 'fa-solid fa-sun',
            'index_num'   => '04',
            'eyebrow'     => 'CÁCH NHIỆT & BẢO VỆ NƯỚC SƠN',
            'desc'        => 'Dán phim cách nhiệt 3M Crystalline chính hãng chống nóng cách nhiệt 99% UV và dán phim bảo vệ sơn PPF TPU tự phục hồi vết xước.'
        ),
        'noi-that-o-to' => array(
            'id'          => 'noi-that-o-to',
            'name'        => 'Nội thất',
            'short_name'  => 'Nội Thất Ô Tô',
            'icon'        => 'fa-solid fa-couch',
            'index_num'   => '05',
            'eyebrow'     => 'NÂNG TẦM KHÔNG GIAN XE',
            'desc'        => 'Bọc ghế da Nappa cao cấp chuẩn form may xưởng Hải Hà, thảm sàn tràn viền TPE, bọc vô lăng thể thao và đèn LED viền nội thất.'
        ),
        'ngoai-that-va-den' => array(
            'id'          => 'ngoai-that-va-den',
            'name'        => 'Ngoại thất và đèn',
            'short_name'  => 'Ngoại Thất & Đèn',
            'icon'        => 'fa-solid fa-lightbulb',
            'index_num'   => '06',
            'eyebrow'     => 'ÁNH SÁNG & TIỆN NGHI NGOẠI THẤT',
            'desc'        => 'Nâng cấp Bi LED siêu sáng, độ cốp điện tự động thông minh kèm cảm biến đá cốp và bạt phủ ô tô cách nhiệt 3 lớp.'
        ),
        'tien-ich-o-to' => array(
            'id'          => 'tien-ich-o-to',
            'name'        => 'Tiện ích',
            'short_name'  => 'Tiện Ích Ô Tô',
            'icon'        => 'fa-solid fa-toolbox',
            'index_num'   => '07',
            'eyebrow'     => 'TIỆN NGHI TIÊU CHUẨN MỌI HÀNH TRÌNH',
            'desc'        => 'Máy bơm lốp điện tử tự ngắt Michelin, tẩu sạc nhanh 65W công suất cao, giá đỡ điện thoại hít MagSafe và máy lọc không khí ô tô.'
        ),
    );

    $terms = get_terms(array(
        'taxonomy'   => 'accessory_category',
        'hide_empty' => false,
        'parent'     => 0,
        'orderby'    => 'term_order',
        'order'      => 'ASC',
    ));

    if (!empty($terms) && !is_wp_error($terms)) {
        $categories = array();
        $idx = 1;
        foreach ($terms as $t) {
            $slug = $t->slug;
            if ($slug === 'phu-kien-vinfast' || strpos($slug, 'vinfast') !== false) {
                continue;
            }
            $cat_data = isset($defaults[$slug]) ? $defaults[$slug] : array();

            $icon = get_term_meta($t->term_id, '_accessory_cat_icon', true);
            if (!$icon) {
                $icon = !empty($cat_data['icon']) ? $cat_data['icon'] : 'fa-solid fa-car';
            }

            $eyebrow = get_term_meta($t->term_id, '_accessory_cat_eyebrow', true);
            if (!$eyebrow) {
                $eyebrow = !empty($cat_data['eyebrow']) ? $cat_data['eyebrow'] : 'PHỤ KIỆN CHÍNH HÃNG HẢI HÀ';
            }

            $desc = $t->description;
            if (empty($desc) && !empty($cat_data['desc'])) {
                $desc = $cat_data['desc'];
            }

            // Get child categories
            $children_terms = get_terms(array(
                'taxonomy'   => 'accessory_category',
                'hide_empty' => false,
                'parent'     => $t->term_id,
                'orderby'    => 'term_order',
                'order'      => 'ASC',
            ));
            $children = array();
            if (!empty($children_terms) && !is_wp_error($children_terms)) {
                foreach ($children_terms as $ct) {
                    $children[] = array(
                        'id'      => $ct->slug,
                        'slug'    => $ct->slug,
                        'term_id' => $ct->term_id,
                        'name'    => $ct->name,
                        'count'   => $ct->count,
                    );
                }
            }

            $categories[$slug] = array(
                'id'         => $slug,
                'term_id'    => $t->term_id,
                'name'       => $t->name,
                'short_name' => $t->name,
                'icon'       => $icon,
                'index_num'  => sprintf('%02d', $idx++),
                'eyebrow'    => $eyebrow,
                'desc'       => $desc,
                'children'   => $children,
            );
        }
        return $categories;
    }

    return $defaults;
}

/**
 * Returns complete definition of the 23 curated genuine accessories
 */
function hieugara_get_accessories_definitions() {
    $img_uri = get_template_directory_uri() . '/assets/images/accessories';

    return array(
        // -------------------------------------------------------------
        // 1. Màn hình và giải trí (man-hinh-va-giai-tri)
        // -------------------------------------------------------------
        array(
            'slug'        => 'man-hinh-android-zestech-z800-pro-plus',
            'title'       => 'Màn hình Android Zestech Z800 Pro+ 360 cao cấp',
            'category'    => 'man-hinh-va-giai-tri',
            'cat_name'    => 'Màn hình và giải trí',
            'price'       => '15.500.000',
            'old_price'   => '17.000.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Zestech',
            'warranty'    => '24 tháng 1 đổi 1',
            'origin'      => 'Chính hãng Zestech Việt Nam & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/zestech-z500.jpg',
            'excerpt'     => 'Màn hình Android Zestech Z800 Pro+ cấu hình khủng RAM 6GB, ROM 128GB tích hợp Camera 360 ghi hình tắt máy, ra lệnh giọng nói tiếng Việt Kiki.',
            'specs'       => "Màn hình: 9 - 10 inch IPS 2K chống chói
Hệ điều hành: Android 10.0
RAM / ROM: 6GB / 128GB
Chip xử lý: Octa-core UIS7862 8 nhân 1.8GHz
Tích hợp: Camera 360 toàn cảnh ghi hình 4 góc, Vietmap Live, Kiki AI",
            'content'     => '<h3>Tổng quan sản phẩm Màn hình Android Zestech Z800 Pro+ 360</h3>
<p><strong>Màn hình Android Zestech Z800 Pro+ 360</strong> là dòng màn hình ô tô thông minh cao cấp hàng đầu hiện nay, tích hợp liền camera 360 độ siêu nét giúp người lái vừa giải trí đa phương tiện đỉnh cao vừa quan sát toàn cảnh an toàn tối ưu.</p>
<h3>Ưu điểm vượt trội:</h3>
<ul>
    <li><strong>Cấu hình cực mạnh:</strong> Chip 8 nhân UIS7862 cùng RAM 6GB và bộ nhớ trong 128GB cho trải nghiệm mượt mà không độ trễ.</li>
    <li><strong>Camera 360 toàn cảnh:</strong> 4 mắt camera Sony ghi hình đồng thời 4 hướng ngay cả khi tắt máy, giám sát đỗ xe thông minh.</li>
    <li><strong>Dẫn đường thông minh:</strong> Tích hợp Vietmap Live bản quyền cảnh báo tốc độ, camera phạt nguội và mật độ giao thông theo thời gian thực.</li>
    <li><strong>Ra lệnh giọng nói:</strong> Trợ lý ảo Kiki nghe hiểu giọng nói 3 miền Bắc - Trung - Nam chuẩn xác.</li>
</ul>
<h3>Chính sách lắp đặt tại Ôtô Hải Hà:</h3>
<p>Lắp đặt giắc zin 100% không cắt nối dây điện nguyên bản của xe, bảo hành chính hãng 2 năm 1 đổi 1, tặng kèm sim 4G tốc độ cao và thẻ nhớ chuyên dụng.</p>',
        ),

        array(
            'slug'        => 'android-box-zestech-dx265-pro',
            'title'       => 'Android Box Zestech DX265 Pro thông minh',
            'category'    => 'man-hinh-va-giai-tri',
            'cat_name'    => 'Màn hình và giải trí',
            'price'       => '7.500.000',
            'old_price'   => '8.500.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Zestech',
            'warranty'    => '24 tháng 1 đổi 1',
            'origin'      => 'Chính hãng Zestech & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/elliview-s4.jpg',
            'excerpt'     => 'Biến màn hình zin theo xe thành màn hình Android thông minh chỉ bằng 1 thao tác cắm cổng USB, giữ nguyên 100% âm thanh và tính năng gốc.',
            'specs'       => "Kết nối: Cắm giắc Type-C / USB zin theo xe 100%
RAM / ROM: 4GB / 64GB
Chip xử lý: Qualcomm Snapdragon 6125 8 nhân
Bản đồ: Vietmap S2 bản quyền trọn đời, Google Maps
Hỗ trợ: Giữ nguyên màn hình zin và toàn bộ tính năng gốc của xe",
            'content'     => '<h3>Biến màn hình zin thành màn Android thông minh chỉ trong 5 giây</h3>
<p><strong>Android Box Zestech DX265 Pro</strong> là giải pháp hoàn hảo cho chủ xe muốn giữ nguyên màn hình và hệ thống âm thanh nguyên bản nhưng vẫn muốn trải nghiệm các tính năng Android hiện đại: xem Youtube không quảng cáo, dẫn đường Vietmap, ra lệnh giọng nói Kiki.</p>
<h3>Tính năng nổi bật:</h3>
<ul>
    <li>Cắm giắc USB/Type-C là nhận ngay, không tháo lắp đục khoét bất kỳ chi tiết nào.</li>
    <li>Chip Qualcomm Snapdragon vận hành mượt mà, tối ưu nhiệt lượng khi hoạt động liên tục.</li>
    <li>Hỗ trợ định vị quản lý xe từ xa qua điện thoại thông minh.</li>
</ul>',
        ),

        array(
            'slug'        => 'bo-chuyen-doi-carplay-khong-day-zestech',
            'title'       => 'Bộ chuyển đổi Apple CarPlay không dây Zestech & Android Auto',
            'category'    => 'man-hinh-va-giai-tri',
            'cat_name'    => 'Màn hình và giải trí',
            'price'       => '1.850.000',
            'old_price'   => '2.200.000',
            'badge'       => 'TIỆN ÍCH',
            'brand'       => 'Zestech',
            'warranty'    => '12 tháng 1 đổi 1',
            'origin'      => 'Phân phối chính hãng Zestech & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/baseus-tau-sac.jpg',
            'excerpt'     => 'Giải pháp kết nối Apple CarPlay và Android Auto không dây tiện lợi, tạm biệt dây cáp rườm rà, tự động kết nối khi vừa bước lên xe.',
            'specs'       => "Chuẩn kết nối: Bluetooth 5.0 & Wi-Fi Dual Band 5.8GHz
Tương thích: iPhone iOS 10+ và Android 11+
Tốc độ kết nối: Tự động kết nối trong vòng 5 giây khi lên xe
Độ trễ: Cực thấp dưới 0.1s, âm thanh chuẩn Lossless",
            'content'     => '<h3>Tạm biệt dây cáp vướng víu trên xe hơi</h3>
<p><strong>Bộ chuyển đổi CarPlay không dây</strong> giúp bạn tận hưởng trọn vẹn sự tiện lợi: điện thoại vẫn để trong túi quần hoặc túi xách, khi bước lên xe hệ thống sẽ tự động ghép nối và hiển thị giao diện CarPlay lên màn hình trung tâm.</p>
<p>Tương thích với hầu hết các dòng xe đã có sẵn tính năng Apple CarPlay hoặc Android Auto có dây của Toyota, Hyundai, Kia, Mazda, Ford, Honda, Mercedes-Benz, BMW.</p>',
        ),

        // -------------------------------------------------------------
        // 2. Camera (camera-o-to)
        // -------------------------------------------------------------
        array(
            'slug'        => 'camera-hanh-trinh-70mai-a810-4k',
            'title'       => 'Camera hành trình 70mai A810 4K HDR Sony Starvis 2',
            'category'    => 'camera-o-to',
            'cat_name'    => 'Camera',
            'price'       => '4.690.000',
            'old_price'   => '5.200.000',
            'badge'       => '4K SẮC NÉT',
            'brand'       => '70mai (Xiaomi Ecosystem)',
            'warranty'    => '12 tháng 1 đổi 1',
            'origin'      => 'Chính hãng 70mai & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/vietmap-c61-pro.jpg',
            'excerpt'     => 'Dòng camera hành trình 4K flagship với cảm biến Sony Starvis 2 ghi hình ban đêm siêu sáng rõ biển số xe, tích hợp GPS và hỗ trợ ADAS cảnh báo va chạm.',
            'specs'       => "Độ phân giải: 4K UHD 3840 x 2160P HDR
Cảm biến hình ảnh: Sony Starvis 2 IMX678 thế hệ mới
Góc quay: 150 độ F1.8 bắt trọn làn đường
Tính năng: Cảnh báo ADAS lái xe an toàn, GPS tích hợp, giám sát đỗ xe 24/24",
            'content'     => '<h3>Flagship camera hành trình 4K đỉnh cao từ 70mai</h3>
<p><strong>70mai A810 4K HDR</strong> trang bị cảm biến Sony Starvis 2 IMX678 đột phá, cung cấp dải tương phản động rộng gấp đôi thế hệ trước. Ngay cả khi di chuyển qua các cung đường hầm tối hoặc ban đêm có đèn pha chiếu ngược, biển số xe phía trước vẫn hiển thị rõ nét.</p>
<ul>
    <li>Ghi hình đồng thời 2 kênh trước và sau sắc nét.</li>
    <li>Tích hợp GPS ghi lại tọa độ và tốc độ di chuyển chính xác trên từng khung hình.</li>
    <li>Cảnh báo thông minh ADAS: cảnh báo lệch làn, xe phía trước khởi hành, nguy cơ va chạm.</li>
</ul>',
        ),

        array(
            'slug'        => 'he-thong-camera-360-do-safeview-3d-ld900',
            'title'       => 'Hệ thống Camera 360 độ Safeview 3D LD900 toàn cảnh',
            'category'    => 'camera-o-to',
            'cat_name'    => 'Camera',
            'price'       => '12.500.000',
            'old_price'   => '14.000.000',
            'badge'       => 'TOÀN CẢNH 3D',
            'brand'       => 'Safeview',
            'warranty'    => '24 tháng chính hãng',
            'origin'      => 'Chính hãng Safeview & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/vietmap-c62s.jpg',
            'excerpt'     => 'Loại bỏ hoàn toàn điểm mù quanh xe với 28 góc quan sát 3D sắc nét, tự động kích hoạt khi bật xi-nhan hoặc về số lùi.',
            'specs'       => "Mắt camera: 4 mắt Sony Starvis chuẩn chống nước IP68
Góc nhìn: 28 góc nhìn 2D & 3D siêu rộng không góc chết
Mô phỏng: Mô hình xe 3D chuẩn xác theo từng dòng xe
Tính năng: Tự động mở camera khi xi nhan, lùi xe, ghi hình hành trình 4 hướng",
            'content'     => '<h3>Công nghệ quan sát toàn cảnh 360 độ dẫn đầu phân khúc</h3>
<p><strong>Safeview 3D LD900</strong> sở hữu chip vi xử lý hình ảnh độc quyền với khả năng mô phỏng xe 3D chân thực, hiển thị chính xác vạch đánh lái theo vô lăng giúp lái xe tự tin luồn lách qua ngõ hẹp và lùi chuồng an toàn.</p>
<p>Tại Hải Hà Workshop, kỹ thuật viên tiến hành căn bạt cân chỉnh tự động theo tiêu chuẩn nhà sản xuất, đảm bảo hình ảnh ghép nối phẳng tuyệt đối không cong vênh.</p>',
        ),

        array(
            'slug'        => 'camera-lui-ahd-goc-rong-chong-nuoc',
            'title'       => 'Camera lùi AHD góc rộng ban đêm Full HD chống nước IP68',
            'category'    => 'camera-o-to',
            'cat_name'    => 'Camera',
            'price'       => '850.000',
            'old_price'   => '1.100.000',
            'badge'       => 'TIÊU CHUẨN',
            'brand'       => 'AHD Japan Tech',
            'warranty'    => '12 tháng',
            'origin'      => 'Chính hãng OEM & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/vietmap-c65.jpg',
            'excerpt'     => 'Camera lùi công nghệ AHD 1080P sắc nét chống lóa ban đêm, góc quay 170 độ căn chỉnh lùi xe an toàn tuyệt đối.',
            'specs'       => "Độ phân giải: AHD 1080P Full HD
Góc nhìn: Góc rộng 170 độ chuẩn Fisheye
Cảm biến: Chip nhạy sáng Starlight ghi hình rõ nét ban đêm
Chống nước: Chuẩn IP68 ngâm nước không lo mờ đục",
            'content'     => '<h3>Căn chỉnh lùi xe an toàn tuyệt đối mọi điều kiện thời tiết</h3>
<p>Trang bị chip cảm biến Starlight nhạy sáng cao giúp hình ảnh lùi ban đêm sáng rõ như ban ngày. Thân vỏ hợp kim kẽm mạ crôm chống gỉ sét, đạt tiêu chuẩn chống nước IP68 kháng mưa bão và xịt rửa xe áp lực cao.</p>',
        ),

        // -------------------------------------------------------------
        // 3. An toàn (an-toan-o-to)
        // -------------------------------------------------------------
        array(
            'slug'        => 'cam-bien-ap-suat-lop-tpms-steelmate',
            'title'       => 'Cảm biến áp suất lốp Steelmate van trong màn hình Solar',
            'category'    => 'an-toan-o-to',
            'cat_name'    => 'An toàn',
            'price'       => '2.450.000',
            'old_price'   => '2.800.000',
            'badge'       => 'AN TOÀN HÀNG ĐẦU',
            'brand'       => 'Steelmate',
            'warranty'    => '36 tháng đổi mới',
            'origin'      => 'Chính hãng Steelmate & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/steelmate-tpms.jpg',
            'excerpt'     => 'Thiết bị an toàn sống còn cho xe ô tô, cảnh báo tức thì bằng âm thanh và đèn khi lốp bị dính đinh hoặc quá nhiệt.',
            'specs'       => "Loại van: Van trong chống trộm, tuổi thọ pin van 5 năm
Màn hình: LCD Solar sạc bằng năng lượng mặt trời
Cảnh báo: Áp suất cao/thấp, rò rỉ hơi nhanh, nhiệt độ lốp bất thường
Độ chính xác: Sai số ± 0.1 Bar",
            'content'     => '<h3>Bảo vệ lốp xe và an toàn tính mạng trên mọi nẻo đường</h3>
<p><strong>Cảm biến áp suất lốp Steelmate TPMS</strong> giám sát liên tục 4 bánh xe theo thời gian thực. Khi lốp bị cán đinh hoặc tụt áp suất đột ngột, màn hình taplo sẽ lập tức phát tiếng chuông cảnh báo to rõ.</p>
<p>Gói lắp đặt tại Ôtô Hải Hà bao gồm: tháo lốp, vào van trong, cân bằng động bánh xe bằng máy laser chuyên dụng.</p>',
        ),

        array(
            'slug'        => 'bo-cam-bien-lui-4-mat-steelmate',
            'title'       => 'Bộ cảm biến lùi 4 mắt Steelmate cảnh báo âm thanh và khoảng cách',
            'category'    => 'an-toan-o-to',
            'cat_name'    => 'An toàn',
            'price'       => '1.350.000',
            'old_price'   => '1.650.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Steelmate',
            'warranty'    => '24 tháng',
            'origin'      => 'Chính hãng Steelmate & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/ellisafe-j3.jpg',
            'excerpt'     => 'Hỗ trợ người lái phát hiện chướng ngại vật phía sau xe, chống va quẹt va chạm khi lùi chuồng hẹp.',
            'specs'       => "Mắt cảm biến: 4 mắt sóng siêu âm độ nhạy cao
Phạm vi quét: 0.3m đến 2.5m
Cảnh báo: Màn hình LED hiển thị khoảng cách và tiếng bíp theo từng mức
Lắp đặt: Sơn đồng màu theo màu sơn zin của xe",
            'content'     => '<h3>Trợ thủ đắc lực chống trầy xước cản sau khi lùi xe</h3>
<p>Bộ 4 mắt cảm biến siêu âm Steelmate được khoan và gắn tỉ mỉ vào cản sau xe, sơn tĩnh điện đúng màu sơn nguyên bản, mang lại tính thẩm mỹ nguyên bản như xe xuất xưởng từ nhà máy.</p>',
        ),

        array(
            'slug'        => 'he-thong-canh-bao-diem-mu-radar-bsm',
            'title'       => 'Hệ thống cảnh báo điểm mù Radar BSM BSM-01 chính hãng',
            'category'    => 'an-toan-o-to',
            'cat_name'    => 'An toàn',
            'price'       => '6.800.000',
            'old_price'   => '7.500.000',
            'badge'       => 'AN TOÀN CAO CẤP',
            'brand'       => 'BSM Radar Tech',
            'warranty'    => '24 tháng 1 đổi 1',
            'origin'      => 'Chính hãng BSM & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/ellisafe-i5.jpg',
            'excerpt'     => 'Công nghệ radar bước sóng milimet cảnh báo điểm mù trên mặt gương chiếu hậu, phòng ngừa va chạm nguy hiểm khi chuyển làn tốc độ cao.',
            'specs'       => "Tần số sóng: Radar bước sóng Milimet 24GHz / 77GHz
Khoảng cách phát hiện: Lên tới 30m trong mọi thời tiết mưa gió sương mù
Cảnh báo: Đèn LED trên gương chiếu hậu và âm thanh bip cảnh báo
Tính năng: Cảnh báo chuyển làn (LCA), Cảnh báo phương tiện cắt ngang khi lùi (RCTA)",
            'content'     => '<h3>Tính năng an toàn chủ động trang bị trên xe hạng sang</h3>
<p>Điểm mù là nguyên nhân hàng đầu gây ra các vụ va chạm khi chuyển làn trên cao tốc. Hệ thống cảnh báo điểm mù Radar BSM hoạt động bằng sóng radar xuyên thấu qua cản nhựa, không bị ảnh hưởng bởi mưa rào, sương mù hay bụi bẩn.</p>',
        ),

        array(
            'slug'        => 'man-hinh-hien-thi-kinh-lai-hud-vietmap-h1n',
            'title'       => 'Màn hình hiển thị kính lái HUD Vietmap H1N cảnh báo tốc độ',
            'category'    => 'an-toan-o-to',
            'cat_name'    => 'An toàn',
            'price'       => '2.690.000',
            'old_price'   => '3.000.000',
            'badge'       => 'CÔNG NGHỆ HUD',
            'brand'       => 'Vietmap',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Chính hãng Vietmap & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/vietmap-c61-pro.jpg',
            'excerpt'     => 'Hiển thị thông số tốc độ và cảnh báo biển báo giao thông trực tiếp trên tầm nhìn lái xe, giúp tài xế không cần cúi đầu nhìn đồng hồ taplo.',
            'specs'       => "Hiển thị: Tốc độ hiện tại, giới hạn tốc độ cung đường, camera phạt nguội
Dữ liệu giao thông: Cập nhật toàn quốc từ Vietmap Live
Kết nối: Cổng OBDII và GPS độc lập
Màn hình: Kính phản chiếu quang học không gây chói mắt ban đêm",
            'content'     => '<h3>Lái xe đúng luật, an toàn và phong cách như phi công tiêm kích</h3>
<p><strong>Vietmap H1N</strong> đồng bộ dữ liệu giao thông toàn quốc, phát cảnh báo bằng giọng nói tiếng Việt khi xe vượt quá tốc độ cho phép, sắp tới khu vực có camera phạt nguội hay trạm thu phí.</p>',
        ),

        // -------------------------------------------------------------
        // 4. Phim và bảo vệ sơn (phim-va-bao-ve-son)
        // -------------------------------------------------------------
        array(
            'slug'        => 'dan-phim-cach-nhiet-3m-crystalline-chinh-hang',
            'title'       => 'Dán phim cách nhiệt 3M Crystalline chính hãng Mỹ gói toàn xe',
            'category'    => 'phim-va-bao-ve-son',
            'cat_name'    => 'Phim và bảo vệ sơn',
            'price'       => '14.800.000',
            'old_price'   => '16.500.000',
            'badge'       => 'DÒNG CAO CẤP',
            'brand'       => '3M USA',
            'warranty'    => '10 năm điện tử chính hãng 3M',
            'origin'      => 'Nhập khẩu 3M Hoa Kỳ & Thi công tại Hải Hà',
            'img'         => $img_uri . '/bat-phu-oto.jpg',
            'excerpt'     => 'Đỉnh cao phim cách nhiệt quang học 200 lớp từ 3M Mỹ, cách nhiệt vượt trội, bảo vệ sức khỏe và chống chói lóa tối ưu.',
            'specs'       => "Công nghệ: 200 lớp quang học Nano đa lớp không chứa kim loại
Chống tia hồng ngoại (IR): 97% - 99%
Chống tia cực tím (UV): 99.9% SPF 1000+
Không cản sóng: 100% không ảnh hưởng sóng điện thoại, GPS, VETC/ePass",
            'content'     => '<h3>Chuẩn mực phim cách nhiệt cao cấp hàng đầu thế giới</h3>
<p>Phim cách nhiệt <strong>3M Crystalline</strong> ứng dụng công nghệ đa lớp độc quyền với 200 lớp quang học mỏng hơn 1 sợi tóc. Khả năng loại bỏ 97% tia hồng ngoại sinh nhiệt, giữ cho khoang lái luôn mát mẻ và giảm tải tối đa cho hệ thống điều hòa ô tô.</p>
<p>Thi công trong phòng lạnh đạt chuẩn tại xưởng Ôtô Hải Hà, cấp mã bảo hành điện tử chính hãng 3M toàn cầu 10 năm.</p>',
        ),

        array(
            'slug'        => 'dan-phim-bao-ve-son-ppf-tpu-tu-phuc-hoi',
            'title'       => 'Dán phim bảo vệ sơn PPF TPU cao cấp tự phục hồi vết xước',
            'category'    => 'phim-va-bao-ve-son',
            'cat_name'    => 'Phim và bảo vệ sơn',
            'price'       => '28.000.000',
            'old_price'   => '32.000.000',
            'badge'       => 'BẢO VỆ NƯỚC SƠN',
            'brand'       => 'TeckWrap / SunTek USA',
            'warranty'    => '05 năm không ố vàng',
            'origin'      => 'Chính hãng TPU USA & Thi công tại Hải Hà',
            'img'         => $img_uri . '/bat-phu-oto.jpg',
            'excerpt'     => 'Lớp áo giáp vô hình bảo vệ toàn diện nước sơn zin đắt giá khỏi đá văng, xước quẹt và tác động thời tiết khắc nghiệt.',
            'specs'       => "Chất liệu: 100% TPU (Thermoplastic Polyurethane) đàn hồi cao
Độ dày: 7.5 - 8.5 Mil
Khả năng tự phục hồi: Tự lành vết xước răm dưới tác động của nhiệt độ
Đặc tính: Tăng 30% độ bóng cho sơn xe, chống ố nước mưa axit và phân chim",
            'content'     => '<h3>Áo giáp tàng hình bảo vệ tối đa giá trị nguyên bản của xe</h3>
<p>Dán phim PPF (Paint Protection Film) bằng chất liệu nhựa nhiệt dẻo TPU cao cấp. Khi gặp các vết cọ quẹt nhẹ từ cành cây hay đá dăm bắn trên đường, lớp PPF sẽ tự động liền lại dưới ánh nắng mặt trời hoặc nước ấm.</p>',
        ),

        // -------------------------------------------------------------
        // 5. Nội thất (noi-that-o-to)
        // -------------------------------------------------------------
        array(
            'slug'        => 'boc-ghe-da-nappa-cao-cap-o-to',
            'title'       => 'Bọc ghế da Nappa cao cấp chuẩn form may xưởng Hải Hà',
            'category'    => 'noi-that-o-to',
            'cat_name'    => 'Nội thất',
            'price'       => '9.500.000',
            'old_price'   => '11.000.000',
            'badge'       => 'THỦ CÔNG TINH XẢO',
            'brand'       => 'Hải Hà Leather Workshop',
            'warranty'    => '03 năm đường may & mặt da',
            'origin'      => 'Da Nappa nhập khẩu cao cấp',
            'img'         => $img_uri . '/goi-tua-dau-oto.jpg',
            'excerpt'     => 'May và bọc ghế da Nappa chuẩn form ôm khít, đường kim mũi chỉ tỉ mỉ tôn lên vẻ sang trọng đẳng cấp cho khoang lái.',
            'specs'       => "Chất liệu: Da Nappa tự nhiên siêu mềm mịn, thoáng khí không mùi
Quy cách may: May bóp chết ôm sát chuẩn phom mút zin từng dòng xe
Màu sắc: Đa dạng phối màu tùy chọn (Kem, Nâu bò, Đen, Đỏ đô, Cam Hermes)
Thời gian thi công: 6 - 8 tiếng hoàn thiện tại xưởng",
            'content'     => '<h3>Nâng tầm nội thất xe hơi thành khoang thương gia hạng nhất</h3>
<p>Với 31 năm kinh nghiệm chế tác nội thất ô tô tại Hải Dương, xưởng Ôtô Hải Hà cung cấp dịch vụ may bọc ghế da Nappa thủ công tỉ mỉ từng chi tiết. Chất da mềm mịn mát tay, đàn hồi tuyệt hảo và hoàn toàn không để lại mùi hôi khó chịu.</p>',
        ),

        array(
            'slug'        => 'tham-lot-san-o-to-tpe-tran-vien',
            'title'       => 'Thảm lót sàn ô tô khuôn đúc tràn viền TPE 5D/6D cao cấp',
            'category'    => 'noi-that-o-to',
            'cat_name'    => 'Nội thất',
            'price'       => '1.850.000',
            'old_price'   => '2.300.000',
            'badge'       => 'CHỐNG NƯỚC 100%',
            'brand'       => 'Macsim / Kardo',
            'warranty'    => '24 tháng không cong vênh',
            'origin'      => 'Nhựa nguyên sinh TPE an toàn',
            'img'         => $img_uri . '/boc-vo-lang.jpg',
            'excerpt'     => 'Thảm sàn đúc nguyên khối TPE tràn viền chống nước tuyệt đối, không mùi khó chịu kể cả khi phơi nắng nhiệt độ cao.',
            'specs'       => "Chất liệu: Nhựa TPE nguyên sinh an toàn không mùi độc hại
Thiết kế: Quét Scan 3D chuẩn xác theo từng sàn xe, tràn viền bậc cửa
Tính năng: Chống nước 100%, dễ dàng xịt rửa vệ sinh trong 2 phút
Chống trượt: Khóa chốt an toàn không xô lệch kẹt chân ga",
            'content'     => '<h3>Giải pháp giữ gìn vệ sinh sàn xe hơi sạch sẽ suốt mùa mưa ẩm</h3>
<p>Khác biệt hoàn toàn với thảm da lót sàn truyền thống dễ ẩm mốc và bốc mùi hôi sau thời gian sử dụng, thảm sàn đúc TPE nguyên khối chống thấm nước 100%, không sinh mùi độc hại và dễ dàng xịt rửa sạch tinh như mới trong chớp mắt.</p>',
        ),

        array(
            'slug'        => 'boc-vo-lang-sparco-chinh-hang',
            'title'       => 'Bọc vô lăng da PU Carbon Sparco thể thao êm tay chống trượt',
            'category'    => 'noi-that-o-to',
            'cat_name'    => 'Nội thất',
            'price'       => '550.000',
            'old_price'   => '680.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Sparco Italy',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Chính hãng Sparco & Phân phối tại Hải Hà',
            'img'         => $img_uri . '/boc-vo-lang.jpg',
            'excerpt'     => 'Bọc vô lăng chính hãng Sparco phong cách thể thao, cảm giác cầm đầm tay, hỗ trợ điều khiển xe chuẩn xác.',
            'specs'       => "Chất liệu: Da PU cao cấp phối sợi carbon thể thao
Kích thước: Chuẩn size 38cm vừa vặn 99% các dòng xe 4 - 7 chỗ
Cảm giác cầm: Êm ái, ma sát tốt, thấm hút mồ hôi tay cực tốt
Thiết kế: Logo Sparco thêu nổi bật phong cách xe đua thể thao",
            'content'     => '<h3>Cảm giác lái thể thao đầm chắc trên từng cung đường</h3>
<p>Bọc vô lăng Sparco chính hãng Italy mang đến sự tự tin tuyệt đối cho người lái nhờ các đường gân nổi bám chắc lòng bàn tay, hạn chế trơn trượt hiệu quả cho những bác tài hay ra mồ hôi tay.</p>',
        ),

        array(
            'slug'        => 'bo-den-led-vien-noi-that-ambient-light-64-mau',
            'title'       => 'Bộ đèn LED viền nội thất Ambient Light 64 màu App Bluetooth',
            'category'    => 'noi-that-o-to',
            'cat_name'    => 'Nội thất',
            'price'       => '3.200.000',
            'old_price'   => '3.800.000',
            'badge'       => 'ĐỔI MÀU THÔNG MINH',
            'brand'       => 'Ultra Ambient LED',
            'warranty'    => '18 tháng 1 đổi 1',
            'origin'      => 'Công nghệ LED cao cấp & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/baseus-gia-do.jpg',
            'excerpt'     => 'Nâng tầm khoang nội thất lung linh như xe sang Mercedes-Benz với dải LED thanh mảnh đổi 64 màu theo nhạc.',
            'specs'       => "Số vị trí: 18 - 22 chi tiết (Taplo, 4 cánh cửa, hộc để chân, tay nắm cửa)
Bảng màu: 64 màu RGB tùy biến chuyển sắc mượt mà
Điều khiển: Qua ứng dụng Smartphone hoặc nút điều khiển trung tâm
Hiệu ứng: Chớp nháy đồng bộ theo giai điệu bài hát trên xe",
            'content'     => '<h3>Không gian ánh sáng lung linh rực rỡ bên trong xế yêu</h3>
<p>Thanh LED quang học siêu mỏng được luồn tinh tế theo các đường chỉ mép taplo và tappi cửa, mang lại không gian nội thất thư giãn và cuốn hút mỗi khi màn đêm buông xuống.</p>',
        ),

        // -------------------------------------------------------------
        // 6. Ngoại thất và đèn (ngoai-that-va-den)
        // -------------------------------------------------------------
        array(
            'slug'        => 'nang-cap-bi-led-x-light-v20-ultra',
            'title'       => 'Nâng cấp Bi LED X-Light V20 Ultra siêu sáng gom luồng sáng',
            'category'    => 'ngoai-that-va-den',
            'cat_name'    => 'Ngoại thất và đèn',
            'price'       => '7.800.000',
            'old_price'   => '9.000.000',
            'badge'       => 'SIÊU SÁNG',
            'brand'       => 'X-Light',
            'warranty'    => '36 tháng đổi mới',
            'origin'      => 'Chính hãng X-Light Germany Tech & Lắp đặt tại Hải Hà',
            'img'         => $img_uri . '/elliview-u4.jpg',
            'excerpt'     => 'Giải pháp tăng sáng toàn diện gấp 5 lần đèn halogen zin, đường cắt cos mịn bám đường và không gây chói xe ngược chiều.',
            'specs'       => "Công suất: Cos 60W / Pha 70W ánh sáng cực đại
Nhiệt màu: 5500K trắng ngà tự nhiên bám đường mưa gió
Tản nhiệt: Quạt tản nhiệt Aluminum Driver rời vận hành êm ái
Đường cắt: Cos thẳng tắp không gây chói mắt người đối diện",
            'content'     => '<h3>Thắp sáng mọi cung đường đêm tối và mưa gió sương mù</h3>
<p>Độ đèn ô tô tại xưởng Hải Hà sử dụng máy hấp nhiệt chuyên dụng, pat sắt định vị chuẩn zin và giắc cắm chống nước, đảm bảo không vào nước và giữ độ bền tuyệt đối cho chóa đèn pha.</p>',
        ),

        array(
            'slug'        => 'do-cop-dien-tu-dong-perfect-car',
            'title'       => 'Độ cốp điện tự động thông minh Perfect Car kèm cảm biến đá cốp',
            'category'    => 'ngoai-that-va-den',
            'cat_name'    => 'Ngoại thất và đèn',
            'price'       => '8.800.000',
            'old_price'   => '9.800.000',
            'badge'       => 'THÔNG MINH',
            'brand'       => 'Perfect Car',
            'warranty'    => '24 tháng 1 đổi 1',
            'origin'      => 'Chính hãng OEM lắp giắc zin 100%',
            'img'         => $img_uri . '/bua-thoat-hiem.jpg',
            'excerpt'     => 'Đóng mở cốp êm ái nhẹ nhàng chỉ bằng 1 nút bấm hoặc thao tác đưa chân tiện lợi khi hai tay đang mang vác đồ đạc.',
            'specs'       => "Hệ thống: 2 ty điện thủy lực đôi chịu lực siêu êm
Điều khiển: Nút bấm trên chìa khóa zin, nút bấm cốp và cảm biến đá chân
Chống kẹt: Tự động đảo chiều khi gặp vật cản an toàn tuyệt đối cho trẻ nhỏ
Lắp đặt: Cắm giắc zin 100% không cắt trích dây điện của xe",
            'content'     => '<h3>Tiện ích đẳng cấp mở cốp rảnh tay tiện lợi</h3>
<p>Bộ cốp điện thế hệ mới với motor hít êm ái, chấm dứt hoàn toàn tình trạng phải dùng sức dằn cốp mạnh gây rung lắc xe. Cảm biến đá cốp nhận diện thông minh hỗ trợ tối đa các bà nội trợ hoặc người hay chở đồ nặng.</p>',
        ),

        array(
            'slug'        => 'bat-phu-o-to-3-lop-trang-bac-tran-bong',
            'title'       => 'Bạt phủ ô tô 3 lớp tráng bạc trần bông chống nóng chống xước',
            'category'    => 'ngoai-that-va-den',
            'cat_name'    => 'Ngoại thất và đèn',
            'price'       => '480.000',
            'old_price'   => '650.000',
            'badge'       => 'CHỐNG NẮNG MƯA',
            'brand'       => 'Hải Hà Auto Shield',
            'warranty'    => '06 tháng',
            'origin'      => 'Sản xuất tiêu chuẩn cao cấp & Phân phối tại Hải Hà',
            'img'         => $img_uri . '/bat-phu-oto.jpg',
            'excerpt'     => 'Bạt phủ cách nhiệt tráng nhôm phản quang giảm nhiệt độ khoang xe đến 25 độ C khi đỗ xe ngoài trời nắng gắt.',
            'specs'       => "Cấu tạo: 3 lớp (Lớp ngoài tráng nhôm phản quang, lớp giữa bông ép cách nhiệt, lớp trong nỉ bông chống xước sơn)
Kích thước: May đo chuẩn size sedan 4 chỗ, SUV 5 - 7 chỗ
Tiện ích: Khóa kéo bên cửa tài xế lấy đồ tiện lợi không cần tháo bạt, dải phản quang ban đêm",
            'content'     => '<h3>Bảo vệ xe toàn diện trước nắng gắt, mưa axit và lá cây rơi</h3>
<p>Bạt phủ ô tô 3 lớp tráng nhôm phản quang là người bạn đồng hành không thể thiếu cho các bác tài thường xuyên phải đỗ xe ngoài bãi đỗ không có mái che.</p>',
        ),

        // -------------------------------------------------------------
        // 7. Tiện ích (tien-ich-o-to)
        // -------------------------------------------------------------
        array(
            'slug'        => 'may-bom-lop-o-to-michelin-12266',
            'title'       => 'Máy bơm lốp ô tô điện tử tự ngắt áp suất Michelin 12266',
            'category'    => 'tien-ich-o-to',
            'cat_name'    => 'Tiện ích',
            'price'       => '1.150.000',
            'old_price'   => '1.390.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Michelin',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Chính hãng Michelin France & Phân phối tại Hải Hà',
            'img'         => $img_uri . '/michelin-bom-lop.jpg',
            'excerpt'     => 'Dòng máy bơm lốp điện tử bán chạy nhất của Michelin, tự động ngắt khi đủ áp suất, nhỏ gọn để cốp xe.',
            'specs'       => "Áp suất tối đa: 150 PSI
Tính năng: Cài đặt trước áp suất cần bơm và máy tự ngắt khi đủ cân
Tốc độ bơm: Bơm đầy lốp rỗng chỉ trong 3 - 4 phút
Đèn LED: Tích hợp đèn chiếu sáng ban đêm và cổng sạc USB tiện lợi",
            'content'     => '<h3>Máy bơm lốp điện tử cao cấp từ thương hiệu lốp danh tiếng Michelin</h3>
<p><strong>Michelin 12266</strong> là phụ kiện không thể thiếu trong mỗi chuyến đi. Thao tác đơn giản: cắm tẩu sạc 12V trên xe, cài đặt mức cân (Bar/PSI) mong muốn, bấm nút và máy sẽ tự động bơm rồi dừng chính xác khi đủ áp suất.</p>',
        ),

        array(
            'slug'        => 'tau-sac-nhanh-o-to-baseus-65w',
            'title'       => 'Tẩu sạc nhanh ô tô Baseus 65W PD/QC đa cổng công suất cao',
            'category'    => 'tien-ich-o-to',
            'cat_name'    => 'Tiện ích',
            'price'       => '350.000',
            'old_price'   => '450.000',
            'badge'       => 'SẠC NHANH 65W',
            'brand'       => 'Baseus',
            'warranty'    => '12 tháng 1 đổi 1',
            'origin'      => 'Chính hãng Baseus & Phân phối tại Hải Hà',
            'img'         => $img_uri . '/baseus-tau-sac.jpg',
            'excerpt'     => 'Tẩu sạc nhanh 65W công suất lớn sạc nhanh đồng thời 2 thiết bị điện thoại và laptop ngay trên xe.',
            'specs'       => "Công suất tối đa: 65W Max (Hỗ trợ sạc nhanh cho cả Macbook / Laptop)
Cổng ra: 1 cổng Type-C PD và 1 cổng USB Quick Charge 4.0
Màn hình: Hiển thị điện áp ắc quy xe theo thời gian thực
Bảo vệ: Chíp AI kiểm soát nhiệt độ thông minh chống quá tải ngắn mạch",
            'content'     => '<h3>Nạp đầy năng lượng thần tốc cho mọi thiết bị trên xe</h3>
<p>Tẩu sạc nhanh Baseus hỗ trợ các chuẩn sạc nhanh phổ biến nhất như PD 3.0, QC 4.0+, SCP, AFC. Màn hình kỹ thuật số LED hiển thị điện áp bình ắc quy giúp bạn luôn nắm bắt được tình trạng nguồn điện của xe.</p>',
        ),

        array(
            'slug'        => 'gia-do-dien-thoai-o-to-baseus-magsafe',
            'title'       => 'Giá đỡ điện thoại ô tô Baseus hít nam châm MagSafe xoay 360 độ',
            'category'    => 'tien-ich-o-to',
            'cat_name'    => 'Tiện ích',
            'price'       => '280.000',
            'old_price'   => '380.000',
            'badge'       => 'TIỆN LỢI',
            'brand'       => 'Baseus',
            'warranty'    => '12 tháng',
            'origin'      => 'Chính hãng Baseus & Phân phối tại Hải Hà',
            'img'         => $img_uri . '/baseus-gia-do.jpg',
            'excerpt'     => 'Giá đỡ điện thoại hít nam châm từ tính chắc chắn, thao tác đặt và nhấc điện thoại chỉ bằng một tay tiện lợi khi lái xe.',
            'specs'       => "Lực hút nam châm: 16 viên nam châm NdFeB lực hút mạnh mẽ chống rơi kể cả đường gồ ghề
Gắn kết: Kẹp cửa gió điều hòa hoặc dán taplo chắc chắn
Khớp xoay: Trục xoay 360 độ điều chỉnh mọi góc nhìn ngang dọc
Tương thích: Hỗ trợ MagSafe iPhone 12 đến 16 và tặng kèm vòng từ tính cho điện thoại khác",
            'content'     => '<h3>Thao tác nhấc đặt điện thoại bằng một tay an toàn tuyệt đối</h3>
<p>Sở hữu lực hút từ tính siêu khỏe với 16 viên nam châm Rubidi chuẩn MagSafe giữ chắc chắn chiếc điện thoại của bạn trên mọi cung đường xóc, không lo rơi rớt hay làm trầy xước viền máy.</p>',
        ),

        array(
            'slug'        => 'may-loc-khong-khi-o-to-philips-gp5211',
            'title'       => 'Máy lọc không khí ô tô Philips GP5211 khử mùi diệt khuẩn ion âm',
            'category'    => 'tien-ich-o-to',
            'cat_name'    => 'Tiện ích',
            'price'       => '2.490.000',
            'old_price'   => '2.890.000',
            'badge'       => 'DIỆT KHUẨN HEPA',
            'brand'       => 'Philips Hà Lan',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Chính hãng Philips & Phân phối tại Hải Hà',
            'img'         => $img_uri . '/philips-loc-khong-khi.jpg',
            'excerpt'     => 'Máy lọc không khí ô tô Philips cao cấp, lọc sạch 99% bụi mịn PM2.5 và mùi xăng xe hôi ẩm cho không khí trong lành tươi mới.',
            'specs'       => "Màng lọc: SelectFilter Plus lọc bụi mịn PM2.5 trong 13 phút
Khử mùi: Khử khí độc Formaldehyde, VOCs, mùi thuốc lá, ẩm mốc hiệu quả 99%
Cảm biến khí: Cảm biến chất lượng không khí hiển thị đèn LED 3 màu
Độ ồn: Siêu êm dưới 40dB không gây ồn khi nghỉ ngơi",
            'content'     => '<h3>Bảo vệ lá phổi gia đình khỏi bụi mịn và không khí ô nhiễm</h3>
<p><strong>Philips GoPure 5211</strong> trang bị công nghệ màng lọc đa tầng SelectFilter Plus độc quyền lọc sạch hạt bụi mịn siêu nhỏ PM2.5 trong vòng chưa đầy 15 phút, loại bỏ mùi da mới độc hại và vi khuẩn gây bệnh trong khoang xe.</p>',
        ),
    );
}

/**
 * Get Accessories Catalog list for templates (query from DB or fallback)
 */
function hieugara_get_native_accessories() {
    $posts = get_posts(array(
        'post_type'      => 'garage_accessory',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'ID',
        'order'          => 'ASC',
    ));

    if (!empty($posts)) {
        $result = array();
        foreach ($posts as $p) {
            $cat_terms = get_the_terms($p->ID, 'accessory_category');
            $parent_cat_slug = '';
            $parent_cat_name = '';
            $child_cat_slug  = '';
            $child_cat_name  = '';
            $term_slugs      = array();

            if (!empty($cat_terms) && !is_wp_error($cat_terms)) {
                foreach ($cat_terms as $ct) {
                    $term_slugs[] = $ct->slug;
                    if ($ct->parent == 0) {
                        $parent_cat_slug = $ct->slug;
                        $parent_cat_name = $ct->name;
                    } else {
                        $child_cat_slug = $ct->slug;
                        $child_cat_name = $ct->name;
                    }
                }
            }
            if (!$parent_cat_slug && !empty($cat_terms) && !is_wp_error($cat_terms)) {
                $parent_cat_slug = $cat_terms[0]->slug;
                $parent_cat_name = $cat_terms[0]->name;
            }

            $thumb = get_the_post_thumbnail_url($p->ID, 'full');
            if (!$thumb) {
                $thumb = get_post_meta($p->ID, '_accessory_img', true);
            }

            $result[] = array(
                'id'         => $p->ID,
                'slug'       => $p->post_name,
                'title'      => $p->post_title,
                'link'       => get_permalink($p->ID),
                'img'        => $thumb ?: get_template_directory_uri() . '/assets/images/shiftup/center-car.jpg',
                'price'      => get_post_meta($p->ID, '_accessory_price', true) ?: 'Liên hệ',
                'old_price'  => get_post_meta($p->ID, '_accessory_old_price', true) ?: '',
                'badge'      => get_post_meta($p->ID, '_accessory_badge', true) ?: 'CHÍNH HÃNG',
                'brand'      => get_post_meta($p->ID, '_accessory_brand', true) ?: 'Chính Hãng',
                'warranty'   => get_post_meta($p->ID, '_accessory_warranty', true) ?: '12 tháng',
                'excerpt'    => $p->post_excerpt,
                'cat'        => $parent_cat_slug ?: 'tien-ich-o-to',
                'cat_name'   => $parent_cat_name ?: 'Tiện ích',
                'child_cat'  => $child_cat_slug,
                'child_name' => $child_cat_name,
                'term_slugs' => $term_slugs,
            );
        }
        return $result;
    }

    // Fallback: seed items formatted with native site links (link to hotline consultation to prevent 404)
    $defs = hieugara_get_accessories_definitions();
    $fallback = array();
    foreach ($defs as $idx => $d) {
        $fallback[] = array(
            'id'        => $idx + 1,
            'slug'      => $d['slug'],
            'title'     => $d['title'],
            'link'      => 'tel:0911211996',
            'img'       => $d['img'],
            'price'     => $d['price'],
            'old_price' => $d['old_price'],
            'badge'     => $d['badge'],
            'brand'     => $d['brand'],
            'warranty'  => $d['warranty'],
            'excerpt'   => $d['excerpt'],
            'cat'       => $d['category'],
            'cat_name'  => $d['cat_name'],
        );
    }
    return $fallback;
}

/**
 * Helper to group accessories by category
 */
function hieugara_get_accessories_grouped_by_category() {
    $all = hieugara_get_native_accessories();
    $grouped = array();
    $categories = hieugara_get_accessories_categories();

    foreach ($categories as $cat_key => $cat_info) {
        $grouped[$cat_key] = array(
            'meta'  => $cat_info,
            'items' => array()
        );
    }

    foreach ($all as $item) {
        $cat = $item['cat'];
        if (isset($grouped[$cat])) {
            $grouped[$cat]['items'][] = $item;
        } else {
            $grouped[$cat] = array(
                'meta'  => array(
                    'id'         => $cat,
                    'name'       => $item['cat_name'],
                    'short_name' => $item['cat_name'],
                    'icon'       => 'fa-solid fa-car',
                    'index_num'  => sprintf('%02d', count($grouped) + 1),
                    'eyebrow'    => 'PHỤ KIỆN Ô TÔ HẢI HÀ',
                    'desc'       => 'Phụ kiện ô tô chính hãng tại Hải Hà Workshop.',
                ),
                'items' => array($item)
            );
        }
    }

    return $grouped;
}
