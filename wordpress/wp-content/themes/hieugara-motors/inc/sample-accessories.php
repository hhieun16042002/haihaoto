<?php
/**
 * Sample Accessories Data & Seeder for Ôtô Hải Hà
 * Saves all 16 accessories directly into WordPress as native 'garage_accessory' posts
 * Allows 100% internal browsing and native Admin CRUD - Zero external redirects
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns complete definition of the 16 genuine accessories
 */
function hieugara_get_accessories_definitions() {
    $img_uri = get_template_directory_uri() . '/assets/images/accessories';

    return array(
        array(
            'slug'      => 'camera-hanh-trinh-70mai-a810s-4k-hdr-omni',
            'title'     => 'Camera hành trình 70mai A810S 4K HDR Omni (Sony Starvis 2)',
            'category'  => 'man-hinh',
            'cat_name'  => 'Màn Hình & Camera',
            'price'     => '3.690.000',
            'old_price' => '4.200.000',
            'badge'     => 'BÁN CHẠY',
            'brand'     => '70mai (Xiaomi Ecosystem)',
            'warranty'  => '12 tháng 1 đổi 1 chính hãng',
            'origin'    => 'Nhập khẩu chính hãng & phân phối META.vn',
            'img'       => $img_uri . '/vietmap-c61-pro.jpg',
            'excerpt'   => 'Camera hành trình cao cấp 4K UHD trang bị cảm biến ảnh Sony Starvis 2 IMX678 thế hệ mới nhất, ghi hình đêm siêu nét Night Owl Vision và cảnh báo an toàn ADAS AI.',
            'specs'     => "Độ phân giải: 4K Ultra HD (3840 x 2160P @ 60fps)\nCảm biến hình ảnh: Sony Starvis 2 IMX678\nGóc quay ống kính: 150° siêu rộng, khẩu độ F/1.8\nMàn hình hiển thị: 3.0 inch IPS sắc nét\nKết nối: Wi-Fi 5GHz & Bluetooth 5.0 tải video cực nhanh\nBộ nhớ hỗ trợ: Thẻ MicroSD lên đến 256GB Class 10 U3\nTích hợp: GPS định vị tọa độ, ADAS AI cảnh báo va chạm sớm",
            'content'   => '
<h3>Đỉnh cao công nghệ ghi hình hành trình với cảm biến Sony Starvis 2</h3>
<p><strong>Camera hành trình 70mai A810S 4K HDR Omni</strong> là bước đột phá mới nhất trong phân khúc camera giám sát xe hơi cao cấp. Được trang bị cảm biến quang học đỉnh cao <strong>Sony Starvis 2 IMX678</strong>, thiết bị mang lại khả năng ghi hình với độ phân giải thực 4K UHD, dải tương phản động mở rộng HDR giúp nhận diện rõ nét từng biển số xe ngay cả trong điều kiện ngược sáng hoặc đêm tối mù sương.</p>

<h3>Các tính năng công nghệ vượt trội:</h3>
<ul>
    <li><strong>Ghi hình siêu nét 4K 60fps:</strong> Khung hình mượt mà, ghi lại chi tiết mọi tình huống giao thông phức tạp ở tốc độ cao.</li>
    <li><strong>Công nghệ độc quyền MaiColor Vivid+ Solution:</strong> Tối ưu hóa màu sắc sống động và cân bằng ánh sáng tự nhiên.</li>
    <li><strong>Hệ thống hỗ trợ lái xe an toàn ADAS AI:</strong> Cảnh báo lệch làn đường, cảnh báo va chạm phía trước và cảnh báo người đi bộ theo thời gian thực.</li>
    <li><strong>Giám sát bãi đỗ xe 24/24:</strong> Cảm biến G-Sensor phát hiện rung chấn và va chạm khi đỗ xe, tự động kích hoạt ghi hình khẩn cấp.</li>
    <li><strong>Kết nối Wi-Fi 5GHz:</strong> Tải video tốc độ cao về ứng dụng 70mai trên điện thoại mà không cần tháo thẻ nhớ.</li>
</ul>

<h3>Dịch vụ lắp đặt tiêu chuẩn tại Ôtô Hải Hà</h3>
<p>Tại xưởng Ôtô Hải Hà, chúng tôi cam kết thi công dây nguồn âm 100% gọn gàng thẩm mỹ, không cắt trích dây điện zin của xe, sử dụng cầu chì an toàn chuyên dụng chống cháy nổ.</p>
'
        ),

        array(
            'slug'      => 'may-bom-lop-o-to-khong-day-michelin-m2567-tu-ngat',
            'title'     => 'Máy bơm lốp ô tô không dây Michelin M2567 Tự Ngắt Thông Minh',
            'category'  => 'bom-lop',
            'cat_name'  => 'Bơm Lốp & Cảm Biến TPMS',
            'price'     => '1.180.000',
            'old_price' => '1.450.000',
            'badge'     => 'MICHELIN',
            'brand'     => 'Michelin',
            'warranty'  => '12 tháng chính hãng',
            'origin'    => 'Chính hãng Michelin',
            'img'       => $img_uri . '/michelin-bom-lop.jpg',
            'excerpt'   => 'Máy bơm lốp điện tử không dây Michelin cao cấp, động cơ đồng nguyên chất nén khí nhanh, tự động ngắt khi đủ áp suất và tích hợp sạc dự phòng.',
            'specs'     => "Áp suất tối đa: 150 PSI / 10.3 Bar\nTốc độ bơm: 25 lít / phút (Bơm sedan từ 0-2.4 bar chỉ trong 3.5 phút)\nDung lượng pin: 2.500mAh x 3 cell Lithium\nMàn hình: Màn hình LCD kỹ thuật số có đèn nền\nĐơn vị đo: PSI, BAR, KPA, Kg/cm²\nĐèn chiếu sáng: Đèn LED cứu hộ khẩn cấp SOS",
            'content'   => '
<h3>Giải pháp cứu hộ lốp xe hoàn hảo trên mọi cung đường</h3>
<p><strong>Máy bơm lốp ô tô không dây Michelin M2567</strong> là người bạn đồng hành không thể thiếu của mọi tài xế. Với động cơ xilanh kim loại nguyên khối, máy cho áp suất nén cực mạnh, vận hành êm ái và tản nhiệt tối ưu.</p>

<h3>Ưu điểm nổi bật:</h3>
<ul>
    <li><strong>Cài đặt áp suất & Tự ngắt:</strong> Chỉ cần cài đặt mức áp suất theo khuyến nghị của nhà sản xuất (ví dụ 2.3 bar), máy sẽ tự động bơm và ngắt chuẩn xác, chống quá nhiệt và nổ lốp.</li>
    <li><strong>Thiết kế không dây tiện dụng:</strong> Sử dụng pin sạc dung lượng cao, không cần kéo dây cắm tẩu vướng víu, dễ dàng bơm cho cả 4 bánh xe và xe máy, xe đạp, bóng rổ.</li>
    <li><strong>Đèn LED chiếu sáng ban đêm:</strong> Giúp thao tác dễ dàng trong bóng tối hoặc bật chế độ chớp đỏ SOS cảnh báo xe phía sau.</li>
</ul>
'
        ),

        array(
            'slug'      => 'cam-bien-ap-suat-lop-steelmate-tpms-m10-solar',
            'title'     => 'Cảm biến áp suất lốp Steelmate TPMS M10 hiển thị LCD Solar',
            'category'  => 'bom-lop',
            'cat_name'  => 'Bơm Lốp & Cảm Biến TPMS',
            'price'     => '2.250.000',
            'old_price' => '2.600.000',
            'badge'     => 'STEELMATE',
            'brand'     => 'Steelmate',
            'warranty'  => '36 tháng chính hãng',
            'origin'    => 'Phân phối chính hãng Steelmate',
            'img'       => $img_uri . '/steelmate-tpms.jpg',
            'excerpt'   => 'Cảm biến áp suất lốp gắn trong Steelmate M10 chip Infineon Đức, màn hình năng lượng mặt trời chống chói, cảnh báo rò rỉ khí tức thì.',
            'specs'     => "Chip cảm biến: Infineon công nghệ Đức\nKiểu van: 4 van gắn trong chống trộm, chống nước IP67\nMàn hình hiển thị: LCD màu Solar tự nạp điện mặt trời\nĐộ chính xác: ± 0.1 Bar / ± 1°C\nTuổi thọ pin van: 5 năm hoạt động bền bỉ\nCảnh báo: Còi hú và biểu tượng nhấp nháy đa cấp độ",
            'content'   => '
<h3>Bảo vệ an toàn tối đa cho lốp và hệ thống lái</h3>
<p>Áp suất lốp non hoặc quá căng là nguyên nhân hàng đầu gây hao mòn lốp bất thường, giảm khả năng bám đường và tăng nguy cơ nổ lốp ở tốc độ cao. <strong>Steelmate TPMS M10</strong> cập nhật áp suất và nhiệt độ 4 bánh xe liên tục mỗi 3 giây.</p>

<h3>Tính năng cốt lõi:</h3>
<ul>
    <li>Màn hình năng lượng mặt trời sạc tự động liên tục khi đặt trên taplo.</li>
    <li>Cảnh báo bằng giọng nói và âm báo khẩn cấp khi lốp bị đinh cán xì hơi chậm.</li>
    <li>Van gắn trong đạt chuẩn IP67, an toàn tuyệt đối khi rửa xe hoặc lội nước.</li>
    <li>Lắp đặt và cân bằng động bánh xe chuyên nghiệp tại Ôtô Hải Hà.</li>
</ul>
'
        ),

        array(
            'slug'      => 'may-hut-bui-cam-tay-o-to-bosch-bhn16l-hepa',
            'title'     => 'Máy hút bụi cầm tay ô tô không dây Bosch BHN16L lực hút cực mạnh HEPA',
            'category'  => 'cuu-ho',
            'cat_name'  => 'Cứu Hộ & Vệ Sinh Ô Tô',
            'price'     => '1.850.000',
            'old_price' => '2.190.000',
            'badge'     => 'BOSCH CHÍNH HÃNG',
            'brand'     => 'Bosch Đức',
            'warranty'  => '24 tháng chính hãng',
            'origin'    => 'Chính hãng Bosch',
            'img'       => $img_uri . '/bosch-may-hut-bui.jpg',
            'excerpt'   => 'Máy hút bụi không dây Bosch công nghệ Đức, lực hút lốc xoáy Cyclone 16.000Pa, màng lọc HEPA diệt khuẩn và pin Lithium bền bỉ 40 phút.',
            'specs'     => "Công nghệ hút: High Airflow System & Cyclone xoáy kép\nLực hút: 16.000 Pa\nBộ lọc: Màng lọc HEPA kép giặt tái sử dụng\nTrọng lượng: 1.1 kg siêu nhẹ công thái học\nThời gian hoạt động: 40 phút liên tục\nPhụ kiện đi kèm: Đầu hút khe dài và đầu chổi quét taplo",
            'content'   => '
<h3>Giữ gìn khoang nội thất luôn sạch bong kin kít</h3>
<p><strong>Máy hút bụi cầm tay Bosch BHN16L</strong> sở hữu động cơ kỹ thuật số thế hệ mới của Bosch, tạo lực hút lốc xoáy cực đại giúp hút sạch vụn bánh, tàn thuốc, lông thú cưng và cát mịn ẩn sâu trong thảm sàn và khe ghế da.</p>
'
        ),

        array(
            'slug'      => 'bo-kich-no-ac-quy-o-to-stanley-12v-1500a',
            'title'     => 'Bộ kích nổ ắc quy ô tô khẩn cấp Stanley 12V kiêm sạc dự phòng',
            'category'  => 'cuu-ho',
            'cat_name'  => 'Cứu Hộ & Vệ Sinh Ô Tô',
            'price'     => '1.450.000',
            'old_price' => '1.790.000',
            'badge'     => 'CỨU HỘ KHẨN CẤP',
            'brand'     => 'Stanley Mỹ',
            'warranty'  => '12 tháng chính hãng',
            'origin'    => 'Stanley Chính Hãng',
            'img'       => $img_uri . '/stanley-kich-binh.jpg',
            'excerpt'   => 'Bộ kích nổ ắc quy chuyên dụng Stanley dòng khởi động đỉnh 1500A, kích nổ xe máy xăng tới 6.0L và xe máy dầu tới 4.0L khi chết máy.',
            'specs'     => "Dòng điện đỉnh: 1500A Peak Current\nDung lượng pin: 18.000 mAh Li-Po cao cấp\nTương thích động cơ: Động cơ xăng đến 6.0L, động cơ diesel đến 4.0L\nBảo vệ an toàn: 8 lớp bảo vệ thông minh (chống ngắn mạch, ngược cực...)\nCổng sạc: 2x USB Quick Charge 3.0 + Type-C\nĐèn pin: 3 chế độ Chiếu sáng / Nhấp nháy / SOS cứu hộ",
            'content'   => '
<h3>Cứu tinh khi ắc quy ô tô chết máy giữa đường</h3>
<p>Không cần chờ xe cứu hộ hay tìm xe khác để câu bình, <strong>Bộ kích nổ Stanley 12V</strong> giúp bạn tự khởi động lại động cơ xe trong vòng 30 giây cực kỳ an toàn và đơn giản.</p>
'
        ),

        array(
            'slug'      => 'man-hinh-android-o-to-zestech-z500-kiki',
            'title'     => 'Màn hình thông minh Android Zestech Z500 tích hợp Giọng nói Kiki',
            'category'  => 'man-hinh',
            'cat_name'  => 'Màn Hình & Camera',
            'price'     => '8.500.000',
            'old_price' => '9.500.000',
            'badge'     => 'ZESTECH',
            'brand'     => 'Zestech',
            'warranty'  => '24 tháng 1 đổi 1',
            'origin'    => 'Zestech Chính Hãng',
            'img'       => $img_uri . '/zestech-z500.jpg',
            'excerpt'   => 'Màn hình ô tô Android Zestech Z500 màn IPS chống chói 9-10 inch, trợ lý ảo Kiki thông minh ra lệnh giọng nói và tích hợp bản đồ Vietmap cảnh báo tốc độ.',
            'specs'     => "Kích thước: 9 inch / 10 inch theo từng dòng xe\nĐộ phân giải: 1280 x 720 IPS Full HD kính 2.5D\nCấu hình: CPU 8 nhân ARM Cortex, RAM 3GB, ROM 32GB\nHệ điều hành: Android 10 mượt mà\nBản đồ tích hợp: Vietmap S1/Live bản quyền trọn đời + Google Maps\nQuà tặng: Camera hành trình trước + Thẻ nhớ 32GB + Sim 4G tốc độ cao",
            'content'   => '
<h3>Biến xế cưng thành không gian giải trí & công nghệ hiện đại</h3>
<p><strong>Màn hình Android Zestech Z500</strong> mang đến trải nghiệm lái xe thông minh với trợ lý Kiki nghe hiểu giọng nói 3 miền Bắc - Trung - Nam, dẫn đường chính xác và cảnh báo giới hạn tốc độ từng cung đường.</p>
'
        ),

        array(
            'slug'      => 'man-hinh-android-elliview-s4-basic-cam360',
            'title'     => 'Màn Hình Android Elliview S4 Basic [3GB/32GB + Camera 360 Sony]',
            'category'  => 'man-hinh',
            'cat_name'  => 'Màn Hình & Camera',
            'price'     => '12.800.000',
            'old_price' => '14.500.000',
            'badge'     => 'TẶNG CAM 360',
            'brand'     => 'ICAR Elliview',
            'warranty'  => '36 tháng chính hãng',
            'origin'    => 'ICAR Việt Nam',
            'img'       => $img_uri . '/elliview-s4.jpg',
            'excerpt'   => 'Gói nâng cấp toàn diện màn hình ô tô Elliview S4 liền camera 360 Sony AHD, đánh lái theo vô lăng và giao diện Elligo thông minh độc quyền.',
            'specs'     => "Camera: Trọn bộ 4 mắt Camera 360 Sony AHD siêu nét\nCấu hình: Octa-core 1.8GHz, RAM 3GB, ROM 32GB\nÂm thanh: DSP 32 kênh tùy chỉnh chuyên nghiệp\nGiao diện: Elligo tiện ích độc quyền ICAR\nTính năng: Đánh lái theo vô lăng, ghi hình thay camera hành trình 4 hướng\nĐịnh vị: Ứng dụng ICAR Tracking định vị xe mọi lúc mọi nơi",
            'content'   => '
<h3>Xóa bỏ mọi điểm mù khi di chuyển trong phố hẹp</h3>
<p>Hệ thống <strong>Elliview S4 liền camera 360</strong> giúp tài xế tự tin tiến lùi, ghép xe vào chuồng và đi qua ngõ ngách chật hẹp mà không sợ va quẹt trầy xước sơn.</p>
'
        ),

        array(
            'slug'      => 'tau-sac-nhanh-o-to-baseus-digital-display-65w',
            'title'     => 'Tẩu sạc nhanh ô tô Baseus Digital Display 65W sạc Laptop & Điện thoại',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '390.000',
            'old_price' => '490.000',
            'badge'     => 'BASEUS 65W',
            'brand'     => 'Baseus',
            'warranty'  => '12 tháng chính hãng',
            'origin'    => 'Baseus Chính Hãng',
            'img'       => $img_uri . '/baseus-tau-sac.jpg',
            'excerpt'   => 'Tẩu sạc xe hơi Baseus công suất khủng 65W, sạc được cả MacBook và laptop Type-C, màn hình LED đo điện áp ắc quy xe theo thời gian thực.',
            'specs'     => "Công suất: 65W Max (USB-C 65W + USB-A 30W)\nChuẩn sạc nhanh: Power Delivery PD 3.0, Quick Charge QC 4.0+, SCP, AFC\nMàn hình: LED hiển thị vôn kế theo dõi bình ắc quy\nChất liệu: Hợp kim nhôm + PC chống cháy\nTương thích: Nguồn 12V - 24V dùng cho mọi dòng xe con, SUV, bán tải, xe tải",
            'content'   => '
<h3>Sạc siêu nhanh cho Laptop, iPad và Smartphone trên xe hơi</h3>
<p><strong>Tẩu sạc Baseus Digital Display 65W</strong> cung cấp nguồn điện ổn định, bảo vệ quá dòng, quá áp và theo dõi tuổi thọ bình ắc quy nhờ màn hình hiển thị điện áp thông minh.</p>
'
        ),

        array(
            'slug'      => 'gia-do-dien-thoai-o-to-baseus-sac-khong-day-15w',
            'title'     => 'Giá đỡ điện thoại ô tô kiêm sạc không dây Baseus cảm ứng tự động 15W',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '420.000',
            'old_price' => '550.000',
            'badge'     => 'SẠC KHÔNG DÂY',
            'brand'     => 'Baseus',
            'warranty'  => '12 tháng chính hãng',
            'origin'    => 'Baseus Chính Hãng',
            'img'       => $img_uri . '/baseus-gia-do.jpg',
            'excerpt'   => 'Giá đỡ điện thoại kẹp cửa gió Baseus cảm ứng hồng ngoại tự đóng mở ngàm thông minh, tích hợp sạc nhanh không dây chuẩn Qi 15W.',
            'specs'     => "Công suất sạc: 15W / 10W / 7.5W chuẩn Qi thông minh\nCơ chế kẹp: Cảm biến hồng ngoại mở tự động và khóa điện cơ siêu chắc\nVị trí lắp: Kẹp cửa gió điều hòa hoặc đế dán taplo chắc chắn\nTương thích: Màn hình từ 4.7 đến 7.2 inch (iPhone 11-16, Samsung Galaxy S20-S25)",
            'content'   => '
<h3>Tiện lợi tối đa khi xem bản đồ GPS khi đang lái xe</h3>
<p>Chỉ cần đưa điện thoại lại gần, ngàm kẹp <strong>Baseus 15W</strong> sẽ tự động nhận diện và kẹp chặt máy, đồng thời kích hoạt sạc không dây tức thì mà không cần cắm dây cáp.</p>
'
        ),

        array(
            'slug'      => 'may-loc-khong-khi-o-to-philips-gopure-gp5211',
            'title'     => 'Máy lọc không khí ô tô Philips GoPure GP5211 khử mùi kháng khuẩn',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '2.490.000',
            'old_price' => '2.890.000',
            'badge'     => 'PHILIPS',
            'brand'     => 'Philips Hà Lan',
            'warranty'  => '12 tháng chính hãng',
            'origin'    => 'Philips Chính Hãng',
            'img'       => $img_uri . '/philips-loc-khong-khi.jpg',
            'excerpt'   => 'Máy lọc không khí ô tô Philips màng lọc SelectFilter Plus độc quyền lọc sạch 99% bụi mịn PM2.5, khử sạch mùi xe mới, mùi thuốc lá và khí độc Formaldehyde.',
            'specs'     => "Màng lọc: SelectFilter Plus 3 giai đoạn độc quyền Philips\nTốc độ lọc CADR: 16 m³/h (lọc sạch cabin xe 5 chỗ chỉ trong 13 phút)\nKhử độc hại: Loại bỏ PM2.5, vi khuẩn, nấm mốc, Formaldehyde, Benzen\nĐộ ồn: Dưới 40dB êm ái tuyệt đối\nCảm biến: Đèn LED chỉ báo chất lượng không khí 3 màu xanh/vàng/đỏ",
            'content'   => '
<h3>Bảo vệ sức khỏe đường hô hấp của gia đình bạn</h3>
<p>Khoang xe kín dưới trời nắng sản sinh nhiều chất độc bay hơi từ da và nhựa nội thất. <strong>Philips GoPure GP5211</strong> trả lại bầu không khí trong lành, sảng khoái và bảo vệ hệ hô hấp cho trẻ nhỏ.</p>
'
        ),

        array(
            'slug'      => 'bat-phu-o-to-3-lop-trang-nhom-cach-nhiet',
            'title'     => 'Bạt phủ ô tô 3 lớp tráng nhôm cách nhiệt chống nóng, mưa đá',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '550.000',
            'old_price' => '750.000',
            'badge'     => 'CHỐNG NẮNG 100%',
            'brand'     => 'Hải Hà Custom Fit',
            'warranty'  => '06 tháng bảo hành đường may',
            'origin'    => 'Gia công cao cấp chuẩn phom xe',
            'img'       => $img_uri . '/bat-phu-oto.jpg',
            'excerpt'   => 'Bạt trùm xe ô tô 3 lớp tráng nhôm dập vân kim cương phản xạ 98% tia tử ngoại, hạ nhiệt khoang lái 20 độ C và chống trầy xước sơn.',
            'specs'     => "Cấu tạo: 3 lớp (Lớp tráng nhôm phản quang + Lớp bông PE cách nhiệt + Lớp nỉ cotton chống xước sơn)\nPhom size: May chuẩn xác theo kích thước từng dòng xe (Sedan, SUV 5 chỗ, Crossover, SUV 7 chỗ, Bán tải)\nTiện ích: Khóa kéo mở cửa ghế tài thông minh + Dải phản quang ban đêm + Dây đai buộc 4 bánh chống gió giật",
            'content'   => '
<h3>Áo giáp bảo vệ xe trước thời tiết khắc nghiệt</h3>
<p>Bạt phủ cách nhiệt 3 lớp giúp giữ cho màu sơn xe không bị bạc màu, bảo vệ taplo và ghế da không bị nứt nẻ lão hóa dưới nắng gắt mùa hè.</p>
'
        ),

        array(
            'slug'      => 'goi-tua-dau-dem-tua-lung-cao-su-non-o-to',
            'title'     => 'Gối tựa đầu & đệm tựa lưng cao su non công thái học ô tô',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '450.000',
            'old_price' => '590.000',
            'badge'     => 'CAO SU NON',
            'brand'     => 'Ergonomic Premium',
            'warranty'  => '12 tháng chống xẹp lún',
            'origin'    => 'Chính Hãng Nhập Khẩu',
            'img'       => $img_uri . '/goi-tua-dau-oto.jpg',
            'excerpt'   => 'Bộ gối tựa đầu và đệm tựa lưng ruột cao su non công thái học phục hồi chậm, nâng đỡ cột sống thắt lưng và đốt sống cổ, chống đau mỏi khi lái xe đường dài.',
            'specs'     => "Chất liệu ruột: Cao su non Polyurethane đúc nguyên khối nhớ hình đàn hồi chậm\nVỏ bọc: Vải sợi thể thao 3D thoáng khí không nóng mồ hôi, tháo giặt dễ dàng\nThiết kế: Đường cong công thái học ôm trọn cột sống và hõm gáy\nMàu sắc: Đen chỉ đỏ, Nâu da bò, Be sang trọng",
            'content'   => '
<h3>Xua tan mệt mỏi, lái xe êm ái trên mọi cung đường dài</h3>
<p>Được thiết kế dựa trên nghiên cứu giải phẫu học cơ thể người lái, bộ đệm gối cao su non phân bổ đều áp lực lên cột sống, mang lại sự thư thái và bảo vệ sức khỏe lâu dài.</p>
'
        ),

        array(
            'slug'      => 'boc-vo-lang-o-to-da-bo-that-van-carbon',
            'title'     => 'Bọc vô lăng ô tô da bò thật vân sợi carbon chống trơn trượt',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '350.000',
            'old_price' => '450.000',
            'badge'     => 'DA CAO CẤP',
            'brand'     => 'Sparco Racing / OEM Premium',
            'warranty'  => '12 tháng chất lượng da',
            'origin'    => 'Chính Hãng Phân Phối',
            'img'       => $img_uri . '/boc-vo-lang.jpg',
            'excerpt'   => 'Bọc vô lăng xe hơi kết hợp da bò thật và sợi carbon thể thao, lỗ thông khí thoát mồ hôi tay cực tốt, tăng ma sát cầm nắm lái đầm chắc.',
            'specs'     => "Chất liệu: Da bò thật cao cấp + Nhựa phủ sợi carbon siêu bền\nKích thước: Chuẩn đường kính 38cm (phù hợp 99% các dòng xe con từ 4 đến 7 chỗ tại Việt Nam)\nLõi trong: Cao su tự nhiên không mùi hôi thân thiện môi trường\nThiết kế: Gai ma sát công thái học ôm sát lòng bàn tay",
            'content'   => '
<h3>Cảm giác lái đầm chắc và tăng tính thể thao cho khoang lái</h3>
<p>Bọc vô lăng da bò sợi carbon không chỉ bảo vệ lớp vô lăng zin khỏi mài mòn, bạc màu mà còn mang lại cảm giác cầm lái chắc tay và chuẩn xác hơn bao giờ hết.</p>
'
        ),

        array(
            'slug'      => 'nuoc-hoa-o-to-cao-cap-etonner-areon-kep-cua-gio',
            'title'     => 'Nước hoa ô tô cao cấp kẹp cửa gió điều hòa Etonner / Areon',
            'category'  => 'noi-that',
            'cat_name'  => 'Nội Thất & Tiện Ích Xe Hơi',
            'price'     => '320.000',
            'old_price' => '420.000',
            'badge'     => 'HƯƠNG TỰ NHIÊN',
            'brand'     => 'Etonner Pháp & Areon Bulgaria',
            'warranty'  => 'Cam kết 100% tinh dầu tự nhiên',
            'origin'    => 'Nhập Khẩu Châu Âu',
            'img'       => $img_uri . '/nuoc-hoa-oto.jpg',
            'excerpt'   => 'Nước hoa ô tô tinh dầu tự nhiên kẹp cửa gió điều hòa, tỏa hương dịu mát sang trọng, khử sạch mùi xe mới và mùi máy lạnh khó chịu.',
            'specs'     => "Dung tích: 10ml tinh dầu cô đặc chiết xuất hoa cỏ tự nhiên\nThời gian lưu hương: 60 - 90 ngày khuếch tán đều\nVị trí gắn: Kẹp cánh cửa gió điều hòa xe\nĐộ an toàn: Không chứa cồn công nghiệp, an toàn tuyệt đối cho bà bầu và trẻ nhỏ",
            'content'   => '
<h3>Hương thơm sang trọng quý phái như xe hạng sang</h3>
<p>Sử dụng tinh dầu nước hoa cao cấp kẹp cửa gió giúp tinh thần người lái luôn tỉnh táo, thư giãn và xóa tan hoàn toàn cảm giác say xe cho người đi cùng.</p>
'
        ),

        array(
            'slug'      => 'dung-dich-rua-xe-khong-cham-ve-sinh-noi-that-3m',
            'title'     => 'Dung dịch rửa xe không chạm và vệ sinh nội thất ô tô Ekokemika 3M',
            'category'  => 'cuu-ho',
            'cat_name'  => 'Cứu Hộ & Vệ Sinh Ô Tô',
            'price'     => '280.000',
            'old_price' => '350.000',
            'badge'     => 'CHĂM SÓC XE',
            'brand'     => '3M & Ekokemika Italy',
            'warranty'  => 'Hàng chính hãng có tem chống giả',
            'origin'    => '3M USA & Ekokemika Italy',
            'img'       => $img_uri . '/dung-dich-cham-soc-xe.jpg',
            'excerpt'   => 'Combo dung dịch rửa xe bọt tuyết không chạm và chai xịt vệ sinh nội thất diệt khuẩn 3M, làm sạch sâu ghế da và nhựa mà không gây ố bạc màu.',
            'specs'     => "Dung tích: Chai 1.000ml tiện dụng\nĐộ pH: 7.0 trung tính tuyệt đối, an toàn cho lớp bóng sơn Ceramic và chi tiết nhôm kính\nHiệu quả: Làm mềm và đánh tan bùn đất dầu mỡ trong 1 phút\nỨng dụng: Rửa vỏ xe, rửa khoang máy, vệ sinh ghế da, taplo, tappi cửa",
            'content'   => '
<h3>Chăm sóc xe chuyên nghiệp ngay tại nhà chuẩn Detailing</h3>
<p>Sản phẩm chính hãng từ 3M và Ekokemika giúp bảo vệ lớp sơn bóng của xe không bị trầy xước như khi cọ rửa bằng giẻ thông thường, giữ cho nội thất luôn thơm tho sạch sẽ.</p>
'
        ),

        array(
            'slug'      => 'bua-thoat-hiem-da-nang-4-trong-1-sos',
            'title'     => 'Búa thoát hiểm đa năng 4 trong 1 kiêm đèn pin SOS và dao cắt dây đai',
            'category'  => 'cuu-ho',
            'cat_name'  => 'Cứu Hộ & An Toàn Ô Tô',
            'price'     => '190.000',
            'old_price' => '250.000',
            'badge'     => 'AN TOÀN ÔTÔ',
            'brand'     => 'Safety Car Equipment',
            'warranty'  => 'Trọn đời sử dụng',
            'origin'    => 'Chính Hãng Phân Phối',
            'img'       => $img_uri . '/bua-thoat-hiem.jpg',
            'excerpt'   => 'Thiết bị cứu hộ sinh tử bắt buộc phải có trên xe hơi: Búa phá kính cường lực đầu thép Vonfram, dao cắt dây an toàn khẩn cấp và đèn pin cảnh báo SOS.',
            'specs'     => "Đầu đập kính: Thép Vonfram siêu cứng độ cứng Rockwell 60HRC\nDao cắt dây: Lưỡi hợp kim sắc bén có rãnh bảo vệ chống đứt tay\nTính năng bổ sung: Đèn pin LED siêu sáng + Đèn chớp đỏ cứu hộ SOS + Nam châm hít vỏ xe\nKích thước: 16 x 6 cm nhỏ gọn để vừa hộc đồ cánh cửa tài",
            'content'   => '
<h3>Thiết bị an toàn bảo vệ mạng sống trong gang tấc</h3>
<p>Khi xe không may bị ngập nước, rơi xuống sông hoặc xảy ra va chạm biến dạng kẹt cửa và kẹt dây đai an toàn, <strong>Búa thoát hiểm đa năng 4 trong 1</strong> giúp phá kính và thoát thân chỉ trong 3 giây.</p>
'
        ),
    );
}

/**
 * Seed all 16 accessories into WordPress as native 'garage_accessory' posts
 */
function hieugara_seed_accessories_posts() {
    $items = hieugara_get_accessories_definitions();

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
            $cat_slug = (!empty($cat_terms) && !is_wp_error($cat_terms)) ? $cat_terms[0]->slug : 'noi-that';
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
