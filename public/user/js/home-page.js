jQuery(document).ready(function () {
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    //TODO: Product HomePage
    fetchProductPage();
    function fetchProductPage(is_homepage) {
        $.ajax({
            url: "fetch-product__page",
            type: "GET",
            data: {
                is_homepage: 1
            },
            dataType: "json",
            success: function (response) {
                $(".product-carousel").html("");
                $.each(response.products , function (key, item) {
                    $(".product-carousel").append('<div class="product-carousel-group col-md-3">\
                    <div class="mirora-product mb-md--10">\
                        <div class="product-img">\
                            <img src="" alt="Product" class="primary-image" />\
                        </div>\
                        <div class="product-content text-center">\
                        <span>'+item.brand.name+'</span>\
                        <h4><a href="">'+item.name+'</a></h4>\
                        <span class="money" style="color: #a8741a; font-size: 1.8rem; font-weight: 500;">\
                            '+(formatCurrency(item.price))+'\
                        </span>\
                        </div>\
                    </div>\
                </div>');
                });
            },
        });
    }
});
