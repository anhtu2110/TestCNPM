<?php
    require_once $_SERVER['DOCUMENT_ROOT'] .'/MyHouseDecor/Connect/connectDatabase.php';
    class Cart_Model{
        private $db = null;

        public function __construct(){
            $this->db = new Database();
        }
        public function check_product_exist_with_UserID($UserID, $ProductID) {
            $conn = $this->db->getConnection();
            $query = "SELECT * FROM orders WHERE UserID = '$UserID' AND ProductID = '$ProductID'";
            $result = $conn->query($query);
            if($result == NULL) {
                return false;
            }
            return true;
        }
        public function get_quantity_product_exist($UserID, $ProductID) {
            $conn = $this->db->getConnection();
            $query = "SELECT Quantity FROM orders WHERE UserID = '$UserID' AND ProductID = '$ProductID'";
            $result = $conn->query($query);
            return result;
        }
        public function Show_CartModel($UserID){
            $conn = $this->db->getConnection();
            $query = "SELECT * FROM orders INNER JOIN products ON products.ProductID = orders.ProductID WHERE UserID = '$UserID'";
            $result = $conn->query($query);
            return $result;
        }
        public function Save_Tmp_Order($UserID,$ProductID,$price,$Title){
            $conn = $this->db->getConnection();
            $query = "INSERT INTO orders (UserID,ProductID,Price,Title) VALUES ($UserID,$ProductID,$price,'$Title')";
            $result = $conn->query($query);
            return $result;
        }
        public function Delete_Tmp_Product($ProductID){
            $conn = $this->db->getConnection();
            $query = "DELETE FROM orders WHERE ProductID = $ProductID";
            $result = $conn->query($query);
            return $result;
        }
        public function Update_Tmp_Order_Chuyen($ProductID,$quantity,$username,$total_price){
            $conn = $this->db->getConnection();
            $query = "UPDATE orders SET Quantity = $quantity,
            UserCustomer = '$username',
            Total_Price = $total_price,
            Status = 1
             WHERE ProductID = $ProductID";
            $result = $conn->query($query);
            return $result;
        }
        public function Update_Tmp_Order_User_id($ProductID,$quantity,$username,$total_price){
            $conn = $this->db->getConnection();
            $query = "UPDATE orders SET Quantity = $quantity,
            UserCustomer = '$username',
            Total_Price = $total_price,
            Status = 1
             WHERE ProductID = $ProductID";
            $result = $conn->query($query);
            return $result;
        }
        public function Update_Quantity_SoldDetail($quantity,$IDDetail){
            $conn = $this->db->getConnection();
            $query = "UPDATE details SET Quantity = Quantity - $quantity,
            Sold = Sold + $quantity
             WHERE IDDetail = $IDDetail";
            $result = $conn->query($query);
            return $result;
        }
    }
?>