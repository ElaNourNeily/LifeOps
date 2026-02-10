<?php
require 'vendor/autoload.php';
require 'src/Kernel.php';
try {
    $kernel = new App\Kernel('dev', true);
    $kernel->boot();
}
catch (\Throwable $e) {
    echo "FILE: " . $e->getFile() . "\n";
    echo "LINE: " . $e->getLine() . "\n";
    echo "MSG: " . $e->getMessage() . "\n";
    if ($e->getPrevious()) {
        echo "PREV FILE: " . $e->getPrevious()->getFile() . "\n";
        echo "PREV LINE: " . $e->getPrevious()->getLine() . "\n";
        echo "PREV MSG: " . $e->getPrevious()->getMessage() . "\n";
    }
}
