<!-- Included header sidebar & footer in layout -->
<?= $this->extend('layout/layout') ?>
<!-- Define the content section -->
<?= $this->section('content') ?>
      
      <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >             
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round skew-shadow card1">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                         
                          <i class="fas fa-thermometer"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Equipments</p>
                          <h4 class="card-title"><?= $total_equipments_Count; ?>+</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3 ">
                <div class="card card-stats card-info card-round skew-shadow card2">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          
                          <i class="fas fa-hospital"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Property</p>
                          <h4 class="card-title"><?= $total_property_Count ?>+</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-success card-round skew-shadow  card3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                          <i class="fas fa-chart-pie"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Sales</p>
                          <h4 class="card-title">60+</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-secondary card-round  skew-shadow card4">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5">
                        <div class="icon-big text-center">
                        <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col-7 col-stats">
                        <div class="numbers">
                          <p class="card-category">Leads</p>
                          <h4 class="card-title"><?= $total_leads_Count; ?>+</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

         
      
            <div class="row pt-5"> 
                      
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      
                      <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Leads</div>
                      
                    </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end">
                      <a href="#" class="btn greybtn leads">View Leads</a>
                      </div>
                    </div>
                    
                  </div>

                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name </th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile Number</th>
                            
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1 ?>
                        <?php foreach ($leads as $lead): ?>
                          <tr>
                              <th scope="row"><?php echo $i++; ?></th>
                              <td><?php echo $lead['first_name'] . ' ' . $lead['last_name']; ?></td>
                              <td><?php echo $lead['email']; ?></td>
                              <td><?php echo $lead['phone_number']; ?></td>
                             
                          </tr>
                          <?php endforeach; ?>            
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?= $this->endSection() ?>   
