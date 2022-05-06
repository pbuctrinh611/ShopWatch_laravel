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

    //TODO: Blog HomePage
    fetchBlogPage();
    function fetchBlogPage(is_homepage) {
        $.ajax({
            url: 'fetch-blog__page',
            type: 'GET',
            data: { 
                is_homepage: 1
            }, 
            dataType: 'json',
            success: function(response) {
                $('.blog-carousel').html('');
                $.each(response.blogs, function(key, item) {
                    $('.blog-carousel').append('<article class="blog col-md-4">\
                    <a href="" class="blog__thumb">\
                        <img src="" alt="Blog">\
                    </a>\
                    <div class="blog__content">\
                        <div class="blog__meta">\
                            <p class="blog__date"><a href="">'+item.created_at+'</a></p>\
                        </div>\
                        <h3 class="blog__title">\
                            <a href="">'+item.title+'</a>\
                        </h3>\
                        <div class="blog__text">\
                            <p class="intro">'+item.content+'</p>\
                            <a class="read-more" href="">Đọc tiếp</a>\
                        </div>\
                    </div>\
                </article>');
                });
            }
        });
    }
});
