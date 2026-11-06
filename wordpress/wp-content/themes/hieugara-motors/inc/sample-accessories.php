<?php
/**
 * Sample Accessories Data & Seeder for Ôtô Hải Hà
 * Genuine Accessories Catalog from META.vn & Ôtô Hải Hà Workshop
 * Native 'garage_accessory' Post Type - 100% Internal URLs & Full Admin CRUD
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return 8 Core Accessory Categories with metadata
 */
function hieugara_get_accessories_categories() {
    return array(
        'camera-man-hinh' => array(
            'id'          => 'camera-man-hinh',
            'name'        => 'Camera Hành Trình & Màn Hình Android',
            'short_name'  => 'Camera & Màn Hình',
            'icon'        => 'fa-solid fa-video',
            'index_num'   => '01',
            'eyebrow'     => 'THIẾT BỊ ĐIỆN TỬ Ô TÔ THÔNG MINH',
            'desc'        => 'Ghi hình 4K siêu nét, dẫn đường thông minh Vietmap Live, cảnh báo tốc độ an toàn và tích hợp camera 360 toàn cảnh sắc nét.'
        ),
        'bom-lop-tpms' => array(
            'id'          => 'bom-lop-tpms',
            'name'        => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'short_name'  => 'Bơm Lốp & TPMS',
            'icon'        => 'fa-solid fa-gauge-high',
            'index_num'   => '02',
            'eyebrow'     => 'AN TOÀN HỆ THỐNG LỐP XE',
            'desc'        => 'Máy bơm lốp điện tử tự ngắt áp suất và hệ thống cảm biến áp suất lốp van trong/ngoài kết nối màn hình Solar thông minh.'
        ),
        'kich-binh-cuu-ho' => array(
            'id'          => 'kich-binh-cuu-ho',
            'name'        => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ Ô Tô',
            'short_name'  => 'Kích Bình & Cứu Hộ',
            'icon'        => 'fa-solid fa-bolt',
            'index_num'   => '03',
            'eyebrow'     => 'CỨU HỘ & KHẨN CẤP ĐƯỜNG TRƯỜNG',
            'desc'        => 'Bộ kích nổ ắc quy cầm tay dòng xả cực đại 2000A, dây câu bình chịu tải cao và búa thoát hiểm đa năng 4 trong 1.'
        ),
        'hut-bui-loc-khi' => array(
            'id'          => 'hut-bui-loc-khi',
            'name'        => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'short_name'  => 'Hút Bụi & Lọc Khí',
            'icon'        => 'fa-solid fa-wind',
            'index_num'   => '04',
            'eyebrow'     => 'CHĂM SÓC KHÔNG GIAN XE',
            'desc'        => 'Máy hút bụi mini lốc xoáy màng lọc HEPA kháng khuẩn và máy lọc không khí ô tô diệt khuẩn ion âm khử mùi ẩm mốc.'
        ),
        'tau-sac-gia-do' => array(
            'id'          => 'tau-sac-gia-do',
            'name'        => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'short_name'  => 'Tẩu Sạc & Giá Đỡ',
            'icon'        => 'fa-solid fa-plug',
            'index_num'   => '05',
            'eyebrow'     => 'TIỆN ÍCH CÔNG NGHỆ BÊN TRONG XE',
            'desc'        => 'Tẩu sạc nhanh công suất cao 65W - 100W PD/QC và giá đỡ điện thoại sạc không dây 15W hít nam châm MagSafe tiện lợi.'
        ),
        'boc-vo-lang-tham-san' => array(
            'id'          => 'boc-vo-lang-tham-san',
            'name'        => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'short_name'  => 'Bọc Vô Lăng & Thảm Sàn',
            'icon'        => 'fa-solid fa-car-side',
            'index_num'   => '06',
            'eyebrow'     => 'NỘI THẤT CAO CẤP & BẢO VỆ',
            'desc'        => 'Bọc vô lăng da PU carbon Sparco thể thao êm tay và thảm lót sàn cao su đúc nguyên khối chống nước không mùi hôi.'
        ),
        'goi-tua-bat-phu' => array(
            'id'          => 'goi-tua-bat-phu',
            'name'        => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'short_name'  => 'Gối Tựa & Bạt Phủ',
            'icon'        => 'fa-solid fa-shield-halved',
            'index_num'   => '07',
            'eyebrow'     => 'TIỆN NGHI & BẢO VỆ NGOẠI THẤT',
            'desc'        => 'Gối tựa đầu cao su non công thái học chống mỏi cổ lái xe đường dài và bạt phủ xe 3 lớp tráng bạc cách nhiệt chống xước.'
        ),
        'cham-soc-xe-nuoc-hoa' => array(
            'id'          => 'cham-soc-xe-nuoc-hoa',
            'name'        => 'Nước Hoa Ô Tô & Dung Dịch Chăm Sóc Xe',
            'short_name'  => 'Nước Hoa & Chăm Sóc Xe',
            'icon'        => 'fa-solid fa-spray-can-sparkles',
            'index_num'   => '08',
            'eyebrow'     => 'DETAILING & NƯỚC HOA CAO CẤP',
            'desc'        => 'Nước hoa kẹp cửa gió cao cấp Areon Bulgaria, sáp thơm xe hơi và dung dịch vệ sinh dưỡng da nội thất 3M, Focar chuyên dụng.'
        )
    );
}

/**
 * Returns complete definition of the 59 genuine accessories
 */
