<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">Accueil</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('contact') ?>" class="nav-link">Contact</a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
              <img class="img-circle elevation-2 img-sm mr-2"
                src="<?= base_url('./assets/upload_users/'.$this->session->userdata('auth_user')['image']) ?>"
                    alt="Photo">
              <span class="text-primary"><?= $this->session->userdata('auth_user')['nomcomplet']; ?></span> </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink-4">
              <a class="dropdown-item mb-2 text-primary" href="<?php echo base_url('profil/show/'.$this->session->userdata('auth_user')['user_id']); ?>">
              <img class="img-circle elevation-2 img-sm mr-2"
                src="<?= base_url('./assets/upload_users/'.$this->session->userdata('auth_user')['image']) ?>"
                    alt="Photo">
              Profil</a>
              <a class="dropdown-item text-danger" href=" <?= base_url('logout') ?> "><i class="fas fa-power-off"></i> Déconnexion  </a>
              
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
    
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="<?= base_url('assets/templates') ?>/dist/img/logo_scse.png" alt="Logo scse" class="brand-image" style="opacity: .8;">
          <span class="brand-text font-weight-light"><b>CERTIFICATION</b></span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">

          <!-- SidebarSearch Form -->
          <div class="form-inline mt-3 pb-2 mb-2">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <!-- les link des pages -->
              <li class="nav-item  <?php if($page_title == 'Tableau de bord'){ echo 'menu-open'; }?> mb-2">
                <a href="#" class="nav-link <?php if($page_title == 'Tableau de bord'){  echo 'active'; } ?>">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Tableau de bord
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?php if($page_title == 'Tableau de bord'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Accueil des courriers</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item <?php if($page_title == 'Session de la comité'){ echo 'menu-open'; }?> mb-2">
                <a href="#" class="nav-link <?php if($page_title == 'Session de la comité'){ echo 'active'; }?>">
                  <i class="nav-icon fa fa-list"></i>
                  <p>
                    Gestions des sessions
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('comite') ?>" class="nav-link <?php if($page_title == 'Session de la comité'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des sessions </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item <?php if($page_title == 'Activite' || $page_title == 'Personnel' ){ echo 'menu-open'; }?> mb-2">
                <a href="#" class="nav-link <?php if($page_title == 'Activite' || $page_title == 'Personnel'){ echo 'active'; }?>">
                  <i class="nav-icon fas fa-list"></i>
                  <p>
                    Gestions participations
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('personne') ?>" class="nav-link <?php if($page_title == 'Personnel'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des Personnels</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('activite') ?>" class="nav-link <?php if($page_title == 'Activite'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des activites </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item <?php if($page_title == 'Courrier Arrivé' || $page_title == 'Courrier Départ' ){ echo 'menu-open'; }?> mb-2">
                <a href="#" class="nav-link <?php if($page_title == 'Courrier Arrivé' || $page_title == 'Courrier Départ'){ echo 'active'; }?>">
                  <i class="nav-icon fas fa-list"></i>
                  <p>
                    Gestions des courriers
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('arriver') ?>" class="nav-link <?php if($page_title == 'Courrier Arrivé'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des arrivés </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('depart') ?>" class="nav-link <?php if($page_title == 'Courrier Départ'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des départs</p>
                    </a>
                  </li>
                </ul>
              </li>
          
              <li class="nav-item <?php if($page_title == 'Utilisateur'){ echo 'menu-open'; }?> mb-2">
                <a href="#" class="nav-link <?php if($page_title == 'Utilisateur'){ echo 'active'; }?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Gestions utilisateurs
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('register') ?>" class="nav-link <?php if($page_title == 'Utilisateur'){ echo 'active'; }?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Liste des utilisateurs</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- fin des link des pages -->
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 "><?= $page_title; ?></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('dashboard')?>">Accueil</a></li>
                  <li class="breadcrumb-item active"><?= $page_title; ?></li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
