SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `all` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `economy` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `politic` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `technology` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `world` (
  `id` int(11) NOT NULL,
  `news_title` varchar(1000) NOT NULL,
  `news_link` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_source_link` varchar(200) NOT NULL,
  `news_source_img` varchar(200) NOT NULL,
  `news_description` text NOT NULL,
  `news_img` varchar(500) DEFAULT NULL,
  `news_video` int(11) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `all`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `economy`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `politic`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `technology`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `world`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `economy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `politic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `technology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `world`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;