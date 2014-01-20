<div id="sf_admin_container">
<?php use_helper('Form','Object','Javascript'); echo form_tag('ganti_jurusan/index');?>
<table border="0" class="sf_admin_list">
<TR><TD>Nrp : </TD>
<TD><?php $nrp=$sf_request->getParameter('nrp'); echo input_tag('nrp',$nrp);?></TD>
</TR>
<TR><TD>Jurusan yang baru : </TD>
<TD><?php
$c=new Criteria;
$c->add(JurusanPeer::KODE_JUR,'62%',Criteria::LIKE);
$jurusans=JurusanPeer::doSelect($c);
$jurusanOptions=objects_for_select($jurusans,'getKodeJur','getNama');
echo select_tag('kode_jur',$jurusanOptions);
?></TD>
</TR>
<TR><TD colspan="2"><input type="submit">
<?php echo button_to_function('Kembali',"document.location='/admin/index.php'");?>
</TD></TR>
</table>

</form>
</div>