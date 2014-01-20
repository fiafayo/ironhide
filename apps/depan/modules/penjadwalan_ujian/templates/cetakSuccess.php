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
   
  <div class="panel-heading">Cetak Tagihan Soal</div>
  <div class="panel-body">
      <form class="form-horizontal" role="form" name="cetakTagihanSoalForm" target="_blank" action="<?php echo url_for('penjadwalan_ujian/cetakTagihanSoal');?>" > 
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Tanggal awal Ujian</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[tanggal]" id="tanggal" value="2014-01-06" />
            </div>
          </div>
          <div class="form-group">
            <label for="noSurat" class="col-md-4 control-label">Angka Nomor Surat</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[noSurat]" id="noSurat" value="0902" />
            </div>
          </div> 
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Perihal</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[halSurat]" id="halSurat" value="Jadwal UAS Gasal 2013/2014" />
            </div>
          </div>
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Kuliah I berakhir</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[kuliah1]" id="kuliah1" value="20 Desember 2013" />
            </div>
          </div>
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Kuliah II mulai</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[kuliah2]" id="kuliah2" value="4 Nopember 2013" />
            </div>
          </div>
          <div class="form-group">
            <label for="kodeDosen" class="col-md-4 control-label">Nama Dosen</label>
            <div class="col-md-8">
            <select name="kodeDosen" class="form-control ">
                <option value="ALL"> -- cetak semua dosen -- </option>
                <?php 
                $kodeDosens = array_keys($penjadwalan->daftarKelasDosen);
                foreach ($kodeDosens as $kodeDosen) {
                    $namaDosen = ( isset( $penjadwalan->dosenReffs[$kodeDosen] ) ) ? trim($penjadwalan->dosenReffs[$kodeDosen]) : false;
                    if ($namaDosen) {
                        echo '<option value="'.$kodeDosen.'">'.$kodeDosen.'.'.$namaDosen.'</option>';
                    }
                }
                ?>
            </select>     
            </div>
          </div>
          <div class="form-group ">          
            <button type="submit" class="btn btn-default" name="cetak" value="cetak">Cetak</button>  
             
          </div>
    </form>
  </div> 
 
</div>
    <div>&nbsp;</div>    
    
<div class="panel panel-info">
   
  <div class="panel-heading">Cetak Jadwal Ujian</div>
  <div class="panel-body">
      <form class="form-horizontal" role="form" name="cetakJadwalUjianForm" target="_blank" action="<?php echo url_for('penjadwalan_ujian/cetakLaporan');?>" > 
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Tanggal awal Ujian</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[tanggal]" id="tanggal" value="2014-01-06" />
            </div>
          </div>
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Judul</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[judul]" id="halSurat" value="Ujian Akhir Semester Gasal 2013/2014" />
            </div>
          </div>
          <div class="form-group">
            <label for="cache" class="col-md-4 control-label">Generate Ulang</label>
            <div class="col-md-8">
                <input type="checkbox" class="checkbox" name="cache" id="cache" value="0" checked="true" />
            </div>
          </div>

          <div class="btn-group ">          
              <button type="submit" class="btn btn-default" name="cetak" value="jadwal_mhs">Jadwal Mahasiswa</button> 
              <button type="submit" class="btn btn-default" name="cetak" value="jadwal_pengawas">Jadwal Pengawas</button>
              <button type="submit" class="btn btn-default" name="cetak" value="jadwal_jaga_dosen">Jadwal Per Dosen</button>
              <button type="submit" class="btn btn-default" name="cetak" value="jadwal_jaga_karyawan">Jadwal Per Karyawan</button>            
          </div>
          <div class="btn-group ">          
              <button type="submit" class="btn btn-default" name="cetak" value="absensi_penjaga">Absensi Petugas Jaga</button> 
              <button type="submit" class="btn btn-default" name="cetak" value="serah_soal">Penyerahan Soal</button>
              <button type="submit" class="btn btn-default" name="cetak" value="berita_acara">Berita Acara Ujian</button>
          </div>
    </form>
  </div> 
 
