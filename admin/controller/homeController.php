<?php 
include("../model/homeModel.php");
class HomeController
{
	public $home;
	public function __construct()
	{
		$this->home = new HomeModel();
	}
	public function countOrder()
	{
		return $this->home->countOrders();
	}
	public function countCustomer()
	{
		return $this->home->countCustomers();
	}
	public function countProduct()
	{
		return $this->home->countProducts();
	}
	public function showOrderItem()
	{
		return $this->home->showOrderItems();
	}
	public function categoryCount()
	{
		return $this->home->categoriesCount();
	}
	public function ProductsCount()
	{
		return $this->home->productCount();
	}

}
?>