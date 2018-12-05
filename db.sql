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
	`msg_subject` VARCHAR(255) NULL DEFAULT NULL COMMENT '消息主题',
	`subject_vars` VARCHAR(255) NULL DEFAULT NULL COMMENT '主题变量',
	`msg_body` TEXT NULL COMMENT '消息内容',
	`body_vars` VARCHAR(255) NULL DEFAULT NULL COMMENT '内容变量',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `code` (`code`)
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

CREATE TABLE `gt_aliyun_log` (
	`project_id` INT(11) NOT NULL COMMENT '项目',
	`endpoint` VARCHAR(64) NOT NULL,
	`access_key` VARCHAR(64) NOT NULL,
	`secret_key` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`project_id`)
)
COMMENT='阿里云日志'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;


INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/ac-route/create', 4, 'ac route create', NULL, NULL, 1543224292, 1543224292),
	('/ac-route/index', 4, 'ac route index', NULL, NULL, 1543224289, 1543224289),
	('/ac-route/view', 4, 'ac route view', NULL, NULL, 1543224304, 1543224304),
	('/app-module/index', 4, 'app module index', NULL, NULL, 1543222003, 1543222003),
	('/auth-permission/create', 4, 'auth permission create', NULL, NULL, 1543225416, 1543225416),
	('/auth-permission/index', 4, 'auth permission index', NULL, NULL, 1543225066, 1543225066),
	('/auth-permission/update', 4, 'auth permission update', NULL, NULL, 1543310118, 1543310118),
	('/auth-role/create', 4, 'auth role create', NULL, NULL, 1543387986, 1543387986),
	('/auth-role/index', 4, 'auth role index', NULL, NULL, 1543225064, 1543225064),
	('/auth-role/permission', 4, 'auth role permission', NULL, NULL, 1543570277, 1543570277),
	('/auth-role/update', 4, 'auth role update', NULL, NULL, 1543288315, 1543288315),
	('/auth-rule/create', 4, 'auth rule create', NULL, NULL, 1543225072, 1543225072),
	('/auth-rule/index', 4, 'auth rule index', NULL, NULL, 1543225069, 1543225069),
	('/auth-rule/update', 4, 'auth rule update', NULL, NULL, 1543309941, 1543309941),
	('/auth-rule/view', 4, 'auth rule view', NULL, NULL, 1543309946, 1543309946),
	('/backlog/acceptance/create', 4, 'backlog acceptance create', NULL, NULL, 1543457417, 1543457417),
	('/backlog/acceptance/index', 4, 'backlog acceptance index', NULL, NULL, 1543457223, 1543457223),
	('/backlog/default/create', 4, 'backlog default create', NULL, NULL, 1543397576, 1543397576),
	('/backlog/default/index', 4, 'backlog default index', NULL, NULL, 1543397160, 1543397160),
	('/change/default/create', 4, 'change default create', NULL, NULL, 1543389913, 1543389913),
	('/change/default/index', 4, 'change default index', NULL, NULL, 1543388974, 1543388974),
	('/event-handler/create', 4, 'event handler create', NULL, NULL, 1543392895, 1543392895),
	('/event-handler/index', 4, 'event handler index', NULL, NULL, 1543392890, 1543392890),
	('/event-handler/update', 4, 'event handler update', NULL, NULL, 1543549693, 1543549693),
	('/event/create', 4, 'event create', NULL, NULL, 1543370011, 1543370011),
	('/event/index', 4, 'event index', NULL, NULL, 1543370008, 1543370008),
	('/event/update', 4, 'event update', NULL, NULL, 1543548211, 1543548211),
	('/im-robot/create', 4, 'im robot create', NULL, NULL, 1543400043, 1543400043),
	('/im-robot/index', 4, 'im robot index', NULL, NULL, 1543392062, 1543392062),
	('/im-robot/update', 4, 'im robot update', NULL, NULL, 1543462272, 1543462272),
	('/meet/default/create', 4, 'meet default create', NULL, NULL, 1543388471, 1543388471),
	('/meet/default/delete', 4, 'meet default delete', NULL, NULL, 1543562135, 1543562135),
	('/meet/default/index', 4, 'meet default index', NULL, NULL, 1543388350, 1543388350),
	('/meet/default/update', 4, 'meet default update', NULL, NULL, 1543567793, 1543567793),
	('/meet/default/view', 4, 'meet default view', NULL, NULL, 1543561947, 1543561947),
	('/member/default/create', 4, 'member default create', NULL, NULL, 1543387712, 1543387712),
	('/member/default/delete', 4, 'member default delete', NULL, NULL, 1543569831, 1543569831),
	('/member/default/index', 4, 'member default index', NULL, NULL, 1543387160, 1543387160),
	('/member/default/update', 4, 'member default update', NULL, NULL, 1543399855, 1543399855),
	('/member/default/view', 4, 'member default view', NULL, NULL, 1543563100, 1543563100),
	('/myproject/default/create', 4, 'myproject default create', NULL, NULL, 1543455548, 1543455548),
	('/myproject/default/index', 4, 'myproject default index', NULL, NULL, 1543455189, 1543455189),
	('/plan/default/index', 4, 'plan default index', NULL, NULL, 1543237893, 1543237893),
	('/project/create', 4, 'project create', NULL, NULL, 1543239722, 1543239722),
	('/project/index', 4, 'project index', NULL, NULL, 1543239549, 1543239549),
	('/project/space', 4, 'project space', NULL, NULL, 1543371051, 1543371051),
	('/project/update', 4, 'project update', NULL, NULL, 1543310102, 1543310102),
	('/project/view', 4, 'project view', NULL, NULL, 1543310095, 1543310095),
	('/robot-message/index', 4, 'robot message index', NULL, NULL, 1543392356, 1543392356),
	('/robot/default/create', 4, 'robot default create', NULL, NULL, 1543391518, 1543391518),
	('/robot/default/index', 4, 'robot default index', NULL, NULL, 1543391351, 1543391351),
	('/robot/default/update', 4, 'robot default update', NULL, NULL, 1543462308, 1543462308),
	('/role/create', 4, 'role create', NULL, NULL, 1543288176, 1543288176),
	('/role/index', 4, 'role index', NULL, NULL, 1543288172, 1543288172),
	('/role/permission', 4, 'role permission', NULL, NULL, 1543288992, 1543288992),
	('/role/update', 4, 'role update', NULL, NULL, 1543288233, 1543288233),
	('/site/index', 4, 'site index', NULL, NULL, 1543207656, 1543207656),
	('/space/default/create', 4, 'space default create', NULL, NULL, 1543377197, 1543377197),
	('/space/default/index', 4, 'space default index', NULL, NULL, 1543375474, 1543375474),
	('/space/default/update', 4, 'space default update', NULL, NULL, 1543477938, 1543477938),
	('/sprint/default/create', 4, 'sprint default create', NULL, NULL, 1543242482, 1543242482),
	('/sprint/default/delete', 4, 'sprint default delete', NULL, NULL, 1543459132, 1543459132),
	('/sprint/default/index', 4, 'sprint default index', NULL, NULL, 1543242478, 1543242478),
	('/sprint/default/update', 4, 'sprint default update', NULL, NULL, 1543415054, 1543415054),
	('/sprint/default/view', 4, 'sprint default view', NULL, NULL, 1543458272, 1543458272),
	('/sprint/story-active/create', 4, 'sprint story active create', NULL, NULL, 1543416108, 1543416108),
	('/sprint/story/create', 4, 'sprint story create', NULL, NULL, 1543399496, 1543399496),
	('/sprint/story/index', 4, 'sprint story index', NULL, NULL, 1543398611, 1543398611),
	('/sprint/story/update', 4, 'sprint story update', NULL, NULL, 1543462511, 1543462511),
	('/sprint/story/view', 4, 'sprint story view', NULL, NULL, 1543415664, 1543415664),
	('/story-status/create', 4, 'story status create', NULL, NULL, 1543394955, 1543394955),
	('/story-status/index', 4, 'story status index', NULL, NULL, 1543394875, 1543394875),
	('/switch-project/index', 4, 'switch project index', NULL, NULL, 1543370113, 1543370113),
	('/user/create', 4, 'user create', NULL, NULL, 1543208720, 1543208720),
	('/user/index', 4, 'user index', NULL, NULL, 1543207762, 1543207762),
	('/user/role', 4, 'user role', NULL, NULL, 1543207775, 1543207775),
	('/user/update', 4, 'user update', NULL, NULL, 1543207796, 1543207796),
	('/user/view', 4, 'user view', NULL, NULL, 1543209419, 1543209419),
	('ac-route', 3, 'ac route', NULL, NULL, 1543224289, 1543224289),
	('ac-route-create', 2, 'ac route create', NULL, NULL, 1543224292, 1543224292),
	('ac-route-index', 2, 'ac route index', NULL, NULL, 1543224289, 1543224289),
	('ac-route-view', 2, 'ac route view', NULL, NULL, 1543224304, 1543224304),
	('app-module', 3, 'app module', NULL, NULL, 1543222002, 1543222002),
	('app-module-index', 2, 'app module index', NULL, NULL, 1543222003, 1543222003),
	('auth-permission', 3, 'auth permission', NULL, NULL, 1543225066, 1543225066),
	('auth-permission-create', 2, 'auth permission create', NULL, NULL, 1543225416, 1543225416),
	('auth-permission-index', 2, 'auth permission index', NULL, NULL, 1543225066, 1543225066),
	('auth-permission-update', 2, 'auth permission update', NULL, NULL, 1543310118, 1543310118),
	('auth-role', 3, 'auth role', NULL, NULL, 1543225064, 1543225064),
	('auth-role-create', 2, 'auth role create', NULL, NULL, 1543387986, 1543387986),
	('auth-role-index', 2, 'auth role index', NULL, NULL, 1543225064, 1543225064),
	('auth-role-permission', 2, 'auth role permission', NULL, NULL, 1543570277, 1543570277),
	('auth-role-update', 2, 'auth role update', NULL, NULL, 1543288315, 1543288315),
	('auth-rule', 3, 'auth rule', NULL, NULL, 1543225069, 1543225069),
	('auth-rule-create', 2, 'auth rule create', NULL, NULL, 1543225072, 1543225072),
	('auth-rule-index', 2, 'auth rule index', NULL, NULL, 1543225069, 1543225069),
	('auth-rule-update', 2, 'auth rule update', NULL, NULL, 1543309942, 1543309942),
	('auth-rule-view', 2, 'auth rule view', NULL, NULL, 1543309946, 1543309946),
	('backlog-acceptance', 3, 'backlog acceptance', NULL, NULL, 1543457223, 1543457223),
	('backlog-acceptance-create', 2, 'backlog acceptance create', NULL, NULL, 1543457417, 1543457417),
	('backlog-acceptance-index', 2, 'backlog acceptance index', NULL, NULL, 1543457223, 1543457223),
	('backlog-default', 3, 'backlog default', NULL, NULL, 1543397160, 1543397160),
	('backlog-default-create', 2, 'backlog default create', NULL, NULL, 1543397576, 1543397576),
	('backlog-default-index', 2, 'backlog default index', NULL, NULL, 1543397160, 1543397160),
	('change-default', 3, 'change default', NULL, NULL, 1543388974, 1543388974),
	('change-default-create', 2, 'change default create', NULL, NULL, 1543389914, 1543389914),
	('change-default-index', 2, 'change default index', NULL, NULL, 1543388974, 1543388974),
	('event', 3, 'event', NULL, NULL, 1543370008, 1543370008),
	('event-create', 2, 'event create', NULL, NULL, 1543370011, 1543370011),
	('event-handler', 3, 'event handler', NULL, NULL, 1543392890, 1543392890),
	('event-handler-create', 2, 'event handler create', NULL, NULL, 1543392895, 1543392895),
	('event-handler-index', 2, 'event handler index', NULL, NULL, 1543392890, 1543392890),
	('event-handler-update', 2, 'event handler update', NULL, NULL, 1543549693, 1543549693),
	('event-index', 2, 'event index', NULL, NULL, 1543370008, 1543370008),
	('event-update', 2, 'event update', NULL, NULL, 1543548211, 1543548211),
	('im-robot', 3, 'im robot', NULL, NULL, 1543392062, 1543392062),
	('im-robot-create', 2, 'im robot create', NULL, NULL, 1543400044, 1543400044),
	('im-robot-index', 2, 'im robot index', NULL, NULL, 1543392062, 1543392062),
	('im-robot-update', 2, 'im robot update', NULL, NULL, 1543462272, 1543462272),
	('meet-default', 3, 'meet default', NULL, NULL, 1543388350, 1543388350),
	('meet-default-create', 2, 'meet default create', NULL, NULL, 1543388471, 1543388471),
	('meet-default-delete', 2, 'meet default delete', NULL, NULL, 1543562135, 1543562135),
	('meet-default-index', 2, 'meet default index', NULL, NULL, 1543388350, 1543388350),
	('meet-default-update', 2, 'meet default update', NULL, NULL, 1543567793, 1543567793),
	('meet-default-view', 2, 'meet default view', NULL, NULL, 1543561947, 1543561947),
	('member-default', 3, 'member default', NULL, NULL, 1543387160, 1543387160),
	('member-default-create', 2, 'member default create', NULL, NULL, 1543387712, 1543387712),
	('member-default-delete', 2, 'member default delete', NULL, NULL, 1543569831, 1543569831),
	('member-default-index', 2, 'member default index', NULL, NULL, 1543387160, 1543387160),
	('member-default-update', 2, 'member default update', NULL, NULL, 1543399855, 1543399855),
	('member-default-view', 2, 'member default view', NULL, NULL, 1543563100, 1543563100),
	('myproject-default', 3, 'myproject default', NULL, NULL, 1543455189, 1543455189),
	('myproject-default-create', 2, 'myproject default create', NULL, NULL, 1543455548, 1543455548),
	('myproject-default-index', 2, 'myproject default index', NULL, NULL, 1543455189, 1543455189),
	('plan-default', 3, 'plan default', NULL, NULL, 1543237893, 1543237893),
	('plan-default-index', 2, 'plan default index', NULL, NULL, 1543237893, 1543237893),
	('project', 3, 'project', NULL, NULL, 1543239549, 1543239549),
	('project-create', 2, 'project create', NULL, NULL, 1543239722, 1543239722),
	('project-index', 2, 'project index', NULL, NULL, 1543239549, 1543239549),
	('project-space', 2, 'project space', NULL, NULL, 1543371051, 1543371051),
	('project-update', 2, 'project update', NULL, NULL, 1543310102, 1543310102),
	('project-view', 2, 'project view', NULL, NULL, 1543310095, 1543310095),
	('robot-default', 3, 'robot default', NULL, NULL, 1543391351, 1543391351),
	('robot-default-create', 2, 'robot default create', NULL, NULL, 1543391518, 1543391518),
	('robot-default-index', 2, 'robot default index', NULL, NULL, 1543391351, 1543391351),
	('robot-default-update', 2, 'robot default update', NULL, NULL, 1543462308, 1543462308),
	('robot-message', 3, 'robot message', NULL, NULL, 1543392356, 1543392356),
	('robot-message-index', 2, 'robot message index', NULL, NULL, 1543392356, 1543392356),
	('role', 3, 'role', NULL, NULL, 1543288172, 1543288172),
	('role-create', 2, 'role create', NULL, NULL, 1543288176, 1543288176),
	('role-index', 2, 'role index', NULL, NULL, 1543288172, 1543288172),
	('role-permission', 2, 'role permission', NULL, NULL, 1543288992, 1543288992),
	('role-update', 2, 'role update', NULL, NULL, 1543288233, 1543288233),
	('site', 3, 'site', NULL, NULL, 1543207654, 1543207654),
	('site-index', 2, 'site index', NULL, NULL, 1543207656, 1543207656),
	('space-default', 3, 'space default', NULL, NULL, 1543375474, 1543375474),
	('space-default-create', 2, 'space default create', NULL, NULL, 1543377197, 1543377197),
	('space-default-index', 2, 'space default index', NULL, NULL, 1543375474, 1543375474),
	('space-default-update', 2, 'space default update', NULL, NULL, 1543477938, 1543477938),
	('sprint-default', 3, 'sprint default', NULL, NULL, 1543242478, 1543242478),
	('sprint-default-create', 2, 'sprint default create', NULL, NULL, 1543242482, 1543242482),
	('sprint-default-delete', 2, 'sprint default delete', NULL, NULL, 1543459132, 1543459132),
	('sprint-default-index', 2, 'sprint default index', NULL, NULL, 1543242478, 1543242478),
	('sprint-default-update', 2, 'sprint default update', NULL, NULL, 1543415054, 1543415054),
	('sprint-default-view', 2, 'sprint default view', NULL, NULL, 1543458272, 1543458272),
	('sprint-story', 3, 'sprint story', NULL, NULL, 1543398611, 1543398611),
	('sprint-story-active', 3, 'sprint story active', NULL, NULL, 1543416108, 1543416108),
	('sprint-story-active-create', 2, 'sprint story active create', NULL, NULL, 1543416108, 1543416108),
	('sprint-story-create', 2, 'sprint story create', NULL, NULL, 1543399496, 1543399496),
	('sprint-story-index', 2, 'sprint story index', NULL, NULL, 1543398611, 1543398611),
	('sprint-story-update', 2, 'sprint story update', NULL, NULL, 1543462511, 1543462511),
	('sprint-story-view', 2, 'sprint story view', NULL, NULL, 1543415664, 1543415664),
	('story-status', 3, 'story status', NULL, NULL, 1543394875, 1543394875),
	('story-status-create', 2, 'story status create', NULL, NULL, 1543394956, 1543394956),
	('story-status-index', 2, 'story status index', NULL, NULL, 1543394875, 1543394875),
	('switch-project', 3, 'switch project', NULL, NULL, 1543370113, 1543370113),
	('switch-project-index', 2, 'switch project index', NULL, NULL, 1543370113, 1543370113),
	('update-my-project', 2, '更新自己的项目', '\\app\\rules\\IsMyProject', NULL, 1543312748, 1543312748),
	('user', 3, 'user', NULL, NULL, 1543207753, 1543207753),
	('user-create', 2, 'user create', NULL, NULL, 1543208720, 1543208720),
	('user-index', 2, 'user index', NULL, NULL, 1543207762, 1543207762),
	('user-role', 2, 'user role', NULL, NULL, 1543207775, 1543207775),
	('user-update', 2, 'user update', NULL, NULL, 1543207796, 1543207796),
	('user-view', 2, 'user view', NULL, NULL, 1543209419, 1543209419),
	('开发人员', 1, NULL, NULL, NULL, 1543562615, 1543562615),
	('敏捷教练', 1, NULL, NULL, NULL, 1543562548, 1543562548),
	('管理员', 1, '', NULL, NULL, 1543288187, 1543288472),
	('部门负责人', 1, 'deparment charge', NULL, NULL, 1543218870, 1543218975),
	('项目负责人', 1, NULL, NULL, NULL, 1543388020, 1543388020);
	
	INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('ac-route', '/ac-route/create'),
	('ac-route', '/ac-route/index'),
	('ac-route', '/ac-route/view'),
	('ac-route', 'ac-route-create'),
	('ac-route', 'ac-route-index'),
	('ac-route', 'ac-route-view'),
	('ac-route-create', '/ac-route/create'),
	('ac-route-index', '/ac-route/index'),
	('ac-route-view', '/ac-route/view'),
	('app-module', '/app-module/index'),
	('app-module', 'app-module-index'),
	('app-module-index', '/app-module/index'),
	('auth-permission', '/auth-permission/create'),
	('auth-permission', '/auth-permission/index'),
	('auth-permission', '/auth-permission/update'),
	('auth-permission', 'auth-permission-create'),
	('auth-permission', 'auth-permission-index'),
	('auth-permission', 'auth-permission-update'),
	('auth-permission-create', '/auth-permission/create'),
	('auth-permission-index', '/auth-permission/index'),
	('auth-permission-update', '/auth-permission/update'),
	('auth-role', '/auth-role/create'),
	('auth-role', '/auth-role/index'),
	('auth-role', '/auth-role/permission'),
	('auth-role', '/auth-role/update'),
	('auth-role', 'auth-role-create'),
	('auth-role', 'auth-role-index'),
	('auth-role', 'auth-role-permission'),
	('auth-role', 'auth-role-update'),
	('auth-role-create', '/auth-role/create'),
	('auth-role-index', '/auth-role/index'),
	('auth-role-permission', '/auth-role/permission'),
	('auth-role-update', '/auth-role/update'),
	('auth-rule', '/auth-rule/create'),
	('auth-rule', '/auth-rule/index'),
	('auth-rule', '/auth-rule/update'),
	('auth-rule', '/auth-rule/view'),
	('auth-rule', 'auth-rule-create'),
	('auth-rule', 'auth-rule-index'),
	('auth-rule', 'auth-rule-update'),
	('auth-rule', 'auth-rule-view'),
	('auth-rule-create', '/auth-rule/create'),
	('auth-rule-index', '/auth-rule/index'),
	('auth-rule-update', '/auth-rule/update'),
	('auth-rule-view', '/auth-rule/view'),
	('backlog-acceptance', '/backlog/acceptance/create'),
	('backlog-acceptance', '/backlog/acceptance/index'),
	('backlog-acceptance', 'backlog-acceptance-create'),
	('backlog-acceptance', 'backlog-acceptance-index'),
	('backlog-acceptance-create', '/backlog/acceptance/create'),
	('backlog-acceptance-index', '/backlog/acceptance/index'),
	('backlog-default', '/backlog/default/create'),
	('backlog-default', '/backlog/default/index'),
	('backlog-default', 'backlog-default-create'),
	('backlog-default', 'backlog-default-index'),
	('backlog-default-create', '/backlog/default/create'),
	('backlog-default-index', '/backlog/default/index'),
	('change-default', '/change/default/create'),
	('change-default', '/change/default/index'),
	('change-default', 'change-default-create'),
	('change-default', 'change-default-index'),
	('change-default-create', '/change/default/create'),
	('change-default-index', '/change/default/index'),
	('event', '/event/create'),
	('event', '/event/index'),
	('event', '/event/update'),
	('event', 'event-create'),
	('event', 'event-index'),
	('event', 'event-update'),
	('event-create', '/event/create'),
	('event-handler', '/event-handler/create'),
	('event-handler', '/event-handler/index'),
	('event-handler', '/event-handler/update'),
	('event-handler', 'event-handler-create'),
	('event-handler', 'event-handler-index'),
	('event-handler', 'event-handler-update'),
	('event-handler-create', '/event-handler/create'),
	('event-handler-index', '/event-handler/index'),
	('event-handler-update', '/event-handler/update'),
	('event-index', '/event/index'),
	('event-update', '/event/update'),
	('im-robot', '/im-robot/create'),
	('im-robot', '/im-robot/index'),
	('im-robot', '/im-robot/update'),
	('im-robot', 'im-robot-create'),
	('im-robot', 'im-robot-index'),
	('im-robot', 'im-robot-update'),
	('im-robot-create', '/im-robot/create'),
	('im-robot-index', '/im-robot/index'),
	('im-robot-update', '/im-robot/update'),
	('meet-default', '/meet/default/create'),
	('meet-default', '/meet/default/delete'),
	('meet-default', '/meet/default/index'),
	('meet-default', '/meet/default/update'),
	('meet-default', '/meet/default/view'),
	('meet-default', 'meet-default-create'),
	('meet-default', 'meet-default-delete'),
	('meet-default', 'meet-default-index'),
	('meet-default', 'meet-default-update'),
	('meet-default', 'meet-default-view'),
	('meet-default-create', '/meet/default/create'),
	('meet-default-delete', '/meet/default/delete'),
	('meet-default-index', '/meet/default/index'),
	('meet-default-update', '/meet/default/update'),
	('meet-default-view', '/meet/default/view'),
	('member-default', '/member/default/create'),
	('member-default', '/member/default/delete'),
	('member-default', '/member/default/index'),
	('member-default', '/member/default/update'),
	('member-default', '/member/default/view'),
	('member-default', 'member-default-create'),
	('member-default', 'member-default-delete'),
	('member-default', 'member-default-index'),
	('member-default', 'member-default-update'),
	('member-default', 'member-default-view'),
	('member-default-create', '/member/default/create'),
	('member-default-delete', '/member/default/delete'),
	('member-default-index', '/member/default/index'),
	('member-default-update', '/member/default/update'),
	('member-default-view', '/member/default/view'),
	('myproject-default', '/myproject/default/create'),
	('myproject-default', '/myproject/default/index'),
	('myproject-default', 'myproject-default-create'),
	('myproject-default', 'myproject-default-index'),
	('myproject-default-create', '/myproject/default/create'),
	('myproject-default-index', '/myproject/default/index'),
	('plan-default', '/plan/default/index'),
	('plan-default', 'plan-default-index'),
	('plan-default-index', '/plan/default/index'),
	('project', '/project/create'),
	('project', '/project/index'),
	('project', '/project/space'),
	('project', '/project/update'),
	('project', '/project/view'),
	('project', 'project-create'),
	('project', 'project-index'),
	('project', 'project-space'),
	('project', 'project-update'),
	('project', 'project-view'),
	('project-create', '/project/create'),
	('project-index', '/project/index'),
	('project-space', '/project/space'),
	('project-update', '/project/update'),
	('project-view', '/project/view'),
	('robot-default', '/robot/default/create'),
	('robot-default', '/robot/default/index'),
	('robot-default', '/robot/default/update'),
	('robot-default', 'robot-default-create'),
	('robot-default', 'robot-default-index'),
	('robot-default', 'robot-default-update'),
	('robot-default-create', '/robot/default/create'),
	('robot-default-index', '/robot/default/index'),
	('robot-default-update', '/robot/default/update'),
	('robot-message', '/robot-message/index'),
	('robot-message', 'robot-message-index'),
	('robot-message-index', '/robot-message/index'),
	('role', '/role/create'),
	('role', '/role/index'),
	('role', '/role/permission'),
	('role', '/role/update'),
	('role', 'role-create'),
	('role', 'role-index'),
	('role', 'role-permission'),
	('role', 'role-update'),
	('role-create', '/role/create'),
	('role-index', '/role/index'),
	('role-permission', '/role/permission'),
	('role-update', '/role/update'),
	('site', '/site/index'),
	('site', 'site-index'),
	('site-index', '/site/index'),
	('space-default', '/space/default/create'),
	('space-default', '/space/default/index'),
	('space-default', '/space/default/update'),
	('space-default', 'space-default-create'),
	('space-default', 'space-default-index'),
	('space-default', 'space-default-update'),
	('space-default-create', '/space/default/create'),
	('space-default-index', '/space/default/index'),
	('space-default-update', '/space/default/update'),
	('sprint-default', '/sprint/default/create'),
	('sprint-default', '/sprint/default/delete'),
	('sprint-default', '/sprint/default/index'),
	('sprint-default', '/sprint/default/update'),
	('sprint-default', '/sprint/default/view'),
	('sprint-default', 'sprint-default-create'),
	('sprint-default', 'sprint-default-delete'),
	('sprint-default', 'sprint-default-index'),
	('sprint-default', 'sprint-default-update'),
	('sprint-default', 'sprint-default-view'),
	('sprint-default-create', '/sprint/default/create'),
	('sprint-default-delete', '/sprint/default/delete'),
	('sprint-default-index', '/sprint/default/index'),
	('sprint-default-update', '/sprint/default/update'),
	('sprint-default-view', '/sprint/default/view'),
	('sprint-story', '/sprint/story/create'),
	('sprint-story', '/sprint/story/index'),
	('sprint-story', '/sprint/story/update'),
	('sprint-story', '/sprint/story/view'),
	('sprint-story', 'sprint-story-create'),
	('sprint-story', 'sprint-story-index'),
	('sprint-story', 'sprint-story-update'),
	('sprint-story', 'sprint-story-view'),
	('sprint-story-active', '/sprint/story-active/create'),
	('sprint-story-active', 'sprint-story-active-create'),
	('sprint-story-active-create', '/sprint/story-active/create'),
	('sprint-story-create', '/sprint/story/create'),
	('sprint-story-index', '/sprint/story/index'),
	('sprint-story-update', '/sprint/story/update'),
	('sprint-story-view', '/sprint/story/view'),
	('story-status', '/story-status/create'),
	('story-status', '/story-status/index'),
	('story-status', 'story-status-create'),
	('story-status', 'story-status-index'),
	('story-status-create', '/story-status/create'),
	('story-status-index', '/story-status/index'),
	('switch-project', '/switch-project/index'),
	('switch-project', 'switch-project-index'),
	('switch-project-index', '/switch-project/index'),
	('update-my-project', 'project-update'),
	('user', '/user/create'),
	('user', '/user/index'),
	('user', '/user/role'),
	('user', '/user/update'),
	('user', '/user/view'),
	('user', 'user-create'),
	('user', 'user-index'),
	('user', 'user-role'),
	('user', 'user-update'),
	('user', 'user-view'),
	('user-create', '/user/create'),
	('user-index', '/user/index'),
	('user-role', '/user/role'),
	('user-update', '/user/update'),
	('user-view', '/user/view'),
	('开发人员', 'meet-default-create'),
	('开发人员', 'meet-default-delete'),
	('开发人员', 'meet-default-index'),
	('开发人员', 'meet-default-update'),
	('开发人员', 'meet-default-view'),
	('开发人员', 'myproject-default-create'),
	('开发人员', 'myproject-default-index'),
	('开发人员', 'space-default-index'),
	('开发人员', 'sprint-default-create'),
	('开发人员', 'sprint-default-delete'),
	('开发人员', 'sprint-default-index'),
	('开发人员', 'sprint-default-update'),
	('开发人员', 'sprint-default-view'),
	('开发人员', 'sprint-story-active-create'),
	('开发人员', 'sprint-story-create'),
	('开发人员', 'sprint-story-index'),
	('开发人员', 'sprint-story-update'),
	('开发人员', 'sprint-story-view'),
	('敏捷教练', 'backlog-acceptance-create'),
	('敏捷教练', 'backlog-acceptance-index'),
	('敏捷教练', 'backlog-default-create'),
	('敏捷教练', 'backlog-default-index'),
	('敏捷教练', 'change-default-create'),
	('敏捷教练', 'change-default-index'),
	('敏捷教练', 'meet-default-create'),
	('敏捷教练', 'meet-default-delete'),
	('敏捷教练', 'meet-default-index'),
	('敏捷教练', 'meet-default-update'),
	('敏捷教练', 'meet-default-view'),
	('敏捷教练', 'member-default-create'),
	('敏捷教练', 'member-default-delete'),
	('敏捷教练', 'member-default-index'),
	('敏捷教练', 'member-default-update'),
	('敏捷教练', 'member-default-view'),
	('敏捷教练', 'myproject-default-create'),
	('敏捷教练', 'myproject-default-index'),
	('敏捷教练', 'robot-default-create'),
	('敏捷教练', 'robot-default-index'),
	('敏捷教练', 'robot-default-update'),
	('敏捷教练', 'space-default-create'),
	('敏捷教练', 'space-default-index'),
	('敏捷教练', 'space-default-update'),
	('敏捷教练', 'sprint-default-create'),
	('敏捷教练', 'sprint-default-delete'),
	('敏捷教练', 'sprint-default-index'),
	('敏捷教练', 'sprint-default-update'),
	('敏捷教练', 'sprint-default-view'),
	('敏捷教练', 'sprint-story-active-create'),
	('敏捷教练', 'sprint-story-create'),
	('敏捷教练', 'sprint-story-index'),
	('敏捷教练', 'sprint-story-update'),
	('敏捷教练', 'sprint-story-view'),
	('项目负责人', 'backlog-acceptance-create'),
	('项目负责人', 'backlog-acceptance-index'),
	('项目负责人', 'backlog-default-create'),
	('项目负责人', 'backlog-default-index'),
	('项目负责人', 'change-default-create'),
	('项目负责人', 'change-default-index'),
	('项目负责人', 'meet-default-create'),
	('项目负责人', 'meet-default-delete'),
	('项目负责人', 'meet-default-index'),
	('项目负责人', 'meet-default-update'),
	('项目负责人', 'meet-default-view'),
	('项目负责人', 'member-default-create'),
	('项目负责人', 'member-default-delete'),
	('项目负责人', 'member-default-index'),
	('项目负责人', 'member-default-update'),
	('项目负责人', 'member-default-view'),
	('项目负责人', 'myproject-default-create'),
	('项目负责人', 'myproject-default-index'),
	('项目负责人', 'robot-default-create'),
	('项目负责人', 'robot-default-index'),
	('项目负责人', 'robot-default-update'),
	('项目负责人', 'space-default-create'),
	('项目负责人', 'space-default-index'),
	('项目负责人', 'space-default-update'),
	('项目负责人', 'sprint-default-create'),
	('项目负责人', 'sprint-default-delete'),
	('项目负责人', 'sprint-default-index'),
	('项目负责人', 'sprint-default-update'),
	('项目负责人', 'sprint-default-view'),
	('项目负责人', 'sprint-story-active-create'),
	('项目负责人', 'sprint-story-create'),
	('项目负责人', 'sprint-story-index'),
	('项目负责人', 'sprint-story-update'),
	('项目负责人', 'sprint-story-view');
	
INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
	('\\app\\rules\\IsMyProject', _binary 0x4F3A32313A226170705C72756C65735C49734D7950726F6A656374223A333A7B733A343A226E616D65223B733A32323A225C6170705C72756C65735C49734D7950726F6A656374223B733A393A22637265617465644174223B693A313534333330393933353B733A393A22757064617465644174223B693A313534333330393933353B7D, 1543309935, 1543309935);

INSERT INTO `gt_change_category` (`id`, `name`) VALUES
	(1, 'SQL');
	
INSERT INTO `gt_event` (`id`, `created_at`, `updated_at`, `name`, `code`, `intro`) VALUES
	(1, 1543392882, 1543548341, '添加新的故事', 'sprint.story.create', '在迭代计划中添加新的故事'),
	(2, 1543548739, 1543551967, '更新故事', 'sprint.story.change', '在迭代计划中通过修改状态或者指派新的处理');

INSERT INTO `gt_event_handler` (`id`, `event_id`, `created_at`, `updated_at`, `name`, `handler`, `intro`) VALUES
	(1, 1, 1543462486, 1543549720, '发送机器人消息', '\\modules\\sprint\\handlers\\OnCreateStorySendMessageHandler', '发送标题消息'),
	(2, 2, 1543549761, 1543551513, '发送机器人消息', '\\modules\\sprint\\handlers\\OnChangeStorySendMessageHandler', '发送标题消息');
	
