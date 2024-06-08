<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var orders_detail_data = <?php echo $orders_detail_json; ?>;
    console.log(orders_detail_data);
    $(document).ready(function() {
        $('#detail-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var orders_detail_data_filtered = orders_detail_data.filter(function(order) {
                return order.order_id == id; // So sánh id với order.id
            });

            var tableBody = $('#detail-modal tbody');
            tableBody.empty();

            if (orders_detail_data_filtered.length > 0) {
                orders_detail_data_filtered.forEach(function(row) {
                    var rowHtml = '<tr>' +
                        '<td>' + row.id + '</td>' +
                        '<td>' + row.order_id + '</td>' +
                        '<td>' + row.product_id + '</td>' +
                        '<td>' + row.name + '</td>' +
                        '<td>' + row.price + '</td>' +
                        '<td>' + row.number_of_products + '</td>' +
                        '<td>' + row.total_money + '</td>' +
                        '</tr>';
                    tableBody.append(rowHtml);
                });
                let total_money = orders_detail_data_filtered.reduce(function(acc, curr) {
                    return acc + Number(curr.total_money);
                }, 0)

                tableBody.append('<tr>'+ '<td colspan = "6" class = "font-weight-bold">TỔNG GIÁ TRỊ HÓA ĐƠN</td>'+ '<td>' + String(total_money) + '</td>' + '</tr>');
            } else {
                var noDataHtml = '<tr><td colspan="7" class="text-center">Không có dữ liệu</td></tr>';
                tableBody.append(noDataHtml);
            }
        });
    });
</script>
<div class="modal fade" id="detail-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Chi tiết</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <table class="table">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">ID</th>
                            <th scope="col">ID Order</th>
                            <th scope="col">ID sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiển</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>