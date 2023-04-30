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
            <h1>Web Site Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">Web Site Listesi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        <!-- /.row -->
        <div class="row">

        <div class="col-md-12">
        <div class="card">

        <div class="card-header">
        <h3 class="card-title">Web Site Listesi (<?php echo $websitecount;?>)</h3>
        </div>
    
                <div class="card-body">


                <?php if($websitecount){ ?>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          
                          <th>KOD</th>
                          <th>SİTE ADI</th>
                          <th>SİTE DOMAİN</th>
                          <th>TARİH</th>
                          <th>DURUM</th>
                          <th>İŞLEMLER</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach($websitelist as $web){ ?>
                          <tr>
                            <td>#<?php echo $web->sitekodu;?></td>
                            <td><?php echo $web->siteadi;?></td>
                            <td><?php echo $web->sitedomain;?></td>
                            <td><?php echo sdate($web->sitetarih);?></td>
                            <td><span class="badge bg-<?php echo $web->durum == 1 ? 'success' : 'danger';?>"><?php echo $web->durum == 1 ? 'Aktif' : 'Pasif';?></span></td>
                            <td><a href="<?php echo base_url("website/editform/".$web->sitekodu); ?>"><i class="fa fa-edit"></i></a> | <a href="<?php echo base_url("website/dnslist/".$web->sitekodu); ?>"><i class="fa fa-list"></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                    
                    <?php }else{
                    alert("Kayıt bulunmuyor","danger");
                  } ?>


                </div>

                <div class="card-footer clearfix">
                  <?php echo $websitelinks;?>
                </div>


            



        </div>

       

        </div>
        
        </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php $this->load->view('inc/footer_view');?>


  <?php if($websitelinks){ ?>
<script>



$(function() {
$('.pagination').find('a').addClass('page-link');
});

// Saf JavaScript kullanarak
window.addEventListener('load', function() {
var pagination = document.querySelector('.pagination');
var links = pagination.querySelectorAll('a');
for (var i = 0; i < links.length; i++) {
    links[i].classList.add('page-link');
}
});
</script>
<?php } ?>