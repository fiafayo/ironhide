<?php
$sf_response->addJavascript('jquery-1.10.2.min.js');
$sf_response->addJavascript('/js/bs3/js/bootstrap.min.js');
$sf_response->addStylesheet('/js/bs3/css/bootstrap.min.css');
$sf_response->addStylesheet('/js/bs3/css/bootstrap-theme.css');

$filename=dirname(__FILE__).'/../../../../../cache/mkUjians.yml';
if (file_exists($filename) ) {
    $mkUjians=  sfYaml::load($filename);
} else {
    $mkUjians=array();
} 
?>

<div class="container">
<?php include_partial('penjadwalan_ujian/tab_atas', array( )); ?> 
    
    <h3>Hasil Proses Penjadwalan Ujian</h3>
     
    <div>&nbsp;</div>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Mata Kuliah Ujian di Ruangan</div>
<!--  <div class="panel-body">
    <p>...</p>
  </div>-->

  <!-- Table -->
  <table class="table">
      <thead>
          <tr>
              <th>Slot</th>
              <th>Kode </th>
              <th>Nama Mata Kuliah</th>
              <th>Jenis</th>
              <th>Jenis Ujian</th>               
              <th>KP</th>
          </tr>
      </thead>
      <tbody>
          
<?php
$class='';
$slots=array_keys($mkUjians);
foreach( $slots as $slot  ):
    $kodeMks=array_keys($mkUjians[$slot]);

    if ($class=='') $class='class="warning" '; else $class='';
    foreach ($kodeMks as $kodeMk) :
        $namaMk = ( isset( $penjadwalan->mataKuliahReffs[$kodeMk] ) ) ? $penjadwalan->mataKuliahReffs[$kodeMk] : '';
?>
          <tr <?php echo $class;?> >
              <td><?php echo $slot;?></td>
              <td><?php echo $kodeMk;?></td>
              <td><?php echo $namaMk;?></td>
              <td><?php echo $mkUjians[$slot][$kodeMk]['rua'];?></td>
              <td><?php echo $mkUjians[$slot][$kodeMk]['uji'];?></td>
              <td>
                  <?php
                  foreach ($mkUjians[$slot][$kodeMk]['isi'] as $kp=>$isi) {
                      echo "<span class='label label-success'>$kp</span> <span class='badge'>$isi</span><br/>";
                  }
                  ?>
              </td>
              
          </tr>
<?php          
    endforeach;
endforeach;
?>
      </tbody>
    
  </table>
</div>
    <div>&nbsp;</div>    
 
</div>