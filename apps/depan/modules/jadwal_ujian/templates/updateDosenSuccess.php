<style type="text/css" media="screen">
.sf_admin_row_1 {
   background-color: #ccc;
   border-bottom: 3px inset ;
}
</style>
<div id="sf_admin_container">
    <h2>Perubahan Jadwal Jaga Ujian</h2>
    <form action="/index.php/jadwal_ujian/updateDosen" method="POST" >
        <input type="hidden" name="id" value="<?php echo $jadwal->getId();?>" />
         
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
                <th class="sf_admin_row_1"  style="text-align:right">Ruang :</th>
                <td class="sf_admin_row_1" colspan="3" ><?php
                    echo $jadwal->getKodeRuang();
                    echo ' ('.$ruang->getJenis().', terisi '.$isi.'/'.$ruang->getKapasitas().')';
                ?></td>
            </tr>
             <tr>
                <th class="sf_admin_row_1"  style="text-align:right">Dosen Pengawas :</th>
                <td class="sf_admin_row_1"  ><?php
                    $kodeDosen=intval($jadwal->getKodeDosen());
                    if ( $kodeDosen>0 )
                    {
                        echo $jadwal->getKodeDosen().'. '. $dosenNames[$jadwal->getKodeDosen()];
                    } else {
                        echo 'Belum ditentukan';
                    }
                ?></td>
                <td class="sf_admin_row_1"><select name="dos" >
                    <?php
                foreach ($dosenNames as $kodeDosen=>$namaDosen)
                {
                    $selected='';
                    if ( $kodeDosen==$sf_request->getParameter('dos') ) $selected=' selected="true" ';
                    echo '<option value="'.$kodeDosen.'" '.$selected.'>'.$namaDosen.'</option>';
                }
                ?></select></td><td class="sf_admin_row_1"><input type="submit" name="commit" value="Simpan"></td>
            </tr>

        </table>

    </form>
</div>