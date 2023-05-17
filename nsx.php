<?php 
    require('widgets/header.php');
?>
<?php 
    require("connect/connect.php");

    // số bản ghi trên một trang
    $gioi_han_tren_mot_trang = 5;

    // truy vấn để lấy tổng số bản ghi(lấy số dòng trong csdl)
    $sql_count = "SELECT COUNT(*) AS total FROM nhaphanphoi";
    $kq_dem = mysqli_query($conn, $sql_count);
    $dong_dem_duoc = mysqli_fetch_assoc($kq_dem);
    $tong_so_dong_dem_duoc = $dong_dem_duoc['total'];

    // tính số trang
    $tong_so_trang = ceil($tong_so_dong_dem_duoc / $gioi_han_tren_mot_trang);

    // xác định trang hiện tại
    $trang_hien_tai = isset($_GET['page']) ? $_GET['page'] : 1;

    // tính trang_bat_dau
    $trang_bat_dau = ($trang_hien_tai - 1) * $gioi_han_tren_mot_trang;

    // truy vấn để lấy dữ liệu cho trang hiện tại
    $sql_data = "SELECT * FROM nhaphanphoi LIMIT $trang_bat_dau, $gioi_han_tren_mot_trang";
    $result_data = mysqli_query($conn, $sql_data);
?>

<html>
<head>
    <title>Quản lý nhà cung cấp</title>
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2 style="text-align: center; color:aqua">Danh sách nhà PHÂN PHỐI</h2>

    <table class="tab">
        <thead>
            <tr>
                <th>Mã NCC</th>
                <th>Tên NCC</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result_data)): ?>
                <tr>
                    <td><?php echo $row['mapp']; ?></td>
                    <td><?php echo $row['tenpp']; ?></td>
                    <td><?php echo $row['diachipp']; ?></td>
                    <td><?php echo $row['sdtpp']; ?></td>
                    <td>
                    <a class="button" href="nhaphanphoi.php?action=edit&id=<?php echo $row['mapp']; ?>">Sửa</a>
                    <?php echo "<script>function confirmDelete() { return confirm('Bạn có chắc chắn muốn xóa không?');}</script>";?>
                    <a class="button" href="nhaphanphoi.php?action=delete&id=<?php echo  $row['mapp']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php if ($tong_so_trang > 1): ?>
        <div class="phantrang">
            <?php if ($trang_hien_tai > 1): ?>
                <a href="?page=<?php echo $trang_hien_tai - 1; ?>">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $tong_so_trang; $i++): ?>
            <?php if ($i == $trang_hien_tai): ?>
                <a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
            <?php else: ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
            <?php if ($i < $tong_so_trang): ?>
                &nbsp; 
            <?php endif; ?>
            <?php endfor; ?>

            <?php if ($trang_hien_tai < $tong_so_trang): ?>
            &nbsp; 
            <a href="?page=<?php echo $trang_hien_tai + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div style="text-align: center; margin:20px">
        <a style="text-decoration:none;" href="themnhapp.php">Thêm Nhà Phân Phối</a>
        <span style="display: inline-block; width: 20px;"></span>
        <a href="thongtinsppp.php" style="text-decoration: none;">Thông Tin Sản Phẩm Phân Phối</a>
    </div>

    </body>
</html>
<?php
// Kiểm tra tham số action được truyền từ URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Kiểm tra tham số action được truyền từ URL

    // Nếu action là edit
    if($action == 'delete') {
        // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
        $id = $_GET['id'];
        $sql = "DELETE FROM sanphampp WHERE mapp = '$id';
        DELETE FROM nhaphanphoi WHERE mapp = '$id';";
        if(mysqli_multi_query($conn, $sql)){
            echo "<script>
                    alert('Xóa dữ liệu thành công!');
                    window.location.replace('nhaphanphoi.php');
                  </script>";
        } else{
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