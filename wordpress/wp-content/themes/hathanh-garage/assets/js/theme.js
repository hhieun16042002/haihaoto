/**
 * Hà Thành Garage Premium Interactive JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
  /* 1. HERO ENGINE TABS SWITCHER (Booking vs Warranty Lookup) */
  const tabBtns = document.querySelectorAll('.engine-tab-btn');
  const tabBooking = document.getElementById('tab-booking');
  const tabWarranty = document.getElementById('tab-warranty');

  if (tabBtns.length && tabBooking && tabWarranty) {
    tabBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        tabBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const target = this.getAttribute('data-tab');
        if (target === 'booking') {
          tabBooking.style.display = 'block';
          tabWarranty.style.display = 'none';
        } else {
          tabBooking.style.display = 'none';
          tabWarranty.style.display = 'block';
        }
      });
    });
  }

  /* 2. REAL-TIME WARRANTY LOOKUP ENGINE */
  const warrantyBtn = document.getElementById('btn-warranty-search');
  const warrantyInput = document.getElementById('warranty-plate-input');
  const warrantyResult = document.getElementById('warranty-result-box');

  const SAMPLE_WARRANTY_DB = {
    '30H-888.88': {
      plate: '30H-888.88',
      owner: 'Nguyễn Văn Hùng',
      car: 'Mercedes-Benz GLC 300 (2022)',
      branch: 'Cơ sở 01 - Võ Chí Công, Tây Hồ, Hà Nội',
      dateOut: '15/10/2026',
      currentKm: '38.500 km',
      items: [
        { name: 'Sơn quây đổi màu cao cấp Dupont', exp: '15/10/2028 (24 tháng)', status: 'active' },
        { name: 'Đại tu hộp số 9G-Tronic & thay dầu tuần hoàn', exp: '15/10/2027 (12 tháng)', status: 'active' },
        { name: 'Bộ má phanh gốm & đĩa phanh Brembo', exp: '15/10/2027 (12 tháng)', status: 'active' },
        { name: 'Gói phủ bóng Ceramic 9H Double Pro', exp: '15/10/2027 (12 tháng)', status: 'active' }
      ]
    },
    '51K-999.99': {
      plate: '51K-999.99',
      owner: 'Trần Minh Quân',
      car: 'Porsche Panamera 4S (2023)',
      branch: 'Cơ sở Miền Nam - TP. Thủ Đức, TP.HCM',
      dateOut: '20/09/2026',
      currentKm: '22.000 km',
      items: [
        { name: 'Bảo dưỡng cấp 20.000km toàn diện', exp: '20/03/2027 (6 tháng)', status: 'active' },
        { name: 'Dán phim cách nhiệt 3M Crystalline', exp: '20/09/2036 (10 năm)', status: 'active' },
        { name: 'Căn chỉnh độ chụm bánh xe 3D vi tính', exp: '20/12/2026 (3 tháng)', status: 'active' }
      ]
    },
    '14A-666.88': {
      plate: '14A-666.88',
      owner: 'Lê Hoàng Long',
      car: 'Toyota Land Cruiser Prado',
      branch: 'Cơ sở Hạ Long - Bãi Cháy, Quảng Ninh',
      dateOut: '05/08/2026',
      currentKm: '65.000 km',
      items: [
        { name: 'Phục hồi va chạm gò nắn bệ sắt xi vi tính', exp: '05/08/2027 (12 tháng)', status: 'active' },
        { name: 'Sơn bóng phủ cản trước & tai xe', exp: '05/08/2028 (24 tháng)', status: 'active' }
      ]
    }
  };

  if (warrantyBtn && warrantyInput && warrantyResult) {
    warrantyBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const val = warrantyInput.value.trim().toUpperCase();
      if (!val) {
        alert('Vui lòng nhập Biển số xe cần tra cứu (VD: 30H-888.88 hoặc 51K-999.99)');
        return;
      }

      const match = SAMPLE_WARRANTY_DB[val] || {
        plate: val,
        owner: 'Khách hàng VIP',
        car: 'Xe ô tô tiêu chuẩn',
        branch: 'Hệ thống Toàn quốc Hà Thành Garage',
        dateOut: '01/11/2026',
        currentKm: '30.000 km',
        items: [
          { name: 'Gói bảo dưỡng định kỳ & kiểm định an toàn 30 bước', exp: '01/05/2027 (6 tháng)', status: 'active' },
          { name: 'Bảo hành phụ tùng thay thế chính hãng', exp: '01/11/2027 (12 tháng)', status: 'active' }
        ]
      };

      let itemsHtml = '';
      match.items.forEach(it => {
        itemsHtml += `
          <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.08); font-size:0.875rem;">
            <span><i class="fa fa-shield-check" style="color:#10b981; margin-right:8px;"></i>${it.name}</span>
            <span style="color:#f59e0b; font-weight:700;">Hạn: ${it.exp}</span>
          </div>
        `;
      });

      warrantyResult.innerHTML = `
        <div style="background:#0a1628; border:1px solid #10b981; border-radius:12px; padding:20px; margin-top:20px; color:#fff;">
          <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid rgba(255,255,255,0.12); padding-bottom:12px; margin-bottom:12px;">
            <div>
              <span style="font-size:0.75rem; text-transform:uppercase; color:#94a3b8;">Chứng Nhận Bảo Hành Điện Tử</span>
              <h3 style="color:#f59e0b; font-family:'Barlow Condensed', sans-serif; font-size:1.75rem; line-height:1; margin-top:4px;">${match.plate}</h3>
            </div>
            <span style="background:#10b981; color:#fff; padding:4px 12px; border-radius:9999px; font-size:0.75rem; font-weight:700;"><i class="fa fa-check-circle"></i> ĐANG HIỆU LỰC TOÀN QUỐC</span>
          </div>
          <div style="font-size:0.875rem; color:#cbd5e1; margin-bottom:14px; line-height:1.6;">
            <div><strong>Chủ xe:</strong> ${match.owner} | <strong>Dòng xe:</strong> ${match.car}</div>
            <div><strong>Cơ sở thực hiện:</strong> ${match.branch}</div>
            <div><strong>Ngày xuất xưởng:</strong> ${match.dateOut} | <strong>Số Km:</strong> ${match.currentKm}</div>
          </div>
          <div style="background:rgba(255,255,255,0.04); border-radius:8px; padding:12px;">
            <strong style="font-size:0.8125rem; color:#94a3b8; text-transform:uppercase; display:block; margin-bottom:6px;">Danh mục chi tiết được bảo hành:</strong>
            ${itemsHtml}
          </div>
          <p style="font-size:0.75rem; color:#94a3b8; margin-top:12px; text-align:center;">
            * Thẻ bảo hành điện tử được chấp nhận tại gần 30 chi nhánh Hà Thành Garage trên toàn quốc.
          </p>
        </div>
      `;
      warrantyResult.style.display = 'block';
    });
  }

  /* 3. MAINTENANCE COST ESTIMATOR CALCULATOR */
  let currentSegment = 'sedan';
  let currentKm = '10000';

  const SEGMENT_PRICES = {
    'sedan': {
      '5000': { total: '750.000 đ', items: ['Thay dầu động cơ tổng hợp cao cấp', 'Kiểm tra 30 hạng mục khung gầm & lốp', 'Vệ sinh lọc gió động cơ & điều hòa'] },
      '10000': { total: '1.450.000 đ', items: ['Thay dầu động cơ tổng hợp', 'Thay lọc dầu chính hãng', 'Vệ sinh má phanh 4 bánh', 'Đảo lốp & kiểm tra áp suất', 'Kiểm tra 30 hạng mục chuyên sâu'] },
      '20000': { total: '2.850.000 đ', items: ['Thay dầu động cơ & lọc dầu', 'Thay lọc gió động cơ', 'Thay lọc gió điều hòa than hoạt tính', 'Bảo dưỡng phanh 4 bánh', 'Vệ sinh kim phun & buồng đốt'] },
      '40000': { total: '5.900.000 đ', items: ['Bảo dưỡng lớn cấp 4 vạn', 'Thay dầu phanh & dầu trợ lực', 'Thay nước làm mát động cơ', 'Thay bugi đánh lửa Iridium', 'Bảo dưỡng máy đề, củ phát', 'Căn chỉnh góc lái 3D'] }
    },
    'suv': {
      '5000': { total: '950.000 đ', items: ['Thay dầu động cơ 6L chuyên dụng', 'Kiểm tra gầm bệ tải nặng', 'Vệ sinh lọc gió'] },
      '10000': { total: '1.850.000 đ', items: ['Thay dầu động cơ & lọc dầu', 'Bảo dưỡng phanh 4 bánh SUV', 'Kiểm tra thước lái & rotuyn', 'Đảo lốp bánh lớn'] },
      '20000': { total: '3.650.000 đ', items: ['Thay dầu máy + lọc nhớt', 'Thay lọc gió động cơ + cabin', 'Thay dầu vi sai cầu trước/sau', 'Vệ sinh kim phun buồng đốt'] },
      '40000': { total: '7.800.000 đ', items: ['Đại tu bảo dưỡng cấp 4 vạn SUV', 'Thay toàn bộ dầu phanh, dầu hộp số phụ', 'Thay nước làm mát & lọc nhiên liệu', 'Căn chỉnh độ chụm 3D vi tính'] }
    },
    'luxury': {
      '5000': { total: '1.800.000 đ', items: ['Dầu nhớt tiêu chuẩn Đức (Castrol/Mobil 1)', 'Kiểm tra 30 điểm cảm biến điện tử'] },
      '10000': { total: '3.200.000 đ', items: ['Dầu nhớt chuẩn Mercedes/BMW/Audi', 'Thay lọc nhớt Mann Filter', 'Bảo dưỡng phanh điện tử ABS/ESP', 'Xóa lỗi máy chẩn đoán chuyên dụng'] },
      '20000': { total: '5.900.000 đ', items: ['Thay dầu máy & lọc dầu cao cấp', 'Thay lọc gió kép cabin kháng khuẩn', 'Vệ sinh họng hút & kim phun trực tiếp', 'Hiệu chuẩn hệ thống treo khí nén'] },
      '40000': { total: '12.500.000 đ', items: ['Bảo dưỡng lớn cấp 40.000km xe Đức', 'Thay dầu hộp số tự động tuần hoàn chuyên dụng', 'Thay toàn bộ bugi bạch kim & nước làm mát', 'Căn chỉnh thước lái radar ADAS 3D'] }
    }
  };

  const segmentBtns = document.querySelectorAll('.pill-segment');
  const kmBtns = document.querySelectorAll('.pill-km');
  const resultList = document.getElementById('calc-items-list');
  const resultTotal = document.getElementById('calc-total-val');

  function updateEstimator() {
    if (!resultList || !resultTotal) return;
    const data = (SEGMENT_PRICES[currentSegment] && SEGMENT_PRICES[currentSegment][currentKm])
      ? SEGMENT_PRICES[currentSegment][currentKm]
      : SEGMENT_PRICES['sedan']['10000'];

    resultTotal.innerText = data.total;
    let html = '';
    data.items.forEach(it => {
      html += `<li><span><i class="fa fa-check" style="color:#f59e0b; margin-right:8px;"></i>${it}</span><span style="color:#94a3b8;">Tiêu chuẩn</span></li>`;
    });
    resultList.innerHTML = html;
  }

  if (segmentBtns.length && kmBtns.length) {
    segmentBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        segmentBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        currentSegment = this.getAttribute('data-segment');
        updateEstimator();
      });
    });

    kmBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        kmBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        currentKm = this.getAttribute('data-km');
        updateEstimator();
      });
    });

    updateEstimator();
  }

  /* 4. BRANCH FILTER TABS */
  const branchFilterBtns = document.querySelectorAll('.branch-tab-btn');
  const branchCards = document.querySelectorAll('.branch-card');

  if (branchFilterBtns.length && branchCards.length) {
    branchFilterBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        branchFilterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const region = this.getAttribute('data-region');

        branchCards.forEach(card => {
          if (region === 'all' || card.getAttribute('data-region') === region) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  /* 5. QUICK BOOKING FORM SUBMISSION */
  const bookingForm = document.getElementById('hero-booking-form');
  if (bookingForm) {
    bookingForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const name = document.getElementById('bk-name')?.value || 'Quý khách';
      const phone = document.getElementById('bk-phone')?.value || '';
      const branch = document.getElementById('bk-branch')?.value || 'Chi nhánh gần nhất';

      if (!phone) {
        alert('Vui lòng nhập Số điện thoại liên hệ để nhân viên xác nhận lịch hẹn!');
        return;
      }

      alert(`✅ Cảm ơn ${name}!\n\nHà Thành Garage đã tiếp nhận yêu cầu đặt lịch tại: ${branch}.\nCố vấn dịch vụ sẽ gọi đến số ${phone} trong vòng 5 phút để xác nhận và gửi mã ưu đãi giảm 10% dịch vụ cho bạn!`);
      bookingForm.reset();
    });
  }
});
