<?php
class BaseController extends Controller
{
	public $db;

	public function __construct()
	{
		parent::__construct();

		$this->db = new DataBase();
	}

	public function error($code = 404)
	{
		$data['text'] = '';

		if ($code === 404) {
			header('HTTP/1.0 404 Not Found');
			$data['text'] = 'Error 404: Page not found';
		} else {
			$data['text'] = $code .': Error';
		}

		$this->view('error_view', $data);
	}
}