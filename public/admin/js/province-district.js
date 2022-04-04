function getOptionProvince(provinces) {
  dfOption = '<option disabled selected value="">Chọn Tỉnh/Thành phố</option>';
  options = provinces.reduce(function (a, b) {
    return a + '<option value="' + b.id + '">' + b.name + '</option>';
  }, '');

  return dfOption + options;
}

function getOptionDistrict(districts) {
  dfOption = '<option disabled selected value="">Chọn Quận/Huyện</option>';
  options = districts.reduce(function (a, b) {
    return a + '<option value="' + b.id + '">' + b.name + '</option>';
  }, '');

  return dfOption + options;
}