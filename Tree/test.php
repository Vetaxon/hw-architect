<?php

include_once 'BalancedBinaryTree.php';
include_once 'Node.php';

$results = [];

$tree = new BalancedBinaryTree();

$previous = 1;

for ($i = 1; $i <= 16500; $i++) {

    $tree->insert(new Node($i, [$i]));

    if ($previous * 2 !== $i) {
        continue;
    }

    $tree->balance();

    $results[$i] = getSearchTime($tree, $i);

    $previous = $i;

    echo $i . PHP_EOL;
}

function getSearchTime(BalancedBinaryTreeInterface $tree, int $i): float
{
    $tree->searchByKey($i);
    $tree->searchByKey($i);

    $time1 = microtime(true);

    $tree->searchByKey($i);

    $time2 = microtime(true);

    $searchTime = $time2 - $time1;

    return round($searchTime * 1000000, 2);
}

file_put_contents('result-header.csv', implode(',', array_keys($results)) . PHP_EOL);
file_put_contents('results.csv', implode(',', $results) . PHP_EOL, FILE_APPEND);
