<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MyHouseDecor/Controller/CheckOutController.php';
$controller = new CheckOut_controller();
$result = $controller->Show_Tinh();
?>
<div class="row">
    <div class="col-md-4">
        <label for="province">Tỉnh/Thành Phố:</label>
        <input type="hidden" id="provinceName" name="provinceName">
        <select id="province" name="province" class="form-select" required>
            <option value="" disabled selected>Chọn Tỉnh/Thành Phố</option>
            <?php
                foreach($result as $item){
                    echo '<option value="'.$item['matp'].'">'.$item['name'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col-md-4">
        <label for="district">Huyện/Quận:</label>
        <input type="hidden" id="districtName" name="districtName">
        <select id="district" name="district" class="form-select" required>
            <option value="" disabled selected>Chọn Huyện/Quận</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="ward">Xã/Phường:</label>
        <input type="hidden" id="wardName" name="wardName">
        <select id="ward" name="ward" class="form-select" required>
            <option value="" disabled selected>Chọn Xã/Phường</option>
        </select>
    </div>
</div>
<script>
// document.getElementById('province').addEventListener('change', function() {
//     const provinceId = this.value;
//     const provinceName = this.selectedOptions[0].textContent;
//     console.log('Selected Province ID:', provinceId);
//     console.log('Selected Province Name:', provinceName);
//     console.log('Selected Province ID:', provinceId);
//     const formData = new FormData();
//     formData.append('provinceId', provinceId);

//     fetch('./Controller/CheckOutController.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log('District data:', data);
//             const district = document.getElementById('district');
//             district.innerHTML = '<option value="" disabled selected>Chọn Huyện/Quận</option>';
//             if (Array.isArray(data)) {
//                 data.forEach(item => {
//                     district.innerHTML += `<option value="${item.maqh}">${item.name}</option>`;
//                 });
//             } else {
//                 console.error('Expected an array but got:', data);
//             }
//         })
//         .catch(error => console.error('Error:', error));
// });
$(document).ready(function() {
    $("#province").change(function(e) {
        e.preventDefault();
        let provinceId = $(this).val();
        let provinceName = $(this).text();
        let data = {
            provinceId: provinceId
        }
        $.ajax({
            type: "POST",
            url: "http://localhost:8081/MyHouseDecor/Controller/CheckOutController.php",
            data: "data",
            dataType: "json",
            success: function(response) {
                console.log(response.data);
            }
        });
    });
});
document.getElementById('district').addEventListener('change', function() {
    const districtId = this.value;
    console.log('Selected District ID:', districtId);
    const formData = new FormData();
    formData.append('districtId', districtId);

    fetch('./Controller/CheckOutController.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(datas => {
            console.log('Ward data:', datas);
            const ward = document.getElementById('ward');
            ward.innerHTML = '<option value="" disabled selected>Chọn Xã/Phường</option>';
            if (Array.isArray(datas)) {
                datas.forEach(item => {
                    ward.innerHTML += `<option value="${item.xaid}">${item.name}</option>`;
                });
            } else {
                console.error('Expected an array but got:', datas);
            }
        })
        .catch(error => console.error('Error:', error));
});
</script>