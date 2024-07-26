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
                          <h4 class="card-title">70+</h4>
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
                            <th scope="col">Date</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Year</th>
                            <th scope="col">Serial-Number</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">
                              
                             1
                            </th>
                            <td>2014-07-15</td>
                            <td>Testing data1</td>
                            <td>25000</td>
                            <td>2024</td>
                            <td>
                            EQ43463265
                            </td>
                          </tr>
                          <tr>
                          <th scope="row">
                              
                              2
                             </th>
                             <td>2014-07-16</td>
                             <td>Testing data2</td>
                             <td>20000</td>
                             <td>2024</td>
                             <td>
                             EQ43463265
                             </td>
                          </tr>
                          <tr>
                          <th scope="row">
                              
                              3
                             </th>
                             <td>2014-07-17</td>
                             <td>Testing data3</td>
                             <td>21000</td>
                             <td>2024</td>
                             <td>
                             EQ43463265
                             </td>
                          </tr>
                          <tr>
                          <th scope="row">
                              
                              4
                             </th>
                             <td>2014-07-18</td>
                             <td>Testing data4</td>
                             <td>15000</td>
                             <td>2024</td>
                             <td>
                             EQ43463265
                             </td>
                          </tr>
                          <tr>
                         
                          <tr>
                          <th scope="row">
                              
                              5
                             </th>
                             <td>2014-07-20</td>
                             <td>Testing data5</td>
                             <td>25000</td>
                             <td>2024</td>
                             <td>
                             EQ43463265
                             </td>
                          </tr>
                         
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
