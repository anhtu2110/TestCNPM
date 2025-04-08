<?php
session_start();
require_once './Controller/auth.php';
require_once './Include/header.php';
?>
<style>
@media (max-width: 768px) {

    h1,
    h2,
    h3,
    h5,
    h4,
    h6 {
        font-size: 1.5rem;
        /* Giảm kích thước tiêu đề */
    }

    p {
        font-size: 1rem;
        /* Giảm kích thước đoạn văn */
    }

    button {
        font-size: 0.9rem;
        /* Giảm kích thước nút */
    }
}

@media (max-width: 576px) {

    h1,
    h2,
    h3,
    h5,
    h4,
    h6 {
        font-size: 1.2rem;
        /* Giảm thêm kích thước tiêu đề */
    }

    p {
        font-size: 0.8rem;
        /* Giảm thêm kích thước đoạn văn */
    }

    button {
        font-size: 0.7rem;
        /* Giảm thêm kích thước nút */
    }
}
</style>
<div class="check-out ">
    <div class="container-fluid p-0">
        <div class="imgcheck">
            <img src="./img/lovepik-mount-everest-snow-mountain-picture_500599227.jpg" alt="">
        </div>
    </div>
    <div class="treo wow zoomIn">
        <div class="check-form">
            <div class="container mt-4 m99">
                <form action="" class="checkout-form">
                    <h2 class="fomr-checkout">Thông tin thanh toán</h2>
                    <label for="name">Họ và tên:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" id="Email" name="Email">
                    <?php
          require_once "./View/CheckOutView.php";
        ?>
                    <label for="phone-number">Số Điện Thoại:</label>
                    <input type="text" id="phone-number" name="phone-number" required>

                </form>
                <div class="d-grid mb-3">
                    <button type="button" id="btn_information" class="btn btn-primary">Mua Ngay</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('btn_information').addEventListener('click', (e) => {
        e.preventDefault();
        let provinceElement = document.getElementById('province');
        let districtElement = document.getElementById('district');
        let wardElement = document.getElementById('ward');

        if (provinceElement.selectedOptions.length === 0 || districtElement.selectedOptions
            .length === 0 || wardElement.selectedOptions.length === 0) {
            alert('Vui lòng chọn đầy đủ Tỉnh/Thành Phố, Huyện/Quận và Xã/Phường.');
            return;
        }

        let province = provinceElement.selectedOptions[0].textContent;
        let district = districtElement.selectedOptions[0].textContent;
        let ward = wardElement.selectedOptions[0].textContent;

        let name = document.getElementById('name').value;
        let email = document.getElementById('Email').value;
        let phone = document.getElementById('phone-number').value;
        let userID = <?php echo $_SESSION['userID'];?>

        let information =
            `Họ và tên: ${name} \n Email: ${email} \n Địa chỉ: ${ward} - ${district} - ${province} \n Số điện thoại: ${phone}`;
        console.log(information);

        let formData = new FormData();
        formData.append('UserID', userID);
        formData.append('Information', information);

        fetch('http://localhost:8081/MyHouseDecor/Controller/CheckOutController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Save information response:', data);
                if (data.check) {
                    window.location.href = './checkdon.php';
                } else {
                    alert('Lưu thông tin thất bại.');
                }
            });

    });
    </script>

    </html>