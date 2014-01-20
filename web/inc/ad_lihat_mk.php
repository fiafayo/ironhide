<?
	if($_POST['cmdEdit'])
	{
		if(checkUsedMk($_GET['kode']) == true)
		{
			//$kodeMk = $_POST['txtKodeMk'];
			$namaMk = strtoupper($_POST['txtNamaMk']);
			$sks = strtoupper($_POST['txtSks']);
			$result = editMk($_GET['kode'],$namaMk,$sks);
			if($result)	{
				$inf = "Data Mata Kuliah ".$_GET['kode']." telah diubah";
			}
			else	{
				$error = "Terjadi kesalahan dalam proses ubah";
			}
		}
		else	{
			$error = "Mata Kuliah ".$_GET['kode']." tidak dapat ubah";
		}
	}
	if(($_GET['del']) && ($_GET['kode']))
	{
		if(checkUsedMk($_GET['kode']) == true)
		{
			$result = deleteMk($_GET['kode']);
			if($result)	{
				$inf = "Data Mata Kuliah ".$_GET['kode']." telah dihapus";
			}
			else	{
				$error = "Terjadi kesalahan dalam proses hapus";
			}
		}
		else	{
			$error = "Mata Kuliah ".$_GET['kode']." tidak dapat dihapus";
		}
	}
	if(($_GET['edit']) && ($_GET['kode']))
	{ 
		$result = getDetailMk($_GET['kode']);
	?>
		<form name="frmEdit" method="post" action="master_mk.php?lihat=1">
		<table width="466" border="0" cellpadding="0" cellspacing="0">
		  <tr align="center">
		    <td colspan="2" class="subHeaderMenu"><a href="master_mk.php?lihat=1">Lihat Daftar Mata Kuliah </a> &gt; Edit Mata Kuliah </td>
	      </tr>
		  <tr align="center">
			<td colspan="2"><?
				if($error)
				{
					echo "<div class='warning'>".$error."</div>";
				}
				elseif($inf)
				{
					echo "<div class='information'>".$inf."</div>";
				}
			?></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td width="201"><div align="right">Kode Mata Kuliah : </div></td>
			<td width="265"><input name="txtKodeMk" type="text" disabled class="stext" value="<? echo $result['kode_mk'];?>" size="10"></td>
		  </tr>
		  <tr>
			<td><div align="right">Nama Mata Kuliah : </div></td>
			<td><input name="txtNamaMk" type="text" class="stext" value="<? echo $result['nama'];?>" size="25"></td>
		  </tr>
		  <tr>
			<td><div align="right">SKS : </div></td>
			<td><input name="txtSks" type="text" class="stext" value="<? echo $result['sks'];?>" size="3"></td>
		  </tr>
		  <tr align="center">
			<td colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><input type="submit" name="cmdEdit" value="Save" class="sbutton">
              <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
	      </tr>
		  <tr>
			<td><a href="master_mk.php?lihat=1">[Kembali]</a> </td>
			<td>&nbsp;			</td>
		  </tr>
		</table>
		</form>
		<?
		}
		else
		{
		?>
	
<table width="518" border="0" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td colspan="2" class="subHeaderMenu" >Daftar Mata Kuliah </td>
  </tr>
  <tr align="center">
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2" ><?
		if($error)	{
			echo "<div class='warning'>".$error."</div>";
		}
		elseif($inf)	{
			echo "<div class='information'>".$inf."</div>";
		}
	?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
	<form name="frmCariMk" method="post" action="master_mk.php?lihat=1&page=1">
  <tr>
    <td width="212" align="right" valign="middle">Cari berdasarkan nama / kode : </td>
    <td width="306"><input type="text" name="mk" class="stext"><input type="submit" name="cari" class="sbutton" value=" Cari "></td>
  </tr>
  </form>
    <tr align="center">
      <td colspan="2">&nbsp;</td>
    </tr>
  <tr align="center">
    <td colspan="2">
	<div class="listTable">
	<table width="507" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td>No</td>
        <td>Kode </td>
        <td width="343">Nama MK</td>
        <td width="35">SKS</td>
        <td>Edit</td>
        <td>Hapus</td>
      </tr>
	<?
		if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
		if($_POST['cari'])	{
			$mk = $_POST['mk'];
		}
		else	{
			$mk = $_GET['mk'];
		}
		$displayMk = selectMk($pages,$mk);
		if($displayMk)
		{
			$i = $pages;
			foreach($displayMk as $display)
			{
				$i++;
		?>
		  <tr>
			<td width="20" align="center"><? echo $i;?></td>
			<td width="39" align="center"><? echo $display['kode_mk'];?></td>
			<td><? echo $display['nama'];?></td>
			<td align="center"><? echo $display['sks'];?></td>
			<td width="29" align="center"><a href="master_mk.php?lihat=1&edit=1&kode=<? echo $display['kode_mk'];?>"><img src="../images/ico/edit.png"></a>			</td>
		    <td width="39" align="center"><a href="master_mk.php?lihat=1&del=1&kode=<? echo $display['kode_mk'];?>"><img src="../images/ico/delete.png"></a></td>
		  </tr>
		<?	
			
			}
		}
		else
		{	?>
			
			<tr align="center">
				<td colspan="7">Tidak ada data mata kuliah</td>
        	</tr>	<?
		}
	?>
        	<tr align="center">
        	  <td colspan="7"><? 
			  if(getPageCountMk($mk)>1)	{
				  if(($_GET['page']!=1)&&(($_GET['page'])))	{
					echo "<a href='master_mk.php?mk=$mk&lihat=1&page=".(($page+1)-1)."'> ".Back." </a>";
				  }
						for($i=getPagingMk($page);$i<=getPageMk($mk,$page)+1;$i++)
						{
							if($i==getPagingMk($page)){
								if($page+1==$i) {
									echo "<b>".$i."</b>";
								}
								else {
									echo "<a href='master_mk.php?mk=$mk&lihat=1&page=$i'>".$i."</a>";
								}
							}
							else{
								if($page+1==$i) {
									echo " - <b>".$i."</b>";
								}
								else {
									echo " - <a href='master_mk.php?mk=$mk&lihat=1&page=$i'>".$i."</a>";
								}
							}
						}
				if($_GET['page']<=(getPageMk($mk,$page)) && (getPageMk($mk,$page)>1))	{
					echo "<a href='master_mk.php?mk=$mk&lihat=1&page=".(($page+1)+1)."'> ".Next." </a>";
				}
			}
					?></td>
      	  </tr>
        	<tr align="center">
			  <td colspan="7">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMk($mk);?></td>
	    </tr>
    </table>
	</div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?
}
?>
