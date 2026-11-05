<?php
/**
 * Template Name: Đăng Ký Lái Thử (Lexus Test Drive Page)
 *
 * @package Lexus_Motors
 */

get_header();
?>

<main id="primary" class="site-main" style="padding-top: 120px; min-height: 85vh;">
    <div class="container">
        
        <header class="section-header" style="margin-bottom: 40px;">
            <span class="subtitle-gold"><?php _e('TRẢI NGHIỆM ĐỈNH CAO', 'lexus-motors'); ?></span>
            <h1 class="title-luxury" style="font-size: 2.75rem; margin-bottom: 16px;">
                <?php _e('ĐĂNG KÝ LÁI THỬ XE LEXUS', 'lexus-motors'); ?>
            </h1>
            <p class="section-desc">
                <?php _e('Cảm nhận sự êm ái tuyệt đối, sự phản hồi chính xác của tay lái và không gian nội thất sang trọng chuẩn mực Nhật Bản.', 'lexus-motors'); ?>
            </p>
        </header>

        <div class="test-drive-form-wrap" style="margin-bottom: 80px;">
            <form class="lexus-ajax-form">
                <div class="form-field">
                    <label><?php _e('Họ và tên của Quý khách (*)', 'lexus-motors'); ?></label>
                    <input type="text" name="customer_name" class="form-control" required placeholder="VD: Nguyễn Thành Trung">
                </div>

                <div class="form-grid-2">
                    <div class="form-field">
                        <label><?php _e('Số điện thoại liên hệ (*)', 'lexus-motors'); ?></label>
                        <input type="tel" name="customer_phone" class="form-control" required placeholder="09xx xxx xxx">
                    </div>
                    <div class="form-field">
                        <label><?php _e('Địa chỉ Email', 'lexus-motors'); ?></label>
                        <input type="email" name="customer_email" class="form-control" placeholder="trung@example.com">
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-field">
                        <label><?php _e('Mẫu xe Quý khách muốn trải nghiệm (*)', 'lexus-motors'); ?></label>
                        <select name="car_model" class="form-control">
                            <option value="Lexus RX 350 Luxury" selected>Lexus RX 350 Luxury</option>
                            <option value="Lexus LX 600 VIP">Lexus LX 600 VIP</option>
                            <option value="Lexus ES 250 F SPORT">Lexus ES 250 F SPORT</option>
                            <option value="Lexus NX 350h Hybrid">Lexus NX 350h Hybrid</option>
                            <option value="Lexus LS 500h Flagship">Lexus LS 500h Flagship</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label><?php _e('Đại lý tiếp đón / Hình thức trải nghiệm (*)', 'lexus-motors'); ?></label>
                        <select name="dealer_city" class="form-control">
                            <option value="Lexus Thăng Long (Hà Nội)">Lexus Thăng Long (Hà Nội)</option>
                            <option value="Lexus Trung Tâm Sài Gòn (TP.HCM)">Lexus Trung Tâm Sài Gòn (TP.HCM)</option>
                            <option value="Lái thử tại tư gia của Quý khách">Lái thử tận nơi tại tư gia / Cơ quan</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-field">
                        <label><?php _e('Ngày dự kiến lái thử', 'lexus-motors'); ?></label>
                        <input type="date" name="preferred_date" class="form-control">
                    </div>

                    <div class="form-field">
                        <label><?php _e('Khung giờ thuận tiện', 'lexus-motors'); ?></label>
                        <select name="preferred_time" class="form-control">
                            <option value="Sáng (08:30 - 11:30)">Buổi sáng (08:30 - 11:30)</option>
                            <option value="Chiều (13:30 - 17:00)">Buổi chiều (13:30 - 17:00)</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label><?php _e('Yêu cầu đặc biệt khác', 'lexus-motors'); ?></label>
                    <textarea name="customer_note" rows="3" class="form-control" placeholder="VD: Muốn so sánh giữa RX 350 và RX 500h..."></textarea>
                </div>

                <button type="submit" class="btn-lexus btn-lexus-gold" style="width: 100%; padding: 18px; font-size: 0.9375rem;">
                    <?php _e('GỬI YÊU CẦU ĐẶT LỊCH LÁI THỬ', 'lexus-motors'); ?>
                </button>
                <div class="form-response-msg" style="display:none;"></div>
            </form>
        </div>

    </div>
</main>

<?php
get_footer();

