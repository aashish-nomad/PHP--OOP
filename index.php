<?php

require 'vendor/autoload.php';

use App\S3Storage;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$storage = new S3Storage();

$storage->put('new.txt', 'Hello World');