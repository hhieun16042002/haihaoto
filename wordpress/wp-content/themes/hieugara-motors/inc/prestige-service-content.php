<?php
/**
 * Prestige Automobile Detailed Service Content Adapted for Ôtô Hải Hà
 *
 * @package HieuGara_Motors
 */

if (!defined('ABSPATH')) {
    exit;
}

function hieugara_get_prestige_footer_box() {
    $rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
    $hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
    return '
    <div style="margin-top: 32px; padding: 24px 28px; background: #fff8f6; border-left: 4px solid #ff4d24; border-radius: 4px;">
        <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.05rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; text-transform: uppercase;">
            TRUNG TÂM BẢO DƯỠNG VÀ SỬA CHỮA Ô TÔ CAO CẤP ÔTÔ HẢI HÀ
        </h4>
        <p style="margin: 0 0 6px; color: #334155; font-size: 0.95rem;"><strong>Địa chỉ:</strong> Km 53+300 Quốc lộ 5 (Chiều Hà Nội – Hải Phòng), Phường Cẩm Thượng, TP. Hải Dương</p>
        <p style="margin: 0 0 6px; color: #334155; font-size: 0.95rem;"><strong>Hotline Cứu Hộ &amp; Tư Vấn 24/7:</strong> <a href="tel:' . esc_attr(preg_replace('/[^0-9]/', '', $rescue_phone)) . '" style="color: #ff4d24; font-weight: 700; text-decoration: none;">' . esc_html($rescue_phone) . '</a> – <a href="tel:' . esc_attr(preg_replace('/[^0-9]/', '', $hotline_phone)) . '" style="color: #0f172a; font-weight: 700; text-decoration: none;">' . esc_html($hotline_phone) . '</a></p>
    </div>';
}

