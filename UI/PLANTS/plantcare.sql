-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 12:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plantcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'off',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `status`, `user_id`) VALUES
(2, 'banana', 'on', 1),
(4, 'onion', 'off', 0),
(5, 'xzc', 'off', 0),
(6, 'sdda', 'on', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `humidity` varchar(100) DEFAULT NULL,
  `water_schedule` varchar(100) DEFAULT NULL,
  `fertilizer` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `image_url`, `humidity`, `water_schedule`, `fertilizer`, `details`) VALUES
(1, 'Sigarilyas', 'assets/sigarilyas.png', 'Sigarilyas thrives in high humidity, ideally between 70% to 90%. This humidity range supports optima', 'For cultivating sigarilyas (winged bean), water deeply before planting, then maintain consistent moi', 'Potassium Nitrate (13-0-46): Provides potassium and nitrogen, enhancing flowering and fruit developm', '(Psophocarpus tetragonolobus) a tropical climbing plant belonging to the Fabaceae family. Known for its long, flat, winged pods that can reach up to 30 cm (12 inches) in length, sigarilyas features green pods that contain small seeds. It is rich in protein, vitamins (especially vitamin C), and minerals, making both the leaves and young pods edible and highly nutritious. Thriving in tropical climates, sigarilyas is commonly cultivated in home gardens and farms throughout Southeast Asia, particularly in the Philippines, where it is valued for its versatility in cooking and health benefits.'),
(2, 'Bitter Gourd ', 'assets/bitter.png', 'Bitter gourd grows best in humidity levels of 60% to 80%, which supports flowering and fruit set. Wh', 'For cultivating bitter gourd, water deeply before planting, then keep the soil consistently moist by', 'Bitter gourd thrives with a mix of inorganic and organic fertilizers. Common inorganic options inclu', '(Ampalaya)\r\nScientific Name: Momordica charantia\r\nBitter gourd, also known as ampalaya, is a tropical vine commonly grown for its edible, bitter fruits. It is rich in vitamins and minerals and is often used in various culinary dishes'),
(3, 'Onion', 'assets/onions.png', 'Onions thrive in moderate humidity levels of 50% to 70%. While they require some moisture in the air', 'For cultivating onions, water deeply before planting to prepare the soil. During the seedling stage ', 'Onions benefit from both inorganic and organic fertilizers. A common practice is to use urea (46-0-0', ' (Allium cepa) \r\nScientific Name: Allium cepa\r\nOnions are a widely cultivated vegetable known for their distinctive flavor and aroma. They are a staple ingredient in many cuisines worldwide and are rich in vitamins, minerals, and antioxidants.'),
(4, 'Carrot', 'assets/karot.png', 'Carrots should be stored in a cool, humid environment with a humidity level of 90-95%. This helps to', 'Spring: As temperatures rise and daylight increases, begin to water more regularly.\r\nSummer: Hotter ', 'For carrots, I recommend selecting a slow-release fertilizer with a balanced NPK ratio such as a 4-4', 'The carrot (Daucus carota) is a root vegetable often claimed to be the perfect health food. It is crunchy, tasty, and highly nutritious.\r\n\r\nCarrots are a particularly good source of beta-carotene, fiber, vitamin K1, potassium, and antioxidants. Plus, they’re low in calories.\r\n\r\nThey also have several health benefits. They have been linked to lower cholesterol levels and improved eye health. What’s more, their carotene antioxidants have been linked to a reduced risk of cancer.\r\n\r\nCarrots are found in many colors, including yellow, white, orange, red, and purple. Orange carrots get their bright color from beta carotene, an antioxidant that your body converts into vitamin A.'),
(5, 'Corn', 'assets/corn.png', 'Corn thrives in humidity levels of 60% to 80%. ', 'During the seedling stage (0-3 weeks), water every 2-3 days to keep the soil consistently moist.', 'Corn requires a balanced approach to fertilization, benefiting from both inorganic and organic ferti', '(Zea mays) \r\nCorn, also known as maize, is a staple cereal grain widely cultivated for human consumption, animal feed, and industrial uses. It is rich in carbohydrates and provides essential nutrients.'),
(6, 'Wheat', 'assets/wheat.png', 'Wheat thrives in moderate humidity levels of 50% to 70%. ', 'During the germination and seedling stage (0-4 weeks), water every 7-10 days to keep the soil consis', ' Common inorganic fertilizers include urea (46-0-0) for nitrogen, diammonium phosphate (DAP) for pho', ' (Triticum aestivum) \r\nScientific Name: Triticum aestivum\r\nWheat, commonly referred to as trigo, is a major cereal grain cultivated worldwide for its seeds, which are ground into flour and used in a variety of food products. It is a staple food in many diets and is rich in carbohydrates, protein, and essential nutrients.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `sex`, `username`, `password`) VALUES
(1, 'sample', 'sample', 'sample', 'Male', 'sample1', 'sample123'),
(2, 'Aji', 'Apalla', 'Takahashi', 'Female', 'jeroneayz@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `watering_history`
--

CREATE TABLE `watering_history` (
  `id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `watered_on` datetime NOT NULL,
  `status` enum('watered','not_watered') NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watering_history`
--

INSERT INTO `watering_history` (`id`, `plant_id`, `watered_on`, `status`, `userid`) VALUES
(1, 1, '2024-09-20 10:30:00', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `watering_history`
--
ALTER TABLE `watering_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `plant_id` (`plant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `watering_history`
--
ALTER TABLE `watering_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `watering_history`
--
ALTER TABLE `watering_history`
  ADD CONSTRAINT `watering_history_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `watering_history_ibfk_2` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
