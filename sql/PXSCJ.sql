-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.34-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema pxscj
--

CREATE DATABASE IF NOT EXISTS pxscj;
USE pxscj;

--
-- Definition of table `cjb`
--

DROP TABLE IF EXISTS `cjb`;
CREATE TABLE `cjb` (
  `学号` char(6) NOT NULL,
  `课程号` char(3) NOT NULL,
  `成绩` int(4) DEFAULT NULL,
  PRIMARY KEY (`学号`,`课程号`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `cjb`
--

/*!40000 ALTER TABLE `cjb` DISABLE KEYS */;
INSERT INTO `cjb` (`学号`,`课程号`,`成绩`) VALUES 
 ('081101','101',80),
 ('081101','102',78),
 ('081101','206',76),
 ('081102','102',78),
 ('081102','206',78),
 ('081103','101',62),
 ('081103','102',70),
 ('081103','206',81),
 ('081104','101',90),
 ('081104','102',84),
 ('081104','206',65),
 ('081106','101',65),
 ('081106','102',71),
 ('081106','206',80),
 ('081107','101',78),
 ('081107','102',80),
 ('081107','206',68),
 ('081108','101',85),
 ('081108','102',64),
 ('081108','206',87),
 ('081109','101',70),
 ('081109','102',95),
 ('081109','206',90),
 ('081110','101',95),
 ('081110','102',90),
 ('081110','206',89),
 ('081111','101',91),
 ('081111','102',70),
 ('081111','206',76),
 ('081113','101',63),
 ('081113','102',79),
 ('081113','206',60),
 ('081201','101',80),
 ('081202','101',65),
 ('081203','101',87),
 ('081204','101',91),
 ('081210','101',76),
 ('081216','101',81),
 ('081218','101',70),
 ('081220','101',82),
 ('081221','101',76),
 ('081241','101',90);
/*!40000 ALTER TABLE `cjb` ENABLE KEYS */;


--
-- Definition of table `kcb`
--

DROP TABLE IF EXISTS `kcb`;
CREATE TABLE `kcb` (
  `课程号` char(3) NOT NULL,
  `课程名` char(16) NOT NULL,
  `开课学期` tinyint(1) DEFAULT '1',
  `学时` tinyint(1) DEFAULT NULL,
  `学分` tinyint(1) NOT NULL,
  PRIMARY KEY (`课程号`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `kcb`
--

/*!40000 ALTER TABLE `kcb` DISABLE KEYS */;
INSERT INTO `kcb` (`课程号`,`课程名`,`开课学期`,`学时`,`学分`) VALUES 
 ('101','计算机基础',1,80,5),
 ('102','程序设计与语言',2,68,4),
 ('206','离散数学',4,68,4),
 ('208','数据结构',5,68,4),
 ('209','操作系统',6,68,4),
 ('210','计算机原理',5,85,5),
 ('212','数据库原理',7,68,4),
 ('301','计算机网络',7,51,3),
 ('302','软件工程',7,51,3);
/*!40000 ALTER TABLE `kcb` ENABLE KEYS */;


--
-- Definition of table `xsb`
--

DROP TABLE IF EXISTS `xsb`;
CREATE TABLE `xsb` (
  `学号` char(6) NOT NULL,
  `姓名` char(8) NOT NULL,
  `性别` tinyint(1) DEFAULT '1',
  `出生时间` date DEFAULT NULL,
  `专业` char(12) DEFAULT NULL,
  `总学分` int(4) DEFAULT '0',
  `备注` text,
  PRIMARY KEY (`学号`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- Dumping data for table `xsb`
--

/*!40000 ALTER TABLE `xsb` DISABLE KEYS */;
INSERT INTO `xsb` (`学号`,`姓名`,`性别`,`出生时间`,`专业`,`总学分`,`备注`) VALUES 
 ('081101','王林',1,'1990-02-10','计算机',50,NULL),
 ('081102','程明',1,'1991-02-01','计算机',50,NULL),
 ('081103','王燕',0,'1989-10-06','计算机',50,NULL),
 ('081104','韦严平',1,'1990-08-26','计算机',50,NULL),
 ('081106','李方方',1,'1990-11-20','计算机',50,NULL),
 ('081107','李明',1,'1990-05-01','计算机',54,'提前修完《数据结构》，并获学分'),
 ('081108','林一帆',1,'1989-08-05','计算机',52,'已提前修完一门课'),
 ('081109','张强民',1,'1989-08-11','计算机',50,NULL),
 ('081110','张蔚',0,'1991-07-22','计算机',50,'三好生'),
 ('081111','赵琳',0,'1990-03-18','计算机',50,NULL),
 ('081113','严红',0,'1989-08-11','计算机',48,'有一门课不及格，待补考'),
 ('081201','王敏',1,'1989-06-10','通信工程',42,NULL),
 ('081202','王林',1,'1989-01-29','通信工程',40,NULL),
 ('081203','王玉民',1,'1990-03-26','通信工程',42,NULL),
 ('081204','马琳琳',0,'1989-02-10','通信工程',42,NULL),
 ('081206','李计',1,'1989-09-20','通信工程',42,NULL),
 ('081210','李红庆',1,'1989-05-01','通信工程',44,'已提前修完一门课，并获得学分'),
 ('081216','孙祥欣',1,'1989-03-19','通信工程',42,NULL),
 ('081218','孙研',1,'1990-10-09','通信工程',42,NULL),
 ('081220','吴薇华',0,'1990-03-18','通信工程',42,NULL),
 ('081221','刘燕敏',0,'1989-11-12','通信工程',42,NULL),
 ('081241','罗林琳',0,'1990-01-30','通信工程',50,'转专业学习');
/*!40000 ALTER TABLE `xsb` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
