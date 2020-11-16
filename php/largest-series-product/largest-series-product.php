<?php

class Series
{
    public string $string;
    protected int $maxProduct = 0;

    public function __construct($input)
    {
        $this->string = $input;
    }

    public function largestProduct($seriesNumber)
    {
        $this->seriesMultiply($seriesNumber);
        return $this->maxProduct;
    }

    protected function seriesMultiply($seriesNumber)
    {
        if (strlen($this->string) < $seriesNumber
            || preg_match('/[^\d]/', $this->string)
            || $seriesNumber < 0) {
            throw new InvalidArgumentException();
        }
        if (!strlen($this->string)){
            $this->maxProduct = 1;
            return $this;
        }
        for ($i = 0; $i < strlen($this->string); $i++) {

            if ($i + $seriesNumber < strlen($this->string) + 1) {
                $j = 0;
                $product = 1;
                while ($j < $seriesNumber){
                    if (!$this->string[$i + $j]){
                        break;
                    }
                    $product *= $this->string[$i + $j];
                    $j++;
                }
                if ($this->maxProduct < $product) {
                    $this->maxProduct = $product;
                }
            }
        }
        return $this;
    }
}
