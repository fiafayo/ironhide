<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_ruang.php');
	
	if(($_GET['edit'])&& ($_GET['rg']))	{
		$result = getDetailRuang($_GET['rg']);
		if($result)	{
			$kode_ruang = $result['kode_ruang'];
			$jenis = $result['jenis'];
			$kapasitas = $result['kapasitas'];
		}
	}
	
	if(($_GET['del'])&& ($_GET['rg']))	{
		if(checkUsedRuang($_GET['rg'])==0)	{
			$result = deleteRuang($_GET['rg']);
			if($result)	{
				$inf = "Data ruang berhasil dihapus";
			}
		}
		else	{
			$error = "Data Ruang sudah terpakai";
		}
	}
	
	if($_POST['cmdEditRuang'])	{
		if(($_GET['rg']!="") && ($_POST['txtJenis']!="") && ($_POST['txtKapasitas']!=""))	{
				$kode_ruang = strtoupper($_GET['rg']);
				$jenis = strtoupper($_POST['txtJenis']);
				$kapasitas = $_POST['txtKapasitas'];
				$result = editRuang($kode_ruang,$jenis,$kapasitas);
				if($result)	{
					$inf = "Data Ruang telah berhasil diubah";
				}
				else	{
					$error = "Data Ruang gagal diubah";
				}
		}
		else {
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_POST['cmdSimpanRuang'])	{
		if(($_POST['txtKodeRuang']!="") && ($_POST['txtJenis']!="") && ($_POST['txtKapasitas']!=""))	{
			if(checkDuplicateRuang($_POST['txtKodeRuang'])==0)	{
				$kode_ruang = strtoupper($_POST['txtKodeRuang']);
				$jenis = strtoupper($_POST['txtJenis']);
				$kapasitas = $_POST['txtKapasitas'];
				$result = insertRuang($kode_ruang,$jenis,$kapasitas);
				if($result)	{
					$inf = "Data Ruang telah berhasil disimpan";
				}
				else	{
					$error = "Data Ruang gagal disimpan";
				}
			}
			else	{
				$error = "Data Ruang telah ada";
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
              <td width="516" class="headerMenu">Master Ruang </td>
            </tr>
            <tr>
              <td align="center"><table width="527" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td colspan="2" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><?
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
                        <form name="frmEditRuang" method="post" action="master_ruang.php?rg=<? echo $_GET['rg'];?>">
                          <table width="508" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td colspan="2" align="right" class="subHeaderMenu">Edit Data Ruang </td>
                              </tr>
                            <tr>
                              <td width="254" align="right">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right">Kode Ruang : </td>
                              <td width="254"><input type="text" name="txtKodeRuang" class="stext" size="5" value="<? 
				if($_GET['edit'])	{
					echo $kode_ruang;
				}?>" disabled></td>
                            </tr>
                            <tr>
                              <td align="right">Jenis : </td>
                              <td><input type="text" name="txtJenis" class="stext" size="10" value="<?
				if($_GET['edit'])	{
					echo $jenis;
				}
				?>"></td>
                            </tr>
                            <tr>
                              <td align="right">Kapasitas : </td>
                              <td><input type="text" name="txtKapasitas" class="stext" size="6" value="<?
				if($_GET['edit'])	{
					echo $kapasitas;
				}
				?>"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><input type="submit" name="cmdEditRuang" value=" Edit " class="sbutton">
                                  <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
                            </tr>
                          </table>
                        </form>
                        <?
		}
		else	{
	?>
                        <form name="frmRuang" method="post" action="master_ruang.php">
                          <table width="512" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td colspan="2" align="right" class="subHeaderMenu">Input Data Ruang Baru</td>
                              </tr>
                            <tr>
                              <td width="263" align="right">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right">Kode Ruang : </td>
                              <td width="249"><input type="text" name="txtKodeRuang" class="stext" size="5"></td>
                            </tr>
                            <tr>
                              <td align="right">Jenis : </td>
                              <td><input type="text" name="txtJenis" class="stext" size="10"></td>
                            </tr>
                            <tr>
                              <td align="right">Kapasitas : </td>
                              <td><input type="text" name="txtKapasitas" class="stext" size="6"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><input type="submit" name="cmdSimpanRuang" value="Simpan" class="sbutton">
                                  <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
                            </tr>
                          </table>
                        </form>
                        <?
		}
	?>
                    </td>
                  </tr>
				  <form name="frmCariRuang" method="post" action="master_ruang.php">
                  <tr>
                    <td align="right" valign="middle">Cari berdasarkan kode / kapasitas : </td>
                    <td><input type="text" name="ruang" class="stext">
                        <input type="submit" name="cariRuang" class="sbutton" value=" Cari "></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><div class="listTable">
                        <table width="417" cellspacing="0" cellpadding="0">
                          <tr class="headerTable">
                            <td width="131">Kode Ruang </td>
                            <td width="116">Jenis </td>
                            <td width="92">Kapasitas</td>
                            <td width="34">Edit</td>
                            <td width="42">Hapus</td>
                          </tr>
                          <?
	  	if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
		if($_POST['cariRuang'])	{
			$ruang = $_POST['ruang'];
		}
		else	{
			$ruang = $_GET['ruang'];
		}
	  	$result	= selectRuang($pages,$ruang);
		if($result)	{
			foreach($result as $display)	{
	  ?>
                          <tr>
                            <td align="center"><? echo $display['kode_ruang'];?></td>
                            <td align="center"><? echo $display['jenis'];?></td>
                            <td align="center"><? echo $display['kapasitas'];?></td>
                            <td align="center"><a href="master_ruang.php?edit=1&rg=<? echo $display['kode_ruang'];?>"><img src="../images/ico/edit.png"></a> </td>
                            <td align="center"><a href="master_ruang.php?del=1&rg=<? echo $display['kode_ruang'];?>"><img src="../images/ico/delete.png"></a></td>
                          </tr>
                          <?
	  		}
		}
		else	{
	  ?>
                          <tr align="center">
                            <td colspan="5">Tidak ada data ruangan kuliah</td>
                          </tr>
                          <?
	  	}
	  ?>
                          <tr align="center">
                            <td colspan="5"><? 
				if(getPageCountRuang($ruang)>1)	{
					 if(($_GET['page']!=1)&&(($_GET['page'])))	{
						echo "<a href='master_ruang.php?ruang=$ruang&page=".(($page+1)-1)."'> ".Back." </a>";
					  }
									for($i=getPagingRuang($page);$i<=(getPageRuang($ruang,$page)+1);$i++)
									{
										if($i==getPagingRuang($page)){
											if($page+1==$i) {
												echo "<b>".$i."</b>";
											}
											else {
												echo "<a href='master_ruang.php?ruang=$ruang&page=$i'>".$i."</a>";
											}
										}
										else{
											if($page+1==$i) {
												echo " - <b>".$i."</b>";
											}
											else {
												echo " - <a href='master_ruang.php?ruang=$ruang&page=$i'>".$i."</a>";
											}
										}
									}
					if(($_GET['page']<=(getPageRuang($ruang,$page))) && (getPageRuang($ruang,$page)>1)) 	{
						echo "<a href='master_ruang.php?ruang=$ruang&page=".(($page+1)+1)."'> ".Next." </a>";
					}
				}
	?></td>
                          </tr>
                          <tr align="center">
                            <td colspan="5">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountRuang($ruang);?> </td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
				  </form>
                  <tr>
                    <td colspan="2">&nbsp;</td>
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