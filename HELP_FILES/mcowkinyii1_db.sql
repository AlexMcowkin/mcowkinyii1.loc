-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 21 2017 г., 13:00
-- Версия сервера: 5.5.48
-- Версия PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mcowkinyii1_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`, `code`) VALUES
(6, 'Afghanistan', 'AFG'),
(7, 'Åland Islands', 'ALA'),
(8, 'Albania', 'ALB'),
(9, 'Algeria', 'DZA'),
(10, 'American Samoa', 'ASM'),
(11, 'Andorra', 'AND'),
(12, 'Angola', 'AGO'),
(13, 'Anguilla', 'AIA'),
(14, 'Antarctica', 'ATA'),
(15, 'Antigua and Barbuda', 'ATG'),
(16, 'Argentina', 'ARG'),
(17, 'Armenia', 'ARM'),
(18, 'Aruba', 'ABW'),
(19, 'Australia', 'AUS'),
(20, 'Austria', 'AUT'),
(21, 'Azerbaijan', 'AZE'),
(22, 'Bahamas', 'BHS'),
(23, 'Bahrain', 'BHR'),
(24, 'Bangladesh', 'BGD'),
(25, 'Barbados', 'BRB'),
(26, 'Belarus', 'BLR'),
(27, 'Belgium', 'BEL'),
(28, 'Belize', 'BLZ'),
(29, 'Benin', 'BEN'),
(30, 'Bermuda', 'BMU'),
(31, 'Bhutan', 'BTN'),
(32, 'Bolivia (Plurinational State o', 'BOL'),
(33, 'Bonaire, Sint Eustatius and Sa', 'BES'),
(34, 'Bosnia and Herzegovina', 'BIH'),
(35, 'Botswana', 'BWA'),
(36, 'Bouvet Island', 'BVT'),
(37, 'Brazil', 'BRA'),
(38, 'British Indian Ocean Territory', 'IOT'),
(39, 'Brunei Darussalam', 'BRN'),
(40, 'Bulgaria', 'BGR'),
(41, 'Burkina Faso', 'BFA'),
(42, 'Burundi', 'BDI'),
(43, 'Cambodia', 'KHM'),
(44, 'Cameroon', 'CMR'),
(45, 'Canada', 'CAN'),
(46, 'Cabo Verde', 'CPV'),
(47, 'Cayman Islands', 'CYM'),
(48, 'Central African Republic', 'CAF'),
(49, 'Chad', 'TCD'),
(50, 'Chile', 'CHL'),
(51, 'China', 'CHN'),
(52, 'Christmas Island', 'CXR'),
(53, 'Cocos (Keeling) Islands', 'CCK'),
(54, 'Colombia', 'COL'),
(55, 'Comoros', 'COM'),
(56, 'Congo', 'COG'),
(57, 'Congo (Democratic Republic of ', 'COD'),
(58, 'Cook Islands', 'COK'),
(59, 'Costa Rica', 'CRI'),
(60, 'Côte d''Ivoire', 'CIV'),
(61, 'Croatia', 'HRV'),
(62, 'Cuba', 'CUB'),
(63, 'Curaçao', 'CUW'),
(64, 'Cyprus', 'CYP'),
(65, 'Czech Republic', 'CZE'),
(66, 'Denmark', 'DNK'),
(67, 'Djibouti', 'DJI'),
(68, 'Dominica', 'DMA'),
(69, 'Dominican Republic', 'DOM'),
(70, 'Ecuador', 'ECU'),
(71, 'Egypt', 'EGY'),
(72, 'El Salvador', 'SLV'),
(73, 'Equatorial Guinea', 'GNQ'),
(74, 'Eritrea', 'ERI'),
(75, 'Estonia', 'EST'),
(76, 'Ethiopia', 'ETH'),
(77, 'Falkland Islands (Malvinas)', 'FLK'),
(78, 'Faroe Islands', 'FRO'),
(79, 'Fiji', 'FJI'),
(80, 'Finland', 'FIN'),
(81, 'France', 'FRA'),
(82, 'French Guiana', 'GUF'),
(83, 'French Polynesia', 'PYF'),
(84, 'French Southern Territories', 'ATF'),
(85, 'Gabon', 'GAB'),
(86, 'Gambia', 'GMB'),
(87, 'Georgia', 'GEO'),
(88, 'Germany', 'DEU'),
(89, 'Ghana', 'GHA'),
(90, 'Gibraltar', 'GIB'),
(91, 'Greece', 'GRC'),
(92, 'Greenland', 'GRL'),
(93, 'Grenada', 'GRD'),
(94, 'Guadeloupe', 'GLP'),
(95, 'Guam', 'GUM'),
(96, 'Guatemala', 'GTM'),
(97, 'Guernsey', 'GGY'),
(98, 'Guinea', 'GIN'),
(99, 'Guinea-Bissau', 'GNB'),
(100, 'Guyana', 'GUY'),
(101, 'Haiti', 'HTI'),
(102, 'Heard Island and McDonald Isla', 'HMD'),
(103, 'Holy See', 'VAT'),
(104, 'Honduras', 'HND'),
(105, 'Hong Kong', 'HKG'),
(106, 'Hungary', 'HUN'),
(107, 'Iceland', 'ISL'),
(108, 'India', 'IND'),
(109, 'Indonesia', 'IDN'),
(110, 'Iran (Islamic Republic of)', 'IRN'),
(111, 'Iraq', 'IRQ'),
(112, 'Ireland', 'IRL'),
(113, 'Isle of Man', 'IMN'),
(114, 'Israel', 'ISR'),
(115, 'Italy', 'ITA'),
(116, 'Jamaica', 'JAM'),
(117, 'Japan', 'JPN'),
(118, 'Jersey', 'JEY'),
(119, 'Jordan', 'JOR'),
(120, 'Kazakhstan', 'KAZ'),
(121, 'Kenya', 'KEN'),
(122, 'Kiribati', 'KIR'),
(123, 'Korea (Democratic People''s Rep', 'PRK'),
(124, 'Korea (Republic of)', 'KOR'),
(125, 'Kuwait', 'KWT'),
(126, 'Kyrgyzstan', 'KGZ'),
(127, 'Lao People''s Democratic Republ', 'LAO'),
(128, 'Latvia', 'LVA'),
(129, 'Lebanon', 'LBN'),
(130, 'Lesotho', 'LSO'),
(131, 'Liberia', 'LBR'),
(132, 'Libya', 'LBY'),
(133, 'Liechtenstein', 'LIE'),
(134, 'Lithuania', 'LTU'),
(135, 'Luxembourg', 'LUX'),
(136, 'Macao', 'MAC'),
(137, 'Macedonia (the former Yugoslav', 'MKD'),
(138, 'Madagascar', 'MDG'),
(139, 'Malawi', 'MWI'),
(140, 'Malaysia', 'MYS'),
(141, 'Maldives', 'MDV'),
(142, 'Mali', 'MLI'),
(143, 'Malta', 'MLT'),
(144, 'Marshall Islands', 'MHL'),
(145, 'Martinique', 'MTQ'),
(146, 'Mauritania', 'MRT'),
(147, 'Mauritius', 'MUS'),
(148, 'Mayotte', 'MYT'),
(149, 'Mexico', 'MEX'),
(150, 'Micronesia (Federated States o', 'FSM'),
(151, 'Moldova (Republic of)', 'MDA'),
(152, 'Monaco', 'MCO'),
(153, 'Mongolia', 'MNG'),
(154, 'Montenegro', 'MNE'),
(155, 'Montserrat', 'MSR'),
(156, 'Morocco', 'MAR'),
(157, 'Mozambique', 'MOZ'),
(158, 'Myanmar', 'MMR'),
(159, 'Namibia', 'NAM'),
(160, 'Nauru', 'NRU'),
(161, 'Nepal', 'NPL'),
(162, 'Netherlands', 'NLD'),
(163, 'New Caledonia', 'NCL'),
(164, 'New Zealand', 'NZL'),
(165, 'Nicaragua', 'NIC'),
(166, 'Niger', 'NER'),
(167, 'Nigeria', 'NGA'),
(168, 'Niue', 'NIU'),
(169, 'Norfolk Island', 'NFK'),
(170, 'Northern Mariana Islands', 'MNP'),
(171, 'Norway', 'NOR'),
(172, 'Oman', 'OMN'),
(173, 'Pakistan', 'PAK'),
(174, 'Palau', 'PLW'),
(175, 'Palestine, State of', 'PSE'),
(176, 'Panama', 'PAN'),
(177, 'Papua New Guinea', 'PNG'),
(178, 'Paraguay', 'PRY'),
(179, 'Peru', 'PER'),
(180, 'Philippines', 'PHL'),
(181, 'Pitcairn', 'PCN'),
(182, 'Poland', 'POL'),
(183, 'Portugal', 'PRT'),
(184, 'Puerto Rico', 'PRI'),
(185, 'Qatar', 'QAT'),
(186, 'Réunion', 'REU'),
(187, 'Romania', 'ROU'),
(188, 'Russian Federation', 'RUS'),
(189, 'Rwanda', 'RWA'),
(190, 'Saint Barthélemy', 'BLM'),
(191, 'Saint Helena, Ascension and Tr', 'SHN'),
(192, 'Saint Kitts and Nevis', 'KNA'),
(193, 'Saint Lucia', 'LCA'),
(194, 'Saint Martin (French part)', 'MAF'),
(195, 'Saint Pierre and Miquelon', 'SPM'),
(196, 'Saint Vincent and the Grenadin', 'VCT'),
(197, 'Samoa', 'WSM'),
(198, 'San Marino', 'SMR'),
(199, 'Sao Tome and Principe', 'STP'),
(200, 'Saudi Arabia', 'SAU'),
(201, 'Senegal', 'SEN'),
(202, 'Serbia', 'SRB'),
(203, 'Seychelles', 'SYC'),
(204, 'Sierra Leone', 'SLE'),
(205, 'Singapore', 'SGP'),
(206, 'Sint Maarten (Dutch part)', 'SXM'),
(207, 'Slovakia', 'SVK'),
(208, 'Slovenia', 'SVN'),
(209, 'Solomon Islands', 'SLB'),
(210, 'Somalia', 'SOM'),
(211, 'South Africa', 'ZAF'),
(212, 'South Georgia and the South Sa', 'SGS'),
(213, 'South Sudan', 'SSD'),
(214, 'Spain', 'ESP'),
(215, 'Sri Lanka', 'LKA'),
(216, 'Sudan', 'SDN'),
(217, 'Suriname', 'SUR'),
(218, 'Svalbard and Jan Mayen', 'SJM'),
(219, 'Swaziland', 'SWZ'),
(220, 'Sweden', 'SWE'),
(221, 'Switzerland', 'CHE'),
(222, 'Syrian Arab Republic', 'SYR'),
(223, 'Taiwan, Province of China', 'TWN'),
(224, 'Tajikistan', 'TJK'),
(225, 'Tanzania, United Republic of', 'TZA'),
(226, 'Thailand', 'THA'),
(227, 'Timor-Leste', 'TLS'),
(228, 'Togo', 'TGO'),
(229, 'Tokelau', 'TKL'),
(230, 'Tonga', 'TON'),
(231, 'Trinidad and Tobago', 'TTO'),
(232, 'Tunisia', 'TUN'),
(233, 'Turkey', 'TUR'),
(234, 'Turkmenistan', 'TKM'),
(235, 'Turks and Caicos Islands', 'TCA'),
(236, 'Tuvalu', 'TUV'),
(237, 'Uganda', 'UGA'),
(238, 'Ukraine', 'UKR'),
(239, 'United Arab Emirates', 'ARE'),
(240, 'United Kingdom of Great Britai', 'GBR'),
(241, 'United States of America', 'USA'),
(242, 'United States Minor Outlying I', 'UMI'),
(243, 'Uruguay', 'URY'),
(244, 'Uzbekistan', 'UZB'),
(245, 'Vanuatu', 'VUT'),
(246, 'Venezuela (Bolivarian Republic', 'VEN'),
(247, 'Viet Nam', 'VNM'),
(248, 'Virgin Islands (British)', 'VGB'),
(249, 'Virgin Islands (U.S.)', 'VIR'),
(250, 'Wallis and Futuna', 'WLF'),
(251, 'Western Sahara', 'ESH'),
(252, 'Yemen', 'YEM'),
(253, 'Zambia', 'ZMB'),
(254, 'Zimbabwe', 'ZWE');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL,
  `departure_date` varchar(30) NOT NULL,
  `departure_airport` varchar(10) NOT NULL,
  `arrival_airport` varchar(10) NOT NULL,
  `aviacompany` varchar(10) NOT NULL,
  `duration_of_flight` varchar(30) NOT NULL,
  `price` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
