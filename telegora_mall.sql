-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2020 at 05:02 AM
-- Server version: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telegora_mall`
--
CREATE DATABASE IF NOT EXISTS `telegora_mall` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `telegora_mall`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT 'No additional information',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Local Food', 'Foods sourced from Western Australia'),
(2, 'National Food', 'Foods sourced from Australia'),
(3, 'International Food', 'Imported foodstuffs'),
(4, 'Natural Personal Care', 'Non-toxic personal hygiene products'),
(5, 'Personal Care', 'Personal hygiene products'),
(6, 'Natural Household', 'Non-toxic household cleaning products'),
(7, 'Household', 'Household cleaning products'),
(8, 'Natural Gardening', 'Non-toxic gardening and weed control products'),
(9, 'Gardening', 'Gardening and weed control products'),
(10, 'Natural Pest Control', 'Non-toxic pest control products'),
(11, 'Pest Control', 'Pest control products'),
(12, 'Medical', 'No additional information'),
(13, 'Hardware', 'No additional information'),
(14, 'Electronics', 'No additional information');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` char(10) NOT NULL,
  `address` varchar(60) NOT NULL DEFAULT 'Not supplied',
  `suburb` varchar(30) NOT NULL DEFAULT 'Not supplied',
  `post_code` char(4) NOT NULL DEFAULT '6000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `phone`, `address`, `suburb`, `post_code`) VALUES
(1, 'Harry', 'Henderson', '0404123423', 'Not supplied', 'Mandurah', '6210'),
(2, 'Ellie', 'Norton', '0402145541', '22 Baldivis Blvd', 'Baldivis', '6171'),
(3, 'Philipa', 'Pronter', '0403345654', 'Not supplied', 'Not supplied', '6000'),
(4, 'Gerald', 'Brocklehurst', '0404678985', '424 Park Rd', 'Mandurah', '6210'),
(5, 'Frederick', 'Anderson', '0413567034', '143 Main St', 'Balcatta', '6021'),
(6, 'Jackie', 'Smith', '', 'Not supplied', 'Not supplied', '6000'),
(7, 'Harry', 'Wellington', '', 'Not supplied', 'Not supplied', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `position` varchar(30) DEFAULT NULL,
  `dob` date NOT NULL,
  `tfn` char(10) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `position`, `dob`, `tfn`, `start_date`) VALUES
(1, 'Myron', 'Matheson', 'Manager', '1986-05-12', '1122111222', '2019-09-05 05:25:20'),
(2, 'Sally', 'Stephens', 'Sales', '1994-04-02', '1221111222', '2019-09-05 05:27:43'),
(3, 'Scott', 'Shermann', 'Sales', '1995-06-15', '3142111122', '2019-09-05 05:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_no` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cust_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  PRIMARY KEY (`invoice_no`),
  KEY `fk_emp_invoice` (`emp_id`),
  KEY `fk_cust_invoice` (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `date`, `cust_id`, `emp_id`) VALUES
(1, '2020-09-21 04:57:39', 5, 3),
(2, '2020-09-21 04:57:39', 5, 1),
(3, '2020-09-21 04:58:07', 4, 3),
(4, '2020-09-21 04:58:07', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_line`
--

CREATE TABLE IF NOT EXISTS `invoice_line` (
  `invoice_no` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`invoice_no`,`prod_id`),
  KEY `fk_prod_invoice_line` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_line`
--

INSERT INTO `invoice_line` (`invoice_no`, `prod_id`, `qty`) VALUES
(1, 4, 2),
(1, 8, 2),
(2, 1, 2),
(2, 2, 1),
(2, 6, 2),
(3, 5, 4),
(3, 7, 2),
(3, 9, 1),
(4, 3, 1),
(4, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT 'No additional information',
  `cost_price` decimal(8,2) NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cat_prod` (`cat_id`),
  KEY `fk_prod_supp` (`supp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cat_id`, `supp_id`, `name`, `description`, `cost_price`, `size`) VALUES
(1, 8, 1, 'Slasher', 'No additional information', '7.50', '500ml'),
(2, 9, 7, 'Watering Can', 'Plastic watering can', '0.99', '9 litre'),
(3, 14, 3, 'Headphones', 'Noise cancelling', '30.00', 'N/A'),
(4, 4, 2, 'Luscious Locks Shampoo', 'Non-toxic, environmentally friendly, cruelty free shampoo', '6.50', '500ml'),
(5, 10, 5, 'Flea Free', 'Non-toxic, environmentally friendly, cruelty free flea treatment for the house and surrounding garden', '1.85', '1 litre'),
(6, 9, 7, 'Blooming Good Fertiliser', 'No additional information', '28.50', '5kg'),
(7, 5, 6, 'Daisy Deodorant', 'It smells so you don\'t', '1.85', '30ml'),
(8, 4, 2, 'Luscious Locks Conditioner', 'Non-toxic, environmentally friendly, cruelty free conditioner', '8.50', '500ml'),
(9, 14, 3, 'Mega-Blaster ', 'Bluetooth speakers suitable for iOS & Android', '23.50', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `email`) VALUES
(1, 'Only Organic ', '95811234', 'info@onlyoriganic.com.au'),
(2, 'Organically Yours', '089563765', 'freda@organicallyyours.com.au'),
(3, 'Electronics R Us', '0885634340', 'info@eru.com.au'),
(4, 'ProMed Supplies', '089563765', 'admin@pms.com.au'),
(5, 'PestGo', '0885634340', 'frontdesk@pestgo.com.au'),
(6, 'Chemguard', '089765423', 'toxic@chemguard.com.au'),
(7, 'Gardener\'s Friend', '089674398', 'info@gf.com.au');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_cust_invoice` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `fk_emp_invoice` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD CONSTRAINT `fk_inv_invoice_line` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`),
  ADD CONSTRAINT `fk_prod_invoice_line` FOREIGN KEY (`prod_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_cat_prod` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_prod_supp` FOREIGN KEY (`supp_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
