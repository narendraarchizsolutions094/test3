-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2021 at 04:06 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smd`
--

-- --------------------------------------------------------

--
-- Table structure for table `allleads`
--

CREATE TABLE `allleads` (
  `lid` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `lead_code` varchar(50) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ld_email` varchar(100) NOT NULL,
  `ld_name` varchar(100) NOT NULL,
  `ld_mobile` varchar(20) NOT NULL,
  `ld_status` int(11) NOT NULL,
  `ld_source` varchar(100) NOT NULL,
  `ld_for` text,
  `lead_score` varchar(100) NOT NULL,
  `lead_stage` varchar(15) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `requirements` varchar(200) NOT NULL,
  `opportunity_size` varchar(200) NOT NULL,
  `expected_date` datetime NOT NULL,
  `drop_status` int(11) NOT NULL,
  `drop_reason` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `assign_to` varchar(100) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_for_boq` int(11) NOT NULL COMMENT 'user_id',
  `ld_created` varchar(200) NOT NULL,
  `create_by` int(11) NOT NULL,
  `update_date` varchar(150) NOT NULL,
  `update_by` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '1',
  `child_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `all_modules`
--

CREATE TABLE `all_modules` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_modules`
--

INSERT INTO `all_modules` (`id`, `title`, `status`, `sort_order`, `created_date`, `updated_date`) VALUES
(1, 'Location Settings', 1, 1, '2020-02-25 00:00:00', '2020-11-06 14:10:51'),
(3, 'Sales Settings', 1, 5, '2020-02-25 00:00:00', '2020-11-06 14:06:13'),
(5, 'Api Configuration', 1, 10, '2020-02-25 00:00:00', '2020-11-06 14:06:18'),
(6, 'Enquiry', 1, 15, '2020-02-25 00:00:00', '2020-11-06 14:06:22'),
(7, 'Lead', 1, 20, '2020-02-25 00:00:00', '2020-11-06 14:06:26'),
(8, 'Client', 1, 25, '2020-02-25 00:00:00', '2020-11-06 14:06:31'),
(9, 'Task', 1, 30, '2020-02-25 00:00:00', '2020-11-06 14:06:36'),
(12, 'Reports', 1, 35, '2020-02-25 00:00:00', '2020-11-06 14:06:42'),
(13, 'User Management', 1, 40, '2020-02-25 00:00:00', '2020-11-06 14:06:47'),
(14, ' User Rights', 1, 45, '2020-02-25 00:00:00', '2020-11-06 14:06:51'),
(15, 'Company Profile', 0, 50, '2020-02-25 00:00:00', '2020-11-06 14:06:59'),
(17, 'Knowledge Base', 1, 200, '2020-02-25 00:00:00', '2020-11-06 15:23:31'),
(18, 'Invoice', 1, 205, '2020-02-25 00:00:00', '2020-11-06 15:23:37'),
(19, 'Language Settings', 1, 55, '2020-02-25 00:00:00', '2020-11-06 14:07:46'),
(20, 'Attendance Management', 1, 60, '2020-02-25 00:00:00', '2020-11-06 14:07:50'),
(21, 'Target And Forecasting', 1, 210, '2020-02-25 00:00:00', '2020-11-06 15:23:47'),
(22, 'Telephony Integration', 1, 215, '2020-02-25 00:00:00', '2020-11-06 19:14:56'),
(23, 'Process', 1, 65, '2020-02-25 00:00:00', '2020-11-06 14:07:56'),
(24, 'Institute', 1, 106, '2020-03-11 17:31:12', '2020-11-06 15:19:13'),
(25, 'Target Setting', 0, 220, '2020-03-13 00:00:00', '2020-11-06 15:24:03'),
(26, 'Forecast Setting', 0, 225, '2020-03-13 00:00:00', '2020-11-06 15:24:09'),
(27, 'Multiple process', 1, 270, '2020-03-13 00:00:00', '2020-12-15 15:40:38'),
(29, 'Chats', 1, 70, '2020-05-11 11:23:13', '2020-11-06 14:08:08'),
(30, 'Inventory', 1, 100, '2020-05-11 11:23:13', '2020-11-06 14:09:51'),
(31, 'Ticket', 1, 75, '2020-05-11 11:23:13', '2020-11-06 14:08:14'),
(33, 'Website', 0, 230, '2020-06-02 19:00:51', '2020-11-06 15:24:20'),
(34, 'Profile', 1, 105, '2020-06-02 22:41:31', '2020-11-06 15:19:06'),
(35, 'Course', 1, 104, '2020-06-03 19:08:18', '2020-11-06 15:18:59'),
(36, 'Schedule', 0, 235, '2020-06-08 00:00:00', '2020-11-06 15:24:26'),
(37, 'Appointment', 0, 240, '2020-06-08 00:00:00', '2020-11-06 15:24:30'),
(38, 'Search Program', 1, 101, '2020-06-15 15:50:32', '2020-11-06 15:18:16'),
(40, 'My Applications', 1, 103, '2020-06-15 15:51:17', '2020-11-06 15:18:52'),
(41, 'Meeting Room', 0, 245, '2020-06-15 15:51:37', '2020-11-06 15:24:34'),
(42, 'My Applicants', 1, 102, '2020-06-15 15:51:54', '2020-11-06 15:18:41'),
(43, 'Telephony Call Reports', 0, 250, '2020-07-22 12:42:34', '2020-11-06 15:24:41'),
(44, 'Ecommerce modules', 1, 80, '2020-07-22 12:42:34', '2020-11-06 14:08:28'),
(45, 'Number masking', 0, 255, '2020-07-22 12:42:34', '2020-12-21 20:50:25'),
(46, 'Orders', 1, 85, '2020-07-22 12:42:34', '2020-11-06 14:08:37'),
(47, 'Products', 1, 90, '2020-07-22 12:42:34', '2020-11-06 14:08:45'),
(48, 'Buy', 1, 95, '2020-07-22 12:42:34', '2020-11-06 14:08:49'),
(49, 'Website Builder', 1, 260, '2020-07-22 12:42:34', '2020-11-06 15:24:58'),
(50, 'Enquiry/Lead/Client Export Data', 0, 265, '2020-07-22 12:42:34', '2020-11-06 15:25:05'),
(51, 'CRM Rules', 1, 6, '2020-02-25 00:00:00', '2020-11-06 14:06:13'),
(52, 'Ticket Setting', 1, 76, '2020-11-06 17:54:33', '2020-11-06 00:00:00'),
(53, 'Holiday Setting', 1, 77, '2020-11-06 17:54:33', '2020-11-06 00:00:00'),
(54, 'Dashboard', 1, 0, '2020-02-25 00:00:00', '2020-11-06 14:10:51'),
(100, 'Deals', 1, NULL, '2020-12-22 13:39:10', NULL),
(101, 'Contacts', 1, NULL, '2020-12-22 13:39:10', NULL),
(102, 'Visits', 1, NULL, '2020-12-22 15:41:39', NULL),
(103, 'Agreement', 1, NULL, '2020-12-22 16:23:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `api_integration`
--

CREATE TABLE `api_integration` (
  `api_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `api_name` varchar(250) NOT NULL,
  `api_key` varchar(250) NOT NULL,
  `key_moblie` varchar(15) DEFAULT NULL,
  `key_messgae` varchar(20) DEFAULT NULL,
  `api_url` varchar(250) DEFAULT NULL,
  `api_type` varchar(50) DEFAULT NULL,
  `api_addby` int(11) DEFAULT NULL,
  `api_for` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_responses`
--

CREATE TABLE `api_responses` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `res` text NOT NULL,
  `endpoint` varchar(10000) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_templates`
--

