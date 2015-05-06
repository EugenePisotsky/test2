<?php
/*
 * Мини-шаблонизатор. Просто подключаем файл шаблона и генерируем переменные
 */

class View {
    public static function display($template, $variables = []) {
        header('Content-Type: text/html; charset=utf-8');

        foreach ($variables as $key => $value) {
            $$key = $value;
        }

        require Config::$values['templatesDir'] . 'template.tpl.php';
    }
}