<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mediresale</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/img/logo-small.png'); ?>" type="image/x-icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/plugins.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kaiadmin.min.css'); ?>">


    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* login page css */
.imgblock {
    padding: 0;
    margin: 0;
}
.inputclass
{
    background-color:#f5f5f5 !important;
    color: #7D7D7D !important;
    border: 1px solid #56C6DD !important;
    height: 50px !important;
    border-radius: 12px;
    width:400px;
   
}

.btn-blue {
    color: #fff;
    background-color: #56C6DD;
    font-size:18px;
    padding: 10px 40px;
    border-radius:12px;
}

.btn-blue:hover
{
    border:2px solid  #56C6DD;
    color: #56C6DD;

}

.loginheading {
            font-size: 30px;
            font-weight: 700;
            color: #000;
            text-align:center;
            padding-top:50px;
        }

        .logoimg
        {
            width: 300px;
        }


@media only screen and (max-width: 600px) {
    .inputclass
    {
        width: 300px;
  }

  .logoimg
        {
            width: 180px;
            padding-top:70px;
        }

        .loginheading 
        {
            padding:0px;
            font-size: 20px;

        }
}
    </style>
</head>
<body>

<div class="container-fluid">
        <div class="row full-height">
            <div class="col-lg-7 imgblock">
                <img src="<?= base_url('assets/img/loginimg.png'); ?>" class="img-fluid" alt="Login Image">
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center align-items-center">
           <div>
           <img src="<?= base_url('assets/img/logo.png'); ?>" class="mb-4 logoimg">
           <h1 class="mb-4 loginheading">LOG IN</h1>
           </div>
           
            <?php if (session()->has('msg')): ?>
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->get('msg') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo base_url('/login/check') ?>" method="POST">
                <div class="mb-5">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control inputclass" id="" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password"  class="form-control inputclass" id="" required>
                </div>
                <div class="mb-5 text-end">
                <a href="<?php echo base_url('/forgot_password') ?>" class="text-danger">Forgot Password?</a>
                </div>
                <div class="mb-5 text-center">
                <button type="submit" class="btn btn-blue">Submit</button>
                </div>
               
            </form>
            </div>
        </div>
    </div>

<script src="<?= base_url('assets/js/core/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/core/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>

<!-- Kaiadmin JS -->
<script src="<?= base_url('assets/js/kaiadmin.min.js'); ?>"></script>

<!-- SweetAlert2 JS -->

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
</body>
</html>
