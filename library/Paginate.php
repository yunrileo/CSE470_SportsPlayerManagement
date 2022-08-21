<?php
include 'Database.php';

class Paginate extends Database{

	protected $page = null;
	protected $total_page = null;
	protected $total_row = null;
	protected $row_per_page = null;
	protected $start = null;
	protected $next = null;
	protected $prev = null;
	protected $list_page = null;

	public function __construct()
	{
		$this->connect();
	}

	// Thiết lật trang hiện tại

	public function setPage()
	{	
		if (isset($_GET['page'])) { //Kiểm tra có tồn tại thuộc tính page trên url hay không

			$this->page = $_GET['page'];

		} else {
			$this->page = 1;
		}
	}


	//Thiết lập tổng số bản ghi trên một trang

	public function setRowPerPage($row_per_page)
	{
		$this->row_per_page = $row_per_page;
	}

	//Thiết lập tổng số bản ghi

	public function setTotalRow()
	{
		$this->total_row = $this->numRow();
	}


	//Thiết lập tổng số trang
	public function setTotalPage()
	{
		$this->total_page = ceil($this->total_row / $this->row_per_page);
	}

	//Thiết lập vị trí bắt đầu trong truy vấn sql
	public function start()
	{

		$this->start = $this->page * $this->row_per_page - $this->row_per_page;

	}

	//Phương thức khỏi tạo các tham số

	// public function init($row_per_page)
	// {
	// 	$this->setPage();
	// 	$this->setRowPerPage($row_per_page);
	// 	$this->setTotalRow();
	// 	$this->setTotalPage();
	// 	$this->start();
	// 	$this->setNext();
	// 	$this->setPrev();
	// }


	public function init($row_per_page)
	{
		$this->setPage();
		$this->setRowPerPage($row_per_page);
		$this->setTotalRow();
		$this->setTotalPage();
		$this->start();
		$this->setNext();
		$this->setPrev();

	}
	//Thiết lập trang tiếp theo
	public function setNext()
	{
		$this->next = $this->page + 1;

		if ($this->next == $this->total_page) {
			$this->next = $this->total_page;
		}
	}

	//Thiết lập trang trước
	public function setPrev()
	{
		$this->prev = $this->page - 1;

		if ($this->prev == 0) {
			$this->prev = 1;
		}
	}

	//Thiết lập mã HTML để đưa ra trình duyệt
	public function setListPage($namepage)
	{

		if ($this->page > 1) {
			$this->list_page .= '<li><a href="'.$namepage.'&page='.$this->prev.'">Truớc</a></li>';
		}

		for ($i = 1; $i <= $this->total_page; $i++) {

			if ($this->page == $i) {
				$this->list_page .= '<li class="active"><span>'.$i.'</span></li>';
			} else {
				$this->list_page .= '<li><a href="'.$namepage.'&page='.$i.'">'.$i.'</a></li> ';
			}

		}

		if ($this->page < $this->total_page) {
			$this->list_page .= '<li><a href="'.$namepage.'&page='.$this->next.'">Sau</a></li>';
		}
		
	}

	//Hiện thị phân trang ngoài trình duyệt

	public function paginate($row_per_page, $namepage = 'index.php?controller=admin')
	{
		$this->init($row_per_page);
		$this->setListPage($namepage);
		$this->loadLimit();
		return $this->list_page;

	}

	public function loadLimit()
	{
		$this->sql .= " LIMIT $this->start, $this->row_per_page";
		$this->query($this->sql);
	}

	// public function paginate($row_per_page)
	// {	
	// 	$this->init($row_per_page);
	// 	$this->setListPage();
	// 	$this->sql .= " LIMIT $this->start,$this->row_per_page";
	// 	$this->query($this->sql);
	// 	return $this->list_page;
	// }

}



