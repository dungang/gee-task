-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        10.1.19-MariaDB - mariadb.org binary distribution
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.5.0.5338
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;



-- 导出  表 geetask.auth_assignment 结构
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  geetask.auth_assignment 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- 导出  表 geetask.auth_item 结构
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  geetask.auth_item 的数据：~191 rows (大约)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/ac-route/create', 4, 'ac route create', NULL, NULL, 1543224292, 1543224292);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/ac-route/index', 4, 'ac route index', NULL, NULL, 1543224289, 1543224289);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/ac-route/update', 4, 'ac route update', NULL, NULL, 1544087957, 1544087957);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/ac-route/view', 4, 'ac route view', NULL, NULL, 1543224304, 1543224304);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/aliyun-log/default/setting', 4, 'aliyun log default setting', NULL, NULL, 1543812158, 1543812158);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/app-module/index', 4, 'app module index', NULL, NULL, 1543222003, 1543222003);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/app-module/update', 4, 'app module update', NULL, NULL, 1544087093, 1544087093);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/app-module/view', 4, 'app module view', NULL, NULL, 1544087941, 1544087941);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-permission/create', 4, 'auth permission create', NULL, NULL, 1543225416, 1543225416);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-permission/index', 4, 'auth permission index', NULL, NULL, 1543225066, 1543225066);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-permission/update', 4, 'auth permission update', NULL, NULL, 1543310118, 1543310118);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-role/create', 4, 'auth role create', NULL, NULL, 1543387986, 1543387986);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-role/index', 4, 'auth role index', NULL, NULL, 1543225064, 1543225064);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-role/permission', 4, 'auth role permission', NULL, NULL, 1543570277, 1543570277);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-role/update', 4, 'auth role update', NULL, NULL, 1543288315, 1543288315);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-rule/create', 4, 'auth rule create', NULL, NULL, 1543225072, 1543225072);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-rule/index', 4, 'auth rule index', NULL, NULL, 1543225069, 1543225069);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-rule/update', 4, 'auth rule update', NULL, NULL, 1543309941, 1543309941);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/auth-rule/view', 4, 'auth rule view', NULL, NULL, 1543309946, 1543309946);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/backlog/acceptance/create', 4, 'backlog acceptance create', NULL, NULL, 1543457417, 1543457417);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/backlog/acceptance/index', 4, 'backlog acceptance index', NULL, NULL, 1543457223, 1543457223);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/backlog/default/create', 4, 'backlog default create', NULL, NULL, 1543397576, 1543397576);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/backlog/default/index', 4, 'backlog default index', NULL, NULL, 1543397160, 1543397160);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/backlog/default/trans', 4, 'backlog default trans', NULL, NULL, 1544435556, 1544435556);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/backlog/default/view', 4, 'backlog default view', NULL, NULL, 1544435473, 1544435473);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/change/default/create', 4, 'change default create', NULL, NULL, 1543389913, 1543389913);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/change/default/index', 4, 'change default index', NULL, NULL, 1543388974, 1543388974);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/event-handler/create', 4, 'event handler create', NULL, NULL, 1543392895, 1543392895);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/event-handler/index', 4, 'event handler index', NULL, NULL, 1543392890, 1543392890);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/event-handler/update', 4, 'event handler update', NULL, NULL, 1543549693, 1543549693);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/event/create', 4, 'event create', NULL, NULL, 1543370011, 1543370011);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/event/index', 4, 'event index', NULL, NULL, 1543370008, 1543370008);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/event/update', 4, 'event update', NULL, NULL, 1543548211, 1543548211);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/im-robot/create', 4, 'im robot create', NULL, NULL, 1543400043, 1543400043);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/im-robot/index', 4, 'im robot index', NULL, NULL, 1543392062, 1543392062);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/im-robot/update', 4, 'im robot update', NULL, NULL, 1543462272, 1543462272);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/link/default/create', 4, 'link default create', NULL, NULL, 1546506744, 1546506744);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/link/default/index', 4, 'link default index', NULL, NULL, 1546506685, 1546506685);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/link/default/view', 4, 'link default view', NULL, NULL, 1546507350, 1546507350);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/meet/default/create', 4, 'meet default create', NULL, NULL, 1543388471, 1543388471);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/meet/default/delete', 4, 'meet default delete', NULL, NULL, 1543562135, 1543562135);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/meet/default/index', 4, 'meet default index', NULL, NULL, 1543388350, 1543388350);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/meet/default/update', 4, 'meet default update', NULL, NULL, 1543567793, 1543567793);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/meet/default/view', 4, 'meet default view', NULL, NULL, 1543561947, 1543561947);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/member/default/create', 4, 'member default create', NULL, NULL, 1543387712, 1543387712);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/member/default/delete', 4, 'member default delete', NULL, NULL, 1543569831, 1543569831);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/member/default/index', 4, 'member default index', NULL, NULL, 1543387160, 1543387160);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/member/default/update', 4, 'member default update', NULL, NULL, 1543399855, 1543399855);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/member/default/view', 4, 'member default view', NULL, NULL, 1543563100, 1543563100);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/myproject/default/create', 4, 'myproject default create', NULL, NULL, 1543455548, 1543455548);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/myproject/default/index', 4, 'myproject default index', NULL, NULL, 1543455189, 1543455189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/plan/default/index', 4, 'plan default index', NULL, NULL, 1543237893, 1543237893);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/project/create', 4, 'project create', NULL, NULL, 1543239722, 1543239722);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/project/index', 4, 'project index', NULL, NULL, 1543239549, 1543239549);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/project/space', 4, 'project space', NULL, NULL, 1543371051, 1543371051);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/project/update', 4, 'project update', NULL, NULL, 1543310102, 1543310102);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/project/view', 4, 'project view', NULL, NULL, 1543310095, 1543310095);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot-message/create', 4, 'robot message create', NULL, NULL, 1543975504, 1543975504);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot-message/index', 4, 'robot message index', NULL, NULL, 1543392356, 1543392356);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot-message/update', 4, 'robot message update', NULL, NULL, 1543976189, 1543976189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot-message/view', 4, 'robot message view', NULL, NULL, 1543976876, 1543976876);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot/default/create', 4, 'robot default create', NULL, NULL, 1543391518, 1543391518);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot/default/index', 4, 'robot default index', NULL, NULL, 1543391351, 1543391351);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/robot/default/update', 4, 'robot default update', NULL, NULL, 1543462308, 1543462308);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/role/create', 4, 'role create', NULL, NULL, 1543288176, 1543288176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/role/index', 4, 'role index', NULL, NULL, 1543288172, 1543288172);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/role/permission', 4, 'role permission', NULL, NULL, 1543288992, 1543288992);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/role/update', 4, 'role update', NULL, NULL, 1543288233, 1543288233);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/site/index', 4, 'site index', NULL, NULL, 1543207656, 1543207656);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/space/default/create', 4, 'space default create', NULL, NULL, 1543377197, 1543377197);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/space/default/index', 4, 'space default index', NULL, NULL, 1543375474, 1543375474);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/space/default/update', 4, 'space default update', NULL, NULL, 1543477938, 1543477938);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/default/create', 4, 'sprint default create', NULL, NULL, 1543242482, 1543242482);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/default/delete', 4, 'sprint default delete', NULL, NULL, 1543459132, 1543459132);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/default/index', 4, 'sprint default index', NULL, NULL, 1543242478, 1543242478);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/default/update', 4, 'sprint default update', NULL, NULL, 1543415054, 1543415054);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/default/view', 4, 'sprint default view', NULL, NULL, 1543458272, 1543458272);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/story-active/create', 4, 'sprint story active create', NULL, NULL, 1543416108, 1543416108);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/story/create', 4, 'sprint story create', NULL, NULL, 1543399496, 1543399496);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/story/index', 4, 'sprint story index', NULL, NULL, 1543398611, 1543398611);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/story/trans', 4, 'sprint story trans', NULL, NULL, 1543985858, 1543985858);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/story/update', 4, 'sprint story update', NULL, NULL, 1543462511, 1543462511);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/sprint/story/view', 4, 'sprint story view', NULL, NULL, 1543415664, 1543415664);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/story-status/create', 4, 'story status create', NULL, NULL, 1543394955, 1543394955);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/story-status/index', 4, 'story status index', NULL, NULL, 1543394875, 1543394875);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/switch-project/index', 4, 'switch project index', NULL, NULL, 1543370113, 1543370113);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/user/create', 4, 'user create', NULL, NULL, 1543208720, 1543208720);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/user/index', 4, 'user index', NULL, NULL, 1543207762, 1543207762);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/user/role', 4, 'user role', NULL, NULL, 1543207775, 1543207775);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/user/update', 4, 'user update', NULL, NULL, 1543207796, 1543207796);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('/user/view', 4, 'user view', NULL, NULL, 1543209419, 1543209419);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('ac-route', 3, 'ac route', NULL, NULL, 1543224289, 1543224289);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('ac-route-create', 2, 'ac route create', NULL, NULL, 1543224292, 1543224292);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('ac-route-index', 2, 'ac route index', NULL, NULL, 1543224289, 1543224289);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('ac-route-update', 2, 'ac route update', NULL, NULL, 1544087957, 1544087957);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('ac-route-view', 2, 'ac route view', NULL, NULL, 1543224304, 1543224304);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('aliyun-log-default', 3, 'aliyun log default', NULL, NULL, 1543812156, 1543812156);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('aliyun-log-default-setting', 2, 'aliyun log default setting', NULL, NULL, 1543812158, 1543812158);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('aliyun-log-store', 3, 'aliyun log store', NULL, NULL, 1543813263, 1543813263);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('app-module', 3, 'app module', NULL, NULL, 1543222002, 1543222002);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('app-module-index', 2, 'app module index', NULL, NULL, 1543222003, 1543222003);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('app-module-update', 2, 'app module update', NULL, NULL, 1544087093, 1544087093);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('app-module-view', 2, 'app module view', NULL, NULL, 1544087941, 1544087941);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-permission', 3, 'auth permission', NULL, NULL, 1543225066, 1543225066);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-permission-create', 2, 'auth permission create', NULL, NULL, 1543225416, 1543225416);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-permission-index', 2, 'auth permission index', NULL, NULL, 1543225066, 1543225066);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-permission-update', 2, 'auth permission update', NULL, NULL, 1543310118, 1543310118);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-role', 3, 'auth role', NULL, NULL, 1543225064, 1543225064);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-role-create', 2, 'auth role create', NULL, NULL, 1543387986, 1543387986);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-role-index', 2, 'auth role index', NULL, NULL, 1543225064, 1543225064);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-role-permission', 2, 'auth role permission', NULL, NULL, 1543570277, 1543570277);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-role-update', 2, 'auth role update', NULL, NULL, 1543288315, 1543288315);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-rule', 3, 'auth rule', NULL, NULL, 1543225069, 1543225069);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-rule-create', 2, 'auth rule create', NULL, NULL, 1543225072, 1543225072);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-rule-index', 2, 'auth rule index', NULL, NULL, 1543225069, 1543225069);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-rule-update', 2, 'auth rule update', NULL, NULL, 1543309942, 1543309942);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('auth-rule-view', 2, 'auth rule view', NULL, NULL, 1543309946, 1543309946);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-acceptance', 3, 'backlog acceptance', NULL, NULL, 1543457223, 1543457223);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-acceptance-create', 2, 'backlog acceptance create', NULL, NULL, 1543457417, 1543457417);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-acceptance-index', 2, 'backlog acceptance index', NULL, NULL, 1543457223, 1543457223);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-default', 3, 'backlog default', NULL, NULL, 1543397160, 1543397160);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-default-create', 2, 'backlog default create', NULL, NULL, 1543397576, 1543397576);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-default-index', 2, 'backlog default index', NULL, NULL, 1543397160, 1543397160);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-default-trans', 2, 'backlog default trans', NULL, NULL, 1544435556, 1544435556);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('backlog-default-view', 2, 'backlog default view', NULL, NULL, 1544435473, 1544435473);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('change-default', 3, 'change default', NULL, NULL, 1543388974, 1543388974);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('change-default-create', 2, 'change default create', NULL, NULL, 1543389914, 1543389914);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('change-default-index', 2, 'change default index', NULL, NULL, 1543388974, 1543388974);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event', 3, 'event', NULL, NULL, 1543370008, 1543370008);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-create', 2, 'event create', NULL, NULL, 1543370011, 1543370011);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-handler', 3, 'event handler', NULL, NULL, 1543392890, 1543392890);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-handler-create', 2, 'event handler create', NULL, NULL, 1543392895, 1543392895);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-handler-index', 2, 'event handler index', NULL, NULL, 1543392890, 1543392890);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-handler-update', 2, 'event handler update', NULL, NULL, 1543549693, 1543549693);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-index', 2, 'event index', NULL, NULL, 1543370008, 1543370008);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('event-update', 2, 'event update', NULL, NULL, 1543548211, 1543548211);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('im-robot', 3, 'im robot', NULL, NULL, 1543392062, 1543392062);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('im-robot-create', 2, 'im robot create', NULL, NULL, 1543400044, 1543400044);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('im-robot-index', 2, 'im robot index', NULL, NULL, 1543392062, 1543392062);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('im-robot-update', 2, 'im robot update', NULL, NULL, 1543462272, 1543462272);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('link-default', 3, 'link default', NULL, NULL, 1546506685, 1546506685);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('link-default-create', 2, 'link default create', NULL, NULL, 1546506744, 1546506744);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('link-default-index', 2, 'link default index', NULL, NULL, 1546506685, 1546506685);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('link-default-view', 2, 'link default view', NULL, NULL, 1546507350, 1546507350);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('meet-default', 3, 'meet default', NULL, NULL, 1543388350, 1543388350);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('meet-default-create', 2, 'meet default create', NULL, NULL, 1543388471, 1543388471);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('meet-default-delete', 2, 'meet default delete', NULL, NULL, 1543562135, 1543562135);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('meet-default-index', 2, 'meet default index', NULL, NULL, 1543388350, 1543388350);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('meet-default-update', 2, 'meet default update', NULL, NULL, 1543567793, 1543567793);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('meet-default-view', 2, 'meet default view', NULL, NULL, 1543561947, 1543561947);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('member-default', 3, 'member default', NULL, NULL, 1543387160, 1543387160);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('member-default-create', 2, 'member default create', NULL, NULL, 1543387712, 1543387712);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('member-default-delete', 2, 'member default delete', NULL, NULL, 1543569831, 1543569831);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('member-default-index', 2, 'member default index', NULL, NULL, 1543387160, 1543387160);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('member-default-update', 2, 'member default update', NULL, NULL, 1543399855, 1543399855);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('member-default-view', 2, 'member default view', NULL, NULL, 1543563100, 1543563100);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('myproject-default', 3, 'myproject default', NULL, NULL, 1543455189, 1543455189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('myproject-default-create', 2, 'myproject default create', NULL, NULL, 1543455548, 1543455548);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('myproject-default-index', 2, 'myproject default index', NULL, NULL, 1543455189, 1543455189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('plan-default', 3, 'plan default', NULL, NULL, 1543237893, 1543237893);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('plan-default-index', 2, 'plan default index', NULL, NULL, 1543237893, 1543237893);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('project', 3, 'project', NULL, NULL, 1543239549, 1543239549);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('project-create', 2, 'project create', NULL, NULL, 1543239722, 1543239722);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('project-index', 2, 'project index', NULL, NULL, 1543239549, 1543239549);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('project-space', 2, 'project space', NULL, NULL, 1543371051, 1543371051);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('project-update', 2, 'project update', NULL, NULL, 1543310102, 1543310102);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('project-view', 2, 'project view', NULL, NULL, 1543310095, 1543310095);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-default', 3, 'robot default', NULL, NULL, 1543391351, 1543391351);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-default-create', 2, 'robot default create', NULL, NULL, 1543391518, 1543391518);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-default-index', 2, 'robot default index', NULL, NULL, 1543391351, 1543391351);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-default-update', 2, 'robot default update', NULL, NULL, 1543462308, 1543462308);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-message', 3, 'robot message', NULL, NULL, 1543392356, 1543392356);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-message-create', 2, 'robot message create', NULL, NULL, 1543975504, 1543975504);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-message-index', 2, 'robot message index', NULL, NULL, 1543392356, 1543392356);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-message-update', 2, 'robot message update', NULL, NULL, 1543976189, 1543976189);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('robot-message-view', 2, 'robot message view', NULL, NULL, 1543976876, 1543976876);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('role', 3, 'role', NULL, NULL, 1543288172, 1543288172);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('role-create', 2, 'role create', NULL, NULL, 1543288176, 1543288176);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('role-index', 2, 'role index', NULL, NULL, 1543288172, 1543288172);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('role-permission', 2, 'role permission', NULL, NULL, 1543288992, 1543288992);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('role-update', 2, 'role update', NULL, NULL, 1543288233, 1543288233);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('site', 3, 'site', NULL, NULL, 1543207654, 1543207654);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('site-index', 2, 'site index', NULL, NULL, 1543207656, 1543207656);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('space-default', 3, 'space default', NULL, NULL, 1543375474, 1543375474);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('space-default-create', 2, 'space default create', NULL, NULL, 1543377197, 1543377197);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('space-default-index', 2, 'space default index', NULL, NULL, 1543375474, 1543375474);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('space-default-update', 2, 'space default update', NULL, NULL, 1543477938, 1543477938);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-default', 3, 'sprint default', NULL, NULL, 1543242478, 1543242478);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-default-create', 2, 'sprint default create', NULL, NULL, 1543242482, 1543242482);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-default-delete', 2, 'sprint default delete', NULL, NULL, 1543459132, 1543459132);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-default-index', 2, 'sprint default index', NULL, NULL, 1543242478, 1543242478);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-default-update', 2, 'sprint default update', NULL, NULL, 1543415054, 1543415054);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-default-view', 2, 'sprint default view', NULL, NULL, 1543458272, 1543458272);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story', 3, 'sprint story', NULL, NULL, 1543398611, 1543398611);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-active', 3, 'sprint story active', NULL, NULL, 1543416108, 1543416108);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-active-create', 2, 'sprint story active create', NULL, NULL, 1543416108, 1543416108);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-create', 2, 'sprint story create', NULL, NULL, 1543399496, 1543399496);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-index', 2, 'sprint story index', NULL, NULL, 1543398611, 1543398611);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-trans', 2, 'sprint story trans', NULL, NULL, 1543985858, 1543985858);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-update', 2, 'sprint story update', NULL, NULL, 1543462511, 1543462511);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('sprint-story-view', 2, 'sprint story view', NULL, NULL, 1543415664, 1543415664);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('story-status', 3, 'story status', NULL, NULL, 1543394875, 1543394875);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('story-status-create', 2, 'story status create', NULL, NULL, 1543394956, 1543394956);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('story-status-index', 2, 'story status index', NULL, NULL, 1543394875, 1543394875);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('switch-project', 3, 'switch project', NULL, NULL, 1543370113, 1543370113);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('switch-project-index', 2, 'switch project index', NULL, NULL, 1543370113, 1543370113);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('update-my-project', 2, '更新自己的项目', '\\app\\rules\\IsMyProject', NULL, 1543312748, 1543312748);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('user', 3, 'user', NULL, NULL, 1543207753, 1543207753);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('user-create', 2, 'user create', NULL, NULL, 1543208720, 1543208720);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('user-index', 2, 'user index', NULL, NULL, 1543207762, 1543207762);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('user-role', 2, 'user role', NULL, NULL, 1543207775, 1543207775);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('user-update', 2, 'user update', NULL, NULL, 1543207796, 1543207796);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('user-view', 2, 'user view', NULL, NULL, 1543209419, 1543209419);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('开发人员', 1, NULL, NULL, NULL, 1543562615, 1543562615);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('敏捷教练', 1, NULL, NULL, NULL, 1543562548, 1543562548);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('管理员1', 1, '', NULL, NULL, 1543288187, 1543288472);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('部门负责人', 1, 'deparment charge', NULL, NULL, 1543218870, 1543218975);
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('项目负责人', 1, NULL, NULL, NULL, 1543388020, 1543388020);

