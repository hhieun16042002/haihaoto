<?php
/**
 * Template Name: Chính Sách Bảo Mật & Pháp Lý
 * Description: Tuân thủ Luật Bảo vệ dữ liệu cá nhân 91/2025/QH15, Luật Thương mại điện tử 122/2025/QH15, Luật BVQLNTD 19/2023/QH15
 *
 * @package HieuGara_Motors
 */

get_header();

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$hotline_phone = get_option('hieugara_hotline_phone', '02203 892 207');
?>

<main id="primary" class="site-main" style="background: #F8FAFC; padding: 45px 0 85px;">
    <div class="container" style="max-width: 1080px; margin: 0 auto; padding: 0 20px;">

        <!-- Breadcrumb -->
        <nav style="display: flex; gap: 8px; align-items: center; font-size: 0.85rem; color: #64748b; margin-bottom: 24px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #64748b; text-decoration: none;"><i class="fa fa-home"></i> Trang chủ</a>
            <span>/</span>
            <span style="color: #0f172a; font-weight: 700;">Chính sách bảo mật &amp; Pháp lý</span>
        </nav>

        <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 40px 48px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); line-height: 1.8; color: #334155;">
            
            <header style="border-bottom: 2px solid #C5A880; padding-bottom: 20px; margin-bottom: 30px;">
                <span style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 0.78rem; font-weight: 800; color: #C5A880; text-transform: uppercase; letter-spacing: 1.5px;">CÔNG BỐ PHÁP LÝ &amp; CHÍNH SÁCH BẢO VỆ DỮ LIỆU</span>
                <h1 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 2rem; font-weight: 800; color: #0f172a; margin: 8px 0 0;">
                    Chính Sách Bảo Mật, Bảo Vệ Dữ Liệu Cá Nhân &amp; Điều Khoản Dịch Vụ
                </h1>
                <p style="font-size: 0.88rem; color: #64748b; margin-top: 8px;">Áp dụng cho mọi hoạt động tư vấn, sửa chữa và cung ứng dịch vụ tại website Ô Tô Hải Hà</p>
            </header>

            <!-- Section 1: Thông tin pháp nhân -->
            <section style="margin-bottom: 36px;">
                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 14px;">
                    1. Thông Tin Đơn Vị Chủ Quản Website (Theo Luật TMĐT 122/2025/QH15)
                </h2>
                <ul style="padding-left: 20px; margin-bottom: 16px;">
                    <li><strong>Đơn vị sở hữu &amp; quản lý:</strong> HTX CƠ KHÍ HẢI HÀ (Gara Ô Tô Hải Hà - Thành lập từ năm 1995).</li>
                    <li><strong>Mã số thuế (MST):</strong> 0800016457 do Chi cục Thuế Thành phố Hải Dương quản lý &amp; cấp phép.</li>
                    <li><strong>Người đại diện theo pháp luật:</strong> NGUYỄN THỊ THU HÀ &bull; Giới tính: Nữ &bull; Quốc tịch: Việt Nam.</li>
                    <li><strong>Địa chỉ trụ sở &amp; xưởng dịch vụ:</strong> Km3 + 500, Nguyễn Lương Bằng, Lê Thanh Nghị, Hải Phòng 170000, Việt Nam.</li>
                    <li><strong>Tổng đài hỗ trợ kỹ thuật:</strong> <a href="tel:02203892207" style="color: #8C6D46; font-weight: 700; text-decoration: none;">02203 892 207</a></li>
                    <li><strong>Hotline cứu hộ khẩn cấp 24/7:</strong> <a href="tel:0911211996" style="color: #D92D20; font-weight: 700; text-decoration: none;">0911 211 996</a></li>
                    <li><strong>Email tiếp nhận thông tin:</strong> thanhotohaiha@gmail.com</li>
                    <li><strong>Website chính thức:</strong> https://otohaiha.vn</li>
                </ul>
            </section>

            <!-- Section 2: Chính sách bảo vệ dữ liệu cá nhân -->
            <section style="margin-bottom: 36px;">
                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 14px;">
                    2. Chính Sách Bảo Vệ Dữ Liệu Cá Nhân (Tuân thủ Luật BVDLCN 91/2025/QH15 &amp; Nghị định 356/2025/NĐ-CP)
                </h2>
                <p>Ô Tô Hải Hà cam kết tôn trọng và bảo vệ tối đa quyền riêng tư của Quý khách hàng theo quy định của pháp luật Việt Nam:</p>
                
                <h3 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin: 16px 0 8px;">2.1. Mục đích thu thập dữ liệu</h3>
                <p>Chúng tôi chỉ thu thập dữ liệu cá nhân cho các mục đích hợp pháp sau:</p>
                <ul style="padding-left: 20px;">
                    <li>Liên hệ tư vấn kỹ thuật, khảo sát tình trạng xe và lập bảng báo giá chi tiết theo yêu cầu của Quý khách.</li>
                    <li>Lưu trữ hồ sơ lịch sử bảo dưỡng, sửa chữa (phiếu công tác RO) và tra cứu thời hạn bảo hành phụ tùng.</li>
                    <li>Điều động phương tiện cứu hộ giao thông 24/7 khi Quý khách yêu cầu hỗ trợ khẩn cấp.</li>
                </ul>

                <h3 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin: 16px 0 8px;">2.2. Loại dữ liệu thu thập</h3>
                <ul style="padding-left: 20px;">
                    <li><strong>Thông tin cơ bản:</strong> Họ và tên, số điện thoại liên hệ.</li>
                    <li><strong>Thông tin phương tiện:</strong> Dòng xe, đời xe, biển số xe (phục vụ đối soát phiếu sửa chữa và bảo hành).</li>
                </ul>

                <h3 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin: 16px 0 8px;">2.3. Thời gian lưu trữ dữ liệu</h3>
                <p>Dữ liệu được lưu trữ an toàn trên hệ thống máy chủ của Ô Tô Hải Hà trong suốt thời gian bảo hành phương tiện hoặc cho đến khi Quý khách có yêu cầu rút lại sự đồng ý và xoá dữ liệu.</p>

                <h3 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin: 16px 0 8px;">2.4. Quyền của Chủ thể dữ liệu (Điều 9 Luật BVDLCN 91/2025/QH15)</h3>
                <p>Quý khách có đầy đủ các quyền: Quyền được biết, quyền đồng ý, quyền truy cập và chỉnh sửa, quyền rút lại sự đồng ý, và quyền yêu cầu xoá dữ liệu cá nhân. Để thực hiện các quyền này, Quý khách chỉ cần liên hệ Hotline <strong>0911 211 996</strong> hoặc gửi yêu cầu tới email <strong>otohaiha1995@gmail.com</strong>.</p>

                <h3 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin: 16px 0 8px;">2.5. Tích hợp dịch vụ của bên thứ ba (Điều 18 Luật 91/2025/QH15)</h3>
                <p>Website có sử dụng bản đồ nhúng Google Maps để hỗ trợ chỉ đường đến xưởng. Khi Quý khách tương tác với bản đồ, dữ liệu địa chỉ IP kết nối mạng có thể được truyền tải tới máy chủ của Google theo chính sách bảo mật của Google.</p>
            </section>

            <!-- Section 3: Chính sách giá & VAT -->
            <section style="margin-bottom: 36px;">
                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 14px;">
                    3. Chính Sách Minh Bạch Giá Cả &amp; Thuế GTGT (VAT)
                </h2>
                <ul style="padding-left: 20px;">
                    <li>Mọi mức giá niêm yết trên website mang tính chất tham khảo tiêu chuẩn cho các dòng xe phổ thông, chưa bao gồm thuế giá trị gia tăng (GTGT/VAT) và vật tư phát sinh đặc thù theo từng dòng xe.</li>
                    <li>Quy trình bắt buộc tại Ô Tô Hải Hà: <strong>Khám xe miễn phí &rarr; Báo giá chi tiết đầy đủ (ghi rõ tiền công, phụ tùng, thuế VAT) &rarr; Khách hàng duyệt &amp; ký xác nhận mới tiến hành thi công</strong>.</li>
                    <li>Cam kết không tự ý phát sinh bất kỳ chi phí nào khi chưa có sự đồng ý của chủ xe.</li>
                </ul>
            </section>

            <!-- Section 4: Chính sách bảo hành & Đổi trả -->
            <section style="margin-bottom: 36px;">
                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 14px;">
                    4. Chính Sách Bảo Hành &amp; Cam Kết Chất Lượng Phụ Tùng
                </h2>
                <ul style="padding-left: 20px;">
                    <li><strong>Cam kết phụ tùng chính hãng:</strong> 100% phụ tùng, dầu nhớt và phụ kiện cung cấp tại xưởng đều có nguồn gốc rõ ràng, hoá đơn chứng từ đầy đủ. Hoàn tiền 100% nếu phát hiện hàng giả, hàng nhái kém chất lượng.</li>
                    <li><strong>Thời hạn bảo hành:</strong> Dịch vụ sửa chữa máy gầm bảo hành 06 - 12 tháng; đồng sơn sấy hấp bảo hành độ bóng và màu sơn từ 12 - 24 tháng; phụ kiện điện tử chính hãng bảo hành từ 12 - 36 tháng theo tiêu chuẩn nhà sản xuất.</li>
                </ul>
            </section>

            <!-- Section 5: Quy trình tiếp nhận giải quyết khiếu nại -->
            <section>
                <h2 style="font-family: 'Be Vietnam Pro', sans-serif; font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 14px;">
                    5. Quy Trình Tiếp Nhận &amp; Giải Quyết Khiếu Nại
                </h2>
                <p>Nếu Quý khách có bất kỳ điều gì chưa hài lòng về thái độ phục vụ hoặc chất lượng dịch vụ, xin vui lòng phản ánh trực tiếp với Ban Quản Lý Ô Tô Hải Hà:</p>
                <p style="background: #FFFBEB; border-left: 4px solid #F59E0B; padding: 14px 18px; border-radius: 4px; font-weight: 600; color: #92400E;">
                    Đường dây nóng phản ánh chất lượng &amp; khiếu nại dịch vụ: <strong>0911 211 996</strong> (Giám đốc kỹ thuật tiếp nhận trực tiếp 24/7). Chúng tôi cam kết phản hồi và xử lý thỏa đáng trong vòng 24 giờ làm việc.
                </p>
            </section>

        </article>
    </div>
</main>

<?php
get_footer();

