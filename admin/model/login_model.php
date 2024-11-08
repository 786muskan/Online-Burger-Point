<?php 
include('../../connection/config.php');
class LoginModel
{
	public $config;
	public function __construct()
	{
		$con_obj = new Connection();
		$this->config = $con_obj->connect();
		
		
	}
	public function CheckUser($username,$pass)
	{
		$query = "select name from users where username= '$username' AND password ='$pass'";
		$object = mysqli_query($this->config,$query);

		
		$name = mysqli_fetch_assoc($object);
		//var_dump($name['name']);
		//echo "string";
		if($name!=null){
			return $name;
		}
	}
	
	
	
}	

?>