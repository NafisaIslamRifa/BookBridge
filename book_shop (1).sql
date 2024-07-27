-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 11:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_book`
--

CREATE TABLE `academic_book` (
  `ac_book_id` int(11) NOT NULL,
  `ac_Book_Title` varchar(255) NOT NULL,
  `ac_Publication_Year` date DEFAULT NULL,
  `ac_Book_Price` decimal(10,2) NOT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Author_Id` int(11) DEFAULT NULL,
  `ac_Book_Image` varchar(255) NOT NULL,
  `Admin_ID` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_book`
--

INSERT INTO `academic_book` (`ac_book_id`, `ac_Book_Title`, `ac_Publication_Year`, `ac_Book_Price`, `Department`, `Author_Id`, `ac_Book_Image`, `Admin_ID`) VALUES
(45, 'wefsdf', '2023-12-14', 34.00, 'EEE', 1016, 'WhatsApp Image 2023-12-12 at 7.28.52 PM.jpeg', 1),
(765, 'sdfdsf', '2023-12-14', 345.00, 'EEE', 1016, 'WhatsApp Image 2023-12-12 at 7.25.06 PM (4).jpeg', 1),
(4564, 'sdvds', '2023-12-11', 234.00, 'BBA', 2020, 'WhatsApp Image 2023-12-12 at 7.25.08 PM (1).jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL DEFAULT 1,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Name`, `Email`, `Phone`, `Password`) VALUES
(1, 'nasif', 'nasif@gmail.com', '12345678', '9807');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `Author_Id` int(11) NOT NULL,
  `Author_Name` varchar(255) DEFAULT NULL,
  `Biography` text DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `Admin_ID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`Author_Id`, `Author_Name`, `Biography`, `image`, `Admin_ID`) VALUES
(1016, 'কাজী নজরুল ইসলাম', 'কাজী নজরুল ইসলাম (২৪ মে[টীকা ১][১] ১৮৯৯ – ২৯ আগস্ট ১৯৭৬; ১১ জ্যৈষ্ঠ ১৩০৬ – ১২ ভাদ্র ১৩৮৩ বঙ্গাব্দ) বিংশ শতাব্দীর প্রধান বাঙালি কবি ও সঙ্গীতকার। তার মাত্র ২৩ বছরের সাহিত্যিক জীবনে সৃষ্টির যে প্রাচুর্য তা তুলনারহিত। সাহিত্যের নানা শাখায় বিচরণ করলেও তার প্রধান পরিচয় তিনি কবি।  তার জীবন শুরু হয়েছিল অকিঞ্চিতকর পরিবেশে। স্কুলের গণ্ডি পার হওয়ার আগেই ১৯১৭ খ্রিষ্টাব্দে তিনি ব্রিটিশ ভারতীয় সেনাবাহিনীতে যোগ দিয়েছিলেন। মুসলিম পরিবারের সন্তান এবং শৈশবে ইসলামী শিক্ষায় দীক্ষিত হয়েও তিনি বড় হয়েছিলেন একটি ধর্মনিরপেক্ষ সত্তা নিয়ে। একই সঙ্গে তার মধ্যে বিকশিত হয়েছিল একটি বিদ্রোহী সত্তা। ১৯২২ খ্রিস্টাব্দে ব্রিটিশ সরকার তাকে রাজ্যদ্রোহিতার অপরাধে কারাবন্দী করেছিল। তিনি ব্রিটিশ সাম্রাজ্যের অধীন অবিভক্ত ভারতের বিদ্রোহী কবি হিসেবে পরিচিত হয়েছিলেন।  যে নজরুল সুগঠিত দেহ, অপরিমেয় স্বাস্থ্য ও প্রাণখোলা হাসির জন্য বিখ্যাত ছিলেন, ১৯৪২ খ্রিষ্টাব্দে তিনি মারাত্মকভাবে স্নায়বিক অসুস্থতায় আক্রান্ত হয়ে পড়লে আকস্মিকভাবে তার সকল সক্রিয়তার অবসান হয়। ফলে ১৯৭৬ খ্রিষ্টাব্দে মৃত্যু অবধি সুদীর্ঘ ৩৪ বছর তাকে সাহিত্যকর্ম থেকে সম্পূর্ণ বিচ্ছিন্ন থাকতে হয়। বাংলাদেশ সরকারের প্রযোজনায় ১৯৭২ খ্রিষ্টাব্দে তাকে সপরিবারে কলকাতা থেকে ঢাকা স্থানান্তর করা হয়। ১৯৭৬ সালে তাকে বাংলাদেশের জাতীয়তা প্রদান করা হয়। এখানেই তিনি মৃত্যুবরণ করেন।[৩]  বিংশ শতাব্দীর বাঙালির মননে কাজী নজরুল ইসলামের মর্যাদা ও গুরুত্ব অপরিসীম। বাংলাদেশে তাকে “জাতীয় কবি“ হিসাবে মর্যাদা দেওয়া হয়। তার কবিতা ও গানের জনপ্রিয়তা বাংলাভাষী পাঠকের মধ্যে তুঙ্গস্পর্শী। তার মানবিকতা, ঔপনিবেশিক শোষণ ও বঞ্চনার বিরুদ্ধে দ্রোহ, ধর্মীয়গোঁড়ামির বিরুদ্ধতা বোধ এবং নারী-পুরুষের সমতার বন্দনা গত প্রায় একশত বছর যাবৎ বাঙালির মানসপীঠ গঠনে ভূমিকা রেখে চলেছে।', 'WhatsApp Image 2023-12-12 at 4.54.05 PM.jpeg', 1),
(2020, 'satyajit roy', 'কাজী নজরুল ইসলাম (২৪ মে[টীকা ১][১] ১৮৯৯ – ২৯ আগস্ট ১৯৭৬; ১১ জ্যৈষ্ঠ ১৩০৬ – ১২ ভাদ্র ১৩৮৩ বঙ্গাব্দ) বিংশ শতাব্দীর প্রধান বাঙালি কবি ও সঙ্গীতকার। তার মাত্র ২৩ বছরের সাহিত্যিক জীবনে সৃষ্টির যে প্রাচুর্য তা তুলনারহিত। সাহিত্যের নানা শাখায় বিচরণ করলেও তার প্রধান পরিচয় তিনি কবি।  তার জীবন শুরু হয়েছিল অকিঞ্চিতকর পরিবেশে। স্কুলের গণ্ডি পার হওয়ার আগেই ১৯১৭ খ্রিষ্টাব্দে তিনি ব্রিটিশ ভারতীয় সেনাবাহিনীতে যোগ দিয়েছিলেন। মুসলিম পরিবারের সন্তান এবং শৈশবে ইসলামী শিক্ষায় দীক্ষিত হয়েও তিনি বড় হয়েছিলেন একটি ধর্মনিরপেক্ষ সত্তা নিয়ে। একই সঙ্গে তার মধ্যে বিকশিত হয়েছিল একটি বিদ্রোহী সত্তা। ১৯২২ খ্রিস্টাব্দে ব্রিটিশ সরকার তাকে রাজ্যদ্রোহিতার অপরাধে কারাবন্দী করেছিল। তিনি ব্রিটিশ সাম্রাজ্যের অধীন অবিভক্ত ভারতের বিদ্রোহী কবি হিসেবে পরিচিত হয়েছিলেন।  যে নজরুল সুগঠিত দেহ, অপরিমেয় স্বাস্থ্য ও প্রাণখোলা হাসির জন্য বিখ্যাত ছিলেন, ১৯৪২ খ্রিষ্টাব্দে তিনি মারাত্মকভাবে স্নায়বিক অসুস্থতায় আক্রান্ত হয়ে পড়লে আকস্মিকভাবে তার সকল সক্রিয়তার অবসান হয়। ফলে ১৯৭৬ খ্রিষ্টাব্দে মৃত্যু অবধি সুদীর্ঘ ৩৪ বছর তাকে সাহিত্যকর্ম থেকে সম্পূর্ণ ', 'WhatsApp Image 2023-12-12 at 4.54.05 PM.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Book_Id` int(11) NOT NULL,
  `Book_Title` varchar(255) DEFAULT NULL,
  `Publication_Year` date DEFAULT NULL,
  `Book_Price` decimal(10,2) DEFAULT NULL,
  `Author_Id` int(11) DEFAULT NULL,
  `Book_Image` varchar(255) DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_Id`, `Book_Title`, `Publication_Year`, `Book_Price`, `Author_Id`, `Book_Image`, `Admin_ID`) VALUES
(2016, 'বিষের বাঁশী', '2020-12-14', 172.00, 1016, 'WhatsApp Image 2023-12-12 at 7.25.07 PM (1).jpeg', 1),
(2020, 'নতুন চাঁদ', '2020-12-15', 80.00, 1016, 'WhatsApp Image 2023-12-12 at 7.25.07 PM.jpeg', 1),
(2030, 'সোনার কেল্লা', '2021-12-14', 270.00, 1017, 'WhatsApp Image 2023-12-12 at 7.25.07 PM (2).jpeg', 1),
(2040, 'adventure of faluda', '2021-12-14', 320.00, 1017, 'WhatsApp Image 2023-12-12 at 7.25.08 PM (1).jpeg', 1),
(2089, 'The Merchant of Venice', '2022-12-21', 270.00, 1017, 'WhatsApp Image 2023-12-12 at 7.25.06 PM (4).jpeg', 1),
(3020, 'আজ আমি কোথাও যাব না', '2015-11-28', 224.00, 1015, 'WhatsApp Image 2023-12-12 at 7.28.52 PM.jpeg', 1),
(3209, 'কোথাও কেউ নেই', '2018-11-26', 312.00, 1025, 'WhatsApp Image 2023-12-12 at 7.32.20 PM.jpeg', 1),
(32000, 'Othello', '2023-12-13', 113.00, 1019, 'WhatsApp Image 2023-12-12 at 7.44.17 PM.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Name` varchar(255) DEFAULT NULL,
  `Customer_Email` varchar(255) DEFAULT NULL,
  `Customer_password` varchar(15) DEFAULT NULL,
  `Phone_No` varchar(15) DEFAULT NULL,
  `Address` varchar(15) DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_Name`, `Customer_Email`, `Customer_password`, `Phone_No`, `Address`, `Admin_ID`) VALUES
(1, 'nasif', 'nasif@gmail.com', '9807', NULL, NULL, 1),
(208, 'hossain', 'hossain@gmail.com', '12345', '12345', 'dfgt', 1),
(209, 'rakib', 'rakib@gmail.com', '9090', '012345678', 'satkania', 1),
(210, 'nafisa', 'nafisa@gmail.com', '1234', '234324', 'dhaka', 1),
(211, 'Tamim ', 'tamim@gmail.com', '6789', '12345678878', 'Dhaka', 1),
(212, 'Mahmud', 'mahmud@gmail.com', '4567', '123456778', 'Chittagong', 1),
(213, 'Rupom', 'rupom@gmail.com', '5678', '123456789', 'Rajshahi', 1),
(214, 'Virat', 'virat@gmail.com', '1235', '213456789', 'Khulna', 1),
(215, 'Andrew', 'andrew@gmail.com', '4568', '12345678', 'mumbai', 1),
(216, 'Allen', 'allen@gmail.com', '4567', '12345678', 'New York', 1),
(217, 'John', 'john@gmail.com', '4567', '12345678', 'Mumbai', 1),
(218, 'Gerorge', 'george@gmail.com', '4890', '23456789', 'New York', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_num` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `customer_id`, `customer_name`, `customer_email`, `customer_num`, `message`, `Admin_ID`) VALUES
(6, 210, 'nafisa', 'nafisa@gmail.com', '34324324', 'i can\'t make my payment complete. please solve this problem', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Order_Date` date DEFAULT NULL,
  `Customer_Name` varchar(250) NOT NULL,
  `number` int(18) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `Total_Amount` decimal(10,2) DEFAULT NULL,
  `Booklist` varchar(255) DEFAULT NULL,
  `No_of_order` int(11) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Customer_ID`, `Order_Date`, `Customer_Name`, `number`, `email`, `address`, `Total_Amount`, `Booklist`, `No_of_order`, `payment_status`, `Admin_ID`) VALUES
