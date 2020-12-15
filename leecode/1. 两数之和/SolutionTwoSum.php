<?php

class SolutionTwoSum
{
    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target)
    {
        $hashMap = [];
        foreach ($nums as $key => $value) {
            if (array_key_exists($target - $value, $hashMap)) {
                return [$hashMap[$target - $value], $key];
            }
            $hashMap[$value] = $key;
        }
    }
}
