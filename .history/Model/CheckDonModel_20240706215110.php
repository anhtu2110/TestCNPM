<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/MyHouseDecor/Connect/connectDatabase.php';
    class CheckDonModel{
        private $db = null;

        public function __construct(){
            $this->db = new Database();
        }

        public function Show_CheckOut($userID){
            $conn = $this->db->getConnection();
            $query = "SELECT orders.*, products.Image FROM orders INNER JOIN products 
            ON products.ProductID = orders.ProductID WHERE UserID = '$userID' AND status IS NOT NULL";
            $result = $conn->query($query);
            return $result;
        }
        public function Update_CheckOut($userID,$ProductID){
            $conn = $this->db->getConnection();
            $query = "UPDATE orders SET status = 2
             WHERE UserID = $userID AND ProductID = $ProductID";
            $result = $conn->query($query);
            return $result;
        }
    }
?>