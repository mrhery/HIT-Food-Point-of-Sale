-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 04:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hanc`
--

-- --------------------------------------------------------

--
-- Table structure for table `anas`
--

CREATE TABLE `anas` (
  `ana_id` int(11) NOT NULL,
  `ana_item` varchar(255) NOT NULL,
  `ana_qty` varchar(255) NOT NULL,
  `ana_price` varchar(255) NOT NULL,
  `ana_total` varchar(255) NOT NULL,
  `ana_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anas`
--

INSERT INTO `anas` (`ana_id`, `ana_item`, `ana_qty`, `ana_price`, `ana_total`, `ana_date`) VALUES
(1, 'gfgfgf', '3', '5', '5', '26-Nov-2016'),
(2, 'Milo Ais', '2', '1', '1', '26-Nov-2016'),
(3, 'Fres Orange', '2', '2.5', '2.5', '26-Nov-2016'),
(4, 'Nasi Goreng Kampung', '2', '5', '5', '26-Nov-2016'),
(5, 'dfhgdfg', '2', '6', '6', '26-Nov-2016'),
(6, 'kjljkl', '1', '7', '7', '26-Nov-2016'),
(7, 'Mee Goreng Mamak', '3', '5', '10', '26-Nov-2016'),
(8, 'dfhd', '2', '5', '10', '26-Nov-2016'),
(9, 'gfgfgf', '1', '5', '', '29-Nov-2016'),
(10, 'gfgfgf', '1', '5', '', '22-Feb-2018'),
(11, 'Fres Orange', '1', '2.5', '', '22-Feb-2018');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `bill_table` varchar(255) NOT NULL,
  `bill_date` varchar(255) NOT NULL,
  `bill_time` varchar(255) NOT NULL,
  `bill_month` varchar(255) NOT NULL,
  `bill_year` varchar(255) NOT NULL,
  `bill_total` varchar(255) NOT NULL,
  `bill_waiteress` varchar(255) NOT NULL,
  `bill_cashier` varchar(255) NOT NULL,
  `bill_print` varchar(255) NOT NULL,
  `bill_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_no`, `bill_table`, `bill_date`, `bill_time`, `bill_month`, `bill_year`, `bill_total`, `bill_waiteress`, `bill_cashier`, `bill_print`, `bill_type`) VALUES
(2, 'S22-Feb-2018/1', '4', '22-Feb-2018', '06:22:36', 'Feb', '2018', '6', 'hery', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `category_date` varchar(255) NOT NULL,
  `category_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`category_id`, `category_name`, `category_type`, `category_date`, `category_user`) VALUES
(1, 'Nasi', 'Foods', '15-Dec-2015', 'tryo_hery'),
(2, 'Mee', 'Foods', '15-Dec-2015', 'tryo_hery'),
(5, 'Fruit Juice', 'Drinks', '15-Dec-2015', 'tryo_hery'),
(6, 'Standard', 'Drinks', '15-Dec-2015', 'tryo_hery'),
(7, 'Set', 'Set', '25-Aug-2016', 'hery');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `item_picture` varchar(255) NOT NULL,
  `item_date` varchar(255) NOT NULL,
  `item_user` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `item_short` varchar(255) NOT NULL,
  `item_promo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_category`, `item_type`, `item_price`, `item_picture`, `item_date`, `item_user`, `item_desc`, `item_short`, `item_promo`) VALUES
(1, 'Nasi Goreng Kampung', 'Nasi', 'Foods', '5', '', '15-Dec-2015', 'Hery', '', 'ngk', 'Wednesday'),
(2, 'Mee Goreng Mamak', 'Mee', 'Foods', '5', '', '15-Dec-2015', 'Hery', '', 'mgm', 'April Fool'),
(3, 'Chicken Chop', 'Express Chicken', 'Set', '5', '', '15-Dec-2015', 'Hery', '', 'cc', ''),
(4, 'Fres Orange', 'Fruit Juice', 'Drinks', '2.5', '', '15-Dec-2015', 'Hery', '', '', ''),
(5, 'Milo Ais', 'Standard', 'Drinks', '1', '', '15-Dec-2015', 'Hery', '', '', ''),
(16, 'dfhd', 'Nasi', 'Foods', '5', 'uploaded/picture/', '17-Dec-2015', 'tryo_hery', '', '', ''),
(17, 'dfhgdfg', 'Nasi', 'Foods', '6', 'uploaded/picture/', '17-Dec-2015', 'tryo_hery', '', '', ''),
(18, 'kjljkl', 'Nasi', 'Foods', '7', 'uploaded/picture/', '17-Dec-2015', 'tryo_hery', '', '', ''),
(19, 'gfgfgf', 'Set', 'Set', '5', 'uploaded/picture/', '24-Aug-2016', 'hery', '', 'gf', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_table` varchar(255) NOT NULL,
  `order_item` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `order_price` varchar(255) NOT NULL,
  `order_quantity` varchar(255) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `order_month` varchar(255) NOT NULL,
  `order_year` varchar(255) NOT NULL,
  `order_bill` varchar(255) NOT NULL,
  `order_note` text NOT NULL,
  `order_user` varchar(255) NOT NULL,
  `order_ad` varchar(255) NOT NULL,
  `order_adprint` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_table`, `order_item`, `order_type`, `order_price`, `order_quantity`, `order_total`, `order_date`, `order_time`, `order_month`, `order_year`, `order_bill`, `order_note`, `order_user`, `order_ad`, `order_adprint`) VALUES
