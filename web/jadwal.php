<?
	session_start();
	include('inc/functions/connectdb.php');
	include('inc/functions/f_kls_mk.php');
	include('inc/functions/f_mhs.php');
	include('inc/functions/f_mk.php');
	include('inc/functions/f_dosen.php');
	include('inc/functions/f_ujian.php');
	include('inc/functions/f_fpp.php');
	include('inc/functions/f_prasyarat.php');
	$fpp = getAktifFpp();

?>

<?php
include_once('inc/_top.php');

?>

        <table width="671" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
      <tr>
        <td width="669" align="center" class="headerMenu">Jadwal Kuliah dan Ujian Kelas Mata Kuliah </td>
      </tr>
      <tr>
        <td><table width="677" border="0" cellspacing="0" cellpadding="0" class="content">
            <tr>
              <td width="675" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><?
			  if($_GET['detail_kls'])	{

			  	include("inc/detail_kls.php");

			  }
	else if($_GET['jadwal']==0)
	{
		if($_POST['cmdCariJadwal'])	{
			$cjadwal = $_POST['cjadwal'];
		}
		else	{
			$cjadwal = $_GET['cjadwal'];
		}
	?>
				 <form name="frmCariJadwal" method="post" action="jadwal.php?jadwal=0">
                      <table width="656" border="0" cellspacing="0" cellpadding="0">
                        <tr align="center">
                          <td colspan="2"><a href="/index.php/jadwal">Jadwal Kuliah Kelas Mata Kuliah </a>|<a href="index.php/jadwal_ujian"> Jadwal Ujian </a></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="subHeaderMenu">Jadwal Kuliah Kelas Mata Kuliah  </td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr class="content">
                          <td align="right" valign="middle">Cari berdasarkan nama / kode : </td>
                          <td><input type="text" name="cjadwal" class="stext" value="<? echo $cjadwal?>">
                              <input type="submit" name="cmdCariJadwal" class="sbutton" value=" Cari "></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center"> <div class="listTable"><table width="651" cellspacing="0" cellpadding="0">
                            <tr class="headerTable">
                              <td width="31" rowspan="2" nowrap>Hari</td>
                              <td colspan="2" nowrap>Jam</td>
                              <td width="40" rowspan="2" nowrap>Kode MK </td>
                              <td width="200" rowspan="2" nowrap>Nama MK </td>
                              <td width="10" rowspan="2" nowrap>KP</td>
                              <td width="95" rowspan="2" nowrap>Dosen Pengajar </td>
                              <td width="105" rowspan="2" nowrap>Setting</td>
                              <td width="29" rowspan="2" nowrap>Kap</td>
                              <td width="42" rowspan="2" nowrap>Ruang</td>
                              <td width="42" rowspan="2" nowrap>Sisa</td>
                            </tr>
                            <tr class="headerTable">
                              <td width="36" nowrap>Mulai</td>
                              <td width="46" nowrap>Selesai</td>
                            </tr>
                            <?
		if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}


		$pages = ($page)*LM_DISPLAY;
	  	$jdw = getJadwalKlsMkJur(getJurusanMhs($_SESSION['mhs_id']),$cjadwal,$pages);
		if($jdw)	{
			foreach($jdw as $display) {
	  ?>
                            <tr <?

							if($fpp['jenis']=='II')	{
								$kodeSblm = generateKodeFpp('I',$fpp['semester'],$fpp['tahun']);
							}
							else if($fpp['jenis']=='KK')	{
								$kodeSblm = generateKodeFpp('II',$fpp['semester'],$fpp['tahun']);
							}
							$fppSblm =  getDetailFpp($kodeSblm);

							if($display['kapasitas']<=$display['isi'])	{
								echo "class='klsPenuh'";
							}
							else if((date("Y-m-d H:i:s",strtotime($display['waktu_buka'])) > date("Y-m-d H:i:s",strtotime($fppSblm['waktu_tutup']))) && ($fpp['jenis']!='I') && ($fpp)){
								echo "class='klsBaru'";
							}
							else if($display['status_buka']=='0')	{
								echo "class='klsTutup'";
							}
							if($_SESSION['kls_fpp'])	{
								if(checkTelahDaftar($_SESSION['kls_fpp'],$display['kode_kelas'])==1)	{
									echo " id='klsSaya' ";
								}
							}
							?>
							>
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
                              <td align="center"><?
		  		if(getJurusanMhs($_SESSION['mhs_id'])==$display['kode_jur'])	{
					$kode_kls = base64_encode($display['kode_kelas']);
					echo $display['kode_mk'];
				}
		  ?></td>
                              <td><?
			$namaMk = getDetailMk($display['kode_mk']);
				if($display['status_buka']=='0' || checkTelahDaftar($_SESSION['kls_fpp'],$display['kode_kelas'])==1)	{
						echo $namaMk['nama'];
				}
				else	{
						echo "<a href='jadwal.php?detail_kls=$kode_kls'>".$namaMk['nama']."</a>";
				}
		?></td>
                              <td align="center"><? echo $display['kp'];?></td>
                              <td><?
			$dsn = getDosenKls($display['kode_kelas']);
			if($dsn)	{
				foreach($dsn as $dosen)	{
					$namaDsn = getDetailDosen($dosen['kode_dosen']);
					echo $namaDsn['nama']."<br>";
				}
			}
			else	{
				echo "-";
			}
		?></td>
                              <td align="center"><?
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
                              <td align="center"><? echo getKursiKosong($display['kode_kelas'],$display['kapasitas']);?></td>
                            </tr>
                            <?
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
                              <td colspan="11"><?
			if(getPageCountJadwalKlsMkJur(getJurusanMhs($_SESSION['mhs_id']),$cjadwal)>1)	{
			   if(($_GET['page']!=1)&&(($_GET['page'])))	{
					echo "<a href='jadwal.php?cjadwal=$cjadwal&page=".(($page+1)-1)."'> ".Back." </a>";
				}
				for($i=getPagingKls($page);$i<=(getPageJadwalKlsMkJur(getJurusanMhs($_SESSION['mhs_id']),$cjadwal,$page)+1);$i++)
				{
					if($i==1){
						if($page+1==$i) {
							echo "<b>".$i."</b>";
						}
						else {
							echo "<a href='jadwal.php?cjadwal=$cjadwal&page=$i'>".$i."</a>";
						}
					}
					else{
						if($page+1==$i) {
							echo " - <b>".$i."</b>";
						}
						else {
							echo " - <a href='jadwal.php?cjadwal=$cjadwal&page=$i'>".$i."</a>";
						}
					}
				}
				if(($_GET['page']<(getPageJadwalKlsMkJur(getJurusanMhs($_SESSION['mhs_id']),$cjadwal,$page))) && (getPageJadwalKlsMkJur(getJurusanMhs($_SESSION['mhs_id']),$cjadwal,$page)>1)) 	{
					echo "<a href='jadwal.php?cjadwal=$cjadwal&page=".(($page+1)+1)."'> ".Next." </a>";
				}
			}
	?></td>
                            </tr>
                            <tr align="center">
                              <td colspan="11">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountJadwalKlsMkJur(getJurusanMhs($_SESSION['mhs_id']),$cjadwal);?> </td>
                            </tr>
                          </table>
                          </div></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">
						<b>* Keterangan:</b>
						  <ul>
							<li>Warna <span class="klsPenuh">Merah</span> menandakan bahwa kapasitas kelas telah penuh.</li>
						    <li>Warna <span class="klsTutup">Abu-abu</span> menandakan bahwa kelas tersebut telah ditutup.</li>
						    <li>Warna <span class="klsBaru">Hijau </span> menandakan bahwa kelas tersebut adalah kelas baru.</li>
						    <li>Blok warna biru menandakan bahwa mata kuliah tersebut telah diterima atau didaftarkan.</li>
						    <li>Klik pada<strong> Nama MK </strong>untuk melihat detail kelas. </li>
						  </ul></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                      </table>
                  </form>
                  <?
	}
	else
	{
		?>
                      <table width="663" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center"><a href="jadwal.php">Jadwal Kelas Mata Kuliah </a>|<a href="jadwal.php?jadwal=1"> Jadwal Ujian </a></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="subHeaderMenu">Jadwal Ujian Mata Kuliah </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center">  <?
						$jurusan = getJurusanMhs($_SESSION['mhs_id']);
						$semester = getSemester();
						$tahun = getTahunAjaran();
						for($minggu=1;$minggu<3;$minggu++)	{

						?>
								 <br>
						  <div  class="listTable"><table width="658" cellspacing="0" cellpadding="0">
                            <tr class="headerTable">
                              <td colspan="7"><? echo "Minggu ke : ".$minggu; ?></td>
                            </tr>
                            <tr class="headerTable">
                              <td width="70" nowrap>Jam \ Hari</td>
                              <td width="100" nowrap>Senin</td>
                              <td width="100" nowrap>Selasa</td>
                              <td width="100" nowrap>Rabu</td>
                              <td width="100" nowrap>Kamis</td>
                              <td width="100" nowrap>Jum'at</td>
                              <td width="100" nowrap>Sabtu</td>
                            </tr>
                            <? 	for($jam=1;$jam<5;$jam++)	{
				?>
                            <tr>
                              <td align="center"><? echo $jam;?></td>
                              <? for($hari=1;$hari<7;$hari++) {

					?>
                              <td><? $ujian = displayUjian($jurusan,$jam,$hari,$minggu,$semester,$tahun);
						   if($ujian)	{
						   		$i=0;
								foreach($ujian as $display)	{
									$i++;
									$namaMk = getDetailMk($display['kode_mk']);
									if($i % 2 != 0)	{
										echo "<span class='genap'>";
									}
									else	{
										echo "<span class='ganjil'>";
									}
									echo $namaMk['nama']." (".getTotalKap($display['kode_mk']).")<span><br>";
								}
						   }
						   else	{
								echo "-";
						   }
					?></td>
                              <?
					}
					?>
                            </tr>
                            <?
					}
					?>
                          </table> </div><?

				}
						  ?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                    </table>

         <?
		}
	?>
              </td>
            </tr>
            <tr>
              <td><? if(!$_GET['detail_kls'])	{
			  	echo "<a href='daftar_mk.php'>[Kembali]</a>";
			  }?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table>
<?php
include_once('inc/_bottom.php');

?>
