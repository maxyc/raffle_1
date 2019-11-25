<?php
return [
    'language'=>'ru',
    'sourceLanguage'=>'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true, //  запрещаем index.php
            'showScriptName' => false, //// запрещаем r= routes
            'rules' => [ // здесь описываем правила формирования ссылок
            ],
        ],
    ],
];