(3, '4', 'Nasi Goreng Kampung', 'Foods', '2', '3', '6', '', '', '', '', '', '', 'hery', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `paids`
--

CREATE TABLE `paids` (
  `paid_id` int(11) NOT NULL,
  `paid_no` varchar(255) NOT NULL,
  `paid_date` varchar(255) NOT NULL,
  `paid_time` varchar(255) NOT NULL,
  `paid_month` varchar(255) NOT NULL,
  `paid_year` varchar(255) NOT NULL,
  `paid_total` varchar(255) NOT NULL,
  `paid_waiteress` varchar(255) NOT NULL,
  `paid_cashier` varchar(255) NOT NULL,
  `paid_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paids`
--

INSERT INTO `paids` (`paid_id`, `paid_no`, `paid_date`, `paid_time`, `paid_month`, `paid_year`, `paid_total`, `paid_waiteress`, `paid_cashier`, `paid_type`) VALUES
(8, 'S25-Nov-2016/1', '25-Nov-2016', '04:49:01', 'Nov', '2016', '41', '', 'hery', ''),
(9, 'S25-Nov-2016/1', '25-Nov-2016', '04:51:28', 'Nov', '2016', '21', '', 'hery', ''),
(10, 'S25-Nov-2016/1', '25-Nov-2016', '04:56:20', 'Nov', '2016', '10', '', 'hery', ''),
(11, 'S25-Nov-2016/1', '25-Nov-2016', '04:58:54', 'Nov', '2016', '5', '', 'hery', ''),
(13, 'S25-Nov-2016/1', '25-Nov-2016', '05:00:13', 'Nov', '2016', '36.5', '', 'hery', ''),
(14, 'S25-Nov-2016/1', '25-Nov-2016', '05:00:45', 'Nov', '2016', '34.5', '', 'hery', ''),
(15, 'S28-Nov-2016/1', '28-Nov-2016', '23:28:09', 'Nov', '2016', '5', '', 'hery', ''),
(16, 'S14-Dec-2016/1', '14-Dec-2016', '22:36:06', 'Dec', '2016', '7.5', '', 'hery', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`) VALUES
(1, 'Test 1', '25', '25'),
(2, 'Test 2', '20', '20'),
(3, 'Test 1', '25', '25');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `promo_id` int(11) NOT NULL,
  `promo_name` varchar(255) NOT NULL,
  `promo_trate` varchar(255) NOT NULL,
  `promo_rate` varchar(255) NOT NULL,
  `promo_twhen` varchar(255) NOT NULL,
  `promo_when` varchar(255) NOT NULL,
  `promo_item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`promo_id`, `promo_name`, `promo_trate`, `promo_rate`, `promo_twhen`, `promo_when`, `promo_item`) VALUES
(1, 'April Fool', 'rate', '10', 'date', '25-Aug', ''),
(2, 'Wednesday', 'price', '2', 'day', 'Thu', '');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_no` varchar(255) NOT NULL,
  `table_status` varchar(255) NOT NULL,
  `table_date` varchar(255) NOT NULL,
  `table_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_no`, `table_status`, `table_date`, `table_user`) VALUES
(1, '1', '0', '15-Dec-2015', 'tryo_hery'),
(2, '2', '0', '18-Dec-2015', 'tryo_hery'),
(3, '3', '0', '18-Dec-2015', 'tryo_hery'),
(4, '4', '1', '18-Dec-2015', 'tryo_hery'),
(5, '5', '0', '18-Dec-2015', 'tryo_hery'),
(6, '6', '0', '18-Dec-2015', 'tryo_hery'),
(7, '7', '0', '18-Dec-2015', 'tryo_hery'),
(8, '8', '0', '18-Dec-2015', 'tryo_hery'),
(9, '9', '0', '18-Dec-2015', 'tryo_hery'),
(10, '10', '0', '18-Dec-2015', 'tryo_hery');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`) VALUES
(1, 'Foods'),
(2, 'Set'),
(3, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_section` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_section`, `user_status`) VALUES
(1, 'hery', '1234', 'cashier', '1'),
(2, 'hery', '1234', 'waitress', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anas`
--
ALTER TABLE `anas`
  ADD PRIMARY KEY (`ana_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `paids`
--
ALTER TABLE `paids`
  ADD PRIMARY KEY (`paid_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anas`
--
ALTER TABLE `anas`
  MODIFY `ana_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paids`
--
ALTER TABLE `paids`
  MODIFY `paid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
