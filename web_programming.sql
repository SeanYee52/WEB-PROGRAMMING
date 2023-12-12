-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 02:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_programming`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `password`) VALUES
(1, 'Jesse Cox', '164026835a3ab9e92e58715b3edfda2fdcdbc9e3'),
(2, 'Walter White', 'b2b4bf7c79d5300bb3849dd2bc1b95533a531664');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `feature_id` varchar(10) NOT NULL,
  `feature` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`feature_id`, `feature`) VALUES
('ACE', 'Accessible Elevator'),
('ALD', 'Assistive Listening Device'),
('AUC', 'Audio Cues'),
('BBQ', 'Barbecue Area'),
('BRAI', 'Braille Signage'),
('CAFE', 'Cafeteria'),
('ELE', 'Elevator Lobby'),
('GYM', 'Gymnasium Room'),
('JOG', 'Jogging Track'),
('LANG', 'Clear and Simple Language'),
('PARK', 'Parking Area'),
('PLAY', 'Playground'),
('RAMP', 'Ramp Access'),
('SEC', '24 Hours Security'),
('SWIM', 'Swimming Pool');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `property_type` varchar(20) NOT NULL,
  `listing_type` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `floor_size` int(6) NOT NULL,
  `building_rating` decimal(2,1) DEFAULT 0.0,
  `renewable_rating` decimal(2,1) DEFAULT 0.0,
  `energy_rating` decimal(2,1) DEFAULT 0.0,
  `water_rating` decimal(2,1) DEFAULT 0.0,
  `user_id` int(10) DEFAULT NULL,
  `description` text NOT NULL,
  `furnished` varchar(3) NOT NULL,
  `no_of_bedrooms` tinyint(4) NOT NULL,
  `no_of_bathrooms` tinyint(4) NOT NULL,
  `no_of_carparks` tinyint(4) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `construction_date` year(4) NOT NULL,
  `certificates` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `address`, `city`, `state`, `property_type`, `listing_type`, `price`, `floor_size`, `building_rating`, `renewable_rating`, `energy_rating`, `water_rating`, `user_id`, `description`, `furnished`, `no_of_bedrooms`, `no_of_bathrooms`, `no_of_carparks`, `upload_date`, `construction_date`, `certificates`) VALUES
(1, '123 Jalan Harmoni', 'Kuala Lumpur', 'Kuala Lumpur', 'Apartment', 'Sale', 350000, 1200, 3.0, 4.0, 4.0, 3.0, 1, 'Discover unparalleled luxury living in this exquisite condominium nestled in the heart of a vibrant urban landscape. Offering a seamless blend of sophistication and modern design, this residence presents a haven of comfort and style. Enjoy breathtaking views from expansive windows that bathe each room in natural light. The open-concept living spaces are adorned with high-end finishes and state-of-the-art amenities, creating an atmosphere of opulence. Whether relaxing in the private spa-like en-suite or entertaining on the spacious balcony, every detail in this condominium is meticulously crafted for a life of indulgence and convenience.', 'yes', 5, 2, 3, '2023-12-11 13:58:47', '1987', 'EcoGuard Platinum Certification,\r\nVerdeStar Eco-Friendly Accreditation,\r\nSustainable Harmony Gold Standard,\r\nGreenVista Platinum Seal,\r\nEnviroChampion Emerald Award,'),
(2, '303 Taman Permai', 'Kota Kinabalu', 'Sabah', 'Bungalow', 'Rent', 5000, 2500, 4.0, 5.0, 4.0, 5.0, 1, 'Step into the epitome of luxury living with our exquisite collection of bungalows, where timeless elegance meets modern comfort. Nestled in serene surroundings, each bungalow is a masterpiece of architectural design, offering a harmonious blend of sophistication and natural beauty. Expansive interiors adorned with high ceilings and opulent finishes create an atmosphere of grandeur, while large windows invite abundant natural light and picturesque views into every room. Enjoy the seamless transition between indoor and outdoor living, with lush gardens, private pools, and charming outdoor spaces that redefine the meaning of tranquility. Experience the pinnacle of exclusivity and privacy in these thoughtfully crafted bungalows, where every detail is a testament to refined living.', 'no', 1, 2, 3, '2023-12-11 14:01:57', '1983', 'GreenPinnacle Diamond Recognition,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation,\r\nEcoHarbor Emerald Certification,'),
(3, '456 Persiaran Ceria', 'Pulau Pinang', 'Penang', 'Townhouse', 'Rent', 1200, 850, 4.0, 5.0, 5.0, 4.0, 2, 'Discover the charm of urban living with our stylish townhouses, designed to offer the perfect balance between convenience and comfort. Nestled in a vibrant neighborhood, each townhouse boasts a contemporary design that harmoniously blends modern aesthetics with functionality. Step into spacious interiors adorned with tasteful finishes, creating an inviting atmosphere for both relaxation and entertainment. The thoughtful layout maximizes living space, providing a cozy retreat for families and individuals alike. Enjoy the convenience of attached garages, private patios, and communal green spaces that enhance the sense of community. With close proximity to city amenities and a welcoming neighborhood ambiance, our townhouses redefine urban living with a touch of elegance.', 'no', 3, 4, 0, '2023-12-11 14:09:42', '2002', 'GreenVista Platinum Seal,\r\nEnviroChampion Emerald Award,\r\nEcoScape Gold Certification,\r\nGreenPinnacle Diamond Recognition'),
(4, '404 Jalan Seri Baiduri', 'Shah Alam', 'Selangor', 'Condominium', 'Sale', 600000, 1800, 4.0, 5.0, 5.0, 5.0, 2, 'Indulge in the epitome of contemporary urban living with our exceptional condominiums. Elevate your lifestyle within these sleek and sophisticated residences that seamlessly blend luxury and convenience. Each unit is a haven of modern design, featuring open-concept living spaces, high-end finishes, and panoramic views of the city skyline. Enjoy the convenience of state-of-the-art amenities, from fitness centers to rooftop lounges, providing the perfect balance between work and play. The condominium\'s strategic location offers easy access to cultural hotspots, dining, and entertainment, ensuring a dynamic and vibrant lifestyle. Experience unparalleled elegance and comfort in these thoughtfully crafted condominiums, where every detail is designed to enhance the urban living experience.', 'yes', 4, 1, 2, '2023-12-11 14:11:26', '2015', 'EnviroChampion Emerald Award,\r\nEcoScape Gold Certification,\r\nGreenPinnacle Diamond Recognition,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation,\r\nEcoHarbor Emerald Certification,'),
(5, '101 Jalan Damai Indah', 'Ipoh', 'Perak', 'Apartment', 'Rent', 900, 1300, 4.0, 0.0, 0.0, 0.0, 4, 'Experience modern living at its finest with our stylish apartments. Thoughtfully designed for comfort and convenience, each unit features contemporary finishes, open layouts, and ample natural light. Enjoy the perks of urban living with nearby amenities and a vibrant community atmosphere. Elevate your lifestyle in these cozy and well-appointed apartments.', 'no', 2, 3, 4, '2023-12-11 14:13:29', '2009', 'VerdeStar Eco-Friendly Accreditation\r\nSustainable Harmony Gold Standard\r\nGreenVista Platinum Seal'),
(6, '606 Persiaran Bahagia', 'Malacca City', 'Melaka', 'Townhouse', 'Sale', 400000, 1200, 5.0, 3.0, 3.0, 4.0, 4, 'Discover the perfect blend of comfort and community in our stylish townhouses. These thoughtfully designed homes offer a cozy retreat with modern interiors, private spaces, and communal amenities. Enjoy the convenience of urban living in a vibrant neighborhood setting. Welcome to a charming townhouse lifestyle tailored for your comfort and enjoyment.', 'no', 4, 3, 4, '2023-12-11 14:15:07', '1982', 'Sustainable Harmony Gold Standard,\r\nGreenVista Platinum Seal,\r\nEnviroChampion Emerald Award'),
(7, '789 Lorong Sejahtera', 'Johor Bahru', 'Johor', 'Bungalow', 'Sale', 500000, 2000, 3.0, 5.0, 4.0, 3.0, 3, 'Escape to luxury in our exclusive bungalows, where elegance meets tranquility. Enjoy spacious interiors, private gardens, and stunning architectural details. Each bungalow is a masterpiece of comfort, offering a secluded retreat for the discerning resident. Embrace a lifestyle of opulence in a serene environment, redefining the meaning of home.', 'yes', 4, 2, 5, '2023-12-12 09:26:00', '1995', 'NatureGuard Platinum Distinction,\r\nEcoScape Gold Certification,\r\nVerdeStar Eco-Friendly Accreditation'),
(8, '505 Taman Damansara', 'Kuantan', 'Pahang', 'Apartment', 'Rent', 800, 950, 3.0, 3.0, 5.0, 5.0, 3, 'Discover affordable living in our charming apartments, where comfort meets affordability. These thoughtfully designed units offer a cozy retreat with practical layouts and modern amenities. Enjoy the convenience of urban living without compromising on quality. With a focus on affordability, our apartments provide a welcoming space for individuals and families alike. Experience the perfect blend of comfort and budget-friendly living in a community that feels like home.', 'yes', 1, 1, 1, '2023-12-12 09:31:01', '1991', 'EcoHarbor Emerald Certification,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation'),
(9, '202 Lebuh Damai', 'Kuching', 'Sarawak', 'Apartment', 'Sale', 250000, 1600, 4.0, 4.0, 5.0, 5.0, 5, 'Welcome to modern urban living in our stylish apartments. Designed with your comfort in mind, each unit features contemporary finishes and open layouts, creating a welcoming space to call home. Enjoy the convenience of on-site amenities and the vibrant atmosphere of the surrounding community. Whether you\'re a professional seeking a central location or a family looking for a cozy retreat, our apartments offer the perfect blend of comfort and convenience', 'yes', 2, 2, 1, '2023-12-12 09:36:00', '2016', 'EcoHarbor Emerald Certification,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation'),
(10, '707 Lorong Sentosa', 'Petaling Jaya', 'Selangor', 'Condominium', 'Rent', 1000, 1100, 4.0, 3.0, 4.0, 3.0, 5, 'Experience refined living in our luxurious condominiums. These sophisticated residences boast contemporary design and high-end finishes, creating an unparalleled urban oasis. Enjoy expansive views from your private balcony and indulge in the convenience of exclusive amenities, from fitness centers to rooftop lounges. Each unit is crafted for modern comfort, offering a lifestyle of elegance and relaxation. Discover the epitome of urban sophistication in our meticulously designed condominiums.', 'yes', 23, 3, 1, '2023-12-12 09:41:14', '2016', 'EcoHarbor Emerald Certification,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation'),
(11, '544, Jalan Ismail', 'Presint 1', 'Putrajaya', 'apartment', 'Sale', 500000, 1500, 4.0, 3.0, 3.0, 5.0, 4, 'Discover contemporary living in our modern apartments. Each unit is thoughtfully designed to offer a perfect blend of style and comfort. Enjoy spacious interiors, sleek finishes, and large windows that fill the space with natural light. Our apartments provide a cozy retreat in the heart of the city, where convenience meets luxury. With a range of amenities and a prime location, experience urban living at its finest in our well-appointed apartments.', 'yes', 3, 2, 2, '2023-12-12 09:53:51', '2016', 'EcoHarbor Emerald Certification,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation'),
(15, '23, Jalan Klang', 'Klang', 'Selangor', 'townhouse', 'Sale', 600000, 1500, 5.0, 4.0, 5.0, 5.0, 4, 'Welcome to urban charm redefined in our stylish townhouses. These thoughtfully designed homes offer a perfect balance of comfort and sophistication. Enjoy spacious interiors, modern finishes, and the convenience of private outdoor spaces. Whether you seek a cozy family retreat or an intimate setting for entertaining, our townhouses provide the ideal backdrop. Experience the warmth of community living in a vibrant neighborhood, where every detail reflects the essence of contemporary townhouse living.', 'no', 2, 2, 1, '2023-12-12 09:59:55', '2000', 'EcoHarbor Emerald Certification,\r\nNatureGuard Platinum Distinction,'),
(16, '223, Lorong 3/A', 'Ipoh', 'Perak', 'bungalow', 'Rent', 2000, 2000, 0.0, 0.0, 0.0, 0.0, 5, 'Escape to tranquility in our exclusive bungalows, where timeless elegance meets modern comfort. Nestled in lush surroundings, each bungalow is a masterpiece of architectural design, offering spacious interiors, private gardens, and luxurious details. Embrace a lifestyle of opulence as large windows invite natural light and panoramic views into every room. From serene master suites to expansive living areas, every corner of our bungalows is crafted for the discerning resident seeking the epitome of refined living.', 'yes', 3, 2, 2, '2023-12-12 10:28:47', '2003', 'EcoHarbor Emerald Certification,\r\nNatureGuard Platinum Distinction,\r\nSustainaBuild Gold Star Accreditation');

-- --------------------------------------------------------

--
-- Table structure for table `property_approval`
--

CREATE TABLE `property_approval` (
  `property_id` int(10) NOT NULL,
  `admin_id` int(10) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `assessment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_approval`
--

INSERT INTO `property_approval` (`property_id`, `admin_id`, `approval_date`, `assessment_date`) VALUES
(1, 1, '2023-12-11 14:16:48', '2023-12-31'),
(2, 2, '2023-12-11 14:20:52', '2024-02-17'),
(3, 1, '2023-12-11 14:17:06', '2023-12-27'),
(4, 2, '2023-12-11 14:20:22', '0000-00-00'),
(5, NULL, NULL, '2023-12-31'),
(6, 2, '2023-12-11 14:20:39', '2024-01-07'),
(7, 2, '2023-12-12 09:44:08', '2024-04-01'),
(8, 2, '2023-12-12 09:44:25', '2025-01-25'),
(9, 1, '2023-12-12 10:30:33', '2024-01-06'),
(10, 1, '2023-12-12 09:43:06', '2024-01-05'),
(11, 1, '2023-12-12 10:30:55', '2024-01-06'),
(15, 1, '2023-12-12 10:30:17', '2023-12-30'),
(16, NULL, NULL, '2023-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `property_features`
--

CREATE TABLE `property_features` (
  `property_id` int(10) NOT NULL,
  `feature_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_features`
--

INSERT INTO `property_features` (`property_id`, `feature_id`) VALUES
(1, 'ACE'),
(1, 'ALD'),
(1, 'CAFE'),
(1, 'ELE'),
(1, 'GYM'),
(1, 'PLAY'),
(1, 'RAMP'),
(2, 'BBQ'),
(2, 'BRAI'),
(2, 'GYM'),
(2, 'LANG'),
(2, 'RAMP'),
(2, 'SWIM'),
(3, 'BBQ'),
(3, 'BRAI'),
(3, 'GYM'),
(3, 'PLAY'),
(3, 'SEC'),
(4, 'ALD'),
(4, 'CAFE'),
(4, 'ELE'),
(4, 'GYM'),
(4, 'JOG'),
(4, 'LANG'),
(4, 'PARK'),
(4, 'SEC'),
(5, 'BBQ'),
(5, 'BRAI'),
(5, 'LANG'),
(5, 'SWIM'),
(7, 'PARK'),
(7, 'PLAY'),
(7, 'RAMP'),
(7, 'SWIM'),
(9, 'ACE'),
(9, 'JOG'),
(9, 'PLAY'),
(9, 'RAMP'),
(9, 'SEC'),
(9, 'SWIM'),
(11, 'GYM'),
(11, 'JOG'),
(11, 'PLAY'),
(11, 'SEC'),
(11, 'SWIM'),
(16, 'ACE'),
(16, 'ALD'),
(16, 'AUC'),
(16, 'BBQ'),
(16, 'BRAI'),
(16, 'CAFE'),
(16, 'ELE'),
(16, 'GYM'),
(16, 'JOG'),
(16, 'LANG'),
(16, 'PARK'),
(16, 'PLAY'),
(16, 'RAMP'),
(16, 'SEC'),
(16, 'SWIM');

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

CREATE TABLE `property_image` (
  `img_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `img_dir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_image`
