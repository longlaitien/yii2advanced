<?php

namespace common\util;

/**
 * Class BgRecord
 * @package common\util
 */
class BgRecord
{
    const SECURE_KEY = "qh36r";

    public static function infoRemoteSave($title, $data = [], $source = 1)
    {
        if (!$title || !is_array($data) || !$source) {
            return;
        }
        $data = http_build_query([
            "title" => $title,
            'source' => $source,
            'data' => $data,
        ]);
        $link = "http://astats.bidgear.com/record/info?key=" . self::SECURE_KEY;
        self::internalRemoteSave($data, $link);
    }

    public static function errorRemoteSave($title, $data = [], $source = 1)
    {
        if (!$title || !is_array($data) || !$source) {
            return;
        }
        $data = http_build_query([
            "title" => $title,
            'source' => $source,
            'data' => $data,
        ]);
        $link = "http://astats.bidgear.com/record/error?key=" . self::SECURE_KEY;
        self::internalRemoteSave($data, $link);
    }

    private static function internalRemoteSave($data, $link)
    {
        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        curl_close($ch);*/
    }
}