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
           
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="<?php echo base_url('dashboard')?>">
                       Home
                    </a>
                </li>
                <span class="fs18">|</span>
                <li class="nav-item">
                    <a href="<?php echo base_url('dashboard')?>">Dashboard</a>
                </li>
                <span class="fs18">|</span>
                <li class="nav-item">
                    <a href="#">Update Equipment</a>
                </li>
            </ul>
            <h3 class="fw-bold mt-4">Equipment</h3>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update Equipment</div>
                    </div>
                    <?php if ($editequipments): ?>
                    <form id="updateequipmentForm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                           
                             
                          <div class="col-sm-12">
                                    <div class="row">
                                        <?php
                                        $images = explode(',', $editequipments->equipment_image);
                                        ?>

                                        <?php foreach ($images as $index => $equipmentimage): ?>
                                            <div class="col-lg-3">
                                              
                                                <img class="d-block w-100" src="<?= base_url('/assets/uploads/equipments/' . $equipmentimage) ?>">
                                             <a onclick="deleteImage('<?= $equipmentimage; ?>', <?= $index; ?>)"><i class="fa fa-trash text-danger"></i></a>
                                                
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                           
                            <!-- image -->
                            <div class="col-lg-6 mt-4">
                            <label for="image" class="labelclass">Image</label>
                            <input type="file" accept="image/*,.pdf" class="form-control greybg" name="equipment_image[]" id="equipment_image" multiple />
                            </div>
                             <!-- image -->
                             <!-- title -->
                            <div class="col-lg-6 mt-4">
                            <label for="title" class="labelclass">Title</label>
                            <input type="text" class="form-control greybg" name="title" value="<?= htmlspecialchars($editequipments->title);?>" />
                            </div>
                            <!-- title -->

                            <!-- preview -->
                            <div id="imagePreview" class="row"></div>
                              <!-- preview -->
                          </div>

                          <div class="row mt-5">
                            <!--Serial Number  -->
                            <div class="col-lg-4">
                            <label for="serial_number" class="labelclass">Serial Number</label>
                            <input type="text" class="form-control greybg" name="serial_number" value="<?= htmlspecialchars($editequipments->serial_number); ?>" />
                            </div>
                             <!-- Serial Number -->
                             <!-- manifacture year -->
                            <div class="col-lg-4">
                            <label for="manifacture_year" class="labelclass">Manufacture Year</label>
                            <input type="text" class="form-control greybg" name="manifacture_year" value="<?= htmlspecialchars($editequipments->manifacture_year); ?>"/>
                            </div>
                            <!-- manifacture year -->

                              <!-- Price-->
                            <div class="col-lg-4">
                            <label for="price" class="labelclass">Price</label>
                            <input type="text" class="form-control greybg" name="price" value="<?= htmlspecialchars($editequipments->price); ?>"/>
                            </div>
                            <!--Price -->

                             <!-- Description-->
                             <div class="col-lg-12 mt-5">
                             <label for="description" class="labelclass">Description</label>
                             <textarea id="editor" name="description" class="greybg"><?= htmlspecialchars($editequipments->description); ?></textarea>
                            </div>
                            <!--Description-->
                          </div>
                        </div>
                        <input type="hidden" class="form-control" name="id" value="<?= htmlspecialchars($editequipments->id); ?>">
                        <div class="card-action text-end">
                            <button class="btn btn-blue"><i class="fa fa-plus color-info me-2"></i>Add Equipment</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery if not already included -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Include CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

<!-- Initialize CKEditor 5 -->
<script>
  $(document).ready(function() {
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  });
</script>

<!-- Form Submission Handling -->
<script>
    $(document).ready(function() {
        $('#updateequipmentForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);

            $.ajax({
                url: '<?php echo base_url('equipments/edit_equipments/' . $editequipments->id); ?>',
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
                                window.location.href = 'http://localhost/mediresale/view_all_equipments';
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
                    console.error(xhr.responseText);
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


<script>
    function deleteImage(imageName, index) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('equipments/delete_equipment_image') ?>',
                    type: 'POST',
                    data: { image_name: imageName },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Your image has been deleted.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the image. Please try again.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Error occurred while deleting the image.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
