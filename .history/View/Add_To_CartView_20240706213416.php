<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/MyHouseDecor/Controller/Add_To_CartController.php';
    $controller = new Cart_Controller();
    $UserID = $_SESSION['userID'];
    $result = $controller->Show_CartController($UserID);
    foreach($result as $item):
?>
<div class="cart-item wow fadeInUp">
    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo $item['Image'];?>" alt="" class="w-100">
        </div>
        <div class="col-md-9">
            <h3><?php echo $item['Title'];?></h3>
            <input type="hidden" class='detailID' value="<?php echo $item['IDDetail'];?>">
            <div class="giatienitem d-flex">
                <p>Giá tiền :
                <p class="giatien"><?php echo number_format($item['Price'], 0, ",", ".") ;?> VND</p>
                </p>
            </div>
            <div class="sll d-flex">
                <p>Số lượng :</p>
                <button class="btn btn-outline-primary decrement" data-id-product="<?php echo $item['ProductID'] ?>"
                    data-price="<?php echo $item['Price'];?>">-</button>
                <input type="text" value="<?php echo isset($item['Quantity']) ? $item['Quantity'] : 1;?>" min='1'
                    class="quantity">
                <button class="btn btn-outline-primary increment" data-id-product="<?php echo $item['ProductID'] ?>"
                    data-price="<?php echo $item['Price'];?>">+</button>
            </div>

        </div>
        <div class="col-md-1 d-flex align-items-center justify-content-center">
            <input type="hidden" id='check_status' value="<?php echo isset($item['status']) ? $item['status'] : '';?>">
            <button class="btn btn-danger tam-an" data-delete-product="<?php echo $item['ProductID'];?>">Xóa Sản
                Phẩm</button>
        </div>
    </div>
</div>
<br>
<?php endforeach;?>
<div class="d-grid">
    <button class="btn btn-success" id='update_cart'>Cập nhật Đơn Hàng</button>
</div>
<script>
// document.querySelectorAll('.tam-an').forEach(btn => {
//     btn.addEventListener('click', (e) => {
//         e.preventDefault();
//         let ProductID = btn.getAttribute('data-delete-product');
//         console.log(ProductID);

//         swal.fire({
//             title: 'Bạn có chắc chắn muốn xóa sản phẩm này không?',
//             icon: 'warning',
//             text: 'Sau khi xóa bạn không thể khôi phục lại sản phẩm này',
//             showCancelButton: true,
//             confirmButtonText: `Xóa`,
//             cancelButtonText: `Hủy`,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 let check_status = document.getElementById('check_status').value;
//                 if (check_status == 2 || check_status == 4 || check_status == 5) {
//                     swal.fire({
//                         title: 'Bạn không thể xóa sản phẩm này',
//                         icon: 'error',
//                         text: 'Sản phẩm này đã được thanh toán hoặc đang được vận chuyển '
//                     });
//                 } else {
//                     let forms = new FormData();
//                     forms.append('ProductID', ProductID);

//                     let xhr = new XMLHttpRequest();
//                     xhr.open('POST',
//                         'http://localhost:8081/MyHouseDecor/Controller/Delete_TmpOrder.php',
//                         true);
//                     xhr.onload = () => {
//                         if (xhr.readyState === XMLHttpRequest.DONE) {
//                             if (xhr.status === 200) {
//                                 let response = JSON.parse(xhr.responseText);
//                                 if (response.check) {
//                                     swal.fire({
//                                         title: 'Xóa sản phẩm thành công',
//                                         text: 'Sản phẩm đã được xóa khỏi giỏ hàng',
//                                         icon: 'success'
//                                     }).then(() => {
//                                         location.reload();
//                                     });
//                                 } else {
//                                     swal.fire({
//                                         title: 'Xóa sản phẩm thất bại',
//                                         text: 'Có lỗi xảy ra trong quá trình xóa sản phẩm',
//                                         icon: 'error'
//                                     });
//                                 }
//                             }
//                         }
//                     }
//                     xhr.send(forms);
//                 }
//             }
//         })


//     });
// });

document.getElementById('update_cart').addEventListener('click', (e) => {
    e.preventDefault();

    let FormData = [];

    document.querySelectorAll('.cart-item').forEach(item => {
        let ProductID = item.querySelector('.tam-an').getAttribute('data-delet-product');
        let quantity = item.querySelector('.quantity').value;
        let UserName = '<?php echo $_SESSION['userName'];?>';
        let priceText = item.querySelector('.giatien').textContent;
        let price = parseFloat(priceText.replace(' VND', '').replace(/,/g, ''));
        let totalPrice = price * quantity;
        let IDDetail = item.querySelector('.detailID').value;

        FormData.push({
            ProductID: ProductID,
            Quantity: quantity,
            UserName: UserName,
            Total_Price: totalPrice,
            IDDetail: IDDetail
        });
    });
    console.log(FormData);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost:8081/MyHouseDecor/Controller/Add_To_CartController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if (response.check) {
                    swal.fire({
                        title: 'Cập nhật đơn hàng thành công',
                        text: 'Đơn hàng của bạn đã được cập nhật',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Cập nhật đơn hàng thất bại',
                        text: 'Có lỗi xảy ra trong quá trình cập nhật đơn hàng',
                        icon: 'error'
                    });
                }
            }
        }
    }
    xhr.send(JSON.stringify({
        FormData: FormData
    }));
});


document.addEventListener('DOMContentLoaded', (event) => {
    function decrement(element) {
        const quantityInput = element.parentElement.querySelector('.quantity');
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    }

    function increment(element) {
        const quantityInput = element.parentElement.querySelector('.quantity');
        let value = parseInt(quantityInput.value);
        quantityInput.value = value + 1;
    }
    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', (e) => {
            decrement(e.target);
        });
    });
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', (e) => {
            increment(e.target);
        });
    });
});

$(document).ready(function() {
    $(".decrement").click(function(e) {
        e.preventDefault();
        let quantity = $(this).next("input.quantity").val()
        let product_id = $(this).attr("data-id-product");
        let price = $(this).attr("data-price");
        let data = {
            quantity: quantity,
            price: price,
            product_id: product_id
        }
        $.ajax({
            type: "POST",
            url: "http://localhost:8081/MyHouseDecor/Controller/Update_Cart_Controller.php",
            data: data,
            dataType: "text",
            success: function(response) {
                $("p.resultMoney").text(response);
                $("p#total-money").text(response);
            }
        });

    });
    $(".increment").click(function(e) {
        e.preventDefault();
        let product_id = $(this).attr("data-id-product");
        let quantity = $(this).prev("input.quantity").val();
        let price = $(this).attr("data-price");
        let data = {
            quantity: quantity,
            price: price,
            product_id: product_id
        }
        $.ajax({
            type: "POST",
            url: "http://localhost:8081/MyHouseDecor/Controller/Update_Cart_Controller.php",
            data: data,
            dataType: "text",
            success: function(response) {
                $("p.resultMoney").text(response);
                $("p#total-money").text(response);
            }
        });

    });
    $(".tam-an").click(function(e) {
        e.preventDefault();
        let ProductID = $(this).attr("data-delete-product");
        let status = $(this).prev("input#check_status").val();
        alert('ProductID: ' + ProductID + "\nstatus: " + status);
    });
});
</script>