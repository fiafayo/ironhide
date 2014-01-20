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
  <div class="panel-heading">Jadwal Ujian</div>
<!--  <div class="panel-body">
    <p>...</p>
  </div>-->

  <!-- Table -->
  
  <table class="table">
      <thead>
          <tr>
              <th>Minggu</th>
              <th>Hari</th>
              <th>Jam</th>
              <th>Kode</th>
              <th>Mata Kuliah</th>
              <th>Jenis Ruang</th>
              <th>Jenis Ujian</th>              
              <th>Pilih Ruang</th>              
              <th>Ubah</th>
          </tr>
      </thead>
      <tbody>
          
<?php
$dayNames=array( 1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu' );
$romawiNames = array(1=>'I','II','III','IV');
$minggu=0; $hari=0; 
$mingguIni=0; $hariIni=0; $jamIni=0;
foreach ( $penjadwalan->ujianSlots as $slot  ) :    
    PenjadwalanUjian::kodeSlotKeMinggu($slot, $mingguIni, $hariIni, $jamIni);
    if (( $hariIni>0 ) && ($hariIni<6)) {
        $n=count( $penjadwalan->mkUjians[$slot] );
        if ($n>0) :
            foreach ($penjadwalan->mkUjians[$slot] as $kodeMk=>$data) :
            
            ?>
          <tr>
              <td><?php echo $mingguIni?></td>
              <td><?php echo $dayNames[$hariIni];?></td>
              <td><?php echo $romawiNames[$jamIni];?></td>
              <td><?php echo $kodeMk; ?></td>
              <td><?php 
               $mkName = isset( $penjadwalan->mataKuliahReffs[$kodeMk] ) ? $penjadwalan->mataKuliahReffs[$kodeMk] : '&nbsp;';
              echo $mkName; ?></td>
              <td><span id="rua_<?php echo $data['id']?>"><?php echo $data['rua']?></span></td>
              <td><span id="uji_<?php echo $data['id']?>"><?php echo $data['uji']?></span></td>
              <td><span id="prio_<?php echo $data['id']?>"><?php echo $data['prio']?></span></td>
              <td> 
                  <a class="fancybox" href="<?php echo url_for('penjadwalan_ujian/ubahJadwal?id='.$kodeMk);?>" ><span class="badge badge-primary">ubah</span></a>
              </td>
              
          </tr>
          <?php
            endforeach;
        endif;
             
 
    }
    
    
?>
          
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

function simpanUbahJadwal(kodeUjian) {
    $("#send").replaceWith("<div class='badge badge-warning'>sending...</div>");
				
    $.ajax({
            type: 'POST',
            url: '<?php echo url_for('penjadwalan_ujian/simpanUbahJadwal');?>',
            data: $("#ubahJadwalForm").serialize(),
            success: function(data) {
                    if(data == "true") {
                        
                            $('#rua_'+kodeUjian).replaceWith( $('#jenisRuang').val() ) ;
                            $('#uji_'+kodeUjian).replaceWith( $('#jenisUjian').val() ) ;
                            $("#ubahJadwalForm").fadeOut("fast", function(){
                                    $(this).before("<p><strong>Pengubahan data telah berhasil disimpan!</strong></p>");
                                    setTimeout("$.fancybox.close()", 1000);
                            });
                    }
            }
    });    
}

</script>

 