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
                        <div class="d-flex">
                            <form method="GET"  class="form-horizontal" id="formSearch">
                                <div class="d-flex">
                                    <input type="text" id="txt_user" name="txt_user" class="txt_user form-control" 
                                    placeholder="Enter name or email..." />
                                    <button class="btn btn-info ml-2" id="search_user" type="submit">Search</button>
                                </div>
                            </form>
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

                        <!-- Open Create User Modal -->
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
                                        <form action="#" id="createUserForm" name="myForm" class="form-horizontal" method="POST">
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
                        <!-- End -->

                        <!-- Open Edit User Modal -->
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
                                        <form action="#" id="editUserForm" name="myForm" class="form-horizontal" method="PUT">
                                            @csrf

                                            <input type="hidden" id="edit_user_id_role">
                                            <input type="hidden" id="edit_user_id">
                                            <div class="form-group">
                                                <label>Họ tên</label>
                                                <input type="text" class="form-control" id="name" name="name" value="">
                                                <span class="text text-danger error-text name_user_edit_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input type="text" class="form-control" id="tel" name="tel" value="">
                                                <span class="text text-danger error-text tel_user_edit_error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="">
                                                <span class="text text-danger error-text email_user_edit_error"></span>
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
                                        <input type="submit" class="btn btn-primary" id="update_user" value="Lưu">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End-->

                        <!-- Open Delete User Modal -->
                        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Xóa người dùng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" id="deleteUserForm" name="myForm" class="form-horizontal" method="DELETE">
                                            @csrf
                                            <input type="hidden" id="delete_user_id">
                                            <h5 class="text text-danger">Bạn có muốn xóa tài khoản này không?</h5>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" id="delete_user" value="Xóa">
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