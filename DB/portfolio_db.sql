START TRANSACTION;

DROP TABLE IF EXISTS `portfolio_project_techno`;

DROP TABLE IF EXISTS `portfolio_techno`;

DROP TABLE IF EXISTS `portfolio_image`;

DROP TABLE IF EXISTS `portfolio_project`;

DROP TABLE IF EXISTS `portfolio_admin`;

CREATE TABLE IF NOT EXISTS `portfolio_admin` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`username` varchar(50) NOT NULL,
	`password` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_project` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`project_name` varchar(255) NOT NULL,
	`project_description` text NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_techno` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`techno_name` varchar(255) NOT NULL,
	`project_id` int NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_project_techno` (
	`project_id` int NOT NULL,
	`techno_id` int NOT NULL,
	PRIMARY KEY (`project_id`, `techno_id`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `portfolio_image` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`image_name` varchar(255) NOT NULL,
	`project_id` int NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE = InnoDB;



ALTER TABLE `portfolio_project_techno` ADD CONSTRAINT `Techno_fk1` FOREIGN KEY (`project_id`) REFERENCES `portfolio_project`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `portfolio_project_techno` ADD CONSTRAINT `Techno_fk2` FOREIGN KEY (`project_id`) REFERENCES `portfolio_techno`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `portfolio_image` ADD CONSTRAINT `Image_fk2` FOREIGN KEY (`project_id`) REFERENCES `portfolio_project`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

COMMIT;