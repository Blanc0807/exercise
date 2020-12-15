<?php

class SolutionFindPeakElement {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function findPeakElement($nums)
    {
        $len = count($nums);
        for ($i = 0; $i < $len - 1; $i++) {
            if ($nums[$i] > $nums[$i + 1]){
                return $i;
            }
        }
        return $len - 1;
    }

    function _findPeakElement($nums)
    {
        return $this->binarySearch($nums, 0, count($nums) - 1);
    }

    function __findPeakElement($nums){
        $start = 0;
        $end = count($nums) - 1;
        while ($start < $end){
            $mid = (int)(($start + $end) / 2);
            if ($nums[$mid] > $nums[$mid + 1]){
                $end = $mid;
            }else{
                $start = $mid + 1;
            }
        }
        return $start;
    }

    protected function binarySearch($nums, $start, $end)
    {
        if ($start == $end){
            return $start;
        }
        $mid = (int)(($start + $end) / 2);
        if ($nums[$mid] > $nums[$mid + 1]){
            return $this->binarySearch($nums, $start, $mid);
        }
        return $this->binarySearch($nums, $mid + 1, $end);
    }
}