--

INSERT INTO `property_image` (`img_id`, `property_id`, `img_dir`) VALUES
(1, 1, '../Images/ECOR10.jpg'),
(2, 1, '../Images/ECOR11.jpg'),
(3, 1, '../Images/ECOR12.jpg'),
(4, 2, '../Images/ECOR20.jpg'),
(5, 2, '../Images/ECOR21.jpg'),
(6, 2, '../Images/ECOR22.webp'),
(7, 2, '../Images/ECOR23.jpg'),
(8, 3, '../Images/ECOR30.jpeg'),
(9, 3, '../Images/ECOR31.JPG'),
(10, 3, '../Images/ECOR32.jpg'),
(11, 4, '../Images/ECOR40.JPG'),
(12, 4, '../Images/ECOR41.jpg'),
(13, 4, '../Images/ECOR42.jpg'),
(14, 4, '../Images/ECOR43.jpg'),
(15, 5, '../Images/ECOR50.jpg'),
(16, 5, '../Images/ECOR51.jpg'),
(17, 5, '../Images/ECOR52.jpg'),
(18, 6, '../Images/ECOR60.jpeg'),
(19, 6, '../Images/ECOR61.JPG'),
(20, 6, '../Images/ECOR62.jpg'),
(21, 7, '../Images/ECOP70.jpg'),
(22, 7, '../Images/ECOP71.jpg'),
(23, 7, '../Images/ECOP72.jpg'),
(24, 7, '../Images/ECOP73.jpg'),
(25, 8, '../Images/ECOP80.jpg'),
(26, 8, '../Images/ECOP81.jpeg'),
(27, 8, '../Images/ECOP82.jpg'),
(28, 9, '../Images/ECOP90.jpg'),
(29, 9, '../Images/ECOP91.jpg'),
(30, 9, '../Images/ECOP92.jpg'),
(31, 9, '../Images/ECOP93.webp'),
(32, 10, '../Images/ECOP100.jpg'),
(33, 10, '../Images/ECOP101.jpg'),
(40, 11, '../Images/ECOP110.jpg'),
(41, 11, '../Images/ECOP111.jpg'),
(42, 11, '../Images/ECOP112.webp'),
(52, 15, '../Images/ECOP150.jpeg'),
(53, 15, '../Images/ECOP151.jpg'),
(54, 15, '../Images/ECOP152.jpg'),
(55, 16, '../Images/ECOP160.jpg'),
(56, 16, '../Images/ECOP161.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `about_me` text DEFAULT '\'Empty for now\'',
  `profile_img_dir` varchar(50) NOT NULL DEFAULT '../Images/default_profile.jpg',
  `banner_img_dir` varchar(50) NOT NULL DEFAULT '../Images/default_banner.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `phone_no`, `join_date`, `about_me`, `profile_img_dir`, `banner_img_dir`) VALUES
(1, 'Jack Smith', 'f7e9bab6e19119084e3377a1d376aa0df54db162', 'jsmith@gmail.com', '012-3456789', '2023-12-11 20:53:44', 'Enthusiastic explorer of life, I thrive on creativity and adventure. A tech geek by day, nature lover by weekend. Let\'s talk science, art, and everything in between!\r\nEnthusiastic explorer of life, I thrive on creativity and adventure. A tech geek by day, nature lover by weekend. Let\'s talk science, art, and everything in between!\r\nEnthusiastic explorer of life, I thrive on creativity and adventure. A tech geek by day, nature lover by weekend. Let\'s talk science, art, and everything in between!', '../Images/ECOR1.jpg', '../Images/default_banner.jpg'),
(2, 'Poh Hao Wen', '9b2d1afc411d4c854daf8ec974ced2df20a5d947', 'pohhw@yahoo.com', '016-7890123', '2023-12-11 21:03:09', 'Aspiring minimalist and coffee aficionado. I find joy in the little things, whether it\'s a good book or a scenic hike. Currently on a mission to learn a new language.', '../Images/ECOR2.jpg', '../Images/default_banner.jpg'),
(3, 'Michelle Tan', 'b961a88742f21275edcd117934861b4ae99b4a87', 'michelletan@outlook.com', '017-2345678', '2023-12-11 21:03:47', 'A perpetual dreamer with a passion for storytelling. From coding to poetry, I believe in the power of words to shape our world. Let\'s create something beautiful together.', '../Images/ECOR3.jpg', '../Images/default_banner.jpg'),
(4, 'Aliyah', '44d5d55b6543cdb461e09cb1809b0a6645f52818', 'aliyah@sunway.edu.my', '019-4567890', '2023-12-11 21:04:25', 'Fitness freak and yoga enthusiast. I believe in the balance of mind, body, and spirit. When not at the gym, you\'ll find me experimenting with healthy recipes in the kitchen.', '../Images/ECOR4.jpg', '../Images/default_banner.jpg'),
(5, 'Narendra Pradha', '226f1a148ded3b058dfe82c149ad45ccc4950ebd', 'narendrap@email.com', '013-8901234', '2023-12-11 21:05:02', 'Musician at heart, I live for the rhythm of life. Whether strumming my guitar or exploring new genres, I\'m on a constant journey of self-discovery. Let\'s share melodies and stories.', '../Images/ECOR5.jpg', '../Images/default_banner.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `property_approval`
--
ALTER TABLE `property_approval`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_features`
--
ALTER TABLE `property_features`
  ADD KEY `property_id` (`property_id`),
  ADD KEY `property_features_ibfk_2` (`feature_id`);

--
-- Indexes for table `property_image`
--
ALTER TABLE `property_image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `property_image`
--
ALTER TABLE `property_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_approval`
--
ALTER TABLE `property_approval`
  ADD CONSTRAINT `property_approval_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `property_approval_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_features`
--
ALTER TABLE `property_features`
  ADD CONSTRAINT `property_features_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `property_features_ibfk_2` FOREIGN KEY (`feature_id`) REFERENCES `features` (`feature_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_image`
--
ALTER TABLE `property_image`
  ADD CONSTRAINT `property_image_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
