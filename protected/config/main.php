<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Test Web Application',

	'sourceLanguage' => 'en', // set default messages to russian language

	// preloading 'log' component
	'preload'=>array('log', 'input'),

	// set theme
	'theme'=>'mcowkin',

	'defaultController' => 'page',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'skyscanner',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false, // hide index.php from url
			'rules'=>array(
				'gii'=>'gii',
				'skyscanner'=>array('skyscanner', 'urlSuffix' => ''), // this is rule for getting acces to skyscanner module
				''=>array('skyscanner', 'urlSuffix' => ''), // this is rule for HOME PAGE
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'input'=>array(
			'class'		=>	'CmsInput',
			'cleanPost'	=>	false,
			'cleanGet'	=>	false,
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'errors/pagenotfound',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'logFile'=>'warningLog',
				),
				// save errors: WARNING in file
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'warning',
					'logFile'=>'warningLog',
				),
				// save errors: INFO in file
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info',
					'logFile'=>'infoLog',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	    'clientScript' => array(
	        // disable default yii scripts
	        'scriptMap' => array(
	            'jquery.js'     => false,
	            'jquery.min.js' => false,
	            'core.css'      => false,
	            'styles.css'    => false,
	            'pager.css'     => false,
	            'default.css'   => false,
	            'jquery-ui.min.js' => false,
	            'jquery-ui.css' => false,
	        ),
	        'coreScriptPosition'=>CClientScript::POS_END,
            'defaultScriptPosition'=>CClientScript::POS_END,
            'defaultScriptFilePosition'=>CClientScript::POS_END
	    ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'skyscannerApiKey'=>'we362092799388808932220568263975',
		'informEmail' => 'pomidor@mynewtrip.com'
	),
);
