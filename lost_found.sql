-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 07:33 PM
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
-- Database: `lost_found`

--

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--
-- Users Table
CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  -- email VARCHAR(100) NOT NULL UNIQUE,
 email VARCHAR(255),
    -- Allow only valid emails
    CONSTRAINT chk_valid_email
    CHECK (email REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'),
   phone CHAR(10) CHECK (phone REGEXP '^[6-9][0-9]{9}$'),
  --  `phone` varchar(15) DEFAULT NULL,
  user_type ENUM('Passenger', 'Staff') NOT NULL,
  -- CHECK (CHAR_LENGTH(phone) BETWEEN 10 AND 15),
  CHECK (user_type IN ('Passenger', 'Staff'))
);


-- Reported Items Table
CREATE TABLE reported_items (
  item_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  item_type VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  status ENUM('Lost', 'Found') NOT NULL,
  report_date DATE NOT NULL,
  location_found VARCHAR(100),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Matches Table
CREATE TABLE matches (
  match_id INT PRIMARY KEY AUTO_INCREMENT,
  lost_item_id INT,
  found_item_id INT,
  match_status ENUM('Pending', 'Confirmed', 'Rejected') NOT NULL DEFAULT 'Pending',
  FOREIGN KEY (lost_item_id) REFERENCES reported_items(item_id),
  FOREIGN KEY (found_item_id) REFERENCES reported_items(item_id)
);

-- Travel Info Table
CREATE TABLE travel_info (
  travel_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  flight_no VARCHAR(20) NOT NULL,
  airport_code VARCHAR(10) NOT NULL,
  dept_arrival_datetime DATETIME NOT NULL,
  seat_no VARCHAR(10),
  booking_ref VARCHAR(50),
  booking_status VARCHAR(20),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Trigger to prevent future dates in reported_items
-- DELIMITER $$
-- CREATE TRIGGER trg_check_report_date
-- BEFORE INSERT ON reported_items
-- FOR EACH ROW
-- BEGIN
--   IF NEW.report_date > CURDATE() THEN
--     SIGNAL SQLSTATE '45000'
--     SET MESSAGE_TEXT = 'Report date cannot be in the future.';
--     --  IF NEW.report_date < (CURDATE() - INTERVAL 30 DAY) THEN
--     -- SIGNAL SQLSTATE '45000'
--     -- SET MESSAGE_TEXT = 'Report date cannot be more than 30 days old.';
--       IF DATEDIFF(CURDATE(), NEW.report_date) > 30 THEN
--     SIGNAL SQLSTATE '45000'
--     SET MESSAGE_TEXT = 'Report date cannot be more than 30 days old.';
--   -- IF NEW.report_date < 01.01.2000 THEN
--   --   SIGNAL SQLSTATE '45000'
--   --   SET MESSAGE_TEXT = 'Report date cannot be less than 25 years back.';
--   END IF;
-- END$$
-- DELIMITER ;

DELIMITER $$

CREATE TRIGGER trg_check_report_date
BEFORE INSERT ON reported_items
FOR EACH ROW
BEGIN
  -- Prevent future dates
  IF NEW.report_date > CURDATE() THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Report date cannot be in the future.';
      END IF;

  -- Prevent dates more than 30 days old
  IF DATEDIFF(CURDATE(), NEW.report_date) > 7 THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Report date cannot be more than 7 days old.';
  END IF;

END$$

DELIMITER ;



--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `user_type`) VALUES
(1, 'Pratham', 'pa@gmail.com', '7979797979', 'Passenger'),
(2, 'Raju', 'raju@example.com', '9123456789', 'Passenger'),
(3, 'Ashia', 'sanvi@example.com', '9012345678', 'Staff'),
(4, 'Sanvi', 'ashia@example.com', '8899776655', 'Staff');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD KEY `lost_item_id` (`lost_item_id`),
  ADD KEY `found_item_id` (`found_item_id`);

--
-- Indexes for table `reported_items`
--
ALTER TABLE `reported_items`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `travel_info`
--
ALTER TABLE `travel_info`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reported_items`
--
ALTER TABLE `reported_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel_info`
--
ALTER TABLE `travel_info`
  MODIFY `travel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;




ALTER TABLE reported_items ADD item_photo VARCHAR(255);


--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
-- ALTER TABLE `matches`
--   ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`lost_item_id`) REFERENCES `reported_items` (`item_id`),
--   ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`found_item_id`) REFERENCES `reported_items` (`item_id`);

-- --
-- -- Constraints for table `reported_items`
-- --
-- ALTER TABLE `reported_items`
--   ADD CONSTRAINT `reported_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

-- --
-- -- Constraints for table `travel_info`
-- --
-- ALTER TABLE `travel_info`
--   ADD CONSTRAINT `travel_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
-- COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
