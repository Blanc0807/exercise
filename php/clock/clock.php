<?php

class Clock1
{
    protected int $hour;
    protected int $minute;
    public DateTime $date;

    public function __construct($hour = 0, $minute = 0)
    {
        $this->hour = $this->checkHour($hour);
        $this->minute = $this->checkMinute($minute);
        $this->date = new DateTime();
        $this->formatDate();
    }

    public function add($minute)
    {
        $this->minute = $this->checkMinute($this->minute + $minute);
        $this->formatDate();
        return $this;
    }

    public function sub($minute)
    {
        return $this->add(-$minute);
    }

    public function __toString()
    {
        return $this->date->format('H:i');
    }

    private function checkHour(int $hour)
    {
        if ($hour >= 0 && $hour <= 24) {
            return $hour;
        }
        if ($hour < 0) {
            return $this->checkHour($hour + 24);
        }
        if ($hour > 24) {
            return $this->checkHour($hour - 24);
        }
    }

    private function checkMinute(int $minute)
    {
        if ($minute >= 0 && $minute <= 59) {
            return $minute;
        }
        if ($minute < 0) {
            $this->hour = $this->checkHour($this->hour -= 1);
            return $this->checkMinute($minute + 60);
        }
        if ($minute > 59) {
            $this->hour = $this->checkHour($this->hour += 1);
            return $this->checkMinute($minute - 60);
        }
    }

    private function formatDate()
    {
        $this->date->setTime($this->hour, $this->minute);
    }

}

