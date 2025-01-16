<?php

// Require the Composer autoloader.
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// AWS credentials
$s3key = $_ENV['AWS_KEY'];
$s3Secret = $_ENV['AWS_SECRET'];

// Bucket and file details
$bucket = 'php--oop';
$file = 'text.txt';
$contents = 'Hello World!';

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
  'version' => 'latest',
  'region' => 'us-east-1',
  'credentials' => [ // Fixed the typo here
    'key' => $s3key,
    'secret' => $s3Secret,
  ],
]);

// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
  $result = $s3->putObject([
    'Bucket' => $bucket,
    'Key'    => $file,
    'Body'   => $contents,
  ]);

  // Print the file's URL
  echo "File uploaded successfully. URL: " . $result['ObjectURL'] . "\n";
} catch (Aws\S3\Exception\S3Exception $e) {
  echo "There was an error uploading the file: " . $e->getMessage() . "\n";
}
