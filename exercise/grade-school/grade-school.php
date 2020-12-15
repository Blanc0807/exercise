<?php

class School
{
    protected array $school = [
        1 => [],
        2 => [],
        3 => [],
        4 => [],
        5 => [],
        6 => []
    ];

    public function add($student, $grade)
    {
        $indexStudent = $this->binarySearch($this->school[$grade], $student);
        array_splice($this->school[$grade], $indexStudent, 0, $student);
    }

    public function grade($grade)
    {
        return $this->school[$grade];
    }

    public function studentsByGradeAlphabetical()
    {
        return array_filter($this->school, 'count');
    }

    protected function binarySearch($list, $item)
    {
        $start = 0;
        $end = count($list);
        while ($end - $start > 1) {
            $mid = (int)(($start + $end) / 2);
            if ($list[$mid] < $item) {
                $start = $mid;
            } else {
                $end = $mid;
            }
        }
        if ($start == 0 && $end != 0) {
            return $list[0] > $item ? 0 : 1;
        }
        return $end;
    }

}

