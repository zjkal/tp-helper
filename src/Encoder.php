<?php

namespace al\helper;

/**
 * AL加密类(对称的字符串加密)
 * Class Encoder
 * @package al\helper
 */
class Encoder
{

    private static $DEFAULT_KEY = 'ykmaiz'; //默认秘钥

    /**
     * 加密
     * @param string $data 要加密的字符串
     * @return string 加密后的字符串
     */
    public static function encode(string $data): string
    {
        $key = function_exists('config') ? (config('al.encoder-key') ?: self::$DEFAULT_KEY) : self::$DEFAULT_KEY;

        $data = strval($data);
        $key = strval($key);

        $a = array('l', 'i', 'a', 'n', 'g', 'x', 'f', 'e');
        $key = md5($key);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        $base64_str = base64_encode($str);
        $count = substr_count($base64_str, '=');
        return $a[$count] . rtrim(str_replace('/', '_', str_replace('+', '-', $base64_str)), '=');
    }

    /**
     * 解密
     * @param string $data 加密的字符串
     * @return string 解密后的字符串
     */
    public static function decode(string $data): string
    {
        $key = function_exists('config') ? (config('al.encoder-key') ?: self::$DEFAULT_KEY) : self::$DEFAULT_KEY;

        $data = strval($data);

        $a = array('l', 'i', 'a', 'n', 'g', 'x', 'f', 'e');

        $str2 = substr(str_replace('-', '+', str_replace('_', '/', $data)), 1);
        $count = substr($data, 0, 1);
        $fill = '';
        for ($i = 0; $i < array_search($count, $a); $i++) {
            $fill .= $fill . '=';
        }

        $key = md5($key);
        $x = 0;
        $data = base64_decode($str2 . $fill);
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }

        return $str;
    }

}