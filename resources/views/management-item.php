<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Items</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./home">
                <div class="sidebar-brand-text mx-2">A Little Daisy</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./home">
                    <i class="fa-solid fa-house fa-lg"></i>
                    <span>Tổng quan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lí
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="./management-item">
                    <i class="fa-solid fa-box-archive fa-lg"></i>
                    <span>Quản lí kho hàng</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="./management-order">
                    <i class="fa-solid fa-money-bills fa-lg"></i>
                    <span>Quản lí đơn hàng</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="./management-bill">
                <i class="fa-solid fa-money-bills fa-lg"></i>
                    <span>Quản lí hóa đơn</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Thêm
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fa-solid fa-shop fa-lg"></i>
                    <span>Cửa hàng</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column pt-4">
            <div class="container mt-6">
                <h2 class="text-left mb-4">Quản lí sản phẩm</h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#trash-can-modal'>
                        <i class="fa-solid fa-trash-can fa-lg"></i> Thùng rác (<?php echo mysqli_num_rows($deleted_products_data); ?>)
                    </button>
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#add-modal'>
                        <i class="fa-solid fa-plus fa-lg"></i> Thêm sản phẩm
                    </button>
                    <input type="text" id="search-input" class="form-control search-input" placeholder="Tìm kiếm sản phẩm..." style='width: 320px'>
                </div>

                <table class="table table-striped mt-4">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">ID</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Ngày khởi tạo</th>
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col">Loại</th>
                            <th scope="col" colspan='2'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($products_data) > 0) {
                            while ($row = mysqli_fetch_assoc($products_data)) {
                                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['count']}</td>
                            <td>{$row['created_at']}</td>
                            <td>{$row['updated_at']}</td>
                            <td>{$row['category_id']}</td>
                            <td><button type='button' class='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modify-modal' data-id='{$row['id']}' data-name='{$row['name']}' data-price='{$row['price']}' data-count='{$row['count']}' data-category='{$row['category_id']}'>Sửa</button></td>
                            <td><button type='button' class='btn btn-danger'data-bs-toggle='modal' data-bs-target='#soft-delete-modal' data-id='{$row['id']}'>Xóa</button></td>
                        </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            include('./resources/views/partials/modify.html');
            include('./resources/views/partials/delete.html');
            include('./resources/views/partials/add_product.html');
            include('./resources/views/partials/trash-can.php');
            ?>

            <footer class="footer mt-auto py-3 bg-light">
                <div class="container text-center">
                    <span class="text-muted">Copyright &copy; A Little Daisy</span>
                </div>
            </footer>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/41cf1aa121.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/tablesort.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#modify-modal').on('show.bs.modal', function(event) {

                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var price = button.data('price');
                var count = button.data('count');
                var category = button.data('category');

                var modal = $(this);
                modal.find('.modal-body #product-id').val(id);
                modal.find('.modal-body #product-name').val(name);
                modal.find('.modal-body #product-price').val(price + ' VND');
                modal.find('.modal-body #product-count').val(count);
                modal.find('.modal-body #product-category').val(category);
            });

            $('#save-modify').on('click', function() {
                var id = $('.modal-body #product-id').val();
                var name = $('.modal-body #product-name').val();
                var price = $('.modal-body #product-price').val();
                var count = $('.modal-body #product-count').val();
                var category = $('.modal-body #product-category').val();
                $.ajax({
                    url: '',
                    type: 'PATCH',
                    data: JSON.stringify({
                        id: id,
                        name: name,
                        price: price,
                        count: count,
                        category: category
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

            $('#soft-delete-modal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('.modal-body #product-id').val(id);
            });

            $('#save-soft-delete').on('click', function() {
                var id = $('#soft-delete-modal #product-id').val();
                $.ajax({
                    url: '',
                    type: 'SOFT_DELETE',
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Tablesort(document.querySelector('.table'));

            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase();
                const table = document.querySelector('.table tbody');
                const rows = table.getElementsByTagName('tr');

                Array.from(rows).forEach(function(row) {
                    const cells = row.getElementsByTagName('td');
                    let match = false;
                    for (let cell of cells) {
                        if (cell.textContent.toLowerCase().includes(filter)) {
                            match = true;
                            break;
                        }
                    }
                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>