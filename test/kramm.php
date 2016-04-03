<?php

function add() {

    $total = 0;
    foreach(func_get_args() as $arg) {
        $total += (int) $arg;
    }
    return $total . '  Paras: ' . count(func_get_args());
}

echo add(5,432,432,423,23,3,4);