<?php
$dayNames = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'); 
?>
<form id="ubahJadwalForm" class="form-horizontal" role="form">
    <div class="form-group"> 
        <label   class="col-md-4 control-label">Waktu Ujian</label>
        <div class="col-md-5">
            <div class="form-control">
            
            Hari <?php echo $dayNames[$jadwal->getHari()];?>,
            Minggu ke-<?php echo $jadwal->getMinggu()?>, 
            Jam ke-<?php echo $jadwal->getJam()?>
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <label   class="col-md-4 control-label">Mata Kuliah</label>
        <div class="col-md-8">
            <div class="form-control">
            
             <?php echo $kodeMk;?>.
             
            <?php echo $matkul->getNama()?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="jenisUjian" class="col-md-4 control-label">Jenis Ujian</label>
        <div class="col-md-5">
            <select class="form-control" id="jenisUjian" name="jenisUjian">
                <option value="ADA"  >Ada ujian tertulis</option>
                <option value="TGS" <?php echo ($jadwal->getJenisUjian()=='TGS') ? 'selected="true"' : '';   ?> >Hanya mengumpulkan tugas</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="jenisRuang" class="col-md-4 control-label">Jenis Ruang Ujian</label>
        <div class="col-md-5">
            <select class="form-control" id="jenisRuang" name="jenisRuang">
                <option value="KELAS">Kelas</option>
                <option value="LAB" <?php echo ($jadwal->getJenisRuang()=='LAB') ? 'selected="true"' : '';   ?>>Laboratorium</option>
            </select>
        </div>
    </div>
    <input type="button" name="action" value="Simpan"   class="btn btn-primary col-md-offset-4" onClick="simpanUbahJadwal('<?php echo $jadwal->getKodeUjian()?>')"/>
    <span id="send" style="color:red;">&nbsp;</span>
    <input type="hidden" name="kodeMk" value="<?php echo $kodeMk;?>" />
    <input type="hidden" name="kodeUjian" value="<?php echo $jadwal->getKodeUjian();?>" />
    
</form> 