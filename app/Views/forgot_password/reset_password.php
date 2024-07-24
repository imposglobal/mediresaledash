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

 </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
       
        <div class="col-lg-8 mx-auto d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
            <img src="<?= base_url('assets/img/logo.png'); ?>" width="320" class="mb-4">
            <h1 class="mb-4 loginheading">Reset Password</h1>
           <!-- flash message code -->
           <?php if (session()->has('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->get('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php endif; ?>
            <!-- flash message code end-->
            <form id="updatePasswordForm" action="<?php echo base_url('/update_password') ?>" method="POST">
                <div class="mb-5">
                    <label for="password" class="form-label"><strong>Enter new Password</strong></label>
                    <input type="password" name="new_password" class="form-control formclass" id="" required>
                </div>

                <div class="mb-5">
                    <label for="password" class="form-label"><strong>Confirm Password</strong></label>
                    <input type="password" name="confirm_password" class="form-control formclass" id="" required>
                </div>
               
                <div class="mb-5 text-center">
                <input type="hidden"  name="id" id="id" class="form-control" value="<?php echo $id;?>">  
                <button type="submit" class="btn btn-blue">Submit</button>
                </div>
               
            </form>
        </div>
    </div>


    <!-- Bootstrap Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalMessage">
                    <!-- Message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modalOkButton">OK</button>
                </div>
            </div>
        </div>
    </div>
    </div>




<script src="<?= base_url('assets/js/core/jquery-3.7.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/core/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>

<!-- Kaiadmin JS -->
<script src="<?= base_url('assets/js/kaiadmin.min.js'); ?>"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
        $(document).ready(function() {
            $('#updatePasswordForm').on('submit', function(event) {
                event.preventDefault(); 

                $.ajax({
                    url: '<?php echo base_url('update_password') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        //console.log('AJAX Success:', response); 
                        var modalMessage = $('#modalMessage');
                        if (response.status === 'success') {
                            modalMessage.html(response.message);
                            $('#responseModal').modal('show'); 
                            $('#modalOkButton').on('click', function() {
                                setTimeout(function() {
                                    window.location.href = '<?php echo base_url('/') ?>'; // Redirect to login page after closing modal
                                }, 0);
                            });
                        } else {
                            modalMessage.html(response.message); 
                            $('#responseModal').modal('show'); 
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //console.error('AJAX Error:', textStatus, errorThrown); 
                        $('#modalMessage').html('An error occurred. Please try again.'); 
                        $('#responseModal').modal('show'); 
                    }
                });
            });
        });
    </script>
</body>
</html>
