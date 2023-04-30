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
            <h1>DNS Listesi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">DNS Listesi</li>
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
        <h3 class="card-title">DNS Listesi (<?php echo $dnscount;?>)</h3>
        </div>
       
                <div class="card-body">

                <?php if($dnscount){ ?>

                  
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          
                          <th>DNS TİPİ</th>
                          <th>DNS ADI</th>
                          <th>DNS İÇERİK</th>
                          <th>DNS TTL</th>
                          <th>DNS PROXY</th>
                          <th>DNS DOMAİN</th>
                          <th>TARİH</th>
                          <th>PROXY</th>
                          <th>DURUM</th>
                          <th>İŞLEMLER</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach($dnslist as $web){ ?>
                          <tr>
                            <td>#<?php echo $web->type;?></td>
                            <td><?php echo $web->name;?></td>
                            <td><?php echo $web->content;?></td>
                            <td><?php echo $web->ttl;?></td>
                            <td><?php echo $web->proxied;?></td>
                            <td><?php echo $web->dnsdomain;?></td>
                            <td><?php echo sdate($web->dnstarih);?></td>
                            <td><span class="badge bg-<?php echo $web->proxied == "true" ? 'success' : 'info';?>"><?php echo $web->proxied == "true" ? 'Proxy Aktif' : 'Proxy Pasif';?></span></td>
                            <td><span class="badge bg-<?php echo $web->dnsdurum == 1 ? 'success' : 'danger';?>"><?php echo $web->dnsdurum == 1 ? 'Aktif' : 'Pasif';?></span></td>
                            <td><a href="<?php echo base_url("dns/delete/".$web->dnsid); ?>"><i class="fa fa-eraser"></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>

                    <?php }else{
                      alert("Kayıt bulunmuyor","danger");
                    } ?>

                </div>

                <div class="card-footer clearfix">
                  <?php echo $dnslinks;?>
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