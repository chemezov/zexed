<?php
    return array(
    // У вас этот путь может отличаться. Можно подсмотреть в config/main.php.
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Cron',

    'preload' => array('log'),

    'import' => array(
        'application.components.*',
        'application.models.*',
        'application.modules.queue.models.*'
    ),
    // Перенаправляем журнал для cron-а в отдельные файлы
    'components' => array(
         // компонент для отправки почты
        'mail' => array(
            'class' => 'application.modules.yupe.components.YMail',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron.log',
                    'levels' => 'error, warning, info',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron_trace.log',
                    'levels' => 'trace',
                ),
            ),
        ),
		'image'        => array(
			'class'  => 'application.modules.yupe.extensions.image.CImageComponent',
			'driver' => 'GD', // если ImageMagick, надо указать к нему путь ниже
			'params' => array('directory' => '/usr/bin'), // в этой директории должен быть convert
		),
           // параметры подключения к базе данных, подробнее http://www.yiiframework.ru/doc/guide/ru/database.overview
        'db' => require(dirname(__FILE__) . '/db.php'),
    ),
);