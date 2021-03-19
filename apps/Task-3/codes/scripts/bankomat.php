<?php

if(isset($_POST) && !empty($_POST)){
    //Формируем массив номиналов купюр в банкомате
    if($_POST['rated'] && preg_match('/^[\d\s.,\/\\\_-]+$/', $_POST['rated'])) {
        $keywords = preg_split("/[\s.,\/\\\_-]+/", $_POST['rated']);
    }else {
        echo json_encode(['status' => FALSE, 'message' => 'Проверьте введенные данные']);
    }
    
    //Удаляем пустые элементы массива
    if(is_array($keywords) && !empty($keywords)) {
        $keywords = array_diff($keywords, array(''));
    }
    //Сортируем в порядке убывания
        rsort($keywords);
    
    
    
    
    echo json_encode(['status'=>true,'message'=>'Все отлично']);
}

