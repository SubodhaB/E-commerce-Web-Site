-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 07:08 PM
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
-- Database: `toy_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `order_date`, `status`, `address`, `city`, `zip`) VALUES
(26, 21, 16.72, '2024-10-27 22:45:52', 'Processing', '279/1 pakaya', 'gampaha', '1201'),
(27, 21, 5.39, '2024-10-28 09:27:41', 'Processing', '279/1 pakaya', 'gampaha', '1201'),
(28, 21, 18.75, '2024-10-28 10:45:56', 'Processing', '279/1 pakaya', 'gampaha', '1201'),
(29, 24, 17.99, '2024-10-28 14:11:19', 'Processing', 'Mirigama road, Sivulapitiya', 'gampaha', '1201'),
(30, 24, 16.72, '2024-10-28 14:14:01', 'Processing', 'Mirigama road, Sivulapitiya', 'gampaha', '1201');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `order_id` int(11) NOT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`order_id`, `tracking_number`, `status`, `last_update`) VALUES
(26, 'TOY-671e754895f35', 'Processing', '2024-10-27 22:45:52'),
(27, 'TOY-671f0bb529fbe', 'Processing', '2024-10-28 09:27:41'),
(28, 'TOY-671f1e0c3d748', 'Processing', '2024-10-28 10:45:56'),
(29, 'TOY-671f4e2fe8503', 'Processing', '2024-10-28 14:11:19'),
(30, 'TOY-671f4ed1d1b97', 'Processing', '2024-10-28 14:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(1, 'Toy Car', 'A fast red toy car.', 10.99, 'images/toy_car.jpg', '2024-09-09 18:40:59'),
(2, 'Action Figure', 'A cool action figure.', 15.49, 'images/action_figure.jpg', '2024-09-09 18:40:59'),
(3, 'Building Blocks', 'Colorful building blocks.', 20.00, 'images/building_blocks.jpg', '2024-09-09 18:40:59'),
(4, 'Tonyra Remote Control Boat', '—RC Boat for Sea and Lake: remote control boat is a boat suit for playing in the saltwater. Meryi RC boat can reach a maximum speed of 18 mph in the water with 2.4GHZ remote control and a signal range of 400 Ft.Unlike traditional RC boats, our product is equipped with a high quality battery, which is better than ordinary batteries. It can support the RC boat to work for 15 minutes at high speed.(One Rechargeable Battery：7.4V/1200mAh)\r\n—Auto Capsize Recovery:This function allows the remote control boat to adjust to the right state automatically after capsizing, it will always be in the right state to travel on the sea without worrying about capsizing when encountering waves.', 17.99, 'images/boat.jpg', '2024-09-09 19:48:16'),
(5, 'Kids Smart Watch', 'Kids Smart Watch Boys Waterproof with 26 Games, Music Player, Camera, and More - Blue.', 9.29, 'images/watch.jpg', '2024-09-09 19:48:16'),
(6, 'Soap Bubble Water Toy', 'One of the best toys for kids and adults, best gift for kids\r\nGreat for use in or out of the tub\r\nHave bubble-blasting fun with the Bubble Blaster\r\n01 Bubble Stick', 9.00, 'images/soup_bubble.jpg', '2024-09-09 19:48:16'),
(7, 'Electric Gel Ball Blaster', '1.Newest design:This blaster is the latest design models for 2022.The unique design of the lower supply clip makes the whole blaster look more realistic and beautiful.Also you can get a better view.', 27.99, 'images/gelblaster.jpg', '2024-09-10 18:21:17'),
(8, 'VEOOJRFEY Children Watch Ben 10 Omnitrix Toys', 'Made by high quality material,adjustable watch band and comfortable to wear.\r\nVery Easy to play, just insert the card and press the side button, a cool cartoon hero will appear\r\nKids can see different images by rotating the card, totally there are 30 different images.\r\nPerfect gifts for Children in birthday,Christmas Party, they will be excited and love it.\r\nPackage includes 3 cards and 10 images on each card. If there are any quality problem just contact freely.', 7.35, 'images/bwatch.jpg', '2024-09-10 18:21:17'),
(9, 'YONTYEQ Spider-Boy Web Shooter Wrist Toy', 'Super Hero Launcher Gloves Wrist Toy is a durable and flexible wrist accessory for cosplay with a movie-accurate design based on Spider-boy movies. It comes with a built-in rechargeable battery and motor, along with an adjustable size and has a launch effective distance of 8ft.', 17.00, 'images/webshooter.jpg', '2024-09-10 18:21:17'),
(10, 'Hot Toys Action Figure, Muticoloured, 1:6', '1.Newest design:This blaster is the latest design models for 2022.The unique design of the lower supply clip makes the whole blaster look more realistic and beautiful.Also you can get a better view.Batman\r\nLicensed Collectable\r\nTV & Movie Cars\r\nTV & Movie', 18.99, 'images/bat.jpg', '2024-09-11 07:49:34'),
(11, 'Electronic Iron-man Helmet', 'Mark42 Wearable Helmet LED Light Up Iron-man mask Iron-man Super Hero Model 1:1 Helmet Cosplay Props Replica Christmas, Halloween', 15.55, 'images/ironman.jpg', '2024-09-11 07:49:34'),
(13, 'Outdoortoys Racing 12V Electric Ride On Motorbike', 'A scrambler style bike for the junior rider, our Racing 12V ride on motorbike looks like it came straight off the motorcross track, it even has the twist grip accelerator for added authenticity.\r\n\r\nSuitable for kids 3+ years, the stabilisers and hand throttle for speed allow for a steady controlled learning experience, the easy controls are ideal for the less experienced too, allowing younger children to learn and enjoy themselves while being like the big kids on a bike made just for them.', 139.95, 'images/kbike.jpg', '2024-10-22 14:32:55'),
(15, 'Marvel Avengers Endgame Captain America Shield', 'Name: Captain America Brand: Material : Plastic For age : 3-15 Package: 1pcs opp bag Function: FEEDBACK 1)Any ions, please send us a , will ry our best o solve he problem for you. 2) Please remember o ve us your 5 STAR POSITIVE FEEDBACK hat really matter o us.', 18.75, 'images/capsheild.jpg', '2024-10-22 14:58:07'),
(16, 'Brown 5 ft Giant Teddy bear', 'Category: 5 Feet Tags: blue teddy, buy teddy online, buy teddy srilanka, giant teddies in srilanka, giant teddy, online teddy buy, teddy buy srilanka, teddy srilanaka.6 feet teddy, teddy store, teddy.lk, teddylk', 7.67, 'images/teddy.jpg', '2024-10-22 15:30:53'),
(17, 'Off Road Remote Control Model Car 6+ (LM258)', 'Age Range: 6+ years\r\nFunctionality: Move Forward, Reverse, Turn Left, Turn Right\r\nOff-Road Capable: Designed for rugged terrain and adventurous play\r\nScale: Typically 1:12 or 1:14 (depending on the model)\r\nSpeed: High-speed performance for exciting play\r\nDurability: Sturdy construction to withstand rough handling\r\nControl: Precise remote control for accurate driving\r\nFeatures: Robust suspension system and durable tires for off-road capability\r\nBattery: Rechargeable with included charger for convenience', 16.72, 'images/rccar.jpg', '2024-10-27 15:27:28'),
(18, 'Nintendo Switch OLED', '64GB Internal Storage\r\nCustom NVIDIA Tegra Processor\r\n7″ 1280 x 720 OLED Touchscreen\r\n4.5 to 9 Hours of Battery Life\r\nOutputs up to 1080p when Using Dock\r\nExpandable Storage via microSD Cards\r\n6 Months Warranty', 396.48, 'images/gamingpad.jpg', '2024-10-28 08:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(23, 'Nayomi', '$2y$10$dKlMm363V2KcicW81THcwelN.J/cIwfgDGgu8SYzExpPcIxQOt4My', 'nayomigeethika23@gmail.com', '2024-10-27 16:37:14'),
(24, 'Subodha', '$2y$10$MBSuX13vshFl5vkNyu0ToObjkI688Sqr5qJ9HlAV6.1sey1nQKU1K', 'subodharealme@gmail.com', '2024-10-28 08:30:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
