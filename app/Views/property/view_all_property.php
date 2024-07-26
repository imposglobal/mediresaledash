
    
<!-- Included header sidebar & footer in layout -->
<?= $this->extend('layout/layout') ?>
<!-- Define the content section -->
<?= $this->section('content') ?>
      
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
            <h3 class="fw-bold">View Property</h3>
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
                  <a href="#">View Equipment</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Property List</h4>
                     
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
                            <th>Zip Code</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                    
                        <tbody>
                        <?php if (!empty($properties) && is_array($properties)): ?>
                          <?php $i =1 ;?>
                          <?php foreach ($properties as $property): ?>
                          <tr>
                            <td><?= $i++;?></td>
                          
                            <td><?= esc($property['created_at']) ?></td>
                            <td><?= esc($property['name']) ?></td>
                            <td><?= esc($property['total_area']) ?></td>
                            <td><?= esc($property['price']) ?></td>
                            <td><?= esc($property['zipcode']) ?></td>
                            <td>
                              <div class="form-button-action">

                                <a href="<?= base_url("view_property/" . $property["id"]); ?>"
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-success btn-lg btn-p"
                                  data-original-title="View"
                                >
                                <i class="fa  fa-eye"></i>
                                </a>
                               
                                 <a 
                                  href="<?= base_url('update_property/' . $property["id"]);?>"
                                  type="button"
                                  data-bs-toggle="tooltip"
                                  title=""
                                  class="btn btn-link btn-primary btn-lg btn-p"
                                  data-original-title="Edit"
                                >
                                <i class="fa fa-edit"></i>
                                </a>
                                <a 
                                  onclick="ConfirmPropertyDelete(<?= $property['id']; ?>)"
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
                                        <tr><td colspan="6">No property found</td></tr>
                                    <?php endif; ?>
                        



                         
                        
                          
                        </tbody>
                      </table>
                    </div>

                     <!-- Pagination -->
    <div class="d-flex justify-content-end">
    <?php if ($pager) :?>
        <?php $pagi_path='/view_all_property'; ?>
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
       

        <script>
    function ConfirmPropertyDelete(id) {
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
                    url: "<?= base_url('/property/delete_property/') ?>" + id,
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
   