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

.tox .tox-edit-area__iframe {
    background-color: #f5f5f5 !important;
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
                    <a href="">Update Property</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8"> <h3 class="fw-bold mt-4">Property</h3></div>
                <div class="col-lg-4 text-end">
                <button class="btn btn-blue mt-4" id="update_property"><i class="fa fa-plus color-info me-2"></i>Update Property</button>
                </div>
            </div>

           
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update Property</div>
                    </div>
                    <?php if ($editproperty): ?>
                    <form id="PropertyUpdateForm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                           
                             
                          <div class="col-sm-12">
                                    <div class="row">
                                        <?php
                                        $images = explode(',', $editproperty->property_image);
                                        ?>

                                           <?php foreach ($images as $index => $propertyimage): ?>
                                            <div class="col-lg-3 col-4">
                                              
                                                <img class="d-block w-100" src="<?=  $propertyimage ?>">
                                                <a onclick="deleteImage('<?= $propertyimage;?>', <?= $index; ?>)"><i class="fa fa-trash text-danger"></i></a>
                                                
                                            </div>
                                            <?php endforeach; ?>
                                    </div>
                                </div>
                           
                            <!-- image -->
                            <div class="col-lg-6 inputmargintop">
                            <label for="image" class="labelclass">Image</label>
                            <input type="file" accept="image/*,.pdf" class="form-control greybg" name="property_image[]" id="property_image" multiple />
                            </div>
                             <!-- image -->
                             <!-- title -->
                            <div class="col-lg-6 inputmargintop">
                            <label for="title" class="labelclass">Title</label>
                            <input type="text" class="form-control greybg" name="name" value="<?= htmlspecialchars($editproperty->name); ?>" />
                            </div>
                            <!-- title -->

                            <!-- preview -->
                            <div id="imagePreview" class="row"></div>
                              <!-- preview -->
                          </div>

                          
                          <div class="row inputmargintop">
                            <!--property_type-->
                            <div class="col-lg-6">
                            <label for="parking" class="labelclass">Property type</label>
                            <select name="property_type" class="form-control greybg">
                            <option  value="<?= htmlspecialchars($editproperty->property_type); ?>"><?= htmlspecialchars($editproperty->property_type); ?></option>
                            <option value="Hospital">Hospital</option>
                            <option value="Clinics">Clinics</option>
                            <option value="Diagnostic Centers">Diagnostic Centers </option Centers>
                            <option value="Nursing Homes">Nursing Homes </option Centers>

                        </select>
                          
                            </div>
                            
                             <!-- transaction_type-->
                            <div class="col-lg-6 res_mt">
                            <label for="price" class="labelclass">Transaction Type</label>
                            <select name="transaction_type" class="form-control greybg">
                            <option  value="<?= htmlspecialchars($editproperty->transaction_type); ?>"><?= htmlspecialchars($editproperty->transaction_type); ?></option>
                            <option value="Rent">Rent</option>
                            <option value="Buy">Buy</option>

                        </select>                            
                        </div>

                            <!-- price-->
                            <div class="row inputmargintop">
                                <div class="col-lg-4 res_mt">
                                    <label for="price" class="labelclass">Price</label>
                                    <input type="text" class="form-control greybg" name="price" value="<?= htmlspecialchars($editproperty->price); ?>" placeholder="Price">
                                </div>

                            <!--Built Year-->
                                <div class="col-lg-4 res_mt">
                                    <label for="Built-year" class="labelclass">Built Year</label>
                                    <input type="text" class="form-control greybg" name="built_year" value="<?= htmlspecialchars($editproperty->built_year); ?>" placeholder="Built Year">
                                </div>
                            <!--Built Year -->
                            <div class="col-lg-4 res_mt">
                                    <label for="Built-year" class="labelclass">Possesion</label>
                                    <select name="possession" class="form-control greybg">
                                        <option  value="<?= htmlspecialchars($editproperty->possession); ?>"><?= htmlspecialchars($editproperty->possession); ?></option>
                                        <option value="Ready to move">Ready to move</option>
                                        <option value="In One Year">In One Year</option>
                                        <option value="In 2 year">In 2 year</option>
                                        <option value="In 3 year">In 3 year</option>
                                    </select> 
                                </div>
                           </div>
                            <!--Possesion----->

                          <div class="row inputmargintop">
                            <!-- address -->
                            <div class="col-lg-12">
                            <label for="address" class="labelclass">Adderess</label>
                            <input type="text"  class="form-control greybg" name="address" value="<?= htmlspecialchars($editproperty->address); ?>" rows="4" cols="50"></input>
                            </div>  
                              <!-- adderess -->                       
                          </div>


                          <div class="row inputmargintop">
                            <!--state  -->
                            <div class="col-lg-6">
                            <label for="state" class="labelclass">Select State</label>
                            <input list="statedata" name="state" id="state" class="form-control greybg" value="<?= htmlspecialchars($editproperty->state); ?>">
                            <datalist id="statedata">
                            <?php foreach ($states as $state): ?>
                            <option value="<?php echo $state['name']; ?>"><?php echo $state['name']; ?></option>
                            <?php endforeach; ?>
                            </datalist>                        
                            </div>
                             <!-- state -->
                             <!-- city-->
                             <div class="col-lg-6 res_mt">
                            <label for="city" class="labelclass">Select City</label>
                            <input list="citydata" name="city" id="city" class="form-control greybg" value="<?= htmlspecialchars($editproperty->city); ?>">
                            <datalist id="citydata">
                            <?php foreach ($cities as $city): ?>
                            <option value="<?php echo $city['city']; ?>"><?php echo $city['city']; ?></option>
                            <?php endforeach; ?>
                            </datalist>
                            </div>
                            <!-- city-->
                          </div>
                        
                          <div class="row inputmargintop">
                            <!--zipcode-->
                            <div class="col-lg-4">
                            <label for="zipcode" class="labelclass">Zip Code</label>
                            <input type="text" class="form-control greybg" name="zipcode" value="<?= htmlspecialchars($editproperty->built_year); ?>" placeholder="Zip Code">
                            </div>
                             <!-- zipcode-->
                             <!-- total area-->
                            <div class="col-lg-4 res_mt">
                            <label for="area" class="labelclass">Total Area</label>
                            <input type="text" class="form-control greybg" name="total_area"  value="<?= htmlspecialchars($editproperty->total_area); ?>" placeholder="Total Area">
                            </div>
                            <!--total area -->

                              
                            <!--parking-->
                            <div class="col-lg-4">
                                <label for="parking" class="labelclass">Parking</label>
                                <select name="parking" class="form-control greybg">
                                <option  value="<?= htmlspecialchars($editproperty->parking); ?>"><?= htmlspecialchars($editproperty->parking); ?></option>
                                <option value="Available">Available</option>
                                <option value="Not Available">Not Available</option>
                                </select>
                            </div>
                           
                          </div>


                          <div class="row inputmargintop">
                            <!--pharmacy-->
                            <div class="col-lg-4">
                            <label for="zipcode" class="labelclass">On Site Pharmacy</label>
                            <select name="pharmacy" class="form-control greybg">
                                <option  value="<?= htmlspecialchars($editproperty->pharmacy); ?>"><?= htmlspecialchars($editproperty->pharmacy); ?></option>
                                <option value="Available">Available</option>
                                <option value="Not Available">Not Available</option>
                                </select>
                        </div>
                             <!-- pharmacy-->
                             <!-- laboratory -->
                            <div class="col-lg-4 res_mt">
                            <label for="area" class="labelclass">Laboratory</label>
                            <select name="laboratory" class="form-control greybg">
                                <option  value="<?= htmlspecialchars($editproperty->laboratory); ?>"><?= htmlspecialchars($editproperty->laboratory); ?></option>
                                <option value="Available">Available</option>
                                <option value="Not Available">Not Available</option>
                                </select>
                        </div>
                            <!-- laboratory -->

                              
                            <!--cafeteria-->
                            <div class="col-lg-4">
                                <label for="parking" class="labelclass">Cafeteria</label>
                                <select name="cafeteria" class="form-control greybg">
                                <option  value="<?= htmlspecialchars($editproperty->cafeteria); ?>"><?= htmlspecialchars($editproperty->cafeteria); ?></option>
                                <option value="Available">Available</option>
                                <option value="Not Available">Not Available</option>
                                </select>
                            </div>
                           
                          </div>

<<<<<<< HEAD



                          

                             
=======
                             <!-- parking-->
>>>>>>> origin/krushna
                             
                             <!-- TinyMCE Editor -->
                             <div class="col-lg-12 inputmargintop">
                             <label for="description" class="labelclass">Description</label>
                             <textarea id="description"  name="description"  class="tinymce-editor"><?= htmlspecialchars($editproperty->description); ?></textarea>
                            </div>
                            <!-- End TinyMCE Editor -->

                          </div>

                        </div>
                        <input type="hidden" class="form-control" name="id" value="<?= htmlspecialchars($editproperty->id); ?>">
                        <!-- <div class="card-action text-center">
                            <button class="btn btn-blue addbtnres" id="update_property"><i class="fa fa-plus color-info me-2"></i>Update Property</button>
                        </div> -->
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
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script> -->

<!-- Initialize CKEditor 5 -->
<!-- <script>
  $(document).ready(function() {
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  });
</script> -->

<!-- tiny mce editor -->
<script src="https://dds.doodlodesign.com/assets/vendor/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea'
});
</script>
<!-- tiny mce editor -->


<script>
    $(document).ready(function() {
        $('#update_property').on('click', function(e) {
            e.preventDefault();
            
            // var formData = new FormData(this);

             // Update TinyMCE editor content
             tinymce.triggerSave();

            // Collect form data
            var form = $('#PropertyUpdateForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: '<?php echo base_url('property/edit_property/' . $editproperty->id); ?>',
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

<!-- update property -->


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
                    url: '<?= base_url('property/delete_property_image') ?>',
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
