<?php
require '../vendor/autoload.php';

$key = 1;

$id = \al\helper\Id::key2id($key);
$key2 = \al\helper\Id::id2key($id);

echo $id . PHP_EOL;
echo $key2 . PHP_EOL;