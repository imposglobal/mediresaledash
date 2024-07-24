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

.forgotblock
{
    background-color: #ebebeb;
    padding: 40px 10px;
    border-radius: 20px;
}

.pr-60
{
    padding-right:260px !important;
}

 </style>
 

</head>
<body>

<div class="container-fluid">
    <div class="row d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-4 mx-auto text-center">
        <img src="<?= base_url('assets/img/logo.png'); ?>" width="320" class="mb-4">
        </div>
        <div class="col-lg-4 mx-auto text-center forgotblock">
            
            <h1 class="mb-5 loginheading">Forgot Password</h1>
            <!-- flash message code -->
            <?php if (session()->has('msg')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('msg') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>
            <!-- flash message code end-->
            <form action="<?php echo base_url('/send_email') ?>" method="POST">
               
                <div class="mb-5  d-flex flex-column justify-content-center align-items-center">
                    <label for="email" class="form-label pr-60"><strong>Enter Your Email ID</strong></label>
                    <input type="email" name="email" class="form-control formclass"  placeholder="e.g. dansmith@gmail.com" required>
                </div>
               
              

                <div class="text-center">
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
