$(function () {
  var url = url = new URL(window.location.href);
  path = url.pathname;
  menu_name = path.split('/')[2]

  item_menu_active = '#link-' + menu_name;
  $(item_menu_active).addClass('active');
})