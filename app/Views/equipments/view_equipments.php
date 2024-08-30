<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


   
<div class="container">
    <div class="page-inner">
        <div class="page-header">
           
            <ul class="breadcrumbs mb-3">
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
                    <a href="#">View Equipment</a>
                </li>
            </ul>
            <h3 class="fw-bold mt-4">Equipment</h3>
        </div>
        

        <div class="row carouselbox">
  <?php if (!empty($viewequipment) && is_array($viewequipment)): ?>
    <?php foreach ($viewequipment as $item): ?>

      <div class="col-md-12 mb-5">
      <div class="card-body">
      <div class="separator-solid"></div>
      
          <h3 class="card-title maintitle">
            <a href="#"><?= esc($item['title']) ?> </a>
          </h3>
          <p class="card-text mt-2">
          <?= esc(strip_tags($item['description'])) ?>
          </p>
      </div>
      </div>
      <div class="col-md-6">
        <!-- carousel -->
        <div class="bootstrap-carousel">
          <div id="carouselExampleIndicators<?= $item['eid'] ?>" class="carousel slide" data-bs-ride="carousel">
            <?php $images = explode(',', $item['equipment_image']); ?>
           
            <div class="carousel-inner">
              <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                  <img class="d-block w-100" src="<?=  $image ?>" alt="Slide <?= $index + 1 ?>">
                </div>
              <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators<?= $item['eid'] ?>" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators<?= $item['eid'] ?>" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
            <!-- <ol class="carousel-indicators">
              <?php foreach ($images as $index => $image): ?>
                <li data-bs-target="#carouselExampleIndicators<?= $item['eid'] ?>" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
              <?php endforeach; ?>
            </ol> -->
          </div>
         
        </div>
        <!-- carousel -->
      </div>

      <div class="col-md-6">
        <div class="card-body">
            <div class="row">
            <div class="col-lg-12 mb-3">
            <h3 class="card-title maintitle mt-3">
             <!-- Ameneties
            </h3> -->
            </div>
            <div class="col-lg-12"><span class="textdarkgrey">Equipment Type</span> - <span class="ms-2 fs16"><?= esc($item['equipment_type']) ?></div>
            <div class="col-lg-12"><span class="textdarkgrey">Quantity</span> - <span class="ms-2 fs16"><?= esc($item['quantity']) ?></div>
            <div class="col-lg-12"><span class="textdarkgrey">Transaction Type</span> - <span class="ms-2 fs16"><?= esc($item['transaction_type']) ?></div>
            <div class="col-lg-12"><span class="textdarkgrey">Brand</span> - <span class="ms-2 fs16"><?= esc($item['brand']) ?></div>
            <div class="col-lg-12"><span class="textdarkgrey">Equipment Condition	</span> - <span class="ms-2 fs16"><?= esc($item['equipment_condition']) ?></div>
            <div class="col-lg-12"><span class="textdarkgrey">Warranty</span> - <span class="ms-2 fs16"><?= esc($item['warranty']) ?></div>
            <div class="col-lg-12"><span class="textdarkgrey">Availability	</span> - <span class="ms-2 fs16"><?= esc($item['availability']) ?></div>
           </div>

          <div class="row">
            <div class="col-lg-12">
            <span class="textdarkgrey">State</span> - <span class="ms-2 fs16"><?= esc($item['state']) ?></span>
            </div>
            <div class="col-lg-12"><span class="textdarkgrey">City</span> - <span class="ms-2 fs16"><?= esc($item['city']) ?></div>   
            <div class="col-lg-12">
            <span class="textdarkgrey">Zip-Code</span> - <span class="ms-2 fs16"><?= esc($item['zipcode']) ?></span>
            </div>
            <div class="col-lg-12"><span class="textdarkgrey">Price</span> - <span class="ms-2 fs16"><?= esc($item['price']) ?></div>
            <div class="col-lg-12">
            <span class="textdarkgrey">Serial Number</span> - <span class="ms-2 fs16"><?= esc($item['serial_number']) ?></span>
            </div>
            <div class="col-lg-12"><span class="textdarkgrey">Manufacture Year</span> - <span class="ms-2 fs16"><?= esc($item['manifacture_year']) ?></div>
          </div>       
        </div>
    </div>


    
    <?php endforeach; ?>
  <?php else: ?>
    <p>No property found</p>
  <?php endif; ?>
</div>
</div>
</div>




<?= $this->endSection() ?>
