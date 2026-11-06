<?php
namespace GarageOS\Admin;

if (!defined('ABSPATH')) {
    exit;
}

class KanbanController {

    public static function get_columns() {
        return [
            'receiving'     => [
                'title' => '1. Tiếp Nhận Xe',
                'color' => '#64748b',
                'badge' => '#f1f5f9',
                'desc'  => 'Kiểm tra hiện trạng ban đầu & lập phiếu khám'
            ],
            'quotation'     => [
                'title' => '2. Khảo Sát Báo Giá',
                'color' => '#f59e0b',
                'badge' => '#fef3c7',
                'desc'  => 'Bóc tách vật tư phụ tùng & chờ khách duyệt'
            ],
            'in_progress'   => [
                'title' => '3. Đang Thi Công',
                'color' => '#3b82f6',
                'badge' => '#dbeafe',
                'desc'  => 'Kỹ thuật viên đang thực hiện trên khoang'
            ],
            'quality_check' => [
                'title' => '4. Kiểm Tra KCS',
                'color' => '#a855f7',
                'badge' => '#f3e8ff',
                'desc'  => 'Test máy, căn chỉnh thông số & rửa xe giao'
            ],
            'delivered'     => [
                'title' => '5. Đã Bàn Giao',
                'color' => '#10b981',
                'badge' => '#dcfce7',
                'desc'  => 'Kích hoạt sổ chứng thư bảo hành điện tử'
            ]
        ];
    }

    public static function get_workshop_bays() {
        return [
            // Khoang Tiếp Nhận
            'TN-01' => ['name' => 'Cầu Tiếp Nhận 01', 'type' => 'reception', 'icon' => 'dashicons-car', 'zone' => 'Khu Vực Đón Tiếp'],
            'TN-02' => ['name' => 'Cầu Tiếp Nhận 02', 'type' => 'reception', 'icon' => 'dashicons-car', 'zone' => 'Khu Vực Đón Tiếp'],

            // Khoang Máy Gầm
            'MG-01' => ['name' => 'Khoang Máy Gầm 01', 'type' => 'mechanic', 'icon' => 'dashicons-hammer', 'zone' => 'Khu Kỹ Thuật Máy Gầm'],
            'MG-02' => ['name' => 'Khoang Máy Gầm 02', 'type' => 'mechanic', 'icon' => 'dashicons-hammer', 'zone' => 'Khu Kỹ Thuật Máy Gầm'],
            'MG-03' => ['name' => 'Khoang Máy Gầm 03', 'type' => 'mechanic', 'icon' => 'dashicons-hammer', 'zone' => 'Khu Kỹ Thuật Máy Gầm'],
            'MG-04' => ['name' => 'Khoang Máy Gầm 04', 'type' => 'mechanic', 'icon' => 'dashicons-hammer', 'zone' => 'Khu Kỹ Thuật Máy Gầm'],

            // Buồng Sơn Sấy Đức
            'DS-01' => ['name' => 'Phòng Sơn Sấy 01 (Ý)', 'type' => 'paint', 'icon' => 'dashicons-art', 'zone' => 'Phòng Sơn Sấy Khép Kín'],
            'DS-02' => ['name' => 'Phòng Sơn Sấy 02 (Đức)', 'type' => 'paint', 'icon' => 'dashicons-art', 'zone' => 'Phòng Sơn Sấy Khép Kín'],
            'DS-03' => ['name' => 'Khoang Đồng Sơn 03', 'type' => 'paint', 'icon' => 'dashicons-art', 'zone' => 'Phòng Sơn Sấy Khép Kín'],

            // Detailing & Đo góc
            'DT-01' => ['name' => 'Phòng Detailing Vô Trùng', 'type' => 'detailing', 'icon' => 'dashicons-shield', 'zone' => 'Detailing & PPF Phòng Sạch'],
            'DT-02' => ['name' => 'Phòng Dán Phim Cách Nhiệt', 'type' => 'detailing', 'icon' => 'dashicons-shield', 'zone' => 'Detailing & PPF Phòng Sạch'],
            'HT-01' => ['name' => 'Cầu Cân Chỉnh Hunter 3D', 'type' => 'alignment', 'icon' => 'dashicons-performance', 'zone' => 'Căn Chỉnh Thước Lái & Lốp'],
        ];
    }

