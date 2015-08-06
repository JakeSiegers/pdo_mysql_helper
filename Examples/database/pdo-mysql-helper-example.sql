CREATE DATABASE IF NOT EXISTS `pdo-mysql-helper-example` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pdo-mysql-helper-example`;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `fname`, `lname`, `age`) VALUES
(1, 'John', 'Doe', 30),
(2, 'Eric', 'Man', 20);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL,
  `place` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO `places` (`id`, `place`) VALUES
(1, 'Bakery'),
(2, 'Fruit Stand');

ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;