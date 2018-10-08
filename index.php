<?php

require './vendor/autoload.php';

use React\EventLoop\Factory;
use React\Socket\ConnectionInterface;
use React\Socket\Server; 


$loop = Factory::create();

$socket = new Server("127.0.0.1:8080", $loop);

$socket->on('connection', function(ConnectionInterface $conn) {
        $conn->write('Hello World');
        $conn->close();
});

$socket->on('data', function($data) {
    echo $data;
});


$loop->addPeriodicTimer(1, function() {
    echo memory_get_usage() . PHP_EOL;
});

$loop->run();