    public static function render() {
        global $wpdb;
        $table_orders = $wpdb->prefix . 'garage_work_orders';

        // Fetch orders
        $orders = $wpdb->get_results("SELECT * FROM $table_orders ORDER BY updated_at DESC");

        // Group by status
        $grouped = [
            'receiving'     => [],
            'quotation'     => [],
            'in_progress'   => [],
            'quality_check' => [],
            'delivered'     => []
        ];

        // Map bay occupancy
        $bay_occupancy = [];

        $total_revenue = 0;
        $in_workshop_count = 0;

        foreach ($orders as $order) {
            $st = $order->work_status;
            if (isset($grouped[$st])) {
                $grouped[$st][] = $order;
            } else {
                $grouped['receiving'][] = $order;
            }

            if ($st !== 'delivered') {
                $in_workshop_count++;
                // Match bay
                $bName = trim($order->bay_number);
                $bay_occupancy[$bName] = $order;
            }
            $total_revenue += intval($order->total_amount);
        }

        $columns = self::get_columns();
        $bays = self::get_workshop_bays();
        $total_bays = count($bays);
        $occupied_bays_count = count($bay_occupancy);
        $bay_capacity_rate = round(($occupied_bays_count / $total_bays) * 100);
        ?>
        <div class="wrap garage-os-wrap tesla-theme">
            <!-- Top Command Center Bar -->
            <div class="tesla-header-bar">
                <div class="tesla-brand-identity">
                    <div class="tesla-logo-mark">G</div>
                    <div>
                        <div class="tesla-app-tag">
                            <span class="live-pulse-dot"></span>
                            <span>CARPLA WORKSHOP OS &bull; LIVE CONNECTED</span>
                        </div>
                        <h1 class="tesla-main-title">Trung Tâm Điều Độ Khoang Xưởng Kỹ Thuật</h1>
                    </div>
                </div>

                <div class="tesla-nav-toggles">
                    <button type="button" class="view-toggle-btn active" data-view="kanban">
                        <span class="dashicons dashicons-columns"></span> Bảng Điều Độ (Kanban)
                    </button>
                    <button type="button" class="view-toggle-btn" data-view="floorplan">
                        <span class="dashicons dashicons-grid-view"></span> Sơ Đồ Mặt Bằng (12 Khoang)
                    </button>
                </div>

                <div class="tesla-quick-actions">
                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=new'); ?>" class="btn-tesla-primary">
                        <span class="dashicons dashicons-plus-alt2"></span> Mở Lệnh Sửa Chữa (RO)
                    </a>
                </div>
            </div>

            <!-- KPI Holographic HUD Row -->
            <div class="tesla-hud-row">
                <div class="hud-stat-box">
                    <div class="hud-stat-top">
                        <span class="hud-lbl">Xe Trong Xưởng</span>
                        <span class="hud-icon-pill icon-blue"><span class="dashicons dashicons-car"></span></span>
                    </div>
                    <div class="hud-stat-val"><?php echo $in_workshop_count; ?> <small>xe</small></div>
                    <div class="hud-stat-foot">Trên tổng 12 khoang cầu nâng</div>
                </div>

                <div class="hud-stat-box">
                    <div class="hud-stat-top">
                        <span class="hud-lbl">Công Suất Khoang</span>
                        <span class="hud-icon-pill icon-gold"><span class="dashicons dashicons-dashboard"></span></span>
                    </div>
                    <div class="hud-stat-val"><?php echo $bay_capacity_rate; ?>% <small>sử dụng</small></div>
                    <div class="hud-progress-track">
                        <div class="hud-progress-fill" style="width: <?php echo min(100, $bay_capacity_rate); ?>%;"></div>
                    </div>
                </div>

                <div class="hud-stat-box">
                    <div class="hud-stat-top">
                        <span class="hud-lbl">Chờ KCS & Bàn Giao</span>
                        <span class="hud-icon-pill icon-purple"><span class="dashicons dashicons-yes-alt"></span></span>
                    </div>
                    <div class="hud-stat-val"><?php echo count($grouped['quality_check']); ?> <small>xe</small></div>
                    <div class="hud-stat-foot">Đang kiểm định chất lượng cuối</div>
                </div>

                <div class="hud-stat-box">
                    <div class="hud-stat-top">
                        <span class="hud-lbl">Doanh Thu Đang Xử Lý</span>
                        <span class="hud-icon-pill icon-green"><span class="dashicons dashicons-money-alt"></span></span>
                    </div>
                    <div class="hud-stat-val"><?php echo number_format($total_revenue, 0, ',', '.'); ?> <small>đ</small></div>
                    <div class="hud-stat-foot">Bao gồm vật tư phụ tùng & công thợ</div>
                </div>
            </div>

            <!-- VIEW 1: INTERACTIVE KANBAN BOARD (DRAG & DROP) -->
            <div id="view-kanban-board" class="workspace-view active">
                <div class="garage-kanban-board">
                    <?php foreach ($columns as $status_key => $col): 
                        $col_orders = $grouped[$status_key];
                        $col_count = count($col_orders);
                    ?>
                        <div class="kanban-column" data-status="<?php echo esc_attr($status_key); ?>">
                            <div class="kanban-column-header" style="border-top-color: <?php echo esc_attr($col['color']); ?>;">
                                <div class="kanban-col-title-wrap">
                                    <h3 class="kanban-col-title"><?php echo esc_html($col['title']); ?></h3>
                                    <span class="kanban-col-count" style="background:<?php echo esc_attr($col['badge']); ?>;color:<?php echo esc_attr($col['color']); ?>;"><?php echo $col_count; ?></span>
                                </div>
                                <span class="kanban-col-desc"><?php echo esc_html($col['desc']); ?></span>
                            </div>

                            <div class="kanban-column-body drop-zone" id="col-<?php echo esc_attr($status_key); ?>" data-status="<?php echo esc_attr($status_key); ?>">
                                <?php if (empty($col_orders)): ?>
                                    <div class="kanban-empty"><span class="dashicons dashicons-marker"></span> Thả xe vào đây để chuyển bước</div>
                                <?php else: ?>
                                    <?php foreach ($col_orders as $order): 
                                        $parts = json_decode($order->parts_json, true) ?: [];
                                    ?>
                                        <div class="kanban-card" 
                                             draggable="true" 
                                             data-order-id="<?php echo esc_attr($order->id); ?>" 
                                             data-order-code="<?php echo esc_attr($order->order_code); ?>">
                                            
                                            <div class="card-drag-handle" title="Kéo thả thẻ xe sang khoang khác">
                                                <span class="dashicons dashicons-move"></span>
                                            </div>

                                            <div class="card-top-bar">
                                                <span class="plate-badge"><?php echo esc_html($order->license_plate); ?></span>
                                                <span class="ro-code"><?php echo esc_html($order->order_code); ?></span>
                                            </div>

                                            <h4 class="car-title"><?php echo esc_html($order->car_model); ?></h4>
                                            <p class="service-brief"><?php echo esc_html(wp_trim_words($order->service_description, 14, '...')); ?></p>

                                            <div class="card-meta">
                                                <div class="meta-row">
                                                    <span class="dashicons dashicons-admin-users"></span>
                                                    <span><strong><?php echo esc_html($order->customer_name); ?></strong> (<?php echo esc_html($order->customer_phone); ?>)</span>
                                                </div>
                                                <div class="meta-row">
                                                    <span class="dashicons dashicons-location"></span>
                                                    <span class="meta-bay"><?php echo esc_html($order->bay_number); ?></span>
                                                    <span class="meta-tech">&bull; <?php echo esc_html($order->technician_lead); ?></span>
                                                </div>
                                                <div class="meta-row meta-price-row">
                                                    <span class="dashicons dashicons-money-alt"></span>
                                                    <span class="price-val"><?php echo number_format($order->total_amount, 0, ',', '.'); ?> đ</span>
                                                    <span class="pay-badge pay-<?php echo esc_attr($order->payment_status); ?>">
                                                        <?php 
                                                            $pay_labels = [
                                                                'unpaid'       => 'Chưa thanh toán',
                                                                'deposit_paid' => 'Đã cọc',
                                                                'paid'         => 'Đã trả'
                                                            ];
                                                            echo $pay_labels[$order->payment_status] ?? $order->payment_status;
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="card-actions">
                                                <div class="status-quick-switch">
                                                    <label>Bước:</label>
                                                    <select class="change-status-select" data-id="<?php echo esc_attr($order->id); ?>">
                                                        <?php foreach ($columns as $s_k => $s_c): ?>
                                                            <option value="<?php echo esc_attr($s_k); ?>" <?php selected($s_k, $order->work_status); ?>>
                                                                <?php echo esc_html($s_c['title']); ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="action-buttons">
                                                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=edit&id=' . $order->id); ?>" class="btn-icon" title="Chi tiết Lệnh sửa chữa">
                                                        <span class="dashicons dashicons-edit"></span>
                                                    </a>
                                                    <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=print&id=' . $order->id); ?>" target="_blank" class="btn-icon" title="In Phiếu / Báo Giá">
                                                        <span class="dashicons dashicons-printer"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- VIEW 2: INTERACTIVE WORKSHOP BAY FLOORPLAN MAP -->
            <div id="view-floorplan-map" class="workspace-view" style="display:none;">
                <div class="tesla-bay-map-container">
                    <div class="bay-map-header">
                        <div>
                            <h3 class="bay-map-title"><span class="dashicons dashicons-building"></span> Sơ Đồ Không Gian Mặt Bằng Xưởng Dịch Vụ Hải Hà ÔTô</h3>
                            <p class="bay-map-sub">Giám sát trạng thái hoạt động thực tế của từng cầu nâng và phòng sơn sấy.</p>
                        </div>
                        <div class="bay-legend">
                            <span class="legend-item"><span class="legend-dot dot-green"></span> Trống (Sẵn sàng)</span>
                            <span class="legend-item"><span class="legend-dot dot-blue"></span> Đang thi công</span>
                            <span class="legend-item"><span class="legend-dot dot-purple"></span> Đang KCS</span>
                        </div>
                    </div>

                    <div class="bay-grid-layout">
                        <?php foreach ($bays as $code => $bay): 
                            // Match occupancy
                            $occupant = null;
                            foreach ($bay_occupancy as $bName => $ord) {
                                if (stripos($bName, $bay['name']) !== false || stripos($bay['name'], $bName) !== false) {
                                    $occupant = $ord;
                                    break;
                                }
                            }
                            $is_busy = ($occupant !== null);
                            $state_class = $is_busy ? 'bay-busy status-' . $occupant->work_status : 'bay-free';
                        ?>
                            <div class="workshop-bay-slot <?php echo esc_attr($state_class); ?>">
                                <div class="slot-top">
                                    <span class="slot-code"><?php echo esc_html($code); ?></span>
                                    <span class="slot-status-indicator">
                                        <?php echo $is_busy ? 'CÓ XE' : 'TRỐNG'; ?>
                                    </span>
                                </div>

                                <div class="slot-bay-name">
                                    <span class="dashicons <?php echo esc_attr($bay['icon']); ?>"></span>
                                    <strong><?php echo esc_html($bay['name']); ?></strong>
                                </div>
                                <div class="slot-zone-tag"><?php echo esc_html($bay['zone']); ?></div>

                                <?php if ($is_busy): ?>
                                    <div class="slot-car-card">
                                        <div class="slot-plate-wrap">
                                            <span class="plate-badge"><?php echo esc_html($occupant->license_plate); ?></span>
                                            <span class="slot-ro"><?php echo esc_html($occupant->order_code); ?></span>
                                        </div>
                                        <div class="slot-car-model"><?php echo esc_html($occupant->car_model); ?></div>
                                        <div class="slot-tech-info">
                                            <span class="dashicons dashicons-admin-users"></span> <?php echo esc_html($occupant->technician_lead); ?>
                                        </div>
                                        <div class="slot-foot-action">
                                            <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=edit&id=' . $occupant->id); ?>" class="slot-btn-view">
                                                Xem Lệnh (RO) &rarr;
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="slot-empty-state">
                                        <span class="dashicons dashicons-yes-alt"></span>
                                        <span>Cầu nâng sẵn sàng nhận xe</span>
                                        <a href="<?php echo admin_url('admin.php?page=garage-os-orders&action=new'); ?>" class="slot-btn-assign">
                                            + Đưa Xe Vào Khoang
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
