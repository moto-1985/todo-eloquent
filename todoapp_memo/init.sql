
-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(15) NOT NULL COMMENT '姓',
  `last_name` VARCHAR(15) NULL DEFAULT NULL COMMENT '名',
  `email` VARCHAR(64) NOT NULL COMMENT 'メールアドレス',
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'メール検証日時',
  `locked_flag` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'アカウントロック状態(0:通常, 1:ロック中)',
  `expires_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'アカウント有効期限',
  `password` VARCHAR(255) NOT NULL COMMENT 'パスワード',
  `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '登録日時',
  `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '更新日時',
  `deleted_at` TIMESTAMP NULL DEFAULT NULL COMMENT '削除日時',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_bin
COMMENT = 'アカウント';

-- -----------------------------------------------------
-- Table `tasks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tasks` ;

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(15) unsigned NOT NULL COMMENT '担当者ID',
  `title` VARCHAR(255) NOT NULL COMMENT 'タイトル',
  `content` TEXT NULL DEFAULT NULL COMMENT '内容',
  `attached_file_path` VARCHAR(255) NULL DEFAULT NULL COMMENT '添付ファイル',
  `status` ENUM('Notstarted', 'Doing', 'Done') NOT NULL DEFAULT 'Notstarted' COMMENT 'ステータス',
  `start_date` DATE NULL DEFAULT NULL COMMENT '開始日',
  `end_date` DATE NULL DEFAULT NULL COMMENT '終了日',
  `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '登録日時',
  `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '更新日時',
  `deleted_at` TIMESTAMP NULL DEFAULT NULL COMMENT '削除日時',
  PRIMARY KEY (`id`),
  CONSTRAINT `PK_users_tasks`
  FOREIGN KEY (`user_id`)
  REFERENCES `users` (`id`)
  )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_bin
COMMENT = 'タスク';

-- -----------------------------------------------------
-- Table `bookmarks`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `bookmarks` ;

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(15) unsigned NOT NULL COMMENT 'ユーザID',
  `task_id` bigint(15) unsigned NOT NULL COMMENT 'タスクID',
  `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '登録日時',
  `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`user_id`,`task_id`),
  CONSTRAINT `PK_users_bookmarks`
  FOREIGN KEY (`user_id`)
  REFERENCES `users` (`id`),
  CONSTRAINT `PK_tasks_bookmarks`
  FOREIGN KEY (`task_id`)
  REFERENCES `tasks` (`id`)
  )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_bin
COMMENT = 'ブックマーク';