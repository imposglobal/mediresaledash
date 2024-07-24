 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="" class="logo">
              <img
                src="<?= base_url('assets/img/logo.png'); ?>"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <!-- <div class="logosmall">
            <img src="<?= base_url('assets/img/logo-small.png'); ?>" class="logo-small">
            </div>
             -->
            <ul class="nav nav-secondary pt-4">
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Home</h4>
              </li>
           
              <li class="nav-item active">
                <a href="<?php echo base_url('dashboard')?>">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  
                </a>
                
              </li>
              <hr class="text-dark mt-4 mb-4">
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Equipments</h4>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('equipments')?>">
                  <i class="fas fa-pen-square"></i>
                  <p>Add Equipment</p>
                 
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('view_all_equipments')?>">
                  <i class="fas fa-table"></i>
                  <p>View Equipment</p>
                 
                </a>
              </li>
              <hr class="text-dark mt-4 mb-4">
              <!-- property -->


             
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Property</h4>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('property')?>">
                  <i class="fas fa-th-list"></i>
                  <p>Add Property</p>
                 
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('view_all_property')?>">
                  <i class="fas fa-file"></i>
                  <p>View Property</p>
                 
                </a>
              </li>

              <hr class="text-dark mt-4 mb-4">
               <!-- settings -->
              <!-- <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Setting</h4>
              </li>

              <li class="nav-item">
                <a href="">
                  <i class="fas fa-user"></i>
                  <p>Profile</p>
                 
                </a>
              </li>
              <hr class="text-dark mt-4 mb-4"> -->



            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->