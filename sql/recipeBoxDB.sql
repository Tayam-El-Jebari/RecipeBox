-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 08, 2023 at 06:19 PM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipeBoxDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodCategories`
--

CREATE TABLE `foodCategories` (
  `foodCategoryID` int(11) NOT NULL,
  `foodCategoryName` varchar(45) NOT NULL,
  `bannerImage` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodCategories`
--

INSERT INTO `foodCategories` (`foodCategoryID`, `foodCategoryName`, `bannerImage`) VALUES
(0, 'chicken', '/img/chicken-banner.png'),
(1, 'beef', '/img/beef-banner.png'),
(2, 'fish', '/img/fish-banner.png'),
(3, 'vegan', '/img/vegan-banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `meal_id` int(11) NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `ingredientWeight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`meal_id`, `ingredient`, `ingredientWeight`) VALUES
(1, 'Chicken burger', 160),
(1, 'Mixed Vegetables', 175),
(2, 'Broccoli', 175),
(2, 'Chicken burger', 160),
(3, 'Chicken Piri Piri', 160),
(3, 'Stir fry mix', 175),
(4, 'Chicken Piri Piri', 150),
(4, 'Mixed Vegetables', 175),
(7, 'Green beans', 175),
(7, 'Grilled chicken skewers', 160),
(8, 'Broccoli mix', 175),
(8, 'Grilled chicken skewers', 160),
(9, 'Fried chicken cubes', 150),
(9, 'Mexican vegetable mix', 175),
(11, 'Bell pepper mix', 100),
(11, 'Grilled chicken strips', 150),
(11, 'Macaroni', 250),
(12, 'Bell pepper mix', 100),
(12, 'Grilled chicken strips', 150),
(12, 'Macaroni', 250),
(13, 'Beef strips teriyaki', 150),
(13, 'Brown rice', 250),
(13, 'Summer mix', 100),
(14, 'Beef strips teriyaki', 150),
(14, 'Bell pepper mix', 100),
(14, 'Yellow rice', 250),
(15, 'Beef burger', 160),
(15, 'Macaroni', 250),
(15, 'Mexican vegetable mix', 100),
(16, 'Beef strips teriyaki', 150),
(16, 'Mexican vegetable mix', 100),
(16, 'Whole wheat penne', 250),
(17, 'Beef burger', 160),
(17, 'Broccoli mix', 100),
(17, 'Sweet potato mash', 250),
(21, 'Beef strips teriyaki', 150),
(21, 'Brown rice', 130),
(21, 'Summer mix', 125),
(22, 'Beef strips teriyaki', 150),
(22, 'Broccoli mix', 175),
(23, 'Beef strips teriyaki', 150),
(23, 'Summer mix', 175),
(24, 'Broccoli', 175),
(24, 'Pangasius fillet', 160),
(25, 'Mixed Vegetables', 175),
(25, 'Salmon', 160),
(26, 'Broccoli', 175),
(26, 'Salmon', 160),
(27, 'Broccoli mix', 125),
(27, 'Pangasius fillet', 630),
(27, 'Sweet potato mash', 130),
(28, 'Broccoli', 125),
(28, 'Macaroni', 130),
(28, 'Salmon', 160),
(29, 'Salmon', 160),
(29, 'Spinach', 125),
(29, 'Whole wheat penne', 130),
(30, 'Mexican vegetable mix', 125),
(30, 'Pangasius fillet', 160),
(30, 'Yellow rice', 160),
(31, 'Mixed Vegetables', 175),
(31, 'Vegetarian burger', 150),
(32, 'Mexican vegetable mix', 175),
(32, 'Vegetarian burger', 150),
(33, 'Broccoli mix', 175),
(33, 'Vegetarian burger', 150),
(34, 'Broccoli', 175),
(34, 'Vegetarian burger', 150),
(35, 'Red cabbage with apple', 125),
(35, 'Sweet potato puree', 130),
(35, 'Vegetarian strips', 150),
(36, 'Green beans', 125),
(36, 'Sweet potato Mashed', 130),
(36, 'Vegetarian burger', 150),
(37, 'Macaroni', 130),
(37, 'Pepper mix', 125),
(37, 'Vegetarian strips', 150),
(38, 'Spinach', 125),
(38, 'Vegetarian strips', 150),
(38, 'Whole wheat penne', 130),
(39, 'Spinach', 125),
(39, 'Vegetarian burger', 150),
(39, 'Whole wheat penne', 130),
(40, 'Macaroni', 130),
(40, 'Mixed Vegetables', 125),
(40, 'Vegetarian burger', 150),
(41, 'Mixed Vegetables', 125),
(41, 'Vegetarian strips', 150),
(41, 'Yellow rice', 130),
(42, 'Broccoli mix', 125),
(42, 'Vegetarian burger', 150),
(42, 'Yellow rice', 130);

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `mainIngredientId` int(11) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(900) NOT NULL,
  `name` varchar(100) NOT NULL,
  `kcal` int(11) NOT NULL,
  `allergens` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='wpp = weight per portion';

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `mainIngredientId`, `price`, `image`, `name`, `kcal`, `allergens`) VALUES
(1, 0, 6.39, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/k/i/kipburger---summermix.jpg', 'Chicken burger - Summer mix (with herbs)\r\n\r\n', 304, 'Gluten, Coriander, Mustard, Legumes, Soy, Wheat'),
(2, 0, 6.39, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/k/i/kipburger---broccoli.jpg', 'Chicken burger - Broccoli (with herbs)', 303, 'Gluten, Coriander, Mustard, Legumes, Soy, Wheat'),
(3, 0, 6.25, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/k/i/kip-piri-piri---wokmix.jpg', 'Chicken Piri Piri - Stir-fry mix\r\n', 255, ''),
(4, 0, 6.1, 'https://www.fuelyourbody.nl/media/catalog/product/cache/a933d7a3783b8d88651fdd9da06e3ec3/k/i/kip-piri-piri---summermix.jpg', 'Chicken Piri Piri - Summer mix\r\n', 260, ''),
(7, 0, 6.49, 'https://www.fuelyourbody.nl/media/catalog/product/cache/a933d7a3783b8d88651fdd9da06e3ec3/k/i/kip-cayun---broccoli.jpg', 'Chicken Cayun - Broccoli\r\n', 228, 'Gluten, Coriander, Soy, Wheat\r\n'),
(8, 0, 5.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/k/i/kipspies---sperziebonen.jpg', 'Baked chicken fillet skewers - Green beans\r\n', 311, ''),
(9, 0, 5.49, 'https://www.fuelyourbody.nl/media/catalog/product/cache/a933d7a3783b8d88651fdd9da06e3ec3/k/i/kipspies---broccolimix.jpg', 'Baked chicken fillet skewers - Broccoli mix\r\n', 314, ''),
(10, 0, 5.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/k/i/kip---mexicomix.jpg', 'Baked chicken fillet cubes - Mexican vegetable mix\r\n', 288, ''),
(11, 0, 5.95, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/m/a/macaroni---gegrilde-kipreepjes---paprikamix_2.jpg', 'Macaroni - Grilled Chicken Strips - Bell Pepper Mix (with herbs) - BULK\n\n', 660, 'Durum Wheat\r\n'),
(12, 0, 5.95, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/m/a/macaroni---gegrilde-kipreepjes---paprikamix_1.jpg', 'Macaroni - Grilled Chicken Strips - Bell Pepper Mix\r\n', 436, 'Durum Wheat\r\n'),
(13, 1, 7.7, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/i/zilvervliesrijst---runderreepjes---summermix.jpg', 'Brown Rice - Beef Teriyaki Strips - Summer Mix (with herbs) - BULK', 557, 'Gluten, Sesame Seeds, Soy, Sulfites, Wheat'),
(14, 1, 7.65, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/g/e/gele-rijst---runderreepjes---paprikamix_2.jpg', 'Yellow Rice - Beef Teriyaki Strips - Bell Pepper Mix (with herbs) - BULK', 552, 'Gluten, Sesame Seeds, Soy, Sulfites, Wheat'),
(15, 1, 6.95, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/m/a/macaroni---runderburger---mexicomix_1_1.jpg', 'Macaroni - Beef Burger - Mexican Vegetable Mix (with herbs) - BULK', 743, 'Durum Wheat, Rye, Celery, Wheat'),
(16, 1, 7.59, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/o/volkoren-penne---rundereepjes---mexicomix_1.jpg', 'Whole Wheat Penne - Beef Teriyaki Strips - Mexican Vegetable Mix (with herbs)', 692, 'Durum Wheat, Gluten, Sesame Seeds, Soy, Sulfites, Wheat'),
(17, 1, 6.95, 'https://www.fuelyourbody.nl/media/catalog/product/cache/a933d7a3783b8d88651fdd9da06e3ec3/z/o/zoete-aardappel-puree---runderburger---broccolimix_1.jpg', 'Sweet Potato Puree - Beef Burger - Broccoli Mix (with herbs) - BULK', 508, 'Rye, Celery, Wheat'),
(18, 1, 6.55, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/p/a/pastabolognesevegan.jpg', 'Pasta Bolognese [Vegan]', 483, 'Barley, Gluten, Corn, Wheat'),
(19, 1, 6.55, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/p/a/pastabolognesevegan.jpg', 'Pasta Bolognese [Vegan]', 483, 'Barley, Gluten, Corn, Wheat'),
(20, 1, 7.49, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/c/h/chili-con-carne.jpg', 'Chili Con Carne', 561, ''),
(21, 1, 7.74, 'hhttps://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/i/zilvervliesrijst---runderreepjes---summermix_1.jpg', 'Brown Rice - Beef Strips Teriyaki - Summer Mix (with herbs)', 402, 'Gluten, Sesame Seeds, Soy, Sulfite, Wheat'),
(22, 1, 7.74, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/r/u/runderrreepjes---broccolimix.jpg', 'Beef Strips Teriyaki - Broccoli Mix (with herbs)', 248, 'Gluten, Sesame Seeds, Soy, Sulfite, Wheat'),
(23, 1, 7.74, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/r/u/runderreepjes---summermix.jpg', 'Beef Strips Teriyaki - Summer Mix (with herbs)', 254, 'Gluten, Sesame Seeds, Soy, Sulfite, Wheat'),
(24, 2, 8.25, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/p/a/panga---broccoli.jpg', 'Pangasius fillet - Broccoli\r\n', 177, ''),
(25, 2, 9.45, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/a/zalm---summermix.jpg', 'Salmon - Summer mix (with herbs)\r\n', 404, ''),
(26, 2, 9.45, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/a/zalm---broccoli_1.jpg', 'Salmon - Broccoli (with herbs)\r\n', 403, ''),
(27, 2, 8.99, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/o/zoete-aardappel-puree---panga---broccolimix.jpg', 'Sweet potato puree - Pangasius fillet - Broccoli mix', 278, 'Fish'),
(28, 2, 9.65, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/m/a/macaroni---zalm---broccoli.jpg', 'Macaroni - Salmon - Broccoli', 620, 'Durum Wheat, Fish'),
(29, 2, 9.65, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/o/volkoren-penne---zalm---spinazie.jpg', 'Whole wheat penne - Salmon - Spinach', 613, 'Wheat, Fish'),
(30, 2, 8.85, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/g/e/gele-rijst---panga---mexicomix.jpg', 'Yellow rice - Pangasius fillet - Mexican vegetable mix', 360, 'Fish'),
(31, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/e/vegaburger---summermix.jpg', 'Vegetarian Burger - Summer mix (with herbs)', 450, 'Eggs, Barley, Gluten, Soy, Wheat'),
(32, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/e/vegaburger---mexicomix.jpg', 'Vegetarian Burger - Mexican vegetable mix (with herbs)', 482, 'Eggs, Barley, Gluten, Soy, Wheat'),
(33, 3, 6.75, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/e/vegaburger---broccolimix.jpg', 'Vegetarian Burger - Broccoli mix (with herbs)', 444, 'Eggs, Barley, Gluten, Soy, Wheat'),
(34, 3, 6.75, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/e/vegaburger---broccoli.jpg', 'Vegetarian Burger - Broccoli (with herbs)', 449, 'Eggs, Barley, Gluten, Soy, Wheat'),
(35, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/o/zoete-aardappel-puree---vegareepjes---rode-kool-met-appel.jpg', 'Sweet potato puree - Vegetarian strips - Red cabbage with apple', 528, 'Eggs, Gluten, Corn, Milk (including lactose), Nuts, Wheat'),
(36, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/z/o/zoete-aardappel-puree---vegaburger---sperziebonen.jpg', 'Sweet potato puree - Veggie burger - Green beans', 524, 'Eggs, Barley, Gluten, Soy, Wheat'),
(37, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/m/a/macaroni---vegetarische-reepjes---paprikamix.jpg', 'Macaroni - Vegetarian strips - Pepper mix', 580, 'Eggs, Durum wheat, Gluten, Corn, Milk (including lactose), Nuts, Soy, Wheat'),
(38, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/o/volkoren-penne---vegetarische-reepjes--spinazie_1.jpg', 'Whole wheat penne - Vegetarian strips - Spinach', 579, 'Eggs, Gluten, Corn, Milk (including lactose), Nuts, Wheat'),
(39, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/v/o/volkoren-penne---vegaburger---spinazie.jpg', 'Whole wheat penne - Veggie burger - Spinach', 636, 'Eggs, Barley, Gluten, Soy, Wheat'),
(40, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/m/a/macaroni---vegaburger---summermix.jpg', 'Macaroni - Veggie burger - Summer mix', 625, 'Eggs, Durum wheat, Barley, Soy, Wheat'),
(41, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/g/e/gele-rijst---vegetarische-reepjes---mexicomix.jpg', 'Yellow rice - Vegetarian strips - Mexican vegetable mix', 533, 'Eggs, Gluten, Corn, Milk (including lactose), Nuts, Wheat'),
(42, 3, 7.5, 'https://www.fuelyourbody.nl/media/catalog/product/cache/7a0fd54248504438380194dd261c8eaf/g/e/gelerijstvegaburgerbroccolimix.jpg', 'Yellow rice - Veggie burger - Broccoli mix', 583, 'Eggs, Barley, Gluten, Soy, Wheat');

-- --------------------------------------------------------

--
-- Table structure for table `StatusOrders`
--

CREATE TABLE `StatusOrders` (
  `statusID` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `StatusOrders`
--

INSERT INTO `StatusOrders` (`statusID`, `status`) VALUES
(1, 'Pending'),
(2, 'In Progress'),
(3, 'Shipped'),
(4, 'Delivered'),
(5, 'Cancelled'),
(6, 'null');

-- --------------------------------------------------------

--
-- Table structure for table `userCarts`
--

CREATE TABLE `userCarts` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `mealId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0,
  `statusID` int(11) DEFAULT NULL,
  `payDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userCarts`
--

INSERT INTO `userCarts` (`cartId`, `userId`, `mealId`, `quantity`, `isPaid`, `statusID`, `payDate`) VALUES
(2, 75, 11, 12, 1, 4, '2023-04-07 16:35:07'),
(4, 75, 2, 5, 0, 1, '2023-04-07 18:18:32'),
(8, 75, 1, 7, 0, 1, '2023-04-07 18:21:57'),
(9, 75, 1, 6, 1, 1, '2023-04-07 18:23:04'),
(10, 78, 1, 11, 1, 1, '2023-04-08 15:55:00'),
(11, 78, 1, 3, 1, 1, '2023-04-08 15:55:15'),
(12, 78, 2, 4, 1, 1, '2023-04-08 15:55:29');

--
-- Triggers `userCarts`
--
DELIMITER $$
CREATE TRIGGER `userCarts_before_insert` BEFORE INSERT ON `userCarts` FOR EACH ROW BEGIN
  SET NEW.payDate = NOW();
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `userCarts_before_update` BEFORE UPDATE ON `userCarts` FOR EACH ROW BEGIN
  SET NEW.payDate = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(99) NOT NULL,
  `postalcode` varchar(8) NOT NULL,
  `houseNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `email`, `password`, `postalcode`, `houseNumber`) VALUES
(75, 'Harry', 'von Harryman', 'luuk@luukmail.com', '$2y$10$OOAIwM/LsByNDOfJ04UGBOVl08e1GW.pevk1.Y.AQI1IORFmEo7ze', '2323rr', '22'),
(76, 'John', 'Doe', 'john.doe@example.com', '$2y$10$CbnQ8rsYKG6CW6jpTcE/aemBG9xOp1QK.aTanj3zSXk05zrQFH502', '1234ab', '12'),
(77, 'Bettina', ' J Bades', 'maude.bat0@hotmail.com', '$2y$10$E7q0iJAG9afygeEqGHc0vOUVblhf7qeTdOZShBYGvdfVWUgO0hKSe', '1234ab', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foodCategories`
--
ALTER TABLE `foodCategories`
  ADD PRIMARY KEY (`foodCategoryID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`meal_id`,`ingredient`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mainIngredientId` (`mainIngredientId`);

--
-- Indexes for table `StatusOrders`
--
ALTER TABLE `StatusOrders`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `userCarts`
--
ALTER TABLE `userCarts`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `mealId` (`mealId`),
  ADD KEY `statusID` (`statusID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foodCategories`
--
ALTER TABLE `foodCategories`
  MODIFY `foodCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `StatusOrders`
--
ALTER TABLE `StatusOrders`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userCarts`
--
ALTER TABLE `userCarts`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`);

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `fk_mainIngredientId` FOREIGN KEY (`mainIngredientId`) REFERENCES `foodCategories` (`foodCategoryID`);

--
-- Constraints for table `userCarts`
--
ALTER TABLE `userCarts`
  ADD CONSTRAINT `userCarts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `userCarts_ibfk_2` FOREIGN KEY (`mealId`) REFERENCES `meals` (`id`),
  ADD CONSTRAINT `userCarts_ibfk_3` FOREIGN KEY (`statusID`) REFERENCES `StatusOrders` (`statusID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
