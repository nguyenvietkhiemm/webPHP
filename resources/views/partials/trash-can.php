<div class="modal fade" id="trash-can-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Thùng rác</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <table class="table table-striped">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">ID</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Ngày khởi tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Loại</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($deleted_products_data) > 0) {
                            while ($row = mysqli_fetch_assoc($deleted_products_data)) {
                                echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['count']}</td>
                                <td>{$row['created_at']}</td>
                                <td>{$row['updated_at']}</td>
                                <td>{$row['category_id']}</td>
                                <td><button type='button' class='btn btn-success' id = 'restore' data-id='{$row['id']}'>Khôi phục</button></td>
                                <td><button type='button' class='btn btn-danger'data-bs-toggle='modal' data-bs-target='#delete-modal' data-id='{$row['id']}'>Xóa</button></td>
                            </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="save-modify">Lưu điều chỉnh</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xóa mặt hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label>Bạn chắc chắn muốn xóa vĩnh viễn mặt hàng này?</label>
                <input class="form-control" type="text" id="product-id" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" id="save-delete">Xóa</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#restore').on('click', function(event) {
            var button = $(this);
            console.log(button);
            var id = button.data('id');
            console.log(id);
            $.ajax({
                url: '',
                type: 'RESTORE',
                data: JSON.stringify({
                    id: id,
                }),
                contentType: 'application/json',
                success: async function(response) {
                    await Swal.fire({
                        title: 'Thành công',
                        text: 'Dữ liệu về mặt hàng đã được cập nhật thành công',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    location.reload();
                },
                error: async function(xhr, status, error) {
                    await Swal.fire({
                        title: 'Lỗi',
                        text: 'Dữ liệu về mặt hàng đã gặp lỗi khi chỉnh sửa: ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    location.reload();
                }
            });
        });

        $('#delete-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body #product-id').val(id);
        });

        $('#save-delete').on('click', function() {
            var id = $('#delete-modal #product-id').val();
            $.ajax({
                url: '',
                type: 'DELETE',
                data: JSON.stringify({
                    id: id,
                }),
                contentType: 'application/json',
                success: async function(response) {
                    await Swal.fire({
                        title: 'Thành công',
                        text: 'Đã xóa thành công mặt hàng',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    location.reload();
                },
                error: async function(xhr, status, error) {
                    await Swal.fire({
                        title: 'Lỗi',
                        text: 'Gặp lỗi khi xóa mặt hàng ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    location.reload();
                }
            });
        });
    });
</script>