<?php
 
?>
<form id="ubahRuangForm" class="form-horizontal" role="form">
    <div class="form-group"> 
        <label   class="col-md-4 control-label">Kode Ruang</label>
        <div class="col-md-5">
            <div class="form-control">
 <?php echo $ruang->getKodeRuang();?>
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <label for="prioritas"  class="col-md-4 control-label">Untuk Ujian</label>
        <div class="col-md-5">
            <div  >
                <input type="text"  class="form-control" name="untuk_ujian" id="untuk_ujian" value="<?php echo $ruang->getUntukUjian();?>" />
             
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <label for="kapasitas_ujian"  class="col-md-4 control-label">Kapasitas Ujian</label>
        <div class="col-md-5">
            
                <input class="form-control" type="text" name="kapasitas_ujian" id="kapasitas_ujian" value="<?php echo $ruang->getKapasitasUjian();?>" />
             
             
        </div>
    </div>
    <div class="form-group"> 
        <label for="prioritas"  class="col-md-4 control-label">Prioritas</label>
        <div class="col-md-5">
            <div  >
                <input type="text"  class="form-control" name="prioritas" id="prioritas" value="<?php echo $ruang->getPrioritas();?>" />
             
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="jenis" class="col-md-4 control-label">Jenis Ruang Ujian</label>
        <div class="col-md-5">
            <select class="form-control" id="jenis" name="jenis">
                <option value="KELAS">Kelas</option>
                <option value="LAB" <?php echo ($ruang->getJenis()=='LAB') ? 'selected="true"' : '';   ?>>Laboratorium</option>
            </select>
        </div>
    </div>
    <input type="button" name="action" value="Simpan"   class="btn btn-primary col-md-offset-4" onClick="simpanUbahRuang('<?php echo $ruang->getKodeRuang()?>')"/>
    <span id="send" style="color:red;">&nbsp;</span>
    <input type="hidden" name="id" value="<?php echo $ruang->getKodeRuang();?>" />
     
    
</form> 