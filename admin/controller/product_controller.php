<?php 
include("../model/product_model.php");
class ProductController
{
	public $product;
	public function __construct()
	{
		$this->product = new ProductModel();
	}
	public function insertproduct($name,$cid,$ptype,$desc,$price,$image,$st)
	{
		return $this->product->addProduct($name,$cid,$ptype,$desc,$price,$image,$st);
	}
	public function showCat()
	{
		return $this->product->ShowCategory();
	}
	public function showProduct()
	{
		return $this->product->ShowProduct();
	}
	
	public function searchProduct($id)
	{
		return $this->product->SearchOneProduct($id);
	}
	public function upProduct($id,$name,$ptype,$desc,$price,$image,$st){
		return $this->product->UpdateProduct($id,$name,$ptype,$desc,$price,$image,$st);
	}

}
?>