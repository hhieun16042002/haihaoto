<?php
/**
 * Auto-populate 12 Comprehensive Garage Services for Gara Ô tô Hải Hà
 * Based on 12-category professional automotive workshop architecture
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_populate_sample_services($force = false) {
    // Check if already imported
    if (!$force) {
        $already_imported = get_option('hieugara_12_services_imported', false);
        if ($already_imported) {
            return;
        }
    }

    // 1. Register 12 Categories
    $categories = array(
        'bao-duong-dinh-ky'      => '1. Bảo Dưỡng Định Kỳ',
        'sua-chua-dong-co'       => '2. Sửa Chữa Động Cơ',
        'hop-so-truyen-dong'     => '3. Hộp Số & Truyền Động',
        'he-thong-phanh'         => '4. Hệ Thống Phanh',
        'treo-lai-lop'           => '5. Hệ Thống Treo, Lái & Lốp',
        'dien-dien-tu'           => '6. Điện – Điện Tử Ô Tô',
        'dieu-hoa-lam-mat'       => '7. Điều Hòa & Làm Mát',
        'xa-khi-thai'            => '8. Hệ Thống Xả & Khí Thải',
        'dong-son-ngoai-that'    => '9. Đồng Sơn – Ngoại Thất',
        'detailing-cham-soc-xe'  => '10. Chăm Sóc & Làm Đẹp Xe (Detailing)',
        'nang-cap-phu-kien'      => '11. Nâng Cấp & Phụ Kiện',
        'dich-vu-ho-tro-cuu-ho'  => '12. Dịch Vụ Hỗ Trợ & Cứu Hộ'
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

    $theme_uri = get_template_directory_uri();
    $shiftup_img = $theme_uri . '/assets/images/shiftup';

    // 2. 12 Master Services matching Gara Hải Hà Real Capabilities
    $services = array(
        // 1. Bảo dưỡng định kỳ
        array(
            'title'     => 'Bảo Dưỡng Định Kỳ Đa Cấp (5.000km - 40.000km)',
            'slug'      => 'bao-duong-dinh-ky-da-cap',
            'category'  => 'bao-duong-dinh-ky',
            'badge'     => 'QUY TRÌNH 45 HẠNG MỤC',
            'price'     => 'từ 550.000 đ',
            'duration'  => '60 - 90 phút',
            'warranty'  => 'Bảo hành 6 tháng / 10.000 km',
            'image'     => $shiftup_img . '/slide-1.jpg',
            'excerpt'   => 'Bảo dưỡng theo mốc km tiêu chuẩn hãng, thay dầu động cơ tổng hợp, kiểm tra toàn diện 45 hạng mục an toàn.',
            'features'  => "Thay dầu máy tổng hợp cao cấp và lọc dầu chính hãng OEM\nKiểm tra, vệ sinh lọc gió động cơ và lọc gió điều hòa (lọc cabin)\nKiểm tra và châm bổ sung toàn bộ nước làm mát, dầu phanh, nước rửa kính\nKiểm tra áp suất lốp, siết lực ốc bánh xe, đảo lốp chống mòn lệch\nQuét mã lỗi ECU điện tử bằng máy chẩn đoán chuyên dụng",
            'content'   => '<p>Quy trình bảo dưỡng tại Gara Ô tô Hải Hà được thiết kế đồng bộ theo tiêu chuẩn các hãng xe lớn như Toyota, Ford, Mazda, Mercedes, BMW. Chúng tôi kiểm tra chi tiết từ khoang động cơ, gầm bệ, phanh đến hệ thống điện tử.</p><p>Khách hàng nhận được biên bản kiểm định KCS rõ ràng từng hạng mục, giúp duy trì xe luôn êm ái, tiết kiệm nhiên liệu và an toàn trên mọi hành trình.</p>'
        ),

        // 2. Sửa chữa động cơ
        array(
            'title'     => 'Chẩn Đoán & Sửa Chữa, Đại Tu Động Cơ',
            'slug'      => 'chuan-doan-sua-chua-dai-tu-dong-co',
            'category'  => 'sua-chua-dong-co',
            'badge'     => 'CHUYÊN GIA 10+ NĂM',
            'price'     => 'từ 850.000 đ',
            'duration'  => '1 - 3 ngày',
            'warranty'  => 'Bảo hành 12 - 24 tháng',
            'image'     => $shiftup_img . '/tech-about.jpg',
            'excerpt'   => 'Xử lý triệt để hiện tượng rung giật, hao dầu, nóng máy, mất công suất, đại tu và cẩu máy chuyên nghiệp.',
            'features'  => "Chẩn đoán nguyên nhân tiếng gõ máy, hao nước làm mát và hao nhớt bất thường\nĐại tu động cơ: mài nắp máy, thay xéc-măng, gioăng nắp máy, căn chỉnh xupap\nThay dây curoa cam, xích cam, bộ tăng đai tự động chính hãng\nVệ sinh buồng đốt hydro, kim phun điện tử và cổ họng hút\nSửa chữa và phục hồi hệ thống tăng áp Turbocharger",
            'content'   => '<p>Với trang thiết bị cẩu động cơ chuyên dụng và máy nội soi buồng đốt, các kỹ sư trưởng tại Gara Hải Hà phát hiện chính xác vị trí mòn hỏng bên trong lốc máy mà không phải tháo lắp mò mẫm.</p><p>Mọi phụ tùng thay thế như xéc-măng, piston, bạc biên balie, xích cam đều là hàng OEM chính hãng, có bảo hành bằng văn bản minh bạch.</p>'
        ),

        // 3. Hộp số và truyền động
        array(
            'title'     => 'Bảo Dưỡng & Đại Tu Hộp Số Tự Động, Hộp Số Sàn, CVT, DCT',
            'slug'      => 'bao-duong-dai-tu-hop-so',
            'category'  => 'hop-so-truyen-dong',
            'badge'     => 'MÁY THAY DẦU TUẦN HOÀN',
            'price'     => 'từ 1.200.000 đ',
            'duration'  => '2 - 8 tiếng',
            'warranty'  => 'Bảo hành 12 tháng',
            'image'     => $shiftup_img . '/port-2.jpg',
            'excerpt'   => 'Thay dầu hộp số tuần hoàn tự động 100%, sửa chữa đại tu hộp số giật số, trượt số, gầm hú láp vi sai.',
            'features'  => "Thay dầu hộp số tự động bằng máy tuần hoàn áp lực cao, sạch 99% cặn bẩn\nSửa chữa bộ ly hợp, bàn ép, lá côn, bi T cho xe số sàn và số tự động\nKhắc phục triệt để hiện tượng giật số, chậm chuyển số, rung rần khi vào D/R\nSửa chữa cầu trước, cầu sau, bộ vi sai và thay thế cao su chân máy, chân hộp số\nThay thế trục láp truyền động, trục các-đăng triệt tiêu tiếng kêu lục cục",
            'content'   => '<p>Hộp số là bộ phận cơ khí chính xác đắt tiền trên xe. Gara Hải Hà sử dụng máy thay dầu tuần hoàn tự động kết nối cổng scan ECU để đo nhiệt độ dầu chuẩn xác, giúp việc thay dầu hộp số đạt hiệu quả tối ưu.</p>'
        ),

        // 4. Hệ thống phanh
        array(
            'title'     => 'Bảo Dưỡng, Thay Thế Má Phanh, Đĩa Phanh & Sửa Chữa Phanh ABS',
            'slug'      => 'bao-duong-thay-the-he-thong-phanh',
            'category'  => 'he-thong-phanh',
            'badge'     => 'AN TOÀN TUYỆT ĐỐI',
            'price'     => 'từ 350.000 đ',
            'duration'  => '45 - 60 phút',
            'warranty'  => 'Bảo hành 12 tháng',
            'image'     => $shiftup_img . '/banner-3.jpg',
            'excerpt'   => 'Thay má phanh gốm không ồn, láng đĩa phanh triệt tiêu rung giật, thay dầu phanh DOT4 và sửa phanh tay điện tử.',
            'features'  => "Thay má phanh chính hãng Brembo, Akebono, Bosch êm ái không kêu rít\nLáng đĩa phanh tự động độ chính xác cao loại bỏ rung lắc chân phanh\nThay dầu phanh tuần hoàn chân không, xả gió cùm heo phanh chuyên dụng\nChẩn đoán và sửa chữa cảm biến ABS, hộp chấp hành phanh tay điện tử EPB\nVệ sinh, tra mỡ chịu nhiệt ốc trượt cùm phanh định kỳ",
            'content'   => '<p>Hệ thống phanh bảo vệ tính mạng cho bạn và gia đình. Tại Gara Hải Hà, chúng tôi kiểm tra độ dày má phanh và đĩa phanh bằng thước kẹp điện tử, đảm bảo mọi chi tiết đều nằm trong dung sai an toàn cho phép của nhà sản xuất.</p>'
        ),

        // 5. Hệ thống treo, lái và lốp
        array(
            'title'     => 'Cân Chỉnh Thước Lái 3D Hunter, Sửa Gầm, Giảm Xóc & Lốp Xe',
            'slug'      => 'can-chinh-thuoc-lai-3d-hunter-sua-gam',
            'category'  => 'treo-lai-lop',
            'badge'     => 'CÔNG NGHỆ 3D HUNTER MỸ',
            'price'     => 'từ 450.000 đ',
            'duration'  => '45 - 60 phút',
            'warranty'  => 'Bảo hành 10.000 km',
            'image'     => $shiftup_img . '/port-3.jpg',
            'excerpt'   => 'Cân chỉnh góc đặt bánh xe 3D triệt tiêu nhao lái, mòn vẹt lốp, cân bằng động mâm xe và thay thế giảm xóc, rotuyn.',
            'features'  => "Hệ thống cân chỉnh thước lái 3D Hunter Hawkeye định vị quang học chính xác 0.01 độ\nCân bằng động bấm chì mâm xe loại bỏ rung vô lăng ở tốc độ 80 - 120 km/h\nThay thế giảm xóc (phuộc nhún), lò xo, bát bèo, rotuyn cân bằng, rotuyn lái\nSửa chữa phục hồi thước lái trợ lực dầu, thước lái trợ lực điện EPS\nĐảo lốp định kỳ, vá lốp nấm chuẩn an toàn cao tốc",
            'content'   => '<p>Thiết bị Hunter Hawkeye Elite của Mỹ đo lường chính xác các thông số góc Camber, Caster, Toe-in. Xe của bạn sẽ lấy lại cảm giác lái đầm chắc, ôm cua chuẩn xác và triệt tiêu hoàn toàn hiện tượng nhao lái hay mòn vẹt mép lốp.</p>'
        ),

        // 6. Điện – điện tử ô tô
        array(
            'title'     => 'Chẩn Đoán Lỗi Bằng Máy Scan Chuyên Hãng, Sửa Điện Thân Xe & ECU',
            'slug'      => 'chuan-doan-dien-dien-tu-o-to',
            'category'  => 'dien-dien-tu',
            'badge'     => 'MÁY SCAN OEM CHUYÊN SÂU',
            'price'     => 'từ 300.000 đ',
            'duration'  => '30 - 90 phút',
            'warranty'  => 'Bảo hành 12 tháng',
            'image'     => $shiftup_img . '/port-1.jpg',
            'excerpt'   => 'Đọc và xóa lỗi đèn taplo, sửa chữa hộp đen ECU/TCU/BCM, sửa máy phát, củ đề, ắc quy và hệ thống điện thân xe.',
            'features'  => "Quét lỗi hệ thống toàn diện với máy đọc lỗi đa năng Autel MaxiSys và máy OEM\nKiểm tra tình trạng ắc quy bằng máy phân tích dòng khởi động CCA\nSửa chữa, đại tu củ đề (máy khởi động), máy phát điện xoay chiều\nSửa chữa hộp điều khiển động cơ ECU, hộp điều khiển thân xe BCM, hộp túi khí\nLập trình cài đặt chìa khóa thông minh Smartkey, reset cảm biến áp suất lốp TPMS",
            'content'   => '<p>Hệ thống điện xe hơi đời mới vô cùng phức tạp với hàng chục mạng CAN Bus kết nối các hộp điều khiển. Đội ngũ kỹ sư điện tử của Gara Hải Hà được đào tạo chuyên sâu, xử lý dứt điểm các lỗi chập chờn, báo đèn động cơ, mất nguồn hoặc lỗi cảm biến.</p>'
        ),

        // 7. Điều hòa và làm mát
        array(
            'title'     => 'Bảo Dưỡng, Nạp Gas & Sửa Chữa Hệ Thống Điều Hòa Ô Tô Nội Soi',
            'slug'      => 'bao-duong-dieu-hoa-o-to',
            'category'  => 'dieu-hoa-lam-mat',
            'badge'     => 'NỘI SOI KHÔNG THÁO TAPLO',
            'price'     => 'từ 400.000 đ',
            'duration'  => '45 - 90 phút',
            'warranty'  => 'Bảo hành 12 tháng',
            'image'     => $shiftup_img . '/banner-2.jpg',
            'excerpt'   => 'Nạp gas điều hòa R134a/R1234yf chuẩn khối lượng, vệ sinh dàn lạnh nội soi camera, sửa lốc lạnh và súc rửa két nước.',
            'features'  => "Vệ sinh dàn lạnh bằng công nghệ camera nội soi không cần tháo táp-lô nguyên bản\nHút chân không và nạp gas điều hòa chính xác theo khối lượng chuẩn hãng\nSửa chữa, thay thế lốc điều hòa (block lạnh), van tiết lưu, phin lọc gas\nKhử mùi diệt khuẩn khoang nội thất bằng công nghệ Ozone và tinh dầu sinh học\nSúc rửa két nước làm mát, thay nước giải nhiệt động cơ chống đóng cặn",
            'content'   => '<p>Hệ thống điều hòa hoạt động tốt đem lại không khí trong lành, mát sâu cho mọi hành khách. Công nghệ nội soi dàn lạnh tại Gara Hải Hà làm sạch 100% nấm mốc và bụi bẩn mà không cần tháo taplo, bảo vệ hệ thống điện và khớp nhựa nguyên bản của xe.</p>'
        ),

        // 8. Hệ thống xả và khí thải
        array(
            'title'     => 'Sửa Chữa Ống Xả, Bầu Lọc Khí Thải Catalytic & Xử Lý Khói Đen',
            'slug'      => 'sua-chua-ong-xa-khi-thai',
            'category'  => 'xa-khi-thai',
            'badge'     => 'CHUẨN ĐĂNG KIỂM',
            'price'     => 'từ 500.000 đ',
            'duration'  => '1 - 2 tiếng',
            'warranty'  => 'Bảo hành 12 tháng',
            'image'     => $shiftup_img . '/center-car.jpg',
            'excerpt'   => 'Sửa chữa, thay thế ống xả, pô xe, vệ sinh bộ lọc xúc tác khí thải (Cat), vệ sinh van EGR và bầu lọc hạt DPF cho xe dầu.',
            'features'  => "Hàn nắn, thay thế đoạn ống xả bị mục thủng, rách ống mềm chống rung\nVệ sinh phục hồi bầu xúc tác khí thải Catalytic Converter bị tắc nghẹt\nVệ sinh van tuần hoàn khí xả EGR và bầu lọc hạt DPF cho động cơ Diesel\nThay thế cảm biến oxy trước và sau bầu lọc triệt tiêu lỗi báo đèn Check Engine\nKiểm tra nồng độ khí xả CO, HC đạt tiêu chuẩn kiểm định đăng kiểm quốc gia",
            'content'   => '<p>Ống xả và bầu lọc khí thải bị tắc nghẽn sẽ khiến động cơ bị ỳ, nóng máy và hao nhiên liệu rõ rệt. Gara Hải Hà cung cấp dịch vụ súc rửa xúc tác và thay thế ống xả chính hãng, giúp động cơ thở thông thoáng và vận hành thanh thoát.</p>'
        ),

        // 9. Đồng sơn – ngoại thất
        array(
            'title'     => 'Gò Hàn Nắn Khung Sườn, Phòng Sơn Sấy Hấp Công Nghệ Châu Âu',
            'slug'      => 'dong-son-phong-say-hap',
            'category'  => 'dong-son-ngoai-that',
            'badge'     => 'BẢO HÀNH SƠN 24 THÁNG',
            'price'     => 'từ 450.000 đ / chi tiết',
            'duration'  => '4 - 24 tiếng',
            'warranty'  => 'Bảo hành 24 tháng theo biển số',
            'image'     => $shiftup_img . '/banner-1.jpg',
            'excerpt'   => 'Phòng sơn sấy hấp hồng ngoại khép kín, sơn dặm nhanh 4 tiếng, sơn quây đổi màu toàn xe, gò nắn xe tai nạn và làm bảo hiểm.',
            'features'  => "Phòng sơn sấy gia nhiệt hồng ngoại 65°C với hệ thống lọc bụi áp suất dương\nSơn gốc nước cao cấp Axalta / Dupont chính hãng Châu Âu chống bay màu\nMáy so màu quang phổ điện tử pha màu chuẩn xác 100% màu sơn nguyên bản\nKéo nắn khung xe tai nạn trên sàn nắn thủy lực đa điểm chuẩn kích thước hình học\nLiên kết hỗ trợ giám định bồi thường bảo hiểm thân vỏ trọn gói cho mọi hãng bảo hiểm",
            'content'   => '<p>Quy trình đồng sơn 5 bước nghiêm ngặt tại Gara Hải Hà đảm bảo nước sơn bóng sâu, mịn màng và không bao giờ bị ố vàng, bong tróc. Chúng tôi cam kết bảo hành màu sơn lên tới 24 tháng bằng mã bảo hành điện tử theo biển số xe.</p>'
        ),

        // 10. Chăm sóc và làm đẹp xe (Detailing)
        array(
            'title'     => 'Chăm Sóc Xe Detailing, Phủ Ceramic Pro 9H & Dán Phim PPF',
            'slug'      => 'detailing-phu-ceramic-dan-ppf',
            'category'  => 'detailing-cham-soc-xe',
            'badge'     => 'CERAMIC PRO & PPF TPU',
            'price'     => 'từ 800.000 đ',
            'duration'  => '3 - 8 tiếng',
            'warranty'  => 'Bảo hành 24 - 36 tháng',
            'image'     => $shiftup_img . '/banner-4.jpg',
            'excerpt'   => 'Dọn nội thất chuyên sâu, rửa khoang máy hơi nước nóng, đánh bóng xóa xước, phủ Ceramic bóng gương và dán phim cách nhiệt 3M.',
            'features'  => "Dọn và dưỡng chi tiết nội thất da, nỉ, trần xe bằng dung dịch Meguiar’s cao cấp\nRửa và phủ dưỡng khoang động cơ khô bằng công nghệ hơi nước nóng 150°C\nĐánh bóng 3 bước hiệu chỉnh bề mặt sơn loại bỏ hoàn toàn vết xước xoáy\nPhủ bóng Ceramic Pro 9H kháng hóa chất, tạo hiệu ứng lá sen chống bám nước\nDán phim cách nhiệt 3M Crystalline và dán phim bảo vệ sơn PPF TPU tự phục hồi",
            'content'   => '<p>Dịch vụ Detailing tại Gara Hải Hà biến chiếc xe của bạn trở lại vẻ đẹp lộng lẫy như ngày đầu nhận xe từ showroom. Mọi hóa chất chăm sóc đều đạt chuẩn an toàn quốc tế, không gây hại cho bề mặt da và sơn xe.</p>'
        ),

        // 11. Nâng cấp và phụ kiện
        array(
            'title'     => 'Độ Đèn Bi LED/Laser, Lắp Màn Hình Android, Camera 360 & Âm Thanh',
            'slug'      => 'do-den-man-hinh-camera-360',
            'category'  => 'nang-cap-phu-kien',
            'badge'     => 'CẮM JACK ZIN 100%',
            'price'     => 'từ 1.500.000 đ',
            'duration'  => '1 - 3 tiếng',
            'warranty'  => 'Bảo hành 24 - 36 tháng',
            'image'     => $shiftup_img . '/port-4.jpg',
            'excerpt'   => 'Nâng cấp hệ thống chiếu sáng bi LED/Laser tăng sáng 500%, lắp camera 360, camera hành trình và màn hình Android liền camera.',
            'features'  => "Độ đèn bi LED, bi gầm, bi Laser tăng sáng vượt trội không gây chói mắt xe đối diện\nLắp đặt hoàn toàn cắm giắc zin 100%, không cắt trích dây điện, giữ nguyên bảo hành hãng\nLắp màn hình Android thông minh điều khiển giọng nói, tích hợp bản đồ Vietmap Live\nLắp camera 360 độ toàn cảnh hỗ trợ đỗ xe và lưu hành trình 4 hướng\nBọc ghế da Nappa cao cấp, thảm lót sàn 6D may đo chuẩn form từng dòng xe",
            'content'   => '<p>Hải Hà ÔTô chỉ cung cấp các dòng phụ kiện chính hãng có chứng nhận an toàn kỹ thuật. Kỹ thuật viên điện của chúng tôi thi công gọn gàng, sử dụng giắc cắm chuyên dụng để xe đăng kiểm hoàn toàn hợp lệ.</p>'
        ),

        // 12. Dịch vụ hỗ trợ
        array(
            'title'     => 'Cứu Hộ Giao Thông 24/7, Giám Định Xe Cũ & Hỗ Trợ Đăng Kiểm',
            'slug'      => 'cuu-ho-giao-thong-24-7-giam-dinh-xe',
            'category'  => 'dich-vu-ho-tro-cuu-ho',
            'badge'     => 'TRỰC CHIẾN 24/7',
            'price'     => 'từ 300.000 đ',
            'duration'  => 'Trực chiến 24/7',
            'warranty'  => 'Hỗ trợ tức thì',
            'image'     => $shiftup_img . '/slide-bao-duong.jpg',
            'excerpt'   => 'Xe kéo sàn trượt trực chiến 24/7 toàn quốc, cứu hộ ắc quy chết máy, giám định xe cũ 142 hạng mục trước khi mua bán.',
            'features'  => "Đội xe cứu hộ kéo sàn trượt chuyên dụng tiếp cận hiện trường nhanh chóng\nKích bình ắc quy, thay lốp dự phòng, cung cấp nhiên liệu khẩn cấp tận nơi\nGiám định xe cũ trước khi mua: kiểm tra đâm đụng, thủy kích, tua công-tơ-mét\nHỗ trợ bảo dưỡng và hoàn thiện thủ tục đăng kiểm xe cơ giới nhanh gọn\nCung cấp xe ô tô thay thế tạm thời cho khách hàng trong thời gian sửa chữa lớn",
            'content'   => '<p>Bất kể ngày đêm hay thời tiết mưa bão, đường dây nóng cứu hộ của Gara Ô tô Hải Hà luôn sẵn sàng hỗ trợ bạn. Chúng tôi mang đến sự an tâm tuyệt đối trên mọi nẻo đường với đội ngũ ứng cứu nhanh và trang thiết bị kéo xe hiện đại.</p>'
        )
    );

    // 3. Insert or Update Posts
    foreach ($services as $s) {
        $existing = get_page_by_path($s['slug'], OBJECT, 'garage_service');
        $post_data = array(
            'post_title'    => $s['title'],
            'post_name'     => $s['slug'],
            'post_content'  => $s['content'],
            'post_excerpt'  => $s['excerpt'],
            'post_status'   => 'publish',
            'post_type'     => 'garage_service'
        );

        if ($existing) {
            $post_data['ID'] = $existing->ID;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }

        if (!is_wp_error($post_id)) {
            // Assign Category
            if (isset($term_ids[$s['category']])) {
                wp_set_object_terms($post_id, array((int)$term_ids[$s['category']]), 'service_category');
            }

            // Save Metadata
            update_post_meta($post_id, '_garage_badge', $s['badge']);
            update_post_meta($post_id, '_garage_price', $s['price']);
            update_post_meta($post_id, '_garage_duration', $s['duration']);
            update_post_meta($post_id, '_garage_warranty', $s['warranty']);
            update_post_meta($post_id, '_garage_custom_image', $s['image']);
            update_post_meta($post_id, '_garage_features', $s['features']);
        }
    }

    update_option('hieugara_12_services_imported', true);
}

// Hook to theme setup or admin_init
add_action('after_switch_theme', 'hieugara_populate_sample_services');
add_action('admin_init', 'hieugara_populate_sample_services');
