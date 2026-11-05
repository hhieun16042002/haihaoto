<?php
/**
 * Template Name: Hệ Thống 27+ Chi Nhánh
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
      <b style="color:#0f172a;">Hệ thống 27+ Chi nhánh</b>
    </div>
  </div>

  <!-- Hero Header -->
  <div style="background:linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); padding:3.5rem 0 2.5rem; text-align:center; border-bottom:1px solid #e2e8f0;">
    <div class="container">
      <span style="font-size:0.8125rem; font-weight:700; color:#dc2626; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:0.5rem; display:block;">MẠNG LƯỚI PHỦ SÓNG TOÀN QUỐC</span>
      <h1 style="font-size:2.5rem; font-weight:900; color:#0f172a; margin-bottom:0.85rem; letter-spacing:-0.02em;">Hệ Thống 27+ Chi Nhánh Hà Thành Garage</h1>
      <p style="max-width:680px; margin:0 auto; color:#64748b; font-size:1.05rem; line-height:1.6;">
        Tìm kiếm trạm dịch vụ gần bạn nhất tại Hà Nội, Hải Phòng, Quảng Ninh, TP. Hồ Chí Minh với trang thiết bị phòng sơn sấy và máy chẩn đoán đồng bộ 100%.
      </p>
    </div>
  </div>

  <!-- Filter Buttons -->
  <div class="container" style="margin-top:2.5rem; margin-bottom:5rem;">
    <div style="display:flex; justify-content:center; gap:0.75rem; margin-bottom:3rem; flex-wrap:wrap;">
      <button class="branch-filter-btn active" onclick="filterWpB('all', this)" style="padding:0.65rem 1.35rem; border-radius:30px; background:#dc2626; color:#fff; border:1.5px solid #dc2626; font-weight:700; cursor:pointer;">Tất cả (27 Chi nhánh)</button>
      <button class="branch-filter-btn" onclick="filterWpB('hn', this)" style="padding:0.65rem 1.35rem; border-radius:30px; background:#fff; color:#64748b; border:1.5px solid #cbd5e1; font-weight:700; cursor:pointer;">Khu vực Hà Nội (10 trạm)</button>
      <button class="branch-filter-btn" onclick="filterWpB('hp', this)" style="padding:0.65rem 1.35rem; border-radius:30px; background:#fff; color:#64748b; border:1.5px solid #cbd5e1; font-weight:700; cursor:pointer;">Hải Phòng (3 trạm)</button>
      <button class="branch-filter-btn" onclick="filterWpB('qn', this)" style="padding:0.65rem 1.35rem; border-radius:30px; background:#fff; color:#64748b; border:1.5px solid #cbd5e1; font-weight:700; cursor:pointer;">Quảng Ninh (3 trạm)</button>
      <button class="branch-filter-btn" onclick="filterWpB('mn', this)" style="padding:0.65rem 1.35rem; border-radius:30px; background:#fff; color:#64748b; border:1.5px solid #cbd5e1; font-weight:700; cursor:pointer;">TP. Hồ Chí Minh & Miền Nam</button>
    </div>

    <!-- Branches Grid -->
    <div id="wpBranchGrid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(350px, 1fr)); gap:1.75rem;">
      <!-- Card 1 -->
      <div class="wp-bcard" data-r="hn" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:1.75rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); display:flex; flex-direction:column; justify-content:space-between;">
        <div>
          <span style="font-size:0.6875rem; font-weight:700; color:#d97706; text-transform:uppercase; margin-bottom:0.4rem; display:block;">TRỤ SỞ CHÍNH HÀ THÀNH</span>
          <div style="font-size:1.25rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Hà Thành 01 - Tây Hồ (HN)</div>
          <div style="font-size:0.875rem; color:#64748b; line-height:1.5; margin-bottom:1rem;">Số 500 Võ Chí Công, P. Xuân La, Q. Tây Hồ, Hà Nội. Khuôn viên 2.000m², 6 buồng sơn sấy hồng ngoại.</div>
          <div style="font-size:0.9375rem; font-weight:700; color:#dc2626; margin-bottom:1.25rem;"><i class="fa fa-phone"></i> 0945 86 0505</div>
        </div>
        <div style="display:flex; gap:0.75rem; border-top:1px solid #e2e8f0; padding-top:1rem;">
          <a href="tel:0945860505" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#dc2626; color:#fff; text-decoration:none;"><i class="fa fa-phone"></i> Gọi ngay</a>
          <a href="https://maps.google.com" target="_blank" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#f8fafc; border:1px solid #cbd5e1; color:#0f172a; text-decoration:none;"><i class="fa fa-location-arrow"></i> Bản đồ</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="wp-bcard" data-r="hn" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:1.75rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); display:flex; flex-direction:column; justify-content:space-between;">
        <div>
          <span style="font-size:0.6875rem; font-weight:700; color:#d97706; text-transform:uppercase; margin-bottom:0.4rem; display:block;">CHI NHÁNH HOÀNG MAI</span>
          <div style="font-size:1.25rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Hà Thành 02 - Hoàng Mai (HN)</div>
          <div style="font-size:0.875rem; color:#64748b; line-height:1.5; margin-bottom:1rem;">Số 300 Trần Điền, P. Định Công, Q. Hoàng Mai, Hà Nội. Chuyên đại tu máy gầm & sơn sấy.</div>
          <div style="font-size:0.9375rem; font-weight:700; color:#dc2626; margin-bottom:1.25rem;"><i class="fa fa-phone"></i> 0916 86 0505</div>
        </div>
        <div style="display:flex; gap:0.75rem; border-top:1px solid #e2e8f0; padding-top:1rem;">
          <a href="tel:0916860505" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#dc2626; color:#fff; text-decoration:none;"><i class="fa fa-phone"></i> Gọi ngay</a>
          <a href="https://maps.google.com" target="_blank" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#f8fafc; border:1px solid #cbd5e1; color:#0f172a; text-decoration:none;"><i class="fa fa-location-arrow"></i> Bản đồ</a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="wp-bcard" data-r="hn" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:1.75rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); display:flex; flex-direction:column; justify-content:space-between;">
        <div>
          <span style="font-size:0.6875rem; font-weight:700; color:#d97706; text-transform:uppercase; margin-bottom:0.4rem; display:block;">CHI NHÁNH LONG BIÊN</span>
          <div style="font-size:1.25rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Hà Thành 22 - Long Biên (HN)</div>
          <div style="font-size:0.875rem; color:#64748b; line-height:1.5; margin-bottom:1rem;">Số 8 Thạch Bàn, Q. Long Biên, Hà Nội. Điểm hẹn thuận tiện phía Đông Thủ đô.</div>
          <div style="font-size:0.9375rem; font-weight:700; color:#dc2626; margin-bottom:1.25rem;"><i class="fa fa-phone"></i> 0912 86 0505</div>
        </div>
        <div style="display:flex; gap:0.75rem; border-top:1px solid #e2e8f0; padding-top:1rem;">
          <a href="tel:0912860505" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#dc2626; color:#fff; text-decoration:none;"><i class="fa fa-phone"></i> Gọi ngay</a>
          <a href="https://maps.google.com" target="_blank" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#f8fafc; border:1px solid #cbd5e1; color:#0f172a; text-decoration:none;"><i class="fa fa-location-arrow"></i> Bản đồ</a>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="wp-bcard" data-r="hp" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:1.75rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); display:flex; flex-direction:column; justify-content:space-between;">
        <div>
          <span style="font-size:0.6875rem; font-weight:700; color:#d97706; text-transform:uppercase; margin-bottom:0.4rem; display:block;">CHI NHÁNH HẢI PHÒNG</span>
          <div style="font-size:1.25rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Hà Thành 05 - Lê Hồng Phong (HP)</div>
          <div style="font-size:0.875rem; color:#64748b; line-height:1.5; margin-bottom:1rem;">Số 18 Lô 22B Lê Hồng Phong, Đông Khê, Ngô Quyền, TP. Hải Phòng.</div>
          <div style="font-size:0.9375rem; font-weight:700; color:#dc2626; margin-bottom:1.25rem;"><i class="fa fa-phone"></i> 0915 86 0505</div>
        </div>
        <div style="display:flex; gap:0.75rem; border-top:1px solid #e2e8f0; padding-top:1rem;">
          <a href="tel:0915860505" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#dc2626; color:#fff; text-decoration:none;"><i class="fa fa-phone"></i> Gọi ngay</a>
          <a href="https://maps.google.com" target="_blank" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#f8fafc; border:1px solid #cbd5e1; color:#0f172a; text-decoration:none;"><i class="fa fa-location-arrow"></i> Bản đồ</a>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="wp-bcard" data-r="qn" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:1.75rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); display:flex; flex-direction:column; justify-content:space-between;">
        <div>
          <span style="font-size:0.6875rem; font-weight:700; color:#d97706; text-transform:uppercase; margin-bottom:0.4rem; display:block;">CHI NHÁNH QUẢNG NINH</span>
          <div style="font-size:1.25rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Hà Thành 12 - Hạ Long (QN)</div>
          <div style="font-size:0.875rem; color:#64748b; line-height:1.5; margin-bottom:1rem;">KĐT Mới Cao Xanh, Hà Khánh B, TP. Hạ Long, Tỉnh Quảng Ninh.</div>
          <div style="font-size:0.9375rem; font-weight:700; color:#dc2626; margin-bottom:1.25rem;"><i class="fa fa-phone"></i> 0918 86 0505</div>
        </div>
        <div style="display:flex; gap:0.75rem; border-top:1px solid #e2e8f0; padding-top:1rem;">
          <a href="tel:0918860505" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#dc2626; color:#fff; text-decoration:none;"><i class="fa fa-phone"></i> Gọi ngay</a>
          <a href="https://maps.google.com" target="_blank" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#f8fafc; border:1px solid #cbd5e1; color:#0f172a; text-decoration:none;"><i class="fa fa-location-arrow"></i> Bản đồ</a>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="wp-bcard" data-r="mn" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; padding:1.75rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08); display:flex; flex-direction:column; justify-content:space-between;">
        <div>
          <span style="font-size:0.6875rem; font-weight:700; color:#d97706; text-transform:uppercase; margin-bottom:0.4rem; display:block;">CHI NHÁNH TP. HỒ CHÍ MINH</span>
          <div style="font-size:1.25rem; font-weight:800; color:#0f172a; margin-bottom:0.5rem;">Hà Thành 27 - Bình Thạnh (HCM)</div>
          <div style="font-size:0.875rem; color:#64748b; line-height:1.5; margin-bottom:1rem;">Số 28 Phan Chu Trinh, Phường 12, Quận Bình Thạnh, TP. Hồ Chí Minh.</div>
          <div style="font-size:0.9375rem; font-weight:700; color:#dc2626; margin-bottom:1.25rem;"><i class="fa fa-phone"></i> 0919 86 0505</div>
        </div>
        <div style="display:flex; gap:0.75rem; border-top:1px solid #e2e8f0; padding-top:1rem;">
          <a href="tel:0919860505" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#dc2626; color:#fff; text-decoration:none;"><i class="fa fa-phone"></i> Gọi ngay</a>
          <a href="https://maps.google.com" target="_blank" style="flex:1; height:40px; display:flex; align-items:center; justify-content:center; gap:0.4rem; border-radius:6px; font-weight:700; font-size:0.8125rem; background:#f8fafc; border:1px solid #cbd5e1; color:#0f172a; text-decoration:none;"><i class="fa fa-location-arrow"></i> Bản đồ</a>
        </div>
      </div>
    </div>
  </div>

</main>

<script>
function filterWpB(region, btn) {
  document.querySelectorAll('.branch-filter-btn').forEach(b => {
    b.style.background = '#fff';
    b.style.color = '#64748b';
    b.style.borderColor = '#cbd5e1';
  });
  btn.style.background = '#dc2626';
  btn.style.color = '#fff';
  btn.style.borderColor = '#dc2626';

  document.querySelectorAll('.wp-bcard').forEach(card => {
    if (region === 'all' || card.getAttribute('data-r') === region) {
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}
</script>

<?php get_footer(); ?>
