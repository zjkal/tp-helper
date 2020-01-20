<?php


namespace al\helper;

/**
 * 对数据自增主键进行追加长度的混淆类
 * Class Id
 * @package al\helper
 */
class Id
{
    /**
     * 把数据自增主键转换为ID
     * @param int $key 数据库自增ID
     * @return int  转换后的ID
     * @throws \Exception
     */
    public static function key2id($key)
    {
        if (!is_numeric($key)) {
            throw  new \Exception('key must be a number');
        }
        //追加的混淆长度
        $length = config('al.helper.Id.lenght') ?: '5';

        $tmp1 = round(decoct($key) * decbin($key) / pi());
        $tmp2 = substr($tmp1, -1, $length);
        return str_pad($tmp2, $length, 0, STR_PAD_LEFT);
    }

    /**
     * 把ID还原为数据自增主键
     * @param int $id 转换后的ID
     * @return int 数据库自增ID
     * @throws \Exception
     */
    public static function id2key($id)
    {
        //追加的混淆长度
        $length = config('al.helper.Id.lenght') ?: '5';

        if (strlen($id) <= $length) {
            throw new \Exception('ID length is too short');
        }

        return substr($id, 0, -$length);
    }

}