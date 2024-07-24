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
                    <a href="#">View Property</a>
                </li>
            </ul>
            <h3 class="fw-bold mt-4">Property</h3>
        </div>

        <div class="row carouselbox">
  <?php if (!empty($viewproperty) && is_array($viewproperty)): ?>
    <?php foreach ($viewproperty as $item): ?>
      <div class="col-md-6">
        <!-- carousel -->
        <div class="bootstrap-carousel">
          <div id="carouselExampleIndicators<?= $item['id'] ?>" class="carousel slide" data-bs-ride="carousel">
            <?php $images = explode(',', $item['property_image']); ?>
            <!-- <ol class="carousel-indicators">
              <?php foreach ($images as $index => $image): ?>
                <li data-bs-target="#carouselExampleIndicators<?= $item['id'] ?>" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
              <?php endforeach; ?>
            </ol> -->
            <div class="carousel-inner">
              <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                  <img class="d-block w-100" src="<?= base_url('/assets/uploads/property/' . $image) ?>" alt="Slide <?= $index + 1 ?>">
                </div>
              <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators<?= $item['id'] ?>" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators<?= $item['id'] ?>" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
        </div>
        <!-- carousel -->
      </div>

      <div class="col-md-6">
        <div class="card-body">
         
          <div class="separator-solid"></div>
          <p class="card-category text-info mb-1">
            <a href="#">2024-12-24</a>
          </p>
          <h3 class="card-title">
            <a href="#"><?= esc($item['name']) ?> </a>
          </h3>
         
        
         
          <p class="card-text mt-3 mb-4">
          <?= esc(strip_tags($item['description'])) ?>
          </p>
      

          <div class="row">
            <div class="col-lg-6">
            <span class="textgrey">State</span> - <span class="ms-2 fs16"><?= esc($item['state']) ?></span>
            </div>
            <div class="col-lg-6"><span class="textgrey">City</span> - <span class="ms-2 fs16"><?= esc($item['city']) ?></div>   
          </div>

          <div class="row">
            <div class="col-lg-6">
            <span class="textgrey">Zip-Code</span> - <span class="ms-2 fs16"><?= esc($item['zipcode']) ?></span>
            </div>
            <div class="col-lg-6"><span class="textgrey">Total Area</span> - <span class="ms-2 fs16"><?= esc($item['total_area']) ?></div>
            
          </div>

          <div class="row">
            <div class="col-lg-6">
            <span class="textgrey">Price</span> - <span class="ms-2 fs16"><?= esc($item['price']) ?></span>
            </div>
            <div class="col-lg-6"><span class="textgrey">Built Year</span> - <span class="ms-2 fs16"><?= esc($item['built_year']) ?></div>
            
          </div>
          <div class="row">
            <div class="col-lg-6">
            <span class="textgrey">Parking</span> - <span class="ms-2 fs16"><?= esc($item['parking']) ?></span>
            </div>
            
            
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
