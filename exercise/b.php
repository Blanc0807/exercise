<?php


class SchoolS
{
    protected array $school = [];

    //insert
    public function add($student, $grade) {
        $this->school[$grade][] = $student;
    }

    public function grade($grade){
        $this->select($grade);
    }

    public function studentsByGradeAlphabetical(){
        $this->orderByGrade()
            ->orderByStudent()
            ->select();
    }

    //select
    protected function select($grade = null){
        if(!$grade) {
            return $this->school;
        }
        return $this->school[$grade];
    }

    //orderBy
    protected function orderByStudent($student){
    }

    protected function orderByGrade() {
        ksort($this->school);
        return $this;
    }
}

$school = new SchoolS();
$school->add('C', 4);
$school->add('A', 4);
$school->add('Z', 1);
$school->add('B', 1);

