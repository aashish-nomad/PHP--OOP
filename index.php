<?php

require 'vendor/autoload.php';

use App\S3Storage;
use Aws\S3\S3Client;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Instantiate an Amazon S3 client.
$client = new S3Client([
  'version' => 'latest',
  'region' => 'us-east-1',
  'credentials' => [
    'key' => $_ENV['AWS_KEY'],
    'secret' => $_ENV['AWS_SECRET'],
  ],
]);

$storage = new S3Storage($client, $_ENV['AWS_BUCKET']);

$storage->put('new.txt', 'Hello World');