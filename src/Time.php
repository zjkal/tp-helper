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
     * 判断是否为时间戳格式
     * @param $timestamp
     * @return bool
     */
    public static function is_timestamp($timestamp)
    {
        if (!is_int($timestamp)) {
            return false;
        }

        if (strtotime(date('Y-m-d H:i:s', $timestamp)) === $timestamp) {
            return true;
        } else {
            return false;
        }
    }

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

    /**
     * 友好的时间显示
     * @param $time
     * @param $format
     * @param $max_days
     * @return false|string
     */
    public static function friendly_date($time, $max_days = 365, $format = 'Y年m月d日')
    {
        if (!$time) {
            return '';
        }
        $time = self::is_timestamp($time) ? $time : strtotime($time);
        $now_time = time();
        if ($time > $now_time) {
            return date($format, $time);
        }

        $z = date('z', $time);//当前的第几天
        $now_days = date('z', $now_time);
        if ($z > $now_days) {
            $now_days += 365;
        }
        $diff_days = $now_days - $z;//获取差异天
        $diffs = $now_time - $time;//获取差异秒

        if ($diff_days >= $max_days) {
            return date($format, $time);
        } elseif ($diff_days >= 3) {
            return $diff_days . '天前';
        } elseif ($diff_days >= 2) {
            return '前天';
        } elseif ($diff_days >= 1) {
            return '昨天';
        } elseif ($diffs >= 3600) {
            return floor($diffs / 3600) . '小时前';
        } elseif ($diffs >= 60) {
            return floor($diffs / 60) . '分钟前';
        } elseif ($diffs >= 10) {
            return $diffs . '秒前';
        } else {
            return '刚刚';
        }
    }
}