/**
 * Lexus On-The-Road & Loan Calculator (Dự toán chi phí lăn bánh & Trả góp ô tô)
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        function formatCurrency(number) {
            return new Intl.NumberFormat('vi-VN').format(Math.round(number)) + ' VNĐ';
        }

        function calculateOnTheRoadCost() {
            var basePrice = parseFloat($('#calc-car-select').val()) || 0;
            var region = $('#calc-region-select').val() || 'hanoi';

            if (basePrice <= 0) {
                return;
            }

            // Tax rate by region
            var taxRate = (region === 'hanoi' || region === 'quangninh') ? 0.12 : 0.10;
            var plateFee = (region === 'hanoi' || region === 'hcm') ? 20000000 : 1000000;
            
            var registrationTax = basePrice * taxRate;
            var inspectionFee = 340000; // Phí đăng kiểm
            var roadMaintenanceFee = 1560000; // Phí đường bộ 1 năm cá nhân
            var insuranceTNDS = 480700; // BH TNDS 1 năm

            var totalCost = basePrice + registrationTax + plateFee + inspectionFee + roadMaintenanceFee + insuranceTNDS;

            // Render Results
            $('#res-base-price').text(formatCurrency(basePrice));
            $('#res-reg-tax').text(formatCurrency(registrationTax) + ' (' + (taxRate * 100) + '%)');
            $('#res-plate-fee').text(formatCurrency(plateFee));
            $('#res-inspection').text(formatCurrency(inspectionFee));
            $('#res-road-fee').text(formatCurrency(roadMaintenanceFee));
            $('#res-tnds').text(formatCurrency(insuranceTNDS));
            $('#res-total-cost').text(formatCurrency(totalCost));

            // Loan Estimate (Giả định vay 70% trong 5 năm lãi 9%/năm)
            var loanRate = 0.70;
            var loanYears = 5;
            var annualInterest = 0.09;
            var loanAmount = basePrice * loanRate;
            var downPayment = totalCost - loanAmount; // Số tiền trả trước (gồm chi phí lăn bánh)
            var monthlyPrincipal = loanAmount / (loanYears * 12);
            var monthlyInterest = (loanAmount * annualInterest) / 12;
            var monthlyPayment = monthlyPrincipal + monthlyInterest;

            $('#res-down-payment').text(formatCurrency(downPayment));
            $('#res-monthly-loan').text(formatCurrency(monthlyPayment) + ' / tháng');
        }

        $('#calc-car-select, #calc-region-select').on('change', function() {
            calculateOnTheRoadCost();
        });

        // Initialize calculation on load if inputs present
        if ($('#calc-car-select').length) {
            calculateOnTheRoadCost();
        }

    });

})(jQuery);

