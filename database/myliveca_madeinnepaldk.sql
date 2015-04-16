-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2015 at 10:46 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myliveca_madeinnepaldk`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
`id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `aki_date` date NOT NULL,
  `aki_time` time NOT NULL,
  `aki_avail` int(1) NOT NULL,
  `aki_edited` int(1) NOT NULL,
  `aki_user` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `aki_date`, `aki_time`, `aki_avail`, `aki_edited`, `aki_user`) VALUES
(1, 'Hi there, this is the first Blog!!!', 'And here is some information...', '2015-04-12', '00:00:00', 1, 0, 'tika');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `pseudo-title` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`pseudo-title`, `title`, `content`) VALUES
('about', 'About', 'Bag madeinnepal.dk finder du Camilla, medio 30, mor til 2 drenge og pt. bachelorstuderende. Som ung pige har jeg rejst i Nepal og i 2014 går turen tilbage til det smukke land sammen med familien.Vores leverandørDet er vigtigt for os, at der er tale om gode vilkår for kvinderne og at der på ingen måde er børnearbejde involveret. Vores leverandør beskæftiger ca. 50 kvinder i alderen 21 år og op. De fleste af kvinderne er ''seniorer'' og de har alle mindst 5 års erfaring. Kvinderne får en god løn efter nepalesiske standarder og de er også så priviligerede, at de rent faktisk kan arbejde hjemmefra, da de udelukkende behøver at have nål, tråd og masser af uldkugler ved hånden for at lave de smukke tæpper. Hen ad vejen er der opstået et troværdigt og tillidsfuldt samarbejde, vi er - næsten - i daglig kontakt og vi glæder os til at besøge fabrikken samt møde leverandøren og de dygtige kvinder, når vi rejser til Nepal senere på året.Vores vision og målVores vision er at sælge unikke håndlavede tæpper til overkommelige priser. Alle størrelser og farver kan designes, så man kan få et tæppe, der passer præcist i farverne og størrelsen.Vores mål er at udvide med tiden og at have flere tæpper på lager, end det hidtil er tilfældet. Vi forsøger at matche tidens trend og vi vil således have altid have et udvalg af forskellige slags tæpper til hver en smag i Made in Nepals eget faste sortiment.');

-- --------------------------------------------------------

--
-- Table structure for table `FAQ`
--

CREATE TABLE IF NOT EXISTS `FAQ` (
`id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FAQ`
--

INSERT INTO `FAQ` (`id`, `question`, `answer`) VALUES
(1, 'Where are you located?', 'Denmark.'),
(2, 'What if I am not satisfied with the product?', 'You get a 14-day money back guaranty with us if you are not satisfied with the product.');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
`id` int(11) NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `shape` enum('Circle','Rectangle','Square','Star','Cloud','Other') NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `material` varchar(200) NOT NULL,
  `offer` varchar(100) NOT NULL,
  `delivery_time_days` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` varchar(500) NOT NULL,
  `image` varchar(5000) NOT NULL,
  `colors` set('#e4e4e4','#AA9A8B','#86909E','#858380','#678091','#5C6275','#687482','#A68E87','#755D33','#A2A88B','#7C842C','#508C4B','#248D2B','#28937D','#1E8761','#414123','#369E8E','#30494C','#709994','#6EA8B3','#33859E','#6D8DBE','#437AC6','#2559B4','#0E6B9D','#10788E','#064666','#31426C','#948A8D','#AB97A1','#B07B95','#D0519F','#FC3881','#870D31','#7D2D75','#B6131F','#B83E42','#A78D40','#A97D28','#AF9A28','#D64219','#D53119','#937EA9','#9070AE','#633D98','#382C7D','#6A3925','#522931','#392928','#040208','#998D7C','#8D837A','#767474','#363533','#908A88','#695A53','#473632','#72131A','#55151B','#92897A') NOT NULL,
  `aki_date` date NOT NULL DEFAULT '2015-04-18',
  `aki_time` time NOT NULL DEFAULT '10:00:00',
  `aki_user` varchar(100) NOT NULL DEFAULT 'xen',
  `aki_edited` tinyint(1) NOT NULL DEFAULT '0',
  `aki_avail` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `cat_id`, `name`, `shape`, `featured`, `material`, `offer`, `delivery_time_days`, `description`, `price`, `image`, `colors`, `aki_date`, `aki_time`, `aki_user`, `aki_edited`, `aki_avail`) VALUES
(2, '2', 'Felt Balls', 'Circle', 1, '', '10%', '', 'Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym', '{"0":{"size":"100","weight":"1","amount":"299","currency":"USD","stock":"3"},"1":{"size":"150","weight":"1.2","amount":"399","currency":"USD","stock":"2"}}', 'screen-sho_397092299.png', '', '2015-04-06', '10:37:56', 'tika', 1, 1),
(3, '1', 'Special Balls', 'Rectangle', 1, 'Felt', '10%', '12-14', 'Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusymLorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym Lorep ipusym', '{"0":{"size":"4&#39;7","weight":"4","amount":"67","currency":"DKK","stock":"0"},"1":{"size":"4&#39;7","weight":"4","amount":"67","currency":"USD","stock":"0"}}', 'screen-sho_397092299.png', '#A68E87,#755D33,#D0519F,#FC3881', '2015-04-13', '03:07:30', 'tika', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
`id` int(11) NOT NULL,
  `trans_count` int(11) NOT NULL,
  `items` varchar(500) NOT NULL,
  `sales_amount` float(10,2) NOT NULL,
  `aki_date` date NOT NULL,
  `aki_time` time NOT NULL,
  `aki_user` varchar(100) NOT NULL,
  `aki_edited` tinyint(4) NOT NULL DEFAULT '0',
  `aki_avail` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `trans_count`, `items`, `sales_amount`, `aki_date`, `aki_time`, `aki_user`, `aki_edited`, `aki_avail`) VALUES
(1, 3, 'Tika (2), Bambi (1), Some Unlimited Item (7)', 3500.00, '2015-03-17', '08:33:03', 'eric', 0, 1),
(2, 2, 'Frank (2), Bambi (2)', 5000.00, '2015-03-18', '08:37:23', 'eric', 0, 1),
(3, 2, 'Bambi (1), Some Unlimited Item (1)', 1500.00, '2015-03-18', '08:37:50', 'eric', 0, 1),
(4, 2, 'Some Unlimited Item (1), Frank (2)', 2500.00, '2015-03-19', '08:47:43', 'eric', 0, 1),
(5, 4, 'Bambi (2), Some Unlimited Item (3), Frank (1), Troy (1)', 1000.00, '2015-03-19', '09:45:10', 'tika', 1, 0),
(6, 1, 'Some Unlimited Item (7)', 3500.00, '2015-03-19', '09:50:52', 'tika', 0, 1),
(7, 1, 'LÃ¸se kugler (1)', 2300.00, '2015-03-25', '08:05:33', 'tika', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
`id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `qty` int(5) NOT NULL,
  `price` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `aki_date` date NOT NULL,
  `aki_time` time NOT NULL,
  `aki_user` varchar(100) NOT NULL,
  `aki_edited` tinyint(1) NOT NULL DEFAULT '0',
  `aki_avail` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `sales_id`, `item_id`, `item_name`, `qty`, `price`, `discount`, `aki_date`, `aki_time`, `aki_user`, `aki_edited`, `aki_avail`) VALUES
