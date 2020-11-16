<?php

class PhoneNumber
{
    protected string $number;
    protected int $length;
    const ERROR = [
        1 => 'punctuations not permitted',
        2 => 'letters not permitted',
        3 => '11 digits must start with 1',
        4 => 'incorrect number of digits',
        5 => 'more than 11 digits',
        6 => 'area code cannot start with zero',
        7 => 'area code cannot start with one',
        8 => 'exchange code cannot start with zero',
        9 => 'exchange code cannot start with one'
    ];

    public function __construct($number)
    {
        $this->number = str_replace([' ', '-', '.', '(', ')', '+'], '', $number);
        $this->length = strlen($this->number);
        $this->checkIllegalInput()
            ->checkLength()
            ->checkAreaCode()
            ->checkExchangeCode();
    }

    public function number()
    {
        return $this->number;
    }

    private function checkIllegalInput(): PhoneNumber
    {
        if (preg_match('/[@!:]/', $this->number)) {
            $this->throwError(1);
        }
        if (preg_match('/[a-zA-Z]/', $this->number)) {
            $this->throwError(2);
        }
        return $this;
    }

    private function checkLength(): PhoneNumber
    {
        if ($this->length == 11) {
            if ($this->number[0] != 1) {
                $this->throwError(3);
            }
            $this->number = substr($this->number, 1);
        }
        if ($this->length < 10) {
            $this->throwError(4);
        }

        if ($this->length > 11) {
            $this->throwError(5);
        }
        return $this;
    }

    private function throwError(int $error)
    {
        throw new InvalidArgumentException(self::ERROR[$error]);
    }

    private function checkAreaCode(): PhoneNumber
    {
        $areaCodeStart = $this->number[0];
        if ($areaCodeStart == 0) {
            $this->throwError(6);
        }
        if ($areaCodeStart == 1) {
            $this->throwError(7);
        }
        return $this;
    }

    private function checkExchangeCode(): PhoneNumber
    {
        $exchangeCodeStart = $this->number[3];
        if ($exchangeCodeStart == 0) {
            $this->throwError(8);
        }
        if ($exchangeCodeStart == 1) {
            $this->throwError(9);
        }
        return $this;
    }

}
