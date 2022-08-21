<?php
class Database
{

	protected $DB_HOST = "localhost";
	protected $DB_USER = "root";
	protected $DB_PASSWORD = "mysql@123";
	protected $DB_DATABASE = 'vietprok55-mvc';

	protected $_conn = null;
	protected $result = null;
	protected $numrow = null;
	protected $data = null;
	protected $sql = null;



	//Kết nối tới database
	public function connect()
	{
		$this->_conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_DATABASE);
		if (!$this->_conn) {
			die("Không thể kết nối tới database");

		}
		mysqli_query($this->_conn, "SET NAMES 'utf8'");
	}


	//Thực thi câu truy vấn
	public function query($sql)
	{
		$this->sql = $sql;
		$this->result = mysqli_query($this->_conn, $this->sql);

	}



	//Đếm tổng số bản ghi trả về 
	public function numRow()
	{
		if ($this->result) {

			$this->numrow = mysqli_num_rows($this->result);
		}
		return $this->numrow;
	}

	//Lấy toàn bộ dự liệu trả về
	public function get()
	{
		if ($this->result) {
			$this->data = [];
			while($row = mysqli_fetch_assoc($this->result)) {
				$this->data[] = $row;
			}
		}
		return $this->data;

	}

	//Lấy dữ liệu của record đầu tiên
	public function first()
	{
		if ($this->result) {
			$this->data = mysqli_fetch_assoc($this->result);
		}	
		return $this->data;
	}

}




