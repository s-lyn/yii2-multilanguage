CREATE TABLE `user` (
	`id` integer PRIMARY KEY AUTOINCREMENT NOT NULL,
	`username` varchar(255) NOT NULL UNIQUE,
	`auth_key` varchar(32) NOT NULL,
	`password_hash` varchar(255) NOT NULL,
	`password_reset_token` varchar(255) UNIQUE,
	`email` varchar(255) NOT NULL UNIQUE,
	`status` smallint NOT NULL DEFAULT 10,
	`created_at` integer NOT NULL,
	`updated_at` integer NOT NULL
)