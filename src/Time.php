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
}