<?php 
include('../../connection/config.php');
class CustomerModel
{
	public $config;
	public function __construct()
	{
		$con_obj = new Connection();
		$this->config = $con_obj->connect();
		
		
	}
	/*public function addCategory($name,$desc,$st)
	{
		$query = "insert into category (`c_name`, `c_description`,`available`) values ('$name','$desc','$st')";
		$res=mysqli_query($this->config,$query);

		if($res){
			return $res;
		}
	}*/
	public function ShowOrder()
	{
		$query = "SELECT 
					orders.id,users.name,order_no, SUM(order_details.price) AS TotalAmount 
					FROM orders  JOIN users  ON orders.user_id = users.id 
					JOIN order_details  ON orders.id = order_details.order_id 
					GROUP BY  orders.id, users.name 
					ORDER BY orders.id";
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
	/*public function SearchOneCategory($id)
	{
		$query = "select * from category where c_id=$id";
		$res=mysqli_query($this->config,$query);
		 $data=mysqli_fetch_assoc($res);
		if($data!=null){
			return $data;
		}
	}
	public function UpdateCategory($id,$name,$desc,$status)
	{
		$query = "update category set c_name='$name',c_description='$desc',available='$status' where c_id=$id";
		$res=mysqli_query($this->config,$query);
		if($res){
			return $res;
		} 
		
	}*/
	
}	

?>