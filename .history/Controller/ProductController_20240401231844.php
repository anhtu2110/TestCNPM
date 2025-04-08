<?php
	require_once './Model/ProductModel.php';

	class ProductController{
		private $model = null;

	public function __construct(){
		$this->model = new ProductModel();
	}

	public function getProductController(){
		return $this->model->getProductModel();
	}
	}
?>