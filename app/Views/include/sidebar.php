<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Mediresale</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="<?= base_url('assets/img/logo-small.png'); ?>"
      type="image/x-icon"
    />

<!-- google font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Fonts and icons -->
  <script src="<?= base_url('assets/js/plugin/webfont/webfont.min.js'); ?>"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["<?= base_url('assets/css/fonts.min.css'); ?>"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/plugins.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/kaiadmin.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>" />

    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  </head>
  <body>
<div class="wrapper">
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

           
              <!-- <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Profile</h4>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('profile')?>">
                  <i class="fas fa-solid fa-user"></i>
                  <p>Profile</p>
                 
                </a>
              </li>
              <hr class="text-dark mt-4 mb-4"> -->
              <!-- property -->




            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->