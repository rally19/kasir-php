-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2025 at 12:44 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `DetailID` int NOT NULL,
  `PenjualanID` int NOT NULL,
  `ProdukID` int NOT NULL,
  `JumlahProduk` int NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `HargaKotor` decimal(10,2) NOT NULL,
  `Diskon` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`DetailID`, `PenjualanID`, `ProdukID`, `JumlahProduk`, `Subtotal`, `NamaProduk`, `Harga`, `HargaKotor`, `Diskon`) VALUES
(6, 4, 2, 4, 380.00, 'Kenzo', 100.00, 400.00, 5.0000),
(7, 4, 1, 4, 18000000.00, 'Uranium 356', 5000000.00, 20000000.00, 10.0000),
(8, 5, 2, 100, 9000.00, 'Kenzo', 100.00, 10000.00, 10.0000),
(9, 5, 1, 5, 22500000.00, 'Uranium 356', 5000000.00, 25000000.00, 10.0000),
(10, 6, 3, 100, 1500000.00, 'Ketchap', 15000.00, 1500000.00, 0.0000),
(11, 7, 3, 100, 1200000.00, 'Ketchap', 15000.00, 1500000.00, 20.0000),
(12, 7, 1, 2, 9800000.00, 'Uranium 356', 5000000.00, 10000000.00, 2.0000),
(13, 7, 4, 10, 4675000.00, '1KG Batu Neodymium', 550000.00, 5500000.00, 15.0000),
(14, 8, 4, 1, 550000.00, '1KG Batu Neodymium', 550000.00, 550000.00, 0.0000),
(15, 9, 5, 3, 3600000.00, 'Zirconium Batang 1KG', 1500000.00, 4500000.00, 20.0000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `PelangganID` int NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`) VALUES
(1, 'Leonel', 'Jalan Leos', '085641667668'),
(2, 'Qemsoh', 'Istana Iblis', '0666'),
(3, 'Gifayam', 'Jl Unggas Perak ', '0855555555'),
(4, 'Iyan Ferbrianti', 'Disono', '102493148329');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `PenjualanID` int NOT NULL,
  `PelangganID` int NOT NULL,
  `TanggalPenjualan` date NOT NULL,
  `TotalHarga` decimal(10,2) NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(255) NOT NULL,
  `HargaKotor` decimal(10,2) DEFAULT NULL,
  `Diskon` decimal(10,4) DEFAULT NULL,
  `Pajak` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`PenjualanID`, `PelangganID`, `TanggalPenjualan`, `TotalHarga`, `NamaPelanggan`, `Alamat`, `NomorTelepon`, `HargaKotor`, `Diskon`, `Pajak`) VALUES
(4, 1, '2025-08-28', 16830355.30, 'Leonel', 'Jalan Leos', '085641667668', 20000400.00, 15.0000, 10.0000),
(5, 1, '2025-08-28', 22283910.00, 'Leonel', 'Jalan Leos', '085641667668', 25010000.00, 10.0000, 10.0000),
(6, 1, '2025-08-28', 1650000.00, 'Leonel', 'Jalan Leos', '085641667668', 1500000.00, 0.0000, 10.0000),
(7, 1, '2025-08-28', 8621250.00, 'Leonel', 'Jalan Leos', '085641667668', 17000000.00, 50.0000, 10.0000),
(8, 1, '2025-08-29', 544500.00, 'Leonel', 'Jalan Leos', '085641667668', 550000.00, 10.0000, 10.0000),
(9, 3, '2025-08-29', 3960000.00, 'Gifayam', 'Jl Unggas Perak ', '0855555555', 4500000.00, 0.0000, 10.0000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ProdukID` int NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ProdukID`, `NamaProduk`, `Harga`, `Stok`) VALUES
(1, 'Uranium 356', 5000000.00, 33),
(2, 'Kenzo', 100.00, 999890),
(3, 'Ketchap', 15000.00, 4800),
(4, '1KG Batu Neodymium', 550000.00, 655),
(5, 'Zirconium Batang 1KG', 1500000.00, 997);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `PenjualanID` (`PenjualanID`,`ProdukID`),
  ADD KEY `ProdukID` (`ProdukID`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`PelangganID`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`PenjualanID`),
  ADD KEY `PelangganID` (`PelangganID`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ProdukID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `DetailID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `PelangganID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `PenjualanID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ProdukID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_ibfk_1` FOREIGN KEY (`ProdukID`) REFERENCES `produk` (`ProdukID`),
  ADD CONSTRAINT `detailpenjualan_ibfk_2` FOREIGN KEY (`PenjualanID`) REFERENCES `penjualan` (`PenjualanID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`PelangganID`) REFERENCES `pelanggan` (`PelangganID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
