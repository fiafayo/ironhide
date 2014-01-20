<?
	$kode_kls = $_GET['kode_kls'];
	$kode_fpp =$_GET['fpp'];
	$detail = getDetailKlsMk($kode_kls);
	
	if($_GET['nrp'])	{
		$status = getStatusDaftar($kode_fpp,$kode_kls,$_GET['nrp']);
		if($status['status'] =='1')	{
			$result = editStatusDaftar($kode_fpp,$kode_kls,$_GET['nrp'],'2');
			if($result)	{
				$inf = "Nrp $nrp telah ditolak";
			}
			else	{
				$error = "Kesalahan update status";
			}
		}
		else if($status['status'] =='2')	{
			$result = editStatusDaftar($kode_fpp,$kode_kls,$_GET['nrp'],'0');
			if($result)	{
				$inf = "Nrp $nrp telah diterima";
			}
			else	{
				$error = "Kesalahan update status";
			}
		}
		else if($status['status'] =='0')	{
			$result = editStatusDaftar($kode_fpp,$kode_kls,$_GET['nrp'],'1');
			if($result)	{
				$inf = "Nrp $nrp belum memiliki status apapun";
			}
			else	{
				$error = "Kesalahan update status";
			}
		}
	}
	
	if($_POST['cmdTutup'])	{
		$result = tutupKelas($kode_kls);
		if($result)	{
			$inf = "Kelas telah berhasil ditutup";
		}
		else	{
			$error = "Kelas gagal ditutup";
		}
	}
	
	if($_POST['cariMhs'])	{
		$cmhs = $_POST['cmhs'];
	}
	else	{
		$cmhs = $_GET['cmhs'];
	}
?>

