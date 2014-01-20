<div class="listTable">
<table  border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="302"  class="headerTable">&nbsp;&nbsp;Fakultas Teknik UBAYA&nbsp;&nbsp;</td>
  </tr>
  <?
	$displayJurusan = getJurusan();
	foreach($displayJurusan as $display)
	{
  ?>
  <tr>
	<td align="center">
		<? if($_GET['manage'])	{
				?><a href="master_mk.php?manage=1&jur=<? echo $display['kode_jur'];?>"><? echo $display['nama'];?></a>
			<?
			}
			elseif($_GET['kelas'])	{
			?>
				<a href="kelas_mk.php?jur=<? echo $display['kode_jur'];?>"><? echo $display['nama'];?></a>
			<?
			}
			elseif($_GET['ujian'])	{
			?>
				<a href="jadwal_ujian.php?jur=<? echo $display['kode_jur'];?>"><? echo $display['nama'];?></a>
			<?
			}
			elseif($_GET['tahun'] && $_GET['semester'] && $_GET['lap']==4)	{
			?>
				<a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=<? echo $_GET['lap'];?>&jur=<? echo $display['kode_jur'];?>"><? echo $display['nama'];?></a>
			<?
			}
			?>
	</td>
  </tr>
  <?
	}
	if($_GET['kelas'])	{
	
		?><tr>
			<td align="center"><a href="kelas_mk.php?jur=MKU">MATA KULIAH UMUM (MKU)</a><br>			
			</td>
		  </tr>
		  <tr>
			<td align="center"><a href="kelas_mk.php?jur=MIPA">MATEMATIKA DAN ILMU PENGETAHUAN ALAM (MIPA)</a><br>			
			</td>
		<tr>
			<td align="center"><a href="kelas_mk.php?jur=ALL">TAMPILKAN SEMUA</a><br>			
		</td>
		  </tr>
	<?
	}
	else if($_GET['ujian'])	{
	
		?><tr>
			<td align="center"><a href="jadwal_ujian.php?jur=MKU">MATA KULIAH UMUM (MKU)</a><br>			
			</td>
		  </tr>
		    <tr>
			<td align="center"><a href="jadwal_ujian.php?jur=MIPA">MATEMATIKA DAN ILMU PENGETAHUAN ALAM(MIPA)</a><br>			
			</td>
			<tr>
			<td align="center"><a href="jadwal_ujian.php?jur=ALL">TAMPILKAN SEMUA</a><br>			
		</td>
		  </tr>
	<?
	}
  ?>
</table>
</div>