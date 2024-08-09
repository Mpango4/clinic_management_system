-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 11:40 AM
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
-- Database: `clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `mobileno` text NOT NULL,
  `addr` varchar(500) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `role_id` int(11) NOT NULL,
  `last_login` date NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `loginid`, `password`, `fname`, `lname`, `gender`, `dob`, `mobileno`, `addr`, `notes`, `image`, `created_on`, `updated_on`, `role_id`, `last_login`, `delete_status`) VALUES
(1, 'admin', 'jenifamsabaha9@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', 'Jennifer msabaha', 'admin', 'Male', '2018-11-26', '0754632706', '<p>Maharashtra, India</p>\r\n', '<p>admin panel</p>\r\n', 'profile.jpg', '2018-04-30', '2019-10-15', 1, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentid` int(10) NOT NULL,
  `appointmenttype` varchar(25) NOT NULL,
  `patientid` int(10) NOT NULL,
  `roomid` int(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `appointmentdate` date NOT NULL,
  `appointmenttime` time NOT NULL,
  `professional_id` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `app_reason` text NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentid`, `appointmenttype`, `patientid`, `roomid`, `departmentid`, `appointmentdate`, `appointmenttime`, `professional_id`, `status`, `app_reason`, `delete_status`) VALUES
(8, '', 2, 0, 1, '2024-06-08', '10:26:00', 1, 'Approved', 'hiiiiiiiii', 0),
(9, '', 1, 0, 1, '2024-06-20', '10:56:00', 2, 'Active', 'hello ', 0),
(11, '', 2, 0, 1, '2024-06-08', '12:03:00', 2, 'Approved', 'duuuh', 0),
(12, '', 2, 0, 1, '2024-06-08', '13:39:00', 1, 'Pending', 'thanks', 1),
(14, '', 2, 0, 1, '2024-06-08', '14:43:00', 1, 'Pending', 'SAWA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bedid` int(11) NOT NULL,
  `bed_no` varchar(50) NOT NULL,
  `ward_id` int(11) NOT NULL,
  `status` enum('Active','Inactive','Taken') NOT NULL,
  `delete_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`bedid`, `bed_no`, `ward_id`, `status`, `delete_status`) VALUES
(1, 'MNZ/MAT/0001', 2, 'Active', 1),
(2, 'KTV/MT/0002', 4, 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentid` int(10) NOT NULL,
  `departmentname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentid`, `departmentname`, `description`, `status`, `delete_status`) VALUES
(1, 'PEDIATRIC', 'For children', 'Active', 0),
(2, 'MATERNITY', 'for pregnant women', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_timings`
--

CREATE TABLE `doctor_timings` (
  `doctor_timings_id` int(10) NOT NULL,
  `doctorid` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `available_day` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor_timings`
--

INSERT INTO `doctor_timings` (`doctor_timings_id`, `doctorid`, `start_time`, `end_time`, `available_day`, `status`, `delete_status`) VALUES
(1, 1, '09:00:00', '12:00:00', '', 'Active', 0),
(2, 2, '10:31:00', '10:34:00', '', 'Inactive', 0);

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL,
  `business_name` varchar(600) NOT NULL,
  `business_email` varchar(600) NOT NULL,
  `business_web` varchar(500) NOT NULL,
  `portal_addr` varchar(500) NOT NULL,
  `addr` varchar(600) NOT NULL,
  `curr_sym` varchar(600) NOT NULL,
  `curr_position` varchar(500) NOT NULL,
  `front_end_en` varchar(500) NOT NULL,
  `date_format` date NOT NULL,
  `def_tax` varchar(500) NOT NULL,
  `logo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`id`, `business_name`, `business_email`, `business_web`, `portal_addr`, `addr`, `curr_sym`, `curr_position`, `front_end_en`, `date_format`, `def_tax`, `logo`) VALUES
(1, 'Mnazi Mmoja hospital', 'mayuri.infospace@gmail.com', 'www.mnazi_mmoja.com', 'P.O.Box 20, ILALA  DAR ES SALAAM', '<p>P.O.Box 20, ILALA DAR ES SALAAM</p>\r\n', 'Tzs', 'left', '1', '0000-00-00', '20000.00', 'www.png');

-- --------------------------------------------------------

--
-- Table structure for table `manage_websites`
--

CREATE TABLE `manage_websites` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footer` text NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_symbol` varchar(10) NOT NULL,
  `login_logo` varchar(255) NOT NULL,
  `invoice_logo` varchar(255) NOT NULL,
  `background_login_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineid` int(10) NOT NULL,
  `medicinename` varchar(25) NOT NULL,
  `medicinecost` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineid`, `medicinename`, `medicinecost`, `description`, `status`, `delete_status`) VALUES
