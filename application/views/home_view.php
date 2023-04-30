<?php $this->load->view('inc/header_view');?>

  <!-- Main Sidebar Container -->
  <?php $this->load->view('inc/menu_view');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BCYSoftware Panel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">BCYSoftware Panel</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo count($websites);?></h3>

                <p>Web Siteler</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('website/list');?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count($dnslist);?></h3>

                <p>DNS Kayıtları</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('dns/list');?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Son Eklenen 20 Web Site
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">

                  <?php if($websites){ ?>
                  <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>KOD</th>
                            <th>ADI</th>
                            <th>DOMAİN</th>
                            <th>TARİH</th>
                            <th>DURUM</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($websites as $web){ ?>
                            <tr>
                              <td><?php echo $web->sitekodu;?></td>
                              <td><?php echo $web->siteadi;?></td>
                              <td><?php echo $web->sitedomain;?></td>
                              <td><?php echo sdate($web->sitetarih);?></td>
                              <td><?php echo $web->durum;?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                  </div>
                  <?php }else{
                    alert("Kayıt bulunmuyor","danger");
                  } ?>

              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          
          </section>


          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Son Eklenen 20 DNS Kayıdı
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">

              <?php if($dnslist){ ?>
                  <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>TİPİ</th>
                            <th>ADI</th>
                            <th>İÇERİK</th>
                            <th>TARİH</th>
                            <th>DURUM</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($dnslist as $dns){ ?>
                            <tr>
                              <td><?php echo $dns->type;?></td>
                              <td><?php echo $dns->name;?></td>
                              <td><?php echo $dns->content;?></td>
                              <td><?php echo sdate($dns->dnstarih);?></td>
                              <td><?php echo $dns->dnsdurum == 1 ? 'Aktif' : 'Pasif';?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                  </div>
                  <?php }else{
                    alert("Kayıt bulunmuyor","danger");
                  } ?>
                
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          
          </section>
       

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 

  <?php $this->load->view('inc/footer_view');?>