# Users
Создать бд Users, в ней таблицу user

CREATE TABLE `user` (
	`id` TINYINT(4) NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(40) NOT NULL,
	`password` VARCHAR(50) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`ip` INT(11) NOT NULL,
	`last_activity` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;
