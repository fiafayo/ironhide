<?
	if(($_GET['del']) && ($_GET['jadwal']))	{
		$result = deleteJadwal($_GET['del']);
		if($result)	{
			$inf = "jadwal berhasil dihapus";
		}
		else	{
			$error = "jadwal gagal dihapus";
		}
	}
	
	if($_POST['cmdSimpanJadwal'])	{
		if(($_POST['txtKeterangan']!="")&&($_POST['txtBuka']!="")&&($_POST['txtTutup']!=""))	{
			$keterangan = $_POST['txtKeterangan'];
			$buka = date("y-M-d",strtotime($_POST['txtBuka']));
			$tutup = date("y-M-d",strtotime($_POST['txtTutup']));
			$result = inputJadwal($keterangan,$buka,$tutup);
			if($result)	{
				$inf = "Input jadwal berhasil";
			}
			else	{
				$error = "Input jadwal gagal";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
?>
<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?
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
  </tr>
  <tr>
    <td align="center">
	<form name="frmJadwal" method="post" action="setting_admin.php?jadwal=1">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="220" align="right">Keterangan : </td>
        <td width="280"><input type="text" name="txtKeterangan" class="stext" ></td>
      </tr>
      <tr>
        <td align="right">Waktu Buka  : </td>
        <td><input type="text" name="txtBuka" class="stext" size="5"></td>
      </tr>
      <tr>
        <td align="right">Waktu Tutup : </td>
        <td><input type="text" name="txtTutup" class="stext" size="5"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" name="cmdSimpanJadwal" class="sbutton" value=" Save ">
            <input type="reset" name="cmdReset" class="sbutton" value="Reset"></td>
      </tr>
    </table></form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="418" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="87">Keterangan</td>
        <td width="147">Waktu Buka</td>
        <td width="143">Waktu Tutup</td>
        <td width="31">&nbsp;</td>
        </tr>
      <?
		$jadwal = selectJadwal();
		if($jadwal)	{
			foreach($jadwal as $display)	{
	?>
      <tr>
        <td><? echo $display['keterangan'];?></td>
        <td><? echo $display['waktu_buka'];?></td>
        <td><? echo $display['waktu_tutup'];?></td>
        <td align="center"> <a href="setting_admin.php?jadwal=1&del=<? echo $display['no'];?>"><img src="../images/ico/delete.png"></a></td>
        </tr>
      <?
			}
		}
		else	{
			?>
      <tr align="center">
        <td colspan="4">Tidak ada data jadwal</td>
      </tr>
      <?
		}
	?>
    </table></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
