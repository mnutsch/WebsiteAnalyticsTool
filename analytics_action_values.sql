/*******************************************************************************************************************************************
 * File Name: analytics_action_values.sql
 * Project: WebAnalytics
 * Author: mnutsch
 * Date Created: 4-6-2017
 * Description: This table will contain the details of action values tracked.
 * Notes: 
 ******************************************************************************************************************************************/

USE `sandbox`;

DROP TABLE IF EXISTS `analytics_action_values`;

CREATE TABLE `analytics_action_values` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(64) NOT NULL,
  `item_value` varchar(64) DEFAULT NULL,
  `action_id` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) 
ENGINE=InnoDB DEFAULT CHARSET=latin1;

# ADD DATA

insert into `analytics_action_values` (action_id, label, item_value)
values
('1','Contact Form Submitted','1'),
('2','Contact Form Submitted','1'),
('2','Error Occured','Connection Timeout');

