<?php
$path = $argv[1] ?? die("File path required\n");
$i = 1;
foreach (file($path) as $l) {
    echo str_pad($i++, 4, ' ', STR_PAD_LEFT) . ': ' . rtrim($l, PHP_EOL) . PHP_EOL;
}
