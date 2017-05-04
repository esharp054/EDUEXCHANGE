-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 07:08 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eduexchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'notes',
  `cover` varchar(128) DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uploader_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `stat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `type`, `cover`, `title`, `description`, `upload_date`, `viewDate`, `uploader_id`, `price`, `class`, `stat`) VALUES
(49, 'notes', '/assets/default_textbook.jpg', 'ArrayLists', 'Understanding the basics of an ArrayList', '2017-04-03 08:04:02', '2017-04-03 08:04:02', 22, 15, 'Java', 1),
(41, 'notes', '/assets/default_textbook.jpg', 'Converegnt plate bou', 'Types of boundries notes', '2017-02-09 11:31:19', '2017-02-09 11:31:19', 22, 10, 'Geology 1313', 1),
(56, 'notes', '/assets/default_textbook.jpg', 'Covalent Bonds', 'Chemistry notes from day 1', '2017-05-04 08:08:45', '2017-05-04 08:08:45', 4, 3, 'Chemistry', 1),
(32, 'notes', '/assets/default_textbook.jpg', 'Econ: Day 1', 'Notes covering the supply curve', '2017-01-03 18:12:11', '2017-01-03 18:12:11', 1, 10, 'Economics 1301', 0),
(33, 'notes', '/assets/default_textbook.jpg', 'Econ: Day 2', 'Notes covering the demand curve', '2017-01-07 20:17:10', '2017-01-07 20:17:10', 2, 15, 'Economics 1301', 1),
(34, 'notes', '/assets/default_textbook.jpg', 'Econ: Day 3', 'Supply intersecting demand and what that means', '2017-01-13 01:02:03', '2017-01-13 01:02:03', 3, 5, 'Economics 1301', 1),
(55, 'notes', '/assets/default_textbook.jpg', 'Eigenspaces, Eigenve', 'Chapter 9 notes', '2017-04-24 11:12:13', '2017-04-24 11:12:13', 13, 4, 'Linear Algebra', 1),
(47, 'notes', '/assets/default_textbook.jpg', 'Exam 3 review', 'Things to review', '2017-03-19 10:17:10', '2017-03-19 10:17:10', 14, 16, 'Anthropology', 1),
(44, 'notes', '/assets/default_textbook.jpg', 'Heap', 'Implementing and understanding a heap', '2017-02-27 23:59:59', '2017-02-27 23:59:59', 3, 6, 'Data structures', 1),
(40, 'notes', '/assets/default_textbook.jpg', 'Industrialization of', 'Industrialization cause and effects', '2017-02-05 03:44:55', '2017-02-05 03:44:55', 24, 20, 'Antropology', 1),
(51, 'notes', '/assets/default_textbook.jpg', 'Inheritance', 'When to use inheritance and when to implement', '2017-04-09 15:17:19', '2017-04-09 15:17:19', 21, 5, 'Java', 1),
(39, 'notes', '/assets/default_textbook.jpg', 'Introduction to sign', 'What each hand gesture means', '2017-01-24 09:10:10', '2017-01-24 09:10:10', 20, 25, 'American Sign Langua', 1),
(38, 'notes', '/assets/default_textbook.jpg', 'Limits Introduction', 'How and when to take the limit', '2017-01-23 16:17:01', '2017-01-23 16:17:01', 8, 10, 'Calculus 1337', 1),
(53, 'notes', '/assets/default_textbook.jpg', 'Mean, Median, Mode', 'Learning statistics to surivive Prof. Fontenots classes', '2017-04-17 20:17:17', '2017-04-17 20:17:17', 18, 9, 'Databases', 1),
(48, 'notes', '/assets/default_textbook.jpg', 'MOV + LDR', 'Learning assembly language', '2017-03-27 09:05:50', '2017-03-27 09:05:50', 17, 21, 'Assembly Language', 1),
(36, 'notes', '/assets/default_textbook.jpg', 'PHPmyAdmin', 'Notes on how to install and use phpmyadmin', '2017-01-19 07:45:46', '2017-01-19 07:45:46', 15, 1, 'Databases', 1),
(45, 'notes', '/assets/default_textbook.jpg', 'Python Basics', 'Learning python', '2017-03-03 17:17:17', '2017-03-03 17:17:17', 5, 1, 'Programming Language', 1),
(46, 'notes', '/assets/default_textbook.jpg', 'R', 'Downloading, installing, and programming in R', '2017-03-13 04:49:39', '2017-03-13 04:49:39', 16, 12, 'Databases', 1),
(43, 'notes', '/assets/default_textbook.jpg', 'REGEX', 'Understanding regular expressions', '2017-02-23 10:08:56', '2017-02-23 10:08:56', 9, 4, 'Programming Language', 1),
(42, 'notes', '/assets/default_textbook.jpg', 'ROI', 'Return on investment and its use', '2017-02-17 20:59:59', '2017-02-17 20:59:59', 13, 15, 'ACCT', 1),
(37, 'notes', '/assets/default_textbook.jpg', 'SLIM', 'How to install and use SLIM', '2017-01-20 23:23:23', '2017-01-20 23:23:23', 11, 11, 'Databases', 1),
(52, 'notes', '/assets/default_textbook.jpg', 'Threads', 'Avoiding race conditions and deadlocks', '2017-04-13 21:14:07', '2017-04-13 21:14:07', 14, 3, 'Programming Language', 1),
(35, 'notes', '/assets/default_textbook.jpg', 'Vagrant', 'Notes on how to install vagrant', '2017-01-16 05:39:25', '2017-01-16 05:39:25', 7, 50, 'Databases', 1),
(50, 'notes', '/assets/default_textbook.jpg', 'Vector', 'Understanding the basics of a Vector', '2017-04-08 07:07:25', '2017-04-08 07:07:25', 20, 10, 'C++', 1),
(54, 'notes', '/assets/default_textbook.jpg', 'Vector Addition', 'How to add vectors in physics', '2017-04-23 17:04:23', '2017-04-23 17:04:23', 17, 6, 'Physics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'supplies',
  `cover` text,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uploader_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `stat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `type`, `cover`, `title`, `description`, `upload_date`, `viewDate`, `uploader_id`, `price`, `class`, `stat`) VALUES
