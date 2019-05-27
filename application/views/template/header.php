<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <!-- Icons-->
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="<?= base_url(); ?>assets/template/coreui/src/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/src/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    

    <!-- CoreUI and necessary plugins-->
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/pace-progress/pace.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>

    <!-- Bootstrap File Input -->
    <link   href="<?=base_url(); ?>assets/plugin/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?= base_url(); ?>assets/plugin/bootstrap-fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/plugin/bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/plugin/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/plugin/bootstrap-fileinput/js/fileinput.min.js"></script>

    <!-- Selelct 2-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugin/select2/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugin/select2/css/select2-bootstrap.css">
    <script src="<?= base_url(); ?>assets/plugin/select2/js/select2.full.min.js" type="text/javascript" charset="utf-8"></script>
    
    <!-- Bootbox -->
    <script src="<?= base_url(); ?>assets/plugin/bootbox/bootbox.min.js"></script>

    <!-- Price Format -->
     <script src="<?= base_url(); ?>assets/plugin/jquery.priceformat.js"></script>

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/r-2.2.2/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/r-2.2.2/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
    
      <!-- Highcharts -->
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/highcharts.js?v=05042019abc"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/modules/data.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/modules/drilldown.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/modules/exporting.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/grouped-categories.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/highcharts-more.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/highcharts-3d.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/lib/canvg.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/lib/jspdf.js"></script>
    <script src="<?= base_url(); ?>assets/plugin/highchart/code/lib/rgbcolor.js"></script>

     <!-- moment.js -->
    <script src="<?= base_url(); ?>assets/plugin/moment/min/moment.min.js"  type="text/javascript"></script>
    <!-- datepicker -->
    <link href="<?= base_url(); ?>assets/plugin/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css">
    <script src="<?= base_url(); ?>assets/plugin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript" charset="utf-8"></script> 
  
    <!-- Awesomplete -->
    <link   href="<?= base_url(); ?>assets/plugin/awesomplete/awesomplete.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?= base_url(); ?>assets/plugin/awesomplete/awesomplete.min.js"></script>

   <!-- JQUERY VALIDATION -->
    <script src="<?= base_url(); ?>assets/plugin/jquery-validation/dist/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?= base_url(); ?>assets/plugin/jquery-validation/dist/additional-methods.min.js" type="text/javascript" charset="utf-8"></script>

   <!-- Hands On Table -->
    <script src="<?= base_url(); ?>assets/plugin/handsontable/dist/handsontable.full.js"></script>
    <link   href="<?=base_url(); ?>assets/plugin/handsontable/dist/handsontable.full.min.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  const base_url = "<?=base_url(); ?>";
</script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show <?= ($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="") ? 'brand-minimized sidebar-minimized' : ''; ?>  "> 
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?= base_url(); ?>assets/img/logo.png" width="130" height="40" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="<?= base_url(); ?>assets/img/logo_sdv.png" width="50" height="30" alt="CoreUI Logo">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
     
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="<?= base_url(); ?>assets/img/avatars/default.png" alt="admin@bootstrapmaster.com">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-wrench"></i> Settings</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-usd"></i> Payments
              <span class="badge badge-secondary">42</span>
            </a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-file"></i> Projects
              <span class="badge badge-primary">42</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-shield"></i> Lock Account</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>
    <div class="app-body">