jQuery(document).ready(function() {

    fetchBlogPage();
    function fetchBlogPage() {
        $.ajax({
            url: 'fetch-blog__page',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.blog-list').html('');
                $.each(response.blogs, function(key, item) {
                    $('.blog-list').append('<div class="col-12 mb--30">\
                    <article class="post listview sticky single-post format-image">\
                        <div class="post-media">\
                            <div class="image">\
                                <a href=""><img src="" alt="blog"></a>\
                            </div>\
                        </div>\
                        <div class="post-info">\
                            <header class="entry-header">\
                                <div class="entry-meta">\
                                    <span class="post-date">'+item.created_at+'</span>\
                                </div>\
                                <h2 class="post-title">\
                                    <a href="">'+item.title+'</a>\
                                </h2>\
                            </header>\
                            <div class="post-content">\
                                <p class="intro">'+item.content+'</p>\
                            </div>\
                            <a href="" class="btn btn-read-more btn-style-2">Đọc tiếp</a>\
                        </div>\
                    </article>\
                </div>');
                });
            }
        });
    }

});