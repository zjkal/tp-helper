<?php


namespace al\helper;

/**
 * 对数字ID进行追加长度的混淆类
 * Class Id
 * @package al\helper
 */
class Id
{
    private static $DEFAULT_LENGTH = 5; //默认的追加长度

    /**
     * 给ID添加混淆后缀
     * @param int $key 数据库自增ID
     * @return int  转换后的ID
     * @throws \Exception
     */
    public static function encode($key)
    {
        if (!is_numeric($key)) {
            throw  new \InvalidArgumentException('Param key must be a number');
        } else {
            $key = strval($key);
        }
        //追加的混淆长度
        $length = function_exists('config') && config('al.id-length') ?: self::$DEFAULT_LENGTH;
        $tmp1 = number_format(round($key * decoct($key) * pi(), 2) * 100 + $length, 0, '', '');
        $tmp2 = substr($tmp1, -$length);
        return $key . str_pad($tmp2, $length, 0, STR_PAD_LEFT);
    }

    /**
     * 验证混淆后缀,并还原ID
     * @param int $id 转换后的ID
     * @return int 数据库自增ID
     * @throws \Exception
     */
    public static function decode($id)
    {
        //追加的混淆长度
        $length = function_exists('config') && config('al.id-length') ?: self::$DEFAULT_LENGTH;

        if (strlen($id) <= $length) {
            throw new \InvalidArgumentException('Length of param id is too short');
        }

        $tmp = substr($id, 0, -$length);

        if (self::encode($tmp) != $id) {
            throw  new \InvalidArgumentException('Invalid id');
        } else {
            return $tmp;
        }
    }

}