(5, 'supplies', '/assets/default_textbook.jpg', 'Binders', '5 Binders that are g', '2012-06-18 10:34:09', '2017-04-20 04:20:09', 5, 25, 'General', 1),
(3, 'supplies', '/assets/default_textbook.jpg', 'DLD board', 'Spartan board', '2012-06-18 10:34:09', '2017-04-20 04:20:09', 3, 75, 'DLD', 1),
(4, 'supplies', 'http://placehold.it/125x150', 'External hard drive', 'A hard drive to back', '2012-06-18 10:34:09', '2017-04-20 04:20:09', 1, 50, 'General', 1),
(2, 'supplies', '/assets/default_textbook.jpg', 'Macbook Pro', 'Newest Macbook pro, ', '2012-06-18 10:34:09', '2017-04-20 04:20:09', 2, 3000, 'General', 1),
(1, 'supplies', '/assets/default_textbook.jpg', 'TI84', 'TI84 from 2012, ok c', '2012-06-18 10:34:09', '2017-04-20 04:20:09', 1, 100, 'Math Classes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `textbooks`
--

CREATE TABLE `textbooks` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'textbook',
  `ibsn` int(11) DEFAULT NULL,
  `cover` text,
  `title` varchar(20) NOT NULL,
  `description` text,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uploader_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `stat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `textbooks`
--

INSERT INTO `textbooks` (`id`, `type`, `ibsn`, `cover`, `title`, `description`, `upload_date`, `viewDate`, `uploader_id`, `price`, `class`, `stat`) VALUES
(1, 'textbook', 564731, 'http://test.url', 'updated title', 'my database', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 1, 100, 'cse3381', 1),
(2, 'textbook', 112113114, NULL, 'Lookbook', 'A book for kid', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 7, 89, 'MATH229', 1),
(3, 'textbook', 7778899, 'http://placehold.it/125x150', '1984', 'a novel', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 9, 65, 'cse4340', 1),
(4, 'textbook', 332232326, NULL, 'Mockingbird', 'a bird', '2017-04-19 00:00:00', '2017-04-26 00:00:00', 66, 77, 'CSE8866', 1),
(5, 'textbook', 6556565, NULL, 'DB n points', 'slim', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 67, 76, 'CSE8888', 1),
(7, 'textbook', NULL, 'http://placehold.it/125x150', 'Textbook', 'ok', '2017-05-03 06:05:15', '2017-05-03 06:05:15', 1, 45, 'cse 3330', 1),
(8, 'textbook', NULL, 'http://placehold.it/125x150', 'test', 'This is a test to see if long descriptions will be accepted', '2017-05-03 06:06:34', '2017-05-03 06:06:34', 1, 20, 'CSE 3330', 1),
(9, 'textbook', NULL, 'http://placehold.it/125x150', 'New Listing', 'This is a test', '2017-05-03 17:45:03', '2017-05-03 17:45:03', 1, 45, 'Cse 4450', 0),
(10, 'textbook', NULL, 'http://placehold.it/125x150', 'Textbook', 'This is a test', '2017-05-03 18:28:29', '2017-05-03 18:28:29', 1, 45, 'cse 3330', 0),
(11, 'textbook', NULL, 'http://placehold.it/125x150', 'GUI Notes', 'GUI notes for class 1', '2017-05-03 18:30:05', '2017-05-03 18:30:05', 1, 3, 'CSE 3345', 0),
(12, 'textbook', NULL, 'http://www.bio-rad.com/webroot/web/images/lse/products/biotechnology_laboratory_textbook/category_feature/global/lse_cat_feat_gataca_txtbk_11-0689.jpg', 'cheme', 'chemestry textbooks', '2017-05-03 19:06:55', '2017-05-03 19:06:55', 1, 19, 'ch20', 0),
(13, 'textbook', NULL, 'https://s-media-cache-ak0.pinimg.com/736x/68/5d/61/685d61a47e631a12cef4156a62cf2557.jpg', 'math', 'This is my math book and the condition was perfect', '2017-05-03 19:21:42', '2017-05-03 19:21:42', 1, 15, 'Math3315', 0),
(14, 'textbook', NULL, 'http://i.walmartimages.com/i/p/09/78/06/18/69/0978061869008_500X500.jpg', 'History', 'Condition is fairly ok', '2017-05-03 19:36:40', '2017-05-03 19:36:40', 114, 9, 'History1000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(40) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `pass` char(64) NOT NULL,
  `avatar` text,
  `rating` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `joined_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `phone`, `pass`, `avatar`, `rating`, `userID`, `joined_date`, `username`) VALUES
