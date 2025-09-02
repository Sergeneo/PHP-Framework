<?php
class App
{
	public $database = [
		'mysqli' => [
			'default' => [
				'status' => true,
				'host' => 'localhost',
				'user' => 'root',
				'pass' => '',
				'name' => 'crypto',
				'charset' => 'utf8',
			],
		],
	];

	public $public = [
		'version' => '1.0',
		'title' => 'PHP Framework',
		'description' => '',
		'header' => '',
		'footer' => '',
	];
}
