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
                    <form id="propertyForm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                         
                           
                          <div class="row mt-4">
                             <!-- name -->
                            <div class="col-lg-6">
                            <label for="title" class="labelclass">Name</label>
                            <input type="text" class="form-control greybg" name="name" placeholder="" />
                            </div>
                        </div>
                            <!-- name -->

                           


                          <div class="row mt-4">
                            <!-- Email -->
                            <div class="col-lg-6">
                            <label for="address" class="labelclass">Email</label>
                            <input type="text" class="form-control greybg" name="address" placeholder="">
                            </div>  
                              <!-- Email -->                       
                          </div>
                         
                        

                          

                         <div class="row mt-4">
                             <!-- Password-->
                            <div class="col-lg-6">
                                <label for="price" class="labelclass">Password</label>
                                <input type="text" class="form-control greybg" name="price" placeholder="">
                            </div>
                            <!--Password----->
                        </div>

                          </div>
                        </div>
                        <div class="card-action text-end">
                            <button class="btn btn-blue"><i class="fa fa-plus color-info me-2"></i>Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery if not already included -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<!-- Include CKEditor 5 -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script> -->


<!-- tiny mce editor -->
<!-- <script src="https://dds.doodlodesign.com/assets/vendor/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea'
});
</script> -->
<!-- tiny mce editor -->




<!-- update profile -->
<script>
    $(document).ready(function() {
        $('#propertyForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '<?php echo base_url('property/add_property') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {

                                 // Clear the form fields
                            $('#propertyForm')[0].reset();
                                //redirect  the page
                                window.location.href = 'http://localhost/mediresaledash/view_all_property';
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
