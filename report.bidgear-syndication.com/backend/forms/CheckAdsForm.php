<?php

namespace backend\forms;

use backend\models\BackendForm;
use common\models\SendMailBackendForm;
use yii\helpers\Json;

/**
 * Class CheckAdsForm
 * @package backend\forms
 */
class CheckAdsForm extends BackendForm
{

    public static function dataScan()
    {
        //return  [];
        return $data = [
            [
                "source" => 'BidGear',
                "items" => [
                    "https://platform.bidgear.com/ads.php?domainid=1&sizeid=2&zoneid=1&k=59f97fa3b2d1f",
                    //w4-bidgear.com
                    "http://159.89.51.170:8080/ads.php?domainid=1&sizeid=2&zoneid=1&k=59f97fa3b2d1f",
                    //w3-bidgear.com
                    "http://67.207.92.50:8080/ads.php?domainid=1&sizeid=2&zoneid=1&k=59f97fa3b2d1f",
                    "https://bidgear.com/?m=1",
                ]
            ],
            [
                "source" => 'SG VN BidGear',
                "items" => [
                    "http://vn-platform.bidgear.com/ads.php?domainid=1&sizeid=2&zoneid=1&k=59f97fa3b2d1f",
                    //"http://167.99.77.213:8082/ads.php?domainid=1270&sizeid=16&zoneid=2867&k=5e78a2a697047",//w1-sg.bidgear.com
                    //68.183.233.185
                    "http://68.183.233.185:8082/ads.php?domainid=1270&sizeid=16&zoneid=2867&k=5e78a2a697047",//w1-bgadx.com
                ]
            ],
            [
                "source" => 'vegacdn1.bidgear-syndication.com',
                "items" => [
                    //"https://vegacdn1.bidgear-syndication.com/hb/i3.js",
                ]
            ],
            [
                "source" => 'Bidgear Convert',
                "items" => [
                    //for BidGear Convert
                    "http://206.81.14.236:8089/convert?z=11&k=ksdfsRHAS6234dfgLNM&t=tag",
                ]
            ],
            [
                "source" => 'BGADX',
                "items" => [
                    //TODO for BGADX
                    //"http://bgadx.com/sync?domainid=1027&sizeid=14&zoneid=3059&k=5c14599fd5f01",
                    //"http://68.183.233.185:8080/sync?domainid=1027&sizeid=14&zoneid=3059&k=5c14599fd5f01",
                ]
            ],
            [
                "source" => 'DSP',
                "items" => [
                    //TODO for DSP
                    "https://demand.bidgear.com/tag?z=154&k=5c45726301f2b",
                    "https://imp-dsp.bidgear.com/rec?viewId=pM4iwKUZCmd2xjy0sFsOLglQamPBrNpbwKqapcUP7LcJB000GxyKsgsGnz2LcSxUVwz8xAzv9PF8oLQpVlB000G50LQYCB001G0ULiWtWbB000GsdVUGKlZdeLlgXBVfELB000GDBmoiRTheUAeUFiXjqEU6YIazdrB001GjtSMNbXeRTr6LBIbc09G8rgB002GB002G",
                    "https://imp-dsp.bidgear-syndication.com/rec3?viewId=pM4iwKUZCmd2xjy0sFsOLglQamPBrNpbwKqapcUP7LcJB000GxyKsgsGnz2LcSxUVwz8xAzv9PF8oLQpVlB000G50LQYCB001G0ULiWtWbB000GsdVUGKlZdeLlgXBVfELB000GDBmoiRTheUAeUFiXjqEU6YIazdrB001GjtSMNbXeRTr6LBIbc09G8rgB002GB002G",
                ],
            ],
            /*[
                "source" => 'DSP - w2-dsp.bidgear.com',
                "items" => [
                    "http://10.136.77.36:8080/tag?z=154&k=5c45726301f2b",
                ],
            ],*/
            //w7-dsp.bidgear.com
            /*[
                "source" => 'DSP - w7-dsp.bidgear.com',
                "items" => [
                    //TODO for DSP
                    "http://157.245.143.25:8080/tag?z=154&k=5c45726301f2b",
                ],
            ],*/
            //w8-dsp.bidgear.com
            /*[
                "source" => 'DSP - w8-dsp.bidgear.com',
                "items" => [
                    //TODO for DSP
                    //"http://157.245.80.174:8080/tag?z=154&k=5c45726301f2b",
                ],
            ],*/
            [
                "source" => 'DSP - rec - imp3-dsp.bidgear.com',
                "items" => [
                    //TODO for DSP
                    //imp3-dsp.bidgear.com
                    //"http://159.89.235.170:8082/rec?viewId=pM4iwKUZCmd2xjy0sFsOLglQamPBrNpbwKqapcUP7LcJB000GxyKsgsGnz2LcSxUVwz8xAzv9PF8oLQpVlB000G50LQYCB001G0ULiWtWbB000GsdVUGKlZdeLlgXBVfELB000GDBmoiRTheUAeUFiXjqEU6YIazdrB001GjtSMNbXeRTr6LBIbc09G8rgB002GB002G",
                ],
            ],
            [
                "source" => 'DSP - rec - imp4-dsp.bidgear.com',
                "items" => [
                    //TODO for DSP
                    //imp4-dsp.bidgear.com
                    //"http://159.65.239.192:8082/rec?viewId=pM4iwKUZCmd2xjy0sFsOLglQamPBrNpbwKqapcUP7LcJB000GxyKsgsGnz2LcSxUVwz8xAzv9PF8oLQpVlB000G50LQYCB001G0ULiWtWbB000GsdVUGKlZdeLlgXBVfELB000GDBmoiRTheUAeUFiXjqEU6YIazdrB001GjtSMNbXeRTr6LBIbc09G8rgB002GB002G",
                ],
            ],
            [
                "source" => 'DSP - rec - imp5-dsp.bidgear.com',
                "items" => [
                    //TODO for DSP
                    //imp5-dsp.bidgear.com
                    //"http://167.99.149.83:8082/rec?viewId=pM4iwKUZCmd2xjy0sFsOLglQamPBrNpbwKqapcUP7LcJB000GxyKsgsGnz2LcSxUVwz8xAzv9PF8oLQpVlB000G50LQYCB001G0ULiWtWbB000GsdVUGKlZdeLlgXBVfELB000GDBmoiRTheUAeUFiXjqEU6YIazdrB001GjtSMNbXeRTr6LBIbc09G8rgB002GB002G",
                ],
            ],
            [
                "source" => 'DSP_ES_7',
                "items" => [
                    "http://10.136.231.243:9200"
                ],
            ],
            [
                "source" => 'BG_SYNDICATION',
                "items" => [
                    "https://bidgear-syndication.com/hd-adx?hid=51&t=15693",
                ],
            ],
        ];
    }

