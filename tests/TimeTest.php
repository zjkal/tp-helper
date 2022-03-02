<?php
require '../vendor/autoload.php';

echo \al\helper\Time::is_timestamp(1646186290) . PHP_EOL;
echo \al\helper\Time::secondEndToday() . PHP_EOL;
echo \al\helper\Time::secondDay(7) . PHP_EOL;
echo \al\helper\Time::secondWeek(4) . PHP_EOL;
echo \al\helper\Time::friendly_date('2022-3-2 10:15:33') . PHP_EOL;
echo \al\helper\Time::friendly_date(1646186290, 365, 'Y-m-d') . PHP_EOL;