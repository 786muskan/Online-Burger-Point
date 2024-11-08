<?php 
include("../model/login_model.php");
class LoginController
{
	public $login_us;
	public function __construct()
	{
		$this->login_us = new LoginModel();
	}
	public function CheckUserController($username,$pass)
	{
		return $this->login_us->CheckUser($username,$pass);
	}
	
}
?>