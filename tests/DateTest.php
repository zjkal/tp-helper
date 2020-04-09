<?php
require '../vendor/autoload.php';

$datetime = '2020-04-10 22:22:22';

var_dump(\al\helper\Date::isToday($datetime));
var_dump(\al\helper\Date::isThisMonth($datetime));
var_dump(\al\helper\Date::isThisYear($datetime));

$datetime = 1586451741;

var_dump(\al\helper\Date::isToday($datetime));
var_dump(\al\helper\Date::isThisMonth($datetime));
var_dump(\al\helper\Date::isThisYear($datetime));