<?php

require 'vendor/autoload.php';

use App\S3Storage;

$storage = new S3Storage();

$storage->put('new.txt', 'Hello World');