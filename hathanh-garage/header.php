<?php
/**
 * Header template for Hà Thành Garage
 *
 * @package HaThanh_Garage
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Topbar -->
<div class="ht-topbar">
  <div class="container">
    <div class="ht-topbar-left">
      <span class="sos-badge"><i class="fa fa-phone-volume"></i> CỨU HỘ 24/7: 0964.888.888</span>
      <span><i class="fa fa-clock" style="margin-right:6px; color:#f59e0b;"></i> Mở cửa: 8h00 - 18h00 (T2 - CN)</span>
      <span><i class="fa fa-map-location-dot" style="margin-right:6px; color:#e52e2e;"></i> Gần 30 chi nhánh toàn quốc</span>
    </div>
    <div class="ht-topbar-right">
      <a href="#tra-cuu"><i class="fa fa-shield-halved" style="color:#10b981; margin-right:4px;"></i> Tra cứu bảo hành điện tử</a>
      <a href="#lien-ket-bao-hiem"><i class="fa fa-handshake-angle" style="color:#f59e0b; margin-right:4px;"></i> Bảo hiểm liên kết</a>
      <a href="tel:0964888888" style="color:#fff; font-weight:700;"><i class="fa fa-headset"></i> CSKH: 1900.2805</a>
    </div>
  </div>
</div>

<!-- Main Header -->
<header class="ht-header">
  <div class="container">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="ht-logo">
      <div class="ht-logo-icon">
        <i class="fa fa-car-burst"></i>
      </div>
      <div class="ht-logo-text">
        <h2>HÀ THÀNH <span>GARAGE</span></h2>
        <p>Hệ thống sửa chữa & bảo dưỡng ô tô toàn quốc</p>
      </div>
    </a>

    <nav class="ht-nav">
      <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="active"><i class="fa fa-house"></i> Trang chủ</a></li>
        <li><a href="#dich-vu"><i class="fa fa-wrench"></i> Dịch vụ <i class="fa fa-chevron-down" style="font-size:10px;"></i></a></li>
        <li><a href="#du-toan"><i class="fa fa-calculator"></i> Bảng giá & Dự toán</a></li>
        <li><a href="#tra-cuu"><i class="fa fa-qrcode"></i> Bảo hành điện tử</a></li>
        <li><a href="#chi-nhanh"><i class="fa fa-location-dot"></i> Chi nhánh (30+)</a></li>
        <li><a href="#quy-trinh"><i class="fa fa-award"></i> Quy trình KCS</a></li>
      </ul>
    </nav>

    <div class="ht-header-actions">
      <a href="#tra-cuu" class="btn-ht btn-ht-outline">
        <i class="fa fa-magnifying-glass"></i> Tra cứu BH
      </a>
      <a href="#dat-lich" class="btn-ht btn-ht-primary">
        <i class="fa fa-calendar-check"></i> ĐẶT LỊCH NGAY
      </a>
    </div>
  </div>
</header>
