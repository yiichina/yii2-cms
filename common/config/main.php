<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'timeZone' => 'PRC',
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
            'defaultRoles' => ['visitor'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
