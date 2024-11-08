<?php 
include("../model/customerModel.php");
class CustomerController
{
	public $cus;
	public function __construct()
	{
		$this->cus = new CustomerModel();
	}
	/*public function insertCat($name,$desc,$st)
	{
		return $this->cus->addCategory($name,$desc,$st);
	}*/
	public function showCus()
	{
		return $this->cus->ShowCustomer();
	}
	public function showOrder($id)
	{
		return $this->cus->ShowOrders($id);
	}
	public function showProduct($id)
	{
		return $this->cus->ShowProducts($id);
	}
	public function searchCust($id)
	{
		return $this->cus->SearchOneCustomer($id);
	}
	public function searchOrder($id)
	{
		return $this->cus->SearchOneOrder($id);
	}/*
	public function upCategory($id,$name,$desc,$status){
		return $this->cus->UpdateCategory($id,$name,$desc,$status);
	}*/

}
?>