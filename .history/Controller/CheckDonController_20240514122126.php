<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Model/CheckDonModel.php';
    class CheckDonController{
        private $model = null;

        public function __construct(){
            $this->model = new CheckDonModel();
        }

        public function Show_CheckOut($userID){
            return $this->model->Show_CheckOut($userID);
        }
        public function Update_CheckOut($userID,$ProductID){
            return $this->model->Update_CheckOut($userID,$ProductID);
        }
    }
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $checkDon = new CheckDonController();
        $ProductID = $_POST['id'];
        $userID = $_POST['UserID'];
        $result = $checkDon->Update_CheckOut($userID,$ProductID);
        if($result){
           header('Content-Type: application/json');
              echo json_encode(array('check' => true));
        }else{
            header('Content-Type: application/json');
            echo json_encode(array('check' => false));
        }
        
    }
        
?>