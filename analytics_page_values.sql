/*******************************************************************************************************************************************
 * File Name: analytics_page_values.sql
 * Project: WebAnalytics
 * Author: mnutsch
 * Date Created: 4-6-2017
 * Description: This table will contain the details of page values tracked.
 * Notes: 
 ******************************************************************************************************************************************/

USE `sandbox`;

DROP TABLE IF EXISTS `analytics_page_values`;

CREATE TABLE `analytics_page_values` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(64) NOT NULL,
  `item_value` varchar(64) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) 
ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ADD DATA

insert into `analytics_page_values` (page_id, label, item_value)
values
('1','User ID','23'),
('1','User Department','Accounting'),
('2','User ID','5'),
('2','User Department','Operations');

