<?php
$dir = __DIR__ . '/../storage/framework/views';
foreach (glob($dir . '/*.php') as $file) {
    echo "==== " . basename($file) . "\n";
    $output = [];
    $ret = 0;
    exec("php -l " . escapeshellarg($file) . " 2>&1", $output, $ret);
    echo implode("\n", $output) . "\n";
}
