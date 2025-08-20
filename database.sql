CREATE DATABASE `rocksure_db`;

USE `rocksure_db`;

CREATE TABLE `operators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `shift` enum('A','B','C') NOT NULL,
  `equipment_type` varchar(255) NOT NULL,
  `license_class` varchar(255) NOT NULL,
  `license_permit_issue_date` date NOT NULL,
  `license_permit_expiry_date` date NOT NULL,
  `mincom_certified` tinyint(1) NOT NULL DEFAULT 0,
  `mincom_registered` tinyint(1) NOT NULL DEFAULT 0,
  `mincom_issue_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
