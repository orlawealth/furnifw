<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="favicon.png">

  <title>Admin Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" /> -->
  <link href="editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
  <link href="editor/css/froala_style.min.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
    .bold{
     font-weight: bold;
    }
    .bg-white{
      background-color: #fff;
    }
    table a:hover{
      text-decoration: none;
    }
    .errors{
        color : #8B0000;
        font-family: cursive;
        font-style: italic;
        text-align: center;
      }
      .primary_message{
        text-align: center;
        font-family: cursive;
        font-style: italic;
        color: #fff;
      }
      .update_message{
        text-align: center;
        font-family: cursive;
        font-style: italic;
        color :#FFD700!important;
      }
      .primary_message a{
        color :#FFD700!important;
      }
      .primary_message a:hover{
        color :#DAA520!important;
      }
      .error_message{
        text-align: center;
        font-family: cursive;
        font-style: italic;
        color: #8B0000;
      }
       .whit{
        color:#fff;
      }
      .error{
        color: rgb(170, 4, 0)!important;
        font-style: italic;
      }
      .err{
      color: #8B0000!important;
      font-family: cursive;
      font-style: italic;

      }
      .success_message{
        text-align: center;
        font-family: cursive;
        font-style: italic;
        color: #fff;
      }
      .success_message a{
        color :#FFD700!important;
      }
      .success_message a:hover{
        color :#DAA520!important;
      }
      .error_message{
        text-align: center;
        font-family: cursive;
        font-style: italic;
        color: #8B0000;
      }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <img src="../images/SSN PNG.png"> -->
        </div>
        <div class="sidebar-brand-text mx-3">Furni</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      

       <!-- Nav Item - Team Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTeam" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user"></i>
          <span>Manage Customers</span>
        </a>
        <div id="collapseTeam" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="customers.php" >Customers</a>
            <a class="collapse-item" href="#" >Add new customer</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Post Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-pen"></i>
            <span>Manage Products</span>
          </a>
          <div id="collapsePost" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="products.php" >Products</a>
              <a class="collapse-item" href="add_product.php" >Add new product</a>
            </div>
          </div>
      </li>

      <!-- Nav Item - Event Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-table"></i>
          <span>Manage Orders</span>
        </a>
        <div id="collapseEvents" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="orders.php" >Orders</a>
            <a class="collapse-item" href="#" >Add new order</a>
         
          </div>
        </div>
      </li>




      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline small text-success bold ">Admin</span>
                <img class="img-profile rounded-circle" src="../images/person_icon.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <!--   <a class="dropdown-item" href="password.php">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->