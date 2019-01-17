-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        10.1.19-MariaDB - mariadb.org binary distribution
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.5.0.5453
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 geetask 的数据库结构
CREATE DATABASE IF NOT EXISTS `geetask` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `geetask`;

-- 导出  表 geetask.auth_assignment 结构
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
-- 导出  表 geetask.auth_item_child 结构
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 数据导出被取消选择。
-- 导出  表 geetask.auth_rule 结构
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_aliyun_log 结构
CREATE TABLE IF NOT EXISTS `gt_aliyun_log` (
  `project_id` int(11) NOT NULL COMMENT '项目',
  `endpoint` varchar(64) NOT NULL,
  `access_key` varchar(64) NOT NULL,
  `secret_key` varchar(64) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='阿里云日志';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_change_category 结构
CREATE TABLE IF NOT EXISTS `gt_change_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='变更分类';

-- 数据导出被取消选择。
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='事件';

-- 数据导出被取消选择。
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='事件处理器';

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_link 结构
CREATE TABLE IF NOT EXISTS `gt_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `label` varchar(32) NOT NULL COMMENT '名称',
  `url` varchar(128) NOT NULL COMMENT '地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='项目相关的链接';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_project_member 结构
CREATE TABLE IF NOT EXISTS `gt_project_member` (
  `project_id` int(11) NOT NULL COMMENT '项目',
  `user_id` int(11) NOT NULL COMMENT '成员',
  `position` varchar(64) NOT NULL COMMENT '岗位',
  PRIMARY KEY (`project_id`,`user_id`),
  KEY `fk_project_mem_pid` (`project_id`),
  KEY `fk_project_mem_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='项目成员';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_robot 结构
CREATE TABLE IF NOT EXISTS `gt_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL COMMENT '添加时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `name` varchar(64) DEFAULT NULL COMMENT '名称',
  `code_full_class` varchar(128) DEFAULT NULL COMMENT '代码类',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='即时机器人';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_setting 结构
CREATE TABLE IF NOT EXISTS `gt_setting` (
  `name` varchar(64) NOT NULL COMMENT '名称',
  `title` varchar(64) NOT NULL COMMENT '标题',
  `value` text COMMENT '值',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统设置';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
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
) ENGINE=InnoDB AUTO_INCREMENT=412 DEFAULT CHARSET=utf8mb4 COMMENT='用户故事';

-- 数据导出被取消选择。
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='验收测试';

-- 数据导出被取消选择。
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='任务活动';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
-- 导出  表 geetask.gt_timeline 结构
CREATE TABLE IF NOT EXISTS `gt_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '项目',
  `title` date NOT NULL COMMENT '名称',
  `description` varchar(255) DEFAULT NULL COMMENT '说明',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`project_id`,`title`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='时间线';

-- 数据导出被取消选择。
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

-- 数据导出被取消选择。
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
