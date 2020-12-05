-- CREATE DATABASE example;
-- use example;

-- このファイルにテーブルとデータの初期化を書く。下記は例

-- CREATE TABLE `comments` (
--   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `tweett_id` int(10) unsigned NOT NULL,
--   `user_id` int(10) unsigned NOT NULL,
--   `body` varchar(255) NOT NULL,
--   `created` datetime NOT NULL,
--   `modified` datetime NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE `tweets` (
--   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `user_id` int(10) unsigned NOT NULL,
--   `body` varchar(255) NOT NULL,
--   `created` datetime NOT NULL,
--   `modified` datetime NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE `users` (
--   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `user_name` varchar(16) NOT NULL,
--   `password` varchar(255) NOT NULL,
--   `email` varchar(255) NOT NULL,
--   `created` datetime NOT NULL,
--   `modified` datetime NOT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `username` (`username`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- INSERT INTO users (user_name, password, email, created, modified)
-- VALUES
--   ('takaya', 'test1','ryoutakaya3623@yahoo.co.jp', now(), now()),
--   ('yamada', 'test2','ryoutakaya3623@gmail.com', now(), now()),
--   ('honda', 'test3','paluca3623@gmail.com', now(), now());

-- INSERT INTO tweets (user_id, body, created, modified)
-- VALUES
--   ( 2, '眠い', now(), now()),
--   ( 1, 'お腹すいた', now(), now());
