<?php $this->load->view('inc/header_view');?>

  <!-- Main Sidebar Container -->
  <?php $this->load->view('inc/menu_view');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profilim</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">Profilim</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Profilim</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST" onsubmit="return false;" id="profileform">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Kodu</label>
                    <input value="<?php echo $this->session->userdata('admincode');?>" type="text" disabled class="form-control" id="exampleInputEmail1">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Adı</label>
                    <input name="kadi" value="<?php echo $this->session->userdata('adminkadi');?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı adı">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı E-posta</label>
                    <input name="email" value="<?php echo $this->session->userdata('adminmail');?>" type="email" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı e-mail">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Şifre <span style="color:#b10021">(Değiştirmek istemiyorsanız giriş yapmayınız...)</span></label>
                    <input name="pass" type="password" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı şifre">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Api Key</label><br>
                    <a target="_blank" href="https://dash.cloudflare.com/profile/api-tokens">Api keyi almak için tıklayınız Global API yazan kısmı almalısınız...</a>
                    <input name="apikey" value="<?php echo $this->session->userdata('apikey');?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı api key">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Api Mail</label><br>
                    <span style="color:#b10021">Cloudflare E-posta Adresiniz</span>
                    <input name="apimail" value="<?php echo $this->session->userdata('apimail');?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı api mail">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı Api Organizasyon</label><br>
                    <span style="color:#b10021">Cloudflare ana sayfaya girince url kısmındaki link</span>
                    <input name="apiorganizasyon" value="<?php echo $this->session->userdata('apiorganizasyon');?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı api organizasyon">
                  </div>
                
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?php echo base_url();?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                  <button onclick="profilebutton();" id="profilebuton" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Kaydet</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

         

          </div>


        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php $this->load->view('inc/footer_view');?>
