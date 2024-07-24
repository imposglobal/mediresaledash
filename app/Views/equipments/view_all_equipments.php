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
                  <a href="<?php echo base_url('view_all_equipments')?>">View Equipment</a>
                </li>
              </ul>

            <h3 class="fw-bold mt-4">Equipment</h3>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Equipment List</h4>
                     
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
                            <th>Title</th>
                            <th>Total Area</th>
                            <th>Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                    
                        <tbody>
                        <?php if (!empty($equipment) && is_array($equipment)): ?>
                          <?php $i =1 ;?>
                          <?php foreach ($equipment as $equipments): ?>
                          <tr>
                            <td><?= $i++;?></td>
                            <td><?= esc($equipments['created_at']) ?></td>
                            <td><?= esc($equipments['title']) ?></td>
                            <td><?= esc($equipments['serial_number']) ?></td>
                            <td><?= esc($equipments['price']) ?></td>
                            <td>
                              <div class="form-button-action">

                                <a href="<?= base_url("view_equipments/" . $equipments["id"]); ?>"
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-success btn-lg btn-p"
                                  data-original-title="View"
                                >
                                <i class="fa  fa-eye"></i>
                                </a>
                               
                                 <a 
                                  href="<?= base_url('update_equipments/' . $equipments["id"]);?>"
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-primary btn-lg btn-p"
                                  data-original-title="Edit"
                                >
                                <i class="fa fa-edit"></i>
                                </a>
                                <a 
                                 onclick="confirmEquipmentDelete(<?= $equipments['id']; ?>)"
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn mt-1 btn-link btn-danger btn-p"
                                  data-original-title="Remove"
                                  
                                >
                                  <i class="fa fa-times"></i>
                               </a>
                              </div>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6">No products found</td></tr>
                                    <?php endif; ?>
                        



                         
                        
                          
                        </tbody>
                      </table>

                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script>
    function confirmEquipmentDelete(id) {
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
                    url: "<?= base_url('/equipments/delete_equipments/') ?>" + id,
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
   