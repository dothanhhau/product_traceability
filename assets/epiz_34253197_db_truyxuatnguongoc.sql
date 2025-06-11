-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql108.infinityfree.com
-- Generation Time: Jun 06, 2023 at 03:15 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_34253197_db_truyxuatnguongoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `nhaphanphoi`
--

CREATE TABLE `nhaphanphoi` (
  `tendangnhap` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `mapp` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `tenpp` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `diachipp` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `sdtpp` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nhaphanphoi`
--

INSERT INTO `nhaphanphoi` (`tendangnhap`, `mapp`, `tenpp`, `diachipp`, `sdtpp`) VALUES
('coopmart', 'NP001', 'Coopmart', '35 Lý Thường Kiệt, Quy Nhơn, Bình Đinh', '0123456789'),
('go', 'NP002', 'GO', '230 Tây Sơn, Quy Nhơn, Bình Định', '0123456789'),
('bigc', 'NP003', 'BIG C', '198 Lý Thái Tổ, Quy Nhơn, Bình ĐỊnh', '2342342234'),
('mega', 'NP004', 'MEGA Market', '456 đường JKL, Quận 4, TP.HCM', '0987654321'),
('garden', 'NP005', 'GARDEN Plaza', '123 đường MNO, Quận 5, TP.HCM', '0123456789'),
('seven', 'NP006', 'SEVEN ELEVEN', '789 đường PQR, Quận 6, TP.HCM', '0987654321'),
('family', 'NP007', 'FAMILY Mart', '456 đường STU, Quận 7, TP.HCM', '0123456789'),
('247', 'NP008', '24/7 Market', '123 đường VWX, Quận 8, TP.HCM', '0987654321'),
('jolibee', 'NP009', 'JOLIBEE', '789 đường YZ, Quận 9, TP.HCM', '0123456789'),
('lotteria', 'NP010', 'LOTTERIA', '456 đường XYZ, Quận 10, TP.HCM', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `tendangnhap` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `mansx` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `tennsx` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `diachinsx` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `sdtnsx` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`tendangnhap`, `mansx`, `tennsx`, `diachinsx`, `sdtnsx`) VALUES
('thanhhau', 'NSX002', 'Công ty TNHH Thành Hậu', '456 Đường B, Quận 2, TP. Hồ Chí Minh', '0902345678'),
('thanhduy', 'NSX003', 'Công ty TNHH Thành Duy', '789 Đường C, Quận 3, TP. Hồ Chí Minh', '0903456789'),
('ngocquy', 'NSX004', 'Công ty TNHH Ngọc Quý', '111 Đường D, Quận 4, TP. Hồ Chí Minh', '0904567890'),
('khanhduy', 'NSX005', 'Công ty TNHH Khánh Duy', '222 Đường E, Quận 5, TP. Hồ Chí Minh', '0905678901'),
('thuuyen', 'NSX006', 'Công ty TNHH Thu Uyên', '333 Đường F, Quận 6, TP. Hồ Chí Minh', '0906789012'),
('qnu', 'NSX007', 'Công ty TNHH QNU', '444 Đường G, Quận 7, TP. Hồ Chí Minh', '0907890123'),
('fpt', 'NSX008', 'Công ty TNHH FPT', '555 Đường H, Quận 8, TP. Hồ Chí Minh', '0908901234'),
('fjs', 'NSX009', 'Công ty TNHH FUJINET', '666 Đường I, Quận 9, TP. Hồ Chí Minh', '0909012345'),
('tma', 'NSX010', 'Công ty TNHH TMA', '777 Đường K, Quận 10, TP. Hồ Chí Minh', '0900123456');

-- --------------------------------------------------------

--
-- Table structure for table `sanphamnsx`
--

CREATE TABLE `sanphamnsx` (
  `mansx` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `maspnsx` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `tenspnsx` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `ngaysanxuat` date NOT NULL,
  `ngayxuathang` date NOT NULL,
  `hinhanh` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `sanphamnsx`
--

INSERT INTO `sanphamnsx` (`mansx`, `maspnsx`, `tenspnsx`, `ngaysanxuat`, `ngayxuathang`, `hinhanh`) VALUES
('NSX002', 'A1', 'Thịt gà', '2023-03-01', '2023-03-04', 'img/thitga.jpg'),
('NSX002', 'A10', 'Thịt tôm', '2024-07-05', '2024-07-08', 'img/thittom.jpg'),
('NSX002', 'A11', 'Thịt bê', '2024-09-10', '2024-09-12', 'img/thitbe.jpg'),
('NSX002', 'A12', 'Thịt chim cút', '2024-11-15', '2024-11-18', 'img/thitchimcut.jpg'),
('NSX002', 'A13', 'Thịt gà đông tảo', '2025-01-20', '2025-01-23', 'img/thitgadongtao.jpg'),
('NSX002', 'A14', 'Thịt vịt quay', '2025-03-25', '2025-03-28', 'img/thitvitquay.jpg'),
('NSX002', 'A15', 'Thịt lợn mọi', '2025-05-30', '2025-06-02', 'img/thitlonmoi.jpg'),
('NSX002', 'A2', 'Thịt Lợn', '2023-12-06', '2023-12-08', 'img/thitlon.jpg'),
('NSX002', 'A3', 'Thịt bò', '2023-05-10', '2023-05-12', 'img/thitbo.jpg'),
('NSX002', 'A4', 'Thịt gà ta', '2023-07-15', '2023-07-18', 'img/thitgata.jpg'),
('NSX002', 'A5', 'Thịt heo quay', '2023-09-22', '2023-09-25', 'img/thitheoquay.jpg'),
('NSX002', 'A6', 'Thịt cá hồi', '2023-11-05', '2023-11-08', 'img/thitcahoi.jpg'),
('NSX002', 'A7', 'Thịt cừu', '2024-01-10', '2024-01-12', 'img/thitcuu.jpg'),
('NSX002', 'A8', 'Thịt ngan', '2024-03-15', '2024-03-18', 'img/thitngan.jpg'),
('NSX002', 'A9', 'Thịt cua', '2024-05-22', '2024-05-25', 'img/thitcua.jpg'),
('NSX003', 'B1', 'Rau cải chíp', '2023-03-01', '2023-03-04', 'img/raucai.jpg'),
('NSX003', 'B10', 'Rau mùi tàu', '2023-03-10', '2023-03-13', 'img/raumuitau.jpg'),
('NSX003', 'B2', 'Rau muống', '2023-03-02', '2023-03-05', 'img/raumuong.jpg'),
('NSX003', 'B3', 'Rau xà lách', '2023-03-03', '2023-03-06', 'img/rauxalach.jpg'),
('NSX003', 'B4', 'Rau mồng tơi', '2023-03-04', '2023-03-07', 'img/raumongtoi.jpg'),
('NSX003', 'B5', 'Rau cải thìa', '2023-03-05', '2023-03-08', 'img/raucaithia.jpg'),
('NSX003', 'B6', 'Rau ngò gai', '2023-03-06', '2023-03-09', 'img/raungogai.jpg'),
('NSX003', 'B7', 'Rau húng quế', '2023-03-07', '2023-03-10', 'img/rauhungque.jpg'),
('NSX003', 'B8', 'Rau cần tây', '2023-03-08', '2023-03-11', 'img/raucantay.jpg'),
('NSX003', 'B9', 'Rau bina', '2023-03-09', '2023-03-12', 'img/raubina.jpg'),
('NSX004', 'C1', 'Bánh mì', '2023-03-01', '2023-03-04', 'img/Bánh_mì_thịt_nướng.png'),
('NSX004', 'C10', 'Bánh tét', '2023-03-10', '2023-03-13', 'img/banhtet.jpg'),
('NSX004', 'C2', 'Bánh bao', '2023-03-02', '2023-03-05', 'img/banhbao.jpg'),
('NSX004', 'C3', 'Bánh pía', '2023-03-03', '2023-03-06', 'img/banhpia.jpg'),
('NSX004', 'C4', 'Bánh flan', '2023-03-04', '2023-03-07', 'img/banhflan.jpg'),
('NSX004', 'C5', 'Bánh tráng', '2023-03-05', '2023-03-08', 'img/banh-trang-muoi-ot-tay-ninh-1_1631506099.jpg'),
('NSX004', 'C6', 'Bánh dày', '2023-03-06', '2023-03-09', 'img/banhday.jpg'),
('NSX004', 'C7', 'Bánh mứt', '2023-03-07', '2023-03-10', 'img/banhmut.jpg'),
('NSX004', 'C8', 'Bánh lá', '2023-03-08', '2023-03-11', 'img/banhla.jpg'),
('NSX004', 'C9', 'Bánh gai', '2023-03-09', '2023-03-12', 'img/bánh gai.jpg'),
('NSX005', 'D1', 'Mực', '2023-04-01', '2023-04-02', 'img/muc.jpg'),
('NSX005', 'D10', 'Cá basa', '2023-04-10', '2023-04-11', 'img/cabasa.jpg'),
('NSX005', 'D2', 'Tôm', '2023-04-02', '2023-04-03', 'img/tom.jpg'),
('NSX005', 'D3', 'Cua', '2023-04-03', '2023-04-04', 'img/cua.jpg'),
('NSX005', 'D4', 'Sò điệp', '2023-04-04', '2023-04-05', 'img/sodiep.jpg'),
('NSX005', 'D5', 'Hàu', '2023-04-05', '2023-04-06', 'img/hau.jpg'),
('NSX005', 'D6', 'Nghêu', '2023-04-06', '2023-04-07', 'img/ngheu.jpg'),
('NSX005', 'D7', 'Sứa', '2023-04-07', '2023-04-08', 'img/sua.jpg'),
('NSX005', 'D8', 'Cá hồi', '2023-04-08', '2023-04-09', 'img/cahoi.jpg'),
('NSX005', 'D9', 'Tôm hùm', '2023-04-09', '2023-04-10', 'img/tomhum.jpg'),
('NSX006', 'E1', 'Sò điệp', '2023-05-01', '2023-05-02', 'img/sodiep.jpg'),
('NSX006', 'E10', 'Cá basa', '2023-05-10', '2023-05-11', 'img/cabasa.jpg'),
('NSX006', 'E2', 'Mực biển', '2023-05-02', '2023-05-03', 'img/muc-bien.jpg'),
('NSX006', 'E3', 'Tôm hùm', '2023-05-03', '2023-05-04', 'img/tomhum.jpg'),
('NSX006', 'E4', 'Hàu', '2023-05-04', '2023-05-05', 'img/hau.jpg'),
('NSX006', 'E5', 'Tôm sú', '2023-05-05', '2023-05-06', 'img/tomhum.jpg'),
('NSX006', 'E6', 'Sò điệp tươi', '2023-05-06', '2023-05-07', 'img/banhla.jpg'),
('NSX006', 'E7', 'Cua biển', '2023-05-07', '2023-05-08', 'img/cua.jpg'),
('NSX006', 'E8', 'Mực khô', '2023-05-08', '2023-05-09', 'img/muc.jpg'),
('NSX006', 'E9', 'Tôm hùm tươi', '2023-05-09', '2023-05-10', 'img/tomhum.jpg'),
('NSX007', 'F1', 'Sò điệp', '2023-05-01', '2023-05-02', 'img/so-diep.jpg'),
('NSX007', 'F10', 'Tôm hùm tươi', '2023-05-10', '2023-05-11', 'img/tom-hum-tuoi.jpg'),
('NSX007', 'F11', 'Bạch tuộc', '2023-05-11', '2023-05-12', 'img/bach-tuoc.jpg'),
('NSX007', 'F12', 'Sò điệp tươi sống', '2023-05-12', '2023-05-13', 'img/so-diep-tuoi-song.jpg'),
('NSX007', 'F13', 'Cá ngừ', '2023-05-13', '2023-05-14', 'img/ca-ngu.jpg'),
('NSX007', 'F2', 'Mực biển', '2023-05-02', '2023-05-03', 'img/muc-bien.jpg'),
('NSX007', 'F3', 'Tôm hùm', '2023-05-03', '2023-05-04', 'img/tom-hum.jpg'),
('NSX007', 'F4', 'Hàu', '2023-05-04', '2023-05-05', 'img/hau.jpg'),
('NSX007', 'F5', 'Tôm sú', '2023-05-05', '2023-05-06', 'img/tom-su.jpg'),
('NSX007', 'F6', 'Sò điệp tươi', '2023-05-06', '2023-05-07', 'img/so-diep-tuoi.jpg'),
('NSX007', 'F7', 'Cá hồi', '2023-05-07', '2023-05-08', 'img/ca-hoi.jpg'),
('NSX007', 'F8', 'Sò điệp tươi', '2023-05-08', '2023-05-09', 'img/so-diep-tuoi.jpg'),
('NSX007', 'F9', 'Cua biển', '2023-05-09', '2023-05-10', 'img/cuabien.jpg'),
('NSX008', 'G1', 'Sò điệp', '2023-05-01', '2023-05-02', 'img/so-diep.jpg'),
('NSX008', 'G10', 'Tôm hùm tươi', '2023-05-10', '2023-05-11', 'img/tom-hum-tuoi.jpg'),
('NSX008', 'G11', 'Bạch tuộc', '2023-05-11', '2023-05-12', 'img/bach-tuoc.jpg'),
('NSX008', 'G12', 'Sò điệp tươi sống', '2023-05-12', '2023-05-13', 'img/so-diep-tuoi-song.jpg'),
('NSX008', 'G13', 'Cá ngừ', '2023-05-13', '2023-05-14', 'img/ca-ngu.jpg'),
('NSX008', 'G2', 'Mực biển', '2023-05-02', '2023-05-03', 'img/muc-bien.jpg'),
('NSX008', 'G3', 'Tôm hùm', '2023-05-03', '2023-05-04', 'img/tom-hum.jpg'),
('NSX008', 'G7', 'Cá hồi', '2023-05-07', '2023-05-08', 'img/ca-hoi.jpg'),
('NSX008', 'G8', 'Sò điệp tươi', '2023-05-08', '2023-05-09', 'img/so-diep-tuoi.jpg'),
('NSX008', 'G9', 'Cua biển', '2023-05-09', '2023-05-10', 'img/cua-bien.jpg'),
('NSX009', 'H10', 'Ổi', '2023-05-04', '2023-05-05', 'img/oi.jpg'),
('NSX009', 'H11', 'Mận', '2023-05-05', '2023-05-06', 'img/man.jpg'),
('NSX009', 'H12', 'Bưởi', '2023-05-06', '2023-05-07', 'img/buoi.jpg'),
('NSX009', 'H13', 'Cam', '2023-05-07', '2023-05-08', 'img/cam.jpg'),
('NSX009', 'H14', 'Nho', '2023-05-08', '2023-05-09', 'img/nho.jpg'),
('NSX009', 'H15', 'Táo', '2023-05-09', '2023-05-10', 'img/tao.jpg'),
('NSX009', 'H16', 'Kiwi', '2023-05-10', '2023-05-11', 'img/kiwi.jpg'),
('NSX009', 'H7', 'Dứa', '2023-05-01', '2023-05-02', 'img/dua.jpg'),
('NSX009', 'H8', 'Mít', '2023-05-02', '2023-05-03', 'img/mit.jpg'),
('NSX009', 'H9', 'Chuối', '2023-05-03', '2023-05-04', 'img/chuoi.jpg'),
('NSX010', 'I1', 'Dừa', '2023-05-01', '2023-05-02', 'img/dua.jpg'),
('NSX010', 'I10', 'Cam xoàn', '2023-05-10', '2023-05-11', 'img/cam.jpg'),
('NSX010', 'I2', 'Mãng cầu', '2023-05-02', '2023-05-03', 'img/mang-cau.jpg'),
('NSX010', 'I3', 'Lựu', '2023-05-03', '2023-05-04', 'img/luu.jpg'),
('NSX010', 'I4', 'Bơ', '2023-05-04', '2023-05-05', 'img/bo.jpg'),
('NSX010', 'I5', 'Dưa hấu', '2023-05-05', '2023-05-06', 'img/dua-hau.jpg'),
('NSX010', 'I6', 'Sầu riêng', '2023-05-06', '2023-05-07', 'img/sau-rieng.jpg'),
('NSX010', 'I7', 'Nước dừa', '2023-05-07', '2023-05-08', 'img/nuoc-dua.jpg'),
('NSX010', 'I8', 'Chôm chôm', '2023-05-08', '2023-05-09', 'img/chom-chom.jpg'),
('NSX010', 'I9', 'Thanh long', '2023-05-09', '2023-05-10', 'img/thanh-long.jpg'),
('NSX003', 'A16', 'Tôm Hùm', '2023-02-25', '2023-02-27', 'img/tomhum.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sanphampp`
--

CREATE TABLE `sanphampp` (
  `mapp` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `masppp` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `mansx` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `tensppp` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `ngaynhaphang` date NOT NULL,
  `hinhanh` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `sanphampp`
--

INSERT INTO `sanphampp` (`mapp`, `masppp`, `mansx`, `tensppp`, `ngaynhaphang`, `hinhanh`) VALUES
('NP003', 'A1', 'NSX002', 'Thịt gà', '2023-03-04', 'img/thitga.jpg'),
('NP003', 'A10', 'NSX002', 'Thịt tôm', '2024-07-08', 'img/thittom.jpg'),
('NP003', 'A11', 'NSX002', 'Thịt bê', '2024-09-12', 'img/thitbe.jpg'),
('NP003', 'A12', 'NSX002', 'Thịt chim cút', '2024-11-18', 'img/thitchimcut.jpg'),
('NP003', 'A13', 'NSX002', 'Thịt gà đông tảo', '2025-01-23', 'img/thitgadongtao.jpg'),
('NP003', 'A14', 'NSX002', 'Thịt vịt quay', '2025-03-28', 'img/thitvitquay.jpg'),
('NP003', 'A15', 'NSX002', 'Thịt lợn mọi', '2025-06-02', 'img/thitlonmoi.jpg'),
('NP003', 'A2', 'NSX002', 'Thịt Lợn', '2023-12-08', 'img/thitlon.jpg'),
('NP003', 'A3', 'NSX002', 'Thịt bò', '2023-05-12', 'img/thitbo.jpg'),
('NP003', 'A4', 'NSX002', 'Thịt gà ta', '2023-07-18', 'img/thitgata.jpg'),
('NP003', 'A5', 'NSX002', 'Thịt heo quay', '2023-09-25', 'img/thitheoquay.jpg'),
('NP003', 'A6', 'NSX002', 'Thịt cá hồi', '2023-11-08', 'img/thitcahoi.jpg'),
('NP003', 'A7', 'NSX002', 'Thịt cừu', '2024-01-12', 'img/thitcuu.jpg'),
('NP003', 'A8', 'NSX002', 'Thịt ngan', '2024-03-18', 'img/thitngan.jpg'),
('NP003', 'A9', 'NSX002', 'Thịt cua', '2024-05-25', 'img/thitcua.jpg'),
('NP002', 'B1', 'NSX003', 'Rau cải chíp', '2023-03-04', 'img/rau_cai_canh_vang-570x421.jpg'),
('NP002', 'B10', 'NSX003', 'Rau mùi tàu', '2023-03-13', 'img/raumuitau.jpg'),
('NP002', 'B2', 'NSX003', 'Rau muống', '2023-03-05', 'img/raumuong.jpg'),
('NP002', 'B3', 'NSX003', 'Rau xà lách', '2023-03-06', 'img/rauxalach.jpg'),
('NP002', 'B4', 'NSX003', 'Rau mồng tơi', '2023-03-07', 'img/raumongtoi.jpg'),
('NP002', 'B5', 'NSX003', 'Rau cải thìa', '2023-03-08', 'img/raucaithia.jpg'),
('NP002', 'B6', 'NSX003', 'Rau ngò gai', '2023-03-09', 'img/raungogai.jpg'),
('NP002', 'B7', 'NSX003', 'Rau húng quế', '2023-03-10', 'img/rauhungque.jpg'),
('NP002', 'B8', 'NSX003', 'Rau cần tây', '2023-03-11', 'img/raucantay.jpg'),
('NP002', 'B9', 'NSX003', 'Rau bina', '2023-03-12', 'img/raubina.jpg'),
('NP005', 'C1', 'NSX004', 'Bánh mì', '2023-03-04', 'img/banhmi.jpg'),
('NP005', 'C10', 'NSX004', 'Bánh tét', '2023-03-13', 'img/banhtet.jpg'),
('NP005', 'C2', 'NSX004', 'Bánh bao', '2023-03-05', 'img/banhbao.jpg'),
('NP005', 'C3', 'NSX004', 'Bánh pía', '2023-03-06', 'img/banhpia.jpg'),
('NP005', 'C4', 'NSX004', 'Bánh flan', '2023-03-07', 'img/banhflan.jpg'),
('NP005', 'C5', 'NSX004', 'Bánh tráng', '2023-03-08', 'img/banhtrang.jpg'),
('NP005', 'C6', 'NSX004', 'Bánh dày', '2023-03-09', 'img/banhday.jpg'),
('NP005', 'C7', 'NSX004', 'Bánh mứt', '2023-03-10', 'img/banhmut.jpg'),
('NP005', 'C8', 'NSX004', 'Bánh lá', '2023-03-11', 'img/banhlam.jpg'),
('NP005', 'C9', 'NSX004', 'Bánh gai', '2023-03-12', 'img/banhgai.jpg'),
('NP009', 'D4', 'NSX005', 'Sò điệp', '2023-04-05', 'img/sodiep.jpg'),
('NP009', 'D5', 'NSX005', 'Hàu', '2023-04-06', 'img/hau.jpg'),
('NP009', 'D6', 'NSX005', 'Nghêu', '2023-04-07', 'img/ngheu.jpg'),
('NP009', 'D7', 'NSX005', 'Sứa', '2023-04-08', 'img/sua.jpg'),
('NP009', 'D8', 'NSX005', 'Cá hồi', '2023-04-09', 'img/cahoi.jpg'),
('NP009', 'D9', 'NSX005', 'Tôm hùm', '2023-04-10', 'img/tomhum.jpg'),
('NP004', 'E1', 'NSX006', 'Sò điệp', '2023-05-02', 'img/so-diep.jpg'),
('NP004', 'E10', 'NSX006', 'Cá basa', '2023-05-11', 'img/ca-basa.jpg'),
('NP004', 'E2', 'NSX006', 'Mực biển', '2023-05-03', 'img/muc-bien.jpg'),
('NP004', 'E3', 'NSX006', 'Tôm hùm', '2023-05-04', 'img/tom-hum.jpg'),
('NP004', 'E4', 'NSX006', 'Hàu', '2023-05-05', 'img/hau.jpg'),
('NP004', 'E5', 'NSX006', 'Tôm sú', '2023-05-06', 'img/tom-su.jpg'),
('NP004', 'E6', 'NSX006', 'Sò điệp tươi', '2023-05-07', 'img/so-diep-tuoi.jpg'),
('NP004', 'E7', 'NSX006', 'Cua biển', '2023-05-08', 'img/cua-bien.jpg'),
('NP004', 'E8', 'NSX006', 'Mực khô', '2023-05-09', 'img/muc-kho.jpg'),
('NP004', 'E9', 'NSX006', 'Tôm hùm tươi', '2023-05-10', 'img/tom-hum-tuoi.jpg'),
('NP007', 'F1', 'NSX007', 'Sò điệp', '2023-05-02', 'img/so-diep.jpg'),
('NP007', 'F10', 'NSX007', 'Tôm hùm tươi', '2023-05-11', 'img/tom-hum-tuoi.jpg'),
('NP007', 'F11', 'NSX007', 'Bạch tuộc', '2023-05-12', 'img/bach-tuoc.jpg'),
('NP007', 'F12', 'NSX007', 'Sò điệp tươi sống', '2023-05-13', 'img/so-diep-tuoi-song.jpg'),
('NP007', 'F13', 'NSX007', 'Cá ngừ', '2023-05-14', 'img/ca-ngu.jpg'),
('NP007', 'F2', 'NSX007', 'Mực biển', '2023-05-03', 'img/muc-bien.jpg'),
('NP007', 'F3', 'NSX007', 'Tôm hùm', '2023-05-04', 'img/tom-hum.jpg'),
('NP007', 'F4', 'NSX007', 'Hàu', '2023-05-05', 'img/hau.jpg'),
('NP007', 'F5', 'NSX007', 'Tôm sú', '2023-05-06', 'img/tom-su.jpg'),
('NP007', 'F6', 'NSX007', 'Sò điệp tươi', '2023-05-07', 'img/so-diep-tuoi.jpg'),
('NP007', 'F7', 'NSX007', 'Cá hồi', '2023-05-08', 'img/ca-hoi.jpg'),
('NP007', 'F8', 'NSX007', 'Sò điệp tươi', '2023-05-09', 'img/so-diep-tuoi.jpg'),
('NP007', 'F9', 'NSX007', 'Cua biển', '2023-05-10', 'img/cua-bien.jpg'),
('NP008', 'G1', 'NSX008', 'Sò điệp', '2023-05-02', 'img/so-diep.jpg'),
('NP008', 'G10', 'NSX008', 'Tôm hùm tươi', '2023-05-11', 'img/tom-hum-tuoi.jpg'),
('NP008', 'G11', 'NSX008', 'Bạch tuộc', '2023-05-12', 'img/bach-tuoc.jpg'),
('NP008', 'G12', 'NSX008', 'Sò điệp tươi sống', '2023-05-13', 'img/so-diep-tuoi-song.jpg'),
('NP008', 'G13', 'NSX008', 'Cá ngừ', '2023-05-14', 'img/ca-ngu.jpg'),
('NP008', 'G2', 'NSX008', 'Mực biển', '2023-05-03', 'img/muc-bien.jpg'),
('NP008', 'G3', 'NSX008', 'Tôm hùm', '2023-05-04', 'img/tom-hum.jpg'),
('NP008', 'G7', 'NSX008', 'Cá hồi', '2023-05-08', 'img/ca-hoi.jpg'),
('NP008', 'G8', 'NSX008', 'Sò điệp tươi', '2023-05-09', 'img/so-diep-tuoi.jpg'),
('NP008', 'G9', 'NSX008', 'Cua biển', '2023-05-10', 'img/cua-bien.jpg'),
('NP006', 'H10', 'NSX009', 'Ổi', '2023-05-05', 'img/oi.jpg'),
('NP006', 'H11', 'NSX009', 'Mận', '2023-05-06', 'img/man.jpg'),
('NP006', 'H12', 'NSX009', 'Bưởi', '2023-05-07', 'img/buoi.jpg'),
('NP006', 'H13', 'NSX009', 'Cam', '2023-05-08', 'img/cam.jpg'),
('NP006', 'H14', 'NSX009', 'Nho', '2023-05-09', 'img/nho.jpg'),
('NP006', 'H15', 'NSX009', 'Táo', '2023-05-10', 'img/tao.jpg'),
('NP006', 'H16', 'NSX009', 'Kiwi', '2023-05-11', 'img/kiwi.jpg'),
('NP006', 'H7', 'NSX009', 'Dứa', '2023-05-02', 'img/dua.jpg'),
('NP006', 'H8', 'NSX009', 'Mít', '2023-05-03', 'img/mit.jpg'),
('NP006', 'H9', 'NSX009', 'Chuối', '2023-05-04', 'img/chuoi.jpg'),
('NP003', 'áđá', 'NSX002', 'đâsd', '2023-06-15', 'not-img'),
('NP004', 'a', 'NSX002', 'a', '2023-05-30', 'img/xanh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tendangnhap` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `matkhau` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `vaitro` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`tendangnhap`, `matkhau`, `vaitro`) VALUES
('dothanhhau', '123', 'admin'),
('nguyenthanhduy', '123', 'admin'),
('nghia', '123', 'nsx'),
('ngoc', '123', 'nsx'),
('xuyen', '123', 'npp'),
('quynh', '123', 'npp'),
('thanhhau', '123', 'nsx'),
('thanhduy', '123', 'nsx'),
('ngocquy', '123', 'nsx'),
('khanhduy', '123', 'nsx'),
('thuuyen', '123', 'nsx'),
('qnu', '123', 'nsx'),
('fpt', '123', 'nsx'),
('fjs', '123', 'nsx'),
('tma', 'nsx123', ''),
('coopmart', '123', 'npp'),
('go', '123', 'npp'),
('bigc', '123', 'npp'),
('mega', '123', 'npp'),
('garden', '123', 'npp'),
('seven', '123', 'npp'),
('family', '123', 'npp'),
('247', '123', 'npp'),
('jolibee', '123', 'npp'),
('lotteria', '123', 'npp'),
('hau123', '123', 'nsx');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
