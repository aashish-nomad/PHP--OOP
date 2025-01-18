<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use App\Storage;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$storage = Storage::resolve();

$storage->put('tet.txt', 'Hello World');