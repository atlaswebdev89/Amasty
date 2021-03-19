<?php

namespace MyInterfaces;

interface IChessmen
{
    public function move (int $x, int $y);
    public function getPosition();
}