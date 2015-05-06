<?php
/*
 * Базовая модель, в которой инициализируется подключение
 * и от которой наследуются все таблицы
 */
class AppModel {
    public function __construct() {
        if (!Config::$pdo) {
            $host = Config::$values['db_host'];
            $db = Config::$values['db_name'];

            $this->pdo = new PDO(
                'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8',
                Config::$values['login'],
                Config::$values['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            Config::$pdo = $this->pdo;
        } else {
            $this->pdo = Config::$pdo;
        }
    }
}