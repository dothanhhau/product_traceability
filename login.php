<?php 
    require 'site.php';
    load_top();
    if($_SESSION['checkLogin'])
        header('Location: index.php');
?>

<?php
    require ("connect/connect.php");

    if(isset($_POST['btSignup'])){
        $tendn = $_POST['nameuser'];
        $mk = $_POST['password'];
        $mk = replace($mk);

        $dangnhap = "SELECT * from taikhoan where tendangnhap = '".$tendn."' and matkhau = '".$mk."'";
        if($kq = mysqli_query($conn,$dangnhap)){
            if($kq1 = mysqli_fetch_array($kq)){
                $role = $kq1['vaitro'];
                $_SESSION['role'] = $role;
                $_SESSION['tendn'] = $tendn;
                $_SESSION['checkLogin'] = 1;
                
                if($role == "admin")
                    header('Location: admin.php');
                else if($role == "nsx")
                    header(('Location: nsx.php'));
                else if($role == "npp")
                    header('Location: npp.php');
            }
            else{
                $mess = "Sai tên đăng nhập hoặc mật khẩu";
            }
        }
        else{
            $mess = "Query thất bại";
        }
        mysqli_close($conn);
    }
?>
<head>
    <link rel="stylesheet" href="./assets/css/other.css">
</head>

<body>
    <div class="grid wide content">
        <div class="content-top">
            <div class="content-top-text">
                <a href="">Twogodfather & son</a>
                <p>Twogodfather & son giúp bạn biết được nguồn gốc <br> xuất sứ của sản phẩm</p>
            </div>
            <div class="content-top-form">
                <form class="content-form" action="<?php if(isset($_SERVER['PHP_SELF'])) echo $_SERVER['PHP_SELF'] ?> " method="POST">
                    <input class="input" type="text" name="nameuser" placeholder="Tên đăng nhập" value="<?php if(isset($tendn)) echo $tendn?>" required autofocus>
                    <input class="input" type="password" name="password" placeholder="Mật khẩu" value="<?php if(isset($mk)) echo $mk?>" required>
                    <?php if(isset($mess)) echo '<p style="color: red; font-size: 1.4rem; margin: 4px 0 12px 0;">'.$mess.'</p>' ?>
                    <input type="submit" name="btSignup" value="Đăng nhập">
                    <a class="text-forgot-pass" href="#">Quên mật khẩu?</a>
                    <div class="serparent"></div>
                    <a class="back" href="exit.php">Trở về</a>
                </form>
            </div>
        </div>
        
        <?php 
            load_footer();
        ?>
    </div>
</body>

</html>