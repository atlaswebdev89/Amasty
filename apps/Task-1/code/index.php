<?php

$root =  $root = rtrim($_SERVER['DOCUMENT_ROOT']);
//Composer autoload classes
require_once 'vendor/autoload.php';

try{
    $queen = new \MyClasses\Queen(1,1);
    $king = new \MyClasses\King(4,3);

    //Перемещаем фигуры
    $queen->move(7,3);
    $king->move(2,2);

    echo "Позиция Queen: \n";
    print_r($position=$queen ->getPosition());
    echo "Позиция King: \n";
    print_r($position=$king ->getPosition());

}catch (\CustomException\AreaInvalidException $e) {
    echo $e->getMessage()."\n";

    echo "Позиция King: \n";
    print_r($position=$king ->getPosition());

    echo "Позиция Queen: \n";
    print_r($position=$queen ->getPosition());

}catch (\CustomException\EdgeChessboardException $e) {
    echo $e->getMessage()."\n";
}catch (\Exception $e) {
    echo $e->getMessage()."\n";
}
