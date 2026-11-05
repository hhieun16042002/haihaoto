<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Carpla Top Utility Bar -->
<div class="carpla-topbar">
    <div class="container carpla-topbar-inner">
        <div class="topbar-left" style="display: flex; gap: 20px; align-items: center;">
            <span class="topbar-badge">
                <i class="fa fa-shield-halved"></i> <?php _e('HỆ THỐNG XƯỞNG DỊCH VỤ Ô TÔ TIÊU CHUẨN TOÀN QUỐC', 'hieugara-motors'); ?>
            </span>
            <span style="color: rgba(255,255,255,0.2);">|</span>
            <span><i class="fa fa-clock" style="color: var(--brand-red);"></i> Giờ tiếp nhận: 08:00 - 18:00 (Cả Thứ 7 & Chủ Nhật)</span>
        </div>
        <div class="topbar-right" style="display: flex; gap: 16px; align-items: center;">
            <span><i class="fa fa-phone" style="color: var(--brand-red);"></i> Hotline Đặt Hẹn: <strong style="color: #ffffff;">1900 99 88 65</strong></span>
        </div>
    </div>
</div>

<!-- Main Corporate Header -->
<header class="carpla-header">
    <div class="container carpla-header-inner">
        <!-- Brand Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="carpla-brand">
            <div class="brand-badge-logo">H</div>
            <div>
                <div class="brand-title">HIẾU GARA <span>SERVICE</span></div>
                <div class="brand-subtitle"><?php _e('HỆ THỐNG XƯỞNG DỊCH VỤ Ô TÔ', 'hieugara-motors'); ?></div>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav>
            <ul class="carpla-nav">
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Trang chủ', 'hieugara-motors'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#dich-vu')); ?>"><?php _e('Dịch vụ chính', 'hieugara-motors'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#du-toan-son-xe')); ?>"><?php _e('Dự toán chi phí', 'hieugara-motors'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#quy-trinh-chuan')); ?>"><?php _e('Quy trình 6 bước', 'hieugara-motors'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#mang-luoi-xuong')); ?>"><?php _e('Mạng lưới xưởng', 'hieugara-motors'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/#lien-he')); ?>"><?php _e('Liên hệ', 'hieugara-motors'); ?></a></li>
            </ul>
        </nav>

        <!-- Right Booking Action -->
        <div style="display: flex; align-items: center; gap: 14px;">
            <a href="tel:0988567890" style="display: flex; flex-direction: column; text-align: right;">
                <small style="font-size: 0.6875rem; color: var(--slate-400); text-transform: uppercase; font-weight: 700;"><?php _e('Cứu hộ 24/7', 'hieugara-motors'); ?></small>
                <strong style="color: var(--brand-red); font-size: 0.9375rem;">0988.567.890</strong>
            </a>
            <a href="#dat-lich" class="btn-carpla btn-carpla-primary" data-open-modal="booking">
                <i class="fa fa-calendar-check"></i> <?php _e('ĐẶT LỊCH NGAY', 'hieugara-motors'); ?>
            </a>
        </div>
    </div>
</header>
