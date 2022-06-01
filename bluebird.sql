-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2022 at 01:39 PM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salutation` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `zip` int(255) NOT NULL,
  `entrydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `salutation`, `suffix`, `addressline1`, `addressline2`, `region`, `brgy`, `zip`, `entrydate`) VALUES
(4, 'asdf', '889d3da25db57cfb9c1118472b198175', 'adf', 'adsf', 'asdf@123.com', '', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 0, '2022-05-26 10:01:24'),
(5, 'asd', '7815696ecbf1c96e6894b779456d330e', 'asdf', 'dsf', 'asdf@123.com', '', 'adf', 'adsf', 'asdf', 'asf', 'adf', 0, '2022-05-26 10:03:09'),
(8, 'asdfdaf', '05c12a287334386c94131ab8aa00d08a', 'asdf', 'dsf', 'asdf@123.com', '', 'adf', 'adsf', 'asdf', 'asf', 'adf', 0, '2022-05-26 10:04:36'),
(9, '123', '202cb962ac59075b964b07152d234b70', 'adsf', 'asdf', 'adsf@safdsddf.com', '', 'adsf', 'adsf', 'asdf', 'adsf', 'asdf', 0, '2022-05-26 10:09:58'),
(12, 'dany', '1b9fc02e98389d29c1506fe944b07d16', 'Daniel', 'En', 'dani@gmail.com', '', 'Jr', '0123 Bahay', 'sa tabi ng court', 'NCR', 'San Antonio', 1700, '2022-05-31 15:37:07'),
(13, '123dan', '202cb962ac59075b964b07152d234b70', 'asdf', 'asd', 'adsf@123.com', '', 'dsf', 'asdf', '', 'asdf', 'asdf', 0, '2022-05-31 16:55:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT,
   body TEXT,
   added_by VARCHAR(60),
   date_added DATETIME,
   deleted BOOLEAN,
   likes INT,
   PRIMARY KEY(id)
);

CREATE TABLE post_comments(
     id INT NOT NULL AUTO_INCREMENT,
    body TEXT,
    posted_by VARCHAR(60),
    posted_to VARCHAR(60),
   date_added DATETIME,
   post_id INT,
   PRIMARY KEY(id)
);

CREATE TABLE likes(
    id INT NOT NULL AUTO_INCREMENT,
   username VARCHAR(60),
   post_id INT,
   PRIMARY KEY(id)
);