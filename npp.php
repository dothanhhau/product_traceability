<?php
    require 'site.php';
    load_top();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != "npp")
        if($_SESSION['checkLogin'])
            header('Location: index.php');
        else
            header('Location: login.php');
    load_header();
?>
<?php
    require("connect/connect.php");
    mysqli_query($conn, "SET NAMES 'utf8'");
    if(!isset($_GET['loc']))
    {
        $_GET['loc'] = "all-sp";
    }

    if(isset($_POST['submit-suamk'])) {
        $tendn = $_SESSION['tendn'];
        $mk = $_POST['mkcu'];

        $dong = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM taikhoan WHERE tendangnhap = '$tendn' AND matkhau = '$mk'"));
        if($dong > 0) {
            $mkmoi = $_POST['mkmoi'];
            $re_mkmoi = $_POST['re-mkmoi'];
            if($mkmoi === $re_mkmoi) {
                $str_update = "UPDATE taikhoan SET tendangnhap='$tendn', matkhau='$mkmoi' WHERE tendangnhap='{$_SESSION['tendn']}'";
                $kq1 = mysqli_query($conn, $str_update);
                if($kq1) {
                    echo '
                        <script>
                            alert("Cập nhật thông tin thành công!");
                            window.location.href = "?loc=changeinfo";
                        </script>
                    ';
                }
                else {
                    $mess = "Cập nhật thông tin thất bại!";
                }
            }
            else {
                $mess = "Nhập mật khẩu mới không khớp!";
            }
        }
        else {
            $mess = "Sai mật khẩu cũ!";
        }
    }
    
    if(isset($_GET['loc'])) {
        if($_GET['loc'] != "add" && $_GET['loc'] != "changeinfo") { // all-sp và all-nsx
            $baitren_mottrang = 5;
        
            if($_GET['loc'] == "all-sp") {
                $baitren_mottrang = 10;
        
                $count_query = "SELECT * FROM sanphampp, nhaphanphoi
                                WHERE sanphampp.mapp = nhaphanphoi.mapp 
                                AND tendangnhap= '".$_SESSION['tendn']."'";
                
            }
            else {
                $count_query = "SELECT * FROM nhasanxuat
                            JOIN sanphampp ON nhasanxuat.mansx = sanphampp.mansx
                            JOIN nhaphanphoi ON sanphampp.mapp = nhaphanphoi.mapp
                            WHERE nhaphanphoi.tendangnhap = '{$_SESSION['tendn']}'
                            GROUP BY nhasanxuat.mansx, nhasanxuat.tennsx, nhasanxuat.diachinsx, nhasanxuat.sdtnsx;";
            }
                
            
            $sodong = mysqli_num_rows(mysqli_query($conn, $count_query));
            // tính số trang
            $tongsotrang = ceil($sodong / $baitren_mottrang);
            // xác định trang hiện tại
            $tranghientai = isset($_GET['page']) ? $_GET['page'] : 1;
        
            // tính trang_bat_dau
            $trangbatdau = ($tranghientai - 1) * $baitren_mottrang;
        
            if($_GET['loc'] == "all-sp") {
                // truy vấn để lấy dữ liệu cho trang hiện tại
                $dulieuhientai = "SELECT * FROM sanphampp, nhaphanphoi 
                                WHERE sanphampp.mapp = nhaphanphoi.mapp and tendangnhap= '".$_SESSION['tendn']."'
                                LIMIT $trangbatdau, $baitren_mottrang";
            }
            else {
                $dulieuhientai = "SELECT * FROM nhasanxuat
                                JOIN sanphampp ON nhasanxuat.mansx = sanphampp.mansx
                                JOIN nhaphanphoi ON sanphampp.mapp = nhaphanphoi.mapp
                                WHERE nhaphanphoi.tendangnhap = '{$_SESSION['tendn']}'
                                GROUP BY nhasanxuat.mansx, nhasanxuat.tennsx, nhasanxuat.diachinsx, nhasanxuat.sdtnsx
                                LIMIT $trangbatdau, $baitren_mottrang";
            }
        
            $kq = mysqli_query($conn, $dulieuhientai);
        }
        else if($_GET['loc'] == "add"){ // add sản phẩm
            if(isset($_POST['add'])) {
                $str_query = "SELECT * FROM nhaphanphoi WHERE tendangnhap = '{$_SESSION['tendn']}'";
                $kq = mysqli_query($conn, $str_query);
                $row = mysqli_fetch_array($kq);
                
                $mapp = $row['mapp'];
                $masppp = $_POST['masppp'];
                $mansx = $_POST['mansx'];
                $tensppp = $_POST['tensppp'];
                $ngaynhaphang = $_POST['ngaynhaphang'];

                $check_masp_nsx = "SELECT * FROM sanphamnsx WHERE mansx = '$mansx' AND maspnsx = '$masppp'";
                
                if(mysqli_num_rows(mysqli_query($conn, $check_masp_nsx)) > 0) {
                    if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
                        $hinhanh = "img/".$_FILES['hinhanh']['name'];
                        $path = "assets/img/products/img/".$_FILES['hinhanh']['name'];
                        move_uploaded_file($_FILES['hinhanh']['tmp_name'], $path);
                    }
                    else $hinhanh = "not-img";
                        
                    
                    $str_insert = "INSERT INTO sanphampp
                                VALUES('".$mapp."', '".$masppp."', '".$mansx."', '".$tensppp."', '".$ngaynhaphang."', '".$hinhanh."')";
                    
                    $kq = mysqli_query($conn, $str_insert);
                    if($kq) {
                        $update_ngayxuat = "UPDATE sanphamnsx SET ngayxuathang = '$ngaynhaphang' 
                                            WHERE maspnsx = '$masppp'";
                        mysqli_query($conn, $update_ngayxuat);
                        echo '
                            <script>
                                alert("Thêm sản phẩm thành công!");
                            </script>';
                    }
                    else {
                        $show_info_addsp = "Thêm sản phẩm thất bại";
                    }
                }
                else  {
                    $show_info_addsp = "Sản phẩm này chưa được sản xuất";
                }
            }
        }
        else {  //changeinfo
            $str_query = "SELECT * FROM taikhoan, nhaphanphoi
                            WHERE nhaphanphoi.tendangnhap = '{$_SESSION['tendn']}'
                            AND taikhoan.tendangnhap = nhaphanphoi.tendangnhap;";

            $kq = mysqli_query($conn, $str_query);
            $row = mysqli_fetch_array($kq);
            if(isset($_POST['change'])) {
                $manpp = $_POST['manpp'];
                $tennpp = $_POST['tennpp'];
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];

                $str_update = "UPDATE nhaphanphoi SET mapp='$manpp', tenpp='$tennpp', diachipp='$diachi', sdtpp='$sdt' WHERE tendangnhap='{$_SESSION['tendn']}'";
                $kq = mysqli_query($conn, $str_update);

                if($kq) {
                    echo '
                        <script>
                            alert("Cập nhật thông tin thành công!");
                            window.location.href = "?loc=changeinfo";
                        </script>';
                }
                else {
                    echo '
                        <script>
                            alert("Cập nhật thông tin thất bại!");
                        </script>';
                }
            }
        }
    }

