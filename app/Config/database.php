<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'login' => 'lojasingular',
		'password' => 'lojasingular',
		'database' => 'fgv_interno',
	);
	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
	);
	public $fgv_interno = array(
		'datasource' => 'Database/Mysql',
		'persistent' => true,
		'host' => '192.168.101.200',
		'port' => 3306,
		'login' => 'lojasingular',
		'password' => 'lojasingular',
		'database' => 'fgv_interno',
		'encoding' => 'utf-8'
	);
}
