<?php

class Game
{

    protected int $scores;
    /**
     * @var Frame[] $frames
     */
    public array $frames;
    protected Frame $currentFrame;

    public function __construct()
    {
        $this->currentFrame = new Frame();
        $this->frames[] = $this->currentFrame;
    }

    /**
     * @param $pins
     * @throws Exception
     */
    public function roll($pins)
    {

        if ($this->currentFrame->isDone() && !$this->currentFrame->isFinalFrame()) {
            $newFrame = new Frame($this->currentFrame->getIndex() + 1);
            $newFrame->setPrev($this->currentFrame);
            $this->currentFrame->setNext($newFrame);
            $this->currentFrame = $newFrame;
            $this->frames[] = $newFrame;
        }
        $this->currentFrame->roll($pins);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function score()
    {
        if (count($this->frames) < 10) {
            throw new Exception();
        }
        if (!$this->frames[9]->checkFinalFrame()){
            throw new Exception();
        }
        $i = 0;
        while ($i < 9) {
            $this->frames[$i]->calculateScores($this->frames[$i]);
            $i++;
        }
        return array_reduce($this->frames, function (int $totalScore, Frame $frame) {
            $totalScore += $frame->score();
            return $totalScore;
        }, 0);
    }
}

class Frame
{
    protected int $index;
    protected Frame $prev;
    protected Frame $next;

    protected $first = null;
    protected $second = null;
    protected $third = null;

    protected int $score = 0;

    public function __construct($index = 0)
    {
        $this->index = $index;
    }

    public function prev(): Frame
    {
        return $this->prev;
    }

    public function next(): Frame
    {
        return $this->next;
    }

    /**
     * @param $n
     * @throws Exception
     */
    public function roll($n)
    {
        if ($n < 0 || $n > 10) {
            throw new Exception();
        }

        if ($this->isFinalFrame()) {// last frame
            if ($this->third !== null) {
                throw new Exception();
            }
            if ($this->second !== null && $this->isOpen()) {//open frame
                throw new Exception();
            }
            if ($this->isStrike() && $this->second< 10 && $this->second + $n > 10) {
                throw new Exception();
            }
            if ($this->first < 10 && $this->first + $this->second > 10) {
                throw new Exception();
            }

            if ($this->first === null) {
                $this->first = $n;
            } elseif ($this->second === null) {
                $this->second = $n;
                if ($this->isOpen()) {
                    $this->score = $this->first + $this->second;
                }
            } elseif ($this->second !== null) {
                $this->third = $n;
                $this->score = $this->first + $this->second + $this->third;
            }

        } else {
            if ($this->first < 10 && $this->first + $n > 10) {
                throw new Exception();
            }
            $this->first === null ? $this->first = $n : $this->second = $n;
        }

    }


    public function isFinalFrame()
    {
        return $this->index == 9;
    }

    public function isSpare()
    {
        return $this->first + $this->second == 10;
    }

    public function isDone()
    {
        if ($this->isStrike()) {
            return true;
        }
        return $this->first !== null && $this->second !== null;
    }

    public function isStrike()
    {
        return $this->first === 10;
    }

    /**
     * @param Frame $prev
     */
    public function setPrev(Frame $prev): void
    {
        $this->prev = $prev;
    }

    /**
     * @param Frame $next
     */
    public function setNext(Frame $next): void
    {
        $this->next = $next;
    }

    public function score()
    {
        return $this->score;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function isOpen()
    {
        return $this->first + $this->second < 10;
    }

    public function calculateScores(Frame $frame)
    {
        if ($frame->isOpen()) {
            $frame->score = $frame->first + $frame->second;
        }

        if ($frame->isSpare()) {
            $frame->score = 10 + $frame->next->first;
        }

        if ($frame->isStrike()) {
            if ($frame->next->isStrike() && !$this->next->isFinalFrame()) {
                $frame->score = 20 + $frame->next->next->first;
            } else {
                $frame->score = 10 + $frame->next->first + $frame->next->second;
            }
        }
    }

    public function checkFinalFrame()
    {
        if ($this->second === null) {
            return false;
        }
        if (!$this->isOpen() && $this->third === null) {
            return false;
        }
        return true;
    }
}
