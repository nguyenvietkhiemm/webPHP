<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Orders</title>

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
                <h2 class="text-left mb-4">Quản lí đơn hàng</h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#add-order-modal'>
                        <i class="fa-solid fa-plus fa-lg"></i> Thêm đơn hàng
                    </button>
                    <input type="text" id="search-input" class="form-control search-input" placeholder="Tìm kiếm sản phẩm..." style='width: 320px'>
                </div>

                <table class="table table-striped mt-4">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Phương thức</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Ngày nhận</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($orders_data) > 0) {
                            while ($row = mysqli_fetch_assoc($orders_data)) {
                                echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['note']}</td>
                            <td>{$row['order_date']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['shipping_method']}</td>
                            <td>{$row['shipping_address']}</td>
                            <td>{$row['shipping_date']}</td>
                            <td>{$row['payment_method']}</td>
                            <td><button type='button' class='btn btn-primary'data-bs-toggle='modal' data-bs-target='#detail-modal' data-id='{$row['id']}'>Detail</button></td>
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
            $orders_detail_array = [];
            while ($row = mysqli_fetch_assoc($orders_detail_data)) {
                $orders_detail_array[] = $row;
            }

            $orders_detail_json = json_encode($orders_detail_array);
            ?>

            <?php 
            $orders_array = [];
            mysqli_data_seek($orders_data, 0);
            while ($row = mysqli_fetch_assoc($orders_data)) {
                $orders_array[] = $row;
            }

            $orders_json = json_encode($orders_array);
            ?>

            <?php
            $products_array = [];
            mysqli_data_seek($products_data, 0);
            while ($row = mysqli_fetch_assoc($products_data)) {
                $products_array[] = $row;
            }

            $products_data_json = json_encode($products_array);
            ?>

            <?php
            include('./resources/views/partials/detail.php');
            include('./resources/views/partials/add_order.php');
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
</body>

</html>