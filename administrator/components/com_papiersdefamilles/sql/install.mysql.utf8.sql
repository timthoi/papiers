
-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : Cities
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -

CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `note` text,
  `published` tinyint(11) NOT NULL,
  `ordering` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : countries
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -

CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_countries` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`alias` varchar(255) NOT NULL,
	`description` text,
	`note` text,
	`published` tinyint(11) NOT NULL,
	`ordering` bigint(20) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : regions
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -

CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_regions` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`alias` varchar(255) NOT NULL,
	`description` text,
	`note` text,
	`published` tinyint(11) NOT NULL,
	`ordering` bigint(20) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : provinces
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -

CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_provinces` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`alias` varchar(255) NOT NULL,
	`description` text,
	`note` text,
	`published` tinyint(11) NOT NULL,
	`ordering` bigint(20) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : subscription plans
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -

CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_subscriptionplans` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`type_subscription_plans` int(11) NULL,
	`description` text,
	`note` text,
	`price` float DEFAULT NULL,
	`times` int(11) DEFAULT NULL,
	`ordering` int(11) DEFAULT NULL,
	`published` tinyint(11) DEFAULT NULL,
	`creation_date` datetime DEFAULT NULL,
	`modification_date` datetime DEFAULT NULL,
	`created_by` bigint(20) UNSIGNED DEFAULT NULL,
	`modified_by` bigint(20) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : categories
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`alias` varchar(255) NOT NULL,
	`description` text,
	`note` text,
	`ordering` int(11) DEFAULT NULL,
	`published` tinyint(11) DEFAULT NULL,
	`creation_date` datetime DEFAULT NULL,
	`modification_date` datetime DEFAULT NULL,
	`created_by` bigint(20) UNSIGNED DEFAULT NULL,
	`modified_by` bigint(20) UNSIGNED DEFAULT NULL,

	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : type documents
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_typedocuments` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`alias` varchar(255) NOT NULL,
	`description` text,
	`note` text,
	`ordering` int(11) DEFAULT NULL,
	`published` tinyint(11) DEFAULT NULL,
	`creation_date` datetime DEFAULT NULL,
	`modification_date` datetime DEFAULT NULL,
	`created_by` bigint(20) UNSIGNED DEFAULT NULL,
	`modified_by` bigint(20) UNSIGNED DEFAULT NULL,

PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : documents
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_documents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num_id` varchar(255),
  `format_document` tinyint(4),
  `qualities` varchar(255),
	`number_of_pages` bigint(20),
	`locations` text,
	`main_persons` text,
	`secondary_persons` text,
	`main_pic` varchar(255),
	`gallery_pic` varchar(255),
	`gallery_demo_pic` varchar(255),
	`description` text,
	`note` text,
	`is_sale` tinyint(4) NOT NULL,
	`is_sale_ebay` tinyint(4) NOT NULL,
	`birthday` datetime DEFAULT NULL,
	`age` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `published` tinyint(11) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `modification_date` datetime DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : documentsecondarynames
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_documentsecondarynames` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`document_id`  BIGINT(20) UNSIGNED NOT NULL ,
	`name`  VARCHAR(255),
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : documentmainnames
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_documentmainnames` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`document_id` BIGINT(20) UNSIGNED NOT NULL ,
	`name` VARCHAR(255) ,
	`sur_name` VARCHAR(255) ,
	`sex` INT(11) ,
	`ordering` INT(11) ,
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : documenttypes
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_documenttypes` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`document_id`  BIGINT(20) UNSIGNED NOT NULL ,
	`type_document_id`  BIGINT(20) UNSIGNED NOT NULL ,
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : documentcategories
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_documentcategories` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`document_id`  BIGINT(20) UNSIGNED NOT NULL ,
	`category_id`  BIGINT(20) UNSIGNED NOT NULL ,
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : Orders
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__papiersdefamilles_orders` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`joomla_user_id` BIGINT(20) UNSIGNED,
	`name` VARCHAR(255) ,
	`surname` VARCHAR(255) ,
	`phone` VARCHAR(255) ,
	`address` VARCHAR(255) ,
	`zip_code` VARCHAR(255) ,
	`city` VARCHAR(255) ,
	`email` VARCHAR(255) ,
	`birthday` DATE ,
	`subscriptionplan_id` BIGINT(20) UNSIGNED ,
	`subscriptionplant_price` VARCHAR(255) ,
	`price_total` VARCHAR(255) ,
	`discount` VARCHAR(255) ,
	`is_paypal` TINYINT ,
	`is_paypalO_refund` TINYINT ,
	`paypal_status` TINYINT ,
	`created_by` BIGINT(20) UNSIGNED ,
	`modified_by` BIGINT(20) UNSIGNED ,
	`creation_date` DATETIME ,
	`modification_date` DATETIME ,
	`ordering` INT(11) ,
	`published` TINYINT(11) ,

	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

