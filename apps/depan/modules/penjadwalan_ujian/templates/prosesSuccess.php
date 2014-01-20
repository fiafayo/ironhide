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
$filename=dirname(__FILE__).'/../../../../../cache/isiRuangPerSlot.yml';
if (file_exists($filename) ) {
    $isiRuangPerSlot=  sfYaml::load($filename);
} else {
    $isiRuangPerSlot=array();
}

?>

<div class="container">
<?php include_partial('penjadwalan_ujian/tab_atas', array( )); ?> 
    
    <h3>Hasil Proses Penjadwalan Ujian</h3>
    <button class="btn btn-danger" onclick="document.location.href='<?php echo url_for('penjadwalan_ujian/laksanakanProses');?>';" >Laksanakan Proses</button>
    <button class="btn btn-warning" onclick="document.location.href='<?php echo url_for('penjadwalan_ujian/simpanCacheKeDb');?>';" >Simpan Hasil Proses ke DB</button>
    <button class="btn btn-success" onclick="document.location.href='<?php echo url_for('penjadwalan_ujian/isiNrpPerKp');?>';" >Isi NRP Awal dan Akhir</button>
    <div>&nbsp;</div>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Pengisian Mata Kuliah Ujian ke Ruangan</div>
<!--  <div class="panel-body">
    <p>...</p>
  </div>-->

  <!-- Table -->
  <table class="table">
      <thead>
          <tr>
              <th>Slot</th>
              <th>Ruang </th>
              <th>Kapasitas</th>
              <th>Isi</th>
              <th>Dosen</th>
              <th>Karyawan</th>
              <th>Mata Kuliah</th>
          </tr>
      </thead>
      <tbody>
          
<?php
$class='';
foreach( $isiRuangPerSlot as $slot=>$data ):
    if ($class=='') $class='class="warning" '; else $class='';
    foreach($isiRuangPerSlot[$slot] as $kodeRuang=>$row):
       if ( $isiRuangPerSlot[$slot][$kodeRuang]['isi']>0 ) :
?>
          <tr <?php echo $class;?>>
              <td><?php echo $slot;?></td>
              <td><?php echo $kodeRuang;?></td>
              <td><?php echo $row['kap'];?></td>
              <td><?php echo $row['isi'];?></td>
              
              <td><?php 
              $kodeDosen= $isiRuangPerSlot[$slot][$kodeRuang]['dos'];
              echo ($kodeDosen) ?  $kodeDosen :  '<span class="label label-danger">kosong</span>';
              echo (isset ($penjadwalan->dosenReffs[$kodeDosen]) ) ? '.'.$penjadwalan->dosenReffs[$kodeDosen] : '';
              $ket = ( isset($row['ket']) ) ? $row['ket'] : '';
              if ($ket=='P') {
                  echo '<span class="label label-success">'.$ket.'</span>';
              } else {
                  echo '<span class="label label-warning">'.$ket.'</span>';
              }
              ?></td>
              <td><?php 
              $kodeKaryawan= trim($isiRuangPerSlot[$slot][$kodeRuang]['kar']);
              echo ($kodeKaryawan) ? $kodeKaryawan :  '<span class="label label-danger">kosong</span>';
              echo (isset ($penjadwalan->karyawanReffs[$kodeKaryawan]) ) ? '.'.$penjadwalan->karyawanReffs[$kodeKaryawan] : '';
              ?></td>
              <td>
                  <?php
                  foreach ($row['mk'] as $kode=>$jml) {
                       $kodes=explode('_',$kode);
                       $kodeMk=$kodes[0];
                       $kp=$kodes[1];
                       $namaMk = ( isset($penjadwalan->mataKuliahReffs[$kodeMk]) ) ? $penjadwalan->mataKuliahReffs[$kodeMk] : '';
                       echo '<span class="label label-primary">'.$namaMk."($kodeMk)($kp)</span>".'<span class="badge badge-info">'.$jml."</span><br/>";
                  }
                   
                  ?>
              </td>
              
          </tr>
<?php
        endif;
    endforeach;
endforeach;
?>
      </tbody>
    
  </table>
</div>
    <div>&nbsp;</div>    
     
    
</div>