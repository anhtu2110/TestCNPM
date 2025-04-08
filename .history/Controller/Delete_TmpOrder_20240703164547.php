<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/MyHouseDecor/Model/Add_To_CartModel.php';
    class Delete_TmpOrder{
        private $model = null;
        public function __construct(){
            $this->model = new Cart_Model();
        }
        public function Delete_TmpOrderController($ProductID, $userID){
            $result = $this->model->Delete_Tmp_Product($ProductID, $userID);
            return $result;
        }
    }
    if(isset($_POST['ProductID'])){
        $ProductID = $_POST['ProductID'];
        $controller = new Delete_TmpOrder();
        $result = $controller->Delete_TmpOrderController($ProductID, $_SESSION['userID']);
        if($result){
            echo json_encode(array('check'=>true));
        }
        else{
            echo json_encode(array('check'=>false));
        }
    }
    else{
        echo json_encode(array('check'=>false));
    }
?>