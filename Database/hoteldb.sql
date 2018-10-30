-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2018 at 12:55 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aemail` varchar(20) NOT NULL,
  `apass` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aemail`, `apass`) VALUES
(1, 'grace@sunnybeach.com', 'e010fd1ce1acc173e3b4835b7635f8d4600d774869102adb5cb7b5d7895649ba');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `fid` tinyint(4) NOT NULL,
  `ftype` varchar(50) NOT NULL,
  `fdesc` varchar(220) NOT NULL,
  `fimage` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`fid`, `ftype`, `fdesc`, `fimage`) VALUES
(1, 'swimming pool', 'The swimming pool is open every day from: 06:00 – 22.00', 'images/swimmingpool.jpg'),
(2, 'parking', 'At Sunny Beach Hotel, a huge video-monitored car park is available for all hotel guests.', 'images/parking.jpg'),
(3, 'restaurant', 'Food and beverage is an important part of life. This is why we want each and every meal to be a culinary experience regardless if you are travelling or just popping in at a nearby hotel for breakfast,', 'images/restaurant.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `gid` int(11) NOT NULL,
  `gusername` varchar(20) NOT NULL,
  `gpass` varchar(128) DEFAULT NULL,
  `gname` varchar(15) DEFAULT NULL,
  `gemail` varchar(20) NOT NULL,
  `gphone` varchar(20) DEFAULT NULL,
  `gdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`gid`, `gusername`, `gpass`, `gname`, `gemail`, `gphone`, `gdate`) VALUES
(7, 'grace', '30f44a23710dbff7c9ea341526641ee578d3de2bcabc26ade4a7f7b64ddeb947', 'grace1', 'grace@sunnybeach.com', '884563466', '2018-03-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `rorderid` varchar(30) NOT NULL,
  `gid` int(11) NOT NULL,
  `roomtypeid` int(11) DEFAULT NULL,
  `orderdate` datetime DEFAULT NULL,
  `rdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `roomlimit`
--

CREATE TABLE `roomlimit` (
  `roomtypeid` int(11) NOT NULL,
  `limitnumber` int(11) DEFAULT NULL,
  `limitdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `roomrcount`
--

CREATE TABLE `roomrcount` (
  `roomtypeid` int(11) NOT NULL,
  `rcount` int(11) DEFAULT NULL,
  `rdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `roomtypeid` int(11) NOT NULL,
  `rname` varchar(50) NOT NULL,
  `rdesc` varchar(200) NOT NULL,
  `rimage` varchar(30) NOT NULL,
  `rprice` int(11) DEFAULT NULL,
  `rcount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`roomtypeid`, `rname`, `rdesc`, `rimage`, `rprice`, `rcount`) VALUES
(1, 'single room', 'You can relax and feel at home as all our single rooms are fitted with a spacious semi double bed. Some are also fitted with a desk.', 'images/singleroom.jpg', 65, 5),
(2, 'double room', 'Most suitable for couples and the size enables you to relax and feel at home.\r\nAll rooms are also fitted with a desk, a closet and a washlet.', 'images/doubleroom.jpg', 75, 5),
(3, 'twin room', 'Our twin rooms can accommodate up to two people in adjacent twin beds (90cm wide). ', 'images/twinroom.jpg', 86, 5),
(4, 'quad room', 'A combination of single and bunk beds along with en-suite bathroom, a secure safe and some with a great canal view make these the perfect rooms for groups of 4.Linen & towels included.', 'images/quadroom.jpg', 93, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`rorderid`,`rdate`),
  ADD KEY `gid` (`gid`),
  ADD KEY `roomtypeid` (`roomtypeid`);

--
-- Indexes for table `roomlimit`
--
ALTER TABLE `roomlimit`
  ADD PRIMARY KEY (`roomtypeid`,`limitdate`);

--
-- Indexes for table `roomrcount`
--
ALTER TABLE `roomrcount`
  ADD PRIMARY KEY (`roomtypeid`,`rdate`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`roomtypeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `fid` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `roomtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `guests` (`gid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`roomtypeid`) REFERENCES `roomtype` (`roomtypeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roomlimit`
--
ALTER TABLE `roomlimit`
  ADD CONSTRAINT `roomlimit_ibfk_1` FOREIGN KEY (`roomtypeid`) REFERENCES `roomtype` (`roomtypeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roomrcount`
--
ALTER TABLE `roomrcount`
  ADD CONSTRAINT `roomrcount_ibfk_1` FOREIGN KEY (`roomtypeid`) REFERENCES `roomtype` (`roomtypeid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
