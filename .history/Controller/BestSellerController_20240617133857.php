<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/MyHouseDecor/Model/BestSellerModel.php';
    class BestSellerController{
        private $model = null;
        
        public function __construct()
        {
            $this->model = new BestSellerModel();
        }

        public function DisplayBestSeller(){
            $conn = $this->model->getBestSeller();
            $BestSellerItems = [];

            while($row = $conn->fetch_assoc()){
                $BestSellerItems[] = $row;
            }
            return $BestSellerItems;
        }
    }
?>