('cjin@smu.edu', '4699946777', 'db4fb40a247dc1bc111f0dc9d84ed0e0', 'https://cdn0.iconfinder.com/data/icons/iconshock_guys/512/andrew.png', NULL, 1, NULL, 'Derek'),
('cjin23@smu.edu', '469994677789', 'f24b7c52b6ab0a0364c5888a4b57f681', NULL, NULL, 3, NULL, 'OK'),
('cjin45@smu.edu', '777777777', '3d801aa532c1cec3ee82d87a99fdf63f', 'https://www.google.com/imgres?imgurl=http%3A%2F%2Fendlesstheme.com%2Fsimplify1.0%2Fimages%2Fprofile%2Fprofile4.jpg&imgrefurl=http%3A%2F%2Fendlesstheme.com%2Fsimplify1.0%2Fwidget.html&docid=u_EzSpMskjuIrM&tbnid=UIFWdSKtprOD6M%3A&vet=10ahUKEwiMp7mPuM_TAhUB7IMKHfcwD5QQMwiMASggMCA..i&w=452&h=454&bih=826&biw=1440&q=user%20avatar&ved=0ahUKEwiMp7mPuM_TAhUB7IMKHfcwD5QQMwiMASggMCA&iact=mrc&uact=8', NULL, 5, NULL, 'temp'),
('rlonghirst0@smu.edu', '3259674273', 'aeLruOe', NULL, 1, 82, '2017-01-03 18:12:11', 'aparr0'),
('mporrett1@smu.edu', '1982024408', 'wh5QyNvpJzvj', NULL, 4, 83, '2017-01-07 20:17:10', 'ckeeler1'),
('dwoodyatt2@smu.edu', '9236784358', 'y4qw0Tfo', NULL, 4, 84, '2017-01-13 01:02:03', 'oponting2'),
('ngawne3@smu.edu', '6528603264', 'QEpY21JQOlC', NULL, 3, 85, '2017-01-16 05:39:25', 'ekrebs3'),
('pbrigshaw4@smu.edu', '7434384536', 'm8oZ1CYEreoY', NULL, 4, 86, '2017-01-19 07:45:46', 'dsondon4'),
('ibrownlee5@smu.edu', '8417415060', 'B0RaVHa1dBUk', NULL, 2, 87, '2017-01-20 23:23:23', 'oroll5'),
('jjime6@smu.edu', '4022029241', 'RILrQVYAo9BA', NULL, 1, 88, '2017-01-23 16:17:01', 'lmactrustie6'),
('dkainz7@smu.edu', '4176842373', 'o3UfMwbSB', NULL, 1, 89, '2017-01-24 09:10:10', 'bbollard7'),
('eskayman8@smu.edu', '2111816382', 'sUo9yGfVuO', NULL, 5, 90, '2017-02-05 03:44:55', 'bbarnwall8'),
('cbrolly9@smu.edu', '4634288548', 'TZYA0UzviIJM', NULL, 2, 91, '2017-02-09 11:31:19', 'gbyrcher9'),
('mlangfortha@smu.edu', '1746393815', 'jWjCVwziUj', NULL, 4, 92, '2017-02-17 20:59:59', 'tbalstona'),
('mshopcottb@smu.edu', '9178361811', 'T2U2zNVP', NULL, 5, 93, '2017-02-23 10:08:56', 'hmenearb'),
('mdrexelc@smu.edu', '5064824448', 'vLwFObCyf', NULL, 4, 94, '2017-02-27 23:59:59', 'jmenendesc'),
('mpaddemored@smu.edu', '9046816548', 'YZaX8lDWvD', NULL, 3, 95, '2017-03-03 17:17:17', 'bbotwrightd'),
('ssansome@smu.edu', '6198079315', '0NoDZ4kR50xu', NULL, 2, 96, '2017-03-13 04:49:39', 'rsoldnere'),
('bbindinf@smu.edu', '7002409861', 'qpVCGvW', NULL, 4, 97, '2017-03-19 10:17:10', 'ptabbf'),
('aarkowg@smu.edu', '5585633719', 'GYPgO1c7H', NULL, 1, 98, '2017-03-27 09:05:50', 'cpaulog'),
('ablesingh@smu.edu', '9895035520', '2FxFMeHgp', NULL, 4, 99, '2017-04-03 08:04:02', 'clemonnierh'),
('dbelvini@smu.edu', '2848993188', '4pCN3k', NULL, 4, 100, '2017-04-08 07:07:25', 'wphilcocki'),
('scastiglionej@smu.edu', '9384104559', 'ChUKGoh93i', NULL, 3, 101, '2017-04-09 15:17:19', 'nrozetj'),
('dbeatonk@smu.edu', '8886689619', 'xUw7tQCokF', NULL, 1, 102, '2017-04-13 21:14:07', 'psinkinsk'),
('tdenisyukl@smu.edu', '8669553664', 'LrcTYZF', NULL, 5, 103, '2017-04-17 20:17:17', 'mgallagerl'),
('gkaganm@smu.edu', '9438507875', 'bFKeaQJ', NULL, 4, 104, '2017-04-23 17:04:23', 'mniccollsm'),
('ikingen@smu.edu', '1734407625', '7g7ILzEjWDY1', NULL, 2, 105, '2017-04-24 11:12:13', 'cmcsauln'),
('nkeywoodo@smu.edu', '2317992469', '4vAVwza', NULL, 3, 106, '2017-05-04 08:08:45', 'dstortono'),
('12312ji@op.com', '123123123', 'db4fb40a247dc1bc111f0dc9d84ed0e0', NULL, NULL, 107, '2017-05-03 06:48:18', 'TAI'),
('12311232ji@op.com', '9090909090', 'db4fb40a247dc1bc111f0dc9d84ed0e0', NULL, NULL, 111, '2017-05-03 06:50:58', 'TAIi'),
('test@smu.edu', '3546575647', '3d801aa532c1cec3ee82d87a99fdf63f', NULL, NULL, 112, '2017-05-03 07:20:10', 'test'),
('tog@op.com', '9909012330', 'db4fb40a247dc1bc111f0dc9d84ed0e0', NULL, NULL, 114, '2017-05-03 07:20:55', 'Tog'),
('tog7@op.com', '99090123370', 'db4fb40a247dc1bc111f0dc9d84ed0e0', NULL, NULL, 116, '2017-05-03 07:25:48', 'Tog7'),
('test7@smu.edu', '1212121212', '3d801aa532c1cec3ee82d87a99fdf63f', NULL, NULL, 117, '2017-05-03 07:33:26', 'test7'),
('anfajk@gmail.com', '1111111111', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 118, '2017-05-03 20:04:56', 'tommy123'),
('jerryB@gmail.com', '3211234345', '3bcb59853bb75521993d3703a5946c08', NULL, NULL, 119, '2017-05-04 04:39:42', 'Jerry123'),
('jbar@smu.edu', '2131231111', '2cf032e1e94afd6331b12b052ac08313', NULL, NULL, 121, '2017-05-04 06:41:34', 'Jerry1234'),
('rrobin@smu.edu', '2312345678', 'ba6f6c1945b2cc32d0882d9b548376b8', NULL, NULL, 129, '2017-05-04 06:42:29', 'redrobin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`title`,`uploader_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`title`,`uploader_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `textbooks`
--
ALTER TABLE `textbooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `userID` (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `textbooks`
--
ALTER TABLE `textbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