(1, 'Paracetamol', 10.00, 'Medicine description here', 'Active', 0),
(2, 'pain killer', 0.00, 'nice', 'Active', 0),
(3, 'VITAMIN D', 0.00, 'bone health and immune function', 'Active', 0),
(4, 'Folic Acid', 0.00, 'preventing neural tube defects in the developing baby', 'Active', 0),
(5, 'IRON SUPPLEMENTS', 0.00, 'Treat anemia', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(10) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `admissiontime` time NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `patientname`, `admissiondate`, `admissiontime`, `address`, `mobileno`, `city`, `pincode`, `loginid`, `password`, `bloodgroup`, `gender`, `dob`, `status`, `delete_status`) VALUES
(1, 'groly', '2020-05-25', '11:00:00', 'DIT', '0632110780', 'Ilala', '1234', 'groly@gmail.com', 'bbcff4db4d8057800d59a68224efd87e545fa1512dfc3ef68298283fbb3b6358', 'B+', 'Female', '2002-07-25', 'Active', 1),
(2, 'Jenifa', '2024-06-07', '08:23:00', 'bibi titi 1202', '0623107804', 'ilala', '1111', 'jenifer@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', 'O-', 'Female', '2004-02-07', 'Active', 1),
(3, 'salma said', '2024-06-22', '07:41:00', 'DIT', '0632110786', 'Ilala', '1234', 'jenifa12@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', 'A+', 'Female', '2002-01-05', 'Active', 0),
(4, 'mama hellena', '2024-07-15', '22:55:00', '2958 mlele', '072310900', 'katavi', '1', 'mamahellena@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', '', 'Female', '2024-07-15', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(10) NOT NULL,
  `treatment_records_id` int(10) NOT NULL,
  `professional_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `prescription_date` date NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `unit` int(10) NOT NULL,
  `dosage` varchar(25) NOT NULL,
  `status` enum('active','fulfilled') NOT NULL DEFAULT 'active',
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `treatment_records_id`, `professional_id`, `patient_id`, `prescription_date`, `medicine_id`, `cost`, `unit`, `dosage`, `status`, `description`) VALUES
(1, 2, 2, 2, '2024-06-27', 2, 0.00, 100, '2 X 3', 'active', '<p>sawa</p>\r\n'),
(2, 1, 2, 1, '2024-06-22', 1, 0.00, 100, '2 X 3', 'active', '<p>keeep it in mind</p>\r\n'),
(3, 1, 2, 1, '2024-06-22', 2, 0.00, 100, '2 X 3', 'active', '<p>keeep it in mind</p>\r\n'),
(4, 1, 2, 2, '2024-06-22', 1, 0.00, 100, '2 X 3', 'active', '<p>hhi</p>\r\n'),
(5, 1, 1, 2, '2024-07-02', 1, 3.00, 10, '2 X 3', 'active', '<p>DEMO DEMO</p>\r\n'),
(6, 1, 1, 2, '2024-07-02', 2, 3.00, 10, '2 X 3', 'active', '<p>DEMO DEMO</p>\r\n'),
(7, 3, 1, 4, '2024-07-15', 3, 0.00, 3, '1/7', 'active', 'maintain dose'),
(8, 2, 1, 4, '2024-07-15', 1, 14.00, 3, '1/7', 'active', 'free'),
(9, 3, 1, 4, '2024-07-15', 3, 0.00, 3, '1/7', 'active', 'thanks'),
(10, 4, 3, 4, '2024-07-16', 5, 0.00, 3, '1/7', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `professional_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `department_id` int(11) NOT NULL,
  `login_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `consultancy_charge` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `delete_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`professional_id`, `name`, `mobile_no`, `department_id`, `login_id`, `password`, `profession`, `experience`, `consultancy_charge`, `status`, `delete_status`) VALUES
(1, 'mpango sogo', '0746428410', 2, 'mpangosogo@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', 'md', '1', '1000', 'Active', 1),
(2, 'Jenifar', '0675311008', 1, 'jeniffer01@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', 'nutrionalist consalitant', '2', '1000', 'Active', 1),
(3, 'MR. mwakilembe shady', '0678336622', 1, 'mwakilembeshady@gmail.com', '1511476083119948bd34613819d059087b6dcd2a82198b723ed5217d6c6dc31f', 'NUTRIONALST', '1', '0', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminder_id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `last_date` date NOT NULL,
  `next_date` date NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`reminder_id`, `patientid`, `last_date`, `next_date`, `status`) VALUES
