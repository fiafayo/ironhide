<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_mhs.php');
	include('../inc/functions/f_kls_mk.php');
	include('../inc/functions/f_tambah_sks.php');
	
	
	if(($_GET['del']) && ($_GET['id']))	{
		$result =deleteSks($_GET['id']);
		if($result)	{
			$inf = "Data penambahan SKS telah dihapus";
		}
		else	{
			$error = "Terjadi kesalahan dalam proses hapus";
		}
	}
	
	if($_POST['cmdSimpanSks'])	{
		$nrp = $_POST['txtNrp'];
		if(checkAvailableMhs($nrp)==1)	{
			$jml_sks = $_POST['txtSks'];
			$keterangan = strtoupper($_POST['rbKeterangan']);
			if($keterangan=='Lainnya')	{
				if($_POST['txtLain']=='')	{
					$keterangan = '-';
				}
			}
			$semester = getSemester();
			$tahun = getTahunAjaran();
			if(($jml_sks !="") && ($keterangan !=""))	{
				if(checkDuplicateSks($nrp,$semester,$tahun)==0)	{
					$result = insertSks ($nrp,$jml_sks,$keterangan,$semester,$tahun);
					if($result)	{
						$inf = "Data penambahan SKS telah disimpan";
					}
					else	{
						$error = "Terjadi kesalahan dalam proses simpan";
					}
				}
				else	{
					$error = "Terjadi duplikasi data"; 
				}
			}
			else	{
				$error = "Pengisian data kurang lengkap";
			}
		}
		else	{
			$error = "Data mahasiswa tidak ditemukan";
		}
	}
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td width="512" class="headerMenu">Manage Tambahan SKS Mahasiswa</td>
            </tr>
            <tr>
              <td align="center"><table width="529" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td align="center" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><form name="frmTambahSks" method="post" action="manage_sks.php">
                        <table width="495" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2" align="right" class="subHeaderMenu">Input SKS Tambahan </td>
                            </tr>
                          <tr align="center">
                            <td colspan="2"><?
		if($error)	{
			echo "<div class='warning'>".$error."</div>";
		}
		elseif($inf)	{
			echo "<div class='information'>".$inf."</div>";
		}
	?>&nbsp;</td>
                            </tr>
                          <tr>
                            <td width="223" align="right">Nrp :</td>
                            <td width="272"><input type="text" name="txtNrp" size="6" class="stext"></td>
                          </tr>
                          <tr>
                            <td align="right">Jumlah SKS tambahan : </td>
                            <td><input type="text" name="txtSks" size="4" class="stext"></td>
                          </tr>
                          <tr>
                            <td align="right" valign="top">Keterangan : </td>
                            <td><input name="rbKeterangan" type="radio" value="IPK / IPS >= 3.75" >
                              IPK / IPS >= 3.75 <br>
                              <input name="rbKeterangan" type="radio" value="Mahasiswa Tuntas">
                              Mahasiswa Tuntas<br>
                              <input name="rbKeterangan" type="radio" value="Mahasiswa Terancam DO" >
                              Mahasiswa Terancam DO<br>
                              <input name="rbKeterangan" type="radio" value="Lainnya" >
                              Lainnya :
                              <input name="txtLain" type="text" class="stext" ></td>
                          </tr>
                          <tr>
                            <td align="right">Semester :</td>
                            <td class="labelContent">&nbsp;<? echo getSemester();?></td>
                          </tr>
                          <tr>
                            <td align="right">Tahun : </td>
                            <td class="labelContent">&nbsp;<? echo getTahunAjaran();?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td><input name="cmdSimpanSks" type="submit" class="sbutton"  value="Simpan">
                                <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
                          </tr>
                        </table>
                    </form></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><div class="listTable">
                        <table width="483" cellspacing="0" cellpadding="0">
                          <tr class="headerTable">
                            <td width="55">Nrp</td>
                            <td width="209">Nama</td>
                            <td width="56">Jml SKS </td>
                            <td width="117">Keterangan</td>
                            <td width="44">Hapus</td>
                          </tr>
                          <?
	  	if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
		$listMhs = selectSks(getSemester(),getTahunAjaran(),$pages);
		if($listMhs)	{
			foreach($listMhs as $display)	{
	  ?>
                          <tr>
                            <td align="center"><? echo $display['nrp'];?></td>
                            <td><? $nama = getDetailMhs($display['nrp']);
				echo $nama['nama'];?></td>
                            <td align="center"><? echo $display['jml_sks'];?></td>
                            <td><? echo $display['keterangan'];?></td>
                            <td align="center"><a href="manage_sks.php?del=1&id=<? echo $display['id'];?>"><img src="../images/ico/delete.png"></a></td>
                          </tr>
                          <?
	  		}
	  	}
		else	{
			?>
                          <tr align="center">
                            <td colspan="5">Tidak ada data penambahan SKS</td>
                          </tr>
                          <?
		}
	  ?>
                        </table>
                    </div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table>
<?php
include_once '../inc/_bottom.php';
?>
