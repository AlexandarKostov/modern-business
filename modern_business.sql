-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 01:13 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modern_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `ID` int(11) NOT NULL,
  `Option1` text COLLATE utf8_bin NOT NULL,
  `Option2` text COLLATE utf8_bin NOT NULL,
  `Option3` text COLLATE utf8_bin NOT NULL,
  `Option4` text COLLATE utf8_bin NOT NULL,
  `Option5` text COLLATE utf8_bin NOT NULL,
  `Option6` text COLLATE utf8_bin NOT NULL,
  `Option7` text COLLATE utf8_bin NOT NULL,
  `Option8` text COLLATE utf8_bin NOT NULL,
  `Option9` text COLLATE utf8_bin NOT NULL,
  `Option10` text COLLATE utf8_bin NOT NULL,
  `Option11` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`ID`, `Option1`, `Option2`, `Option3`, `Option4`, `Option5`, `Option6`, `Option7`, `Option8`, `Option9`, `Option10`, `Option11`) VALUES
(1, 'Our mission is to make building websites easier for everyone.', 'Start Bootstrap was built on the idea that quality, functional website templates and themes should be available to everyone. Use our open source, free products, or support us by purchasing one of our premium products or services.', 'Read our story', '600x400.png', 'Our founding', 'About - Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.\n\n', 'Growth & beyond\n', 'A - Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.\n\n', '600x400.png', 'Our team', 'Dedicated to quality and your success');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `ID` int(11) NOT NULL,
  `Option1` text COLLATE utf8_bin NOT NULL,
  `Option2` text COLLATE utf8_bin NOT NULL,
  `Option3` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`ID`, `Option1`, `Option2`, `Option3`) VALUES
(1, 'Contact', 'For press inquiries, email us at', 'press@domain.com');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `ID` int(11) NOT NULL,
  `Category` text COLLATE utf8_bin NOT NULL DEFAULT 'uncategorized'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`ID`, `Category`) VALUES
(1, 'uncategorized');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `BlogTitle` text COLLATE utf8_bin NOT NULL,
  `BlogDesc` varchar(255) COLLATE utf8_bin NOT NULL,
  `BlogContent` text COLLATE utf8_bin NOT NULL,
  `BlogCategory` int(11) NOT NULL DEFAULT 1,
  `BlogDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `BlogFeatured` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `ID` int(11) NOT NULL,
  `Option1` text COLLATE utf8_bin NOT NULL,
  `Option2` text COLLATE utf8_bin NOT NULL,
  `Option3` text COLLATE utf8_bin NOT NULL,
  `Option4` text COLLATE utf8_bin NOT NULL,
  `Option5` text COLLATE utf8_bin NOT NULL,
  `Option6` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`ID`, `Option1`, `Option2`, `Option3`, `Option4`, `Option5`, `Option6`) VALUES
(1, 'Frequently Asked Questions', 'How can we help you?', 'Website & Settings', 'Have more questions?', 'Contact us at', 'support@domain.com');

-- --------------------------------------------------------

--
-- Table structure for table `faq_item`
--

CREATE TABLE `faq_item` (
  `ID` int(11) NOT NULL,
  `FaqTitle` text COLLATE utf8_bin NOT NULL,
  `FaqAnswer` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `faq_item`
--

INSERT INTO `faq_item` (`ID`, `FaqTitle`, `FaqAnswer`) VALUES
(2, 'Lorem ipsum?', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. Wikipedia\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `ID` int(11) NOT NULL,
  `Option1` text COLLATE utf8_bin NOT NULL,
  `Option2` text COLLATE utf8_bin NOT NULL,
  `Option3` text COLLATE utf8_bin NOT NULL,
  `Option4` text COLLATE utf8_bin NOT NULL,
  `Option5` text COLLATE utf8_bin NOT NULL,
  `Option6` text COLLATE utf8_bin NOT NULL,
  `Option7` text COLLATE utf8_bin NOT NULL,
  `Option8` text COLLATE utf8_bin NOT NULL,
  `Option9` text COLLATE utf8_bin NOT NULL,
  `Option10` text COLLATE utf8_bin NOT NULL,
  `Option11` text COLLATE utf8_bin NOT NULL,
  `Option12` text COLLATE utf8_bin NOT NULL,
  `Option13` text COLLATE utf8_bin NOT NULL,
  `Option14` text COLLATE utf8_bin NOT NULL,
  `Option15` text COLLATE utf8_bin NOT NULL,
  `Option16` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`ID`, `Option1`, `Option2`, `Option3`, `Option4`, `Option5`, `Option6`, `Option7`, `Option8`, `Option9`, `Option10`, `Option11`, `Option12`, `Option13`, `Option14`, `Option15`, `Option16`) VALUES
(1, 'Accesco CMS template for modern businesses', 'Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit!', 'Get Started', 'Learn More', '600x400.png', 'A better way to start building.', 'Featured Title', 'Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.', 'Featured Title', 'Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.', 'Featured Title', 'Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.', 'Featured Title', 'Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.', 'From our blog', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque fugit ratione dicta mollitia. Officiis ad.');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `ID` tinyint(4) NOT NULL,
  `SendTo` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Login` int(11) NOT NULL DEFAULT 1,
  `Newsletter` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `User`, `Login`, `Newsletter`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `ID` int(11) NOT NULL,
  `Option1` text COLLATE utf8_bin NOT NULL,
  `Option2` text COLLATE utf8_bin NOT NULL,
  `Option3` text COLLATE utf8_bin NOT NULL,
  `Option4` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`ID`, `Option1`, `Option2`, `Option3`, `Option4`) VALUES
