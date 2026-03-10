-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 08:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moepadata_support_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(90) NOT NULL,
  `announcement` text NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `helpful` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `not_helpful` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `visibility` tinyint(3) UNSIGNED NOT NULL,
  `logged_in_only` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles_categories`
--

CREATE TABLE `articles_categories` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles_votes`
--

CREATE TABLE `articles_votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `type` varchar(30) NOT NULL,
  `count` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `is_locked` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `attempted_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_log`
--

CREATE TABLE `backup_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `backup_file` varchar(50) NOT NULL,
  `backup_option` tinyint(3) UNSIGNED NOT NULL,
  `backup_action` tinyint(3) UNSIGNED NOT NULL,
  `taken_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `canned_replies`
--

CREATE TABLE `canned_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `canned_replies`
--

INSERT INTO `canned_replies` (`id`, `subject`, `message`, `updated_at`, `created_at`) VALUES
(1, 'Working on Issue', 'Hi {REQUESTER_NAME},\r\n\r\nThanks for reaching out to us. We\'ve started working on your issue and will get back to you soon.\r\n\r\nIf you have some more questions, please let us know. We\'ll be happy to help you.\r\n\r\nThanks,\r\n{AGENT_NAME}\r\n{SITE_NAME} Support', NULL, 1627110924),
(2, 'Work in Progress', 'Hi {REQUESTER_NAME},\r\n\r\nYour issue is currently in progress. The team is working hard on it. We\'ll get back to you in [NUMBER OF HOURS] hours. Thanks for your patience.\r\n\r\nRegards,\r\n{AGENT_NAME}\r\n{SITE_NAME} Support', NULL, 1627110988),
(3, 'Issue Resolved', 'Hi {REQUESTER_NAME},\r\n\r\nWe\'ve resolved your issue. If there is something else you need help with, please feel free to reply to this ticket or open a new one.\r\n\r\nThanks again for reaching out to us.\r\n\r\nRegards,\r\n{AGENT_NAME}\r\n{SITE_NAME} Support', NULL, 1627111036),
(4, 'Going to Close', 'Hi {REQUESTER_NAME},\r\n\r\nThanks for taking the time to speak about {SUBJECT}.\r\n\r\nIt\'s been [NUMBER OF DAYS] days since we\'ve heard from you, so I wanted to let you know that we are going to close this ticket.\r\n\r\nPlease feel free to open a new ticket if you need any further assistance.\r\n\r\nThanks again for reaching out to us.\r\n\r\nRegards,\r\n{AGENT_NAME}\r\n{SITE_NAME} Support', NULL, 1627111158),
(5, 'Requester is Angry', 'Hi {REQUESTER_NAME},\r\n\r\nI\'m sorry about the {SUBJECT} issue that you faced. You\'re right that it shouldn\'t take long to fix.\r\n\r\nI\'ve got our team working on your issue. I will keep you informed until we have resolved your issue.\r\n\r\nAgain, we are sorry for the inconvenience.\r\n\r\nRegards,\r\n{AGENT_NAME}\r\n{SITE_NAME} Support', NULL, 1627111248),
(6, 'Header and Footer', 'Hi {REQUESTER_NAME},\r\n\r\nThanks for reaching out to us. [PLEASE ADD DETAILS HERE]\r\n\r\nThanks,\r\n{AGENT_NAME}\r\n{SITE_NAME} Support', NULL, 1627138443);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(90) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `assigned_to` int(10) UNSIGNED DEFAULT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `is_read` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_read_assigned` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `sub_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ended_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_month_year` varchar(7) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats_envato_responses`
--

