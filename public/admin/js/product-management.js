jQuery(document).ready(function() {
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    //TODO: Search product by name
    $(document).on('click', '#btn-product__search', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var filter_category = $('#filter_product_category').val();
        var filter_brand = $('#filter_product_brand').val();
        fetchProduct(search_product, filter_category, filter_brand);
    });

    //TODO: Filter product by category
    $(document).on('click', '#filter_product_category', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var filter_category = $('#filter_product_category').val();
        var filter_brand = $('#filter_product_brand').val();
        fetchProduct(search_product, filter_category, filter_brand);
    });

    //TODO: Filter product by brand
    $(document).on('click', '#filter_product_brand', function(e) {
        e.preventDefault();
        var search_product = $('#formProductSearch').find('#txt_product').val();
        var filter_category = $('#filter_product_category').val();
        var filter_brand = $('#filter_product_brand').val();
        fetchProduct(search_product, filter_category, filter_brand);
    });

    //TODO: Fetch product
    fetchProduct();
    function fetchProduct(search_product, filter_category, filter_brand) {
        $.ajax({
            url: 'fetch-product',
            type: 'GET',
            data : {
                search_product: search_product,
                filter_category: filter_category,
                filter_brand: filter_brand
            },
            dataType: 'json',
            success: function (response) {
                $('.tbody-product').html('');
                $.each(response.products, function(key, item) {
                    var defaultStatus = "Hoạt động";
                    if ( item.status == 0)  {
                        defaultStatus =  'Khóa';
                    } 
                    $('.tbody-product').append( 
                        '<tr>\
                            <th>'+item.id+'</th>\
                            <td>'+item.name+'</td>\
                            <td>'+(formatCurrency(item.price))+'</td>\
                            <td>'+item.category.name+'</td>\
                            <td>'+item.brand.name+'</td>\
                            <td class="text-center">'+
                                (item.status == 0 ?
                                    '<button type="button" value="'+item.id+'" class="btn btn-danger btn-active__product col-md-10">Khóa</button>'
                                :
                                    '<button type="button" value="'+item.id+'" class="btn btn-success btn-blocked__product col-md-10">Hoạt động</button>'
                                )+
                            '</td>\
                        <td><button type="button" value="'+item.id+'" class="btn btn-primary btn-edit__product mr-2">Edit</button>\
                        <button type="button" value="'+item.id+'" class="btn btn-danger btn-delete__product">Delete</button></td>\
                </tr>');
                });
            }
        });
    }

    //TODO: Open create product modal and add product
    $(document).on('click', '#btn-create__product', function(e) {
        e.preventDefault();
        $("#createProductModal").modal("show");
        $('#btn-product__save').click(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var name = $('#createProductForm').find('#name').val();
            var price = $('#createProductForm').find('#price').val();
         //   var image = $('#createProductForm').find('#image').val();
            var image = $('input[name="payment-method"]').target.files[0].name;
            console.log(image);
            var warranty = $('#createProductForm').find('#warranty').val();
            var is_waterproof = $('#createProductForm').find('#is_waterproof').val();
            var glasses = $('#createProductForm').find('#glasses').val();
            var strap = $('#createProductForm').find('#strap').val();
            var watch_case = $('#createProductForm').find('#watch_case').val();
            var description = $('#createProductForm').find('#description').val();
            var id_brand = $('#createProductForm').find('#id_brand').val();
            var id_category = $('#createProductForm').find('#id_category').val();
            var status = $('#createProductForm').find('#status').val();
            var url = "product/store";
            console.log(image);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    name: name,
                    price: price,
                    image: image,
                    warranty: warranty,
                    is_waterproof: is_waterproof,
                    glasses: glasses,
                    strap: strap,
                    watch_case: watch_case,
                    description: description,
                    id_brand: id_brand,
                    id_category: id_category,
                    status: status,
                },
                dataType: 'json',
                success: function(data) {
                    if(data.status == 400) {
                        $.each(data.error, function(prefix, val) {
                            $('span.'+prefix + '_error').text(val[0]);
                        });
                    }else {
                        toastr.success("Thêm thành công");
                        $('#createProductForm')[0].reset();
                        $("#createProductModal").modal("hide");
                        fetchProduct();
                    }
                }
            });
        });
    });
});