<?php

class Robot {
    protected string $name;
    protected static array $usedName = [];

    public function __construct()
    {
        $this->newName();
    }

    public function reset() {
        $this->newName();
    }

    public function getName() {
        return $this->name;
    }

    protected function newName() {
        $name = chr(mt_rand(65, 90))
            .chr(mt_rand(65, 90))
            .mt_rand(0, 9)
            .mt_rand(0, 9)
            .mt_rand(0, 9);
        if (in_array($name, static::$usedName)) {
            return $this->newName();
        }
        static::$usedName[] = $name;

        $this->name = $name;
    }
}