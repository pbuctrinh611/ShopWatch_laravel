jQuery(document).ready(function () {
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

    //TODO: Add to cart
    $(document).on("click", ".add-to-cart", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = $(this).data("id");
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).text();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_color = $('.cart_product_color:selected').text();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
       
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
        $id = $('.cart_product_id').val();
        var url = '/delete-from-cart';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var data = {
            "id" : $('.cart_product_id').val()
        }
        $.ajax({
            type: 'DELETE',
            url: url,
            data: data,
            dataType: 'json',
            success: function(data) {
                toastr.success("Xóa sản phẩm khỏi giỏ hàng thành công");
                cartCount();
            }
        });
    });
});