(27, 212, '2023-12-26', 'Mahmud', 235346536, 'mahmud@gmail.com', 'Chittagong, ctg, ctg, Bangladesh - 1545', 999.99, 'The Merchant of Venice (1 x .TK270.00), নতুন চাঁদ (1 x .TK80.00), কোথাও কেউ নেই (1 x .TK312.00), সোনার কেল্লা (1 x .TK270.00), Othello (1 x .TK113.00)', 1, 'completed', 1),
(28, 211, '2023-12-14', 'Tamim ', 432565, 'tamim@gmail.com', 'esgfsdgfs, sffdgfdg, sadgfdsg, bangladesh - 2345', 932.00, 'নতুন চাঁদ (1 x .TK80.00), কোথাও কেউ নেই (1 x .TK312.00), সোনার কেল্লা (1 x .TK270.00), The Merchant of Venice (1 x .TK270.00)', 2, 'completed', 1),
(29, 211, '2023-12-07', 'Tamim ', 265436456, 'tamim@gmail.com', 'AFDFDS, DSFDSFDSF, SDFDSFDSF, MUMBAI - 2543536', 703.00, 'adventure of faluda (1 x .TK320.00), সোনার কেল্লা (1 x .TK270.00), Othello (1 x .TK113.00)', 2, 'completed', 1),
(30, 211, '2023-12-23', 'Tamim ', 23545435, 'tamim@gmail.com', 'AFDFDS, DSFDSFDSF, SDFDSFDSF, MUMBAI - 2543536', 1317.00, 'নতুন চাঁদ (1 x .TK80.00), বিষের বাঁশী (1 x .TK172.00), কোথাও কেউ নেই (1 x .TK312.00), Othello (1 x .TK113.00), adventure of faluda (2 x .TK320.00)', 4, 'completed', 1),
(31, 209, '2023-12-19', 'rakib', 123456, 'rakib@gmail.com', 'satkania, sds, 465ry76, Bangladesh - 12321', 1722.00, 'সোনার কেল্লা (1 x .TK270.00), বিষের বাঁশী (1 x .TK172.00), adventure of faluda (4 x .TK320.00)', 8, NULL, 1),
(32, 209, '2023-12-06', 'rakib', 123456, 'rakib@gmail.com', 'satkania, sds, 465ry76, Bangladesh - 12321', 806.00, 'The Merchant of Venice (1 x .TK270.00), আজ আমি কোথাও যাব না (1 x .TK224.00), কোথাও কেউ নেই (1 x .TK312.00)', 2, 'completed', 1),
(34, 209, '2023-12-25', 'sahruk khan', 324324, 'sahrukkhan@gmail.com', 'mumbai, sdvf, vfvf, Bangladesh - 123', 569.00, 'sdfdsf (1 x .TK345.00), আজ আমি কোথাও যাব না (1 x .TK224.00)', 2, 'completed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `Add_to_Cart_ID` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Image_URL` varchar(255) DEFAULT NULL,
  `product_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_book`
--
ALTER TABLE `academic_book`
  ADD PRIMARY KEY (`ac_book_id`),
  ADD KEY `ac_authorid` (`Author_Id`),
  ADD KEY `ac_adminid` (`Admin_ID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`Author_Id`),
  ADD KEY `admin_fk_author` (`Admin_ID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_Id`),
  ADD KEY `author_fk_book` (`Author_Id`),
  ADD KEY `admin_fk_book` (`Admin_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD KEY `admin_fk_cus` (`Admin_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `cus_fk_mes` (`customer_id`),
  ADD KEY `admin_fk_msg` (`Admin_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `cus_fk_order` (`Customer_ID`),
  ADD KEY `admin_fk_orders` (`Admin_ID`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`Add_to_Cart_ID`),
  ADD KEY `cus_fk_shop` (`Customer_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `Add_to_Cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_book`
--
ALTER TABLE `academic_book`
  ADD CONSTRAINT `ac_adminid` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `ac_authorid` FOREIGN KEY (`Author_Id`) REFERENCES `author` (`Author_Id`);

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `admin_fk_author` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `admin_fk_book` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `admin_fk_cus` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `admin_fk_msg` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `admin_fk_orders` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
