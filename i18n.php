<?php
/*
 * Что-то вроде синглтона, для языковых файлов
 */
class i18n {
    protected static $instance = false;
    protected $values = [];

    function __construct() {
        $i18n = [];
        $lang = (isset($_COOKIE['lang'])) ? $_COOKIE['lang'] : Config::$values['default_lang'];

        require Config::$values['i18nDir'] . $lang . '.lng.php';

        $this->values = $i18n;
    }

    public static function setLang($lang) {
        setcookie("lang", $lang, time()+ (3600 * 24 * 365));
    }

    public static function msg($key) {
        if (!self::$instance) {
            self::$instance = new self();
        }

        $c = self::$instance;

        if (isset($c->values[$key])) {
            return $c->values[$key];
        }

        return $key;
    }
}