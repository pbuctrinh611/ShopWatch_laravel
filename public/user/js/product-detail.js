// $(document).ready(function() {
//     var url = window.location.pathname;
//     var productID= url.substring(url.lastIndexOf('/') + 1);
//     fetchProductDetailPage(productID);
//     console.log(productID)
// });

// function fetchProductDetailPage(productID) {
//     console.log('fetchProductDetailPage',productID)
//     $.ajax({
//         url: "fetch-product-detail__page",
//         type: "GET",
//         data: {
//             productID: productID
//         },
//         dataType: "json",
//         success: function (response) {
//             $(".mirora-single-product").html("");
//             $.each(response.product, function (key, item) {
//                $(".mirora-single-product").append('<div class="row">\
//                <div class="col-lg-6">\
//                <div class="tab-content product-details-thumb-large" id="myTabContent-3">\
//                    <div class="tab-pane fade show active" id="thumb-1">\
//                        <div class="product-details-img easyzoom">\
//                            <a class="popup-btn" href="">\
//                                <img src="'+item.image+'" alt="product">\
//                            </a>\
//                        </div>\
//                    </div>\
//                </div>\
//            </div>\
//         </div>')});
//         }
//     });
// }

// $('select[name=id_color]').change(function() {
//     var optionSelected = $("option:selected", this)
//     $('#product-qty').text(optionSelected.data('qty'))
//     //$('#product-price').text(formatCurrency(optionSelected.data('price')))
// })

jQuery(document).ready(function() {
    //TODO: Display product number default
    var optionDefault = $('#id_color > option').eq(0);
    var productQuantyDefault = optionDefault.data('qty');
    $('#product_qty_stock').text(productQuantyDefault);

    //TODO: Display product number according to the color selected
    $(document).on('change', '#id_color', function(e) {
        e.preventDefault();
        var optionSelected = $("option:selected", this);
        var productQuantySelected = optionSelected.data('qty');
        $('#product_qty_stock').text(productQuantySelected);
    });
});