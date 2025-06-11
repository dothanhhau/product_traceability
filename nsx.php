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
<?php
    require("connect/connect.php");
    mysqli_query($conn, "SET NAMES 'utf8'");
    if(!isset($_GET['loc']))
        $_GET['loc'] = "all-sp";

    if(isset($_POST['submit-suamk'])) {
        $tendn = $_SESSION['tendn'];
        $mk = $_POST['mkcu'];

        $dong = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM taikhoan WHERE tendangnhap = '$tendn' AND matkhau = '$mk'"));
        if($dong > 0) {
            $mkmoi = $_POST['mkmoi'];
            $re_mkmoi = $_POST['re-mkmoi'];
            if($mkmoi === $re_mkmoi) {
                $str_update = "UPDATE taikhoan SET matkhau='$mkmoi' WHERE tendangnhap='{$_SESSION['tendn']}'";
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
        if($_GET['loc'] != "add" && $_GET['loc'] != "changeinfo") {
            $baitren_mottrang = 5;
        
            if($_GET['loc'] == "all-sp") {
                $baitren_mottrang = 10;
        
                $count_query = "SELECT * FROM nhasanxuat, sanphamnsx
                                WHERE nhasanxuat.mansx = sanphamnsx.mansx
                                AND nhasanxuat.tendangnhap = '".$_SESSION['tendn']."'";
                
            }
            else {
                $count_query = "SELECT * FROM nhaphanphoi
                                JOIN sanphampp ON nhaphanphoi.mapp = sanphampp.mapp
                                JOIN nhasanxuat ON sanphampp.mansx = nhasanxuat.mansx
                                WHERE nhasanxuat.tendangnhap = '{$_SESSION['tendn']}'
                                GROUP BY nhaphanphoi.mapp, nhaphanphoi.tenpp, nhaphanphoi.diachipp, nhaphanphoi.sdtpp;";
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
                $dulieuhientai = "SELECT * FROM nhasanxuat, sanphamnsx
                                WHERE nhasanxuat.mansx = sanphamnsx.mansx
                                AND nhasanxuat.tendangnhap = '".$_SESSION['tendn']."'
                                LIMIT $trangbatdau, $baitren_mottrang";
            }
            else {
                $dulieuhientai = "SELECT * FROM nhaphanphoi
                                JOIN sanphampp ON nhaphanphoi.mapp = sanphampp.mapp
                                JOIN nhasanxuat ON sanphampp.mansx = nhasanxuat.mansx
                                WHERE nhasanxuat.tendangnhap = '{$_SESSION['tendn']}'
                                GROUP BY nhaphanphoi.mapp, nhaphanphoi.tenpp, nhaphanphoi.diachipp, nhaphanphoi.sdtpp
                                LIMIT $trangbatdau, $baitren_mottrang";
            }
        
            $kq = mysqli_query($conn, $dulieuhientai);
        }
        else if($_GET['loc'] == "add") {
            if(isset($_POST['add-sp'])) {
                $str_query = "SELECT * FROM nhasanxuat WHERE tendangnhap = '{$_SESSION['tendn']}'";
                $kq = mysqli_query($conn, $str_query);
                $row = mysqli_fetch_array($kq);

                $mansx = $row['mansx'];
                $masppp = $_POST['masppp'];
                $tensppp = $_POST['tensppp'];
                $ngaysanxuat = $_POST['ngaysanxuat'];
                
                $check_masp_nsx = "SELECT * FROM sanphamnsx WHERE maspnsx = '$masppp' ";
                if(mysqli_num_rows(mysqli_query($conn, $check_masp_nsx)) == 0) {
                    if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
                        $hinhanh = "img/".$_FILES['hinhanh']['name'];
                        $path = "assets/img/products/img/".$_FILES['hinhanh']['name'];
                        move_uploaded_file($_FILES['hinhanh']['tmp_name'], $path);
                    }
                    else $hinhanh = "not-img";
    
                    $str_insert = "INSERT INTO sanphamnsx
                                VALUES('{$mansx}', '{$masppp}', '{$tensppp}', '{$ngaysanxuat}', '1/1/1990', '{$hinhanh}')";
    
                    $kq = mysqli_query($conn, $str_insert);
                    if($kq) {
                        echo '
                            <script>
                                alert("Thêm sản phẩm thành công!");
                            </script>';
                    }
                    else {
                        $show_info_addsp = "Thêm sản phẩm thất bại";
                    }
                }
                else {
                    $show_info_addsp = "Mã sản phẩm đã tồn tại";
                }
            }
        }
        else {      //sửa thông tin nhà sản xuất
            $str_query = "SELECT * FROM nhaphanphoi
                        JOIN sanphampp ON nhaphanphoi.mapp = sanphampp.mapp
                        JOIN nhasanxuat ON sanphampp.mansx = nhasanxuat.mansx
                        WHERE nhasanxuat.tendangnhap = '{$_SESSION['tendn']}'
                        GROUP BY nhaphanphoi.mapp, nhaphanphoi.tenpp, nhaphanphoi.diachipp, nhaphanphoi.sdtpp;";

            $kq = mysqli_query($conn, $str_query);
            $row = mysqli_fetch_array($kq);
            if(isset($_POST['change'])) {
                $mansx = $_POST['mansx'];
                $tennsx = $_POST['tennsx'];
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];
                $mk = $_POST['mk'];

                $str_update = "UPDATE nhasanxuat SET mansx='$mansx', tennsx='$tennsx', diachinsx='$diachi', sdtnsx='$sdt' WHERE tendangnhap='{$_SESSION['tendn']}'";
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
                            <a href="?loc=all-npp" class="category-item__link <?php if(isset($_GET['loc']) && $_GET['loc'] == "all-npp") echo "category-item__link--active" ?>">Danh sách nhà phân phối</a>
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
                                                <a href="ttct_nsx.php?id='.$row['maspnsx'].'">
                                                    <div class="item">
                                                        <div class="item-img">
                                                            <img src="./assets/img/products/'.$row['hinhanh'].'" alt="" style="width: 191px; height: 191px; object-fit: cover;">
                                                        </div>
                                                        <h4 class="item-name">'.$row['tenspnsx'].'</h4>
                                                        <div class="form-btn form-btn-padding">
                                                            <a class="button sm-btn" href="?loc='.$_GET['loc'].'&hanhdong=edit-sp&id='.$row['maspnsx'].'">Sửa</a>
                                                            <a class="button sm-btn" href="?loc='.$_GET['loc'].'&hanhdong=delete&id='.$row['maspnsx'].'" onclick="return confirm('."'Bạn có chắc muốn xóa?'".')">Xóa</a>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        ';
                                    endwhile;
                                }
                                
                                else if($_GET['loc'] == "all-npp") {
                                    echo '
                                            <table align="center" class="tab">
                                            <thead>
                                                <tr>
                                                    <th>Mã nhà phân phối</th>
                                                    <th>Tên nhà phân phối</th>
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
                                                        <td>'.$row['mapp'].'</td>
                                                        <td>'.$row['tenpp'].'</td>
                                                        <td>'.$row['diachipp'].'</td>
                                                        <td>'.$row['sdtpp'].'</td>
                                                        <td>
                                                            <a class="button" href="?loc='.$_GET['loc'].'&hanhdong=delete&id='.$row['mapp'].'" onclick="return confirm(\'Bạn có chắc muốn xóa?\')">Xóa</a>
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
                                                    <td>Mã nhà sản xuất</td>
                                                    <td><input type="text" name="mansx" value="'.$row['mansx'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Tên nhà sản xuất</td>
                                                    <td><input type="text" name="tennsx" value="'.$row['tennsx'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ nhà sản xuất</td>
                                                    <td><input type="text" name="diachi" value="'.$row['diachinsx'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại</td>
                                                    <td><input type="text" name="sdt" value="'.$row['sdtnsx'].'" required></td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><a class="css-a-changepass" href="?loc=changeinfo&hanhdong=changepass">Đổi mật khẩu</a></td>
                                                    <td align="right"><input type="submit" value="Sửa thông tin" name="change"></td>
                                                </tr>
                                            </table>
                                        </form>
                                    ';
                                }
                                else { //add sản phẩm
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
                                                    <td>Tên sản phẩm</td>
                                                    <td><input type="text" name="tensppp" value="';if(isset($_POST['tensppp'])) echo $_POST['tensppp'];echo '" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày sản xuất</td>
                                                    <td><input type="date" name="ngaysanxuat" value="';if(isset($_POST['ngaysanxuat'])) echo $_POST['ngaysanxuat'];echo '" required></td>
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
                                    echo'       <tr>
                                                    <td colspan="2" align="right"><input type="submit" value="Thêm sản phẩm" name="add-sp"></td>
                                                </tr>
                                            </table>
                                        </form>';
                                }
                                if($_GET['loc'] != "add" && $_GET['loc'] != "changeinfo") { // phân trang
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
                
                                            if ($tranghientai < $tongsotrang):
                                                echo '<a href="?loc='.$_GET['loc'].'&page='.($tranghientai + 1).'">Sau</a>';
                                            endif;
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
        if ($hanhdong == 'delete') {
            // Lấy thông tin đối tượng cần sửa từ CSDL dựa trên tham số id
            $id = $_GET['id'];
            $sql = "DELETE FROM sanphamnsx WHERE maspnsx = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('Xóa dữ liệu thành công!');
                    window.location.replace('nsx.php?loc={$_GET['loc']}');
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
            if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === UPLOAD_ERR_OK) {
                $path = "img/".$_FILES['hinhanh']['name'];
                $sql = "UPDATE sanphamnsx SET maspnsx='$masppp', tenspnsx='$tensppp', hinhanh='$path' WHERE maspnsx='$id'";
                move_uploaded_file($_FILES['hinhanh']['tmp_name'], "assets/img/products/img/".$_FILES['hinhanh']['name']);
            }
            else {
                $sql = "UPDATE sanphamnsx SET maspnsx='$masppp', tenspnsx='$tensppp' WHERE maspnsx='$id'";
            }

            
            $result = mysqli_query($conn, $sql);

            // Hiển thị
            // Kiểm tra kết quả truy vấn
            if ($result) {
                
                echo '
                    <script>
                        alert("Cập nhật thông tin thành công!");
                        window.location.href = "nsx.php?loc=all-sp";
                    </script>';
            } else {
                // Hiển thị thông báo cập nhật thất bại
                echo '
                    <script>
                        alert("Cập nhật thông tin thất bại!");
                    </script>';
            }
        }
    }
    // Đóng kết nối CSDL
    mysqli_close($conn);
    ?>
