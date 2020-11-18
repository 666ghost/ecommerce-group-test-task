-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: orm_test
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role`
(
    `id`        int unsigned NOT NULL AUTO_INCREMENT,
    `name`      varchar(64)  NOT NULL,
    `parent_id` int unsigned,
    PRIMARY KEY (`id`),
    INDEX parent_id_index (parent_id),
    FOREIGN KEY (`parent_id`) REFERENCES `role` (`id`)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role`
    DISABLE KEYS */;
INSERT INTO `role`
VALUES (1, 'Guest', NULL),
       (2, 'User', 1),
       (3, 'Manager', 2),
       (4, 'Admin', 2);
/*!40000 ALTER TABLE `role`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `route`
(
    `id`                int unsigned NOT NULL AUTO_INCREMENT,
    `name`              varchar(255) NOT NULL,
    `uri`               varchar(255) NOT NULL,
    `allow_child_roles` boolean      NOT NULL,
    `parent_id`         int unsigned,
    PRIMARY KEY (`id`),
    INDEX parent_id_index (parent_id),
    FOREIGN KEY (`parent_id`) REFERENCES `route` (`id`)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
) ENGINE = InnoDB
  AUTO_INCREMENT = 10
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route`
    DISABLE KEYS */;
INSERT INTO `route`
VALUES (1, 'Root', '', true, NULL),
       (2, 'Log-in', 'login', false, 1),
       (3, 'Log-out', 'logout', true, 1),
       (4, 'Dashboard', 'dashboard', true, 1),
       (5, 'News', 'news', true, 1),
       (6, 'Comments', 'comment', true, 1),
       (7, 'Control panel', 'admin', true, 1),
       (8, 'Users', 'users', true, 7),
       (9, 'Analytic', 'stat', true, 7);
/*!40000 ALTER TABLE `route`
    ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `role_route`
--

DROP TABLE IF EXISTS `role_route`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_route`
(
    `role_id`  int unsigned NOT NULL,
    `route_id` int unsigned NOT NULL,
    INDEX role_id_index (role_id),
    FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    INDEX route_id_index (route_id),
    FOREIGN KEY (`route_id`) REFERENCES `route` (`id`)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `role_route` WRITE;
/*!40000 ALTER TABLE `role_route`
    DISABLE KEYS */;
INSERT INTO `role_route`
VALUES (1, 1),
       (1, 2),
       (2, 3),
       (2, 4),
       (2, 5),
       (3, 6),
       (3, 9),
       (4, 7),
       (4, 8),
       (4, 9);
/*!40000 ALTER TABLE `role_route`
    ENABLE KEYS */;
UNLOCK TABLES;



/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2020-09-01 12:55:53
