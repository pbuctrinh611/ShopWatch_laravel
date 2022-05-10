jQuery(document).ready(function () {
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    //TODO: Search Product By Name
    $(document).on('click', '#search-product__page', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var categories = [];
        $('.category_checkbox').each(function() {
            if($(this).is(':checked')){
               categories.push($(this).val());
            }
        });
        var brands = [];
        $('.brand_checkbox').each(function() {
            if($(this).is(':checked')) {
                brands.push($(this).val());
            }
        });
        var colors = [];
        $('.color_checkbox').each(function() {
            if($(this).is(':checked')) {
                colors.push($(this).val());
            }
        });
        fetchProductPage(search_product, categories, brands, colors);
    });

    //TODO: Filter Product By Category
    $(document).on('change', '.category_checkbox', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var categories = [];
        $('.category_checkbox').each(function() {
            if($(this).is(':checked')){
               categories.push($(this).val());
            }
        });
        var brands = [];
        $('.brand_checkbox').each(function() {
            if($(this).is(':checked')) {
                brands.push($(this).val());
            }
        });
        var colors = [];
        $('.color_checkbox').each(function() {
            if($(this).is(':checked')) {
                colors.push($(this).val());
            }
        });
        fetchProductPage(search_product, categories, brands, colors);
    });

    //TODO: Filter Product By Brand
    $(document).on('change', '.brand_checkbox', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var categories = [];
        $('.category_checkbox').each(function() {
            if($(this).is(':checked')){
               categories.push($(this).val());
            }
        });
        var brands = [];
        $('.brand_checkbox').each(function() {
            if($(this).is(':checked')) {
                brands.push($(this).val());
            }
        });
        var colors = [];
        $('.color_checkbox').each(function() {
            if($(this).is(':checked')) {
                colors.push($(this).val());
            }
        });
        fetchProductPage(search_product, categories, brands, colors);
    });

    //TODO: Filter Product By Color
    $(document).on('change', '.color_checkbox', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var categories = [];
        $('.category_checkbox').each(function() {
            if($(this).is(':checked')){
               categories.push($(this).val());
            }
        });
        var brands = [];
        $('.brand_checkbox').each(function() {
            if($(this).is(':checked')) {
                brands.push($(this).val());
            }
        });
        var colors = [];
        $('.color_checkbox').each(function() {
            if($(this).is(':checked')) {
                colors.push($(this).val());
            }
            console.log(colors);
        });
        fetchProductPage(search_product, categories, brands, colors);
    });

    fetchProductPage();
    function fetchProductPage(searchProduct, filterProductByCategory, filterProductByBrand, filterProductByColor) {
        $.ajax({
            url: "fetch-product__page",
            type: "GET",
            data: {
                searchProduct: searchProduct,
                filterProductByCategory: filterProductByCategory,
                filterProductByBrand: filterProductByBrand,
                filterProductByColor: filterProductByColor
            },
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
            }
        });
    }
});