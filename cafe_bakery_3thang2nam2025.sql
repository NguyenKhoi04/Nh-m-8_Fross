-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: cafe_bakery
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chi_tiet_don_hang`
--

DROP TABLE IF EXISTS `chi_tiet_don_hang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chi_tiet_don_hang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_don_hang` int NOT NULL,
  `id_san_pham` int NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `giam_phan_tram` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ghi_chu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thanh_tien` decimal(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_don_hang` (`id_don_hang`),
  KEY `id_san_pham` (`id_san_pham`),
  CONSTRAINT `fk_ctdh_donhang` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ctdh_sanpham` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chi_tiet_don_hang`
--

LOCK TABLES `chi_tiet_don_hang` WRITE;
/*!40000 ALTER TABLE `chi_tiet_don_hang` DISABLE KEYS */;
INSERT INTO `chi_tiet_don_hang` VALUES (1,1,1,2,28000.00,0.00,'Ít đá',56000.00),(2,1,3,1,35000.00,10.00,'Ít đường',31500.00);
/*!40000 ALTER TABLE `chi_tiet_don_hang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danh_gia`
--

DROP TABLE IF EXISTS `danh_gia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `danh_gia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nguoi_dung` int NOT NULL,
  `id_san_pham` int NOT NULL,
  `so_sao` tinyint NOT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_dung` (`id_nguoi_dung`),
  KEY `id_san_pham` (`id_san_pham`),
  CONSTRAINT `fk_dg_nguoidung` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_dg_sanpham` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danh_gia`
--

LOCK TABLES `danh_gia` WRITE;
/*!40000 ALTER TABLE `danh_gia` DISABLE KEYS */;
/*!40000 ALTER TABLE `danh_gia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danh_muc`
--

DROP TABLE IF EXISTS `danh_muc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `danh_muc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten_danh_muc` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT 'khac',
  `kich_hoat` tinyint NOT NULL DEFAULT '1',
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danh_muc`
--

LOCK TABLES `danh_muc` WRITE;
/*!40000 ALTER TABLE `danh_muc` DISABLE KEYS */;
INSERT INTO `danh_muc` VALUES (1,'Cà phê','do_uong',1,'2025-11-04 13:59:04'),(2,'Trà','do_uong',1,'2025-11-04 13:59:04'),(3,'Bánh ngọt','trang_mieng',1,'2025-11-04 13:59:04'),(4,'Bánh mặn','trang_mieng',1,'2025-11-04 13:59:04');
/*!40000 ALTER TABLE `danh_muc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `don_hang`
--

DROP TABLE IF EXISTS `don_hang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `don_hang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nguoi_dung` int NOT NULL,
  `ghi_chu_giao_hang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia_chi_giao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trang_thai` enum('da_dat','dang_chuan_bi','da_huy','hoan_thanh') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'da_dat',
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_dung` (`id_nguoi_dung`),
  CONSTRAINT `fk_donhang_nguoidung` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `don_hang`
--

LOCK TABLES `don_hang` WRITE;
/*!40000 ALTER TABLE `don_hang` DISABLE KEYS */;
INSERT INTO `don_hang` VALUES (1,3,'Giao nhanh trong 30 phút','12 Nguyễn Văn B, Q.10','da_dat','2025-11-04 13:59:04');
/*!40000 ALTER TABLE `don_hang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lich_su_dang_nhap`
--

DROP TABLE IF EXISTS `lich_su_dang_nhap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lich_su_dang_nhap` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nguoi_dung` int NOT NULL,
  `tieu_de` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_dung` (`id_nguoi_dung`),
  CONSTRAINT `fk_ls_dn_nguoidung` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lich_su_dang_nhap`
--

LOCK TABLES `lich_su_dang_nhap` WRITE;
/*!40000 ALTER TABLE `lich_su_dang_nhap` DISABLE KEYS */;
/*!40000 ALTER TABLE `lich_su_dang_nhap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lien_he`
--

DROP TABLE IF EXISTS `lien_he`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lien_he` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nguoi_dung` int DEFAULT NULL,
  `ho_ten` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chu_de` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_dung` (`id_nguoi_dung`),
  CONSTRAINT `fk_lienhe_nguoidung` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lien_he`
--

LOCK TABLES `lien_he` WRITE;
/*!40000 ALTER TABLE `lien_he` DISABLE KEYS */;
/*!40000 ALTER TABLE `lien_he` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nguoi_dung`
--

DROP TABLE IF EXISTS `nguoi_dung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nguoi_dung` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `vai_tro` tinyint NOT NULL DEFAULT '3',
  `kich_hoat` tinyint NOT NULL DEFAULT '1',
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tenvaitro` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nguoi_dung`
--

LOCK TABLES `nguoi_dung` WRITE;
/*!40000 ALTER TABLE `nguoi_dung` DISABLE KEYS */;
INSERT INTO `nguoi_dung` VALUES (1,'admin','admin','Quản trị viên','admin@example.com',NULL,NULL,NULL,1,1,'2025-11-04 13:59:04','admin'),(2,'MinhKhoi','nhanvien01','Đặng Minh Khôi','minhkhoi@gmail.com','012345678',NULL,NULL,2,1,'2025-11-04 13:59:04','nhân viên'),(3,'khach01','khach01','DuongTuanKiet','khach01@gmail.com',NULL,NULL,NULL,3,1,'2025-11-04 13:59:04','khách');
/*!40000 ALTER TABLE `nguoi_dung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nguoi_dung_thong_bao`
--

DROP TABLE IF EXISTS `nguoi_dung_thong_bao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nguoi_dung_thong_bao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nguoi_dung` int NOT NULL,
  `id_thong_bao` int NOT NULL,
  `da_doc` tinyint NOT NULL DEFAULT '0',
  `ngay_doc` timestamp NULL DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_dung` (`id_nguoi_dung`),
  KEY `id_thong_bao` (`id_thong_bao`),
  CONSTRAINT `fk_ndtb_nguoidung` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ndtb_thongbao` FOREIGN KEY (`id_thong_bao`) REFERENCES `thong_bao` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nguoi_dung_thong_bao`
--

LOCK TABLES `nguoi_dung_thong_bao` WRITE;
/*!40000 ALTER TABLE `nguoi_dung_thong_bao` DISABLE KEYS */;
/*!40000 ALTER TABLE `nguoi_dung_thong_bao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `san_pham`
--

DROP TABLE IF EXISTS `san_pham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `san_pham` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_danh_muc` int NOT NULL,
  `ten_san_pham` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `gia` decimal(10,2) NOT NULL DEFAULT '0.00',
  `giam_phan_tram` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tinh_trang` enum('con_hang','het_hang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'con_hang',
  `noi_bat` tinyint NOT NULL DEFAULT '0',
  `moi` tinyint NOT NULL DEFAULT '1',
  `hinh_anh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_danh_muc` (`id_danh_muc`),
  CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `san_pham`
--

LOCK TABLES `san_pham` WRITE;
/*!40000 ALTER TABLE `san_pham` DISABLE KEYS */;
INSERT INTO `san_pham` VALUES (1,1,'Cà phê sữa (M)','Đậm đà vị sữa, đắng nhẹ',25000.00,0.00,'con_hang',1,1,'1762957733_ca_phe_sua.png','2025-11-04 13:59:04'),(2,1,'Americano (M)','Vị mạnh, thơm',25000.00,10.00,'con_hang',0,1,'1762957751_americano.png','2025-11-04 13:59:04'),(3,2,'Trà chanh (M)','Thanh mát, miếng đào giòn',35000.00,0.00,'con_hang',1,1,'1762957400_tra_chanh.png','2025-11-04 13:59:04'),(4,3,'Bánh Tiramisu','Bánh mềm, thơm cà phê',20000.00,0.00,'con_hang',0,1,'1762958461_banh_tiramisu.png','2025-11-04 13:59:04'),(5,1,'Cà phê sữa (L)','Sữa tươi, ngon tuyệt',30000.00,0.00,'con_hang',0,0,'ca_phe_sua.png','2025-11-12 14:30:45'),(6,1,'Americano (L)','Sữa ngon tuyệt',30000.00,0.00,'con_hang',0,0,'americano.png','2025-11-12 14:32:30'),(7,1,'Cafe Bạc Sỉu (M)','Cafe Bạc Sỉu (M)',25000.00,0.00,'con_hang',0,0,'bac_xiu.png','2025-11-12 14:34:27'),(8,1,'Cafe Bạc Sỉu (L)','Bạch Sỉu (L)',30000.00,0.00,'con_hang',0,0,'1762958132_bac_xiu.png','2025-11-12 14:35:08'),(9,1,'Cà phê Đen (M)','Cà phê Đen (M)',25000.00,0.00,'con_hang',0,0,'ca_phe_den.png','2025-11-12 14:36:47'),(10,1,'Cà phê Đen (L)','Cà phê Đen (l)',30000.00,0.00,'con_hang',0,0,'ca_phe_den.png','2025-11-12 14:37:22'),(11,1,'Cà phê Capuccino','Cà phê Capuccino',25000.00,0.00,'con_hang',0,0,'capuccino.png','2025-11-12 14:38:03'),(12,3,'Bánh  bông lan phô mai','Bánh  bông lan phô mai',20000.00,0.00,'con_hang',0,0,'banh_bong_lan_pho_mai.png','2025-11-12 14:42:25'),(13,4,'Bánh bông lan trứng muối','Bánh bông lan trứng muối',15000.00,0.00,'con_hang',0,0,'banh_bong_lan_trung_muoi.png','2025-11-12 17:37:53'),(14,3,'Bánh Chocolate Mousse (Kem sô-cô-la)','Kem sô-cô-la',20000.00,0.00,'con_hang',0,0,'banh_chocolate_mousse.png','2025-11-12 17:42:19'),(15,3,'Bánh Flan','Bánh Flan mền dẻo và có cafe',10000.00,0.00,'con_hang',0,0,'banh_flan.png','2025-11-12 17:50:08'),(16,3,'Bánh Matcha','Bánh Matcha chứa màu xanh, ở giữa màu trắng',10000.00,0.00,'con_hang',0,0,'banh_matcha.png','2025-11-12 17:52:48'),(17,4,'Bánh mỳ bơ tỏi','Bánh mỳ bơ tỏi +kèm sữa tươi',20000.00,0.00,'con_hang',0,0,'banh_mi_bo_toi.png','2025-11-12 17:53:57'),(18,3,'Bánh Opera','Bánh Opera: nổi bật với cấu trúc nhiều lớp xen kẽ giữa bánh bông lan hạnh nhân ngâm siro cà phê, kem bơ cà phê và ganache sô cô la, cuối cùng được phủ một lớp sô cô la mỏng.',20000.00,0.00,'con_hang',0,0,'banh_opera.png','2025-11-12 17:55:38'),(19,3,'Bánh Strawberry Shortcake','Bánh strawberry shortcake (bánh dâu tây) được làm từ các thành phần chính như bánh bông lan mềm mịn, kem tươi và dâu tây tươi. Có nhiều cách để sử dụng đường, bao gồm thêm vào bột bánh, siro dâu, và kem tươi.',20000.00,0.00,'con_hang',0,1,'banh_strawberry_shortcake.png','2025-11-12 17:57:35'),(20,2,'Trà chanh (L)','Trà chanh (L)',30000.00,10.00,'con_hang',0,0,'tra_chanh.png','2025-11-12 18:00:05'),(21,2,'Trà dâu tây (M)','Trà dâu tây (M)',25000.00,0.00,'con_hang',0,0,'tra_dau_tay.png','2025-11-12 18:00:59'),(22,2,'Trà dâu tây (L)','Trà dâu tây (L)',30000.00,15.00,'con_hang',0,0,'tra_dau_tay.png','2025-11-12 18:01:42'),(23,2,'Trà ổi hồng(M)','Trà ổi hồng(M)',25000.00,0.00,'con_hang',0,0,'tra_oi_hong.png','2025-11-12 18:02:40'),(24,2,'Trà ổi hồng (L)','Trà ổi hồng (L)',30000.00,0.00,'con_hang',0,0,'tra_oi_hong.png','2025-11-12 18:03:22'),(25,2,'Trà vải (M)','Trà vải (M)',25000.00,0.00,'con_hang',0,1,'tra_vai.png','2025-11-12 18:04:04'),(26,2,'Trà vải (L)','Trà vải (L)',30000.00,15.00,'con_hang',0,0,'tra_vai.png','2025-11-12 18:05:02'),(27,2,'Trà xoài (M)','Trà xoài (M)',25000.00,0.00,'con_hang',0,0,'tra_xoai.png','2025-11-12 18:05:40'),(28,4,'Bánh croissant chấm sốt phô mai','Với lớp vỏ giòn tan kết hợp cùng nhân bánh mềm mịn, được chấm cùng sốt phô mai thơm ngậy theo công thức độc quyền, bạn sẽ cảm nhận được một hương vị độc đáo.',30000.00,0.00,'con_hang',0,0,'1762971858_Banh_croissant_cham_sot_pho_mai.jpg','2025-11-12 18:12:19'),(29,4,'Bánh Pate Chaud','Bánh Pate Chaud nóng hổi thơm phức đậm đà là một lựa chọn tuyệt vời để bắt đầu một ngày mới tràn đầy năng lượng.',30000.00,0.00,'con_hang',0,0,'banh_pate_chaud.jpg','2025-11-12 18:12:59');
/*!40000 ALTER TABLE `san_pham` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thanh_toan`
--

DROP TABLE IF EXISTS `thanh_toan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `thanh_toan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_don_hang` int NOT NULL,
  `ma_hoa_don` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuong_thuc` enum('tien_mat','chuyen_khoan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tien_mat',
  `so_tien` decimal(12,2) NOT NULL DEFAULT '0.00',
  `trang_thai` enum('chua_thanh_toan','da_thanh_toan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chua_thanh_toan',
  `ngay_thanh_toan` datetime DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_don_hang` (`id_don_hang`),
  KEY `id_don_hang_2` (`id_don_hang`),
  CONSTRAINT `fk_thanhtoan_donhang` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thanh_toan`
--

LOCK TABLES `thanh_toan` WRITE;
/*!40000 ALTER TABLE `thanh_toan` DISABLE KEYS */;
INSERT INTO `thanh_toan` VALUES (1,1,'HD20251104205904','tien_mat',87500.00,'chua_thanh_toan',NULL,'2025-11-04 13:59:04');
/*!40000 ALTER TABLE `thanh_toan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thong_bao`
--

DROP TABLE IF EXISTS `thong_bao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `thong_bao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vai_tro_nhan` tinyint NOT NULL DEFAULT '0',
  `id_nguoi_tao` int DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_tao` (`id_nguoi_tao`),
  CONSTRAINT `fk_tb_nguoitac` FOREIGN KEY (`id_nguoi_tao`) REFERENCES `nguoi_dung` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thong_bao`
--

LOCK TABLES `thong_bao` WRITE;
/*!40000 ALTER TABLE `thong_bao` DISABLE KEYS */;
/*!40000 ALTER TABLE `thong_bao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tin_nhan`
--

DROP TABLE IF EXISTS `tin_nhan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tin_nhan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nguoi_dung` int NOT NULL,
  `chu_de` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cau_hoi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tra_loi` text COLLATE utf8mb4_unicode_ci,
  `gia` decimal(10,2) DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_dung` (`id_nguoi_dung`),
  CONSTRAINT `fk_tinnhan_nguoidung` FOREIGN KEY (`id_nguoi_dung`) REFERENCES `nguoi_dung` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tin_nhan`
--

LOCK TABLES `tin_nhan` WRITE;
/*!40000 ALTER TABLE `tin_nhan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tin_nhan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tin_tuc`
--

DROP TABLE IF EXISTS `tin_tuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tin_tuc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tom_tat` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noi_dung_html` mediumtext COLLATE utf8mb4_unicode_ci,
  `hinh_anh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tin_tuc`
--

LOCK TABLES `tin_tuc` WRITE;
/*!40000 ALTER TABLE `tin_tuc` DISABLE KEYS */;
INSERT INTO `tin_tuc` VALUES (1,'Xu hướng \"Sống Xanh\" tại các quán Cafe','Làn sóng \"Zero Waste\": Khi quán Cafe không chỉ bán đồ uống mà còn bán phong cách sống.\r\nXu hướng tiêu dùng bền vững đang thay đổi diện mạo ngành F&B. Các quán cafe hiện đại đang loại bỏ nhựa dùng một lần, khuyến khích khách mang bình cá nhân và sử dụng nguyên liệu thân thiện với môi trường.','Trong năm vừa qua, thuật ngữ \"Zero Waste\" (Không rác thải) đã trở thành kim chỉ nam cho nhiều thương hiệu cafe lớn nhỏ. Không chỉ dừng lại ở việc thay thế ống hút nhựa bằng ống hút giấy hay gạo, nhiều quán cafe tại các thành phố lớn đã bắt đầu áp dụng chính sách giảm giá từ 10-15% cho khách hàng mang theo bình đựng cá nhân.\r\n\r\nBên cạnh đó, menu bánh ngọt cũng có sự chuyển dịch. Các chủ quán ưu tiên sử dụng trái cây địa phương theo mùa để giảm thiểu khí thải carbon từ quá trình vận chuyển (Food Miles). Bã cà phê sau khi chiết xuất không bị vứt đi mà được tái chế thành xà phòng hoặc phân bón tặng kèm cho khách hàng. Đây không chỉ là một chiến lược marketing mà còn là lời cam kết trách nhiệm xã hội, giúp thương hiệu ghi điểm tuyệt đối trong mắt thế hệ Gen Z – những người tiêu dùng luôn đề cao yếu tố môi trường.','Xu hướng Sống Xanh tại các quán Cafe.jpg','2025-12-02 13:28:11'),(2,'Sức khỏe và Dinh dưỡng','Bánh ngọt \"Healthy\": Giải oan cho nỗi sợ tăng cân của tín đồ hảo ngọt Tóm tắt: Sự lên ngôi của các dòng bánh Keto, Gluten-free và Low-carb đang mở ra một thị trường ngách đầy tiềm năng. Khách hàng giờ đây có thể thưởng thức bánh ngọt mà không lo ngại về lượng đường và calo.','Quan niệm \"ăn bánh ngọt là béo\" đang dần trở nên lỗi thời trước sự sáng tạo của các thợ làm bánh hiện đại. Nắm bắt nhu cầu chăm sóc sức khỏe ngày càng cao, các tiệm bánh cafe đang tích cực ra mắt các dòng sản phẩm sử dụng đường ăn kiêng (đường la hán quả, cỏ ngọt) thay cho đường tinh luyện, và bột hạnh nhân thay cho bột mì trắng.\r\n\r\nCác loại bánh như Biscotti nguyên cám, Tiramisu phiên bản Keto hay Mousse sữa chua trái cây đang trở thành những cái tên \"best-seller\". Khách hàng không chỉ tìm kiếm hương vị thơm ngon mà còn quan tâm kỹ lưỡng đến bảng thành phần dinh dưỡng. Sự thay đổi này đòi hỏi các chủ quán phải liên tục cập nhật kiến thức về dinh dưỡng để tư vấn chính xác cho khách hàng, biến quán cafe thành một nơi thư giãn lành mạnh cả về tinh thần lẫn thể chất.','bánh ngọt heathy.jpg','2025-12-02 13:55:48'),(3,'Mô hình kinh doanh','Sự trỗi dậy của mô hình \"Work-from-Cafe\": Không gian làm việc hay nơi thưởng thức cà phê?','Sau đại dịch, văn hóa làm việc từ xa bùng nổ khiến các quán cafe trở thành văn phòng thứ hai của nhiều người. Điều này buộc các chủ quán phải tái thiết kế không gian để tối ưu hóa trải nghiệm làm việc.\r\nĐã qua rồi cái thời quán cafe chỉ cần nhạc hay và đồ uống ngon. Ngày nay, \"ổ cắm điện\", \"wifi tốc độ cao\" và \"ghế ngồi êm ái\" là những từ khóa hàng đầu khi khách hàng lựa chọn điểm đến. Mô hình \"Cafe Coworking\" đang phát triển mạnh mẽ, nơi không gian được chia thành các khu vực riêng biệt: khu vực yên tĩnh để làm việc tập trung và khu vực trò chuyện cởi mở.\r\n\r\nNhiều quán cafe cũng điều chỉnh menu để phục vụ nhóm khách này, ví dụ như các gói combo \"Coffee & Pastry\" (Cafe và bánh) giá ưu đãi cho khung giờ sáng, hoặc phục vụ thêm các món ăn nhẹ (finger food) để khách hàng có thể nạp năng lượng nhanh chóng mà không cần di chuyển đi nơi khác. Thách thức lớn nhất hiện nay là cân bằng giữa doanh thu và thời gian khách ngồi lại quán (turnover rate), đòi hỏi các chiến lược giá thông minh.','mô hình kinh doanh.jpg','2025-12-02 13:57:53'),(4,'Trải nghiệm khách hàng','Workshop làm bánh tại quán Cafe: Cuối tuần trọn vẹn với trải nghiệm DIY Tóm tắt: Không chỉ đến để ăn uống, khách hàng ngày nay muốn được \"nhúng tay\" vào quá trình tạo ra sản phẩm. Mô hình Cafe kết hợp Workshop làm bánh trang trí đang thu hút đông đảo các cặp đôi và gia đình.','Vào mỗi cuối tuần, thay vì chỉ ngồi lướt điện thoại, nhiều bạn trẻ rủ nhau đến các quán cafe có tổ chức Workshop DIY (Do It Yourself). Tại đây, với một mức phí trọn gói bao gồm đồ uống và nguyên liệu, khách hàng sẽ được hướng dẫn tự tay trang trí những chiếc bánh Bento cake nhỏ xinh hoặc vẽ tranh lên bánh quy (Cookie painting).\r\n\r\nMô hình này đánh trúng vào tâm lý thích trải nghiệm và nhu cầu \"sống ảo\" của giới trẻ. Thành phẩm không chỉ là chiếc bánh để ăn, mà là một món quà ý nghĩa hoặc một tác phẩm nghệ thuật cá nhân hóa. Đối với các chủ quán, đây là cơ hội tuyệt vời để tăng doanh thu vào giờ thấp điểm và tạo ra sự gắn kết cảm xúc mạnh mẽ với thương hiệu.','trải nghiệm khách hàng.jpg','2025-12-02 13:59:23'),(5,'Hương vị và Sáng tạo','Cà phê Đặc sản (Specialty Coffee) kết hợp Bánh Á Đông: Bản giao hưởng hương vị mới lạ','Xu hướng kết hợp giữa cà phê chất lượng cao phương Tây và các loại bánh truyền thống hoặc nguyên liệu Á Đông đang tạo nên cơn sốt trong giới ẩm thực.\r\nNếu trước đây Cappuccino thường đi kèm với Croissant, thì nay thực khách có thể bắt gặp những sự kết hợp đầy táo bạo như Cold Brew ăn kèm bánh Trung Thu nhân chảy, hay Latte nghệ tây dùng chung với bánh bông lan trứng muối.\r\n\r\nCác barista và thợ làm bánh đang nỗ lực \"Việt hóa\" các món tráng miệng âu bằng cách đưa vào các nguyên liệu bản địa như lá dứa, khoai môn, dừa sáp hay hạt mắc khén. Sự kết hợp giữa vị đắng thanh, chua nhẹ của hạt Arabica thượng hạng với vị ngọt dịu, béo ngậy của bánh Á Đông tạo nên sự cân bằng hoàn hảo, mang lại trải nghiệm vị giác bùng nổ. Đây được xem là hướng đi tiềm năng để tôn vinh nông sản Việt và tạo dấu ấn riêng biệt trên bản đồ F&B thế giới.','hương vị.jpg','2025-12-02 14:00:57');
/*!40000 ALTER TABLE `tin_tuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_baocao_ngay`
--

DROP TABLE IF EXISTS `v_baocao_ngay`;
/*!50001 DROP VIEW IF EXISTS `v_baocao_ngay`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_baocao_ngay` AS SELECT 
 1 AS `ngay`,
 1 AS `so_don_da_tt`,
 1 AS `doanh_thu`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_baocao_thang`
--

DROP TABLE IF EXISTS `v_baocao_thang`;
/*!50001 DROP VIEW IF EXISTS `v_baocao_thang`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_baocao_thang` AS SELECT 
 1 AS `thang`,
 1 AS `so_don_da_tt`,
 1 AS `doanh_thu`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_so_luong_nhanvien`
--

DROP TABLE IF EXISTS `v_so_luong_nhanvien`;
/*!50001 DROP VIEW IF EXISTS `v_so_luong_nhanvien`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_so_luong_nhanvien` AS SELECT 
 1 AS `tong_nhan_vien`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'cafe_bakery'
--

--
-- Final view structure for view `v_baocao_ngay`
--

/*!50001 DROP VIEW IF EXISTS `v_baocao_ngay`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_baocao_ngay` AS select cast(`tt`.`ngay_tao` as date) AS `ngay`,count(0) AS `so_don_da_tt`,sum(`tt`.`so_tien`) AS `doanh_thu` from `thanh_toan` `tt` where (`tt`.`trang_thai` = 'da_thanh_toan') group by cast(`tt`.`ngay_tao` as date) order by `ngay` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_baocao_thang`
--

/*!50001 DROP VIEW IF EXISTS `v_baocao_thang`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_baocao_thang` AS select date_format(`tt`.`ngay_tao`,'%Y-%m') AS `thang`,count(0) AS `so_don_da_tt`,sum(`tt`.`so_tien`) AS `doanh_thu` from `thanh_toan` `tt` where (`tt`.`trang_thai` = 'da_thanh_toan') group by date_format(`tt`.`ngay_tao`,'%Y-%m') order by `thang` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_so_luong_nhanvien`
--

/*!50001 DROP VIEW IF EXISTS `v_so_luong_nhanvien`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_so_luong_nhanvien` AS select count(0) AS `tong_nhan_vien` from `nguoi_dung` where (`nguoi_dung`.`vai_tro` = 2) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-03 20:17:22
