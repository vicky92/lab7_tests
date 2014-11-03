<?php 
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR."..",
	'name' => 'Тесты',
	'import' => array (
		'application.models.*',
		'application.components.*',
        'ext.YiiMongoDbSuite.*',
	),
	'defaultController'=>'Main',
 	'components' => array (
       	'mongodb' => array(
          'class'            => 'EMongoDB',
          'connectionString' => 'mongodb://localhost',
          'dbName'           => 'testdb',
          'fsyncFlag'        => true,
          'safeFlag'         => true,
          'useCursor'        => false
        ),
	    'urlManager' => array (
	        'urlFormat' => 'path',
	        'showScriptName' => false,
	        'rules' => array(),
	    ),
    ),
);