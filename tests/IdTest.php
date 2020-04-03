<?php
require '../vendor/autoload.php';

$key = 10110300135345;

$id = \al\helper\Id::encode($key);
$key2 = \al\helper\Id::decode($id);

echo $id . PHP_EOL;
echo $key2 . PHP_EOL;

function config($s)
{
    return 4;
}