(1, 1, 2, 'Tika', 33, 1000.00, 0.00, '2015-03-26', '10:39:12', 'tika', 1, 1),
(2, 1, 1, 'Bambi', 1, 1500.00, 0.00, '2015-03-17', '08:33:03', 'eric', 0, 0),
(3, 1, 3, 'Some Unlimited Item', 7, 0.00, 0.00, '2015-03-17', '08:33:03', 'eric', 0, 1),
(4, 2, 4, 'Frank', 2, 1000.00, 0.00, '2015-03-18', '08:37:23', 'eric', 0, 1),
(5, 2, 1, 'Bambi', 2, 1500.00, 0.00, '2015-03-18', '08:37:23', 'eric', 0, 1),
(6, 3, 1, 'Bambi', 1, 1500.00, 0.00, '2015-03-18', '08:37:50', 'eric', 0, 1),
(7, 3, 3, 'Some Unlimited Item', 1, 0.00, 0.00, '2015-03-18', '08:37:50', 'eric', 0, 1),
(8, 4, 3, 'Some Unlimited Item', 1, 500.00, 0.00, '2015-03-19', '08:47:43', 'eric', 0, 1),
(9, 4, 4, 'Frank', 2, 1000.00, 0.00, '2015-03-19', '08:47:43', 'eric', 0, 1),
(10, 5, 1, 'Bambi', 2, 1500.00, 0.00, '2015-03-19', '09:42:35', 'dakota', 0, 1),
(11, 5, 3, 'Some Unlimited Item', 3, 500.00, 0.00, '2015-03-19', '09:42:35', 'dakota', 0, 1),
(12, 5, 4, 'Frank', 1, 1000.00, 0.00, '2015-03-19', '09:42:35', 'dakota', 0, 1),
(13, 5, 5, 'Troy', 1, 1500.00, 0.00, '2015-03-19', '09:42:35', 'dakota', 0, 1),
(14, 6, 3, 'Some Unlimited Item', 7, 500.00, 0.00, '2015-03-19', '09:50:52', 'tika', 0, 1),
(15, 7, 1, 'LÃ¸se kugler', 1, 2300.00, 0.00, '2015-03-25', '08:05:33', 'tika', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'admin',
  `namespace` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `type`, `namespace`) VALUES
(1, 'eric', 'Eric Pennington', 'xen@somewhere.com', '2cfbca0640c14b5ad46a9819c8642683e115632c', 'admin', 'madeinnepal.dk'),
(4, 'tika', 'Tika Pahadi', 'tika@akitech.org\r\n', '2cfbca0640c14b5ad46a9819c8642683e115632c', 'admin', 'madeinnepal.dk'),
(5, 'dakota', 'Dakota Bankston', 'djhdjak@jhgdfaj.co', '2cfbca0640c14b5ad46a9819c8642683e115632c', 'admin', 'madeinnepal.dk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
 ADD PRIMARY KEY (`pseudo-title`);

--
-- Indexes for table `FAQ`
--
ALTER TABLE `FAQ`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `FAQ`
--
ALTER TABLE `FAQ`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
