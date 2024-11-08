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
	public function ShowCustomer()
	{
		$query = "SELECT * from users where users.type='customer' ";
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
	public function SearchOneCustomer($id)
	{
		$query = "select * from users where id=$id";
		$res=mysqli_query($this->config,$query);
		 $data=mysqli_fetch_assoc($res);
		if($data!=null){
			return $data;
		}
	}
	public function SearchOneOrder($id)
	{
		$query = "select orders.id,orders.order_no,name,order_date  from orders inner join users on users.id=orders.user_id where orders.id=$id";
		$res=mysqli_query($this->config,$query);
		 $data=mysqli_fetch_assoc($res);
		if($data!=null){
			return $data;
		}
	}
	public function ShowOrders($id)
	{
		$query = "SELECT orders.id, orders.order_no, SUM(order_details.price) AS TotalAmount FROM orders INNER JOIN order_details ON orders.id = order_details.order_id INNER JOIN users ON orders.user_id = users.id INNER JOIN products ON order_details.product_id = products.id WHERE users.id = $id GROUP BY orders.id, orders.order_no;";
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
	public function ShowProducts($id)
	{
		$query = "SELECT od.id, u.id,p.image, p.name ,od.qty , (od.qty * p.price) FROM order_details od JOIN products p ON od.product_id = p.id JOIN orders o ON od.order_id = o.id  join users u on u.id=o.user_id WHERE o.id = $id";
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
	/*
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