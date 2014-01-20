<?php
$sf_response->addJavascript('jquery-1.10.2.min.js');
$sf_response->addJavascript('/js/bs3/js/bootstrap.min.js');
$sf_response->addJavascript('/js/fancybox/jquery.fancybox.js?v=2.0.6');

$sf_response->addStylesheet('/js/bs3/css/bootstrap.min.css');
$sf_response->addStylesheet('/js/bs3/css/bootstrap-theme.css');
$sf_response->addStylesheet('/js/fancybox/jquery.fancybox.css');
?>


<div class="container">
<?php include_partial('penjadwalan_ujian/tab_atas', array( )); ?> 
    
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Ruang Kelas Untuk Ujian</div>
<!--  <div class="panel-body">
    <p>...</p>
  </div>-->

  <!-- Table -->
  <table class="table">
      <thead>
          <tr>
              <th>Kode Ruang</th>
              <th>Jenis</th>
              <th>Prioritas</th>
              <th>Untuk Ujian</th>
              <th>Kapasitas</th>
               
              <th>Ubah</th>
          </tr>
      </thead>
      <tbody>
          
<?php
foreach( $penjadwalan->ruangKelass as $kode=>$data ):
    $kodeRuang = str_replace(' ', '_', $data['kode_ruang']);
    $kodeRuang = str_replace('.', '__', $kodeRuang);
?> 
          <tr>
              <td><?php echo $kodeRuang;?></td>
              <td id="jns_<?php echo $kodeRuang;?>"><?php echo $data['jenis'];?></td>
              <td id="pri_<?php echo $kodeRuang;?>"><?php echo $data['prioritas'];?></td>
              <td id="utk_<?php echo $kodeRuang;?>"><?php echo $data['untuk_ujian'];?></td>
              <td id="kap_<?php echo $kodeRuang;?>"><?php echo $data['kapasitas_ujian'];?></td>
              <td>
                   
                      <a class="fancybox" href="<?php  echo url_for('penjadwalan_ujian/ubahRuang?id='.$kodeRuang); ?>">
                          <span class="badge badge-primary">ubah</span>
                      </a>  
                  
                  <?php  
              
              ?>
              </td>
              
          </tr>
<?php
endforeach;
?>
      </tbody>
    
  </table>
</div>
    <div>&nbsp;</div>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Ruang LAB Untuk Ujian</div>
<!--  <div class="panel-body">
    <p>...</p>
  </div>-->

  <!-- Table -->
  <table class="table">
      <thead>
          <tr>
              <th>Kode Ruang</th>
              <th>Jenis</th>
              <th>Prioritas</th>
              <th>Untuk Ujian</th>
              <th>Kapasitas</th>
               
              <th>Ubah</th>
          </tr>
      </thead>
      <tbody>
          
<?php
foreach( $penjadwalan->ruangLabs as $kode=>$data ):
    $kodeRuang = str_replace(' ', '_', $data['kode_ruang']);
    $kodeRuang = str_replace('.', '__', $kodeRuang);
?> 
          <tr>
              <td><?php echo $kodeRuang;?></td>
              <td id="jns_<?php echo $kodeRuang;?>"><?php echo $data['jenis'];?></td>
              <td id="pri_<?php echo $kodeRuang;?>"><?php echo $data['prioritas'];?></td>
              <td id="utk_<?php echo $kodeRuang;?>"><?php echo $data['untuk_ujian'];?></td>
              <td id="kap_<?php echo $kodeRuang;?>"><?php echo $data['kapasitas_ujian'];?></td>
              <td>
                   
                      <a class="fancybox" href="<?php  echo url_for('penjadwalan_ujian/ubahRuang?id='.$kodeRuang); ?>">
                          <span class="badge badge-primary">ubah</span>
                      </a>  
                  
                  <?php  
              
              ?>
              </td>
              
          </tr>
<?php
endforeach;
?>
      </tbody>
    
  </table>
</div>    
</div>

<script type="text/javascript"> 
$(document).ready(function() {
	$(".fancybox").fancybox({
                type: "ajax",
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});

function simpanUbahRuang(kodeRuang) {
    $("#send").replaceWith("<div class='badge badge-warning'>sending...</div>");
				
    $.ajax({
            type: 'POST',
            url: '<?php echo url_for('penjadwalan_ujian/simpanUbahRuang');?>',
            data: $("#ubahRuangForm").serialize(),
            success: function(data) {
                    if(data == "true") {
                        
                            $('#jns_'+kodeRuang).html( $('#jenis').val() ) ;
                            $('#pri_'+kodeRuang).html( $('#prioritas').val() ) ;
                            $('#utk_'+kodeRuang).html( $('#untuk_ujian').val() ) ;
                            $('#kap_'+kodeRuang).html( $('#kapasitas_ujian').val() ) ;
                            $("#ubahRuangForm").fadeOut("fast", function(){
                                    $(this).before("<p><strong>Pengubahan data telah berhasil disimpan!</strong></p>");
                                    setTimeout("$.fancybox.close()", 1000);
                            });
                    } else {
                            $("#ubahRuangForm").fadeOut("fast", function(){
                                    $(this).before("<p><strong>Terjadi Kesalahan!</strong></p><p>"+data+"</p>");
                                    setTimeout("$.fancybox.close()", 2000);
                            });
                    }
            }
    });    
}

</script>

      
    
