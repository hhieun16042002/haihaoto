<?php
namespace GarageOS\Frontend;

if (!defined('ABSPATH')) {
    exit;
}

class Shortcodes {

    public static function init() {
        add_shortcode('garage_warranty_lookup', [__CLASS__, 'render_warranty_lookup']);
        add_shortcode('garage_booking_form', [__CLASS__, 'render_booking_form']);
    }

    public static function render_warranty_lookup($atts = []) {
        ob_start();
        ?>
        <div class="garage-lookup-container" id="garage-lookup-app">
            <div class="lookup-search-card">
                <div class="lookup-badge">
                    <span class="lookup-badge-dot"></span>
                    <span>CỔNG BẢO HÀNH ĐIỆN TỬ HẢI HÀ ÔTÔ</span>
                </div>
                
                <h2 class="lookup-title">
                    Tra Cứu Lịch Sử Sửa Chữa & <span>Bảo Hành Điện Tử</span>
                </h2>
                <p class="lookup-sub">
                    Nhập chính xác biển số xe của quý khách để kiểm tra hồ sơ kỹ thuật, danh mục phụ tùng thay thế và thời hạn chứng thư bảo hành chính hãng.
                </p>

                <form id="garage-lookup-form" class="lookup-input-form">
                    <div class="modern-plate-search-bar">
                        <div class="plate-search-icon">
                            <i class="fa fa-id-card"></i>
                        </div>

                        <input type="text" id="lookup-plate-input" name="license_plate" placeholder="NHẬP BIỂN SỐ XE (VD: 30H-888.88 HOẶC 51K-999.99)" autocomplete="off" required>

                        <button type="submit" class="btn-plate-search" id="lookup-btn">
                            <i class="fa fa-magnifying-glass"></i>
                            <span class="btn-text">Tra Cứu Ngay</span>
                        </button>
                    </div>
                </form>

                <div class="lookup-searching-indicator" id="laser-scanner" style="display:none;">
                    <div class="spinner-circle"></div>
                    <span>Đang kết nối hệ thống dữ liệu bảo hành toàn quốc...</span>
                </div>

                <div class="quick-sample-plates">
                    <span class="sample-tag-label"><i class="fa fa-car-side"></i> Biển số xe mẫu:</span>
                    <button type="button" class="btn-sample-plate" data-plate="30H-888.88">
                        <span class="badge-num">30H-888.88</span>
                        <span>Mazda CX-5 (Đã hoàn tất)</span>
                    </button>
                    <button type="button" class="btn-sample-plate" data-plate="51K-999.99">
                        <span class="badge-num">51K-999.99</span>
                        <span>Fortuner Legender (Đang làm)</span>
                    </button>
                    <button type="button" class="btn-sample-plate" data-plate="30F-123.45">
                        <span class="badge-num">30F-123.45</span>
                        <span>SantaFe (Kiểm định KCS)</span>
                    </button>
                </div>
            </div>

            <!-- Result Feedback Box -->
            <div id="lookup-result-area" style="display:none;"></div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function render_booking_form($atts = []) {
        ob_start();
        ?>
        <div class="garage-booking-widget">
            <form id="garage-embedded-booking-form" class="gos-booking-form">
                <div class="form-row-2">
                    <div class="form-group">
                        <label>Họ và Tên chủ xe *</label>
                        <input type="text" name="name" placeholder="Nguyễn Văn A" required>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại liên hệ *</label>
                        <input type="tel" name="phone" placeholder="0912 345 678" required>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Biển số xe *</label>
                        <input type="text" name="plate" placeholder="30H-888.88" style="text-transform:uppercase;font-weight:700;" required>
                    </div>
                    <div class="form-group">
                        <label>Dòng xe / Đời xe</label>
                        <input type="text" name="model" placeholder="Mazda CX-5, Camry, Ranger...">
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Dịch vụ cần thực hiện</label>
                        <select name="service">
                            <option value="Sơn sấy hấp công nghệ cao">Sơn sấy hấp công nghệ cao (Đồng sơn nhanh)</option>
                            <option value="Bảo dưỡng định kỳ các cấp">Bảo dưỡng định kỳ các cấp</option>
                            <option value="Sửa chữa máy - gầm - truyền động">Sửa chữa máy - gầm - hộp số</option>
                            <option value="Điện - Điều hòa ô tô chuyên sâu">Điện & Bảo dưỡng điều hòa nội soi</option>
                            <option value="Detailing & Dán phim cách nhiệt">Detailing & Phủ Ceramic / Dán phim</option>
                            <option value="Khám xe & Cứu hộ bảo hiểm">Khám xe & Cứu hộ 24/7</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chi nhánh gần bạn</label>
                        <select name="branch">
                            <option value="Chi nhánh Cầu Giấy - Hà Nội">Xưởng Cầu Giấy - 500 Cầu Giấy, HN</option>
                            <option value="Chi nhánh Tây Hồ - Hà Nội">Xưởng Tây Hồ - 685 Lạc Long Quân, HN</option>
                            <option value="Chi nhánh Long Biên - Hà Nội">Xưởng Long Biên - 390 Nguyễn Văn Cừ, HN</option>
                            <option value="Chi nhánh Tân Bình - TP.HCM">Xưởng Tân Bình - 22 Cộng Hòa, TP.HCM</option>
                        </select>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label>Ngày hẹn đưa xe đến</label>
                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Giờ hẹn</label>
                        <select name="time">
                            <option value="08:00">08:00 Sáng</option>
                            <option value="08:30" selected>08:30 Sáng</option>
                            <option value="09:30">09:30 Sáng</option>
                            <option value="11:00">11:00 Trưa</option>
                            <option value="14:00">14:00 Chiều</option>
                            <option value="15:30">15:30 Chiều</option>
                            <option value="16:30">16:30 Chiều</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:18px;">
                    <label>Yêu cầu hoặc ghi chú thêm</label>
                    <textarea name="notes" rows="2" placeholder="Tình trạng xe hiện tại, âm thanh lạ, va quẹt..."></textarea>
                </div>

                <button type="submit" class="btn-gos-submit-booking">
                    <span>Xác Nhận Đặt Lịch Ngay</span>
                </button>
                <div class="booking-feedback-msg" style="display:none;margin-top:12px;"></div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}
