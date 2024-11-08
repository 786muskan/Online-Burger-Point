<?php 
include('../../connection/config.php');
class ProductModel
{
	public $config;
	public function __construct()
	{
		$con_obj = new Connection();
		$this->config = $con_obj->connect();
		
		
	}
	public function addProduct($name,$cid,$ptype,$desc,$price,$image,$st)
	{
		$query = "insert into products (`name`, `category_id`,`type`,`description`, `price`, `image`,`status`) values ('$name',$cid,'$ptype','$desc',$price,'$image','$st')";
		//echo $query;
		var_dump($query);
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
	public function ShowProduct()
	{
		$query = "SELECT products.id,products.image,products.name,products.type,products.description,products.price,products.status,categories.name as c_name from products left join categories on products.category_id=categories.id";
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
	
	public function SearchOneProduct($id)
	{
		$query = "select * from product where p_id=$id";
		$res=mysqli_query($this->config,$query);
		 $data=mysqli_fetch_assoc($res);
		if($data!=null){
			return $data;
		}
	}
	public function UpdateProduct($id,$name,$ptype,$desc,$price,$image,$st)
	{
		$query = "update product set p_name='$name',p_type='$ptype',p_description='$desc',p_price=$price,p_images='$image',available='$st' where p_id=$id";
		$res=mysqli_query($this->config,$query);
		if($res){
			return $res;
		} 
		
	}
	
}	

?>