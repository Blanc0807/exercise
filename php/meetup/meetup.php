<?php

const WEEK = [
    'Sunday' => 0,
    'Monday' => 1,
    'Tuesday' => 2,
    'Wednesday' => 3,
    'Thursday' => 4,
    'Friday' => 5,
    'Saturday' => 6,
];

function meetup_day($year, $month, $times, $weekday)
{
    $weekIndex = WEEK[$weekday];
    if ($times === 'teenth') {
        $date = new DateTime("{$year}/{$month}/13");
        $weekOffset = $weekIndex - date('w', $date->getTimestamp());
        if ($weekOffset < 0) {
            $weekOffset += 7;
        }
        return $date->modify("+{$weekOffset}days");
    }
    $date = new DateTime("$year-$month");
    return $date->modify("$times $weekday of this month");
}

