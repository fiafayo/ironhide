<?php
$sf_response->addJavascript('jquery-1.10.2.min.js');
$sf_response->addJavascript('/js/bs3/js/bootstrap.min.js');
$sf_response->addStylesheet('/js/bs3/css/bootstrap.min.css');
$sf_response->addStylesheet('/js/bs3/css/bootstrap-theme.css');

$filename=dirname(__FILE__).'/../../../../../cache/daftarKaryawanJaga.yml';
if (file_exists($filename) ) {
    $daftarKaryawanJaga=  sfYaml::load($filename);
} else {
    $daftarKaryawanJaga=array();
}
ksort($daftarKaryawanJaga);
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
     
    <div>&nbsp;</div>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Daftar Karyawan Jaga</div>
<!--  <div class="panel-body">
    <p>...</p>
  </div>-->

  <!-- Table -->
  <table class="table">
      <thead>
          <tr>
              <th>Kode </th>
              <th>Nama </th>
              <th>Minggu</th>
              <th>Hari</th>
              <th>Jam</th>
              <th>Ruang</th>
              <th>Mata Kuliah</th>              
          </tr>
      </thead>
      <tbody>
          
<?php
$class='';
$kodeKars=array_keys($daftarKaryawanJaga);
foreach( $kodeKars as $kodeKar  ):
    $slots=$daftarKaryawanJaga[$kodeKar];
    $namaKar = ( isset( $penjadwalan->karyawanReffs[$kodeKar] ) ) ? $penjadwalan->karyawanReffs[$kodeKar] : '';

    if ($class=='') $class='class="warning" '; else $class='';
    foreach ($slots as $slot) :
        
         
?>
          <tr <?php echo $class;?> >
              <td><?php echo $kodeKar;?></td>
              <td><?php echo $namaKar;?></td>
               
              <?php 
              echo slot2TableCell($slot); 
              $data=  getRuangBySlot($isiRuangPerSlot,$slot, $kodeKar, false);
              if ( $data && isset($data['kodeRuang']) ) {
                    echo '<td>'.$data['kodeRuang'].'</td>';
                    echo '<td>';
                    $kodeKelass=array_keys($data['mk']);
                    foreach ($kodeKelass as $kodeKelas) {
                        $kodes=explode('_',$kodeKelas);
                        $kodeMk=$kodes[0];
                        $kp=$kodes[1];
                        $isi=$data['mk'][$kodeKelas];
                        $namaMk = ( isset( $penjadwalan->mataKuliahReffs[$kodeMk] ) ) ? '.'.$penjadwalan->mataKuliahReffs[$kodeMk] : '';
                        echo '<span class="label label-info">'.$kodeMk.$namaMk.'</span><span class="badge">'.$kp.'</span><span class="badge">'.$isi.'</span><br/>';

                    }
                    echo '</td>';
              } else {
                  echo '<td>&nbsp;</td><td>&nbsp;</td>';
              }
              ?>
 
              
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

<?php
function slot2TableCell($slot) {
    $dayNames = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
    $romawiNames = array(1=>'I','II','III','IV');    
    $minggu = substr($slot,0,1);
    $hari   = substr($slot,1,1);
    $jam = substr($slot, 2, 1);
    return '<td>'.$romawiNames[$minggu].'</td>'.'<td>'.$dayNames[$hari].'</td>'.'<td>'.$romawiNames[$jam].'</td>';
}

function getRuangBySlot($isiRuangPerSlot,$slot,$kodeKar,$isDosen=false) {
     
    $result=array('kodeRuang'=>null, 'mk'=>array());
    $kodeRuangs = array_keys( $isiRuangPerSlot[$slot] );
    $isKetemu = false;
    foreach( $kodeRuangs as $kodeRuang ) {
        if ($isDosen) {
          $kode = $isiRuangPerSlot[$slot][$kodeRuang]['dos'];
        } else {
          $kode = $isiRuangPerSlot[$slot][$kodeRuang]['kar'];
        }
        if ($kodeKar==$kode) {
            $isKetemu=true;
            $result['kodeRuang']=$kodeRuang;
            $mk=$isiRuangPerSlot[$slot][$kodeRuang]['mk'];
            $result['mk']=$mk;
             
            break;
        }
    }
    if (!$isKetemu) {
        return false;
    }
    return $result;
}
?>