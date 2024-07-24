<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


   
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">View Property</h3>
            <ul class="breadcrumbs mb-3">
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
                    <a href="#">View Property</a>
                </li>
            </ul>
        </div>

        <div class="row">
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
          <div class="d-flex">
            <div class="avatar">
              <img src="<?= base_url('assets/img/logo-small.png'); ?>" alt="..." class="avatar-img rounded-circle" />
            </div>
          </div>
          <div class="separator-solid"></div>
          <p class="card-category text-info mb-1">
            <a href="#">2024-12-24</a>
          </p>
          <h3 class="card-title">
            <a href="#"><?= esc($item['name']) ?> </a>
          </h3>
         
          <?= esc($item['state']) ?>, <?= esc($item['city']) ?>
         
          <p class="card-text">
          <?= esc(strip_tags($item['description'])) ?>
          </p>
          <div class="d-flex">
            <div class="info-post">
              <span class="textgrey">Zip-Code</span> - <span class="ms-2 fs16"><?= esc($item['zipcode']) ?></span>
              <br>
              <span class="textgrey">Total Area</span> - <span class="ms-2 fs16"><?= esc($item['total_area']) ?></span>
              <br>
              <span class="textgrey">Price</span> - <span class="ms-2 fs16"><?= esc($item['price']) ?></span>
              <br>
              <span class="textgrey">Parking</span> - <span class="ms-2 fs16"><?= esc($item['parking']) ?></span>
              <br>
              <span class="textgrey">Built Year</span> - <span class="ms-2 fs16"><?= esc($item['built_year']) ?></span>
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
