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
  font-size:16px;
  color: #000;
  padding-left: 12px;
  font-weight:500;
}

.lead
{
  color:#000;
  font-weight:700;
  font-size:16px;
}

.carousel {
    padding: 30px 10px;
}

.carousel-inner {
    border-radius: 30px;
}

.offcanvas-header .btn-close
{
    border-radius:50%;
    background-color:#56C6DD;
}

.carousel-control-prev-icon {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e) !important;
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
                    <a href="<?= base_url('WebsiteLeads') ?>">View website leads</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    <h3 class="fw-bold mt-4">Website Leads</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Website Leads</h4>
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
                                                <td><?= esc($lead['full_name']) ?></td>
                                                <td><?= esc($lead['phone']) ?></td>
                                               
                                                
                                                <td>
                                                    <div class="form-button-action">
                                                        <a class="btn btn-link btn-success btn-lg btn-p" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" data-id="<?= esc($lead['gid']) ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a onclick="confirmLeadDelete(<?= $lead['gid']; ?>)" type="button" class="btn btn-link btn-danger btn-p btn-remove" data-bs-toggle="tooltip" data-original-title="Remove">
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
        <?php $pagi_path = '/WebsiteLeads';?>
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
    function confirmLeadDelete(gid) {
        Swal.fire({
            title: 'Are you sure to delete this Lead?',
            text: 'You are about to delete this lead. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with deletion
                $.ajax({
                    url: "<?= base_url('/websiteleads/delete_lead/') ?>" + gid,
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


<!-- script to show leads data in drawer -->
<script>
document.querySelectorAll('[data-bs-toggle="offcanvas"]').forEach(function(element) {
    element.addEventListener('click', function(event) {
        // Get the lead ID from the data-id attribute
        let leadId = event.currentTarget.getAttribute('data-id');

        // Fetch and display data in the offcanvas using the leadId
        $.ajax({
            url: "<?= base_url('/websiteleads/view_leads/') ?>" + leadId, // Ensure the URL matches your route
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response); // Log the response for debugging
                if (response.status === 'success') {
                    let content = '';

                    if (response.data.full_name) {
                        content += `
                            <table class="table table-bordered">
                                <tr>
                                    <th>Full Name</th>
                                    <td>${response.data.full_name}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>${response.data.phone}</td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td>${response.data.subject}</td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td>${response.data.message}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td>${response.data.created_at}</td>
                                </tr>
                            </table>
                        `;
                    } else {
                        content = '<p>No Leads data available.</p>';
                    }

                    
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
</script>


<?= $this->endSection() ?>
