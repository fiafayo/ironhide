<?
	session_start();
	include('inc/functions/connectdb.php');
	include('inc/functions/f_mhs.php');
	include('inc/functions/f_fpp.php');
	include('inc/functions/f_kls_mk.php');
	include('inc/functions/f_mk.php');
	include('inc/functions/f_tambah_sks.php');
	
	$bukaFpp = getAktifFpp();
        include_once('inc/_top.php');
?>


            <table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
  <tr>
    <td width="537" class="headerMenu">Hasil Perwalian <? echo $bukaFpp['jenis']."  ".$bukaFpp['semester']." ".$bukaFpp['tahun'];?></td>
  </tr>
  <tr>
    <td align="center">
	<?
	//if(($bukaFpp) && (checkStatusMhs($_SESSION['mhs_id'])==""))	{
		$mhs = getDetailMhs($_SESSION['mhs_id']);
	?>
      <table width="522" border="0" cellspacing="0" cellpadding="0" class="content">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Nrp : </td>
          <td align="left"><b><? echo $mhs['nrp'];?></b></td>
        </tr>
        <tr>
          <td align="right">Nama : </td>
          <td align="left"><b><? echo $mhs['nama'];?></b></td>
        </tr>
        <tr>
          <td align="right">Jumlah SKS maksimum yang dapat diambil : </td>
          <td align="left"><b><? $tambah = getDetailSks(getSemester(),getTahunAjaran(),$_SESSION['mhs_id']);
		  	if($bukaFpp['jenis']!='I')	{
				$ava = $tambah['jumlah_sks'] + $mhs['sksmax'];
			}
			else	{
				$ava = $mhs['sksmax'];
			}
			echo $ava;
		  ?></b></td>
        </tr>
        <tr>
          <td align="right">Jumlah SKS yang terpakai :</td>
          <td align="left"><b><? 
		  $total = getSksTerpakaiMhs($mhs['nrp'],getSemester(),getTahunAjaran());
		  if($total == " ")	{
		  	echo "0";
		  }
		  else	{
		  	echo $total;
		  }?></b></td>
        </tr>
        <tr>
          <td width="261" align="right">Jumlah SKS sisa : </td>
          <td width="259" align="left"><strong><? echo $ava-$total;?></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><div class="listTable">
              <table width="487" border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td colspan="5" class="headerTable">FPP I </td>
                </tr>
                <tr class="headerTable">
                  <td width="79">Kode MK</td>
                  <td width="285">Nama MK </td>
                  <td width="50">KP</td>
                  <td width="30">SKS</td>
                  <td width="42">Status</td>
                </tr>
                <?
	  		$result= hasilPerwalianMhs('I',getSemester(),getTahunAjaran(),$_SESSION['mhs_id']);
			if($result)	{
				$totalSks=0;
				foreach($result as $kelas_mk)	{
					$kelas=getDetailKlsMk($kelas_mk['kode_kelas']);
			  ?>
                <tr>
                  <td align="center"><? echo $kelas['kode_mk'];?></td>
                  <td><? $nama=getDetailMk($kelas['kode_mk']);
				  		  if($kelas_mk['status']=='2')	{
								echo "<a href='information.php?kode_mk=".$kelas['kode_mk']."&hasil=1'>".$nama['nama']."</a>";
						  }
						  else	{
							  echo $nama['nama'];
						  }
						?></td>
                  <td align="center"><? echo $kelas['kp'];?></td>
                  <td align="center"><? $sks=getDetailMk($kelas['kode_mk']);
						echo $sks['sks'];
						if($kelas_mk['status']=='1')	{
							$totalSks+=$sks['sks'];
						  }
						?></td>
                  <td align="center"><? 
				  if($kelas_mk['status']=='1')	{
				  	echo "Diterima";
				  }
				  else if($kelas_mk['status']=='2')	{
				  	echo "Ditolak";
				  }
				  else if($kelas_mk['status']=='0')	{
				  	echo "None";
				  }
				  ?></td>
                </tr>
                <?
	 		}
			?>
                <tr>
                  <td colspan="5" align="right">Total SKS kelas mata kuliah yang diterima : <? echo $totalSks;?></td>
                </tr>
                <?
	 	}
		else	{
			?>
                <tr>
                  <td colspan="5" align="center">Tidak ada hasil perwalian</td>
                </tr>
                <?
		}
	 ?>
              </table>
          </div>
		  </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><div class="listTable">
              <table width="487" border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td colspan="5" class="headerTable">FPP II </td>
                </tr>
                <tr class="headerTable">
                  <td width="79">Kode MK</td>
                  <td width="287">Nama MK </td>
                  <td width="46">KP</td>
                  <td width="31">SKS</td>
                  <td width="43">Status</td>
                </tr>
                <?
	  		$result= hasilPerwalianMhs('II',getSemester(),getTahunAjaran(),$_SESSION['mhs_id']);
			if($result)	{
				$totalSks=0;
				foreach($result as $kelas_mk)	{
					$kelas=getDetailKlsMk($kelas_mk['kode_kelas']);
			  ?>
                <tr>
                  <td align="center"><? echo $kelas['kode_mk'];?></td>
                  <td><? $nama=getDetailMk($kelas['kode_mk']);
						echo $nama['nama'];?></td>
                  <td align="center"><? echo $kelas['kp'];?></td>
                  <td align="center"><? $sks=getDetailMk($kelas['kode_mk']);
						echo $sks['sks'];
						if($kelas_mk['status']=='1')	{
							$totalSks+=$sks['sks'];
						  }
						?></td>
                  <td align="center"><? 
				  if($kelas_mk['status']=='1')	{
				  	echo "Diterima";
				  }
				  else if($kelas_mk['status']=='2')	{
				  	echo "Ditolak";
				  }
				  else if($kelas_mk['status']=='0')	{
				  	echo "None";
				  }
				  ?></td>
                </tr>
                <?
	 		}
			?>
                <tr>
                  <td colspan="5" align="right">Total SKS kelas mata kuliah yang diterima :<? echo $totalSks;?></td>
                </tr>
                <?
	 	}
		else	{
			?>
                <tr align="center">
                  <td colspan="5">Tidak ada hasil perwalian</td>
                </tr>
                <?
		}
	 ?>
              </table>
          </div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"><div class="listTable">
              <table width="487" border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td colspan="5" class="headerTable">Kasus Khusus</td>
                </tr>
                <tr class="headerTable">
                  <td width="77">Kode MK</td>
                  <td width="328">Nama MK </td>
                  <td width="40">KP</td>
                  <td width="21">SKS</td>
                  <td width="20">Status</td>
                </tr>
                <?
	  		$result= hasilPerwalianMhs('KK',getSemester(),getTahunAjaran(),$_SESSION['mhs_id']);
			if($result)	{
				$totalSks=0;
				foreach($result as $kelas_mk)	{
					$kelas=getDetailKlsMk($kelas_mk['kode_kelas']);
			  ?>
                <tr>
                  <td align="center"><? echo $kelas['kode_mk'];?></td>
                  <td><? $nama=getDetailMk($kelas['kode_mk']);
						echo $nama['nama'];?></td>
                  <td align="center"><? echo $kelas['kp'];?></td>
                  <td align="center"><? $sks=getDetailMk($kelas['kode_mk']);
						echo $sks['sks'];
						 if($kelas_mk['status']=='1')	{
							$totalSks+=$sks['sks'];
					 	 }
						?></td>
                  <td align="center"><? 
				  if($kelas_mk['status']=='1')	{
				  	echo "Diterima";
				  }
				  else if($kelas_mk['status']=='2')	{
				  	echo "Ditolak";
				  }
				  else if($kelas_mk['status']=='0')	{
				  	echo "None";
				  }
				  ?></td>
                </tr>
                <?
	 		}
			?>
                <tr>
                  <td colspan="5" align="right">Total SKS kelas mata kuliah yang diterima :<? echo $totalSks;?></td>
                </tr>
                <?
	 	}
		else	{
			?>
                <tr align="center">
                  <td colspan="5">Tidak ada hasil perwalian</td>
                </tr>
                <?
		}
	 ?>
              </table>
          </div></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><b>* Keterangan:</b>
            <ul>
              <li>Klik pada <strong>Nama Mata Kuliah</strong> yang ditolak untuk melihat KP alternatif dari mata kuliah tersebut. </li>
            </ul></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
      </table>
      <?
	//}
	/*else	{
	?>
      <table width="523" border="0" cellspacing="0" cellpadding="0" class="content">
        <tr>
          <td width="521">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="warning"><?
			$status = checkStatusMhs($_SESSION['mhs_id']);
			if($status!="")	{
				echo "Anda sedang mengalami status $status <br> Silakan menghubungi administrator untuk keterangan lebih lanjut";
			}
			else	{
				echo "Saat ini tidak ada proses perwalian yang dibuka <br><br> Jadwal Perwalian pada semester ".getSemester()." ".getTahunAjaran()." adalah sebagai berikut :<br>";
				$tampil = selectJadwalFpp(getSemester(),getTahunAjaran());
				foreach($tampil as $fpp)	{
					echo "<br><br>".$fpp['jenis']." <br>Mulai :  ".date("d F Y g:i a",strtotime($fpp['waktu_buka']))." <br> Selesai : ".date("d F Y g:i a",strtotime($fpp['waktu_tutup']))."<br>";
				}
			}
		?>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    <?
	}*/
	?></td>
  </tr>
</table>
<?php
include_once('inc/_bottom.php');

?>