<?php

const GIGASECOND = 1E9;

function from(DateTimeImmutable $date) {
    return $date->add(new DateInterval('PT'.GIGASECOND.'S'));
}
