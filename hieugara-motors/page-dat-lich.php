<?php
/**
 * Template Name: Đặt Lịch Hẹn (Hiếu Gara Booking Page)
 *
 * @package HieuGara_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 60px 0 90px; background: var(--bg-slate);">
    <div class="container">
        
        <div class="booking-box" style="margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 30px;">
                <span class="section-tag"><?php _e('TIẾP NHẬN CHU ĐÁO', 'hieugara-motors'); ?></span>
                <h1 class="section-title" style="font-size: 2.25rem; margin-bottom: 12px;"><?php _e('ĐẶT HẸN SỬA CHỮA & BẢO DƯỠNG XE', 'hieugara-motors'); ?></h1>
                <p style="color: var(--text-secondary); font-size: 1rem;">
                    <?php _e('Đặt hẹn trước giúp xưởng chuẩn bị trước khoang sửa chữa và kỹ thuật viên đón tiếp, giúp tiết kiệm tối đa thời gian của Quý khách.', 'hieugara-motors'); ?>
                </p>
            </div>

            <form class="hieugara-ajax-form">
                <div class="form-group">
                    <label><?php _e('Họ và tên Quý khách (*)', 'hieugara-motors'); ?></label>
                    <input type="text" name="customer_name" class="form-input" required placeholder="VD: Anh Hoàng, Chị Mai...">
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label><?php _e('Số điện thoại liên hệ (*)', 'hieugara-motors'); ?></label>
                        <input type="tel" name="customer_phone" class="form-input" required placeholder="09xx xxx xxx">
                    </div>
                    <div class="form-group">
                        <label><?php _e('Dòng xe & Đời xe', 'hieugara-motors'); ?></label>
                        <input type="text" name="car_model" class="form-input" placeholder="VD: Honda City 2022, Hyundai Tucson 2020...">
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label><?php _e('Dịch vụ cần thực hiện', 'hieugara-motors'); ?></label>
                        <select name="service_type" class="form-select">
                            <option value="Đồng sơn ô tô công nghệ cao">Đồng sơn ô tô công nghệ cao</option>
                            <option value="Bảo dưỡng định kỳ 30 hạng mục">Bảo dưỡng định kỳ 30 hạng mục</option>
                            <option value="Sửa chữa máy gầm chuyên sâu">Sửa chữa máy gầm chuyên sâu</option>
                            <option value="Sửa chữa điện - điều hòa mát sâu">Sửa chữa điện - điều hòa mát sâu</option>
                            <option value="Chăm sóc xe Detailing - Phủ Ceramic">Chăm sóc xe Detailing - Phủ Ceramic</option>
                            <option value="Hỗ trợ thủ tục bồi thường bảo hiểm">Hỗ trợ thủ tục bồi thường bảo hiểm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('Cơ sở xưởng tiếp đón', 'hieugara-motors'); ?></label>
                        <select name="branch_location" class="form-select">
                            <option value="Cơ sở 1 - Cầu Giấy (500 Cầu Giấy)">Cơ sở 1 - Cầu Giấy (500 Cầu Giấy)</option>
                            <option value="Cơ sở 2 - Tây Hồ (685 Lạc Long Quân)">Cơ sở 2 - Tây Hồ (685 Lạc Long Quân)</option>
                            <option value="Cơ sở 3 - Long Biên (390 Nguyễn Văn Cừ)">Cơ sở 3 - Long Biên (390 Nguyễn Văn Cừ)</option>
                            <option value="Cơ sở 4 - Hoàng Mai (820 Giải Phóng)">Cơ sở 4 - Hoàng Mai (820 Giải Phóng)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label><?php _e('Ngày dự kiến mang xe tới', 'hieugara-motors'); ?></label>
                    <input type="date" name="booking_date" class="form-input">
                </div>

                <div class="form-group">
                    <label><?php _e('Mô tả hiện tượng hỏng hóc hoặc yêu cầu thêm', 'hieugara-motors'); ?></label>
                    <textarea name="customer_note" rows="3" class="form-textarea" placeholder="VD: Xe bị xước cản trước và tai vè bên phụ..."></textarea>
                </div>

                <button type="submit" class="btn-gara btn-gara-red" style="width: 100%; padding: 16px; font-size: 1rem;">
                    <i class="fa fa-calendar-check"></i> <?php _e('XÁC NHẬN ĐẶT LỊCH TIẾP NHẬN XE', 'hieugara-motors'); ?>
                </button>
                <div class="form-response-msg" style="display:none;"></div>
            </form>
        </div>

    </div>
</main>

<?php
get_footer();

