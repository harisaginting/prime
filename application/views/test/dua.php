<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Test</title>
    <!-- Icons-->
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="<?= base_url(); ?>assets/template/coreui/src/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/template/coreui/src/vendors/pace-progress/css/pace.min.css" rel="stylesheet">


    <!-- CoreUI and necessary plugins-->
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/coreui/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </head>

<body>
      <div class="row">
        <div class="col-md-6 offset-md-3">
            <div clas="card">
              <div class="card-header"><h4>Test 2</h4></div>
              <div class="card-body">
                  <div class="col-md-12">
                    <form action="<?= base_url(); ?>/test/dua" method="post">
                      <div class="form-group">
                        <label>Masukkan angka untuk dipecah</label>
                        <input value="<?= $angka ?>"  type="number" name="angka">
                      </div>
                      <div class="form-group">
                        <button class="btn btn-info" type="submit">Pecah angka</button>
                      </div>
                  </form>
                  </div>    
              </div>
           </div>
        </div>
      </div>
      <?php if(!empty($result)) :  ?>
        <div class="row"> 
          <div class="col-md-6 offset-md-3">
          <strong> Hasil : </strong> <?= json_encode($result); ?>
          </div>
        </div>

      <?php endif  ?>
</body>