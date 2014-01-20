<?
	$mhs= getDetailMhs($_SESSION['mhs_id']);
    $tambah = getDetailSks($bukaFpp['semester'],$bukaFpp['tahun'],$_SESSION['mhs_id']);
  $error=$_REQUEST['error'];

?>

<table width="530" border="0" cellspacing="0" cellpadding="0" class="content">
  <tr>
    <td width="530" align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td align="center" ><span class="warning">
      <?
		if($error==1)	{
			echo "Pengisian data kurang lengkap";
		}
		else if($error==2)	{
			echo "Kode MK dan KP tidak ada / tutup";
		}
		else if($error==3)	{
			echo "Data sudah ada";
		}
		else if($error==4)	{
			echo "Terjadi tubrukan jadwal kuliah";
		}
		else if($error==5)	{
			echo "Terjadi tubrukan jadwal ujian";
		}
		else if($error==6)	{
			echo "Mata kuliah yang telah diterima tidak boleh dihapus";
		}
		else if($error==7)	{
			echo "Mata kuliah Prasyarat tidak terpenuhi";
		}
		else if($error==8)	{
			echo "Jumlah total SKS melebihi SKS maksimum";
		}
		else if($error==11)	{
			echo "Status mata kuliah sebagai prasyarat paralel";
		}
		else if($error=='12')	{
			echo "Kapasitas kelas penuh";
		}
		else if($error==13)	{
			echo "Hapus kelas pengganti terlebih dahulu";
		}
		else if($inf==1)	{
			echo "<span class='information'>Pendaftaran kelas mata kuliah telah dibatalkan</span>";
		}
		else if($inf==2)	{
			echo "<span class='information'>Pendaftaran telah tercatat</span>";
		}
		else if($inf==3)	{
			echo "<span class='information'>Proses Kasus Khusus telah berhasil dilakukan</span>";
		}
		else if($error==9)	{
			echo "Data telah tercatat";
		}
		else if($error==10)	{
			echo "Error pada pembatalan kelas";
		}
		if($pesan!=1)	{
			echo $pesan;
		}
		?>
    </span></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="right" class="subHeaderMenu">Data Mahasiswa </td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td class="labelContent">&nbsp;</td>
      </tr>
      <tr>
        <td width="255" align="right">Nrp : </td>
        <td width="245" class="labelContent">&nbsp;<? echo $mhs['nrp'];?></td>
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
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="508" border="0" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td colspan="5">Daftar Mata Kuliah yang telah diterima </td>
        </tr>
      <tr class="headerTable">
        <td width="82">Kode MK</td>
        <td width="325">Nama MK </td>
        <td width="30">KP</td>
        <td width="30">SKS</td>
        <td width="52">Batal</td>
      </tr>
      <?
	  		$result= selectAllTerimaKls($_SESSION['mhs_id'],$bukaFpp['semester'],$bukaFpp['tahun']);
			if($result)	{
				$totalSks=0;
				foreach($result as $kelas_mk)	{
					$kelas=getDetailKlsMk($kelas_mk['kode_kelas']);
					$mk =getDetailMk($kelas['kode_mk']);
					$totalSks+=$mk['sks'];
			  ?>
      <tr>
        <td align="center"><? echo $kelas['kode_mk'];?></td>
        <td><? $nama=getDetailMk($kelas['kode_mk']);
						echo $nama['nama'];?></td>
        <td align="center"><? echo $kelas['kp'];?></td>
        <td align="center"><? echo $mk['sks'];?></td>
        <td align="center"><a href="daftar_mk.php?batal=<? echo base64_encode($kelas_mk['kode_kelas']);?>">Proses</a></td>
      </tr>
      <?
	 		}
			?>
      <tr>
        <td colspan="5" align="right">Total SKS : <? echo $totalSks;?></td>
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
	</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<form name="frmInputKls" method="post" action="daftar_mk.php">
	  <table width="499" border="0" cellspacing="0" cellpadding="0">
        <tr >
          <td colspan="2" class="subHeaderMenu">Daftar Mata Kuliah Baru</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="250"><div align="right">Kode MataKuliah :</div></td>
          <td width="249"><input type="text" name="txtKodeMkKK" class="stext" size="6" id="kodeMk" onChange="getNamaMkMhs()"></td>
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
      </table>
	</form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><div class="listTable">
      <table width="511" cellpadding="0" cellspacing="0" >
        <tr class="headerTable">
          <td colspan="7">Permintaan Kasus Khusus yang akan diproses </td>
          </tr>
        <tr class="headerTable">
          <td width="60">Kode MK </td>
          <td width="241"> Nama MK </td>
          <td width="29">KP</td>
          <td width="30">SKS</td>
          <td width="55">Status</td>
          <td width="55">Keterangan</td>
          <td width="39">Hapus</td>
        </tr>
        <?
			$daftarKls = $_SESSION['kls_fpp'];
			$sksTot=0;
			$sksPending=0;
			$sksBatal=0;
			if($daftarKls)	{
				foreach($daftarKls as $tampil)	{
					if($tampil['status']!='1')	{
						$kelas = getDetailKlsMk($tampil['kode_kelas']);
						$mataKuliah = getDetailMk($kelas['kode_mk']);
						$kode =$tampil['kode_kelas'];
			?>
        <tr>
          <td align="center"><? echo $kelas['kode_mk']; ?></td>
          <td><? echo $mataKuliah['nama']; ?></td>
          <td align="center"><? echo $kelas['kp']; ?></td>
          <td align="center"><? echo $mataKuliah['sks']; ?></td>
          <td align="center"><?
			  $dmb = getDetailMkJur($kelas['kode_mk'],getJurusanMhs($nrp));
				if($tampil['status']=='1'){
					echo "DITERIMA";
				}
				else if($tampil['status']=='2'){
					echo "DITOLAK";
				}
				else if($tampil['status']=='3'){
					echo "BATAL";

					if($dmb['status_bebas']=='0')	{
						$sksBatal+=$mataKuliah['sks'];
					}
				}
				else {
					echo "PENDING";

					if($dmb['status_bebas']=='0')	{
						$sksPending+=$mataKuliah['sks'];
					}

				}
				 ?></td>
          <td><?
		  	if($tampil['status']!='3'){
		  		$nrp = $_SESSION['mhs_id'];
				$kode_fpp = $bukaFpp['kode_fpp'];
				$semester = $bukaFpp['semester'];
				$tahun = $bukaFpp['tahun'];
		  		if(checkPrasyarat($daftarKls,$nrp,$kode_fpp,$tampil['kode_kelas'])==false)	{
					echo "Prasyarat Tidak Terpenuhi<br>";
				}

				if(checkJadwalTubrukan($daftarKls,$nrp,$semester,$tahun,$tampil['kode_kelas'])==true)	{
					echo "Tubrukan Jadwal Kuliah<br>";
				}

				if(checkUjianTubrukan($daftarKls,$nrp,$semester,$tahun,$tampil['kode_kelas'])==true)	{
					echo "Tubrukan Jadwal Ujian<br>";
				}


				echo "&nbsp;";
			}
			else	{
				echo "&nbsp;";
			}
		  ?></td>
          <td align="center"><? echo "<a href='javascript:void(0);' onClick=deleteMk('$kode')><img src='images/ico/delete.png'></a>"?></td>
        </tr>
        <?
						$sksTot = $sksTot + $mataKuliah['sks'];

					}
				}
			}
			else	{	?>
        <tr align="center">
          <td colspan="7">Tidak ada kelas kuliah yang terdaftar </td>
        </tr>
        <?

			}
		?>
		 <tr align="right">
          <td colspan="7">Jumlah SKS Batal : <b><? echo $sksBatal;?></b> &nbsp;Jumlah SKS Pending : <b><? echo $sksPending;?></b>&nbsp; Sisa SKS yang Dapat Diambil :<b> <? echo ($mhs['sksmax']+$tambah['jml_sks']-getSksTerpakaiMhs($mhs['nrp'],getSemester(),getTahunAjaran()))-($sksPending-$sksBatal);?></b>
			</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><form name="frmProsesKK" method="post" action="daftar_mk.php">
		<input type="submit" name="cmdProses" class="sbutton" value="Proses Kasus Khusus"   onClick="return confirmSubmit()">
	</form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>* Keterangan:</b>
      <ul>
	  	<li>Perwalian <strong><? echo $bukaFpp['jenis'];?></strong> akan berakhir pada <span class="klsPenuh"><strong><? echo date("d F Y - g:i a",strtotime($bukaFpp['waktu_tutup']));?></strong></span>. </li>
		<li> Pembatalan mata kuliah yang bersifat paralel harus dilakukan dengan menginputkan mata kuliah yang sejenis dahulu baru atau dengan membatalkan mata kuliah yang mempunyai prasyarat paralel terhadap mata kuliah tersebut.</li>
		<li> Pergantian KP mata kuliah dapat dilakukan dengan cara melakukan pembatalan terlebih dahulu pada KP lama setelah itu baru dilakukan penginputan KP yang baru.</li>
        <li> Kasus khusus akan diterima apabila semua permintaan dapat dilakukan. </li>
		<li> Apabila ada permintaan yang tidak dapat dilakukan maka semua permintaan akan ditolak. </li>
    </ul></td>
  </tr>
</table>