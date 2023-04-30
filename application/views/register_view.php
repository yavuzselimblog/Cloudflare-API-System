<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $setting->site_baslik;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/dist/css/adminlte.min.css">
  <link href="<?php echo base_url();?>/assets/sweetalert2/sweetalert2.css" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url();?>" class="h1"><b>BCYSoftware</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sistemi kullanabilmek için kayıt olunuz...</p>

      <form action="" method="post" onsubmit="return false;" id="registerform">


      <div class="input-group mb-3">
          <input type="text"  name="kadi" class="form-control" placeholder="Kullanıcı adınız">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email"  name="email" class="form-control" placeholder="E-posta adresiniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="pass"  class="form-control" placeholder="Şifreniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>



        <div class="input-group mb-3">
          <input type="text"  name="apikey" class="form-control" placeholder="Api Key">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>

        
        <div class="input-group mb-3">
          <input type="text"  name="apimail" class="form-control" placeholder="Api Mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>


           
        <div class="input-group mb-3">
          <input type="text"  name="apiorganizasyon" class="form-control" placeholder="Api Organizasyon Kod">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>




        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button onclick="registerbutton();" id="registerbuton" type="submit" class="btn btn-primary btn-block">Kayıt Olun</button><br>
            <a href="<?php echo base_url('user/login');?>">Giriş Yapın</a>

          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url();?>/assets/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url();?>/assets/main.js"></script>

</body>
</html>
