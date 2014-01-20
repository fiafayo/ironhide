<table width="661" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="682" colspan="2" class="subHeaderMenu"><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='kelas_mk.php?kelas=1'>";
		}?>Manage Jadwal Kelas Mata Kuliah
    </a>&gt; Jadwal Mata Kuliah
      <? 
	if($jur=='MKU')
	{
		echo " ".MKU." ";
	}
	else if($jur=='MIPA')
	{
		echo " ".MIPA." ";
	}
	else if($jur=='ALL')
	{
		echo " Fakultas Teknik ";
	}
	else{
		$jurusan=getDetailJurusan($jur);
		echo " ".$jurusan['nama'];
	}
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <form name="frmCariJadwal" method="post" action="kelas_mk.php?jur=<? echo $jur;?>">
  <tr class="content">
    <td align="right" valign="middle">Cari berdasarkan nama / kode : </td>
    <td><input type="text" name="cjadwal" class="stext">
        <input type="submit" name="cmdCariJadwal" class="sbutton" value=" Cari "></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	<div class="listTable">
	<table width="645" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="26" rowspan="2">Hari</td>
        <td colspan="2" nowrap>Jam</td>
        <td width="45" rowspan="2" nowrap>Kode MK </td>
        <td width="170" rowspan="2" nowrap>Nama MK </td>
        <td width="21" rowspan="2" nowrap>KP</td>
        <td width="100" rowspan="2" nowrap>Dosen Pengajar </td>
        <td width="105" rowspan="2" nowrap>Setting</td>
        <td width="27" rowspan="2" nowrap>Kap</td>
        <td width="40" rowspan="2" nowrap>Ruang</td>
      </tr>
      <tr class="headerTable">
        <td width="34" nowrap>Mulai</td>
        <td width="42" nowrap>Selesai</td>
      </tr>
	  <?
	  	if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		
		if($_POST['cmdCariJadwal'])	{
			$cjadwal = $_POST['cjadwal'];
		}
		else	{
			$cjadwal = $_GET['cjadwal'];
		}
		
		$pages = ($page)*LM_DISPLAY;
	  	$jdw = getJadwalKlsMkJur($jur,$cjadwal,$pages);
		if($jdw)	{
			foreach($jdw as $display) {
	  ?>
      <tr>
        <td align="center"><? 
		  if($display['hari']=='1')	{
			echo "Senin";
		  }
		  else if($display['hari']=='2')	{
			echo "Selasa";
		  }
		  else if($display['hari']=='3')	{
			echo "Rabu";
		  }
		  else if($display['hari']=='4')	{
			echo "Kamis";
		  }
		  else if($display['hari']=='5')	{
			echo "Jumat";
		  }
		  else if($display['hari']=='6')	{
			echo "Sabtu";
		  }
		  ?></td>
        <td align="center"><? echo $display['jam_masuk'];?></td>
        <td align="center"><? echo $display['jam_keluar'];?></td>
        <td align="center"><? echo $display['kode_mk'];?></td>
        <td><?	echo $display['nama'];
		?></td>
        <td align="center"><? echo $display['kp'];?></td>
		
       
        <td><?
			$dsn = getDosenKls($display['kode_kelas']);
			if($dsn)	{
				foreach($dsn as $dosen)	{
					$namaDsn = getDetailDosen($dosen['kode_dosen']);
					echo $dosen['kode_dosen']." - ".$namaDsn['nama']."<br>";
				}
			}
			else	{
				echo "-";
			}
		?></td>
        <td><?
			$stg = getSettingKls($display['kode_kelas']);
			if($stg)	{
				foreach($stg as $setting)	{
					echo $setting['nrp_awal']." - ".$setting['nrp_akhir']."<br>";
				}
			}
			else	{
				echo "-";
			}
		?></td>
        <td align="center"><? echo $display['kapasitas'];?></td>
		<td align="center"><? echo $display['kode_ruang'];?></td>
      </tr><?
	  	}
	}
	else	{
	  ?>
	  <tr align="center">
        <td colspan="10">Tidak ada jadwal kelas mata kuliah</td>
      </tr>
	  <?
	  }
	  ?>
	   <tr align="center">
	     <td colspan="10"><? 
		 if(getPageCountJadwalKlsMkJur($jur,$cjadwal)>1)	{
					   if(($_GET['page']!=1)&&(($_GET['page'])))	{
							echo "<a href='kelas_mk.php?cjadwal=$cjadwal&jur=".$jur."&page=".(($page+1)-1)."'> ".Back." </a>";
						}
				for($i=getPagingKls($page);$i<=(getPageJadwalKlsMkJur($jur,$cjadwal,$page)+1);$i++)
				{
					if($i==getPagingKls($page)){
						if($page+1==$i) {
							echo "<b>".$i."</b>";
						}
						else {
							echo "<a href='kelas_mk.php?cjadwal=$cjadwal&jur=".$jur."&page=$i'>".$i."</a>";
						}
					}
					else{
						if($page+1==$i) {
							echo " - <b>".$i."</b>";
						}
						else {
							echo " - <a href='kelas_mk.php?cjadwal=$cjadwal&jur=".$jur."&page=$i'>".$i."</a>";
						}
					}
				}
				if(($_GET['page']<=(getPageJadwalKlsMkJur($jur,$cjadwal,$page))) && (getPageJadwalKlsMkJur($jur,$cjadwal,$page)>1)) 	{
					echo "<a href='kelas_mk.php?cjadwal=$cjadwal&jur=".$jur."&page=".(($page+1)+1)."'> ".Next." </a>";
				}
			}
	?></td>
	     </tr>
	   <tr align="center">
        <td colspan="10">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountJadwalKlsMkJur($jur,$cjadwal);?> </td>
      </tr>
    </table>
	</div></td>
  </tr>
  </form>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<?
		if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='kelas_mk.php?kelas=1'>";
		}?>[Kembali]</a>
		</td>
  </tr>
</table>
