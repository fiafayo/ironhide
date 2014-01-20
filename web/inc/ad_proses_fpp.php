<?
if($_GET['up'])	{
	editPrioritas('up',$_GET['up']);
}
else if ($_GET['down'])	{
	editPrioritas('down',$_GET['down']);
}

if($_POST['cmdProses'])	{
	$result = generateHasilPerwalian($_GET['fpp']);
	if($result)	{
		$inf = 1;
	}
}




if(substr($_GET['fpp'],0,2)!='KK')	{
?>
<form name="frmProses" method="post" action="perwalian.php?proses=1&fpp=<? echo $_GET['fpp'];?>">
<table width="510" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt;<a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>"> </a>Proses Data Hasil Perwalian <? echo  $_GET['fpp'];?></td>
  </tr>
  <tr>
    <td align="center"><?
		if($inf)	{
			echo "<span class='information'>Proses perwalian telah berhasil</span>";
		}
		?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="245" border="0" cellspacing="0" cellpadding="0">
	<tr align="center">
        <td colspan="4" class="headerTable">Tabel Prioritas</td>
      </tr>
	<?
		$prioritas = selectPrioritas($_GET['fpp']);
		$i=1;
		foreach($prioritas as $result)	{
	?>
      <tr>
        <td width="23" align="center"><? echo $i;?></td>
        <td width="181"><? 
			if($result['nama']=='SN')	{
				echo "SETTING NRP";
			}
			else if($result['nama']=='AS')	{
				echo "ASSISTEN";
			}
			else if($result['nama']=='AT')	{
				echo "ANGKATAN TUA";
			}
			else if($result['nama']=='AR')	{
				echo "RANDOM";
			}
			else if($result['nama']=='MS')	{
				echo "SEMESTER MATA KULIAH";
			}
			?></td>
        <td width="23" align="center"><?
		$kode= $result['kode_prioritas'];
		$fpp=$_GET['fpp'];
		if($result['prioritas']!=1)	{
				
					echo "<a href='javascript:void(0);' onClick=ubahPrioritas('up','$kode','$fpp')><img src='../images/uparrow.png' width='12' height='12'></a>";
			}
			else	echo "&nbsp"?>
		</td>
        <td width="18" align="center"><?
		if($result['prioritas']!=5)	{
					echo "<a href='javascript:void(0);' onClick=ubahPrioritas('down','$kode','$fpp')><img src='../images/downarrow.png' width='12' height='12'></a>";
			}
			else	echo "&nbsp"?></td>
      </tr>
	  <?
	  		$i++;
	  }
	  ?>
    </table>
	</div></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="cmdProses" value="Proses" class="sbutton"></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><b>* Keterangan:</b>
      <ul>
        <li> Klik pada  <img src='../images/uparrow.png' width='12' height='12'>  untuk menaikkan prioritas. </li>
        <li> Klik pada <img src='../images/downarrow.png' width='12' height='12'> untuk menurunkan prioritas. </li>
      </ul></td>
  </tr>
  <tr>
    <td align="left"><a href="perwalian.php">[Kembali]</a></td>
  </tr>
</table>
</form>
<?
}
else if(substr($_GET['fpp'],0,2)=='KK')	{
	$bukaFpp = getDetailFpp($_GET['fpp']);
	if(date("Y-m-d G:i:s")>date("Y-m-d G:i:s",strtotime($bukaFpp['waktu_buka'])))	
	{
			if($_POST['cmdProsesNrp'])	{
				$_SESSION['plus_id'] = $_POST['txtNrp'];
			}
			$nrp = $_SESSION['plus_id'];
			$mhs = getDetailMhs($nrp);
		
			if($_GET['kode'])	{
				$result = deleteKKPlus($_GET['kode'],$nrp);
				$mk = getDetailKlsMk($_GET['kode']);
				if($result)	{
					$inf = "Data kelas ".$mk['kode_mk']." KP ".$mk['kp']." telah berhasil dihapus";
				}
				else	{
					$error = "Data kelas ".$mk['kode_mk']." KP ".$mk['kp']." gagal dihapus";
				}
			}
			
			if($_POST['cmdTambahKK'])	{
				$kode_mk = strtoupper($_POST['txtKodeMkKK']);
				$kp = strtoupper($_POST['txtKpKK']);
				$semester =  $bukaFpp['semester'];
				$tahun =  $bukaFpp['tahun'];
				if(checkAvailable($kode_mk,$kp,getJurusanMhs($nrp))==1)	{
					$result = inputKKPlus($_GET['fpp'],generateKodeKelas($kode_mk,$kp,$semester,$tahun),$nrp);
					$mk = getDetailKlsMk($_GET['kode']);
					if($result)	{
						$inf = "Data kelas ".$mk['kode_mk']." KP ".$mk['kp']." telah berhasil diinput";
					}
					else	{
						$error = "Data kelas ".$mk['kode_mk']." KP ".$mk['kp']." gagal diinput";
					}
				}
				else	{
					$error = "Kode kelas salah / tidak dibuka";
				}
			}
			$tambah = getDetailSks($bukaFpp['semester'],$bukaFpp['tahun'],$nrp);
		?>
		
		<table width="500" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="500" align="center"  class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt;<a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>"> </a>Proses  Kasus Khusus Tambahan <? echo  $bukaFpp['semester']." ". $bukaFpp['tahun'];?></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center"><?
				if($inf)	{
					echo "<span class='information'>$inf</span>";
				}
				else if($error)	{
					echo "<span class='error'>$error</span>";
				}
				?></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr align="center">
			<td>
			<form name="frmKK" method="post" action="perwalian.php?proses=1&fpp=<? echo $_GET['fpp'];?>">
			<table width="480" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="241" align="right">Input nrp mahasiswa : </td>
				<td width="239"><input type="text" name="txtNrp" class="stext" value="<? echo $nrp;?>">
				  <input type="submit" name="cmdProsesNrp" value="Proses" class="sbutton"></td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
				<td align="left" class="labelContent">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2" class="subHeaderMenu">Detail Mahasiswa</td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
				<td align="left" class="labelContent">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="right">Nama : </td>
				<td align="left" class="labelContent">&nbsp;<? echo $mhs['nama'];?></td>
			  </tr>
			  <tr>
				<td align="right">SKS Maks : </td>
				<td align="left" class="labelContent">&nbsp;<? echo $mhs['sksmax'];?></td>
			  </tr>
			  <tr>
				<td align="right">SKS Tambahan : </td>
				<td class="labelContent">&nbsp;<? echo $tambah['jml_sks'];?></td>
			  </tr>
			</table>
			</form>
			</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
		  </tr>
			<td align="center">
			<form name="KKPlus" method="post">
			<table width="477" border="0" cellspacing="0" cellpadding="0">
			  <tr >
				<td colspan="2" class="subHeaderMenu">Input Mata Kuliah Tambahan </td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td width="250"><div align="right">Kode MataKuliah :</div></td>
				<td width="227"><input type="text" name="txtKodeMkKK" class="stext" size="6" id="kodeMk" onChange="getNamaMk()"></td>
			  </tr>
			  <tr>
				<td align="right">Nama Mata Kuliah : </td>
				<td class="labelContent">&nbsp;<span id="namaMk">None</span></td>
			  </tr>
			  <tr>
				<td><div align="right">KP : </div></td>
				<td><input name="txtKpKK" type="text" class="stext" id="txtKpKK" size="3"></td>
			  </tr>
			  <tr>
				<td><div align="center"> </div></td>
				<td><input name="cmdTambahKK" type="submit" class="sbutton"  value=" Add ">
					<input name="cmdResetKK" type="reset" class="sbutton" value="Reset"></td>
			  </tr>
			</table></form>
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			<td>
			<span class="listTable">
			  <table width="497" border="0" cellspacing="0" cellpadding="0">
				<tr class="headerTable">
				  <td colspan="6">Daftar Mata Kuliah yang telah diterima </td>
				</tr>
				<tr class="headerTable">
				  <td width="68" nowrap>Kode MK</td>
				  <td width="259" nowrap>Nama MK </td>
				  <td width="80" nowrap>Keterangan</td>
				  <td width="21" nowrap>KP</td>
				  <td width="30" nowrap>SKS</td>
				  <td width="39" nowrap>Hapus</td>
				</tr>
				<?
					
					$result= selectAllTerimaKls($nrp,$bukaFpp['semester'],$bukaFpp['tahun']);
					if($result)	{
						$totalSks=0;
						foreach($result as $kelas_mk)	{
							$kelas=getDetailKlsMk($kelas_mk['kode_kelas']);
							$kode = $kelas_mk['kode_kelas'];
							$mk =getDetailMk($kelas['kode_mk']);
							$totalSks+=$mk['sks'];
					  ?>
				<tr>
				  <td align="center"><? echo $kelas['kode_mk'];?></td>
				  <td><? $nama=getDetailMk($kelas['kode_mk']);
								echo $nama['nama'];?></td>
				  <td>&nbsp;</td>
				  <td align="center"><? echo $kelas['kp'];?></td>
				  <td align="center"><? echo $mk['sks'];?></td>
				  <td align="center"><? echo "<a href='javascript:void(0);' onClick=deleteKK('$kode','".$_GET['fpp']."')><img src='../images/ico/delete.png'></a>"?></td>
				</tr>
				<?
					}
					?>
				<tr>
				  <td colspan="6" align="right">Total SKS : <? echo $totalSks;?></td>
				</tr>
				<?
				}
				else	{
					?>
				<tr>
				  <td colspan="6" align="center">Tidak ada hasil perwalian</td>
				</tr>
				<?
				}
			 ?>
			  </table>
			</span></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td><b>* Keterangan:</b>
			  <ul>
				<li> Mata kuliah yang ditambah dan dihapus pada proses ini akan langsung dilakukan terhadap database.</li>
				<li> Kolom keterangan pada tabel daftar mata kuliah yang telah diterima akan terisi apabila terjadi tubrukan jadwal kuliah, jadwal ujian, kelas penuh, dan mata kuliah prasyrat tidak terpenuhi.</li>
			  </ul></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td><a href="perwalian.php">[Kembali]</a></td>
		  </tr>
		</table>
		
		<?
		}
		else	{
			
			if($_GET['status'])	{
				$status=$_GET['status'];
				$result = ubahManageKK($status,$bukaFpp['kode_fpp']);
				if($result)	{
					$inf = "Pengubahan status pegecekan berhasil";
				}
				else	{
					$inf = "Pengubahan status pengecekan gagal";
				}
			}
			$kk = getDetailManageKK($bukaFpp['kode_fpp']);
		?>
			<table width="500" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt;<a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>"> </a>Manage Kasus Khusus <? echo  $bukaFpp['semester']." ". $bukaFpp['tahun'];?></td>
			  </tr>
			  <tr>
			    <td align="center">&nbsp;</td>
		      </tr>
			  <tr>
			    <td align="center"><?
				if($inf)	{
					echo "<span class='information'>$inf</span>";
				}
				else if($error)	{
					echo "<span class='error'>$error</span>";
				}
				?></td>
		      </tr>
			  <tr>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
				<td align="center">
				<span class="listTable">
				<table width="396" border="0" cellspacing="0" cellpadding="0">
                  <tr class="headerTable">
                    <td width="69">&nbsp;</td>
                    <td width="110">Kuliah Tubrukan </td>
                    <td width="109">Ujian Tubrukan </td>
                    <td width="108">MK Prasyarat </td>
                  </tr>
                  <tr>
                    <td align="right">Status KK : </td>
                    <td align="center"><a href='perwalian.php?proses=1&fpp=<? echo $_GET['fpp'];?>&status=1'><? if($kk['jwd_kul']=='1')	{
						echo "<img src='../images/ico/done.png'>";
					}
					else	{
						echo "<img src='../images/ico/none.png'>";
					}?></a></td>
                    <td align="center"><a href='perwalian.php?proses=1&fpp=<? echo $_GET['fpp'];?>&status=2'><? if($kk['jwd_ujian']=='1')	{
						echo "<img src='../images/ico/done.png'>";
					}
					else	{
						echo "<img src='../images/ico/none.png'>";
					}?></a></td>
                    <td align="center"><a href='perwalian.php?proses=1&fpp=<? echo $_GET['fpp'];?>&status=3'><? if($kk['mk_p']=='1')	{
						echo "<img src='../images/ico/done.png'>";
					}
					else	{
						echo "<img src='../images/ico/none.png'>";
					}?></a></td>
                  </tr>
                </table></span></td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td><b>* Keterangan:</b>
                  <ul>
                    <li> Tanda <img src='../images/ico/done.png' width="15" height="15"> manandakan pengecekan tersebut terpakai </li>
					<li>Tanda <img src='../images/ico/none.png' width="15" height="15"> menandakan pengecekan tersebut tidak terpakai.</li>
					<li> Untuk mengubahnya penegcekan dapat dilakukan dengan  menekan tanda tersebut.</li>
                </ul></td>
		      </tr>
			  <tr>
				<td><a href="perwalian.php">[Kembali]</a></td>
			  </tr>
			</table>
<?
		}
}
?>