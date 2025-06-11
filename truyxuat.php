<?php 
    if(!isset($_POST['truyxuat']))
        header('Location: index.php');
    require 'site.php';
    load_top();
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
    </style>
</head>

<?php
    if(isset($_POST['truyxuat'])) {
        require ('connect/connect.php');
        mysqli_query($conn, "SET NAMES 'utf8'");

        $masp = $_POST['sp-truyxuat'];

        $sql_truyxuat = "SELECT sanphamnsx.tenspnsx,sanphampp.masppp, sanphamnsx.maspnsx, sanphampp.tensppp, nhasanxuat.tennsx, nhaphanphoi.tenpp,
                                sanphamnsx.ngaysanxuat, sanphamnsx.ngayxuathang, sanphampp.ngaynhaphang, sanphamnsx.hinhanh, nhasanxuat.mansx
                        FROM nhaphanphoi, sanphampp, nhasanxuat, sanphamnsx
                        WHERE sanphampp.masppp = '$masp'
                        AND sanphampp.mansx = nhasanxuat.mansx
                        AND sanphampp.mapp = nhaphanphoi.mapp
                        AND sanphampp.masppp = sanphamnsx.maspnsx";
        $kq = mysqli_query($conn, $sql_truyxuat);
        $row = mysqli_fetch_array($kq);
        if(mysqli_num_rows($kq) > 0) {
            echo "
                <div class='separation'></div>
                <div class='grid wide wrapper-product'>
                    <div class='product-details'>
                        <h2>Chi tiết sản phẩm</h2>
                        <div class='row'>
                            <div class='col l-6'>
                                <div class='image-column'>
                                    <img src='./assets/img/products/" . $row['hinhanh'] . "' width='100%' height='auto'>
                                </div>
                            </div>
                            <div class='col l-6'>
                                <div class='info-column'>
                                    <div>
                                        <table align='center'>
                                            <tr>
                                                <td>Mã Sản Phẩm:</td>
                                                <td>" . $row['masppp'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Tên nhà sản xuất:</td>
                                                <td><a href='https://www.google.com/' target='_blank'>". $row['tennsx'] . "</a> </td>
                                            </tr>
                                            <tr>
                                                <td>Tên nhà phân phối:</td>
                                                <td><a href='https://www.google.com/' target='_blank'>". $row['tenpp'] . "</a> </td>
                                            </tr>
                                            <tr>
                                                <td>Tên Sản Phẩm:</td>
                                                <td>" . $row['tensppp'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày sản xuất:</td>
                                                <td>" . $row['ngaysanxuat'] . "</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày nhập hàng:</td>
                                                <td>" . $row['ngaynhaphang'] . "</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
        else {
            echo '
                <center style="height:100vh"><p style="color:red;font-size:3rem; line-height:70vh; cursor: default; user-select: none; -webkit-user-select: none;">Không tồn tại mã sản phẩm này</p></center>
                ';
        }
    }

    load_footer();
?>
