<?php
class DataBase extends App
{
	public $db = false;

	public function __construct(string $name = 'default')
	{
		$config = $this->database['mysqli'][$name];

		if ($config['status']) {
			$this->db = new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);

			if ($this->db->connect_errno) {
				exit('Connect failed: '. $this->db->connect_error);
			}

			$this->db->set_charset($config['charset']);
		}
	}

	public function query(string $sql)
	{
		return $this->db->query($sql);
	}

	public function fetchRows(string $sql)
	{
		$rows = [];
		$query = $this->query($sql);

		while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function fetchRow(string $sql)
	{
		$query = $this->query($sql);

		return $query->fetch_array(MYSQLI_ASSOC);
	}
}