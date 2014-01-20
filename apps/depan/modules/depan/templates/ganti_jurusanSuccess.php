<div id="sf_admin_container">
<?php echo form_tag('depan/ganti_jurusan'); ?>
<table border="0" class="sf_admin_list">
<TR><TD>Nrp : </TD>
<TD><?php $nrp=$sf_request->getParameter('nrp'); echo '<input type="text" name="nrp" value="'.$nrp.'" />';?></TD>
</TR>
<TR><TD>Jurusan yang baru : </TD>
<TD><?php
$c=new Criteria;
$c->add(JurusanPeer::KODE_JUR,'62%',Criteria::LIKE);
$jurusans=JurusanPeer::doSelect($c);
echo '<select name="kode_jur">';
foreach ($jurusans as $jur)
{
   echo '<option value="'.$jur->getKodeJur().'">'.$jur->getNama().'</option>';

}
echo '</select>';
 
?></TD>
</TR>
<TR><TD colspan="2"><input type="submit">
 
</TD></TR>
</table>

</form>
</div>