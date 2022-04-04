function getOption(obj) {
  options = obj.reduce(function (a, b) {
    return a + '<option value="' + b.id + '">' + b.name + '</option>';
  }, '');

  return options;
}

function checkSelected(value, elm) {
  if (value) {
      elm.attr("selected", "selected")
  }
}