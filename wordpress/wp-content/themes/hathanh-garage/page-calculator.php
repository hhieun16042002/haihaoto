<?php
/**
 * Template Name: Bảng Giá & Dự Toán Chi Phí
 *
 * @package HaThanh_Garage
 */

get_header();
?>

<main id="primary" class="site-main" style="background:#f8fafc; min-height:80vh;">

  <!-- Breadcrumbs -->
  <div style="background:#ffffff; border-bottom:1px solid #e2e8f0; padding:0.85rem 0; font-size:0.875rem; color:#64748b;">
    <div class="container">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color:#64748b; text-decoration:none;">Trang chủ</a>
      <span style="margin:0 0.5rem; color:#cbd5e1;">/</span>
      <b style="color:#0f172a;">Bảng giá & Dự toán chi phí</b>
    </div>
  </div>

  <!-- Hero Header -->
  <div style="background:linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); padding:3.5rem 0 2.5rem; text-align:center; border-bottom:1px solid #e2e8f0;">
    <div class="container">
      <span style="font-size:0.8125rem; font-weight:700; color:#dc2626; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:0.5rem; display:block;">CÔNG CỤ MINH BẠCH CHI PHÍ</span>
      <h1 style="font-size:2.5rem; font-weight:900; color:#0f172a; margin-bottom:0.85rem; letter-spacing:-0.02em;">Dự Toán Chi Phí & Bảng Giá Dịch Vụ</h1>
      <p style="max-width:680px; margin:0 auto; color:#64748b; font-size:1.05rem; line-height:1.6;">
        Chủ động dự tính chi phí bảo dưỡng định kỳ và tra cứu bảng giá niêm yết các hạng mục phụ tùng chính hãng Motul, Mobil 1, Bosch tại hệ thống Hà Thành Garage.
      </p>
    </div>
  </div>

  <!-- Interactive Calculator Box -->
  <div class="container" style="max-width:1100px; margin:-2.5rem auto 4rem; position:relative; z-index:10;">
    <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:2.5rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.08);">
      <h3 style="font-size:1.15rem; font-weight:800; color:#0f172a; margin-bottom:0.75rem;">1. Chọn Phân Khúc Xe Ô Tô Của Bạn:</h3>
      <div style="display:flex; flex-wrap:wrap; gap:0.65rem; margin-bottom:1.75rem;" id="wpSegPills">
        <button type="button" class="calc-pill active" data-seg="ab" onclick="selectWpSeg('ab', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#dc2626; color:#fff; border:1.5px solid #dc2626; font-weight:600; cursor:pointer;">Hạng A / B (Vios, Morning, Accent, i10)</button>
        <button type="button" class="calc-pill" data-seg="cd" onclick="selectWpSeg('cd', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Hạng C / D (Camry, Civic, Mazda 3, K3)</button>
        <button type="button" class="calc-pill" data-seg="suv" onclick="selectWpSeg('suv', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">SUV / Crossover (CR-V, CX-5, SantaFe, Tucson)</button>
        <button type="button" class="calc-pill" data-seg="mpv" onclick="selectWpSeg('mpv', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Bán tải / MPV (Ranger, Hilux, Xpander)</button>
        <button type="button" class="calc-pill" data-seg="lux" onclick="selectWpSeg('lux', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Xe Sang (Mercedes-Benz, BMW, Audi, Lexus)</button>
      </div>

      <h3 style="font-size:1.15rem; font-weight:800; color:#0f172a; margin-bottom:0.75rem;">2. Chọn Cấp Số Km Cần Bảo Dưỡng:</h3>
      <div style="display:flex; flex-wrap:wrap; gap:0.65rem; margin-bottom:1.75rem;" id="wpKmPills">
        <button type="button" class="calc-km-pill active" data-km="5000" onclick="selectWpKm('5000', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#dc2626; color:#fff; border:1.5px solid #dc2626; font-weight:600; cursor:pointer;">Cấp 5.000 Km (Cấp 1)</button>
        <button type="button" class="calc-km-pill" data-km="10000" onclick="selectWpKm('10000', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Cấp 10.000 Km (Cấp 2)</button>
        <button type="button" class="calc-km-pill" data-km="20000" onclick="selectWpKm('20000', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Cấp 20.000 Km (Cấp 3)</button>
        <button type="button" class="calc-km-pill" data-km="40000" onclick="selectWpKm('40000', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Cấp 40.000 Km (Cấp lớn)</button>
        <button type="button" class="calc-km-pill" data-km="80000" onclick="selectWpKm('80000', this)" style="padding:0.65rem 1.25rem; border-radius:10px; background:#fff; color:#0f172a; border:1.5px solid #cbd5e1; font-weight:600; cursor:pointer;">Cấp 80.000 Km (Đại tu)</button>
      </div>

      <div style="background:linear-gradient(145deg, #0f172a, #1e293b); color:#ffffff; border-radius:12px; padding:2rem; margin-top:2rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
        <div>
          <div style="font-size:0.75rem; font-weight:700; color:#fbbf24; text-transform:uppercase;">TỔNG DỰ TOÁN TRỌN GÓI</div>
          <div style="font-size:2.5rem; font-weight:900; color:#fff;" id="wpPriceVal">850.000 VNĐ</div>
          <div style="font-size:0.875rem; color:#4ade80;"><i class="fa fa-clock"></i> Thời gian: <span id="wpTimeVal">45 - 60 phút</span></div>
        </div>
        <div>
          <a href="<?php echo esc_url(home_url('/#dat-lich')); ?>" style="display:inline-block; padding:0.85rem 1.75rem; background:#dc2626; color:#ffffff; border-radius:10px; font-weight:700; font-size:1rem; text-decoration:none;">
            Đặt lịch theo giá này (-10%)
          </a>
        </div>
      </div>
    </div>

    <!-- Official Price Table -->
    <div style="margin-top:3rem;">
      <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:2rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); margin-bottom:2rem;">
        <h2 style="font-size:1.5rem; font-weight:900; color:#0f172a; margin-bottom:0.5rem;">Bảng Giá Niêm Yết Các Dịch Vụ Cốt Lõi</h2>
        <p style="color:#64748b; font-size:0.90625rem; margin-bottom:1.5rem;">Cam kết giá minh bạch, kiểm tra báo giá trước khi làm việc, không phụ phí ẩn.</p>
        <table style="width:100%; border-collapse:collapse; font-size:0.9375rem;">
          <thead>
            <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
              <th style="padding:1rem; border:1px solid #e2e8f0; text-align:left;">Dịch vụ / Hạng mục</th>
              <th style="padding:1rem; border:1px solid #e2e8f0; text-align:left;">Tiêu chuẩn kỹ thuật</th>
              <th style="padding:1rem; border:1px solid #e2e8f0; text-align:left;">Đơn giá niêm yết</th>
              <th style="padding:1rem; border:1px solid #e2e8f0; text-align:left;">Bảo hành</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding:1rem; border:1px solid #e2e8f0;"><b>Sơn dặm xước xe ô tô</b></td>
              <td style="padding:1rem; border:1px solid #e2e8f0;">Phòng sơn sấy hồng ngoại Sikkens Hà Lan</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; font-weight:700; color:#dc2626;">Từ 500.000đ / vị trí</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; color:#16a34a; font-weight:700;">5 Năm độ bền màu</td>
            </tr>
            <tr style="background:#fcfcfc;">
              <td style="padding:1rem; border:1px solid #e2e8f0;"><b>Sơn quây đổi màu toàn xe</b></td>
              <td style="padding:1rem; border:1px solid #e2e8f0;">Tháo dỡ gioăng nẹp, sấy buồng nhiệt âm sàn</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; font-weight:700; color:#dc2626;">Từ 14.500.000đ</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; color:#16a34a; font-weight:700;">3 Năm bảo hành điện tử</td>
            </tr>
            <tr>
              <td style="padding:1rem; border:1px solid #e2e8f0;"><b>Bảo dưỡng 30 bước tiêu chuẩn</b></td>
              <td style="padding:1rem; border:1px solid #e2e8f0;">KCS 6 bước bằng máy đo chẩn đoán OBD-II</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; font-weight:700; color:#dc2626;">Từ 850.000đ</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; color:#16a34a; font-weight:700;">6 Tháng hoặc 10.000km</td>
            </tr>
            <tr style="background:#fcfcfc;">
              <td style="padding:1rem; border:1px solid #e2e8f0;"><b>Gói Car Spa Ceramic 9H</b></td>
              <td style="padding:1rem; border:1px solid #e2e8f0;">Hiệu chỉnh mặt sơn 3 bước + 2 lớp Ceramic</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; font-weight:700; color:#dc2626;">Từ 4.800.000đ</td>
              <td style="padding:1rem; border:1px solid #e2e8f0; color:#16a34a; font-weight:700;">2 Năm bảo dưỡng định kỳ</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</main>

