// doi mau menu khi scroll
window.addEventListener('scroll',function(){
    let start = this.document.querySelector('.start');
    if(window.scrollY > 100){
        start.classList.add('active');
    } else{
        start.classList.remove('active');
    }
});

window.addEventListener('scroll', function(){
    let m = document.querySelector('.menu');
    if (m) {
        if(window.scrollY > 100){
            m.classList.add('atv');
        }
        else{
            m.classList.remove('atv');
        }
    }
});
// let xacnhanhuy = document.querySelector('#huydonhang');
// xacnhanhuy.addEventListener('click', function() {
//     Swal.fire({
//         title: 'Bạn có chắc chắn hủy đơn?',
//         text: 'Sau khi hủy đơn, mọi thông tin đơn hàng này vẫn được lưu trữ trên giỏ hàng của bạn!',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Vâng, hủy đơn hàng!',
//         cancelButtonText: 'Không, giữ lại!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             let xoa = document.querySelectorAll('.onok');
//             xoa.forEach(function(element) {
//                 element.classList.add('an-form');
//             });
        
//             let them = document.querySelectorAll('.onnotok');
//             them.forEach(function(element) {
//                 element.classList.remove('an-form');
//             });
//             Swal.fire(
//                 'Đã hủy!',
//                 'Đơn hàng của bạn đã được hủy.',
//                 'success'
//             );
//         } else {
//             Swal.fire(
//                 'Đã giữ lại!',
//                 'Đơn hàng của bạn vẫn được lưu trữ.',
//                 'success'
//             );
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function() {

    let thaydoidiachi = document.getElementById('thaydoidiachi');
    let form = document.querySelector('.form');
    let nhanthongtin = document.getElementById('nhanthongtin');
    thaydoidiachi.addEventListener('click', function() {

        form.classList.toggle('d-none');
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của form

        let m1 = document.getElementById('recipient-name').value;
        let m2 = document.getElementById('recipient-phone').value;
        let m3 = document.getElementById('recipient-address').value;
        let nhanthongtin = document.getElementById('nhanthongtin');
                if (!nhanthongtin ||m1 == "" || m2 == "" || m3 == "") {
                    Swal.fire(
                        'Thất bại!',
                        'Vui lòng nhập đủ thông tin!',
                        'error'
                    );
                } else {
                    nhanthongtin.innerHTML = "Tên người nhận: " + m1 + "<br>" + "Số điện thoại: " + m2 + "<br>" + "Địa chỉ: " + m3; 
                    Swal.fire(
                        'Thành công!',
                        'Đã cập nhật thông tin giao hàng.',
                        'success'
                    );
                }
        form.classList.add('d-none');
    });
});

    function getthanhcong(){
        Swal.fire(
            'Thành công!',
            'Cảm ơn bạn đã tin tưởng mua hàng!',
            'success'
          );
     }
document.getElementById('xacminhok').addEventListener('click', getthanhcong);

// function getthanhcong(){
//     Swal.fire(
//         'Thành công!',
//         'Chúc mừng bạn đã đăng nhập thành công!',
//         'success'
//       );
//  }
//  function gettbai(){
//     Swal.fire(
//         'Thất bại!',
//         'Vui lòng kiểm tra lại thông tin đăng nhập!',
//         'error'
//       );
//  }
//  function getemail(){
//     Swal.fire(
//         'Thành công!',
//         'Vui lòng kiểm tra email để xác minh!',
//         'success'
//       );
//  }
// let tb = document.getElementById('xacminhok');
// tb.addEventListener('click', getthanhcong());