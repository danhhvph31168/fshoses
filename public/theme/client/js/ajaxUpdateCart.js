$(document).on("click", ".qtybtn", function () {
    var input = $(this).siblings(".quantity-input");
    var quantity = parseInt(input.val()); // Chuyển đổi giá trị input thành số nguyên
    var id = parseInt(input.data("id"));
    console.log(id, quantity);

    $.ajax({
        url: "http://127.0.0.1:8000/cart-update", // Địa chỉ URL đến server
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            quantity: quantity,
        },
        success: function (result) {
            data = result.data;
            console.log(data);
            $(`.cart-price-${id}`).html(formatCurrencyVN(data.price)); // Cập nhật
            $(".cart__total-price").html(formatCurrencyVN(data.total_cart));
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error: ", status, error); // Xử lý lỗi
            console.log("Response Text: ", xhr.responseText); // Xem chi tiết lỗi từ server
        }
    });
});
var proQty = $('.pro-qty-2');
proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
proQty.on('click', '.qtybtn', function () {
    var $button = $(this);
    var oldValue = $button.parent().find('input').val();
    if ($button.hasClass('inc')) {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }
    $button.parent().find('input').val(newVal);
});

$(document).on("click", "#apply-coupon", function (e) {
    e.preventDefault();
    var couponCode = $('#coupon_code').val();

    $.ajax({
        url: "http://127.0.0.1:8000/apply-coupon", // Địa chỉ route để xử lý mã giảm giá
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            coupon_code: couponCode,
        },
        success: function (response) {
            if (response.success) {
                // Cập nhật lại tổng giá trong giỏ hàng với số tiền đã được giảm giá
                $(".cart__total-price").html(formatCurrencyVN(response.total_price));
                alert("Coupon applied successfully!");
            } else {
                alert(response.message); // Hiển thị thông báo lỗi nếu mã giảm giá không hợp lệ
            }
        },
        error: function (xhr, status, error) {
            console.error("Error applying coupon:", status, error);
        }
    });
});

