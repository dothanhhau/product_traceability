
<body>
    <div class="app">

        <!-- HEADER -->
        <header class="header">
            <div class="grid wide">
                <div class="header__container">
                    <div class="header_content">
                        <div class="header__logo">
                            <a href="index.php">
                                <img src="./assets/img/logo.png" alt="Logo" class="logo-item">
                            </a>
                        </div>
                        <div class="header__about">
                            <div class="header__about-item header__about-phone">
                                <!-- icon phone -->
                                <div class="header__about-phone-icon">
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/bjnaomnr.json" trigger="loop" delay="1500"
                                        colors="outline:#05573a,primary:#f5f5f5,secondary:#f5f5f5,tertiary:#f5f5f5"
                                        stroke="80" style="width:60px;height:60px">
                                    </lord-icon>
                                </div>
                                <div class="header__about-phone-info">
                                    <p class="about-phone-info-title">Hot Line: </p>
                                    <a href="tel:19001243">1900 1243</a>
                                </div>
                            </div>

                            <div class="header__about-item header__about-email">
                                <!-- icon mail -->
                                <div class="header__about-email-icon">
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/gzmgulpl.json" trigger="loop" delay="2200"
                                        colors="outline:#05573a,primary:#f5f5f5,secondary:#f5f5f5" stroke="90"
                                        style="width:60px;height:60px">
                                    </lord-icon>
                                </div>
                                <div class="header__about-email-info">
                                    <p class="about-phone-info-title">Email: </p>
                                    <a href="mailto:INFO@TWOGODFATHER.COM">INFO@TWOGODFATHER.COM</a>
                                </div>
                            </div>

                            <div class="header__about-item header__about-location">
                                <!-- icon location -->
                                <div class="header__about-location-icon">
                                    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/zzcjjxew.json" trigger="loop" delay="2000"
                                        colors="primary:#05573a,secondary:#05573a" stroke="60"
                                        style="width:60px;height:60px">
                                    </lord-icon>
                                </div>
                                <div class="header__about-location-info">
                                    <p class="about-phone-info-title">Địa chỉ: </p>
                                    <a target="_blank"
                                        href="https://www.google.com/maps/place/Tr%C6%B0%E1%BB%9Dng+%C4%90%E1%BA%A1i+H%E1%BB%8Dc+Quy+Nh%C6%A1n/@13.7589649,109.2152824,17z/data=!4m14!1m7!3m6!1s0x316f6cebf252c49f:0xa83caa291737172f!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBRdXkgTmjGoW4!8m2!3d13.7589597!4d109.2178573!16s%2Fg%2F120ylnmc!3m5!1s0x316f6cebf252c49f:0xa83caa291737172f!8m2!3d13.7589597!4d109.2178573!16s%2Fg%2F120ylnmc">ĐẠI
                                        HỌC QUY NHƠN</a>
                                </div>
                            </div>

                            <!-- icon qr code -->
                            <!-- <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/bfmwpqst.json" trigger="hover"
                                colors="outline:#05573a,primary:#f5f5f5,secondary:#f5f5f5"
                                stroke="100"
                                style="width:60px;height:60px">
                            </lord-icon> -->
                        </div>

                        <div class="header__login <?php if($_SESSION['checkLogin']) echo "show-info" ?>">
                            <a href="<?php  if(!$_SESSION['checkLogin'])
                                                echo "login.php"; 
                                            else {
                                                if($_SESSION['role'] == "admin")
                                                    echo "admin.php";
                                                else if($_SESSION['role'] == "nsx")
                                                    echo "nsx.php";
                                                else
                                                    echo "npp.php";
                                            }
                                    ?>">
                                    <?php if(isset($_SESSION['tendn'])) echo $_SESSION['tendn']; else echo "Đăng nhập" ?></a>
                            
                            <div class="info-user">
                                <a href="?loc=changeinfo">Thay đổi thông tin</a>
                                <a href="exit.php">Đăng xuất</a>
                            </div>
                        </div>

                    </div>
                    <div class="header_nav-parents">
                        <div class="header__nav">
                            <div class="header__nav--left">
                                <ul class="header__nav-item-list">
                                    <li class="header__nav-item-item">
                                        <a href="index.php">Trang chủ</a>
                                    </li>
                                    <li class="header__nav-item-item">
                                        <a href="">Giới thiệu</a>
                                        <i class=""><svg style="fill: white;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg></i>
                                        <ul class="header__subnav-list">
                                            <li class="header__subnav-item">
                                                <a href="">Về Twogodfather</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Chuyên gia Twogodfather</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Trách nhiệm xã hội</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Cơ hội nghệ nghiệp</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Điều khoản sử dụng</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header__nav-item-item">
                                        <a href="">Dịch vụ</a>
                                        <i class=""><svg style="fill: white;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg></i>
                                        <ul class="header__subnav-list header__subnav-list--service">
                                            <li class="header__subnav-item">
                                                <a href="">Truy xuất nguồn gốc điện tử</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">TraceFarm - Phần mềm Quản lý trang trại</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">TraceChain - phần mềm Quản lý chuỗi cung ứng</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Tư vấn cấp Mã số vùng trồng</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Tư vấn cấp mã số cơ sở đóng gói</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Tư vấn thương hiệu nông sản</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Trở thành đối tác của Twogodfather</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header__nav-item-item">
                                        <a href="">Tin tức</a>
                                        <i class=""><svg style="fill: white;" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg></i>
                                        <ul class="header__subnav-list">
                                            <li class="header__subnav-item">
                                                <a href="">Hoạt động của Twogodfather</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Truy xuất nguồn gốc</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Quy trình nông nghiệp</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Tiêu chuẩn chất lượng</a>
                                            </li>
                                            <li class="header__subnav-item">
                                                <a href="">Chính sách pháp luật</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="header__nav-item-item">
                                        <a href="">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header__nav-right">
                                <form class="header__nav-form-search" action="truyxuat.php" method="POST">
                                    <div class="header__nav--search">
                                        <input id="input-search" type="text" value="<?php if(isset($_POST['sp-truyxuat'])) echo $_POST['sp-truyxuat'] ?>" placeholder="Search" name="sp-truyxuat" required>
                                        <input type="submit" class="header__nav--btn" value="Truy xuất" name="truyxuat">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

