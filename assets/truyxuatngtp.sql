-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 04:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truyxuatngtp`
--

-- --------------------------------------------------------

--
-- Table structure for table `nhaphanphoi`
--

CREATE TABLE `nhaphanphoi` (
  `mapp` varchar(20) NOT NULL,
  `tenpp` varchar(255) NOT NULL,
  `diachipp` varchar(255) NOT NULL,
  `sdtpp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhaphanphoi`
--

INSERT INTO `nhaphanphoi` (`mapp`, `tenpp`, `diachipp`, `sdtpp`) VALUES
('NP001', 'Công ty TNHH Thực phẩm Nguyễn Thành Duy', 'Công ty TNHH Thực phẩm ACB', '0123456789'),
('NP002', 'Công ty TNHH Thực phẩm Nguyễn Thành Duy', 'Đường', '0123456789'),
('NP003', 'Công ty TNHH Thực phẩm Nguyễn Văn A', '324234234', '2342342234'),
('NP004', 'Công ty TNHH Thực phẩm XYZ', '456 đường JKL, Quận 4, TP.HCM', '0987654321'),
('NP005', 'Công ty TNHH Thực phẩm ABC', '123 đường MNO, Quận 5, TP.HCM', '0123456789'),
('NP006', 'Công ty TNHH Thực phẩm XYZ', '789 đường PQR, Quận 6, TP.HCM', '0987654321'),
('NP007', 'Công ty TNHH Thực phẩm ABC', '456 đường STU, Quận 7, TP.HCM', '0123456789'),
('NP008', 'Công ty TNHH Thực phẩm XYZ', '123 đường VWX, Quận 8, TP.HCM', '0987654321'),
('NP009', 'Công ty TNHH Thực phẩm MNP', '789 đường YZ, Quận 9, TP.HCM', '0123456789'),
('NP010', 'Công ty TNHH Thực phẩm ABC', '456 đường XYZ, Quận 10, TP.HCM', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `mansx` varchar(20) NOT NULL,
  `tennsx` varchar(255) NOT NULL,
  `diachinsx` varchar(255) NOT NULL,
  `sdtnsx` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`mansx`, `tennsx`, `diachinsx`, `sdtnsx`) VALUES
('NSX001', 'Công ty TNHH A', 'áđâsdá', '123141'),
('NSX002', 'Công ty TNHH A', '456 Đường B, Quận 2, TP. Hồ Chí Minh', '0902345678'),
('NSX003', 'Công ty TNHH C', '789 Đường C, Quận 3, TP. Hồ Chí Minh', '0903456789'),
('NSX004', 'Công ty TNHH D', '111 Đường D, Quận 4, TP. Hồ Chí Minh', '0904567890'),
('NSX005', 'Công ty TNHH E', '222 Đường E, Quận 5, TP. Hồ Chí Minh', '0905678901'),
('NSX006', 'Công ty TNHH F', '333 Đường F, Quận 6, TP. Hồ Chí Minh', '0906789012'),
('NSX007', 'Công ty TNHH G', '444 Đường G, Quận 7, TP. Hồ Chí Minh', '0907890123'),
('NSX008', 'Công ty TNHH H', '555 Đường H, Quận 8, TP. Hồ Chí Minh', '0908901234'),
('NSX009', 'Công ty TNHH I', '666 Đường I, Quận 9, TP. Hồ Chí Minh', '0909012345'),
('NSX010', 'Công ty TNHH K', '777 Đường K, Quận 10, TP. Hồ Chí Minh', '0900123456');

-- --------------------------------------------------------

--
-- Table structure for table `sanphamnsx`
--

CREATE TABLE `sanphamnsx` (
  `mansx` varchar(20) NOT NULL,
  `maspnsx` varchar(20) NOT NULL,
  `tenspnsx` varchar(255) NOT NULL,
  `ngaysanxuat` varchar(20) NOT NULL,
  `ngayxuathang` varchar(20) NOT NULL,
  `hinhanh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanphamnsx`
--

INSERT INTO `sanphamnsx` (`mansx`, `maspnsx`, `tenspnsx`, `ngaysanxuat`, `ngayxuathang`, `hinhanh`) VALUES
('NSX002', 'SP002', 'Sản phẩm 2', '2022-12-03', '2023-05-04', 'img/hoahau.jpeg'),
('NSX003', 'SP003', 'Sản phẩm 3', '2022-11-05', '2023-05-06', 'img/thitga.jpg'),
('NSX004', 'SP004', 'Sản phẩm 4', '2022-08-07', '2023-05-08', 'img/thitga.jpg'),
('NSX005', 'SP005', 'Sản phẩm 5', '2022-07-09', '2023-05-10', 'img/thitga.jpg'),
('NSX006', 'SP006', 'Sản phẩm 6', '2022-06-11', '2023-05-12', 'img/thitga.jpg'),
('NSX007', 'SP007', 'Sản phẩm 7', '2022-04-13', '2022-05-14', 'img/thitga.jpg'),
('NSX008', 'SP008', 'Sản phẩm 8', '2022-01-15', '2022-05-16', 'img/thitga.jpg'),
('NSX009', 'SP009', 'Sản phẩm 9', '2022-03-17', '2022-05-13', 'img/thitga.jpg'),
('NSX010', 'SP010', 'Sản phẩm 10', '2023-02-17', '2023-05-13', 'img/thitga.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sanphampp`
--

