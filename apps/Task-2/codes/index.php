<?php

$slova = [
            'red'       =>      '#FF0000',
            'blue'      =>      '#0000FF',
            'green'     =>      '#008000',
            'yellow'    =>      '#FFFF00',
            'lime'      =>      '#00FF00',
            'magenta'   =>      '#FF00FF',
            'black'     =>      '#000000',
            'gold'      =>      '#FFD700',
            'gray'      =>      '#808080',
            'tomato'    =>      '#FF6347',
         ];
        
        echo '<div>';
            $string =1; 
            while($string < 6){
                $keys = array_rand($slova, 5);  
                echo '<p style=" font-size:30px;">';
                   foreach ($keys as $key) {
                       $item_color = $slova[$key];
                       //Удаляем текущий цвет из массива
                       unset($slova[$key]);
                       //Определяем рандомно цвет 
                       $color = $slova[array_rand($slova, 1)];
                       
                            echo '<span style="color:'.$color.';"> ' .$key. ' </span>';
                       
                       //Возвращаем в массив цвет 
                       $slova[$key] = $item_color;
                   }
                $string++;
            }
        echo '</div>'; 
       
         