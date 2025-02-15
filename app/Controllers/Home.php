<?php
class Home extends BaseController
{
	public function __construct()
	{
		parent::__construct();

		require_once APP .'/Models/HomeModel.php';
	}

	public function index()
	{
		$model = new HomeModel();

		$data['text'] = $model->show();

		$this->view('home_view', $data);
	}

	public function example()
	{
		$this->view('home_view', ['text' => 'Example']);
	}

	public function page($value = '')
	{
		$this->view('home_view', ['text' => $value]);
	}
}