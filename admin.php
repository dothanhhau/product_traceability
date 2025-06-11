<?php 
    require 'site.php';
    load_top();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
        if($_SESSION['checkLogin'])
            header('Location: index.php');
        else
            header('Location: login.php');
    }
    load_header();
    
?>
<?php 
    require("connect/connect.php");

    if(isset($_GET['loc'])) {
        $str_query = "SELECT * FROM taikhoan WHERE tendangnhap = '{$_SESSION['tendn']}'";
        $kq2 = mysqli_query($conn, $str_query);
        $row = mysqli_fetch_array($kq2);

        if(isset($_POST['change'])) {
            $tendn = $_POST['tendangnhap'];
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
                                window.location.href = "admin.php";
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
    }
    else {
        // if(isset($_SESSION['vaitro'])) {
        //     if(isset($_GET['btn-vaitro']))
        //         $_SESSION['vaitro'] = $_GET['btn-vaitro'];
        // }
        // else {
        //     $_SESSION['vaitro'] = "Tất cả";
        // }
        
        // if($_SESSION['vaitro'] == "Tất cả")
        //     $role = "WHERE vaitro = 'nsx' OR vaitro = 'npp'";
        // else if($_SESSION['vaitro'] == "Nhà sản xuất")
        //     $role = "WHERE vaitro = 'nsx'";
        // else
        //     $role = "WHERE vaitro = 'npp'";

        if(!isset($_GET['btn-vaitro']))
            $_GET['btn-vaitro'] = "Tất cả";
        
        if($_GET['btn-vaitro'] == "Tất cả")
            $role = "WHERE vaitro = 'nsx' OR vaitro = 'npp'";
        else if($_GET['btn-vaitro'] == "Nhà sản xuất")
            $role = "WHERE vaitro = 'nsx'";
        else
            $role = "WHERE vaitro = 'npp'";
            
        $baitren_mottrang = 5;
        
        $tranghientai = isset($_GET['page']) ? $_GET['page'] : 1;

        $cautruyvan = "SELECT * FROM taikhoan ".$role;

        $sodong = mysqli_num_rows(mysqli_query($conn, $cautruyvan));

        $tongsotrang = ceil($sodong / $baitren_mottrang);
    
        $trangbatdau = ($tranghientai - 1) * $baitren_mottrang;
        
        $dulieuhientai = "SELECT * FROM taikhoan ".$role." LIMIT $trangbatdau, $baitren_mottrang";
        $kq = mysqli_query($conn, $dulieuhientai);
    }
?>

<head>
    <style>
        form.change-info {
            height: 100vh;
            font-size: 1.6rem;
        }
        table.them-sp {
            margin: 37px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
        }
        table.them-sp tr {
            border-radius: 8px;
        }
        table.them-sp tr:hover {
            background-color: #fff;
        }
        .them-sp tr:nth-child(even) {
            background-color: #fff;
            border-radius: 8px;
        }
        .them-sp input[type="submit"] {
            background-color: var(--primary-color);
            color: #fff;
        }
        .them-sp input[type="submit"]:hover {
            background-color: var(--secondary-color);
            cursor: pointer;
        }
        .change-info input {
            padding: 14px;
            border-radius: 8px;
            outline: none;
            border: 1px solid #ccc;
        }
        .footer {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <?php if(isset($_GET['loc'])){ ?>                    <!-- Hiển thị form sửa thông tin  -->
        <div class="separation"></div>
            <form action="" method="POST" class="change-info">
                <table align="center" class="them-sp">
                    <tr>
                        <td align="center" colspan="2"><h2>Sửa thông tin</h2></td>
                    </tr>
                    <tr>
                        <td>Tên đăng nhập</td>
                        <td><input type="text" name="tendangnhap" value="<?php echo $row['tendangnhap'] ?>" required readonly></td>
                    </tr>
                    <tr>
                        <td>Mật khẩu cũ</td>
                        <td><input type="password" name="mkcu" value="" required autofocus></td>
                    </tr>
                    <tr>
                        <td>Mật khẩu mới</td>
                        <td><input type="password" name="mkmoi" value="" required></td>
                    </tr>
                    <tr>
                        <td>Nhập lại mật khẩu mới</td>
                        <td><input type="password" name="re-mkmoi" value="" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php if(isset($mess)) echo '<p style="color: red; font-size: 1.4rem;">'.$mess.'</p>' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right"><input type="submit" value="Sửa thông tin" name="change"></td>
                    </tr>
                </table>
            </form>
    <?php }else{ ?>                                             <!-- Hiển thị danh sách người dùng  -->
        <div >
            
            <h2 style="text-align: center; color: #333; font-size: 2.4rem; margin-top: 58px;">Danh sách các tài khoản</h2>

            <div style="height: 502px">
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
                        <?php while($row = mysqli_fetch_assoc($kq)){ ?>
                            <tr>
                                <td><?php echo $row['tendangnhap']; ?></td>
                                <td><?php echo $row['matkhau']; ?></td>
                                <td><?php echo $row['vaitro']; ?></td>
                                <td>
                                    <a class="button" href="admin.php?hanhdong=delete&id=<?php echo $row['tendangnhap']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php if ($tongsotrang > 1){ ?>
                <div class="phantrang">
                    <?php if ($tranghientai > 1){ ?>
                        <a href="admin.php?btn-vaitro=<?php echo $_GET['btn-vaitro'] ?>&page=<?php echo $tranghientai - 1; ?>">Trước</a>
                    <?php } ?>

                    <?php for ($i = 1; $i <= $tongsotrang; $i++){ ?>
                        <a href="admin.php?btn-vaitro=<?php echo $_GET['btn-vaitro'] ?>&page=<?php echo $i; ?>" class="<?php if($i == $tranghientai) echo 'active' ?>"><?php echo $i; ?></a>
                    <?php } ?>

                    <?php if ($tranghientai < $tongsotrang){ ?>
                        <a href="admin.php?btn-vaitro=<?php echo $_GET['btn-vaitro'] ?>&page=<?php echo $tranghientai + 1; ?>">Sau</a>
                    <?php } ?>
                </div>
            <?php } ?>

            <form class="filter" action="<?php if(isset($_SERVER['PHP_SELF'])) echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <label for="">Lọc: </label>
                <input type="submit" value="Tất cả" name="btn-vaitro">
                <input type="submit" value="Nhà sản xuất" name="btn-vaitro">
                <input type="submit" value="Nhà phân phối" name="btn-vaitro">
            </form>
            <div class="feature-npp" style="text-align: center;">
                <a style="text-decoration:none;" href="admin.php?hanhdong=add">Thêm tài khoản</a>
            </div>
        </div>
    <?php } ?>
    
<?php
    
    if (isset($_GET['hanhdong'])) {
        $hanhdong = $_GET['hanhdong'];

        if($hanhdong == 'delete') {

            $id = $_GET['id'];
            $sql = "DELETE FROM taikhoan WHERE tendangnhap = '$id'";
            if(mysqli_query($conn, $sql)){
                echo "<script>
                        alert('Xóa dữ liệu thành công!');
                        window.history.back();
                    </script>";
            } else{
                echo "<script>
                        alert('Truy vấn lỗi!');
                        window.history.back();
                    </script>";
            }
        }

        // Nếu hanhdong là add
        if ($hanhdong == 'add') {
            // Hiển thị form thêm tài khoản
            echo '
                <div class="form-overlay" onclick="closeForm()"></div>
                <div class="form-container">
                    <h2>Thêm tài khoản</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <input type="text" name="tendn" class="form-control" placeholder="Tên tài khoản" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                        <div class="form-vaitro">
                            <label for="sdtpp">Vai trò:</label>
                            <input id="nsx" type="radio" name="vaitro" value="nsx" required>
                            <label for="nsx" class="checkbox-label">Nhà sản xuất</label>
                            
                            <input id="npp" type="radio" name="vaitro" value="npp" required>
                            <label for="npp" class="checkbox-label">Nhà phân phối</label>
                        </div>';
                        if(isset($_SESSION['canhbao'])) {
                            echo '<p style="color: red; font-size: 1.4rem; margin: 4px 0 12px 0;">'.$_SESSION['canhbao'].'</p>';
                            unset($_SESSION['canhbao']);
                        }
                        echo '
                        <div class="form-btn">
                            <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" onclick="closeForm()">Hủy</button>
                        </div>
                    </form>
                </div>
            '; // end echo;

            
            echo '
                <script>  
                    function closeForm() {
                        window.location.href = "admin.php";
                    }
                </script>
            ';
        }

        if (isset($_POST['submit'])) {
            
            $tentk = $_POST['tendn'];
            $mk = $_POST['pass'];
            $vaitro = $_POST['vaitro'];

            $dong = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM taikhoan WHERE tendangnhap = '$tentk'"));
            if($dong == 0) {
                $sql = "INSERT INTO taikhoan VALUES('".$tentk."','".$mk."','".$vaitro."')";
                $result = mysqli_query($conn, $sql);
    
                if ($result) {
                    echo '<script>
                            alert("Thêm tài khoản thành công!");
                            window.location.href = "admin.php";
                        </script>';
                } else {
                    $_SESSION['canhbao'] = "Thêm tài khoản thất bại!";
                    echo '<script>
                            window.location.href = "admin.php?hanhdong=add";
                        </script>';
                }
            }
            else  {
                $_SESSION['canhbao'] = "Tên đăng nhập đã tồn tại!";
                echo '<script>
                        window.location.href = "admin.php?hanhdong=add";
                    </script>';
            }
        }
    }
    
    // Đóng kết nối CSDL
    mysqli_close($conn);
    load_footer();
?>
