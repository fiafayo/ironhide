<?
	if(isset($_GET['status']))	{
		$result = statusFpp($_GET['kode'],$_GET['status']);
		if($result)	{
				$inf = "Status Perwalian telah berhasil diubah";
		}
	}
	
	if(isset($_GET['del']) && ($_GET['kode']))	{
		$cek=checkStatusFpp($_GET['kode']);
		if($cek['status_aktif']=='0')	{
			if(checkUsedFpp($_GET['kode'])==0)	{
				$result = deleteFpp($_GET['kode']);
				if($result)	{
						$inf = "Data Perwalian berhasil dihapus";
				}
			}
			else	{
				$error = "Data Perwalian sudah terpakai";
			}
		}
		else	{
			$error = "Data Perwalian sedang terpakai";
		}
	}
	
	if($_POST['cmdSimpanFpp'])	{
		$semester = getSemester();
		$tahun= getTahunAjaran();
		if(($_POST['slcJenis']!="0") && ($_POST['txtWaktuBuka']!="") && ($_POST['txtWaktuTutup']!="0"))	{
			if(checkDuplicateFpp($_POST['slcJenis'],$semester,$tahun)==0)	{
				$jenis = strtoupper($_POST['slcJenis']);
				$waktuBuka=date("Y-m-d H:i:s",strtotime($_POST['txtWaktuBuka']));
				$waktuTutup=date("Y-m-d H:i:s",strtotime($_POST['txtWaktuTutup']));

				if($waktuTutup>$waktuBuka)	{
				
					$result = insertFpp($jenis,$semester,$tahun,$waktuBuka,$waktuTutup);
					
					if($result)	{
						$inf = "Data Perwalian telah berhasil disimpan";
					}
					else	{
						$error = "Data Perwalian gagal disimpan";
					}
				}
				else	{
					$error = "Waktu akhir harus lebih besar dari waktu mulai";
				}
			}
			else	{
				$error = "Data Perwalian telah ada";
			}
		}
		else {
			$error = "Pengisian data kurang lengkap";
		}
	}
?>
<table width="516" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="598" align="center" class="subHeaderMenu">Input Jenis Perwalian </td>
      </tr>
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
        <td align="center"><form name="frmPerwalian" method="post" action="perwalian.php?input=1">
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right">Jenis : </td>
                <td><select name="slcJenis" class="stext" id="slcJenis">
					<option value="0" selected>- Pilih Jenis -</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
					<option value="KK">Kasus Khusus</option>
                </select></td>
              </tr>
              <tr>
                <td align="right">Semester : </td>
                <td class="labelContent">&nbsp;<? echo getSemester();?></td>
              </tr>
              <tr>
                <td align="right">Tahun Ajaran : </td>
                <td class="labelContent">&nbsp;<? echo getTahunAjaran();?></td>
              </tr>
              <tr>
                <td align="right">Waktu Mulai : </td>
                <td valign="bottom"><input type="text" name="txtWaktuBuka" class="stext" size="15" >
				<a href="javascript:show_calendar('document.frmPerwalian.txtWaktuBuka', document.frmPerwalian.txtWaktuBuka.value);"><img src="../images/ico/date.png" border="0" alt="Ambil Tanggal Mulai"></a></td>
              </tr>
              <tr>
                <td align="right">Waktu Selesai : </td>
                <td><input type="text" name="txtWaktuTutup" class="stext" size="15">
                <a href="javascript:show_calendar('document.frmPerwalian.txtWaktuTutup', document.frmPerwalian.txtWaktuTutup.value);"><img src="../images/ico/date.png" border="0" alt="Ambil Tanggal Selesai"></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="cmdSimpanFpp" value="Simpan" class="sbutton">
                    <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
              </tr>
            </table>
        </form></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
		<div class="listTable">
		<table width="475" cellspacing="0" cellpadding="0">
            <tr class="headerTable">
              <td width="29">Jenis</td>
              <td width="62">Semester</td>
              <td width="89">Tahun</td>
              <td width="85">Waktu Mulai </td>
              <td width="95">Waktu Selesai </td>
              <td width="45">Status</td>
              <td width="32">Hapus</td>
            </tr>
            <?
		  if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
	  	$result = selectFpp($pages);
		if($result)	{
			foreach($result as $display)	{
	  ?>
            <tr>
              <td align="center"><? echo $display['jenis'];?></td>
              <td align="center"><? echo $display['semester'];?></td>
              <td align="center"><? echo $display['tahun'];?></td>
              <td align="center"><? echo date("d M Y H:i:s",strtotime($display['waktu_buka']));?></td>
              <td align="center"><? echo date("d M Y H:i:s",strtotime($display['waktu_tutup']));?></td>
              <td align="center"><?
			if($display['status_aktif']=='0')	{
				echo "<a href='perwalian.php?input=1&status=0&kode=".$display['kode_fpp']."'><img src='../images/ico/none.png'></a>";
			}
			else	{
				echo "<a href='perwalian.php?input=1&status=1&kode=".$display['kode_fpp']."'><img src='../images/ico/done.png'></a>";
			}
		?></td>
              <td align="center"><a href="perwalian.php?input=1&del=1&kode=<? echo $display['kode_fpp'];?>"><img src="../images/ico/delete.png"></a></td>
            </tr>
            <?
	  		}
		}
		else	{
	  ?>
            <tr align="center">
              <td colspan="7"> Tidak ada data perwalian </td>
            </tr>
            <?
	  	}
	  ?>
            <tr align="center">
              <td colspan="7"> Page :
                  <? 
				  
	for($i=1;$i<(getPageFpp()/LM_DISPLAY)+1;$i++)
	{
		if($i==1){
			if($page+1==$i) {
				echo "<b>".$i."</b>";
			}
			else {
				echo "<a href='perwalian.php?input=1&page=$i'>".$i."</a>";
			}
		}
		else{
			if($page+1==$i) {
				echo " - <b>".$i."</b>";
			}
			else {
				echo " - <a href='perwalian.php?input=1&page=$i'>".$i."</a>";
			}
		}
	}
	?></td>
            </tr>
        </table></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
</table>
