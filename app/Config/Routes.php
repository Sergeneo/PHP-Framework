<?php
$this->route('/example', 'Home/example');

$this->route('/(:any).html', 'Home/page/$1');

$this->route('/', 'Home/index');