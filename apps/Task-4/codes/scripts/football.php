<?php

//Корень проекта
$root =  $root = rtrim($_SERVER['DOCUMENT_ROOT']);
//Подключаем парсер html
require_once $root.'/lib/simple_html_dom.php';

//Адрес ресурса
$domen = 'https://terrikon.com';
//uri нужной страницы
$url_archive = $domen.'/football/italy/championship/archive';

if(isset($_POST) && !empty($_POST['football_club'])) {
    $club_value=mb_convert_case($_POST['football_club'],MB_CASE_TITLE, 'UTF-8');
}
$html=file_get_html($url_archive);

$links = $html->find('.news',0)->find('a');

//Формируем массив ссылок на результаты каждого из доступных сезонов
foreach ($links as $link) {
    $arr[$link->plaintext]=$link->href;
}

//Формируем массив с полученными результатами по всем сезонам
foreach ($arr as $key=>$season) {
    //Получаем html страницы результатов конкретного сезона Серии А
    $html=file_get_html($domen.$season);
    //Находим таблицу результатов
    $table = $html->find('table',0);
    //Находим название клубов
    $club = $table->find('tr');
    
    foreach ($club as $item){
        if($item->find('td a',0) && $item->find('td a',0)->plaintext === $club_value) {
                $result[$key]=$item->find('td',0)->plaintext;
        }       
    }
}

    if($result) {
        echo json_encode([
            'status' => true,
            'club' => $club_value,
            'message' => $result
        ]);
    }else {
        echo json_encode([
            'status' => false,
            'club' => $club_value,
            'message' => 'Ошибка получения данных. Проверьте правильность введенных данных...'
        ]);
    }