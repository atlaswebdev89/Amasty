<?php

//Корень проекта
$root =  $root = rtrim($_SERVER['DOCUMENT_ROOT']);
//Подключаем парсер html
require_once $root.'/lib/simple_html_dom.php';

print_r($_POST);