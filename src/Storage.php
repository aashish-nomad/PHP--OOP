<?php

namespace App;

use App\LocalStorage;
use App\S3Storage;
use Aws\S3\S3Client;
use Exception;

class Storage
{
  public static function resolve()
  {
    $storage_method = $_ENV['FILE_STORAGE'];

    if ($storage_method == 'local') {
      return new LocalStorage();
    } elseif ($storage_method == 's3') {
      // Instantiate an Amazon S3 client.
      $client = new S3Client([
        'version' => 'latest',
        'region' => 'us-east-1',
        'credentials' => [
          'key' => $_ENV['AWS_KEY'],
          'secret' => $_ENV['AWS_SECRET'],
        ],
      ]);

      return new S3Storage($client, $_ENV['AWS_BUCKET']);
    } else {
      throw new Exception("Error Processing Request", 1);
    }
  }
}