(1, 1, '2024-06-25', '2024-08-03', 'Active'),
(2, 2, '2024-06-25', '2024-08-10', 'Inactive'),
(3, 3, '2024-06-25', '2024-06-25', 'Active'),
(4, 2, '2024-07-02', '2024-08-07', 'Active'),
(5, 4, '2024-07-15', '2024-07-15', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `professional_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `time_slot` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `professional_id`, `day_of_week`, `time_slot`) VALUES
(1, 1, 'Tuesday', '12:00:00'),
(7, 3, 'Friday', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `service_type_id` int(10) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `servicecharge` float(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`service_type_id`, `service_type`, `servicecharge`, `description`, `status`) VALUES
(10, 'X-ray', 250.00, 'To take fractured photo copy', 'Active'),
(11, 'Scanning', 450.00, 'To scan body from injury', 'Active'),
(12, 'MRI', 300.00, 'Regarding body scan', 'Active'),
(13, 'Blood Testing', 150.00, 'To detect the type of disease', 'Active'),
(14, 'Diagnosis', 210.00, 'To analyse the diagnosis', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `e_id` int(21) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mail_driver_host` varchar(5000) NOT NULL,
  `mail_port` int(50) NOT NULL,
  `mail_username` varchar(50) NOT NULL,
  `mail_password` varchar(30) NOT NULL,
  `mail_encrypt` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_email_config`
--

INSERT INTO `tbl_email_config` (`e_id`, `name`, `mail_driver_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encrypt`) VALUES
(1, 'tanzania', 'mail.upturnit.com', 587, 'jennifermsabaha@gmail.com', 'Jenife@1234', 'sdsad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission_role`
--

CREATE TABLE `tbl_permission_role` (
  `id` int(30) NOT NULL,
  `permission_id` int(30) NOT NULL,
  `role_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_permission_role`
--

INSERT INTO `tbl_permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 1),
(31, 31, 1),
(32, 32, 1),
(33, 33, 1),
(34, 34, 1),
(35, 35, 1),
(36, 36, 1),
(37, 37, 1),
(38, 38, 1),
(39, 39, 1),
(40, 40, 1),
(41, 41, 1),
(42, 42, 1),
(43, 43, 1),
(44, 44, 1),
(45, 1, 2),
(46, 2, 2),
(47, 6, 2),
(48, 9, 2),
(49, 12, 2),
(50, 17, 2),
(51, 35, 2),
(52, 39, 2),
(53, 40, 2),
(54, 41, 2),
(55, 42, 2),
(56, 43, 2),
(57, 44, 2),
(236, 34, 4),
(237, 1, 3),
(238, 2, 3),
(239, 3, 3),
(240, 4, 3),
(241, 5, 3),
(242, 6, 3),
(243, 7, 3),
(244, 8, 3),
(245, 9, 3),
(246, 10, 3),
(247, 13, 3),
(248, 14, 3),
(249, 17, 3),
(250, 18, 3),
(251, 26, 3),
(252, 27, 3),
(253, 28, 3),
(254, 29, 3),
(255, 34, 3),
(256, 35, 3),
(257, 36, 3),
(258, 37, 3),
(259, 38, 3),
(260, 39, 3),
(261, 40, 3),
(262, 41, 3),
(263, 42, 3),
(264, 43, 3),
(265, 44, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role_name`, `slug`, `delete_status`) VALUES
(1, 'Admin', 'admin', 0),
(2, 'client', 'client', 0),
(3, 'Technicians', 'technicians', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_config`
--

CREATE TABLE `tbl_sms_config` (
  `id` int(11) NOT NULL,
  `sms_username` varchar(200) NOT NULL,
  `sms_password` varchar(200) NOT NULL,
  `sms_senderid` varchar(200) NOT NULL,
  `created_at` date NOT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_sms_config`
--

INSERT INTO `tbl_sms_config` (`id`, `sms_username`, `sms_password`, `sms_senderid`, `created_at`, `delete_status`) VALUES
(1, 'nikhilbhalerao007', '123456789', 'UPTURN', '2019-10-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatmentid` int(11) NOT NULL,
  `treatmenttype` varchar(25) NOT NULL,
  `treatment_cost` decimal(10,2) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatmentid`, `treatmenttype`, `treatment_cost`, `note`, `status`, `delete_status`) VALUES
(1, 'Blood Test', 1000.00, 'Treatment note here', 'Active', 0),
(2, 'utra sound', 10000.00, 'available', 'Active', 0),
(3, 'PRENATAL CARE', 0.00, 'FOR FREE', 'Active', 1),
(4, 'VACCINATION', 0.00, 'FOR FREE', 'Active', 0),
(5, 'NUTRITIONAL COUNSELLING', 0.00, 'For free', 'Active', 0),
(6, 'EDUCATION AND COUNSELLING', 0.00, 'FREE', 'Active', 0),
(7, 'ADVICE ON EXERCISE AND LI', 0.00, 'FREE', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_record`
--

CREATE TABLE `treatment_record` (
  `recordid` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `professional_id` int(11) NOT NULL,
  `treatmentids` varchar(255) NOT NULL,
  `treatment_description` text NOT NULL,
  `treatment_date` date NOT NULL,
  `treatment_time` time NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment_record`
--

INSERT INTO `treatment_record` (`recordid`, `patientid`, `professional_id`, `treatmentids`, `treatment_description`, `treatment_date`, `treatment_time`, `status`) VALUES
(1, 2, 1, '1,2', '<p>1. weigth 60kg</p>\r\n\r\n<p>2. prgnancy length 20m</p>\r\n', '2024-06-08', '15:55:00', 'Active'),
(2, 2, 2, '2', '<p>okay</p>\r\n', '2024-06-22', '00:52:00', 'Active'),
(3, 4, 1, '5,7', 'balance diet ', '2024-07-15', '14:08:00', 'Active'),
(4, 4, 3, '3', '<p>weight, blood pressure&nbsp;</p>\r\n', '2024-07-16', '05:14:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `wardid` int(11) NOT NULL,
  `wardname` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive','Taken') DEFAULT 'Active',
  `delete_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`wardid`, `wardname`, `description`, `status`, `delete_status`) VALUES
(1, 'maternity ward', 'for pregnant women', 'Active', 1),
(2, 'pediatric ward', 'for pregnant women', 'Active', 0),
(3, 'pediatric ward', 'for children', 'Active', 1),
(4, 'Maternity ', 'for pregnancy women', 'Active', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentid`),
  ADD KEY `fk_constraint` (`professional_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bedid`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  ADD PRIMARY KEY (`doctor_timings_id`);

--
-- Indexes for table `manage_website`
--
ALTER TABLE `manage_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_websites`
--
ALTER TABLE `manage_websites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`),
  ADD KEY `loginid` (`loginid`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `treatment_records_id` (`treatment_records_id`),
  ADD KEY `professional_id` (`professional_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD PRIMARY KEY (`professional_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminder_id`),
  ADD KEY `patientid` (`patientid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `professional_id` (`professional_id`);

--
-- Indexes for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tbl_permission_role`
--
ALTER TABLE `tbl_permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms_config`
--
ALTER TABLE `tbl_sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatmentid`);

--
-- Indexes for table `treatment_record`
--
ALTER TABLE `treatment_record`
  ADD PRIMARY KEY (`recordid`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `professional_id` (`professional_id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`wardid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `bedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_timings`
--
ALTER TABLE `doctor_timings`
  MODIFY `doctor_timings_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manage_websites`
--
ALTER TABLE `manage_websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `professional_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `e_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_permission_role`
--
ALTER TABLE `tbl_permission_role`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sms_config`
--
ALTER TABLE `tbl_sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `treatment_record`
--
ALTER TABLE `treatment_record`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `wardid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_constraint` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`professional_id`);

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_ibfk_1` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`wardid`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`treatment_records_id`) REFERENCES `treatment_record` (`recordid`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`professional_id`),
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patientid`),
  ADD CONSTRAINT `prescription_ibfk_4` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicineid`);

--
-- Constraints for table `professionals`
--
ALTER TABLE `professionals`
  ADD CONSTRAINT `professionals_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`departmentid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`professional_id`);

--
-- Constraints for table `treatment_record`
--
ALTER TABLE `treatment_record`
  ADD CONSTRAINT `treatment_record_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`),
  ADD CONSTRAINT `treatment_record_ibfk_2` FOREIGN KEY (`professional_id`) REFERENCES `professionals` (`professional_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
