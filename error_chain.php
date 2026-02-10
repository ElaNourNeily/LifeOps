<?php
require 'vendor/autoload.php';
require 'src/Kernel.php';
try {
    $kernel = new App\Kernel('dev', true);
    $kernel->boot();
}
catch (\Throwable $e) {
    $current = $e;
    while ($current) {
        echo "CLASS: " . get_class($current) . "\n";
        echo "FILE: " . $current->getFile() . "\n";
        echo "LINE: " . $current->getLine() . "\n";
        echo "MSG: " . $current->getMessage() . "\n";
        echo "-------------------\n";
        $current = $current->getPrevious();
    }
}