?>
<head>  
    <style>
        .phantrang {
            width: 100%;
        }
        .item {
            box-shadow: 0 0 10px rgb(0, 0, 0, 0.2);
        }
        .item-img img {
            border-bottom: 1px solid #ebd9d9;
        }
        .them-sp tr:nth-child(even) {
            background-color: #fff;
        }
        tr:hover{
            background-color: #fff !important;
        }
        form {
            border-radius: 8px;
            margin: 0 auto;
        }
        table.them-sp {
            font-size: 1.6rem;
            border-collapse: collapse;
            border-radius: 8px;
            background-color: #fff;
        }
        .them-sp h2 {
            margin-top: 15px;
        }
        input {
            padding: 12px;
            width: 100%;
            outline: none;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        input[type='submit'] {
            max-width: 200px;
            background-color: var(--primary-color);
            cursor: pointer;
            color: #fff;
            font-size: 1.8rem;
        }
        .them-sp input[type='submit']:hover {
            background-color: var(--secondary-color);
        }
        .form-btn-padding {
            margin-top: 0;
        }
        .css-a-changepass {
            padding: 12px;
            background-color: var(--primary-color);
            width: 200px;
            display: block;
            color: #fff;
            border-radius: 8px;
            height: 44px;
            line-height: 2rem;
            font-size: 1.8rem;
        }
        .css-a-changepass:hover {
            background-color: var(--secondary-color);
        }
        .content {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="separation"></div>
    <div class="grid wide content-npp">
        <div class="row sm-gutter">
            <div class="col l-2">
                <div class="category">
                    <h3 class="category__heading">Danh mục</h3>
                    <ul class="category-list">
                        <li class="category-item">
                            <a href="?loc=all-sp" class="category-item__link <?php if(isset($_GET['loc']) && $_GET['loc'] == "all-sp") echo "category-item__link--active" ?>">Tất cả sản phẩm</a>
                        </li>
                        <li class="category-item">
                            <a href="?loc=all-nsx" class="category-item__link <?php if(isset($_GET['loc']) && $_GET['loc'] == "all-nsx") echo "category-item__link--active" ?>">Danh sách nhà sản xuất</a>
                        </li>
                        <li class="category-item">
                            <a href="?loc=add" class="category-item__link <?php if(isset($_GET['loc']) && $_GET['loc'] == "add") echo "category-item__link--active" ?>">Thêm sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col l-10">
                <div class="content">
                    <div class="row sm-gutter">
                        <?php 
                            if(isset($_GET['loc'])) {
                                if($_GET['loc'] == "all-sp") {
                                    while ($row = mysqli_fetch_assoc($kq)):
                                        echo '
                                            <div class="col l-2-4">
                                                <a href="ttct_npp.php?id='.$row['masppp'].'">
                                                    <div class="item">
                                                        <div class="item-img">
                                                            <img src="./assets/img/products/'.$row['hinhanh'].'" alt="" style="width: 191px; height: 191px; object-fit: cover;">
                                                        </div>
                                                        <h4 class="item-name">'.$row['tensppp'].'</h4>
                                                        <div class="form-btn form-btn-padding">
                                                            <a class="button sm-btn" href="?loc='.$_GET['loc'].'&hanhdong=edit-sp&id='.$row['masppp'].'">Sửa</a>
                                                            <a class="button sm-btn" href="?loc='.$_GET['loc'].'&hanhdong=delete-sp&id='.$row['masppp'].'" onclick="return confirm('."'Bạn có chắc muốn xóa?'".')">Xóa</a>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        ';
                                    endwhile;
                                }
                                
                                else if($_GET['loc'] == "all-nsx") {
                                    echo '
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
                                        ';
                                            while ($row = mysqli_fetch_assoc($kq)):
                                                echo '
                                                    <tr>
                                                        <td>'.$row['mansx'].'</td>
                                                        <td>'.$row['tennsx'].'</td>
                                                        <td>'.$row['diachinsx'].'</td>
                                                        <td>'.$row['sdtnsx'].'</td>
                                                        <td>
                                                            <a class="button" href="?loc='.$_GET['loc'].'&hanhdong=delete-nsx&id='.$row['mansx'].'" onclick="return confirm(\'Bạn có chắc muốn xóa?\')">Xóa</a>
                                                        </td>
                                                    </tr>';
                                            endwhile;
                                        echo '
                                            </tbody>
                                        </table>
                                    ';
                                }
                                else if($_GET['loc'] == "changeinfo") {
                                    echo '
                                        <form action="" method="POST"">
                                            <table align="center" class="them-sp">
                                                <tr>
                                                    <td align="center" colspan="2"><h2>Sửa thông tin</h2></td>
                                                </tr>
                                                <tr>
                                                    <td>Mã nhà phân phối</td>
                                                    <td><input type="text" name="manpp" value="'.$row['mapp'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Tên nhà phân phối</td>
                                                    <td><input type="text" name="tennpp" value="'.$row['tenpp'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ nhà phân phối</td>
                                                    <td><input type="text" name="diachi" value="'.$row['diachipp'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td><input type="text" name="sdt" value="'.$row['sdtpp'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><a class="css-a-changepass" href="?loc=changeinfo&hanhdong=changepass">Đổi mật khẩu</a></td>
                                                    <td align="right"><input type="submit" value="Sửa thông tin" name="change"></td>
                                                </tr>
                                            </table>
                                        </form>
                                    ';
                                }
                                else {  // add sản phẩm 
                                    echo '
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <table align="center" class="them-sp">
                                                <tr>
                                                    <td align="center" colspan="2"><h2>Thêm sản phẩm</h2></td>
                                                </tr>
                                                <tr>
                                                    <td>Mã sản phẩm</td>
                                                    <td><input type="text" name="masppp" value="';if(isset($_POST['masppp'])) echo $_POST['masppp'];echo '" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Mã nhà sản xuất</td>
                                                    <td><input type="text" name="mansx" value="';if(isset($_POST['mansx'])) echo $_POST['mansx'];echo '" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Tên sản phẩm</td>
                                                    <td><input type="text" name="tensppp" value="';if(isset($_POST['tensppp'])) echo $_POST['tensppp'];echo '" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày nhập hàng</td>
                                                    <td><input type="date" name="ngaynhaphang" value="';if(isset($_POST['ngaynhaphang'])) echo $_POST['ngaynhaphang'];echo '" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Hình ảnh</td>
                                                    <td><input type="file" name="hinhanh"></td>
                                                </tr>';
                                                if(isset($show_info_addsp)) echo '
                                                <tr>
                                                    <td colspan="2">
                                                        <p style="color: red; font-size: 1.6rem; text-align: center;">'.$show_info_addsp.'</p>
                                                    </td>
                                                </tr>';

                                        echo'   <tr>
                                                    <td colspan="2" align="right">
                                                        <input type="submit" value="Thêm sản phẩm" name="add">
                                                    </td>
                                                </tr>
                                                </table>
                                            </form>';
                                } 
                                if($_GET['loc'] != "add" && $_GET['loc'] != "changeinfo") {
                                    if ($tongsotrang > 1) {
                                        echo '<div class="phantrang">';
                                            if ($tranghientai > 1)
                                                echo '<a href="?loc='.$_GET['loc'].'&page='.($tranghientai - 1).'">Trước</a>';
                                            
                
                                            for ($i = 1; $i <= $tongsotrang; $i++) {
                                                if ($i == $tranghientai)
                                                    echo '<a href="?loc='.$_GET['loc'].'&page='.$i.'" class="active">'.$i.'</a>';
                                                else
                                                    echo '<a href="?loc='.$_GET['loc'].'&page='.$i.'">'.$i.'</a>';
                                            }
                
                                            if ($tranghientai < $tongsotrang)
                                                echo '<a href="?loc='.$_GET['loc'].'&page='.($tranghientai + 1).'">Sau</a>';
                                        echo '</div>';
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    load_footer();
    ?>
    <?php
    // Kiểm tra tham số hanhdong được truyền từ URL
    if (isset($_GET['hanhdong'])) {
        $hanhdong = $_GET['hanhdong'];

        // Kiểm tra tham số hanhdong được truyền từ URL

        // Nếu hanhdong là delete
        if ($hanhdong == 'delete-sp') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];
            $sql = "DELETE FROM sanphampp WHERE masppp = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Xóa dữ liệu thành công!');
                        window.location.replace('npp.php?loc=".$_GET['loc']."');
                    </script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
        if ($hanhdong == 'delete-nsx') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];

            $laymapp = "SELECT * FROM nhaphanphoi WHERE nhaphanphoi.tendangnhap = '{$_SESSION['tendn']}'";

            $dong = mysqli_fetch_assoc(mysqli_query($conn, $laymapp));

            $sql = "DELETE FROM sanphampp
                        WHERE sanphampp.mansx = '$id'
                        AND sanphampp.mapp = '{$dong['mapp']}'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Xóa dữ liệu thành công!');
                        window.location.replace('npp.php?loc=".$_GET['loc']."');
                    </script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
        if($hanhdong == 'changepass') {
            echo '
                <div class="form-overlay" onclick="closeForm()"></div>
                <div class="form-container">
                    <h2>Đổi mật khẩu</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="password" name="mkcu" class="form-control" placeholder="Mật khẩu cũ" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" name="mkmoi" class="form-control" value="" placeholder="Mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <input type="password" name="re-mkmoi" class="form-control" value="" placeholder="Nhập lại mật khẩu mới">
                        </div>';

                        if(isset($mess)) echo '<p style="color: red; font-size: 1.4rem;">'.$mess.'</p>';
                  echo '<div class="form-btn form-btn-edit-sp">
                            <button type="submit" name="submit-suamk" class="btn btn-primary">Lưu</button>
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
                    window.location.href = "?loc=changeinfo";
                }
            </script>';
        }
        
        // Kiểm tra nút "Lưu" đã được nhấn hay chưa
        if (isset($_POST['submit-sp'])) {
            $id = $_GET['id'];

            $masppp = $_POST['masp'];
            $tensppp = $_POST['tensp'];
            if(isset($_FILES['file-hinhanh']) && $_FILES['file-hinhanh']['error'] === UPLOAD_ERR_OK) {
                $path = "img/".$_FILES['file-hinhanh']['name'];
                
                $sql = "UPDATE sanphampp SET masppp='$masppp', tensppp='$tensppp', hinhanh='$path' WHERE masppp='$id'";
                move_uploaded_file($_FILES['file-hinhanh']['tmp_name'], "assets/img/products/".$path);
            }
            else {
                $sql = "UPDATE sanphampp SET masppp='$masppp', tensppp='$tensppp' WHERE masppp='$id'";
            }

            // Truy vấn để cập nhật thông tin nhà phân phối
            $result = mysqli_query($conn, $sql);

            // Hiển thị
            // Kiểm tra kết quả truy vấn
            if ($result) {
                // Hiển thị thông báo cập nhật thành công và chuyển về trang danh sách nhà phân phối
                echo '
                    <script>
                        alert("Cập nhật thông tin thành công!");
                        window.location.href = "?loc=all-sp";
                    </script>';
            } else {
                // Hiển thị thông báo cập nhật thất bại
                echo '
                    <script>
                        alert("Cập nhật thông tin thất bại!");
                    </script>';
            }
        
        }
        if(isset($_POST['change-mk']))
            header('Location: npp.php?loc=changeinfo&hanhdong=changepass');
            
        if ($hanhdong == 'edit-sp') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM sanphampp, nhaphanphoi 
                    WHERE sanphampp.mapp = nhaphanphoi.mapp 
                    AND tendangnhap= '".$_SESSION['tendn']."'
                    AND sanphampp.masppp = '{$id}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            echo '
                <div class="form-overlay" onclick="closeForm()"></div>
                <div class="form-container">
                    <h2>Sửa thông tin sản phẩm</h2>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="file-hinhanh">
                        </div>
                        <div class="form-group">
                            <input type="text" name="masp" class="form-control" value="' . $row['masppp'] . '" placeholder="Mã sản phẩm">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tensp" class="form-control" value="' . $row['tensppp'] . '" placeholder="Tên sản phẩm">
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
        
    }
    // Đóng kết nối CSDL
    mysqli_close($conn);
?>
