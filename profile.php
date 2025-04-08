<?php 
    session_start();
    require_once './Controller/auth.php';
    require_once './Include/header.php';
  ?>
<style>
   
    .col-md-4 img{
        border-radius: 50%;
        width: 300px;
        height: 300px;   
        object-fit: cover;
        border: solid 3px #00EE00;
        margin:auto;
    }
    .btn-them{
        margin-left: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }
  .form_profile{
    box-shadow:0 0 80px rgba(49, 48, 48, 0.1);
    border-radius: 0 10px 10px 0;
  }
  @media (max-width: 768px) {
    h1,h2,h3,h5,h4,h6 {
      font-size: 1.5rem; /* Giảm kích thước tiêu đề */
    }

    p {
      font-size: 1rem; /* Giảm kích thước đoạn văn */
    }

     button {
      font-size: 0.9rem; /* Giảm kích thước nút */
    }
  }

  @media (max-width: 576px) {
    h1,h2,h3,h5,h4,h6 {
      font-size: 1.2rem; /* Giảm thêm kích thước tiêu đề */
    }

    p {
      font-size: 0.8rem; /* Giảm thêm kích thước đoạn văn */
    }

    button {
      font-size: 0.7rem; /* Giảm thêm kích thước nút */
    }
  }

</style>
<body>

    <div class="container mt-5 ">
        <?php require_once './View/Profile_View.php';?>
        
        <script>
            document.getElementById('view').addEventListener('click', function() {
                var input = document.getElementById('Password');
                var eyeIcon = document.getElementById('view');
        
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        </script>
        </div>
        <?php 
    require_once './Include/footer.php';
    ?>

</html>  