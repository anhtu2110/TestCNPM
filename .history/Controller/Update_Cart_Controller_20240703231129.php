<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/MyHouseDecor/Model/Add_To_CartModel.php';

    class Update_Controller {
        private $model = null;
        public function __construct() {
            $this->model = new Cart_Model();
        }

        public function Update_Quantity_Product_Exist_Controller($UserID, $ProductID, $quantity, $total_price) {
            $result = $this->model->Update_Quantity_Product_Exist($UserID, $ProductID, $quantity, $total_price);
            return $result;
        }
        public function Get_Total_Price_Controller($UserID) {
            $result = $this->model->Get_Total_Price($UserID);
            return $result;
        }
    }

    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){   
        $controller = new Update_Controller();
        $quantity = $_POST['quantity'];
        $ProductID = $_POST['product_id'];
        $price = $_POST['price'];
        $Price = $_POST['Price'];
        $Title = $_POST['Title'];
        if($controller->get_quantity_product_exist_Controller($UserID, $ProductID) > 0) {
            $quantity = $controller->get_quantity_product_exist_Controller($UserID, $ProductID) + 1;
            $total_price = $quantity * $Price;
            $result = $controller->Update_Quantity_Product_Exist_Controller($UserID, $ProductID, $quantity, $total_price);
        } else {
            $quantity = 1;
            $total_price = $quantity * $Price;
            $result = $controller->Save_Tmp_OrderController($Title, $ProductID, $UserID, $username, $Price, $quantity, $total_price);
        }
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success'=>true,'message'=>'Thêm vào giỏ hàng thành công']);
        }else{
            header('Content-Type: application/json');
            echo json_encode(['success'=>false,'message'=>'Không thể thêm vào giỏ hàng']);
        }
    }
?>