<?php
/**
 * Template Part: Smart Vehicle Diagnostics & Maintenance Checklist Tool
 * (Nhóm 1: Tra cứu hạng mục bảo dưỡng theo số Km & Bắt bệnh xe nhanh theo hiện tượng)
 * 
 * @package HieuGara_Motors
 */

$rescue_phone  = get_option('hieugara_rescue_phone', '0911 211 996');
$tech_phone    = get_option('hieugara_tech_phone', '0915 041 989');
$zalo_phone    = '0911211996';
?>

<section class="haiha-smart-tools-section" id="tien-ich-kiem-tra-xe" aria-label="Tiện ích tra cứu bảo dưỡng và bắt bệnh ô tô">
    <div class="smart-tools-container">
        <!-- Section Header -->
        <div class="smart-tools-header text-center">
            <span class="smart-tools-badge"><i class="fa-solid fa-microchip"></i> TIỆN ÍCH KỸ THUẬT Ô TÔ HẢI HÀ</span>
            <h2 class="smart-tools-heading">TRUNG TÂM TRA CỨU BẢO DƯỠNG &amp; BẮT BỆNH XE THÔNG MINH</h2>
            <p class="smart-tools-sub">Biết ngay các hạng mục phụ tùng cần làm theo từng mốc số Km hoặc chẩn đoán nguyên nhân triệu chứng xe đang gặp phải trước khi mang xe tới xưởng.</p>
        </div>

        <!-- Tool Nav Tabs -->
        <div class="smart-tools-nav-wrap">
            <div class="smart-tools-nav" role="tablist">
                <button type="button" class="smart-tool-tab active" data-tab="maintenance" role="tab" aria-selected="true" id="tab-btn-maint">
                    <span class="tab-icon">🛞</span>
                    <span class="tab-label">Tra Cứu Hạng Mục Bảo Dưỡng Theo Km</span>
                </button>
                <button type="button" class="smart-tool-tab" data-tab="symptoms" role="tab" aria-selected="false" id="tab-btn-symp">
                    <span class="tab-icon">🔍</span>
                    <span class="tab-label">Bắt Bệnh Xe Nhanh Theo Hiện Tượng</span>
                </button>
            </div>
        </div>

        <!-- =====================================================================
             TAB 1: BẢNG TRA CỨU BẢO DƯỠNG THEO SỐ KM
             ===================================================================== -->
        <div class="smart-tool-panel active" id="panel-maintenance" role="tabpanel" aria-labelledby="tab-btn-maint">
            <div class="maint-builder-card">
                <!-- Selectors Bar -->
                <div class="maint-selector-grid">
                    <!-- 1. Select Km -->
                    <div class="selector-group">
                        <label class="selector-title"><i class="fa-solid fa-gauge-high"></i> 1. Chọn cấp số Km hiện tại của xe:</label>
                        <div class="km-chips-row" id="kmChipsRow">
                            <button type="button" class="km-chip active" data-km="5000">5.000 km</button>
                            <button type="button" class="km-chip" data-km="10000">10.000 km</button>
                            <button type="button" class="km-chip" data-km="20000">20.000 km</button>
                            <button type="button" class="km-chip" data-km="40000">40.000 km (Cấp Lớn)</button>
                            <button type="button" class="km-chip" data-km="80000">80.000 km+ (Đại Tu)</button>
                        </div>
                    </div>

                    <!-- 2. Select Engine -->
                    <div class="selector-group">
                        <label class="selector-title"><i class="fa-solid fa-car-side"></i> 2. Chọn loại động cơ:</label>
                        <div class="engine-chips-row" id="engineChipsRow">
                            <button type="button" class="engine-chip active" data-engine="gasoline">⛽ Động Cơ Xăng</button>
                            <button type="button" class="engine-chip" data-engine="diesel">🛢️ Động Cơ Dầu (Diesel)</button>
                            <button type="button" class="engine-chip" data-engine="electric">⚡ Xe Điện VinFast</button>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Checklist Display -->
                <div class="maint-results-box" id="maintResultsBox">
                    <div class="maint-results-header">
                        <div class="maint-badge-lead">
                            <span class="lead-dot"></span>
                            <strong id="maintSelectedTitle">GÓI BẢO DƯỠNG CẤP 1 (5.000 KM) — ĐỘNG CƠ XĂNG</strong>
                        </div>
                        <span class="maint-quality-badge"><i class="fa-solid fa-circle-check"></i> Tiêu Chuẩn 45 Hạng Mục Kỹ Thuật Hải Hà</span>
                    </div>

                    <!-- Checklist Items List -->
                    <div class="maint-items-grid" id="maintItemsGrid">
                        <!-- Filled dynamically by JavaScript -->
                    </div>

                    <!-- VinFast Special Electric Notice (Shown when electric is active) -->
                    <div class="vf-electric-notice" id="vfElectricNotice" style="display: none;">
                        <i class="fa-solid fa-bolt-lightning"></i>
                        <span><strong>Đối tác chính thức của VinFast:</strong> Xưởng Hải Hà trang bị đầy đủ máy chẩn đoán pin chuyên dụng, thiết bị ngắt cao áp chuẩn Châu Âu và kỹ sư được cấp chứng chỉ xe điện.</span>
                    </div>

                    <!-- Action Bar -->
                    <div class="maint-actions-row">
                        <a href="https://zalo.me/<?php echo esc_attr($zalo_phone); ?>" target="_blank" rel="noopener" class="maint-cta-zalo" id="maintZaloBtn">
                            <svg width="22" height="22" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.779 43.5892C10.1019 43.846 13.0061 43.1836 15.0682 42.1825C24.0225 47.1318 38.0197 46.8954 46.4923 41.4732C46.8209 40.9803 47.1279 40.4677 47.4128 39.9363C49.1062 36.7779 50.0004 33.22 50.0004 27.1316V22.7175C50.0004 16.629 49.1062 13.0711 47.4128 9.91273C45.7385 6.75436 43.2461 4.28093 40.0877 2.58758C36.9293 0.894239 33.3714 0 27.283 0H22.8499C17.6644 0 14.2982 0.652754 11.4699 1.89893C11.3153 2.03737 11.1636 2.17818 11.0151 2.32135C2.71734 10.3203 2.08658 27.6593 9.12279 37.0782C9.13064 37.0921 9.13933 37.1061 9.14889 37.1203C10.2334 38.7185 9.18694 41.5154 7.55068 43.1516C7.28431 43.399 7.37944 43.5512 7.779 43.5892Z" fill="white"/>
                                <path d="M20.5632 17H10.8382V19.0853H17.5869L10.9329 27.3317C10.7244 27.635 10.5728 27.9194 10.5728 28.5639V29.0947H19.748C20.203 29.0947 20.5822 28.7156 20.5822 28.2606V27.1421H13.4922L19.748 19.2938C19.8428 19.1801 20.0134 18.9716 20.0893 18.8768L20.1272 18.8199C20.4874 18.2891 20.5632 17.8341 20.5632 17.2844V17Z" fill="#0068FF"/>
                                <path d="M32.9416 29.0947H34.3255V17H32.2402V28.3933C32.2402 28.7725 32.5435 29.0947 32.9416 29.0947Z" fill="#0068FF"/>
                                <path d="M25.814 19.6924C23.1979 19.6924 21.0747 21.8156 21.0747 24.4317C21.0747 27.0478 23.1979 29.171 25.814 29.171C28.4301 29.171 30.5533 27.0478 30.5533 24.4317C30.5723 21.8156 28.4491 19.6924 25.814 19.6924ZM25.814 27.2184C24.2785 27.2184 23.0273 25.9672 23.0273 24.4317C23.0273 22.8962 24.2785 21.645 25.814 21.645C27.3495 21.645 28.6007 22.8962 28.6007 24.4317C28.6007 25.9672 27.3685 27.2184 25.814 27.2184Z" fill="#0068FF"/>
                                <path d="M40.4867 19.6162C37.8516 19.6162 35.7095 21.7584 35.7095 24.3934C35.7095 27.0285 37.8516 29.1707 40.4867 29.1707C43.1217 29.1707 45.2639 27.0285 45.2639 24.3934C45.2639 21.7584 43.1217 19.6162 40.4867 19.6162ZM40.4867 27.2181C38.9322 27.2181 37.681 25.9669 37.681 24.4124C37.681 22.8579 38.9322 21.6067 40.4867 21.6067C42.0412 21.6067 43.2924 22.8579 43.2924 24.4124C43.2924 25.9669 42.0412 27.2181 40.4867 27.2181Z" fill="#0068FF"/>
                                <path d="M29.4562 29.0944H30.5747V19.957H28.6221V28.2793C28.6221 28.7153 29.0012 29.0944 29.4562 29.0944Z" fill="#0068FF"/>
                            </svg>
                            <span>Nhận Tư Vấn Gói Bảo Dưỡng Này Qua Zalo</span>
                        </a>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $tech_phone)); ?>" class="maint-cta-call">
                            <i class="fa-solid fa-phone"></i>
                            <span>Hotline Kỹ Thuật: <strong><?php echo esc_html($tech_phone); ?></strong></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- =====================================================================
             TAB 2: CÔNG CỤ BẮT BỆNH XE NHANH THEO HIỆN TƯỢNG
             ===================================================================== -->
        <div class="smart-tool-panel" id="panel-symptoms" role="tabpanel" aria-labelledby="tab-btn-symp">
            <div class="symptom-builder-card">
                <div class="symptom-prompt-bar">
                    <span class="prompt-icon">💡</span>
                    <p class="prompt-text">Bấm chọn 1 hiện tượng lạ xe bạn đang gặp phải bên dưới để xem chẩn đoán kỹ thuật sơ bộ &amp; lời khuyên của Kỹ Sư Trưởng Hải Hà:</p>
                </div>

                <!-- 6 Symptom Cards Grid -->
                <div class="symptoms-grid" id="symptomsGrid">
                    <!-- Card 1 -->
                    <button type="button" class="symptom-card active" data-symptom="ac">
                        <span class="symptom-icon">❄️</span>
                        <div class="symptom-info">
                            <strong class="symptom-name">Điều hòa không mát / Chỉ ra gió nóng</strong>
                            <span class="symptom-short">Bật AC hết cỡ nhưng cabin vẫn ngột ngạt hoặc có mùi hôi ẩm.</span>
                        </div>
                    </button>

                    <!-- Card 2 -->
                    <button type="button" class="symptom-card" data-symptom="underbody">
                        <span class="symptom-icon">🔊</span>
                        <div class="symptom-info">
                            <strong class="symptom-name">Gầm kêu lục cục khi qua gờ giảm tốc</strong>
                            <span class="symptom-short">Tiếng va đập kim loại dưới gầm khi đi đường gồ ghề hoặc ôm cua.</span>
                        </div>
                    </button>

                    <!-- Card 3 -->
                    <button type="button" class="symptom-card" data-symptom="steering">
                        <span class="symptom-icon">🛞</span>
                        <div class="symptom-info">
                            <strong class="symptom-name">Vô lăng rung lắc / Nhao lái sang bên</strong>
                            <span class="symptom-short">Chạy tốc độ cao vô lăng rung, hoặc buông tay xe tự lạng sang lề.</span>
                        </div>
                    </button>

                    <!-- Card 4 -->
                    <button type="button" class="symptom-card" data-symptom="brake">
                        <span class="symptom-icon">🛑</span>
                        <div class="symptom-info">
                            <strong class="symptom-name">Phanh rít két két / Đạp phanh bị sâu</strong>
                            <span class="symptom-short">Tiếng kim loại ken két rít chói tai mỗi khi nhấn bàn đạp phanh.</span>
                        </div>
                    </button>

                    <!-- Card 5 -->
                    <button type="button" class="symptom-card" data-symptom="start">
                        <span class="symptom-icon">⚡</span>
                        <div class="symptom-info">
                            <strong class="symptom-name">Đề dai khó nổ / Chết máy đột ngột</strong>
                            <span class="symptom-short">Bấm nút start tiếng đề lịm dần, đồng hồ chớp tắt hoặc hụt ga chết máy.</span>
                        </div>
                    </button>

                    <!-- Card 6 -->
                    <button type="button" class="symptom-card" data-symptom="check_engine">
                        <span class="symptom-icon">⚠️</span>
                        <div class="symptom-info">
                            <strong class="symptom-name">Đèn Check Engine sáng (Đèn cá vàng)</strong>
                            <span class="symptom-short">Biểu tượng động cơ màu vàng sáng liên tục trên bảng đồng hồ taplo.</span>
                        </div>
                    </button>
                </div>

                <!-- Diagnosis Detail Card -->
                <div class="diagnosis-detail-card" id="diagnosisDetailCard">
                    <!-- Populated dynamically via JS -->
                </div>
            </div>
        </div>

    </div>
</section>
