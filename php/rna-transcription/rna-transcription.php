<?php

const RNA_REPLACE = [
    'G' =>  'C',
    'C' =>  'G',
    'T' =>  'A',
    'A' =>  'U'
];

function toRna($dna) {
    $rna = '';
    for($i = 0; $i < strlen($dna); $i ++) {
        $rna .= RNA_REPLACE[$dna[$i]];
    }
    return $rna;
}
