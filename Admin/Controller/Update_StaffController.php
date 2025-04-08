<?php
    if(isset($_POST)){
        $userID = $_POST['userID'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $extraTime = $_POST['extratime'];
        $status = $_POST['status'];
        $phone = $_POST['phone'];
    
        if (isset($_FILES['file'])) {
            $uploadDir = '../img/';
            $targetFile = $uploadDir . basename($_FILES['file']['name']);
            
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                require_once '../Model/Admin_UserModel.php';
                $controller = new Admin_UserModel();
                $result = $controller->Update_Staff($userID,$fullname, $username, $password, $email,$phone, $address, basename($_FILES['file']['name']), $extraTime, $status);
                if ($result) {
                    header('Content-type: application/json');
                    echo json_encode(['check' => true, 'message' => 'Chỉnh sửa nhân viên Thành Công!']);
                } else {
                    header('Content-type: application/json');
                    echo json_encode(['check' => false, 'message' => 'Chỉnh sửa nhân viên thất bại!']);
                }
            } else {
                header('Content-type: application/json');
                echo json_encode(['check' => false, 'message' => 'Không thể di chuyển file đến thư mục đích!']);
            }
        } else {
            header('Content-type: application/json');
            echo json_encode(['check' => false, 'message' => 'Không có file được gửi kèm!']);
        }
    } else {
        header('Content-type: application/json');
        echo json_encode(['check' => false, 'message' => 'Không có dữ liệu được gửi từ client!']);
    }
?>