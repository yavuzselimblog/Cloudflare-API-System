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
            <h1>Web Site Düzenleme</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active"><?php echo $detail->siteadi;?> Site Düzenle</li>
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
                <h3 class="card-title"><?php echo $detail->siteadi;?> Site Düzenle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST" onsubmit="return false;" id="editsiteform">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Site Zone ID</label>
                    <input disabled value="<?php echo $detail->sitezone;?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="Web site adı">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Site Adı</label>
                    <input name="sitename" value="<?php echo $detail->siteadi;?>" type="text" class="form-control" id="exampleInputEmail1" placeholder="Web site adı">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Site Domain</label>
                    <input name="domain" value="<?php echo $detail->sitedomain;?>" type="text" class="form-control" id="exampleInputPassword1" placeholder="Https:// olmadan sadece deneme.com şeklinde giriniz...">
                  </div>

                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Site Durum</label>
                    <select name="status" class="form-control">
                        <option <?php echo $detail->durum == 1 ? 'selected' : null;?> value="1">Aktif</option>
                        <option <?php echo $detail->durum == 2 ? 'selected' : null;?> value="2">Pasif</option>
                    </select>
                  </div>
                
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="sitecode" value="<?php echo $detail->sitekodu;?>" />
                  <a href="<?php echo base_url("website/list");?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                  <a href="<?php echo base_url("website/delete/".$detail->sitekodu);?>" class="btn btn-warning"><i class="fa fa-info"></i> Siteyi Sil</a>
                  <button onclick="editsitebutton();" id="editsitebuton" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Kaydet</button>
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
