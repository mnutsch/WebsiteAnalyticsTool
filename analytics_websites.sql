/*******************************************************************************************************************************************
 * File Name: analytics_websites.sql
 * Project: WebAnalytics
 * Author: mnutsch
 * Date Created: 4-6-2017
 * Description: This table will contain the names and ID's of websites tracked.
 * Notes: 
 ******************************************************************************************************************************************/

USE `sandbox`;

DROP TABLE IF EXISTS `analytics_websites`;

CREATE TABLE `analytics_websites` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `access_token` varchar(512) NOT NULL UNIQUE,
   PRIMARY KEY (`id`)
) 
ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ADD DATA

insert into `analytics_websites` (name, access_token)
values
('vistasand.com','987654321'),
('mattnutsch.com','123456789');

