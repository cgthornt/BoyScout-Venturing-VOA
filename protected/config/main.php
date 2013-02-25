<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Grand Canyon VOA',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'defaultController'=>'home',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'class' => 'WebUser',
                        //'loginUrl' => 'user/login',
		),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=voa',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'imapNow17z',
			'charset' => 'utf8',
                        'class'=>'CDbConnection',
		),

		

        'urlManager'=>array(
                'urlSuffix' => '.html',
        	'urlFormat'=>'path',
        	'rules'=>array(
        		'home/<page:\w+>'=>'home/view',
                        'site/login' => 'user/login',
                        'user' => 'user/login',
                        'events/<id:\d+>' => 'events/view',
                        

        	),
        ),
        

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);