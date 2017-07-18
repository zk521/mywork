<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/13
 * Time: 16:56
 */
namespace  frontend\models;

use yii\base\model;
use yii\web\UploadedFile;
class UploadFile extends Model
{
    public $file;
    public function rules()
    {
        return[
            ['file','file','skipOnEmpty'=>false],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if(!file_exists('uploads'))
            {
                mkdir('uploads');
            }
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}