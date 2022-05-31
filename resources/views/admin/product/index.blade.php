@extends('admin.master')
@section('title')
Quản lý sản phẩm
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex  align-items-center justify-content-between">
                            <span class="card-title mr-3">Danh mục</span>
                            <button class="btn btn-success" id="btn-create__product">Add</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <form method="GET" class="form-horizontal" id="">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center mr-2">
                                        <h5 class="text text-primary mb-0 mr-2">Category</h5>
                                        <select name="filter_product_category" id="filter_product_category" class="form-control">
                                            <option selected disabled>--Please select one category--</option>
                                            @foreach($categories as $key => $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h5 class="text text-primary mb-0 mr-2">Brand</h5>
                                        <select name="filter_product_brand" id="filter_product_brand" class="form-control">
                                            <option selected disabled>--Please select one brand--</option>
                                            @foreach($brands as $key => $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <form method="GET" class="form-horizontal" id="formProductSearch" onsubmit="return false;">
                                <div class="d-flex">
                                    <input type="text" id="txt_product" name="txt_product" class="txt_product form-control" placeholder="Enter product name..." />
                                    <button class="btn btn-info ml-2" id="btn-product__search" type="button">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Thương hiệu</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-product">

                            </tbody>
                        </table>

                        <!-- Open Create Product Modal -->
                        <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModalLabel">Thêm sản phẩm</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="createProductForm" name="myForm" class="form-horizontal" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
                                                <span class="text text-danger error-text name_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Giá</label>
                                                <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá">
                                                <span class="text text-danger error-text price_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Độ bảo đảm</label>
                                                <input type="text" class="form-control" id="warranty" name="warranty" placeholder="Nhập độ bảo đảm">
                                                <span class="text text-danger error-text warranty_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Chống nước</label>
                                                <input type="text" class="form-control" id="is_waterproof" name="is_waterproof" placeholder="Nhập chống nước">
                                                <span class="text text-danger error-text is_waterproof_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Chất liệu kính</label>
                                                <input type="text" class="form-control" id="glasses" name="glasses" placeholder="Nhập chất liệu kính">
                                                <span class="text text-danger error-text glasses_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Chất liệu dây đeo</label>
                                                <input type="text" class="form-control" id="strap" name="strap" placeholder="Nhập chất dây đeo">
                                                <span class="text text-danger error-text strap_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Chất liệu vỏ</label>
                                                <input type="text" class="form-control" id="watch_case" name="watch_case" placeholder="Nhập chất liệu vỏ">
                                                <span class="text text-danger error-text watch_case_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
                                                <input type="file" name="image" id="image">
                                                <span class="text text-danger error-text image_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả">
                                                <span class="text text-danger error-text description_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn thương hiệu</label>
                                                <select id="id_brand" name="id_brand" class="form-control input-sm m-bot15">
                                                    @foreach($brands as $key => $brand)
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn danh mục</label>
                                                <select id="id_category" name="id_category" class="form-control input-sm m-bot15">
                                                    @foreach($categories as $key => $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="hidden" name="status" id="status" value="1">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" id="btn-product__save" value="Thêm">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                         <!-- Open Delete Product Modal -->
                         <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProductLabel">Xóa sản phẩm</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="deleteProductForm" name="myForm" class="form-horizontal" method="DELETE">
                                            @csrf
                                            <input type="hidden" id="delete_product_id">
                                            <h5 class="text text-danger">Bạn có muốn xóa sản phẩm này không?</h5>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" id="delete_product" value="Xóa">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End-->
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection