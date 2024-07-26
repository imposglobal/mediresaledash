<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<style>
    .greybg
{
    background-color: #f5f5f5 !important;
    border:none;
    height: 50px !important;
    border-radius: 12px;
}

.labelclass
{
    color:#000 !important;
    font-size:16px !important;
    margin-bottom:10px !important;
}

</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold">Update Profile</h3>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Update Profile</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update Profile</div>
                    </div>
                    <form id="profileForm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                         
                        <?php if (!empty($success)): ?>
                            <p style="color: green;"><?= esc($success) ?></p>
                        <?php endif; ?>   

                            <div class="row mt-4">
                                <!-- name -->
                                <div class="col-lg-6">
                                    <label for="name" class="labelclass">First Name</label>
                                    <input type="text" class="form-control greybg" name="name" value="<?= esc($user['name']) ?>" placeholder="" />
                                </div>
                                <!-- lname -->
                                <div class="col-lg-6">
                                    <label for="lname" class="labelclass">Last Name</label>
                                    <input type="text" class="form-control greybg" name="lname" value="<?= esc($user['lname']) ?>" placeholder="" />
                                </div>
                            </div>
                            

                            <div class="row mt-4">
                                 <!-- email -->
                                <div class="col-lg-6">
                                    <label for="email" class="labelclass">Email</label>
                                    <input type="text" class="form-control greybg" name="email" value="<?= esc($user['email']) ?>" placeholder="">
                                 </div> 
                                 <!-- Password-->
                                <div class="col-lg-6">
                                    <label for="password" class="labelclass">Password</label>
                                    <input type="text" class="form-control greybg" name="password" value="<?= esc($user['password']) ?>" placeholder="">
                                 </div>
                                <!--Password----->
                            </div>
                          </div>
                        </div>
                        <div class="card-action text-end">
                        <input type="hidden"  name="id" id="id" class="form-control" value="<?= esc($user['id']) ?>">  

                            <button  class="btn btn-blue"><i class="fa fa-plus color-info me-2"></i>Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery if not already included -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- update profile -->
<script>
    $(document).ready(function() {
        $('#profileForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?php echo base_url('/update_profile') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response)
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {

                                 // Clear the form fields
                            $('#profileForm')[0].reset();
                                //redirect  the page
                                window.location.href = 'http://localhost/mediresaledash/profile';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred: ' + xhr.responseText,
                    });
                }
            });
        });
    });
</script>




<?= $this->endSection() ?>
