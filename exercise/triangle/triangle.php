<?php

class Triangle
{
    protected array $sides;
    const SIDES_MAP = [
        1   =>  'equilateral',
        2   =>  'isosceles',
        3   =>  'scalene'
    ];

    public function __construct($a, $b, $c)
    {
        $this->sides = [$a, $b, $c];
        sort($this->sides);
        $this->checkSides();
    }

    public function kind()
    {
        //compare three sides
        /*
        if ($this->sides[0] == $this->sides[1]){
            return $this->sides[2] == $this->sides[0] ? 'equilateral' : 'isosceles';
        }elseif($this->sides[2] == $this->sides[0] or $this->sides[2] == $this->sides[1]){
            return 'isosceles';
        }else{
            return 'scalene';
        }
        */
        return self::SIDES_MAP[count(array_unique($this->sides))];
    }

    private function checkSides()
    {
        if ($this->sides[0] + $this->sides[1] <= $this->sides[2]){
            throw new Exception();
        }
    }
}