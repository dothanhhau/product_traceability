<?php
    require 'site.php';
    load_top();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != "nsx")
        if($_SESSION['checkLogin'])
            header('Location: index.php');
        else
            header('Location: login.php');
    load_header();
?>
<head>
    <style>
        .wrapper-product {
            height: 100vh;
        }
        .product-details {
            padding: 16px;
            background-color: #fff;
            border-radius: 8px;
        }
        .product-details h2 {
            text-align: center;
            font-size: 2.4rem;
            font-weight: 500;
            line-height: 3rem;
            margin: 3px 0 20px;
            word-spacing: 5px;
        }
        .image-column img {
            width: 100%;
            box-shadow: 0 0 10px rgb(0, 0, 0, 0.2);
            
        }
        .info-column {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        table {
            font-size: 2rem;
            line-height: 2.4rem;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .hanhdongs {
            display: flex;
            justify-content: space-evenly;
            margin-top: 100px;
        }
        .hanhdongs a {
            display: inline-block;
            padding: 16px 10px;
            border-radius: 40px;
            font-size: 1.8rem;
            width: 150px;
            background-color: green;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            text-align: center;
        }

        .hanhdongs a {
            margin-right: 10px;
        }
        
        .hanhdongs a:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>
<?php
    require("connect/connect.php");

// Lấy mã từ trang nhà phân phối
    if (isset($_GET['id'])) {
        $malay = $_GET['id'];
        mysqli_query($conn, "SET NAMES 'utf8'");

        // Thực hiện truy vấn để lấy thông tin chi tiết từ bảng sản phẩm nhà phân phối
        $sql = "SELECT * FROM sanphamnsx WHERE maspnsx='$malay'";
        $kq = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_array($kq)) {
            echo "
                <div class='separation'></div>
                <div class='grid wide wrapper-product'>
                    <div class='product-details'>
                        <h2>Chi tiết sản phẩm</h2>
                        <div class='row'>
                            <div class='col l-6'>
                                <div class='image-column'>
                                    <img src='./assets/img/products/" . $row['hinhanh'] . "' width='300px' height='auto'>
                                </div>
                            </div>
                            <div class='col l-6'>
                                <div class='info-column'>
                                    <div>
                                        <table align='center'>
                                            <tr>
                                                <td>Mã Sản Phẩm:</td>
                                                <td>" . $row['maspnsx'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Mã nhà sản xuất:</td>
                                                <td>" . $row['mansx'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Tên Sản Phẩm Sản Xuất:</td>
                                                <td>" . $row['tenspnsx'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày sản xuất:</td>
                                                <td>" . $row['ngaysanxuat'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày xuất hàng:</td>
                                                <td>" . $row['ngayxuathang'] . "</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class='hanhdongs'>
                                        <a href='?hanhdong=edit-sp&id=" . $row['maspnsx'] . "'>Sửa</a>
                                        <a href='?hanhdong=delete&id=" . $row['maspnsx'] . "'onclick=\"return confirm('Bạn có chắc muốn xóa?')\">Xóa</a>
                                        <a href='nsx.php?loc=all-sp'>Trở về</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
    }
    load_footer();
    if (isset($_GET['hanhdong'])) {
        $hanhdong = $_GET['hanhdong'];

        // Kiểm tra tham số hanhdong được truyền từ URL

        // Nếu hanhdong là delete
        if ($hanhdong == 'delete') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];
            $sql = "DELETE FROM sanphamnsx WHERE maspnsx = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Xóa dữ liệu thành công!');
                        window.location.replace('nsx.php?loc=all-sp');
                    </script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
        if ($hanhdong == 'edit-sp') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM sanphamnsx, nhasanxuat 
                    WHERE sanphamnsx.mansx = nhasanxuat.mansx
                    AND tendangnhap= '".$_SESSION['tendn']."'
                    AND sanphamnsx.maspnsx = '{$id}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            echo '
                <div class="form-overlay" onclick="closeForm()"></div>
                <div class="form-container">
                    <h2>Sửa thông tin sản phẩm</h2>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="hinhanh">
                        </div>
                        <div class="form-group">
                            <input type="text" name="masp" class="form-control" value="' . $row['maspnsx'] . '" placeholder="Mã sản phẩm">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tensp" class="form-control" value="' . $row['tenspnsx'] . '" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-btn form-btn-edit-sp">
                            <button type="submit" name="submit-sp" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" onclick="closeForm()">Hủy</button>
                        </div>
                    </form>
                </div>
            ';

            //Thêm mã JavaScript để hiển thị và ẩn form sửa thông tin nhà phân phối
            echo '
            <script>  
                function closeForm() {
                    document.querySelector(".form-overlay").style.display = "none";
                    document.querySelector(".form-container").style.display = "none";
                    window.history.back();
                }
            </script>';
        }

        if (isset($_POST['submit-sp'])) {
            $id = $_GET['id'];

            $maspnsx = $_POST['masp'];
            $tenspnsx = $_POST['tensp'];
            if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
                $path = "img/".$_FILES['hinhanh']['name'];
                $sql = "UPDATE sanphamnsx SET maspnsx='$maspnsx', tenspnsx='$tenspnsx', hinhanh='$path' WHERE maspnsx='$id'";
                move_uploaded_file($_FILES['hinhanh']['tmp_name'], "assets/img/products/img/".$_FILES['hinhanh']['name']);
            }
            else {
                $sql = "UPDATE sanphamnsx SET maspnsx='$maspnsx', tenspnsx='$tenspnsx' WHERE maspnsx='$id'";
            }

            $result = mysqli_query($conn, $sql);

            // Hiển thị
            // Kiểm tra kết quả truy vấn
            if ($result) {
                echo '
                    <script>
                        alert("Cập nhật thông tin nhà phân phối thành công!");
                        window.location.href = "?id='.$maspnsx.'";
                    </script>';
            } else {
                // Hiển thị thông báo cập nhật thất bại
                echo '
                    <script>
                        alert("Cập nhật thông tin nhà phân phối thất bại!");
                    </script>';
            }
        }
    }
?>