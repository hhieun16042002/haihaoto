<?php
/**
 * Single Service Template
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
      <a href="<?php echo esc_url(home_url('/#dich-vu')); ?>" style="color:#64748b; text-decoration:none;">Dịch vụ kỹ thuật</a>
      <span style="margin:0 0.5rem; color:#cbd5e1;">/</span>
      <b style="color:#0f172a;"><?php the_title(); ?></b>
    </div>
  </div>

  <div class="container" style="margin-top:3rem; margin-bottom:5rem;">
    <div style="display:grid; grid-template-columns: 2fr 1fr; gap:2.5rem;" class="svc-layout-grid">
      <!-- Main Content -->
      <article style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:2.5rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08);">
        <?php if (has_post_thumbnail()) : ?>
          <div style="margin-bottom:2rem; border-radius:12px; overflow:hidden; max-height:400px;">
            <?php the_post_thumbnail('full', array('style' => 'width:100%; height:auto; object-fit:cover;')); ?>
          </div>
        <?php else: ?>
          <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=1200&q=80" alt="Dịch vụ ô tô" style="width:100%; height:380px; object-fit:cover; border-radius:12px; margin-bottom:2rem;">
        <?php endif; ?>

        <h1 style="font-size:2.25rem; font-weight:900; color:#0f172a; margin-bottom:1.25rem; line-height:1.2;">
          <?php the_title(); ?>
        </h1>

        <div class="entry-content" style="color:#334155; font-size:1.05rem; line-height:1.7;">
          <?php
          if (have_posts()) :
            while (have_posts()) : the_post();
              the_content();
            endwhile;
          else :
          ?>
            <p>Hà Thành Garage tự hào là đơn vị tiên phong ứng dụng phòng sơn sấy hồng ngoại đối lưu khí sạch chuẩn công nghệ Sikkens (Hà Lan) kết hợp máy đo pha màu quang phổ điện tử DuPont.</p>
            
            <h3 style="font-size:1.35rem; font-weight:800; color:#0f172a; margin:2rem 0 1rem;">Quy Trình 7 Bước Đồng Sơn Chuẩn Hãng</h3>
            <div style="display:flex; flex-direction:column; gap:1rem; margin-bottom:2rem;">
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">1</div>
                <div><b>Tiếp nhận & Giám định bề mặt:</b> Rửa xe sạch, tẩy nhựa đường, đo độ sâu vết xước bằng thiết bị chuyên dụng.</div>
              </div>
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">2</div>
                <div><b>Gò hàn giật tôn công nghệ cao:</b> Rút vết móp méo bằng máy hàn giật không phá hủy lớp chống rỉ bên trong thân vỏ.</div>
              </div>
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">3</div>
                <div><b>Sơn chống rỉ & Bả matit Sikkens:</b> Sử dụng bả siêu mịn khô nhanh, mài khô bằng máy hút bụi quỹ đạo không bụi bẩn.</div>
              </div>
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">4</div>
                <div><b>Pha màu vi tính quang phổ:</b> Độ chính xác 99.9% so với màu nguyên bản xuất xưởng của xe.</div>
              </div>
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">5</div>
                <div><b>Phun sơn lót & Sơn màu trong buồng kín:</b> Áp suất dương loại bỏ 100% bụi bẩn lơ lửng.</div>
              </div>
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">6</div>
                <div><b>Sấy đèn hồng ngoại sóng ngắn:</b> Khô sâu từ bên trong lớp sơn ra ngoài ở nhiệt độ ổn định 60 - 70°C.</div>
              </div>
              <div style="display:flex; gap:1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:1rem;">
                <div style="width:36px; height:36px; border-radius:50%; background:#dc2626; color:#fff; display:grid; place-items:center; font-weight:800; flex-shrink:0;">7</div>
                <div><b>Đánh bóng hoàn thiện & KCS bàn giao:</b> Kiểm tra độ bóng bề mặt và kích hoạt bảo hành điện tử.</div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </article>

      <!-- Sidebar -->
      <aside style="display:flex; flex-direction:column; gap:1.75rem;">
        <!-- Card 1: Fast Booking -->
        <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:2rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08);">
          <h3 style="font-size:1.2rem; font-weight:800; color:#0f172a; margin-bottom:1.25rem; border-bottom:2px solid #dc2626; padding-bottom:0.5rem;">
            ĐẶT LỊCH DỊCH VỤ NÀY
          </h3>
          <p style="font-size:0.875rem; color:#64748b; margin-bottom:1.25rem;">
            Ưu đãi giảm ngay 10% công thợ khi đặt hẹn trước online qua hệ thống.
          </p>
          <a href="<?php echo esc_url(home_url('/#dat-lich')); ?>" style="display:block; text-align:center; padding:0.85rem; background:#dc2626; color:#fff; border-radius:8px; font-weight:700; text-decoration:none;">
            <i class="fa fa-calendar-check"></i> Đặt hẹn giữ chỗ ngay
          </a>
        </div>

        <!-- Card 2: Hotline Support -->
        <div style="background:linear-gradient(135deg, #0f172a, #1e293b); color:#fff; border-radius:18px; padding:2rem;">
          <h3 style="font-size:1.15rem; font-weight:800; margin-bottom:0.75rem; color:#f59e0b;">
            <i class="fa fa-headset"></i> Cần Tư Vấn Kỹ Thuật?
          </h3>
          <p style="font-size:0.875rem; color:#cbd5e1; margin-bottom:1.25rem;">
            Đội ngũ chuyên gia kỹ thuật trưởng của Hà Thành sẵn sàng giải đáp 24/7.
          </p>
          <a href="tel:0568050505" style="display:inline-flex; align-items:center; gap:0.5rem; color:#fff; font-size:1.25rem; font-weight:900; text-decoration:none;">
            <i class="fa fa-phone-volume" style="color:#ef4444;"></i> 0568 05 0505
          </a>
        </div>

        <!-- Card 3: Other Services -->
        <div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:18px; padding:2rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.08);">
          <h3 style="font-size:1.15rem; font-weight:800; color:#0f172a; margin-bottom:1rem;">Dịch Vụ Nổi Bật Khác</h3>
          <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.75rem;">
            <li><a href="<?php echo esc_url(home_url('/dich-vu/bao-duong-30-buoc')); ?>" style="color:#334155; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.5rem;"><i class="fa fa-wrench" style="color:#dc2626"></i> Bảo dưỡng định kỳ 30 bước</a></li>
            <li><a href="<?php echo esc_url(home_url('/dich-vu/dai-tu-may-gam')); ?>" style="color:#334155; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.5rem;"><i class="fa fa-gears" style="color:#dc2626"></i> Sửa chữa & Đại tu máy gầm</a></li>
            <li><a href="<?php echo esc_url(home_url('/dich-vu/car-spa-ceramic')); ?>" style="color:#334155; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.5rem;"><i class="fa fa-gem" style="color:#dc2626"></i> Chăm sóc xe & Phủ Ceramic 9H</a></li>
            <li><a href="<?php echo esc_url(home_url('/dich-vu/cuu-ho-247')); ?>" style="color:#334155; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:0.5rem;"><i class="fa fa-truck-pickup" style="color:#dc2626"></i> Cứu hộ giao thông 24/7</a></li>
          </ul>
        </div>
      </aside>
    </div>
  </div>

</main>

<?php get_footer(); ?>
