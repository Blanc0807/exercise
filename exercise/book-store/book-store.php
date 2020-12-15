<?php

const DISCOUNTED = [
    1 => 8.0,
    2 => 15.2,
    3 => 21.6,
    4 => 25.6,
    5 => 30.0
];

function total($basket)
{
    $minPrice=PHP_INT_MAX;
    branch([], $basket, $minPrice, $minPriceBranch);
    return $minPrice;
}

function branch($buckets, $basket, &$minPrice, &$minPriceBranch)
{
    $item = array_shift($basket);
    if (!$item) {
//        print_r($buckets);
        $price = getPrice($buckets);
        if ($price < $minPrice) {
            $minPrice = $price;
            $minPriceBranch = $buckets;
        }
        return;
    }
    $push = false;
    foreach ($buckets as $i => $bucket) {
        if (!in_array($item, $bucket)) {
            $branchBuckets = $buckets;
            $branchBuckets[$i][] = $item;
            $push = true;
            branch($branchBuckets, $basket, $minPrice, $minPriceBranch);
        }
    }
    if (!$push) {
        $buckets[] = [$item];
        branch($buckets, $basket, $minPrice, $minPriceBranch);
    }
}

function getPrice($buckets)
{
    return array_reduce($buckets, function ($total, $bucket) {
        $total += DISCOUNTED[count($bucket)];
        return $total;
    },0);
}