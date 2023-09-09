-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 03, 2023 at 04:40 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dek_equal_tani`
--

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

DROP TABLE IF EXISTS `child`;
CREATE TABLE `child` (
  `perid` bigint(20) NOT NULL COMMENT 'รหัสเด็ก',
  `chiphoto` varchar(20) DEFAULT NULL COMMENT 'รูปถ่ายเด็ก',
  `chiord` int(2) DEFAULT NULL COMMENT 'เป็นบุตรคนที่เท่าไหร่',
  `livewid` int(2) DEFAULT NULL COMMENT 'นักเรียนอาศัยอยู่กับใคร',
  `famsttid` int(2) DEFAULT NULL COMMENT 'รหัสสถานภาพครอบครัว',
  `distschkm` int(3) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ระยะทางกี่กิโลเมตรกี่เมตร)',
  `distschm` int(3) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ระยะทางกี่กิโลเมตรกี่เมตร)',
  `distschhrs` int(2) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ใช้เวลากี่ชั่วโมงกี่นาที)',
  `distschmin` int(2) DEFAULT NULL COMMENT 'การเดินทางจากที่พักอาศัยไปโรงเรียน (ใช้เวลากี่ชั่วโมงกี่นาที)',
  `farepay` int(4) DEFAULT NULL COMMENT 'ค่าใช้จ่ายในการเดินทางไป-กลับกี่บาท/เดือน',
  `schmethid` int(2) DEFAULT NULL COMMENT 'รหัสวิธีเดินทางหลัก',
  `chidetail` varchar(1000) DEFAULT NULL COMMENT 'รายละเอียดเชิงคุณภาพ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='ตารางเก็บข้อมูลเฉพาะเด็ก';

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`perid`, `chiphoto`, `chiord`, `livewid`, `famsttid`, `distschkm`, `distschm`, `distschhrs`, `distschmin`, `farepay`, `schmethid`, `chidetail`) VALUES
(1, 'รูป1.jpg', 1, 1, 1, 2, 500, 1, 30, 1500, 1, 'รายละเอียดเกี่ยวกับเด็ก 1.'),
(2, 'รูป2.jpg', 2, 1, 2, 1, 200, 0, 15, 800, 2, 'รายละเอียดเกี่ยวกับเด็ก 2.'),
(3, 'รูป3.jpg', 1, 2, 1, 3, 750, 1, 45, 2000, 3, 'รายละเอียดเกี่ยวกับเด็ก 3.'),
(4, 'รูป4.jpg', 2, 2, 3, 5, 1200, 2, 50, 2500, 1, 'รายละเอียดเกี่ยวกับเด็ก 4.'),
(5, 'รูป5.jpg', 3, 3, 1, 1, 200, 0, 10, 500, 2, 'รายละเอียดเกี่ยวกับเด็ก 5.'),
(37, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(38, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(39, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(40, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(41, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(42, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(43, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(44, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(45, NULL, 2, 3, 5, 2, 3, 4, 5, 2, 4, '1000'),
(46, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(47, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(48, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(49, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(50, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(51, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(52, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(53, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(54, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(55, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(56, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(57, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(58, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(59, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(60, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(61, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(62, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(63, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(64, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(65, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(66, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(67, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(68, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(69, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(70, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(71, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(72, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(73, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(74, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(75, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(76, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(77, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(78, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(79, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(80, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(81, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(82, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(83, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(84, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(85, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(86, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(87, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(88, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(89, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(90, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(91, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(92, NULL, 2, 3, 5, 2, NULL, NULL, NULL, 2, 4, NULL),
(93, NULL, 2, 3, 5, 2, 3, NULL, NULL, 2, 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`perid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
