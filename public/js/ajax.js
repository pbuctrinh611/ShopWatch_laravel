function ajax(url, data, method, success, error) {
  $('.box-spinner').removeClass('d-none')
  $.ajax({
    url: url,
    data: data,
    type: method,
    success: function (result) {
      success(result);
      $('.box-spinner').addClass('d-none')
    },
    error: function(err) {
      error(err);
      $('.box-spinner').addClass('d-none');
    }
  });
}