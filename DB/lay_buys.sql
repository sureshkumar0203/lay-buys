-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 02:36 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lay_buys`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner_photo` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_photo`, `created_date`, `updated_date`) VALUES
(1, 'B_1007181531200383.jpg', '2018-07-10', '2018-07-10'),
(2, 'B_1007181531200388.jpg', '2018-07-10', '2018-07-10'),
(3, 'B_1007181531200392.jpg', '2018-07-10', '2018-07-10'),
(4, 'B_1007181531200396.jpg', '2018-07-10', '2018-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `category_photo` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `category_name`, `category_slug`, `category_icon`, `category_photo`, `created_date`, `updated_date`) VALUES
(1, 'TVs', 'tvs', 'CI_1007181531222463.png', 'C_1007181531222463.png', '2018-07-10', '2018-07-10'),
(2, 'Furniture', 'furniture', 'CI_1007181531223215.png', 'C_1007181531223215.png', '2018-07-10', '2018-07-10'),
(3, 'Mobile Phones', 'mobile-phones', 'CI_1007181531223259.png', 'C_1007181531223259.png', '2018-07-10', '2018-07-10'),
(4, 'Kitchen Appliances', 'kitchen-appliances', 'CI_1007181531223293.png', 'C_1007181531223293.png', '2018-07-10', '2018-07-10'),
(5, 'Kitchen Gadgets', 'kitchen-gadgets', 'CI_1007181531223327.png', 'C_1007181531223327.png', '2018-07-10', '2018-07-10'),
(6, 'Tools', 'tools', 'CI_1007181531223358.png', 'C_1007181531223358.png', '2018-07-10', '2018-07-10'),
(7, 'Homeware', 'homeware', 'CI_1007181531223413.png', 'N_1007181531225563.png', '2018-07-10', '2018-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `meta_title` longtext NOT NULL,
  `meta_descr` longtext NOT NULL,
  `meta_keyword` longtext NOT NULL,
  `created_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page_title`, `slug`, `content`, `meta_title`, `meta_descr`, `meta_keyword`, `created_date`) VALUES
(1, 'About Us', 'about-us', '<p>There are <strong>many </strong>variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</p>\r\n\r\n<p>There are&nbsp;<strong>many&nbsp;</strong>variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated&nbsp;Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</p>', 'About Us', 'About Us', 'About Us', '2015-11-27'),
(2, 'Terms and Conditions', 'terms-and-conditions', '<p>There are&nbsp;<strong>many&nbsp;</strong>variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</p>', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', '2018-07-10'),
(3, 'Privacy Policy', 'privacy-policy', '<p>There are&nbsp;<strong>many&nbsp;</strong>variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</p>\r\n\r\n<p>There are&nbsp;<strong>many&nbsp;</strong>variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc</p>', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '2018-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(120) NOT NULL,
  `email` varchar(80) NOT NULL,
  `alt_email` varchar(80) NOT NULL,
  `contact_no` varchar(55) NOT NULL,
  `fax_no` varchar(55) DEFAULT NULL,
  `mobile_no` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `active_status` int(11) NOT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `googleplus_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`id`, `admin_name`, `email`, `alt_email`, `contact_no`, `fax_no`, `mobile_no`, `address`, `password`, `active_status`, `facebook_url`, `twitter_url`, `googleplus_url`, `linkedin_url`, `youtube_url`, `instagram_url`, `pinterest_url`, `site_url`) VALUES
(1, 'Lay Buys', 'suresh@bletindia.com', 'info@bletechnolabs.com', '0161 654 7220', '0', '07760 351357', 'Pandora Business Park, \r\nGreengate, \r\nMiddleton, \r\nManchester, \r\nM24 1RU', 'UkdWdGIwQXhNak0wTlRZPQ==', 1, 'https://facebook.com', 'https://twitter.com/', '', NULL, NULL, NULL, '', 'http://192.168.0.170/lay-buys/');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contents` text CHARACTER SET utf8 NOT NULL,
  `created_date` date NOT NULL,
  `updated_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `title`, `contents`, `created_date`, `updated_on`) VALUES
