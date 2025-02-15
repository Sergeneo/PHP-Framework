<?php
class Controller
{
	public $app;

	public function __construct()
	{
		$this->app = new App();
	}

	public function view(string $name, array $data = [])
	{
		$data = array_merge($this->app->public, $data);

		require_once APP .'/Views/'. $name .'.php';
	}
}