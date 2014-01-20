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
    
    <h3>Cetak Jadwal Ujian</h3>
     
    <div>&nbsp;</div>
    <div class="panel panel-info">

      <div class="panel-heading">Monitor Plot Ruang</div>
      <div class="panel-body">
          <div  style="height: 200px; overflow-y: scroll">
              <pre id="monitor_plot_ruang" ></pre>
          </div>
      </div> 

    </div>
    <div>&nbsp;</div>    
    <div class="panel panel-info">

      <div class="panel-heading">Monitor Plot Karyawan</div>
      <div class="panel-body">
          <div  style="height: 200px; overflow-y: scroll">
              <pre id="monitor_plot_karyawan" ></pre>
          </div>
      </div> 

    </div>
    <div>&nbsp;</div>    
    <div class="panel panel-info">

      <div class="panel-heading">Debug Plot Ruang</div>
      <div class="panel-body">
          <div  style="height: 200px; overflow-y: scroll">
              <pre id="debug_plot_ruang" ></pre>
          </div>
      </div> 

    </div>
    <div>&nbsp;</div>    
        
</div>

<script type="text/javascript" >
$('#monitor_plot_karyawan').load("/uploads/plot_karyawan.log");    
$('#monitor_plot_ruang').load("/uploads/plot_ruang.log");    
$('#debug_plot_ruang').load("/uploads/hitungIsiKelasPerSlot.log");    
</script>