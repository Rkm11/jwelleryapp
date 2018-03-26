-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2015 at 07:02 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `panacea_code_library_version2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pipl_ci_sessions`
--

CREATE TABLE IF NOT EXISTS `pipl_ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET utf8,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pipl_ci_sessions`
--

INSERT INTO `pipl_ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('6cfc31ef401cc824164d0c820e226dc5', '192.168.2.128', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0', 1428073378, 'a:4:{s:9:"user_data";s:0:"";s:11:"msg_success";s:0:"";s:12:"user_account";a:8:{s:7:"user_id";s:1:"1";s:9:"user_name";s:5:"admin";s:10:"user_email";s:20:"sofia@panaceatek.com";s:9:"user_type";s:1:"2";s:7:"role_id";s:1:"1";s:10:"first_name";s:6:"Sofiaw";s:9:"last_name";s:6:"Singhw";s:15:"user_privileges";a:0:{}}s:15:"admin_user_name";s:5:"admin";}'),
('84847e9739bbcecf69d891543e97f4ee', '192.168.2.66', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36', 1428069511, 'a:2:{s:9:"user_data";s:0:"";s:3:"msg";s:0:"";}'),
('bcb77bda9c68d41263b9d341aeb4a2d1', '192.168.2.65', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', 1428068689, 'a:2:{s:9:"user_data";s:0:"";s:3:"msg";s:0:"";}'),
('faff0dd018bf865ba2e624395ed70369', '192.168.2.128', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1428123526, 'a:3:{s:9:"user_data";s:0:"";s:12:"user_account";a:8:{s:7:"user_id";s:1:"1";s:9:"user_name";s:5:"admin";s:10:"user_email";s:20:"sofia@panaceatek.com";s:9:"user_type";s:1:"2";s:7:"role_id";s:1:"1";s:10:"first_name";s:6:"Sofiaw";s:9:"last_name";s:6:"Singhw";s:15:"user_privileges";a:0:{}}s:15:"admin_user_name";s:5:"admin";}');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_advertises`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_advertises` (
  `advertise_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `advertise_type` enum('Image','Script') NOT NULL DEFAULT 'Image',
  `redirect_url` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `script` text NOT NULL,
  `expired_start_date` datetime NOT NULL,
  `expired_end_date` datetime NOT NULL,
  `advertise_click_block_limit` int(11) NOT NULL,
  `advertise_alt_text` varchar(255) NOT NULL,
  `advertise_style` varchar(255) NOT NULL,
  `advertise_rel` varchar(255) NOT NULL,
  `advertise_impression` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '17',
  `advertise_show_type` enum('Public','Customer') NOT NULL DEFAULT 'Public',
  `advertise_size` varchar(255) NOT NULL,
  `advertise_cost` float(11,2) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`advertise_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `pipl_mst_advertises`
--

INSERT INTO `pipl_mst_advertises` (`advertise_id`, `title`, `advertise_type`, `redirect_url`, `image_name`, `script`, `expired_start_date`, `expired_end_date`, `advertise_click_block_limit`, `advertise_alt_text`, `advertise_style`, `advertise_rel`, `advertise_impression`, `language_id`, `advertise_show_type`, `advertise_size`, `advertise_cost`, `status`, `created_on`) VALUES
(27, '测试 测试 電	电	電	electricity 買	买	買	buy 開	开	開	open 東	东	東	east 車	车	車	car, vehicle 紅	红	紅	red (crimson in Japanese) 馬	马	馬	horse 無	无	無	nothing 鳥	鸟	鳥	bird 熱	热	熱	hot 時	时	時	time 語	语	語	spoken language Simplified in Japan, not Mainland China (In some cases this represen', 'Image', 'http%3A%2F%2Fgoogle.com', '1428046022.jpg', '', '2015-04-10 12:55:00', '2015-04-17 00:00:00', 0, '', '', '', 0, 12, 'Public', 'medium rectangle *300-250', 0.00, 'Active', '2015-04-03 10:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_advertise_category`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_advertise_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `pipl_mst_advertise_category`
--

