<?php

namespace App;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3Storage implements FileStorage
{
  public function put(string $path, string $content): void
  {
    // AWS credentials
    $s3key = $_ENV['AWS_KEY'];
    $s3Secret = $_ENV['AWS_SECRET'];
    $bucket = $_ENV['AWS_BUCKET'];

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
        'Key'    => $path,
        'Body'   => $content,
      ]);

      // Print the file's URL
      echo "File uploaded successfully. URL: " . $result['ObjectURL'] . "\n";
    } catch (S3Exception $e) {
      echo "There was an error uploading the file: " . $e->getMessage() . "\n";
    }
  }
}
