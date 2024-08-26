<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Included header sidebar & footer in layout -->
<?= $this->extend('layout/layout') ?>
<!-- Define the content section -->
<?= $this->section('content') ?>

<style>
  .offcanvas, .offcanvas-lg, .offcanvas-md, .offcanvas-sm, .offcanvas-xl, .offcanvas-xxl {
    --bs-offcanvas-width: 550px !important;
}

.offcanvas-title
{
  font-size:25px;
  font-weight:600;
  color:#2a2f5b;
}

.leadtitle
{
  font-size:18px;
  color: #4664AE;
  padding-left: 12px;
}

.lead
{
  color:#000;
  font-weight:500;
}

.carousel {
    padding: 30px 10px;
    width: 300px;
}
</style>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="<?= base_url('dashboard') ?>">
                        Home
                    </a>
                </li>
                <span class="fs18">|</span>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>
                <span class="fs18">|</span>
                <li class="nav-item">
                    <a href="<?= base_url('leads') ?>">View leads</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    <h3 class="fw-bold mt-4">Leads</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Leads</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($leads) && is_array($leads)): ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($leads as $lead): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= esc($lead['created_at']) ?></td>
                                                <td><?= esc($lead['first_name'] . ' ' . $lead['last_name']) ?></td>
                                                <td><?= esc($lead['email']) ?></td>
                                                <td><?= esc($lead['phone_number']) ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a class="btn btn-link btn-success btn-lg btn-p" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" data-id="<?= esc($lead['id']) ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a onclick="confirmLeadDelete(<?= $lead['id']; ?>)" type="button" class="btn btn-link btn-danger btn-p btn-remove" data-bs-toggle="tooltip" data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No Leads found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                         <!-- Pagination -->
                         <div class="d-flex justify-content-end">
    <?php if ($pager) : ?>
        <?php $pagi_path = '/leads/view_leads/'; // Base path without placeholder ?>
        <?php $pager->setPath($pagi_path); ?>
        <nav aria-label="Page navigation">
            <?= $pager->links() ?>
        </nav>
    <?php endif ?>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- drawer -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Details</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        
    </div>
</div>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<!-- Ajax code to delete lead -->
<script>
    function confirmLeadDelete(id) {
        Swal.fire({
            title: 'Are you sure to delete this property?',
            text: 'You are about to delete this property. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                $.ajax({
                    url: "<?= base_url('/leads/delete_lead/') ?>" + id,
                    type: 'GET',
                    dataType: 'json', // Expect JSON response from server
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error deleting property: ' + error
                        });
                    }
                });
            }
        });
    }

   
</script>


<!-- <script>
document.querySelectorAll('[data-bs-toggle="offcanvas"]').forEach(function(element) {
    element.addEventListener('click', function(event) {
        // Get the lead ID from the data-id attribute
        let leadId = event.currentTarget.getAttribute('data-id');

        // Fetch and display data in the offcanvas using the leadId
        $.ajax({
            url: "<?= base_url('/leads/view_leads/') ?>" + leadId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let content = '';

                    // Check if `eid` exists and is not empty
                    if (response.data.equipment_title) {
                        content += `
                            <p class="leadtitle"><span class="lead">Equipment Title:</span>  ${response.data.equipment_title}</p>
                            <p class="leadtitle"><span class="lead">Equipment Type:</span>  ${response.data.equipment_type}</p>
                            <p class="leadtitle"><span class="lead">Transaction Type:</span>  ${response.data.etransaction_type}</p>
                            <p class="leadtitle"><span class="lead">Serial Number:</span>  ${response.data.serial_number}</p>
                            <p class="leadtitle"><span class="lead">Price:</span>  ${response.data.price}</p>
                        `;
                    }

                    // Check if `pid` exists and is not empty
                    if (response.data.property_name) {
                        content += `
                            <p class="leadtitle"><span class="lead">Property Name:</span> ${response.data.property_name}</p>
                            <p class="leadtitle"><span class="lead">Transaction Type:</span> ${response.data.ptransaction_type}</p>
                            <p class="leadtitle"><span class="lead">Property Type:<span></span> ${response.data.property_type}</p>
                            <p class="leadtitle"><span class="lead">State:</span> ${response.data.state}</p>
                            <p class="leadtitle"><span class="lead">City:</span> ${response.data.city}</p>
                            <p class="leadtitle"><span class="lead">Zipcode:</span> ${response.data.zipcode}</p>
                            
                        `;
                    }

                    // Populate the offcanvas body with the content
                    document.querySelector('.offcanvas-body').innerHTML = content;

                } else {
                    document.querySelector('.offcanvas-body').innerHTML = '<p>Error loading details.</p>';
                }
            },
            error: function(xhr, status, error) {
                document.querySelector('.offcanvas-body').innerHTML = `<p>Error loading details: ${error}</p>`;
            }
        });
    });
});
</script> -->


