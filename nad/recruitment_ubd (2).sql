-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 06:18 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recruitment_ubd`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_1` varchar(255) NOT NULL,
  `password_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`username`, `email`, `password_1`, `password_2`) VALUES
('Nadeeya', 'nadeeyanorjemee@gmail.com', '123456', '123456'),
('20b6001', 'Nadeeyanorjemee@gmail.com', '123456', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `applies`
--

CREATE TABLE `applies` (
  `jobName` varchar(60) NOT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `IC` varchar(255) NOT NULL,
  `Phone_No` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Id_Passport` varchar(255) NOT NULL,
  `Work_Experience` int(11) NOT NULL,
  `Level_Of_Education` varchar(255) NOT NULL,
  `Qualifications` varchar(255) NOT NULL,
  `School_Details` varchar(255) NOT NULL,
  `Other_Qualification` varchar(255) NOT NULL,
  `CV` varchar(255) NOT NULL,
  `Cover_Letter` varchar(255) NOT NULL,
  `Level_of_Education_Index` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `File_Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applies`
--

INSERT INTO `applies` (`jobName`, `Full_Name`, `Email_Address`, `IC`, `Phone_No`, `DOB`, `Gender`, `Nationality`, `Id_Passport`, `Work_Experience`, `Level_Of_Education`, `Qualifications`, `School_Details`, `Other_Qualification`, `CV`, `Cover_Letter`, `Level_of_Education_Index`, `Status`, `File_Location`) VALUES
('PHYSICS LECTURER', 'Nadeeya Norjemee', '20b6001@ubd.edu.bn', '01-123456', '+6738149056', '2022-04-18', 'female', 'bruneian', 'NadeeyaNorjemee Id_Passport.jpeg', 2, 'Diploma', 'NadeeyaNorjemee Qualification.pdf', 'NadeeyaNorjemee School Details.pdf', 'x', 'NadeeyaNorjemee CV.pdf', 'NadeeyaNorjemee Cover Letter.docx', 3, 'PENDING', './uploads/'),
('PHYSICS LECTURER', 'Amy', 'nadeeyanorjemee@gmail.com', '01-123477', '+6738149056', '2022-04-19', 'female', 'barbadian', 'Amy Id_Passport.jpeg', 5, 'PHD', 'Amy Qualification.pdf', 'Amy School Details.pdf', 'x', 'Amy CV.pdf', 'Amy Cover Letter.docx', 6, 'REVIEWED', './uploads/'),
('', 'Nadeeya Norjemee', 'nadeeyanorjemee@gmail.com', '01-123456', '+6738149056', '2022-04-13', 'female', 'bruneian', 'NadeeyaNorjemee Id_Passport.jpeg', 2, 'Degree', 'NadeeyaNorjemee Qualification.pdf', 'NadeeyaNorjemee School Details.pdf', 'x', 'NadeeyaNorjemee CV.docx', 'NadeeyaNorjemee Cover Letter.pdf', 4, 'PENDING', './uploads/'),
('', 'Nadeeya Norjemee', 'nadeeyanorjemee@gmail.com', '01-123456', '+6738149056', '2022-04-13', 'female', 'bruneian', 'NadeeyaNorjemee Id_Passport.jpeg', 2, 'Degree', 'NadeeyaNorjemee Qualification.pdf', 'NadeeyaNorjemee School Details.pdf', 'x', 'NadeeyaNorjemee CV.docx', 'NadeeyaNorjemee Cover Letter.pdf', 4, 'PENDING', './uploads/'),
('JANITOR', 'luqman', '20b2122@ubd.edu.bn', '01-123456', '+6738149056', '2022-04-19', 'female', 'bruneian', 'luqman Id_Passport.jpeg', 2, 'Diploma', 'luqman Qualification.pdf', 'luqman School Details.pdf', 'x', 'luqman CV.docx', 'luqman Cover Letter.pdf', 3, 'PENDING', './uploads/'),
('PHYSICS LECTURER', 'Nadeeya Norjemee', '20b2122@ubd.edu.bn', '01-123456', '+6738149056', '2022-04-22', 'female', 'belarusian', 'NadeeyaNorjemee Id_Passport.jpeg', 4, 'Degree', 'NadeeyaNorjemee Qualification.pdf', 'NadeeyaNorjemee School Details.pdf', 'x', 'NadeeyaNorjemee CV.pdf', 'NadeeyaNorjemee Cover Letter.pdf', 4, 'PENDING', './uploads/'),
('PHYSICS LECTURER', 'hakim', '20b6001@ubd.edu.bn', '01-123456', '+6738149056', '2022-04-14', 'female', 'batswana', 'hakim Id_Passport.pdf', 2, 'Diploma', 'hakim Qualification.pdf', 'hakim School Details.jpeg', 'x', 'hakim CV.pdf', 'hakim Cover Letter.jpeg', 3, 'PENDING', './uploads/');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `jobName` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `quota` int(11) NOT NULL,
  `jCategory` varchar(20) NOT NULL,
  `jType` varchar(20) NOT NULL,
  `salary` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `jDescription` varchar(1000) NOT NULL,
  `minQualification` varchar(255) NOT NULL,
  `numExperience` varchar(255) NOT NULL,
  `jRequirements` varchar(1000) NOT NULL,
  `closeDate` date NOT NULL,
  `minQualificationIndex` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jobName`, `department`, `quota`, `jCategory`, `jType`, `salary`, `startTime`, `endTime`, `jDescription`, `minQualification`, `numExperience`, `jRequirements`, `closeDate`, `minQualificationIndex`) VALUES
('PHYSICS LECTURER', 'FOS', 2, 'academic', 'fullTime', 50000, '08:00:00', '16:00:00', 'Plan and deliver the assigned modules.\r\nCarry out invigilation duties during examination period.\r\nProvide guidance to students in their learning as and when required.\r\nUpdate and facilitate the development of academic resources.\r\nInvolve in professional development trainings (Workshop, Seminars and Trainings).\r\nPerform the required administrative duties as and when necessary.\r\nConstantly thinking out of the box to provide an engaging and interactive teaching lessons for all students, always (both classroom and online teaching).', 'PHD', '3', 'At least a Bachelor’s Degree holder in the expertise / fields needed as listed above.\r\nA Master’s Degree is compulsory for candidates who are applying for Lecturer in Mathematics & Statistics, Physics and Sociology.\r\nQualified and possess prior experience in teaching programming related subjects.\r\nExperienced in both classroom and online teaching.\r\nCreative in coming up with interactive teaching methods for both classroom and online teaching.\r\nFluent in both English and Bahasa Malaysia (verbal and written).\r\nPassionate in teaching and educating students.\r\nA great team player.', '2022-04-22', 6),
('JANITOR', 'others', 2, 'nonAcademic', 'fullTime', 9600, '08:00:00', '16:00:00', 'Clean the interior of buildings including floors, carpet, rugs, windows and walls.\r\nDisinfect commonly used items like desks, door handles, office tools and phones.\r\nMaintain cleaning inventory, placing orders for new. products when needed.\r\nMaintain outdoor grounds, cut grass and trim bushes.\r\nRemove debris and snow from sidewalks.\r\nReplace air filters and maintain HVAC systems.\r\nEmpty trash and recycling bins.', 'Olevel', '0', 'Previous housekeeping experience preferred', '2022-04-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `recName` varchar(60) NOT NULL,
  `recEmail` varchar(100) NOT NULL,
  `jobName` varchar(60) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manages`
--

INSERT INTO `manages` (`recName`, `recEmail`, `jobName`, `department`) VALUES
('Nadeeya Norjemee', '20b6001@ubd.edu.bn', 'JANITOR', 'others'),
('Nadeeya Norjemee', '20b6001@ubd.edu.bn', 'PHYSICS LECTURER', 'FOS');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recruiter`
--

INSERT INTO `recruiter` (`Email`, `Password`, `Name`, `Department`) VALUES
('20b6001@ubd.edu.bn', '123456', 'Nadeeya', 'FOS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`department`,`jobName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
