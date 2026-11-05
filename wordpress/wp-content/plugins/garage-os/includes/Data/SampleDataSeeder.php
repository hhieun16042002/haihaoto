<?php
namespace GarageOS\Data;

if (!defined('ABSPATH')) {
    exit;
}

class SampleDataSeeder {

    public static function seed() {
        global $wpdb;

        $table_bookings   = $wpdb->prefix . 'garage_bookings';
        $table_orders     = $wpdb->prefix . 'garage_work_orders';
        $table_warranties = $wpdb->prefix . 'garage_warranties';

        // Check if sample data already exists
        $count = $wpdb->get_var("SELECT COUNT(*) FROM $table_orders WHERE order_code = 'RO-2026-0902'");
        if ($count > 0) {
            return; // Already seeded
        }

        $now = current_time('mysql');
        $today = current_time('Y-m-d');

        // 1. Seed Bookings
        $sample_bookings = [
            [
                'booking_code'      => 'HG-BK-1001',
                'customer_name'     => 'Nguyễn Hoàng Long',
                'customer_phone'    => '0912345678',
                'customer_email'    => 'long.nguyen@example.com',
                'license_plate'     => '30H-888.88',
                'car_model'         => 'Mazda CX-5 2.0 Premium (2022)',
                'service_requested' => 'Sơn sấy hấp công nghệ cao & Bảo dưỡng 40,000km',
                'branch'            => 'Chi nhánh 01 - Cầu Giấy, Hà Nội',
                'booking_date'      => date('Y-m-d', strtotime('-5 days')),
                'booking_time'      => '08:30',
                'notes'             => 'Yêu cầu kiểm tra xước ba-đờ-sốc trước và bảo dưỡng mốc lớn 4 vạn.',
                'status'            => 'completed',
                'created_at'        => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            [
                'booking_code'      => 'HG-BK-1002',
                'customer_name'     => 'Trần Tuấn Dũng',
                'customer_phone'    => '0988776655',
                'customer_email'    => 'dung.tran@gmail.com',
                'license_plate'     => '51K-999.99',
                'car_model'         => 'Toyota Fortuner 2.8 Legender (2021)',
                'service_requested' => 'Bảo dưỡng gầm máy & Vệ sinh giàn lạnh điều hòa',
                'branch'            => 'Chi nhánh 02 - Long Biên, Hà Nội',
                'booking_date'      => date('Y-m-d', strtotime('-1 days')),
                'booking_time'      => '14:00',
                'notes'             => 'Xe đi đường đồi núi nhiều, gầm hơi kêu lọc cọc khi qua gờ giảm tốc.',
                'status'            => 'in_progress',
                'created_at'        => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'booking_code'      => 'HG-BK-1003',
                'customer_name'     => 'Phạm Minh Trí',
                'customer_phone'    => '0933221100',
                'customer_email'    => 'tri.pham@autocare.vn',
                'license_plate'     => '30F-123.45',
                'car_model'         => 'Hyundai SantaFe 2.2 Dầu (2023)',
                'service_requested' => 'Dán phim cách nhiệt 3M Crystalline & Phủ Ceramic Pro',
                'branch'            => 'Chi nhánh 01 - Cầu Giấy, Hà Nội',
                'booking_date'      => $today,
                'booking_time'      => '09:00',
                'notes'             => 'Khách đặt lịch trước 2 hôm, ưu tiên khoang Detailing phòng sạch.',
                'status'            => 'confirmed',
                'created_at'        => date('Y-m-d H:i:s', strtotime('-1 days')),
            ],
            [
                'booking_code'      => 'HG-BK-1004',
                'customer_name'     => 'Lê Thị Thu Hương',
                'customer_phone'    => '0905123456',
                'customer_email'    => 'huong.le@vietcombank.com',
                'license_plate'     => '29A-678.90',
                'car_model'         => 'Honda CR-V 1.5 Turbo L (2020)',
                'service_requested' => 'Sơn dặm cánh cửa sau phụ & Thay dầu động cơ Motul',
                'branch'            => 'Chi nhánh 03 - Hà Đông, Hà Nội',
                'booking_date'      => date('Y-m-d', strtotime('+1 days')),
                'booking_time'      => '10:30',
                'notes'             => 'Khách mang xe buổi sáng, cần lấy trong ngày.',
                'status'            => 'pending',
                'created_at'        => $now,
            ]
        ];

        foreach ($sample_bookings as $b) {
            $wpdb->insert($table_bookings, $b);
        }

        // 2. Seed Work Orders (RO - Repair Orders)
        // Order 1: 30H-888.88 (Completed, Has Warranty)
        $parts_order_1 = [
            [
                'name'     => 'Sơn sấy công nghệ cao cản trước (Bumper)',
                'type'     => 'labor',
                'quantity' => 1,
                'unit'     => 'Vị trí',
                'price'    => 1200000,
                'total'    => 1200000
            ],
            [
                'name'     => 'Dầu động cơ Idemitsu 0W-20 Fully Synthetic (4.2L)',
                'type'     => 'part',
                'quantity' => 1,
                'unit'     => 'Can 4L + 1L',
                'price'    => 950000,
                'total'    => 950000
            ],
            [
                'name'     => 'Lọc dầu nhớt động cơ chính hãng Mazda',
                'type'     => 'part',
                'quantity' => 1,
                'unit'     => 'Cái',
                'price'    => 180000,
                'total'    => 180000
            ],
            [
                'name'     => 'Lọc gió động cơ & lọc gió điều hòa than hoạt tính',
                'type'     => 'part',
                'quantity' => 2,
                'unit'     => 'Bộ',
                'price'    => 320000,
                'total'    => 640000
            ],
            [
                'name'     => 'Công bảo dưỡng định kỳ cấp 4 vạn (40,000km)',
                'type'     => 'labor',
                'quantity' => 1,
                'unit'     => 'Gói',
                'price'    => 650000,
                'total'    => 650000
            ]
        ];

        $labor_1 = 1200000 + 650000;
        $parts_1 = 950000 + 180000 + 640000;
        $discount_1 = 200000;
        $total_1 = ($labor_1 + $parts_1) - $discount_1;

        $order_id_1 = $wpdb->insert($table_orders, [
            'order_code'          => 'RO-2026-0891',
            'booking_id'          => 1,
            'customer_name'       => 'Nguyễn Hoàng Long',
            'customer_phone'      => '0912345678',
            'license_plate'       => '30H-888.88',
            'car_model'           => 'Mazda CX-5 2.0 Premium (2022)',
            'odo'                 => 40250,
            'reception_date'      => date('Y-m-d H:i:s', strtotime('-5 days 08:30:00')),
            'delivery_date'       => date('Y-m-d H:i:s', strtotime('-4 days 16:30:00')),
            'technician_lead'     => 'KTV Trưởng Phạm Văn Hiếu',
            'bay_number'          => 'Khoang Đồng Sơn 03',
            'service_description' => 'Sơn phục hồi ba-đờ-sốc cản trước, phòng sơn sấy hấp tiêu chuẩn Đức. Bảo dưỡng mốc 40,000 km toàn diện.',
            'parts_json'          => json_encode($parts_order_1, JSON_UNESCAPED_UNICODE),
            'labor_amount'        => $labor_1,
            'parts_amount'        => $parts_1,
            'discount_amount'     => $discount_1,
            'total_amount'        => $total_1,
            'payment_status'      => 'paid',
            'work_status'         => 'delivered',
            'notes'               => 'Khách hài lòng về độ bóng màu sơn đồng nhất 99.8%. Đã dán tem bảo dưỡng mốc tiếp theo 45,000km.',
            'created_at'          => date('Y-m-d H:i:s', strtotime('-5 days 08:45:00')),
            'updated_at'          => date('Y-m-d H:i:s', strtotime('-4 days 17:00:00')),
        ]);
        $order_1_insert_id = $wpdb->insert_id;

        // Order 2: 51K-999.99 (In Progress)
        $parts_order_2 = [
            [
                'name'     => 'Bảo dưỡng hệ thống phanh 4 bánh & láng đĩa phanh',
                'type'     => 'labor',
                'quantity' => 1,
                'unit'     => 'Bộ',
                'price'    => 800000,
                'total'    => 800000
            ],
            [
                'name'     => 'Rô-tuyn cân bằng trước trái/phải chính hãng',
                'type'     => 'part',
                'quantity' => 2,
                'unit'     => 'Cái',
                'price'    => 650000,
                'total'    => 1300000
            ],
            [
                'name'     => 'Vệ sinh nội soi giàn lạnh điều hòa ô tô bằng dung dịch Wurth',
                'type'     => 'labor',
                'quantity' => 1,
                'unit'     => 'Gói',
                'price'    => 750000,
                'total'    => 750000
            ]
        ];
        $labor_2 = 800000 + 750000;
        $parts_2 = 1300000;
        $total_2 = $labor_2 + $parts_2;

        $wpdb->insert($table_orders, [
            'order_code'          => 'RO-2026-0895',
            'booking_id'          => 2,
            'customer_name'       => 'Trần Tuấn Dũng',
            'customer_phone'      => '0988776655',
            'license_plate'       => '51K-999.99',
            'car_model'           => 'Toyota Fortuner 2.8 Legender (2021)',
            'odo'                 => 68500,
            'reception_date'      => date('Y-m-d H:i:s', strtotime('-1 days 14:15:00')),
            'delivery_date'       => null,
            'technician_lead'     => 'KTV Gầm Máy Trần Quốc Tuấn',
            'bay_number'          => 'Khoang Máy Gầm 02',
            'service_description' => 'Khắc phục tiếng kêu gầm trước, thay rô-tuyn cân bằng, nội soi giàn lạnh không tháo taplo.',
            'parts_json'          => json_encode($parts_order_2, JSON_UNESCAPED_UNICODE),
            'labor_amount'        => $labor_2,
            'parts_amount'        => $parts_2,
            'discount_amount'     => 0,
            'total_amount'        => $total_2,
            'payment_status'      => 'unpaid',
            'work_status'         => 'in_progress',
            'notes'               => 'Đang siết lực theo tiêu chuẩn Toyota Service Manual.',
            'created_at'          => date('Y-m-d H:i:s', strtotime('-1 days 14:30:00')),
            'updated_at'          => $now,
        ]);

        // Order 3: 30F-123.45 (Quality Inspection KCS)
        $parts_order_3 = [
            [
                'name'     => 'Gói dán phim cách nhiệt 3M Crystalline chính hãng toàn xe',
                'type'     => 'part_labor',
                'quantity' => 1,
                'unit'     => 'Xe SUV',
                'price'    => 14500000,
                'total'    => 14500000
            ],
            [
                'name'     => 'Phủ bóng sơn bảo vệ Ceramic Pro 9H 3 lớp',
                'type'     => 'labor',
                'quantity' => 1,
                'unit'     => 'Gói',
                'price'    => 4500000,
                'total'    => 4500000
            ]
        ];
        $total_3 = 19000000;
        $wpdb->insert($table_orders, [
            'order_code'          => 'RO-2026-0898',
            'booking_id'          => 3,
            'customer_name'       => 'Phạm Minh Trí',
            'customer_phone'      => '0933221100',
            'license_plate'       => '30F-123.45',
            'car_model'           => 'Hyundai SantaFe 2.2 Dầu (2023)',
            'odo'                 => 18200,
            'reception_date'      => date('Y-m-d H:i:s', strtotime('-6 hours')),
            'delivery_date'       => null,
            'technician_lead'     => 'Chuyên viên Detailing Vũ Hải',
            'bay_number'          => 'Phòng Detailing Vô Trùng',
            'service_description' => 'Dán phim 3M Crystalline cao cấp chống tia UV 99.9%, phủ bóng Ceramic Pro.',
            'parts_json'          => json_encode($parts_order_3, JSON_UNESCAPED_UNICODE),
            'labor_amount'        => 4500000,
            'parts_amount'        => 14500000,
            'discount_amount'     => 1000000,
            'total_amount'        => 18000000,
            'payment_status'      => 'deposit_paid',
            'work_status'         => 'quality_check',
            'notes'               => 'Đang rọi đèn kiểm tra độ trong của phim và hạt gợn Ceramic.',
            'created_at'          => date('Y-m-d H:i:s', strtotime('-6 hours')),
            'updated_at'          => $now,
        ]);

        // Order 4: 29A-678.90 (Receiving)
        $wpdb->insert($table_orders, [
            'order_code'          => 'RO-2026-0902',
            'booking_id'          => 4,
            'customer_name'       => 'Lê Thị Thu Hương',
            'customer_phone'      => '0905123456',
            'license_plate'       => '29A-678.90',
            'car_model'           => 'Honda CR-V 1.5 Turbo L (2020)',
            'odo'                 => 52300,
            'reception_date'      => $now,
            'delivery_date'       => null,
            'technician_lead'     => 'KTV Tiếp nhận Đỗ Nam',
            'bay_number'          => 'Cầu Nâng Tiếp Nhận 01',
            'service_description' => 'Sơn dặm cánh cửa sau phụ & Thay dầu động cơ Motul 5W30.',
            'parts_json'          => json_encode([], JSON_UNESCAPED_UNICODE),
            'labor_amount'        => 700000,
            'parts_amount'        => 850000,
            'discount_amount'     => 0,
            'total_amount'        => 1550000,
            'payment_status'      => 'unpaid',
            'work_status'         => 'receiving',
            'notes'               => 'Đang lập báo giá chi tiết và biên bản bàn giao xe.',
            'created_at'          => $now,
            'updated_at'          => $now,
        ]);

        // 3. Seed Warranties
        // Warranty 1: 30H-888.88 (Sơn sấy hấp công nghệ cao - Bảo hành 24 tháng)
        $wpdb->insert($table_warranties, [
            'warranty_code'   => 'WAR-30H888-01',
            'work_order_id'   => $order_1_insert_id ?: 1,
            'license_plate'   => '30H-888.88',
            'customer_name'   => 'Nguyễn Hoàng Long',
            'customer_phone'  => '0912345678',
            'item_type'       => 'paint',
            'item_name'       => 'Bảo hành chất lượng bề mặt sơn sấy hấp cản trước (Không bong tróc, bay màu, ố rộp)',
            'duration_months' => 24,
            'start_date'      => date('Y-m-d', strtotime('-4 days')),
            'end_date'        => date('Y-m-d', strtotime('+726 days')),
            'terms'           => 'Bảo hành 1 đổi 1 hoặc sơn lại 100% miễn phí nếu sơn có hiện tượng bong tróc, bạc màu do lỗi kỹ thuật xưởng.',
            'status'          => 'active',
            'created_at'      => date('Y-m-d H:i:s', strtotime('-4 days 17:00:00')),
        ]);

        // Warranty 2: 30H-888.88 (Bảo hành phụ tùng lọc & dầu động cơ - 6 tháng / 5000km)
        $wpdb->insert($table_warranties, [
            'warranty_code'   => 'WAR-30H888-02',
            'work_order_id'   => $order_1_insert_id ?: 1,
            'license_plate'   => '30H-888.88',
            'customer_name'   => 'Nguyễn Hoàng Long',
            'customer_phone'  => '0912345678',
            'item_type'       => 'part',
            'item_name'       => 'Bảo hành phụ tùng lọc dầu & gioăng phớt động cơ Mazda chính hãng',
            'duration_months' => 6,
            'start_date'      => date('Y-m-d', strtotime('-4 days')),
            'end_date'        => date('Y-m-d', strtotime('+176 days')),
            'terms'           => 'Cam kết phụ tùng chính hãng Mazda Nhật Bản, bảo hành rò rỉ nhớt và hư hỏng kỹ thuật.',
            'status'          => 'active',
            'created_at'      => date('Y-m-d H:i:s', strtotime('-4 days 17:00:00')),
        ]);

        // Warranty 3: 51K-999.99 (Bảo hành ắc quy Varta từ dịch vụ trước - 12 tháng)
        $wpdb->insert($table_warranties, [
            'warranty_code'   => 'WAR-51K999-01',
            'work_order_id'   => 0,
            'license_plate'   => '51K-999.99',
            'customer_name'   => 'Trần Tuấn Dũng',
            'customer_phone'  => '0988776655',
            'item_type'       => 'battery',
            'item_name'       => 'Ắc quy Varta AGM 80Ah (Germany) công nghệ Start-Stop',
            'duration_months' => 12,
            'start_date'      => date('Y-m-d', strtotime('-3 months')),
            'end_date'        => date('Y-m-d', strtotime('+9 months')),
            'terms'           => 'Bảo hành chính hãng 1 đổi 1 trong 12 tháng nếu sụt áp, không nạp điện do lỗi nhà sản xuất.',
            'status'          => 'active',
            'created_at'      => date('Y-m-d H:i:s', strtotime('-3 months')),
        ]);
    }
}
