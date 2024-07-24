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
        .imgblock {
            padding: 0;
            margin: 0;
        }

        .formblock {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            width: 100%;
        }

        .loginheading {
            font-size: 30px;
            font-weight: 700;
            color: #000;
        }

        .formclass {
         
            background-color:#f5f5f5 !important;
            color: #7D7D7D !important;
            border: 1px solid #56C6DD !important;
            height: 50px !important;
            border-radius: 12px;
            width: 400px;
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

.grey-text
{
  color: #7D7D7D;
}

        /* Responsive Design */
        @media (max-width: 992px) {
            .col-lg-7 {
                display: none;
            }
            .col-lg-5 {
                height: auto;
                padding: 20px;
            }
            .imgblock img {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .loginheading {
                font-size: 24px;
            }
            .mb-5 {
                margin-bottom: 1.5rem !important;
            }
        }

        @media (max-width: 576px) {
            .loginheading {
                font-size: 20px;
            }
            .mb-5 {
                margin-bottom: 1rem !important;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 imgblock">
            <img src="<?= base_url('assets/img/loginimg.png'); ?>" class="img-fluid">
        </div>
        <div class="col-lg-5 d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
            <img src="<?= base_url('assets/img/logo.png'); ?>" width="320" class="mb-4">
            <h1 class="mb-4 loginheading">LOG IN</h1>
             <!-- flash message code -->
             <?php if (session()->has('msg')): ?>
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->get('msg') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>
            <!-- flash message code end-->
            <form action="<?php echo base_url('/login/check') ?>" method="POST">
                <div class="mb-5">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control formclass" id="" required>
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password"  class="form-control formclass" id="" required>
                </div>
                <div class="mb-5 text-end">
                <a href="<?php echo base_url('/forgot_password') ?>" class="grey-text">Forgot Password?</a>
                </div>
              

                <div class="mb-5 text-center">
                <button type="submit" class="btn btn-blue">Submit</button>
                </div>
               
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Kaiadmin JS -->
<script src="<?= base_url('assets/js/kaiadmin.min.js'); ?>"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
