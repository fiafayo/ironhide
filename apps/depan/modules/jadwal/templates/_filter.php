<div class="sf_admin_filters">
<?php
  $selectedKodeJur=$sf_request->getParameter('jurusan_id','62-62');
  echo form_tag( url_for('jadwal/index'),array('method'=>'get'));
?>
<table class="sf_admin_list">
<TR><TH colspan="2">Jadwal Jurusan Lainnya</TH></TR>
<TR>
  <TD>Pilih Jurusan :</TD>
  <TD>
  <?php

    if ($jurusan) $kodeJur=$jurusan->getKodeJur(); else $kodeJur=$selectedKodeJur;
        $c=new Criteria();
        $c->addAscendingOrderByColumn(JurusanPeer::NAMA);
        $jurusans=JurusanPeer::doSelect($c);
        echo '<select name="jurusan_id" id="jurusan_id" onchanged="this.form.submit()" >';
        if (  isset( $_SESSION['admin_id'] )  && $_SESSION['admin_id'] ) {
            echo '<option value="ALL">Semua Jurusan</option>';
        }
$selected='';

        foreach ($jurusans as $jur)
        {
if ($selectedKodeJur==$jur->getKodeJur()) $selected=' selected="true"'; else $selected='';
           echo '<option '.$selected.' value="'. $jur->getKodeJur().'">'.$jur->getNama().'</option>';
        }
        echo '</select>';
        echo '<input type="submit" name="commit" value="Pilih" />';

        if (  isset( $_SESSION['admin_id'] )  && $_SESSION['admin_id'] ) {
            echo '<input type="submit" name="commit" value="Bikin Jadwal Tanpa Nama Dosen" />';
        }



  ?>
  </TD>
</TR>
</table>
<?php echo   '</form>'; ?>
</div>