<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('memory_limit', '-1');

date_default_timezone_set('UTC');
session_start();

define('TIME', time());
define('ROOT', __DIR__);
define('APP', ROOT .'/app');
define('DATA', ROOT .'/data');
define('SYSTEM', ROOT .'/system');

require_once SYSTEM .'/Bootstrap.php';

$app = new Bootstrap();
$app->run();