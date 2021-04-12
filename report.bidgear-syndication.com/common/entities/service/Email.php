<?php

namespace common\entities\service;

use backend\models\BackendForm;

/**
 * This is the model class for table "email".
 *
 * @property string $type
 * @property string $subject
 * @property string $content
 * @property string $from_email
 * @property string $from_name
 * @property string $to
 * @property string $attachments
 * @property string $result
 * @property string $params
 *
 * @property integer $status
 * @property string $created_at
 */
class Email extends BackendForm
{
    public $status;
    public $created_at;
    public $params;
    public $attachments;
    public $subject;
    public $content;
    public $to;
    public $result;
    public $type;
    public $from_email;
    public $from_name;

    public static function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            @unlink($filePath);
            return true;
        }
        return false;
    }
}

