<?php
/**
 * Master Front Page Template for Hà Thành Garage
 *
 * @package HaThanh_Garage
 */

get_header();
?>

<main id="primary" class="site-main">

  <!-- 1. HERO SECTION & FLOATING ENGINE -->
  <section class="ht-hero" id="dat-lich">
    <div class="container">
      <div class="ht-hero-grid">
        <!-- Hero Left Content -->
        <div class="ht-hero-info">
          <div class="hero-badge-tag">
            <i class="fa fa-circle-check"></i> TOP 1 HỆ THỐNG CHĂM SÓC & SỬA CHỮA Ô TÔ TOÀN QUỐC
          </div>

          <h1>
            CHUYÊN NGHIỆP TỪNG CHI TIẾT <br>
            <span class="highlight">AN TÂM MỌI HÀNH TRÌNH</span>
          </h1>

          <p class="hero-desc">
            Hà Thành Garage tự hào sở hữu mạng lưới gần 30 chi nhánh trên cả nước, cung cấp dịch vụ bảo dưỡng 30 bước tiêu chuẩn hãng, sơn sấy công nghệ cao bảo hành 2-5 năm, đại tu máy gầm và hệ thống bảo hành điện tử liên chi nhánh toàn quốc.
          </p>

          <div style="display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 30px;">
            <a href="#dich-vu" class="btn-ht btn-ht-primary" style="padding: 14px 28px; font-size: 1rem;">
              <i class="fa fa-wrench"></i> KHÁM PHÁ DỊCH VỤ
            </a>
            <a href="#chi-nhanh" class="btn-ht btn-ht-outline" style="padding: 14px 28px; font-size: 1rem;">
              <i class="fa fa-map-location-dot"></i> TÌM CHI NHÁNH GẦN BẠN
            </a>
          </div>

          <div class="hero-stats-row">
            <div class="hero-stat-item">
              <h3>30<span>+</span></h3>
              <p>Chi nhánh toàn quốc</p>
            </div>
            <div class="hero-stat-item">
              <h3>200.000<span>+</span></h3>
              <p>Khách hàng tin chọn</p>
            </div>
            <div class="hero-stat-item">
              <h3>100<span>%</span></h3>
              <p>Phụ tùng chính hãng</p>
            </div>
          </div>
        </div>

        <!-- Hero Right: Booking / Warranty Engine Box -->
        <div class="hero-engine-card">
          <div class="engine-tabs">
            <button type="button" class="engine-tab-btn active" data-tab="booking">
              <i class="fa fa-calendar-check"></i> ĐẶT LỊCH DỊCH VỤ
            </button>
            <button type="button" class="engine-tab-btn" data-tab="warranty">
              <i class="fa fa-shield-halved"></i> TRA CỨU BẢO HÀNH
            </button>
          </div>

          <!-- Tab Content 1: Booking -->
          <div class="engine-tab-content" id="tab-booking">
            <form id="hero-booking-form">
              <div class="engine-row-2">
                <div class="engine-form-group">
                  <label for="bk-name">Họ và tên chủ xe *</label>
                  <input type="text" id="bk-name" class="engine-input" placeholder="Nguyễn Văn A" required>
                </div>
                <div class="engine-form-group">
                  <label for="bk-phone">Số điện thoại *</label>
                  <input type="tel" id="bk-phone" class="engine-input" placeholder="09xx xxx xxx" required>
                </div>
              </div>

              <div class="engine-row-2">
                <div class="engine-form-group">
                  <label for="bk-car">Hãng xe / Dòng xe</label>
                  <input type="text" id="bk-car" class="engine-input" placeholder="VD: Mazda 3, Mercedes C200...">
                </div>
                <div class="engine-form-group">
                  <label for="bk-plate">Biển số xe</label>
                  <input type="text" id="bk-plate" class="engine-input" placeholder="VD: 30H-123.45">
                </div>
              </div>

              <div class="engine-form-group">
                <label for="bk-service">Gói dịch vụ cần thực hiện</label>
                <select id="bk-service" class="engine-select">
                  <option value="Bảo dưỡng định kỳ 30 bước">Bảo dưỡng định kỳ 30 bước tiêu chuẩn hãng</option>
                  <option value="Sơn phục hồi / Sơn đổi màu">Sơn dặm, sơn quây, phục hồi vết xước</option>
                  <option value="Đại tu động cơ & hộp số">Kiểm tra sửa chữa máy gầm, điện lạnh</option>
                  <option value="Chăm sóc Detailing & Ceramic">Phủ Ceramic 9H, dán phim 3M, dọn nội thất</option>
                  <option value="Sửa chữa thân vỏ bảo hiểm">Bảo hiểm thân vỏ va chạm phục hồi</option>
                  <option value="Khám xe tổng quát miễn phí">Kiểm tra tổng quát 30 hạng mục miễn phí</option>
                </select>
              </div>

              <div class="engine-row-2">
                <div class="engine-form-group">
                  <label for="bk-branch">Chi nhánh tiếp nhận</label>
                  <select id="bk-branch" class="engine-select">
                    <option value="Cơ sở Võ Chí Công (Hà Nội)">Hà Nội - Cơ sở Võ Chí Công (Tây Hồ)</option>
                    <option value="Cơ sở Trần Điền (Hà Nội)">Hà Nội - Cơ sở Trần Điền (Hoàng Mai)</option>
                    <option value="Cơ sở Thạch Bàn (Hà Nội)">Hà Nội - Cơ sở Thạch Bàn (Long Biên)</option>
                    <option value="Cơ sở Lê Hồng Phong (Hải Phòng)">Hải Phòng - Cơ sở Ngô Quyền</option>
                    <option value="Cơ sở Bãi Cháy (Quảng Ninh)">Quảng Ninh - Cơ sở Bãi Cháy</option>
                    <option value="Cơ sở TP.HCM (Thủ Đức)">TP. Hồ Chí Minh - Cơ sở Thủ Đức</option>
                    <option value="Chi nhánh gần nhất">Hệ thống tự động chọn chi nhánh gần nhất</option>
                  </select>
                </div>
                <div class="engine-form-group">
                  <label for="bk-date">Ngày mong muốn</label>
                  <input type="date" id="bk-date" class="engine-input">
                </div>
              </div>

              <button type="submit" class="btn-ht btn-ht-primary" style="width:100%; padding:14px; margin-top:8px; font-size:1rem;">
                <i class="fa fa-ticket"></i> GỬI LỊCH HẸN & NHẬN ƯU ĐÃI 10%
              </button>
            </form>
          </div>

          <!-- Tab Content 2: Warranty Lookup -->
          <div class="engine-tab-content" id="tab-warranty" style="display: none;">
            <p style="font-size:0.875rem; color:#94a3b8; margin-bottom:16px;">
              Hệ thống quản lý dữ liệu bảo hành điện tử độc quyền của Hà Thành Garage. Tra cứu lịch sử sửa chữa, vật tư và thời hạn bảo hành liên chi nhánh:
            </p>
            <div class="engine-form-group">
              <label for="warranty-plate-input">Nhập Biển số xe hoặc Số điện thoại</label>
              <div style="display:flex; gap:8px;">
                <input type="text" id="warranty-plate-input" class="engine-input" placeholder="Ví dụ: 30H-888.88 hoặc 51K-999.99">
                <button type="button" id="btn-warranty-search" class="btn-ht btn-ht-primary" style="padding:0 20px; white-space:nowrap;">
                  <i class="fa fa-search"></i> TRA CỨU
                </button>
              </div>
            </div>
            <div style="font-size:0.75rem; color:#64748b; margin-top:-6px;">
              * Biển số mẫu thử nghiệm: <strong style="color:#f59e0b; cursor:pointer;" onclick="document.getElementById('warranty-plate-input').value='30H-888.88'; document.getElementById('btn-warranty-search').click();">30H-888.88</strong>, <strong style="color:#f59e0b; cursor:pointer;" onclick="document.getElementById('warranty-plate-input').value='51K-999.99'; document.getElementById('btn-warranty-search').click();">51K-999.99</strong>
            </div>

            <!-- Result Box -->
            <div id="warranty-result-box" style="display:none;"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. CORE SERVICES SECTION (6 SERVICES OF HA THANH GARAGE) -->
  <section class="services-section" id="dich-vu">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">DỊCH VỤ TOÀN DIỆN</span>
        <h2 class="section-title">CHĂM SÓC & SỬA CHỮA CHUẨN CHUYÊN GIA</h2>
        <p class="section-desc">
          Hà Thành Garage đáp ứng tất cả nhu cầu về ô tô từ bảo dưỡng cơ bản, phục hồi thân vỏ công nghệ cao đến đại tu máy gầm phức tạp theo quy trình hãng.
        </p>
      </div>

      <div class="services-grid">
        <!-- Service 1 -->
        <div class="service-card">
          <div class="service-thumb-wrap">
            <span class="service-tag">KHUYÊN DÙNG ĐỊNH KỲ</span>
            <img src="https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=700&q=80" alt="Bảo dưỡng định kỳ 30 bước">
          </div>
          <div class="service-content">
            <h3>Bảo dưỡng định kỳ 30 bước</h3>
            <p>Quy trình kiểm tra khép kín 30 hạng mục: dầu nhớt, lọc gió, phanh, gầm bệ, điện lạnh, chẩn đoán xóa lỗi máy vi tính tiêu chuẩn kỹ thuật quốc tế.</p>
            <div class="service-footer">
              <span class="service-price">Từ 750.000 đ</span>
              <a href="#dat-lich" class="service-link">Đặt lịch ngay <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Service 2 -->
        <div class="service-card">
          <div class="service-thumb-wrap">
            <span class="service-tag" style="background:#f59e0b;">BẢO HÀNH 2-5 NĂM</span>
            <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=700&q=80" alt="Sơn sấy công nghệ cao Dupont">
          </div>
          <div class="service-content">
            <h3>Sơn sấy ô tô Dupont / PPG</h3>
            <p>Hệ thống phòng sơn sấy khép kín công nghệ cao, pha màu vi tính chính xác 100%, sơn dặm lấy ngay trong ngày, cam kết bảo hành chống bong tróc tới 5 năm.</p>
            <div class="service-footer">
              <span class="service-price">Từ 400.000 đ/vị trí</span>
              <a href="#dat-lich" class="service-link">Đặt lịch ngay <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Service 3 -->
        <div class="service-card">
          <div class="service-thumb-wrap">
            <span class="service-tag">CHUYÊN SÂU MÁY GẦM</span>
            <img src="https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?auto=format&fit=crop&w=700&q=80" alt="Đại tu động cơ & hộp số">
          </div>
          <div class="service-content">
            <h3>Đại tu động cơ & hộp số</h3>
            <p>Trị dứt điểm bệnh rung giật, hao dầu, sôi nước, trượt số, gầm kêu. Thiết bị chẩn đoán chuyên dụng cho Mercedes, BMW, Audi, Porsche, Toyota, Ford.</p>
            <div class="service-footer">
              <span class="service-price">Kiểm tra miễn phí</span>
              <a href="#dat-lich" class="service-link">Đặt lịch ngay <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Service 4 -->
        <div class="service-card">
          <div class="service-thumb-wrap">
            <span class="service-tag">LÀM ĐẸP DETAILING</span>
            <img src="https://images.unsplash.com/photo-1607860108855-64acf2078ed9?auto=format&fit=crop&w=700&q=80" alt="Chăm sóc xe Detailing & Ceramic">
          </div>
          <div class="service-content">
            <h3>Phủ Ceramic & Detailing</h3>
            <p>Bảo vệ lớp sơn bóng gương với Ceramic 9H/10H, dọn nội thất diệt khuẩn khử mùi Ozone, vệ sinh khoang máy bằng hơi nước nóng, dán phim cách nhiệt 3M.</p>
            <div class="service-footer">
              <span class="service-price">Từ 1.200.000 đ</span>
              <a href="#dat-lich" class="service-link">Đặt lịch ngay <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Service 5 -->
        <div class="service-card">
          <div class="service-thumb-wrap">
            <span class="service-tag" style="background:#10b981;">BẢO LÃNH 100%</span>
            <img src="https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?auto=format&fit=crop&w=700&q=80" alt="Phục hồi xe tai nạn bảo hiểm">
          </div>
          <div class="service-content">
            <h3>Phục hồi xe tai nạn & Bảo hiểm</h3>
            <p>Gò nắn sắt xi bằng khung kéo nắn điện tử 3D, hỗ trợ làm hồ sơ bồi thường bảo hiểm nhanh gọn không phát sinh chi phí, liên kết hơn 15 hãng bảo hiểm lớn.</p>
            <div class="service-footer">
              <span class="service-price">Bảo lãnh trực tiếp</span>
              <a href="#dat-lich" class="service-link">Đặt lịch ngay <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Service 6 -->
        <div class="service-card">
          <div class="service-thumb-wrap">
            <span class="service-tag">NÂNG CẤP ĐỒ CHƠI</span>
            <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=700&q=80" alt="Độ xe & phụ kiện thông minh">
          </div>
          <div class="service-content">
            <h3>Độ xe & Phụ kiện thông minh</h3>
            <p>Lắp đặt màn hình Android liền camera 360, cảnh báo điểm mù, cốp điện, cửa hít, độ đèn bi LED/Laser tăng sáng không cắt trích dây nguyên bản của xe.</p>
            <div class="service-footer">
              <span class="service-price">Phụ tùng chính hãng</span>
              <a href="#dat-lich" class="service-link">Đặt lịch ngay <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. MAINTENANCE COST ESTIMATOR TOOL -->
  <section class="estimator-section" id="du-toan">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">DỰ TOÁN MINH BẠCH</span>
        <h2 class="section-title">BẢNG TÍNH CHI PHÍ BẢO DƯỠNG NHANH</h2>
        <p class="section-desc">
          Công cụ ước tính vật tư và chi phí bảo dưỡng định kỳ chính xác theo phân khúc xe và số km hiện tại của bạn.
        </p>
      </div>

      <div class="estimator-box">
        <div class="estimator-controls">
          <div>
            <strong style="color:var(--primary-navy); font-size:1rem; display:block;">1. Chọn phân khúc xe của bạn:</strong>
            <div class="pills-group">
              <button type="button" class="pill-btn pill-segment active" data-segment="sedan">
                <i class="fa fa-car-side"></i> Sedan / Hatchback (A, B, C)
              </button>
              <button type="button" class="pill-btn pill-segment" data-segment="suv">
                <i class="fa fa-truck-pickup"></i> SUV / Crossover / Bán tải
              </button>
              <button type="button" class="pill-btn pill-segment" data-segment="luxury">
                <i class="fa fa-gem"></i> Xe sang (Mercedes, BMW, Audi, Lexus)
              </button>
            </div>
          </div>

          <div>
            <strong style="color:var(--primary-navy); font-size:1rem; display:block;">2. Chọn cấp bảo dưỡng hiện tại (Km):</strong>
            <div class="pills-group">
              <button type="button" class="pill-btn pill-km" data-km="5000">Cấp 5.000 Km</button>
              <button type="button" class="pill-btn pill-km active" data-km="10000">Cấp 10.000 Km</button>
              <button type="button" class="pill-btn pill-km" data-km="20000">Cấp 20.000 Km</button>
              <button type="button" class="pill-btn pill-km" data-km="40000">Cấp 40.000 Km (Cấp lớn)</button>
            </div>
          </div>
        </div>

        <div class="estimator-result-card">
          <div>
            <h4 style="font-family:var(--font-heading); font-size:1.375rem; color:#f59e0b; text-transform:uppercase; margin-bottom:12px;">
              <i class="fa fa-list-check"></i> Chi tiết các hạng mục thực hiện:
            </h4>
            <ul class="result-items-list" id="calc-items-list">
              <!-- Dynamically populated by JS -->
            </ul>
          </div>
          <div class="result-total-wrap">
            <div class="result-total-label">Tổng chi phí dự kiến:</div>
            <div class="result-total-price" id="calc-total-val">1.450.000 đ</div>
            <a href="#dat-lich" class="btn-ht btn-ht-primary" style="padding:12px 24px;">
              <i class="fa fa-check"></i> ĐẶT LỊCH GÓI NÀY
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. 6-STEP QUALITY STANDARD (QUY TRÌNH KCS) -->
  <section class="steps-section" id="quy-trinh">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle" style="color:#f59e0b;">QUY TRÌNH CHUẨN HÃNG</span>
        <h2 class="section-title">6 BƯỚC DỊCH VỤ MINH BẠCH TẠI HÀ THÀNH</h2>
        <p class="section-desc" style="color:#cbd5e1;">
          Mỗi chiếc xe vào xưởng đều được giám sát chặt chẽ qua hệ thống camera và kỹ thuật viên KCS độc lập trước khi xuất xưởng.
        </p>
      </div>

      <div class="steps-grid">
        <div class="step-card">
          <div class="step-number">01</div>
          <h4>Tiếp nhận xe</h4>
          <p>Kiểm tra 30 hạng mục sơ bộ, bọc vô lăng ghế da cẩn thận.</p>
        </div>
        <div class="step-card">
          <div class="step-number">02</div>
          <h4>Chẩn đoán & Báo giá</h4>
          <p>Cắm máy đọc lỗi, lập bảng báo giá minh bạch trước khi làm.</p>
        </div>
        <div class="step-card">
          <div class="step-number">03</div>
          <h4>Triển khai kỹ thuật</h4>
          <p>Thực hiện thay thế vật tư chính hãng, đúng quy trình nhà sản xuất.</p>
        </div>
        <div class="step-card">
          <div class="step-number">04</div>
          <h4>Kiểm tra KCS độc lập</h4>
          <p>Quản đốc chạy thử và ký duyệt biên bản kiểm định 30 tiêu chí.</p>
        </div>
        <div class="step-card">
          <div class="step-number">05</div>
          <h4>Rửa xe & Vệ sinh</h4>
          <p>Rửa vỏ ngoài và hút bụi khoang lái miễn phí trước khi giao.</p>
        </div>
        <div class="step-card">
          <div class="step-number">06</div>
          <h4>Bàn giao & Kích hoạt BH</h4>
          <p>Xuất hóa đơn điện tử, cấp mã bảo hành toàn quốc cho chủ xe.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. BRANCH LOCATOR (MẠNG LƯỚI CHI NHÁNH TOÀN QUỐC) -->
  <section class="branches-section" id="chi-nhanh">
    <div class="container">
      <div class="section-header">
        <span class="section-subtitle">MẠNG LƯỚI TOÀN QUỐC</span>
        <h2 class="section-title">HỆ THỐNG GẦN 30 CƠ SỞ TIÊU CHUẨN</h2>
        <p class="section-desc">
          Bảo hành liên chi nhánh — Quý khách làm dịch vụ tại bất kỳ cơ sở nào đều được bảo hành tại tất cả các gara còn lại trên cả nước.
        </p>
      </div>

      <div class="branch-filter-tabs">
        <button type="button" class="branch-tab-btn active" data-region="all">Tất cả chi nhánh</button>
        <button type="button" class="branch-tab-btn" data-region="hanoi">Hà Nội (8 xưởng)</button>
        <button type="button" class="branch-tab-btn" data-region="haiphong">Hải Phòng (3 xưởng)</button>
        <button type="button" class="branch-tab-btn" data-region="quangninh">Quảng Ninh (3 xưởng)</button>
        <button type="button" class="branch-tab-btn" data-region="south">Miền Nam (Bình Dương, TP.HCM)</button>
      </div>

      <div class="branches-grid">
        <!-- Branch 1 -->
        <div class="branch-card" data-region="hanoi">
          <div class="branch-header">
            <div class="branch-num">01</div>
            <div>
              <h4>Cơ sở Võ Chí Công</h4>
              <span style="font-size:0.75rem; color:var(--accent-red); font-weight:700;">TRỤ SỞ CHÍNH HÀ NỘI</span>
            </div>
          </div>
          <ul class="branch-info-list">
            <li><i class="fa fa-location-dot"></i> Số 110 Võ Chí Công, P. Xuân La, Q. Tây Hồ, Hà Nội</li>
            <li><i class="fa fa-phone"></i> Hotline: 0964.888.888 (24/7)</li>
            <li><i class="fa fa-warehouse"></i> Diện tích xưởng: 2.500m² - 12 cầu nâng</li>
          </ul>
          <div class="branch-actions">
            <a href="tel:0964888888" class="btn-branch btn-branch-call"><i class="fa fa-phone"></i> Gọi ngay</a>
            <a href="https://maps.google.com" target="_blank" class="btn-branch btn-branch-dir"><i class="fa fa-diamond-turn-right"></i> Chỉ đường</a>
          </div>
        </div>

        <!-- Branch 2 -->
        <div class="branch-card" data-region="hanoi">
          <div class="branch-header">
            <div class="branch-num">02</div>
            <div>
              <h4>Cơ sở Trần Điền</h4>
              <span style="font-size:0.75rem; color:#16a34a; font-weight:700;">KHU VỰC HOÀNG MAI</span>
            </div>
          </div>
          <ul class="branch-info-list">
            <li><i class="fa fa-location-dot"></i> Số 500 Trần Điền, P. Định Công, Q. Hoàng Mai, Hà Nội</li>
            <li><i class="fa fa-phone"></i> Hotline: 0968.222.888</li>
            <li><i class="fa fa-warehouse"></i> Phòng sơn sấy Dupont - 8 cầu nâng</li>
          </ul>
          <div class="branch-actions">
            <a href="tel:0968222888" class="btn-branch btn-branch-call"><i class="fa fa-phone"></i> Gọi ngay</a>
            <a href="https://maps.google.com" target="_blank" class="btn-branch btn-branch-dir"><i class="fa fa-diamond-turn-right"></i> Chỉ đường</a>
          </div>
        </div>

        <!-- Branch 3 -->
        <div class="branch-card" data-region="hanoi">
          <div class="branch-header">
            <div class="branch-num">03</div>
            <div>
              <h4>Cơ sở Thạch Bàn</h4>
              <span style="font-size:0.75rem; color:#16a34a; font-weight:700;">KHU VỰC LONG BIÊN</span>
            </div>
          </div>
          <ul class="branch-info-list">
            <li><i class="fa fa-location-dot"></i> Số 68 Phố Thạch Bàn, Q. Long Biên, Hà Nội</li>
            <li><i class="fa fa-phone"></i> Hotline: 0973.111.999</li>
            <li><i class="fa fa-warehouse"></i> Quy mô 1.800m² - Trung tâm Detailing</li>
          </ul>
          <div class="branch-actions">
            <a href="tel:0973111999" class="btn-branch btn-branch-call"><i class="fa fa-phone"></i> Gọi ngay</a>
            <a href="https://maps.google.com" target="_blank" class="btn-branch btn-branch-dir"><i class="fa fa-diamond-turn-right"></i> Chỉ đường</a>
          </div>
        </div>

        <!-- Branch 4 -->
        <div class="branch-card" data-region="haiphong">
          <div class="branch-header">
            <div class="branch-num">04</div>
            <div>
              <h4>Cơ sở Lê Hồng Phong</h4>
              <span style="font-size:0.75rem; color:#2563eb; font-weight:700;">HẢI PHÒNG</span>
            </div>
          </div>
          <ul class="branch-info-list">
            <li><i class="fa fa-location-dot"></i> Lô 26BC Lê Hồng Phong, Q. Ngô Quyền, Hải Phòng</li>
            <li><i class="fa fa-phone"></i> Hotline: 0969.555.777</li>
            <li><i class="fa fa-warehouse"></i> Đại tu máy gầm & Sơn phục hồi xe sang</li>
          </ul>
          <div class="branch-actions">
            <a href="tel:0969555777" class="btn-branch btn-branch-call"><i class="fa fa-phone"></i> Gọi ngay</a>
            <a href="https://maps.google.com" target="_blank" class="btn-branch btn-branch-dir"><i class="fa fa-diamond-turn-right"></i> Chỉ đường</a>
          </div>
        </div>

        <!-- Branch 5 -->
        <div class="branch-card" data-region="quangninh">
          <div class="branch-header">
            <div class="branch-num">05</div>
            <div>
              <h4>Cơ sở Bãi Cháy</h4>
              <span style="font-size:0.75rem; color:#8b5cf6; font-weight:700;">HẠ LONG - QUẢNG NINH</span>
            </div>
          </div>
          <ul class="branch-info-list">
            <li><i class="fa fa-location-dot"></i> Đường Hoàng Quốc Việt, Bãi Cháy, TP. Hạ Long</li>
            <li><i class="fa fa-phone"></i> Hotline: 0975.333.666</li>
            <li><i class="fa fa-warehouse"></i> Trung tâm cứu hộ & làm đồng sơn bảo hiểm</li>
          </ul>
          <div class="branch-actions">
            <a href="tel:0975333666" class="btn-branch btn-branch-call"><i class="fa fa-phone"></i> Gọi ngay</a>
            <a href="https://maps.google.com" target="_blank" class="btn-branch btn-branch-dir"><i class="fa fa-diamond-turn-right"></i> Chỉ đường</a>
          </div>
        </div>

        <!-- Branch 6 -->
        <div class="branch-card" data-region="south">
          <div class="branch-header">
            <div class="branch-num">06</div>
            <div>
              <h4>Cơ sở TP. Thủ Đức</h4>
              <span style="font-size:0.75rem; color:#f59e0b; font-weight:700;">TP. HỒ CHÍ MINH</span>
            </div>
          </div>
          <ul class="branch-info-list">
            <li><i class="fa fa-location-dot"></i> Đường Song Hành Xa Lộ Hà Nội, TP. Thủ Đức, TP.HCM</li>
            <li><i class="fa fa-phone"></i> Hotline: 0989.111.333</li>
            <li><i class="fa fa-warehouse"></i> Xưởng tổng miền Nam 3.000m² - 16 cầu nâng</li>
          </ul>
          <div class="branch-actions">
            <a href="tel:0989111333" class="btn-branch btn-branch-call"><i class="fa fa-phone"></i> Gọi ngay</a>
            <a href="https://maps.google.com" target="_blank" class="btn-branch btn-branch-dir"><i class="fa fa-diamond-turn-right"></i> Chỉ đường</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<?php
get_footer();
