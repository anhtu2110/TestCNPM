<?php
session_start();
    require_once '../Model/Add_To_CartModel.php';
    class Cart_Controller{
        private $model = null;
        public function __construct(){
            $this->model = new Cart_Model();
        }
        public function Save_Tmp_OrderController($UserID,$ProductID,$Price,$Title){
            $result = $this->model->Save_Tmp_Order($UserID,$ProductID,$Price,$Title);
            return $result;
        }
    }
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $controller = new Cart_Controller();
        $UserID = $_SESSION['userID'];
        $IDSpham = $_POST['IDSpham'];
        $Price = $_POST['Price'];
        $Title = $_POST['Title'];
        $result = $controller->Save_Tmp_OrderController($UserID,$IDSpham,$Price,$Title);
        if($result){
            header('Content-Type: application/json');
            echo json_encode(['success'=>true,'message'=>'Thêm vào giỏ hàng thành công']);
        }else{
            header('Content-Type: application/json');
            echo json_encode(['success'=>false,'message'=>'Không thể thêm vào giỏ hàng']);
        }
    }

?>