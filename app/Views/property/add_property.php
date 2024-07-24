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
            <h3 class="fw-bold">Add Equipment</h3>
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
                    <a href="#">Add Property</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Property</div>
                    </div>
                    <form id="propertyForm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                          <div class="row">
                            <!-- image -->
                            <div class="col-lg-6">
                            <label for="image" class="labelclass">Image</label>
                            <input type="file" accept="image/*,.pdf" class="form-control greybg" name="property_image[]" id="property_image" multiple />
                            </div>
                             <!-- image -->
                             <!-- title -->
                            <div class="col-lg-6">
                            <label for="title" class="labelclass">Title</label>
                            <input type="text" class="form-control greybg" name="name" placeholder="Enter title" />
                            </div>
                            <!-- title -->

                            <!-- preview -->
                            <div id="imagePreview" class="row mt-3"></div>
                              <!-- preview -->
                          </div>


                          <div class="row mt-4">
                            <!-- address -->
                            <div class="col-lg-12">
                            <label for="address" class="labelclass">Adderess</label>
                            <input type="text" class="form-control greybg" name="address" placeholder="Address">
                            </div>  
                              <!-- adderess -->                       
                          </div>
                        

                          <div class="row mt-5">
                            <!--state  -->
                            <div class="col-lg-6">
                            <label for="state" class="labelclass">Select State</label>
                            <select name="state" id="state" class="form-control greybg" onchange="fetchCityData(this.value)">
                             <option value="">Select State</option>
                            <?php foreach ($states as $state) { ?>
                            <option value="<?php echo $state->id ?>"><?php echo $state->name ?></option>
                             <?php }?>
                            </select>
                            </div>
                             <!-- state -->
                             <!-- city-->
                            <div class="col-lg-6">
                            <label for="city" class="labelclass">Select City</label>
                            <select name="city" id="cityId" class="form-control greybg">
                            <option value="">Select City</option>
                            </select>
                            </div>
                            <!-- city-->
                          </div>


                          <div class="row mt-5">
                            <!--zipcode-->
                            <div class="col-lg-4">
                            <label for="zipcode" class="labelclass">Zip Code</label>
                            <input type="text" class="form-control greybg" name="zipcode" placeholder="Zip Code">
                            </div>
                             <!-- zipcode-->
                             <!-- total area-->
                            <div class="col-lg-4">
                            <label for="area" class="labelclass">Total Area</label>
                            <input type="text" class="form-control greybg" name="total_area" placeholder="Total Area">
                            </div>
                            <!--total area -->

                              <!--Built Year-->
                            <div class="col-lg-4">
                            <label for="Built-year" class="labelclass">Built Year</label>
                            <input type="text" class="form-control greybg" name="built_year" placeholder="Built Year">
                            </div>
                            <!--Built Year -->

                           
                          </div>




                          <div class="row mt-5">
                            <!--parking-->
                            <div class="col-lg-6">
                            <label for="parking" class="labelclass">Parking</label>
                            <select name="parking" class="form-control greybg">
                            <option value="" disabled="true">Select City</option>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                            </select>
                          
                            </div>
                             <!-- parking-->
                             <!-- price-->
                            <div class="col-lg-6">
                            <label for="price" class="labelclass">Price</label>
                            <input type="text" class="form-control greybg" name="price" placeholder="Price">
                            </div>
                            <!--price----->

                            

                             <!-- Description-->
                             <div class="col-lg-12 mt-5">
                             <label for="description" class="labelclass">Description</label>
                             <textarea id="editor" name="description" class="greybg"></textarea>
                            </div>
                            <!--Description-->
                          </div>





                        </div>
                        <div class="card-action text-end">
                            <button class="btn btn-blue"><i class="fa fa-plus color-info me-2"></i>Add Equipment</button>
                        </div>
                    </form>
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


<script>
document.getElementById('property_image').addEventListener('change', function(event) {
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
                    img.style.maxWidth = '150px';
                    img.style.margin = '10px';

                    var deleteIcon = document.createElement('span');
                    deleteIcon.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
                    deleteIcon.style.cursor = 'pointer';
                    deleteIcon.style.right = '0px';
                    deleteIcon.style.top = '5px';
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

<!-- image script -->


<!-- add equipments -->
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
                                window.location.href = 'http://localhost/mediresale/view_all_property';
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

<!-- scritp for sate and city data  -->
        <script>
            function fetchCityData(statesId){
                $.ajax({
                    url: "<?php echo site_url("cities") ?> ",
                    method: "POST",
                    data: {
                        statesId:statesId
                    },
                    success: function(result){
                    let data = JSON.parse(result);

                    document.querySelector("#cityId").innerHTML = data;
                        console.log(result);
                    }
                });
            }
        </script>
<!-- scritp for sate and city data  -->


<?= $this->endSection() ?>
