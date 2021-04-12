<?php

namespace common\models;

use common\entities\service\Email;

/**
 * Class SendMailBackendForm
 * @package backend\modules\service\forms\mail
 *
 * @property array $users
 * @property array $attach_files
 */
class SendMailBackendForm extends Email
{
    const
        //API_KEY = 'QFnoIGfBJI6I4V6YKFtgQQ';//x8code.org
        API_KEY = "u7Mp3hzQxGmL4Eg4_JMJzw";//bidgear.com

    const
        TYPE_TEXT = "text",
        TYPE_HTML = "html";

    const
        STATUS_PENDING = 1,
        STATUS_SENT = 2,
        STATUS_REJECT = -1;

    const
        SUPPORT_EMAIL = 'support@bidgear.com',
        INFO_EMAIL = 'info@bidgear.com',
        PAYMENTS_EMAIL = 'payments@bidgear.com';

    const
        //SUPPORT_NAME = 'Hỗ trợ kỹ thuật Bidgear',
        SUPPORT_NAME = 'Notify Team',
        INFO_NAME = 'Notify Info',
        PAYMENT_NAME = 'BidGear Payments';

    public $users = [];
    public $attach_files = [];

    public function toSend()
    {
        $this->type = static::TYPE_HTML;
        return $this->sendMail();
    }

    private function sendMail()
    {
        require_once \Yii::getAlias("@common") . "/util/PHPMailer/class.phpmailer.php";
        require_once \Yii::getAlias("@common") . "/util/PHPMailer/class.smtp.php";
        require_once \Yii::getAlias("@common") . "/util/PHPMailer/class.pop3.php";

        $mail = new \PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'AKIAJSNEZEN6Z7P5TJUA';
        $mail->Password = 'AvgGBGK6jZSn5nKgrNrFdo6FVwHjF83VM7vmSJJ+OyQo';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($this->from_email, $this->from_name);
        $to = $this->users;
        foreach ($to as $item) {
            if (isset($item['type'])) {
                if ($item['type'] == 'to') {
                    $mail->addAddress($item['email'], $item['email']);
                }
                if ($item['type'] == 'bcc') {

                }
            }
        }
        $mail->addReplyTo($this->from_email, $this->from_name);
        $mail->isHTML(true);

        $mail->Subject = $this->subject;
        $mail->Body = $this->content;

        if (!is_null($this->attach_files) && is_array($this->attach_files) && !empty($this->attach_files)) {
            foreach ($this->attach_files as $attachment) {
                $attachment_type = "application/octet-stream";
                if (isset($attachment['type'])) {
                    $attachment_type = $attachment['type'];
                }
                $mail->addAttachment($attachment['file'], $attachment_type);
            }
        }

        if (!$mail->send()) {
            return false;
        }
        return true;
    }
}