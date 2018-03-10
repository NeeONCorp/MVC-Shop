<?php

Class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        $dsn = 'mysql:host=' . $params['host'] . ';dbname=' . $params['db'] . ';charset=' . $params['charset'];

        try {
            $pdo = new PDO($dsn, $params['user'], $params['pass']);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }

        return $pdo;
    }
}