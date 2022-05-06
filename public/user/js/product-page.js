jQuery(document).ready(function () {
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    fetchProductPage();
    function fetchProductPage() {
        $.ajax({
            url: "fetch-product__page",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $(".shop-product-wrap").html("");
                $.each(response.products, function (key, item) {
                    $(".shop-product-wrap").append('<div class="col-xl-3 col-lg-4 col-md-6 col-12">\
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