<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_dosen.php');
	
	if(($_GET['edit']) && ($_GET['dos']))	{
		$result = getDetailDosen($_GET['dos']);
		$kode_dosen = $result['kode_dosen'];
		$nama = $result['nama'];
		$status = $result['status'];
	}
	
	if(($_GET['del']) && ($_GET['dos']))	{
		if(checkUsedDosen($_GET['dos'])==0)	{
			$result = deleteDosen($_GET['dos']);
			if($result)	{
				$inf = "Data Dosen telah berhasil dihapus";
			}
		}
		else	{
			$error = "Data Dosen telah terpakai";
		}
	}
	
	if($_POST['cmdEditDosen'])	{
		if(($_GET['dos']) && ($_POST['txtNamaDosen']!=""))	{
			$result = editDosen($_GET['dos'],$_POST['txtNamaDosen'],$_POST['slcStatus']);
			if($result)	{
				$inf = "Data Dosen telah berhasil diubah";
			}
			else	{
				$error = "Data Dosen gagal diubah";
			}
		}
		else {
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_POST['cmdSaveDosen'])	{
		if(($_POST['txtNamaDosen']!="") && ($_POST['txtKodeDosen']!=""))	{
			if(checkDuplicateDosen($_POST['txtKodeDosen'])==0)	{
				$kode_dosen = strtoupper($_POST['txtKodeDosen']);
				$nama = strtoupper($_POST['txtNamaDosen']);
				$status = strtoupper($_POST['slcStatus']);
				$result = insertDosen($kode_dosen,$nama,$status);
				if($result)	{
					$inf = "Data Dosen telah berhasil disimpan";
				}
				else	{
					$error = "Data Dosen gagal disimpan";
				}
			}
			else	{
				$error = "Data dosen telah ada";
			}
		}
		else {
			$error = "Pengisian data kurang lengkap";
		}
	}
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
          <tr>
            <td width="541" class="headerMenu">Master Dosen </td>
          </tr>
          <tr>
            <td align="center"><table width="528" border="0" cellspacing="0" cellpadding="0" class="content">
                <tr>
                  <td width="526" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center" class="labelContent"><?
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
                  <td colspan="2" align="center"><?
		if($_GET['edit'])	{
		?>
                      <form name="frmEditDosen" method="post" action="master_dosen.php?dos=<? echo $_GET['dos'];?>">
                        <table width="488" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2" align="right" class="subHeaderMenu">Edit Data  Dosen</td>
                            </tr>
                          <tr>
                            <td align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="221" align="right">Kode Dosen : </td>
                            <td width="267"><input type="text" name="txtKodeDosen" class="stext" size="6" <? 
				if($_GET['edit'])	{
					echo " value='".$kode_dosen."' disabled";
				}?>></td>
                          </tr>
                          <tr>
                            <td align="right">Nama Dosen : </td>
                            <td><input type="text" name="txtNamaDosen" class="stext" value="<? 
			if($_GET['edit'])	{
				echo $nama;
			}?>"></td>
                          </tr>
                          <tr>
                            <td align="right">Status : </td>
                            <td><select name="slcStatus" class="stext">
                                <option value="DOSEN">DOSEN</option>
                                <option value="ADMIN" <?
				if($status=='ADMIN')	{
					echo " checked";
				}
				?>>ADMIN</option>
                            </select></td>
                          </tr>
                          <tr>
                            <td align="right">&nbsp;</td>
                            <td><input type="submit" name="cmdEditDosen" class="sbutton" value=" Edit ">
                                <input type="reset" name="cmdReset" class="sbutton" value="Reset">
                            </td>
                          </tr>
                          <tr>
                            <td align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </form>
                      <?
		}
		else	{
	?>
                      <form name="frmInputDosen" method="post" action="master_dosen.php">
                        <table width="488" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2" align="right" class="subHeaderMenu">Input Dosen Baru </td>
                            </tr>
                          <tr>
                            <td align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="221" align="right">Kode Dosen : </td>
                            <td width="267"><input type="text" name="txtKodeDosen" class="stext" size="6"></td>
                          </tr>
                          <tr>
                            <td align="right">Nama Dosen : </td>
                            <td><input type="text" name="txtNamaDosen" class="stext"></td>
                          </tr>
                          <tr>
                            <td align="right">Status : </td>
                            <td><select name="slcStatus" class="stext">
                                <option value="DOSEN">DOSEN</option>
                                <option value="KEPALA JURUSAN">KEPALA JURUSAN</option>
                            </select></td>
                          </tr>
                          <tr>
                            <td align="right">&nbsp;</td>
                            <td><input type="submit" name="cmdSaveDosen" class="sbutton" value="Simpan">
                                <input type="reset" name="cmdReset" class="sbutton" value="Reset">
                            </td>
                          </tr>
                          <tr>
                            <td align="right">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </form>
                      <?
		}
	?>
                  </td>
                </tr>
				<form name="frmCariDosen" method="post" action="master_dosen.php">
                <tr>
                  <td align="right" valign="middle">Cari berdasarkan nama / kode : </td>
                  <td><input type="text" name="cdos" class="stext">
                      <input type="submit" name="cariDos" class="sbutton" value=" Cari "></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><div class="listTable">
                      <table width="520" cellspacing="0" cellpadding="0">
                        <tr class="headerTable">
                          <td width="26">No</td>
                          <td width="77">Kode Dosen </td>
                          <td width="236">Nama Dosen </td>
                          <td width="92">Status</td>
                          <td width="41">Edit</td>
                          <td width="52">Hapus</td>
                        </tr>
                        <?
		if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
		
		if($_POST['cariDos'])	{
			$cdos = $_POST['cdos'];
		}
		else	{
			$cdos = $_GET['cdos'];
		}

	  	$result = selectDosen($pages,$cdos);
		if($result)	{
			$i = $pages;
			foreach($result as $display)	{
			$i++;
	  ?>
                        <tr>
                          <td align="center"><? echo $i;?></td>
                          <td align="center"><? echo $display['kode_dosen'];?></td>
                          <td><? echo $display['nama'];?></td>
                          <td align="center"><? echo $display['status'];?></td>
                          <td align="center"><a href="master_dosen.php?edit=1&dos=<? echo $display['kode_dosen'];?>"><img src="../images/ico/edit.png"></a> </td>
                          <td align="center"><a href="master_dosen.php?del=1&dos=<? echo $display['kode_dosen'];?>"><img src="../images/ico/delete.png"></a></td>
                        </tr>
                        <?
	  		}
		}
		else	{  	
	  ?>
                        <tr align="center">
                          <td colspan="6">Tidak ada data dosen</td>
                        </tr>
                        <?
	  	}
	  ?>
	     				<tr align="center">
	     				  <td colspan="6"><? 
			if(getPageCountDosen($cdos)>1)	{
			  if(($_GET['page']!=1)&&(($_GET['page'])))	{
				echo "<a href='master_dosen.php?cdos=$cdos&page=".(($page+1)-1)."'> ".Back." </a>";
			  }
				for($i=getPagingDosen($page);$i<=getPageDosen($cdos,$page)+1;$i++)
				{
					if($i==getPagingDosen($page)){
						if($page+1==$i) {
							echo "<b>".$i."</b>";
						}
						else {
							echo "<a href='master_dosen.php?cdos=$cdos&page=$i'>".$i."</a>";
						}
					}
					else{
						if($page+1==$i) {
							echo " - <b>".$i."</b>";
						}
						else {
							echo " - <a href='master_dosen.php?cdos=$cdos&page=$i'>".$i."</a>";
						}
					}
				}
			if(($_GET['page']<=(getPageDosen($cdos,$page))) && (getPageDosen($cdos,$page)>1)) 	{
				echo "<a href='master_dosen.php?cdos=$cdos&page=".(($page+1)+1)."'> ".Next." </a>";
			}
		}
	?></td>
	     				  </tr>
	     				<tr align="center">
                          <td colspan="6">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountDosen($cdos);?> </td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
				</form>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table>
<?php
include_once '../inc/_bottom.php';
?>