function hieugara_get_accessories_definitions() {
    $img_uri = get_template_directory_uri() . '/assets/images/accessories';
    $upload_dir = wp_upload_dir();
    $acc_upload_url = $upload_dir['baseurl'] . '/accessories';

    return array(
        array(
            'slug'        => 'camera-hanh-trinh-70mai-m310-plus-3k',
            'title'       => 'Camera hành trình 70mai M310 Plus 3K',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '1.500.000',
            'old_price'   => '1.770.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-70mai-m310-plus-3k.jpg',
            'local_file'  => 'camera-hanh-trinh-70mai-m310-plus-3k.jpg',
            'excerpt'     => 'Camera hành trình 70mai M310 Plus 3K ghi hình chất lượng 3K sắc nét, với công nghệ Super Night Vision và góc quay rộng 139° cho hình ảnh rõ ràng mọi lúc.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình 70mai M310 Plus 3K</h3>
<p><strong>Camera hành trình 70mai M310 Plus 3K</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình 70mai M310 Plus 3K ghi hình chất lượng 3K sắc nét, với công nghệ Super Night Vision và góc quay rộng 139° cho hình ảnh rõ ràng mọi lúc.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-truoc-sau-70mai-a500s-1',
            'title'       => 'Camera hành trình trước sau 70mai A500S-1',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '2.470.000',
            'old_price'   => '2.910.000',
            'badge'       => 'CAO CẤP',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-truoc-sau-70mai-a500s-1.jpg',
            'local_file'  => 'camera-hanh-trinh-truoc-sau-70mai-a500s-1.jpg',
            'excerpt'     => 'Camera hành trình trước sau 70mai A500S-1 ghi hình sắc nét 2 kênh, tích hợp GPS, giám sát bãi đậu xe 24/7, cảnh báo ADAS và dễ dàng điều khiển qua ứng dụng.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình trước sau 70mai A500S-1</h3>
<p><strong>Camera hành trình trước sau 70mai A500S-1</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình trước sau 70mai A500S-1 ghi hình sắc nét 2 kênh, tích hợp GPS, giám sát bãi đậu xe 24/7, cảnh báo ADAS và dễ dàng điều khiển qua ứng dụng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-truoc-70mai-m310-plus-2k',
            'title'       => 'Camera hành trình trước 70mai M310 Plus 2K',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '1.050.000',
            'old_price'   => '1.240.000',
            'badge'       => 'HOT',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-truoc-70mai-m310-plus-2k.jpg',
            'local_file'  => 'camera-hanh-trinh-truoc-70mai-m310-plus-2k.jpg',
            'excerpt'     => 'Camera hành trình 70mai M310 Plus 2K ghi hình 2K QHD sắc nét, hỗ trợ Super Night Vision, WDR và ghi hình khẩn cấp có bộ đệm, giúp bảo vệ mọi hành trình an toàn hơn.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình trước 70mai M310 Plus 2K</h3>
<p><strong>Camera hành trình trước 70mai M310 Plus 2K</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình 70mai M310 Plus 2K ghi hình 2K QHD sắc nét, hỗ trợ Super Night Vision, WDR và ghi hình khẩn cấp có bộ đệm, giúp bảo vệ mọi hành trình an toàn hơn.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-dang-guong-70mai-s410-truoc-sau-lui',
            'title'       => 'Camera hành trình dạng gương 70mai S410 (trước, sau + lùi)',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '2.790.000',
            'old_price'   => '3.290.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-dang-guong-70mai-s410-truoc-sau-lui.jpg',
            'local_file'  => 'camera-hanh-trinh-dang-guong-70mai-s410-truoc-sau-lui.jpg',
            'excerpt'     => 'Camera hành trình dạng gương 70mai S410 ghi hình toàn diện với camera trước 2.5K, camera sau Full HD 1080P, màn hình cảm ứng 9.35 inch, hỗ trợ lái xe an toàn.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình dạng gương 70mai S410 (trước, sau + lùi)</h3>
<p><strong>Camera hành trình dạng gương 70mai S410 (trước, sau + lùi)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình dạng gương 70mai S410 ghi hình toàn diện với camera trước 2.5K, camera sau Full HD 1080P, màn hình cảm ứng 9.35 inch, hỗ trợ lái xe an toàn.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-70mai-a410',
            'title'       => 'Camera hành trình 70mai A410',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '1.590.000',
            'old_price'   => '1.880.000',
            'badge'       => 'HOT',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-70mai-a410.jpg',
            'local_file'  => 'camera-hanh-trinh-70mai-a410.jpg',
            'excerpt'     => 'Camera hành trình 70Mai A410 mang đến chất lượng ghi hình sắc nét, khả năng ghi hình ban đêm vượt trội và tính năng giám sát thông minh, bảo vệ bạn trong mọi chuyến đi.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình 70mai A410</h3>
<p><strong>Camera hành trình 70mai A410</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình 70Mai A410 mang đến chất lượng ghi hình sắc nét, khả năng ghi hình ban đêm vượt trội và tính năng giám sát thông minh, bảo vệ bạn trong mọi chuyến đi.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-truoc-sau-70mai-a800se-1',
            'title'       => 'Camera hành trình trước sau 70mai A800SE-1',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '3.390.000',
            'old_price'   => '4.000.000',
            'badge'       => 'MỚI',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-truoc-sau-70mai-a800se-1.jpg',
            'local_file'  => 'camera-hanh-trinh-truoc-sau-70mai-a800se-1.jpg',
            'excerpt'     => 'Camera hành trình 70mai A800SE-1 ghi hình chuẩn 4K, tích hợp công nghệ HDR và Super Night Vision, mang đến chất lượng hình ảnh sắc nét cả ngày và đêm.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình trước sau 70mai A800SE-1</h3>
<p><strong>Camera hành trình trước sau 70mai A800SE-1</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình 70mai A800SE-1 ghi hình chuẩn 4K, tích hợp công nghệ HDR và Super Night Vision, mang đến chất lượng hình ảnh sắc nét cả ngày và đêm.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-70mai-a510',
            'title'       => 'Camera hành trình 70mai A510',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '2.390.000',
            'old_price'   => '2.820.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-70mai-a510.jpg',
            'local_file'  => 'camera-hanh-trinh-70mai-a510.jpg',
            'excerpt'     => '70mai A510 tích hợp cảm biến Sony STARVIS 2, ghi hình HDR trước với độ phân giải cao, hỗ trợ GPS, ADAS, giám sát đỗ xe 24h và tính năng ghi hình khẩn cấp.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình 70mai A510</h3>
<p><strong>Camera hành trình 70mai A510</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. 70mai A510 tích hợp cảm biến Sony STARVIS 2, ghi hình HDR trước với độ phân giải cao, hỗ trợ GPS, ADAS, giám sát đỗ xe 24h và tính năng ghi hình khẩn cấp.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'camera-hanh-trinh-truoc-70mai-4k-a810-lite',
            'title'       => 'Camera hành trình trước 70mai 4K A810 Lite',
            'category'    => 'camera-man-hinh',
            'cat_name'    => 'Camera Hành Trình & Màn Hình Android',
            'price'       => '2.690.000',
            'old_price'   => '3.170.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => '70mai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/camera-hanh-trinh-truoc-70mai-4k-a810-lite.jpg',
            'local_file'  => 'camera-hanh-trinh-truoc-70mai-4k-a810-lite.jpg',
            'excerpt'     => 'Camera hành trình 70mai 4K A810 Lite ghi hình 4K HDR sắc nét, hỗ trợ ghi đêm, GPS, giám sát đỗ xe 24/7 và Wi-Fi 6, giúp bảo vệ hành trình an toàn, hiệu quả.',
            'specs'       => "Thương hiệu: 70mai
Độ phân giải: 2K / 4K Ultra HD sắc nét
Góc quay rộng: 140° - 170° quan sát toàn diện
Tính năng: Ghi hình vòng lặp, cảnh báo tốc độ, ADAS AI thông minh
Kết nối: Wi-Fi xem và tải video trực tiếp qua điện thoại
Nguồn điện: 12V - 24V cổng tẩu / cắm giắc zin an toàn",
            'content'     => '<h3>Tổng quan sản phẩm Camera hành trình trước 70mai 4K A810 Lite</h3>
<p><strong>Camera hành trình trước 70mai 4K A810 Lite</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>70mai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Camera hành trình 70mai 4K A810 Lite ghi hình 4K HDR sắc nét, hỗ trợ ghi đêm, GPS, giám sát đỗ xe 24/7 và Wi-Fi 6, giúp bảo vệ hành trình an toàn, hiệu quả.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-bom-lop-michelin-m2566',
            'title'       => 'Máy bơm lốp Michelin M2566',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '1.170.000',
            'old_price'   => '1.380.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Michelin',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-bom-lop-michelin-m2566.jpg',
            'local_file'  => 'may-bom-lop-michelin-m2566.jpg',
            'excerpt'     => 'Máy bơm lốp Michelin M2566 với công suất mạnh mẽ 168W, màn hình LED kỹ thuật số, tự ngắt khi đủ áp suất và đèn LED hỗ trợ khi sử dụng ban đêm.',
            'specs'       => "Thương hiệu: Michelin
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Máy bơm lốp Michelin M2566</h3>
<p><strong>Máy bơm lốp Michelin M2566</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Michelin</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm lốp Michelin M2566 với công suất mạnh mẽ 168W, màn hình LED kỹ thuật số, tự ngắt khi đủ áp suất và đèn LED hỗ trợ khi sử dụng ban đêm.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-bom-lop-khong-day-cong-suat-cao-michelin-m2567',
            'title'       => 'Máy bơm lốp không dây công suất cao Michelin M2567',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '1.180.000',
            'old_price'   => '1.390.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Michelin',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-bom-lop-khong-day-cong-suat-cao-michelin-m2567.jpg',
            'local_file'  => 'may-bom-lop-khong-day-cong-suat-cao-michelin-m2567.jpg',
            'excerpt'     => 'Máy bơm lốp Michelin M2567 nhỏ gọn, không dây, công suất mạnh mẽ, giúp bơm lốp nhanh chóng, an toàn và tiện lợi cho mọi chuyến đi.',
            'specs'       => "Thương hiệu: Michelin
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Máy bơm lốp không dây công suất cao Michelin M2567</h3>
<p><strong>Máy bơm lốp không dây công suất cao Michelin M2567</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Michelin</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm lốp Michelin M2567 nhỏ gọn, không dây, công suất mạnh mẽ, giúp bơm lốp nhanh chóng, an toàn và tiện lợi cho mọi chuyến đi.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'than-may-bom-hoi-pin-hukan-gen-2-g2-bhp2120-chua-pin-sac',
            'title'       => 'Thân máy bơm hơi pin Hukan (GEN 2) G2-BHP2120 (chưa pin, sạc)',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '720.000',
            'old_price'   => '850.000',
            'badge'       => 'HOT',
            'brand'       => 'Hukan',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/than-may-bom-hoi-pin-hukan-gen-2-g2-bhp2120-chua-pin-sac.jpg',
            'local_file'  => 'than-may-bom-hoi-pin-hukan-gen-2-g2-bhp2120-chua-pin-sac.jpg',
            'excerpt'     => 'Máy bơm hơi pin Hukan (GEN 2) G2-BHP2120 mang đến khả năng bơm hơi mạnh mẽ, vận hành linh hoạt với pin 21V và màn hình kỹ thuật số giúp kiểm soát áp suất chính xác.',
            'specs'       => "Thương hiệu: Hukan
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Thân máy bơm hơi pin Hukan (GEN 2) G2-BHP2120 (chưa pin, sạc)</h3>
<p><strong>Thân máy bơm hơi pin Hukan (GEN 2) G2-BHP2120 (chưa pin, sạc)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Hukan</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm hơi pin Hukan (GEN 2) G2-BHP2120 mang đến khả năng bơm hơi mạnh mẽ, vận hành linh hoạt với pin 21V và màn hình kỹ thuật số giúp kiểm soát áp suất chính xác.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-bom-hoi-da-nang-dung-dien-12v220v-stanley-sxif3501',
            'title'       => 'Máy bơm hơi đa năng dùng điện 12V/220V Stanley SXIF3501',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '1.850.000',
            'old_price'   => '2.180.000',
            'badge'       => 'MỚI',
            'brand'       => 'Stanley',
            'warranty'    => '36 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-bom-hoi-da-nang-dung-dien-12v220v-stanley-sxif3501.jpg',
            'local_file'  => 'may-bom-hoi-da-nang-dung-dien-12v220v-stanley-sxif3501.jpg',
            'excerpt'     => 'Máy bơm hơi đa năng Stanley SXIF3501 dùng điện 12V/220V, hỗ trợ bơm lốp, thổi khí nhanh, tiện lợi cho gia đình và ô tô.',
            'specs'       => "Thương hiệu: Stanley
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Máy bơm hơi đa năng dùng điện 12V/220V Stanley SXIF3501</h3>
<p><strong>Máy bơm hơi đa năng dùng điện 12V/220V Stanley SXIF3501</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Stanley</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm hơi đa năng Stanley SXIF3501 dùng điện 12V/220V, hỗ trợ bơm lốp, thổi khí nhanh, tiện lợi cho gia đình và ô tô.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'bom-chan-co-dong-ho-2-x-55-x-120-mm-tolsen-65510',
            'title'       => 'Bơm chân có đồng hồ 2 x Ø55 x 120 mm Tolsen 65510',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '410.000',
            'old_price'   => '480.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Tolsen',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/bom-chan-co-dong-ho-2-x-55-x-120-mm-tolsen-65510.jpg',
            'local_file'  => 'bom-chan-co-dong-ho-2-x-55-x-120-mm-tolsen-65510.jpg',
            'excerpt'     => 'Bơm chân có đồng hồ Tolsen 65510 có thùng đôi làm từ thép hợp kim sơn chống gỉ, chống oxy hóa, áp suất 80 psi bơm hơi lốp xe đạp, xe máy nhanh.',
            'specs'       => "Thương hiệu: Tolsen
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Bơm chân có đồng hồ 2 x Ø55 x 120 mm Tolsen 65510</h3>
<p><strong>Bơm chân có đồng hồ 2 x Ø55 x 120 mm Tolsen 65510</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Tolsen</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Bơm chân có đồng hồ Tolsen 65510 có thùng đôi làm từ thép hợp kim sơn chống gỉ, chống oxy hóa, áp suất 80 psi bơm hơi lốp xe đạp, xe máy nhanh.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-bom-o-to-xe-may-kem-va-lop-xe-khan-cap-12v-michelin-5818',
            'title'       => 'Máy bơm ô tô, xe máy kèm vá lốp xe khẩn cấp 12V Michelin 5818',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '1.190.000',
            'old_price'   => '1.400.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Michelin',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-bom-o-to-xe-may-kem-va-lop-xe-khan-cap-12v-michelin-5818.jpg',
            'local_file'  => 'may-bom-o-to-xe-may-kem-va-lop-xe-khan-cap-12v-michelin-5818.jpg',
            'excerpt'     => 'Máy bơm ô tô, xe máy kèm vá lốp xe khẩn cấp 12V Michelin 5818 sử dụng cho xe: sendan, Suv, bán tải, 4,5 và 7,8 chỗ,  xe 16 chỗ, đi kèm đầu bơm phụ để bơm phao bơi',
            'specs'       => "Thương hiệu: Michelin
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Máy bơm ô tô, xe máy kèm vá lốp xe khẩn cấp 12V Michelin 5818</h3>
<p><strong>Máy bơm ô tô, xe máy kèm vá lốp xe khẩn cấp 12V Michelin 5818</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Michelin</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm ô tô, xe máy kèm vá lốp xe khẩn cấp 12V Michelin 5818 sử dụng cho xe: sendan, Suv, bán tải, 4,5 và 7,8 chỗ,  xe 16 chỗ, đi kèm đầu bơm phụ để bơm phao bơi</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-bom-lop-banh-xe-o-to-hiroma-dhl-0312',
            'title'       => 'Máy bơm lốp bánh xe ô tô Hiroma DHL-0312',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '350.000',
            'old_price'   => '410.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Hiroma',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-bom-lop-banh-xe-o-to-hiroma-dhl-0312.jpg',
            'local_file'  => 'may-bom-lop-banh-xe-o-to-hiroma-dhl-0312.jpg',
            'excerpt'     => 'Máy bơm lốp bánh xe ô tô Hiroma DHL-0312 có công suất 150W, piston thép size lớn nén áp suất cao cho lưu lượng khí bơm đạt 40 lít/phút.',
            'specs'       => "Thương hiệu: Hiroma
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Máy bơm lốp bánh xe ô tô Hiroma DHL-0312</h3>
<p><strong>Máy bơm lốp bánh xe ô tô Hiroma DHL-0312</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Hiroma</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm lốp bánh xe ô tô Hiroma DHL-0312 có công suất 150W, piston thép size lớn nén áp suất cao cho lưu lượng khí bơm đạt 40 lít/phút.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-bom-hoi-dung-pin-stanley-sxif0101-co-den-led-sac-du-phong',
            'title'       => 'Máy bơm hơi dùng pin Stanley SXIF0101 (có đèn led, sạc dự phòng)',
            'category'    => 'bom-lop-tpms',
            'cat_name'    => 'Máy Bơm Lốp & Cảm Biến Áp Suất Lốp (TPMS)',
            'price'       => '1.050.000',
            'old_price'   => '1.240.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Stanley',
            'warranty'    => '36 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-bom-hoi-dung-pin-stanley-sxif0101-co-den-led-sac-du-phong.jpg',
            'local_file'  => 'may-bom-hoi-dung-pin-stanley-sxif0101-co-den-led-sac-du-phong.jpg',
            'excerpt'     => 'Máy bơm hơi dùng pin Stanley SXIF0101 có áp suất  150 PSI, pin 6000 mAh, lưu lượng bơm 14.2 lít/phút giúp bơm hơi nhanh.',
            'specs'       => "Thương hiệu: Stanley
Áp suất nén tối đa: 150 PSI / 10.3 Bar
Chức năng: Cài đặt áp suất điện tử, tự động ngắt khi đủ áp
Độ chính xác: ± 0.1 Bar tiêu chuẩn quốc tế
Đèn chiếu sáng: Đèn LED cứu hộ ban đêm tích hợp SOS
Bảo hành: 12 - 24 tháng chính hãng",
            'content'     => '<h3>Tổng quan sản phẩm Máy bơm hơi dùng pin Stanley SXIF0101 (có đèn led, sạc dự phòng)</h3>
<p><strong>Máy bơm hơi dùng pin Stanley SXIF0101 (có đèn led, sạc dự phòng)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Stanley</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy bơm hơi dùng pin Stanley SXIF0101 có áp suất  150 PSI, pin 6000 mAh, lưu lượng bơm 14.2 lít/phút giúp bơm hơi nhanh.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-dong-nai-n120-12v-120ah',
            'title'       => 'Ắc quy Đồng Nai N120 (12V - 120Ah)',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '2.890.000',
            'old_price'   => '3.410.000',
            'badge'       => 'HOT',
            'brand'       => 'Đồng Nai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-dong-nai-n120-12v-120ah.jpg',
            'local_file'  => 'ac-quy-dong-nai-n120-12v-120ah.jpg',
            'excerpt'     => 'Ắc quy Đồng Nai N120 (12V - 120Ah) có điện thế 12V, dung lượng 120Ah, đảm bảo sự khởi động mạnh mẽ cho động cơ. Thể tích axit 9,7 lít giúp sử dụng trong thời gian dài.',
            'specs'       => "Thương hiệu: Đồng Nai
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy Đồng Nai N120 (12V - 120Ah)</h3>
<p><strong>Ắc quy Đồng Nai N120 (12V - 120Ah)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Đồng Nai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy Đồng Nai N120 (12V - 120Ah) có điện thế 12V, dung lượng 120Ah, đảm bảo sự khởi động mạnh mẽ cho động cơ. Thể tích axit 9,7 lít giúp sử dụng trong thời gian dài.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-dong-nai-n150-mf-12v-150ah',
            'title'       => 'Ắc quy Đồng Nai N150 MF (12V - 150Ah)',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '2.900.000',
            'old_price'   => '3.420.000',
            'badge'       => 'MỚI',
            'brand'       => 'Đồng Nai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-dong-nai-n150-mf-12v-150ah.jpg',
            'local_file'  => 'ac-quy-dong-nai-n150-mf-12v-150ah.jpg',
            'excerpt'     => 'Ắc quy Đồng Nai N150 MF dùng cho ô tô 50 chỗ hoặc ô tô tải 8 tấn , 11 tấn, 14 tấn , 15 tấn, 19 tấn. Đồng Nai N150 MF có vỏ nhựa, dung lượng 150Ah.',
            'specs'       => "Thương hiệu: Đồng Nai
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy Đồng Nai N150 MF (12V - 150Ah)</h3>
<p><strong>Ắc quy Đồng Nai N150 MF (12V - 150Ah)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Đồng Nai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy Đồng Nai N150 MF dùng cho ô tô 50 chỗ hoặc ô tô tải 8 tấn , 11 tấn, 14 tấn , 15 tấn, 19 tấn. Đồng Nai N150 MF có vỏ nhựa, dung lượng 150Ah.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-dong-nai-n85-12v-85ah',
            'title'       => 'Ắc quy Đồng Nai N85 (12V - 85Ah)',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '1.930.000',
            'old_price'   => '2.280.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Đồng Nai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-dong-nai-n85-12v-85ah.jpg',
            'local_file'  => 'ac-quy-dong-nai-n85-12v-85ah.jpg',
            'excerpt'     => 'Ắc quy Đồng Nai N85 có bình axit là 5.3 lít, vị trí cọc thuận, điện áp 12V, dung lượng pin 85Ah sẽ phù hợp sử dụng cho xe tải nhỏ, xe hơi gia đình, tàu thuyền.',
            'specs'       => "Thương hiệu: Đồng Nai
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy Đồng Nai N85 (12V - 85Ah)</h3>
<p><strong>Ắc quy Đồng Nai N85 (12V - 85Ah)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Đồng Nai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy Đồng Nai N85 có bình axit là 5.3 lít, vị trí cọc thuận, điện áp 12V, dung lượng pin 85Ah sẽ phù hợp sử dụng cho xe tải nhỏ, xe hơi gia đình, tàu thuyền.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-gs-mf-105d31r-12v-90ah',
            'title'       => 'Ắc quy GS MF 105D31R (12V - 90Ah)',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '2.050.000',
            'old_price'   => '2.420.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'GS',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-gs-mf-105d31r-12v-90ah.jpg',
            'local_file'  => 'ac-quy-gs-mf-105d31r-12v-90ah.jpg',
            'excerpt'     => 'Ắc quy GS MF 105D31R (12V - 90Ah) dùng cho ô tô và nhiều ứng dụng khác. GS 105D31L MF không cần bảo dưỡng, kín khí, vị trí cọc R.',
            'specs'       => "Thương hiệu: GS
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy GS MF 105D31R (12V - 90Ah)</h3>
<p><strong>Ắc quy GS MF 105D31R (12V - 90Ah)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>GS</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy GS MF 105D31R (12V - 90Ah) dùng cho ô tô và nhiều ứng dụng khác. GS 105D31L MF không cần bảo dưỡng, kín khí, vị trí cọc R.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-gs-mf115d33c-12v-100ah',
            'title'       => 'Ắc quy GS MF115D33C 12V - 100Ah',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '2.250.000',
            'old_price'   => '2.660.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'GS',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-gs-mf115d33c-12v-100ah.jpg',
            'local_file'  => 'ac-quy-gs-mf115d33c-12v-100ah.jpg',
            'excerpt'     => 'Ắc quy GS MF115D33C dùng để khởi động xe ô tô, không cần bảo dưỡng, kín khí không cần châm axit, cung cấp năng lượng vượt trội.',
            'specs'       => "Thương hiệu: GS
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy GS MF115D33C 12V - 100Ah</h3>
<p><strong>Ắc quy GS MF115D33C 12V - 100Ah</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>GS</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy GS MF115D33C dùng để khởi động xe ô tô, không cần bảo dưỡng, kín khí không cần châm axit, cung cấp năng lượng vượt trội.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-dong-nai-n150s-12v-135ah',
            'title'       => 'Ắc quy Đồng Nai N150S (12V - 135Ah)',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '3.180.000',
            'old_price'   => '3.750.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Đồng Nai',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-dong-nai-n150s-12v-135ah.jpg',
            'local_file'  => 'ac-quy-dong-nai-n150s-12v-135ah.jpg',
            'excerpt'     => 'Ắc quy Đồng Nai N150S (12V - 135Ah) có vị trí đặt là R, dung tích bình axit là 13.3 lít. Đồng Nai N150S dùng cho ô tô, dung lượng là 135Ah.',
            'specs'       => "Thương hiệu: Đồng Nai
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy Đồng Nai N150S (12V - 135Ah)</h3>
<p><strong>Ắc quy Đồng Nai N150S (12V - 135Ah)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Đồng Nai</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy Đồng Nai N150S (12V - 135Ah) có vị trí đặt là R, dung tích bình axit là 13.3 lít. Đồng Nai N150S dùng cho ô tô, dung lượng là 135Ah.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'ac-quy-gsmf-46b24ls-12v-45ah-coc-trai-lon',
            'title'       => 'Ắc quy GSMF 46B24L(S) (12V - 45Ah), cọc trái (lớn)',
            'category'    => 'kich-binh-cuu-ho',
            'cat_name'    => 'Bộ Kích Nổ Bình & Thiết Bị Cứu Hộ',
            'price'       => '1.450.000',
            'old_price'   => '1.710.000',
            'badge'       => 'HOT',
            'brand'       => 'GS',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/ac-quy-gsmf-46b24ls-12v-45ah-coc-trai-lon.jpg',
            'local_file'  => 'ac-quy-gsmf-46b24ls-12v-45ah-coc-trai-lon.jpg',
            'excerpt'     => 'Ắc quy GSMF 46B24L(S) sản xuất theo công nghệ Nhật Bản tiên tiến, đảm bảo độ bền, hiệu suất cao, kín khí, không cần bảo dưỡng, phù hợp với nhiều dòng xe ô tô phổ biến.',
            'specs'       => "Thương hiệu: GS
Dòng điện kích cực đại: 1000A - 2000A chuyên dụng xe hơi
Dung lượng cell pin: Lithium cao cấp chống cháy nổ
Tương thích động cơ: Động cơ xăng lên tới 6.0L, động cơ dầu tới 4.0L
Cổng sạc ra: Cổng USB Type-C sạc nhanh cho điện thoại, máy tính bảng
Tích hợp an toàn: Kẹp thông minh chống ngược cực, chống ngắn mạch",
            'content'     => '<h3>Tổng quan sản phẩm Ắc quy GSMF 46B24L(S) (12V - 45Ah), cọc trái (lớn)</h3>
<p><strong>Ắc quy GSMF 46B24L(S) (12V - 45Ah), cọc trái (lớn)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>GS</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ắc quy GSMF 46B24L(S) sản xuất theo công nghệ Nhật Bản tiên tiến, đảm bảo độ bền, hiệu suất cao, kín khí, không cần bảo dưỡng, phù hợp với nhiều dòng xe ô tô phổ biến.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'am-dun-nuoc-inox-kalpen-kk03-3-lit',
            'title'       => 'Ấm đun nước inox Kalpen KK03 - 3 lít',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '390.000',
            'old_price'   => '460.000',
            'badge'       => 'MỚI',
            'brand'       => 'Kalpen',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/am-dun-nuoc-inox-kalpen-kk03-3-lit.jpg',
            'local_file'  => 'am-dun-nuoc-inox-kalpen-kk03-3-lit.jpg',
            'excerpt'     => 'Ấm đun nước inox Kalpen KK03 làm từ inox 304 an toàn cho sức khỏe theo tiêu chuẩn Đức, truyền nhiệt nhanh với 5 lớp đáy.',
            'specs'       => "Thương hiệu: Kalpen
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Ấm đun nước inox Kalpen KK03 - 3 lít</h3>
<p><strong>Ấm đun nước inox Kalpen KK03 - 3 lít</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Kalpen</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ấm đun nước inox Kalpen KK03 làm từ inox 304 an toàn cho sức khỏe theo tiêu chuẩn Đức, truyền nhiệt nhanh với 5 lớp đáy.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'may-pha-tra-bear-sb-pt15k-15-lit',
            'title'       => 'Máy pha trà Bear SB-PT15K (1.5 lít)',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '790.000',
            'old_price'   => '930.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Bear',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/may-pha-tra-bear-sb-pt15k-15-lit.jpg',
            'local_file'  => 'may-pha-tra-bear-sb-pt15k-15-lit.jpg',
            'excerpt'     => 'Máy pha trà Bear SB-PT15K có chức năng đun nước, nấu đồ ngọt, nấu cháo trắng, canh thuốc, pha trà, nấu súp, giữ ấm và hẹn trước.',
            'specs'       => "Thương hiệu: Bear
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Máy pha trà Bear SB-PT15K (1.5 lít)</h3>
<p><strong>Máy pha trà Bear SB-PT15K (1.5 lít)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Bear</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Máy pha trà Bear SB-PT15K có chức năng đun nước, nấu đồ ngọt, nấu cháo trắng, canh thuốc, pha trà, nấu súp, giữ ấm và hẹn trước.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'am-dun-may-chung-yen-da-nang-bbcooker-bb15-15-lit',
            'title'       => 'Ấm đun - máy chưng yến đa năng BBcooker BB15 - 1.5 lít',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '990.000',
            'old_price'   => '1.170.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'BBcooker',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/am-dun-may-chung-yen-da-nang-bbcooker-bb15-15-lit.jpg',
            'local_file'  => 'am-dun-may-chung-yen-da-nang-bbcooker-bb15-15-lit.jpg',
            'excerpt'     => 'BBcooker BB15 là ấm đun đa năng 1.5 lít với thiết kế tinh tế, bảng điều khiển cảm ứng và 11 chế độ nấu, phù hợp cho mọi nhu cầu từ chưng yến, pha trà đến tiệt trùng.',
            'specs'       => "Thương hiệu: BBcooker
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Ấm đun - máy chưng yến đa năng BBcooker BB15 - 1.5 lít</h3>
<p><strong>Ấm đun - máy chưng yến đa năng BBcooker BB15 - 1.5 lít</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>BBcooker</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. BBcooker BB15 là ấm đun đa năng 1.5 lít với thiết kế tinh tế, bảng điều khiển cảm ứng và 11 chế độ nấu, phù hợp cho mọi nhu cầu từ chưng yến, pha trà đến tiệt trùng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'am-dun-nuoc-inox-kalpen-kk02-25-lit',
            'title'       => 'Ấm đun nước inox Kalpen KK02 2.5 lít',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '590.000',
            'old_price'   => '700.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Kalpen',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/am-dun-nuoc-inox-kalpen-kk02-25-lit.jpg',
            'local_file'  => 'am-dun-nuoc-inox-kalpen-kk02-25-lit.jpg',
            'excerpt'     => 'Ấm đun nước inox Kalpen KK02 dùng cho bếp từ, làm từ inox 304 chống han gỉ, đáy dày 5 lớp bắt từ tốt, đun nước nhanh sôi.',
            'specs'       => "Thương hiệu: Kalpen
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Ấm đun nước inox Kalpen KK02 2.5 lít</h3>
<p><strong>Ấm đun nước inox Kalpen KK02 2.5 lít</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Kalpen</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ấm đun nước inox Kalpen KK02 dùng cho bếp từ, làm từ inox 304 chống han gỉ, đáy dày 5 lớp bắt từ tốt, đun nước nhanh sôi.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'am-dun-nuoc-hawonkoo-keh-181',
            'title'       => 'Ấm đun nước Hawonkoo KEH-181',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '359.000',
            'old_price'   => '420.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Hawonkoo',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/am-dun-nuoc-hawonkoo-keh-181.jpg',
            'local_file'  => 'am-dun-nuoc-hawonkoo-keh-181.jpg',
            'excerpt'     => 'Ấm đun nước Hawonkoo KEH-181 thiết kế hiện đại , đun sôi nhanh với công suất 1.500W, chất liệu an toàn và tích hợp nhiều tính năng bảo vệ tiện lợi cho gia đình.',
            'specs'       => "Thương hiệu: Hawonkoo
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Ấm đun nước Hawonkoo KEH-181</h3>
<p><strong>Ấm đun nước Hawonkoo KEH-181</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Hawonkoo</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ấm đun nước Hawonkoo KEH-181 thiết kế hiện đại , đun sôi nhanh với công suất 1.500W, chất liệu an toàn và tích hợp nhiều tính năng bảo vệ tiện lợi cho gia đình.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'am-dun-nuoc-sieu-toc-braun-wk1100wh',
            'title'       => 'Ấm đun nước siêu tốc Braun WK1100WH',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '790.000',
            'old_price'   => '930.000',
            'badge'       => 'HOT',
            'brand'       => 'Braun',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/am-dun-nuoc-sieu-toc-braun-wk1100wh.jpg',
            'local_file'  => 'am-dun-nuoc-sieu-toc-braun-wk1100wh.jpg',
            'excerpt'     => 'Ấm đun nước siêu tốc Braun WK1100WH dung tích 1.7L, công suất 2.200W, đun sôi nhanh, chất liệu an toàn, đế xoay 360° và hệ thống bảo vệ 4 chiều.',
            'specs'       => "Thương hiệu: Braun
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Ấm đun nước siêu tốc Braun WK1100WH</h3>
<p><strong>Ấm đun nước siêu tốc Braun WK1100WH</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Braun</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ấm đun nước siêu tốc Braun WK1100WH dung tích 1.7L, công suất 2.200W, đun sôi nhanh, chất liệu an toàn, đế xoay 360° và hệ thống bảo vệ 4 chiều.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'de-lot-ly-giu-am-thong-minh-di-dong-tiross-ts5100',
            'title'       => 'Đế lót ly giữ ấm thông minh di động Tiross TS5100',
            'category'    => 'hut-bui-loc-khi',
            'cat_name'    => 'Máy Hút Bụi & Lọc Không Khí Ô Tô',
            'price'       => '430.000',
            'old_price'   => '510.000',
            'badge'       => 'MỚI',
            'brand'       => 'Tiross',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/de-lot-ly-giu-am-thong-minh-di-dong-tiross-ts5100.jpg',
            'local_file'  => 'de-lot-ly-giu-am-thong-minh-di-dong-tiross-ts5100.jpg',
            'excerpt'     => 'Đế lót ly giữ ấm thông minh di động Tiross TS5100 giữ ấm đồ uống, có nhiều chế độ và hẹn giờ, thiết kế đẹp mắt.',
            'specs'       => "Thương hiệu: Tiross
Công suất hút: 6.000Pa - 15.000Pa lốc xoáy
Bộ lọc: Màng lọc HEPA tiêu chuẩn giữ lại 99.9% bụi mịn PM2.5
Nguồn pin / điện: Pin sạc Lithium không dây tiện dụng
Thời lượng hoạt động: 25 - 45 phút liên tục
Độ ồn: < 65dB vận hành êm ái",
            'content'     => '<h3>Tổng quan sản phẩm Đế lót ly giữ ấm thông minh di động Tiross TS5100</h3>
<p><strong>Đế lót ly giữ ấm thông minh di động Tiross TS5100</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Tiross</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Đế lót ly giữ ấm thông minh di động Tiross TS5100 giữ ấm đồ uống, có nhiều chế độ và hẹn giờ, thiết kế đẹp mắt.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'binh-dung-xa-phong-nhan-tay-sokimi-sm-4108',
            'title'       => 'Bình đựng xà phòng nhấn tay Sokimi SM-4108',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '310.000',
            'old_price'   => '370.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Sokimi',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/binh-dung-xa-phong-nhan-tay-sokimi-sm-4108.jpg',
            'local_file'  => 'binh-dung-xa-phong-nhan-tay-sokimi-sm-4108.jpg',
            'excerpt'     => 'Bình đựng xà phòng nhấn tay Sokimi SM-4108 lắp đặt treo tường, làm từ inox không gỉ, chỉ 1 lần nhấn sẽ lấy đủ lượng xà phòng để rửa tay.',
            'specs'       => "Thương hiệu: Sokimi
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Bình đựng xà phòng nhấn tay Sokimi SM-4108</h3>
<p><strong>Bình đựng xà phòng nhấn tay Sokimi SM-4108</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Sokimi</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Bình đựng xà phòng nhấn tay Sokimi SM-4108 lắp đặt treo tường, làm từ inox không gỉ, chỉ 1 lần nhấn sẽ lấy đủ lượng xà phòng để rửa tay.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'binh-dung-xa-phong-sokimi-sm-4104',
            'title'       => 'Bình đựng xà phòng Sokimi SM-4104',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '310.000',
            'old_price'   => '370.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Sokimi',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/binh-dung-xa-phong-sokimi-sm-4104.jpg',
            'local_file'  => 'binh-dung-xa-phong-sokimi-sm-4104.jpg',
            'excerpt'     => 'Bình đựng xà phòng Sokimi SM-4104 có nút nhấn bền, chỉ một lần nhấn sẽ cho ra lượng xà phòng vừa đủ sử dụng giúp tiết kiệm, tránh lãng phí.',
            'specs'       => "Thương hiệu: Sokimi
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Bình đựng xà phòng Sokimi SM-4104</h3>
<p><strong>Bình đựng xà phòng Sokimi SM-4104</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Sokimi</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Bình đựng xà phòng Sokimi SM-4104 có nút nhấn bền, chỉ một lần nhấn sẽ cho ra lượng xà phòng vừa đủ sử dụng giúp tiết kiệm, tránh lãng phí.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'hop-dung-dau-goi-sua-tam-xinda-zyq-138-white',
            'title'       => 'Hộp đựng dầu gội sữa tắm Xinda ZYQ-138 White',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '159.000',
            'old_price'   => '190.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Xinda',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/hop-dung-dau-goi-sua-tam-xinda-zyq-138-white.jpg',
            'local_file'  => 'hop-dung-dau-goi-sua-tam-xinda-zyq-138-white.jpg',
            'excerpt'     => 'Hộp đựng dầu gội sữa tắm Xinda ZYQ-138 White có khóa an toàn, chống rò rỉ xà phòng. Được làm bằng chất liệu nhựa ABS kháng khuẩn',
            'specs'       => "Thương hiệu: Xinda
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Hộp đựng dầu gội sữa tắm Xinda ZYQ-138 White</h3>
<p><strong>Hộp đựng dầu gội sữa tắm Xinda ZYQ-138 White</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Xinda</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Hộp đựng dầu gội sữa tắm Xinda ZYQ-138 White có khóa an toàn, chống rò rỉ xà phòng. Được làm bằng chất liệu nhựa ABS kháng khuẩn</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'binh-dung-xa-phong-cam-ung-sokimi-sm800',
            'title'       => 'Bình đựng xà phòng cảm ứng Sokimi SM800',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '530.000',
            'old_price'   => '630.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Sokimi',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/binh-dung-xa-phong-cam-ung-sokimi-sm800.jpg',
            'local_file'  => 'binh-dung-xa-phong-cam-ung-sokimi-sm800.jpg',
            'excerpt'     => 'Bình đựng xà phòng cảm ứng Sokimi SM800 dùng 4 viên pin 2A, dung tích 600ml, lấy xà phòng mà không cần chạm tay trực tiếp vào bình.',
            'specs'       => "Thương hiệu: Sokimi
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Bình đựng xà phòng cảm ứng Sokimi SM800</h3>
<p><strong>Bình đựng xà phòng cảm ứng Sokimi SM800</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Sokimi</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Bình đựng xà phòng cảm ứng Sokimi SM800 dùng 4 viên pin 2A, dung tích 600ml, lấy xà phòng mà không cần chạm tay trực tiếp vào bình.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'hop-dung-dau-goi-xa-phong-xinda-zyq100',
            'title'       => 'Hộp đựng dầu gội xà phòng Xinda ZYQ100',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '500.000',
            'old_price'   => '590.000',
            'badge'       => 'HOT',
            'brand'       => 'Xinda',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/hop-dung-dau-goi-xa-phong-xinda-zyq100.jpg',
            'local_file'  => 'hop-dung-dau-goi-xa-phong-xinda-zyq100.jpg',
            'excerpt'     => 'Hộp đựng dầu gội xà phòng Xinda ZYQ100 thiết kế dạng nút nhấn lấy dầu gội và xà phòng rất tiện. Xinda ZYQ100 làm bằng nhựa, dung tích 1 lít.',
            'specs'       => "Thương hiệu: Xinda
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Hộp đựng dầu gội xà phòng Xinda ZYQ100</h3>
<p><strong>Hộp đựng dầu gội xà phòng Xinda ZYQ100</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Xinda</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Hộp đựng dầu gội xà phòng Xinda ZYQ100 thiết kế dạng nút nhấn lấy dầu gội và xà phòng rất tiện. Xinda ZYQ100 làm bằng nhựa, dung tích 1 lít.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'hop-dung-xa-phong-doi-mau-trang-zyq-138s-white',
            'title'       => 'Hộp đựng xà phòng đôi, màu trắng ZYQ-138S White',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '360.000',
            'old_price'   => '420.000',
            'badge'       => 'MỚI',
            'brand'       => 'Xinda',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/hop-dung-xa-phong-doi-mau-trang-zyq-138s-white.jpg',
            'local_file'  => 'hop-dung-xa-phong-doi-mau-trang-zyq-138s-white.jpg',
            'excerpt'     => 'Hộp đựng xà phòng đôi, màu trắng ZYQ-138S White thiết kế 2 hộp riêng biệt nhưng chung khung đỡ giúp bạn chứa đồng thời 2 dung dịch khác nhau.',
            'specs'       => "Thương hiệu: Xinda
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Hộp đựng xà phòng đôi, màu trắng ZYQ-138S White</h3>
<p><strong>Hộp đựng xà phòng đôi, màu trắng ZYQ-138S White</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Xinda</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Hộp đựng xà phòng đôi, màu trắng ZYQ-138S White thiết kế 2 hộp riêng biệt nhưng chung khung đỡ giúp bạn chứa đồng thời 2 dung dịch khác nhau.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'binh-dung-xa-phong-cam-ung-sokimi-sm600',
            'title'       => 'Bình đựng xà phòng cảm ứng Sokimi SM600',
            'category'    => 'tau-sac-gia-do',
            'cat_name'    => 'Tẩu Sạc Nhanh & Giá Đỡ Điện Thoại',
            'price'       => '1.090.000',
            'old_price'   => '1.290.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Sokimi',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/binh-dung-xa-phong-cam-ung-sokimi-sm600.jpg',
            'local_file'  => 'binh-dung-xa-phong-cam-ung-sokimi-sm600.jpg',
            'excerpt'     => 'Bình đựng xà phòng cảm ứng Sokimi SM600 thường được sử dụng tại các nhà vệ sinh công cộng, khách sạn, resort, nhà hàng,...',
            'specs'       => "Thương hiệu: Sokimi
Công suất sạc: 30W - 100W sạc nhanh đa giao thức (PD, QC 3.0, PPS)
Cổng kết nối: USB-A + Type-C kép sạc 2 thiết bị cùng lúc
Chất liệu: Hợp kim nhôm tản nhiệt cao cấp + ABS chống cháy
Cơ chế giá đỡ: Hít nam châm MagSafe hoặc khóa tự động trọng lực
Nguồn vào: 12V - 24V tương thích mọi dòng xe",
            'content'     => '<h3>Tổng quan sản phẩm Bình đựng xà phòng cảm ứng Sokimi SM600</h3>
<p><strong>Bình đựng xà phòng cảm ứng Sokimi SM600</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Sokimi</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Bình đựng xà phòng cảm ứng Sokimi SM600 thường được sử dụng tại các nhà vệ sinh công cộng, khách sạn, resort, nhà hàng,...</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'tam-tham-che-bang-dieu-khien-o-to',
            'title'       => 'Tấm thảm che bảng điều khiển ô tô',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '230.000',
            'old_price'   => '270.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Trung Quốc',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/tam-tham-che-bang-dieu-khien-o-to.jpg',
            'local_file'  => 'tam-tham-che-bang-dieu-khien-o-to.jpg',
            'excerpt'     => 'Tấm thảm che bảng điều khiển ô tô làm từ nhung lông cừu hoặc da vân cacbon. Thảm Taplo ô tô dùng để che bảng điều khiển ô tô.',
            'specs'       => "Thương hiệu: Trung Quốc
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Tấm thảm che bảng điều khiển ô tô</h3>
<p><strong>Tấm thảm che bảng điều khiển ô tô</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Trung Quốc</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Tấm thảm che bảng điều khiển ô tô làm từ nhung lông cừu hoặc da vân cacbon. Thảm Taplo ô tô dùng để che bảng điều khiển ô tô.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'lot-cop-o-to-vasic-xe-7-cho',
            'title'       => 'Lót cốp ô tô Vasic (Xe 7 chỗ)',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '470.000',
            'old_price'   => '550.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Vasic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/lot-cop-o-to-vasic-xe-7-cho.jpg',
            'local_file'  => 'lot-cop-o-to-vasic-xe-7-cho.jpg',
            'excerpt'     => 'Lót cốp ô tô Vasic (Xe 7 chỗ) có vật liệu được làm từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh',
            'specs'       => "Thương hiệu: Vasic
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Lót cốp ô tô Vasic (Xe 7 chỗ)</h3>
<p><strong>Lót cốp ô tô Vasic (Xe 7 chỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Vasic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Lót cốp ô tô Vasic (Xe 7 chỗ) có vật liệu được làm từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'tham-lot-san-o-to-vasic-xe-5-cho',
            'title'       => 'Thảm lót sàn ô tô Vasic (Xe 5 chỗ)',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '1.690.000',
            'old_price'   => '1.990.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Vasic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/tham-lot-san-o-to-vasic-xe-5-cho.jpg',
            'local_file'  => 'tham-lot-san-o-to-vasic-xe-5-cho.jpg',
            'excerpt'     => 'Thảm lót sàn ô tô Vasic (Xe 5 chỗ) chất liệu từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh',
            'specs'       => "Thương hiệu: Vasic
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Thảm lót sàn ô tô Vasic (Xe 5 chỗ)</h3>
<p><strong>Thảm lót sàn ô tô Vasic (Xe 5 chỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Vasic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Thảm lót sàn ô tô Vasic (Xe 5 chỗ) chất liệu từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'tham-lot-san-o-to-vasic-xe-7-cho',
            'title'       => 'Thảm lót sàn ô tô Vasic (Xe 7 chỗ)',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '2.500.000',
            'old_price'   => '2.950.000',
            'badge'       => 'HOT',
            'brand'       => 'Vasic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/tham-lot-san-o-to-vasic-xe-7-cho.jpg',
            'local_file'  => 'tham-lot-san-o-to-vasic-xe-7-cho.jpg',
            'excerpt'     => 'Thảm lót sàn ô tô Vasic (Xe 7 chỗ) có chất liệu từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh',
            'specs'       => "Thương hiệu: Vasic
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Thảm lót sàn ô tô Vasic (Xe 7 chỗ)</h3>
<p><strong>Thảm lót sàn ô tô Vasic (Xe 7 chỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Vasic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Thảm lót sàn ô tô Vasic (Xe 7 chỗ) có chất liệu từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'lot-cop-o-to-vasic-xe-5-cho',
            'title'       => 'Lót cốp ô tô Vasic (Xe 5 chỗ)',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '1.120.000',
            'old_price'   => '1.320.000',
            'badge'       => 'MỚI',
            'brand'       => 'Vasic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/lot-cop-o-to-vasic-xe-5-cho.jpg',
            'local_file'  => 'lot-cop-o-to-vasic-xe-5-cho.jpg',
            'excerpt'     => 'Lót cốp ô tô Vasic (Xe 5 chỗ) có vật liệu được làm từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh',
            'specs'       => "Thương hiệu: Vasic
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Lót cốp ô tô Vasic (Xe 5 chỗ)</h3>
<p><strong>Lót cốp ô tô Vasic (Xe 5 chỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Vasic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Lót cốp ô tô Vasic (Xe 5 chỗ) có vật liệu được làm từ hạt nhựa PVC cao cấp, không mùi độc hại và ẩm mốc, dễ lắp đặt và vệ sinh</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'op-lung-hang-ghe-thu-3-vasic-xe-7-cho',
            'title'       => 'Ốp lưng hàng ghế thứ 3 Vasic (Xe 7 chỗ)',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '650.000',
            'old_price'   => '770.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Vasic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/op-lung-hang-ghe-thu-3-vasic-xe-7-cho.jpg',
            'local_file'  => 'op-lung-hang-ghe-thu-3-vasic-xe-7-cho.jpg',
            'excerpt'     => 'Ốp lưng hàng ghế thứ 3 Vasic (Xe 7 chỗ) giúp bảo vệ mặt lưng cho hàng ghế sau cùng, bảo vệ ghế không bị trầy xước',
            'specs'       => "Thương hiệu: Vasic
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Ốp lưng hàng ghế thứ 3 Vasic (Xe 7 chỗ)</h3>
<p><strong>Ốp lưng hàng ghế thứ 3 Vasic (Xe 7 chỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Vasic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ốp lưng hàng ghế thứ 3 Vasic (Xe 7 chỗ) giúp bảo vệ mặt lưng cho hàng ghế sau cùng, bảo vệ ghế không bị trầy xước</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'boc-vo-lang-the-thao-sparco-spc1111-da-pu-carbon-cao-cap',
            'title'       => 'Bọc vô lăng thể thao Sparco SPC1111 da PU carbon cao cấp',
            'category'    => 'boc-vo-lang-tham-san',
            'cat_name'    => 'Bọc Vô Lăng & Thảm Lót Sàn Ô Tô',
            'price'       => '480.000',
            'old_price'   => '650.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Sparco Corsa',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/boc-vo-lang-the-thao-sparco-spc1111-da-pu-carbon-cao-cap.jpg',
            'local_file'  => 'boc-vo-lang-the-thao-sparco-spc1111-da-pu-carbon-cao-cap.jpg',
            'excerpt'     => 'Bọc vô lăng cao cấp Sparco chất liệu da PU đục lỗ thoáng khí kết hợp vân carbon thể thao, chống trơn trượt mồ hôi tay cực tốt.',
            'specs'       => "Thương hiệu: Sparco Corsa
Chất liệu: Da PU cao cấp kết hợp sợi carbon / cao su đúc nguyên khối
Kích thước: Chuẩn form xe đường kính 38cm hoặc cắt may theo từng dòng xe
Đặc tính: Không mùi hôi độc hại, chống trơn trượt mồ hôi tay, dễ lau chùi
Độ bền: Trên 5 năm sử dụng liên tục",
            'content'     => '<h3>Tổng quan sản phẩm Bọc vô lăng thể thao Sparco SPC1111 da PU carbon cao cấp</h3>
<p><strong>Bọc vô lăng thể thao Sparco SPC1111 da PU carbon cao cấp</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Sparco Corsa</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Bọc vô lăng cao cấp Sparco chất liệu da PU đục lỗ thoáng khí kết hợp vân carbon thể thao, chống trơn trượt mồ hôi tay cực tốt.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-dien-quang-eco-dq-esk-8eco-8-lo',
            'title'       => 'Ổ cắm Điện Quang ECO ĐQ ESK 8ECO (8 lỗ)',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '175.000',
            'old_price'   => '210.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Điện Quang',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-dien-quang-eco-dq-esk-8eco-8-lo.jpg',
            'local_file'  => 'o-cam-dien-quang-eco-dq-esk-8eco-8-lo.jpg',
            'excerpt'     => 'Ổ cắm Điện Quang ECO ĐQ ESK 8ECO được làm từ nhựa ABS nguyên chất chịu nhiệt, gồm 4 lỗ 3 chấu và 4 lỗ 2 chấu.',
            'specs'       => "Thương hiệu: Điện Quang
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm Điện Quang ECO ĐQ ESK 8ECO (8 lỗ)</h3>
<p><strong>Ổ cắm Điện Quang ECO ĐQ ESK 8ECO (8 lỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Điện Quang</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm Điện Quang ECO ĐQ ESK 8ECO được làm từ nhựa ABS nguyên chất chịu nhiệt, gồm 4 lỗ 3 chấu và 4 lỗ 2 chấu.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-dien-quang-eco-dq-esk-6eco-6-lo',
            'title'       => 'Ổ cắm Điện Quang ECO ĐQ ESK 6ECO (6 lỗ)',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '150.000',
            'old_price'   => '180.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Điện Quang',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-dien-quang-eco-dq-esk-6eco-6-lo.jpg',
            'local_file'  => 'o-cam-dien-quang-eco-dq-esk-6eco-6-lo.jpg',
            'excerpt'     => 'Ổ cắm Điện Quang ECO ĐQ ESK 6ECO (6 lỗ) có thiết kế nhỏ gọn, dây dài 5m, 6 lỗ cắm, công nghệ Extra Power, an toàn, và dễ sử dụng.',
            'specs'       => "Thương hiệu: Điện Quang
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm Điện Quang ECO ĐQ ESK 6ECO (6 lỗ)</h3>
<p><strong>Ổ cắm Điện Quang ECO ĐQ ESK 6ECO (6 lỗ)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Điện Quang</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm Điện Quang ECO ĐQ ESK 6ECO (6 lỗ) có thiết kế nhỏ gọn, dây dài 5m, 6 lỗ cắm, công nghệ Extra Power, an toàn, và dễ sử dụng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-co-day-panasonic-wchg28352-3m',
            'title'       => 'Ổ cắm có dây Panasonic WCHG28352 (3m)',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '750.000',
            'old_price'   => '890.000',
            'badge'       => 'HOT',
            'brand'       => 'Panasonic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-co-day-panasonic-wchg28352-3m.jpg',
            'local_file'  => 'o-cam-co-day-panasonic-wchg28352-3m.jpg',
            'excerpt'     => 'Ổ cắm có dây Panasonic WCHG28352 với công suất 3.500W, độ bền cao và khả năng chịu nhiệt tốt, mang đến sự thuận tiện và an toàn khi sử dụng.',
            'specs'       => "Thương hiệu: Panasonic
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm có dây Panasonic WCHG28352 (3m)</h3>
<p><strong>Ổ cắm có dây Panasonic WCHG28352 (3m)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Panasonic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm có dây Panasonic WCHG28352 với công suất 3.500W, độ bền cao và khả năng chịu nhiệt tốt, mang đến sự thuận tiện và an toàn khi sử dụng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-dien-quang-dq-esk-sm750sl-5-lo-3-chau',
            'title'       => 'Ổ cắm Điện Quang ĐQ ESK SM750SL (5 lỗ 3 chấu)',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '268.000',
            'old_price'   => '320.000',
            'badge'       => 'MỚI',
            'brand'       => 'Điện Quang',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-dien-quang-dq-esk-sm750sl-5-lo-3-chau.jpg',
            'local_file'  => 'o-cam-dien-quang-dq-esk-sm750sl-5-lo-3-chau.jpg',
            'excerpt'     => 'Ổ cắm Điện Quang ĐQ ESK SM750SL gồm 5 lỗ cắm đa năng, công suất 3200W cùng nhiều tính năng an toàn, đáp ứng tốt nhu cầu sử dụng điện trong gia đình và văn phòng.',
            'specs'       => "Thương hiệu: Điện Quang
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm Điện Quang ĐQ ESK SM750SL (5 lỗ 3 chấu)</h3>
<p><strong>Ổ cắm Điện Quang ĐQ ESK SM750SL (5 lỗ 3 chấu)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Điện Quang</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm Điện Quang ĐQ ESK SM750SL gồm 5 lỗ cắm đa năng, công suất 3200W cùng nhiều tính năng an toàn, đáp ứng tốt nhu cầu sử dụng điện trong gia đình và văn phòng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-co-day-panasonic-wchg24332w',
            'title'       => 'Ổ cắm có dây Panasonic WCHG24332W',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '420.000',
            'old_price'   => '500.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Panasonic',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-co-day-panasonic-wchg24332w.jpg',
            'local_file'  => 'o-cam-co-day-panasonic-wchg24332w.jpg',
            'excerpt'     => 'Ổ cắm có dây Panasonic WCHG24332W có khả năng chịu tải lên tới 2.300W, tự động ngắt khi vượt quá công suất chịu tải.',
            'specs'       => "Thương hiệu: Panasonic
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm có dây Panasonic WCHG24332W</h3>
<p><strong>Ổ cắm có dây Panasonic WCHG24332W</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Panasonic</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm có dây Panasonic WCHG24332W có khả năng chịu tải lên tới 2.300W, tự động ngắt khi vượt quá công suất chịu tải.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-dien-quang-dq-003a-04-6-lo-3-chau',
            'title'       => 'Ổ cắm Điện Quang ĐQ 003A-04 (6 lỗ 3 chấu)',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '255.000',
            'old_price'   => '300.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Điện Quang',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-dien-quang-dq-003a-04-6-lo-3-chau.jpg',
            'local_file'  => 'o-cam-dien-quang-dq-003a-04-6-lo-3-chau.jpg',
            'excerpt'     => 'Ổ cắm Điện Quang ĐQ 003A-04 với chất liệu ABS nguyên chất và tính năng tự ngắt điện giúp bảo vệ an toàn cho người sử dụng và thiết bị điện.',
            'specs'       => "Thương hiệu: Điện Quang
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm Điện Quang ĐQ 003A-04 (6 lỗ 3 chấu)</h3>
<p><strong>Ổ cắm Điện Quang ĐQ 003A-04 (6 lỗ 3 chấu)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Điện Quang</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm Điện Quang ĐQ 003A-04 với chất liệu ABS nguyên chất và tính năng tự ngắt điện giúp bảo vệ an toàn cho người sử dụng và thiết bị điện.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'o-cam-keo-dai-lioa-qt30-3-15a-kieu-rulo-danh-cho-cong-truong',
            'title'       => 'Ổ cắm kéo dài LiOA QT30-3-15A kiểu Rulo (Dành cho công trường)',
            'category'    => 'goi-tua-bat-phu',
            'cat_name'    => 'Gối Tựa Đầu, Tựa Lưng & Bạt Phủ Xe',
            'price'       => '1.040.000',
            'old_price'   => '1.230.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'LiOA',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/o-cam-keo-dai-lioa-qt30-3-15a-kieu-rulo-danh-cho-cong-truong.jpg',
            'local_file'  => 'o-cam-keo-dai-lioa-qt30-3-15a-kieu-rulo-danh-cho-cong-truong.jpg',
            'excerpt'     => 'Ổ cắm kéo dài LiOA QT30-3-15A kiểu Rulo có thể dùng được cho các thiết bị điện trong gia đình hay những nơi có nhu cầu sử dụng ổ cắm dây dài. Công suất chịu tải 3.300W',
            'specs'       => "Thương hiệu: LiOA
Chất liệu: Cao su non nhớ hình Memory Foam / Vải tráng bạc nhôm 3 lớp
Công năng: Nâng đỡ cột sống cổ và thắt lưng, chống nóng cách nhiệt tia UV 99%
Tương thích: Thiết kế vừa vặn cho tất cả các dòng xe Sedan, SUV, Crossover",
            'content'     => '<h3>Tổng quan sản phẩm Ổ cắm kéo dài LiOA QT30-3-15A kiểu Rulo (Dành cho công trường)</h3>
<p><strong>Ổ cắm kéo dài LiOA QT30-3-15A kiểu Rulo (Dành cho công trường)</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>LiOA</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Ổ cắm kéo dài LiOA QT30-3-15A kiểu Rulo có thể dùng được cho các thiết bị điện trong gia đình hay những nơi có nhu cầu sử dụng ổ cắm dây dài. Công suất chịu tải 3.300W</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'nuoc-hoa-o-to-cao-cap-etonner-e1701-60ml',
            'title'       => 'Nước hoa ô tô cao cấp Etonner E1701 - 60ml',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '1.060.000',
            'old_price'   => '1.250.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Etonner',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/nuoc-hoa-o-to-cao-cap-etonner-e1701-60ml.jpg',
            'local_file'  => 'nuoc-hoa-o-to-cao-cap-etonner-e1701-60ml.jpg',
            'excerpt'     => 'Nước hoa ô tô cao cấp Etonner E1701 có 4 mùi hương đặc trưng sẽ đem hương thơm tự nhiên, thoải mái, thư giãn cho người lái xe.',
            'specs'       => "Thương hiệu: Etonner
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Nước hoa ô tô cao cấp Etonner E1701 - 60ml</h3>
<p><strong>Nước hoa ô tô cao cấp Etonner E1701 - 60ml</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Etonner</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Nước hoa ô tô cao cấp Etonner E1701 có 4 mùi hương đặc trưng sẽ đem hương thơm tự nhiên, thoải mái, thư giãn cho người lái xe.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'nuoc-hoa-o-to-cao-cap-etonner-e1801',
            'title'       => 'Nước hoa ô tô cao cấp Etonner E1801',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '990.000',
            'old_price'   => '1.170.000',
            'badge'       => 'HOT',
            'brand'       => 'Etonner',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/nuoc-hoa-o-to-cao-cap-etonner-e1801.jpg',
            'local_file'  => 'nuoc-hoa-o-to-cao-cap-etonner-e1801.jpg',
            'excerpt'     => 'Nước hoa ô tô cao cấp Etonner E1801 mang đến mùi hương quý phái, sang trọng cũng như sở hữu thiết kế thanh lịch, quý phái và phóng khoáng.',
            'specs'       => "Thương hiệu: Etonner
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Nước hoa ô tô cao cấp Etonner E1801</h3>
<p><strong>Nước hoa ô tô cao cấp Etonner E1801</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Etonner</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Nước hoa ô tô cao cấp Etonner E1801 mang đến mùi hương quý phái, sang trọng cũng như sở hữu thiết kế thanh lịch, quý phái và phóng khoáng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'nuoc-hoa-o-to-cao-cap-dang-xit-etonner-e30',
            'title'       => 'Nước hoa ô tô cao cấp dạng xịt Etonner E30',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '750.000',
            'old_price'   => '890.000',
            'badge'       => 'MỚI',
            'brand'       => 'Etonner',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/nuoc-hoa-o-to-cao-cap-dang-xit-etonner-e30.jpg',
            'local_file'  => 'nuoc-hoa-o-to-cao-cap-dang-xit-etonner-e30.jpg',
            'excerpt'     => 'Nước hoa ô tô cao cấp dạng xịt Etonner E30 có hương thơm không quá nồng, tỏa hương thoang thoảng giúp  khử mùi và làm thơm xe ô tô hiệu quả.',
            'specs'       => "Thương hiệu: Etonner
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Nước hoa ô tô cao cấp dạng xịt Etonner E30</h3>
<p><strong>Nước hoa ô tô cao cấp dạng xịt Etonner E30</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Etonner</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Nước hoa ô tô cao cấp dạng xịt Etonner E30 có hương thơm không quá nồng, tỏa hương thoang thoảng giúp  khử mùi và làm thơm xe ô tô hiệu quả.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'sap-thom-treo-xe-o-to-etonner-f1711',
            'title'       => 'Sáp thơm treo xe ô tô Etonner F1711',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '1.300.000',
            'old_price'   => '1.530.000',
            'badge'       => 'BÁN CHẠY',
            'brand'       => 'Etonner',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/sap-thom-treo-xe-o-to-etonner-f1711.jpg',
            'local_file'  => 'sap-thom-treo-xe-o-to-etonner-f1711.jpg',
            'excerpt'     => 'Sáp thơm treo xe ô tô Etonner F1711 tỏa ra hương thơm dễ chịu, lưu giữ mùi lâu, dây treo bằng da lộn, mùi hương an toàn cho sức khỏe.',
            'specs'       => "Thương hiệu: Etonner
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Sáp thơm treo xe ô tô Etonner F1711</h3>
<p><strong>Sáp thơm treo xe ô tô Etonner F1711</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Etonner</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Sáp thơm treo xe ô tô Etonner F1711 tỏa ra hương thơm dễ chịu, lưu giữ mùi lâu, dây treo bằng da lộn, mùi hương an toàn cho sức khỏe.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'dung-dich-tay-bang-keo-va-nhua-duong-ekokemika-xtar-pro',
            'title'       => 'Dung dịch tẩy băng keo và nhựa đường Ekokemika XTAR PRO',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '445.000',
            'old_price'   => '530.000',
            'badge'       => 'CHÍNH HÃNG',
            'brand'       => 'Ekokemika',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/dung-dich-tay-bang-keo-va-nhua-duong-ekokemika-xtar-pro.jpg',
            'local_file'  => 'dung-dich-tay-bang-keo-va-nhua-duong-ekokemika-xtar-pro.jpg',
            'excerpt'     => 'Dung dịch tẩy băng keo và nhựa đường Ekokemika XTAR PRO sẽ tẩy sạch vết nhựa đường, vết keo, vết bẩn do decal bám trên ô tô nhanh chóng.',
            'specs'       => "Thương hiệu: Ekokemika
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Dung dịch tẩy băng keo và nhựa đường Ekokemika XTAR PRO</h3>
<p><strong>Dung dịch tẩy băng keo và nhựa đường Ekokemika XTAR PRO</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Ekokemika</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Dung dịch tẩy băng keo và nhựa đường Ekokemika XTAR PRO sẽ tẩy sạch vết nhựa đường, vết keo, vết bẩn do decal bám trên ô tô nhanh chóng.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'dung-dich-ve-sinh-do-da-chuyen-dung-michelin-w32187',
            'title'       => 'Dung dịch vệ sinh đồ da chuyên dụng Michelin W32187',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '230.000',
            'old_price'   => '270.000',
            'badge'       => 'CAO CẤP',
            'brand'       => 'Michelin',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/dung-dich-ve-sinh-do-da-chuyen-dung-michelin-w32187.jpg',
            'local_file'  => 'dung-dich-ve-sinh-do-da-chuyen-dung-michelin-w32187.jpg',
            'excerpt'     => 'Dung dịch vệ sinh đồ da chuyên dụng Michelin W32187 dùng để vệ sinh bề mặt da trong nội thất xe hơi, giúp làm sạch mọi vết bẩn, vết ố.',
            'specs'       => "Thương hiệu: Michelin
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Dung dịch vệ sinh đồ da chuyên dụng Michelin W32187</h3>
<p><strong>Dung dịch vệ sinh đồ da chuyên dụng Michelin W32187</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Michelin</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Dung dịch vệ sinh đồ da chuyên dụng Michelin W32187 dùng để vệ sinh bề mặt da trong nội thất xe hơi, giúp làm sạch mọi vết bẩn, vết ố.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'dung-dich-rua-khoang-dong-co-ekokemika-motor',
            'title'       => 'Dung dịch rửa khoang động cơ Ekokemika MOTOR',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '265.000',
            'old_price'   => '310.000',
            'badge'       => 'KHUYÊN DÙNG',
            'brand'       => 'Ekokemika',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/dung-dich-rua-khoang-dong-co-ekokemika-motor.jpg',
            'local_file'  => 'dung-dich-rua-khoang-dong-co-ekokemika-motor.jpg',
            'excerpt'     => 'Dung dịch rửa khoang động cơ Ekokemika MOTOR pha loãng với nước theo tỉ lệ 1:5 đến 1:10 sẽ loại bỏ 95% bụi bẩn, dầu và chất tĩnh điện trong khoang động cơ ô tô.',
            'specs'       => "Thương hiệu: Ekokemika
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Dung dịch rửa khoang động cơ Ekokemika MOTOR</h3>
<p><strong>Dung dịch rửa khoang động cơ Ekokemika MOTOR</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Ekokemika</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Dung dịch rửa khoang động cơ Ekokemika MOTOR pha loãng với nước theo tỉ lệ 1:5 đến 1:10 sẽ loại bỏ 95% bụi bẩn, dầu và chất tĩnh điện trong khoang động cơ ô tô.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

        array(
            'slug'        => 'dung-dich-lam-sach-la-zang-o-kinh-va-gam-xe-perlega',
            'title'       => 'Dung dịch làm sạch la zăng, ố kính và gầm xe Perlega',
            'category'    => 'cham-soc-xe-nuoc-hoa',
            'cat_name'    => 'Nước Hoa & Dung Dịch Chăm Sóc Xe',
            'price'       => '215.000',
            'old_price'   => '250.000',
            'badge'       => 'HOT',
            'brand'       => 'Ekokemika',
            'warranty'    => '12 tháng chính hãng',
            'origin'      => 'Phân phối chính hãng META.vn & Lắp đặt tại Hải Hà',
            'img'         => $acc_upload_url . '/dung-dich-lam-sach-la-zang-o-kinh-va-gam-xe-perlega.jpg',
            'local_file'  => 'dung-dich-lam-sach-la-zang-o-kinh-va-gam-xe-perlega.jpg',
            'excerpt'     => 'Dung dịch làm sạch la zăng, ố kính và gầm xe Perlega sẽ loại bỏ cặn bẩn trên động cơ, gỉ sét từ gầm xe, loại bỏ vết ố vàng đọng lại trên ô tô hiệu quả.',
            'specs'       => "Thương hiệu: Ekokemika
Xuất xứ: Nhập khẩu chính hãng & phân phối META.vn
Dung tích / Khối lượng: Tiêu chuẩn đóng chai nhà sản xuất
Công dụng: Vệ sinh, khử mùi, dưỡng bóng và bảo vệ bề mặt nội ngoại thất ô tô
Độ an toàn: Chứng nhận an toàn sức khỏe người ngồi trên xe",
            'content'     => '<h3>Tổng quan sản phẩm Dung dịch làm sạch la zăng, ố kính và gầm xe Perlega</h3>
<p><strong>Dung dịch làm sạch la zăng, ố kính và gầm xe Perlega</strong> là dòng phụ kiện xe hơi chính hãng thương hiệu <strong>Ekokemika</strong>, được phân phối trực tiếp bởi <strong>META.vn</strong> và tiếp nhận hỗ trợ kỹ thuật, lắp đặt tại hệ thống xưởng dịch vụ <strong>Ôtô Hải Hà</strong>. Dung dịch làm sạch la zăng, ố kính và gầm xe Perlega sẽ loại bỏ cặn bẩn trên động cơ, gỉ sét từ gầm xe, loại bỏ vết ố vàng đọng lại trên ô tô hiệu quả.</p>

<h3>Đặc điểm nổi bật &amp; Lợi ích sử dụng:</h3>
<ul>
    <li><strong>Chất lượng chính hãng 100%:</strong> Sản phẩm có đầy đủ tem phụ, mã vạch bảo hành điện tử chính hãng từ nhà phân phối.</li>
    <li><strong>Độ hoàn thiện cao cấp:</strong> Thiết kế chuẩn mực, tương thích hoàn hảo với nội thất và hệ thống điện của các dòng xe ô tô hiện đại.</li>
    <li><strong>An toàn tuyệt đối cho xe:</strong> Không can thiệp cắt nối dây điện nguyên bản, sử dụng giắc cắm zin và cầu chì bảo vệ chuyên dụng.</li>
    <li><strong>Độ bền bỉ vượt trội:</strong> Vận hành ổn định trong điều kiện khí hậu nhiệt đới nóng ẩm của Việt Nam.</li>
</ul>

<h3>Cam kết dịch vụ tại xưởng Ôtô Hải Hà</h3>
<p>Khi mua và sử dụng dịch vụ tại xưởng Ôtô Hải Hà, quý khách hàng nhận được chính sách bảo hành 1 đổi 1 chu đáo, hỗ trợ tư vấn lắp đặt tận tình từ đội ngũ thợ lành nghề với hơn 31 năm kinh nghiệm.</p>',
        ),

    );
}

/**
 * Seed all accessories into WordPress as native 'garage_accessory' posts
 */
function hieugara_seed_accessories_posts() {
    $items = hieugara_get_accessories_definitions();
    $upload_dir = wp_upload_dir();
    $acc_folder = $upload_dir['basedir'] . '/accessories';

    foreach ($items as $item) {
        $existing = get_page_by_path($item['slug'], OBJECT, 'garage_accessory');

        $post_data = array(
            'post_title'    => $item['title'],
            'post_name'     => $item['slug'],
            'post_content'  => trim($item['content']),
            'post_excerpt'  => trim($item['excerpt']),
            'post_status'   => 'publish',
            'post_type'     => 'garage_accessory',
        );

        if ($existing) {
            $post_data['ID'] = $existing->ID;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }

        if (!is_wp_error($post_id)) {
            // Assign Taxonomy Category
            if (!empty($item['category']) && !empty($item['cat_name'])) {
                $term = term_exists($item['cat_name'], 'accessory_category');
                if (!$term) {
                    $term = wp_insert_term($item['cat_name'], 'accessory_category', array('slug' => $item['category']));
                }
                if (!is_wp_error($term) && isset($term['term_id'])) {
                    wp_set_object_terms($post_id, array((int)$term['term_id']), 'accessory_category');
                }
            }

            // Save Post Meta
            update_post_meta($post_id, '_accessory_price', $item['price']);
            update_post_meta($post_id, '_accessory_old_price', $item['old_price']);
            update_post_meta($post_id, '_accessory_badge', $item['badge']);
            update_post_meta($post_id, '_accessory_brand', $item['brand']);
            update_post_meta($post_id, '_accessory_warranty', $item['warranty']);
            update_post_meta($post_id, '_accessory_origin', $item['origin']);
            update_post_meta($post_id, '_accessory_img', $item['img']);
            update_post_meta($post_id, '_accessory_specs', $item['specs']);

            // Set Featured Image if file exists in uploads/accessories
            $file_name = !empty($item['local_file']) ? $item['local_file'] : ($item['slug'] . '.jpg');
            $file_path = $acc_folder . '/' . $file_name;
            if (file_exists($file_path)) {
                $attach_id = attachment_url_to_postid($item['img']);
                if (!$attach_id) {
                    $wp_filetype = wp_check_filetype($file_path, null);
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'] ?: 'image/jpeg',
                        'post_title'     => sanitize_file_name($file_name),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );
                    $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
                    if (!is_wp_error($attach_id)) {
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
                        wp_update_attachment_metadata($attach_id, $attach_data);
                    }
                }
                if ($attach_id && !is_wp_error($attach_id)) {
                    set_post_thumbnail($post_id, $attach_id);
                }
            }
        }
    }
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
            $cat_slug = (!empty($cat_terms) && !is_wp_error($cat_terms)) ? $cat_terms[0]->slug : 'cham-soc-xe-nuoc-hoa';
            $cat_name = (!empty($cat_terms) && !is_wp_error($cat_terms)) ? $cat_terms[0]->name : 'Phụ Kiện Ô Tô';

            $thumb = get_the_post_thumbnail_url($p->ID, 'full');
            if (!$thumb) {
                $thumb = get_post_meta($p->ID, '_accessory_img', true);
            }

            $result[] = array(
                'id'        => $p->ID,
                'slug'      => $p->post_name,
                'title'     => $p->post_title,
                'link'      => get_permalink($p->ID), // 100% INTERNAL LINK!
                'img'       => $thumb ?: get_template_directory_uri() . '/assets/images/shiftup/center-car.jpg',
                'price'     => get_post_meta($p->ID, '_accessory_price', true) ?: 'Liên hệ',
                'old_price' => get_post_meta($p->ID, '_accessory_old_price', true) ?: '',
                'badge'     => get_post_meta($p->ID, '_accessory_badge', true) ?: 'CHÍNH HÃNG',
                'brand'     => get_post_meta($p->ID, '_accessory_brand', true) ?: 'Chính Hãng',
                'warranty'  => get_post_meta($p->ID, '_accessory_warranty', true) ?: '12 tháng',
                'excerpt'   => $p->post_excerpt,
                'cat'       => $cat_slug,
                'cat_name'  => $cat_name,
            );
        }
        return $result;
    }

    // Fallback: seed items formatted with native site links
    $defs = hieugara_get_accessories_definitions();
    $fallback = array();
    foreach ($defs as $idx => $d) {
        $fallback[] = array(
            'id'        => $idx + 1,
            'slug'      => $d['slug'],
            'title'     => $d['title'],
            'link'      => home_url('/phu-kien-oto/' . $d['slug'] . '/'), // Internal link
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
        if (!isset($grouped[$cat])) {
            $cat = 'cham-soc-xe-nuoc-hoa';
        }
        $grouped[$cat]['items'][] = $item;
    }

    return $grouped;
}
