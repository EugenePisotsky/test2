<?php
define('ROOT', dirname(__FILE__));

class Config {
    public static $values = [];
    public static $pdo = false;
}

/*
 * Все настройки здесь
 */
Config::$values = [
    'db_host' => 'localhost',
    'db_name' => 'test1',
    'login' => 'root',
    'password' => '******',
    'default_lang' => 'ru',
    'salt' => 'test_salt_value',

    'uploadPath' => ROOT . '/images/',
    'noPhotoFile' => 'no_image_available.png',
    'templatesDir' => ROOT . '/templates/',
    'i18nDir' => ROOT . '/i18n/'
];
