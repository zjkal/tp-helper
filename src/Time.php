<?php


namespace al\helper;

/**
 * 时间助手类
 * Class Time
 * @package al\helper
 */
class Time
{
    /**
     * 返回到今天晚上零点之前的秒数
     * @return false|int
     */
    public static function secondEndToday()
    {
        list($y, $m, $d) = explode('-', date('Y-m-d'));
        return mktime(23, 59, 59, $m, $d, $y) - time();
    }

    /**
     * 返回一天的秒数,传入参数可以返回数天的秒数
     * @param int $days
     * @return float|int
     */
    public static function secondDay($days = 1)
    {
        return 86400 * $days;
    }

    /**
     * 返回一周的秒数,传入参数可以返回数周的秒数
     * @param int $weeks
     * @return float|int
     */
    public static function secondWeek($weeks = 1)
    {
        return 604800 * $weeks;
    }
}