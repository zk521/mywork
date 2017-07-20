<?php
namespace backend\models;

use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\captcha\Captcha;

/**
 * UploadForm is the model behind the upload form.
 */
class Uploadbanner extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false],
        ];
    }

    public function upload($file='')
    {
        if($this->validate())
        {
            if(!file_exists('ad_img'))
            {
                mkdir('ad_img');
            }
            $name = mb_convert_encoding($this->file->baseName,"GBK","UTF-8") . '.' . $this->file->extension;

            // if(!empty($file)) {
            //     $a = unlink(__DIR__ . '/../web/'.$file);
            //     echo "<pre>";
            //     var_dump($a);die;
            // }
            
            $this->file->saveAs('ad_img/' . $name);
            return true;
        }
        else
        {
            return false;
        }
    }
}