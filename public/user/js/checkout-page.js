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
                        <td colspan="2">'+ (formatCurrency(total))+'</td>\
                    </tr>\
                    <tr class="order-total">\
                        <td>Tổng tiền</td>\
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
        console.log(code);
        $.ajax({
            url: '/checkout/check-promotion',
            type: 'POST',
            data: {
                code: code,
            },
            success: function (response) {
                if(response.status === 404) {
                    toastr.error("Không tồn tại mã giảm giá");
                }else if(response.status == 400) {
                    toastr.error("Bạn đã sử dụng mã này rồi");
                }else if(response.status == 204) {
                    toastr.error("Bạn chưa nhập mã giảm giá");
                }else{
                    $('.checkout-money').html('');
                    toastr.success("Áp dụng mã giảm giá thành công");
                }
            }
        });
    });
});