CREATE TABLE `api_templates` (
  `temp_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `template_name` varchar(100) NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `mail_subject` varchar(100) NOT NULL,
  `template_content` text NOT NULL,
  `response_type` int(11) NOT NULL DEFAULT '0' COMMENT '1=normal,2=auto',
  `auto_mail_for` int(11) NOT NULL DEFAULT '0' COMMENT '1=enquiry,2=customeWLCM,3=CP',
  `temp_addby` int(11) NOT NULL,
  `temp_for` int(11) NOT NULL COMMENT '1=whatsapp,2=sms,3=email',
  `stage` text,
  `process` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `scope` int(11) DEFAULT NULL COMMENT '1=internal, 2=exteral',
  `status` int(11) NOT NULL COMMENT '1=active,2=inactive',
  `description` text NOT NULL,
  `attachment` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `basic_fields`
--

CREATE TABLE `basic_fields` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `field_for` int(11) DEFAULT NULL,
  `fld_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basic_fields`
--

INSERT INTO `basic_fields` (`id`, `type`, `title`, `field_for`, `fld_order`) VALUES
(1, 1, 'First Name', 0, 0),
(2, 1, 'Last Name', 0, 0),
(3, 3, 'Gender', 0, 0),
(4, 1, 'Mobile', 0, 0),
(5, 12, 'Email', 0, 0),
(6, 1, 'Company', 0, 0),
(7, 2, 'Lead Source', 0, 0),
(8, 2, 'Product', 0, 0),
(9, 2, 'State', 0, 0),
(10, 2, 'City', 0, 0),
(11, 5, 'Address', 0, 0),
(12, 5, 'Remark', 0, 0),
(13, 2, 'Preferred Country', 0, 0),
(14, 1, 'Pin code', 0, 0),
(15, 3, 'Complaint Type', 2, 0),
(16, 2, 'Referred By', 2, 0),
(17, 2, 'Problem For', 2, 0),
(18, 1, 'Name', 2, 0),
(19, 1, 'Phone', 2, 0),
(20, 12, 'Email', 2, 0),
(21, 2, 'Product', 2, 0),
(22, 2, 'Problem', 2, 0),
(23, 2, 'Nature of Complaint', 2, 0),
(24, 2, 'Priority', 2, 0),
(25, 2, 'Source', 2, 0),
(26, 8, 'Attachment', 2, 0),
(27, 5, 'Description', 2, 0),
(28, 1, 'Tracking Number', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_status` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(15) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `receiver_id` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `attachment_name` varchar(100) NOT NULL,
  `file_ext` varchar(100) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `message_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `companey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `cli_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `customer_code` varchar(50) NOT NULL,
  `cl_name` varchar(100) NOT NULL,
  `cl_email` varchar(100) NOT NULL,
  `cl_mobile` bigint(20) NOT NULL,
  `address` text,
  `country_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `territory_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `created_date` varchar(20) NOT NULL,
  `create_by` int(11) NOT NULL,
  `updated_date` varchar(15) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `installer_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `cl_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commercial_info`
--

CREATE TABLE `commercial_info` (
  `id` int(11) NOT NULL,
  `enquiry_id` bigint(10) NOT NULL,
  `branch_type` int(11) NOT NULL,
  `booking_type` tinyint(4) NOT NULL COMMENT 'sundry=>0, ftl=>1',
  `business_type` tinyint(4) NOT NULL COMMENT 'Inward=>0,outward=>1',
  `booking_branch` int(11) NOT NULL,
  `delivery_branch` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `insurance` int(11) NOT NULL COMMENT 'carrier=>0,owner risk=>1',
  `paymode` int(11) DEFAULT NULL,
  `potential_tonnage` float NOT NULL,
  `potential_amount` float NOT NULL,
  `expected_tonnage` float NOT NULL,
  `expected_amount` float NOT NULL,
  `vehicle_type` text,
  `carrying_capacity` text,
  `invoice_value` text,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` datetime DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `comp_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-Done,0-Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `custom_sms_info`
--

CREATE TABLE `custom_sms_info` (
  `custom_sms_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `reciver` varchar(100) NOT NULL,
  `gateway` text NOT NULL,
  `message` text NOT NULL,
  `sms_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `czentrix`
--

CREATE TABLE `czentrix` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `res` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_connections`
--

CREATE TABLE `db_connections` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `sub_domain` varchar(50) NOT NULL,
  `DbName` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(10) NOT NULL,
  `ord_id` int(10) NOT NULL,
  `ord_no` varchar(100) NOT NULL,
  `ord_prdby_id` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `tot_price` decimal(10,0) NOT NULL,
  `ofr_price` int(10) NOT NULL,
  `tot_qty` int(10) NOT NULL,
  `delv_qty` int(10) NOT NULL,
  `pending_qty` int(10) DEFAULT NULL,
  `deliver_by` varchar(10) NOT NULL,
  `added_by` int(10) NOT NULL,
  `remark` text NOT NULL,
  `status` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `pending_deliver` date NOT NULL,
  `cust_id` int(10) NOT NULL,
  `company` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dprt_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_integration`
--

CREATE TABLE `email_integration` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `name` varchar(250) NOT NULL,
  `protocol` varchar(250) NOT NULL,
  `smtp_host` varchar(150) NOT NULL,
  `smtp_port` int(20) NOT NULL,
  `smtp_timeout` int(11) NOT NULL,
  `smtp_user` varchar(100) NOT NULL,
  `smtp_pass` varchar(100) NOT NULL,
  `from_email` varchar(111) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `Enquery_id` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `other_phone` varchar(500) DEFAULT NULL,
  `name_prefix` varchar(34) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `gender` char(1) DEFAULT '',
  `reference_type` char(1) DEFAULT '',
  `reference_name` varchar(100) DEFAULT '',
  `enquiry` text,
  `org_name` varchar(200) NOT NULL,
  `enquiry_source` int(11) DEFAULT NULL,
  `enquiry_subsource` varchar(10) DEFAULT NULL,
  `sub_source` int(100) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `drop_status` int(11) DEFAULT '0',
  `drop_reason` text,
  `country_id` varchar(15) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `datasource_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `aasign_to` int(11) DEFAULT NULL,
  `assign_by` int(11) DEFAULT NULL,
  `checked` char(1) DEFAULT '1',
  `checked_by` int(11) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `lead_score` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `lead_stage` int(11) DEFAULT '0',
  `lead_discription` varchar(10) DEFAULT NULL,
  `lead_discription_reamrk` text,
  `lead_comment` text,
  `lead_expected_date` datetime DEFAULT NULL,
  `lead_created_date` datetime DEFAULT NULL,
  `lead_updated_date` datetime DEFAULT NULL,
  `lead_drop_status` char(1) DEFAULT '0',
  `lead_drop_reason` text,
  `client_created_date` datetime DEFAULT NULL,
  `client_drop_status` char(1) DEFAULT '0',
  `client_drop_reason` varchar(255) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city_id` varchar(10) DEFAULT NULL,
  `state_id` varchar(15) DEFAULT NULL,
  `territory_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `pin_code` varchar(11) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '1',
  `qr_code_id` int(11) DEFAULT NULL,
  `partner_id` varchar(10000) DEFAULT NULL,
  `rule_executed` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `enquiry`
--
DELIMITER $$
CREATE TRIGGER `enquiry_delete` AFTER DELETE ON `enquiry` FOR EACH ROW BEGIN
DELETE FROM extra_enquery WHERE extra_enquery.enq_no = OLD.Enquery_id;
DELETE FROM query_response WHERE query_response.query_id = OLD.Enquery_id;
DELETE FROM tbl_comment WHERE tbl_comment.lead_id = OLD.Enquery_id;
DELETE FROM paisa_expo_enquiry_meta WHERE paisa_expo_enquiry_meta.enquiry_code = OLD.Enquery_id;
DELETE FROM tbl_newdeal WHERE tbl_newdeal.enq_id = OLD.Enquery_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry2`
--

CREATE TABLE `enquiry2` (
  `enquiry_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `Enquery_id` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name_prefix` varchar(34) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `enquiry` text,
  `op_size` int(11) DEFAULT NULL,
  `enquiry_source` int(11) NOT NULL,
  `enquiry_subsource` int(11) NOT NULL,
  `checked` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `user_role` varchar(100) DEFAULT NULL,
  `checked_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `address` text,
  `enquiry_cust_type` varchar(50) DEFAULT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `drop_status` int(11) DEFAULT '0',
  `drop_reason` text,
  `country_id` varchar(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `territory_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pin_code` varchar(6) DEFAULT NULL,
  `requirement` varchar(34) DEFAULT NULL,
  `customer_type` int(11) DEFAULT NULL,
  `channel_partnr_type` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `datasource_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_date` varchar(20) DEFAULT NULL,
  `aasign_to` int(11) DEFAULT NULL,
  `assign_by` int(11) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '1',
  `other_no` varchar(255) NOT NULL,
  `other_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_fileds_basic`
--

CREATE TABLE `enquiry_fileds_basic` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `process_id` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `fld_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extra_enquery`
--

CREATE TABLE `extra_enquery` (
  `id` int(10) NOT NULL,
  `enq_no` varchar(100) NOT NULL,
  `parent` int(10) NOT NULL,
  `input` int(10) NOT NULL,
  `fvalue` text NOT NULL,
  `cmp_no` int(11) NOT NULL,
  `usrno` int(10) NOT NULL,
  `status` int(100) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fb_from_details`
--

CREATE TABLE `fb_from_details` (
  `id` int(11) NOT NULL,
  `from_id` varchar(200) NOT NULL,
  `from_name` varchar(200) NOT NULL,
  `compaign_name` varchar(200) NOT NULL,
  `add_set_name` varchar(200) NOT NULL,
  `add_name` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_dtae` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fb_page`
--

CREATE TABLE `fb_page` (
  `id` int(11) NOT NULL,
  `page_id` text NOT NULL,
  `page_token` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fb_setting`
--

CREATE TABLE `fb_setting` (
  `id` int(11) NOT NULL,
  `response` text NOT NULL,
  `is_status` int(11) NOT NULL DEFAULT '0',
  `s` int(11) NOT NULL DEFAULT '0',
  `r` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `gc_no` varchar(20) NOT NULL,
  `feedback` text NOT NULL,
  `comp_id` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `feedback_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` int(11) NOT NULL,
  `lead_pass_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `festivals`
--

CREATE TABLE `festivals` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `festival_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `comp_id` text NOT NULL,
  `title` varchar(30) NOT NULL,
  `process_id` varchar(30) NOT NULL,
  `is_query_type` int(11) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `is_edit` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `form_type` int(11) NOT NULL,
  `form_for` int(11) DEFAULT NULL COMMENT '0=Sales,1=Product,2=ticket',
  `primary_tab` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `forms`
--
DELIMITER $$
CREATE TRIGGER `tab_delete` AFTER DELETE ON `forms` FOR EACH ROW BEGIN 
DELETE FROM tbl_input where form_id=OLD.id; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `form_process`
--

CREATE TABLE `form_process` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `process_id` varchar(1000) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_rules`
--

CREATE TABLE `form_rules` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `rules` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `festival` int(11) NOT NULL,
  `dateto` date NOT NULL,
  `datefrom` date DEFAULT NULL,
  `country` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `indiamart_api`
--

CREATE TABLE `indiamart_api` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `endpoint` varchar(10000) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `api_key` varchar(1000) NOT NULL,
  `api_call_interval` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `input_types`
--

CREATE TABLE `input_types` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `input_types`
--

INSERT INTO `input_types` (`id`, `title`) VALUES
(1, 'Text'),
(2, 'Dropdown'),
(3, 'Radio'),
(4, 'CheckBox'),
(5, 'Textarea'),
(6, 'Date'),
(7, 'Time'),
(8, 'File'),
(9, 'password'),
(10, 'color'),
(11, 'datetime-local	'),
(12, 'email'),
(13, 'month'),
(14, 'number'),
(15, 'url'),
(16, 'week'),
(17, 'search'),
(18, 'tel'),
(19, 'Section'),
(20, 'Dropdown Multiselect'),
(21, 'Star Rating');

-- --------------------------------------------------------

--
-- Table structure for table `institute_app_status`
--

CREATE TABLE `institute_app_status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institute_data`
--

CREATE TABLE `institute_data` (
  `id` int(11) NOT NULL,
  `institute_id` int(255) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL,
  `p_disc` varchar(20) DEFAULT NULL,
  `p_lvl` varchar(100) DEFAULT NULL,
  `p_length` varchar(100) DEFAULT NULL,
  `t_fee` varchar(100) DEFAULT NULL,
  `ol_fee` varchar(100) DEFAULT NULL,
  `enquery_code` varchar(150) DEFAULT NULL,
  `application_url` varchar(255) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `app_status` varchar(150) DEFAULT NULL,
  `app_fee` varchar(150) DEFAULT NULL,
  `transcript` varchar(150) DEFAULT NULL,
  `lors` varchar(150) DEFAULT NULL,
  `sop` varchar(150) DEFAULT NULL,
  `cv` varchar(150) DEFAULT NULL,
  `gre_gmt` varchar(150) DEFAULT NULL,
  `toefl` varchar(150) DEFAULT NULL,
  `remark` varchar(150) DEFAULT NULL,
  `followup_comment` varchar(150) DEFAULT NULL,
  `ref_no` varchar(150) DEFAULT NULL,
  `courier_status` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `invoice_code` varchar(100) NOT NULL,
  `related_to` int(11) NOT NULL,
  `enquiry_code` varchar(100) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `note` text NOT NULL,
  `total_amount` float NOT NULL,
  `total_discount_amount` float NOT NULL,
  `total_gst_amount` float NOT NULL,
  `net_payable` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `gst` varchar(250) NOT NULL,
  `gst_amount` int(100) NOT NULL,
  `net_payable` float NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) UNSIGNED NOT NULL,
  `comp_id` int(20) DEFAULT '0',
  `phrase` text NOT NULL,
  `english` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `comp_id`, `phrase`, `english`) VALUES
(1, 0, 'email', 'Email Address'),
(2, 0, 'password', 'Password'),
(3, 0, 'login', 'Log In'),
(4, 0, 'incorrect_email_password', 'Incorrect Email/Password!'),
(5, 0, 'user_role', 'User Role'),
(6, 0, 'please_login', 'Please Log In'),
(7, 0, 'setting', 'Master Setup'),
(8, 0, 'profile', 'Profile'),
(9, 0, 'logout', 'Log Out'),
(10, 0, 'please_try_again', 'Please Try Again'),
(11, 0, 'admin', 'Admin'),
(12, 0, 'doctor', 'Company'),
(13, 0, 'representative', 'Representative'),
(14, 0, 'dashboard', 'Dashboard'),
(15, 0, 'User_mgment', 'User Management'),
(16, 0, 'add_department', 'Add Department'),
(17, 0, 'user_list', 'User List'),
(18, 0, 'add_doctor', 'Add Company'),
(19, 0, 'doctor_list', 'Company List'),
(20, 0, 'add_representative', 'Add Representative'),
(21, 0, 'representative_list', 'Representative List'),
(22, 0, 'patient', 'Patient'),
(23, 0, 'add_patient', 'Add Patient'),
(24, 0, 'patient_list', 'Patient List'),
(25, 0, 'schedule', 'Add Schedule'),
(26, 0, 'add_schedule', 'Add Schedule'),
(27, 0, 'schedule_list', 'Schedule List'),
(28, 0, 'appointment', 'Appointment'),
(29, 0, 'add_appointment', 'Add Appointment'),
(30, 0, 'appointment_list', 'Appointment List'),
(31, 0, 'enquiry', 'Enquiry'),
(32, 0, 'language_setting', 'Language Setting'),
(33, 0, 'appointment_report', 'Appointment Report'),
(34, 0, 'assign_by_all', 'Assign by All'),
(35, 0, 'assign_by_doctor', 'Assign by Doctor'),
(36, 0, 'assign_to_doctor', 'Assign to Doctor'),
(37, 0, 'assign_by_representative', 'Assign by Representative'),
(38, 0, 'report', 'Reports'),
(39, 0, 'assign_by_me', 'Assign by Me'),
(40, 0, 'assign_to_me', 'Assign to Me'),
(41, 0, 'website', 'Website'),
(42, 0, 'slider', 'Slider'),
(43, 0, 'section', 'Section'),
(44, 0, 'section_item', 'Section Item'),
(45, 0, 'comments', 'Comment'),
(46, 0, 'latest_enquiry', 'Latest Enquiry'),
(47, 0, 'total_progress', 'Total Progress'),
(48, 0, 'last_year_status', 'Showing status from the last year'),
(49, 0, 'department_name', 'Department Name'),
(50, 0, 'description', 'Description'),
(51, 0, 'status', 'Status'),
(52, 0, 'active', 'Active'),
(53, 0, 'inactive', 'Inactive'),
(54, 0, 'cancel', 'Cancel'),
(55, 0, 'save', 'Save'),
(56, 0, 'serial', 'S.No'),
(57, 0, 'action', 'Action'),
(58, 0, 'edit', 'Edit '),
(59, 0, 'delete', 'Delete'),
(60, 0, 'save_successfully', 'Save Successfully!'),
(61, 0, 'update_successfully', 'Update Successfully!'),
(62, 0, 'department_edit', 'Module Edit'),
(63, 0, 'delete_successfully', 'Delete successfully!'),
(64, 0, 'are_you_sure', 'Are You Sure ? '),
(65, 0, 'first_name', 'First Name'),
(66, 0, 'last_name', 'Last Name'),
(67, 0, 'phone', 'Phone No'),
(68, 0, 'mobile', 'Mobile No'),
(69, 0, 'blood_group', 'Blood Group'),
(70, 0, 'sex', 'Sex'),
(71, 0, 'date_of_birth', 'Date of Birth'),
(72, 0, 'address', 'Address'),
(73, 0, 'invalid_picture', 'Invalid Picture'),
(74, 0, 'doctor_profile', 'Company Profile'),
(75, 0, 'edit_profile', 'Edit Profile'),
(76, 0, 'edit_customer', 'Edit Customer'),
(77, 0, 'designation', 'Designation'),
(78, 0, 'short_biography', 'Short Biography'),
(79, 0, 'picture', 'Picture'),
(80, 0, 'specialist', 'Specialist'),
(81, 0, 'male', 'Male'),
(82, 0, 'female', 'Female'),
(83, 0, 'education_degree', 'Education/Degree'),
(84, 0, 'create_date', 'Create Date'),
(85, 0, 'view', 'View'),
(86, 0, 'doctor_information', 'Doctor Information'),
(87, 0, 'update_date', 'Update Date'),
(88, 0, 'print', 'Print'),
(89, 0, 'representative_edit', 'Representative Edit'),
(90, 0, 'patient_information', 'Patient Information'),
(91, 0, 'other', 'Other'),
(92, 0, 'patient_id', 'Patient ID'),
(93, 0, 'age', 'Age'),
(94, 0, 'patient_edit', 'Patient Edit'),
(95, 0, 'id_no', 'ID No.'),
(96, 0, 'select_option', 'Select Option'),
(97, 0, 'doctor_name', 'Doctor Name'),
(98, 0, 'day', 'Day'),
(99, 0, 'start_time', 'Start Time'),
(100, 0, 'end_time', 'End Time'),
(101, 0, 'per_patient_time', 'Per Patient Time'),
(102, 0, 'serial_visibility_type', 'Serial Visibility'),
(103, 0, 'sequential', 'Sequential'),
(104, 0, 'timestamp', 'Timestamp'),
(105, 0, 'available_days', 'Available Days'),
(106, 0, 'schedule_edit', 'Schedule Edit'),
(107, 0, 'available_time', 'Available Time'),
(108, 0, 'serial_no', 'Serial No'),
(109, 0, 'problem', 'Problem'),
(110, 0, 'appointment_date', 'Appointment Date'),
(111, 0, 'you_are_already_registered', 'You Are Already Registered'),
(112, 0, 'invalid_patient_id', 'Invalid patient ID'),
(113, 0, 'invalid_input', 'Invalid Input'),
(114, 0, 'no_doctor_available', 'No Doctor Available'),
(115, 0, 'invalid_department', 'Invalid Department!'),
(116, 0, 'no_schedule_available', 'No Schedule Available'),
(117, 0, 'please_fillup_all_required_fields', 'Please fillup all required filelds'),
(118, 0, 'appointment_id', 'Appointment ID'),
(119, 0, 'schedule_time', 'Schedule Time'),
(120, 0, 'appointment_information', 'Appointment Information'),
(121, 0, 'full_name', 'Full Name'),
(122, 0, 'read_unread', 'Read / Unread'),
(123, 0, 'date', 'Date'),
(124, 0, 'ip_address', 'IP Address'),
(125, 0, 'user_agent', 'User Agent'),
(126, 0, 'checked_by', 'Checked By'),
(127, 0, 'enquiry_date', 'Enquiry Date'),
(128, 0, 'enquiry_list', 'Enquiry List'),
(129, 0, 'filter', 'Filter'),
(130, 0, 'start_date', 'Start Date'),
(131, 0, 'end_date', 'End Date'),
(132, 0, 'application_title', 'Application Title'),
(133, 0, 'favicon', 'Favicon'),
(134, 0, 'logo', 'Logo'),
(135, 0, 'footer_text', 'Footer Text'),
(136, 0, 'language', 'Language'),
(137, 0, 'appointment_assign_by_all', 'Appointment Assign by All'),
(138, 0, 'appointment_assign_by_doctor', 'Appointment Assign by Doctor'),
(139, 0, 'appointment_assign_by_representative', 'Appointment Assign by Representative'),
(140, 0, 'appointment_assign_to_all_doctor', 'Appointment Assign to All Doctor'),
(141, 0, 'appointment_assign_to_me', 'Appointment Assign to Me'),
(142, 0, 'appointment_assign_by_me', 'Appointment Assign by Me'),
(143, 0, 'type', 'Type'),
(144, 0, 'website_title', 'Website Title'),
(145, 0, 'invalid_logo', 'Invalid Logo'),
(146, 0, 'details', 'Details'),
(147, 0, 'website_setting', 'Website Setting'),
(148, 0, 'submit_successfully', 'Submit Successfully!'),
(149, 0, 'application_setting', 'Application Setting'),
(150, 0, 'invalid_favicon', 'Invalid Favicon'),
(151, 0, 'new_enquiry', 'New Enquiry'),
(152, 0, 'information', 'Information'),
(153, 0, 'home', 'Home'),
(154, 0, 'select_department', 'Select Department'),
(155, 0, 'select_doctor', 'Select Doctor'),
(156, 0, 'select_representative', 'Select Representative'),
(157, 0, 'post_id', 'Post ID'),
(158, 0, 'thank_you_for_your_comment', 'Thank you for your comment!'),
(159, 0, 'comment_id', 'Comment ID'),
(160, 0, 'comment_status', 'Comment Status'),
(161, 0, 'comment_added_successfully', 'Comment Added Successfully'),
(162, 0, 'comment_remove_successfully', 'Comment Remove Successfully'),
(163, 0, 'select_item', 'Section Item'),
(164, 0, 'add_item', 'Add Item'),
(165, 0, 'menu_name', 'Menu Name'),
(166, 0, 'title', 'Title'),
(167, 0, 'position', 'Position'),
(168, 0, 'invalid_icon_image', 'Invalid Icon Image!'),
(169, 0, 'about', 'About'),
(170, 0, 'blog', 'Blog'),
(171, 0, 'service', 'Service'),
(172, 0, 'item_edit', 'Item Edit'),
(173, 0, 'registration_successfully', 'Registration Successfully'),
(174, 0, 'add_section', 'Add Section'),
(175, 0, 'section_name', 'Section Name'),
(176, 0, 'invalid_featured_image', 'Invalid Featured Image!'),
(177, 0, 'section_edit', 'Section Edit'),
(178, 0, 'meta_description', 'Meta Description'),
(179, 0, 'twitter_api', 'Twitter Api'),
(180, 0, 'google_map', 'Google Map'),
(181, 0, 'copyright_text', 'Copyright Text'),
(182, 0, 'facebook_url', 'Facebook URL'),
(183, 0, 'twitter_url', 'Twitter URL'),
(184, 0, 'vimeo_url', 'Vimeo URL'),
(185, 0, 'instagram_url', 'Instagram Url'),
(186, 0, 'dribbble_url', 'Dribbble URL'),
(187, 0, 'skype_url', 'Skype URL'),
(188, 0, 'add_slider', 'Add Slider'),
(189, 0, 'subtitle', 'Sub Title'),
(190, 0, 'slide_position', 'Slide Position'),
(191, 0, 'invalid_image', 'Invalid Image'),
(192, 0, 'image_is_required', 'Image is required'),
(193, 0, 'slider_edit', 'Slider Edit'),
(194, 0, 'meta_keyword', 'Meta Keyword'),
(195, 0, 'year', 'Years test'),
(196, 0, 'month', 'Month'),
(197, 0, 'recent_post', 'Recent Post'),
(198, 0, 'leave_a_comment', 'Leave a Comment'),
(199, 0, 'submit', 'Submit'),
(200, 0, 'google_plus_url', 'Google Plus URL'),
(201, 0, 'website_status', 'Website Status'),
(202, 0, 'new_slide', 'New Slide'),
(203, 0, 'new_section', 'New Section'),
(204, 0, 'subtitle_description', 'Sub Title / Description'),
(205, 0, 'featured_image', 'Featured Image'),
(206, 0, 'new_item', 'New Item'),
(207, 0, 'item_position', 'Item Position'),
(208, 0, 'icon_image', 'Icon Image'),
(209, 0, 'post_title', 'Post Title'),
(210, 0, 'add_to_website', 'Add to Website'),
(211, 0, 'read_more', 'Read More'),
(212, 0, 'registration', 'Registration'),
(213, 0, 'appointment_form', 'Appointment Form'),
(214, 0, 'contact', 'Contact'),
(215, 0, 'optional', 'Optional'),
(216, 0, 'customer_comments', 'Customer Comments'),
(217, 0, 'need_a_doctor_for_checkup', 'Need a Doctor for Check-up?'),
(218, 0, 'just_make_an_appointment_and_you_are_done', 'JUST MAKE AN APPOINTMENT & YOU\'RE DONE ! '),
(219, 0, 'get_an_appointment', 'Get an appointment'),
(220, 0, 'latest_news', 'Latest News'),
(221, 0, 'latest_tweet', 'Latest Tweet'),
(222, 0, 'menu', 'Menu'),
(223, 0, 'select_user_role', 'Select User Role'),
(224, 0, 'site_align', 'Website Align'),
(225, 0, 'right_to_left', 'Right to Left'),
(226, 0, 'left_to_right', 'Left to Right'),
(227, 0, 'account_manager', 'Account Manager'),
(228, 0, 'add_invoice', 'Add Invoice'),
(229, 0, 'invoice_list', 'Invoice List'),
(230, 0, 'account_list', 'Account List'),
(231, 0, 'add_account', 'Add Account'),
(232, 0, 'account_name', 'Account Name'),
(233, 0, 'credit', 'Credit'),
(234, 0, 'debit', 'Debit'),
(235, 0, 'account_edit', 'Account Edit'),
(236, 0, 'quantity', 'Quantity'),
(237, 0, 'price', 'Price'),
(238, 0, 'total', 'Total'),
(239, 0, 'remove', 'Remove'),
(240, 0, 'add', 'Add'),
(241, 0, 'subtotal', 'Sub Total'),
(242, 0, 'vat', 'Vat'),
(243, 0, 'grand_total', 'Grand Total'),
(244, 0, 'discount', 'Discount'),
(245, 0, 'paid', 'Paid'),
(246, 0, 'due', 'Due'),
(247, 0, 'reset', 'Reset'),
(248, 0, 'add_or_remove', 'Add / Remove'),
(249, 0, 'invoice', 'Invoice'),
(250, 0, 'invoice_information', 'Invoice Information'),
(251, 0, 'invoice_edit', 'Invoice Edit'),
(252, 0, 'update', 'Update'),
(253, 0, 'all', 'All'),
(254, 0, 'patient_wise', 'Patient Wise'),
(255, 0, 'account_wise', 'Account Wise'),
(256, 0, 'debit_report', 'Debit Report'),
(257, 0, 'credit_report', 'Credit Report'),
(258, 0, 'payment_list', 'Payment List'),
(259, 0, 'add_payment', 'Add Payment'),
(260, 0, 'payment_edit', 'Payment Edit'),
(261, 0, 'pay_to', 'Pay To'),
(262, 0, 'amount', 'Amount'),
(263, 0, 'bed_type', 'Bed Type'),
(264, 0, 'bed_limit', 'Bed Capacity'),
(265, 0, 'charge', 'Charge'),
(266, 0, 'bed_list', 'Bed List'),
(267, 0, 'add_bed', 'Add Bed'),
(268, 0, 'bed_manager', 'Bed Manager'),
(269, 0, 'bed_edit', 'Bed Edit'),
(270, 0, 'bed_assign', 'Bed Assign'),
(271, 0, 'assign_date', 'Assign Date'),
(272, 0, 'discharge_date', 'Discharge Date'),
(273, 0, 'bed_assign_list', 'Bed Assign List'),
(274, 0, 'assign_by', 'Assign By'),
(275, 0, 'bed_available', 'Bed is Available'),
(276, 0, 'bed_not_available', 'Bed is Not Available'),
(277, 0, 'invlid_input', 'Invalid Input'),
(278, 0, 'allocated', 'Allocated'),
(279, 0, 'free_now', 'Free'),
(280, 0, 'select_only_avaiable_days', 'Select Only Avaiable Days'),
(281, 0, 'human_resources', 'Human Resources'),
(282, 0, 'nurse_list', 'Nurse List'),
(283, 0, 'add_employee', 'Add Employee'),
(284, 0, 'user_type', 'User Type'),
(285, 0, 'employee_information', 'Employee Information'),
(286, 0, 'employee_edit', 'Edit Employee'),
(287, 0, 'laboratorist_list', 'Laboratorist List'),
(288, 0, 'accountant_list', 'Accountant List'),
(289, 0, 'receptionist_list', 'Receptionist List'),
(290, 0, 'pharmacist_list', 'Pharmacist List'),
(291, 0, 'nurse', 'Nurse'),
(292, 0, 'laboratorist', 'Laboratorist'),
(293, 0, 'pharmacist', 'Pharmacist'),
(294, 0, 'accountant', 'Accountant'),
(295, 0, 'receptionist', 'Receptionist'),
(296, 0, 'noticeboard', 'Noticeboard'),
(297, 0, 'notice_list', 'Notice List'),
(298, 0, 'add_notice', 'Add Notice'),
(299, 0, 'hospital_activities', 'Hospital Activities'),
(300, 0, 'death_report', 'Death Report'),
(301, 0, 'add_death_report', 'Add Death Report'),
(302, 0, 'death_report_edit', 'Death Report Edit'),
(303, 0, 'birth_report', 'Birth Report'),
(304, 0, 'birth_report_edit', 'Birth Report Edit'),
(305, 0, 'add_birth_report', 'Add Birth Report'),
(306, 0, 'add_operation_report', 'Add Operation Report'),
(307, 0, 'operation_report', 'Operation Report'),
(308, 0, 'investigation_report', 'Investigation Report'),
(309, 0, 'add_investigation_report', 'Add Investigation Report'),
(310, 0, 'add_medicine_category', 'Add Medicine Category'),
(311, 0, 'medicine_category_list', 'Medicine Category List'),
(312, 0, 'category_name', 'Category Name'),
(313, 0, 'medicine_category_edit', 'Medicine Category Edit'),
(314, 0, 'add_medicine', 'Add Medicine'),
(315, 0, 'medicine_list', 'Medicine List'),
(316, 0, 'medicine_edit', 'Medicine Edit'),
(317, 0, 'manufactured_by', 'Manufactured By'),
(318, 0, 'medicine_name', 'Medicine Name'),
(319, 0, 'messages', 'Messages'),
(320, 0, 'inbox', 'Inbox'),
(321, 0, 'sent', 'Sent'),
(322, 0, 'new_message', 'New Message'),
(323, 0, 'sender', 'Sender Name'),
(324, 0, 'message', 'Message'),
(325, 0, 'subject', 'Subject'),
(326, 0, 'receiver_name', 'Send To'),
(327, 0, 'select_user', 'Select User'),
(328, 0, 'message_sent', 'Messages Sent'),
(329, 0, 'mail', 'Mail'),
(330, 0, 'send_mail', 'Send Mail'),
(331, 0, 'mail_setting', 'Mail Setting'),
(332, 0, 'protocol', 'Protocol'),
(333, 0, 'mailpath', 'Mail Path'),
(334, 0, 'mailtype', 'Mail Type'),
(335, 0, 'validate_email', 'Validate Email Address'),
(336, 0, 'true', 'True'),
(337, 0, 'false', 'False'),
(338, 0, 'attach_file', 'Attach File'),
(339, 0, 'wordwrap', 'Enable Word Wrap'),
(340, 0, 'send', 'Send'),
(341, 0, 'upload_successfully', 'Upload Successfully!'),
(342, 0, 'app_setting', 'App Setting'),
(343, 0, 'case_manager', 'Case Manager'),
(344, 0, 'patient_status', 'Patient Status'),
(345, 0, 'patient_status_edit', 'Edit Patient Status'),
(346, 0, 'add_patient_status', 'Add Patient Status'),
(347, 0, 'add_new_status', 'Add New Status'),
(348, 0, 'case_manager_list', 'Case Manager List'),
(349, 0, 'hospital_address', 'Hospital Address'),
(350, 0, 'ref_doctor_name', 'Ref. Doctor Name'),
(351, 0, 'hospital_name', 'Hospital Name'),
(352, 0, 'patient_name', 'Patient  Name'),
(353, 0, 'document_list', 'Document List'),
(354, 0, 'add_document', 'Add Document'),
(355, 0, 'upload_by', 'Upload By'),
(356, 0, 'documents', 'Documents'),
(357, 0, 'prescription', 'Prescription'),
(358, 0, 'add_prescription', 'Add Prescription'),
(359, 0, 'prescription_list', 'Prescription List'),
(360, 0, 'add_insurance', 'Add Insurance'),
(361, 0, 'insurance_list', 'Insurance List'),
(362, 0, 'insurance_name', 'Insurance Name'),
(366, 0, 'add_patient_case_study', 'Add Patient Case Study'),
(367, 0, 'patient_case_study_list', 'Patient Case Study List'),
(368, 0, 'food_allergies', 'Food Allergies'),
(369, 0, 'tendency_bleed', 'Tendency Bleed'),
(370, 0, 'heart_disease', 'Heart Disease'),
(371, 0, 'high_blood_pressure', 'High Blood Pressure'),
(372, 0, 'diabetic', 'Diabetic'),
(373, 0, 'surgery', 'Surgery'),
(374, 0, 'accident', 'Accident'),
(375, 0, 'others', 'Others'),
(376, 0, 'family_medical_history', 'Family Medical History'),
(377, 0, 'current_medication', 'Current Medication'),
(378, 0, 'female_pregnancy', 'Female Pregnancy'),
(379, 0, 'breast_feeding', 'Breast Feeding'),
(380, 0, 'health_insurance', 'Health Insurance'),
(381, 0, 'low_income', 'Low Income'),
(382, 0, 'reference', 'Reference'),
(385, 0, 'instruction', 'Instruction'),
(386, 0, 'medicine_type', 'Medicine Type'),
(387, 0, 'days', 'Days'),
(388, 0, 'weight', 'Weight'),
(389, 0, 'blood_pressure', 'Blood Pressure'),
(390, 0, 'old', 'Old'),
(391, 0, 'new', 'New'),
(392, 0, 'case_study', 'Case Study'),
(393, 0, 'chief_complain', 'Chief Complain'),
(394, 0, 'patient_notes', 'Patient Notes'),
(395, 0, 'visiting_fees', 'Visiting Fees'),
(396, 0, 'diagnosis', 'Diagnosis'),
(397, 0, 'prescription_id', 'Prescription ID'),
(398, 0, 'name', 'Name'),
(399, 0, 'prescription_information', 'Prescription Information'),
(400, 0, 'sms', 'SMS'),
(401, 0, 'gateway_setting', 'Gateway Setting'),
(402, 0, 'time_zone', 'Time Zone'),
(403, 0, 'username', 'User Name'),
(404, 0, 'provider', 'Provider'),
(405, 0, 'sms_template', 'SMS Template'),
(406, 0, 'template_name', 'Template Name'),
(407, 0, 'sms_schedule', 'SMS Schedule'),
(408, 0, 'schedule_name', 'Schedule Name'),
(409, 0, 'time', 'Time'),
(410, 0, 'already_exists', 'Already Exists'),
(411, 0, 'send_custom_sms', 'Send Custom SMS'),
(412, 0, 'sms_sent', 'SMS Sent!'),
(413, 0, 'custom_sms_list', 'Custom SMS List'),
(414, 0, 'reciver', 'Reciver'),
(415, 0, 'auto_sms_report', 'Auto SMS Report'),
(417, 0, 'user_sms_list', 'User SMS List'),
(418, 0, 'send_sms', 'Send SMS'),
(419, 0, 'new_sms', 'New SMS'),
(420, 0, 'sms_list', 'SMS List'),
(421, 0, 'insurance', 'Insurance'),
(422, 0, 'add_limit_approval', 'Add Limit Approval'),
(423, 0, 'limit_approval_list', 'Limit Approval List'),
(424, 0, 'service_tax', 'Service Tax'),
(425, 0, 'remark', 'Remark'),
(426, 0, 'insurance_no', 'Insurance No.'),
(427, 0, 'insurance_code', 'Insurance Code'),
(428, 0, 'hospital_rate', 'Hospital Rate'),
(429, 0, 'insurance_rate', 'Insurance Rate'),
(430, 0, 'disease_charge', 'Disease Charge'),
(431, 0, 'disease_name', 'Disease Name'),
(432, 0, 'room_no', 'Room No'),
(433, 0, 'disease_details', 'Disease Details'),
(434, 0, 'consultant_name', 'Consultant Name'),
(435, 0, 'policy_name', 'Policy Name'),
(436, 0, 'policy_no', 'Policy No.'),
(437, 0, 'policy_holder_name', 'Policy Holder Name'),
(438, 0, 'approval_breakup', ' Approval Charge Break up'),
(439, 0, 'limit_approval', 'Limit Approval'),
(440, 0, 'insurance_limit_approval', 'Insurance Limit Approval'),
(441, 0, 'billing', 'Billing'),
(442, 0, 'add_admission', 'Add Patient Admission'),
(443, 0, 'add_service', 'Add Service'),
(444, 0, 'service_list', 'Service List'),
(445, 0, 'service_name', 'Service Name'),
(446, 0, 'add_package', 'Add Package'),
(447, 0, 'package_list', 'Package List'),
(448, 0, 'package_name', 'Package Name'),
(449, 0, 'package_details', 'Package Details'),
(450, 0, 'edit_package', 'Edit Package'),
(451, 0, 'admission_date', 'Admission Date'),
(452, 0, 'guardian_name', 'Guardian Name'),
(453, 0, 'agent_name', 'Agent Name'),
(454, 0, 'guardian_relation', 'Guardian Relation'),
(455, 0, 'guardian_contact', 'Guardian Contact'),
(456, 0, 'guardian_address', 'Guardian Address'),
(457, 0, 'admission_list', 'Patient Admission List'),
(458, 0, 'admission_id', 'AID'),
(459, 0, 'edit_admission', 'Edit Admission'),
(460, 0, 'add_advance', 'Add Advance Payment'),
(461, 0, 'advance_list', 'Advance Payment List'),
(462, 0, 'receipt_no', 'Receipt No'),
(463, 0, 'cash_card_or_cheque', 'Cash / Card / Cheque'),
(464, 0, 'payment_method', 'Payment Method'),
(465, 0, 'add_bill', 'Add Bill'),
(466, 0, 'bill_list', 'Bill List'),
(467, 0, 'bill_date', 'Bill Date'),
(468, 0, 'total_days', 'Total Days'),
(469, 0, 'advance_payment', 'Advance Payment'),
(470, 0, 'cash', 'Cash'),
(471, 0, 'card', 'Card'),
(472, 0, 'cheque', 'Cheque'),
(473, 0, 'card_cheque_no', 'Card / Cheque No.'),
(474, 0, 'receipt', 'Receipt'),
(475, 0, 'tax', 'Tax'),
(476, 0, 'pay_advance', 'Pay Advance'),
(477, 0, 'payable', 'Payable'),
(478, 0, 'notes', 'Notes'),
(479, 0, 'rate', 'Rate'),
(480, 0, 'bill_id', 'Bill ID.'),
(481, 0, 'paid', 'Paid'),
(482, 0, 'unpaid', 'Unpaid'),
(483, 0, 'bill_details', 'Bill Details'),
(484, 0, 'signature', 'Signature'),
(485, 0, 'update_bill', 'Update Bill'),
(486, 0, 'account_details', 'Account Details'),
(487, 0, 'add_companey_details', 'Company details'),
(488, 0, 'personal_info', 'Personal info'),
(489, 0, 'customer_account_name', 'Account name'),
(490, 0, 'customer_account_number', 'Account Number'),
(491, 0, 'customer_account_branch', 'Branch Name'),
(492, 0, 'customer_ifsc', 'IFSC Code'),
(493, 0, 'customer_company_name', 'Company Name'),
(494, 0, 'Company_address', 'Company Address'),
(495, 0, 'customer_services', 'Service Modules'),
(497, 0, 'lead', 'Lead'),
(498, 0, 'task', 'Task'),
(499, 0, 'client_list', 'Client List'),
(500, 0, 'token', 'Token'),
(501, 0, 'invoice', 'Invoice'),
(502, 0, 'sms_panel', 'SMS'),
(503, 0, 'email_panel', 'Email'),
(504, 0, 'social_panel', 'Social'),
(505, 0, 'SuperAdmin', 'SuperAdmin'),
(506, 0, 'Sales', 'Sales'),
(507, 0, 'Client', 'Client'),
(508, 0, 'from_rights', 'Form Rights'),
(510, 0, 'country_list', 'Country List'),
(511, 0, 'region_list', 'Region List'),
(512, 0, 'territory_list', 'Territory List'),
(513, 0, 'state_list', 'State List'),
(514, 0, 'city_list', 'City List'),
(515, 0, 'country_name', 'Country Name'),
(516, 0, 'add_country', 'Add Country'),
(517, 0, 'add_region', 'Add Region'),
(518, 0, 'region_name', 'Region Name'),
(519, 0, 'add_teretory', 'Add Territory'),
(520, 0, 'territory_name', 'Territory Name'),
(521, 0, 'state_name', 'State Name'),
(522, 0, 'city_name', 'City Name'),
(523, 0, 'add_state', 'Add State'),
(524, 0, 'add_city', 'Add City'),
(525, 0, 'import', 'Import'),
(526, 0, 'lead_source', 'Enquiry Source'),
(527, 0, 'lead_addby', 'Lead Add By'),
(528, 0, 'add_user', 'Add Employee'),
(529, 0, 'disolay_name', 'Display Name'),
(530, 0, 'user_name', 'User name'),
(531, 0, 'mobile', 'Mobile No'),
(532, 0, 'position_input', 'POSITION'),
(533, 0, 'company_info', 'Company Name'),
(534, 0, 'assign_to', 'Assign To'),
(535, 0, 'interested_in', 'Interested in'),
(536, 0, 'lead_score', 'Lead Score'),
(537, 0, 'lead_stage', 'Lead Stage'),
(538, 0, 'total_invoice', 'Total Invoice'),
(539, 0, 'enquiry_type', 'Enquiry Type'),
(540, 0, 'Add_More', 'Add More'),
(541, 0, 'ticket', 'Support'),
(542, 0, 'employee_id', 'Employee ID'),
(543, 0, 'user_type', 'User Type'),
(544, 0, 'edit_user', 'Edit User'),
(545, 0, 'whatsapp', 'Whatsapp'),
(546, 0, 'api', 'API Configuration'),
(547, 0, 'email_setting', 'Email'),
(548, 0, 'add_new_enquiry', 'Add New Enquiry'),
(549, 0, 'created_today', 'Created Today'),
(550, 0, 'add_new_lead', 'Add New Lead'),
(551, 0, 'updated_today', 'Updated Today'),
(552, 0, 'move_lead', 'Move Lead To Client'),
(553, 0, 'droped', 'Dropped'),
(554, 0, 'all_leads', 'All Leads'),
(555, 0, 'circuit_sheet', 'Requirements Sheet'),
(556, 0, 'all_enquiry', 'All Enquiry'),
(557, 0, 'last_update', 'Last Update'),
(558, 0, 'assign_selected', 'Assign Selected'),
(559, 0, 'move_to_lead', 'Move to lead'),
(560, 0, 'boq', 'BoQ'),
(561, 0, 'drop_enquiry', 'Drop Enquiry'),
(562, 0, 'send_whatsapp', 'Send Bulk Whatsapp'),
(563, 0, 'send_bulk_sms', 'Send bulk sms'),
(564, 0, 'pi', 'PI'),
(565, 0, 'convert_to_client', 'Convert To Client'),
(566, 0, 'delete_selected', 'Delete Selected'),
(567, 0, 'po', 'PO'),
(568, 0, 'close', 'Close'),
(569, 0, 'upload_po', 'Upload Photo'),
(570, 0, 'conversion_rate', 'Conversion Rate'),
(571, 0, 'create_task', 'Create Task'),
(572, 0, 'add_comment', 'Add Comment'),
(573, 0, 'actual_meet_date', 'Actual Meet Date'),
(574, 0, 'contact_person_name', 'Contact Person Name'),
(575, 0, 'contact_person_no', 'Contact Person Mobile No.'),
(576, 0, 'contact_person_email', 'Contact Person Email'),
(577, 0, 'contact_person_designation', 'Contact Person Designation'),
(578, 0, 'conversation_details', 'Conversation Details'),
(579, 0, 'update_lead_details', 'Update Lead Details'),
(580, 0, 'drop_lead', 'Drop Lead'),
(581, 0, 'drop_status', 'Drop comment'),
(582, 0, 'drop_reason', 'Drop Reason'),
(583, 0, 'integration_name', 'Integration Name'),
(584, 0, 'source', 'Source'),
(585, 0, 'Duplicate', 'Duplicate'),
(586, 0, 'Attended', 'Attended'),
(587, 0, 'Overdue_Followup', 'Overdue Followup'),
(588, 0, 'Due_Today', 'Due Today'),
(589, 0, 'Unscheduled', 'Unscheduled'),
(590, 0, 'scheduled', 'Add Scheduled'),
(591, 0, 'unattended', 'Unattended'),
(592, 0, 'qr_code', 'QR-Code'),
(593, 0, 'add_new_integration', 'Add New Integration'),
(594, 0, 'capture_link', 'Capture Link'),
(595, 0, 'indiamart', 'IndiaMart'),
(596, 0, 'indiamart_key', 'IndiaMart Key'),
(597, 0, 'primary_num', 'Primary Number'),
(598, 0, 'userid', 'User ID'),
(599, 0, 'user_profileid', 'Profile ID'),
(600, 0, 'tradeindia_key', 'Tradeindia Key'),
(601, 0, 'tradeindia', 'Tradeindia'),
(602, 0, 'justdial', 'JustDial'),
(603, 0, 'move_to_client', 'Move To Client'),
(604, 0, 'add_new_client', 'Add New Client'),
(605, 0, 'stage', 'Stage'),
(606, 0, 'create_Task', 'Create Task'),
(607, 0, 'search', 'Search'),
(608, 0, 'add_new_readiness', 'Add New Readiness'),
(609, 0, 'user_function', 'User Rights'),
(610, 0, 'country_level', 'Country Level'),
(611, 0, 'region_level', 'Region Level'),
(612, 0, 'state_level', 'State Level'),
(613, 0, 'territory_level', 'Territory Level'),
(614, 0, 'city_level', 'City Level'),
(615, 0, 'admin_level', 'Admin Level'),
(616, 0, 'user_level', 'User Level'),
(617, 0, 'partner_id', 'Partner ID'),
(618, 0, 'facebook', 'Facebook'),
(619, 0, 'linkedin', 'Linkedin'),
(620, 0, 'add_product', 'Add Product'),
(621, 0, 'update_product', 'Update Product'),
(622, 0, 'product_list', 'Product List'),
(623, 0, 'product_name', 'Product Name'),
(624, 0, 'requirement_management', 'Product'),
(625, 0, 'product_country_management', 'Product Country'),
(626, 0, 'institute_management', 'Institute'),
(627, 0, 'add_institute', 'Add Institute'),
(628, 0, 'edit_institute', 'Edit Institute'),
(629, 0, 'institute_list', 'Institute List'),
(630, 0, 'institute_name', 'Institute Name'),
(631, 0, 'contact_name', 'Contact Name'),
(632, 0, 'contact_number', 'Contact Number'),
(633, 0, 'address', 'Address'),
(634, 0, 'datasource_management', 'Datasource'),
(635, 0, 'add_datasource', 'Add Datasource'),
(636, 0, 'edit_datasource', 'Edit Datasource'),
(637, 0, 'datasource_list', 'Datasource List'),
(638, 0, 'datasource_name', 'Datasource Name'),
(639, 0, 'taskstatus_management', 'Taskstatus'),
(640, 0, 'add_taskstatus', 'Add Taskstatus'),
(641, 0, 'edit_taskstatus', 'Edit Taskstatus'),
(642, 0, 'taskstatus_list', 'Taskstatus List'),
(643, 0, 'taskstatus_name', 'Task Status'),
(644, 0, 'lead_list', 'Lead List'),
(645, 0, 'lead_list', 'Lead List'),
(646, 0, 'center_management', 'Center'),
(647, 0, 'add_center', 'Add Center'),
(648, 0, 'edit_center', 'Update Center'),
(649, 0, 'center_name', 'Center Name'),
(650, 0, 'center_list', 'Center List'),
(651, 0, 'subsource_management', 'Sub Source'),
(652, 0, 'add_subsource', 'Add Sub Source'),
(653, 0, 'edit_subsource', 'Update Sub Source'),
(654, 0, 'subsource_name', 'Sub Source'),
(655, 0, 'subsource_list', 'Sub Source List'),
(656, 0, 'sub_source', 'Sub source'),
(657, 0, 'lead_description', 'Lead Description'),
(658, 0, 'description', 'Description'),
(659, 0, 'add_lead_description', 'Add Lead Description'),
(660, 0, 'description_name', 'Description Name'),
(661, 0, 'lead_stages', 'Lead Stages'),
(662, 0, 'description_list', 'Description List'),
(663, 0, 'lead_stage', 'Lead Stage'),
(664, 0, 'update_deiscription', 'Update Deiscription'),
(665, 0, 'product_status', 'Status'),
(666, 0, 'company_name', 'Company Name'),
(667, 0, 'company', 'Enter Company'),
(668, 0, 'user_activity', 'User Activity'),
(669, 0, 'attendence', 'Aattendence'),
(670, 0, 'company_right', 'Company Right'),
(671, 0, 'next', 'Next'),
(672, 0, 'lead_master', 'Lead Mastter'),
(674, 0, 'mark_attendence', 'Mark Attendance'),
(676, 0, 'english', 'English'),
(1984, 0, 'hindi', 'Hindi'),
(2001, 0, 'phrase', 'Phrase'),
(2002, 0, 'label', 'Label'),
(2003, 0, 'phrase_name', 'Phrase Name'),
(2004, 0, 'phrase_value', 'phrase_value'),
(2005, 0, 'language_list', 'Language List'),
(2006, 0, 'add_phrase', 'Add Phrase'),
(2007, 0, 'change_password', 'Change Password'),
(2008, 0, 'lead_master_search', 'Lead Master Search '),
(2009, 0, 'location_setting', 'Location Setting'),
(2010, 0, 'sales_setting', 'Sales Setting'),
(2011, 0, 'conversion_probability', 'Conversion Probability'),
(2012, 0, 'product', 'Product/Services'),
(2013, 0, 'company_list', 'Company List'),
(2014, 0, 'upload_enquiry', 'Upload Enquiry'),
(2015, 0, 'download_sample', 'Download Sample'),
(2018, 0, 'proccess', 'Process'),
(2019, 0, 'forget_password', 'Forgot Password?'),
(2020, 0, 'gender', 'Gender'),
(2021, 0, 'select_product', 'Select Product'),
(2022, 0, 'state', 'State'),
(2023, 0, 'city', 'City'),
(2024, 0, 'floor_list', 'Floor List'),
(2025, 0, 'floor_name', 'Floor Name'),
(2026, 0, 'add_new', 'Add New'),
(2027, 0, 'question', 'Question'),
(2028, 0, 'question_paragraph', 'Question Paragraph'),
(2029, 0, 'question_descreption', 'Question Descreption'),
(2030, 0, 'select_correct_option', 'Select Correct Option'),
(2031, 0, 'correct_answer', 'Correct Answer'),
(2032, 0, 'mark_score', 'Marks Score'),
(2033, 0, 'add_question', 'Add Question'),
(2034, 0, 'select_question_type', 'Select Question Type'),
(2035, 0, 'room_list', 'Room List'),
(2036, 0, 'room_name', 'Room Name'),
(2037, 0, 'list_sub_function', 'List Sub Function'),
(2038, 0, 'sub_function_name', 'Sub Function Name'),
(2039, 0, 'function_name', 'Function Name'),
(2040, 0, 'main_function', 'Main Function'),
(2041, 0, 'function_list', 'Function List'),
(2042, 0, 'code', 'Code'),
(2043, 0, 'function_url', 'Function Url'),
(2044, 0, 'from_date', 'From Date'),
(2045, 0, 'to_date', 'To Date'),
(2046, 0, 'employee', 'Employee'),
(2047, 0, 'subsource', 'Subsource'),
(2048, 0, 'datasource', 'Datasource'),
(2049, 0, 'created_date', 'Created Date'),
(2050, 0, 'create_new', 'Create New'),
(2051, 0, 'created_by', 'Created By'),
(2052, 0, 'data_source', 'Data Source'),
(2053, 0, 'sales_funnel', 'SALES FUNNEL'),
(2054, 0, 'proccess_chart', 'Process Chart'),
(2055, 0, 'enquiries', 'enquiries'),
(2056, 0, 'enquiry_status', 'Enquiry Status'),
(2057, 0, 'lead_stage_by_month', 'Disposition By Month'),
(2060, 0, 'hot', 'Hot'),
(2061, 0, 'warm', 'Warm'),
(2062, 0, 'cold', 'Cold'),
(2063, 0, 'report_columns', 'Report Columns'),
(2064, 0, 'filter_and_save', 'Filter And Save'),
(2065, 0, 'reports_list', 'All Reports '),
(2066, 0, 'report_filter_create', 'Report Filter/Save'),
(2068, 0, 'access_denied', 'Access Denied'),
(2069, 0, 'something_went_wrong', 'Some thing went wrong!'),
(2070, 0, 'task_delete_msg', 'Task Deleted Successfully'),
(2071, 0, 'add_process', 'Add Process'),
(2073, 0, 'cell', 'Mobile No'),
(2074, 0, 'invoice_settings', 'General'),
(2075, 0, 'invoice_advance_setting', 'Advance'),
(2076, 0, 'invoice_seller_buyer_setting', 'Seller & Buyer'),
(2077, 0, 'invoice_content_block_setting', 'Content Blocks'),
(2078, 0, 'invoice_localization_setting', 'Localization Settings'),
(2079, 0, 'invoice_payment_setting', 'Payment Settings'),
(2080, 0, 'telephony_agent_id', 'Telephony Agent Id'),
(2084, 0, 'report_and_save', 'Filter And Save'),
(2086, 0, 'custom_form_company', 'Custom Enquiry Form'),
(2090, 0, 'table_config', 'Table Config'),
(2132, 0, 'pin_code', 'Pin Code'),
(2134, 0, 'course_management', 'Course'),
(2135, 0, 'course_name', 'Course Name'),
(2136, 0, 'unassigned', 'Unassigned'),
(2137, 0, 'all_clients', 'All Clients'),
(2138, 0, 'dashclock', 'Dash Clock'),
(2139, 0, 'dropdata', 'Drop Data'),
(2140, 0, 'state_map', 'State Wise Data'),
(2141, 0, 'disposition_data', 'Disposition Data'),
(2142, 0, 'average_follow_up_rate', 'Average follow up rate'),
(2143, 0, 'course_image', 'Course Image'),
(2144, 0, 'course_rating', 'Course Rating'),
(2145, 0, 'course_discription', 'Course Discription'),
(2146, 0, 'profile_image', 'Profile Image'),
(2147, 0, 'agreement_comision', 'Agreement Commission'),
(2148, 0, 'agreement_doc', 'Agreement Document'),
(2149, 0, 'search_program', 'Search Programs'),
(2150, 0, 'meeting_room', 'Meeting Room'),
(2151, 0, 'user_profile', 'User Profile'),
(2152, 0, 'my_applications', 'My Applictions'),
(2153, 0, 'my_applicants', 'My Applicants'),
(2154, 0, 'program_discipline', 'Discipline'),
(2155, 0, 'program_length', 'Length'),
(2156, 0, 'program_level', 'Level'),
(2157, 0, 'discipline_list', 'Discipline List'),
(2158, 0, 'update_discipline', 'Update Discipline'),
(2159, 0, 'level_list', 'Level List'),
(2160, 0, 'update_level', 'Update Level'),
(2161, 0, 'course_master', 'Course Master'),
(2162, 0, 'course_list', 'Course List'),
(2163, 0, 'vedio_list', 'Video List'),
(2164, 0, 'title_name', 'Title'),
(2165, 0, 'link_name', 'Link(URL)'),
(2166, 0, 'add_vid', 'Add Video'),
(2167, 0, 'update_vedio', 'Update vedio'),
(2168, 0, 'course_ielts', 'Course IELTS'),
(2173, 0, 'add_title', 'Add Title'),
(2174, 0, 'title_list', 'Title List'),
(2175, 0, 'update_title', 'Update Title'),
(2176, 0, 'department', 'Department'),
(2177, 0, 'department_list', 'Department List'),
(2178, 0, 'update_department', 'Update Department'),
(2179, 0, 'duration', 'Duration'),
(2180, 0, 'annual_fees', 'Annual Fees'),
(2181, 0, 'mode', 'Mode'),
(2182, 0, 'campus', 'Campus'),
(2183, 0, 'university_list', 'University List'),
(2184, 0, 'student_list', 'Student List'),
(2185, 0, 'admin_list', 'Admin List'),
(2186, 0, 'confirm_password', 'Confirm Password'),
(2187, 0, 'signup', 'Register'),
(2188, 0, 'update_course', 'Edit Course'),
(2189, 0, 'add_course', 'Add Course'),
(2190, 0, 'telephone_call_reports', 'Call Reports'),
(2191, 0, 'create_rule', 'Create Rule'),
(2192, 0, 'leadrules', 'Rules List'),
(2193, 0, 'lead_rules', 'Lead Rules'),
(2194, 0, 'bulk_autodial', 'Bulk autodial'),
(2195, 0, 'upload_course', 'Upload Course'),
(2196, 0, 'tuition_fees', 'Tuition Fees'),
(2197, 0, 'ticketing', 'Ticket'),
(2198, 0, 'course_details', 'Course Details'),
(2199, 0, 'search_programs', 'Search Programs'),
(2200, 0, 'send_bulk_email', 'Send Bulk Email'),
(2201, 0, 'ticket_problem_master', 'Problem Master'),
(2202, 0, 'add_ticket_problem_master', 'Add Problem'),
(2203, 0, 'ticket_problem', 'Problem'),
(2232, 0, 'natureofcomplaint', 'Nature of complaints'),
(2233, 0, 'ticket_remark', 'Description'),
(2234, 0, 'problem_for', 'Organization Name'),
(2242, 0, 'short_dashboard_ticket_created', 'Created'),
(2243, 0, 'short_dashboard_ticket_assigned', 'Assigned'),
(2244, 0, 'short_dashboard_ticket_updated', 'Updated'),
(2245, 0, 'short_dashboard_ticket_followup', 'Followups'),
(2246, 0, 'short_dashboard_ticket_closed', 'Dropped'),
(2247, 0, 'short_dashboard_ticket_pending', 'Pending'),
(2248, 0, 'short_dashboard_ticket_all', 'Total'),
(2251, 0, 'update_from_date', 'Update From Date'),
(2252, 0, 'update_to_date', 'Update To Date'),
(2253, 0, 'created', 'Created'),
(2254, 0, 'assigned', 'Assigned'),
(2255, 0, 'updated', 'Updated'),
(2256, 0, 'pending_enquiry', 'Pending Enquiry');

-- --------------------------------------------------------

--
-- Table structure for table `leadrules`
--

CREATE TABLE `leadrules` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=lead score,2=lead assign,3=Email Send,4=auto follow up rule',
  `rule_sql` text,
  `rule_json` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `lead_score` varchar(200) DEFAULT NULL,
  `rule_action` varchar(1000) NOT NULL,
  `status` enum('1','0','') DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lead_description`
--

CREATE TABLE `lead_description` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `lead_stage_id` varchar(1000) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `updated_by` varchar(15) NOT NULL,
  `created_date` varchar(10) NOT NULL,
  `updated_date` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_score`
--

CREATE TABLE `lead_score` (
  `sc_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `score_name` varchar(100) NOT NULL,
  `probability` varchar(150) NOT NULL,
  `score_icon` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_source`
--

CREATE TABLE `lead_source` (
  `lsid` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `lead_name` varchar(100) NOT NULL,
  `score_count` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `icon_url` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_stage`
--

CREATE TABLE `lead_stage` (
  `stg_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `lead_stage_name` varchar(100) NOT NULL,
  `process_id` varchar(100) DEFAULT NULL,
  `stage_for` varchar(100) NOT NULL COMMENT '1=enquiry,2=lead,3=client,4=ticket'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `lg_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lgot_date_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `lg_ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `comp_id`, `uid`, `lg_date_time`, `lgot_date_time`, `lg_ip`) VALUES
(1, 0, 155, '2021-01-08 20:34:05', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `token` varchar(1000) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_setting`
--

CREATE TABLE `mail_setting` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `protocol` varchar(20) NOT NULL,
  `mailpath` varchar(255) NOT NULL,
  `mailtype` varchar(20) NOT NULL,
  `validate_email` varchar(20) NOT NULL,
  `wordwrap` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_signature`
--

CREATE TABLE `mail_signature` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `signature` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_template_attachments`
--

CREATE TABLE `mail_template_attachments` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `templt_id` int(11) NOT NULL,
  `files` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_attendance`
--

CREATE TABLE `map_attendance` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_location_feed`
--

CREATE TABLE `map_location_feed` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `waypoints` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `measurement_unit`
--

CREATE TABLE `measurement_unit` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `modulewise_right`
--

CREATE TABLE `modulewise_right` (
  `id` int(11) NOT NULL,
  `right_id` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modulewise_right`
--

INSERT INTO `modulewise_right` (`id`, `right_id`, `name`, `module_id`, `created_at`, `updated_at`) VALUES
(1, '10', 'add country', 1, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(2, '11', 'edit country', 1, '2020-09-28 16:52:23', '2020-09-28 16:52:23'),
(3, '12', 'view country list', 1, '2020-09-28 16:52:41', '2020-09-28 16:52:41'),
(4, '13', 'delete country', 1, '2020-09-28 16:52:56', '2020-09-28 16:52:56'),
(5, '14', 'add region', 1, '2020-09-28 16:54:00', '2020-09-28 16:54:00'),
(6, '0', 'edit region', 0, '2020-09-28 16:54:11', '2020-09-28 16:54:11'),
(7, '15', 'view region list', 1, '2020-09-28 16:54:29', '2020-09-28 16:54:29'),
(8, '16', 'delete region', 1, '2020-09-28 16:54:41', '2020-09-28 16:54:41'),
(9, '17', 'add state', 1, '2020-09-28 16:54:58', '2020-09-28 16:54:58'),
(10, '1', 'edit state', 0, '2020-09-28 16:55:11', '2020-09-28 16:55:11'),
(11, '18', 'edit state', 1, '2020-09-28 16:55:55', '2020-09-28 16:55:55'),
(12, '19', 'view state list', 1, '2020-09-28 16:56:12', '2020-09-28 16:56:12'),
(13, '110', 'delete state ', 1, '2020-09-28 16:56:28', '2020-09-28 16:56:28'),
(14, '111', 'add territory', 1, '2020-09-28 16:56:58', '2020-09-28 16:56:58'),
(15, '2', 'edit territory', 0, '2020-09-28 16:57:15', '2020-09-28 16:57:15'),
(16, '112', 'edit territory', 1, '2020-09-28 16:57:34', '2020-09-28 16:57:34'),
(17, '113', 'view territory list', 1, '2020-09-28 16:57:54', '2020-09-28 16:57:54'),
(18, '114', 'delete territory', 1, '2020-09-28 16:58:11', '2020-09-28 16:58:11'),
(19, '115', ' add city', 1, '2020-09-28 16:58:40', '2020-09-28 16:58:40'),
(20, '116', 'edit city', 1, '2020-09-28 16:58:54', '2020-09-28 16:58:54'),
(21, '117', 'view city list', 1, '2020-09-28 16:59:08', '2020-09-28 16:59:08'),
(22, '118', 'delete city', 1, '2020-09-28 16:59:21', '2020-09-28 16:59:21'),
(23, '119', 'import', 1, '2020-09-28 16:59:35', '2020-09-28 16:59:35'),
(24, '50', 'add whatsapp api', 5, '2020-09-28 17:04:58', '2020-09-28 17:04:58'),
(25, '51', 'edit whatsapp api', 5, '2020-09-28 17:05:18', '2020-09-28 17:05:18'),
(26, '52', 'view whatsapp api list', 5, '2020-09-28 17:05:44', '2020-09-28 17:05:44'),
(27, '53', 'delete whatsapp api', 5, '2020-09-28 17:07:29', '2020-09-28 17:07:29'),
(28, '54', 'add sms api', 5, '2020-09-28 17:08:22', '2020-09-28 17:08:22'),
(29, '55', 'edit sms api', 5, '2020-09-28 17:08:35', '2020-09-28 17:08:35'),
(30, '56', 'view sms api list', 5, '2020-09-28 17:08:50', '2020-09-28 17:08:50'),
(31, '57', 'delete sms api', 5, '2020-09-28 17:09:25', '2020-09-28 17:09:25'),
(32, '58', 'add email api ', 5, '2020-09-28 17:10:46', '2020-09-28 17:10:46'),
(33, '59', 'edit email api', 5, '2020-09-28 17:10:57', '2020-09-28 17:10:57'),
(34, '510', 'view email api list', 5, '2020-09-28 17:11:12', '2020-09-28 17:11:12'),
(35, '511', 'delete email api', 5, '2020-09-28 17:11:46', '2020-09-28 17:11:46'),
(36, '512', 'add website', 5, '2020-09-28 17:12:22', '2020-09-28 17:12:22'),
(37, '513', 'edit website', 5, '2020-09-28 17:12:35', '2020-09-28 17:12:35'),
(38, '514', 'view website list', 5, '2020-09-28 17:13:06', '2020-09-28 17:13:06'),
(39, '515', 'delete website', 5, '2020-09-28 17:13:19', '2020-09-28 17:13:19'),
(40, '516', 'add qrcode', 5, '2020-09-28 17:13:54', '2020-09-28 17:13:54'),
(41, '517', 'edit qrcode', 5, '2020-09-28 17:14:09', '2020-09-28 17:14:09'),
(42, '3', 'view qrcode list', 0, '2020-09-28 17:14:23', '2020-09-28 17:14:23'),
(43, '518', 'delete qrcode', 5, '2020-09-28 17:14:36', '2020-09-28 17:14:36'),
(44, '260', 'set target', 26, '2020-09-28 17:16:04', '2020-09-28 17:16:04'),
(45, '261', 'view target', 26, '2020-09-28 17:16:32', '2020-09-28 17:16:32'),
(46, '262', 'user forecasting', 26, '2020-09-28 17:40:05', '2020-09-28 17:40:05'),
(47, '60', 'add', 6, '2020-09-28 20:19:39', '2020-09-28 20:19:39'),
(48, '61', 'update', 6, '2020-09-28 20:19:52', '2020-09-28 20:19:52'),
(49, '62', 'delete', 6, '2020-09-28 20:20:08', '2020-09-28 20:20:08'),
(50, '64', 'send sms', 6, '2020-09-28 20:20:31', '2020-09-28 20:20:31'),
(51, '65', 'send whatsapp', 6, '2020-09-28 20:20:48', '2020-09-28 20:20:48'),
(52, '67', 'assignment', 6, '2020-09-28 20:21:16', '2020-09-28 20:21:16'),
(53, '68', 'convert to lead', 6, '2020-09-28 20:21:50', '2020-09-28 20:21:50'),
(54, '70', 'add', 7, '2020-09-28 20:22:12', '2020-09-28 20:22:12'),
(55, '71', 'update', 7, '2020-09-28 20:22:22', '2020-09-28 20:22:22'),
(56, '72', 'delete', 7, '2020-09-28 20:22:34', '2020-09-28 20:22:34'),
(57, '74', 'send sms', 7, '2020-09-28 20:22:49', '2020-09-28 20:22:49'),
(58, '75', 'send whatsapp', 7, '2020-09-28 20:23:03', '2020-09-28 20:23:03'),
(59, '77', 'convert to client', 7, '2020-09-28 20:23:25', '2020-09-28 20:23:25'),
(60, '80', 'add', 8, '2020-09-28 20:23:50', '2020-09-28 20:23:50'),
(61, '81', 'update', 8, '2020-09-28 20:24:06', '2020-09-28 20:24:06'),
(62, '82', 'delete', 8, '2020-09-28 20:24:20', '2020-09-28 20:24:20'),
(63, '90', 'add', 9, '2020-09-28 20:24:44', '2020-09-28 20:24:44'),
(64, '91', 'update', 9, '2020-09-28 20:24:51', '2020-09-28 20:24:51'),
(65, '92', 'delete', 9, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(66, '190', 'allow', 19, '2020-09-28 20:25:26', '2020-09-28 20:25:26'),
(67, '290', 'Internal chat ', 29, '2020-09-28 20:25:50', '2020-09-28 20:25:50'),
(68, '270', 'Multi Process', 23, '2020-09-28 20:26:08', '2020-09-28 20:26:08'),
(70, '30', 'Allow', 3, '2020-09-28 16:54:11', '2020-09-28 16:54:11'),
(71, '66', 'send email', 6, '2020-09-28 20:20:48', '2020-09-28 20:20:48'),
(72, '69', 'Export', 6, '2020-09-28 20:21:50', '2020-09-28 20:21:50'),
(73, '76', 'send email', 7, '2020-09-28 20:20:48', '2020-09-28 20:20:48'),
(74, '84', 'send sms', 8, '2020-09-28 20:22:49', '2020-09-28 20:22:49'),
(75, '85', 'send whatsapp', 8, '2020-09-28 20:23:03', '2020-09-28 20:23:03'),
(76, '86', 'send email', 8, '2020-09-28 20:20:48', '2020-09-28 20:20:48'),
(77, '120', 'Sales Repot', 12, '2020-09-28 17:04:58', '2020-09-28 17:04:58'),
(78, '130', 'Add User', 13, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(79, '131', 'Edit User', 13, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(80, '132', 'Delete User', 13, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(81, '140', 'Add User Right', 14, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(82, '141', 'Edit User Right', 14, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(83, '142', 'Delete User Right', 14, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(84, '170', 'Allow', 17, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(85, '180', 'Allow', 18, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(86, '200', 'Allow', 20, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(87, '250', 'Target Setting', 21, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(88, '220', 'Allow', 22, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(89, '230', 'Allow', 23, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(90, '210', 'Forecasting', 21, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(93, '78', 'Export', 7, '2020-09-28 20:21:50', '2020-09-28 20:21:50'),
(94, '88', 'Export', 8, '2020-09-28 20:20:48', '2020-09-28 20:20:48'),
(95, '93', 'Export', 9, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(96, '430', 'Telephony Report', 12, '2020-09-28 17:04:58', '2020-09-28 17:04:58'),
(98, '291', 'External agent chat ', 29, '2020-09-28 20:25:50', '2020-09-28 20:25:50'),
(99, '310', 'Add Ticket', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(100, '311', 'Edit Ticket', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(101, '312', 'Delete Ticket', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(102, '313', 'Assign Ticket', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(103, '314', 'Send SMS', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(104, '315', 'Send Whatsapp', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(105, '316', 'Send Email', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(107, '317', 'Export', 31, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(108, '490', 'Allow', 49, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(110, '440', 'Allow', 44, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(111, '470', 'Add', 47, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(112, '471', 'Edit', 47, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(113, '473', 'Delete', 47, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(116, '474', 'Export', 47, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(117, '475', 'Import', 47, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(118, '480', 'Allow', 48, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(119, '460', 'View order', 46, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(121, '461', 'Add payment', 46, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(122, '462', 'Invoice', 46, '2020-09-28 20:25:02', '2020-09-28 20:25:02'),
(124, '100', 'Add Rule', 51, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(125, '101', 'Edit Rule', 51, '2020-09-28 16:52:23', '2020-09-28 16:52:23'),
(126, '102', 'Delete Rule', 51, '2020-09-28 16:52:56', '2020-09-28 16:52:56'),
(127, '420', 'Allow', 42, '2020-11-06 15:36:11', '2020-11-06 15:36:11'),
(128, '400', 'Allow', 40, '2020-11-06 15:37:39', '2020-11-06 15:37:39'),
(129, '380', 'Allow', 38, '2020-11-06 15:38:25', '2020-11-06 15:38:25'),
(130, '350', 'Allow', 35, '2020-11-06 15:47:05', '2020-11-06 15:47:05'),
(131, '340', 'Allow', 34, '2020-11-06 15:47:49', '2020-11-06 15:47:49'),
(132, '300', 'Add', 30, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(134, '301', 'Import', 30, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(135, '520', 'Failure Point Master', 52, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(136, '521', 'Referred By Master', 52, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(137, '530', 'Festival Master', 53, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(138, '531', 'Holiday Master', 53, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(139, '522', 'Problem Master', 52, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(140, '523', 'Nature Of Complaints Master', 52, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(141, '240', 'Allow', 24, '2020-11-06 19:05:05', '2020-11-06 19:05:05'),
(142, '450', 'Number Masking', 3, '2020-09-28 16:54:11', '2020-09-28 16:54:11'),
(143, '540', 'Sales Dashboard', 54, '2020-12-21 23:04:43', '2020-12-21 23:04:43'),
(144, '541', 'Ticket Dashboard', 54, '2020-12-21 23:05:11', '2020-12-21 23:05:11'),
(145, '1000', 'Add Deal', 100, '2020-12-22 15:02:18', '2020-12-22 15:02:18'),
(146, '1001', 'Delete Deals', 100, '2020-12-22 15:12:35', '2020-12-22 15:12:35'),
(147, '1002', 'Edit Deals', 100, '2020-12-22 15:12:50', '2020-12-22 15:12:50'),
(148, '1010', 'Add Contacts', 101, '2020-12-22 15:15:32', '2020-12-22 15:15:32'),
(149, '1011', 'Delete Contacts', 101, '2020-12-22 15:16:13', '2020-12-22 15:16:13'),
(150, '1012', 'Edit Contacts', 101, '2020-12-22 15:16:20', '2020-12-22 15:16:20'),
(151, '1013', 'Contact Menu', 101, '2020-12-22 15:36:00', '2020-12-22 15:36:00'),
(152, '1023', 'Visit Menu', 102, '2020-12-22 15:41:57', '2020-12-22 15:41:57'),
(153, '1003', 'Deals Menu', 100, '2020-12-22 15:44:21', '2020-12-22 15:44:21'),
(154, '1020', 'Add Visits', 102, '2020-12-22 15:47:58', '2020-12-22 15:47:58'),
(155, '1021', 'Delete Visits', 102, '2020-12-22 15:48:09', '2020-12-22 15:48:09'),
(156, '1022', 'Edit Visits', 102, '2020-12-22 15:48:22', '2020-12-22 15:48:22'),
(157, '1030', 'Create Agreement', 103, '2020-12-22 16:24:14', '2020-12-22 16:24:14'),
(158, '1031', 'Download Agreement', 103, '2020-12-22 16:24:29', '2020-12-22 16:24:29'),
(162, '171', 'Create Article', 17, '2020-12-23 13:20:28', NULL),
(163, '172', 'Edit Article', 17, '2020-12-23 13:20:34', NULL),
(164, '173', 'Delete Article', 17, '2020-12-23 13:20:50', '2020-12-23 13:20:50'),
(169, '174', 'Create Category', 17, '2020-12-23 13:20:50', '2020-12-23 13:20:50'),
(170, '175', 'Edit Category', 17, '2020-12-23 13:20:50', '2020-12-23 13:20:50'),
(171, '176', 'Delete Category', 17, '2020-12-23 13:20:50', '2020-12-23 13:20:50'),
(172, '123', 'Ticket Report', 12, '2020-12-23 13:20:50', '2020-12-23 13:20:50'),
(173, '524', 'Add problem', 52, '2020-12-23 13:20:50', '2020-12-23 13:20:50'),
(174, '525', 'Edit Problem', 52, NULL, NULL),
(183, '526', 'Delete Problem', 52, NULL, NULL),
(184, '527', 'Add Nature of Complaint', 52, NULL, NULL),
(185, '528', 'Edit Nature of complaint', 52, NULL, NULL),
(186, '529', 'Delete Nature of Complaint', 52, NULL, NULL),
(187, '5210', 'Add Referred By', 52, NULL, NULL),
(188, '5211', 'Edit Referred By', 52, NULL, NULL),
(189, '5212', 'Delete Referred By', 52, NULL, NULL),
(190, '263', 'Edit Target', 26, '2020-09-28 17:40:05', '2020-09-28 17:40:05'),
(191, '264', 'Delete Target', 26, '2020-09-28 17:40:05', '2020-09-28 17:40:05'),
(192, '221', 'Auto Bulk Dial', 22, '2020-09-28 16:52:09', '2020-09-28 16:52:09'),
(193, 'A61', 'Import', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msg_logs`
--

CREATE TABLE `msg_logs` (
  `id` int(11) NOT NULL,
  `related_id` varchar(20) NOT NULL,
  `timelineId` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '0=>enquiry,1=>tickets',
  `msg_type` int(11) NOT NULL COMMENT '0=>mail,1=>sms,2=>whatsapp',
  `receiver` varchar(111) NOT NULL COMMENT 'receiver \r\nemail or mobile',
  `temp_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `msg` mediumtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attachment` text NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_parameters`
--

CREATE TABLE `order_parameters` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `order_parameter` varchar(100) DEFAULT NULL,
  `order_value` text,
  `type` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ord_prod_stage`
--

CREATE TABLE `ord_prod_stage` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `ord_no` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remark` text,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paisa_expo_enquiry_meta`
--

CREATE TABLE `paisa_expo_enquiry_meta` (
  `id` int(11) NOT NULL,
  `enquiry_code` varchar(1000) NOT NULL,
  `paisaexpo_processid` varchar(1000) DEFAULT NULL,
  `paisaexpo_customerid` varchar(1000) DEFAULT NULL,
  `paisaexpo_requestid` varchar(1000) DEFAULT NULL,
  `date_updated` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `ord_id` varchar(100) DEFAULT NULL,
  `tot_pay` int(10) NOT NULL,
  `prev_balance` int(10) DEFAULT NULL,
  `pay` int(10) DEFAULT NULL,
  `balance` int(10) DEFAULT NULL,
  `advance_pay` int(10) DEFAULT NULL,
  `pay_mode` int(10) DEFAULT NULL,
  `transaction_no` varchar(100) DEFAULT NULL,
  `cust_id` int(10) DEFAULT NULL,
  `added_by` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `approve` int(10) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `next_pay` date NOT NULL,
  `remark` text,
  `created_date` datetime NOT NULL,
  `company` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `method` varchar(50) DEFAULT NULL,
  `ins_id` int(11) DEFAULT NULL,
  `txnid` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `response` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `portals`
--

CREATE TABLE `portals` (
  `portal_id` int(11) NOT NULL,
  `p_integration_name` varchar(150) DEFAULT NULL,
  `p_source` varchar(150) DEFAULT NULL,
  `p_key` varchar(150) DEFAULT NULL,
  `p_primaryno` varchar(20) DEFAULT NULL,
  `p_assignto` varchar(150) DEFAULT NULL,
  `p_created_date` varchar(150) DEFAULT NULL,
  `portal_type` int(11) NOT NULL,
  `portal_created_by` int(11) NOT NULL,
  `p_userid` varchar(100) DEFAULT NULL,
  `p_profileid` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_fields`
--

CREATE TABLE `product_fields` (
  `id` int(10) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `parent` int(10) NOT NULL,
  `input` int(10) NOT NULL,
  `fvalue` text NOT NULL,
  `cmp_no` int(11) NOT NULL,
  `usrno` int(10) NOT NULL,
  `status` int(100) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `query_response`
--

CREATE TABLE `query_response` (
  `resp_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `query_id` varchar(100) DEFAULT NULL,
  `notification_id` varchar(1000) DEFAULT NULL,
  `noti_read` int(11) NOT NULL DEFAULT '0',
  `contact_person` varchar(100) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `conversation` text,
  `distance_from` varchar(255) DEFAULT NULL,
  `distance_to` varchar(255) DEFAULT NULL,
  `km` varchar(255) DEFAULT NULL,
  `mode` varchar(34) DEFAULT NULL,
  `subject` text,
  `bilable` int(11) DEFAULT NULL,
  `upd_date` varchar(255) DEFAULT NULL,
  `nxt_date` varchar(255) DEFAULT NULL,
  `task_type` int(11) DEFAULT NULL COMMENT '16=ecommerce notification',
  `create_by` int(11) NOT NULL,
  `task_status` int(11) DEFAULT NULL COMMENT '1for not start,2 in progress,3 weating,4 Deferred,5 complete',
  `task_date` varchar(15) DEFAULT NULL,
  `task_time` varchar(15) DEFAULT NULL,
  `task_remark` text,
  `related_to` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `filters` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `time_zone` varchar(100) DEFAULT NULL,
  `domain` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `comp_id`, `title`, `description`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`, `time_zone`, `domain`) VALUES
(2, 0, 'Archiz Solutions', '', '', '', 'assets/images/apps/e398f3b0b2d11cbe6726f2b4c9d6777e.jpg', 'assets/images/icons/7d6c74e4011638f161c87b17421ef948.jpg', 'english', 'LTR', '2020 Archiz Solutions ©Copyright', 'Asia/Dili', 'thecrm360.com');

-- --------------------------------------------------------

--
-- Table structure for table `sms_send_log`
--

CREATE TABLE `sms_send_log` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `mobile_no` varchar(15) NOT NULL,
  `response` text NOT NULL,
  `url` text,
  `created_by` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_status`
--

CREATE TABLE `support_ticket_status` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_parameters`
--

CREATE TABLE `sys_parameters` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `sys_para` varchar(100) NOT NULL,
  `sys_value` varchar(5000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_slab`
--

CREATE TABLE `tax_slab` (
  `id` int(100) NOT NULL,
  `tax` varchar(250) NOT NULL,
  `dividend` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbll_modules`
--

CREATE TABLE `tbll_modules` (
  `m_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `m_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `pk_i_admin_id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `user_roles` int(1) DEFAULT NULL,
  `user_permissions` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `s_username` varchar(100) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `s_display_name` varchar(255) DEFAULT NULL COMMENT 'as first name',
  `last_name` varchar(64) DEFAULT NULL,
  `date_of_birth` varchar(64) DEFAULT NULL,
  `joining_date` varchar(50) DEFAULT NULL,
  `anniversary` varchar(64) DEFAULT NULL,
  `designation` varchar(64) DEFAULT NULL,
  `employee_band` varchar(64) DEFAULT NULL,
  `orgisation_name` varchar(100) NOT NULL,
  `country` varchar(64) DEFAULT NULL,
  `region` varchar(64) DEFAULT NULL,
  `territory_name` varchar(64) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `companey_id` int(11) NOT NULL,
  `s_user_email` varchar(50) DEFAULT NULL,
  `second_email` varchar(50) DEFAULT NULL,
  `second_phone` varchar(15) DEFAULT NULL,
  `contact_pname` varchar(50) DEFAULT NULL,
  `contact_pemail` varchar(50) DEFAULT NULL,
  `contact_semail` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(15) DEFAULT NULL,
  `contact_sphone` varchar(15) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `modules` varchar(255) NOT NULL,
  `s_phoneno` varchar(255) DEFAULT NULL,
  `add_ress` varchar(255) NOT NULL,
  `report_to` int(11) DEFAULT NULL,
  `partner_type` int(11) NOT NULL,
  `fk_i_group_id` char(1) NOT NULL,
  `fk_i_created_by` int(11) NOT NULL,
  `dt_create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `fk_i_updated_by` int(11) DEFAULT NULL,
  `dt_update_date` datetime DEFAULT NULL,
  `b_status` tinyint(1) NOT NULL DEFAULT '1',
  `inactive_date` varchar(20) DEFAULT NULL,
  `picture` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `b_is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_password` int(11) NOT NULL DEFAULT '0' COMMENT '0=normal,1=link-sent',
  `fk_i_tenant_id` int(11) NOT NULL DEFAULT '0',
  `process` varchar(100) DEFAULT NULL,
  `datasource` varchar(100) DEFAULT NULL,
  `products` varchar(255) DEFAULT NULL,
  `telephony_agent_id` varchar(20) DEFAULT NULL,
  `telephony_token` varchar(50) DEFAULT NULL,
  `public_ivr_id` varchar(100) NOT NULL,
  `telephony_compid` varchar(50) NOT NULL,
  `telephony_comp_token` varchar(255) NOT NULL,
  `mobile_token` varchar(10000) DEFAULT NULL,
  `last_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `zoom_id` varchar(255) DEFAULT NULL,
  `time_slot` varchar(255) DEFAULT NULL,
  `intrested_area` varchar(255) DEFAULT NULL,
  `inst_name` varchar(255) DEFAULT NULL,
  `availability` varchar(200) DEFAULT '1',
  `start_billing_date` date DEFAULT NULL,
  `valid_upto_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`pk_i_admin_id`, `employee_id`, `user_roles`, `user_permissions`, `user_type`, `s_username`, `s_password`, `s_display_name`, `last_name`, `date_of_birth`, `joining_date`, `anniversary`, `designation`, `employee_band`, `orgisation_name`, `country`, `region`, `territory_name`, `state_id`, `city_id`, `companey_id`, `s_user_email`, `second_email`, `second_phone`, `contact_pname`, `contact_pemail`, `contact_semail`, `contact_phone`, `contact_sphone`, `discount`, `modules`, `s_phoneno`, `add_ress`, `report_to`, `partner_type`, `fk_i_group_id`, `fk_i_created_by`, `dt_create_date`, `fk_i_updated_by`, `dt_update_date`, `b_status`, `inactive_date`, `picture`, `ip_address`, `b_is_deleted`, `reset_password`, `fk_i_tenant_id`, `process`, `datasource`, `products`, `telephony_agent_id`, `telephony_token`, `public_ivr_id`, `telephony_compid`, `telephony_comp_token`, `mobile_token`, `last_log`, `zoom_id`, `time_slot`, `intrested_area`, `inst_name`, `availability`, `start_billing_date`, `valid_upto_date`) VALUES
(155, '', NULL, '1', 1, '', 'ff2d4d3dcf3aaa64259efd28efbdedc8', 'Super Admin', 'system', '2020-02-08', '2020-02-08', NULL, '', '', '', '', '', '', 0, 0, 0, 'admin@archizsolutions.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '1234567890', '', 0, 0, '', 0, '2020-02-08 18:09:39', NULL, NULL, 1, '', '', '', 0, 0, 0, '2,3,4', '', NULL, NULL, '', '', '', '', '', '2021-01-04 12:59:58', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aggriment`
--

CREATE TABLE `tbl_aggriment` (
  `id` int(11) NOT NULL,
  `enq_id` varchar(100) DEFAULT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `agg_name` varchar(100) DEFAULT NULL,
  `agg_phone` varchar(20) DEFAULT NULL,
  `agg_email` varchar(100) DEFAULT NULL,
  `agg_adrs` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `agg_date` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amc`
--

CREATE TABLE `tbl_amc` (
  `id` int(100) NOT NULL,
  `comp_id` int(10) NOT NULL,
  `uid` int(100) NOT NULL,
  `enq_id` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `amc_fromdate` datetime NOT NULL,
  `amc_todate` datetime NOT NULL,
  `po` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apnt`
--

CREATE TABLE `tbl_apnt` (
  `id` int(11) NOT NULL,
  `schdl_id` int(100) NOT NULL,
  `apid` varchar(250) NOT NULL,
  `uni` varchar(100) DEFAULT NULL,
  `crs` varchar(100) DEFAULT NULL,
  `ptid` varchar(250) NOT NULL,
  `patid` int(100) NOT NULL,
  `hid` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `did` varchar(100) NOT NULL,
  `apdt` date NOT NULL,
  `ty` varchar(250) NOT NULL,
  `tmslt` varchar(250) NOT NULL,
  `sessty` varchar(250) NOT NULL,
  `prp` varchar(250) NOT NULL,
  `sts` int(100) NOT NULL COMMENT '2=Pending 1=Approved 0=Not Approved 3=Waitlist ',
  `pay_sts` int(100) NOT NULL COMMENT '1=successful 0=Failed 2=Pending 3=Paid',
  `apnt_sts` int(100) NOT NULL COMMENT '1=Fresh,2=Assigned',
  `remark` varchar(100) NOT NULL,
  `cd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `zoin` varchar(10) DEFAULT '0',
  `queue` int(15) NOT NULL,
  `flag` int(15) NOT NULL,
  `zoomid` int(15) NOT NULL,
  `atmptstst` int(10) NOT NULL COMMENT '1=not attempt'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `a_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `a_name` varchar(50) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `area_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL,
  `ubdated_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_notification`
--

CREATE TABLE `tbl_assign_notification` (
  `assign_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `enq_code` varchar(20) NOT NULL,
  `enq_id` varchar(30) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `notification_type` int(11) NOT NULL COMMENT 'type=1 for installation,2 for leads,0 for enquery',
  `assign_status` int(11) NOT NULL COMMENT 'unchked=0,checked=1',
  `assign_date` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `update_date` varchar(29) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `check_in_time` datetime NOT NULL,
  `check_out_time` datetime NOT NULL,
  `task_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id` int(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` int(100) NOT NULL,
  `comp_id` int(15) NOT NULL,
  `typeofpro` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(15) NOT NULL COMMENT '1=Active 0=Inactive',
  `created_by` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=knowledge_base',
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_center`
--

CREATE TABLE `tbl_center` (
  `center_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `center_name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_contacts`
--

CREATE TABLE `tbl_client_contacts` (
  `cc_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `client_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `other_detail` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_close_family`
--

CREATE TABLE `tbl_close_family` (
  `cf_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `unique_number` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `country_id` int(10) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `visa_status` char(1) NOT NULL DEFAULT '1',
  `they_help` char(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_col_log`
--

CREATE TABLE `tbl_col_log` (
  `id` int(11) NOT NULL,
  `uid` varchar(150) NOT NULL,
  `enq_id` varchar(130) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `cll_state` int(11) NOT NULL,
  `users` varchar(255) NOT NULL,
  `json_data` json NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comission`
--

CREATE TABLE `tbl_comission` (
  `id` int(100) NOT NULL,
  `Enquiry_code` varchar(255) NOT NULL,
  `amt_disb` int(100) NOT NULL,
  `comission` int(100) NOT NULL,
  `amt_earned` int(100) NOT NULL,
  `date_of_payment` datetime DEFAULT NULL,
  `tds` int(100) NOT NULL,
  `amt_paid` int(100) NOT NULL,
  `payout_per` int(100) NOT NULL,
  `month` varchar(255) NOT NULL,
  `created_by` int(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comm_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `lead_id` varchar(255) NOT NULL,
  `comment_msg` varchar(255) NOT NULL,
  `drop_status` int(100) NOT NULL,
  `drop_reason` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `assigned_user` int(11) DEFAULT NULL,
  `coment_type` int(11) NOT NULL COMMENT '5 for voice call,6 for email in timeline',
  `stage_id` varchar(10) DEFAULT NULL,
  `stage_description` varchar(255) DEFAULT NULL,
  `remark` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_competencies`
--

CREATE TABLE `tbl_competencies` (
  `c_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `l_id` varchar(255) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `c_status` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `id_c` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_name` varchar(50) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `companey_id` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `c_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `crs_id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `institute_id` varchar(20) DEFAULT NULL,
  `length_id` varchar(20) DEFAULT NULL,
  `level_id` varchar(20) DEFAULT NULL,
  `discipline_id` varchar(20) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_ielts` varchar(20) DEFAULT NULL,
  `crs_name` int(15) NOT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `course_image` varchar(255) DEFAULT NULL,
  `course_rating` varchar(20) DEFAULT NULL,
  `course_discription` text,
  `meta_key` varchar(255) DEFAULT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `title_name` varchar(255) DEFAULT NULL,
  `start_date` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `annual_fees` varchar(255) DEFAULT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `campus` varchar(100) DEFAULT NULL,
  `country_list` varchar(100) DEFAULT NULL,
  `city_list` varchar(100) DEFAULT NULL,
  `tuition_fees` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_crsmaster`
--

CREATE TABLE `tbl_crsmaster` (
  `id` int(100) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `status` int(100) NOT NULL,
  `created_by` int(15) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_type`
--

CREATE TABLE `tbl_customer_type` (
  `cus_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `customer_type` varchar(100) NOT NULL,
  `added_on` varchar(64) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` varchar(64) NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '0= incative, 1=active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_datasource`
--

CREATE TABLE `tbl_datasource` (
  `datasource_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `datasource_name` varchar(50) NOT NULL,
  `companey_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dept`
--

CREATE TABLE `tbl_dept` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discipline`
--

CREATE TABLE `tbl_discipline` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `discipline` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_docTemplate`
--

CREATE TABLE `tbl_docTemplate` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drop`
--

CREATE TABLE `tbl_drop` (
  `d_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `drop_reason` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education`
--

CREATE TABLE `tbl_education` (
  `edu_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `unique_number` varchar(255) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `university` varchar(64) DEFAULT NULL,
  `passing_year` varchar(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_english`
--

CREATE TABLE `tbl_english` (
  `id` int(11) NOT NULL,
  `cmp_no` varchar(20) DEFAULT NULL,
  `enq_id` varchar(100) DEFAULT NULL,
  `exam_ielts` varchar(20) DEFAULT NULL,
  `ieltsappeard` varchar(20) DEFAULT NULL,
  `ieltsdate` varchar(20) DEFAULT NULL,
  `ieltslisten` varchar(100) DEFAULT NULL,
  `ieltsread` varchar(100) DEFAULT NULL,
  `ieltswrite` varchar(100) DEFAULT NULL,
  `ieltsspeak` varchar(100) DEFAULT NULL,
  `ieltsfinal` varchar(100) DEFAULT NULL,
  `exam_pte` varchar(20) DEFAULT NULL,
  `pteappeard` varchar(100) DEFAULT NULL,
  `ptedt` varchar(20) DEFAULT NULL,
  `ptelisten` varchar(20) DEFAULT NULL,
  `pteread` varchar(20) DEFAULT NULL,
  `ptewrite` varchar(20) DEFAULT NULL,
  `ptespeak` varchar(20) DEFAULT NULL,
  `ptefinal` varchar(100) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enqstatus`
--

CREATE TABLE `tbl_enqstatus` (
  `id` int(100) NOT NULL,
  `enquiry_code` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `status` enum('1','2') NOT NULL COMMENT '1=Read,2=Unread',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry_products`
--

CREATE TABLE `tbl_enquiry_products` (
  `tbl_enquiry_products_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `enquiry_id` int(11) NOT NULL,
  `sb_id` int(11) NOT NULL COMMENT 'primary table= tbl_product'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(100) NOT NULL,
  `que_type` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `comp_id` int(15) NOT NULL,
  `created_by` int(15) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(100) NOT NULL,
  `enquiry_id` varchar(255) NOT NULL,
  `tab_id` int(100) NOT NULL,
  `parent` int(100) NOT NULL,
  `input` int(100) NOT NULL,
  `fvalue` varchar(255) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `status` int(100) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_filterdata`
--

CREATE TABLE `tbl_filterdata` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comp_id` int(11) NOT NULL,
  `filter_data` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '2=>ticket,1=>enquiry\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_followupAvgtime`
--

CREATE TABLE `tbl_followupAvgtime` (
  `fatId` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `enq_id` bigint(10) NOT NULL,
  `type` int(11) NOT NULL,
  `time` float NOT NULL,
  `date1` datetime DEFAULT NULL,
  `date2` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forecast`
--

CREATE TABLE `tbl_forecast` (
  `id` int(11) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `fu_id` int(100) NOT NULL,
  `fp_id` varchar(255) DEFAULT NULL,
  `f_jan` varchar(255) DEFAULT NULL,
  `f_feb` varchar(255) DEFAULT NULL,
  `f_mar` varchar(255) DEFAULT NULL,
  `f_apr` varchar(255) DEFAULT NULL,
  `f_may` varchar(255) DEFAULT NULL,
  `f_jun` varchar(255) DEFAULT NULL,
  `f_jly` varchar(255) DEFAULT NULL,
  `f_aug` varchar(255) DEFAULT NULL,
  `f_sep` varchar(255) DEFAULT NULL,
  `f_oct` varchar(255) DEFAULT NULL,
  `f_nov` varchar(255) DEFAULT NULL,
  `f_dece` varchar(255) DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goals`
--

CREATE TABLE `tbl_goals` (
  `goal_id` int(11) NOT NULL,
  `goal_period` varchar(100) NOT NULL,
  `products` text NOT NULL,
  `time_range` varchar(100) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `goal_type` varchar(100) NOT NULL,
  `team_id` int(11) NOT NULL,
  `goal_for` varchar(1000) NOT NULL,
  `custom_target` varchar(5000) NOT NULL,
  `metric_type` varchar(10) NOT NULL,
  `target_value` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `process_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_input`
--

CREATE TABLE `tbl_input` (
  `input_id` int(11) NOT NULL,
  `input_place` varchar(50) NOT NULL,
  `input_label` varchar(255) NOT NULL,
  `rep_label` varchar(100) DEFAULT NULL,
  `input_values` text NOT NULL,
  `input_name` varchar(255) NOT NULL,
  `input_type` varchar(11) NOT NULL,
  `fld_attributes` varchar(1000) DEFAULT NULL,
  `function` varchar(11) DEFAULT NULL,
  `label_required` tinyint(1) DEFAULT NULL,
  `readonly` int(11) DEFAULT NULL,
  `disabled` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT '0' COMMENT '0=Sales,1=Product,2=Support',
  `form_id` int(11) DEFAULT '0',
  `company_id` int(100) NOT NULL,
  `process_id` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `fld_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `tbl_input`
--
DELIMITER $$
CREATE TRIGGER `tbl_input_delete` AFTER DELETE ON `tbl_input` FOR EACH ROW BEGIN
DELETE from extra_enquery where input=OLD.input_id;
DELETE from ticket_dynamic_data where input=OLD.input_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_institute`
--

CREATE TABLE `tbl_institute` (
  `institute_id` int(11) NOT NULL,
  `comp_id` int(20) DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `state_id` varchar(20) DEFAULT NULL,
  `univ_id` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `agreement_comision` varchar(100) DEFAULT NULL,
  `agreement_doc` varchar(255) DEFAULT NULL,
  `from_date` varchar(100) DEFAULT NULL,
  `to_date` varchar(100) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `institute_name` varchar(100) NOT NULL,
  `ins_desc` text,
  `descp` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(100) NOT NULL,
  `comp_id` int(15) NOT NULL,
  `skuid` varchar(100) NOT NULL,
  `batchno` varchar(100) NOT NULL,
  `serialno` varchar(255) NOT NULL,
  `product_name` int(100) NOT NULL,
  `warehouse` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `brand` int(100) DEFAULT NULL,
  `created_by` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kyc`
--

CREATE TABLE `tbl_kyc` (
  `kyc_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `unique_number` varchar(255) NOT NULL,
  `doc_name` varchar(100) DEFAULT NULL,
  `doc_number` varchar(20) DEFAULT NULL,
  `doc_file` varchar(255) DEFAULT NULL,
  `doc_validity` varchar(10) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_length`
--

CREATE TABLE `tbl_length` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `level_id` varchar(100) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `l_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `l_name` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `l_status` tinyint(1) NOT NULL,
  `create_date` date NOT NULL,
  `create_by` int(11) NOT NULL,
  `ubdated_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_levels`
--

CREATE TABLE `tbl_levels` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_module`
--

CREATE TABLE `tbl_module` (
  `mo_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `p_id` varchar(100) NOT NULL,
  `q_id` varchar(255) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `updated_by` int(20) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_name_prefix`
--

CREATE TABLE `tbl_name_prefix` (
  `np_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `prefix` varchar(64) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(64) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` varchar(64) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nature_of_complaint`
--

CREATE TABLE `tbl_nature_of_complaint` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newdeal`
--

CREATE TABLE `tbl_newdeal` (
  `id` int(100) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `product` int(100) NOT NULL,
  `enq_id` varchar(255) NOT NULL,
  `created_by` int(100) NOT NULL,
  `updated_by` int(100) NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) NOT NULL,
  `ord_no` varchar(100) NOT NULL,
  `cus_id` int(100) NOT NULL,
  `preferd_by` int(20) DEFAULT NULL,
  `enq_no` varchar(100) NOT NULL,
  `payment_mode` int(11) NOT NULL DEFAULT '0' COMMENT '1=COD,2=ONLINE',
  `warehouse` int(10) DEFAULT NULL,
  `product` varchar(10) DEFAULT NULL,
  `conf_delv` int(10) NOT NULL,
  `deliver_by` varchar(11) DEFAULT NULL,
  `pend_delv` int(10) NOT NULL,
  `delvr_date` date DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  `scheme` int(10) DEFAULT NULL,
  `quantity` varchar(10) DEFAULT '0',
  `price` int(10) DEFAULT NULL,
  `offer` varchar(100) DEFAULT '0',
  `tax` int(10) NOT NULL,
  `details` text,
  `disc_meth` int(10) DEFAULT NULL,
  `disc_price` int(10) NOT NULL,
  `disc_type` int(10) NOT NULL,
  `other_price` int(100) DEFAULT NULL,
  `total_price` int(100) DEFAULT NULL,
  `addedby` int(10) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `company` int(10) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `is_invoice_generated` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `id` int(20) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `status` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parameter`
--

CREATE TABLE `tbl_parameter` (
  `p_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `p_name` varchar(255) NOT NULL,
  `p_tools` varchar(100) NOT NULL,
  `p_investment_type` int(11) NOT NULL,
  `p_mode` varchar(50) NOT NULL,
  `p_day` int(11) NOT NULL,
  `Minum_core` int(11) NOT NULL,
  `Maximum_score` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `c_id` varchar(255) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `p_status` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `enq_id` varchar(100) NOT NULL,
  `stage_id` varchar(100) NOT NULL,
  `desc_id` varchar(100) NOT NULL,
  `pay_mode` varchar(100) NOT NULL,
  `pay_type` varchar(100) DEFAULT NULL,
  `ins_dt` varchar(100) DEFAULT NULL,
  `ins_amt` varchar(100) DEFAULT NULL,
  `reg_amt` varchar(50) DEFAULT NULL,
  `stamp_amt` varchar(50) DEFAULT NULL,
  `recieved_amt` varchar(50) DEFAULT NULL,
  `recieved_date` varchar(20) DEFAULT NULL,
  `pay_status` varchar(20) DEFAULT '0',
  `cmp_no` varchar(20) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personal_details`
--

CREATE TABLE `tbl_personal_details` (
  `pd_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `unique_number` varchar(255) NOT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `marital_status` varchar(15) DEFAULT NULL,
  `last_comm` varchar(10) DEFAULT NULL,
  `mode_of_comm` varchar(50) DEFAULT '0',
  `remark` text,
  `mother_tongue` varchar(20) DEFAULT NULL,
  `other_language` text,
  `corres_add_line1` varchar(100) DEFAULT NULL,
  `corres_add_line2` varchar(100) DEFAULT NULL,
  `corres_add_line3` varchar(100) DEFAULT NULL,
  `corres_country_id` int(10) DEFAULT NULL,
  `corres_state_id` int(10) DEFAULT NULL,
  `corres_district_id` int(10) DEFAULT NULL,
  `corres_pincode` int(6) DEFAULT NULL,
  `corres_landmark` varchar(20) DEFAULT NULL,
  `perm_add_line1` varchar(100) DEFAULT NULL,
  `perm_add_line2` varchar(100) DEFAULT NULL,
  `perm_add_line3` varchar(100) DEFAULT NULL,
  `perm_country_id` int(10) DEFAULT NULL,
  `perm_state_id` int(10) DEFAULT NULL,
  `perm_district_id` int(10) DEFAULT NULL,
  `perm_pincode` int(6) DEFAULT NULL,
  `perm_landmark` varchar(20) DEFAULT NULL,
  `created_by` varchar(11) DEFAULT NULL,
  `created_date` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proddetails`
--

CREATE TABLE `tbl_proddetails` (
  `id` int(10) NOT NULL,
  `prodid` int(10) DEFAULT NULL,
  `process` varchar(1000) DEFAULT NULL,
  `scheme` int(10) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `stockid` int(10) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `othr_price` int(10) NOT NULL,
  `tax` int(10) NOT NULL,
  `total_price` int(10) NOT NULL,
  `last_update` datetime NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `sub_image` text,
  `category` int(10) NOT NULL,
  `subcatogory` int(10) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `details` text,
  `hsn` varchar(10) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `skuid` varchar(1000) DEFAULT NULL,
  `brand` varchar(1000) DEFAULT NULL,
  `measurement_unit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `sb_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `product_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `main_fun` int(11) DEFAULT '0',
  `status` char(1) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL,
  `added_on` varchar(34) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_country`
--

CREATE TABLE `tbl_product_country` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_name` varchar(200) NOT NULL,
  `hsn_sac` varchar(100) NOT NULL,
  `companey_id` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `gst` varchar(250) DEFAULT NULL,
  `minimum_order_quantity` int(11) DEFAULT NULL,
  `skuid` varchar(255) NOT NULL,
  `typeofpro` int(100) NOT NULL,
  `brand` int(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qualification`
--

CREATE TABLE `tbl_qualification` (
  `id` int(11) NOT NULL,
  `cmp_no` varchar(20) DEFAULT NULL,
  `enq_id` varchar(100) DEFAULT NULL,
  `xiipassfrom` varchar(20) DEFAULT NULL,
  `xiipassto` varchar(20) DEFAULT NULL,
  `xiiper` varchar(100) DEFAULT NULL,
  `xiimb` varchar(100) DEFAULT NULL,
  `xiieng` varchar(100) DEFAULT NULL,
  `xiistrm` varchar(100) DEFAULT NULL,
  `xiispec` varchar(100) DEFAULT NULL,
  `dpassfrom` varchar(20) DEFAULT NULL,
  `dpassto` varchar(20) DEFAULT NULL,
  `dper` varchar(100) DEFAULT NULL,
  `dback` varchar(100) DEFAULT NULL,
  `dtype` varchar(100) NOT NULL,
  `bpassfrom` varchar(20) DEFAULT NULL,
  `bpassto` varchar(20) DEFAULT NULL,
  `bper` varchar(100) DEFAULT NULL,
  `bback` varchar(100) DEFAULT NULL,
  `btype` varchar(100) DEFAULT NULL,
  `bspec` varchar(100) DEFAULT NULL,
  `pgpassfrom` varchar(20) DEFAULT NULL,
  `pgpassto` varchar(20) DEFAULT NULL,
  `pgper` varchar(100) DEFAULT NULL,
  `pgback` varchar(100) DEFAULT NULL,
  `pgmtype` varchar(100) DEFAULT NULL,
  `pgexp` varchar(100) DEFAULT NULL,
  `pgjob` varchar(100) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_referred_by`
--

CREATE TABLE `tbl_referred_by` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Consignee,2=Consigner,3=Internal',
  `name` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_region`
--

CREATE TABLE `tbl_region` (
  `region_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `region_name` varchar(100) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `companey_id` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schdl`
--

CREATE TABLE `tbl_schdl` (
  `id` int(11) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `buid` varchar(100) NOT NULL,
  `stu_id` int(100) NOT NULL,
  `uni_id` int(100) NOT NULL,
  `ins_id` int(100) DEFAULT NULL,
  `crs_id` varchar(100) DEFAULT NULL,
  `schdl_dt` date NOT NULL,
  `stm` varchar(250) DEFAULT NULL,
  `avblty` varchar(250) DEFAULT NULL,
  `ty` varchar(250) DEFAULT NULL,
  `schl_sts` int(100) NOT NULL COMMENT '1="Booked",2="Not Booked"',
  `apt` int(10) NOT NULL,
  `sts` int(100) NOT NULL COMMENT '1=Active, 0=Inactive',
  `cd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `zoom_response` text,
  `zoin` varchar(10) DEFAULT '0',
  `flag` int(15) NOT NULL,
  `zoomid` int(15) NOT NULL,
  `break_starttime` varchar(100) NOT NULL,
  `break_stoptime` varchar(100) NOT NULL,
  `total_breaktime` varchar(100) NOT NULL,
  `break_count` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scheme`
--

CREATE TABLE `tbl_scheme` (
  `id` int(100) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `coupan` varchar(100) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `scm_apply` int(10) DEFAULT NULL,
  `scm_field` varchar(100) DEFAULT NULL,
  `scm_specific_flld` text NOT NULL,
  `all_apply` varchar(100) DEFAULT NULL,
  `by_prdt` varchar(100) DEFAULT NULL,
  `prdt_val` varchar(100) DEFAULT NULL,
  `by_pay` varchar(100) DEFAULT NULL,
  `pay_val` varchar(100) DEFAULT NULL,
  `usr_loc` varchar(100) DEFAULT NULL,
  `loc_id` varchar(100) DEFAULT NULL,
  `usr_type` varchar(100) DEFAULT NULL,
  `usr_fld` varchar(100) DEFAULT NULL,
  `apply_qty` int(10) NOT NULL,
  `from_qty` int(100) DEFAULT NULL,
  `to_qty` int(100) DEFAULT NULL,
  `discount` decimal(50,2) DEFAULT NULL,
  `calc_type` int(10) DEFAULT NULL,
  `calc_mth` int(10) DEFAULT NULL,
  `added_by` int(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company` int(10) NOT NULL,
  `status` int(15) NOT NULL,
  `scheme_type` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_profile`
--

CREATE TABLE `tbl_social_profile` (
  `sp_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `unique_number` varchar(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `profile` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stage_changed`
--

CREATE TABLE `tbl_stage_changed` (
  `stg_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `enq_id` varchar(20) NOT NULL,
  `stg_date` varchar(15) NOT NULL,
  `stg_stage` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `id` int(11) NOT NULL,
  `subcat_name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `comp_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subsource`
--

CREATE TABLE `tbl_subsource` (
  `subsource_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `lead_source_id` int(11) NOT NULL,
  `subsource_name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_target`
--

CREATE TABLE `tbl_target` (
  `id` int(11) NOT NULL,
  `comp_id` int(100) DEFAULT NULL,
  `u_id` int(100) DEFAULT NULL,
  `p_id` varchar(255) DEFAULT NULL,
  `jan` varchar(255) DEFAULT NULL,
  `feb` varchar(255) DEFAULT NULL,
  `mar` varchar(255) DEFAULT NULL,
  `apr` varchar(255) DEFAULT NULL,
  `may` varchar(255) DEFAULT NULL,
  `jun` varchar(255) DEFAULT NULL,
  `jly` varchar(255) DEFAULT NULL,
  `aug` varchar(255) DEFAULT NULL,
  `sep` varchar(255) DEFAULT NULL,
  `oct` varchar(255) DEFAULT NULL,
  `nov` varchar(255) DEFAULT NULL,
  `dece` varchar(255) DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taskstatus`
--

CREATE TABLE `tbl_taskstatus` (
  `taskstatus_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `taskstatus_name` varchar(50) NOT NULL,
  `companey_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_territory`
--

CREATE TABLE `tbl_territory` (
  `territory_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `territory_name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `companey_id` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` varchar(20) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `id` int(10) NOT NULL,
  `ticketno` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `other` varchar(100) NOT NULL,
  `product` varchar(200) NOT NULL,
  `process_id` int(11) DEFAULT NULL,
  `message` text,
  `attachment` varchar(100) DEFAULT NULL,
  `issue` varchar(100) DEFAULT NULL,
  `solution` varchar(100) DEFAULT NULL,
  `ticket_status` int(11) DEFAULT '1',
  `sourse` varchar(100) DEFAULT NULL,
  `ticket_stage` int(11) DEFAULT NULL,
  `ticket_substage` int(11) DEFAULT NULL,
  `review` text,
  `status` int(10) NOT NULL,
  `priority` int(10) NOT NULL,
  `complaint_type` enum('1','2','') NOT NULL,
  `coml_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `send_date` datetime NOT NULL,
  `client` int(10) NOT NULL,
  `assign_to` int(10) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `assigned_to_date` datetime DEFAULT NULL,
  `nextAssignTime` datetime DEFAULT NULL,
  `company` int(10) NOT NULL,
  `added_by` int(10) NOT NULL,
  `tracking_no` varchar(100) DEFAULT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `last_esc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tbl_ticket`
--
DELIMITER $$
CREATE TRIGGER `ticket_delete` AFTER DELETE ON `tbl_ticket` FOR EACH ROW BEGIN
DELETE FROM tbl_ticket_conv where tck_id=OLD.id;
DELETE FROM query_response where query_id=OLD.ticketno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_conv`
--

CREATE TABLE `tbl_ticket_conv` (
  `id` int(10) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `tck_id` varchar(100) NOT NULL,
  `parent` int(10) NOT NULL,
  `subj` varchar(200) NOT NULL,
  `msg` text NOT NULL,
  `stage` int(11) DEFAULT NULL,
  `sub_stage` int(11) DEFAULT NULL,
  `attacment` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `send_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client` int(10) NOT NULL,
  `ticket_status` int(11) DEFAULT NULL,
  `lid` int(11) DEFAULT NULL COMMENT 'leadrule id',
  `added_by` int(10) NOT NULL,
  `assignedTo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_source`
--

CREATE TABLE `tbl_ticket_source` (
  `s_id` int(11) NOT NULL,
  `source_name` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_status`
--

CREATE TABLE `tbl_ticket_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_subject`
--

CREATE TABLE `tbl_ticket_subject` (
  `id` int(11) NOT NULL,
  `subject_title` text,
  `comp_id` varchar(20) NOT NULL,
  `process_id` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_title`
--

CREATE TABLE `tbl_title` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_typeofproduct`
--

CREATE TABLE `tbl_typeofproduct` (
  `id` int(100) NOT NULL,
  `comp_id` int(100) NOT NULL,
  `warehouse` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(15) NOT NULL COMMENT '1=Active,0=Inactive',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `use_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `user_role` varchar(50) NOT NULL,
  `user_permissions` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` varchar(50) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `ipaddress` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`use_id`, `comp_id`, `user_role`, `user_permissions`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`, `ipaddress`) VALUES
(1, 0, 'Super Admin', '130,131,132,133,134,135,136,140,141,142,143,144,145,146,150,151,152,153,154,155,156,190,191,192,193,194,195,196', 1, '2019-08-11 09:46:37', 1, '', 0, 0),
(56, 0, 'Admin', '10,11,12,13,30,31,32,33,60,61,62,63,70,71,72,73,80,81,82,83,90,91,92,93,120,121,122,123,130,131,132,133,140,141,142,143', 1, '2020-02-11 04:46:05', 155, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vid`
--

CREATE TABLE `tbl_vid` (
  `id` int(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `comp_id` int(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(100) NOT NULL,
  `status` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visit`
--

CREATE TABLE `tbl_visit` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time DEFAULT NULL,
  `travelled` varchar(100) NOT NULL,
  `travelled_type` varchar(100) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `next_date` date NOT NULL,
  `next_location` varchar(300) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id` int(100) NOT NULL,
  `comp_id` int(14) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `country` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `city` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(100) DEFAULT NULL,
  `stu_id` varchar(100) DEFAULT NULL,
  `uni_id` varchar(100) DEFAULT NULL,
  `crs_id` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tck_mstr`
--

CREATE TABLE `tck_mstr` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `cmp` int(10) NOT NULL,
  `added_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `telephony_log`
--

CREATE TABLE `telephony_log` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `session_id` varchar(500) NOT NULL,
  `call_by` int(11) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `res` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_dynamic_data`
--

CREATE TABLE `ticket_dynamic_data` (
  `id` int(10) NOT NULL,
  `enq_no` varchar(100) NOT NULL COMMENT 'ticket no',
  `parent` int(10) NOT NULL,
  `input` int(10) NOT NULL,
  `fvalue` text NOT NULL,
  `cmp_no` int(11) NOT NULL,
  `usrno` int(10) NOT NULL,
  `status` int(100) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_fileds_basic`
--

CREATE TABLE `ticket_fileds_basic` (
  `id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `process_id` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `fld_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_role` tinyint(1) DEFAULT NULL,
  `company_rights` text,
  `designation` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `short_biography` text,
  `pictures` varchar(255) DEFAULT NULL,
  `specialist` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `a_name` text NOT NULL,
  `a_account_number` text NOT NULL,
  `a_ifsc` text NOT NULL,
  `a_branch` text NOT NULL,
  `a_companyname` text NOT NULL,
  `a_companyaddress` text NOT NULL,
  `modules` text NOT NULL,
  `form_edit_rights` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `account_type` int(11) DEFAULT NULL COMMENT '1: Live  2 : Trial',
  `valid_upto` datetime DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `comp_id`, `firstname`, `lastname`, `email`, `password`, `user_role`, `company_rights`, `designation`, `department_id`, `address`, `phone`, `mobile`, `short_biography`, `pictures`, `specialist`, `date_of_birth`, `sex`, `blood_group`, `degree`, `a_name`, `a_account_number`, `a_ifsc`, `a_branch`, `a_companyname`, `a_companyaddress`, `modules`, `form_edit_rights`, `created_by`, `create_date`, `account_type`, `valid_upto`, `update_date`, `status`) VALUES
(0, 0, 'Archiz ', 'CRM', 'admin@archizsolutions.com', '7b7c4d042b2ea235ce865a21fa16a435', 2, NULL, '', NULL, 'Noida', '1234567890', '1234567890', '', '', NULL, '2020-02-08', 'Male', '', '', '', '', '', '', 'New Company', '', '', '', 155, '2020-10-16', 1, '2020-10-30 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `parameter` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `website_integration`
--

CREATE TABLE `website_integration` (
  `wid` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `integration_name` varchar(200) NOT NULL,
  `source_name` varchar(200) DEFAULT NULL,
  `assign_by` varchar(200) NOT NULL,
  `capture_link` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `web_created_by` int(11) NOT NULL,
  `created_date` varchar(150) NOT NULL,
  `updated_date` varchar(150) NOT NULL,
  `integration_type` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_send_log`
--

CREATE TABLE `whatsapp_send_log` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `mobile_no` varchar(15) NOT NULL,
  `response` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `msg` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_comment`
--

CREATE TABLE `ws_comment` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `add_to_website` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_item`
--

CREATE TABLE `ws_item` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `icon_image` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `position` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `counter` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_section`
--

CREATE TABLE `ws_section` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `featured_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_setting`
--

CREATE TABLE `ws_setting` (
  `id` int(11) NOT NULL,
  `comp_id` int(20) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `twitter_api` text,
  `google_map` text,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `vimeo` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `dribbble` varchar(100) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `google_plus` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ws_slider`
--

CREATE TABLE `ws_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_link`
--

CREATE TABLE `zoom_link` (
  `id` int(11) NOT NULL,
  `comp_id` varchar(20) DEFAULT NULL,
  `ins_id` varchar(20) DEFAULT NULL,
  `schdl_dt` varchar(20) DEFAULT NULL,
  `crs_id` varchar(20) DEFAULT NULL,
  `uni_id` int(100) DEFAULT NULL,
  `ty` varchar(100) DEFAULT NULL,
  `avblty` varchar(100) DEFAULT NULL,
  `start_tm` varchar(100) DEFAULT NULL,
  `end_tm` varchar(100) DEFAULT NULL,
  `a_duration` varchar(100) DEFAULT NULL,
  `zoom_response` text,
  `cd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ud` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allleads`
--
ALTER TABLE `allleads`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `all_modules`
--
ALTER TABLE `all_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_integration`
--
ALTER TABLE `api_integration`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `api_responses`
--
ALTER TABLE `api_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_templates`
--
ALTER TABLE `api_templates`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_fields`
--
ALTER TABLE `basic_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indexes for table `commercial_info`
--
ALTER TABLE `commercial_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_sms_info`
--
ALTER TABLE `custom_sms_info`
  ADD PRIMARY KEY (`custom_sms_id`);

--
-- Indexes for table `czentrix`
--
ALTER TABLE `czentrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_connections`
--
ALTER TABLE `db_connections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dprt_id`);

--
-- Indexes for table `email_integration`
--
ALTER TABLE `email_integration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiry_id`),
  ADD UNIQUE KEY `Enquery_id` (`Enquery_id`),
  ADD KEY `enquiry_idx_is_delete_status_drop_status_countr_id_enquir_id` (`is_delete`,`status`,`drop_status`,`country_id`,`enquiry_id`),
  ADD KEY `enquiry_idx_enquiry_id` (`enquiry_id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `enquiry2`
--
ALTER TABLE `enquiry2`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `enquiry_fileds_basic`
--
ALTER TABLE `enquiry_fileds_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_enquery`
--
ALTER TABLE `extra_enquery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `input` (`input`);

--
-- Indexes for table `fb_from_details`
--
ALTER TABLE `fb_from_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_page`
--
ALTER TABLE `fb_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_setting`
--
ALTER TABLE `fb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `festivals`
--
ALTER TABLE `festivals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_process`
--
ALTER TABLE `form_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_rules`
--
ALTER TABLE `form_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indiamart_api`
--
ALTER TABLE `indiamart_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `input_types`
--
ALTER TABLE `input_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_app_status`
--
ALTER TABLE `institute_app_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_data`
--
ALTER TABLE `institute_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leadrules`
--
ALTER TABLE `leadrules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_description`
--
ALTER TABLE `lead_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_score`
--
ALTER TABLE `lead_score`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `lead_source`
--
ALTER TABLE `lead_source`
  ADD PRIMARY KEY (`lsid`);

--
-- Indexes for table `lead_stage`
--
ALTER TABLE `lead_stage`
  ADD PRIMARY KEY (`stg_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_setting`
--
ALTER TABLE `mail_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_signature`
--
ALTER TABLE `mail_signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_template_attachments`
--
ALTER TABLE `mail_template_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_attendance`
--
ALTER TABLE `map_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_location_feed`
--
ALTER TABLE `map_location_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurement_unit`
--
ALTER TABLE `measurement_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulewise_right`
--
ALTER TABLE `modulewise_right`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `right_id` (`right_id`);

--
-- Indexes for table `msg_logs`
--
ALTER TABLE `msg_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_parameters`
--
ALTER TABLE `order_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ord_prod_stage`
--
ALTER TABLE `ord_prod_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paisa_expo_enquiry_meta`
--
ALTER TABLE `paisa_expo_enquiry_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portals`
--
ALTER TABLE `portals`
  ADD PRIMARY KEY (`portal_id`);

--
-- Indexes for table `product_fields`
--
ALTER TABLE `product_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `input` (`input`);

--
-- Indexes for table `query_response`
--
ALTER TABLE `query_response`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sms_send_log`
--
ALTER TABLE `sms_send_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_status`
--
ALTER TABLE `support_ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_parameters`
--
ALTER TABLE `sys_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_slab`
--
ALTER TABLE `tax_slab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbll_modules`
--
ALTER TABLE `tbll_modules`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`pk_i_admin_id`),
  ADD UNIQUE KEY `pk_i_admin_id` (`pk_i_admin_id`),
  ADD KEY `s_phoneno` (`s_phoneno`),
  ADD KEY `s_user_email` (`s_user_email`);

--
-- Indexes for table `tbl_aggriment`
--
ALTER TABLE `tbl_aggriment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_amc`
--
ALTER TABLE `tbl_amc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_apnt`
--
ALTER TABLE `tbl_apnt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `tbl_assign_notification`
--
ALTER TABLE `tbl_assign_notification`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_center`
--
ALTER TABLE `tbl_center`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `tbl_client_contacts`
--
ALTER TABLE `tbl_client_contacts`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `tbl_close_family`
--
ALTER TABLE `tbl_close_family`
  ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `tbl_col_log`
--
ALTER TABLE `tbl_col_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comission`
--
ALTER TABLE `tbl_comission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `tbl_competencies`
--
ALTER TABLE `tbl_competencies`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id_c`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`crs_id`);

--
-- Indexes for table `tbl_crsmaster`
--
ALTER TABLE `tbl_crsmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_type`
--
ALTER TABLE `tbl_customer_type`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tbl_datasource`
--
ALTER TABLE `tbl_datasource`
  ADD PRIMARY KEY (`datasource_id`),
  ADD KEY `tbl_datasource_idx_datasource_id` (`datasource_id`);

--
-- Indexes for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_discipline`
--
ALTER TABLE `tbl_discipline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_docTemplate`
--
ALTER TABLE `tbl_docTemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_drop`
--
ALTER TABLE `tbl_drop`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tbl_education`
--
ALTER TABLE `tbl_education`
  ADD PRIMARY KEY (`edu_id`);

--
-- Indexes for table `tbl_english`
--
ALTER TABLE `tbl_english`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_enqstatus`
--
ALTER TABLE `tbl_enqstatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiry_code` (`enquiry_code`,`user_id`) USING HASH;

--
-- Indexes for table `tbl_enquiry_products`
--
ALTER TABLE `tbl_enquiry_products`
  ADD PRIMARY KEY (`tbl_enquiry_products_id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_filterdata`
--
ALTER TABLE `tbl_filterdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_followupAvgtime`
--
ALTER TABLE `tbl_followupAvgtime`
  ADD PRIMARY KEY (`fatId`);

--
-- Indexes for table `tbl_forecast`
--
ALTER TABLE `tbl_forecast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_goals`
--
ALTER TABLE `tbl_goals`
  ADD PRIMARY KEY (`goal_id`);

--
-- Indexes for table `tbl_input`
--
ALTER TABLE `tbl_input`
  ADD PRIMARY KEY (`input_id`);

--
-- Indexes for table `tbl_institute`
--
ALTER TABLE `tbl_institute`
  ADD PRIMARY KEY (`institute_id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `tbl_kyc`
--
ALTER TABLE `tbl_kyc`
  ADD PRIMARY KEY (`kyc_id`);

--
-- Indexes for table `tbl_length`
--
ALTER TABLE `tbl_length`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `tbl_levels`
--
ALTER TABLE `tbl_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_module`
--
ALTER TABLE `tbl_module`
  ADD PRIMARY KEY (`mo_id`);

--
-- Indexes for table `tbl_name_prefix`
--
ALTER TABLE `tbl_name_prefix`
  ADD PRIMARY KEY (`np_id`);

--
-- Indexes for table `tbl_nature_of_complaint`
--
ALTER TABLE `tbl_nature_of_complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newdeal`
--
ALTER TABLE `tbl_newdeal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ord_no` (`ord_no`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_parameter`
--
ALTER TABLE `tbl_parameter`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_personal_details`
--
ALTER TABLE `tbl_personal_details`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `tbl_proddetails`
--
ALTER TABLE `tbl_proddetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `prodid` (`prodid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`sb_id`),
  ADD KEY `tbl_product_idx_sb_id` (`sb_id`);

--
-- Indexes for table `tbl_product_country`
--
ALTER TABLE `tbl_product_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_referred_by`
--
ALTER TABLE `tbl_referred_by`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_region`
--
ALTER TABLE `tbl_region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `tbl_schdl`
--
ALTER TABLE `tbl_schdl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scheme`
--
ALTER TABLE `tbl_scheme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social_profile`
--
ALTER TABLE `tbl_social_profile`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `tbl_stage_changed`
--
ALTER TABLE `tbl_stage_changed`
  ADD PRIMARY KEY (`stg_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subsource`
--
ALTER TABLE `tbl_subsource`
  ADD PRIMARY KEY (`subsource_id`);

--
-- Indexes for table `tbl_target`
--
ALTER TABLE `tbl_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_taskstatus`
--
ALTER TABLE `tbl_taskstatus`
  ADD PRIMARY KEY (`taskstatus_id`);

--
-- Indexes for table `tbl_territory`
--
ALTER TABLE `tbl_territory`
  ADD PRIMARY KEY (`territory_id`);

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticketno` (`ticketno`);

--
-- Indexes for table `tbl_ticket_conv`
--
ALTER TABLE `tbl_ticket_conv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ticket_source`
--
ALTER TABLE `tbl_ticket_source`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tbl_ticket_status`
--
ALTER TABLE `tbl_ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ticket_subject`
--
ALTER TABLE `tbl_ticket_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_title`
--
ALTER TABLE `tbl_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_typeofproduct`
--
ALTER TABLE `tbl_typeofproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`use_id`);

--
-- Indexes for table `tbl_vid`
--
ALTER TABLE `tbl_vid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_visit`
--
ALTER TABLE `tbl_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tck_mstr`
--
ALTER TABLE `tck_mstr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephony_log`
--
ALTER TABLE `telephony_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_dynamic_data`
--
ALTER TABLE `ticket_dynamic_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `input` (`input`);

--
-- Indexes for table `ticket_fileds_basic`
--
ALTER TABLE `ticket_fileds_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website_integration`
--
ALTER TABLE `website_integration`
  ADD PRIMARY KEY (`wid`);

--
-- Indexes for table `whatsapp_send_log`
--
ALTER TABLE `whatsapp_send_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zoom_link`
--
ALTER TABLE `zoom_link`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allleads`
--
ALTER TABLE `allleads`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `all_modules`
--
ALTER TABLE `all_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `api_integration`
--
ALTER TABLE `api_integration`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api_responses`
--
ALTER TABLE `api_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api_templates`
--
ALTER TABLE `api_templates`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `basic_fields`
--
ALTER TABLE `basic_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ci_cookies`
--
ALTER TABLE `ci_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commercial_info`
--
ALTER TABLE `commercial_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_sms_info`
--
ALTER TABLE `custom_sms_info`
  MODIFY `custom_sms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `czentrix`
--
ALTER TABLE `czentrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `db_connections`
--
ALTER TABLE `db_connections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dprt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_integration`
--
ALTER TABLE `email_integration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry2`
--
ALTER TABLE `enquiry2`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enquiry_fileds_basic`
--
ALTER TABLE `enquiry_fileds_basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `extra_enquery`
--
ALTER TABLE `extra_enquery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_from_details`
--
ALTER TABLE `fb_from_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_page`
--
ALTER TABLE `fb_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_setting`
--
ALTER TABLE `fb_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `festivals`
--
ALTER TABLE `festivals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `form_process`
--
ALTER TABLE `form_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `form_rules`
--
ALTER TABLE `form_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `indiamart_api`
--
ALTER TABLE `indiamart_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `input_types`
--
ALTER TABLE `input_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `institute_app_status`
--
ALTER TABLE `institute_app_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `institute_data`
--
ALTER TABLE `institute_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2262;
--
-- AUTO_INCREMENT for table `leadrules`
--
ALTER TABLE `leadrules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_description`
--
ALTER TABLE `lead_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_score`
--
ALTER TABLE `lead_score`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_source`
--
ALTER TABLE `lead_source`
  MODIFY `lsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_stage`
--
ALTER TABLE `lead_stage`
  MODIFY `stg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_setting`
--
ALTER TABLE `mail_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_signature`
--
ALTER TABLE `mail_signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_template_attachments`
--
ALTER TABLE `mail_template_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `map_attendance`
--
ALTER TABLE `map_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `map_location_feed`
--
ALTER TABLE `map_location_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `measurement_unit`
--
ALTER TABLE `measurement_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modulewise_right`
--
ALTER TABLE `modulewise_right`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT for table `msg_logs`
--
ALTER TABLE `msg_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_parameters`
--
ALTER TABLE `order_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ord_prod_stage`
--
ALTER TABLE `ord_prod_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paisa_expo_enquiry_meta`
--
ALTER TABLE `paisa_expo_enquiry_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portals`
--
ALTER TABLE `portals`
  MODIFY `portal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_fields`
--
ALTER TABLE `product_fields`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `query_response`
--
ALTER TABLE `query_response`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sms_send_log`
--
ALTER TABLE `sms_send_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `support_ticket_status`
--
ALTER TABLE `support_ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_parameters`
--
ALTER TABLE `sys_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax_slab`
--
ALTER TABLE `tax_slab`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbll_modules`
--
ALTER TABLE `tbll_modules`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `pk_i_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3128;
--
-- AUTO_INCREMENT for table `tbl_aggriment`
--
ALTER TABLE `tbl_aggriment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_amc`
--
ALTER TABLE `tbl_amc`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_apnt`
--
ALTER TABLE `tbl_apnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_assign_notification`
--
ALTER TABLE `tbl_assign_notification`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_center`
--
ALTER TABLE `tbl_center`
  MODIFY `center_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_client_contacts`
--
ALTER TABLE `tbl_client_contacts`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_close_family`
--
ALTER TABLE `tbl_close_family`
  MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_col_log`
--
ALTER TABLE `tbl_col_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_comission`
--
ALTER TABLE `tbl_comission`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_competencies`
--
ALTER TABLE `tbl_competencies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id_c` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `crs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_crsmaster`
--
ALTER TABLE `tbl_crsmaster`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_customer_type`
--
ALTER TABLE `tbl_customer_type`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_datasource`
--
ALTER TABLE `tbl_datasource`
  MODIFY `datasource_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_dept`
--
ALTER TABLE `tbl_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_discipline`
--
ALTER TABLE `tbl_discipline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_docTemplate`
--
ALTER TABLE `tbl_docTemplate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_drop`
--
ALTER TABLE `tbl_drop`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_education`
--
ALTER TABLE `tbl_education`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_english`
--
ALTER TABLE `tbl_english`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_enqstatus`
--
ALTER TABLE `tbl_enqstatus`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_enquiry_products`
--
ALTER TABLE `tbl_enquiry_products`
  MODIFY `tbl_enquiry_products_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_filterdata`
--
ALTER TABLE `tbl_filterdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_followupAvgtime`
--
ALTER TABLE `tbl_followupAvgtime`
  MODIFY `fatId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_forecast`
--
ALTER TABLE `tbl_forecast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_goals`
--
ALTER TABLE `tbl_goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_input`
--
ALTER TABLE `tbl_input`
  MODIFY `input_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_institute`
--
ALTER TABLE `tbl_institute`
  MODIFY `institute_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kyc`
--
ALTER TABLE `tbl_kyc`
  MODIFY `kyc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_length`
--
ALTER TABLE `tbl_length`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_levels`
--
ALTER TABLE `tbl_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_module`
--
ALTER TABLE `tbl_module`
  MODIFY `mo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_name_prefix`
--
ALTER TABLE `tbl_name_prefix`
  MODIFY `np_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_nature_of_complaint`
--
ALTER TABLE `tbl_nature_of_complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_newdeal`
--
ALTER TABLE `tbl_newdeal`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_parameter`
--
ALTER TABLE `tbl_parameter`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_personal_details`
--
ALTER TABLE `tbl_personal_details`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_proddetails`
--
ALTER TABLE `tbl_proddetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `sb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product_country`
--
ALTER TABLE `tbl_product_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_referred_by`
--
ALTER TABLE `tbl_referred_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_region`
--
ALTER TABLE `tbl_region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_schdl`
--
ALTER TABLE `tbl_schdl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_scheme`
--
ALTER TABLE `tbl_scheme`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_social_profile`
--
ALTER TABLE `tbl_social_profile`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_stage_changed`
--
ALTER TABLE `tbl_stage_changed`
  MODIFY `stg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_subsource`
--
ALTER TABLE `tbl_subsource`
  MODIFY `subsource_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_target`
--
ALTER TABLE `tbl_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_taskstatus`
--
ALTER TABLE `tbl_taskstatus`
  MODIFY `taskstatus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_territory`
--
ALTER TABLE `tbl_territory`
  MODIFY `territory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ticket_conv`
--
ALTER TABLE `tbl_ticket_conv`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ticket_source`
--
ALTER TABLE `tbl_ticket_source`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ticket_status`
--
ALTER TABLE `tbl_ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ticket_subject`
--
ALTER TABLE `tbl_ticket_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_title`
--
ALTER TABLE `tbl_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_typeofproduct`
--
ALTER TABLE `tbl_typeofproduct`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
--
-- AUTO_INCREMENT for table `tbl_vid`
--
ALTER TABLE `tbl_vid`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_visit`
--
ALTER TABLE `tbl_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tck_mstr`
--
ALTER TABLE `tck_mstr`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `telephony_log`
--
ALTER TABLE `telephony_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_dynamic_data`
--
ALTER TABLE `ticket_dynamic_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_fileds_basic`
--
ALTER TABLE `ticket_fileds_basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `website_integration`
--
ALTER TABLE `website_integration`
  MODIFY `wid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `whatsapp_send_log`
--
ALTER TABLE `whatsapp_send_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zoom_link`
--
ALTER TABLE `zoom_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
