<?php


class Robot
{

    const DIRECTION_NORTH = 0;
    const DIRECTION_EAST = 1;
    const DIRECTION_SOUTH = 2;
    const DIRECTION_WEST = 3;
    const DIRECTION_TO_POINT = [
        [0, 1],//N
        [1, 0],//E
        [0, -1],//S
        [-1, 0]//W
    ];

    public array $position;
    public int $direction;


    public function __construct($position, $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function turnRight()
    {
        $this->setDirection($this->direction + 1);
        return $this;
    }

    protected function setDirection($direction)
    {
        if ($direction < 0)
            $direction = 3;
        if ($direction > 3) {
            $direction = 0;
        }
        $this->direction = $direction;
    }

    public function turnLeft()
    {
        $this->setDirection($this->direction - 1);
        return $this;
    }

    public function advance()
    {
        $move = static::DIRECTION_TO_POINT[$this->direction];
        $this->position[0] += $move[0];
        $this->position[1] += $move[1];
        return $this;
    }

    public function instructions($command)
    {
        if (preg_match('/[^RLA]/', $command)){
            throw new InvalidArgumentException();
        }
        foreach (str_split($command) as $cmd) {
//            try {
                $this->{'execCmd' . $cmd}();
//            } catch (Throwable $e) {
//                throw new InvalidArgumentException();
//            };
        }

    }

    protected function execCmdA()
    {
        $this->advance();
    }

    protected function execCmdR()
    {
        $this->turnRight();
    }

    protected function execCmdL()
    {
        $this->turnLeft();
    }

}
