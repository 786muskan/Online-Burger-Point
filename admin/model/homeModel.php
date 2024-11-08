<?php 
include('../../connection/config.php');
class HomeModel
{
	public $config;
	public function __construct()
	{
		$con_obj = new Connection();
		$this->config = $con_obj->connect();
		
		
	}
	public function countOrders()
	{
		$query = "SELECT count(orders.id) from orders";
		$object = mysqli_query($this->config,$query);
		$row=mysqli_fetch_array($object);
		//var_dump($row);
		/*$name = mysqli_fetch_assoc($object);
		//echo "string";
		//var_dump($name);*/
		
			return $row;
		
	}
	public function countCustomers()
	{
		$query = "SELECT count(`id`) from users where `type`='customer'";
		$object = mysqli_query($this->config,$query);
		$row=mysqli_fetch_array($object);
		//var_dump($row);
		/*$name = mysqli_fetch_assoc($object);
		//echo "string";
		//var_dump($name);*/
		
			return $row;
		
	}
	public function countProducts()
	{
		$query = "SELECT count(`id`) from products";
		$object = mysqli_query($this->config,$query);
		$row=mysqli_fetch_array($object);
		return $row;
			
	}
	public function showOrderItems()
	{
		$query = "SELECT order_details.id,users.name,products.name,orders.order_no,products.price,order_details.qty from order_details INNER join orders on order_details.order_id=orders.id inner join users on orders.user_id = users.id inner join products on order_details.product_id=products.id";
		$object = mysqli_query($this->config,$query);
		$data=[];
		while ($row = $object->fetch_array(MYSQLI_ASSOC)) {
		 	$data[]=$row;
		 }
		 return $data;
			
	}
		 
	public function categoriesCount()
	{
		$query = "SELECT  c.name, COUNT(od.id) AS order_count FROM order_details od JOIN products p ON od.product_id = p.id JOIN categories c ON p.category_id = c.id GROUP BY  c.name";
		$object = mysqli_query($this->config,$query);
		$data=[];
		while ($row = $object->fetch_array(MYSQLI_ASSOC)) {
		 	$data[]=$row;
		 }
		 return $data;
			
	}
	public function productCount()
	{
		$query = "SELECT p.name, SUM(od.qty) AS total_sales FROM products p JOIN order_details od ON p.id = od.product_id JOIN orders o ON o.id = od.order_id GROUP BY  p.id, p.name ORDER BY  total_sales DESC LIMIT 5";
		$object = mysqli_query($this->config,$query);
		$data=[];
		while ($row = $object->fetch_array(MYSQLI_ASSOC)) {
		 	$data[]=$row;
		 }
		 return $data;
			
	}
		

		//Montserrat , sans-serif

	
	
}	

?>