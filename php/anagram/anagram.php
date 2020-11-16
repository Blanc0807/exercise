<?php

function detectAnagrams($word, $candidates)
{
    $word = mb_strtolower($word);
    return array_values(array_filter($candidates, function ($candidate) use ($word) {
        $candidate = mb_strtolower($candidate);
        return count_chars($word) === count_chars($candidate) && $word != $candidate;
    }));
}

