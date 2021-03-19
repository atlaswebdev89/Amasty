<?php

namespace MyClasses;

class King extends \MyClasses\AbstractChessmen
{
    public function move (int $x, int $y) {
        //Проверка введенных координат
        $this->validXY($x,$y);
        //Допустимые значения
        $AreaValid = $this->validArea();
            if($y>$AreaValid['Ymax'] || $y<$AreaValid['Ymin']) {
                throw new \CustomException\AreaInvalidException("Не допустимое значение Y={$y} для текущей фигуры", 50);
            }
            if($x>$AreaValid['Xmax'] || $x<$AreaValid['Xmin']) {
                throw new \CustomException\AreaInvalidException("Не допустимое значение X={$x} для текущей фигуры", 50);
            }
        $this->x = $x;
        $this->y = $y;
    }
    //Функция получение допустимых значений перемещения фигуры относительно текущего положения
    protected function validArea () {
        $arr = [];
            $arr['Ymax'] = (($this->y+1)<= 8)?($this->y+1):($this->y);
            $arr['Ymin'] = (($this->y-1)>= 1)?($this->y-1):($this->y);

            $arr['Xmax'] = (($this->x+1)<= 8)?($this->x+1):($this->x);
            $arr['Xmin'] = (($this->x-1)>= 1)?($this->x-1):($this->x);
        return $arr;
    }
}