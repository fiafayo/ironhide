<div class="sf_admin_filters">
<?php
  $selectedKodeJur=$sf_request->getParameter('jurusan_id');
  echo form_tag('http://'.$_SERVER['HTTP_HOST'].'/index.php/jadwal_ujian',array('method'=>'get'));
?>
<table class="sf_admin_list">
<TR><TH colspan="2">Jadwal Jurusan Lainnya</TH></TR>
<TR>
  <TD>Pilih Jurusan :</TD>
  <TD>
  <?php
    if (isset($jurusan) && $jurusan) $kodeJur=$jurusan->getKodeJur(); else $kodeJur=$sf_request->getParameter('jurusan_id');
        $c=new Criteria();
        $c->addAscendingOrderByColumn(JurusanPeer::NAMA);
        $jurusans=JurusanPeer::doSelect($c);
        echo '<select name="jurusan_id" id="jurusan_id" >';

        foreach ($jurusans as $jur)
        {
if ($selectedKodeJur==$jur->getKodeJur()) $selected=' selected="true"'; else $selected='';
           echo '<option '.$selected.' value="'. $jur->getKodeJur().'">'.$jur->getNama().'</option>';
        }
        echo '</select>';
        echo '<input type="submit" name="Commit" value="Pilih" />';

  ?>
  </TD>
</TR>
</table>
  </form>
</div>
