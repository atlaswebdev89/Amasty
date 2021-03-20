<?php

if(isset($_POST) && !empty($_POST)){
    //Формируем массив номиналов купюр в банкомате
    if($_POST['rated'] && preg_match('/^[\d\s.,\/\\\_-]+$/', $_POST['rated'])) {
        $keywords = preg_split("/[\s.,\/\\\_-]+/", $_POST['rated']);
    }else {
        send_message("Проверьте введенные данные", FALSE, 10);
    }
    
    //Удаляем пустые элементы массива
    if(is_array($keywords) && !empty($keywords)) {
        $keywords = array_diff($keywords, array(''));
    }
    //Сортируем в порядке убывания
        rsort($keywords);
    //Минимальная и максимальная купюра в банкомате
        $count = count($keywords);
        $max_nom = $keywords[0];
        $min_nom = $keywords[$count -1];
        
    
    if(isset($_POST['summa']) && !empty($_POST['summa']) && (int)($_POST['summa'])) {
        $summ = $_POST['summa'];
    }
    //
    if($summ < $min_nom) {
       send_message("Неверная сумма. Минимально возможная к выдаче сумма {$min_nom}", FALSE, 20);
    }
    
    //Проверяем возможность выдать указанную сумму 
    if($summ % $min_nom != 0) {
        $a = intval($summ/$min_nom);
        //Находим диапазон ближайших возможных к выдаче сумм относительно заданной
            $min_val = $a*$min_nom;
            $max_val = $min_val+$min_nom;
            if($summ > $min_val && $summ < $max_val) {
                send_message("Неверная сумма. Выберите {$min_val} или {$max_val}", FALSE, 20);
            }
    }
    
    //Находим номинал купюр и их количество
    foreach ($keywords as $nominal) {
        if($summ >= $nominal) {
            $c = intval($summ/$nominal);
            $o = ($summ % $nominal);
            $mas[$nominal]=$c;
            //Изменяем оставшуюся сумму
            $summ = $o;
        }else {
            $mas[$nominal]=0;
            continue;
        }
    }
    if(is_array($mas) && !empty($mas)) {
        send_message($mas, TRUE, 200);
    }else {
        send_message("В Банкомате нет купюр для выдачи", FALSE, 30);
    }
}

function send_message ($message, $status, $code){
            $a =[
                'status' => $status,
                'code' => $code,
                'message'=>$message
            ];
        echo json_encode($a);
    die();
}

