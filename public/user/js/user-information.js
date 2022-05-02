jQuery(document).ready(function() {
    $(document).on('submit', '#profileInfoUserForm', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend:function(){
                $(document).find('#profileInfoUserForm span.error-text').text('');
            },
            success: function (response) {
                if(response.status == 400) {
                    $.each(response.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.status == 404) {
                    console.log(response.error);
                }else{
                    $('#member_name').each(function() {
                        $(this).html($('#profileInfoUserForm').find($('input[name="name"]')).val());
                        $(this).append(`
                            <i class="fa fa-angle-down"></i>
                        `);
                    });
                    toastr.success("Cập nhật thành công");
                }
            }
        });
    });

    $(document).on('submit', '#changePasswordUserForm', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend:function(){
                $(document).find('#changePasswordUserForm span.error-text').text('');
            },
            success: function (response) {
                if(response.status == 400) {
                    $.each(response.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.status == 404) {
                    console.log(response.error);
                }else{
                    $('#changePasswordUserForm')[0].reset();
                    toastr.success("Đổi mật khẩu thành công");
                }
            }
        });
    });
});