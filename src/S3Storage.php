<?php

namespace App;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3Storage implements FileStorage
{

  public function __construct(protected S3Client $client, protected string $bucket) {}

  public function put(string $path, string $content): void
  {
    // Upload a publicly accessible file. The file size and type are determined by the SDK.
    try {
      $result = $this->client->putObject([
        'Bucket' => $this->bucket,
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
