-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2012 at 11:46 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `appedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `user_id`, `token`, `duration`, `used`, `created`, `expires`) VALUES
(16, 1, 'f474aaa293c43c7f01eeaeed1d6a1d62', '2 weeks', 0, '2012-09-29 07:37:11', '2012-10-13 07:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'CEO'),
(2, 'Marketing Manager'),
(3, 'Product Manager'),
(4, 'CTO'),
(5, 'Founder'),
(6, 'Co-Founder');

-- --------------------------------------------------------

--
-- Table structure for table `startups`
--

CREATE TABLE IF NOT EXISTS `startups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `startups`
--


-- --------------------------------------------------------

--
-- Table structure for table `startup_invites`
--

CREATE TABLE IF NOT EXISTS `startup_invites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startup_id` int(12) NOT NULL,
  `inviter_id` int(12) NOT NULL,
  `invitee_email` varchar(256) NOT NULL,
  `invitee_name` varchar(256) NOT NULL,
  `invitee_role_id` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `startup_invites`
--


-- --------------------------------------------------------

--
-- Table structure for table `startup_users`
--

CREATE TABLE IF NOT EXISTS `startup_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startup_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `role_id` int(6) NOT NULL DEFAULT '6',
  `default` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `startup_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `tmp_emails`
--

CREATE TABLE IF NOT EXISTS `tmp_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tmp_emails`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(100) DEFAULT NULL,
  `fb_access_token` text,
  `twt_id` bigint(100) DEFAULT NULL,
  `twt_access_token` text,
  `twt_access_secret` text,
  `ldn_id` varchar(100) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `active` varchar(3) DEFAULT '0',
  `email_verified` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `by_admin` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fb_id`, `fb_access_token`, `twt_id`, `twt_access_token`, `twt_access_secret`, `ldn_id`, `user_group_id`, `username`, `password`, `salt`, `email`, `first_name`, `last_name`, `active`, `email_verified`, `last_login`, `by_admin`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'admin', 'b2aae31278a1f3a911f84497a7182ee0', '6adf262cff5454313b6f65800a6c9859', 'admin@admin.com', 'Admin', '', '1', 1, '2012-09-29 07:37:11', 0, '2012-09-09 23:11:16', '2012-09-09 23:11:16'),
(2, NULL, NULL, NULL, NULL, NULL, 'fEXeRPDiFG', '2', 'amirshevat', '185b2d0a2db96f3dce08ff8dd96dcc2e', NULL, NULL, 'Amir', 'Shevat', '1', 1, '2012-09-29 07:39:04', 0, '2012-09-15 04:05:24', '2012-09-15 04:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(256) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `last_action` int(10) DEFAULT NULL,
  `last_url` text,
  `logout_time` int(10) DEFAULT NULL,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `useragent`, `user_id`, `last_action`, `last_url`, `logout_time`, `user_browser`, `ip_address`, `logout`, `deleted`, `status`, `created`, `modified`) VALUES
(33, 'e48e49917ecc1bfd65bbdd0c820caa77', 2, 1348933423, '/xboard/basics/team', NULL, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.79 Safari/537.4', '127.0.0.1', 0, 0, 1, '2012-09-29 07:38:19', '2012-09-29 07:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `photo` text,
  `bday` date DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `cellphone` varchar(15) DEFAULT NULL,
  `web_page` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `photo`, `bday`, `location`, `marital_status`, `cellphone`, `web_page`, `created`, `modified`) VALUES
(1, 1, 'male', '', '1986-01-30', '', 'single', '', '', '2012-09-09 23:11:16', '2012-09-09 23:11:16'),
(2, 2, NULL, '13476963241963252454.jpg', NULL, NULL, NULL, NULL, NULL, '2012-09-15 04:05:24', '2012-09-15 04:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL,
  `allowRegistration` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `alias_name`, `allowRegistration`, `created`, `modified`) VALUES
(1, 'Admin', 'Admin', 0, '2012-09-09 23:11:16', '2012-09-09 23:11:16'),
(2, 'User', 'User', 1, '2012-09-09 23:11:16', '2012-09-09 23:11:16'),
(3, 'Guest', 'Guest', 0, '2012-09-09 23:11:16', '2012-09-09 23:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions`
--

