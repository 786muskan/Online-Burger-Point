<?php 
include("../model/category_model.php");
class CategoryController
{
	public $cat;
	public function __construct()
	{
		$this->cat = new CategoryModel();
	}
	public function insertCat($name,$desc,$st)
	{
		return $this->cat->addCategory($name,$desc,$st);
	}
	public function showCat()
	{
		return $this->cat->ShowCategory();
	}
	public function searchCat($id)
	{
		return $this->cat->SearchOneCategory($id);
	}
	public function upCategory($id,$name,$desc,$status){
		return $this->cat->UpdateCategory($id,$name,$desc,$status);
	}

}
?>