CREATE TABLE `sanphampp` (
  `mapp` varchar(20) NOT NULL,
  `masppp` varchar(20) NOT NULL,
  `mansx` varchar(20) NOT NULL,
  `tensppp` varchar(255) NOT NULL,
  `ngaynhaphang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanphampp`
--

INSERT INTO `sanphampp` (`mapp`, `masppp`, `mansx`, `tensppp`, `ngaynhaphang`) VALUES
('NP006', 'MASP006', 'NSX002', 'Sản phẩm D', '2022-06-01'),
('NP008', 'MASP008', 'NSX004', 'Sản phẩm H', '2022-08-01'),
('NP009', 'MASP009', 'NSX002', 'Sản phẩm I', '2022-09-01'),
('NP010', 'MASP010', 'NSX003', 'Sản phẩm J', '2022-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tendangnhap` text NOT NULL,
  `matkhau` text NOT NULL,
  `vaitro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`tendangnhap`, `matkhau`, `vaitro`) VALUES
('dothanhhau', '123', 'addmin'),
('nguyenthanhduy', '123', 'addmin'),
('nghia', '123', 'nhà sản xuất'),
('ngoc', '123', 'nhà sản xuất'),
('xuyen', '123', 'nhà phân phối'),
('quynh', '123', 'nhà phân phối');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nhaphanphoi`
--
ALTER TABLE `nhaphanphoi`
  ADD PRIMARY KEY (`mapp`);

--
-- Indexes for table `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  ADD PRIMARY KEY (`mansx`);

--
-- Indexes for table `sanphamnsx`
--
ALTER TABLE `sanphamnsx`
  ADD PRIMARY KEY (`maspnsx`),
  ADD KEY `fk_mansx` (`mansx`);

--
-- Indexes for table `sanphampp`
--
ALTER TABLE `sanphampp`
  ADD PRIMARY KEY (`masppp`),
  ADD KEY `fk_mapp` (`mapp`),
  ADD KEY `fk_mansx1` (`mansx`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanphamnsx`
--
ALTER TABLE `sanphamnsx`
  ADD CONSTRAINT `fk_mansx` FOREIGN KEY (`mansx`) REFERENCES `nhasanxuat` (`mansx`);

--
-- Constraints for table `sanphampp`
--
ALTER TABLE `sanphampp`
  ADD CONSTRAINT `fk_mansx1` FOREIGN KEY (`mansx`) REFERENCES `nhasanxuat` (`mansx`),
  ADD CONSTRAINT `fk_mapp` FOREIGN KEY (`mapp`) REFERENCES `nhaphanphoi` (`mapp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
