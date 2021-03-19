<?php

namespace MyClasses;

abstract class AbstractChessmen  implements \MyInterfaces\IChessmen
{
    public $x;
    public $y;

    public function __construct(int $x, int $y)
    {
        //Проверяем значения на соответсвие допустимых значений шахматной доски
        $this->validXY($x,$y);

        $this->x = $x;
        $this->y = $y;
    }

    public function move (int $x, int $y) {
        //Переопределена в дочерних классах
    }

    //Текущая позиция
    public function getPosition()
    {
            if(isset($this->x) && !empty($this->x)) {
                $arr['x'] = $this->x;
            }
            if(isset($this->y) && !empty($this->y)) {
                $arr['y'] = $this->y;
            }
        return $arr;
    }

    //Функция проверки переданных координат на соответствие допустимых значений шахматной доски
    protected function validXY($x, $y) {
        if($x<1 || $x>8 ) {
            throw new \CustomException\EdgeChessboardException ("Не допустимое значение X={$x}", 50);
        }
        if($y<1 || $y>8) {
            throw new \CustomException\EdgeChessboardException ("Не допустимое значение Y={$y}", 50);
        }
    }
}