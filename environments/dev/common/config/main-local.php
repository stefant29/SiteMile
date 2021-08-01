<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=172.29.0.1:3336;dbname=sitemile',
            'username' => 'sitemile',
            'password' => 'sitemile-password',
            'charset' => 'utf8',
            'attributes' => [PDO::ATTR_CASE => PDO::CASE_LOWER],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'nexhelios@gmail.com',
                'password' => 'tuzdzxvwmvxcnzff',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
