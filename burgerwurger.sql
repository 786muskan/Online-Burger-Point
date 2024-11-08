-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2024 at 01:39 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `copyphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_Id` int DEFAULT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cuId` (`customer_Id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_Id`, `product_id`) VALUES
(122, 2, 1),
(123, 2, 1),
(124, 2, 1),
(125, 2, 1),
(126, 2, 3),
(127, 2, 3),
(128, 2, 3),
(129, 2, 3),
(130, 2, 3),
(131, 2, 3),
(132, 2, 3),
(133, 2, 3),
(134, 2, 3),
(135, 2, 3),
(136, 2, 3),
(137, 2, 3),
(138, 2, 3),
(139, 2, 3),
(140, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('available','not-available') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'Burgers', 'A burger is made with a cooked patty, placed inside a sliced bun. It is commonly topped with ingredi', 'available'),
(2, 'French-Fries', 'French fries are thinly sliced potatoes that are deep-fried and are typically seasoned with salt ', 'available'),
(3, 'Cold Drink', 'A cold drink is a chilled beverage served at a low temperature, often enjoyed for its refreshing qua', 'available'),
(4, 'Ice-cream', 'Ice cream is a sweet, creamy dessert made from milk, cream, sugar, and flavorings, often churned to ', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_no` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_to_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `user_id`, `order_date`) VALUES
(1, 'FMN1101', 2, '2024-10-18 12:40:10'),
(2, 'MNO1102', 2, '2024-10-18 12:40:10'),
(3, 'CCX6347', 9, '2024-10-18 12:40:10'),
(4, 'EVU0428', 9, '2024-10-18 12:40:10'),
(5, 'QWV5731', 9, '2024-10-18 12:40:10'),
(6, 'TPH4361', 2, '2024-10-18 12:40:10'),
(7, 'ULH9031', 2, '2024-10-18 12:40:10'),
(8, 'RFW3882', 2, '2024-10-18 12:40:10'),
(9, 'GDQ2776', 2, '2024-10-18 12:40:10'),
(10, 'ZRH2793', 2, '2024-10-18 12:40:10'),
(11, 'SDY4088', 5, '2024-10-18 12:40:10'),
(12, 'AFX0286', 2, '2024-10-18 12:40:10'),
(13, 'NFL3682', 2, '2024-10-18 12:40:10'),
(14, 'SDU8340', 2, '2024-10-18 12:40:10'),
(15, 'AHR3556', 2, '2024-10-18 12:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_to_order_detail` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 1, 2, 160),
(2, 1, 5, 2, 400),
(3, 2, 8, 1, 150),
(4, 2, 2, 1, 150),
(5, 4, 8, 1, 150),
(6, 4, 2, 2, 300),
(7, 6, 1, 31, 2480),
(8, 6, 2, 1, 150),
(9, 6, 3, 3, 360),
(10, 6, 9, 19, 3800),
(11, 8, 9, 4, 800),
(12, 8, 10, 4, 600),
(13, 10, 1, 8, 480),
(14, 11, 9, 1, 200),
(15, 11, 8, 1, 150),
(16, 11, 5, 1, 200),
(17, 12, 1, 2, 160),
(18, 12, 2, 3, 450),
(19, 13, 2, 1, 150),
(20, 13, 1, 1, 80),
(21, 13, 5, 2, 400),
(22, 14, 1, 2, 160),
(23, 14, 3, 1, 120),
(24, 15, 1, 3, 240),
(25, 15, 2, 3, 450);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL,
  `type` enum('None','Non-vegetarian','Vegetarian') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('available','not-available') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'available',
  PRIMARY KEY (`id`),
  KEY `cat_to_product` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `type`, `description`, `price`, `image`, `status`) VALUES
(1, 'Crispy Veg Burger', 1, 'Vegetarian', 'Crispy veg patty burger', 80, 'crispy veg.jpg', 'available'),
(2, 'Veggie burger with cheese', 1, 'Vegetarian', 'Veg Patty, Lettuce, Tomato(Seasonal) & Our Signature Mayo Sauce', 150, 'veg burger with cheese.jpg', 'available'),
(3, 'Chicken Makhani Burst Burger', 1, 'Non-vegetarian', '2 Crunchy Veg taco + med fries', 120, 'Chicken Makhani Burst Burger.jpg', 'available'),
(4, 'Whopper Jr Chicken', 1, 'Non-vegetarian', 'Our Signature Whopper with Flame Grilled Chicken Patty, Onions, Lettuce, Tomatoes (Seasonal), Gherkins, Creamy And Smoky Sauces', 180, 'Whopper Jr Chicken.jpg', 'available'),
(5, 'Iced Americano', 3, 'None', 'Our signature Arabica espresso with ice', 200, 'Iced Americano.jpg', 'available'),
(6, ' Coca Cola', 3, 'None', 'carbonated soft drink ', 60, 'cola.jpg', 'available'),
(7, 'Crunchy Chicken Nuggets', 2, 'Non-vegetarian', 'Tender Crunchy Chicken Nuggets Fried To Golden Brown Perfection', 100, 'Crunchy Chicken Nuggets.jpg', 'available'),
(8, 'Peri Peri Fries', 2, 'Vegetarian', 'Crispy Fries With Tangy Peri Peri Spice', 150, 'fries.jpg', 'available'),
(9, 'Fusion Oreo', 4, 'None', 'creamy soft ice cream and crunchy Oreo pieces', 200, 'fusion oreo.jpg', 'available'),
(10, 'Cokkie Crunch', 4, 'None', 'a scoop of creamy vanilla ice cream topped with crushed chocolate chip cookies, hot fudge or caramel sauce, and a dollop of whipped cream.', 150, 'cokkie crunch.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type` enum('customer','admin','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `address`, `type`) VALUES
(1, 'Muskan', 'muskan@123.com', 'muskan', '7678909890', 'Ajmer', 'admin'),
(2, 'Sanjana', 'sanjana@6.com', 'sanjana', '8796879686', 'Ajmer', 'customer'),
(3, 'Hema', 'hm@09.com', 'hema', '6578767898', 'Ajmer', 'admin'),
(4, 'muskan', 'muskan@12.com', 'muskan', '8967574657', 'ajmer', 'customer'),
(5, 'rekha', 'rh@23.com', 'rekha', '6576859684', 'ajmer', 'customer'),
(6, 'payal', 'py@27.com', 'payal', '8968778867', 'ajmer', 'customer'),
(7, 'hema', 'hm@22.com', 'hema22', '9988667757', 'ajmer', 'customer'),
(8, 'vanshika', 'vs@10.com', 'vanshi', '8899887789', 'ajmer', 'customer'),
(9, 'muskan', 'ml@12.com', 'muskan', '9985768586', 'ajmer', 'customer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`customer_Id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
