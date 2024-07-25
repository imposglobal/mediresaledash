<?php $session = session();?>
<div class="main-panel">
<div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="" class="logo">
                <img
                  src="<?= base_url('assets/img/logo.png');?>"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
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
          <!-- Navbar Header -->
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg"
          >
            <div class="container-fluid">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
             
                <h3 class="fw-bold pt-3 ps-4 reshidden">👋 Hi, <?php echo $session->get('name');?> ! </h3>
              
             
              
            </div>
         
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <div class="avatar-sm">
                      <img
                        src="<?= base_url('assets/img/logo-small.png'); ?>"
                        alt="..."
                        class="avatar-img rounded-circle"
                      /> 
                    
                    </div>
                    <span class="profile-username">
                     
                    <span class="fw-bold"><i class="fas fa-angle-down"></i></span>
                    <a class="logoutbtn"><?php echo $session->get('name');?></a>
                 
                    <a href="<?php echo base_url('logout'); ?>"
                      class="btn btn-xs btn-secondary btn-sm logoutbtn mb-3 mt-2">Logout</a>
                    </span>
                      </a>
                    <!-- <div class="d-flex">
                    <div><?php echo $session->get('name');?></div>
                    <div> <a href="<?php echo base_url('logout'); ?>"
                      class="btn btn-xs btn-secondary btn-sm logoutbtn mb-3">Logout</a>
                    </span>
                      </a></div>
                    </div> -->
                     
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img
                              src="<?= base_url('assets/img/logo-small.png'); ?>"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            <h4><?php echo $session->get('name');?></h4>
                            <p class="text-muted"><?php echo $session->get('email');?></p>
                            <a
                              href="<?php echo base_url('logout'); ?>"
                              class="btn btn-xs btn-secondary btn-sm"
                              >Logout</a
                            >
                          </div>
                        </div>
                      </li>
                      
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <!-- end of main header -->