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
                    <a href="">Add Equipment</a>
                </li>
            </ul>


            <div class="row">
                <div class="col-lg-8"> <h3 class="fw-bold mt-4">Equipment</h3></div>
                <div class="col-lg-4 text-end">
                <button class="btn btn-blue mt-4 addbtndesk" id="add_equipment"><i class="fa fa-plus color-info me-2"></i>Add Equipment</button>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Equipment</div>
                    </div>
                    <form id="equipmentForm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                            <!-- image -->
                            <div class="col-lg-6">
                            <label for="image" class="labelclass">Image</label>
                            <input type="file" accept="image/*,.pdf" class="form-control greybg" name="equipment_image[]" id="equipment_image" multiple />
                            </div>
                             <!-- image -->
                             <!-- title -->
                            <div class="col-lg-6 res_mt">
                            <label for="title" class="labelclass">Title</label>
                            <input type="text" class="form-control greybg" name="title" placeholder="Enter title" />
                            </div>
                            <!-- title -->

                            <!-- preview -->
                            <div id="imagePreview" class="row"></div>
                              <!-- preview -->
                          </div>

                          <div class="row inputmargintop">
                            <!--Serial Number  -->
                            <div class="col-lg-4">
                            <label for="serial_number" class="labelclass">Serial Number</label>
                            <input type="text" class="form-control greybg" name="serial_number" placeholder="Serial Number" />
                            </div>
                             <!-- Serial Number -->
                             <!-- manifacture year -->
                            <div class="col-lg-4 res_mt">
                            <label for="manifacture_year" class="labelclass">Manufacture Year</label>
                            <input type="text" class="form-control greybg" name="manifacture_year" placeholder="Year" />
                            </div>
                            <!-- manifacture year -->

                              <!-- Price-->
                            <div class="col-lg-4 res_mt">
                            <label for="price" class="labelclass">Price</label>
                            <input type="text" class="form-control greybg" name="price" placeholder="Price" />
                            </div>
                            <!--Price -->

                             

                              <!-- TinyMCE Editor -->
                              <div class="col-lg-12 inputmargintop">
                             <label for="description" class="labelclass">Description</label>
                             <textarea id="description"  name="description"  class="tinymce-editor">            
                            </textarea>
                            </div>
                            <!-- End TinyMCE Editor -->


                          </div>
                        </div>
                        <!-- <div class="card-action text-center">
                            <button class="btn btn-blue addbtnres" id="add_equipment"><i class="fa fa-plus color-info me-2"></i>Add Equipment</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery if not already included -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Include CKEditor 5 -->

<!-- tiny mce editor -->
<script src="https://dds.doodlodesign.com/assets/vendor/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea'
});
</script>
<!-- tiny mce editor -->



<!-- preview image -->

<script>
document.getElementById('equipment_image').addEventListener('change', function(event) {
    var input = event.target;
    var previewDiv = document.getElementById('imagePreview');
    
    // Clear the previous previews
    previewDiv.innerHTML = '';

    for (var i = 0; i < input.files.length; i++) {
        var file = input.files[i];

        if (file.type.startsWith('image/')) {
            var reader = new FileReader();

            reader.onload = (function(f) {
                return function(e) {
                    var previewContainer = document.createElement('div');
                    previewContainer.className = 'col-md-3 position-relative';

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.maxWidth = '180px';
                    img.style.margin = '10px';

                    var deleteIcon = document.createElement('span');
                    deleteIcon.className = 'position-absolute top-20 bottom-20 translate-middle badge rounded-pill bg-danger';
                    deleteIcon.style.cursor = 'pointer';
                    deleteIcon.style.right = '30px';
                    deleteIcon.style.top = '15px';
                    deleteIcon.innerHTML = '<i class="fa fa-times"></i>';

                    deleteIcon.onclick = function() {
                        previewDiv.removeChild(previewContainer);
                        // Remove the file from the input element
                        var dt = new DataTransfer();
                        for (var j = 0; j < input.files.length; j++) {
                            if (input.files[j] !== f) {
                                dt.items.add(input.files[j]);
                            }
                        }
                        input.files = dt.files;
                    };

                    previewContainer.appendChild(img);
                    previewContainer.appendChild(deleteIcon);
                    previewDiv.appendChild(previewContainer);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    }
});
</script>


<!-- ajax add equipment -->


<script>
    $(document).ready(function() {
        $('#add_equipment').on('click', function(e) {
            e.preventDefault();

            // Update TinyMCE editor content
            tinymce.triggerSave();

            // Collect form data
            var form = $('#equipmentForm')[0];
            var formData = new FormData(form);

            // Check if all required fields are filled
            var allFieldsFilled = true;
            formData.forEach(function(value, key) {
                if (!value) {
                    allFieldsFilled = false;
                }
            });

            if (!allFieldsFilled) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'All fields are required.',
                });
                return; // Stop further execution
            }

            $.ajax({
                url: '<?php echo base_url('equipments/add_equipments') ?>',
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
                                // Redirect the page
                                window.location.href = 'http://localhost/mediresaledash/view_all_equipments';
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
