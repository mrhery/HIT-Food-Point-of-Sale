-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2015 at 12:06 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hanc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(255) NOT NULL,
  `bill_table` varchar(255) NOT NULL,
  `bill_date` varchar(255) NOT NULL,
  `bill_time` varchar(255) NOT NULL,
  `bill_month` varchar(255) NOT NULL,
  `bill_year` varchar(255) NOT NULL,
  `bill_total` varchar(255) NOT NULL,
  `bill_waiteress` varchar(255) NOT NULL,
  `bill_cashier` varchar(255) NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `category_date` varchar(255) NOT NULL,
  `category_user` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`category_id`, `category_name`, `category_type`, `category_date`, `category_user`) VALUES
(1, 'Nasi', 'Foods', '15-Dec-2015', 'tryo_hery'),
(2, 'Mee', 'Foods', '15-Dec-2015', 'tryo_hery'),
(3, 'Roti', 'Set', '15-Dec-2015', 'tryo_hery'),
(4, 'Express Chicken', 'Set', '15-Dec-2015', 'tryo_hery'),
(5, 'Fruit Juice', 'Drinks', '15-Dec-2015', 'tryo_hery'),
(6, 'Standard', 'Drinks', '15-Dec-2015', 'tryo_hery');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `item_picture` varchar(255) NOT NULL,
  `item_date` varchar(255) NOT NULL,
  `item_user` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_category`, `item_type`, `item_price`, `item_picture`, `item_date`, `item_user`) VALUES
(1, 'Nasi Goreng Kampung', 'Nasi', 'Foods', '5', '', '15-Dec-2015', 'Hery'),
(2, 'Mee Goreng Mamak', 'Mee', 'Foods', '5', '', '15-Dec-2015', 'Hery'),
(3, 'Chicken Chop', 'Express Chicken', 'Set', '5', '', '15-Dec-2015', 'Hery'),
(4, 'Fres Orange', 'Fruit Juice', 'Drinks', '2.5', '', '15-Dec-2015', 'Hery'),
(5, 'Milo Ais', 'Standard', 'Drinks', '1', '', '15-Dec-2015', 'Hery'),
(16, 'dfhd', 'Nasi', 'Foods', '5', 'uploaded/picture/', '17-Dec-2015', 'tryo_hery'),
(17, 'dfhgdfg', 'Nasi', 'Foods', '6', 'uploaded/picture/', '17-Dec-2015', 'tryo_hery'),
(18, 'kjljkl', 'Nasi', 'Foods', '7', 'uploaded/picture/', '17-Dec-2015', 'tryo_hery');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paids`
--

CREATE TABLE IF NOT EXISTS `paids` (
  `paid_id` int(11) NOT NULL AUTO_INCREMENT,
  `paid_no` varchar(255) NOT NULL,
  `paid_date` varchar(255) NOT NULL,
  `paid_time` varchar(255) NOT NULL,
  `paid_month` varchar(255) NOT NULL,
  `paid_year` varchar(255) NOT NULL,
  `paid_total` varchar(255) NOT NULL,
  `paid_waiteress` varchar(255) NOT NULL,
  `paid_cashier` varchar(255) NOT NULL,
  PRIMARY KEY (`paid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`) VALUES
(1, 'Test 1', '25', '25'),
(2, 'Test 2', '20', '20'),
(3, 'Test 1', '25', '25');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_no` varchar(255) NOT NULL,
  `table_status` varchar(255) NOT NULL,
  `table_date` varchar(255) NOT NULL,
  `table_user` varchar(255) NOT NULL,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_no`, `table_status`, `table_date`, `table_user`) VALUES
(1, '1', '0', '15-Dec-2015', 'tryo_hery'),
(2, '2', '0', '18-Dec-2015', 'tryo_hery'),
(3, '3', '0', '18-Dec-2015', 'tryo_hery'),
(4, '4', '0', '18-Dec-2015', 'tryo_hery'),
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

CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_section` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_section`, `user_status`) VALUES
(1, 'tryo_hery', 'hery', 'cashier', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
