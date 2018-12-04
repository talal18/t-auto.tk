-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 01:56 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_password`) VALUES
(1, 'admin@test.com', 'admin'),
(2, 'admin2@test.com', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Audi'),
(2, 'Alfa Romeo'),
(3, 'BMW'),
(4, 'Citroen'),
(5, 'Ducati'),
(6, 'Jaguar'),
(7, 'Mercedes'),
(8, 'Mini'),
(9, 'VW');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(3, '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Motorcycles'),
(2, 'Cars'),
(3, 'SUV'),
(4, 'Trucks'),
(5, 'Coupe');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(15, '::1', 'Talal', 'talal_kasem@hotmail.com', '123456', 'Canada', 'Ottawa', '6133557999', '3532 Downpatrick Rd', 'WIN_20170909_00_03_54_Pro2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(3, 5, 4, 'Citroen c3 pluriel', 2150, '<p>5 in 1</p>', 'citroen_c3_PL.jpg', 'Citroen, c3, pluriel, coupe, convertable'),
(4, 5, 2, 'Alfa Romeo 4C', 76000, '<p>Convertable</p>', 'alfa_romeo_4c.jpg', 'alfa romeo, coupe, 4c,'),
(5, 2, 2, 'Alfa Romeo Giulia', 60000, '<p>Alfa romeo seedan</p>', 'alfa_romeo_giulia.jpg', 'alfa romeo, giulia, seedan,'),
(6, 3, 2, 'Alfa Romeo Stelvio', 70000, '<p>Alfa romeo SUV</p>', 'alfa_romeo_stelvio.jpg', 'alfa romeo, suv, stelvio, '),
(7, 2, 1, 'Audi A4', 35000, '<p>Audi A4 seedan</p>', 'audi_a4.jpg', 'audi, a4, seedan'),
(9, 2, 1, 'Audi A6', 50000, '<p>Audi A5 seedan</p>', 'audi_a6.jpg', 'audi, a5, seedan'),
(10, 5, 1, 'Audi A5', 65000, '<p>Audi A5 coupe</p>', 'audi_a5.jpg', 'audi, a5, coupe'),
(11, 2, 1, 'Audi A7', 85000, '<p>Audi A7 luxury sport car</p>', 'audi_a7.jpg', 'audi, a7'),
(12, 3, 1, 'Audi Q5', 48000, '<p>Audi Q5 small SUV</p>', 'audi_q5.jpg', 'audi, q5, suv'),
(13, 3, 1, 'Audi Q7', 77000, '<p>Audi Q7 SUV</p>', 'audi_q7.jpg', 'audi, q7, suv'),
(14, 5, 1, 'Audi R8', 180000, '<p>Audi R8 supercar</p>', 'audi_r8.jpg', 'audi, r8, supercar, coupe'),
(15, 2, 3, 'BMW 3 Series', 35000, '<p>BMW 3 Series seedan</p>', 'bmw_3.jpg', 'bmw, 3 series, seedan'),
(16, 2, 3, 'BMW 5 Series', 55000, '<p>BMW 5 Series seedan</p>', 'bmw_5.jpg', 'bmw, 5 series, seedan'),
(17, 5, 3, 'BMW 6 Series', 120000, '<p>BMW 6 Series luxury coupe</p>', 'bmw_6.jpg', 'bmw, 6 series, coupe'),
(18, 2, 3, 'BMW 7 Series', 130000, '<p>BMW 7 Series luxury car</p>', 'bmw_7.jpg', 'bmw, 7 series, luxury'),
(19, 1, 3, 'BMW R9T', 40000, '<p>BMW Motorcycle</p>', 'bmw_r9t.jpg', 'bmw, motorcycle, r9t'),
(20, 3, 3, 'BMW X5', 80000, '<p>BMW X5 SUV</p>', 'bmw_x5.jpg', 'bmw, x5, suv'),
(21, 3, 3, 'BMW X3', 40000, '<p>BMW X3 small SUV</p>', 'bmw_x3.jpg', 'bmw, x3, suv'),
(22, 3, 4, 'Citroen C-Crosser', 45000, '<p>Citroen C-Crosser SUV</p>', 'citroen_c_crosser.jpg', 'citroen, c-crosser, suv'),
(23, 2, 4, 'Citroen c3 ', 16000, '<p>Citroen C3</p>', 'citroen_c3.jpg', 'Citroen, c3 '),
(24, 2, 4, 'Citroen c5', 42000, '<p>Citroen C5 seedan</p>', 'citroen_c5.jpg', 'Citroen, c5, seedan'),
(25, 2, 4, 'Citroen c6', 65000, '<p>Citroen C6 luxury car</p>', 'citroen_c6.jpg', 'Citroen, c6, luxury'),
(26, 2, 4, 'Citroen Cactus', 18000, '<p>Citroen Cactus</p>', 'citroen_cactus.jpg', 'citroen, cactus '),
(27, 5, 4, 'Citroen GT', 1000000, '<p>Citroen GT supercar</p>', 'citroen_gt.jpg', 'citroen, gt, supercar, coupe'),
(28, 1, 5, 'Ducati Diavel', 30000, '<p>Ducati Cheapest motorcycle</p>', 'ducati_diavel.jpeg', 'ducati, diavel, motorcycle'),
(29, 1, 5, 'Ducati Monster', 40000, '<p>Ducati Monster motorcycle</p>', 'ducati_monster.jpg', 'ducati, monster, motorcycle'),
(30, 1, 5, 'Ducati Panigale', 60000, '<p>Ducati top of the line motorcycle</p>', 'ducati_panigale.jpg', 'ducati, panigale, motorcycle'),
(31, 3, 6, 'Jaguar F-Pace', 70000, '<p>Jaguar SUV</p>', 'jaguar_f_pace.jpg', 'jaguar, suv, f-pace'),
(32, 5, 6, 'Jaguar F-Type', 160000, '<p>Jaguar sport car</p>', 'jaguar_f_type.jpg', 'jaguar, f-type, sport car'),
(33, 2, 6, 'Jaguar XE', 45000, '<p>Jaguar small seedan</p>', 'jaguar_xe.jpg', 'jaguar, xe, seedan'),
(34, 2, 6, 'Jaguar XF', 60000, '<p>Jaguar seedan</p>', 'jaguar_xf.jpg', 'jaguar, xf, seedan'),
(35, 2, 6, 'Jaguar XJ', 140000, '<p>Jaguar luxury car</p>', 'jaguar_xj.jpg', 'jaguar, xj, luxury'),
(36, 2, 7, 'Mercedes C-Class', 40000, '<p>Mercedes small seedan</p>', 'mercedes_c.jpg', 'mercedes, c-class, seedan'),
(37, 2, 7, 'Mercedes E-Class', 60000, '<p>Mercedes E-Class seedan</p>', 'mercedes_e.jpg', 'mercedes, e-class, seedan'),
(38, 3, 7, 'Mercedes G-Class', 180000, '<p>Mercedes G-Class SUV</p>', 'mercedes_g.jpg', 'mercedes, g-class, suv'),
(39, 5, 7, 'Mercedes GT', 400000, '<p>Mercedes GT supercar</p>', 'mercedes_gt.jpg', 'mercedes, gt, supercar, coupe'),
(40, 2, 7, 'Mercedes S-Class', 140000, '<p>Mercedes S-Class luxury car</p>', 'mercedes_s.jpg', 'mercedes, s-class, luxury'),
(41, 5, 7, 'Mercedes SL', 130000, '<p>Mercedes SL sport car</p>', 'mercedes_sl.jpg', 'mercedes, sl, sport car, coupe'),
(42, 5, 8, 'Mini Cooper S', 45000, '<p>Mini Cooper S sport car</p>', 'mini_cooper.jpg', 'mini, cooper s, coupe, sport car'),
(43, 2, 8, 'Mini Clubman', 50000, '<p>Mini Clubman 4 doors</p>', 'mini_clubman.jpg', 'mini, clubman'),
(45, 5, 9, 'VW Beetle', 45000, '<p>VW Beetle coupe/convertable car</p>', 'vw_beetle.jpg', 'vw, beetle, coupe, convertable'),
(46, 2, 9, 'VW Golf', 28000, '<p>VW Golf hatchback</p>', 'vw_golf.jpg', 'vw, golf, hatchbak'),
(47, 2, 9, 'VW Passat', 37000, '<p>VW Passat seedan</p>', 'vw_passat.jpg', 'vw, passat, seedan'),
(48, 3, 9, 'VW Touareg', 67000, '<p>VW Touareg SUV</p>', 'vw_touareg.jpg', 'vw, suv, touareg'),
(50, 5, 1, 'Audi TT', 60000, '<p>Audi Coupe/Convertable sportcar</p>', 'audi_tt.jpg', 'audi, tt, sportcar, convertable, coupe'),
(51, 4, 9, 'VW Amarok', 35000, '<p>vw truck</p>', 'vw_amarok.jpg', 'pickup, truck, vw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
