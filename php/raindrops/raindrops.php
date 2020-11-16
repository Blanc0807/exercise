<?php

function raindrops($number)
{
    $obj =new RainDrops($number);
    return $obj->string;
}


class RainDrops
{
    const FACTOR = [
        'THREE_FACTOR' => [
            'FACTOR'    =>  3,
            'OUTPUT'    =>  'Pling'
        ],
        'FIVE_FACTOR' => [
            'FACTOR'    =>  5,
            'OUTPUT'    =>  'Plang'
        ],
        'SEVEN_FACTOR' => [
            'FACTOR'    =>  7,
            'OUTPUT'    =>  'Plong'
        ]
    ];
    protected $number;
    public $string = '';

    public function __construct($number)
    {
        $this->number = $number;
        $this->hasFactor();
    }

    protected function hasFactor() {
        foreach (self::FACTOR as $item) {
            if( $this->number%$item['FACTOR'] === 0 ){
                $this->string .= $item['OUTPUT'];
            }
        }
        if (!$this->string) {
            $this->string = (string)$this->number;
        }
        return $this;
    }
}
