jQuery(document).ready(function () {
    //TODO: Format price
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    //TODO: Count item in cart
    cartCount();
    function cartCount() {
        var url = '/cart-count';
        $.ajax({
            method: 'GET',
            url: url,
            success: function(response) {
                $('.mini-cart__count').html('');
                $('.mini-cart__count').html(response.cartCount);
            }
        });
    }

    //TODO: Increment button
    $(document).on('click', '.increment-btn', function(e) {
        e.preventDefault();
        var id  = $(this).data('id');
        var product_qty = parseInt($('#cart_product_qty_' + id).val());
        $('#cart_product_qty_' + id).val(product_qty + 1);
    });

    //TODO: Decrement button 
    $(document).on('click', '.decrement-btn', function(e) {
        e.preventDefault();
        var id  = $(this).data('id');
        var product_qty = parseInt($('#cart_product_qty_' + id).val());
        if(product_qty < 1) {
            $('#cart_product_qty_' + id).val(1);
        }else {
            $('#cart_product_qty_' + id).val(product_qty - 1);
        }
    });

    //TODO: Fetch cart page
    fetchCartPage();
    function fetchCartPage() {
        $.ajax({
            url: 'fetch-cart__page',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#cart-content').html('');
                var total = 0;
                $.each(response.cart, function(key, item) {
                    var subTotal = 0;
                    subTotal = item['product_qty'] * item['product_price'];
                    total = total + subTotal;
                    $('#cart-content').append(
                        '<tr class="row-cart">\
                                <td>\
                                    <input type="hidden" name="id" value="'+item['id']+'">\
                                    <a href="product-details.html">\
                                        <img src="'+item['product_image']+'" alt="product">\
                                    </a>\
                                </td>\
                                <td class="wide-column">\
                                    <h3><a href="">'+item['product_name']+'</a></h3>\
                                </td>\
                                <input type="hidden" class="cart_product_id_color" value="'+item['product_id_color']+'">\
                                <td class="cart-product-color"><strong>'+item['product_color']+'</strong></td>\
                                <td class="cart-product-price">\
                                    <strong>'+(formatCurrency(item['product_price']))+'\</strong>\
                                </td>\
                                <td width="140px">\
                                    <div class="input-group quantity" style="width: 110px !important; height: 40px !important;">\
                                        <div class="input-group-prepend decrement-btn changeQuantity" data-id='+item['id']+' style="cursor: pointer">\
                                            <span class="input-group-text" style="font-size: 18px !important">-</span>\
                                        </div>\
                                        <input type="number" min="1" class="qty-input form-control" id="cart_product_qty_'+item['id']+'"\
                                        name="cart_product_qty" value="'+item['product_qty']+'"\
                                        style="font-size:20px; height: 40px;">\
                                        <div class="input-group-append increment-btn changeQuantity"  data-id='+item['id']+' style="cursor: pointer">\
                                            <span class="input-group-text"  style="font-size: 18px !important">+</span>\
                                        </div>\
                                    </div>\
                                </td>\
                                <input type="hidden" name="product_qty_stock" class="qty-stock-input" value="'+item['product_qty_stock']+'">\
                                <td class="cart-product-price">\
                                    <strong>'+(formatCurrency(item['product_price'] * item['product_qty'])) +'</strong>\
                                </td>\
                                <td width="220px">\
                                    <button type="button" class="btn btn-primary update-from-cart mr-2" data-id="'+item['id']+'">Edit</button>\
                                    <button type="button" class="btn btn-danger remove-from-cart" data-id="'+item['id']+'">Remove</button>\
                                </td>\
                    </tr>');
                });

                $('#cart-total').html('');
                $('#cart-total').append('<span class="price-ammount">'+(formatCurrency(total))+'</span>')
            }
        });
    }

    //TODO: Fetch mini cart in header
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

    //TODO: Add to cart
    $(document).on("click", ".add-to-cart", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = $(this).data("id");
        var cart_product_id = $('#addCartForm').find('.cart_product_id_' + id).val();
        var cart_product_image = $('#addCartForm').find('.cart_product_image_' + id).val();
        var cart_product_name = $('#addCartForm').find('.cart_product_name_' + id).text();
        var cart_product_price = $('#addCartForm').find('.cart_product_price_' + id).val();
        var cart_product_id_color = $('#addCartForm').find('#id_color').val();
        var cart_product_color = $('#addCartForm').find('.cart_product_color:selected').text();
        var cart_product_qty = $('#addCartForm').find('.cart_product_qty_' + id).val();
        var cart_product_qty_stock = parseInt($('#addCartForm').find('.cart_product_qty_stock_' + id).text());
        //console.log($.isNumeric(cart_product_qty_stock))
        console.log(cart_product_id_color);
       
        var _token = $('input[name="_token"]').val();
        var url = "/cart/add"
        if(cart_product_qty_stock == 0) {
            toastr.error("Sản phẩm này đã hết hàng!");
        }else if(cart_product_qty > cart_product_qty_stock){
            toastr.error("Không được mua quá số lượng còn trong kho");
        }else if(cart_product_qty < 1) {
            toastr.error("Bạn phải đặt ít nhất một sản phẩm!");
        }else{
            $.ajax({
                url:  url,
                type: 'POST',
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_image: cart_product_image,
                    cart_product_name : cart_product_name,
                    cart_product_price : cart_product_price,
                    cart_product_id_color : cart_product_id_color,
                    cart_product_color : cart_product_color,
                    cart_product_qty : cart_product_qty,
                    cart_product_qty_stock : cart_product_qty_stock,
                    _token:_token
                },
                success: function (data) {
                    toastr.success("Thêm vào giỏ hàng thành công!");
                    cartCount();
                    fetchMiniCart();
                }
            });
        }
    });

    //TODO: Update cart
    $(document).on('click', '.update-from-cart', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).data('id');
        var product_qty = parseInt($(this).parents('tr').find('.qty-input').val());
        var product_qty_stock = parseInt($(this).parents('tr').find('.qty-stock-input').val());
        if(product_qty < 1) {
            toastr.error("Bạn phải đặt ít nhất một sản phẩm!");
            fetchCartPage();
            fetchMiniCart();
        }else if(product_qty > product_qty_stock) {
            toastr.error("Không được mua quá số lượng còn trong kho");
            fetchCartPage();
            fetchMiniCart();
        }else {
            $.ajax({
                url: '/cart/update',
                type: 'PUT',
                data: {
                    id: id,
                    product_qty: product_qty,
                },
                success: function (data) {
                    toastr.success("Cập nhật giỏ hàng thành công!");
                    fetchCartPage();
                    fetchMiniCart();
                }
            });
        }
    });

    //TODO: Delete from cart
    $(document).on("click", ".remove-from-cart", function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id= $(this).data('id');
        $.ajax({
            url: '/cart/delete',
            type: 'DELETE',
            data: {
                id: id
            },
            success: function(data){
                toastr.success("Xóa sản phẩm khỏi giỏ hàng thành công!");
                cartCount();
                fetchCartPage();
                fetchMiniCart();
            }
        });
    });
});