(1, 'Forgot password mail :: Admin', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n			<td style=\"text-align:center; background:#1C81BD;\">\r\n			<img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n			</td>\r\n		</tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:20px;\"><br/>\r\n                    Your Login credential details as follows.\r\n                </strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %ADMINEMAIL% <br>\r\n                <strong>Password: </strong> %ADMINPASSWORD% <br>\r\n                <br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%FROMEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n   <tr>\r\n\r\n      <td style=\"background:#1C81BD;\">\r\n\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n\r\n      </td>\r\n\r\n  </tr>\r\n  </table>\r\n</body>', '2018-07-02', '2018-07-02'),
(2, 'Contact Us :: Email Template', '<table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center; background:#1C81BD;\">\r\n			<img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n			</td>\r\n		</tr>\r\n\r\n		<tr>\r\n			<td>\r\n			<div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">Dear <strong>%ADMINNAME%</strong> ,<br />\r\n\r\n			&nbsp;\r\n\r\n			<div style=\"padding-left:30px; line-height:20px;\"><strong>Enquiry details as follows</strong><br />\r\n			<br />\r\n			<strong>Name :</strong> %NAME%<br />\r\n            <strong>Email :</strong> %EMAIL%<br />\r\n           \r\n            \r\n            <br /><strong>Message :</strong><br />\r\n            \r\n             %MESSAGE%\r\n            \r\n			\r\n			<br /><br />\r\n			&nbsp;\r\n            </div>\r\n\r\n			Thanks<br />\r\n\r\n			<strong>%ADMINNAME%</strong><br />\r\n			<strong>%ADMINEMAIL%</strong>\r\n            </div>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n\r\n			<td style=\"background:#1C81BD;\">\r\n\r\n			<div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2018-07-10', '2018-07-10'),
(3, 'Registration Mail :: User', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n  <tr>\r\n    <td style=\"text-align:center; background:#1C81BD;\">\r\n    	<img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n    </td>\r\n  </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:20px;\"><br/>\r\n                    You have registered successfully.Your login credential as follows.\r\n                </strong><br/><br/>\r\n                \r\n                Email ID : %USEREMAIL%<br/>\r\n                Password : %USERPASSWORD%<br/>\r\n                <br/>\r\n                \r\n                <a href=\"%CONFIRMURL%\">Click here to confirm your email address.</a>\r\n                <br/><br/>\r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n\r\n      <td style=\"background:#1C81BD;\">\r\n\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n\r\n      </td>\r\n\r\n  </tr>\r\n\r\n  </table>\r\n</body>', '2018-07-12', '2018-07-12'),
(4, 'Forgot Password Mail :: User', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:20px;\"><br/>\r\n                    Your Login credential details as follows.\r\n                </strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %USEREMAIL% <br>\r\n                <strong>Password: </strong> %USERPASSWORD% <br>\r\n                <br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n   <tr>\r\n\r\n      <td style=\"background:#1C81BD;\">\r\n\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n\r\n      </td>\r\n\r\n  </tr>\r\n  </table>\r\n</body>', '2018-07-16', '2018-07-16'),
(5, 'Order Despatched Email Template', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:200px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:18px;\"><br/>\r\n                    Today we have despatched your order number %ORDERNUMBER%. <br/>\r\n                    Within 2-3 working days you will get your order.\r\n                </strong><br/><br/>\r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td style=\"background:#1C81BD;\">\r\n        <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n        </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2018-07-24', '2018-07-24'),
(6, 'New Order Placed By an user :: Admin', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:16px;\"><br/>\r\n                    A new order recently placed by %USERNAME%.<br/>\r\n                    ORDER ID : %ORDERID% <br/><br/>\r\n                    Pleach check the admin panel to get the order details.\r\n                </strong><br/><br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%USERNAME%</strong><br/>\r\n              <strong>%USEREMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"background:#1C81BD;\">\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n      </td>\r\n  </tr>\r\n  </table>\r\n</body>', '2018-08-28', '2018-08-28'),
(7, 'New installment paid by an user :: Admin', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:16px;\"><br/>\r\n                    A new installment recently placed by %USERNAME%.<br/>\r\n                    ORDER ID : %ORDERID% <br/><br/>\r\n                    Pleach check the admin panel to get the order details.\r\n                </strong><br/><br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%USERNAME%</strong><br/>\r\n              <strong>%USEREMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"background:#1C81BD;\">\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n      </td>\r\n  </tr>\r\n  </table>\r\n</body>', '2018-08-29', '2018-08-29'),
(8, 'Order cancel by the user :: Admin', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:16px;\"><br/>\r\n                    %USERNAME% recently cancel the order.<br/>\r\n                    ORDER ID : %ORDERID% <br/><br/>\r\n                    Pleach check the admin panel to get the order details.\r\n                </strong><br/><br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%USERNAME%</strong><br/>\r\n              <strong>%USEREMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"background:#1C81BD;\">\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n      </td>\r\n  </tr>\r\n  </table>\r\n</body>', '2018-08-30', '2018-08-30'),
(9, 'Money Returned to your account :: User', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.bletechnolabs.com/projects/lay-buys/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:16px;\"><br/>\r\n                    We recently returned your money to your account against your \r\n                    ORDER ID : %ORDERID% <br/>\r\n                    Pleach check the account & login panel to get the details.\r\n                </strong><br/><br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"background:#1C81BD;\">\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n      </td>\r\n  </tr>\r\n  </table>\r\n</body>', '2018-08-30', '2018-08-30'),
(10, 'Order Placed By an user :: User', '<body>\r\n  <table cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #1C81BD;margin:35px 25px; width:90%;\">\r\n    <tr>\r\n        <td style=\"text-align:center; background:#1C81BD;\">\r\n        <img src=\"https://www.laybuys.co.uk/public/images/logo.png\"/> \r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:16px;\"><br/>\r\n                    Thank you for your order.<br/>\r\n                    ORDER ID : %ORDERID% <br/><br/>\r\n                    Pleach check your login panel to get the order details.\r\n                </strong><br/><br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"background:#1C81BD;\">\r\n      <div style=\"padding:15px; text-align:center; font-size:12px; color:#FFF;\">All rights &copy; Lay Buys.  %CURRENTYEAR%</div>\r\n      </td>\r\n  </tr>\r\n  </table>\r\n</body>', '2018-10-26', '2018-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `master_order`
--

CREATE TABLE `master_order` (
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `bill_full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bill_phone_number` varchar(55) NOT NULL,
  `bill_address1` varchar(255) NOT NULL,
  `bill_address2` varchar(255) DEFAULT NULL,
  `bill_town` varchar(255) DEFAULT NULL,
  `bill_city` varchar(255) DEFAULT NULL,
  `bill_post_code` varchar(15) NOT NULL,
  `bill_country` varchar(255) DEFAULT NULL,
  `bill_state` varchar(155) DEFAULT NULL,
  `ship_full_name` varchar(255) NOT NULL,
  `ship_phone_number` varchar(55) NOT NULL,
  `ship_address1` varchar(55) NOT NULL,
  `ship_address2` varchar(255) DEFAULT NULL,
  `ship_town` varchar(255) DEFAULT NULL,
  `ship_city` varchar(255) DEFAULT NULL,
  `ship_post_code` varchar(255) NOT NULL,
  `ship_country` varchar(255) DEFAULT NULL,
  `ship_state` varchar(25) DEFAULT NULL,
  `order_prd_id` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `dp_per` double DEFAULT NULL,
  `dp_amount` double DEFAULT NULL,
  `installment_period` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `installment_exp_dt` date NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `ship_date` date DEFAULT NULL,
  `cancel_status` int(11) NOT NULL DEFAULT '0' COMMENT '1 - Cancelled',
  `cancel_date` date DEFAULT NULL,
  `cancel_trans_id` varchar(255) DEFAULT NULL,
  `cancel_amount` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_order`
--

INSERT INTO `master_order` (`order_id`, `user_id`, `bill_full_name`, `email`, `bill_phone_number`, `bill_address1`, `bill_address2`, `bill_town`, `bill_city`, `bill_post_code`, `bill_country`, `bill_state`, `ship_full_name`, `ship_phone_number`, `ship_address1`, `ship_address2`, `ship_town`, `ship_city`, `ship_post_code`, `ship_country`, `ship_state`, `order_prd_id`, `total_amount`, `dp_per`, `dp_amount`, `installment_period`, `order_date`, `installment_exp_dt`, `transaction_id`, `payment_status`, `order_status`, `ship_date`, `cancel_status`, `cancel_date`, `cancel_trans_id`, `cancel_amount`) VALUES
(1, 1, 'Suresh', 'suresh@bletindia.com', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', NULL, 'Bhubaneswar', '751010', 'India', 'Odisha', 'Suresh', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', NULL, 'Bhubaneswar', '751010', 'India', 'Odisha', 12, 19990, 20, 3998, 2, '2018-07-20', '2018-08-03', 'TRNS45678', 'Paid', 'Not yet shipped', '0000-00-00', 1, '2018-08-30', NULL, 0),
(2, 3, 'Tridee Dakua', 'trideep@bletindia.com', '7205821247', 'Bhubaneswar Odisha', 'Patia Shree vihar', 'Bomikhal', 'Bhubaneswar', '751016', 'India', 'Odisha', 'Tridee Dakua', '7205821247', 'Bhubaneswar Odisha', 'Patia Shree vihar', NULL, 'Bhubaneswar', '751016', 'India', 'Odisha', 8, 80, 16, 12.8, 8, '2018-07-20', '2018-09-14', 'TRNS24324TEST2444', 'Paid', 'Not yet shipped', '2018-08-03', 0, NULL, NULL, 0),
(3, 1, 'Suresh', 'suresh@bletindia.com', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', NULL, 'Bhubaneswar', '751010', 'India', 'Odisha', 'Suresh', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', NULL, 'Bhubaneswar', '751010', 'India', 'Odisha', 8, 80, 16, 12.8, 2, '2018-07-23', '2018-08-06', 'TRNS567TEST', 'Paid', 'Not yet shipped', NULL, 0, '2018-08-08', '', 0),
(13, 1, 'Suresh', 'suresh@bletindia.com', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bomikhal', 'Bhubaneswar', '751010', '0', '0', 'Suresh', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bomikhal', 'Bhubaneswar', '751010', '0', '0', 5, 65, 18, 11.7, 2, '2018-11-06', '2018-11-20', NULL, 'Unpaid', 'Not yet shipped', NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `paypal_environment` varchar(255) NOT NULL,
  `paypal_email` varchar(255) NOT NULL,
  `processing_cost` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `paypal_environment`, `paypal_email`, `processing_cost`) VALUES
(1, 'sandbox', 'sureshkumar02_biz@gmail.com', 17.95);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prd_id` bigint(11) NOT NULL,
  `prd_cat_id` int(11) NOT NULL,
  `prd_sub_cat_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `prd_slug_name` varchar(255) NOT NULL,
  `product_model` varchar(155) NOT NULL,
  `product_price` double NOT NULL,
  `product_dp_per` double NOT NULL COMMENT 'dp-Down Payment',
  `product_details` longtext,
  `active_status` int(11) NOT NULL DEFAULT '0',
  `prd_meta_title` varchar(255) DEFAULT NULL,
  `prd_meta_keywords` longtext,
  `prd_meta_descriptions` longtext,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prd_id`, `prd_cat_id`, `prd_sub_cat_id`, `product_name`, `prd_slug_name`, `product_model`, `product_price`, `product_dp_per`, `product_details`, `active_status`, `prd_meta_title`, `prd_meta_keywords`, `prd_meta_descriptions`, `created_date`, `updated_date`) VALUES
(1, 5, 6, 'Pigeon Crest Diecast Cookware Kadhai 2.5 L', 'pigeon-crest-diecast-cookware-kadhai-25-l', '12730', 85, 15, '<p><strong>Lorem Ipsum</strong><span style=\"color:rgb(0, 0, 0); font-family:open sans,arial,sans-serif; font-size:14px\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 0, 'Pigeon Crest Diecast Cookware Kadhai 2.5 L', 'Pigeon Crest Diecast Cookware Kadhai 2.5 L', 'Pigeon Crest Diecast Cookware Kadhai 2.5 L', '2018-07-16', '2018-07-16'),
(2, 6, 7, 'Bosch All-in-One Metal 108 Piece Hand Tool Kit', 'bosch-all-in-one-metal-108-piece-hand-tool-kit', '2.607.002.790', 100, 20, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Here&rsquo;s your one-stop solution to all your home repair needs - the Bosch All-in-one metal hand toolkit. With 108 pieces all set in a sturdy case, this sturdy hand toolkit lets you fix almost all your repairs.</span></p>', 0, 'Bosch All-in-One Metal 108 Piece Hand Tool Kit', 'Bosch All-in-One Metal 108 Piece Hand Tool Kit', 'Bosch All-in-One Metal 108 Piece Hand Tool Kit', '2018-07-16', '2018-07-16'),
(3, 3, 8, 'Redmi Note 5 Pro (Black, 64 GB)', 'redmi-note-5-pro-black-64-gb', 'MZB6079IN / MZB6087IN', 70, 19, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Stunning visuals on a 15.2-cm (5.99) FHD+ display, a powerful 1.8 GHz Snapdragon 636 processor, and expandable memory of up to 128 GB - the Redmi Note 5 Pro has much to offer. The (12 MP + 5 MP) dual rear camera setup and a 20 MP front camera, coupled with features such as Beautify 4.0,&nbsp;let you take truly beautiful pictures and selfies.</span></p>', 0, 'Redmi Note 5 Pro (Black, 64 GB)', 'Redmi Note 5 Pro (Black, 64 GB)', 'Redmi Note 5 Pro (Black, 64 GB)', '2018-07-16', '2018-07-16'),
(4, 3, 9, 'Samsung Galaxy J6 (Blue, 32 GB)', 'samsung-galaxy-j6-blue-32-gb', 'SM-J600GZBGINS', 80, 25, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">The Samsung Galaxy J6 is here, with its virtually continuous Bezel-free Screen, to make work and entertainment seem even more appealing. And, while you revel in your favorite show, you can simultaneously chat with your loved ones without having to switch screens and disturb your viewing experience.</span></p>', 0, 'Samsung Galaxy J6 (Blue, 32 GB)', 'Samsung Galaxy J6 (Blue, 32 GB)', 'Samsung Galaxy J6 (Blue, 32 GB)', '2018-07-16', '2018-07-16'),
(5, 2, 11, 'PRIMROSE Eclipse Fabric 3 Seater Sofa', 'primrose-eclipse-fabric-3-seater-sofa', 'Eclipse3_Blue', 65, 18, '<p>A&nbsp;<span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">&nbsp;lot of care has gone into choosing the materials that go into making your sofa. And with continued care, they will share your address for many years. Please keep the following in mind to ensure a long life for your sofa: Avoid outdoor use and exposure to water or prolonged moisture. Avoid exposure to direct heat or sunlight as this can cause the sofa colour to fade. Vacuum your sofas periodically with a soft bristled brush attachment or lightly brush them to keep general dirt and dust off the sofa and prevent any embedding between the fibres. Getting your sofa professionally cleaned once every 6-8 months will not only take care of the nooks and corners that you can&#39;t reach, it will also make it more durable. Fibre-filled backs and armrests will flatten with regular use. However, they can be brought back to shape as easily as a normal pillow. Take care your sofa...</span></p>', 0, 'PRIMROSE Eclipse Fabric 3 Seater Sofa', 'PRIMROSE Eclipse Fabric 3 Seater Sofa', 'PRIMROSE Eclipse Fabric 3 Seater Sofa', '2018-07-16', '2018-07-16'),
(6, 1, 2, 'LG LH454A 60cm (24 inch) HD Ready LED TV', 'lg-lh454a-60cm-24-inch-hd-ready-led-tv', '24LH454A', 55, 25, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Do you want higher levels of colour, contrast and clarity on your TV, along with the best possible picture, quality and performance? If yes, then this TV is perfect for you. It comes with LG&rsquo;s Triple XD Engine, so you can experience your favourite action or superhero movies in better quality.</span></p>', 0, 'LG LH454A 60cm (24 inch) HD Ready LED TV', 'LG LH454A 60cm (24 inch) HD Ready LED TV', 'LG LH454A 60cm (24 inch) HD Ready LED TV', '2018-07-16', '2018-07-16'),
(7, 1, 3, 'Sony 80cm (32 inch) HD Ready LED Smart TV', 'sony-80cm-32-inch-hd-ready-led-smart-tv', 'KLV-32W622F', 60, 24, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Warranty Does Not Cover Any External Accessories (Such as Battery, Cable, Carrying Bag), Damage Caused to the Product Due to Improper Installation by Customer, Normal Wear and Tear to Magnetic Heads, Audio, Video, Laser Pick-ups and TV Picture Tubes, Panel, Damages Caused to the Product by Accident, Lightening, Ingress of Water, Fire, Dropping or Excessive Shock, Any Damage Caused Due to Tampering of the Product by an Unauthorized Agent, Liability for Loss of Data, Recorded Images or Business Opportunity Loss.</span></p>', 0, 'Sony 80cm (32 inch) HD Ready LED Smart TV', 'Sony 80cm (32 inch) HD Ready LED Smart TV', 'Sony 80cm (32 inch) HD Ready LED Smart TV', '2018-07-16', '2018-07-16'),
(8, 3, 10, 'Lenovo Vibe K5 Note (Grey, 32 GB)', 'lenovo-vibe-k5-note-grey-32-gb', 'PA330118IN/PA330115IN', 80, 16, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Metal rules and Lenovo definitely knows that. The Vibe K5 Note comes with a gorgeous metal body that looks and feels great. You also get two equally beautiful colour variants to choose from.</span></p>', 0, 'Lenovo Vibe K5 Note (Grey, 32 GB)', 'Lenovo Vibe K5 Note (Grey, 32 GB)', 'Lenovo Vibe K5 Note (Grey, 32 GB)', '2018-07-16', '2018-07-16'),
(9, 2, 12, 'Urban Ladder Packard Solid Wood King Bed  (Finish Color - Dark Walnut)', 'urban-ladder-packard-solid-wood-king-bed-finish-color-dark-walnut', 'ULPacKarD', 40, 30, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">A royal retreat. The neat construction and earthy tones of the Packard bed lend a regal look to your room. Ideal in a contemporary bedroom setting, its high, cushioned headboard offers a comfortable spot for you to lean against, whether to watch a film or enjoy breakfast in bed. A night of undisturbed slumber awaits you, Your Highness. Made from&Acirc;&nbsp;Rubberwood, Veneer and MDF Headboard upholstery made of fabric Available in 2 sizes - King and Queen Recommended mattress size &acirc;&euro;&ldquo; King: 72&acirc;&euro; x 78&acirc;&euro;; Queen: 60&acirc;&euro; x 78&acirc;&euro; Please refer to images for dimension details Any assembly or installation required will be done by the UL team at the time of delivery For indoor use only Note: Mattress and other accessories not included, unless specified otherwise</span></p>', 0, 'Urban Ladder Packard Solid Wood King Bed  (Finish Color - Dark Walnut)', 'Urban Ladder Packard Solid Wood King Bed  (Finish Color - Dark Walnut)', 'Urban Ladder Packard Solid Wood King Bed  (Finish Color - Dark Walnut)', '2018-07-16', '2018-07-16'),
(10, 5, 6, 'Pigeon Royal Induction Bottom Cookware Set  (Aluminium, 3 - Piece)', 'pigeon-royal-induction-bottom-cookware-set-aluminium-3-piece', '12714', 50, 16, '<p>1 Year Company Warranty. Customer Needs to Call the Nearest Service Center.&nbsp;</p>', 0, 'Pigeon Royal Induction Bottom Cookware Set  (Aluminium, 3 - Piece)', 'Pigeon Royal Induction Bottom Cookware Set  (Aluminium, 3 - Piece)', 'Pigeon Royal Induction Bottom Cookware Set  (Aluminium, 3 - Piece)', '2018-07-16', '2018-07-16'),
(11, 3, 8, 'Redmi 5A (Grey, 32 GB)  (3 GB RAM)', 'redmi-5a-grey-32-gb-3-gb-ram', 'MCI3B', 6999, 10, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Redmi 5A boasts of a beautiful fully-laminated 12.7 cm (5) HD display. Upto 8 days standby time with 3000 mAh Battery.Take gorgeous group photos and scenic shots on the all-new Redmi 5A. It is equipped with a fast focusing 13MP camera that helps you capture sharp and crisp photos.Qualcomm&#39;s Snapdragon 425 64-bit quad-core processor is great for daily use and performs well even when you&#39;re playing visually intensive games.</span></p>', 0, 'Redmi 5A (Grey, 32 GB)  (3 GB RAM)', 'Redmi 5A (Grey, 32 GB)  (3 GB RAM)', 'Redmi 5A (Grey, 32 GB)  (3 GB RAM)', '2018-07-17', '2018-07-17'),
(12, 3, 8, 'OPPO F7 (Silver, 64 GB)  (4 GB RAM)', 'oppo-f7-silver-64-gb-4-gb-ram', 'CPH1819', 19990, 20, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">Meet the OPPO F7 - the smartphone with an AI-powered selfie camera that captures the real you. Within its sleek and stylish body lies a powerful 2.0 GHz octa-core MTK P60 processor and 4 GB of RAM that take your smartphone experience to the next level.</span></p>', 0, 'OPPO F7 (Silver, 64 GB)  (4 GB RAM)', 'OPPO F7 (Silver, 64 GB)  (4 GB RAM)', 'OPPO F7 (Silver, 64 GB)  (4 GB RAM)', '2018-07-17', '2018-07-17'),
(13, 3, 10, 'Lenovo Z2 Plus (Black, 32 GB)  (3 GB RAM)', 'lenovo-z2-plus-black-32-gb-3-gb-ram', 'PA500016IN', 15449, 30, '<p><span style=\"color:rgb(33, 33, 33); font-family:roboto,arial,sans-serif; font-size:14px\">The flaunt-worthy Lenovo Z2 Plus isn&#39;t just a treat to the eye, it also comes with cutting-edge technologies which make it the perfect entertainment-companion, whether you&#39;re a cinephile, a gamer or a digital socialite.</span></p>', 1, 'Lenovo Z2 Plus (Black, 32 GB)  (3 GB RAM)', 'Lenovo Z2 Plus (Black, 32 GB)  (3 GB RAM)', 'Lenovo Z2 Plus (Black, 32 GB)  (3 GB RAM)', '2018-07-17', '2018-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `product_installment_periods`
--

CREATE TABLE `product_installment_periods` (
  `pip_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `insta_period` int(11) NOT NULL COMMENT 'In Weeks'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_installment_periods`
--

INSERT INTO `product_installment_periods` (`pip_id`, `prd_id`, `insta_period`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 1, 6),
(4, 1, 8),
(5, 2, 2),
(6, 2, 4),
(7, 2, 6),
(8, 2, 8),
(9, 3, 2),
(10, 3, 4),
(11, 3, 6),
(12, 3, 8),
(13, 3, 10),
(14, 4, 2),
(15, 4, 4),
(16, 4, 6),
(17, 4, 8),
(18, 5, 2),
(19, 5, 4),
(20, 5, 6),
(21, 5, 8),
(22, 6, 2),
(23, 6, 4),
(24, 6, 6),
(25, 6, 8),
(26, 6, 10),
(27, 7, 2),
(28, 7, 4),
(29, 7, 6),
(30, 7, 8),
(31, 8, 2),
(32, 8, 4),
(33, 8, 6),
(34, 8, 8),
(35, 9, 2),
(36, 9, 4),
(37, 9, 6),
(38, 9, 8),
(39, 10, 2),
(40, 10, 4),
(41, 10, 6),
(42, 10, 8),
(43, 10, 12),
(44, 11, 2),
(45, 11, 4),
(46, 11, 6),
(47, 11, 8),
(48, 12, 2),
(49, 12, 4),
(50, 12, 8),
(51, 12, 10),
(52, 13, 2),
(53, 13, 4),
(54, 13, 6),
(55, 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `prd_ph_id` bigint(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `prd_photo` varchar(255) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`prd_ph_id`, `prd_id`, `prd_photo`, `created_on`, `updated_on`) VALUES
(18, 2, 'P_16071815317216151.jpg', '2018-07-16', '2018-07-16'),
(19, 2, 'P_16071815317216152.jpg', '2018-07-16', '2018-07-16'),
(20, 2, 'P_16071815317216153.jpg', '2018-07-16', '2018-07-16'),
(21, 2, 'P_16071815317216154.jpg', '2018-07-16', '2018-07-16'),
(22, 1, 'P_16071815317218161.jpg', '2018-07-16', '2018-07-16'),
(23, 1, 'P_16071815317218162.jpg', '2018-07-16', '2018-07-16'),
(24, 1, 'P_16071815317218163.jpg', '2018-07-16', '2018-07-16'),
(25, 3, 'P_16071815317222341.jpg', '2018-07-16', '2018-07-16'),
(26, 3, 'P_16071815317222352.jpg', '2018-07-16', '2018-07-16'),
(27, 3, 'P_16071815317222353.jpg', '2018-07-16', '2018-07-16'),
(28, 3, 'P_16071815317222354.jpg', '2018-07-16', '2018-07-16'),
(29, 3, 'P_16071815317222355.jpg', '2018-07-16', '2018-07-16'),
(30, 4, 'P_16071815317226391.jpg', '2018-07-16', '2018-07-16'),
(31, 4, 'P_16071815317226402.jpg', '2018-07-16', '2018-07-16'),
(32, 4, 'P_16071815317226403.jpg', '2018-07-16', '2018-07-16'),
(33, 4, 'P_16071815317226404.jpg', '2018-07-16', '2018-07-16'),
(34, 4, 'P_16071815317226405.jpg', '2018-07-16', '2018-07-16'),
(35, 5, 'P_16071815317237181.jpg', '2018-07-16', '2018-07-16'),
(36, 5, 'P_16071815317237182.jpg', '2018-07-16', '2018-07-16'),
(37, 5, 'P_16071815317237183.jpg', '2018-07-16', '2018-07-16'),
(38, 5, 'P_16071815317237194.jpg', '2018-07-16', '2018-07-16'),
(39, 6, 'P_16071815317242251.jpg', '2018-07-16', '2018-07-16'),
(40, 6, 'P_16071815317242252.jpg', '2018-07-16', '2018-07-16'),
(41, 6, 'P_16071815317242263.jpg', '2018-07-16', '2018-07-16'),
(42, 6, 'P_16071815317242264.jpg', '2018-07-16', '2018-07-16'),
(43, 6, 'P_16071815317242265.jpg', '2018-07-16', '2018-07-16'),
(44, 7, 'P_16071815317247351.jpg', '2018-07-16', '2018-07-16'),
(45, 7, 'P_16071815317247352.jpg', '2018-07-16', '2018-07-16'),
(46, 7, 'P_16071815317247353.jpg', '2018-07-16', '2018-07-16'),
(47, 7, 'P_16071815317247354.jpg', '2018-07-16', '2018-07-16'),
(48, 8, 'P_16071815317251861.jpg', '2018-07-16', '2018-07-16'),
(49, 8, 'P_16071815317251862.jpg', '2018-07-16', '2018-07-16'),
(50, 8, 'P_16071815317251863.jpg', '2018-07-16', '2018-07-16'),
(51, 8, 'P_16071815317251864.jpg', '2018-07-16', '2018-07-16'),
(52, 8, 'P_16071815317251865.jpg', '2018-07-16', '2018-07-16'),
(54, 9, 'P_16071815317257902.jpg', '2018-07-16', '2018-07-16'),
(55, 9, 'P_16071815317257913.jpg', '2018-07-16', '2018-07-16'),
(56, 9, 'P_16071815317257914.jpg', '2018-07-16', '2018-07-16'),
(57, 10, 'P_16071815317294281.jpg', '2018-07-16', '2018-07-16'),
(58, 10, 'P_16071815317294282.jpg', '2018-07-16', '2018-07-16'),
(59, 10, 'P_16071815317294283.jpg', '2018-07-16', '2018-07-16'),
(60, 10, 'P_16071815317294284.jpg', '2018-07-16', '2018-07-16'),
(61, 10, 'P_16071815317294285.jpg', '2018-07-16', '2018-07-16'),
(65, 11, 'P_17071815318248091.jpg', '2018-07-17', '2018-07-17'),
(66, 11, 'P_17071815318248092.jpg', '2018-07-17', '2018-07-17'),
(67, 11, 'P_17071815318248271.jpg', '2018-07-17', '2018-07-17'),
(68, 12, 'P_17071815318253021.jpg', '2018-07-17', '2018-07-17'),
(69, 12, 'P_17071815318253032.jpg', '2018-07-17', '2018-07-17'),
(70, 12, 'P_17071815318253033.jpg', '2018-07-17', '2018-07-17'),
(71, 12, 'P_17071815318253034.jpg', '2018-07-17', '2018-07-17'),
(72, 12, 'P_17071815318253035.jpg', '2018-07-17', '2018-07-17'),
(73, 13, 'P_17071815318255831.jpg', '2018-07-17', '2018-07-17'),
(74, 13, 'P_17071815318255832.jpg', '2018-07-17', '2018-07-17'),
(75, 13, 'P_17071815318255833.jpg', '2018-07-17', '2018-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_descr` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `meta_title`, `meta_descr`, `meta_keyword`) VALUES
(1, 'Welcome to Lay Buys', 'Welcome to Lay Buys', 'Welcome to Lay Buys');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_cat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL,
  `sub_cat_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_cat_id`, `cat_id`, `sub_cat_name`, `sub_cat_slug`) VALUES
(2, 1, 'LG', 'lg'),
(3, 1, 'Sony', 'sony'),
(6, 5, 'Kitchen & Dining', 'kitchen-dining'),
(7, 6, 'Tools & Hardware', 'tools-hardware'),
(8, 3, 'Red Mi', 'red-mi'),
(9, 3, 'Samsung', 'samsung'),
(10, 3, 'Lenovo', 'lenovo'),
(11, 2, 'sofas', 'sofas'),
(12, 2, 'Beds', 'beds');

-- --------------------------------------------------------

--
-- Table structure for table `user_installments`
--

CREATE TABLE `user_installments` (
  `insta_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `insta_amt` double NOT NULL,
  `trns_id` varchar(255) DEFAULT NULL,
  `intsa_status` varchar(55) NOT NULL,
  `insta_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_installments`
--

INSERT INTO `user_installments` (`insta_id`, `user_id`, `prd_id`, `ord_id`, `insta_amt`, `trns_id`, `intsa_status`, `insta_date`) VALUES
(1, 1, 12, 1, 2, 'TRNS214214OK24', 'Paid', '2018-07-24'),
(2, 1, 12, 1, 4, 'TRNS1231TES235423', 'Paid', '2018-07-24'),
(3, 1, 12, 1, 15980, 'TXN567OKL', 'Paid', '2018-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` bigint(20) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `email_conf_status` int(11) NOT NULL DEFAULT '0' COMMENT '0- Unconfirmed 1- Confirmed',
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '0- Unblock 1- Block',
  `paypal_email_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_contact_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_city` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_post_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_state` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_country` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `same_for_billing` int(11) NOT NULL,
  `reg_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `full_name`, `contact_no`, `email`, `password`, `address1`, `address2`, `town`, `city`, `post_code`, `state`, `country`, `email_conf_status`, `user_status`, `paypal_email_user`, `ship_full_name`, `ship_contact_no`, `ship_address1`, `ship_address2`, `ship_town`, `ship_city`, `ship_post_code`, `ship_state`, `ship_country`, `same_for_billing`, `reg_date`, `updated_date`) VALUES
(1, 'Suresh', '9861245555', 'suresh@bletindia.com', '3c8650922028fd6e7a357c8941807a6c', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bomikhal', 'Bhubaneswar', '751010', '0', '0', 1, 0, 'sureshkumar02_per@gmail.com', 'Suresh', '9861245555', 'Plot No - 1242 P -8', 'Govindaprasad Bomikhal', 'Bomikhal', 'Bhubaneswar', '751010', NULL, NULL, 0, '2019-03-11', '2018-08-24'),
(2, 'malaya', '9861105226', 'malaya@bletindia.com', 'UkdWdGIwQXhNak0wTlE9PQ==', 'as', 'as', '', 'BBSR', '752010', 'Odisha', 'India', 1, 0, NULL, 'malaya', '9861105226', 'as', 'as', NULL, 'BBSR', '752010', 'Odisha', 'India', 0, '2018-07-13', '2018-07-13'),
(3, 'Tridee Dakua', '7205821247', 'trideep@bletindia.com', 'UkdWdGIwQXhNak0wTlE9PQ==', 'Bhubaneswar Odisha', 'Patia Shree vihar', '', 'Bhubaneswar', '751016', 'Odisha', 'India', 1, 0, NULL, 'Deenabandhu Dakua', '9040437353', 'Bhubaneswar Odisha', 'Chandrasekharpur', NULL, 'Bhubaneswar', '751012', 'Odisha', 'India', 1, '2018-07-16', '2018-07-16'),
(25, 'dsad', '12312', 'ss@gmail.com', 'UkdWdGIwQXhNak0wTlE9PQ==', 'asdas', '', '', '', 'adad', '', '', 0, 0, NULL, 'asda', '242342', '2342', '', '', '', '2424242', '', '', 1, '2018-08-24', '2018-08-24'),
(26, 'Hello', '907897897', 'hello@gmail.com', 'UkdWdGIwQXhNak0wTlE9PQ==', 'test', 'test', 'test', 'test', '2342342', '', '', 0, 0, NULL, 'dgd', '2424', 'dgdfg', 'dgdfgd', 'dgdgd', 'dfgdf', 'dgdfgd', '', '', 1, '2018-08-24', '2018-08-24'),
(27, 'Yes', '242342', 'yes@gmail.com', 'e18df5e6d8bad2aa659502d9dad186b4', 'sdfsd', 'wer', 'wer', 'wer', 'sdfs', '0', '0', 1, 0, NULL, 'Yes', '242342', 'sdfsd', 'wer', 'wer', 'wer', 'sdfs', NULL, NULL, 0, '2018-08-24', '2018-08-24'),
(28, 'Malaya Rout', '9090905717', 'malayak@bletindia.com', 'fd4893545feccc2db59e437b0d240858', 'Mancheswar Industrial Estate', '', 'Bhubaneswar', 'Bhubaneswar', '751010', '', '', 1, 0, NULL, 'Malaya Rout', '9090905717', 'Mancheswar Industrial Estate', '', 'Bhubaneswar', 'Bhubaneswar', '751010', '', '', 0, '2019-03-11', '2019-03-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_order`
--
ALTER TABLE `master_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prd_id`);

--
-- Indexes for table `product_installment_periods`
--
ALTER TABLE `product_installment_periods`
  ADD PRIMARY KEY (`pip_id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`prd_ph_id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `user_installments`
--
ALTER TABLE `user_installments`
  ADD PRIMARY KEY (`insta_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_order`
--
ALTER TABLE `master_order`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prd_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_installment_periods`
--
ALTER TABLE `product_installment_periods`
  MODIFY `pip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `prd_ph_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_installments`
--
ALTER TABLE `user_installments`
  MODIFY `insta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
