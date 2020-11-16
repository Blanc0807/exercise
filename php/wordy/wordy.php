<?php

function calculate($word)
{
    $calculate = new Calculate($word);
    return $calculate->calculate();
}

class Calculate
{

    private string $word;

    public function __construct($word)
    {
        $this->word = $this->dealWord($word);
    }

    public function calculate()
    {
        return $this->_calculate($this->word);
    }

    protected function _calculate($expression)
    {
        if (is_numeric($expression)) {
            return $expression;
        }
        $regex = '/^(.+)(plus|minus|multipliedby|dividedby)(-?\d+$)/i';
        preg_match($regex, $expression, $matches);
        return $this->{$matches[2]}($this->_calculate($matches[1]), $matches[3]);
    }

    private function plus($a, $b)
    {
        return $a + $b;
    }

    private function minus($a, $b)
    {
        return $a - $b;
    }

    private function multipliedby($a, $b)
    {
        return $a * $b;
    }

    private function dividedby($a, $b)
    {
        return $a / $b;
    }

    private function dealWord($word)
    {
        if (!is_numeric($word[-2])) {
            throw new InvalidArgumentException();
        }
        return str_replace(['What is ', '?', ' '], '', $word);
    }
}


class Calculate1
{
    private array $word;
    private int $result;

    public function __construct($word)
    {
        $this->word = $this->dealWord($word);
    }

    public function calculate()
    {
        $this->result = (int)$this->word[0];
        for ($i = 1; $i < count($this->word); $i++) {
            if (is_numeric($this->word[$i])) {
                continue;
            }
            $this->result = $this->{$this->word[$i]}($this->result, (int)$this->word[$i + 1]);
        }
        return $this->result;
    }

    private function plus($a, $b)
    {
        return $a + $b;
    }

    private function minus($a, $b)
    {
        return $a - $b;
    }

    private function multiplied($a, $b)
    {
        return $a * $b;
    }

    private function divided($a, $b)
    {
        return $a / $b;
    }

    private function dealWord($word)
    {
        if (!is_numeric($word[-2])) {
            throw new InvalidArgumentException('Wrong word problem');
        }
        $word = str_replace(['What is ', 'by '], '', $word);
        return explode(' ', $word);
    }
}
