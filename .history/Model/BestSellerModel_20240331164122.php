<?php
    require_once './Connect/connectDatabase.php';
    class BestSellerModel{
        private $db = null;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function getBestSeller(){
            $conn = $this->db->getConnection();
            $query = "SELECT * FROM products WHERE IsBestSeller = 1";
            $result = $conn->query($query);
            return $result;
        }
    }
?>