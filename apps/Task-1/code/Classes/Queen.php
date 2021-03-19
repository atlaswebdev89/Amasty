<?php

namespace MyClasses;

class Queen extends \MyClasses\AbstractChessmen
{
    public function move(int $x, int $y) {
            //Проверка введенных координат
            $this->validXY($x,$y);
            //Проверка допустимой области перехода фигуры
            $this->validAreaQueen($x, $y);
            //Изменяем текущее положение фигуры на шахматной доске
            $this->x = $x;
            $this->y = $y;
    }

    protected function validAreaQueen ($x, $y) {
            //Находим смещение относительно текущей позиции
            $s_y = abs($this->y - $y);
            $s_x = abs($this->x - $x);
            if($s_x >0 && $s_y>0) {
                if(($s_x-$s_y) != 0) {
                    throw new \CustomException\AreaInvalidException("Не допустимое значение смещения для текущей фигуры ".__CLASS__, 50);
                }
            }
    }
}