jQuery(document).ready(function() {

    //TODO: Search User By Name Or Email
    $(document).on('click', '#search_user', function(e) {
        e.preventDefault();
        var search_data= $('#txt_user').val();
        var filter_role =   $("#filter_user_role").val();
        fetchUser(search_data, filter_role);
    });

    //TODO: Filter User By Role
    $(document).on('change', '#filter_user_role', function(e) {
        e.preventDefault();
        var search_data= $('#txt_user').val();
        var filter_role =   $("#filter_user_role").val();
        fetchUser(search_data, filter_role);
    });


    // TODO: Fetch User
    fetchUser();
    function fetchUser(searchKey, filterRole) {
        $.ajax({
            url : 'fetch-user',
            type: "GET",
            data : {
                searchKey: searchKey,
                filterRole: filterRole,
            },
            dataType: 'json',
            success: function(response){
                $('tbody').html('');
              
                $.each(response.users, function(key, item) {
                    var defaultStatus = "Hoạt động";
                    if ( item.status == 0)  {
                        defaultStatus =  'Khóa';
                    } 
                    var defaultRole = "";
                    if(item.id_role == 2) {
                        defaultRole = "Quản lý";
                    }else if(item.id_role == 3) {
                        defaultRole = "Nhân viên bán hàng";
                    }else if(item.id_role == 4) {
                        defaultRole = "Nhân viên giao hàng";
                    }else {
                        defaultRole = "Khách hàng";
                    }

                    $('tbody').append(
                        '<tr id="users-list" name="users-list">\
                            <th>'+item.id+'</th>\
                            <td>'+item.name+'</td>\
                            <td>'+item.tel+'</td>\
                            <td>'+item.email+'</td>\
                            <td class="text-center">'+
                                (item.status == 0 ?
                                '<button type="button" value="'+item.id+'" class="btn btn-danger btn-active__user col-md-10">Khóa</button>'
                                :
                                '<button type="button" value="'+item.id+'" class="btn btn-success btn-blocked__user col-md-10">Hoạt động</button>'
                                )+
                            '</td>\
                            <td>'+ defaultRole+'</td>\
                            <td><button type="button" value="'+item.id+'" class="btn btn-primary btn-edit__user mr-2">Sửa</button>\
                                <button type="button" value="'+item.id+'" class="btn btn-danger btn-delete__user">Xóa</button>\
                            </td>\
                        </tr>');
                });
            }
        });
    }

    // TODO: Open Create User Modal And Add User
    $(document).on("click", '#btn-create__user', function(e) {
        $("#createUserModal").modal("show");
        e.preventDefault();
        $('#btn-save').click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = {
                'name': $('#name').val(),
                'tel': $('#tel').val(),
                'email': $('#email').val(),
                'password': $('#password').val(),
                'id_role': $('#id_role').val()
            };
            var url = "user/store"
            $.ajax({
                url: url,
                method:  "POST",
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if(data.status == 400) {
                        $.each(data.error, function(prefix, val) {
                            $('span.'+prefix + '_error').text(val[0]);
                        });
                    }else {
                        toastr.success("Thêm thành công");
                        $("#createUserModal").modal("hide");
                        fetchUser();
                    }
                }
            });
        });
    });

    //TODO: Open Edit User Modal
    $(document).on('click', '.btn-edit__user', function (e) {
        e.preventDefault();
        var user_id = $(this).val();
        $('#editUserModal').modal('show');
        var url = "user/edit/";
        $.ajax({
            url: url + user_id,
            type: "GET",
            cache: false,
            success: function (response) {
                if(response.status == 404) {
                    console.log(response.message);
                }else {
                    $('#editUserModal').find('#edit_user_id').val(user_id);  
                    $('#editUserModal').find('#name').val(response.user_edit.name);
                    $('#editUserModal').find('#tel').val(response.user_edit.tel);
                    $('#editUserModal').find('#email').val(response.user_edit.email); 
                    $('#editUserModal').find("#id_role").val(response.user_edit.id_role).change();
                }
            }
        });
    });

    //TODO: Update User
    $(document).on('click', '#update_user', function (e) {
        e.preventDefault();
        var id = $('#edit_user_id').val();
        var data = {
            'name':  $('#editUserModal').find('#name').val(),
            'tel':   $('#editUserModal').find('#tel').val(),
            'email': $('#editUserModal').find('#email').val(),
            'id_role': $('#editUserModal').find('#id_role').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "user/update/";
        $.ajax({
            url: url + id,
            type: "PUT",
            data: data,
            dataType: "json",
            cache: false,
            success: function (response) {
                if (response.status == 400) {
                    $.each(response.error, function(prefix, val) {
                        $('span.'+prefix + '_user_edit_error').text(val[0]);
                    });
                } else if(response.status == 404) {
                    console.log(response.error);
                } else {
                    toastr.success("Cập nhật thành công");
                    $("#editUserModal").modal("hide");
                    fetchUser();
                }
            }
        });
    });

    //TODO: Open Delete User Modal
    $(document).on("click", '.btn-delete__user', function(e) {
        e.preventDefault();
        var user_id = $(this).val();
        $("#delete_user_id").val(user_id);
        $("#deleteUserModal").modal('show');
    });

    //TODO: Delete User
    $(document).on('click', '#delete_user', function(e){
        e.preventDefault();
        var user_id = $('#deleteUserModal').find('#delete_user_id').val();
        console.log(user_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "user/delete/";
        $.ajax({
            url : url + user_id,
            type: "DELETE",
            dataType: 'json',
            success: function(response) {
                if(response.status == 404){
                   console.log(response.error);
                }
                console.log(response.message);
                toastr.success("Xóa người dùng thành công");
                $("#deleteUserModal").modal("hide");
                fetchUser();
            }
        });
        
    });

    //TODO: Blocked User
    $(document).on("click", '.btn-blocked__user', function(e) {
        e.preventDefault();
        var user_id = $(this).val();
        var url = "user/blocked/";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : url + user_id,
            type: "PUT",
            dataType: 'json',
            success: function(response) {
                if(response.status == 404){
                   console.log(response.error);
                }
                toastr.success("Khóa người dùng thành công");
                fetchUser();
            }
        });
    });

    //TODO: Active User
    $(document).on('click', '.btn-active__user', function(e) {
        e.preventDefault();
        var user_id = $(this).val();
        var url = "user/active/";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : url + user_id,
            type: "PUT",
            dataType: 'json',
            success: function(response) {
                if(response.status == 404){
                   console.log(response.error);
                }
                toastr.success("Kích hoạt người dùng thành công");
                fetchUser();
            }
        });
    });

});




