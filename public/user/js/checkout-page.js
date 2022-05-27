jQuery(document).ready(function() {
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    fetchMiniCart();
    function fetchMiniCart(){
        $.ajax({
            url: 'fetch-mini__cart',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.mini-cart__item').html('');
                var total = 0;
                $.each(response.cart, function(key, item) {
                    var subTotal = 0;
                    subTotal = item['product_qty'] * item['product_price'];
                    total = total + subTotal;
                    $('.mini-cart__item').append(
                    '<div class="mini-cart__item--single">\
                        <div class="mini-cart__item--image">\
                            <img src="'+item['product_image']+'" alt="product">\
                        </div>\
                        <div class="mini-cart__item--content">\
                            <h4 class="mini-cart__item--name">\
                                <a href="">'+item['product_name']+'</a>\
                            </h4>\
                            <p class="mini-cart__item--quantity">x'+item['product_qty']+'</p>\
                            <p class="mini-cart__item--price">\
                                '+(formatCurrency(item['product_price'] * item['product_qty'])) +'\
                            </p>\
                        </div>\
                </div>')
                });
                $('#cart-mini__total').html('');
                $('#cart-mini__total').append(
                    '<span class="mini-cart__calculation--item">Tổng tiền: '+ (formatCurrency(total))+'</span>')
            }
        });
    }

    fetchPromotionCode();
    function fetchPromotionCode() {
        $.ajax({
            url: 'fetch-promotion__code',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.gIRASp').html('');
                $.each(response.promotion_used, function(key, item) {
                    $('.gIRASp').append(
                        '<div class="promotion-wrapper d-flex id="user_promotion_id_'+item.id+'"">\
                            <div class="inner">\
                                <input type="hidden" name="user_promotion_id"  value="'+item.id+'">\
                                <div class="content">'+item.promotion.code+'</div>\
                            </div>\
                            <button type="button" class="btn-delete__promotion mr-3" data-id='+item.id+'>\
                                <i class="fa fa-times"></i>\
                            </button>\
                        </div>');
                });
            }
        });
    }

    fetchCheckoutPage();
    function fetchCheckoutPage() {
        $.ajax({
            url: 'fetch-checkout__page',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.checkout-content').html('');
                var total = 0;
                $.each(response.cart, function(key, item) {
                    var subTotal = 0;
                    subTotal = item['product_qty'] * item['product_price'];
                    total = total + subTotal;
                    $('.checkout-content').append(
                    '<tr>\
                        <td>'+item['product_name']+'</td>\
                        <td>'+item['product_qty']+'</td>\
                        <td>'+(formatCurrency(item['product_price'] * item['product_qty']))+'</td>\
                    </tr>');
                });
                $('.checkout-money').html('');
                $('.checkout-money').append(
                    '<tr class="cart-subtotal">\
                        <td>Tạm tính</td>\
                        <td colspan="2" class="order-subtotal-amount">'+ (formatCurrency(total))+'</td>\
                    </tr>\
                    <tr class="cart-discount">\
                        <td>Giảm giá</td>\
                        <td colspan="2" class="order-total-discount">0 VND</td>\
                    </tr>\
                    <tr class="cart-total">\
                        <td>Tổng tiền</td>\
                        <input type="hidden" id="total-before__convert" name="total-before__convert" value="'+total+'">\
                        <td colspan="2"><span class="order-total-ammount">'+ (formatCurrency(total))+'</span></td>\
                    </tr>');
            }
        });
    }

    $(document).on('click', '.btn-promotion',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var code = $('#code').val();
        $.ajax({
            url: '/checkout/check-promotion',
            type: 'POST',
            data: { code: code },
            success: function (response) {
                if(response.status === 404) {
                    toastr.error("Không tồn tại mã giảm giá");
                }else if(response.status == 400) {
                    toastr.error("Bạn đã sử dụng mã này rồi");
                }else if(response.status == 204) {
                    toastr.error("Bạn chưa nhập mã giảm giá");
                }else{
                    $('.gIRASp').html('');
                    $.each(response.promotion_used, function(key, item) {
                        $('.gIRASp').append(
                            '<div class="promotion-wrapper d-flex id="user_promotion_id_'+item.id+'"">\
                                <div class="inner">\
                                    <input type="hidden" name="user_promotion_id"  value="'+item.id+'">\
                                    <div class="content">'+item.promotion.code+'</div>\
                                </div>\
                                <button type="button" class="btn-delete__promotion mr-3" data-id='+item.id+'>\
                                    <i class="fa fa-times"></i>\
                                </button>\
                            </div>');
                    });
                    // $('.checkout-money tr:nth-child(2)').removeClass('d-none');
                    $('.order-total-discount').text(formatCurrency(response.discount_price));
                    $('.order-total-ammount').text(formatCurrency(response.total));
                    toastr.success("Áp dụng mã giảm giá thành công");
                }
            }
        });
    });

    $(document).on('click', '.btn-delete__promotion', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: '/checkout/delete-promotion',
            type: 'DELETE',
            data: {id: id},
            success: function(response) {
                if(response.status == 200) {
                    $discount_currency =  $('.order-total-discount').text();
                    $('.order-total-discount').text(formatCurrency(parseInt($discount_currency.replaceAll(',','').replace(' VND','')) - parseInt(response.discount_price)));
                    $total_currency = $('.order-total-ammount').text();
                    $('.order-total-ammount').text(formatCurrency(parseInt($total_currency.replaceAll(',','').replace(' VND','')) + parseInt(response.discount_price)));
                    fetchPromotionCode();
                    toastr.success("Xóa mã giảm giá thành công");
                }
            }
        });
    });
});