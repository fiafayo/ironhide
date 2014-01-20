<?php
use_helper('Url');

?>
<style type="text/css" media="screen">
.sf_admin_row_1 {
   background-color: #ccc;
   border-bottom: 3px inset ;
}
</style>
<div id="sf_admin_container">
    <h2>Perubahan Jadwal Jaga Ujian</h2>
    <form action="/jadwal_ujian/updateRuang" method="POST" >
       <!-- <input type="hidden" name="module" value="jadwal_ujian" />
        <input type="hidden" name="action" value="updateRuang" /> -->
        <input type="hidden" name="id" value="<?php echo $jadwal->getId();?>" />
        <input type="hidden" name="mk" value="<?php echo $jadwalMk->getKodeKelas();?>" />
        <input type="hidden" name="kp" value="<?php echo $jadwalMk->getKp();?>" />
        <table border="0" cellspacing="0" cellpadding="4" class="sf_admin_list" >
            <tr>
                <th class="sf_admin_row_1" style="text-align:right">Minggu ke- :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php echo $jadwal->getMinggu();?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Hari ke- :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php echo $jadwal->getHari();?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Jam ke- :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php echo $jadwal->getJam();?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Mata kuliah :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php echo $jadwalMk->getKodeKelas();?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">KP :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php echo $jadwalMk->getKp();?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Ruang :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php 
                    echo $jadwal->getKodeRuang();
                    if ( isset( $ruangUjians[$jadwal->getKodeRuang()] ) ) echo ' ('.$ruangUjians[$jadwal->getKodeRuang()].')';
                ?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Jumlah Mahasiswa :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php echo $jadwalMk->getKapasitas();?></td>
            </tr>
            <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Diubah Menjadi Ruang :</th>
                <td class="sf_admin_row_1" colspan="3" ><select name="kode_ruang" id="jadwal_kode_ruang">
                        
                      <?php 
foreach ($ruangUjians as $kode=>$jenis)
{
    echo '<option value="'.$kode.'">',$kode.' ('.$jenis.')</option>';
}
                ?></select></td>
            </tr>
            
        </table>
        <input type="submit" name="commit" value="Simpan" />
    </form>
</div>