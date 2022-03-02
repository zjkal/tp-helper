<?php

namespace al\helper;

class Common
{
    function is_timestamp($timestamp) {
        if(strtotime(date('m-d-Y H:i:s',$timestamp)) === $timestamp) {
            return $timestamp;
        } else return false;
    }
}