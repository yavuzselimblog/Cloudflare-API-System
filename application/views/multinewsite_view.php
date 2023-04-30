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
            <h1>Toplu Web Site</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">Toplu Web Site</li>
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
                <h3 class="card-title">Toplu Web Site Ekleyin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url('website/multiadd');?>" method="POST" id="multiform" onsubmit="return false;">
                <div class="card-body">

                  <a class="btn btn-primary mb-4" onclick="addInput()">+ Yeni Site</a>

                  <div class="form-group" id="input-container">
                    <label for="exampleInputPassword1">Domain</label>
                    <input name="website[]" type="text" class="form-control mb-4" id="exampleInputPassword1" placeholder="Https:// olmadan sadece deneme.com şeklinde giriniz...">
                  </div>
                
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?php echo base_url("website/list");?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                  <button onclick="multibutton();" id="multibuton" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Kaydet</button>
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