INSERT INTO `pipl_mst_advertise_category` (`category_id`, `category_name`, `status`) VALUES
(14, '测试 测试 電	电	電	electricity 買	买	買	buy 開	开	開	open 東	东	東	east 車	车	車	car, vehicle 紅	红	紅	red (crimson in Japanese) 馬	马	馬	horse 無	无	無	nothing 鳥	鸟	鳥	bird 熱	热	熱	hot 時	时	時	time 語	语	語	', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_advertise_pages`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_advertise_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pipl_mst_advertise_pages`
--

INSERT INTO `pipl_mst_advertise_pages` (`page_id`, `page_name`) VALUES
(1, 'homepage');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_advertise_position`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_advertise_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(100) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pipl_mst_advertise_position`
--

INSERT INTO `pipl_mst_advertise_position` (`position_id`, `position_name`) VALUES
(1, 'Upper Side'),
(2, 'Lower Side');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_blog_categories`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_description` text NOT NULL,
  `created_on` date NOT NULL,
  `category_price` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `pipl_mst_blog_categories`
--

INSERT INTO `pipl_mst_blog_categories` (`category_id`, `category_name`, `parent_id`, `page_title`, `page_keywords`, `page_description`, `created_on`, `category_price`) VALUES
(44, 'Blog1', 0, '', '', '', '2015-04-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_blog_posts`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_blog_posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL DEFAULT '17',
  `post_title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_short_description` text NOT NULL,
  `post_content` text NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `post_tags` text NOT NULL,
  `post_keywords` text NOT NULL,
  `posted_by` int(11) unsigned NOT NULL,
  `posted_on` datetime NOT NULL,
  `status` enum('0','1','2') CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '"0"=>Unpublished  "1"=>Published   "2"=>Flag By Admin',
  `blog_type` enum('Public','Private') NOT NULL DEFAULT 'Public',
  `month` varchar(250) CHARACTER SET latin1 NOT NULL,
  `year` year(4) NOT NULL,
  `author_id` int(11) NOT NULL,
  `blog_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `author_id_fk` (`author_id`),
  KEY `fk_p871_mst_blog_posts_1` (`category_id`),
  KEY `fk_p871_mst_blog_posts_2` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `pipl_mst_blog_posts`
--

INSERT INTO `pipl_mst_blog_posts` (`post_id`, `lang_id`, `post_title`, `category_id`, `post_short_description`, `post_content`, `page_title`, `post_tags`, `post_keywords`, `posted_by`, `posted_on`, `status`, `blog_type`, `month`, `year`, `author_id`, `blog_image`) VALUES
(48, 17, 'Blog1', 0, 'Post short Description for blog 1\r\nPost short Description for blog 1', '<p>Post Desciption&nbsp;Post Desciption&nbsp;Post DesciptionPost Desciption&nbsp;Post Desciption</p>\r\n\r\n<p>Post Desciption&nbsp;Post Desciption&nbsp;Post Desciption post description</p>\r\n\r\n<p>Post Desciption&nbsp;Post Desciption&nbsp;Post Desciption&nbsp;Post Desciption&nbsp;Post Desciption</p>\r\n', 'blog1', '', '', 0, '2015-04-03 08:05:40', '1', 'Public', '', 0000, 0, '13-1428044740.jpg'),
(49, 12, '帖子标题为中国 Tiězi biāotí wéi zhōngguó', 44, '发表简短描述\r\nFābiǎo jiǎnduǎn miáoshù', '<pre>\r\n<span style="color:#FFD700">谷歌的免费在线语言翻译服务即时翻译文本和网页。该翻译器支持：英语，南非荷兰语，阿尔巴尼亚语，阿拉伯语， ...谷歌的免费在线语言翻译服务即时翻译文本和网页。该翻译器支持：英语，南非荷兰语，阿尔巴尼亚语，阿拉伯语， ...谷歌的免费在线语言翻译服务即时翻译文本和网页。该翻译器支持：英语，南非荷兰语，阿尔巴尼亚语，阿拉伯语， </span></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>测试 测试<br />\r\n電&nbsp;&nbsp; &nbsp;电&nbsp;&nbsp; &nbsp;電&nbsp;&nbsp; &nbsp;electricity<br />\r\n買&nbsp;&nbsp; &nbsp;买&nbsp;&nbsp; &nbsp;買&nbsp;&nbsp; &nbsp;buy<br />\r\n開&nbsp;&nbsp; &nbsp;开&nbsp;&nbsp; &nbsp;開&nbsp;&nbsp; &nbsp;open<br />\r\n東&nbsp;&nbsp; &nbsp;东&nbsp;&nbsp; &nbsp;東&nbsp;&nbsp; &nbsp;east<br />\r\n車&nbsp;&nbsp; &nbsp;车&nbsp;&nbsp; &nbsp;車&nbsp;&nbsp; &nbsp;car, vehicle<br />\r\n紅&nbsp;&nbsp; &nbsp;红&nbsp;&nbsp; &nbsp;紅&nbsp;&nbsp; &nbsp;red (crimson in Japanese)<br />\r\n馬&nbsp;&nbsp; &nbsp;马&nbsp;&nbsp; &nbsp;馬&nbsp;&nbsp; &nbsp;horse<br />\r\n無&nbsp;&nbsp; &nbsp;无&nbsp;&nbsp; &nbsp;無&nbsp;&nbsp; &nbsp;nothing<br />\r\n鳥&nbsp;&nbsp; &nbsp;鸟&nbsp;&nbsp; &nbsp;鳥&nbsp;&nbsp; &nbsp;bird<br />\r\n熱&nbsp;&nbsp; &nbsp;热&nbsp;&nbsp; &nbsp;熱&nbsp;&nbsp; &nbsp;hot<br />\r\n時&nbsp;&nbsp; &nbsp;时&nbsp;&nbsp; &nbsp;時&nbsp;&nbsp; &nbsp;time<br />\r\n語&nbsp;&nbsp; &nbsp;语&nbsp;&nbsp; &nbsp;語&nbsp;&nbsp; &nbsp;spoken language<br />\r\nSimplified in Japan, not Mainland China<br />\r\n(In some cases this represents the adoption<br />\r\nof different variants as standard)&nbsp;&nbsp; &nbsp;假&nbsp;&nbsp; &nbsp;假&nbsp;&nbsp; &nbsp;仮&nbsp;&nbsp; &nbsp;false<br />\r\n罐&nbsp;&nbsp; &nbsp;罐&nbsp;&nbsp; &nbsp;缶&nbsp;&nbsp; &nbsp;Tin can<br />\r\n佛&nbsp;&nbsp; &nbsp;佛&nbsp;&nbsp; &nbsp;仏&nbsp;&nbsp; &nbsp;Buddha<br />\r\n惠&nbsp;&nbsp; &nbsp;惠&nbsp;&nbsp; &nbsp;</p>\r\n\r\n<pre>\r\n<span style="background-color:#AFEEEE">Gǔgē de miǎnf&egrave;i z&agrave;ixi&agrave;n yǔy&aacute;n fāny&igrave; f&uacute;w&ugrave; j&iacute;sh&iacute; fāny&igrave; w&eacute;nběn h&eacute; wǎngy&egrave;. Gāi fāny&igrave; q&igrave; zhīch&iacute;: Yīngyǔ, n&aacute;nfēi h&eacute;l&aacute;n yǔ, ā&#39;ěrbān&iacute;yǎ yǔ, ālāb&oacute; yǔ, ... Gǔgē de miǎnf&egrave;i z&agrave;ixi&agrave;n yǔy&aacute;n fāny&igrave; f&uacute;w&ugrave; j&iacute;sh&iacute; fāny&igrave; w&eacute;nběn h&eacute; wǎngy&egrave;. Gāi fāny&igrave; q&igrave; zhīch&iacute;: Yīngyǔ, n&aacute;nfēi h&eacute;l&aacute;n yǔ, ā&#39;ěrbān&iacute;yǎ yǔ, ālāb&oacute; yǔ, ... Gǔgē de miǎnf&egrave;i z&agrave;ixi&agrave;n yǔy&aacute;n fāny&igrave; f&uacute;w&ugrave; j&iacute;sh&iacute; fāny&igrave; w&eacute;nběn h&eacute; wǎngy&egrave;. Gāi fāny&igrave; q&igrave; zhīch&iacute;: Yīngyǔ, n&aacute;nfēi h&eacute;l&aacute;n yǔ, ā&#39;ěrbān&iacute;yǎ yǔ, ālāb&oacute; yǔ, ...</span></pre>\r\n\r\n<pre>\r\n<span style="background-color:#AFEEEE">Gǔgē de miǎnf&egrave;i z&agrave;ixi&agrave;n yǔy&aacute;n fāny&igrave; f&uacute;w&ugrave; j&iacute;sh&iacute; fāny&igrave; w&eacute;nběn h&eacute; wǎngy&egrave;. Gāi fāny&igrave; q&igrave; zhīch&iacute;: Yīngyǔ, n&aacute;nfēi h&eacute;l&aacute;n yǔ, ā&#39;ěrbān&iacute;yǎ yǔ, ālāb&oacute; yǔ, ... Gǔgē de miǎnf&egrave;i z&agrave;ixi&agrave;n yǔy&aacute;n fāny&igrave; f&uacute;w&ugrave; j&iacute;sh&iacute; fāny&igrave; w&eacute;nběn h&eacute; wǎngy&egrave;. Gāi fāny&igrave; q&igrave; zhīch&iacute;: Yīngyǔ, n&aacute;nfēi h&eacute;l&aacute;n yǔ, ā&#39;ěrbān&iacute;yǎ yǔ, ālāb&oacute; yǔ, ... Gǔgē de miǎnf&egrave;i z&agrave;ixi&agrave;n yǔy&aacute;n fāny&igrave; f&uacute;w&ugrave; j&iacute;sh&iacute; fāny&igrave; w&eacute;nběn h&eacute; wǎngy&egrave;. Gāi fāny&igrave; q&igrave; zhīch&iacute;: Yīngyǔ, n&aacute;nfēi h&eacute;l&aacute;n yǔ, ā&#39;ěrbān&iacute;yǎ yǔ, ālāb&oacute; yǔ, ...</span></pre>\r\n\r\n<p><span style="background-color:#AFEEEE"><img alt="smiley" src="http://192.168.2.128/panacea_code_library_new_multi_language/media/backend/js/ckeditor/plugins/smiley/images/regular_smile.png" style="height:23px; width:23px" title="smiley" /></span></p>\r\n\r\n<p><span style="background-color:#AFEEEE"><img alt="smiley" src="http://192.168.2.128/panacea_code_library_new_multi_language/media/backend/js/ckeditor/plugins/smiley/images/regular_smile.png" style="height:23px; width:23px" title="smiley" /></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', '测试', '测试 测试\r\n電	电	電	electricity\r\n買	买	買	buy\r\n開	开	開	open\r\n東	东	東	east\r\n車	车	車	car, vehicle\r\n紅	红	紅	red (crimson in Japanese)\r\n馬	马	馬	horse\r\n無	无	無	nothing\r\n鳥	鸟	鳥	bird\r\n熱	热	熱	hot\r\n時	时	時	time\r\n語	语	語	spoken language\r\nSimplified in Japan, not Mainland China\r\n(In some cases this represents the adoption\r\nof different variants as standard)	假	假	仮	false\r\n罐	罐	缶	Tin can\r\n佛	佛	仏	Buddha\r\n惠	惠	', '', 0, '2015-04-03 08:09:46', '1', 'Public', '', 0000, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_category`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pipl_mst_category`
--

INSERT INTO `pipl_mst_category` (`category_id`, `parent_id`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_cities`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_fk` int(11) DEFAULT NULL,
  `state_id_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`city_id`),
  KEY `state_id_fk` (`state_id_fk`),
  KEY `country_id_fk` (`country_id_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This is the city table. ' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pipl_mst_cities`
--

INSERT INTO `pipl_mst_cities` (`city_id`, `country_id_fk`, `state_id_fk`) VALUES
(1, 1, 6),
(2, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_cms`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_alias` varchar(225) NOT NULL,
  `status` enum('Published','Unpublished') NOT NULL,
  `on_date` datetime NOT NULL,
  PRIMARY KEY (`cms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pipl_mst_cms`
--

INSERT INTO `pipl_mst_cms` (`cms_id`, `page_alias`, `status`, `on_date`) VALUES
(1, 'about-us', 'Published', '2014-08-01 16:37:48'),
(2, 'terms-services', 'Published', '2014-10-21 12:03:44'),
(3, 'privacy', 'Published', '2014-12-16 07:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_contact_us`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_contact_us` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mail_id` varchar(255) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `reply_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'Not Replied=>0,Replied=>1',
  `date` datetime NOT NULL,
  `user_id_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `contact_id` (`contact_id`),
  KEY `fk_pipl_mst_contact_us_1` (`user_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_countries`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` varchar(110) NOT NULL,
  `geoname` int(11) NOT NULL,
  PRIMARY KEY (`country_id`),
  KEY `indxCountryIso` (`iso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pipl_mst_countries`
--

INSERT INTO `pipl_mst_countries` (`country_id`, `iso`, `geoname`) VALUES
(1, 'In', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_email_templates`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_email_templates` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_template_title` varchar(100) DEFAULT NULL,
  `email_template_subject` varchar(100) DEFAULT NULL,
  `email_template_content` text,
  `lang_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`email_template_id`),
  KEY `fk_pipl_email_templates_1` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `pipl_mst_email_templates`
--

INSERT INTO `pipl_mst_email_templates` (`email_template_id`, `email_template_title`, `email_template_subject`, `email_template_content`, `lang_id`, `created_by`, `date_created`, `date_updated`) VALUES
(3, 'admin-added', 'You have been added as admin user', '<p>Dear ||ADMIN_NAME||,</p>\n\n<p>You have been added as admin user on ||SITE_TITLE||, your log in details are as follows</p>\n\n<p>Username: ||USER_NAME||</p>\n\n<p>Password: ||PASSWORD||</p>\n\n<p>Click on Following link to activate you account.</p>\n\n<p>||ADMIN_ACTIVATION_LINK||</p>\n\n<p>Thank you,</p>\n\n<p>||SITE_TITLE||</p>\n\n<p>||SITE_PATH||</p>\n', 17, 1, '2014-08-01 09:29:23', '2015-03-28 09:48:50'),
(4, 'admin-updated', 'Your account has been updated', '<p>\n	Dear ||ADMIN_NAME||,</p>\n<p>\n	&nbsp;</p>\n<p>\n	Your account has been updated on ||SITE_TITLE||,&nbsp; your log in details are as follows</p>\n<p>\n	Username:||USER_NAME||</p>\n<p>\n	Password:||PASSWORD||</p>\n<p>\n	Click on Following link to Log in.</p>\n<p>\n	||ADMIN_LOGIN_LINK||</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thank you,</p>\n<p>\n	||SITE_TITLE||</p>\n<p>\n	||SITE_PATH||</p>\n', 17, 1, '2014-08-01 09:29:23', '2014-08-01 09:29:23'),
(5, 'admin-deleted', 'Your account has been deleted.', '<p>\n	Dear ||ADMIN_NAME||,</p>\n<p>\n	&nbsp;</p>\n<p>\n	Your admin account has been deleted on ||SITE_TITLE||</p>\n<p>\n	You may contact with ||SITE_TITLE|| administrator for more details.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thank you,</p>\n<p>\n	||SITE_TITLE||</p>\n<p>\n	||SITE_PATH||</p>\n<p>\n	&nbsp;</p>\n', 17, 4, '2014-08-01 09:29:23', '2014-08-01 09:29:23'),
(6, 'admin-forgot-password', 'Admin Login Credentials', '<p>\n	Dear ||ADMIN_NAME||,</p>\n<p>\n	&nbsp;</p>\n<p>\n	Your login credential for your admin account on ||SITE_TITLE||&nbsp;are as below.</p>\n<p>\n	Username:||USER_NAME||</p>\n<p>\n	Password:||PASSWORD||</p>\n<p>\n	Click on Following link to Log in.</p>\n<p>\n	||ADMIN_LOGIN_LINK||</p>\n<p>\n	&nbsp;</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thank you,</p>\n<p>\n	||SITE_TITLE||</p>\n<p>\n	||SITE_PATH||</p>\n<div>\n	&nbsp;</div>\n', 17, 1, '2014-08-01 09:29:23', '2014-08-01 09:29:23'),
(7, 'admin-email-updated', 'Verify updated Account', '<p>\n	Dear ||USER_NAME||,</p>\n<p>\n	&nbsp;</p>\n<p>\n	Your account has been updated on ||SITE_TITLE||,&nbsp; your log in details are as follows</p>\n<p>\n	Username:||USER_NAME||</p>\n<p>\n	Password:||PASSWORD||</p>\n<p>\n	Click on Following link to verify your account</p>\n<p>\n	||ADMIN_ACTIVATION_LINK||</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thank you,</p>\n<p>\n	||SITE_TITLE||</p>\n<p>\n	||SITE_PATH||</p>\n', 17, 1, '2014-08-01 09:29:23', '2014-10-15 19:10:09'),
(8, 'registration-successful', 'Registration Successful', '<p>\n	Dear ||USER_NAME||,</p>\n<p>\n	Your registration has&nbsp; been completed successfully. Please click on following link to login.</p>\n<p>\n	Email:-&nbsp;||USER_EMAIL||</p>\n<p>\n	Password:- ||PASSWORD||</p>\n<p>\n	Please ||ACTIVATION_LINK|| to access your account.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Regards,</p>\n<p>\n	||SITE_TITLE||</p>\n<p>\n	&nbsp;</p>\n', 17, 1, '2014-10-04 00:00:00', '2014-12-22 06:17:07'),
(9, 'registration-successful-to-admin', 'New user Registred', '<p>\n	Dear Admin,</p>\n<p>\n	&nbsp;</p>\n<p>\n	New user has been registered successfully.</p>\n<p>\n	Following are the User Details,<br />\n	<br />\n	User email : ||USER_EMAIL||</p>\n<p>\n	&nbsp;</p>\n<p>\n	Regards,</p>\n<p>\n	||SITE_TITLE||</p>\n', 17, 1, '2014-10-04 00:00:00', '2014-10-22 19:03:29'),
(10, 'forgot-password', 'forgot-password', '<p>\n	Dear ||USER_NAME||</p>\n<p>\n	&nbsp;</p>\n<p>\n	Click the link below to set a new password on&nbsp; ||SITE_TITLE||.</p>\n<p>\n	||RESET_PASSWORD_LINK||</p>\n<p>\n	If you don&#39;t want to change your password or did not request a password change, just ignore this message.</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thank you,</p>\n<p>\n	||SITE_TITLE||</p>\n', 17, 1, '2014-10-04 00:00:00', '2014-10-22 19:04:56'),
(11, 'reverification-link-send', 'Reverification Link Send', '<p>\r\n	Dear ||USER_NAME||,</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Your registration has&nbsp; been completed suceessfully. Please click on following link and activiate your account to login.</p>\r\n<p>\r\n	||VARIFICATION_LINK||</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Regards,</p>\r\n<p>\r\n	||SITE_TITLE||</p>\r\n<div>\r\n	&nbsp;</div>\r\n', 17, 1, '2014-10-04 00:00:00', NULL),
(12, 'facebook-registration-successful', 'Registration Successful', '<p>\r\n	Dear ||USER||,</p>\r\n<p>\r\n	Your registration has been completed suceessfully.</p>\r\n<p>\r\n	Please note you are registered via your facebook account, so the login credentials are automatically created by ||SITE_TITLE||, which will allow you to login using below details,</p>\r\n<p>\r\n	Username (your email):- ||USER||</p>\r\n<p>\r\n	Password(automatically generated):-&nbsp;||USER_PASS||</p>\r\n<p>\r\n	You can still use your facebook account to login further.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Regards,</p>\r\n<p>\r\n	||SITE_TITLE||</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 17, 1, '2014-10-17 00:00:00', NULL),
(19, 'user-updated', 'Your account has been updated', '<p>\n	Dear ||ADMIN_NAME||,</p>\n<p>\n	&nbsp;</p>\n<p>\n	Your account has been updated on ||SITE_TITLE||,&nbsp; your log in details are as follows</p>\n<p>\n	Email:- ||USER_EMAIL||</p>\n<p>\n	Password:- ||PASSWORD||</p>\n<p>\n	Click on Following link to Log in.</p>\n<p>\n	||ADMIN_LOGIN_LINK||</p>\n<p>\n	&nbsp;</p>\n<p>\n	Thank you,</p>\n<p>\n	||SITE_TITLE||</p>\n<p>\n	||SITE_PATH||</p>\n', 17, 1, '2014-08-01 09:29:23', '2014-12-03 17:42:49'),
(20, 'user-deleted', 'Your account has been deleted.', '<p>\r\n	Dear ||USER_NAME||,</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Your account has been deleted on ||SITE_TITLE||</p>\r\n<p>\r\n	You may contact with ||SITE_TITLE|| administrator for more details.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Thank you,</p>\r\n<p>\r\n	||SITE_TITLE||</p>\r\n<p>\r\n	||SITE_PATH||</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 17, 4, '2014-08-01 09:29:23', '2014-08-01 09:29:23'),
(21, 'new-dispute-created', 'New Dispute Created', '<p>\r\n	Dear ||USER_NAME||,</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	A New dispute has been opened for the Product ||PRODUCT_NAME|| . Following details are details.</p>\r\n<p>\r\n	product Title : ||PRODUCT_NAME|| Originator Name: ||ORIGINATOR_NAME||</p>\r\n<p>\r\n	For more details check on ||SITE_TITLE||.</p>\r\n<p>\r\n	Regards,</p>\r\n<p>\r\n	||SITE_TITLE||</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 17, 1, '2014-12-22 00:00:00', '2015-04-03 10:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_email_template_macros`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_email_template_macros` (
  `macro_id` int(11) NOT NULL AUTO_INCREMENT,
  `macros` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`macro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `pipl_mst_email_template_macros`
--

INSERT INTO `pipl_mst_email_template_macros` (`macro_id`, `macros`, `value`, `created_date`) VALUES
(1, '||USER_NAME||', '', '2014-12-04 04:06:18'),
(2, '||USER_EMAIL||', '', '2014-12-04 04:06:18'),
(3, '||PASSWORD||', '', '2014-12-04 03:04:20'),
(4, '||SITE_TITLE||', '', '2014-12-04 03:04:20'),
(7, '||LOGIN_LINK||', '', '2014-12-03 12:28:42'),
(8, '||ADMIN_NAME||', '', '2014-12-03 12:28:42'),
(9, '||ADMIN_ACTIVATION_LINK||', '', '2014-12-06 12:28:42'),
(10, '||SITE_PATH||', '', '2014-12-06 12:28:42'),
(11, '||ADMIN_EMAIL||', '', '2014-12-06 05:17:18'),
(12, '||ADMIN_LOGIN_LINK||', '', '2014-12-06 15:13:13'),
(13, '||Link_to_activate_account||', '', '2014-12-06 13:17:19'),
(18, '||SITE_URL||', '', '2014-12-06 15:38:38'),
(19, '||RESET_PASSWORD_LINK||', '', '0000-00-00 00:00:00'),
(20, '||USER||', '', '0000-00-00 00:00:00'),
(21, '||FIRST_NAME||', '', '0000-00-00 00:00:00'),
(22, '||LAST_NAME||', '', '0000-00-00 00:00:00'),
(23, '||VARIFICATION_LINK||', '', '0000-00-00 00:00:00'),
(24, '||ACTIVATION_LINK||', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_faqs`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_faqs` (
  `faq_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` longtext NOT NULL,
  `created_on` date NOT NULL,
  `lang_id` int(11) NOT NULL DEFAULT '17',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive' COMMENT 'if status is active it will display in front end otherwise not',
  PRIMARY KEY (`faq_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `pipl_mst_faqs`
--

INSERT INTO `pipl_mst_faqs` (`faq_id`, `category_id`, `question`, `answer`, `created_on`, `lang_id`, `status`) VALUES
(24, 0, 'Questions', 'Answers Answers Answers Answers Answers Answers Answers Answers Answers Answers', '2015-04-03', 17, 'Active'),
(25, 0, '馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāngv馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng', '馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng\r\n馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng\r\n馬哈拉施特拉邦\r\nMǎ hā lā shī tè lā bāng', '2015-04-03', 12, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_faq_categories`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_faq_categories` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pipl_mst_faq_categories`
--

INSERT INTO `pipl_mst_faq_categories` (`category_id`, `title`, `created_on`) VALUES
(6, 'category 1', '2014-08-11 00:00:00'),
(7, 'category 2', '2014-08-11 00:00:00'),
(9, 'category 3', '2014-08-11 16:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_global_settings`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_global_settings` (
  `global_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`global_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pipl_mst_global_settings`
--

INSERT INTO `pipl_mst_global_settings` (`global_name_id`, `name`) VALUES
(1, 'site_email'),
(2, 'site_title'),
(3, 'contact_email'),
(4, 'date_format'),
(7, 'per_page_record'),
(8, 'facebook_link'),
(9, 'twitter_link'),
(11, 'google_link'),
(13, 'phone_no'),
(14, 'facebook_app_id'),
(15, 'pinterest_link'),
(16, 'zip_code'),
(17, 'address'),
(18, 'street'),
(19, 'city'),
(20, 'contact_us_message');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_languages`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_languages` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(100) DEFAULT NULL,
  `lang_icon` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `pipl_mst_languages`
--

INSERT INTO `pipl_mst_languages` (`lang_id`, `lang_name`, `lang_icon`, `status`) VALUES
(2, 'Afrikaans', '', 'I'),
(4, 'Arabic', '', 'I'),
(5, 'Armenian', '', 'I'),
(7, 'Basque', '', 'I'),
(8, 'Belarusian', '', 'I'),
(9, 'Bengali', '', 'I'),
(10, 'Bulgarian', '', 'I'),
(11, 'Catalan', '', 'I'),
(12, 'Chinese', '', 'A'),
(13, 'Croatian', '', 'I'),
(14, 'Czech', '', 'I'),
(15, 'Danish', '', 'I'),
(16, 'Dutch', '', 'I'),
(17, 'English', 'en.jpg', 'A'),
(18, 'Esperanto', '', 'I'),
(19, 'Estonian', '', 'I'),
(20, 'Filipino', '', 'I'),
(21, 'Finnish', '', 'I'),
(22, 'French', '', 'I'),
(23, 'Galician', '', 'I'),
(24, 'Georgian', '', 'I'),
(25, 'German', '', 'I'),
(26, 'Greek', '', 'I'),
(27, 'Gujarati', '', 'I'),
(28, 'Haitian Creole', '', 'I'),
(29, 'Hebrew', '', 'I'),
(30, 'Hindi', '', 'I'),
(31, 'Hungarian', '', 'I'),
(32, 'Icelandic', '', 'I'),
(33, 'Indonesian', '', 'I'),
(34, 'Irish', '', 'I'),
(35, 'Italian', '', 'I'),
(36, 'Japanese', 'ar.png', 'I'),
(37, 'Kannada', '', 'I'),
(38, 'Korean', '', 'I'),
(39, 'Latin', '', 'I'),
(40, 'Latvian', '', 'I'),
(41, 'Lithuanian', '', 'I'),
(42, 'Macedonian', '', 'I'),
(43, 'Malay', '', 'I'),
(44, 'Maltese', '', 'I'),
(45, 'Norwegian', '', 'I'),
(46, 'Persian', '', 'I'),
(47, 'Polish', '', 'I'),
(48, 'Portuguese', '', 'I'),
(49, 'Romanian', '', 'I'),
(50, 'Russian', '', 'I'),
(51, 'Serbian', '', 'I'),
(52, 'Slovak', '', 'I'),
(53, 'Slovenian', '', 'I'),
(54, 'Spanish', '', 'I'),
(55, 'Swahili', '', 'I'),
(56, 'Swedish', '', 'I'),
(57, 'Tamil', '', 'I'),
(58, 'Telugu', '', 'I'),
(59, 'Thai', '', 'I'),
(60, 'Turkish', '', 'I'),
(61, 'Ukrainian', '', 'I'),
(62, 'Urdu', '', 'I'),
(63, 'Vietnamese', '', 'I'),
(64, 'Welsh', '', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_newsletter`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_subject` varchar(150) NOT NULL,
  `newsletter_content` text NOT NULL,
  `lang_id` int(11) NOT NULL,
  `newsletter_status` enum('1','0') NOT NULL,
  `add_date` date NOT NULL,
  `update_date` date NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pipl_mst_newsletter`
--

INSERT INTO `pipl_mst_newsletter` (`newsletter_id`, `newsletter_subject`, `newsletter_content`, `lang_id`, `newsletter_status`, `add_date`, `update_date`) VALUES
(6, '馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng', '<div class="tw-lfl tw-compact-ta-container" id="tw-target-text-container" style="position: relative; padding-top: 20px; color: rgb(33, 33, 33); font-family: arial, sans-serif; font-size: 0px; line-height: 0px; background-color: rgb(255, 255, 255);"><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;"><div class="tw-lfl tw-compact-ta-container" id="tw-target-text-container" style="position: relative; padding-top: 20px; font-size: 0px; line-height: 0px; white-space: normal;"><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;"><div class="tw-lfl tw-compact-ta-container" id="tw-target-text-container" style="position: relative; padding-top: 20px; font-size: 0px; line-height: 0px; white-space: normal;"><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">dejfcbjsb<span style="font-family: inherit; font-weight: lighter; background-color: transparent;">馬哈拉施特拉邦</span></pre><div class="tw-lfl tw-compact-ta-container" id="tw-target-text-container" style="position: relative; padding-top: 20px;"><pre class="tw-data-text vk_txt tw-ta tw-text-medium" style="border: none; padding: 0px 0.14em 0px 0px; position: absolute; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; text-align: initial; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; visibility: hidden; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;"></pre></div><div class="vk_dgy tw-nfl tw-compact-ta-container" id="tw-target-rmn-container" style="position: relative; margin-top: 5px; color: rgb(84, 84, 84) !important;"><pre class="tw-data-text vk_txt tw-ta tw-text-small" data-placeholder="" id="tw-target-rmn" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 24px; font-size: 16px !important; line-height: 24px !important; color: rgb(135, 135, 135) !important; background-color: transparent;">Mǎ hā lā shī tè lā bāng <span style="font-family: inherit; font-size: 25px; font-weight: lighter; line-height: 36px; color: rgb(33, 33, 33); background-color: transparent;">馬哈拉施特拉邦</span></pre><div class="tw-lfl tw-compact-ta-container" id="tw-target-text-container" style="position: relative; padding-top: 20px; color: rgb(33, 33, 33);"><pre class="tw-data-text vk_txt tw-ta tw-text-medium" style="border: none; padding: 0px 0.14em 0px 0px; position: absolute; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; text-align: initial; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; visibility: hidden; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;"></pre></div><div class="vk_dgy tw-nfl tw-compact-ta-container" id="tw-target-rmn-container" style="position: relative; margin-top: 5px;"><pre class="tw-data-text vk_txt tw-ta tw-text-small" data-placeholder="" id="tw-target-rmn" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 24px; font-size: 16px !important; line-height: 24px !important; color: rgb(135, 135, 135) !important; background-color: transparent;">Mǎ hā lā shī tè lā bāng <span style="font-family: inherit; font-size: 25px; font-weight: lighter; line-height: 36px; color: rgb(33, 33, 33); background-color: transparent;">馬哈拉施特拉邦</span></pre><div class="tw-lfl tw-compact-ta-container" id="tw-target-text-container" style="position: relative; padding-top: 20px; color: rgb(33, 33, 33);"><pre class="tw-data-text vk_txt tw-ta tw-text-medium" style="border: none; padding: 0px 0.14em 0px 0px; position: absolute; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; text-align: initial; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; visibility: hidden; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;"></pre></div><div class="vk_dgy tw-nfl tw-compact-ta-container" id="tw-target-rmn-container" style="position: relative; margin-top: 5px;"><pre class="tw-data-text vk_txt tw-ta tw-text-small" data-placeholder="" id="tw-target-rmn" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 24px; font-size: 16px !important; line-height: 24px !important; color: rgb(135, 135, 135) !important; background-color: transparent;">Mǎ hā lā shī tè lā bāng</pre></div></div></div><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">fhsdjb</pre><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">jhfjsdhfsfd</pre><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">jjhfghfh</pre><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">fbfbvfv </pre><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">fjbgv njfjgg</pre><pre class="tw-data-text vk_txt tw-ta tw-text-medium" data-placeholder="Translation" id="tw-target-text" data-fulltext="" dir="ltr" style="unicode-bidi: -webkit-isolate; border: none; padding: 0px 0.14em 0px 0px; position: relative; margin-top: 0px; margin-bottom: 0px; resize: none; font-family: inherit; overflow: hidden; width: 237.5px; white-space: pre-wrap; word-wrap: break-word; height: 36px; font-weight: lighter !important; font-size: 25px !important; line-height: 36px !important; background-color: transparent;">vbfbvfbvbv vfjvgxdvgnm</pre></div></pre></div></pre></div>', 0, '1', '2015-04-03', '2015-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_notifications`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `notification_to` int(11) DEFAULT NULL,
  `subject` varchar(225) NOT NULL,
  `message` text NOT NULL,
  `notification_status` enum('send','failed') NOT NULL,
  `notification_date` datetime NOT NULL,
  `read_status` enum('0','1') NOT NULL DEFAULT '0',
  `user_type` enum('1','2') NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1546 ;

--
-- Dumping data for table `pipl_mst_notifications`
--

INSERT INTO `pipl_mst_notifications` (`notification_id`, `contact_id`, `from`, `notification_to`, `subject`, `message`, `notification_status`, `notification_date`, `read_status`, `user_type`) VALUES
(1, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear joytest,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '1', '2'),
(2, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear admin,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '1', '2'),
(3, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear shona123,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '0', '2'),
(4, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear rohini,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '1', '2'),
(5, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear kotaruk,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '0', '2'),
(6, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear tushar,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '0', '2'),
(7, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear google,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '0', '2'),
(8, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear datta,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/MQ==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:28:35', '0', '2'),
(9, NULL, 151, 181, 'New Product available for rent in your subscribed category', '<p>\n	Dear joytest,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/Mg==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:30:14', '0', '2'),
(10, NULL, 151, 223, 'New Product available for rent in your subscribed category', '<p>\n	Dear admin,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/Mg==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:30:14', '1', '2'),
(11, NULL, 151, 164, 'New Product available for rent in your subscribed category', '<p>\n	Dear rohini,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/Mg==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:30:15', '0', '2'),
(12, NULL, 151, 176, 'New Product available for rent in your subscribed category', '<p>\n	Dear kotaruk,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/Mg==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:30:15', '0', '2'),
(14, NULL, 151, 156, 'New Product available for rent in your subscribed category', '<p>\n	Dear google,</p>\n<p>\n	New product posted on pipl.Click on below link for more details <a href="http://182.72.122.106/pipl/phase4/product-details/Mg==" target="_blank">Click here</a></p>\n<p>\n	 </p>\n<p>\n	Regards,</p>\n<p>\n	pipl</p>\n<p>\n	 </p>\n', 'send', '2014-11-04 11:30:15', '0', '2'),
(1542, NULL, NULL, 219, 'New Dispute Created', '<p>\r\n	Dear harry,</p>\r\n<p>\r\n\r\n<p>\r\n	A New dispute has been opened for the Product Sports & health/Fitness123 .\r\nFollowing details are details.</p>\r\n\r\n<p>\r\n	product Title : Sports & health/Fitness123\r\n        Originator Name: tushar\r\n</p>\r\n<p>\r\n	For more details check on PIPL Code lib.\r\n</p>\r\n\r\n<p>\r\n	Regards,</p>\r\n<p>\r\n	PIPL Code lib</p>\r\n', 'send', '2014-12-22 12:19:58', '0', '1'),
(1544, NULL, NULL, 217, 'New Dispute Created', '<p>\r\n	Dear emmaa,</p>\r\n<p>\r\n\r\n<p>\r\n	A New dispute has been opened for the Product aaaa .\r\nFollowing details are details.</p>\r\n\r\n<p>\r\n	product Title : aaaa\r\n        Originator Name: tushar\r\n</p>\r\n<p>\r\n	For more details check on PIPL Code lib.\r\n</p>\r\n\r\n<p>\r\n	Regards,</p>\r\n<p>\r\n	PIPL Code lib</p>\r\n', 'send', '2014-12-22 13:54:21', '0', '1'),
(1545, NULL, NULL, 219, 'New Dispute Created', '<p>\r\n	Dear harry,</p>\r\n<p>\r\n\r\n<p>\r\n	A New dispute has been opened for the Product yyyyyyyyyy .\r\nFollowing details are details.</p>\r\n\r\n<p>\r\n	product Title : yyyyyyyyyy\r\n        Originator Name: tushar\r\n</p>\r\n<p>\r\n	For more details check on PIPL Code lib.\r\n</p>\r\n\r\n<p>\r\n	Regards,</p>\r\n<p>\r\n	PIPL Code lib</p>\r\n', 'send', '2014-12-23 05:00:23', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_privileges`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_privileges` (
  `privileges_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_name` varchar(200) NOT NULL,
  PRIMARY KEY (`privileges_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pipl_mst_privileges`
--

INSERT INTO `pipl_mst_privileges` (`privileges_id`, `privilege_name`) VALUES
(1, 'Email Templates'),
(3, 'Manage CMS'),
(4, 'Contact Us Section'),
(5, 'User Section'),
(6, 'Newsletter Section'),
(7, 'FAQ Section'),
(8, 'Interests Section');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_role`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `pipl_mst_role`
--

INSERT INTO `pipl_mst_role` (`role_id`, `role_name`) VALUES
(1, 'Super Admin'),
(23, 'Sub Admin'),
(36, 'test123'),
(37, 'dssadsadsadas');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_sliders`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_sliders` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(50) DEFAULT NULL,
  `slider_rotation_speed` varchar(10) DEFAULT NULL,
  `pause_on_mouse_over` enum('Yes','No') DEFAULT NULL,
  `enable_pause_button` enum('Yes','No') DEFAULT NULL,
  `enable_next_previous_button` enum('Yes','No') DEFAULT NULL,
  `control_nav` enum('Yes','thumbnails','No') DEFAULT NULL,
  `slider_type` enum('Full Width','Responsive') DEFAULT NULL,
  `enable_auto_slide` enum('Yes','No') DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `show_description_text_over_image` enum('Yes','No') DEFAULT NULL,
  `image_over_description_position` enum('Left','Right','Up','Down') DEFAULT NULL,
  `slider_effect_id_fk` int(11) DEFAULT NULL,
  `slider_status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `slider_width_height_fk` int(11) DEFAULT NULL,
  `slider_direction` enum('horizontal','vertical') DEFAULT NULL,
  `is_autoslide_loop` enum('Yes','No') DEFAULT NULL,
  `slider_animation_speed` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`slider_id`),
  KEY `fk_p778_mst_slider_banners_1` (`lang_id`),
  KEY `fk_p778_mst_slider_banners_2` (`slider_effect_id_fk`),
  KEY `fk_p778_mst_slider_1` (`slider_effect_id_fk`),
  KEY `fk_p778_mst_sliders_1` (`slider_width_height_fk`),
  KEY `fk_p778_mst_sliders_2` (`slider_width_height_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This is the master table for slider which will have the slid' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pipl_mst_sliders`
--

INSERT INTO `pipl_mst_sliders` (`slider_id`, `slider_title`, `slider_rotation_speed`, `pause_on_mouse_over`, `enable_pause_button`, `enable_next_previous_button`, `control_nav`, `slider_type`, `enable_auto_slide`, `lang_id`, `show_description_text_over_image`, `image_over_description_position`, `slider_effect_id_fk`, `slider_status`, `slider_width_height_fk`, `slider_direction`, `is_autoslide_loop`, `slider_animation_speed`) VALUES
(1, 'Demo Slider', '500', 'No', 'No', 'Yes', 'Yes', 'Responsive', 'Yes', 17, 'Yes', '', 1, 'Active', 1, 'vertical', 'Yes', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_states`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` int(11) NOT NULL,
  `geonameid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pipl_mst_states`
--

INSERT INTO `pipl_mst_states` (`id`, `country`, `geonameid`) VALUES
(6, 1, 0),
(7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_testimonial`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_testimonial` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` enum('User','Admin') NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'User id is of front end user id or back end admin user id',
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL COMMENT 'if status is active it will display in front end otherwise not',
  `testimonial` text NOT NULL COMMENT 'tetimonail content',
  `added_date` datetime NOT NULL COMMENT 'added date of testimonail',
  `updated_date` datetime NOT NULL COMMENT 'Updated date of testimonial',
  `is_featured` enum('0','1') NOT NULL DEFAULT '0',
  `lang_id` int(11) NOT NULL DEFAULT '17',
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `pipl_mst_testimonial`
--

INSERT INTO `pipl_mst_testimonial` (`testimonial_id`, `added_by`, `user_id`, `name`, `status`, `testimonial`, `added_date`, `updated_date`, `is_featured`, `lang_id`) VALUES
(48, 'Admin', 1, ' gfdg ', 'Inactive', 'dfgdfgdfdfgfdgfdgdfgfdgdf', '2015-04-01 07:00:27', '2015-04-01 07:24:41', '0', 0),
(51, 'Admin', 1, 'Tetimonial 123   ', 'Active', 'testimonial testimoniall', '2015-04-03 09:43:46', '2015-04-03 10:19:00', '0', 0),
(53, 'Admin', 1, ' 馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng ', 'Active', '馬哈拉施特拉邦\\\\r\\\\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\\\\r\\\\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\\\\r\\\\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\\\\r\\\\nMǎ hā lā shī tè lā bāng 馬哈拉施特拉邦\\\\r\\\\nMǎ hā lā shī tè lā bāng', '2015-04-03 09:44:32', '2015-04-03 14:17:52', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_uri_map`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_uri_map` (
  `url_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL,
  `rel_id` int(11) NOT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `pipl_mst_uri_map`
--

INSERT INTO `pipl_mst_uri_map` (`url_id`, `type`, `url`, `rel_id`) VALUES
(1, 'blog-category', 'gggghhh', 33),
(2, 'blog-post', 'ddd', 40),
(3, 'blog-post', 'Addvertisement', 41),
(4, 'blog-category', '', 34),
(5, 'blog-category', '', 35),
(6, 'blog-category', 'pR', 36),
(7, 'blog-post', 'Blog', 42),
(8, 'blog-category', '', 37),
(9, 'blog-category', '', 38),
(10, 'blog-category', '', 39),
(11, 'blog-post', 'xcvxc', 43),
(12, 'blog-category', '', 40),
(13, 'blog-category', '', 41),
(14, 'blog-category', '', 42),
(15, 'blog-category', '', 43),
(16, 'blog-post', 'gfdgdfg', 44),
(17, 'blog-post', 'test', 45),
(18, 'blog-post', 'testLan', 46),
(19, 'blog-post', 'testBlogLang', 47),
(20, 'blog-post', 'Blog1', 48),
(21, 'blog-post', '帖子标题为中国-Tiězi-biāotí-wéi-zhōngguó', 49),
(22, 'blog-post', '测试-测试-测试-测试', 50),
(23, 'blog-category', 'Blog1', 44);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_mst_users`
--

CREATE TABLE IF NOT EXISTS `pipl_mst_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `profile_picture` varchar(20) DEFAULT NULL,
  `gender` enum('1','2') NOT NULL COMMENT '''1=>Male'',''2=>Female''',
  `user_type` enum('1','2') NOT NULL COMMENT '1=>Normal 2=>admin',
  `user_status` enum('0','1','2') NOT NULL COMMENT '0=>Inactive,1=>Active,2=>Blocked',
  `activation_code` varchar(20) DEFAULT NULL,
  `reset_password_code` varchar(20) NOT NULL,
  `email_verified` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `last_login` datetime DEFAULT NULL,
  `fb_id` varchar(25) DEFAULT NULL,
  `tw_id` varchar(25) DEFAULT NULL,
  `register_date` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  `send_email_notification` enum('1','0') NOT NULL DEFAULT '1',
  `ip_address` varchar(35) NOT NULL,
  `user_county` int(11) DEFAULT NULL,
  `user_city` int(11) DEFAULT NULL,
  `user_birth_date` varchar(45) DEFAULT NULL,
  `user_age` int(11) DEFAULT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `is_member` enum('Yes','No') DEFAULT 'No',
  `zip_code` varchar(20) NOT NULL,
  `last_logout_time` datetime DEFAULT NULL,
  `about_me` text NOT NULL,
  `allow_user_to_contact` enum('0','1') NOT NULL DEFAULT '1',
  `allow_user_to_follow` enum('0','1') NOT NULL DEFAULT '1',
  `dispute_raise` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `fk_pipl_user_country` (`user_county`),
  KEY `fk_pipl_user_city` (`user_city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=236 ;

--
-- Dumping data for table `pipl_mst_users`
--

INSERT INTO `pipl_mst_users` (`user_id`, `user_name`, `user_email`, `user_password`, `profile_picture`, `gender`, `user_type`, `user_status`, `activation_code`, `reset_password_code`, `email_verified`, `last_login`, `fb_id`, `tw_id`, `register_date`, `role_id`, `send_email_notification`, `ip_address`, `user_county`, `user_city`, `user_birth_date`, `user_age`, `first_name`, `last_name`, `is_member`, `zip_code`, `last_logout_time`, `about_me`, `allow_user_to_contact`, `allow_user_to_follow`, `dispute_raise`) VALUES
(1, 'admin', 'sofia@panaceatek.com', 'YWRtaW4=', '731717764.jpg', '1', '2', '1', '1419327925', '', '1', NULL, NULL, NULL, '0000-00-00 00:00:00', 1, '1', '', NULL, NULL, NULL, NULL, 'Sofiaw', 'Singhw', 'No', '', NULL, '', '1', '1', '0'),
(217, 'emmaa', 'emma@panaceatek.com', 'UGFzc0AxMjM=', '731717764.jpg', '1', '1', '1', '1418721519', '', '1', NULL, NULL, NULL, '2014-12-16 09:18:39', 1, '1', '', NULL, NULL, NULL, NULL, 'emmaa', 'piplp', 'No', '', NULL, '', '1', '1', '0'),
(219, 'harry', 'harry@panaceatek.com', 'UGFzc0AxMjM=', '731717764.jpg', '1', '1', '1', '1418719908', '', '1', NULL, NULL, NULL, '2014-12-16 08:51:48', 1, '1', '', 0, NULL, '0', NULL, 'harry', 'pipl', 'No', '', NULL, '', '1', '1', '0'),
(226, 'hancy', 'hancy@panaceatek.com', 'UGFzc0AxMjM=', NULL, '1', '2', '2', '1419325936', '', '1', NULL, NULL, NULL, '2014-12-23 09:12:16', 23, '1', '', NULL, NULL, NULL, NULL, 'hancy', 'pipl', 'No', '', NULL, '', '1', '1', '0'),
(227, 'joy1232', 'joy@panaceatek.com', 'VHVzaGFyQDEyMw==', '1756794662.jpg', '2', '1', '2', '1419328886', '', '1', NULL, NULL, NULL, '2014-12-23 09:46:20', 1, '1', '192.168.2.170', NULL, NULL, NULL, NULL, 'asdf', 'jkl', 'No', '', NULL, '', '1', '1', '0'),
(230, 'Anujw', 'anuj@panaceatek.com', 'MTIzQFBhc3M=', NULL, '1', '2', '', '1427807729', '', '', NULL, NULL, NULL, '2015-03-31 14:15:29', 36, '1', '', NULL, NULL, NULL, NULL, 'tyagi', 'anujaj', 'No', '', NULL, '', '1', '1', '0'),
(231, 'dssadsasad', 'anujs@panaceatek.com', 'MTIzQFBhc3M=', NULL, '1', '2', '', '1427807816', '', '', NULL, NULL, NULL, '2015-03-31 14:16:56', 36, '1', '', NULL, NULL, NULL, NULL, 'sdadssad', 'dsadsadsadsa', 'No', '', NULL, '', '1', '1', '0'),
(232, 'dasdadsadssdasad', 'adsdsnuj@panaceatek.com', 'MTIzQFBhc3M=', NULL, '1', '2', '', '1427807960', '', '', NULL, NULL, NULL, '2015-03-31 14:19:20', 37, '1', '', NULL, NULL, NULL, NULL, 'dasasddasas', 'dsadssdadsa', 'No', '', NULL, '', '1', '1', '0'),
(233, 'ggfdg', 'dgdf@eefsd.vnnvb', 'UGFzc0AxMjM=', NULL, '1', '2', '', '1427869286', '', '', NULL, NULL, NULL, '2015-04-01 07:21:26', 36, '1', '', NULL, NULL, NULL, NULL, 'dfgfd', 'fdgf', 'No', '', NULL, '', '1', '1', '0'),
(234, 'testAdmin', 'anuj22@panaceatek.com', 'MTIzQFBhc3M=', NULL, '1', '2', '', '1427879777', '', '', NULL, NULL, NULL, '2015-04-01 10:16:17', 23, '1', '', NULL, NULL, NULL, NULL, 'anuj', 'atyagu', 'No', '', NULL, '', '1', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_advertise_category`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_advertise_category` (
  `advertise_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertise_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`advertise_category_id`),
  KEY `advertise_id` (`advertise_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=158 ;

--
-- Dumping data for table `pipl_trans_advertise_category`
--

INSERT INTO `pipl_trans_advertise_category` (`advertise_category_id`, `advertise_id`, `category_id`) VALUES
(1, 2, 1),
(6, 3, 1),
(7, 3, 3),
(8, 3, 4),
(12, 5, 1),
(13, 5, 3),
(14, 5, 4),
(43, 4, 1),
(51, 6, 1),
(54, 7, 1),
(55, 7, 3),
(56, 9, 3),
(57, 10, 4),
(58, 10, 5),
(59, 11, 4),
(66, 13, 1),
(67, 14, 1),
(68, 14, 3),
(93, 15, 1),
(94, 15, 3),
(118, 18, 1),
(119, 17, 7),
(124, 19, 3),
(129, 20, 3),
(131, 21, 3),
(132, 22, 3),
(139, 23, 3),
(142, 16, 3),
(143, 16, 4),
(144, 24, 4),
(145, 25, 1),
(146, 25, 3),
(152, 26, 1),
(157, 27, 14);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_advertise_counter`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_advertise_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advertise_id` int(11) NOT NULL,
  `type` enum('C','I') NOT NULL,
  `remote_address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `advertise_d` (`advertise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_advertise_page_position`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_advertise_page_position` (
  `page_position_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertise_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`page_position_id`),
  KEY `advertise_id` (`advertise_id`),
  KEY `page_id` (`page_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `pipl_trans_advertise_page_position`
--

INSERT INTO `pipl_trans_advertise_page_position` (`page_position_id`, `advertise_id`, `page_id`, `position_id`) VALUES
(2, 3, 1, 1),
(3, 1, 1, 2),
(5, 5, 1, 1),
(33, 4, 1, 2),
(39, 6, 1, 1),
(41, 7, 1, 2),
(42, 9, 1, 1),
(43, 10, 1, 2),
(44, 11, 1, 1),
(45, 12, 1, 1),
(50, 13, 1, 1),
(51, 14, 1, 1),
(64, 15, 1, 1),
(78, 18, 1, 1),
(79, 17, 1, 1),
(84, 19, 1, 1),
(89, 20, 1, 2),
(91, 21, 1, 1),
(92, 22, 1, 1),
(99, 23, 1, 1),
(101, 16, 1, 1),
(102, 24, 1, 1),
(103, 25, 1, 2),
(109, 26, 1, 1),
(114, 27, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_blog_categories_lang_map`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_blog_categories_lang_map` (
  `rec_id` int(11) unsigned NOT NULL DEFAULT '0',
  `lang_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_keyword_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_blog_comments`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_blog_comments` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `commented_by` varchar(255) NOT NULL,
  `commented_user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_on` datetime NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '"0"=>Unpublished, "1"=>"Published","2"=>Flag By Admin',
  PRIMARY KEY (`comment_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_category_details`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_category_details` (
  `category_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL COMMENT '"created_by" will be the referece of mst_user table',
  `lang_id` int(11) NOT NULL,
  `category_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`category_detail_id`),
  KEY `created_by` (`created_by`),
  KEY `category_id_fk` (`category_id_fk`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pipl_trans_category_details`
--

INSERT INTO `pipl_trans_category_details` (`category_detail_id`, `category_name`, `category_description`, `created_date`, `created_by`, `lang_id`, `category_id_fk`) VALUES
(2, 'testchinese', 'testchinesetestchinesetestchinese', '2015-04-02 07:47:43', 1, 12, 1),
(4, 'testtestchines_update', 'testtestchinestesttestchinestesttestchinestesttestchines_update', '2015-04-02 08:04:08', 1, 12, 2),
(5, 'Test', '测试 测试 電	电	電	 测试 测试 電	电	電	 测试 测试 電	电	電	 测试 测试 電	电	電	测试 测试 電	电	電	 测试 测试 電	电', '2015-04-03 08:34:35', 1, 17, 3),
(6, 'test12454', 'hhjgb fsjdhfjkd nj#$%$^%&^*( hhkjhkjh%^%&^*(#$% GHGJHKJ', '2015-04-03 08:35:59', 1, 12, 3),
(8, 'aa', 'aaaa aaa', '2015-04-03 08:39:10', 1, 12, 4),
(9, 'wswdsde', 'dasdd', '2015-04-03 11:02:57', 1, 17, 5),
(10, 'asdfc', 'dszff', '2015-04-03 11:03:07', 1, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_cities_lang`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_cities_lang` (
  `city_id_lang` int(11) NOT NULL AUTO_INCREMENT,
  `city_id_fk` int(11) NOT NULL,
  `city_name` varchar(150) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`city_id_lang`),
  KEY `city_id_fk` (`city_id_fk`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This is the city table. ' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pipl_trans_cities_lang`
--

INSERT INTO `pipl_trans_cities_lang` (`city_id_lang`, `city_id_fk`, `city_name`, `lang_id`) VALUES
(1, 1, 'Pune', 17),
(2, 2, 'Mumbai', 17);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_cms`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_cms` (
  `cms_val_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_seo_title_lang` varchar(500) NOT NULL,
  `page_meta_keyword` varchar(500) NOT NULL,
  `page_meta_description` varchar(500) NOT NULL,
  `lang_id` int(11) NOT NULL,
  PRIMARY KEY (`cms_val_id`),
  KEY `cms_id` (`cms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pipl_trans_cms`
--

INSERT INTO `pipl_trans_cms` (`cms_val_id`, `cms_id`, `page_title`, `page_content`, `page_seo_title_lang`, `page_meta_keyword`, `page_meta_description`, `lang_id`) VALUES
(1, 1, 'About Us', 'About UsAbout UsAbout UsAbout UsAbout UsAbout UsAbout Us About UsAbout UsAbout UsAbout UsAbout UsAbout Us', 'About Us', 'About UsAbout UsAbout UsAbout UsAbout UsAbout UsAbout UsAbout Us', 'About UsAbout UsAbout Us', 17),
(2, 1, 'About Us', 'About UsAbout UsAbout UsAbout UsAbout UsAbout UsAbout Us About UsAbout UsAbout UsAbout UsAbout UsAbout Us', 'About Us', 'About UsAbout UsAbout UsAbout UsAbout UsAbout UsAbout UsAbout Us', 'About UsAbout UsAbout Us', 12),
(3, 2, 'Terms Servies', '<p>Terms ServiesTerms Servies Terms ServiesTerms ServiesTerms ServiesTerms ServiesTerms ServiesTerms Servies</p>\r\n\r\n<table border=\\"1\\" cellpadding=\\"1\\" cellspacing=\\"1\\" style=\\"width:500px\\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\\"\\" src=\\"http://192.168.2.128/panacea_code_library_new/media/backend/userfiles/1427870125.jpg\\" style=\\"height:194px; width:259px\\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Terms Servies', 'Terms ServiesTerms ServiesTerms Servies', 'Terms ServiesTerms ServiesTerms Servies', 12),
(4, 2, 'Terms Servies', '<p>Terms ServiesTerms Servies Terms ServiesTerms ServiesTerms ServiesTerms ServiesTerms ServiesTerms Servies</p>\r\n\r\n<table border=\\"1\\" cellpadding=\\"1\\" cellspacing=\\"1\\" style=\\"width:500px\\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\\"\\" src=\\"http://192.168.2.128/panacea_code_library_new/media/backend/userfiles/1427870125.jpg\\" style=\\"height:194px; width:259px\\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Terms Servies', 'Terms ServiesTerms ServiesTerms Servies', 'Terms ServiesTerms ServiesTerms Servies', 17),
(5, 3, 'Privacy_test', '<p>test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\\"\\" src=\\"data:image/jpeg;base64,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\\" /></p>\r\n', 'Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Englishcms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsdkjsa cms_contentkasdaskjd asjdjkasjdksa djkasdjkajtest', 'Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Englishcms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsdkjsa cms_contentkasdaskjd asjdjkasjdksa djkasdjkajtest', 'Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Privacy Englishcms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsdkjsa cms_contentkasdaskjd asjdjkasjdksa testdjkasdjkajkdjkkjdsdkjsacms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsdkjsacms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsdkjsacms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsdkjsacms_contentkasdaskjd asjdjkasjdksa djkasdjkajkdjkkjdsd', 17),
(13, 3, '馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng', '<p>馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng&nbsp;馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng rn馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng 馬哈拉施特拉邦 Mǎ hā lā shī t&egrave; lā bāng</p>\\r\\n\\r\\n<p>rnrn</p>\\r\\n\\r\\n<p>rn</p>\\r\\n\\r\\n<p>rn</p>\\r\\n', '馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāngrn馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāngrn馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng', '馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng rn馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng 馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng', '馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng 馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāngrn馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng 馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāngrn馬哈拉施特拉邦 Mǎ hā lā shī tè lā bāng', 12);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_contact_feedback_reply`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_contact_feedback_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `message_to` varchar(100) NOT NULL,
  `message_from_name` varchar(100) NOT NULL,
  `message_from_email` varchar(100) NOT NULL,
  `message_subject` varchar(500) NOT NULL,
  `message_body` text NOT NULL,
  `reply_date` date NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_country_lang`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_country_lang` (
  `country_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(110) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`country_lang_id`),
  KEY `country_id_fk` (`country_id_fk`),
  KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pipl_trans_country_lang`
--

INSERT INTO `pipl_trans_country_lang` (`country_lang_id`, `country_name`, `country_id_fk`, `lang_id`, `status`) VALUES
(1, 'India', 1, 17, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_global_settings`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_global_settings` (
  `global_val_id` int(11) NOT NULL AUTO_INCREMENT,
  `global_name_id` int(11) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`global_val_id`),
  KEY `language_fk_genral` (`lang_id`),
  KEY `global_id` (`global_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `pipl_trans_global_settings`
--

INSERT INTO `pipl_trans_global_settings` (`global_val_id`, `global_name_id`, `value`, `lang_id`) VALUES
(1, 1, 'sofia31@panaceatek.com', 17),
(2, 2, 'Revision2123', 17),
(6, 3, 'sofia@panaceatek.com', 17),
(8, 4, 'Y/m/d', 17),
(14, 7, '10', 17),
(15, 8, 'http://www.facebook.com/', 17),
(16, 9, 'http://twitter.com/', 17),
(18, 11, 'http://plus.google.com/', 17),
(20, 13, '02064656565', 17),
(21, 14, '747764141969929', 17),
(22, 15, 'http://www.pinterest.com', 17),
(23, 16, '412301', 17),
(24, 17, 'Queen Square56 College Green RoadBS1 XR18Bristol, UK ', 17),
(25, 18, 'street', 17),
(26, 19, 'pune', 17),
(27, 20, 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry''s Standard Dummy Text Ever Since The 1500s', 17),
(28, 1, 'sofia111@panaceatek.com', 12),
(29, 2, '調整 調整 調整 調整', 12),
(30, 4, 'Y-m-d H:i:s', 12),
(31, 7, '1', 12),
(32, 8, 'http://調整.in', 12),
(33, 20, '調整 調整 調整 調整 調整 調整 調整 調整 調整 調整 調整', 12),
(34, 17, '調整調整調整調整調整 調整 調整調整調整調整調整調整調整調整', 12),
(35, 19, '調整 調整 調整 調整 調整 調整 調整 調整 調整', 12),
(36, 18, '調整 調整 調整 調整 調整 調整 調整 調整 調整', 12);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_newsletter_send`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_newsletter_send` (
  `send_newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(265) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `newsletter_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`send_newsletter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `pipl_trans_newsletter_send`
--

INSERT INTO `pipl_trans_newsletter_send` (`send_newsletter_id`, `user_email`, `user_id`, `newsletter_id`, `date_created`) VALUES
(1, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(2, 'joy@panaceatek.com', 220, 2, '2014-12-23'),
(3, 'hancy@panaceatek.com', 223, 2, '2014-12-23'),
(4, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(5, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(6, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(7, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(8, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(9, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(10, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(11, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(12, 'hancy@panaceatek.com', 223, 3, '2014-12-23'),
(13, 'hancy@panaceatek.com', 223, 2, '2014-12-23'),
(14, 'sofia@panaceatek.com', 1, 2, '2015-03-24'),
(15, 'emma@panaceatek.com', 217, 2, '2015-03-24'),
(16, 'harry@panaceatek.com', 219, 2, '2015-03-24'),
(17, 'hancy@panaceatek.com', 226, 2, '2015-03-24'),
(18, 'joy@panaceatek.com', 227, 2, '2015-03-24'),
(19, 'sofia@panaceatek.com', 1, 2, '2015-03-30'),
(20, 'emma@panaceatek.com', 217, 2, '2015-03-30'),
(21, 'harry@panaceatek.com', 219, 2, '2015-03-30'),
(22, 'hancy@panaceatek.com', 226, 2, '2015-03-30'),
(23, 'joy@panaceatek.com', 227, 2, '2015-03-30'),
(24, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(25, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(26, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(27, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(28, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(29, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(30, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(31, 'anuj@panaceatek.com', 230, 4, '2015-04-01'),
(32, 'sofia@panaceatek.com', 1, 4, '2015-04-01'),
(33, 'emma@panaceatek.com', 217, 4, '2015-04-01'),
(34, 'harry@panaceatek.com', 219, 4, '2015-04-01'),
(35, 'sofia@panaceatek.com', 1, 4, '2015-04-01'),
(36, 'hancy@panaceatek.com', 226, 4, '2015-04-01'),
(37, 'emma@panaceatek.com', 217, 4, '2015-04-01'),
(38, 'harry@panaceatek.com', 219, 4, '2015-04-01'),
(39, 'joy@panaceatek.com', 227, 4, '2015-04-01'),
(40, 'hancy@panaceatek.com', 226, 4, '2015-04-01'),
(41, 'joy@panaceatek.com', 227, 4, '2015-04-01'),
(42, 'sofia@panaceatek.com', 1, 4, '2015-04-01'),
(43, 'emma@panaceatek.com', 217, 4, '2015-04-01'),
(44, 'hancy@panaceatek.com', 226, 1, '2015-04-01'),
(45, 'hancy@panaceatek.com', 226, 5, '2015-04-02'),
(46, 'sofia@panaceatek.com', 1, 6, '2015-04-03'),
(47, 'emma@panaceatek.com', 217, 6, '2015-04-03'),
(48, 'harry@panaceatek.com', 219, 6, '2015-04-03'),
(49, 'sofia@panaceatek.com', 1, 6, '2015-04-03'),
(50, 'emma@panaceatek.com', 217, 6, '2015-04-03'),
(51, 'harry@panaceatek.com', 219, 6, '2015-04-03'),
(52, 'sofia@panaceatek.com', 1, 6, '2015-04-03'),
(53, 'emma@panaceatek.com', 217, 6, '2015-04-03'),
(54, 'harry@panaceatek.com', 219, 6, '2015-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_newsletter_subscription`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_newsletter_subscription` (
  `newsletter_subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) DEFAULT NULL,
  `subscribe_status` enum('Inactive','Active') NOT NULL DEFAULT 'Active' COMMENT '0=>Inactive,1=>Active',
  `user_subscription_code` varchar(50) NOT NULL,
  `is_subscribe_for_daily` enum('1','0') NOT NULL,
  PRIMARY KEY (`newsletter_subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_role_privileges`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_role_privileges` (
  `role_privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`role_privilege_id`),
  KEY `fk_Role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=412 ;

--
-- Dumping data for table `pipl_trans_role_privileges`
--

INSERT INTO `pipl_trans_role_privileges` (`role_privilege_id`, `role_id`, `privilege_id`) VALUES
(293, 25, 1),
(294, 25, 2),
(295, 25, 3),
(322, 24, 1),
(323, 24, 3),
(324, 24, 4),
(325, 24, 5),
(326, 24, 6),
(327, 24, 7),
(333, 24, 3),
(334, 24, 4),
(335, 24, 5),
(336, 25, 1),
(337, 25, 3),
(338, 24, 1),
(339, 24, 3),
(340, 24, 4),
(351, 30, 1),
(352, 30, 3),
(358, 32, 7),
(359, 32, 8),
(360, 33, 8),
(361, 34, 8),
(362, 35, 8),
(384, 31, 1),
(385, 31, 3),
(391, 37, 7),
(392, 37, 8),
(393, 38, 8),
(394, 23, 1),
(395, 23, 3),
(396, 23, 7),
(397, 39, 4),
(398, 39, 5),
(399, 40, 1),
(400, 40, 3),
(401, 41, 1),
(402, 41, 3),
(403, 42, 7),
(404, 42, 8),
(405, 36, 1),
(406, 36, 3),
(407, 36, 4),
(408, 36, 5),
(409, 36, 6),
(410, 36, 7),
(411, 36, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_slider_banner_effects`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_slider_banner_effects` (
  `slider_banner_effects_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_banner_effects_name` varchar(100) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`slider_banner_effects_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This is the table for holding the effects list that can be a' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pipl_trans_slider_banner_effects`
--

INSERT INTO `pipl_trans_slider_banner_effects` (`slider_banner_effects_id`, `slider_banner_effects_name`, `order_id`) VALUES
(1, 'Fade', 1),
(2, 'Slide', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_slider_banner_objects`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_slider_banner_objects` (
  `banner_object_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_object_title` varchar(100) DEFAULT NULL,
  `banner_object_url` varchar(100) DEFAULT NULL,
  `open_url_in_new_page` enum('Yes','No') DEFAULT NULL,
  `banner_object_start_date` datetime DEFAULT NULL,
  `banner_object_end_date` datetime DEFAULT NULL,
  `banner_object_alt_text` varchar(100) DEFAULT NULL,
  `banner_object_rel_value` varchar(45) DEFAULT NULL,
  `banner_object_description_text` text,
  `enable_border` enum('Yes','No') DEFAULT NULL,
  `banner_object_status` enum('Active','Inactive') DEFAULT 'Inactive',
  `banner_object_click_count` varchar(50) DEFAULT '0',
  `banner_object_size` enum('Full','Half') DEFAULT NULL,
  `banner_object_type` enum('Image','Video','Image_video') DEFAULT NULL,
  `banner_object_image` varchar(100) DEFAULT NULL,
  `banner_object_video` varchar(100) DEFAULT NULL,
  `slider_id_fk` int(11) DEFAULT NULL,
  `video_type` enum('Upload','Youtube') DEFAULT NULL,
  `youtube_path` varchar(45) DEFAULT NULL,
  `sorting_order` int(11) NOT NULL,
  PRIMARY KEY (`banner_object_id`),
  KEY `fk_p795_trans_slider_banners_1` (`slider_id_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This will contain the images or video files that will slider' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pipl_trans_slider_banner_objects`
--

INSERT INTO `pipl_trans_slider_banner_objects` (`banner_object_id`, `banner_object_title`, `banner_object_url`, `open_url_in_new_page`, `banner_object_start_date`, `banner_object_end_date`, `banner_object_alt_text`, `banner_object_rel_value`, `banner_object_description_text`, `enable_border`, `banner_object_status`, `banner_object_click_count`, `banner_object_size`, `banner_object_type`, `banner_object_image`, `banner_object_video`, `slider_id_fk`, `video_type`, `youtube_path`, `sorting_order`) VALUES
(11, 'Slider two', '', 'Yes', '2014-12-23 00:00:00', '2014-12-31 00:00:00', '', '', '', '', 'Active', '', '', 'Image', '562882869.jpg', '', 1, 'Upload', '', 0),
(15, 'chck1', 'http://google.co', 'Yes', '2015-04-22 00:00:00', '2015-04-24 00:00:00', '', '', 'sdsdsaddaadsdsadsasda', '', 'Inactive', '', '', 'Image', '8264.jpg', NULL, 1, 'Upload', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_slider_widths_heights`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_slider_widths_heights` (
  `slider_widths_heights_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_width` varchar(45) DEFAULT NULL,
  `slider_height` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`slider_widths_heights_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pipl_trans_slider_widths_heights`
--

INSERT INTO `pipl_trans_slider_widths_heights` (`slider_widths_heights_id`, `slider_width`, `slider_height`) VALUES
(1, '1920', '1080'),
(2, '1000', '300'),
(3, '580', '350');

-- --------------------------------------------------------

--
-- Table structure for table `pipl_trans_states_lang`
--

CREATE TABLE IF NOT EXISTS `pipl_trans_states_lang` (
  `state_lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id_fk` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `lang_id` int(11) NOT NULL,
  PRIMARY KEY (`state_lang_id`),
  KEY `state_id_fk` (`state_id_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pipl_trans_states_lang`
--

INSERT INTO `pipl_trans_states_lang` (`state_lang_id`, `state_id_fk`, `state_name`, `lang_id`) VALUES
(1, 6, 'Maharashtra', 17),
(2, 7, 'UP', 17);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pipl_mst_advertises`
--
ALTER TABLE `pipl_mst_advertises`
  ADD CONSTRAINT `pipl_mst_advertises_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `pipl_mst_languages` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pipl_mst_states`
--
ALTER TABLE `pipl_mst_states`
  ADD CONSTRAINT `pipl_mst_states_ibfk_1` FOREIGN KEY (`country`) REFERENCES `pipl_mst_countries` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pipl_trans_blog_comments`
--
ALTER TABLE `pipl_trans_blog_comments`
  ADD CONSTRAINT `pipl_trans_blog_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pipl_mst_blog_posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pipl_trans_cities_lang`
--
ALTER TABLE `pipl_trans_cities_lang`
  ADD CONSTRAINT `pipl_trans_cities_lang_ibfk_1` FOREIGN KEY (`city_id_fk`) REFERENCES `pipl_mst_cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pipl_trans_country_lang`
--
ALTER TABLE `pipl_trans_country_lang`
  ADD CONSTRAINT `pipl_trans_country_lang_ibfk_2` FOREIGN KEY (`country_id_fk`) REFERENCES `pipl_mst_countries` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pipl_trans_country_lang_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `pipl_mst_languages` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pipl_trans_states_lang`
--
ALTER TABLE `pipl_trans_states_lang`
  ADD CONSTRAINT `pipl_trans_states_lang_ibfk_1` FOREIGN KEY (`state_id_fk`) REFERENCES `pipl_mst_states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
