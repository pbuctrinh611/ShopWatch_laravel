jQuery(document).ready(function() {
    function formatCurrency(n) {
        n =  Math.floor(n);
        return n.toLocaleString('it-IT').replaceAll('.',',') + " VND";
    }

    fetchOrderHistoryPage();
    function fetchOrderHistoryPage() {
        $.ajax({
            url: 'fetch-order-history__page',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#order-history__content').html('');
                $.each(response.orders, function(key, item) {
                    $('#order-history__content').append(
                        '<tr class="row-cart">\
                                <td>\
                                    <strong>'+item.id+'</strong>\
                                </td>\
                                <td>\
                                    <strong>'+item.address+'</strong>\
                                </td>\
                                <td>\
                                    <strong>'+item.order_at+'</strong>\
                                </td>\
                                <td class="text-center"><strong>'+
                                (item.status == 0 ? 'Chưa duyệt' : 'Đã duyệt')+
                                '</strong></td>\
                                <td class="text-center"><strong>'+
                                (item.payment_method == 1 ? 'Khi giao hàng' : 'Paypal')+
                                '</strong></td>\
                                <td class="text-center">\
                                    <strong>'+item.note+'</strong>\
                                </td>\
                                <td>\
                                    <strong> '+(formatCurrency(item.total_money))+'</strong>\
                                </td>\
                    </tr>');
                });
            }
        });
    }
});