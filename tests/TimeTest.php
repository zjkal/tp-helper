<?php
require '../vendor/autoload.php';

echo \al\helper\Time::is_timestamp(1646186290) . PHP_EOL;
echo \al\helper\Time::secondEndToday() . PHP_EOL;
echo \al\helper\Time::secondDay(7) . PHP_EOL;
echo \al\helper\Time::secondWeek(4) . PHP_EOL;
echo \al\helper\Time::friendly_date('2022-3-2 10:15:33') . PHP_EOL;
echo \al\helper\Time::friendly_date(1646186290, 365, 'Y-m-d', 'en') . PHP_EOL;

$datetime = '2020-04-10 22:22:22';

var_dump(\al\helper\Time::isToday($datetime));
var_dump(\al\helper\Time::isThisMonth($datetime));
var_dump(\al\helper\Time::isThisYear($datetime));
var_dump(\al\helper\Time::isThisWeek($datetime));

$datetime = 1586451741;

var_dump(\al\helper\Time::isToday($datetime));
var_dump(\al\helper\Time::isThisMonth($datetime));
var_dump(\al\helper\Time::isThisYear($datetime));
var_dump(\al\helper\Time::isThisWeek($datetime));

$datetime = 'Apr 11, 2020';

var_dump(\al\helper\Time::isToday($datetime));
var_dump(\al\helper\Time::isThisMonth($datetime));
var_dump(\al\helper\Time::isThisYear($datetime));
var_dump(\al\helper\Time::isThisWeek($datetime));
echo '相差天数:';
var_dump(\al\helper\Time::diffDays('2022-4-10 23:01:11', 'Apr 11, 2020')) . PHP_EOL;
echo '相差天数:';
var_dump(\al\helper\Time::diffDays(1586451741)) . PHP_EOL;
echo '相差年数:';
var_dump(\al\helper\Time::diffYears(1586451741)) . PHP_EOL;
echo '相差月数:';
var_dump(\al\helper\Time::diffMonth(1586451741)) . PHP_EOL;
echo '相差周数:';
var_dump(\al\helper\Time::diffWeeks(1586451741)) . PHP_EOL;