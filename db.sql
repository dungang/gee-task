CREATE TABLE `auth_rule` (
	`name` VARCHAR(64) NOT NULL,
	`data` BLOB NULL,
	`created_at` INT(11) NULL DEFAULT NULL,
	`updated_at` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`name`)
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `auth_item` (
	`name` VARCHAR(64) NOT NULL,
	`type` SMALLINT(6) NOT NULL,
	`description` TEXT NULL,
	`rule_name` VARCHAR(64) NULL DEFAULT NULL,
	`data` BLOB NULL,
	`created_at` INT(11) NULL DEFAULT NULL,
	`updated_at` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`name`),
	INDEX `rule_name` (`rule_name`),
	INDEX `idx-auth_item-type` (`type`),
	CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `auth_item_child` (
	`parent` VARCHAR(64) NOT NULL,
	`child` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`parent`, `child`),
	INDEX `child` (`child`),
	CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `auth_assignment` (
	`item_name` VARCHAR(64) NOT NULL,
	`user_id` VARCHAR(64) NOT NULL,
	`created_at` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`item_name`, `user_id`),
	INDEX `auth_assignment_user_id_idx` (`user_id`),
	CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(32) NOT NULL COMMENT '用户名',
	`nick_name` VARCHAR(32) NULL DEFAULT NULL COMMENT '姓名',
	`auth_key` VARCHAR(32) NOT NULL,
	`password_hash` VARCHAR(64) NOT NULL,
	`password_reset_token` VARCHAR(64) NULL DEFAULT NULL,
	`email` VARCHAR(64) NOT NULL COMMENT '邮箱',
	`mobile` VARCHAR(32) NOT NULL COMMENT '手机',
	`status` SMALLINT(6) NOT NULL DEFAULT '10' COMMENT '状态',
	`is_admin` TINYINT(1) NULL DEFAULT NULL COMMENT '管理员',
	`is_super` TINYINT(1) NULL DEFAULT NULL COMMENT '超管',
	`def_project` INT(11) NULL DEFAULT NULL COMMENT '默认项目',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`role` VARCHAR(64) NULL COMMENT '角色',
	`is_del` TINYINT(1) NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `username` (`username`),
	UNIQUE INDEX `email` (`email`),
	UNIQUE INDEX `password_reset_token` (`password_reset_token`)
)
COMMENT='用户'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_project` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL COMMENT '名称',
	`web_site` VARCHAR(128) NULL DEFAULT NULL COMMENT '官网',
	`is_achived` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '归档',
	`cycle` ENUM('WEEK','MONTH') NOT NULL DEFAULT 'WEEK' COMMENT '迭代周期',
	`planning_meet` TINYINT NOT NULL DEFAULT 5 COMMENT '规划会议日',
	`review_meet` TINYINT NOT NULL DEFAULT 3 COMMENT '评审会议日',
	`retrospective_day` TINYINT NOT NULL DEFAULT 5 COMMENT '顾会议日',
	`creator_id` INT(11) NOT NULL COMMENT '创始人',
	`created_at` INT(11) NULL DEFAULT NULL COMMENT '添加日期',
	`updated_at` INT(11) NULL DEFAULT NULL COMMENT '更新日期',
	`is_del` TINYINT(1) NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `fk_project_user_idx` (`creator_id`)
)
COMMENT='项目'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_sprint` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`status` ENUM('todo','doing','done') NOT NULL DEFAULT 'todo' COMMENT '状态',
	`start_date` DATE NULL DEFAULT NULL COMMENT '开始日期',
	`end_date` DATE NULL DEFAULT NULL COMMENT '结束日期',
	`created_at` INT(11) NULL DEFAULT NULL COMMENT '添加时间',
	`updated_at` INT(11) NULL DEFAULT NULL COMMENT '更新时间',
	`name` VARCHAR(128) NULL DEFAULT NULL COMMENT '名称',
	`is_del` TINYINT(1) NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COMMENT='迭代计划'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_story` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`sprint_id` INT(11) NOT NULL COMMENT '计划',
	`story_type` VARCHAR(32) NOT NULL DEFAULT 'bug' COMMENT '类型',
	`important` SMALLINT NOT NULL DEFAULT 0 COMMENT '优先程度',
	`important` FLOAT NOT NULL DEFAULT 1 COMMENT '故事点',
	`status` INT NOT NULL COMMENT '状态',
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`user_id` INT(11) NOT NULL COMMENT '处理人',
	`last_user_id` INT(11) NULL DEFAULT NULL COMMENT '更新者',
	`creator_id` INT(11) NOT NULL COMMENT '创建者',
	`created_at` INT(11) NULL DEFAULT NULL COMMENT '添加时间',
	`updated_at` INT(11) NULL DEFAULT NULL COMMENT '更新时间',
	`name` VARCHAR(128) NULL DEFAULT NULL COMMENT '名称',
	`project_version` VARCHAR(32) NULL DEFAULT NULL COMMENT '版本',
	`is_del` TINYINT(1) NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `task_status` (`status`)
)
COMMENT='用户故事'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_story_active` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`story_id` INT(11) NOT NULL COMMENT '故事',
	`old_status` VARCHAR(32) NOT NULL COMMENT '旧状态',
	`new_status` VARCHAR(32) NOT NULL COMMENT '新状态',
	`creator_id` INT(11) NOT NULL COMMENT '处理人',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`remark` VARCHAR(128) NULL COMMENT '备注',
	PRIMARY KEY (`id`)
)
COMMENT='故事活动'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_story_acceptance` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`story_id` INT(11) NOT NULL COMMENT '故事',
	`creator_id` INT(11) NOT NULL COMMENT '处理人',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NULL DEFAULT NULL COMMENT '更新时间',
	`acceptance` VARCHAR(128) NULL COMMENT '接受项',
	PRIMARY KEY (`id`)
)
COMMENT='验收测试'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_change_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` TEXT NULL COMMENT '名称',
	PRIMARY KEY (`id`)
)
COMMENT='变更分类'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_change` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`category_id` INT(11) NOT NULL COMMENT '分类',
	`creator_id` INT(11) NOT NULL COMMENT '创建人',
	`content` TEXT NULL COMMENT '内容',
	`created_at` INT(11) NULL DEFAULT NULL COMMENT '添加时间',
	`updated_at` INT(11) NULL DEFAULT NULL COMMENT '更新时间',
	PRIMARY KEY (`id`)
)
COMMENT='变更'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_project_member` (
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`user_id` INT(11) NOT NULL COMMENT '成员',
	`position`  VARCHAR(64) NOT NULL COMMENT '岗位',
	PRIMARY KEY (`project_id`, `user_id`),
	INDEX `fk_project_mem_pid` (`project_id`),
	INDEX `fk_project_mem_user` (`user_id`)
)
COMMENT='项目成员'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_meet` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`actors` TEXT NOT NULL COMMENT '参会人',
	`meet_date` DATE NOT NULL COMMENT '日期',
	`creator_id` INT(11) NOT NULL COMMENT '记录人',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`title` VARCHAR(128) NOT NULL COMMENT '议题',
	`content` TEXT NOT NULL COMMENT '内容',
	`is_del` TINYINT(1) NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COMMENT='会议'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_robot` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`name` VARCHAR(64) NULL DEFAULT NULL COMMENT '名称',
	`code_full_class` VARCHAR(128) NULL DEFAULT NULL COMMENT '代码类',
	PRIMARY KEY (`id`)
)
COMMENT='即时机器人'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_project_robot` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`robot_id` INT(11) NOT NULL COMMENT '机器人',
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`name` VARCHAR(64) NULL DEFAULT NULL COMMENT '机器人名称',
	`webhook` VARCHAR(255) NULL DEFAULT NULL COMMENT '通知地址',
	PRIMARY KEY (`id`)
)
COMMENT='项目机器人'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_robot_message` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(64) NULL DEFAULT NULL COMMENT '消息代号',
	`name` VARCHAR(64) NULL DEFAULT NULL COMMENT '消息名称',
	`message` VARCHAR(255) NULL DEFAULT NULL COMMENT '消息模板',
	PRIMARY KEY (`id`)
)
COMMENT='机器人消息'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;