function hieugara_get_prestige_service_data($slug) {
    $theme_uri   = get_template_directory_uri();
    $gallery_img = $theme_uri . '/assets/images/gallery';
    $footer_box  = hieugara_get_prestige_footer_box();

    // Map child slugs to primary Prestige content keys
    $alias_map = array(
        // 1. Bảo dưỡng ô tô
        'bao-duong-o-to'                  => 'bao-duong-o-to',
        'bao-duong-dinh-ky'               => 'bao-duong-o-to',
        'thay-dau-va-loc-o-to'            => 'bao-duong-o-to',
        'kiem-tra-va-bao-duong-tong-quat' => 'bao-duong-o-to',

        // 2. Sửa chữa ô tô & Điện điều hòa
        'sua-chua-o-to'                   => 'sua-chua-o-to',
        'sua-chua-dong-co'                => 'sua-chua-o-to',
        'sua-chua-hop-so-va-truyen-dong'  => 'sua-chua-o-to',
        'sua-chua-he-thong-phanh'         => 'sua-chua-o-to',
        'sua-chua-gam-va-he-thong-treo'   => 'sua-chua-o-to',
        'sua-chua-he-thong-lai'           => 'sua-chua-o-to',
        'sua-chua-he-thong-xa-va-khi-thai'=> 'sua-chua-o-to',
        'dien-o-to-dieu-hoa'              => 'sua-chua-o-to',
        'sua-chua-dien-o-to'              => 'sua-chua-o-to',
        'sua-chua-dien-tu-va-ecu'         => 'sua-chua-o-to',
        'sua-chua-dieu-hoa-o-to'          => 'sua-chua-o-to',
        'he-thong-lam-mat-o-to'           => 'sua-chua-o-to',

        // 3. Sửa chữa thân vỏ - Đồng sơn
        'dong-son-o-to'                   => 'dong-son-o-to',
        'son-o-to'                        => 'dong-son-o-to',
        'go-han-va-sua-chua-than-vo'      => 'dong-son-o-to',
        'sua-chua-kinh-va-den-o-to'       => 'dong-son-o-to',
        'sua-chua-o-to-sau-va-cham'       => 'dong-son-o-to',

        // 4. Sửa chữa xe bảo hiểm
        'bao-hiem-va-bao-hanh-o-to'       => 'bao-hiem-o-to',

        // 5. Nâng cấp nội - ngoại thất
        'phu-kien-va-nang-cap-o-to'       => 'nang-cap-o-to',
        'nang-cap-anh-sang-va-am-thanh'   => 'nang-cap-o-to',

        // 6. Chăm sóc nội - ngoại thất (Detailing)
        'cham-soc-nang-cap-o-to'          => 'cham-soc-o-to',
        'cham-soc-va-lam-dep-xe-detailing'=> 'cham-soc-o-to',
        've-sinh-noi-that-o-to'           => 'cham-soc-o-to',
        'danh-bong-va-phu-ceramic'        => 'cham-soc-o-to',
        'phim-cach-nhiet-va-ppf'          => 'cham-soc-o-to',

        // 7. Cứu hộ xe 24/7
        'cuu-ho-ho-tro-o-to'              => 'cuu-ho-o-to',
        'cuu-ho-giao-thong-o-to'          => 'cuu-ho-o-to',
        'sua-chua-o-to-luu-dong'          => 'cuu-ho-o-to',

        // 8. Hỗ trợ đăng kiểm xe
        'dich-vu-dang-kiem-o-to'          => 'dang-kiem-o-to',
        'kiem-tra-xe-cu-truoc-khi-mua'    => 'dang-kiem-o-to',
        'bao-duong-xe-doanh-nghiep'       => 'bao-duong-o-to',
    );

    $key = isset($alias_map[$slug]) ? $alias_map[$slug] : 'bao-duong-o-to';

    $data = array(
        'bao-duong-o-to' => array(
            'title'    => 'Bảo Dưỡng Ô Tô – Chìa Khóa Cho Xe Có Hành Trình Êm Ái và An Toàn',
            'badge'    => 'BẢO DƯỠNG ĐỊNH KỲ CHUẨN HÃNG',
            'img'      => $gallery_img . '/haiha-gallery-4.jpg',
            'duration' => '45 - 90 phút',
            'warranty' => '12 - 24 tháng',
            'price'    => 'Theo cấp bảo dưỡng (5.000km - 40.000km+)',
            'html'     => '
                <p>Giống như cơ thể con người cần được thăm khám sức khỏe, xe của bạn cũng cần được “chăm sóc” đúng lịch trình để duy trì phong độ đỉnh cao. Bảo dưỡng ô tô không chỉ giúp động cơ vận hành mượt mà, tiết kiệm nhiên liệu mà còn là biện pháp ngăn chặn sớm những hỏng hóc nghiêm trọng, giúp bạn tiết kiệm tối đa chi phí sửa chữa sau này.</p>
                <p>Là trung tâm dịch vụ ô tô cao cấp hàng đầu tại khu vực Hải Dương (Km 53+300 Quốc lộ 5, Phường Cẩm Thượng, TP. Hải Dương), <strong>Ôtô Hải Hà</strong> mang đến quy trình bảo dưỡng định kỳ chuẩn hãng. Chúng tôi cung cấp các gói bảo dưỡng linh hoạt theo số kilomet (5.000km, 10.000km, 20.000km, 40.000km…) hoặc theo thời gian sử dụng, đáp ứng hoàn hảo tiêu chuẩn khắt khe của các dòng xe từ phổ thông đến cao cấp.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Chi Tiết Các Hạng Mục Bảo Dưỡng Cốt Lõi Tại Ôtô Hải Hà
                </h3>
                <p>Quy trình bảo dưỡng của chúng tôi được thiết kế toàn diện, tập trung vào việc phục hồi hiệu suất và đảm bảo an toàn tuyệt đối cho mọi chuyến đi:</p>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Thay dầu nhớt động cơ và Lọc nhớt:</strong> Nhớt được ví như “máu” của động cơ, giúp bôi trơn, làm mát và làm sạch các chi tiết cơ khí. Chúng tôi sử dụng các dòng dầu nhớt tổng hợp toàn phần (Fully Synthetic) từ các thương hiệu danh tiếng toàn cầu, kết hợp thay thế lọc nhớt chính hãng để đảm bảo động cơ luôn hoạt động trơn tru, chống mài mòn tối đa.</li>
                    <li style="margin-bottom: 12px;"><strong>Kiểm tra kỹ thuật tổng quát toàn diện:</strong> Kỹ thuật viên sẽ đưa xe lên cầu nâng để rà soát chi tiết hệ thống gầm, hệ thống treo, phanh xe, hệ thống lái và lốp xe. Kết hợp sử dụng máy chẩn đoán điện tử (Diagnostic Scanner) để quét lỗi toàn bộ hệ thống ECU, đảm bảo không bỏ sót bất kỳ rủi ro tiềm ẩn nào.</li>
                    <li style="margin-bottom: 12px;"><strong>Vệ sinh và Thay thế lọc gió (Động cơ &amp; Cabin):</strong>
                        <br>• <em>Lọc gió động cơ:</em> Được kiểm tra và vệ sinh sạch bụi bẩn để buồng đốt luôn nhận đủ không khí sạch, duy trì công suất và tiết kiệm nhiên liệu.
                        <br>• <em>Lọc gió điều hòa (Cabin filter):</em> Vệ sinh hoặc thay mới để loại bỏ vi khuẩn, nấm mốc và mùi hôi, bảo vệ sức khỏe hô hấp cho cả gia đình bạn.
                    </li>
                    <li style="margin-bottom: 12px;"><strong>Vệ sinh kim phun và Buồng đốt:</strong> Sau một thời gian vận hành, muội carbon sẽ tích tụ làm tắc nghẽn kim phun, khiến xe chạy có độ trễ, hao xăng và rung giật. Chúng tôi sử dụng dung dịch làm sạch chuyên dụng và công nghệ vệ sinh tiên tiến giúp đánh bay muội than, phục hồi độ tơi của tia phun nhiên liệu, trả lại sức mạnh nguyên bản cho khối động cơ.</li>
                    <li style="margin-bottom: 12px;"><strong>Kiểm tra và Bổ sung các loại dung dịch thiết yếu:</strong> Rà soát và châm thêm (hoặc thay mới khi đến hạn) nước làm mát động cơ, dung dịch nước rửa kính, dầu phanh, dầu trợ lực lái. Đảm bảo các hệ thống phụ trợ luôn trong trạng thái sẵn sàng làm việc dưới cường độ cao.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Tại Sao Nên Chọn Bảo Dưỡng Xe Tại Ôtô Hải Hà?
                </h3>
                <p>Chúng tôi hiểu rằng thời gian của bạn là vô giá và sự an tâm là điều quan trọng nhất khi giao chìa khóa xe cho một garage:</p>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Vật tư &amp; Phụ tùng cao cấp:</strong> Cam kết 100% dầu nhớt và phụ tùng thay thế (lọc nhớt, lọc gió, bugi…) là hàng chính hãng hoặc OEM cao cấp, tương thích tuyệt đối với từng dòng xe.</li>
                    <li style="margin-bottom: 10px;"><strong>Minh bạch trong từng chi phí:</strong> Mọi hạng mục cần thay thế hoặc bảo dưỡng đều được Cố vấn dịch vụ báo giá chi tiết, giải thích cặn kẽ và chỉ thực hiện khi có sự đồng ý từ khách hàng.</li>
                    <li style="margin-bottom: 10px;"><strong>Đội ngũ chuyên gia tận tâm:</strong> Kỹ thuật viên được đào tạo chuyên sâu, thao tác chuẩn xác, nhanh chóng, không làm mất thời gian chờ đợi của bạn.</li>
                    <li style="margin-bottom: 10px;"><strong>Cơ sở vật chất hiện đại:</strong> Xưởng dịch vụ rộng rãi, trang thiết bị tối tân, cùng không gian phòng chờ tiện nghi giúp trải nghiệm chờ bảo dưỡng xe của bạn trở nên thư thái hơn bao giờ hết.</li>
                </ul>
                <p>Đừng chờ đến khi xế yêu “lên tiếng” mới đưa xe đi kiểm tra. Đặt lịch bảo dưỡng định kỳ ngay hôm nay tại <strong>Ôtô Hải Hà</strong> để mọi hành trình luôn là những trải nghiệm tuyệt vời nhất.</p>
            ' . $footer_box
        ),

        'sua-chua-o-to' => array(
            'title'    => 'Dịch Vụ Sửa Chữa Ô Tô Chuyên Sâu Tại Ôtô Hải Hà',
            'badge'    => 'CHẨN ĐOÁN & SỬA CHỮA CHUYÊN SÂU',
            'img'      => $gallery_img . '/haiha-gallery-1.jpg',
            'duration' => 'Khảo sát theo hạng mục',
            'warranty' => '12 - 24 tháng',
            'price'    => 'Kiểm tra chẩn đoán & Báo giá minh bạch',
            'html'     => '
                <p>Chiếc xe hơi không chỉ là phương tiện di chuyển mà còn là tài sản và người bạn đồng hành bảo vệ sự an toàn cho cả gia đình bạn trên mọi hành trình. Sau một thời gian dài vận hành hoặc do tác động của điều kiện thời tiết, đường sá khắc nghiệt, xế cưng của bạn khó tránh khỏi những hao mòn và hỏng hóc kỹ thuật.</p>
                <p>Hiểu được tầm quan trọng của việc duy trì hiệu suất vận hành hoàn hảo, <strong>Ôtô Hải Hà</strong> mang đến giải pháp sửa chữa ô tô toàn diện và chuyên sâu. Tọa lạc tại Km 53+300 Quốc lộ 5, Phường Cẩm Thượng, TP. Hải Dương, chúng tôi tự hào là điểm đến tin cậy của cộng đồng yêu xe, đặc biệt là các dòng xe phổ thông và xe cao cấp, nhờ đội ngũ chuyên gia giàu kinh nghiệm và hệ thống trang thiết bị chẩn đoán hiện đại bậc nhất.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Các Hạng Mục Sửa Chữa Trọng Tâm Tại Ôtô Hải Hà
                </h3>
                <p>Tại <strong>Ôtô Hải Hà</strong>, chúng tôi có khả năng xử lý triệt để từ những bệnh cơ bản đến các lỗi hệ thống phức tạp nhất:</p>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa động cơ:</strong> Xử lý triệt để các tình trạng động cơ rung giật, hao hụt dầu nhớt, sôi nước làm mát, hay có tiếng gõ bất thường. Dịch vụ bao gồm: đại tu động cơ, thay thế gioăng phớt, vệ sinh buồng đốt, sửa chữa hệ thống làm mát và hệ thống phun nhiên liệu.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa hệ thống điện và điện tử:</strong> Các dòng xe hiện đại được trang bị hệ thống điện tử chằng chịt và vô cùng nhạy cảm. Bằng máy đọc lỗi chuyên hãng, chúng tôi chẩn đoán và khắc phục nhanh chóng các lỗi từ Hộp điều khiển trung tâm (ECU), hệ thống cảm biến, lỗi cáp nguồn, đến việc cài đặt (coding) lại phần mềm hệ thống.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa máy gầm và Hệ thống treo:</strong> Đường sá nhiều ổ gà và ngập nước dễ làm tổn thương hệ thống gầm. Chúng tôi cung cấp dịch vụ thay thế phuộc giảm xóc, càng A, rô-tuyn, cao su chân máy, cao su chân số và căn chỉnh thước lái điện tử, giúp trả lại sự êm ái và đầm chắc nguyên bản cho xế cưng.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa hệ thống lái:</strong> Đảm bảo an toàn tuyệt đối với các hạng mục xử lý chảy dầu thước lái, thay thế bơm trợ lực lái, xử lý vô lăng nặng, rơ lệch hoặc có tiếng kêu lục cục khi đánh lái.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa và Nâng cấp hệ thống chiếu sáng:</strong> Xử lý tình trạng đèn pha/hậu bị đọng hơi nước, ố vàng, cháy bóng hoặc lỗi hộp điều khiển đèn. Hỗ trợ nâng cấp ánh sáng an toàn, đúng tiêu chuẩn kỹ thuật để tăng cường tầm nhìn khi đi đêm hoặc trời mưa sương mù.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa hộp số:</strong> Hộp số là bộ phận truyền tải sức mạnh phức tạp, đòi hỏi độ chính xác tuyệt đối. Chúng tôi xử lý dứt điểm các hiện tượng xe chuyển số bị giật cục, trượt số, vòng tua máy cao nhưng xe vọt chậm, hoặc rò rỉ dầu đáy hộp số. Dịch vụ bao gồm: thay dầu hộp số tuần hoàn, thay vỉ điều khiển (Mechatronics), và đại tu các dòng hộp số tự động (AT, CVT, DCT) chuyên sâu.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa hệ thống phanh:</strong> Sự an toàn của bạn luôn được đặt lên hàng đầu. <strong>Ôtô Hải Hà</strong> tiếp nhận xử lý hiện tượng phanh kêu rít, bàn đạp phanh sâu/nặng, rung lắc vô lăng khi phanh gấp. Dịch vụ gồm: thay má phanh chất lượng cao, láng đĩa phanh trực tiếp, thay dầu phanh định kỳ và chẩn đoán lỗi hệ thống chống bó cứng phanh (ABS), phân phối lực phanh (EBD).</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa hệ thống điều hòa ô tô:</strong> Trả lại không gian mát lạnh và trong lành cho khoang cabin. Kỹ thuật viên của chúng tôi chuyên bắt bệnh điều hòa ô tô không mát, mát không sâu, gió yếu hoặc có mùi hôi. Các hạng mục triển khai: vệ sinh dàn lạnh nội soi (không tháo taplo), kiểm tra rò rỉ khí gas, nạp gas lạnh tiêu chuẩn, thay lốc điều hòa và lọc gió cabin.</li>
                    <li style="margin-bottom: 12px;"><strong>Dịch vụ mâm lốp và Cân bằng động:</strong> Lốp xe quyết định độ êm ái và khả năng bám đường. Chúng tôi cung cấp dịch vụ thay thế lốp xe cao cấp, vá lốp an toàn chuẩn kỹ thuật, cân bằng động (bấm chì) bằng máy laser và đảo lốp định kỳ để khắc phục triệt để tình trạng lốp mòn không đều hoặc chao đảo khi chạy tốc độ cao.</li>
                    <li style="margin-bottom: 12px;"><strong>Chẩn đoán lỗi ô tô điện tử (Diagnostic):</strong> Tự hào sở hữu hệ thống máy chẩn đoán (OEM Scanners) và phần mềm bản quyền thế hệ mới nhất. <strong>Ôtô Hải Hà</strong> dễ dàng “đọc vị” mọi cảnh báo trên bảng đồng hồ (đèn Check Engine, lỗi túi khí, lỗi hộp số, lỗi hệ thống điện trên xe điện/hybrid). Chuyên cài đặt (Coding), lập trình lại phần mềm và reset các hộp điều khiển (ECU) theo đúng thông số xuất xưởng.</li>
                    <li style="margin-bottom: 12px;"><strong>Sửa chữa hệ thống truyền động:</strong> Khắc phục triệt để các tiếng kêu lục cục gầm xe, tiếng hú từ gầm hoặc hiện tượng thân xe rung lắc mạnh khi thốc ga tăng tốc. Đội ngũ chuyên gia sẽ kiểm tra, bảo dưỡng và thay thế vật tư cho trục các-đăng (Driveshaft), trục láp, bộ vi sai, thay dầu cầu và xử lý các lỗi trên hệ dẫn động (RWD, AWD/4WD), giúp xe vận hành trơn tru và tối ưu hóa lực kéo.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Tại Sao Khách Hàng Tin Tưởng Lựa Chọn Ôtô Hải Hà?
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Chẩn đoán chính xác – Sửa đúng bệnh:</strong> Không phỏng đoán, không “vẽ” thêm bệnh. Mọi hư hỏng đều được đối chiếu bằng dữ liệu từ máy quét lỗi chuyên sâu (Diagnostic Scanner).</li>
                    <li style="margin-bottom: 10px;"><strong>Phụ tùng minh bạch:</strong> Cam kết sử dụng phụ tùng chính hãng hoặc phụ tùng thay thế cao cấp (OEM) từ các thương hiệu danh tiếng, có đầy đủ hóa đơn chứng từ và chính sách bảo hành rõ ràng.</li>
                    <li style="margin-bottom: 10px;"><strong>Kỹ thuật viên chuyên trách giàu kinh nghiệm:</strong> Đội ngũ thợ máy và kỹ sư điện được đào tạo bài bản, am hiểu sâu sắc cấu tạo phức tạp của các dòng xe châu Âu, xe Nhật, xe Hàn và xe đời mới.</li>
                    <li style="margin-bottom: 10px;"><strong>Không gian dịch vụ chuyên nghiệp:</strong> Khách hàng được thư giãn trong phòng chờ tiện nghi, được cập nhật tiến độ sửa chữa xe liên tục bởi đội ngũ cố vấn dịch vụ chuyên nghiệp.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Quy Trình Dịch Vụ 5 Bước Minh Bạch Và Chuyên Nghiệp
                </h3>
                <ol style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Tiếp nhận và Lắng nghe:</strong> Cố vấn dịch vụ ghi nhận tình trạng xe và mong muốn của khách hàng.</li>
                    <li style="margin-bottom: 10px;"><strong>Kiểm tra và Chẩn đoán:</strong> Kỹ thuật viên đưa xe lên cầu nâng, kết hợp máy đọc lỗi để xác định chính xác nguyên nhân.</li>
                    <li style="margin-bottom: 10px;"><strong>Báo giá chi tiết:</strong> Gửi bảng dự toán sửa chữa, giải thích rõ ràng từng hạng mục vật tư và nhân công. Chúng tôi chỉ tiến hành khi có sự đồng ý của khách hàng.</li>
                    <li style="margin-bottom: 10px;"><strong>Thực thi sửa chữa:</strong> Tiến hành thay thế, sửa chữa theo đúng quy chuẩn kỹ thuật của nhà sản xuất.</li>
                    <li style="margin-bottom: 10px;"><strong>Chạy thử và Bàn giao:</strong> Kỹ thuật viên trực tiếp chạy thử nghiệm thu (Quality Control) trước khi vệ sinh sạch sẽ và bàn giao xe tận tay khách hàng kèm chính sách bảo hành.</li>
                </ol>
                <p>Đừng để những hỏng hóc nhỏ làm gián đoạn hành trình của bạn. Hãy để xe của bạn được chăm sóc bởi những đôi tay chuyên gia tại <strong>Ôtô Hải Hà</strong>.</p>
            ' . $footer_box
        ),

        'dong-son-o-to' => array(
            'title'    => 'Dịch Vụ Đồng Sơn & Phục Hồi Thân Vỏ: Trả Lại Vẻ Đẹp Nguyên Bản Cho Xế Cưng',
            'badge'    => 'PHÒNG SƠN SẤY TIÊU CHUẨN • BẢO HÀNH TRỌN ĐỜI',
            'img'      => $gallery_img . '/haiha-gallery-2.jpg',
            'duration' => 'Từ 4 giờ (Sơn dặm lấy ngay)',
            'warranty' => 'Bảo hành chất lượng sơn trọn đời',
            'price'    => 'Báo giá theo vết xước / Hỗ trợ Bảo hiểm',
            'html'     => '
                <p>Ngoại thất sáng bóng, hoàn hảo không tì vết chính là “bộ mặt” thể hiện đẳng cấp của chiếc xe và phong cách của chủ nhân. Tuy nhiên, trong quá trình di chuyển tại các đô thị đông đúc, việc xế cưng gặp phải những va quẹt gây trầy xước, móp méo hay mài mòn lớp sơn do thời tiết là điều khó tránh khỏi.</p>
                <p>Tại <strong>Ôtô Hải Hà</strong>, chúng tôi mang đến giải pháp Đồng sơn và Phục hồi thân vỏ đỉnh cao với đặc quyền bảo hành chất lượng bề mặt sơn. Với sơn gốc nước chuẩn cao cấp thân thiện với môi trường, bền màu cùng thời gian kết hợp cùng công nghệ hiện đại và bàn tay tài hoa của những kỹ thuật viên lành nghề, chúng tôi cam kết xóa mờ mọi dấu vết va chạm, trả lại diện mạo nguyên bản hoàn mỹ như ngày đầu xuất xưởng cho chiếc xe của bạn.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Chi Tiết Các Hạng Mục Dịch Vụ Đồng Sơn Tại Ôtô Hải Hà
                </h3>
                <p>Dù là một vết xước nhỏ hay những hư hỏng nặng nề sau va chạm, hệ thống xưởng đồng sơn tiêu chuẩn của chúng tôi đều có thể xử lý triệt để:</p>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Sơn dặm, sơn tút (Xóa xước nhanh):</strong> Xử lý nhanh gọn các vết trầy xước cục bộ ở cản trước/sau, cửa xe, lườn xe. Công nghệ pha màu vi tính cam kết độ tiệp màu 100%, không để lại bất kỳ ranh giới hay vùng chênh lệch màu nào so với lớp sơn zin nguyên bản.</li>
                    <li style="margin-bottom: 12px;"><strong>Phục hồi hình dạng thân vỏ (Gò, hàn, nắn móp):</strong> Đối với các xe gặp tai nạn, móp méo sâu, kỹ thuật viên sẽ sử dụng hệ thống máy giật tôn, thước đo điện tử để nắn chỉnh, kéo nắn lại khung gầm và thân vỏ. Đảm bảo khôi phục chính xác thông số khí động học và độ cứng cáp của cấu trúc xe.</li>
                    <li style="margin-bottom: 12px;"><strong>Sơn quây, sơn toàn bộ xe &amp; Đổi màu:</strong> Dành cho những chiếc xe đã xuống cấp toàn diện do thời gian hoặc chủ nhân muốn đổi màu hợp phong thủy/sở thích. Quá trình lột bỏ lớp sơn cũ, xử lý bề mặt chống gỉ, bả matit và sơn nhiều lớp được thực hiện trong môi trường khép kín, mang lại độ bóng sâu (Deep Gloss) cực kỳ sang trọng.</li>
                    <li style="margin-bottom: 12px;"><strong>Phục hồi, đánh bóng &amp; Phủ Ceramic:</strong> Hiệu chỉnh bề mặt sơn, xóa vết xước dăm (xước màng nhện), tẩy ố kính, nhựa đường và phủ Ceramic bảo vệ lớp sơn mới khỏi tia UV và các tác nhân gây hại từ môi trường.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Sự Khác Biệt Làm Nên Đẳng Cấp Đồng Sơn Tại Ôtô Hải Hà
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Chất lượng bảo hành trọn đời:</strong> Chúng tôi tự tin áp dụng chính sách bảo hành đối với chất lượng bề mặt sơn (không bong tróc, không rạn nứt, không phai màu do lỗi vật liệu hoặc kỹ thuật thi công). Đây là lời cam kết đanh thép nhất cho chất lượng dịch vụ tại <strong>Ôtô Hải Hà</strong>.</li>
                    <li style="margin-bottom: 12px;"><strong>Phòng sơn sấy khép kín tiêu chuẩn:</strong> Quá trình sơn được thực hiện trong phòng sơn sấy áp suất âm, cách ly hoàn toàn với bụi bẩn bên ngoài. Nhiệt độ sấy được kiểm soát tự động giúp màng sơn khô đồng đều, bám dính cực chắc và đạt độ bóng tối đa.</li>
                    <li style="margin-bottom: 12px;"><strong>Hệ thống pha sơn vi tính và vật liệu cao cấp:</strong> Sử dụng 100% các dòng sơn gốc nước, dầu bóng và vật liệu xử lý bề mặt cao cấp từ các thương hiệu hàng đầu (PPG, Achison...). Hệ thống pha màu điện tử nhận diện đúng mã màu gốc của mọi dòng xe (Mercedes, BMW, Porsche, Audi, Lexus, Toyota, Mazda…).</li>
                    <li style="margin-bottom: 12px;"><strong>Hỗ trợ thủ tục bảo hiểm nhanh gọn:</strong> <strong>Ôtô Hải Hà</strong> tự hào là đối tác liên kết của nhiều hãng bảo hiểm uy tín. Chúng tôi hỗ trợ khách hàng xử lý hồ sơ bồi thường, giám định hư hỏng ngay tại xưởng một cách nhanh chóng, minh bạch, giúp bạn tiết kiệm tối đa thời gian chờ đợi.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Quy Trình Đồng Sơn 5 Bước Chuẩn Mực
                </h3>
                <ol style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Đánh giá và Báo giá:</strong> Cố vấn dịch vụ và kỹ thuật viên đồng sơn kiểm tra mức độ thiệt hại, tư vấn phương án xử lý (sơn dặm hay sơn toàn bộ) và gửi báo giá minh bạch chờ xác nhận từ khách hàng.</li>
                    <li style="margin-bottom: 10px;"><strong>Xử lý bề mặt thân vỏ:</strong> Kỹ thuật viên tiến hành gò nắn móp méo, chà nhám, bả matit và phun sơn lót chống gỉ để tạo một bề mặt nền hoàn hảo.</li>
                    <li style="margin-bottom: 10px;"><strong>Pha màu và Phun sơn:</strong> Code màu zin của xe được đưa vào máy pha vi tính. Thợ sơn tiến hành phun sơn màu và sơn bóng phủ bề mặt trong phòng sơn sấy cách ly.</li>
                    <li style="margin-bottom: 10px;"><strong>Sấy khô và Đánh bóng:</strong> Xe được sấy ở nhiệt độ tiêu chuẩn để sơn chết hoàn toàn. Sau đó, kỹ thuật viên tiến hành đánh bóng toàn bộ bề mặt để tạo độ mịn và bóng sâu (mirror-like finish).</li>
                    <li style="margin-bottom: 10px;"><strong>Kiểm tra (QC) &amp; Bàn giao:</strong> Kỹ thuật viên dùng đèn soi chuyên dụng kiểm tra lại độ tiệp màu dưới nhiều góc sáng khác nhau trước khi vệ sinh và bàn giao xe cho khách hàng.</li>
                </ol>
                <p>Hãy để <strong>Ôtô Hải Hà</strong> “hô biến” những vết xước xấu xí trở lại thành diện mạo hoàn hảo, giúp bạn luôn tự tin cầm lái xế cưng tỏa sáng trên mọi cung đường.</p>
            ' . $footer_box
        ),

        'bao-hiem-o-to' => array(
            'title'    => 'Sửa Chữa Xe Bảo Hiểm & Hỗ Trợ Thủ Tục Bồi Thường Trọn Gói (Từ A – Z)',
            'badge'    => 'ĐỐI TÁC BẢO HIỂM UY TÍN',
            'img'      => $gallery_img . '/haiha-gallery-6.jpg',
            'duration' => 'Hỗ trợ hồ sơ nhanh gọn trong ngày',
            'warranty' => 'Bảo hành chất lượng sơn trọn đời',
            'price'    => 'Hỗ trợ giám định & bồi thường bảo hiểm',
            'html'     => '
                <p>Sở hữu một chiếc ô tô không chỉ dừng lại ở việc cầm lái, mà còn đi kèm hàng loạt vấn đề khiến các chủ xe bận rộn phải đau đầu khi xảy ra va quẹt hay tai nạn: quy trình khai báo và chờ đợi giám định bảo hiểm thường lấy đi rất nhiều thời gian của chủ xe. Thấu hiểu giá trị thời gian và sự an tâm của khách hàng, <strong>Ôtô Hải Hà</strong> mang đến dịch vụ Sửa chữa xe bảo hiểm &amp; Hỗ trợ thủ tục bồi thường trọn gói từ A – Z.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Tư Vấn, Cấp Mới và Sửa Chữa Bảo Hiểm Ô Tô Trọn Gói Tại Ôtô Hải Hà
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Liên kết của các hãng bảo hiểm hàng đầu:</strong> Tư vấn và cung cấp các gói Bảo hiểm vật chất thân vỏ, Bảo hiểm trách nhiệm dân sự với mức phí ưu đãi và quyền lợi bảo vệ cao nhất.</li>
                    <li style="margin-bottom: 12px;"><strong>Hỗ trợ thủ tục bồi thường từ A – Z:</strong> Đội ngũ Cố vấn dịch vụ giàu kinh nghiệm sẽ trực tiếp hướng dẫn bạn giữ nguyên hiện trường (hoặc chụp ảnh đúng quy chuẩn), làm việc với giám định viên và hoàn thiện hồ sơ pháp lý ngay tại xưởng.</li>
                    <li style="margin-bottom: 12px;"><strong>Phục hồi chuẩn hãng – Bảo hành trọn đời:</strong> Xe làm bảo hiểm tại <strong>Ôtô Hải Hà</strong> được hưởng tiêu chuẩn đồng sơn cao cấp nhất trong phòng sơn sấy khép kín, cam kết độ tiệp màu 100%, phụ tùng thay thế chính hãng và bảo hành chất lượng màu sơn.</li>
                    <li style="margin-bottom: 12px;"><strong>Dịch vụ Giao Nhận Xe Tận Nơi (Door-to-Door Service):</strong> Nếu lịch trình công việc dày đặc khiến bạn không thể trực tiếp mang xe đến garage, đội ngũ của <strong>Ôtô Hải Hà</strong> sẽ đến nhận xe, đưa về xưởng thực hiện dịch vụ (cập nhật tiến độ liên tục qua Zalo) và bàn giao lại chiếc xe sạch bóng, hoàn hảo đúng giờ hẹn.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Tại Sao Chủ Xe Luôn Đặt Trọn Niềm Tin Vào Ôtô Hải Hà?
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Phản ứng thần tốc:</strong> Đội ngũ cứu hộ và tư vấn viên luôn túc trực, sẵn sàng có mặt và hỗ trợ xử lý tình huống nhanh nhất.</li>
                    <li style="margin-bottom: 10px;"><strong>Bảo vệ quyền lợi khách hàng tối đa:</strong> Trong các vụ việc liên quan đến bảo hiểm, chúng tôi luôn đứng về phía khách hàng để đàm phán phương án sửa chữa, thay thế vật tư tốt nhất cho chiếc xe của bạn.</li>
                    <li style="margin-bottom: 10px;"><strong>Chi phí minh bạch – Không phụ phí ẩn:</strong> Mọi khoản phí dịch vụ đều có hóa đơn, chứng từ rõ ràng.</li>
                    <li style="margin-bottom: 10px;"><strong>An toàn tài sản tuyệt đối:</strong> Quá trình nhận xe đều có biên bản bàn giao ghi nhận tình trạng xe, số ODO và tư trang minh bạch.</li>
                </ul>
            ' . $footer_box
        ),

        'nang-cap-o-to' => array(
            'title'    => 'Dịch Vụ Nâng Cấp và Độ Xe Ô Tô – Khẳng Định Đẳng Cấp, Cá Tính Riêng Của Bạn',
            'badge'    => 'NÂNG CẤP NỘI – NGOẠI THẤT CHUYÊN NGHIỆP',
            'img'      => $gallery_img . '/haiha-gallery-7.jpg',
            'duration' => '60 - 180 phút (Thi công Plug & Play)',
            'warranty' => '12 - 36 tháng chính hãng',
            'price'    => 'Theo cấu hình phụ kiện chính hãng',
            'html'     => '
                <p>Một chiếc xe nguyên bản từ nhà sản xuất đôi khi chưa thể đáp ứng trọn vẹn gu thẩm mỹ cá nhân hay những đòi hỏi khắt khe về tiện nghi, an toàn và cảm giác lái của chủ nhân. Nâng cấp và độ xe ô tô chính là nghệ thuật biến phương tiện di chuyển hàng ngày trở thành một tác phẩm mang đậm dấu ấn cá nhân, đồng thời tối ưu hóa trải nghiệm trên mọi cung đường.</p>
                <p>Tọa lạc tại Km 53+300 Quốc lộ 5, Phường Cẩm Thượng, TP. Hải Dương, <strong>Ôtô Hải Hà</strong> là địa chỉ uy tín hàng đầu chuyên cung cấp các giải pháp nâng cấp và độ xe ô tô từ cơ bản đến chuyên sâu. Chúng tôi kết hợp hoàn hảo giữa thiết bị công nghệ chính hãng, tư duy thẩm mỹ hiện đại và kỹ thuật thi công chuẩn mực để mang lại diện mạo mới hoàn hảo cùng những tính năng vượt trội cho xế cưng của bạn.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Các Hạng Mục Nâng Cấp và Độ Xe Tại Ôtô Hải Hà
                </h3>
                <p>Tại <strong>Ôtô Hải Hà</strong>, mọi gói nâng cấp đều được thiết kế riêng biệt dựa trên nhu cầu thực tế và đặc thù kỹ thuật của từng dòng xe (từ xe sang châu Âu, xe phổ thông đến các dòng xe điện phổ biến hiện nay):</p>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">1. Độ Đèn Tăng Sáng và Nâng Cấp Hệ Thống Chiếu Sáng</h4>
                <ul style="padding-left: 20px; margin-bottom: 18px;">
                    <li style="margin-bottom: 8px;"><strong>Nâng cấp Bi-LED, Bi-Laser thế hệ mới:</strong> Tăng cường độ chiếu sáng gấp nhiều lần so với đèn zin, mặt cắt ánh sáng (Cut-off) sắc nét, bám đường cực tốt và văn minh — tuyệt đối không gây chói mắt cho phương tiện đi ngược chiều.</li>
                    <li style="margin-bottom: 8px;"><strong>Độ đèn viền nội thất (Ambient Light):</strong> Biến khoang cabin trở nên lung linh, sang trọng với hệ thống LED đổi màu theo nhạc, điều khiển thông minh qua ứng dụng điện thoại.</li>
                    <li style="margin-bottom: 8px;"><strong>Thi công chuẩn kỹ thuật:</strong> Sử dụng pat bắt zin và giắc cắm chuyển đổi chuyên dụng, giữ nguyên kết cấu chóa đèn và an toàn tuyệt đối cho hệ thống điện.</li>
                </ul>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">2. Nâng Cấp Hệ Thống Âm Thanh và Cách Âm Chống Ồn</h4>
                <ul style="padding-left: 20px; margin-bottom: 18px;">
                    <li style="margin-bottom: 8px;"><strong>Cấu hình âm thanh đa dạng:</strong> Từ việc lắp thêm loa Subwoofer (Sub gầm ghế, Sub hơi) để tăng dải âm trầm ấm áp, đến việc nâng cấp toàn diện hệ thống loa cánh (2-way, 3-way), Amply và bộ xử lý tín hiệu số (DSP) từ các thương hiệu âm thanh danh tiếng.</li>
                    <li style="margin-bottom: 8px;"><strong>Cách âm – Chống ồn toàn diện:</strong> Thi công vật liệu cách âm tiêu âm cao cấp tại các vị trí trọng yếu (4 cánh cửa, sàn xe, hốc bánh, trần xe), giúp triệt tiêu tạp âm từ lốp và môi trường.</li>
                </ul>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">3. Lên Đời Bodykit và Cá Nhân Hóa Ngoại Thất</h4>
                <ul style="padding-left: 20px; margin-bottom: 18px;">
                    <li style="margin-bottom: 8px;"><strong>Độ Bodykit thể thao &amp; Nâng đời xe:</strong> Lắp đặt các mẫu Bodykit chính hãng (nhựa PP/ABS cao cấp hoặc sợi Carbon) với độ khít tuyệt đối (Fitment chuẩn 100%).</li>
                    <li style="margin-bottom: 8px;"><strong>Nâng cấp chi tiết ngoại thất:</strong> Thay mặt ca-lăng thể thao, độ pô on/off, lắp đuôi gió (Spoiler), lip chia pô và bậc lên xuống cơ/điện.</li>
                </ul>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">4. Thay Mâm (Lazang) Thể Thao và Nâng Cấp Hiệu Năng</h4>
                <ul style="padding-left: 20px; margin-bottom: 18px;">
                    <li style="margin-bottom: 8px;"><strong>Đa dạng mẫu mã mâm xe:</strong> Cung cấp các dòng mâm đúc hợp kim (Cast) và mâm nén nguyên khối (Forged) siêu nhẹ, siêu bền, phù hợp đúng thông số kỹ thuật của từng dòng xe.</li>
                    <li style="margin-bottom: 8px;"><strong>Căn chỉnh bằng công nghệ cao:</strong> Quá trình vào lốp, lắp cảm biến áp suất lốp và cân bằng động bằng máy laser được thực hiện tỉ mỉ, đảm bảo xe vận hành êm ái ở dải tốc độ cao.</li>
                </ul>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">5. Lắp Đặt Camera Hành Trình &amp; Phụ Kiện Thông Minh</h4>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 8px;"><strong>Camera hành trình chính hãng:</strong> Ghi hình sắc nét chuẩn 2K/4K cả ngày lẫn đêm, tích hợp GPS cảnh báo tốc độ, cảnh báo biển báo giao thông và kết nối xem video trực tiếp trên điện thoại.</li>
                    <li style="margin-bottom: 8px;"><strong>Hệ thống Camera 360 độ siêu nét:</strong> Xóa tan mọi điểm mù quanh xe, hiển thị mô phỏng 3D trực quan giúp việc lùi đỗ hoặc di chuyển trong các ngõ hẹp trở nên dễ dàng hơn bao giờ hết.</li>
                    <li style="margin-bottom: 8px;"><strong>Phụ kiện tiện ích cao cấp:</strong> Nâng cấp màn hình giải trí Android thông minh, Android Box giữ màn zin, cảm biến áp suất lốp (TPMS), cửa hít tự động, cốp điện đá cốp thông minh và bọc ghế da cao cấp.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Nguyên Tắc “Vàng” Khi Nâng Cấp Xe Tại Ôtô Hải Hà
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Giữ zin hệ thống điện 100% (Plug &amp; Play):</strong> Tuyệt đối không cắt trích dây điện nguyên bản của xe. Mọi thiết bị nâng cấp đều sử dụng giắc cắm zin theo xe và đi dây gọn gàng trong ống gen chống cháy.</li>
                    <li style="margin-bottom: 10px;"><strong>Tư vấn giải pháp an toàn &amp; Chuẩn quy định:</strong> Tư vấn trung thực các hạng mục nâng cấp phù hợp với quy chuẩn kỹ thuật hiện hành, giúp chủ xe vừa làm đẹp xế cưng, vừa an tâm lưu thông và đăng kiểm.</li>
                    <li style="margin-bottom: 10px;"><strong>Sản phẩm chính hãng – Bảo hành dài hạn:</strong> 100% thiết bị đèn, âm thanh, camera, mâm xe và phụ kiện đều có nguồn gốc xuất xứ rõ ràng từ các thương hiệu lớn.</li>
                    <li style="margin-bottom: 10px;"><strong>Đội ngũ kỹ thuật viên tay nghề cao:</strong> Am hiểu sâu sắc sơ đồ mạch điện và kết cấu ngàm khóa của các dòng xe, tháo lắp chuẩn xác.</li>
                </ul>
            ' . $footer_box
        ),

        'cham-soc-o-to' => array(
            'title'    => 'Nâng Tầm Đẳng Cấp Xế Cưng Với Dịch Vụ Chăm Sóc Xe (Detailing) Toàn Diện',
            'badge'    => 'AUTO DETAILING CHUẨN QUỐC TẾ',
            'img'      => $gallery_img . '/haiha-gallery-5.jpg',
            'duration' => '60 - 240 phút',
            'warranty' => 'Bảo hành lớp phủ & phim chính hãng',
            'price'    => 'Đa dạng gói chăm sóc từ cơ bản đến chuyên sâu',
            'html'     => '
                <p>Một chiếc ô tô hoàn hảo không chỉ cần khối động cơ mạnh mẽ mà còn phải sở hữu một diện mạo bóng bẩy và không gian nội thất tinh tế. Khói bụi đô thị, tia UV gay gắt hay những cơn mưa bất chợt đều là những tác nhân làm phai mờ đi vẻ đẹp nguyên bản của chiếc xe.</p>
                <p>Tại <strong>Ôtô Hải Hà</strong>, chúng tôi không chỉ sửa chữa, bảo dưỡng mà còn mang đến một hệ sinh thái Chăm sóc xe (Auto Detailing) chuyên nghiệp. Từ làm sạch chuyên sâu, bảo dưỡng bề mặt đến cá nhân hóa ngoại thất, mọi dịch vụ đều được thực hiện bởi đội ngũ kỹ thuật viên đam mê sự hoàn hảo, kết hợp cùng sản phẩm thương hiệu cao cấp nhất.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Chi Tiết Các Hạng Mục Chăm Sóc Xe Tại Ôtô Hải Hà
                </h3>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">1. Rửa Xe và Chăm Sóc Nội Ngoại Thất Chuyên Sâu</h4>
                <p>Vượt xa những phương pháp rửa xe truyền thống, quy trình rửa xe tại <strong>Ôtô Hải Hà</strong> tuân thủ chuẩn Detailing quốc tế, sử dụng kỹ thuật rửa nhiều xô và bọt tuyết trung tính để tuyệt đối không làm xước xoáy màng sơn. Chúng tôi làm sạch chi tiết từ bề mặt sơn, hốc bánh, lồng vè cho đến việc tẩy ố logo, ca-lăng và dưỡng đen lốp xe chống lão hóa cao su.</p>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">2. Vệ Sinh và Dưỡng Nội Thất Ô Tô</h4>
                <p>Không gian nội thất là nơi bạn gắn bó trong suốt hành trình. Bụi bẩn, mồ hôi và thức ăn rơi vãi lâu ngày sẽ sinh ra nấm mốc và mùi hôi khó chịu. Dịch vụ vệ sinh nội thất của chúng tôi bao gồm:</p>
                <ul style="padding-left: 20px; margin-bottom: 18px;">
                    <li style="margin-bottom: 8px;">Hút bụi toàn diện mọi khe kẽ, gầm ghế.</li>
                    <li style="margin-bottom: 8px;">Sử dụng dung dịch chuyên dụng làm sạch và dưỡng mềm các chi tiết ghế da, taplo, tapi cửa, trần xe.</li>
                    <li style="margin-bottom: 8px;">Khử mùi, diệt khuẩn dàn lạnh và khoang cabin bằng công nghệ xông tinh dầu/Ozone, mang lại bầu không khí trong lành, bảo vệ sức khỏe hô hấp cho gia đình.</li>
                </ul>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">3. Dán Phim Cách Nhiệt Chính Hãng</h4>
                <p>Bảo vệ bạn và xế cưng khỏi sức nóng và tia cực tím (UV) độc hại. <strong>Ôtô Hải Hà</strong> cung cấp và thi công các dòng phim cách nhiệt cao cấp hàng đầu thị trường với lợi ích vượt trội: Chống nóng hiệu quả, giảm tải cho hệ thống điều hòa, bảo vệ nội thất không bị nứt nẻ, phai màu. Đồng thời, phim cách nhiệt còn chống chói lóa khi đi đêm và đảm bảo sự riêng tư tuyệt đối cho người ngồi trong xe.</p>

                <h4 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 20px 0 10px;">4. Dán Decal Đổi Màu, Đánh Bóng Phủ Ceramic và Wrap PPF Bảo Vệ Bề Mặt</h4>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 8px;"><strong>Đánh bóng &amp; Phủ Ceramic:</strong> Hiệu chỉnh bề mặt sơn xóa xước xoáy, tạo hiệu ứng lá sen chống bám nước và giữ độ bóng sâu bền bỉ.</li>
                    <li style="margin-bottom: 8px;"><strong>Wrap đổi màu toàn xe:</strong> Bảng màu đa dạng (từ Matte, Satin, Glossy đến Metallic) giúp chiếc xe lột xác nhanh chóng, thi công tỉ mỉ gập mí giấu viền chuyên nghiệp.</li>
                    <li style="margin-bottom: 8px;"><strong>Dán màng bảo vệ PPF (Paint Protection Film):</strong> Lớp “áo giáp” vô hình, tự phục hồi vết xước dăm, bảo vệ màng sơn khỏi đá văng và hóa chất bào mòn.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Sự Khác Biệt Của Dịch Vụ Detailing Tại Ôtô Hải Hà
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Sử dụng hóa chất an toàn:</strong> 100% dung dịch làm sạch, dưỡng da, bóng lốp đều được nhập khẩu từ các thương hiệu Detailing danh tiếng, đảm bảo an toàn tuyệt đối cho vật liệu xe và sức khỏe con người.</li>
                    <li style="margin-bottom: 10px;"><strong>Trang thiết bị chuyên nghiệp:</strong> Hệ thống máy phun áp lực cao, súng lốc xoáy (Tornador), máy đánh bóng lệch tâm (Dual Action) giúp xử lý bề mặt tối ưu mà không để lại quầng xước.</li>
                    <li style="margin-bottom: 10px;"><strong>Kỹ thuật viên tỉ mỉ:</strong> Đội ngũ kỹ thuật viên được đào tạo bài bản, chăm chút từng tiểu tiết nhỏ nhất như khe cửa gió điều hòa hay đường chỉ may trên ghế da.</li>
                    <li style="margin-bottom: 10px;"><strong>Không gian phòng chờ tiện nghi:</strong> Trong lúc chờ xế cưng được “spa”, quý khách có thể thư giãn, thưởng thức trà/cafe tại phòng chờ với đầy đủ tiện nghi.</li>
                </ul>
            ' . $footer_box
        ),

        'cuu-ho-o-to' => array(
            'title'    => 'Dịch Vụ Cứu Hộ Ô Tô 24/7 & Hỗ Trợ Chủ Xe Khẩn Cấp Trên Mọi Hành Trình',
            'badge'    => 'CỨU HỘ GIAO THÔNG 24/7',
            'img'      => $gallery_img . '/haiha-gallery-3.jpg',
            'duration' => 'Có mặt sau 15 - 30 phút',
            'warranty' => 'Đảm bảo an toàn tuyệt đối khi cẩu kéo',
            'price'    => 'Hỗ trợ ưu đãi chi phí kéo xe về xưởng',
            'html'     => '
                <p>Sự cố chết máy giữa đêm khuya, nổ lốp trên cao tốc hay xe bị ngập nước (thủy kích) trong mùa mưa luôn là nỗi ám ảnh của mọi tài xế. Hãy lưu ngay số Hotline <strong>0911 211 996</strong> của <strong>Ôtô Hải Hà</strong> để luôn có một đội ngũ chuyên gia sẵn sàng ứng cứu 24/7 trên mọi cung đường.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Chi Tiết Dịch Vụ Cứu Hộ Ô Tô 24/7 &amp; Kéo Xe Về Xưởng Tại Ôtô Hải Hà
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Hỗ trợ cứu hộ kéo xe chuyên nghiệp:</strong> Đội xe cứu hộ sàn trượt, cẩu kéo chuyên dụng túc trực 24/7 đưa xe của bạn về xưởng <strong>Ôtô Hải Hà</strong> an toàn với chính sách hỗ trợ chi phí tối đa cho khách hàng sửa chữa tại xưởng.</li>
                    <li style="margin-bottom: 12px;"><strong>Ứng cứu nhanh chóng tại hiện trường:</strong> Hỗ trợ kích bình ắc quy lưu động, thay lốp dự phòng hoặc xử lý nhanh các lỗi kỹ thuật cơ bản để bạn có thể tiếp tục hành trình ngay lập tức.</li>
                    <li style="margin-bottom: 12px;"><strong>Xử lý xe ngập nước (thủy kích) chuyên nghiệp:</strong> Quy trình cẩu kéo an toàn tuyệt đối cho hệ dẫn động và hộp số, kết hợp ưu tiên tháo rã, sấy khô và kiểm tra khẩn cấp ngay khi xe vừa về đến garage để ngăn chặn nguy cơ hư hỏng nặng.</li>
                    <li style="margin-bottom: 12px;"><strong>Tư vấn và hỗ trợ bảo hiểm tai nạn:</strong> Hướng dẫn giữ hiện trường, chụp ảnh giám định và hỗ trợ toàn bộ thủ tục bồi thường bảo hiểm thân vỏ ngay khi xe được đưa về xưởng.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Tại Sao Chủ Xe Luôn Đặt Trọn Niềm Tin Vào Ôtô Hải Hà?
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Phản ứng thần tốc 24/7:</strong> Đội ngũ cứu hộ và kỹ thuật viên luôn túc trực ngày đêm kể cả ngày Lễ, Tết.</li>
                    <li style="margin-bottom: 10px;"><strong>Bảo vệ quyền lợi khách hàng tối đa:</strong> Luôn đề xuất phương án khắc phục tối ưu, tiết kiệm nhất và hỗ trợ làm việc với các đơn vị bảo hiểm.</li>
                    <li style="margin-bottom: 10px;"><strong>Chi phí minh bạch – Không phụ phí ẩn:</strong> Báo giá rõ ràng trước khi thực hiện.</li>
                    <li style="margin-bottom: 10px;"><strong>An toàn tài sản tuyệt đối:</strong> Quá trình nhận xe cứu hộ đều có biên bản bàn giao ghi nhận tình trạng xe, số ODO và tư trang minh bạch.</li>
                </ul>
            ' . $footer_box
        ),

        'dang-kiem-o-to' => array(
            'title'    => 'Kiểm Tra Kỹ Thuật và Hỗ Trợ Đăng Kiểm Ô Tô Nhanh Gọn Tại Ôtô Hải Hà',
            'badge'    => 'HỖ TRỢ ĐĂNG KIỂM TRỌN GÓI',
            'img'      => $gallery_img . '/haiha-gallery-9.jpg',
            'duration' => 'Hoàn tất nhanh gọn trong ngày',
            'warranty' => 'Cam kết đạt chuẩn an toàn kỹ thuật',
            'price'    => 'Kiểm tra tiền đăng kiểm & Hỗ trợ trọn gói',
            'html'     => '
                <p>Quy định đăng kiểm ngày càng khắt khe khiến nhiều chiếc xe bị “trượt” đăng kiểm và phải đi lại nhiều lần chỉ vì những lỗi nhỏ ở hệ thống phanh, khí thải hay đèn chiếu sáng. Thấu hiểu giá trị thời gian của các chủ xe bận rộn, <strong>Ôtô Hải Hà</strong> cung cấp giải pháp kiểm tra kỹ thuật và hỗ trợ đăng kiểm ô tô trọn gói nhanh chóng, thuận lợi.</p>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Chi Tiết Dịch Vụ Kiểm Tra Kỹ Thuật &amp; Hỗ Trợ Đăng Kiểm Tại Ôtô Hải Hà
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 12px;"><strong>Rà soát “Tiền đăng kiểm” chuẩn xác:</strong> Kỹ thuật viên sẽ kiểm tra toàn diện các hạng mục nằm trong danh mục sát hạch của Cục Đăng Kiểm: đo và căn chỉnh lại tâm đèn pha/cos, kiểm tra lực phanh, độ chụm bánh xe (thước lái), độ mòn lốp, vệ sinh hệ thống khí thải và xóa các lỗi cảnh báo trên màn hình taplo.</li>
                    <li style="margin-bottom: 12px;"><strong>Tư vấn hoàn thiện cấu hình hợp quy:</strong> Hỗ trợ kiểm tra và tư vấn phương án điều chỉnh phù hợp đối với các xe đã từng nâng cấp phụ kiện, đảm bảo xe đáp ứng đúng tiêu chuẩn an toàn kỹ thuật hiện hành.</li>
                    <li style="margin-bottom: 12px;"><strong>Dịch vụ hỗ trợ đăng kiểm trọn gói (Tiết kiệm thời gian):</strong> Dành cho những chủ xe bận rộn. Bạn chỉ cần giao xe cho đội ngũ <strong>Ôtô Hải Hà</strong>, nhân sự của chúng tôi sẽ hỗ trợ thực hiện toàn bộ quy trình kiểm tra, chuẩn bị hồ sơ và bàn giao lại xe cùng tem đăng kiểm mới ngay trong ngày.</li>
                    <li style="margin-bottom: 12px;"><strong>Dịch vụ Giao Nhận Xe Tận Nơi (Door-to-Door Service):</strong> Nhận xe tận nhà hoặc văn phòng, đưa về xưởng kiểm tra bảo dưỡng tiền đăng kiểm (cập nhật tiến độ liên tục qua Zalo) và bàn giao lại chiếc xe đúng giờ hẹn.</li>
                </ul>

                <h3 style="font-family: \'Chakra Petch\', sans-serif; font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 28px 0 14px; text-transform: uppercase;">
                    <span style="color: #ff4d24;">|</span> Tại Sao Chủ Xe Luôn Đặt Trọn Niềm Tin Vào Ôtô Hải Hà?
                </h3>
                <ul style="padding-left: 20px; margin-bottom: 24px;">
                    <li style="margin-bottom: 10px;"><strong>Trang thiết bị đo kiểm chuẩn xác:</strong> Đầy đủ máy chẩn đoán ECU, thiết bị căn chỉnh góc đặt bánh xe, thiết bị kiểm tra phanh và đèn chiếu sáng trước khi đưa xe đi đăng kiểm.</li>
                    <li style="margin-bottom: 10px;"><strong>Tiết kiệm tối đa thời gian &amp; công sức:</strong> Loại bỏ hoàn toàn rủi ro phải quay đầu sửa lại nhiều lần vì những lỗi kỹ thuật nhỏ.</li>
                    <li style="margin-bottom: 10px;"><strong>Chi phí minh bạch – Không phụ phí ẩn:</strong> Mọi khoản phí dịch vụ hay lệ phí nhà nước (như phí đăng kiểm, phí đường bộ) đều có hóa đơn, chứng từ rõ ràng.</li>
                    <li style="margin-bottom: 10px;"><strong>An toàn tài sản tuyệt đối:</strong> Quá trình nhận xe đi đăng kiểm hay giao nhận xe tận nơi đều có biên bản bàn giao ghi nhận tình trạng xe, số ODO và tư trang minh bạch.</li>
                </ul>
            ' . $footer_box
        ),
    );

    return isset($data[$key]) ? $data[$key] : $data['bao-duong-o-to'];
}

