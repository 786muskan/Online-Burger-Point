<?php 
include('../../connection/config.php');
class CategoryModel
{
	public $config;
	public function __construct()
	{
		$con_obj = new Connection();
		$this->config = $con_obj->connect();
		
		
	}
	public function addCategory($name,$desc,$st)
	{
		$query = "insert into categories (`name`, `description`,`status`) values ('$name','$desc','$st')";
		$res=mysqli_query($this->config,$query);

		if($res){
			return $res;
		}
	}
	public function ShowCategory()
	{
		$query = "select * from categories";
		$res=mysqli_query($this->config,$query);
		$data=[];
		while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
		 	// code...
		 	$data[]=$row;
		 } 
		if($data!=null){
			return $data;
		}
	}
	public function SearchOneCategory($id)
	{
		$query = "select * from categories where id=$id";
		$res=mysqli_query($this->config,$query);
		 $data=mysqli_fetch_assoc($res);
		if($data!=null){
			return $data;
		}
	}
	public function UpdateCategory($id,$name,$desc,$status)
	{
		$query = "update categories set name='$name',description='$desc',status='$status' where id=$id";
		$res=mysqli_query($this->config,$query);
		if($res){
			return $res;
		} 
		
	}
	
}	

?>