</div>
    <div>&nbsp;</div>     
       
<div class="panel panel-info">
   
  <div class="panel-heading">Cetak Pengantar Berkas Ujian</div>
  <div class="panel-body">
      <form class="form-horizontal" role="form" name="cetakPengantarBerkasForm" target="_blank" action="<?php echo url_for('penjadwalan_ujian/cetakPengantarBerkasUjian');?>" > 
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Tanggal Surat</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[tanggal]" id="tanggal" value="2013-10-2" />
            </div>
          </div>
          <div class="form-group">
            <label for="noSurat" class="col-md-4 control-label">Angka Nomor Surat</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[noSurat]" id="noSurat" value="0903" />
            </div>
          </div> 
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Perihal</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[halSurat]" id="halSurat" value="Pengantar Berkas UAS Gasal 2013/2014" />
            </div>
          </div>
          <div class="form-group">
            <label for="ujian" class="col-md-4 control-label">Ujian</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[ujian]" id="ujian" value="Ujian Akhir Semester Gasal 2013/2014" />
            </div>
          </div>
          <div class="form-group">
              <label for="deadline" class="col-md-4 control-label">Tanggal berakhir</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[deadline]" id="kuliah1" value="29 Nopember 2013" />
            </div>
          </div>
          <div class="form-group">
            <label for="tanggalAwal" class="col-md-4 control-label">Tanggal awal Ujian</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[tanggalAwal]" id="tanggal" value="2014-01-06" />
            </div>
          </div>
          <div class="form-group">
            <label for="tanggalAwal" class="col-md-4 control-label">Nama Sekretaris Panitia</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="surat[wd]" id="tanggal" value="Dr. Hudiyo Firmanto" />
            </div>
          </div>
           
          <div class="form-group">
            <label for="kodeMk" class="col-md-4 control-label">Mata Kuliah</label>
            <div class="col-md-8">
            <select name="kodeMk" class="form-control ">
                <option value="ALL"> -- cetak semua mata kuliah -- </option>
                <?php 
                $kodeMks = array_keys($penjadwalan->mataKuliahReffs);
                foreach($kodeMks as $kodeMk) {
                    echo "<option value='$kodeMk'>".$penjadwalan->mataKuliahReffs[$kodeMk]."</option>";
                }
                ?>
            </select>     
            </div>
          </div>
          <div class="form-group ">          
            <button type="submit" class="btn btn-default" name="cetak" value="cetak">Cetak</button>  
             
          </div>
    </form>
  </div> 
 
</div>
    <div>&nbsp;</div>  
    
    
<div class="panel panel-info">
   
  <div class="panel-heading">Cetak CSV Ke Sistem Siska</div>
  <div class="panel-body">
      <form class="form-horizontal" role="form" name="exportSiska" target="_blank" action="<?php echo url_for('penjadwalan_ujian/exportSiska');?>" > 
 
          <div class="form-group">
            <label for="halSurat" class="col-md-4 control-label">Tanggal Awal</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="tanggal" id="tanggal" value="2014-01-06" />
            </div>
          </div>
          <div class="form-group">
            <label for="ujian" class="col-md-4 control-label">Ujian</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="jenis" id="ujian" value="UAS" />
            </div>
          </div>
           
          <div class="form-group ">          
            <button type="submit" class="btn btn-default" name="format" value="BeritaAcara">Berita Acara</button>  
            <button type="submit" class="btn btn-default" name="format" value="BeritaAcaraPengawas">B.A Pengawas</button>  
            <button type="submit" class="btn btn-default" name="format" value="BeritaAcaraDosen">B.A. Dosen</button>  
             
          </div>
    </form>
  </div> 
 
</div>
    <div>&nbsp;</div>      
</div>