CREATE TABLE IF NOT EXISTS `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `user_group_permissions`
--

INSERT INTO `user_group_permissions` (`id`, `user_group_id`, `controller`, `action`, `allowed`) VALUES
(1, 1, 'Pages', 'display', 1),
(2, 2, 'Pages', 'display', 1),
(3, 3, 'Pages', 'display', 1),
(4, 1, 'UserGroupPermissions', 'index', 1),
(5, 2, 'UserGroupPermissions', 'index', 0),
(6, 3, 'UserGroupPermissions', 'index', 0),
(7, 1, 'UserGroups', 'index', 1),
(8, 2, 'UserGroups', 'index', 0),
(9, 3, 'UserGroups', 'index', 0),
(10, 1, 'UserGroups', 'addGroup', 1),
(11, 2, 'UserGroups', 'addGroup', 0),
(12, 3, 'UserGroups', 'addGroup', 0),
(13, 1, 'UserGroups', 'editGroup', 1),
(14, 2, 'UserGroups', 'editGroup', 0),
(15, 3, 'UserGroups', 'editGroup', 0),
(16, 1, 'UserGroups', 'deleteGroup', 1),
(17, 2, 'UserGroups', 'deleteGroup', 0),
(18, 3, 'UserGroups', 'deleteGroup', 0),
(19, 1, 'UserSettings', 'index', 1),
(20, 2, 'UserSettings', 'index', 0),
(21, 3, 'UserSettings', 'index', 0),
(22, 1, 'UserSettings', 'editSetting', 1),
(23, 2, 'UserSettings', 'editSetting', 0),
(24, 3, 'UserSettings', 'editSetting', 0),
(25, 1, 'Users', 'index', 1),
(26, 2, 'Users', 'index', 0),
(27, 3, 'Users', 'index', 0),
(28, 1, 'Users', 'online', 1),
(29, 2, 'Users', 'online', 0),
(30, 3, 'Users', 'online', 0),
(31, 1, 'Users', 'viewUser', 1),
(32, 2, 'Users', 'viewUser', 0),
(33, 3, 'Users', 'viewUser', 0),
(34, 1, 'Users', 'myprofile', 0),
(35, 2, 'Users', 'myprofile', 1),
(36, 3, 'Users', 'myprofile', 0),
(37, 1, 'Users', 'editProfile', 0),
(38, 2, 'Users', 'editProfile', 1),
(39, 3, 'Users', 'editProfile', 0),
(40, 1, 'Users', 'login', 1),
(41, 2, 'Users', 'login', 1),
(42, 3, 'Users', 'login', 1),
(43, 1, 'Users', 'logout', 1),
(44, 2, 'Users', 'logout', 1),
(45, 3, 'Users', 'logout', 1),
(46, 1, 'Users', 'register', 1),
(47, 2, 'Users', 'register', 1),
(48, 3, 'Users', 'register', 1),
(49, 1, 'Users', 'changePassword', 1),
(50, 2, 'Users', 'changePassword', 1),
(51, 3, 'Users', 'changePassword', 0),
(52, 1, 'Users', 'changeUserPassword', 1),
(53, 2, 'Users', 'changeUserPassword', 0),
(54, 3, 'Users', 'changeUserPassword', 0),
(55, 1, 'Users', 'addUser', 1),
(56, 2, 'Users', 'addUser', 0),
(57, 3, 'Users', 'addUser', 0),
(58, 1, 'Users', 'editUser', 1),
(59, 2, 'Users', 'editUser', 0),
(60, 3, 'Users', 'editUser', 0),
(61, 1, 'Users', 'deleteUser', 1),
(62, 2, 'Users', 'deleteUser', 0),
(63, 3, 'Users', 'deleteUser', 0),
(64, 1, 'Users', 'deleteAccount', 0),
(65, 2, 'Users', 'deleteAccount', 1),
(66, 3, 'Users', 'deleteAccount', 0),
(67, 1, 'Users', 'logoutUser', 1),
(68, 2, 'Users', 'logoutUser', 0),
(69, 3, 'Users', 'logoutUser', 0),
(70, 1, 'Users', 'makeInactive', 1),
(71, 2, 'Users', 'makeInactive', 0),
(72, 3, 'Users', 'makeInactive', 0),
(73, 1, 'Users', 'dashboard', 1),
(74, 2, 'Users', 'dashboard', 1),
(75, 3, 'Users', 'dashboard', 0),
(76, 1, 'Users', 'makeActiveInactive', 1),
(77, 2, 'Users', 'makeActiveInactive', 0),
(78, 3, 'Users', 'makeActiveInactive', 0),
(79, 1, 'Users', 'verifyEmail', 1),
(80, 2, 'Users', 'verifyEmail', 0),
(81, 3, 'Users', 'verifyEmail', 0),
(82, 1, 'Users', 'accessDenied', 1),
(83, 2, 'Users', 'accessDenied', 1),
(84, 3, 'Users', 'accessDenied', 0),
(85, 1, 'Users', 'userVerification', 1),
(86, 2, 'Users', 'userVerification', 1),
(87, 3, 'Users', 'userVerification', 1),
(88, 1, 'Users', 'forgotPassword', 1),
(89, 2, 'Users', 'forgotPassword', 1),
(90, 3, 'Users', 'forgotPassword', 1),
(91, 1, 'Users', 'emailVerification', 1),
(92, 2, 'Users', 'emailVerification', 1),
(93, 3, 'Users', 'emailVerification', 1),
(94, 1, 'Users', 'activatePassword', 1),
(95, 2, 'Users', 'activatePassword', 1),
(96, 3, 'Users', 'activatePassword', 1),
(97, 1, 'UserGroupPermissions', 'update', 1),
(98, 2, 'UserGroupPermissions', 'update', 0),
(99, 3, 'UserGroupPermissions', 'update', 0),
(100, 1, 'Users', 'deleteCache', 1),
(101, 2, 'Users', 'deleteCache', 0),
(102, 3, 'Users', 'deleteCache', 0),
(103, 1, 'Autocomplete', 'fetch', 1),
(104, 2, 'Autocomplete', 'fetch', 1),
(105, 3, 'Autocomplete', 'fetch', 1),
(106, 1, 'Users', 'viewUserPermissions', 1),
(107, 2, 'Users', 'viewUserPermissions', 0),
(108, 3, 'Users', 'viewUserPermissions', 0),
(109, 1, 'Basics', 'index', 1),
(110, 2, 'Basics', 'index', 1),
(111, 3, 'Basics', 'index', 1),
(112, 1, 'Basics', 'name', 1),
(113, 2, 'Basics', 'name', 1),
(114, 3, 'Basics', 'name', 1),
(115, 1, 'Basics', 'team', 1),
(116, 2, 'Basics', 'team', 1),
(117, 3, 'Basics', 'team', 1),
(118, 1, 'Modules', 'index', 1),
(119, 2, 'Modules', 'index', 1),
(120, 3, 'Modules', 'index', 1),
(121, 1, 'Modules', 'details', 1),
(122, 2, 'Modules', 'details', 1),
(123, 3, 'Modules', 'details', 0),
(124, 1, 'Reports', 'index', 1),
(125, 2, 'Reports', 'index', 1),
(126, 3, 'Reports', 'index', 1),
(127, 1, 'Basics', 'overview', 1),
(128, 2, 'Basics', 'overview', 1),
(129, 3, 'Basics', 'overview', 1),
(130, 1, 'Basics', 'invited', 1),
(131, 2, 'Basics', 'invited', 1),
(132, 3, 'Basics', 'invited', 1),
(133, 1, 'Modules', 'uninstall', 0),
(134, 2, 'Modules', 'uninstall', 0),
(135, 3, 'Modules', 'uninstall', 0),
(136, 1, 'Modules', 'install', 1),
(137, 2, 'Modules', 'install', 0),
(138, 3, 'Modules', 'install', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `name_public` text,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `name`, `name_public`, `value`, `type`) VALUES
(1, 'defaultTimeZone', 'Enter default time zone identifier', 'America/New_York', 'input'),
(2, 'siteName', 'Enter Your Site Name', 'Startupedia', 'input'),
(3, 'siteRegistration', 'New Registration is allowed or not', '1', 'checkbox'),
(4, 'allowDeleteAccount', 'Allow users to delete account', '0', 'checkbox'),
(5, 'sendRegistrationMail', 'Send Registration Mail After User Registered', '1', 'checkbox'),
(6, 'sendPasswordChangeMail', 'Send Password Change Mail After User changed password', '0', 'checkbox'),
(7, 'emailVerification', 'Want to verify user''s email address?', '0', 'checkbox'),
(8, 'emailFromAddress', 'Enter email by which emails will be send.', 'example@example.com', 'input'),
(9, 'emailFromName', 'Enter Email From Name', 'User Management Plugin', 'input'),
(10, 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox'),
(11, 'bannedUsernames', 'Set banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input'),
(12, 'useRecaptcha', 'Do you want to captcha support on registration form?', '1', 'checkbox'),
(13, 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', '', 'input'),
(14, 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', '', 'input'),
(15, 'loginRedirectUrl', 'Enter URL where user will be redirected after login ', '/basics/overview', 'input'),
(16, 'logoutRedirectUrl', 'Enter URL where user will be redirected after logout', '/login', 'input'),
(17, 'permissions', 'Do you Want to enable permissions for users?', '1', 'checkbox'),
(18, 'adminPermissions', 'Do you want to check permissions for Admin?', '0', 'checkbox'),
(19, 'defaultGroupId', 'Enter default group id for user registration', '2', 'input'),
(20, 'adminGroupId', 'Enter Admin Group Id', '1', 'input'),
(21, 'guestGroupId', 'Enter Guest Group Id', '3', 'input'),
(22, 'useFacebookLogin', 'Want to use Facebook Connect on your site?', '0', 'checkbox'),
(23, 'facebookAppId', 'Facebook Application Id', '', 'input'),
(24, 'facebookSecret', 'Facebook Application Secret Code', '', 'input'),
(25, 'facebookScope', 'Facebook Permissions', 'user_status, publish_stream, email', 'input'),
(26, 'useTwitterLogin', 'Want to use Twitter Connect on your site?', '0', 'checkbox'),
(27, 'twitterConsumerKey', 'Twitter Consumer Key', '', 'input'),
(28, 'twitterConsumerSecret', 'Twitter Consumer Secret', '', 'input'),
(29, 'useGmailLogin', 'Want to use Gmail Connect on your site?', '0', 'checkbox'),
(30, 'useYahooLogin', 'Want to use Yahoo Connect on your site?', '0', 'checkbox'),
(31, 'useLinkedinLogin', 'Want to use Linkedin Connect on your site?', '1', 'checkbox'),
(32, 'linkedinApiKey', 'Linkedin Api Key', 'ydzekq44v83b', 'input'),
(33, 'linkedinSecretKey', 'Linkedin Secret Key', '1kzojWEEVqRB3NNn', 'input'),
(34, 'useFoursquareLogin', 'Want to use Foursquare Connect on your site?', '0', 'checkbox'),
(35, 'foursquareClientId', 'Foursquare Client Id', '', 'input'),
(36, 'foursquareClientSecret', 'Foursquare Client Secret', '', 'input'),
(37, 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input'),
(38, 'useHttps', 'Do you want to HTTPS for whole site?', '0', 'checkbox'),
(39, 'httpsUrls', 'You can set selected urls for HTTPS (e.g. users/login, users/register)', NULL, 'input'),
(40, 'imgDir', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in webroot/img directory', 'umphotos', 'input'),
(41, 'QRDN', 'Increase this number by 1 every time if you made any changes in CSS or JS file', '12345678', 'input'),
(42, 'cookieName', 'Please enter cookie name for your site which is used to login user automatically for remember me functionality', 'UMPremiumCookie', 'input');





-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2012 at 09:27 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--
-- Database: `xboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `QualifiedName` varchar(100) NOT NULL,
  `version` float NOT NULL,
  `plugin_category_id` int(11) NOT NULL,
  `tag_line` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `plugin_author_id` int(11) NOT NULL,
  `expiration` date NOT NULL,
  `cost` float NOT NULL,
  `currency` int(11) NOT NULL DEFAULT '1',
  `installed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `QualifiedName`, `version`, `plugin_category_id`, `tag_line`, `description`, `plugin_author_id`, `expiration`, `cost`, `currency`, `installed`) VALUES
(10, 'contact manager', 'ContactManager', 1, 3, 'Header text', 'This is a description for this plugin', 1, '0000-00-00', 0, 1, 0),
(11, 'UX Wizard', 'UXWizard', 1.2, 4, 'Header text', 'This is a description for this plugin', 2, '0000-00-00', 0.99, 1, 0),
(12, 'Development Methodology', 'DevelopmentMethodology', 1, 5, '', 'short description', 1, '0000-00-00', 0, 1, 0),
(13, 'Scrum best practices', 'ScrumBestPractices', 0.9, 5, 'all you need to know about scrum and didnt bother to ask', 'all you need to know about scrum and didnt bother to ask', 1, '0000-00-00', 0, 1, 0);


--
-- Table structure for table `plugins_startups`
--

CREATE TABLE IF NOT EXISTS `plugins_startups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startup_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `plugins_startups`
--

INSERT INTO `plugins_startups` (`id`, `startup_id`, `plugin_id`) VALUES
(1, 1, 10),
(2, 1, 11);

--
-- Table structure for table `plugin_authors`
--

CREATE TABLE IF NOT EXISTS `plugin_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `plugin_authors`
--

INSERT INTO `plugin_authors` (`id`, `name`, `info`) VALUES
(1, 'Yuval Lubowich', 'some author description'),
(2, 'John Doe', 'some author description');



--
-- Table structure for table `plugin_categories`
--

CREATE TABLE IF NOT EXISTS `plugin_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `plugin_categories`
--

INSERT INTO `plugin_categories` (`id`, `name`, `description`) VALUES
(3, 'Marketing', 'some category description'),
(4, 'Product Manegnment', 'some category description');

