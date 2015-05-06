<?php
/*
 * Фабрика для моделей
 */
class Model {
    protected static $models = [];

    public static function get($model) {
        if (!isset(self::$models[$model])) {
            $cls = $model . 'Table';

            require ROOT . '/models/' . $cls . '.php';

            self::$models[$model] =  new $cls();
        }

        return self::$models[$model];
    }
}