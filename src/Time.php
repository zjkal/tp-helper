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
    public static function is_timestamp($timestamp): bool
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

    //将任意时间类型的参数转为时间戳
    public static function toTimestamp($datetime): int
    {
        if (!$datetime) {
            throw new \InvalidArgumentException('Param datetime must be a timestamp or a string time');
        }

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
    public static function secondDay(int $days = 1)
    {
        return 86400 * $days;
    }

    /**
     * 返回一周的秒数,传入参数可以返回数周的秒数
     * @param int $weeks
     * @return float|int
     */
    public static function secondWeek(int $weeks = 1)
    {
        return 604800 * $weeks;
    }

    /**
     * 友好的时间显示
     * @param $time
     * @param string $format
     * @param int $max_days
     * @return false|string
     */
    public static function friendly_date($time, int $max_days = 365, string $format = 'Y年m月d日', string $lang = 'zh')
    {

        $time = self::toTimestamp($time);
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
            return $diff_days . ($lang == 'zh' ? '天前' : ' days ago');
        } elseif ($diff_days >= 1) {
            return $lang == 'zh' ? '昨天' : 'yesterday';
        } elseif ($diffs >= 3600) {
            return floor($diffs / 3600) . ($lang == 'zh' ? '小时前' : ' hours ago');
        } elseif ($diffs >= 60) {
            return floor($diffs / 60) . ($lang == 'zh' ? '分钟前' : ' minutes ago');
        } elseif ($diffs >= 10) {
            return $diffs . ($lang == 'zh' ? '秒前' : ' seconds ago');
        } else {
            return $lang == 'zh' ? '刚刚' : 'just';
        }
    }

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

    /**
     * 返回两个日期相差天数(如果只传入一个日期,则与当天时间比较)
     * @param $datetime
     * @param $new_datetime
     * @return int
     */
    public static function diffDays($datetime, $new_datetime = null): int
    {
        $datetime = date('Y-m-d', self::toTimestamp($datetime));
        if ($new_datetime) {
            $new_datetime = date('Y-m-d', self::toTimestamp($new_datetime));
        } else {
            $new_datetime = date('Y-m-d');
        }

        return date_diff(date_create($datetime), date_create($new_datetime))->days;
    }
}