    public static function checkAds($send = "")
    {
        $data = self::dataScan();
        foreach ($data as $item) {
            $source = $item['source'];
            $links = $item['items'];
            foreach ($links as $link) {
                self::toCheckOne($source, $link, $send);
            }
            echo "<br/>-----------------------------<br/>";
        }
    }

    private static function toCheckOne($source, $link, $send = '')
    {
        $sendEmail = false;
        /*if ($send == 1) {
            $sendEmail = true;
        }*/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        $headers = [
            "Cache-Control: no-cache, no-store, must-revalidate, max-age=0",
            "Pragma: no-cache",
            "Expires: 0",
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        //TODO send email
        $dateTime = date('Y-m-d H:i:s');
        $email = new SendMailBackendForm();
        $email->from_email = SendMailBackendForm::SUPPORT_EMAIL;
        $email->from_name = SendMailBackendForm::SUPPORT_NAME;
        $to = [
            [
                'email' => "caibong534@gmail.com",
                'name' => "caibong534@gmail.com",
                'type' => 'to',
            ],
        ];

        if ((int)$httpCode != 200) {
            if (!in_array($source, [
                "Bidgear Convert", "2mdn Convert", "CFA Convert",'DSP - convert - db3-dsp.bidgear.com'
            ])) {
                $to[] =
                    [
                        'email' => "quynhtran@bidgear.com",
                        'name' => "quynhtran@bidgear.com",
                        'type' => 'to',
                    ];//0
                $to[] =
                    [
                        'email' => "liam.nguyen@bidgear.com",
                        'name' => "liam.nguyen@bidgear.com",
                        'type' => 'to',
                    ];//1
                $to[] =
                    [
                        'email' => "lisa.green@bidgear.com",
                        'name' => "lisa.green@bidgear.com",
                        'type' => 'to',
                    ];//2
                $to[] =
                    [
                        'email' => "jenny.nguyen@bidgear.com",
                        'name' => "jenny.nguyen@bidgear.com",
                        'type' => 'to',
                    ];//3
                $to[] =
                    [
                        'email' => "amy.grace@bidgear.com",
                        'name' => "amy.grace@bidgear.com",
                        'type' => 'to',
                    ];//4
                $to[] =
                    [
                        'email' => "kim.pham@bidgear.com",
                        'name' => "kim.pham@bidgear.com",
                        'type' => 'to',
                    ];//5
                $to[] =
                    [
                        'email' => "tom.vu@bidgear.com",
                        'name' => "tom.vu@bidgear.com",
                        'type' => 'to',
                    ];//6
                $to[] =
                    [
                        'email' => "nam.nt@bidgear.com",
                        'name' => "nam.nt@bidgear.com",
                        'type' => 'to',
                    ];//7
                $to[] =
                    [
                        'email' => "thuannd@bidgear.com",
                        'name' => "thuannd@bidgear.com",
                        'type' => 'to',
                    ];//8
                $to[] =
                    [
                        'email' => "thuy.do@bidgear.com",
                        'name' => "thuy.do@bidgear.com",
                        'type' => 'to',
                    ];//9
            }

            $sendEmail = true;
            echo "NG: " . $httpCode . "<br/>";
            echo "From: report.bidgear-syndication.com <br/>";
            echo "Source: " . $source . "<br/>";
            echo "Link: " . $link . "<br/>";
            $priority = " Loi 5xx va 0 rat nghiem trong. Neu canh bao tiep sau khoang 5 phut, thong bao cho moi nguoi biet ";
            echo "Priority: " . $priority . "<br/>";
            echo "===============<br/>";

            //TODO content && subject email in here
            $email->subject = "{$httpCode} - {$source} - Link error - {$dateTime}";
            $email->content = "Must check now<br/>";
            $email->content = "From: report.bidgear-syndication.com<br/>";
            $email->content .= "NG: " . $httpCode . "<br/>";
            $email->content .= "Source: " . $source . "<br/>";
            $email->content .= "Link: " . $link . "<br/>";
            $email->content .= "Priority: " . $priority . "<br/>";
        } else {
            echo "OK: " . $httpCode . "<br/>";
            echo "From: report.bidgear-syndication.com <br/>";
            echo "Source: " . $source . "<br/>";
            echo "Link: " . $link . "<br/>";
            echo "===============<br/>";
            $h = (int)date("H");
            $m = (int)date("i");
            if ((($m < 10) && ($h == 20))) {
                $sendEmail = true;
                //TODO send email daily
                //TODO content && subject email in here
                $email->subject = "OK - {$httpCode} - {$source} - Link success - {$dateTime}";
                $email->content = "It is OK<br/>";
                $email->content = "From: report.bidgear-syndication.com<br/>";
                $email->content .= "Code: " . $httpCode . "<br/>";
                $email->content .= "Source: " . $source . "<br/>";
                $email->content .= "Hour: " . $h . "<br/>";
                $email->content .= "minute: " . $m . "<br/>";
                $email->content .= "Link: " . $link . "<br/>";
            }
        }
        $email->to = Json::encode($to);
        $email->users = $to;
        if ($sendEmail) {
            echo "to send:...";
            $email->toSend();
        }
    }

    public static function slackAds($send = "")
    {
        $data = self::dataScan();
        foreach ($data as $item) {
            $source = $item['source'];
            $links = $item['items'];
            foreach ($links as $link) {
                self::toCheckSlackOne($source, $link, $send);
            }
            echo "<br/>-----------------------------<br/>";
        }
    }

    public static function toCheckSlackOne($source, $link, $send = '')
    {
        $sendSclack = false;
        if ($send == "1") {
            $sendSclack = true;
        }
        $dateTime = date('Y-m-d H:i:s');
        /*$t = uniqid();
        if ($source != "DSP_ES") {
            $link .= "&t={$t}";
        }*/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        $headers = [
            "Cache-Control: no-cache, no-store, must-revalidate, max-age=0",
            "Pragma: no-cache",
            "Expires: 0",
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        //TODO send slack
        $ch2 = curl_init("https://slack.com/api/chat.postMessage");
        if ((int)$httpCode != 200) {
            $sendSclack = true;
            $text = " Error - {$httpCode} - {$source} - Link error - {$dateTime}";
            $text .= " Link : {$link}";
            $text .= " From : astats.2mdnsys.com";
            $priority = "Cuc ky nghiem trong, canh bao moi nguoi cung biet luon ";
            $text .= " Priority : {$priority} ";

        } else {
            $h = (int)date("H");
            $m = (int)date("i");
            if (($m < 2) && ($h == 19)) {
                $sendSclack = true;
            }
            $text = " OK - {$httpCode} - {$source} - Link success - {$dateTime}";
            $text .= " Link : {$link} ";
            $text .= " From : astats.2mdnsys.com";
        }
        $data = [
            "token" => "xoxp-320115444835-320214229474-320770204369-4fcef2309788c1a69313f3f38155cff6",
            "channel" => "general",
            "text" => $text,
            "username" => "CheckAdsOwn",
        ];
        if ($sendSclack) {
            $data = http_build_query($data);
            curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 10000);
            $res = curl_exec($ch2);
            curl_close($ch2);
            var_dump($res);
        }
    }
}