(1, 'Our Work', 'Company portfolio', 'Let\'s build something together!', 'Contact us');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_items`
--

CREATE TABLE `portfolio_items` (
  `ID` int(11) NOT NULL,
  `PortTitle` text COLLATE utf8_bin NOT NULL,
  `PortDesc` varchar(255) COLLATE utf8_bin NOT NULL,
  `PortContent` text COLLATE utf8_bin NOT NULL,
  `PortFeatured` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `ID` int(11) NOT NULL,
  `Option1` text COLLATE utf8_bin NOT NULL,
  `Option2` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`ID`, `Option1`, `Option2`) VALUES
(1, 'Pay as you grow', 'With our no hassle pricing plans');

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `ID` int(11) NOT NULL,
  `Mode` int(11) NOT NULL,
  `Information` text COLLATE utf8_bin NOT NULL DEFAULT 'N/A',
  `Logo` text COLLATE utf8_bin NOT NULL DEFAULT 'favicon.ico',
  `Title` text COLLATE utf8_bin NOT NULL DEFAULT 'Code4You',
  `FooterText` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`ID`, `Mode`, `Information`, `Logo`, `Title`, `FooterText`) VALUES
(1, 0, 'N/A', 'favicon.ico', 'Modern Business', 'Copyright © 2021 Accesco, All rights reserved!');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `IP` varchar(46) COLLATE utf8_bin NOT NULL,
  `Location` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `ID` int(11) NOT NULL,
  `Avatar` text COLLATE utf8_bin NOT NULL,
  `Name` text COLLATE utf8_bin NOT NULL,
  `Title` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`ID`, `Avatar`, `Name`, `Title`) VALUES
(1, 'gospodinot.jpg', 'Daniel Veselinov', 'CEO & Developer');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `ID` tinyint(4) NOT NULL,
  `Text` text COLLATE utf8_bin NOT NULL,
  `Name` mediumtext COLLATE utf8_bin NOT NULL,
  `Title` mediumtext COLLATE utf8_bin NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`ID`, `Text`, `Name`, `Title`) VALUES
(1, '\"Working with Accesco.co has saved me tons of development time when building new projects! Working with them just makes things easier!\"', 'Daniel Veselinov', 'CEO at Accesco.co');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `Joined` datetime NOT NULL DEFAULT current_timestamp(),
  `EMail` varchar(100) COLLATE utf8_bin NOT NULL,
  `Password` varchar(40) COLLATE utf8_bin NOT NULL,
  `Name` mediumtext COLLATE utf8_bin NOT NULL,
  `Phone` int(11) NOT NULL,
  `Gender` tinyint(4) NOT NULL,
  `Birthday` date NOT NULL,
  `Approved` tinyint(4) NOT NULL DEFAULT 0,
  `Admin` tinyint(4) NOT NULL DEFAULT 0,
  `Avatar` text COLLATE utf8_bin NOT NULL DEFAULT 'favicon.ico',
  `Deactivated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Joined`, `EMail`, `Password`, `Name`, `Phone`, `Gender`, `Birthday`, `Approved`, `Admin`, `Avatar`, `Deactivated`) VALUES
(1, '2021-11-30 13:08:26', 'admin@demo.com', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'Administrator', 70600600, 0, '2000-01-01', 1, 1, 'favicon.ico', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faq_item`
--
ALTER TABLE `faq_item`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq_item`
--
ALTER TABLE `faq_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
