-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 06:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(113, 'Trà trái cây'),
(114, 'Trà sữa'),
(115, 'Bánh ngọt');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `subject_name` varchar(200) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `ngay_lap` datetime DEFAULT NULL,
  `trang_thai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`, `ngay_lap`, `trang_thai`) VALUES
(14, 28, 'Minh Đăng', 'minhdang@gmail.com', '123456789', 'Long An', '', '2024-11-01 02:24:45', 1),
(15, 28, 'Minh Đăng', 'minhdang@gmail.com', '123456789', 'Long An', '', '2024-11-01 03:23:31', 1),
(16, 28, 'Minh Đăng', 'minhdang@gmail.com', '123456789', 'Long An', '', '2024-11-01 03:24:37', 1),
(17, 29, 'Đăng Duy', 'dangduy@gmail.com', '123456789', 'HCM', '', '2024-11-01 17:54:10', 1),
(18, 33, 'Nhật Long', 'nhatlong@gmail.com', '123456789', 'Phan Thiết', '', '2024-11-02 11:41:52', 0),
(19, 33, 'Nhật Long', 'nhatlong@gmail.com', '123456789', 'Phan Thiết', '', '2024-11-02 11:42:36', 0),
(20, 33, 'Nhật Long', 'nhatlong@gmail.com', '123456789', 'Phan Thiết', '', '2024-11-02 11:43:41', 0),
(21, 33, 'Nhật Long', 'nhatlong@gmail.com', '123456789', 'Phan Thiết', '', '2024-11-02 11:44:44', 0),
(22, 39, 'Bảo Trân', 'baotran@gmail.com', '123456789', 'Long An', '', '2024-11-02 11:49:58', 0),
(23, 39, 'Bảo Trân', 'baotran@gmail.com', '123456789', 'Long An', '', '2024-11-02 11:52:21', 0),
(24, 40, 'Chí Bảo', 'chibao@gmail.com', '123456789', 'Vũng Tàu', '', '2024-11-02 11:55:11', 0),
(25, 40, 'Chí Bảo', 'chibao@gmail.com', '123456789', 'Vũng Tàu', '', '2024-11-02 17:23:32', 0),
(26, 41, 'Duy Hạnh', 'duyhanh@gmail.com', '123456789', 'Nha Trang', '', '2024-11-02 17:40:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `total_money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`) VALUES
(25, 14, 147, 50000, 1, 50000),
(26, 15, 147, 50000, 2, 100000),
(27, 15, 143, 30000, 1, 30000),
(28, 16, 145, 45000, 1, 45000),
(29, 16, 143, 30000, 1, 30000),
(30, 17, 147, 50000, 2, 100000),
(31, 18, 147, 50000, 1, 50000),
(32, 18, 153, 50000, 1, 50000),
(33, 18, 148, 45000, 1, 45000),
(34, 19, 153, 50000, 1, 50000),
(35, 19, 147, 50000, 1, 50000),
(36, 19, 148, 45000, 1, 45000),
(37, 20, 153, 50000, 1, 50000),
(38, 20, 147, 50000, 1, 50000),
(39, 20, 148, 45000, 1, 45000),
(40, 20, 156, 45000, 1, 45000),
(41, 20, 145, 45000, 1, 45000),
(42, 21, 153, 50000, 1, 50000),
(43, 21, 147, 50000, 1, 50000),
(44, 21, 146, 50000, 1, 50000),
(45, 21, 148, 45000, 2, 90000),
(46, 21, 156, 45000, 2, 90000),
(47, 21, 145, 45000, 3, 135000),
(48, 22, 153, 50000, 1, 50000),
(49, 22, 147, 50000, 1, 50000),
(50, 22, 146, 50000, 1, 50000),
(51, 22, 148, 45000, 1, 45000),
(52, 22, 156, 45000, 1, 45000),
(53, 22, 145, 45000, 1, 45000),
(54, 23, 153, 50000, 1, 50000),
(55, 23, 147, 50000, 1, 50000),
(56, 23, 146, 50000, 1, 50000),
(57, 23, 148, 45000, 1, 45000),
(58, 23, 145, 45000, 1, 45000),
(59, 23, 156, 45000, 1, 45000),
(60, 24, 153, 50000, 1, 50000),
(61, 24, 146, 50000, 1, 50000),
(62, 24, 147, 50000, 1, 50000),
(63, 24, 148, 45000, 1, 45000),
(64, 24, 156, 45000, 1, 45000),
(65, 24, 145, 45000, 1, 45000),
(66, 25, NULL, NULL, NULL, 0),
(67, 25, NULL, NULL, NULL, 0),
(68, 25, 147, 50000, 1, 50000),
(69, 25, NULL, NULL, NULL, 0),
(70, 26, 145, 45000, 1, 45000),
(71, 26, 158, 45000, 1, 45000),
(72, 26, 157, 45000, 1, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `soluong` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(350) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`soluong`, `id`, `category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `created_at`, `updated_at`, `deleted`) VALUES
(10, 142, 115, 'Blueberry Mousse', 30000, NULL, '2.jpg', 'Bánh blueberry mousse mềm mịn, vị béo nhẹ hòa quyện với hương chua ngọt của việt quất, mang đến trải nghiệm thanh mát và hấp dẫn.', '2024-10-25 11:11:29', NULL, NULL),
(10, 143, 115, 'Chocolate Mousse', 30000, NULL, '3.jpg', 'Chocolate mousse là món tráng miệng mềm mịn, béo ngậy, được làm từ socola tan chảy, trứng và kem tươi, mang hương vị đậm đà và ngọt vừa phải.', '2024-10-25 11:12:47', NULL, NULL),
(20, 144, 113, 'Trà bí đao sương sáo hạt chia', 45000, NULL, '4.jpg', 'Vị ngọt nhẹ, giòn từ sương sáo, và độ dai của hạt chia, tạo cảm giác sảng khoái, dễ chịu. Thức uống này không chỉ ngon mà còn bổ dưỡng, giúp giải nhiệt hiệu quả.', '2024-10-25 17:36:06', NULL, NULL),
(17, 145, 113, 'Trà đào', 45000, NULL, '5.jpg', 'Trà đào có vị ngọt thanh mát của đào kết hợp với hương thơm của trà, tạo cảm giác dễ chịu và sảng khoái. Đây là lựa chọn hoàn hảo để giải nhiệt và thưởng thức vào những ngày nóng.', '2024-10-25 17:37:44', NULL, NULL),
(17, 146, 114, 'Trà sữa socola mochi', 50000, NULL, '7.jpg', 'Trà sữa socola mochi', '2024-10-25 17:42:39', '2024-10-25 17:52:19', NULL),
(19, 147, 114, 'Trà sữa chân châu hoàng kim', 50000, NULL, '8.jpg', 'Trà sữa chân châu hoàng kim kết hợp trà sữa ngọt ngào với chân châu vàng béo ngậy, mang lại hương vị sảng khoái và độc đáo.', '2024-10-25 17:44:31', NULL, NULL),
(20, 148, 113, 'Trà trái cây nhiệt đới', 45000, NULL, '9.jpg', 'Trà trái cây nhiệt đới là sự kết hợp tươi mát của nhiều loại trái cây nhiệt đới như xoài, dứa, và dưa hấu, hòa quyện cùng trà thơm ngon, mang lại cảm giác giải khát tuyệt vời và hương vị sống động.', '2024-10-25 17:46:00', NULL, NULL),
(20, 149, 115, 'Panna Cotta Chocolate', 45000, NULL, '10.jpg', 'Panna Cotta Chocolate là món tráng miệng mịn, béo ngậy từ kem, sữa và chocolate, thường được phục vụ lạnh với sốt chocolate', '2024-10-25 17:47:44', NULL, NULL),
(20, 150, 115, 'Panna Cotta Raspberry', 45000, NULL, '11.jpg', 'Panna Cotta Raspberry là món tráng miệng kem tươi mịn màng, được phủ sốt mâm xôi chua ngọt.', '2024-10-25 17:49:10', NULL, NULL),
(20, 151, 115, 'Tiramisu', 45000, NULL, '12.jpg', 'Tiramisu là món tráng miệng Ý nổi tiếng, gồm lớp bánh quy savoiardi thấm cà phê và rượu, xen kẽ với kem mascarpone béo ngậy, thường được rắc bột ca cao trên cùng.', '2024-10-25 17:50:12', NULL, NULL),
(20, 152, 114, 'Trà Sữa Olong \'mất ngủ\'', 50000, NULL, '13.jpg', 'Trà sữa ô long kết hợp trà ô long thơm ngon với sữa béo, mang đến hương vị dịu nhẹ và ngọt ngào.', '2024-10-25 17:51:40', NULL, NULL),
(12, 153, 114, 'Trà sữa khoai môn mochi', 50000, NULL, '14.jpg', 'Trà sữa khoai môn mochi kết hợp trà sữa thơm ngon với khoai môn béo ngậy và mochi dẻo dai, mang đến trải nghiệm ngọt ngào và thú vị.', '2024-10-25 18:05:34', NULL, NULL),
(12, 154, 114, 'Trà sữa lài', 50000, NULL, '15.jpg', 'Trà sữa lài là sự kết hợp hoàn hảo giữa hương thơm nhẹ nhàng của trà lài và vị ngọt béo của sữa, tạo nên một thức uống sảng khoái, thơm ngon và dễ uống.', '2024-10-25 18:06:17', NULL, NULL),
(12, 155, 115, 'Croissant', 50000, NULL, '16.jpg', 'Croissant là bánh mì ngọt hình vỏ sò, có vỏ giòn và ruột mềm. Thường dùng kèm cà phê hoặc trà, nó là lựa chọn phổ biến cho bữa sáng.', '2024-10-25 18:08:08', NULL, NULL),
(12, 156, 113, 'Hồng trà machiato', 45000, NULL, '17.jpg', 'Hồng trà macchiato là sự kết hợp giữa hồng trà thơm ngon và lớp bọt sữa, mang lại vị ngọt nhẹ và hương thơm dễ chịu.', '2024-10-25 18:10:37', NULL, NULL),
(12, 157, 113, 'Trà dưa hấu chân trâu giòn', 45000, NULL, '18.jpg', 'Trà dưa hấu chân trâu giòn kết hợp trà xanh thanh mát và dưa hấu ngọt, cùng chân trâu giòn sần sật, mang đến cảm giác tươi mát.', '2024-10-25 18:12:11', NULL, NULL),
(12, 158, 113, 'Trà Oolong', 45000, NULL, '19.jpg', 'Trà Oolong là trà bán lên men, mang hương vị phong phú và hậu vị ngọt ngào, cân bằng giữa trà xanh và trà đen, tốt cho sức khỏe.', '2024-10-25 18:13:17', NULL, NULL),
(12, 159, 114, 'Trà sữa đào', 50000, NULL, '20.jpg', 'Trà sữa đào là sự kết hợp hoàn hảo giữa trà đen thơm ngon và hương vị ngọt ngào của đào, tạo nên một thức uống sảng khoái với vị béo ngậy của sữa.', '2024-10-25 18:14:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(2, 'Admin'),
(3, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `taikhoan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `address`, `password`, `role_id`, `created_at`, `updated_at`, `taikhoan`) VALUES
(2, 'Phương Thảo', 'phuongthao@gmail.com', '0123456789', 'HCM', '123456', 2, '2024-10-20 20:22:57', NULL, 'htpt365'),
(3, 'Tấn Phát', 'tanphat@gmail.com', '0123456789', 'HCM', '123456', 2, '2024-10-20 20:23:46', NULL, 'ntp123'),
(4, 'Hoàng Dũng', 'hoangdung@gmail.com', '0123456789', 'HCM', '123456', 2, '2024-10-20 20:24:31', NULL, 'nhd456'),
(7, 'Anh Hoàng', 'anhhoang@gmail.com', '0123456789', 'HN', '123456', 2, '2024-10-20 20:27:15', NULL, 'nvah567'),
(8, 'Quang Hùng', 'quanghung@gmail.com', '0123456789', 'HN', '123456', 2, '2024-10-20 20:27:48', NULL, 'nqh890'),
(21, 'Duy Phương', 'duyphuong@gmail.com', '0123456789', 'Long An', '123456', 3, '2024-10-20 20:36:54', NULL, 'hdp432'),
(27, 'Cẩm Nhung', 'camnhung@gmail.com', '123456789', 'HCM', '123456', 3, '2024-10-31 15:09:48', NULL, 'ntcn123'),
(28, 'Minh Đăng', 'minhdang@gmail.com', '123456789', 'Long An', '123456', 3, '2024-11-01 01:42:56', NULL, 'lmd542'),
(29, 'Đăng Duy', 'dangduy@gmail.com', '123456789', 'HCM', '123456', 3, '2024-11-01 17:53:56', NULL, 'tdd'),
(30, 'Hoàng Minh', 'hoangminh@gmail.com', '123456789', 'Đà Lạt', '123456', 3, '2024-11-02 11:37:34', NULL, 'hhm123'),
(31, 'Phương Thy', 'phuongthy@gmail.com', '123456789', 'Long An', '123456', 3, '2024-11-02 11:38:09', NULL, 'npt367'),
(32, 'Ngọc Vy', 'ngocvy@gmail.com', '123456789', 'Long An', '123456', 3, '2024-11-02 11:38:40', NULL, 'tvnv689'),
(33, 'Nhật Long', 'nhatlong@gmail.com', '123456789', 'Phan Thiết', '123456', 3, '2024-11-02 11:40:13', NULL, 'hnl567'),
(34, 'Huỳnh Hương', 'huynhhuong@gmail.com', '123456789', 'Long An', '123456', 3, '2024-11-02 11:45:18', NULL, 'dhhh179'),
(35, 'Hạn Vũ', 'hanvu@gmail.com', '123456789', 'Bình Dương', '123456', 3, '2024-11-02 11:45:39', NULL, 'nhv678'),
(36, 'Chí Tâm', 'chitam@gmail.com', '123456789', 'Biên Hòa', '123456', 3, '2024-11-02 11:46:02', NULL, 'nct256'),
(37, 'Kim Anh', 'kimanh@gmail.com', '123456789', 'Nha Trang', '123456', 3, '2024-11-02 11:46:22', NULL, 'vka478'),
(38, 'Khả Ý', 'khay@gmail.com', '123456789', 'Vũng Tàu', '123456', 3, '2024-11-02 11:46:37', NULL, 'tnky345'),
(39, 'Bảo Trân', 'baotran@gmail.com', '123456789', 'Long An', '123456', 3, '2024-11-02 11:47:07', NULL, 'nnbt'),
(40, 'Chí Bảo', 'chibao@gmail.com', '123456789', 'Vũng Tàu', '123456', 3, '2024-11-02 11:54:28', NULL, 'ncb'),
(41, 'Duy Hạnh', 'duyhanh@gmail.com', '123456789', 'Nha Trang', '123456', 3, '2024-11-02 17:39:52', NULL, 'hdh123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
