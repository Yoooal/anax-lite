-- USE oophp;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100),
  `userLevel` INT,

  UNIQUE KEY `username_unique` (`username`)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


INSERT INTO `users` (`username`, `password`, `userLevel`) VALUES
("doe", "doe", 1),
("joel", "joel", 1),
("johan", "johan", 1),
("peter", "peter", 1),
("thomas", "thomas", 1),
("linnea", "linnea", 1)
;
