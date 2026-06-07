-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 01:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybread_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `id_pesanan` varchar(50) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `total_bayar` decimal(10,0) NOT NULL,
  `status` varchar(50) DEFAULT 'Sedang Diproses',
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `id_pesanan` varchar(50) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img` varchar(255) NOT NULL,
  `desc` text DEFAULT NULL,
  `category` enum('Reguler','Custom') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `img`, `desc`, `category`) VALUES
(1, 'Roti Sobek', 10000, 'img/roti.jpg', 'Roti sobek sangat empuk dengan serat halus dan rasa manis yang pas. Cocok dinikmati bersama teh hangat.', 'Reguler'),
(2, 'Maryam', 15000, 'img/maryam.jpg', 'Roti berlapis yang gurih dan renyah di luar, lembut di dalam. Sangat lezat dimakan langsung atau dicelup kuah kari.', 'Reguler'),
(3, 'Roti Tawar', 12000, 'img/tawar.jpeg', 'Roti tawar klasik yang lembut, cocok untuk sarapan keluarga sehari-hari.', 'Reguler'),
(4, 'Roti Sisir', 11000, 'img/sisir.jpeg', 'Roti sisir manis klasik dengan olesan mentega berkualitas.', 'Reguler'),
(5, 'Croissant', 18000, 'img/croissant.jpeg', 'Croissant ala Prancis otentik. Sangat renyah di luar dengan aroma mentega premium.', 'Reguler'),
(6, 'Roti Cokelat', 8000, 'img/cokelat.jpeg', 'Roti empuk dengan isian cokelat lumer yang melimpah di dalamnya.', 'Reguler'),
(7, 'Roti Keju', 9000, 'img/keju.jpeg', 'Roti lembut dengan taburan keju parut gurih yang dipanggang hingga keemasan.', 'Reguler'),
(8, 'Donat Kampung', 5000, 'img/donat.jpeg', 'Donat empuk klasik khas Nusantara dengan taburan gula halus.', 'Reguler'),
(9, 'Baguette', 20000, 'img/baguette.jpeg', 'Roti panjang khas Prancis, renyah dan keras di luar namun lembut berongga di dalam.', 'Reguler'),
(10, 'Roti Gandum', 16000, 'img/gandum.jpeg', 'Roti gandum utuh yang sehat, kaya akan serat, dan sangat mengenyangkan.', 'Reguler'),
(11, 'Kue Ulang Tahun Custom', 150000, 'img/cake.jpg', 'Kue ulang tahun premium yang bisa disesuaikan rasa, ukuran, tema, dan tulisan di atasnya.', 'Custom'),
(12, 'Hampers Roti Premium', 250000, 'img/hampers.jpg', 'Paket hantaran elegan berisi aneka roti dan kue kering. Cocok untuk hadiah hari raya atau acara spesial.', 'Custom'),
(13, 'Roti Buaya Seserahan', 300000, 'img/buaya.jpg', 'Roti buaya sepasang khas Betawi untuk acara pernikahan/seserahan. Dihias cantik dan dijamin empuk.', 'Custom'),
(14, 'Custom Cupcake Box', 120000, 'img/cupcake.jpg', 'Box berisi 6/12 cupcake dengan topping buttercream atau fondant yang bisa di-request bentuk karakternya.', 'Custom');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `nik`, `telepon`, `alamat`) VALUES
(1, 'Admin MyBread', 'admin', 'admin@mybread.com', '$2y$10$e.w2f5QzK3c/gG/Z/n5e.uH1sB/wKzC3U1M1X5M/wXq.zX1uH1sB.', '1234567890123456', '08999999999', 'Jl. Admin Rahasia No. 1'),
(2, 'Zefanya Raditya Pratama', 'zeraphim', 'pratamazefanya3009@gmail.com', '$2y$10$BgkJrquI2OkuWi4.zuFQYunL7sgIfUInAowFzI3xDWPKibnwPVy0a', '1234567890123456', '085655295707', 'Perum Wisma Asri Pesantren Block R3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
