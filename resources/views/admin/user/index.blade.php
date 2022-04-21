@extends('admin.master')
@section('title')
Quản lý người dùng
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex  align-items-center justify-content-between">
                            <span class="card-title mr-3">Danh sách</span>
                            <button class="btn btn-success" id="btn-create__user">Add</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Tình trạng</th>
                                    <th scope="col">Quyền</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="users-list">

                            </tbody>
                        </table>

                        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModalLabel">Thêm người dùng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul id="saveform_errorList"></ul>
                                        <form action="{{route('user.store')}}" id="createUserForm" name="myForm" class="form-horizontal" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Họ tên</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="">
                                                <span class="text text-danger error-text name_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input type="text" class="form-control" id="tel" name="tel" placeholder="Nhập số điện thoại" value="">
                                                <span class="text text-danger error-text tel_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="">
                                                <span class="text text-danger error-text email_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" value="">
                                                <span class="text text-danger error-text password_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn quyền</label>
                                                <select id="id_role" name="id_role" class="form-control input-sm m-bot15">
                                                    @foreach($roles as $key => $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" id="btn-save" value="Thêm">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Cập nhật người dùng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul id="saveform_errorList"></ul>
                                        <form action="" id="editUserForm" name="myForm" class="form-horizontal" method="POST">
                                            @csrf
                                            <input type="hidden" id="edit_user_id">
                                            <div class="form-group">
                                                <label>Họ tên</label>
                                                <input type="text" class="form-control" id="name" name="name" value="">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input type="text" class="form-control" id="tel" name="tel" value="">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label>Chọn quyền</label>
                                                <select id="id_role" name="id_role" class="form-control input-sm m-bot15">
                                                    @foreach($roles as $key => $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" id="update_user" value="Lưu">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>

@endsection