CREATE TABLE `gt_event`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`name` VARCHAR(64) NOT NULL COMMENT '名称',
	`code` VARCHAR(64) NOT NULL UNIQUE COMMENT '编码',
	`intro` VARCHAR(255) NULL COMMENT '介绍',
	PRIMARY KEY (`id`)
)
COMMENT='事件'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_event_handler`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`event_id` INT(11) NOT NULL COMMENT '事件',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`name` VARCHAR(64) NOT NULL COMMENT '名称',
	`handler` VARCHAR(128) NOT NULL UNIQUE COMMENT '处理器',
	`intro` VARCHAR(255) NULL COMMENT '介绍',
	PRIMARY KEY (`id`)
)
COMMENT='事件处理器'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_integration_target` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL COMMENT '名称',
	`intro` VARCHAR(255)  NULL COMMENT '介绍',
	`created_at` INT(11) NULL DEFAULT NULL COMMENT '添加时间',
	`updated_at` INT(11) NULL DEFAULT NULL COMMENT '更新时间',
	PRIMARY KEY (`id`)
)
COMMENT='积分对象'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_integration_rule` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`name` VARCHAR(64) NOT NULL COMMENT '名称',
	`method` ENUM('POST','GET') NOT NULL COMMENT '方法',
	`route` VARCHAR(64) NOT NULL COMMENT '路由',
	`intro` VARCHAR(255) NULL COMMENT '介绍',
	PRIMARY KEY (`id`)
)
COMMENT='积分规则'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB; 

CREATE TABLE `gt_integration_rule_detail` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`rule_id` INT(11) NOT NULL COMMENT '规则',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`updated_at` INT(11) NOT NULL COMMENT '更新时间',
	`position` VARCHAR(64) NOT NULL COMMENT '岗位',
	`target_id` INT(11) NOT NULL COMMENT '积分对象',
	`target_scope` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '分值',
	`repeat_times` SMALLINT(6) NULL DEFAULT '1' COMMENT '可重复次数',
	PRIMARY KEY (`id`)
)
COMMENT='积分值'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_integration_active` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`rule_id` INT(11) NOT NULL COMMENT '规则',
	`creator_id` INT(11) NOT NULL COMMENT '创建用户',
	`position` VARCHAR(64) NULL DEFAULT 'developer' COMMENT '岗位',
	`created_at` INT(11) NOT NULL COMMENT '添加时间',
	`target_id` INT(11) NOT NULL COMMENT '积分对象',
	`target_scope` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '分值',
	`route` VARCHAR(64) NOT NULL COMMENT '路由',
	`repeat_times` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '可重复',
	`rest_times` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '剩余',
	`remark` VARCHAR(255) NULL DEFAULT NULL COMMENT '备注',
	PRIMARY KEY (`id`)
)
COMMENT='积分'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_role` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(64) NOT NULL UNIQUE COMMENT '名称',
	`description` VARCHAR(255) NULL COMMENT '说明',
	`scope` ENUM('ADMIN','POSITION') NOT NULL DEFAULT 'ADMIN' COMMENT '范围',
	`is_sys` TINYINT(1) NULL DEFAULT '1' COMMENT '系统内置',
	PRIMARY KEY (`id`)
)
COMMENT='积分'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;


CREATE TABLE `gt_timeline` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`title` date NOT NULL UNIQUE COMMENT '名称',
	`description` VARCHAR(255) NULL COMMENT '说明',
	PRIMARY KEY (`id`)
)
COMMENT='时间线'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_story_status` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`is_backlog` TINYINT(1) NULL DEFAULT '0' COMMENT '产品Backlog',
	`name` VARCHAR(64) NOT NULL UNIQUE COMMENT '名称',
	`description` VARCHAR(255) NULL COMMENT '说明',
	`sort` INT NOT NULL DEFAULT 0 COMMENT '排序',
	PRIMARY KEY (`id`)
)
COMMENT='故事状态'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;

CREATE TABLE `gt_setting` (
	`name` VARCHAR(64) NOT NULL UNIQUE COMMENT '名称',
	`title` VARCHAR(64) NOT NULL COMMENT '标题',
	`value` TEXT NULL COMMENT '值',
	PRIMARY KEY (`name`)
)
COMMENT='系统设置'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;
