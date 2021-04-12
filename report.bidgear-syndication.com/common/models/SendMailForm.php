<?php
namespace common\models;

use common\entities\service\Email;

/**
 * Date: 10/1/15
 * Time: 2:42 PM
 */

/**
 * Class SendMailForm
 * @package backend\modules\service\forms\mail
 *
 * @property array $users
 * @property array $attach_files
 */
class SendMailForm extends Email
{
    const
        API_KEY = "u7Mp3hzQxGmL4Eg4_JMJzw";//bidgear.com

    const
        TYPE_TEXT = "text",
        TYPE_HTML = "html";

    const
        STATUS_PENDING = 1,
        STATUS_SENT = 2,
        STATUS_REJECT = -1;

    const
        SUPPORT_EMAIL = 'support@2mdnsys.com',
        INFO_EMAIL = 'info@2mdnsys.com',
        PAYMENTS_EMAIL = 'payments@bidgear.com';

    const
        SUPPORT_NAME = '2mdn Technical Support',
        INFO_NAME = '2mdn Info',
        PAYMENT_NAME = '2mdn Payments';

    public $users = [];
    public $attach_files = [];

    public function toSend()
    {
        $this->type = static::TYPE_HTML;
        return $this->sendMail();
    }

    private function sendMail()
    {
        if (\Yii::$app->params["code.send_email"]) {
            if (\Yii::$app->params["code.server_email"] == 'smtp_google') {
                echo "google";
                require_once \Yii::getAlias("@common") . "/util/PHPMailer/class.phpmailer.php";
                require_once \Yii::getAlias("@common") . "/util/PHPMailer/class.smtp.php";
                require_once \Yii::getAlias("@common") . "/util/PHPMailer/class.pop3.php";

                $mail = new \PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'x8mediavn@gmail.com';
                $mail->Password = 'toiditimtoi234';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($this->from_email, $this->from_name);
                $to = $this->users;
                foreach ($to as $item) {
                    $mail->addAddress($item['email'], $item['email']);
                }
                $mail->addReplyTo($this->from_email, $this->from_name);
                $mail->isHTML(true);

                $mail->Subject = $this->subject;
                $mail->Body = $this->content;

                if (!is_null($this->attach_files) && is_array($this->attach_files) && !empty($this->attach_files)) {
                    foreach ($this->attach_files as $attachment) {
                        $attachment_type = "application/octet-stream";
                        if(isset($attachment['type'])){
                            $attachment_type = $attachment['type'];
                        }
                        $mail->addAttachment($attachment['file'],$attachment_type);
                    }
                }

                if (!$mail->send()) {
                    echo "error";
                }
                return true;
            }
        }
        return false;
    }
}