<?php
$root = "storage";
$file = 'one/two/three/text.txt';
$contents = 'Hello World!';


$savePath = "{$root}/{$file}";
mkdir(dirname($savePath), 0777, recursive: true);

file_put_contents($savePath, $contents);