/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- 导出  表 geetask.auth_item_child 结构
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  geetask.auth_item_child 的数据：~323 rows (大约)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', '/ac-route/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', '/ac-route/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', '/ac-route/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', '/ac-route/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', 'ac-route-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', 'ac-route-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', 'ac-route-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route', 'ac-route-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route-create', '/ac-route/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route-index', '/ac-route/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route-update', '/ac-route/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('ac-route-view', '/ac-route/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('aliyun-log-default', '/aliyun-log/default/setting');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('aliyun-log-default', 'aliyun-log-default-setting');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('aliyun-log-default-setting', '/aliyun-log/default/setting');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module', '/app-module/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module', '/app-module/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module', '/app-module/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module', 'app-module-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module', 'app-module-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module', 'app-module-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module-index', '/app-module/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module-update', '/app-module/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('app-module-view', '/app-module/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission', '/auth-permission/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission', '/auth-permission/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission', '/auth-permission/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission', 'auth-permission-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission', 'auth-permission-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission', 'auth-permission-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission-create', '/auth-permission/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission-index', '/auth-permission/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-permission-update', '/auth-permission/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', '/auth-role/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', '/auth-role/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', '/auth-role/permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', '/auth-role/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', 'auth-role-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', 'auth-role-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', 'auth-role-permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role', 'auth-role-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role-create', '/auth-role/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role-index', '/auth-role/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role-permission', '/auth-role/permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-role-update', '/auth-role/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', '/auth-rule/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', '/auth-rule/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', '/auth-rule/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', '/auth-rule/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', 'auth-rule-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', 'auth-rule-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', 'auth-rule-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule', 'auth-rule-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule-create', '/auth-rule/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule-index', '/auth-rule/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule-update', '/auth-rule/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('auth-rule-view', '/auth-rule/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-acceptance', '/backlog/acceptance/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-acceptance', '/backlog/acceptance/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-acceptance', 'backlog-acceptance-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-acceptance', 'backlog-acceptance-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-acceptance-create', '/backlog/acceptance/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-acceptance-index', '/backlog/acceptance/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', '/backlog/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', '/backlog/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', '/backlog/default/trans');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', '/backlog/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', 'backlog-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', 'backlog-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', 'backlog-default-trans');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default', 'backlog-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default-create', '/backlog/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default-index', '/backlog/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default-trans', '/backlog/default/trans');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('backlog-default-view', '/backlog/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('change-default', '/change/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('change-default', '/change/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('change-default', 'change-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('change-default', 'change-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('change-default-create', '/change/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('change-default-index', '/change/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event', '/event/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event', '/event/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event', '/event/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event', 'event-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event', 'event-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event', 'event-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-create', '/event/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler', '/event-handler/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler', '/event-handler/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler', '/event-handler/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler', 'event-handler-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler', 'event-handler-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler', 'event-handler-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler-create', '/event-handler/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler-index', '/event-handler/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-handler-update', '/event-handler/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-index', '/event/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('event-update', '/event/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot', '/im-robot/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot', '/im-robot/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot', '/im-robot/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot', 'im-robot-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot', 'im-robot-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot', 'im-robot-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot-create', '/im-robot/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot-index', '/im-robot/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('im-robot-update', '/im-robot/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default', '/link/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default', '/link/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default', '/link/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default', 'link-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default', 'link-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default', 'link-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default-create', '/link/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default-index', '/link/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('link-default-view', '/link/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', '/meet/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', '/meet/default/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', '/meet/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', '/meet/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', '/meet/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', 'meet-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', 'meet-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', 'meet-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', 'meet-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default', 'meet-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default-create', '/meet/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default-delete', '/meet/default/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default-index', '/meet/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default-update', '/meet/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('meet-default-view', '/meet/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', '/member/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', '/member/default/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', '/member/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', '/member/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', '/member/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', 'member-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', 'member-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', 'member-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', 'member-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default', 'member-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default-create', '/member/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default-delete', '/member/default/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default-index', '/member/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default-update', '/member/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('member-default-view', '/member/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('myproject-default', '/myproject/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('myproject-default', '/myproject/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('myproject-default', 'myproject-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('myproject-default', 'myproject-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('myproject-default-create', '/myproject/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('myproject-default-index', '/myproject/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('plan-default', '/plan/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('plan-default', 'plan-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('plan-default-index', '/plan/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', '/project/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', '/project/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', '/project/space');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', '/project/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', '/project/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', 'project-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', 'project-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', 'project-space');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', 'project-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project', 'project-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project-create', '/project/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project-index', '/project/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project-space', '/project/space');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project-update', '/project/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('project-view', '/project/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default', '/robot/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default', '/robot/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default', '/robot/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default', 'robot-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default', 'robot-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default', 'robot-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default-create', '/robot/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default-index', '/robot/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-default-update', '/robot/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', '/robot-message/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', '/robot-message/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', '/robot-message/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', '/robot-message/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', 'robot-message-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', 'robot-message-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', 'robot-message-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message', 'robot-message-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message-create', '/robot-message/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message-index', '/robot-message/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message-update', '/robot-message/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('robot-message-view', '/robot-message/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', '/role/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', '/role/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', '/role/permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', '/role/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', 'role-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', 'role-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', 'role-permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role', 'role-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role-create', '/role/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role-index', '/role/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role-permission', '/role/permission');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('role-update', '/role/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('site', '/site/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('site', 'site-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('site-index', '/site/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default', '/space/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default', '/space/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default', '/space/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default', 'space-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default', 'space-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default', 'space-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default-create', '/space/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default-index', '/space/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('space-default-update', '/space/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', '/sprint/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', '/sprint/default/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', '/sprint/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', '/sprint/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', '/sprint/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', 'sprint-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', 'sprint-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', 'sprint-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', 'sprint-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default', 'sprint-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default-create', '/sprint/default/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default-delete', '/sprint/default/delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default-index', '/sprint/default/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default-update', '/sprint/default/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-default-view', '/sprint/default/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', '/sprint/story/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', '/sprint/story/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', '/sprint/story/trans');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', '/sprint/story/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', '/sprint/story/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', 'sprint-story-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', 'sprint-story-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', 'sprint-story-trans');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', 'sprint-story-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story', 'sprint-story-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-active', '/sprint/story-active/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-active', 'sprint-story-active-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-active-create', '/sprint/story-active/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-create', '/sprint/story/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-index', '/sprint/story/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-trans', '/sprint/story/trans');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-update', '/sprint/story/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('sprint-story-view', '/sprint/story/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('story-status', '/story-status/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('story-status', '/story-status/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('story-status', 'story-status-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('story-status', 'story-status-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('story-status-create', '/story-status/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('story-status-index', '/story-status/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('switch-project', '/switch-project/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('switch-project', 'switch-project-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('switch-project-index', '/switch-project/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('update-my-project', 'project-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', '/user/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', '/user/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', '/user/role');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', '/user/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', '/user/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', 'user-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', 'user-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', 'user-role');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', 'user-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user', 'user-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user-create', '/user/create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user-index', '/user/index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user-role', '/user/role');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user-update', '/user/update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('user-view', '/user/view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'meet-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'meet-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'meet-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'meet-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'meet-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'myproject-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'myproject-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'space-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-story-active-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-story-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-story-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-story-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('开发人员', 'sprint-story-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'backlog-acceptance-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'backlog-acceptance-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'backlog-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'backlog-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'change-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'change-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'meet-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'meet-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'meet-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'meet-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'meet-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'member-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'member-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'member-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'member-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'member-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'myproject-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'myproject-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'robot-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'robot-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'robot-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'space-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'space-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'space-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-story-active-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-story-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-story-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-story-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('敏捷教练', 'sprint-story-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'backlog-acceptance-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'backlog-acceptance-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'backlog-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'backlog-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'change-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'change-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'meet-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'meet-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'meet-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'meet-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'meet-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'member-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'member-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'member-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'member-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'member-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'myproject-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'myproject-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'robot-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'robot-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'robot-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'space-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'space-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'space-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-default-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-default-delete');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-default-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-default-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-default-view');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-story-active-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-story-create');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-story-index');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-story-update');
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES ('项目负责人', 'sprint-story-view');

/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- 导出  表 geetask.auth_rule 结构
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  geetask.auth_rule 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
	('\\app\\rules\\IsMyProject', _binary 0x4F3A32313A226170705C72756C65735C49734D7950726F6A656374223A333A7B733A343A226E616D65223B733A32323A225C6170705C72756C65735C49734D7950726F6A656374223B733A393A22637265617465644174223B693A313534333330393933353B733A393A22757064617465644174223B693A313534333330393933353B7D, 1543309935, 1543309935);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- 导出  表 geetask.gt_aliyun_log 结构
CREATE TABLE IF NOT EXISTS `gt_aliyun_log` (
  `project_id` int(11) NOT NULL COMMENT '项目',
  `endpoint` varchar(64) NOT NULL,
  `access_key` varchar(64) NOT NULL,
  `secret_key` varchar(64) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='阿里云日志';


-- 导出  表 geetask.gt_change 结构
CREATE TABLE IF NOT EXISTS `gt_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `category_id` int(11) NOT NULL COMMENT '分类',
  `creator_id` int(11) NOT NULL COMMENT '创建人',
  `content` text COMMENT '内容',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COMMENT='变更';



-- 导出  表 geetask.gt_change_category 结构
CREATE TABLE IF NOT EXISTS `gt_change_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='变更分类';

-- 正在导出表  geetask.gt_change_category 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `gt_change_category` DISABLE KEYS */;
INSERT INTO `gt_change_category` (`id`, `name`) VALUES
	(1, 'SQL');
/*!40000 ALTER TABLE `gt_change_category` ENABLE KEYS */;

-- 导出  表 geetask.gt_event 结构
CREATE TABLE IF NOT EXISTS `gt_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `code` varchar(64) NOT NULL COMMENT '编码',
  `intro` varchar(255) DEFAULT NULL COMMENT '介绍',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='事件';

-- 正在导出表  geetask.gt_event 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `gt_event` DISABLE KEYS */;
INSERT INTO `gt_event` (`id`, `created_at`, `updated_at`, `name`, `code`, `intro`) VALUES
	(1, 1543392882, 1543548341, '添加新的故事', 'sprint.story.create', '在迭代计划中添加新的故事'),
	(2, 1543548739, 1543551967, '更新故事', 'sprint.story.change', '在迭代计划中通过修改状态或者指派新的处理');
/*!40000 ALTER TABLE `gt_event` ENABLE KEYS */;

-- 导出  表 geetask.gt_event_handler 结构
CREATE TABLE IF NOT EXISTS `gt_event_handler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL COMMENT '事件',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `handler` varchar(128) NOT NULL COMMENT '处理器',
  `intro` varchar(255) DEFAULT NULL COMMENT '介绍',
  PRIMARY KEY (`id`),
  UNIQUE KEY `handler` (`handler`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='事件处理器';

-- 正在导出表  geetask.gt_event_handler 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `gt_event_handler` DISABLE KEYS */;
INSERT INTO `gt_event_handler` (`id`, `event_id`, `created_at`, `updated_at`, `name`, `handler`, `intro`) VALUES
	(1, 1, 1543462486, 1543549720, '发送机器人消息', '\\modules\\sprint\\handlers\\OnCreateStorySendMessageHandler', '发送标题消息'),
	(2, 2, 1543549761, 1543551513, '发送机器人消息', '\\modules\\sprint\\handlers\\OnChangeStorySendMessageHandler', '发送标题消息');
/*!40000 ALTER TABLE `gt_event_handler` ENABLE KEYS */;

-- 导出  表 geetask.gt_meet 结构
CREATE TABLE IF NOT EXISTS `gt_meet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `actors` text NOT NULL COMMENT '参会人',
  `meet_date` date NOT NULL COMMENT '日期',
  `creator_id` int(11) NOT NULL COMMENT '记录人',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `title` varchar(128) NOT NULL COMMENT '议题',
  `content` text NOT NULL COMMENT '内容',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COMMENT='会议';

-- 正在导出表  geetask.gt_meet 的数据：~47 rows (大约)
/*!40000 ALTER TABLE `gt_meet` DISABLE KEYS */;
INSERT INTO `gt_meet` (`id`, `project_id`, `actors`, `meet_date`, `creator_id`, `created_at`, `updated_at`, `title`, `content`, `is_del`) VALUES
	(47, 1, '钱攀，章宇飞，俞栋炜，顿刚', '2018-11-30', 1, 1543567773, 1543567843, '🎥回顾会议', '<p>1.hotelswtich的外部数据产生的日志不纳入到分布式事务中</p><p>2.NDAswitch当中不用加入分布事务</p><p>3.roomplan服务测试分布事务，特别是sql语句的改造</p><p>4.特别注意：sharding-jdbc 支持批量插入，不支持批量更新操作</p><p>5.服务升级需要升级版本号，解决无缝发布系统的问题</p><p>6.待处理问题 ： 提供酒店图片<br></p><p><br></p>', 0);
/*!40000 ALTER TABLE `gt_meet` ENABLE KEYS */;

-- 导出  表 geetask.gt_project 结构
CREATE TABLE IF NOT EXISTS `gt_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '名称',
  `web_site` varchar(128) DEFAULT NULL COMMENT '官网',
  `is_achived` tinyint(1) NOT NULL DEFAULT '0' COMMENT '归档',
  `creator_id` int(11) NOT NULL COMMENT '创始人',
  `created_at` int(11) DEFAULT NULL COMMENT '添加日期',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新日期',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_project_user_idx` (`creator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='项目';

-- 正在导出表  geetask.gt_project 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `gt_project` DISABLE KEYS */;
INSERT INTO `gt_project` (`id`, `name`, `web_site`, `is_achived`, `creator_id`, `created_at`, `updated_at`, `is_del`) VALUES
	(1, 'NDA', 'http://www.ndabooking.com', 0, 1, 1543371042, 1543371042, 0);
/*!40000 ALTER TABLE `gt_project` ENABLE KEYS */;

-- 导出  表 geetask.gt_project_member 结构
CREATE TABLE IF NOT EXISTS `gt_project_member` (
  `project_id` int(11) NOT NULL COMMENT '项目',
  `user_id` int(11) NOT NULL COMMENT '成员',
  `position` varchar(64) NOT NULL COMMENT '岗位',
  PRIMARY KEY (`project_id`,`user_id`),
  KEY `fk_project_mem_pid` (`project_id`),
  KEY `fk_project_mem_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='项目成员';

-- 正在导出表  geetask.gt_project_member 的数据：~9 rows (大约)
/*!40000 ALTER TABLE `gt_project_member` DISABLE KEYS */;
INSERT INTO `gt_project_member` (`project_id`, `user_id`, `position`) VALUES
	(1, 1, '项目负责人'),
	(1, 2, '敏捷教练'),
	(1, 3, '开发人员'),
	(1, 5, '开发人员'),
	(1, 6, '项目负责人'),
	(1, 11, '项目负责人'),
	(1, 12, '项目负责人'),
	(1, 14, '开发人员'),
	(1, 15, '项目负责人');
/*!40000 ALTER TABLE `gt_project_member` ENABLE KEYS */;

-- 导出  表 geetask.gt_project_robot 结构
CREATE TABLE IF NOT EXISTS `gt_project_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `robot_id` int(11) NOT NULL COMMENT '机器人',
  `project_id` int(11) NOT NULL COMMENT '项目',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `name` varchar(64) DEFAULT NULL COMMENT '机器人名称',
  `webhook` varchar(255) DEFAULT NULL COMMENT '通知地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='项目机器人';

-- 正在导出表  geetask.gt_project_robot 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `gt_project_robot` DISABLE KEYS */;
INSERT INTO `gt_project_robot` (`id`, `robot_id`, `project_id`, `created_at`, `updated_at`, `name`, `webhook`) VALUES
	(1, 1, 1, 1543400237, 1543990884, '项目鼓励师', 'https://oapi.dingtalk.com/robot/send?access_token=a5a2347f4524e93eb06f2a7aa806914c7202078ff07bc0395139325a24ed3262');
/*!40000 ALTER TABLE `gt_project_robot` ENABLE KEYS */;

-- 导出  表 geetask.gt_robot 结构
CREATE TABLE IF NOT EXISTS `gt_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `name` varchar(64) DEFAULT NULL COMMENT '名称',
  `code_full_class` varchar(128) DEFAULT NULL COMMENT '代码类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='即时机器人';

-- 正在导出表  geetask.gt_robot 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `gt_robot` DISABLE KEYS */;
INSERT INTO `gt_robot` (`id`, `created_at`, `updated_at`, `name`, `code_full_class`) VALUES
	(1, 1543400079, 1543462291, '钉钉', '\\app\\robots\\DingTalkRobot');
/*!40000 ALTER TABLE `gt_robot` ENABLE KEYS */;

-- 导出  表 geetask.gt_robot_message 结构
CREATE TABLE IF NOT EXISTS `gt_robot_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) DEFAULT NULL COMMENT '消息代号',
  `name` varchar(64) DEFAULT NULL COMMENT '消息名称',
  `msg_subject` varchar(255) DEFAULT NULL COMMENT '消息主题',
  `subject_vars` varchar(255) DEFAULT NULL COMMENT '主题变量',
  `msg_body` text COMMENT '消息内容',
  `body_vars` varchar(255) DEFAULT NULL COMMENT '内容变量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='机器人消息';

-- 正在导出表  geetask.gt_robot_message 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `gt_robot_message` DISABLE KEYS */;
INSERT INTO `gt_robot_message` (`id`, `code`, `name`, `msg_subject`, `subject_vars`, `msg_body`, `body_vars`) VALUES
	(1, 'OnChangeStoryInSprint', '修改迭代中的用户故事的时候', '{user.nick_name} -> 才更新了用户故事#{story.id}🎉🎉🎉', '{user.nick_name},{story.id},{story.name},{story.status},{story.user}', '> **处理人:** {story.user}\r\n> **状态:** {story.old_status} -> {story.status}\r\n> **内容:** {story.name}\r\n> **备注:** {story.remark}\r\n> ❤❤❤\r\n\r\n\r\n', '{story.id},{story.name},{story.status},{story.user},{story.remark}'),
	(2, 'OnCreateStoryInSprint', '添加迭代中的用户故事的时候', '{user.nick_name} -> 才添加了用户故事#{story.id}🎉🎉🎉', '{user.nick_name},{story.id},{story.name},{story.status},{story.user}', '> **处理人:** {story.user}\r\n> **内容:** {story.name}\r\n> ❤❤❤', '{story.id},{story.name},{story.status},{story.user}');
/*!40000 ALTER TABLE `gt_robot_message` ENABLE KEYS */;

-- 导出  表 geetask.gt_role 结构
CREATE TABLE IF NOT EXISTS `gt_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '名称',
  `scope` enum('ADMIN','POSITION') NOT NULL DEFAULT 'ADMIN' COMMENT '范围',
  `description` varchar(255) NOT NULL COMMENT '说明',
  `is_sys` tinyint(1) DEFAULT '1' COMMENT '系统内置',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='积分';

-- 正在导出表  geetask.gt_role 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `gt_role` DISABLE KEYS */;
INSERT INTO `gt_role` (`id`, `name`, `scope`, `description`, `is_sys`) VALUES
	(1, '管理员1', 'ADMIN', '', NULL),
	(2, '项目负责人', 'POSITION', 'product owner', 1),
	(3, '敏捷教练', 'POSITION', 'project master', 1),
	(4, '开发人员', 'POSITION', 'developer', 1);
/*!40000 ALTER TABLE `gt_role` ENABLE KEYS */;

-- 导出  表 geetask.gt_setting 结构
CREATE TABLE IF NOT EXISTS `gt_setting` (
  `name` varchar(64) NOT NULL COMMENT '名称',
  `title` varchar(64) NOT NULL COMMENT '标题',
  `value` text COMMENT '值',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统设置';

-- 正在导出表  geetask.gt_setting 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `gt_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `gt_setting` ENABLE KEYS */;

-- 导出  表 geetask.gt_sprint 结构
CREATE TABLE IF NOT EXISTS `gt_sprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `status` enum('todo','doing','done') NOT NULL DEFAULT 'todo' COMMENT '状态',
  `start_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `name` varchar(128) DEFAULT NULL COMMENT '名称',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COMMENT='迭代计划';

-- 正在导出表  geetask.gt_sprint 的数据：~36 rows (大约)
/*!40000 ALTER TABLE `gt_sprint` DISABLE KEYS */;
INSERT INTO `gt_sprint` (`id`, `project_id`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`, `name`, `is_del`) VALUES
	(1, 1, 'done', '2018-06-05', '2018-06-05', 1527735186, 1528426290, 'dev4supplier', 0),
	(2, 1, 'done', NULL, NULL, 1527735545, 1529459427, 'fixbug20180528', 0),
	(3, 1, 'done', '2018-06-15', '2018-06-15', 1527750115, 1530067935, 'dev4api20180528(api第二期)', 0),
	(5, 1, 'done', NULL, NULL, 1527752414, 1528970545, 'dev-spider', 0),
	(6, 1, 'done', NULL, NULL, 1527814670, 1531819779, 'dev-ndaswitch', 0),
	(7, 1, 'done', NULL, NULL, 1528182413, 1528182413, '酒店端UI1.0', 0),
	(8, 1, 'done', NULL, NULL, 1528266351, 1529026496, 'dev4message20180606(一期)', 0),
	(9, 1, 'done', '2018-06-07', '2018-06-07', 1528426172, 1528426274, 'fixbug4orderId', 0),
	(10, 1, 'done', NULL, '2018-06-15', 1528684885, 1530670242, 'fixbug4orderId（第二版）', 0),
	(11, 1, 'done', '2018-06-25', '2018-06-19', 1528941686, 1530064134, 'fixbug20180614', 0),
	(12, 1, 'done', NULL, NULL, 1529026427, 1530842950, 'dev-api-1.0', 0),
	(13, 1, 'done', NULL, NULL, 1529026461, 1529026461, 'dev4message二期', 0),
	(14, 1, 'done', NULL, NULL, 1529459716, 1531453282, 'fixbug20180620', 0),
	(15, 1, 'done', NULL, NULL, 1529919526, 1531789733, 'dev4userdefinechannel(该版本废弃)', 0),
	(16, 1, 'done', NULL, NULL, 1530241378, 1531985850, 'devmenu2', 0),
	(17, 1, 'done', NULL, NULL, 1530583615, 1532510397, 'fixbug20180703', 0),
	(18, 1, 'done', NULL, NULL, 1531281829, 1531985894, 'dev4udc', 0),
	(19, 1, 'done', NULL, NULL, 1531359153, 1532584197, 'fixbug20180712', 0),
	(20, 1, 'done', NULL, NULL, 1531452927, 1533008589, 'dev4inviteta', 0),
	(21, 1, 'done', NULL, NULL, 1531705854, 1531705854, 'dev4logopt', 0),
	(22, 1, 'done', NULL, NULL, 1531799438, 1532049702, 'dev4id', 0),
	(23, 1, 'done', NULL, NULL, 1531902315, 1531902315, 'dev4licenceaudit', 0),
	(24, 1, 'done', NULL, NULL, 1531987515, 1533287023, 'dev4combineHC', 0),
	(25, 1, 'done', NULL, NULL, 1531990758, 1533287071, 'dev4combineUser', 0),
	(26, 1, 'done', NULL, NULL, 1532049854, 1532510427, 'dev4licenceaudit', 0),
	(27, 1, 'done', NULL, NULL, 1532050762, 1532050762, 'fixbug20180720', 0),
	(28, 1, 'done', NULL, NULL, 1532310821, 1533008621, 'dev4hTest', 0),
	(29, 1, 'done', NULL, NULL, 1532589491, 1532589491, 'fixbug20180726', 0),
	(30, 1, 'done', '2018-08-04', '2018-08-05', 1532941988, 1532941988, 'dev4tapi', 0),
	(31, 1, 'done', NULL, NULL, 1533817574, 1533817574, '从渠道API同步酒店静态数据', 0),
	(32, 1, 'done', NULL, NULL, 1534146582, 1535335764, 'dev4hotelpolicy', 0),
	(33, 1, 'done', NULL, NULL, 1534383463, 1534384547, '飞猪店铺接口计划(dev4feizhuhotel)', 0),
	(34, 1, 'done', NULL, NULL, 1534753384, 1534753384, 'fang_cang_api', 0),
	(35, 1, 'done', NULL, NULL, 1537942640, 1537942640, '畅联对接', 0),
	(36, 1, 'doing', NULL, '2018-10-26', 1540180279, 1543714379, 'dev4roomtag', 0),
	(37, 1, 'done', NULL, NULL, 1540809070, 1542010574, 'dev4wxlogin', 0);
/*!40000 ALTER TABLE `gt_sprint` ENABLE KEYS */;

-- 导出  表 geetask.gt_story 结构
CREATE TABLE IF NOT EXISTS `gt_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprint_id` int(11) NOT NULL DEFAULT '0' COMMENT '计划',
  `story_type` varchar(32) NOT NULL DEFAULT 'bug' COMMENT '类型',
  `status` int(11) NOT NULL COMMENT '状态',
  `important` smallint(6) NOT NULL DEFAULT '0' COMMENT '优先程度',
  `points` float NOT NULL DEFAULT '1' COMMENT '故事点',
  `project_id` int(11) NOT NULL COMMENT '项目',
  `user_id` int(11) NOT NULL COMMENT '处理人',
  `last_user_id` int(11) DEFAULT NULL COMMENT '更新者',
  `creator_id` int(11) NOT NULL COMMENT '创建者',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `name` varchar(128) DEFAULT NULL COMMENT '名称',
  `project_version` varchar(32) DEFAULT NULL COMMENT '版本',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `task_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=410 DEFAULT CHARSET=utf8mb4 COMMENT='用户故事';

-- 正在导出表  geetask.gt_story 的数据：~407 rows (大约)
/*!40000 ALTER TABLE `gt_story` DISABLE KEYS */;
INSERT INTO `gt_story` (`id`, `sprint_id`, `story_type`, `status`, `important`, `points`, `project_id`, `user_id`, `last_user_id`, `creator_id`, `created_at`, `updated_at`, `name`, `project_version`, `is_del`) VALUES
	(1, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527735321, 1529395842, '酒店浏览后没记录到历史记录没有记录', NULL, 0),
	(2, 1, 'requirement', 11, 100, 1, 1, 6, 9, 1, 1527735441, 1527843964, '【平台端】测试账号的权限没有生效', NULL, 0),
	(3, 2, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1527735526, 1528941738, '渠道类型编辑填写排序异常', NULL, 0),
	(4, 1, 'requirement', 11, 100, 1, 1, 7, 9, 1, 1527735633, 1528094888, '房价无效【预定按钮】未变灰', NULL, 0),
	(5, 1, 'requirement', 11, 100, 1, 1, 9, 9, 1, 1527736106, 1527836262, '酒店与分销显示的政策不一致', NULL, 0),
	(6, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527736265, 1529396497, '修改晚数后预定政策没有变化', NULL, 0),
	(7, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527736443, 1528088859, '订单待处理通知提示的数量不正确', NULL, 0),
	(8, 1, 'requirement', 11, 100, 1, 1, 4, 9, 1, 1527747672, 1527848363, '酒店端集团帐号下仍切换关联状态为无效的酒店', NULL, 0),
	(9, 1, 'requirement', 11, 100, 1, 1, 6, 9, 1, 1527747695, 1528081656, '酒店端集团帐号下库存管理中应隐藏房型修改功能', NULL, 0),
	(10, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527747714, 1527847679, '酒店集团帐号首次登录没有提示绑定手机号', NULL, 0),
	(11, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747737, 1527847592, '集团房型售出佣金结算在单体酒店中', NULL, 0),
	(12, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747760, 1528081744, 'api对接订单出现空指针', NULL, 0),
	(13, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527747790, 1527846894, '供应商管理中搜索框名称错误', NULL, 0),
	(14, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747809, 1527847022, ' api对接使用支付宝支付出现空指针', NULL, 0),
	(15, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747828, 1527846237, ' 分销取消订单后，支付宝支付退款显示错误', NULL, 0),
	(16, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747846, 1527845677, 'api对接预付订单使用支付宝支付后取消未退款', NULL, 0),
	(17, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747871, 1527846067, ' 分销商预定免担保订单提交成功后订单状态未改变', NULL, 0),
	(18, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747895, 1527846536, 'api对接提交现付订单出现空指针', NULL, 0),
	(19, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747915, 1528081726, ' api对接使用支付宝支付出现空指针', NULL, 0),
	(20, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747931, 1527847283, ' 分销商取消订单后，供应商后台没有相应确认取消单动作', NULL, 0),
	(21, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747962, 1528094691, 'api对接，接口确认后。酒店端锁定允许取消修改按钮未消失', NULL, 0),
	(22, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527747980, 1528094535, ' api对接过取消时间，取消按钮未消失', NULL, 0),
	(23, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527748007, 1527847385, '集团酒店帐号下全部订单中需要增加酒店名称一栏', NULL, 0),
	(24, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527748028, 1527847892, '酒店端集团帐号下应隐藏酒店维护导航页', NULL, 0),
	(25, 1, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1527748049, 1528165953, '拆分对接hotelswitch的数据项目nda-switch', NULL, 0),
	(26, 1, 'requirement', 11, 100, 1, 1, 4, 9, 1, 1527748066, 1527846136, '分销端接收的供应商发送的账单，酒店名称显示错误', NULL, 0),
	(27, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527748087, 1527843565, '单体酒店的级别管理中出现了供应商提供的房型', NULL, 0),
	(28, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527748110, 1528095614, 'api预付下单后页面报错', NULL, 0),
	(29, 2, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1527749258, 1528959218, '房型宽带信息展示问题', NULL, 0),
	(30, 27, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1527749520, 1532661696, '关闭对话框刷新页面', NULL, 0),
	(31, 2, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1527749538, 1528944024, '增加支付类型', NULL, 0),
	(32, 11, 'requirement', 11, 100, 1, 1, 7, 12, 1, 1527749565, 1529982406, '新增酒店点击两次添加，出现重复酒店', NULL, 0),
	(33, 2, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1527749586, 1528943078, '酒店ID和酒店名称位置不统一', NULL, 0),
	(34, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1527749603, 1529982676, '【管理后台】将酒店信息管理页的“提交审核”剔除', NULL, 0),
	(35, 2, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1527749618, 1528944121, '房型默认项改为“有效”', NULL, 0),
	(36, 11, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1527749640, 1529983981, '酒店信息提交后页面未跳转', NULL, 0),
	(37, 2, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1527749656, 1528944289, '可点击的按钮不明显', NULL, 0),
	(38, 2, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1527749680, 1528944410, '提交审核”按钮更改为“确认修改”', NULL, 0),
	(39, 2, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1527749695, 1528944503, '房型信息展示不完整', NULL, 0),
	(40, 2, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1527749711, 1529391822, '星级显示有问题', NULL, 0),
	(41, 2, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1527749726, 1528943488, '更改类目', NULL, 0),
	(42, 2, 'requirement', 11, 100, 1, 1, 7, 6, 1, 1527749745, 1529391917, '没选床型，提交后增加提醒框', NULL, 0),
	(43, 2, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1527749784, 1528943925, '酒店在修改证明图片时，刷新后不知道是否上传成功，优化加个文字提示', NULL, 0),
	(44, 2, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1527749804, 1528946500, '务板块中编辑按钮会有歧义', NULL, 0),
	(45, 2, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1527749823, 1528955528, '英文名称输入英文和空格，保存时提示应为名称只能输入英文和特殊符号', NULL, 0),
	(46, 2, 'requirement', 11, 100, 1, 1, 3, 12, 1, 1527749855, 1528956733, '最少起订间数提示不具体', NULL, 0),
	(47, 2, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1527749871, 1528942844, '返佣设置未填保存，原有数据被覆盖', NULL, 0),
	(48, 11, 'requirement', 11, 100, 1, 1, 7, 12, 1, 1527749887, 1530001800, '平台端维护酒店图片时无法批量上传', NULL, 0),
	(49, 11, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1527749915, 1530001834, '平台端维护酒店图片时无法批量上传', NULL, 0),
	(50, 2, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1527749938, 1528959252, ' 管理后台酒店基础信息维护模块文字错误', NULL, 0),
	(51, 2, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1527749962, 1528941858, ' 文字不统一，且缺少内容', NULL, 0),
	(52, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1527749982, 1529983448, ' 系统设置中字典管理导航标签展示内容错误', NULL, 0),
	(53, 2, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1527749999, 1528946377, ' 异常订单查看', NULL, 0),
	(54, 14, 'requirement', 11, 100, 1, 1, 7, 6, 1, 1527750014, 1531291676, '订单接受后未消失', NULL, 0),
	(55, 2, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1527750033, 1528947410, '添加默认主图', NULL, 0),
	(56, 2, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1527750045, 1528942015, ' 按区域搜索酒店后，分页标签摆放位置问题', NULL, 0),
	(57, 2, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1527750063, 1528943938, '点击营业执照加载不出', NULL, 0),
	(58, 3, 'requirement', 11, 100, 1, 1, 13, 9, 1, 1527750143, 1529052847, 'API-酒店绑定API类型', NULL, 0),
	(59, 3, 'requirement', 11, 100, 1, 1, 13, 9, 1, 1527750158, 1529052872, 'API-酒店开启同步或者停止', NULL, 0),
	(60, 3, 'requirement', 11, 100, 1, 1, 13, 9, 1, 1527750174, 1529052767, 'API-根据酒店编码+API类型，查询物理房型', NULL, 0),
	(61, 3, 'requirement', 11, 100, 1, 1, 13, 9, 1, 1527750189, 1529052687, 'API-根据物理房型的Id+API类型，查询销售房型', NULL, 0),
	(62, 3, 'requirement', 11, 100, 1, 1, 13, 9, 1, 1527750212, 1529052936, 'API-查询支持的所有API类型+API提供额介绍', NULL, 0),
	(63, 3, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527750228, 1529052581, '设计酒店API的映射（多对多），是否绑定，是否同步', NULL, 0),
	(64, 3, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527750240, 1529052527, '设计酒店物理房型和API对应的物理房型的关系（多对多）', NULL, 0),
	(65, 3, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527750259, 1529051791, '通过API接口来更新APIType的值', NULL, 0),
	(66, 3, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527750273, 1529049961, '供应商数据同步管理', NULL, 0),
	(67, 3, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527750288, 1529027767, '根据API类型列出注册的酒店（管理绑定，同步开启）排除集团账号', NULL, 0),
	(68, 3, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527750315, 1529026268, '物理房型新增匹配', NULL, 0),
	(69, 3, 'requirement', 11, 100, 1, 1, 14, 9, 1, 1527750336, 1529050020, '销售房型新增匹配', NULL, 0),
	(70, 3, 'requirement', 11, 100, 1, 1, 14, 9, 1, 1527750352, 1528956658, '屏蔽（酒店屏蔽分销商）', NULL, 0),
	(71, 14, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1527750366, 1531291343, '酒店端基础信息中增加撤销星级功能按钮', NULL, 0),
	(72, 5, 'requirement', 11, 100, 1, 1, 4, 1, 1, 1527752481, 1528020966, '设计数据模型', NULL, 0),
	(73, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1527752501, 1527846043, '系统管理员登录功能（管理后台）', NULL, 0),
	(74, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1527752519, 1527846062, '抓取携程酒店静态数据（管理后台）', NULL, 0),
	(75, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1527752533, 1527846091, '外网酒店静态数据转化成NDA格式的数据（管理后台）', NULL, 0),
	(76, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1527752547, 1527846108, '查询酒店的静态信息API（json）', NULL, 0),
	(77, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1527752562, 1527846124, '根据数据来源分页搜索列表（管理后台）', NULL, 0),
	(78, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1527752574, 1528177458, '查看和编辑酒店信息（管理后台）', NULL, 0),
	(79, 1, 'requirement', 11, 100, 1, 1, 3, 9, 1, 1527758408, 1529395422, '现付担保下单入住完成后，订单界面未显示授信支付退款金额。', NULL, 0),
	(80, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1527763891, 1528079955, '无删除员工账号权限，未提示权限不足', NULL, 0),
	(81, 6, 'requirement', 11, 100, 1, 1, 8, 13, 1, 1527815821, 1531875548, 'docker 容器互联 研究', NULL, 0),
	(82, 6, 'requirement', 11, 100, 1, 1, 8, 13, 1, 1527844718, 1531875560, 'ndaswitch更新价格库存时，碰到找不到的产品跳过，处理之后的数据', NULL, 0),
	(83, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1527844972, 1528097905, 'ndaswitch,hotelswitch 正式环境搭建', NULL, 0),
	(84, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1528074055, 1528273958, 'api对接，小议渠道增加每天自动登录一次功能', NULL, 0),
	(85, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1528163955, 1529395775, ' 登录后出现重复导航栏', NULL, 0),
	(86, 11, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528178366, 1529981746, '未展示取消政策的时间限制', NULL, 0),
	(87, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1528178475, 1529395802, '页面出现了多次嵌套', NULL, 0),
	(88, 1, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1528178528, 1529395862, '重新预定出现异常', NULL, 0),
	(89, 7, 'requirement', 11, 100, 1, 1, 10, 10, 1, 1528182463, 1528355486, '酒店基础信息设计', NULL, 0),
	(90, 7, 'requirement', 11, 100, 1, 1, 10, 10, 1, 1528182503, 1528355495, '酒店设施一键编辑页面设计', NULL, 0),
	(91, 7, 'requirement', 11, 100, 1, 1, 10, 10, 1, 1528182601, 1528356443, '酒店房型信息操作按钮排版设计', NULL, 0),
	(92, 7, 'requirement', 11, 100, 1, 1, 10, 10, 1, 1528182684, 1528699168, '酒店图片管理页面设计', NULL, 0),
	(93, 7, 'requirement', 11, 100, 1, 1, 10, 10, 1, 1528182847, 1528699175, '待处理订单页面设计', NULL, 0),
	(94, 7, 'requirement', 11, 100, 1, 1, 10, 10, 1, 1528182860, 1528699183, '打印页面设计', NULL, 0),
	(95, 7, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1528183050, 1528269077, '首页内容布局的排版', NULL, 0),
	(96, 7, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1528183104, 1528356815, '酒店基础信息交互开发', NULL, 0),
	(97, 7, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1528183363, 1528436789, '酒店设施的交互', NULL, 0),
	(98, 7, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1528183401, 1528786367, '酒店房型补充交互', NULL, 0),
	(99, 7, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1528183449, 1529916677, '酒店图片补充交互', NULL, 0),
	(100, 7, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1528183570, 1528363534, '酒店联系方式交互', NULL, 0),
	(101, 7, 'requirement', 11, 100, 1, 1, 12, 12, 1, 1528183684, 1528336591, '全部订单列表项目展示的信息清单', NULL, 0),
	(102, 7, 'requirement', 11, 100, 1, 1, 12, 12, 1, 1528183816, 1528336744, '待解锁订单条目展示清单', NULL, 0),
	(103, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1528184638, 1528281006, '图片去水印', NULL, 0),
	(104, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1528184674, 1528371809, '上传图片到oss', NULL, 0),
	(105, 2, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1528268685, 1528955820, '待处理订单刷新页面没有待处理任务时，传到后台的时间是毫秒数', NULL, 0),
	(106, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1528270556, 1528371818, '抓取图片失败后台邮件通知开发者', NULL, 0),
	(107, 2, 'requirement', 11, 100, 1, 1, 5, 6, 1, 1528275849, 1529459376, '权限补充', NULL, 0),
	(108, 13, 'requirement', 11, 100, 1, 1, 13, 8, 1, 1528277173, 1529479223, '平台端-admin后台操作房型审核成功后通知', NULL, 0),
	(109, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528277434, 1532309427, '平台端-admin后台操作酒店信息审核中审核完成后', NULL, 0),
	(110, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528333475, 1532309463, '平台端-admin后台操作图片审核中审核后', NULL, 0),
	(111, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528333666, 1532309474, '平台端-admin后台操作酒店修改审核中审核成功/审核失败后', NULL, 0),
	(112, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528354088, 1532309504, '平台端-admin后台操作酒店佣金管理中确认开票后', NULL, 0),
	(113, 8, 'requirement', 11, 100, 1, 1, 8, 6, 1, 1528354146, 1532487701, '分销端-分销端成功下单后', NULL, 0),
	(114, 8, 'requirement', 11, 100, 1, 1, 8, 6, 1, 1528354219, 1532488271, '分销端-分销端操作取消订单后', NULL, 0),
	(115, 8, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528354262, 1532681509, '分销端-分销商操作修改入住信息并提交成功后', NULL, 0),
	(116, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528354306, 1530240372, '分销端-分销端提交问题后', NULL, 0),
	(117, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528354344, 1530240380, '分销端-分销端提交点评后', NULL, 0),
	(118, 8, 'requirement', 11, 100, 1, 1, 8, 9, 1, 1528354375, 1530263797, '酒店端-截止当前系统日期10点，入住审核中现付订单有待审核状态', NULL, 0),
	(119, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528354579, 1532326743, '酒店端-酒店端佣金预计可用少于等于三天用户登录时提醒（调整为少于固定金额提醒）', NULL, 0),
	(120, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1528373560, 1528702434, '爬虫计划', NULL, 0),
	(121, 5, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1528373590, 1528702455, '定时爬取计划清单的定时任务', NULL, 0),
	(122, 1, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1528425926, 1528425926, 'dev4supplier的SQL', NULL, 0),
	(123, 9, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1528426214, 1528426226, '修复签约解约时的重复ID的报错', NULL, 0),
	(124, 10, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1528684922, 1530244480, '支付模块重构', NULL, 0),
	(125, 8, 'requirement', 11, 100, 1, 1, 13, 6, 1, 1528703738, 1532488063, '酒店端操作接受/拒绝订单时（二次确认订单）', NULL, 0),
	(126, 8, 'requirement', 11, 100, 1, 1, 13, 6, 1, 1528703890, 1532489999, '酒店端操作允许取消变更后', NULL, 0),
	(127, 8, 'requirement', 11, 100, 1, 1, 13, 6, 1, 1528704944, 1532498238, '酒店操作入住审核判定为异常订单', NULL, 0),
	(128, 8, 'requirement', 11, 100, 1, 1, 13, 6, 1, 1528705014, 1532498205, '分销商提交立即确认订单成功后', NULL, 0),
	(129, 3, 'requirement', 11, 100, 1, 1, 5, 9, 1, 1528873769, 1529027589, '平台测试端管理员管理编辑框显示问题', NULL, 0),
	(130, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1528879122, 1529979470, '新建员工帐号未勾选权限登录报错', NULL, 0),
	(131, 14, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1528941878, 1531194663, ' 系统Session时间设置长一点', NULL, 0),
	(132, 11, 'requirement', 11, 100, 1, 1, 7, 12, 1, 1528942051, 1529994275, '酒店端维护酒店设施取消后页面未刷新，取消前的操作仍在', NULL, 0),
	(133, 11, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1528942123, 1529993383, '平台端维护酒店图片时提示图片大小不能超过512K,与酒店端不一致', NULL, 0),
	(134, 11, 'requirement', 11, 100, 1, 1, 7, 16, 1, 1528942230, 1529979703, '全部订单列表显示不完整', NULL, 0),
	(135, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528942336, 1529991839, ' 房型图片上传还未审核通过应该不可设置首图', NULL, 0),
	(136, 11, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1528942424, 1529993970, ' 酒店房型 宽带信息 全部房间 免费可以选择', NULL, 0),
	(137, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528942485, 1529993537, '分销端我的订单与全部订单无待确认状态的筛选项', NULL, 0),
	(138, 11, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1528942572, 1529994391, '酒店建筑面积选项未设置必填', NULL, 0),
	(139, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528942625, 1529994502, ' ta端使用主帐号登录报空指针', NULL, 0),
	(140, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528942718, 1529995508, '管理后台新增酒店报错', NULL, 0),
	(141, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528942756, 1529995280, ' 支付状态增加已退款', NULL, 0),
	(142, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528942796, 1529995572, '搜索条件错误', NULL, 0),
	(143, 11, 'requirement', 11, 100, 1, 1, 6, 6, 1, 1528942859, 1529025741, ' 酒店端code无默认值报错', NULL, 0),
	(144, 11, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1528942933, 1529977245, ' 收益管理已下线的售卖房型未被过滤', NULL, 0),
	(145, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528942988, 1529979934, ' 查看订单中输入确认号颜色不明显', NULL, 0),
	(146, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1528943025, 1532397214, ' 选择早餐1份/人时，酒店端订单详情不展示', NULL, 0),
	(147, 11, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1528943197, 1529979415, ' 专享配额订完不共享的问题', NULL, 0),
	(148, 11, 'requirement', 11, 100, 1, 1, 7, 11, 1, 1528943314, 1529979615, ' 单格日历查看日志', NULL, 0),
	(149, 11, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528943401, 1529980038, '页面展示异常', NULL, 0),
	(150, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528943525, 1529981660, ' 分销测试端异常订单确认出现错误', NULL, 0),
	(151, 14, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528943669, 1531194920, '账单结算中订单是否同步的问题', NULL, 0),
	(152, 11, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1528943771, 1530063509, ' 酒店端导航页脚固定优化', NULL, 0),
	(153, 11, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1528943984, 1529981782, ' 员工管理界面优化问题', NULL, 0),
	(154, 11, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1528944057, 1529980317, ' 酒店总机不支持400格式', NULL, 0),
	(155, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528944100, 1529982168, ' 房型宽带显示异常', NULL, 0),
	(156, 11, 'requirement', 11, 100, 1, 1, 7, 11, 1, 1528944149, 1529980477, ' 日期无法选择', NULL, 0),
	(157, 11, 'requirement', 11, 100, 1, 1, 7, 11, 1, 1528944243, 1529980546, '日期无法选择', NULL, 0),
	(158, 11, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1528944319, 1529981067, ' 页面展示异常', NULL, 0),
	(159, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528944367, 1529982237, ' 酒店端个人信息用户名修改问题', NULL, 0),
	(160, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1528944460, 1529982780, '分销管理设置分销商返佣时，显示错误', NULL, 0),
	(161, 11, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1528944568, 1529996092, '订单填写时更换房间数量，价格未更新', NULL, 0),
	(162, 14, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1528944644, 1531195044, '分销端“异常订单”担保扣款金额错误', NULL, 0),
	(163, 11, 'requirement', 11, 100, 1, 1, 7, 11, 1, 1528944727, 1529981622, ' 订单通知的弹框只出现一半', NULL, 0),
	(164, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528944801, 1529982911, ' 在库存管理搜索小议集团酒店，只填写城市时，提示“请输入酒店名称”', NULL, 0),
	(165, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528944860, 1531194977, ' 关联酒店的第一家无效后，登陆集团，酒店默认登陆第一家。', NULL, 0),
	(166, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1528944908, 1529983050, '在担保订单填写页面语句错误', NULL, 0),
	(167, 11, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1528944980, 1529981590, ' 确认取消单跳出修改通知', NULL, 0),
	(168, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945092, 1531195166, '订单修改日期后，提交按钮无法提交。', NULL, 0),
	(169, 11, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1528945153, 1529981907, ' 酒店设施部分与全部的展示混乱', NULL, 0),
	(170, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528945229, 1529983253, '平台端酒店设施模块选项排序有误导致分销端显示错误', NULL, 0),
	(171, 11, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1528945276, 1529983340, '在后台编辑设施后，新编辑的一行会跳到最后', NULL, 0),
	(172, 11, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945364, 1529983238, ' 添加发票异常弹框', NULL, 0),
	(173, 11, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945416, 1529982054, ' 酒店地图上的坐标与实际不符', NULL, 0),
	(174, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945470, 1531201836, ' 内部后台酒店基础信息页面缺少地图坐标模块', NULL, 0),
	(175, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1528945737, 1529982558, '1367 分销管理设置现付返佣时弹出错误弹框', NULL, 0),
	(176, 11, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945771, 1529981223, ' 页面展示异常', NULL, 0),
	(177, 14, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1528945807, 1531195057, ' 分销端“异常订单”担保扣款金额错误', NULL, 0),
	(178, 11, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945841, 1529981820, ' 重新预定出现异常', NULL, 0),
	(179, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1528945917, 1531195244, '酒店库存显示房价与分销显示的不一致', NULL, 0),
	(180, 11, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1528945960, 1529982405, '增加酒店信息时提交凭证后不显示', NULL, 0),
	(181, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1528967055, 1532326730, '酒店后台操作临时额度时', NULL, 0),
	(182, 12, 'requirement', 11, 100, 1, 1, 13, NULL, 1, 1529026915, 1529026915, '自动任务线上管理', NULL, 0),
	(183, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1529027359, 1530858049, '研究appkey,appsecret的接入方式， 结合我们现有的用户模式', NULL, 0),
	(184, 8, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1529375283, 1529388432, '协助的要点', NULL, 0),
	(185, 11, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1529399995, 1529978624, '设置专项配额出现负数', NULL, 0),
	(186, 14, 'requirement', 11, 100, 1, 1, 3, 16, 1, 1529459974, 1531193366, '专享配额有库存时不勾选【共享公共配额】外网不显示房型', NULL, 0),
	(187, 14, 'requirement', 11, 100, 1, 1, 5, 3, 1, 1529460104, 1531453268, '未勾选跟进权限的情况下，停止跟进成功', NULL, 0),
	(188, 14, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1529460234, 1531193862, '酒店搜索页面，取消筛选条件后未刷新', NULL, 0),
	(189, 14, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1529460289, 1531193538, ' 分销商申请提现未填写提现账号时出现提示框文字错误', NULL, 0),
	(190, 14, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1529460353, 1531194309, ' 入住审核筛选条件错误', NULL, 0),
	(191, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1529460442, 1532486764, ' 酒店总机格式局限', NULL, 0),
	(192, 14, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1529460571, 1531193898, '酒店详情无房型图时应不可点击', NULL, 0),
	(193, 14, 'requirement', 11, 100, 1, 1, 7, 16, 1, 1529460653, 1531194098, '分销商级别个性化设置出现错误', NULL, 0),
	(194, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1529474466, 1529978393, '酒店首次维护基础信息时弹出弹框', NULL, 0),
	(195, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1529474520, 1529978336, ' 酒店信息维护中“保存”按钮点击无反应', NULL, 0),
	(196, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1529474581, 1529979111, ' 账户修改密码后出现页面嵌套', NULL, 0),
	(197, 11, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1529474638, 1529977542, '酒店设施页面无法显示', NULL, 0),
	(198, 15, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1529919570, 1530063542, '建表语句', NULL, 0),
	(199, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1529984313, 1531187503, ' 在预定和订单修改填写信息页面增加每日房价的显示', NULL, 0),
	(200, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530150741, 1530669781, '分销端-授信额度少于1000元时提醒', NULL, 0),
	(201, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530150774, 1530669789, '分销端-临时额度少于1000元时提醒', NULL, 0),
	(202, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530150796, 1533029165, '分销端-临时额度失效时', NULL, 0),
	(203, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530150873, 1532346864, '分销端-首次登录后台，提醒分销端修改密码及验证手机邮箱', NULL, 0),
	(204, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530150899, 1532326608, '平台端-admin后台操作提现申请接受/拒绝后', NULL, 0),
	(205, 13, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530150925, 1532326650, '平台端-admin后台成功添加发票操作', NULL, 0),
	(206, 8, 'requirement', 11, 100, 1, 1, 8, 9, 1, 1530151299, 1530263731, '信息提示中待审核提示的去处理链接错误', NULL, 0),
	(207, 8, 'requirement', 11, 100, 1, 1, 8, 9, 1, 1530151324, 1530263774, '系统提示预付未付订单，下单后无提示', NULL, 0),
	(208, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530151345, 1532485904, '收益管理的预付加幅设置可以调整为负', NULL, 0),
	(209, 14, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1530151366, 1531202160, ' 预付订单设置优惠金额后页面未关闭刷新', NULL, 0),
	(210, 10, 'requirement', 11, 100, 1, 1, 7, 12, 1, 1530175151, 1530669148, '官网文字优化', NULL, 0),
	(211, 15, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1530176579, 1530515254, '自定义渠道管理', NULL, 0),
	(212, 15, 'requirement', 11, 100, 1, 1, 4, NULL, 1, 1530176598, 1530176598, '自定义渠道的个性化设置', NULL, 0),
	(213, 8, 'requirement', 11, 100, 1, 1, 2, 6, 1, 1530238409, 1532498355, ' 酒店登录出现空指针', NULL, 0),
	(214, 14, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1530240608, 1531204295, '分销商端主页的查询优化', NULL, 0),
	(215, 16, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1530241400, 1530609898, '测试内容', NULL, 0),
	(216, 8, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530242726, 1530675785, '1450 信息提示中待审核提示的去处理链接错误', NULL, 0),
	(217, 8, 'requirement', 11, 100, 1, 1, 8, 8, 1, 1530242774, 1532681493, ' 系统提示预付未付订单，下单后无提示', NULL, 0),
	(218, 17, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1530242829, 1531791214, ' 收益管理的预付加幅设置可以调整为负', NULL, 0),
	(219, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1530242890, 1531187309, '预付订单设置优惠金额后页面未关闭刷新', NULL, 0),
	(220, 14, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1530581639, 1531192500, ' 酒店房型信息的宽带设置收费后，再次修改信息收费金额的选项禁用', NULL, 0),
	(221, 14, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1530581708, 1531192287, ' 酒店账号信息修改编辑后提示酒店code不能为空，但却无酒店code', NULL, 0),
	(222, 14, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1530581793, 1531192926, ' 分销公司删除按钮拿掉', NULL, 0),
	(223, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530582059, 1532485451, '图片上传兆数限制放大', NULL, 0),
	(224, 14, 'requirement', 11, 100, 1, 1, 3, 16, 1, 1530582216, 1531188158, ' 订单管理中修改房型的修改单没有“修改”标签', NULL, 0),
	(225, 14, 'requirement', 11, 100, 1, 1, 5, 16, 1, 1530582345, 1531187444, '添加编辑酒店管理员账号时点击保存提示“酒店code不能为空”', NULL, 0),
	(226, 27, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1530582958, 1532595339, ' 收益管理与库存管理的查看日志中没有显示修改预付加幅和现付返佣操作', NULL, 0),
	(227, 14, 'requirement', 11, 100, 1, 1, 14, 11, 1, 1530583040, 1531192823, '酒店首图放大与房型放大的像素不一致', NULL, 0),
	(228, 14, 'requirement', 11, 100, 1, 1, 4, 11, 1, 1530583092, 1531192723, '添加分销商发票时发票编号未填写却提交成功', NULL, 0),
	(229, 14, 'requirement', 11, 100, 1, 1, 14, 16, 1, 1530583145, 1531187178, '登陆分销端账户后，个别板块与浏览器显示的标签不一致', NULL, 0),
	(230, 17, 'requirement', 11, 100, 1, 1, 3, 12, 1, 1530583245, 1532488100, ' 当更改库存管理的价格导致收益和分销级别价格出现负数时，增加提醒', NULL, 0),
	(231, 14, 'requirement', 11, 100, 1, 1, 5, 6, 1, 1530583356, 1531273474, '初次提交酒店信息时，地图坐标未获取', NULL, 0),
	(232, 14, 'requirement', 11, 100, 1, 1, 6, 6, 1, 1530583481, 1530668471, '点击日历格内的详情，隔2-3分钟才跳出来', NULL, 0),
	(233, 14, 'requirement', 11, 100, 1, 1, 5, 11, 1, 1530583527, 1531187914, 'api类型选择为“无”时，报错', NULL, 0),
	(234, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530583657, 1532488520, ' 把“发票欠额”拿掉', NULL, 0),
	(235, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530583768, 1532488736, '入住审核中筛选状态和状态显示的问题', NULL, 0),
	(236, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530583918, 1532502673, '全部订单中操作人不应显示出分销端的操作账号', NULL, 0),
	(237, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530584238, 1532490564, '分销商级别下已添加分销商的显示问题', NULL, 0),
	(238, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530584309, 1532490815, '需要在锁定的情况下，才可以修改确认号', NULL, 0),
	(239, 27, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1530584425, 1532510013, ' 修改订单时，满房情况下无法完成减少或增加晚数，减少入住房间数量的修改操作。', NULL, 0),
	(240, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530584518, 1532490944, '增加提问功能', NULL, 0),
	(241, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530584631, 1532499034, '酒店端佣金管理交易时间筛选问题', NULL, 0),
	(242, 17, 'requirement', 11, 100, 1, 1, 6, 6, 1, 1530584724, 1530610961, ' 创建账单前需查看账单明细', NULL, 0),
	(243, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530584878, 1532500032, '酒店端必填项优化', NULL, 0),
	(244, 27, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1530584978, 1532936712, '修改订单后订单的位置需更换', NULL, 0),
	(245, 27, 'requirement', 11, 100, 1, 1, 8, 9, 1, 1530585069, 1532510315, ' 忽略按钮无效', NULL, 0),
	(246, 17, 'requirement', 11, 100, 1, 1, 7, 12, 1, 1530585147, 1532396554, '预定详情页中选择入离时间时的问题', NULL, 0),
	(247, 19, 'requirement', 11, 100, 1, 1, 5, 12, 1, 1530585239, 1532571643, ' 修改非核心内容未展示修改前信息和修改后信息', NULL, 0),
	(248, 27, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1530585371, 1532586434, ' 邮箱补充酒店未展示', NULL, 0),
	(249, 27, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1530585442, 1532595495, ' 酒店端员工管理中部门全部栏点击后刷新页面', NULL, 0),
	(250, 17, 'requirement', 11, 100, 1, 1, 8, 12, 1, 1530585503, 1532501263, ' 订单拒绝通知，点击“去处理”跳到了订单列表（测试环境）', NULL, 0),
	(251, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530585561, 1532499740, '佣金余额展示异常', NULL, 0),
	(252, 17, 'requirement', 11, 100, 1, 1, 3, 12, 1, 1530585608, 1532503585, '单结预付的订单酒店没收到款', NULL, 0),
	(253, 17, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1530585660, 1532485089, ' 特殊要求的文字更改', NULL, 0),
	(254, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530585732, 1532501947, '库存管理中修改现付返佣应设置为必填', NULL, 0),
	(255, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530839737, 1532395521, ' 已停止合作的酒店分销端仍展示', NULL, 0),
	(256, 17, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1530839764, 1532501886, ' 酒店基础信息未提交审核时，分销端不应搜索出该酒店', NULL, 0),
	(257, 12, 'requirement', 11, 100, 1, 1, 13, NULL, 1, 1530847368, 1530858379, '在供应商管理中增加应用管理', NULL, 0),
	(258, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530847586, 1531457689, 'api调用权限验证，用户验证', NULL, 0),
	(259, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858188, 1531135156, '城市分布接口 queryCityList', NULL, 0),
	(260, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858235, 1531457700, '酒店列表接口 queryHotelList (code, 名称，地址，电话)', NULL, 0),
	(261, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858263, 1531453930, '酒店详情接口 queryHotelInfo', NULL, 0),
	(262, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858290, 1530858442, '酒店销售房型接口 querySaleRoom', NULL, 0),
	(263, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858319, 1530858496, '房价查询接口', NULL, 0),
	(264, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858337, 1530858501, '房态查询接口', NULL, 0),
	(265, 12, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1530858358, 1530858505, '房价房态查询接口', NULL, 0),
	(266, 18, 'requirement', 11, 100, 1, 1, 1, 4, 1, 1531289179, 1531985876, 'SQL', NULL, 0),
	(267, 19, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1531359393, 1532569628, '级别内添加分销商', NULL, 0),
	(268, 19, 'requirement', 11, 100, 1, 1, 4, 12, 1, 1531359445, 1532569683, ' 分销商级别内设置预付和现付个性化', NULL, 0),
	(269, 19, 'requirement', 11, 100, 1, 1, 7, 12, 1, 1531359572, 1532569809, '分销商级别设置预付个性化设置时的问题', NULL, 0),
	(270, 19, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1531359875, 1532569879, '售卖房型信息中缺少早餐类型。宽带资费免费收费不明确', NULL, 0),
	(271, 19, 'requirement', 11, 100, 1, 1, 14, 12, 1, 1531359917, 1532569986, ' 发票管理中的充值时间异常', NULL, 0),
	(272, 19, 'requirement', 11, 100, 1, 1, 8, 6, 1, 1531359990, 1532570831, ' 待处理订单条数与通知提示条数不一致', NULL, 0),
	(273, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531360046, 1532570398, '无法批量删除账号', NULL, 0),
	(274, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531360189, 1532570260, '已有管理员账号的酒店不能再次点击添加用户', NULL, 0),
	(275, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531360240, 1532570196, '已有管理员账号的分销商不能再次点击添加用户', NULL, 0),
	(276, 19, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1531360282, 1532570121, '没有酒店的创建时间，并且需改成倒叙', NULL, 0),
	(277, 19, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1531360342, 1532569933, '系统服务费未填点击确认异常', NULL, 0),
	(278, 19, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1531383595, 1532569852, '点击忘记密码页面未跳转', NULL, 0),
	(279, 19, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1531383653, 1532569771, ' 修改个人密码错误', NULL, 0),
	(280, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531383755, 1532569674, ' 酒店房型是否有窗显示错误', NULL, 0),
	(281, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531383899, 1532569594, '代码错误	员工账号的权限问题', NULL, 0),
	(282, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531383991, 1532569136, '员工管理中员工应不能对自己设置权限', NULL, 0),
	(283, 19, 'requirement', 11, 100, 1, 1, 14, 6, 1, 1531384031, 1532568793, '个人信息中邮箱绑定后，点击编辑弹框后关闭无效', NULL, 0),
	(284, 19, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1531384120, 1532568714, '酒店预订详情页【交通信息】【我看过的酒店】无显示', NULL, 0),
	(285, 19, 'requirement', 11, 100, 1, 1, 4, 6, 1, 1531384208, 1532568631, ' 分销公司管理状态展示不一致', NULL, 0),
	(286, 21, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1531705931, 1532916236, '日志优化', NULL, 0),
	(287, 22, 'requirement', 11, 100, 1, 1, 2, 3, 1, 1531799456, 1532049689, 'ID 重构', NULL, 0),
	(288, 16, 'requirement', 11, 100, 1, 1, 5, 3, 1, 1531799693, 1531985839, ' 酒店员工账号登录菜单异常', NULL, 0),
	(289, 18, 'requirement', 11, 100, 1, 1, 14, NULL, 1, 1531809429, 1531985882, 'SQL', NULL, 0),
	(290, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1531819833, 1531982858, '亚朵对接城市查询接口', NULL, 0),
	(291, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1531819848, 1531982865, '亚朵对接酒店查询接口', NULL, 0),
	(292, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1531819875, 1531982873, '亚朵对接物理房型查询接口', NULL, 0),
	(293, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1531819891, 1531982878, '亚朵对接销售房型查询接口', NULL, 0),
	(294, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1531819956, 1532485595, '亚朵对接房价数据自动推送', NULL, 0),
	(295, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1531819969, 1532485600, '亚朵对接房态数据自动推送', NULL, 0),
	(296, 23, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1531902548, 1532049645, '分销商营业执照上传和审核', NULL, 0),
	(297, 24, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1531987531, 1533286997, 'SQL', NULL, 0),
	(298, 24, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1531987554, 1533287011, '合并tacompany和hotel的ID', NULL, 0),
	(299, 25, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1531991060, 1533287039, 'SQL', NULL, 0),
	(300, 25, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1531991092, 1533287048, '功能开发', NULL, 0),
	(301, 26, 'requirement', 11, 100, 1, 1, 4, 3, 1, 1532049879, 1532420459, '分销商的营业执照的审核', NULL, 0),
	(302, 27, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1532050807, 1532678279, '账单中添加订单时应过滤已退款订单', NULL, 0),
	(303, 27, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532050911, 1532567968, '增加价格的搜索条件', NULL, 0),
	(304, 27, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532050944, 1532567959, '增加金额区间搜索', NULL, 0),
	(305, 27, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1532051089, 1532567788, '全部订单导出数据需增加数值', NULL, 0),
	(306, 27, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1532051120, 1532567767, '全部订单导出数据需增加数值', NULL, 0),
	(307, 27, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532051196, 1532678351, '收益管理设置现付返佣时出现错误', NULL, 0),
	(308, 27, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532051251, 1532567992, ' 现付担保订单延期入住扣款金额不对', NULL, 0),
	(309, 27, 'requirement', 11, 100, 1, 1, 4, 16, 1, 1532051330, 1532567755, '新增酒店时城市正常选择，提交时弹框城市等信息未填', NULL, 0),
	(310, 28, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532310849, 1532342026, '屏蔽测试酒店', NULL, 0),
	(311, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1532485695, 1532485952, '亚朵对接-可订检查接口', NULL, 0),
	(312, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1532485713, 1532485958, '亚朵对接-创建订单接口', NULL, 0),
	(313, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1532485731, 1532485963, '亚朵对接-取消订单接口', NULL, 0),
	(314, 6, 'requirement', 11, 100, 1, 1, 13, 13, 1, 1532485750, 1532485967, '亚朵对接-查询订单接口', NULL, 0),
	(315, 27, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532568703, 1532659857, '酒店房型审核通过后，列表没消失', NULL, 0),
	(316, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587178, 1532587496, '生成链接平台渠道注册 使用已有账号是否成功', NULL, 0),
	(317, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587197, 1532587544, '生成链接自定义渠道注册 使用已有账号是否成功', NULL, 0),
	(318, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587209, 1532587560, '生成链接平台渠道注册 注册公司注册 是否成功', NULL, 0),
	(319, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587227, 1532587587, '生成链接自定义渠道注册 注册公司注册 是否成功', NULL, 0),
	(320, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587254, 1532587603, ' 注册页面的验证信息是否满足要求', NULL, 0),
	(321, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587264, 1532587625, '注册成功分销商登录价格展示是否正确', NULL, 0),
	(322, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587276, 1532587639, '分销商的酒店详情页面 当链接地址手动输入是否提示异常', NULL, 0),
	(323, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587285, 1532587656, '平台关闭分销商，分销商是否可以登录', NULL, 0),
	(324, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587303, 1532587672, '酒店客户管理页面平台渠道切酒店自定义渠道是否正确', NULL, 0),
	(325, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587314, 1532587689, '酒店客户管理页面酒店自定义切平台渠道是否正确', NULL, 0),
	(326, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587325, 1532587705, '平台是否展示酒店客户的分销商', NULL, 0),
	(327, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587336, 1532587733, '如果该分销商不是该酒店客户 自定义渠道是否可以查询加入自己的定义渠道', NULL, 0),
	(328, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587347, 1532587748, '当分销商注册成功时是否在自定义渠道显示', NULL, 0),
	(329, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587407, 1532587764, '分销商申请为NDA客户是否展示在平台', NULL, 0),
	(330, 20, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1532587418, 1532587979, 'SQL', NULL, 0),
	(331, 27, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1532589619, 1532680006, '分销端注册页面和官网页面公司电话不应必填', NULL, 0),
	(332, 27, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1532589689, 1532655239, ' 酒店房型排版显示不一致', NULL, 0),
	(333, 27, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1532589753, 1532655501, '分销级别中多选框选中后取消出现，点击页面跳转出现弹框提示', NULL, 0),
	(334, 27, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1532589929, 1532589929, '子账号被显示在内部平台', NULL, 0),
	(335, 27, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1532589981, 1532589981, ' 子账号被显示在内部平台', NULL, 0),
	(336, 27, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1532590043, 1532688321, ' 更改列表内容', NULL, 0),
	(337, 27, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1532590174, 1532590174, '订单支付时，点击提交两次出现代码错误', NULL, 0),
	(338, 27, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532590292, 1532681863, '预定详情页连续点击多次可多次提交订单', NULL, 0),
	(339, 27, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1532590427, 1532590427, ' 订单支付页面连续点击提交提示框优化', NULL, 0),
	(340, 27, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1532590527, 1532590527, '分销业务指派跟进人优化', NULL, 0),
	(341, 27, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1532590597, 1532590597, ' 酒店业务指派跟进人页面优化', NULL, 0),
	(342, 29, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1532590662, 1532590662, '使用员工账号登陆菜单排序错误', NULL, 0),
	(343, 29, 'requirement', 11, 100, 1, 1, 3, 11, 1, 1532590755, 1533114956, ' 佣金为0时，下单提示佣金不足', NULL, 0),
	(344, 27, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1532590828, 1532592073, ' 更改重要文字', NULL, 0),
	(345, 29, 'requirement', 11, 100, 1, 1, 4, NULL, 1, 1532591047, 1532591047, ' 自定义渠道个性化设置现付或者预付修改刷新后又跳回到全部', NULL, 0),
	(346, 29, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1532591159, 1532591159, ' 自定义渠道中修改加幅后二级导航消失', NULL, 0),
	(347, 27, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1532591299, 1532662112, '原有声音代码报错问题', NULL, 0),
	(348, 27, 'requirement', 11, 100, 1, 1, 7, 7, 1, 1532591403, 1532663971, ' 消息提醒页面样式重叠', NULL, 0),
	(349, 30, 'requirement', 11, 100, 1, 1, 2, NULL, 1, 1532942040, 1534226847, '国家列表API', NULL, 0),
	(350, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532942077, 1533086448, '获取城市列表API', NULL, 0),
	(351, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532942115, 1533086468, '行政区域列表API', NULL, 0),
	(352, 30, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1532942282, 1533027984, '酒店ID列表查询API', NULL, 0),
	(353, 30, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1532942321, 1533031001, '酒店信息增量查询API', NULL, 0),
	(354, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1532942364, 1533794360, '酒店详情查询API', NULL, 0),
	(355, 30, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1532942409, 1533194414, '酒店产品信息查询API', NULL, 0),
	(356, 30, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1533604604, 1533873525, '编写API文档-订单相关的部分', NULL, 0),
	(357, 30, 'requirement', 11, 100, 1, 1, 4, NULL, 1, 1533605098, 1533605098, '研究一下阿里云的OSS图片授权', NULL, 0),
	(358, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1533794447, 1533794612, '订单可定检查接口', NULL, 0),
	(359, 30, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1533794464, 1533864294, '创建订单接口', NULL, 0),
	(360, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1533794483, 1533794537, '取消订单接口', NULL, 0),
	(361, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1533794512, 1533794561, '查看订单详情接口', NULL, 0),
	(362, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1533794532, 1533794586, '支付接口', NULL, 0),
	(363, 30, 'requirement', 11, 100, 1, 1, 4, 4, 1, 1533794551, 1534494202, '订单推送接口', NULL, 0),
	(364, 30, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1533817064, 1533885281, '在订单中识别由某个渠道通过API创建的订单', NULL, 0),
	(365, 30, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1533817266, 1533817266, '下单超时后，告诉外部系统原因未知', NULL, 0),
	(366, 31, 'requirement', 11, 100, 1, 1, 14, NULL, 1, 1533817870, 1533817870, '以API为单位控制酒店的静态信息的同步 ', NULL, 0),
	(367, 30, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1533818036, 1533818036, ' 幂等通知的问题', NULL, 0),
	(368, 30, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1533818383, 1533818410, '幂等通知的频次问题', NULL, 0),
	(369, 31, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1533818687, 1533818687, 'NDA的ID作为酒店编码映射亚朵的酒店编码', NULL, 0),
	(370, 31, 'requirement', 11, 100, 1, 1, 14, NULL, 1, 1533866974, 1533867353, '以酒店为单位接收房型（物理）数据', NULL, 0),
	(371, 31, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1533867427, 1533867427, '推送房型数据（物理）到NDA switch', NULL, 0),
	(372, 31, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1533867512, 1533867512, '推送售卖产品（销售房型）到NDAswtich', NULL, 0),
	(373, 31, 'requirement', 11, 100, 1, 1, 14, NULL, 1, 1533867536, 1533867536, '接收产品数据（销售房型）的数据', NULL, 0),
	(374, 32, 'requirement', 11, 100, 1, 1, 4, 3, 1, 1534146602, 1535335692, '酒店端的配置', NULL, 0),
	(375, 32, 'requirement', 11, 100, 1, 1, 4, 3, 1, 1534146617, 1535335739, '订单的展示', NULL, 0),
	(376, 32, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1534146629, 1534472753, '订单的新的规则的计算', NULL, 0),
	(377, 32, 'requirement', 11, 100, 1, 1, 5, 3, 1, 1534146655, 1534474021, 'API在传入亚朵酒店下的信息时传入入住政策', NULL, 0),
	(378, 33, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1534383536, 1534383536, 'API-OTA渠道到申请不可见', NULL, 0),
	(379, 33, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1534383577, 1534383577, '设置api服务跟api渠道的中间关系', NULL, 0),
	(380, 33, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1534383796, 1534727918, '设计酒店开通api渠道的模型表', NULL, 0),
	(381, 33, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1534383834, 1534727927, '开通渠道直连', NULL, 0),
	(382, 30, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1534400454, 1534494173, '酒店可订产品查询', NULL, 0),
	(383, 34, 'requirement', 11, 100, 1, 1, 5, 3, 1, 1534754152, 1535702587, '酒店ID和name的同步，以及筛选酒店', NULL, 0),
	(384, 34, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1534754168, 1535597857, '匹配省市区', NULL, 0),
	(385, 34, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1534754178, 1535526079, '物理房型的匹配', NULL, 0),
	(386, 34, 'requirement', 11, 100, 1, 1, 5, 3, 1, 1535508356, 1535702691, '销售房型、价格计划的同步', NULL, 0),
	(388, 34, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1535526026, 1535702722, '试预订接口- preBook', NULL, 0),
	(389, 34, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1535526047, 1535702730, '新建订单接口 - createOrder', NULL, 0),
	(390, 34, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1535526070, 1535942050, '取消订单接口- cancelOrder', NULL, 0),
	(392, 34, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1535595324, 1535703200, '查询单订单详情接口', NULL, 0),
	(393, 34, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1535702678, 1536127685, '匹配中需要加一个数据无法匹配的状态', NULL, 0),
	(394, 34, 'requirement', 11, 100, 1, 1, 6, 3, 1, 1535703166, 1536127516, '谁来负责我们在房仓中的信用额度', NULL, 0),
	(395, 34, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1535703876, 1536204390, '定时任务未完成，酒店基本信息，物理房型，销售房型，库存，价格计划', NULL, 0),
	(396, 34, 'requirement', 11, 100, 1, 1, 5, NULL, 1, 1536127599, 1536128192, '访问房仓接口中的超时问题，库存，价格，销售房型都是同一个接口，下单也会调用', NULL, 0),
	(397, 34, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1536129450, 1536219575, '物理房型手工匹配后状态更新', NULL, 0),
	(398, 34, 'requirement', 11, 100, 1, 1, 14, 14, 1, 1536131398, 1536219610, '物理房型匹配需要体现出房仓删除物理房型', NULL, 0),
	(399, 34, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1536131616, 1536213037, '酒店基本信息增量接口需要查看物理房型匹配是否有变化', NULL, 0),
	(400, 34, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1536198651, 1536219673, '给价格计划添加早餐类型，后端开发', NULL, 0),
	(401, 35, 'requirement', 11, 100, 1, 1, 3, NULL, 1, 1537942657, 1537942657, '创建订单接口', NULL, 0),
	(402, 35, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1537942675, 1539339369, '取消订单', NULL, 0),
	(403, 35, 'requirement', 11, 100, 1, 1, 5, 5, 1, 1537942822, 1539339336, '房价和库存接口', NULL, 0),
	(404, 35, 'requirement', 11, 100, 1, 1, 14, NULL, 1, 1537942863, 1537942863, '房价开关接口', NULL, 0),
	(405, 36, 'requirement', 11, 100, 1, 1, 14, 3, 1, 1540180739, 1543990901, '售卖房型标签区分直营与供应商需求', NULL, 0),
	(406, 37, 'requirement', 11, 100, 1, 1, 3, 3, 1, 1540809094, 1542010522, '扫码登录开发', NULL, 0);
/*!40000 ALTER TABLE `gt_story` ENABLE KEYS */;

-- 导出  表 geetask.gt_story_acceptance 结构
CREATE TABLE IF NOT EXISTS `gt_story_acceptance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `story_id` int(11) NOT NULL COMMENT '故事',
  `creator_id` int(11) NOT NULL COMMENT '处理人',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  `acceptance` varchar(128) DEFAULT NULL COMMENT '接受项',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='验收测试';

-- 正在导出表  geetask.gt_story_acceptance 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `gt_story_acceptance` DISABLE KEYS */;
/*!40000 ALTER TABLE `gt_story_acceptance` ENABLE KEYS */;

-- 导出  表 geetask.gt_story_active 结构
CREATE TABLE IF NOT EXISTS `gt_story_active` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL DEFAULT '0' COMMENT '项目',
  `story_id` int(11) NOT NULL COMMENT '任务项',
  `old_user` int(11) NOT NULL COMMENT '旧处理人',
  `new_user` int(11) NOT NULL COMMENT '处理人',
  `old_status` varchar(32) NOT NULL COMMENT '旧状态',
  `new_status` varchar(32) NOT NULL COMMENT '状态',
  `creator_id` int(11) NOT NULL COMMENT '更新人',
  `created_at` int(11) DEFAULT NULL COMMENT '添加时间',
  `remark` varchar(128) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='任务活动';

-- 正在导出表  geetask.gt_story_active 的数据：~14 rows (大约)
/*!40000 ALTER TABLE `gt_story_active` DISABLE KEYS */;
INSERT INTO `gt_story_active` (`id`, `project_id`, `story_id`, `old_user`, `new_user`, `old_status`, `new_status`, `creator_id`, `created_at`, `remark`) VALUES
	(1, 0, 1, 1, 1, '5', '5', 1, 1543550177, '🥘应该完成了'),
	(2, 0, 1, 1, 1, '5', '6', 1, 1543550384, '😍台开心了'),
	(3, 0, 1, 1, 1, '6', '7', 1, 1543550486, '🙊你是猴子请来的救兵吗？'),
	(4, 0, 1, 1, 1, '7', '8', 1, 1543550653, '🏅给你发一个奖牌'),
	(5, 0, 1, 1, 1, '8', '9', 1, 1543550942, '👷🏻优先员工一枚'),
	(6, 0, 1, 1, 1, '9', '10', 1, 1543551684, '🎙让我们来一起嗨'),
	(7, 0, 1, 1, 1, '10', '11', 1, 1543551753, '🚀我们可以飞啦'),
	(8, 0, 1, 1, 1, '11', '11', 1, 1543552063, '🌻'),
	(9, 0, 405, 14, 14, '11', '11', 1, 1543978023, '🚀可以考虑在后台计算好读取缓存\r\n'),
	(10, 0, 405, 14, 14, '11', '11', 1, 1543978132, '🏅测试'),
	(11, 0, 405, 14, 14, '11', '11', 1, 1543978536, '测试'),
	(12, 0, 405, 14, 14, '11', '11', 1, 1543978947, '测试\r\n'),
	(13, 0, 405, 14, 14, '11', '11', 1, 1543979073, '测试\r\n'),
	(14, 0, 405, 14, 14, '11', '11', 1, 1543990901, '测试\r\n');
/*!40000 ALTER TABLE `gt_story_active` ENABLE KEYS */;

-- 导出  表 geetask.gt_story_status 结构
CREATE TABLE IF NOT EXISTS `gt_story_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_backlog` tinyint(1) DEFAULT '0' COMMENT '产品Backlog',
  `name` varchar(64) NOT NULL COMMENT '名称',
  `description` varchar(255) DEFAULT NULL COMMENT '说明',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='故事状态';

-- 正在导出表  geetask.gt_story_status 的数据：~11 rows (大约)
/*!40000 ALTER TABLE `gt_story_status` DISABLE KEYS */;
INSERT INTO `gt_story_status` (`id`, `is_backlog`, `name`, `description`, `sort`) VALUES
	(1, 1, '待评估', '产品负责人添加新的故事默认状态', 1000),
	(2, 1, '已评估', '故事已经更开发人员沟通评估等待迭代', 900),
	(3, 1, '作废', '评估失败', 0),
	(4, 0, '启动', '任务已经分配待开发，待开发人员再跟产品经理确认需求', 800),
	(5, 0, '确认', '开发者已跟产品经理确认需求一致，待开发', 700),
	(6, 0, '开发中', '开发者进行编码或者设计', 650),
	(7, 0, '开发完', '编码完成，跟产品经理再次确认完成的结果一致', 600),
	(8, 0, '测试中', '测试人员进行测试，并确认需求一致', 550),
	(9, 0, '测试完', '测试人员完成测试，待通知产品验收', 500),
	(10, 0, '验收', '产品经理验收', 450),
	(11, 0, '完成', '结束任务项待发布', 400);
/*!40000 ALTER TABLE `gt_story_status` ENABLE KEYS */;

-- 导出  表 geetask.gt_timeline 结构
CREATE TABLE IF NOT EXISTS `gt_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `title` date NOT NULL COMMENT '名称',
  `description` varchar(255) DEFAULT NULL COMMENT '说明',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`project_id`,`title`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='时间线';

-- 正在导出表  geetask.gt_timeline 的数据：~6 rows (大约)
/*!40000 ALTER TABLE `gt_timeline` DISABLE KEYS */;
INSERT INTO `gt_timeline` (`id`, `project_id`, `title`, `description`) VALUES
	(1, 1, '2018-11-28', '支持微信支付'),
	(2, 1, '2018-11-30', '支持支付宝'),
	(3, 1, '2018-12-01', '发布上线2.0'),
	(4, 1, '2018-12-09', '支持微信登录👷🏻🤖'),
	(5, 1, '2018-12-13', '支持供应商🏅'),
	(6, 1, '2018-12-30', '🚁我们可以飞了');
/*!40000 ALTER TABLE `gt_timeline` ENABLE KEYS */;

-- 导出  表 geetask.gt_user 结构
CREATE TABLE IF NOT EXISTS `gt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `nick_name` varchar(32) DEFAULT NULL COMMENT '姓名',
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(64) NOT NULL,
  `password_reset_token` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL COMMENT '邮箱',
  `mobile` varchar(32) NOT NULL COMMENT '手机',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `is_admin` tinyint(1) DEFAULT NULL COMMENT '管理员',
  `is_super` tinyint(1) DEFAULT NULL COMMENT '超管',
  `def_project` int(11) DEFAULT NULL COMMENT '默认项目',
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `role` varchar(64) DEFAULT NULL COMMENT '角色',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='用户';

-- 正在导出表  geetask.gt_user 的数据：~16 rows (大约)
/*!40000 ALTER TABLE `gt_user` DISABLE KEYS */;
INSERT INTO `gt_user` (`id`, `username`, `nick_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `mobile`, `status`, `is_admin`, `is_super`, `def_project`, `created_at`, `updated_at`, `role`, `is_del`) VALUES
	(1, 'admin', '管理员', 'dFIfQutSickXRaQXsZSCPB1LAJZ6FnbA', '$2y$13$m5Z6Ruhoi3NIVaCCdnhuvO4tS9SEeMOFEIWy4UXAw39qqPJaRVzTu', NULL, 'dungang@126.com', '', 10, 1, 1, 1, 1543204772, 1544087066, '管理员1', 0);
/*!40000 ALTER TABLE `gt_user` ENABLE KEYS */;
CREATE TABLE `gt_link` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`label` VARCHAR(32) NOT NULL COMMENT '名称',
	`url` VARCHAR(128) NOT NULL COMMENT '地址',
	PRIMARY KEY (`id`)
)
COMMENT='项目相关的链接'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;
INSERT INTO `gt_link` (`id`, `project_id`, `label`, `url`) VALUES (1, 1, '阿里云', 'https://www.aliyun.com');
INSERT INTO `gt_link` (`id`, `project_id`, `label`, `url`) VALUES (2, 1, '支付宝', 'https://www.alipay.com');
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
