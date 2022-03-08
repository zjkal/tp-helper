<?php


namespace al\helper;

/**
 * 日期助手类
 * Class Date
 * @package al\helper
 */
class Date
{

    /**
     * 判断日期是否为今天
     * @param string|int $datetime
     * @return bool
     */
    public static function isToday($datetime): bool
    {
        $timestamp = self::toTimestamp($datetime);
        if (date('Y-m-d', $timestamp) == date('Y-m-d')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断日期是否为本周
     * @param string|int $datetime
     * @return bool
     */
    public static function isThisWeek($datetime): bool
    {
        $week_start = strtotime(date('Y-m-d 00:00:00', strtotime('this week')));
        $week_end = strtotime(date('Y-m-d 23:59:59', strtotime('last day next week')));
        $timestamp = self::toTimestamp($datetime);
        if ($timestamp >= $week_start && $timestamp <= $week_end) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 判断日期是否为本月
     * @param string|int $datetime
     * @return bool
     */
    public static function isThisMonth($datetime): bool
    {
        $timestamp = self::toTimestamp($datetime);
        if (date('Y-m', $timestamp) == date('Y-m')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 判断日期是否为今年
     * @param string|int $datetime
     * @return bool
     */
    public static function isThisYear($datetime): bool
    {
        $timestamp = self::toTimestamp($datetime);
        if (date('Y', $timestamp) == date('Y')) {
            return true;
        } else {
            return false;
        }
    }

    //将任意时间类型的参数转为时间戳
    private static function toTimestamp($datetime): int
    {
        $start = strtotime('1970-01-01 07:00:00'); // 0
        $end = strtotime('2038-01-19 03:14:07'); // 2147454847
        //判断是否为时间戳
        if (is_numeric($datetime) && $datetime <= $end && $datetime >= $start) {
            return intval($datetime);
        } else {
            $timestamp = strtotime($datetime);
            if ($timestamp) {
                return $timestamp;
            } else {
                throw new \InvalidArgumentException('Param datetime must be a timestamp or a string time');
            }
        }
    }
}