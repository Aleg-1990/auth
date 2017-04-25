<?php

class Db
{
    /**
     * @var \PDO
     */
    private static $connection;

    /**
     * @return \PDO
     */
    public static function getConnection()
    {
        if(! self::$connection instanceof \PDO) {
            $config = [
                'host' => '127.0.0.1',
                'db_name' => 'test',
                'db_user' => 'root',
                'db_password' => '',
            ];

            // here we can change config

            $dsn = 'mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset=UTF8';

            self::$connection = new \PDO($dsn, $config['db_user'], $config['db_password']);
        }
        return self::$connection;
    }
}