<?php
namespace backend\models;

use Yii;

class Upload extends \yii\db\ActiveRecord
{

    public $file;

    public static function tableName()
    {
        return '{{%brand}}';
    }

    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }
}