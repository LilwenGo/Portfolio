DROP TABLE IF EXISTS `portfolio_Techno`;

DROP TABLE IF EXISTS `portfolio_Image`;

DROP TABLE IF EXISTS `portfolio_Project`;

DROP TABLE IF EXISTS `portfolio_Admin`;

CREATE TABLE IF NOT EXISTS `portfolio_Admin` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`username` varchar(50) NOT NULL,
	`password` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_Project` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`project_name` varchar(255) NOT NULL,
	`project_description` text NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_Techno` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`techno_name` varchar(255) NOT NULL,
	`project_id` int NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_Image` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`image_name` varchar(255) NOT NULL,
	`project_id` int NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;



ALTER TABLE `portfolio_Techno` ADD CONSTRAINT `Techno_fk2` FOREIGN KEY (`project_id`) REFERENCES `portfolio_Project`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `portfolio_Image` ADD CONSTRAINT `Image_fk2` FOREIGN KEY (`project_id`) REFERENCES `portfolio_Project`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;