<script>
const WP_CALC_DATA = {
  ab: {
    5000: { price: '850.000 VNĐ', time: '45 - 60 phút' },
    10000: { price: '1.250.000 VNĐ', time: '60 - 90 phút' },
    20000: { price: '2.100.000 VNĐ', time: '120 phút' },
    40000: { price: '3.800.000 VNĐ', time: '180 phút' },
    80000: { price: '6.500.000 VNĐ', time: '1 ngày' }
  },
  cd: {
    5000: { price: '1.050.000 VNĐ', time: '45 - 60 phút' },
    10000: { price: '1.550.000 VNĐ', time: '60 - 90 phút' },
    20000: { price: '2.600.000 VNĐ', time: '120 phút' },
    40000: { price: '4.600.000 VNĐ', time: '180 phút' },
    80000: { price: '8.200.000 VNĐ', time: '1 - 2 ngày' }
  },
  suv: {
    5000: { price: '1.200.000 VNĐ', time: '60 phút' },
    10000: { price: '1.800.000 VNĐ', time: '90 phút' },
    20000: { price: '2.950.000 VNĐ', time: '120 - 150 phút' },
    40000: { price: '5.200.000 VNĐ', time: '180 - 240 phút' },
    80000: { price: '9.500.000 VNĐ', time: '2 ngày' }
  },
  mpv: {
    5000: { price: '1.300.000 VNĐ', time: '60 phút' },
    10000: { price: '1.950.000 VNĐ', time: '90 phút' },
    20000: { price: '3.200.000 VNĐ', time: '150 phút' },
    40000: { price: '5.800.000 VNĐ', time: '240 phút' },
    80000: { price: '10.500.000 VNĐ', time: '2 ngày' }
  },
  lux: {
    5000: { price: '2.800.000 VNĐ', time: '90 phút' },
    10000: { price: '4.200.000 VNĐ', time: '120 phút' },
    20000: { price: '6.800.000 VNĐ', time: '180 phút' },
    40000: { price: '12.500.000 VNĐ', time: '1 ngày' },
    80000: { price: '22.000.000 VNĐ', time: '2 - 3 ngày' }
  }
};

let currentWpSeg = 'ab';
let currentWpKm = '5000';

function selectWpSeg(seg, btn) {
  currentWpSeg = seg;
  document.querySelectorAll('.calc-pill').forEach(b => {
    b.style.background = '#fff';
    b.style.color = '#0f172a';
    b.style.borderColor = '#cbd5e1';
  });
  btn.style.background = '#dc2626';
  btn.style.color = '#fff';
  btn.style.borderColor = '#dc2626';
  updateWpEstimate();
}

function selectWpKm(km, btn) {
  currentWpKm = km;
  document.querySelectorAll('.calc-km-pill').forEach(b => {
    b.style.background = '#fff';
    b.style.color = '#0f172a';
    b.style.borderColor = '#cbd5e1';
  });
  btn.style.background = '#dc2626';
  btn.style.color = '#fff';
  btn.style.borderColor = '#dc2626';
  updateWpEstimate();
}

function updateWpEstimate() {
  const data = WP_CALC_DATA[currentWpSeg][currentWpKm];
  document.getElementById('wpPriceVal').textContent = data.price;
  document.getElementById('wpTimeVal').textContent = data.time;
}
</script>

<?php get_footer(); ?>
