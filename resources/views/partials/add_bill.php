<div class="modal fade" id="add-bill-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin hóa đơn mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-start align-items-center mb-3">
                    <div class="form-group me-3" style="width: 100px">
                        <label>ID đơn hàng</label>
                        <input type="text" class="form-control" id="order-id" readonly>
                    </div>
                    <div class="form-group me-3" style="width: 100px">
                        <label>ID User</label>
                        <input type="text" class="form-control" id="user-id">
                    </div>
                </div>

                <div class="form-group">
                    <label>Ghi chú</label>
                    <input type="text" class="form-control" id="note">
                </div>
            </div>

            <div class="modal-body container">
                <table class="table table-striped">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">Sản phẩm</th>
                            <th scope="col" style="width: 100px">ID</th>
                            <th scope="col" style="width: 200px">Giá</th>
                            <th scope="col" style="width: 160px">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" id="add-row">Thêm sản phẩm</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="save-add-bill">Lưu sản phẩm</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Tất cả đống này đều chỉ là validate dữ liệu thôi
        $('#add-bill-modal').on('show.bs.modal', function() {
            var modal = $(this);
            var products_data = <?php echo $products_data_json; ?>;
            var bills_data = <?php echo $bills_json; ?>;
            var index = 0;
            modal.find('#order-id').val(Number(bills_data[bills_data.length - 1].id) + 1);

            var tableBody = modal.find('tbody');
            tableBody.empty();

            function addRow() {

                var row = '<select class="form-control product-select" data-index="' + index + '">'
                products_data.forEach(function(product) {
                    row += '<option value="' + product.id + '" data-price="' + product.price + '">' + product.name + '</option>';
                });
                row += '</select>';

                tableBody.append('<tr>' +
                    '<td>' + row + '</td>' +
                    '<td><input type="text" class="form-control product-id" data-index="' + index + '" readonly></td>' +
                    '<td><input type="text" class="form-control product-price" data-index="' + index + '" readonly></td>' +
                    '<td><input type="text" class="form-control product-quantity" data-index="' + index + '"></td>' +
                    '</tr>');

                // Thiết lập giá trị mặc định cho dòng mới
                tableBody.find('.product-select[data-index="' + index + '"]').trigger('change');

                index++;
            }
            addRow();

            $('#add-row').off('click').on('click', addRow);

            tableBody.on('change', '.product-select', '.product-quantity', function() {
                let index = $(this).data('index');
                var selectedOption = $(this).find('option:selected');
                var id = selectedOption.val();
                var price = selectedOption.data('price');

                tableBody.find('.product-id[data-index="' + index + '"]').val(id);
                tableBody.find('.product-price[data-index="' + index + '"]').val(price);

                var quantity = Number(tableBody.find('.product-quantity[data-index="' + index + '"]').val());

                var product = products_data.find(function(product) {
                    return product.id == id;
                });
                var count = product.count;

                if (quantity > count) {
                    tableBody.find('.product-quantity[data-index="' + index + '"]').val(count);
                }
            });

            tableBody.on('input', '.product-quantity', function() {
                let index = $(this).data('index');
                var quantity = Number($(this).val());
                var id = Number(tableBody.find('.product-id[data-index="' + index + '"]').val());

                var product = products_data.find(function(product) {
                    return product.id == id;
                });
                var count = product.count;

                if (quantity > count) {
                    $(this).val(count);
                }
            });

            $('#save-add-bill').off('click').on('click', function() {
                var order_id = Number(modal.find('#order-id').val());
                var user_id = Number(modal.find('#user-id').val());
                var note = modal.find('#note').val();

                var products = [];
                tableBody.find('tr').each(function() {
                    var product_id = Number($(this).find('.product-id').val());
                    var product_price = Number($(this).find('.product-price').val());
                    var product_quantity = Number($(this).find('.product-quantity').val());

                    products.push({
                        product_id,
                        product_price,
                        product_quantity
                    });
                });

                $.ajax({
                    url: '',
                    type: 'POST',
                    data: JSON.stringify({
                        order_id,
                        user_id,
                        note,
                        products,
                    }),
                    contentType: 'application/json',
                    success: async function(response) {
                        await Swal.fire({
                            title: 'Thành công',
                            text: 'Dữ liệu về hóa đơn đã được thêm thành công',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        location.reload();
                    },
                    error: async function(xhr, status, error) {
                        await Swal.fire({
                            title: 'Lỗi',
                            text: 'Dữ liệu về hóa đơn đã gặp lỗi khi thêm: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });

                        location.reload();
                    }
                });
            });
        });
    });
</script>