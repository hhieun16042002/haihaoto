<?php
/**
 * Template Name: Tra Cứu Bảo Hành Điện Tử
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
      <b style="color:#0f172a;">Tra cứu bảo hành điện tử</b>
    </div>
  </div>

  <!-- Hero Header -->
  <div style="background:linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); padding:3.5rem 0 2.5rem; text-align:center; border-bottom:1px solid #e2e8f0;">
    <div class="container">
      <span style="font-size:0.8125rem; font-weight:700; color:#dc2626; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:0.5rem; display:block;">HỆ THỐNG SỐ HOÁ TOÀN QUỐC</span>
      <h1 style="font-size:2.5rem; font-weight:900; color:#0f172a; margin-bottom:0.85rem; letter-spacing:-0.02em;">Tra Cứu Bảo Hành Điện Tử</h1>
      <p style="max-width:680px; margin:0 auto; color:#64748b; font-size:1.05rem; line-height:1.6;">
        Nhập biển số xe hoặc số điện thoại của bạn để kiểm tra toàn bộ lịch sử sửa chữa, thời hạn bảo hành còn lại và xác thực kỹ thuật viên KCS ký duyệt tại bất kỳ chi nhánh nào trong hệ thống Hà Thành Garage.
      </p>
    </div>
  </div>

  <!-- Search Box -->
  <div class="container" style="max-width:900px; margin:-2.5rem auto 3.5rem; position:relative; z-index:10;">
    <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:2.5rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.08);">
      <form id="warrantySearchForm" onsubmit="event.preventDefault(); doWpSearch();" style="display:flex; gap:0.85rem; margin-bottom:1.25rem;">
        <input type="text" id="wpPlateInput" placeholder="Nhập Biển Số Xe (VD: 30H-888.88) hoặc Số Điện Thoại..." style="flex:1; height:52px; padding:0 1.25rem; border:2px solid #cbd5e1; border-radius:10px; font-size:1.05rem; outline:none;" required>
        <button type="submit" style="padding:0 2rem; background:#dc2626; color:#ffffff; border:none; border-radius:10px; font-weight:700; font-size:1rem; cursor:pointer; display:flex; align-items:center; gap:0.5rem;">
          <i class="fa fa-magnifying-glass"></i> Tra cứu hồ sơ
        </button>
      </form>
      <div style="display:flex; align-items:center; gap:0.65rem; font-size:0.8125rem; color:#64748b; flex-wrap:wrap;">
        <span><i class="fa fa-circle-info"></i> Biển số mẫu thử hệ thống:</span>
        <button type="button" onclick="setWpSample('30H-888.88')" style="background:#f1f5f9; border:1px solid #e2e8f0; padding:0.3rem 0.75rem; border-radius:6px; font-family:monospace; font-weight:700; color:#0f172a; cursor:pointer;">30H-888.88 (Mercedes E300)</button>
        <button type="button" onclick="setWpSample('51K-999.99')" style="background:#f1f5f9; border:1px solid #e2e8f0; padding:0.3rem 0.75rem; border-radius:6px; font-family:monospace; font-weight:700; color:#0f172a; cursor:pointer;">51K-999.99 (Porsche Panamera)</button>
        <button type="button" onclick="setWpSample('14A-666.88')" style="background:#f1f5f9; border:1px solid #e2e8f0; padding:0.3rem 0.75rem; border-radius:6px; font-family:monospace; font-weight:700; color:#0f172a; cursor:pointer;">14A-666.88 (Toyota Camry)</button>
      </div>
    </div>
  </div>

  <!-- Certificate Result Container -->
  <div class="container" id="wpWarrantyResult" style="max-width:900px; margin:0 auto 4rem;">
    <!-- Rendered dynamically via JS below -->
  </div>

</main>

<script>
const WP_WARRANTY_DB = {
  '30H-888.88': {
    owner: 'Nguyễn Tuấn Dũng',
    phone: '0988.***.888',
    vehicle: 'Mercedes-Benz E300 AMG (2022)',
    vin: 'WDDZF4JB8NA90****',
    plate: '30H-888.88',
    branch: 'Chi nhánh Tây Hồ - 500 Võ Chí Công, Q. Tây Hồ, HN',
    service: 'Sơn đổi màu toàn xe công nghệ Sikkens + Phủ bóng Ceramic 9H',
    certCode: 'HT-BH-2024-8888',
    dateIn: '15/09/2024',
    dateOut: '22/09/2024',
    warrantyUntil: '22/09/2027',
    kcsStaff: 'Nguyễn Văn Mạnh (KCS Bậc 4)',
    status: 'ĐANG CÒN HIỆU LỰC (3 Năm)',
    history: [
      { date: '22/09/2024', odo: '28,500 km', job: 'Sơn đổi màu phủ bóng Sikkens cao cấp + KCS 6 bước', warrantyTo: '22/09/2027' },
      { date: '15/04/2024', odo: '22,100 km', job: 'Bảo dưỡng cấp lớn 30 bước + Thay dầu Wolver Special Evolution', warrantyTo: '15/10/2024' }
    ]
  },
  '51K-999.99': {
    owner: 'Phan Minh Khang',
    phone: '0903.***.999',
    vehicle: 'Porsche Panamera 4S (2021)',
    vin: 'WP0AA2A79ML12****',
    plate: '51K-999.99',
    branch: 'Chi nhánh TP.HCM - 28 Phan Chu Trinh, Q. Bình Thạnh',
    service: 'Đại tu gầm & Thay toàn bộ giảm xóc bóng hơi chính hãng',
    certCode: 'HT-BH-2024-9999',
    dateIn: '05/10/2024',
    dateOut: '12/10/2024',
    warrantyUntil: '12/10/2026',
    kcsStaff: 'Trần Đình Trọng (Chuyên gia Porsche Certified)',
    status: 'ĐANG CÒN HIỆU LỰC (2 Năm)',
    history: [
      { date: '12/10/2024', odo: '45,200 km', job: 'Thay 4 bóng hơi giảm chấn + Cân chỉnh góc đặt bánh xe 3D Hunter', warrantyTo: '12/10/2026' }
    ]
  },
  '14A-666.88': {
    owner: 'Lê Hoàng Nam',
    phone: '0912.***.666',
    vehicle: 'Toyota Camry 2.5Q (2023)',
    vin: '6T1BF3HK4NX88****',
    plate: '14A-666.88',
    branch: 'Chi nhánh Quảng Ninh - KĐT Cao Xanh, Hạ Long',
    service: 'Bảo dưỡng 30 bước tiêu chuẩn + Sơn sấy cản trước & tai xe',
    certCode: 'HT-BH-2024-6668',
    dateIn: '20/10/2024',
    dateOut: '23/10/2024',
    warrantyUntil: '23/10/2025',
    kcsStaff: 'Vũ Đức Thịnh (Trưởng KCS)',
    status: 'ĐANG CÒN HIỆU LỰC (1 Năm)',
    history: [
      { date: '23/10/2024', odo: '15,000 km', job: 'Bảo dưỡng định kỳ 30 bước + Gò nắn sơn sấy cản trước', warrantyTo: '23/10/2025' }
    ]
  }
};

function setWpSample(plate) {
  document.getElementById('wpPlateInput').value = plate;
  doWpSearch();
}

function doWpSearch() {
  const query = document.getElementById('wpPlateInput').value.trim().toUpperCase();
  const c = document.getElementById('wpWarrantyResult');
  const d = WP_WARRANTY_DB[query];

  if (!d) {
    c.innerHTML = `
      <div style="background:#fff; border:1px solid #fecaca; border-radius:18px; padding:3rem; text-align:center;">
        <i class="fa fa-triangle-exclamation" style="font-size:3rem; color:#dc2626; margin-bottom:1rem;"></i>
        <h3 style="font-size:1.5rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Không Tìm Thấy Hồ Sơ Bảo Hành</h3>
        <p style="color:#64748b; max-width:500px; margin:0 auto 1.5rem;">Không tìm thấy biển số "${query}" trên hệ thống cơ sở dữ liệu số toàn quốc. Vui lòng kiểm tra lại biển số hoặc liên hệ tổng đài hỗ trợ.</p>
        <a href="tel:0568050505" style="display:inline-flex; align-items:center; gap:0.5rem; background:#dc2626; color:#fff; padding:0.75rem 1.5rem; border-radius:8px; text-decoration:none; font-weight:700;">
          <i class="fa fa-phone"></i> Gọi CSKH 0568 05 0505
        </a>
      </div>
    `;
    return;
  }

  c.innerHTML = `
    <div style="background:#ffffff; border:2px solid #cbd5e1; border-radius:18px; padding:3rem; box-shadow:0 20px 25px -5px rgba(0,0,0,0.08); position:relative;">
      <!-- Cert Header -->
      <div style="display:flex; justify-content:space-between; align-items:flex-start; border-bottom:2px solid #e2e8f0; padding-bottom:1.75rem; margin-bottom:2rem; flex-wrap:wrap; gap:1rem;">
        <div>
          <div style="display:inline-flex; align-items:center; gap:0.4rem; background:#dcfce7; color:#15803d; border:1.5px solid #86efac; padding:0.4rem 1rem; border-radius:30px; font-weight:800; font-size:0.875rem; margin-bottom:0.75rem;">
            <i class="fa fa-circle-check"></i> ${d.status}
          </div>
          <h2 style="font-size:1.75rem; font-weight:900; color:#0f172a;">CHỨNG THƯ BẢO HÀNH ĐIỆN TỬ</h2>
          <div style="color:#64748b; font-size:0.875rem;">Mã xác thực: <b style="font-family:monospace; color:#dc2626;">${d.certCode}</b></div>
        </div>
        <div style="text-align:right;">
          <div style="font-size:0.75rem; color:#64748b;">HỆ THỐNG ĐIỆN TỬ LIÊN CHI NHÁNH</div>
          <div style="font-size:1.2rem; font-weight:900; color:#dc2626;">HÀ THÀNH GARAGE</div>
        </div>
      </div>

      <!-- Vehicle & Client Data -->
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; margin-bottom:2.5rem;">
        <div>
          <div style="margin-bottom:1.25rem;">
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748b;">Chủ Phương Tiện</div>
            <div style="font-size:1.2rem; font-weight:800; color:#0f172a;">${d.owner}</div>
          </div>
          <div style="margin-bottom:1.25rem;">
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748b;">Biển Số Đăng Ký</div>
            <div style="font-size:1.35rem; font-weight:900; color:#dc2626; font-family:monospace;">${d.plate}</div>
          </div>
          <div>
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748b;">Dòng Xe / Đời Xe</div>
            <div style="font-size:1.1rem; font-weight:700; color:#0f172a;">${d.vehicle}</div>
          </div>
        </div>

        <div>
          <div style="margin-bottom:1.25rem;">
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748b;">Chi Nhánh Thực Hiện</div>
            <div style="font-size:1rem; font-weight:700; color:#0f172a;">${d.branch}</div>
          </div>
          <div style="margin-bottom:1.25rem;">
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748b;">Thời Hạn Bảo Hành Đến</div>
            <div style="font-size:1.35rem; font-weight:900; color:#16a34a;">${d.warrantyUntil}</div>
          </div>
          <div>
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748b;">Kỹ Thuật Viên KCS Ký Duyệt</div>
            <div style="font-size:1rem; font-weight:700; color:#0f172a;"><i class="fa fa-user-check" style="color:#16a34a"></i> ${d.kcsStaff}</div>
          </div>
        </div>
      </div>

      <!-- Service History Table -->
      <h3 style="font-size:1.15rem; font-weight:800; color:#0f172a; margin-bottom:1rem; border-left:4px solid #dc2626; padding-left:0.75rem;">LỊCH SỬ THI CÔNG & HẠNG MỤC BẢO HÀNH</h3>
      <table style="width:100%; border-collapse:collapse; margin-bottom:2rem; font-size:0.90625rem;">
        <thead>
          <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
            <th style="padding:0.75rem 1rem; text-align:left;">Ngày</th>
            <th style="padding:0.75rem 1rem; text-align:left;">Số ODO</th>
            <th style="padding:0.75rem 1rem; text-align:left;">Nội Dung Kỹ Thuật</th>
            <th style="padding:0.75rem 1rem; text-align:left;">Hiệu Lực BH Đến</th>
          </tr>
        </thead>
        <tbody>
          ${d.history.map(h => `
            <tr style="border-bottom:1px solid #e2e8f0;">
              <td style="padding:0.75rem 1rem; font-weight:700;">${h.date}</td>
              <td style="padding:0.75rem 1rem; font-family:monospace;">${h.odo}</td>
              <td style="padding:0.75rem 1rem; font-weight:600; color:#0f172a;">${h.job}</td>
              <td style="padding:0.75rem 1rem; color:#16a34a; font-weight:700;">${h.warrantyTo}</td>
            </tr>
          `).join('')}
        </tbody>
      </table>

      <!-- Cert Footer with Print Button -->
      <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid #e2e8f0; padding-top:1.5rem; flex-wrap:wrap; gap:1rem;">
        <div style="font-size:0.8125rem; color:#64748b;">
          <i class="fa fa-shield-halved" style="color:#16a34a;"></i> Hồ sơ được bảo lưu điện tử vĩnh viễn trên toàn bộ gần 30 chi nhánh Hà Thành.
        </div>
        <button onclick="window.print()" style="padding:0.6rem 1.25rem; background:#0f172a; color:#fff; border:none; border-radius:8px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:0.5rem;">
          <i class="fa fa-print"></i> In chứng thư A4
        </button>
      </div>
    </div>
  `;
}

// Auto search default plate on load
window.addEventListener('DOMContentLoaded', () => {
  setWpSample('30H-888.88');
});
</script>

<?php get_footer(); ?>
