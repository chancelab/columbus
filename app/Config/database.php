<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'columbus',
		'password' => 'columbus',
		'database' => 'columbus',
	);

	/*
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'columbus',
		'password' => 'columbus',
		'unix_socket' => '/tmp/mysql.sock',
		'database' => 'columbus',
		'prefix' => ''
	);
	*/
}
