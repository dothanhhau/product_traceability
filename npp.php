<?php
    require 'site.php';
    load_top();
    load_header();
?>
<?php
    require("connect/connect.php");

    // số bản ghi trên một trang
    $records_per_page = 5;
    // truy vấn để lấy tổng số bản ghi(lấy số dòng trong csdl)
    $count_query = "SELECT COUNT(*) AS total FROM nhaphanphoi";
    $count_result = mysqli_query($conn, $count_query);
    $row_count = mysqli_fetch_assoc($count_result);
    $total_records = $row_count['total'];
    // tính số trang
    $total_pages = ceil($total_records / $records_per_page);
    // xác định trang hiện tại
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    // tính trang_bat_dau
    $start_record = ($current_page - 1) * $records_per_page;

    // truy vấn để lấy dữ liệu cho trang hiện tại
    $data_query = "SELECT * FROM nhaphanphoi LIMIT $start_record, $records_per_page";
    $data_result = mysqli_query($conn, $data_query);
?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table.tab {
            border-collapse: collapse;
            margin: 26px auto 0 auto;
            font-size: 1.6rem;
            line-height: 2.2rem;
            border: solid 1px #ccc;
        }

        thead {
            line-height: 7rem;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        td {
            padding: 18px 48px;
        }

        tr:hover {
            cursor: pointer;
        }

        thead>tr:hover {
            cursor: default;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;

        }

        tr:hover {
            background-color: #ccc;
        }

        .button {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 30px;
        }

        .button:hover {
            background-color: var(--secondary-color);
        }

        .phantrang {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 41px 0 30px 0;
            font-size: 1.4rem;
        }

        .phantrang a {
            padding: 0 8px;
            text-decoration: solid;
            margin: 0 5px;
        }

        .phantrang a:hover {
            background-color: var(--primary-color);
        }

        .phantrang a,
        .phantrang .current-page {
            display: inline-block;
            margin: 0 5px;
            padding: 5px 10px;
            background-color: var(--secondary-color);
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #fff;
        }

        .phantrang .current-page {
            font-weight: bold;
            background-color: #ccc;
        }

        .feature-npp {
            padding-bottom: 50px;
        }

        .feature-npp a {
            display: inline-block;
            padding: 16px 10px;
            background-color: var(--primary-color);
            color: #fff;
            font-size: 1.4rem;
            width: 218px;
            border-radius: 8px;
        }

        .feature-npp a:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>

<body>

    <h2 style="text-align: center; color: #333; font-size: 2.4rem; margin-top: 58px;">Danh sách nhà sản xuất</h2>

    <table align="center" class="tab">
        <thead>
            <tr>
                <th>Mã NSX</th>
                <th>Tên NSX</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($data_result)) : ?>
                <tr>
                    <td><?php echo $row['mapp']; ?></td>
                    <td><?php echo $row['tenpp']; ?></td>
                    <td><?php echo $row['diachipp']; ?></td>
                    <td><?php echo $row['sdtpp']; ?></td>
                    <td>
                        <a class="button" href="nhaphanphoi.php?action=edit&id=<?php echo $row['mapp']; ?>">Sửa</a>
                        <?php echo "<script>function confirmDelete() { return confirm('Bạn có chắc chắn muốn xóa không?');}</script>"; ?>
                        <a class="button" href="nhaphanphoi.php?action=delete&id=<?php echo  $row['mapp']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1) : ?>
        <div class="phantrang">
            <?php if ($current_page > 1) : ?>
                <a href="?page=<?php echo $current_page - 1; ?>">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <?php if ($i == $current_page) : ?>
                    <a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
                <?php else : ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>

                <?php if ($i < $total_pages) : ?>
                    &nbsp;
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages) : ?>
                &nbsp;
                <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="feature-npp" style="text-align: center;">
        <a style="text-decoration:none;" href="themnhapp.php">Thêm Nhà Phân Phối</a>
        <span style="display: inline-block; width: 20px;"></span>
        <a href="thongtinsppp.php" style="text-decoration: none;">Thông Tin Sản Phẩm Phân Phối</a>
    </div>
    <?php
    load_footer();
    ?>
    <?php
    // Kiểm tra tham số action được truyền từ URL
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        // Kiểm tra tham số action được truyền từ URL

        // Nếu action là edit
        if ($action == 'delete') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];
            $sql = "DELETE FROM sanphampp WHERE mapp = '$id';
        DELETE FROM nhaphanphoi WHERE mapp = '$id';";
            if (mysqli_multi_query($conn, $sql)) {
                echo "<script>
                    alert('Xóa dữ liệu thành công!');
                    window.location.replace('nhaphanphoi.php');
                  </script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
        // Nếu action là edit
        if ($action == 'edit') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];
            $sql = "SELECT * FROM nhaphanphoi WHERE mapp = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // Hiển thị form sửa thông tin nhà phân phối
            echo '
            <div class="edit-form-overlay"></div>
            <div class="edit-form-container">
                <h2>Sửa thông tin nhà phân phối</h2>
                <form method="POST" action="">
                    <input type="hidden" name="mapp" value="' . $row['mapp'] . '">
                    <div class="form-group">
                        <label for="tenpp">Tên nhà phân phối:</label>
                        <input type="text" name="tenpp" class="form-control" value="' . $row['tenpp'] . '">
                    </div>
                    <div class="form-group">
                        <label for="diachipp">Địa chỉ:</label>
                        <input type="text" name="diachipp" class="form-control" value="' . $row['diachipp'] . '">
                    </div>
                    <div class="form-group">
                        <label for="sdtpp">Số điện thoại:</label>
                        <input type="text" name="sdtpp" class="form-control" value="' . $row['sdtpp'] . '">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditForm()">Hủy</button>
                </form>
            </div>
        ';

            //Thêm mã JavaScript để hiển thị và ẩn form sửa thông tin nhà phân phối
            echo '
            <script>  
                function closeEditForm() {
                    document.querySelector(".edit-form-overlay").style.display = "none";
                    document.querySelector(".edit-form-container").style.display = "none";
                }
                showEditForm();
            </script>
        ';
        }

        // Kiểm tra nút "Lưu" đã được nhấn hay chưa
        if (isset($_POST['submit'])) {
            // Lấy dữ liệu từ form
            $mapp = $_POST['mapp'];
            $tenpp = $_POST['tenpp'];
            $diachipp = $_POST['diachipp'];
            $sdtpp = $_POST['sdtpp'];

            // Truy vấn để cập nhật thông tin nhà phân phối
            $sql = "UPDATE nhaphanphoi SET tenpp='$tenpp', diachipp='$diachipp', sdtpp='$sdtpp' WHERE mapp='$mapp'";
            $result = mysqli_query($conn, $sql);

            // Hiển thị
            // Kiểm tra kết quả truy vấn
            if ($result) {
                // Hiển thị thông báo cập nhật thành công và chuyển về trang danh sách nhà phân phối
                echo '
            <script>
                alert("Cập nhật thông tin nhà phân phối thành công!");
                window.location.href = "nhaphanphoi.php";
            </script>
        ';
            } else {
                // Hiển thị thông báo cập nhật thất bại
                echo '
            <script>
                alert("Cập nhật thông tin nhà phân phối thất bại!");
            </script>
        ';
            }
        }
    }
    // Đóng kết nối CSDL
    mysqli_close($conn);
    ?>