<?php

$root =  $root = rtrim($_SERVER['DOCUMENT_ROOT']);
//Composer autoload classes
require_once 'vendor/autoload.php';





try{
    $queen = new \MyClasses\Queen(1,1);
    $king = new \MyClasses\King(4,3);

    //Перемещаем фигуры
    $king->move(2,2);
    $queen->move(7,3);

    print_r($position=$king ->getPosition());



}catch (\CustomException\AreaInvalidException $e) {
    echo $e->getMessage()."\n";
}catch (\CustomException\EdgeChessboardException $e) {
    echo $e->getMessage()."\n";
}catch (\Exception $e) {
    echo $e->getMessage()."\n";
}