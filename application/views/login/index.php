
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>SDV - PRIME</title>

  <!-- Icons-->
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/src/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/src/vendors/pace-progress/css/pace.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/login.css">
  <!-- CoreUI and necessary plugins-->
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/pace-progress/pace.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
</head>
<body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4 container_form_login">
              <div class="card-body">
                <form action="<?= base_url() ?>login/login_proccess" method="POST" enctype="multipart/form-data">
                  <img src="<?= base_url();?>/assets/img/logo.png" alt="" width="250" >
                  <p class="text-white"><strong>Sign In to your account</strong></p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="icon-user"></i>
                    </span>
                    </div>
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                    </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                    <i class="icon-lock"></i>
                    </span>
                    </div>
                    <input name="password" class="form-control" type="password" placeholder="Password" required>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <?=$this->session->flashdata('alError')?> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-sign-in"></i>  <span>&nbsp;&nbsp;Login &nbsp;&nbsp;&nbsp;</span></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card text-white py-5 d-md-down-none container_remarks" style="width:44%">
            <div class="card-body text-center">
            <div>
            <img src="<?= base_url();?>/assets/img/logo-symbol.png" alt="" width="180" >
            <img src="<?= base_url();?>/assets/img/telkomsolution.png" style="margin-top: 33px;" alt="" width="200" >
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>


</body>
</html>