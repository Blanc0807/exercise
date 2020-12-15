<?php

class Allergen
{
    const EGGS = 1;
    const PEANUTS = 2;
    const SHELLFISH = 4;
    const STRAWBERRIES = 8;
    const TOMATOES = 16;
    const CHOCOLATE = 32;
    const POLLEN = 64;
    const CATS = 128;
    protected int $score;

    public function __construct($score)
    {
        $this->score = $score;
    }

    public static function allergenList()
    {
        return array_map(function ($allergen) {
            return new Allergen($allergen);
        }, (new ReflectionClass(static::class))->getConstants());

    }

    public function getScore()
    {
        return $this->score;
    }
}

class Allergies
{
    protected int $score;

    public function __construct($score)
    {
        $this->score = $score;
    }

    public function isAllergicTo(Allergen $allergen)
    {
        return ($this->score & $allergen->getScore()) > 0;
    }

    public function getList()
    {
        return array_filter(Allergen::allergenList(), function ($allergen) {
            return $this->isAllergicTo($allergen);
        });
    }
}