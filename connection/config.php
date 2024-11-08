<?php 
class Connection
{
	public $conn;
	public function connect()
	{
		$this->conn = mysqli_connect("localhost","root","","copyphp");
		if($this->conn)
		{
			//echo "connected!!";
		}
		return $this->conn;
	}
}

?>