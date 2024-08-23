<!-- Included header sidebar & footer in layout -->
<?= $this->extend('layout/layout') ?>
<!-- Define the content section -->
<?= $this->section('content') ?>

      
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
                  <a href="<?php echo base_url('leads')?>">View leads</a>
                </li>
              </ul>


            <div class="row">
                <div class="col-lg-8"> <h3 class="fw-bold mt-4">Leads</h3></div>
                <div class="col-lg-4 text-end">
                <div class="search-container mt-4">
                <form action="">
                <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..">
                <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
                </button>
                </div>
               </form>
            </div>
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
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
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
                          <?php $i =1 ;?>
                          <?php foreach ($leads as $lead): ?>
                          <tr>
                            <td><?= $i++;?></td>
                            <td><?= esc($lead['created_at']) ?></td>
                            <td><?= esc($lead['first_name'] . ' ' . $lead['last_name']) ?></td>
                            <td><?= esc($lead['email']) ?></td>
                            <td><?= esc($lead['phone_number']) ?></td>
                            <td>
                              <div class="form-button-action">

                                 <a 
                                 onclick="confirmLeadDelete(<?= $lead['id']; ?>)"
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-danger btn-p btn-remove"
                                  data-original-title="Remove"
                                  
                                >
                                  <i class="fa fa-times"></i>
                               </a> 
                              </div>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6">No Leads found</td></tr>
                                    <?php endif; ?>
                        </tbody>
                      </table>

                     
                    </div>


     <!-- Pagination -->
    <div class="d-flex justify-content-end">
    <?php if ($pager) :?>
        <?php $pagi_path='/view_all_equipments'; ?>
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

    <!-- ajax code to delete equipment -->
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
                    error: function (xhr, status, error) {
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
<?= $this->endSection() ?>  
   