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
            <h1>Yeni Dns Site</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">Yeni Dns Site</li>
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
                <h3 class="card-title">Yeni DNS Ekleyin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST" onsubmit="return false;" id="newdnsform">
                <div class="card-body">


                  <div class="form-group">
                    <label for="exampleInputEmail1">Web Site Domain</label>
                    <select name="sitename" class="form-control">
                        <option value="0">---Seçiniz---</option>
                        <?php 
                          if($website){
                          foreach($website as $site){ ?> 
                          <option value="<?php echo $site->sitekodu;?>"><?php echo $site->sitedomain;?></option>
                        <?php } 
                        
                          }?>  
                    </select>
                
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">DNS Type</label>
                    <input name="dnstype" type="text" class="form-control" id="exampleInputPassword1" placeholder="A, MX, SPF vb...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">DNS Name</label>
                    <input name="dnsname" type="text" class="form-control" id="exampleInputPassword1" placeholder="www, domain.com vb...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">DNS Ip</label>
                    <input name="dnsip" type="text" class="form-control" id="exampleInputPassword1" placeholder="DNS IP Adresi">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">DNS TTL</label>
                    <input name="dnsttl" type="number" class="form-control" id="exampleInputPassword1" placeholder="DNS TTL (min 60)">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">DNS Property</label>
                    <input name="dnsproperty" type="number" class="form-control" id="exampleInputPassword1" placeholder="DNS Property">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">DNS Proxy</label>
                    <select name="dnsproxystatus" class="form-control">
                      <option value="">---Seçiniz---</option>
                      <option value="true">Proxy Aktif</option>
                      <option value="false">Proxy Pasif</option>
                    </select>
                  </div>
                
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?php echo base_url("dns/list");?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                  <button onclick="newdnsbutton();" id="newdnsbuton" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Kaydet</button>
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
