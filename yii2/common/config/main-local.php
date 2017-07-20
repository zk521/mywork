<?php
if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'www.myshop.com') {
    return [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=127.0.0.1;dbname=myshop',
                'username' => 'root',
                'password' => 'liu1205',
                'charset' => 'utf8',
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
                    'username' => 'm17600037299',
                    'password' => 'm199401m',
                    'port' => '25',
                    'encryption' => 'tls',

                ],
                'messageConfig'=>[
                    'charset'=>'UTF-8',
                    'from'=>['m17600037299@163.com'=>'admin']
                ],
            ],
        ],
    ];
} else {
    return [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=47.93.52.225;dbname=myshop',
                'username' => 'xsh',
                'password' => '123456',
                'charset' => 'utf8',
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
                    'username' => 'm17600037299',
                    'password' => 'm199401m',
                    'port' => '25',
                    'encryption' => 'tls',

                ],
                'messageConfig'=>[
                    'charset'=>'UTF-8',
                    'from'=>['m17600037299@163.com'=>'admin']
                ],
            ],
        ],
    ];
}
