<div id="sf_admin_container">
  <h1>Konversi Mata Kuliah</h1>






  <div id="sf_admin_bar">

<div class="sf_admin_filter">

    <form action="<?php echo url_for('konversi/filter')?>" method="post">
    <table cellspacing="0">
        <tr>
            <td>Jurusan</td>
            <td>
                <select name="kode_jur">
                    <?php
                    $jurusanTerpilih=$sf_user->getAttribute('kode_jur',null,'konversi_mk');
                    foreach (JurusanPeer::$jurusanNames as $jId=>$jNama) {
                        if ($jurusanTerpilih == $jId) {
                            $selected='selected="true" ';
                        } else {
                            $selected='';
                        }
                        echo '<option '.$selected.' value="'.$jId.'">'.$jNama.'</option>';
                    }
                    
                    ?>
                    
                </select>
            </td>
        </tr>
        <tr>
            <td>Kurikulum</td>
            <td>
                <select name="tahun">
                    c

<?php
//$c=new Criteria();
//$c->clearSelectColumns();
//$c->addSelectColumn(KonversiMkPeer::TAHUN);
//$c->setDistinct();
//$c->addAscendingOrderByColumn(KonversiMkPeer::TAHUN);
//$rs=KonversiMkPeer::doSelectStmt($c);
////$tahuns=array();
//while ($rs->nextRowset()) {
//    $tahun=$rs->getAttribute('TAHUN');
//    echo '<option value="'.$tahun.'">'.$tahun.'</option>';
//}
$tahuns=array(
    '2005'=>'2005',
    '2010'=>'2010'
);
$tahunTerpilih=$sf_user->getAttribute('tahun',null,'konversi_mk');
foreach ($tahuns as $tId=>$tNama) {
    if ($tahunTerpilih==$tId) {
        $selected=' selected="true" ';
    } else {
        $selected='';
    }
    echo '<option '.$selected.' value="'.$tId.'">'.$tNama.'</option>';
}

?>


                </select>
            </td>
        </tr>
     

    </table>
        <input type="submit" name="commit" value="Tampilkan" />
        <input type="submit" name="commit" value="Jalankan Proses Konversi" />

  </form>
</div>
  </div>
  <table class="sf_admin_list" border="1">
      <thead>
          <tr>
              <th>Jurusan</th>
              <th>Kurikulum</th>
              <th colspan="2">Mata Kuliah Asal</th>
              <th colspan="2">Mata Kuliah Konversi</th>
              <th>Jenis Konversi</th>
          </tr>
      </thead>
      <tbody>
<?php
$genap=0;
foreach ($konversis as $konversi) {
    if ($genap)  $genap=0; else $genap=1;

?>
          <tr class="sf_admin_row_<?php echo $genap?>">
              <td><?php echo $konversi->getKodeJur();?></td>
              <td><?php echo $konversi->getTahun();?></td>
              <td><?php echo $konversi->getMkLama();?></td>
              <td><?php echo isset( $mkNames[$konversi->getMkLama()] ) ? $mkNames[$konversi->getMkLama()] : '-'  ;?></td>
              <td><?php echo $konversi->getMkBaru();?></td>
              <td><?php echo isset( $mkNames[$konversi->getMkBaru()] ) ? $mkNames[$konversi->getMkBaru()] : '-'  ;?></td>
              <td><?php echo $konversi->getJenisKonversi();?></td>

          </tr>
<?php
}
?>
      </tbody>

  </table>

</div>