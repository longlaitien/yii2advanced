<?php
namespace common\util;

/**
 * Class Common
 * @package common\util
 */
class Common
{
    //TODO get source
    public static function getSource(){
        $cookies = \Yii::$app->request->cookies;
        $source = $cookies->getValue('mdnSource', 2);
        return $source;
    }

    //TODO get source name
    public static function getSourceName(){
        $source = self::getSource();
        $name = "BidGear";
        switch ($source){
            case 1:
                $name = "BidGear";
                break;
            case  2:
                $name = "2mdnsys";
                break;
            case  4:
                $name = "RTB BidGear";
                break;
        }
        return $name;
    }

    public static function formatJson($data){
        for ($i = 0; $i <= 31; ++$i) {
            $data = str_replace(chr($i), "", $data);
        }
        $data = str_replace(chr(127), "", $data);

        if (0 === strpos(bin2hex($data), 'efbbbf')) {
            $data = substr($data, 3);
        }
        return $data;
    }

    public static function formatHtmlUrl($url)
    {
        $url = str_replace(['http://', 'https://'], '', $url);
        $url = str_replace(['www.'], '', $url);
        return rtrim($url, '/');
    }
}