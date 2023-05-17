<?php 
    require 'site.php';
    load_top();
    load_header();
?>
<?php 
    require("connect/connect.php");

    $role = "WHERE vaitro = 'nsx' OR vaitro = 'npp'";
    if(isset($_POST['btn-nsx']))
        $role = "WHERE vaitro = 'nsx'";
    else if(isset($_POST['btn-npp']))
        $role = "WHERE vaitro = 'npp'";
    
    $records_per_page = 5;
    
    $count_query = "SELECT COUNT(*) AS total FROM taikhoan ".$role;
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
    $data_query = "SELECT * FROM taikhoan ".$role." LIMIT $start_record, $records_per_page";
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
        thead > tr:hover {
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
            padding: 25px 0 30px 0;
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
        .phantrang a, .phantrang .current-page {
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
        .filter {
            text-align: center;
            font-size: 1.4rem;
            margin: -8px 0 19px 0;
        }
        .filter label {
            margin-right: 8px;
        }
        .filter input {
            width: 106px;
            padding: 8px;
            border: none;
            background-color: #ccc;
            border-radius: 5px;
        }
        .filter input:hover {
            cursor: pointer;
            opacity: 0.9;
        }
        
        .add-form-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 20;
        }

        .add-form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 40px 40px 50px 40px;
            width: 500px !important;
            font-size: 1.6rem;
            z-index: 21;
            border-radius: 8px;

        }

        .add-form-container {
            width: 400px;
            /* Đặt chiều rộng của khung là 400px */
        }

        .add-form-container h2 {
            font-size: 2.6rem;
            line-height: 3rem;
            margin-bottom: 20px;
        }
        input.form-control {
            width: 100%;
            padding: 16px;
            font-size: 1.8rem;
            margin: 16px 0;
            border-radius: 8px;
            border: solid 1px #ccc;
            outline: none;
        }
        input[type="radio"] {
            transform: scale(1.5);
            margin: 8px 8px 21px 20px;
        }
        .form-vaitro {
            margin: 9px 0 48px;
        }
        .form-btn {
            text-align: center;
        }
        .form-btn button {
            padding: 15px 19px;
            width: 192px;
            font-size: 1.8rem;
            background-color: var(--secondary-color);
            color: #fff;
            font-weight: 500;
            border: none;
            border-radius: 8px;
        }
        button.btn.btn-primary {
            margin-right: 16px;
        }
        button.btn.btn-secondary {
            margin-left: 16px;
        }
        .btn:hover {
            cursor: pointer;
            background-color: var(--primary-color);
        }
    </style>
</head>
<body>

    <h2 style="text-align: center; color: #333; font-size: 2.4rem; margin-top: 58px;">Danh sách các tài khoản</h2>

    <table align="center" class="tab">
        <thead>
            <tr>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Vai trò</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($data_result)): ?>
                <tr>
                    <td><?php echo $row['tendangnhap']; ?></td>
                    <td><?php echo $row['matkhau']; ?></td>
                    <td><?php echo $row['vaitro']; ?></td>
                    <td>
                    <?php echo "<script>function confirmDelete() { return confirm('Bạn có chắc chắn muốn xóa không?');}</script>";?>
                    <a class="button" href="admin.php?action=delete&id=<?php echo  $row['tendangnhap']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
        <div class="phantrang">
            <?php if ($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1; ?>">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $current_page): ?>
                    <a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>

                <?php if ($i < $total_pages): ?>
                    &nbsp; 
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                &nbsp; 
                <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <form class="filter" action="<?php if(isset($_SERVER['PHP_SELF'])) echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="">Lọc: </label>
        <input type="submit" value="Tất cả" name="btn-all">
        <input type="submit" value="Nhà sản xuất" name="btn-nsx">
        <input type="submit" value="Nhà phân phối" name="btn-npp">
    </form>
    <div class="feature-npp" style="text-align: center;">
    
        <a style="text-decoration:none;" href="admin.php?action=add">Thêm tài khoản</a>
    </div>
    
<?php
    // Kiểm tra tham số action được truyền từ URL
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        // Kiểm tra tham số action được truyền từ URL

        // Nếu action là delete
        if($action == 'delete') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];
            $sql = "DELETE FROM taikhoan WHERE tendangnhap = '$id';
            DELETE FROM taikhoan WHERE tendangnhap = '$id';";
            if(mysqli_multi_query($conn, $sql)){
                echo "<script>
                        alert('Xóa dữ liệu thành công!');
                        window.location.replace('admin.php');
                    </script>";
            } else{
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
        // Nếu action là add
        if ($action == 'add') {
            // Hiển thị form thêm tài khoản
            echo '
                <div class="add-form-overlay"></div>
                <div class="add-form-container">
                    <h2>Thêm tài khoản</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="text" name="tendn" class="form-control" placeholder="Tên tài khoản" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                        <div class="form-vaitro">
                            <label for="sdtpp">Vai trò:</label>
                            <input id="nsx" type="radio" name="vaitro" value="nsx" required><label for="nsx" class="checkbox-label">Nhà sản xuất</label>
                            <input id="npp" type="radio" name="vaitro" value="npp" required><label for="npp" class="checkbox-label">Nhà phân phối</label>
                        </div>
                        <div class="form-btn">
                            <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" onclick="closeEditForm()">Hủy</button>
                        </div>
                    </form>
                </div>
            '; // end echo;

            //Thêm mã JavaScript để hiển thị và ẩn form add tài khoản
            echo '
            <script>  
                function closeEditForm() {
                    document.querySelector(".add-form-overlay").style.display = "none";
                    document.querySelector(".add-form-container").style.display = "none";
                }
                showEditForm();
            </script>
        ';
        }

        // Kiểm tra nút "Lưu" đã được nhấn hay chưa
        if (isset($_POST['submit'])) {
            // Lấy dữ liệu từ form
            $tentk = $_POST['tendn'];
            $mk = $_POST['pass'];
            $vaitro = $_POST['vaitro'];

            // Truy vấn để cập nhật thông tin nhà phân phối
            $sql = "INSERT INTO taikhoan VALUES('".$tentk."','".$mk."','".$vaitro."')";
            $result = mysqli_query($conn, $sql);

            // Hiển thị
            // Kiểm tra kết quả truy vấn
            if ($result) {
                // Hiển thị thông báo cập nhật thành công và chuyển về trang danh sách nhà phân phối
                echo '<script>
                        alert("Thêm tài khoản thành công!");
                        window.location.href = "admin.php";
                    </script>';
            } else {
                // Hiển thị thông báo cập nhật thất bại
                echo '<script>
                        alert("Thêm tài khoản thất bại!");
                    </script>';
            }
        }
    }
    
    // Đóng kết nối CSDL
    mysqli_close($conn);
    load_footer();
?>
<!-- <table align="center" border="0">
                            <tr>
                                <td>Tên tài khoản:</td>
                                <td><input type="text" name="tendn" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Mật khẩu:</td>
                                <td><input type="password" name="pass" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Vai trò:</td>
                                <td>
                                    <input type="radio" name="vaitro" value="nsx">Nhà sản xuất
                                    <input type="radio" name="vaitro" value="npp">Nhà phân phối
                                </td>
                            </tr>
                            <tr>
                                <td><button type="submit" name="submit" class="btn btn-primary">Lưu</button></td>
                                <td><button type="button" class="btn btn-secondary" onclick="closeEditForm()">Hủy</button></td>
                            </tr>
                        </table> -->