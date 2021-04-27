<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(realpath(getcwd()));
$dotenv->load();

return [
    // ...
];
