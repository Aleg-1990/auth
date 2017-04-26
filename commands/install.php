<?php

// autoload
require_once(__DIR__.'/../vendor/autoload.php');

Db::getConnection()->query('CREATE table '.\ActiveRecord\User::TABLE_NAME.'(
    `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)');