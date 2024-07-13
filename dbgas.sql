-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: jul 08, 2024 at 09:42 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgas`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL);
--
-- Table structure for table `admins`
--
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL);
--
-- Table structure for table `guides`
--

CREATE TABLE guides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL);

--
-- Table structure for table `guide_allocation`


CREATE TABLE guide_allocations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_username VARCHAR(50) NOT NULL,
    guide_name VARCHAR(100) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    FOREIGN KEY (student_username) REFERENCES students(username)
);

CREATE TABLE student_dash_guides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
 
    total INT NOT NULL,
    allotted INT NOT NULL DEFAULT 0
);


CREATE TABLE students_groups (
    usn VARCHAR(10) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact VARCHAR(15),
    section VARCHAR(10)
);

CREATE TABLE requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guide_name VARCHAR(100),
    usn1 VARCHAR(10),
    usn2 VARCHAR(10),
    usn3 VARCHAR(10),
    usn4 VARCHAR(10),
    domain VARCHAR(100),
    project_title VARCHAR(200),
    consent_letter VARCHAR(255),
    FOREIGN KEY (usn1) REFERENCES students_groups(usn),
    FOREIGN KEY (usn2) REFERENCES students_groups(usn),
    FOREIGN KEY (usn3) REFERENCES students_groups(usn),
    FOREIGN KEY (usn4) REFERENCES students_groups(usn)
);

CREATE TABLE student_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guide_name VARCHAR(255) NOT NULL,
    usn1 VARCHAR(20) NOT NULL,
    name1 VARCHAR(255) NOT NULL,
    email1 VARCHAR(255) NOT NULL,
    contact1 VARCHAR(15) NOT NULL,
    section1 VARCHAR(10) NOT NULL,
    usn2 VARCHAR(20) NOT NULL,
    name2 VARCHAR(255) NOT NULL,
    email2 VARCHAR(255) NOT NULL,
    contact2 VARCHAR(15) NOT NULL,
    section2 VARCHAR(10) NOT NULL,
    usn3 VARCHAR(20) NOT NULL,
    name3 VARCHAR(255) NOT NULL,
    email3 VARCHAR(255) NOT NULL,
    contact3 VARCHAR(15) NOT NULL,
    section3 VARCHAR(10) NOT NULL,
    usn4 VARCHAR(20) NOT NULL,
    name4 VARCHAR(255) NOT NULL,
    email4 VARCHAR(255) NOT NULL,
    contact4 VARCHAR(15) NOT NULL,
    section4 VARCHAR(10) NOT NULL,
    domain VARCHAR(255) NOT NULL,
    project_title VARCHAR(255) NOT NULL,
    consent_letter VARCHAR(255) NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE guide_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guide_id INT,
    group_name VARCHAR(255),
    project_title VARCHAR(255),
    domain VARCHAR(100),
    name1 VARCHAR(100),
    usn1 VARCHAR(20),
    name2 VARCHAR(100),
    usn2 VARCHAR(20),
    name3 VARCHAR(100),
    usn3 VARCHAR(20),
    name4 VARCHAR(100),
    usn4 VARCHAR(20),
    consent_letter VARCHAR(255),
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guide_id) REFERENCES guides(id)
);


--
-- Dumping data for table `students`
--

INSERT INTO students (username, password) VALUES ('monisha', 'moni');
INSERT INTO students (username, password) VALUES ('nandini', 'nandu');
INSERT INTO students (username, password) VALUES ('raju', 'myt');
INSERT INTO students (username, password) VALUES ('bheem', 'strong');
INSERT INTO students (username, password) VALUES ('kaliya', 'dumma');

--
-- Dumping data for table `admins`
--

INSERT INTO admins (username, password) VALUES ('vinod', 'amvin');
INSERT INTO admins (username, password) VALUES ('admin2', 'password2');

--
-- Dumping data for table `guides`
--

INSERT INTO guides (username, password) VALUES ('guide1', 'password1');
INSERT INTO guides (username, password) VALUES ('guide2', 'password2');

--
-- Dumping data for table `guide_allocations`
--
INSERT INTO guide_allocations (student_username, guide_name, status) VALUES 
('monisha', 'Dr. Ramesh B', 'approved'),
('nandini', 'Mr. Madhu C K', 'pending'),
('raju', 'Mr. Vinod A M', 'rejected'),
('bheem', 'Mrs. Sunitha P', 'pending'),
('kaliya', 'Dr. Ramesh B', 'approved');

INSERT INTO student_dash_guides(name, total, allotted) VALUES
('Dr. Ramesh B', 2, 1),
('Mr. Madhu C K', 2, 0),
('Mr. Vinod A M',  2, 1),
('Mrs. Sunitha P',  1, 1),
('Mrs. Uma',  2, 1);




CREATE TABLE ad_allocation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guide_name VARCHAR(255) NOT NULL,
    slots INT NOT NULL
);