<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt;<a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>"> Daftar MK </a>&gt;
	<a href="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_mk=<? echo $detail['kode_mk'];?>"> Daftar Kelas MK </a>&gt; Mhs Pendaftar Kelas MK</td>
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
  <tr align="left">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="279" align="right">Kode Mata Kuliah : </td>
    <td width="279" class="labelContent">&nbsp;<? echo $detail['kode_mk']?></td>
  </tr>
  <tr>
    <td align="right">Nama Mata Kuliah : </td>
    <td class="labelContent">&nbsp;<? $nama= getDetailMK($detail['kode_mk']);
							 echo $nama['nama'];?></td>
  </tr>
  <tr>
    <td align="right">KP : </td>
    <td class="labelContent">&nbsp;<? echo $detail['kp']?></td>
  </tr>
  <tr>
    <td align="right">Kapasitas : </td>
    <td class="labelContent">&nbsp;<? echo $detail['kapasitas']?></td>
  </tr>
  <form name="frmCariMhs" method="post" action="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_kls=<? echo $_GET['kode_kls'];?>">
  <tr class="content">
    <td align="right" valign="middle">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" class="content">
    <td colspan="2" valign="middle">- <img src="../images/ico/pdf_button.png" width="16" height="16"><a href="pdf_mhs_kls.php?kls=<? echo $_GET['kode_kls'];?>&fpp=<? echo $_GET['fpp']; ?>"> Cetak Laporan </a>-</td>
    </tr>
  <tr class="content">
    <td align="right" valign="middle">Cari berdasarkan nrp / nama : </td>
    <td><input type="text" name="cmhs" class="stext" value="<? echo $cmhs;?>">
        <input type="submit" name="cariMhs" class="sbutton" value=" Cari "></td>
  </tr>
  <tr align="center">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2">
	<div class="listTable">
	<table width="489" cellpadding="0" cellspacing="0">
      <tr class="headerTable">
        <td width="24">No </td>
        <td width="48">Nrp </td>
        <td width="194">Nama </td>
        <td width="102">Status Asisten</td>
        <td width="119">Status terima </td>
        </tr>
	  <?
	  
	  	if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
		
		
	  	$mhs = selectPendaftarMk($kode_kls,$cmhs,$pages);
		if($mhs)	{
			$i=0;
			foreach($mhs as $display)	{
	  ?>
      <tr>
        <td align="center"><? echo ++$i;?></td>
        <td align="center"><? echo $display['nrp'];?></td>
        <td><? echo $display['nama'];?></td>
        <td align="center"><? 
		if($display['asisten']=='1')	{
			echo "Asisten";
		}
		else	{
			echo "Non-Asisten";
		}?></td>
        <td align="center">
		<?
		$status = getStatusDaftar($kode_fpp,$kode_kls,$display['nrp']);
		if($status['status']=='1')	{
			?>
			<a href="perwalian.php?fpp=<? echo $kode_fpp;?>&kode_kls=<? echo $kode_kls;?>&nrp=<? echo $display['nrp'];?>"><img src="../images/ico/done.png"></a>
		<?
		}
		else if($status['status']=='0'){
			?>
			<a href="perwalian.php?fpp=<? echo $kode_fpp;?>&kode_kls=<? echo $kode_kls;?>&nrp=<? echo $display['nrp'];?>"><img src="../images/ico/none.png"></a>
			<?
		}
		else if($status['status']=='2'){
			?>
			<a href="perwalian.php?fpp=<? echo $kode_fpp;?>&kode_kls=<? echo $kode_kls;?>&nrp=<? echo $display['nrp'];?>"><img src="../images/ico/delete.png"></a>
			<?
		}
		?>
		  </td>
        </tr>
	  <?
	  		}
	  	}
		else	{
		?>
		 <tr align="center">
			<td colspan="5">Tidak ada data mahasiswa</td>
	    </tr>
		<?
		}
	  ?>
	    <tr align="center">
	      <td colspan="5"><? 
		  if(getPageCountPendaftarMk($kode_kls,$kode_fpp,$cmhs)>1)	{
						  if(($_GET['page']!=1)&&(($_GET['page'])))	{
							echo "<a href='perwalian.php?cmhs=$cmhs&fpp=$kode_fpp&kode_kls=$kode_kls&page=".(($page+1)-1)."'> ".Back." </a>";
						  }
				for($i=getPagingFpp($page);$i<=(getPagePendaftarMk($kode_kls,$kode_fpp,$cmhs,$page)+1);$i++)
				{
					if($i==getPagingFpp($page)){
						if($page+1==$i) {
							echo "<b>".$i."</b>";
						}
						else {
							echo "<a href='perwalian.php?cmhs=$cmhs&fpp=$kode_fpp&kode_kls=$kode_kls&page=$i'>".$i."</a>";
						}
					}
					else{
						if($page+1==$i) {
							echo " - <b>".$i."</b>";
						}
						else {
							echo " - <a href='perwalian.php?cmhs=$cmhs&fpp=$kode_fpp&kode_kls=$kode_kls&page=$i'>".$i."</a>";
						}
					}
				}
				if(($_GET['page']<=(getPagePendaftarMk($kode_kls,$kode_fpp,$cmhs,$page))) && (getPagePendaftarMk($kode_kls,$kode_fpp,$cmhs,$page)>1)) 	{
					echo "<a href='perwalian.php?cmhs=$cmhs&fpp=$kode_fpp&kode_kls=$kode_kls&page=".(($page+1)+1)."'> ".Next." </a>";
				}
			}
	?></td>
	      </tr>
	    <tr align="center">
            <td colspan="5">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountPendaftarMk($kode_kls,$kode_fpp,$cmhs);?> </td>
            </tr>
    </table>
	</div></td>
  </tr>
  </form>
  <tr align="center">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2">
	<form name="frmTutupKls" method="post" >
	<input type="submit" name="cmdTutup" class="sbutton" value="Tutup Kelas">
	</form></td>
  </tr>
  <tr>
    <td colspan="2"><b>* Keterangan:</b>
      <ul>
        <li>Proses tutup kelas akan mengakibatkan semua pendaftar kelas mata kuliah ditolak.</li>
        <li>Proses tutup kelas dapat dibuka kembali pada <strong>Manage Kelas Mata Kuliah</strong>.</li>
        <li>Status terima mahasiswa dapat diubah secara manual dengan menekan tanda pada kolom status terima. </li>
        <li>Tanda  <img src="../images/ico/none.png" width="15" height="15"> menujukkan bahwa mahasiswa tersebut belum memiliki status apapun.</li>
        <li>Tanda  <img src="../images/ico/delete.png" width="15" height="15"> menujukkan bahwa mahasiswa tersebut ditolak. </li>
        <li>Tanda <img src="../images/ico/done.png" width="15" height="15"> menujukkan bahwa mahasiswa tersebut  diterima.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a href="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_mk=<? echo $detail['kode_mk'];?>">[Kembali]</a></td>
  </tr>
</table>