INSERT INTO `gt_project` (`id`, `name`, `web_site`, `is_achived`, `creator_id`, `created_at`, `updated_at`, `is_del`) VALUES
	(1, '我的第一个项目', 'http://www.my-first-project.com', 0, 1, 1543371042, 1543371042, 0);
INSERT INTO `gt_project_member` (`project_id`, `user_id`, `position`) VALUES
	(1, 1, '项目负责人');
INSERT INTO `gt_robot` (`id`, `created_at`, `updated_at`, `name`, `code_full_class`) VALUES
	(1, 1543400079, 1543462291, '钉钉', '\\app\\robots\\DingTalkRobot');
INSERT INTO `gt_role` (`id`, `name`, `scope`, `description`, `is_sys`) VALUES
	(1, '管理员', 'ADMIN', '', 1),
	(2, '项目负责人', 'POSITION', 'product owner', 1),
	(3, '敏捷教练', 'POSITION', 'project master', 1),
	(4, '开发人员', 'POSITION', 'developer', 1);
	
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

INSERT INTO `gt_timeline` (`id`, `project_id`, `title`, `description`) VALUES
	(1, 1, '2018-11-28', '第一个目标');
INSERT INTO `gt_user` (`id`, `username`, `nick_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `mobile`, `status`, `is_admin`, `is_super`, `def_project`, `created_at`, `updated_at`, `role`, `is_del`) VALUES
	(1, 'admin', '管理员', 'dFIfQutSickXRaQXsZSCPB1LAJZ6FnbA', '$2y$13$m5Z6Ruhoi3NIVaCCdnhuvO4tS9SEeMOFEIWy4UXAw39qqPJaRVzTu', NULL, 'dungang@126.com', '', 10, 1, 1, 1, 1543204772, 1543460613, '部门负责人', 0);
	