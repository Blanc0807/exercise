<?php

class BeerSong
{
    protected string $verse = '';

    public function verses($start, $end)
    {
        if ($start == $end) {
            $this->_verse($end);
            return $this->verse;
        }
        $this->_verse($start);
        $this->verse .= "\n";
        return $this->verses($start - 1, $end);
    }

    public function lyrics()
    {
        return $this->verses(99, 0);
    }

    public function verse($n)
    {
        $this->_verse($n);
        return $this->verse;
    }

    protected function _verse($n)
    {
        if ($n == 0) {
            $this->verse .= "No more bottles of beer on the wall, no more bottles of beer.\n" .
            "Go to the store and buy some more, 99 bottles of beer on the wall.";
        } else {
            $bottles = $n > 1 ? $n . ' bottles' : '1 bottle';
            $take = $n > 1 ? 'Take one' : 'Take it';
            $left = $n > 1 ? ($n > 2 ? ($n - 1) . ' bottles' : '1 bottle') : 'no more bottles';
            $firstLine = ucfirst($bottles) . ' of beer on the wall, ' . $bottles . " of beer.\n";
            $secondLine = $take . ' down and pass it around, ' . $left . " of beer on the wall.\n";
            $this->verse .= $firstLine . $secondLine;
        }
    }
}
