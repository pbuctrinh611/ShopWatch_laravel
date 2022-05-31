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
                            <td>\
                                <button type="button" value="'+item.id+'" class="btn btn-primary btn-edit__product mr-2">Edit</button>\
                                <button type="button" value="'+item.id+'" class="btn btn-danger btn-delete__product">Delete</button>\
                            </td>\
                        </tr>');
                });
            }
        });
    }

    //TODO: Open create product modal and add product
    $(document).on('click', '#btn-create__product', function(e) {
        e.preventDefault();
        $("#createProductModal").modal("show");
        $('#createProductForm').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            var url = "product/store";
            console.log(image);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
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

    //TODO: Open delete modal
    $(document).on('click', '.btn-delete__product', function(e) {
        e.preventDefault();
        var id = $(this).val();
        $("#delete_product_id").val(id);
        $('#deleteProductModal').modal('show');
    });

    //TODO: Delete product
    $(document).on('click', '#delete_product', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $('#deleteProductModal').find('#delete_product_id').val();
        var url = 'product/delete';
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if(response.status == 404){
                    console.log(response.error);
                }
                toastr.success("Xóa sản phẩm thành công");
                $('#deleteProductModal').modal('hide');
                fetchProduct();
            }
        });
    });

    //TODO: Blocked product
    $(document).on('click', '.btn-blocked__product', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).val();
        var url = 'product/blocked';
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                if(response.status == 404){
                    console.log(response.error);
                 }
                 toastr.success("Khóa sản phẩm thành công");
                 fetchProduct();
            }
        });
    });

    //TODO: Active product
    $(document).on('click', '.btn-active__product', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).val();
        var url = 'product/active';
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                if(response.status == 404){
                    console.log(response.error);
                 }
                 toastr.success("Kích hoạt sản phẩm thành công");
                 fetchProduct();
            }
        });
    });
});