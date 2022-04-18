jQuery(document).ready(function($){
    //User Register
    $('#registerForm').submit(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method:  "POST",
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function(data) {
                if(data.status == 200) {
                    toastr.success("Đăng ký thành công");
                    jQuery('#registerForm').trigger("reset"); 
                }else {
                    $.each(data.error, function(prefix, val) {
                        $('span.'+prefix + '_error').text(val[0]);
                    });
                    console.log('Fail');
                }
            }  
        });
    });
});