<!-- slider code -->



<script>
document.querySelectorAll('[data-bs-toggle="offcanvas"]').forEach(function(element) {
    element.addEventListener('click', function(event) {
        // Get the lead ID from the data-id attribute
        let leadId = event.currentTarget.getAttribute('data-id');

        // Fetch and display data in the offcanvas using the leadId
        $.ajax({
            url: "<?= base_url('/leads/view_leads/') ?>" + leadId, // Ensure the URL matches your route
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response); // Log the response for debugging
                if (response.status === 'success') {
                    let content = '';

                    // Handle equipment details and images if `eid` is present
                    if (response.data.equipment_title) {
                        let equipmentImages = response.data.equipment_image ? response.data.equipment_image.split(',').map(img => img.trim()) : [];
                        

                        if (equipmentImages.length > 0) {
                            content += `
                                <div id="equipmentImageCarousel" class="carousel slide">
                                    <div class="carousel-inner">`;

                            equipmentImages.forEach((image, index) => {
                                content += `
                                    <div class="carousel-item${index === 0 ? ' active' : ''}">
                                        <img src="${image}" class="d-block w-100" alt="Equipment Image">
                                    </div>`;
                            });

                            content += `
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#equipmentImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#equipmentImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>`;
                        } else {
                            content += '<p>No equipment images available.</p>';
                        }

                        content += `
                            <p class="leadtitle"><span class="lead">Equipment Title:</span> ${response.data.equipment_title}</p>
                            <p class="leadtitle"><span class="lead">Equipment Type:</span> ${response.data.equipment_type}</p>
                            <p class="leadtitle"><span class="lead">Transaction Type:</span> ${response.data.etransaction_type}</p>
                            <p class="leadtitle"><span class="lead">Serial Number:</span> ${response.data.serial_number}</p>
                            <p class="leadtitle"><span class="lead">Price:</span> ${response.data.price}</p>
                        `;
                    }

                    // Handle property details and images if `pid` is present
                    if (response.data.property_name) {
                        let propertyImages = response.data.property_image ? response.data.property_image.split(',').map(img => img.trim()) : [];
                        

                        if (propertyImages.length > 0) {
                            content += `
                                <div id="propertyImageCarousel" class="carousel slide">
                                    <div class="carousel-inner">`;

                            propertyImages.forEach((image, index) => {
                                content += `
                                    <div class="carousel-item${index === 0 ? ' active' : ''}">
                                        <img src="${image}" class="d-block w-100" alt="Property Image">
                                    </div>`;
                            });

                            content += `
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>`;
                        } else {
                            content += '<p>No property images available.</p>';
                        }

                        content += `
                            <p class="leadtitle"><span class="lead">Property Name:</span> ${response.data.property_name}</p>
                            <p class="leadtitle"><span class="lead">Transaction Type:</span> ${response.data.ptransaction_type}</p>
                            <p class="leadtitle"><span class="lead">Property Type:</span> ${response.data.property_type}</p>
                            <p class="leadtitle"><span class="lead">State:</span> ${response.data.state}</p>
                            <p class="leadtitle"><span class="lead">City:</span> ${response.data.city}</p>
                            <p class="leadtitle"><span class="lead">Zipcode:</span> ${response.data.zipcode}</p>
                        `;
                    }

                    // Populate the offcanvas body with the content
                    document.querySelector('.offcanvas-body').innerHTML = content;

                    // Ensure the carousels are initialized after content is inserted
                    const equipmentCarouselElement = document.querySelector('#equipmentImageCarousel');
                    if (equipmentCarouselElement) {
                        new bootstrap.Carousel(equipmentCarouselElement);
                    }

                    const propertyCarouselElement = document.querySelector('#propertyImageCarousel');
                    if (propertyCarouselElement) {
                        new bootstrap.Carousel(propertyCarouselElement);
                    }

                } else {
                    document.querySelector('.offcanvas-body').innerHTML = '<p>Error loading details.</p>';
                }
            },
            error: function(xhr, status, error) {
                document.querySelector('.offcanvas-body').innerHTML = `<p>Error loading details: ${error}</p>`;
            }
        });
    });
});
</script>
<?= $this->endSection() ?>

