jQuery(document).ready(function() {

    // Fetch User
    fetchUser();
    function fetchUser() {
        $.ajax({
            url : 'fetch-user',
            type: "GET",
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
                            <td>'+defaultStatus+'</td>\
                            <td>'+ defaultRole+'</td>\
                            <td><button type="button" value="'+item.id+'" class="btn btn-primary btn-edit__user mr-2" data-backdrop="false">Edit</button>\
                                <button value="'+item.id+'" class="btn btn-danger" id="btn-delete__user">Delete</button></td>\
                        </tr>');
                });
            }
        });
    }

     
    // Open Create User Modal And Add User
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
          
            $.ajax({
                url: $(this).attr('action'),
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

      //Open Create Modal Edit
       $(document).on('click', '.btn-edit__user', function (e) {
        e.preventDefault();
        var user_id = $(this).val();
        $('#editUserModal').modal('show');
        var url = "user/edit/";
        $.ajax({
            url: url + user_id,
            type: "GET",
            success: function (response) {
                if(response.status == 404) {
                    console.log('fail');
                }else {
                    $('#name').val(response.user_edit.name);
                    $('#tel').val(response.user_edit.tel);
                    $('#email').val(response.user_edit.email);        
                }
            }
        });
    });
   

 

});

//Edit User


