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
            <h1>Yeni Web Site</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">Yeni Web Site</li>
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
                <h3 class="card-title">Yeni Web Site Ekleyin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST" onsubmit="return false;" id="newsiteform">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Site Adı</label>
                    <input name="sitename" type="text" class="form-control" id="exampleInputEmail1" placeholder="Web site adı">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Domain</label>
                    <input name="domain" type="text" class="form-control" id="exampleInputPassword1" placeholder="Https:// olmadan sadece deneme.com şeklinde giriniz...">
                  </div>
                
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?php echo base_url("website/list");?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                  <button onclick="newsitebutton();" id="newsitebuton" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Kaydet</button>
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