CREATE TABLE `chats_envato_responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `chat_id` int(10) UNSIGNED NOT NULL,
  `envato_purchase_code` varchar(255) NOT NULL,
  `envato_purchase_code_response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats_replies`
--

CREATE TABLE `chats_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `chat_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `area` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  `replied_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('24u1e7tb2jkleghp4dguhus1te08d2n0', '::1', 1772545147, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323534353134373b),
('48r3p2un722bqe8is4bhgn0uq1bjnq3i', '::1', 1772544330, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323534343333303b7a5f757365725f746f6b656e7c733a38353a2266643832333562373630646230326536383130333265326563643764316235626336303338633139626565656631666461353466373162393638653435393830323265633064653736396136646565636134333635223b),
('5k1q19rp97f2d337mafjvgipvpdpqam0', '::1', 1772788541, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323738383534303b7a5f757365725f746f6b656e7c733a36343a2232313535303161646166323664383936353439386431396336333566353038386166336561356133303834373338666239306366376637306232396362313461223b),
('6vepkifhmld25p59ioepckdnqnsv7vd1', '::1', 1772790452, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323738383835353b7a5f757365725f746f6b656e7c733a36343a2261623663663731363063333966613265343564316564383134663534633030303738643564303235376638653333316664393235373839613831383334346434223b),
('8klftcfhgr05t5v72agnbr3mij6fqa5f', '::1', 1772545146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323534353134363b6c6f67696e5f72656469726563747c733a32363a22757365722f737570706f72742f6372656174655f7469636b6574223b),
('8pofrdkma59m7lp8s7jh41qqj5ov7avd', '::1', 1772788855, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323738383835353b7a5f757365725f746f6b656e7c733a36343a2261623663663731363063333966613265343564316564383134663534633030303738643564303235376638653333316664393235373839613831383334346434223b),
('9pufvl6l5h5g8f89ol39tigabkmfh54j', '::1', 1772544644, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323534343634343b7a5f757365725f746f6b656e7c733a38353a2266643832333562373630646230326536383130333265326563643764316235626336303338633139626565656631666461353466373162393638653435393830323265633064653736396136646565636134333635223b),
('cosb1cplc55dt9tkoigs3bqs15fvdjbs', '::1', 1772742203, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323734323230333b6c6f67696e5f72656469726563747c733a3139373a2273736f2d6c6f67696e3f746f6b656e3d65794a316332567958326c6b496a6f7a4e54557a4c434a6c6257467062434936496d5636636d46416257396c634746306148563063326c6a6232357a645778306157356e4c6d4e764c6e70684969776964476c745a584e3059573177496a6f784e7a63794e7a51784d7a553266513d3d267369673d63623163386633303161326632396235363433396133613137646133636431326166663262366132346431623538636565393164333930306261646530643563223b),
('kl5daf67p8t7rikpjlt0msg4iv0hdddi', '::1', 1772743428, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323734333432383b6c6f67696e5f72656469726563747c733a3139373a2273736f2d6c6f67696e3f746f6b656e3d65794a316332567958326c6b496a6f7a4e54557a4c434a6c6257467062434936496d5636636d46416257396c634746306148563063326c6a6232357a645778306157356e4c6d4e764c6e70684969776964476c745a584e3059573177496a6f784e7a63794e7a51784d7a553266513d3d267369673d63623163386633303161326632396235363433396133613137646133636431326166663262366132346431623538636565393164333930306261646530643563223b),
('l4bphr9so568fc4gbke2iu4ovu2q2ail', '::1', 1772744656, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323734333732393b6c6f67696e5f72656469726563747c733a3139373a2273736f2d6c6f67696e3f746f6b656e3d65794a316332567958326c6b496a6f7a4e54557a4c434a6c6257467062434936496d5636636d46416257396c634746306148563063326c6a6232357a645778306157356e4c6d4e764c6e70684969776964476c745a584e3059573177496a6f784e7a63794e7a517a4e7a493466513d3d267369673d37386261316338646366653532613866366338383366633264323664633463663765306431383336636665653933316465666162643939393764333233363731223b7a5f757365725f746f6b656e7c733a36343a2231343863376537666464663665363637326135616136663632363465663063666465343761663662353634646632646133636266323739643135393338306533223b),
('mta8rrmsrls8pqi5ps1o5ecrshrifd5v', '::1', 1772743729, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323734333732393b),
('ol0iehp244mknodk0omnbi7cfmi439oa', '::1', 1772766290, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323736353938343b6c6f67696e5f72656469726563747c733a3137373a2273736f2d6c6f67696e3f746f6b656e3d65794a316332567958326c6b496a6f7a4e446b344c434a6c6257467062434936496d466b62576c7551474a72626d6c304c6d4e764c6e70684969776964476c745a584e3059573177496a6f784e7a63794e7a59324d444d7866513d3d267369673d36323537306437333266303861653966643166356165653339393266613566626462363934326334373535303435306664313764373665643936616437383862223b7a5f757365725f746f6b656e7c733a36343a2236356633646664653237633335666662356666623834363937363539376333373462633765663664393466633764623535653137393233323137383864643932223b),
('tvfkl8qtgs3ie4mcsn908n00jo219mlg', '::1', 1772559444, 0x5f5f63695f6c6173745f726567656e65726174657c693a313737323534343634343b7a5f757365725f746f6b656e7c733a38353a2266643832333562373630646230326536383130333265326563643764316235626336303338633139626565656631666461353466373162393638653435393830323265633064653736396136646565636134333635223b);

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(90) NOT NULL,
  `type` varchar(30) NOT NULL,
  `options` varchar(1500) NOT NULL,
  `is_required` tinyint(3) UNSIGNED NOT NULL,
  `guide_text` varchar(255) NOT NULL,
  `visibility` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  `content` mediumtext NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `visibility` tinyint(3) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) NOT NULL,
  `subject` varchar(90) NOT NULL,
  `hook` varchar(50) NOT NULL,
  `language` varchar(255) NOT NULL,
  `template` text NOT NULL,
  `is_built_in` tinyint(3) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `subject`, `hook`, `language`, `template`, `is_built_in`, `updated_at`, `created_at`) VALUES
