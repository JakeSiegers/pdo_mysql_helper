CREATE DATABASE IF NOT EXISTS `pdo-mysql-helper-other-example` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pdo-mysql-helper-other-example`;

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
