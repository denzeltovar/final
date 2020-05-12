--
-- Database: `Final`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--
USE `homeworkwebpage`;-- put your database name in the single quotes

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE  `accounts` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL UNIQUE,
  `password` varchar(30) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `college` varchar(20) DEFAULT NULL,
  `major` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`,`password`, `fname`, `lname`,`college`, `major`) VALUES
(1, 'mjlee@njit.edu','123456', 'Mike', 'Lee', 'NJIT', 'CS'),
(2, 'drt33@njit.edu','654321', 'Denzel', 'Tovar','NJIT', 'BIS');


-- --------------------------------------------------------

--
-- Table structure for table `todos`
--
DROP TABLE IF EXISTS `todos`;

CREATE TABLE `todos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `description` varchar(60) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duedate` datetime DEFAULT NULL,
  `complete` varchar(10) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`,`title`, `description`,`createdate`, `duedate`,`complete`) VALUES
(1, 'English', 'Write 100 word essay', '2017-05-03 0:00:00', '2017-05-03 00:00:00', "Complete");