(1, 'Email Verification', 'Please Verify your Account', 'email_verification', 'english', '<p>Hi {USER_NAME},<br><br>Thank you so much for joining the {SITE_NAME}.<br><br>Please verify your account by clicking on the following link:<br><a href=\"{EMAIL_LINK}\" target=\"_blank\">Click here</a><br><br>If you did not register, please kindly ignore this email.<br><br>Thanks,<br>{SITE_NAME}<br></p>', 1, NULL, 1611059287),
(2, 'Forgot Password', 'Password Reset', 'forgot_password', 'english', '<p>Hi {USER_NAME},<br><br>We\'ve received a password reset request. Please click on the following link to proceed:<br><a href=\"{EMAIL_LINK}\" target=\"_blank\">Reset Password</a><br><br>The link will expire after a limited time. If you didn\'t request to reset your password, please kindly ignore this message.<br><br>Thanks,<br>{SITE_NAME}<br></p>', 1, NULL, 1611135272),
(3, 'Ticket Replied by Agent', 'Your Ticket Has Been Replied', 'ticket_replied_agent', 'english', '<p>Hi {USER_NAME},<br><br>Your ticket has been replied to by our agent. You can see the ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Thanks,<br>{SITE_NAME} Support<br></p>', 1, NULL, 1611135470),
(4, 'Member Invite', 'Sign Up Invitation', 'member_invite', 'english', '<p>Hi there,<br><br>You have been invited to sign up as a member of {SITE_NAME}.<br><br>Please click on the following link to proceed:<br><a href=\"{EMAIL_LINK}\" target=\"_blank\">Register now</a><br><br>Thanks,<br>{SITE_NAME}<br></p>', 1, NULL, 1611136036),
(5, 'Change Email', 'Please Verify your Email Address', 'change_email', 'english', '<p>Hi there,<br><br>We\'ve received a request to change your email address. Please click on the following link to proceed:<br><a href=\"{EMAIL_LINK}\" target=\"_blank\">Click here</a><br><br>If you didn\'t request, please kindly ignore this email.<br><br>Thanks,<br>{SITE_NAME}</p>', 1, NULL, 1614102803),
(6, 'Changed Password', 'Password Changed', 'changed_password', 'english', '<p>Hi {USER_NAME},<br><br>Your account password is successfully changed. If you didn\'t request the change, please send us a message.<br><br>Thanks,<br>{SITE_NAME} Support</p>', 1, NULL, 1616355883),
(7, 'Welcome User', 'Your Account is Successfully Registered', 'welcome_user', 'english', '<p>Hi {USER_NAME},<br><br>You\'re welcome to {SITE_NAME}.<br><br>You can login to your account with username: {LOGIN_USERNAME} and the password that you created when registering.<br><br>You can go to the login page by clicking on the following link:<br><a href=\"{EMAIL_LINK}\" target=\"_blank\">Click here</a><br><br>Thanks,<br>{SITE_NAME}</p>', 1, NULL, 1625991429),
(8, 'Department Ticket', 'New Ticket Assigned to Department: {DEPARTMENT_NAME}', 'department_ticket', 'english', '<p>Hi {USER_NAME},<br><br>A new ticket has been assigned to your <b>{DEPARTMENT_NAME}</b> department.<br><br>You can see the assigned ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1627205276),
(9, 'Ticket Replied by User', 'User Replied to Assigned Ticket', 'ticket_replied_user', 'english', '<p>Hi {USER_NAME},<br><br>The user has replied to the ticket that\'s assigned to you. You can see the ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Thanks,<br>{SITE_NAME} Support<br></p>', 1, NULL, 1627224733),
(10, 'Ticket Assigned', 'Ticket Assigned', 'ticket_assigned', 'english', '<p>Hi {USER_NAME},<br><br>You have been assigned a ticket. You can see the ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1628170959),
(11, 'Department Chat', 'New Chat Assigned to Department: {DEPARTMENT_NAME}', 'department_chat', 'english', '<p>Hi {USER_NAME},<br><br>A new chat has been assigned to your <b>{DEPARTMENT_NAME}</b> department.<br><br>You can see the assigned chat by clicking on the following link:<br><a href=\"{CHAT_URL}\" target=\"_blank\">Click here</a><br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1638553679),
(12, 'Ticket Created (Unregistered User)', 'New Ticket Created For You', 'ticket_created_unregistered_user', 'english', '<p>Dear Customer,<br><br>A new ticket has been created for you by our support agent.<br><br>You can reach that ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1638868973),
(13, 'Chat Assigned', 'Chat Assigned', 'chat_assigned', 'english', '<p>Hi {USER_NAME},<br><br>You have been assigned a chat. You can see the chat by clicking on the following link:<br><a href=\"{CHAT_URL}\" target=\"_blank\">Click here</a><br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1639160537),
(14, 'Ticket Created by Guest', 'New Guest Ticket Created', 'ticket_created_guest', 'english', '<p>Dear Customer,<br><br>We have received a ticket submission request and a guest ticket has been successfully created for you.<br><br>Please kindly verify that the request was submitted by you, otherwise, you will not be able to add the replies:&nbsp;<a href=\"{EMAIL_LINK}\" target=\"_blank\">Verify Now</a><br><br>You can access it by clicking:&nbsp;<a href=\"{TICKET_URL}\" target=\"_blank\">View Ticket</a><br><br>If you didn\'t submit it, please kindly ignore this email (possibly the email address typing mistake).<br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1660817123),
(15, 'Resend Ticket Access', 'Re-sent Guest Ticket Access URL', 'resend_ticket_access', 'english', '<p>Dear Customer,<br><br>We have resent the URL of your guest ticket #{TICKET_ID}.<br><br>You can access that ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Regards,<br>{SITE_NAME} Support</p>', 1, NULL, 1660931621),
(16, 'Ticket Feedback Shared by User', 'User Shared the Feedback to Assigned Ticket', 'ticket_feedback_shared', 'english', '<p>Hi {USER_NAME},<br><br>The user has shared the feedback to the ticket that\'s assigned to you. You can see the ticket by clicking on the following link:<br><a href=\"{TICKET_URL}\" target=\"_blank\">Click here</a><br><br>Thanks,<br>{SITE_NAME} Support<br></p>', 1, NULL, 1693640033),
(17, 'Two Factor Authentication', 'Two Factor Authentication', '2f_authentication', 'english', '<p>Hi {USER_NAME},<br><br>Your two-factor authentication code is {2F_CODE}.<br><br>Thanks,<br>{SITE_NAME}<br></p>', 1, NULL, 1696239001),
(18, 'Ticket Confirmation', 'We\'ve Received Your Email! Ticket #{TICKET_ID}', 'ticket_confirmation', 'english', '<p>Dear Customer,<br><br>Greetings! This is an automatic email to inform you that your message has been successfully received. Your unique ticket reference number is {TICKET_ID}.<br><br>Should you have any additional information or updates you\'d like to share before our reply, please don\'t hesitate to respond to this email.<br><br>Thanks,<br>{SITE_NAME} Support</p>', 1, NULL, 1704453006),
(19, 'Ticket Closed', 'Action Required: Create a New Ticket for Further Assistance', 'ticket_closed', 'english', '<p>Dear Customer,<br><br>We wanted to update you on the recent ticket (#{TICKET_ID}) you attempted to reply to—it has now been officially closed in our system. We understand that this may have caused some inconvenience, and for that, we sincerely apologize.<br><br>If your initial inquiry has been successfully addressed to your satisfaction, we are delighted to have provided assistance. Nevertheless, should you have any outstanding questions, concerns, or new inquiries, we recommend initiating a new ticket dedicated to each specific matter.<br><br>We appreciate your understanding and cooperation in this matter.<br><br>Thanks,<br>{SITE_NAME} Support</p>', 1, NULL, 1704881794);

-- --------------------------------------------------------

--
-- Table structure for table `email_tokens`
--

CREATE TABLE `email_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `token` varchar(32) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `requested_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(90) NOT NULL,
  `answer` text NOT NULL,
  `category_id` tinyint(3) UNSIGNED NOT NULL,
  `visibility` tinyint(3) UNSIGNED NOT NULL,
  `logged_in_only` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs_categories`
--

CREATE TABLE `faqs_categories` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_key` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `for_team_member` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_read` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `content` mediumtext NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `content`, `meta_description`, `meta_keywords`, `updated_at`, `created_at`) VALUES
(1, '<p>\n  Welcome to WEBSITE NAME. By accessing or using our website at\n  http://yourwebsite.com, you agree to follow these Terms of Use.\n  If you do not agree with any part of these terms, please do not use the website.\n</p>\n\n<p>\n  You must be at least 18 years old to use this website. By using the site,\n  you confirm that you meet this requirement.\n</p>\n\n<p>\n  <strong>Accounts<br></strong>Some features may require you to create an account.\n  You are responsible for providing accurate information and keeping your\n  login details secure.\n</p>\n\n<p>\n  You are responsible for all activity that occurs under your account.\n  If you believe your account has been used without permission,\n  please contact us immediately.\n</p>\n\n<p>\n  <strong>Use of the Website<br></strong>WEBSITE NAME allows you to use the website\n  for personal, non-commercial purposes only. You agree not to misuse or\n  attempt to harm the website.\n</p>\n\n<p>\n  <strong>User Content<br></strong>If you submit content to the website,\n  you confirm that you have the right to do so. By submitting content,\n  you allow WEBSITE NAME to use it as needed to operate the website.\n</p>\n\n<p>\n  <strong>Third-Party Links<br></strong>The website may contain links to third-party\n  websites. We are not responsible for their content or policies.\n</p>\n\n<p>\n  <strong>Disclaimers<br></strong>The website is provided “as is” and\n  “as available” without warranties of any kind.\n</p>\n\n<p>\n  <b>Limitation of Liability<br></b>WEBSITE NAME will not be liable\n  for any damages resulting from your use of the website.\n</p>\n\n<p>\n  <strong>Termination<br></strong>We may suspend or terminate your access\n  to the website at any time if these Terms are violated.\n</p>\n\n<p>\n  <strong>Changes to These Terms<br></strong>These Terms may be updated\n  from time to time. Continued use of the website means you accept\n  the updated Terms.\n</p>\n\n<p>\n  <b>Contact Information<br></b> If you have questions about\n  these Terms, please contact us at\n  <strong>email@yourwebsite.com</strong>.\n</p>', 'The meta description goes here...', 'terms of use, terms', NULL, 1611744608),
(2, '<p>\n  This Privacy Policy explains how WEBSITE NAME collects, uses, and protects\n  your information when you visit or use our website at\n  http://yourwebsite.com. By using the website, you agree to the practices described in this policy. We value your privacy and are committed to protecting your personal\n  information in a clear and transparent way.\n</p>\n\n<p>\n  <strong>Information We Collect</strong><br>\n  We may collect personal information that you voluntarily provide to us,\n  such as your name, email address, or any other details you submit through\n  forms on the website.\n  <br>\n  We may also collect non-personal information automatically, including\n  browser type, device information, pages visited, and general usage data.\n</p>\n\n<p>\n  <strong>How We Use Your Information</strong><br>\n  We use the information we collect to operate and improve the website,\n  respond to inquiries, provide support, and communicate with users.\n  <br>\n  We may also use your information to maintain website security and prevent\n  fraud or misuse.\n</p>\n\n<p>\n  <strong>Cookies and Tracking Technologies</strong><br>\n  WEBSITE NAME uses cookies and similar technologies to improve user\n  experience, analyze website traffic, and understand how visitors interact\n  with the site.\n  <br>\n  You can choose to disable cookies through your browser settings. Please\n  note that some features of the website may not function properly if cookies\n  are disabled.\n</p>\n\n<p>\n  <strong>Sharing of Information</strong><br>\n  We do not sell, rent, or trade your personal information to third parties.\n  <br>\n  We may share information with trusted service providers who help us operate\n  the website, provided they agree to keep the information confidential.\n</p>\n\n<p>\n  <strong>Third-Party Links</strong><br>\n  Our website may contain links to third-party websites. We are not\n  responsible for the privacy practices or content of those websites.\n  We encourage you to review their privacy policies.\n</p>\n\n<p>\n  <strong>Data Security</strong><br>\n  We take reasonable measures to protect your personal information from\n  unauthorized access, loss, misuse, or disclosure.\n  <br>\n  However, no method of transmission over the internet or electronic storage\n  is completely secure, and we cannot guarantee absolute security.\n</p>\n\n<p>\n  <strong>Your Privacy Rights</strong><br>\n  You have the right to request access to, correction of, or deletion of your\n  personal information, subject to applicable laws.\n  <br>\n  To make such a request, please contact us using the details provided below.\n</p>\n\n<p>\n  <strong>Children’s Information</strong><br>\n  WEBSITE NAME does not knowingly collect personal information from children\n  under the age of 13. If you believe that a child has provided personal\n  information on our website, please contact us and we will take appropriate\n  action.\n</p>\n\n<p>\n  <strong>Changes to This Privacy Policy</strong><br>\n  We may update this Privacy Policy from time to time. Any changes will be\n  posted on this page, and continued use of the website means you accept the\n  updated policy.\n</p>\n\n<p>\n  <strong>Contact Information</strong><br>\n  If you have any questions or concerns about this Privacy Policy, you may\n  contact us at:\n  <br>\n  <strong>Email:</strong> email@yourwebsite.com\n</p>', 'The meta description goes here.', 'privacy policy, visitor\'s privacy', NULL, 1611744759);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `access_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `access_key`) VALUES
(1, 'Canned Replies', 'canned_replies'),
(2, 'Tickets', 'tickets'),
(3, 'All Tickets', 'all_tickets'),
(4, 'Departments', 'departments'),
(5, 'Knowledge Base', 'knowledge_base'),
(6, 'FAQs', 'faqs'),
(7, 'Announcements', 'announcements'),
(8, 'Backup', 'backup'),
(9, 'Email Templates', 'email_templates'),
(10, 'Pages', 'pages'),
(11, 'Impersonate', 'impersonate'),
(12, 'Users', 'users'),
(13, 'Roles & Permissions', 'roles_and_permissions'),
(14, 'Settings', 'settings'),
(15, 'Chats', 'chats'),
(16, 'All Chats', 'all_chats'),
(17, 'Reports', 'reports'),
(18, 'Custom Fields', 'custom_fields'),
(19, 'Delete Ticket', 'delete_ticket'),
(20, 'Edit Ticket Reply', 'edit_ticket_reply'),
(21, 'Delete Ticket Reply', 'delete_ticket_reply'),
(22, 'Delete Ticket Feedback', 'delete_ticket_feedback'),
(23, 'Envato Purchase Information (Tickets & Chats)', 'envato_purchase_information'),
(24, 'AI Writer', 'ai_writer');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `users` int(10) UNSIGNED NOT NULL,
  `opened_tickets` int(10) UNSIGNED NOT NULL,
  `closed_tickets` int(10) UNSIGNED NOT NULL,
  `solved_tickets` int(10) UNSIGNED NOT NULL,
  `total_tickets` int(10) UNSIGNED NOT NULL,
  `active_chats` int(10) UNSIGNED NOT NULL,
  `ended_chats` int(10) UNSIGNED NOT NULL,
  `total_chats` int(10) UNSIGNED NOT NULL,
  `period` varchar(255) NOT NULL,
  `generated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `access_key` varchar(50) NOT NULL,
  `is_built_in` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `access_key`, `is_built_in`) VALUES
(1, 'Super Admin', 'super_admin', 1),
(2, 'Agent', 'agent', 1),
(3, 'User', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `permission_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 2, 1),
(16, 2, 2),
(17, 1, 15),
(18, 1, 16),
(19, 2, 15),
(20, 1, 17),
(21, 1, 18),
(22, 1, 19),
(23, 1, 20),
(24, 1, 21),
(25, 1, 22),
(26, 1, 23),
(27, 2, 23),
(28, 1, 24),
(29, 2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `access_key` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `access_key`, `value`) VALUES
(1, 'auto_close_tickets', '1'),
(2, 'create_ticket_page_message', 'Please note that our response time can be up to 3 business days.'),
(3, 'e_encryption', ''),
(4, 'e_host', ''),
(5, 'e_password', ''),
(6, 'e_port', ''),
(7, 'e_protocol', 'mail'),
(8, 'e_sender', ''),
(9, 'e_sender_name', ''),
(10, 'e_username', ''),
(11, 'fb_app_id', ''),
(12, 'fb_app_secret', ''),
(13, 'fb_enable_login', '0'),
(14, 'gl_client_key', ''),
(15, 'gl_enable', '0'),
(16, 'gl_secret_key', ''),
(17, 'google_analytics_id', ''),
(18, 'gr_enable', '0'),
(19, 'gr_public_key', ''),
(20, 'gr_secret_key', ''),
(21, 'ipinfo_token', ''),
(22, 'maintenance_mode', '0'),
(23, 'mm_allowed_ips', ''),
(24, 'mm_message', 'We\'re very sorry for the inconvenience, the site is currently undergoing scheduled maintenance.'),
(25, 'show_tp_message', '1'),
(26, 'site_about', 'Create a support ticketing system with the creation of multiple departments and user roles based on your needs.'),
(27, 'site_color', '5'),
(28, 'site_description', 'The description goes here...'),
(29, 'site_favicon', '635ae68e8b1ff8a324a9f517f9ff3f34.png'),
(30, 'site_keywords', 'keyword1, keyword2'),
(31, 'site_logo', '50e6701f73d6a51ba8fe217b43b176b9.png'),
(32, 'site_name', 'Moepadata Support'),
(33, 'site_show_cookie_popup', '1'),
(34, 'site_tagline', 'Support Tickets System with Knowledge Base and FAQs'),
(35, 'site_theme', 'default'),
(36, 'site_timezone', ''),
(37, 'sp_allow_ticket_reopen', '0'),
(38, 'sp_email_notifications', '1'),
(39, 'sp_verification_before_submit', '0'),
(40, 'tw_consumer_key', ''),
(41, 'tw_consumer_secret', ''),
(42, 'tw_enable_login', '0'),
(43, 'u_allow_username_change', '1'),
(44, 'u_can_remove_them', '0'),
(45, 'u_enable_registration', '1'),
(46, 'u_lockout_unlock_time', '1'),
(47, 'u_max_avator_size', '500x500'),
(48, 'u_notify_pass_changed', '1'),
(49, 'u_password_requirement', 'low'),
(50, 'u_req_ev_onchange', '1'),
(51, 'u_reset_password', '1'),
(52, 'u_temporary_lockout', 'medium'),
(53, 'sp_live_chatting', '0'),
(54, 'sp_guest_ticketing', '0'),
(55, 'i_pc_string', 'b993086c-3f11-4bc9-91e1-eb5e2b8ca6c3'),
(56, 'i_pc_status', '0'),
(57, 'i_at', '1772543647'),
(58, 'site_custom_css', ''),
(59, 'i_app_id', ''),
(60, 'err_invalid_detected', '<strong>Please note that the system detected this copy as unlicensed, kindly reach out to support (with your purchase code) as soon as possible if it\'s a mistake.</strong>'),
(61, 'module_knowledgebase', '1'),
(62, 'module_faqs', '1'),
(63, 'module_announcements', '1'),
(64, 'module_tickets', '1'),
(65, 'envato_api_token', ''),
(66, 'envato_ask_purchase_code_ticket', '0'),
(67, 'envato_se_create_ticket', '0'),
(68, 'envato_support_policy_url', 'https://codecanyon.net/page/item_support_policy'),
(69, 'envato_ask_purchase_code_chat', '0'),
(70, 'envato_se_create_chat', '0'),
(71, 'envato_how_to_find_pc', 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-'),
(72, 'sp_allow_ticket_feedback_delete', '1'),
(73, 'u_2f_authentication', '0'),
(74, 'u_2fa_cookie_expiry', '+1 year'),
(75, 'u_2fa_show_remember', '1'),
(76, 'imap_host', ''),
(77, 'imap_username', ''),
(78, 'imap_password', ''),
(79, 'enable_email_to_ticket', '0'),
(80, 'tickets_default_department_id', '1'),
(81, 'tickets_default_priority', 'medium'),
(82, 'imap_port', '993'),
(83, 'imap_encryption', 'ssl'),
(84, 'imap_validate_cert', '1'),
(85, 'imap_protocol', 'imap'),
(86, 'site_custom_js', ''),
(87, 'vkontakte_app_id', ''),
(88, 'vkontakte_secret_key', ''),
(89, 'vkontakte_enable', '0'),
(90, 'openai_api_key', ''),
(91, 'openai_frequency_penalty', '0.5'),
(92, 'openai_max_tokens', '300'),
(93, 'openai_model', 'gpt-4o'),
(94, 'openai_presence_penalty', '0.5'),
(95, 'openai_status', '0'),
(96, 'openai_temperature', '0.7'),
(97, 'openai_top_p', '0.9'),
(98, 'max_files', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(90) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attachment_name` varchar(255) NOT NULL,
  `feedback_type` tinyint(3) UNSIGNED DEFAULT NULL,
  `feedback` varchar(500) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `assigned_to` int(10) UNSIGNED DEFAULT NULL,
  `department_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `security_key` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `is_verified` tinyint(3) UNSIGNED DEFAULT NULL,
  `email_attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `last_email_attempt` int(10) UNSIGNED DEFAULT NULL,
  `is_read` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_read_assigned` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `last_agent_replied_at` int(10) UNSIGNED DEFAULT NULL,
  `reopened_awaiting` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `last_reply_area` tinyint(3) UNSIGNED DEFAULT NULL,
  `sub_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `source` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `closed_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_month_year` varchar(7) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_attachments`
--

CREATE TABLE `tickets_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attachment_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_custom_fields`
--

CREATE TABLE `tickets_custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `custom_field_id` tinyint(3) UNSIGNED NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_departments`
--

CREATE TABLE `tickets_departments` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `team` text NOT NULL,
  `visibility` tinyint(3) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets_departments`
--

INSERT INTO `tickets_departments` (`id`, `name`, `team`, `visibility`, `updated_at`, `created_at`) VALUES
(1, 'General Inquiries', '{\"users\":[1]}', 1, NULL, 1611213421);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_emails`
--

CREATE TABLE `tickets_emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `message_id` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_envato_responses`
--

CREATE TABLE `tickets_envato_responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `envato_purchase_code` varchar(255) NOT NULL,
  `envato_purchase_code_response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_history`
--

CREATE TABLE `tickets_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_key` varchar(255) NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_notes`
--

CREATE TABLE `tickets_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `note` varchar(500) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attachment_name` varchar(255) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_replies`
--

CREATE TABLE `tickets_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attachment_name` varchar(255) NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `replied_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_replies_attachments`
--

CREATE TABLE `tickets_replies_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_reply_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attachment_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_replies_quotes`
--

CREATE TABLE `tickets_replies_quotes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_reply_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_tasks`
--

CREATE TABLE `tickets_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(90) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pending_email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'default.png',
  `date_format` varchar(10) NOT NULL DEFAULT 'd/m/Y',
  `time_format` varchar(10) NOT NULL DEFAULT 'H:i:s',
  `timezone` varchar(32) NOT NULL,
  `language` varchar(255) NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL,
  `is_online` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `online_time` int(10) UNSIGNED DEFAULT NULL,
  `online_date` varchar(10) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `is_verified` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `two_factor_authentication` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `send_email_notifications` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `announcements_last_read_at` int(10) UNSIGNED DEFAULT NULL,
  `last_activity` int(10) UNSIGNED DEFAULT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `registration_source` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `oauth_identifier` varchar(255) NOT NULL,
  `registered_month_year` varchar(7) NOT NULL,
  `registered_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email_address`, `pending_email_address`, `password`, `picture`, `date_format`, `time_format`, `timezone`, `language`, `role`, `is_online`, `online_time`, `online_date`, `status`, `is_verified`, `two_factor_authentication`, `send_email_notifications`, `announcements_last_read_at`, `last_activity`, `last_login`, `updated_at`, `registration_source`, `oauth_identifier`, `registered_month_year`, `registered_at`) VALUES
(1, 'Super', 'Admin', 'superadmin', 'ezra@moepathutsiconsulting.co.za', '', '$2y$10$m.927pK19dDTQz2rYMnSHOVUWI8b.G.md3mkLre51fPAoaJd2Mi9u', 'default.png', 'd/m/Y', 'H:i:s', '', '', 1, 1, 1772790314, '2026-03-06', 1, 1, 0, 1, NULL, 1772790452, 1772788807, NULL, 1, '', '3-2026', 1772543647),
(2, 'Sarah', '', 'admin@bknit.co.za', 'admin@bknit.co.za', '', '$2y$10$.wk2azfBQPRhmNhOOEPZPe8pYMl88oVghmIoVfnxj5lRytiZfn6Ie', 'default.png', 'd/m/Y', 'H:i:s', '', '', 3, 1, 1772788175, '2026-03-06', 1, 1, 0, 1, NULL, 1772788175, 1772766032, NULL, 1, '', '', 0),
(3, 'Ezra', 'Seroto', 'serotoke1@gmail.com', 'serotoke1@gmail.com', '', '$2y$10$yyERDINKGAdedtHDQxkfzepUHgOenD1CA8rDh5i.Z/v9j2qoGMXDS', 'default.png', 'd/m/Y', 'H:i:s', '', '', 3, 1, 1772788788, '2026-03-06', 1, 1, 0, 1, NULL, 1772788807, 1772788176, NULL, 1, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_invites`
--

CREATE TABLE `users_invites` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `invitation_code` varchar(32) NOT NULL,
  `expires_in` tinyint(3) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `bypass_registration` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `updated_at` int(10) UNSIGNED DEFAULT NULL,
  `invited_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_rememberings`
--

CREATE TABLE `users_rememberings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_sent_emails`
--

CREATE TABLE `users_sent_emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_to` int(10) UNSIGNED NOT NULL,
  `sent_by` int(10) UNSIGNED NOT NULL,
  `sent_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_sessions`
--

CREATE TABLE `users_sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `interface` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `last_activity` int(10) UNSIGNED DEFAULT NULL,
  `last_location` varchar(255) NOT NULL,
  `logged_in_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_sessions`
--

INSERT INTO `users_sessions` (`id`, `user_id`, `token`, `ip_address`, `platform`, `browser`, `interface`, `last_activity`, `last_location`, `logged_in_at`) VALUES
(1, 1, 'fd8235b760db02e681032e2ecd7d1b5bc6038c19beeef1fda54f71b968e4598022ec0de769a6deeca4365', '::1', 'Windows 10', 'Firefox', 1, 1772559444, 'user/support/create_ticket', 1772543724),
(2, 1, '5b4874c4e62d6fa3c58d06fad01c5cd8850504435b93b81c07e5e4ab9a035f7d6b78d20469a9eb120f903', '::1', 'Windows 10', 'Firefox', 1, 1772743614, 'sso-login', 1772743442),
(5, 2, '65f3dfde27c35ffb5ffb846976597c374bc7ef6d94fc7db55e1792321788dd92', '::1', 'Windows 10', 'Firefox', 1, 1772788175, 'sso-login', 1772766032),
(6, 3, '215501adaf26d8965498d19c635f5088af3ea5a3084738fb90cf7f70b29cb14a', '::1', 'Windows 10', 'Firefox', 1, 1772788807, 'sso-login', 1772788176),
(7, 1, 'ab6cf7160c39fa2e45d1ed814f54c00078d5d0257f8e331fd925789a818344d4', '::1', 'Windows 10', 'Firefox', 1, 1772790452, 'admin/tickets/all', 1772788807);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `articles_categories`
--
ALTER TABLE `articles_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_votes`
--
ALTER TABLE `articles_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_log`
--
ALTER TABLE `backup_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canned_replies`
--
ALTER TABLE `canned_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats_envato_responses`
--
ALTER TABLE `chats_envato_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats_replies`
--
ALTER TABLE `chats_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_tokens`
--
ALTER TABLE `email_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs_categories`
--
ALTER TABLE `faqs_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_key` (`access_key`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_attachments`
--
ALTER TABLE `tickets_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_custom_fields`
--
ALTER TABLE `tickets_custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_departments`
--
ALTER TABLE `tickets_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_emails`
--
ALTER TABLE `tickets_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_envato_responses`
--
ALTER TABLE `tickets_envato_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_history`
--
ALTER TABLE `tickets_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_notes`
--
ALTER TABLE `tickets_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_replies`
--
ALTER TABLE `tickets_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_replies_attachments`
--
ALTER TABLE `tickets_replies_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_replies_quotes`
--
ALTER TABLE `tickets_replies_quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_tasks`
--
ALTER TABLE `tickets_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_invites`
--
ALTER TABLE `users_invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_rememberings`
--
ALTER TABLE `users_rememberings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_sent_emails`
--
ALTER TABLE `users_sent_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_sessions`
--
ALTER TABLE `users_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles_categories`
--
ALTER TABLE `articles_categories`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles_votes`
--
ALTER TABLE `articles_votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_log`
--
ALTER TABLE `backup_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `canned_replies`
--
ALTER TABLE `canned_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats_envato_responses`
--
ALTER TABLE `chats_envato_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats_replies`
--
ALTER TABLE `chats_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `email_tokens`
--
ALTER TABLE `email_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs_categories`
--
ALTER TABLE `faqs_categories`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_attachments`
--
ALTER TABLE `tickets_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_custom_fields`
--
ALTER TABLE `tickets_custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_departments`
--
ALTER TABLE `tickets_departments`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets_emails`
--
ALTER TABLE `tickets_emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_envato_responses`
--
ALTER TABLE `tickets_envato_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_history`
--
ALTER TABLE `tickets_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_notes`
--
ALTER TABLE `tickets_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_replies`
--
ALTER TABLE `tickets_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_replies_attachments`
--
ALTER TABLE `tickets_replies_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_replies_quotes`
--
ALTER TABLE `tickets_replies_quotes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_tasks`
--
ALTER TABLE `tickets_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_invites`
--
ALTER TABLE `users_invites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_rememberings`
--
ALTER TABLE `users_rememberings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_sent_emails`
--
ALTER TABLE `users_sent_emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_sessions`
--
ALTER TABLE `users_sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
