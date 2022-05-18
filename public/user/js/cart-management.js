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

    //TODO: Fetch cart page
    fetchCartPage();
    function fetchCartPage() {
        $.ajax({
            url: 'fetch-cart__page',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#cart-content').html('');
                $.each(response.cart, function(key, item) {
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
                                <td class="cart-product-color"><strong>'+item['product_color']+'</strong></td>\
                                <td class="cart-product-price">\
                                    <strong>'+(formatCurrency(item['product_price']))+'\</strong>\
                                </td>\
                                <td>\
                                    <div class="quantity">\
                                        <input type="number" class="quantity-input" name="qty" value="'+item['product_qty']+'" min="1">\
                                    </div>\
                                </td>\
                                <td class="cart-product-price">\
                                    <strong>'+(formatCurrency(item['product_price'] * item['product_qty'])) +'</strong>\
                                </td>\
                                <td>\
                                    <button type="button" class="remove-from-cart" data-id="'+item['id']+'"><i class="fa fa-times"></i></button>\
                                </td>\
                    </tr>');
                });
            }
        });
    }

    //TODO: Fetch

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
        var cart_product_color = $('#addCartForm').find('.cart_product_color:selected').text();
        var cart_product_qty = $('#addCartForm').find('.cart_product_qty_' + id).val();
       
        var _token = $('input[name="_token"]').val();
        var url = "/add-to-cart"
        $.ajax({
            url:  url,
            type: 'POST',
            data: {
                cart_product_id: cart_product_id,
                cart_product_image: cart_product_image,
                cart_product_name : cart_product_name,
                cart_product_price : cart_product_price,
                cart_product_color : cart_product_color,
                cart_product_qty : cart_product_qty,
                _token:_token
            },
            success: function (data) {
                toastr.success("Thêm vào giỏ hàng thành công!");
                cartCount();
            }
        });
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
            url: '/delete-from-cart',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data){
                toastr.success("Xóa sản phẩm khỏi giỏ hàng thành công!");
                cartCount();
                fetchCartPage();
            }
        });
    });
});
