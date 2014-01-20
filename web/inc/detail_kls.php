<?
	$kls = getDetailKlsMk(base64_decode($_GET['detail_kls']));
?>
<table width="520" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="subHeaderMenu"><? if($_GET['inf'])	{
						echo  "<a href='information.php'>Informasi Mata Kuliah</a>  &gt; <a href='information.php?kode_mk=".base64_encode($kls['kode_mk'])."'>Daftar Kelas Mata Kuliah </a> &gt; Detail Kelas Mata Kuliah";
					}
					else	{
						echo  "<a href='jadwal.php'>Jadwal Kelas Mata Kuliah</a>  &gt; Detail Kelas Mata Kuliah";
					}
					?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="427" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="250" align="right">Kode Mata Kuliah : </td>
                        <td width="276" class="labelContent">&nbsp;<? echo $kls['kode_mk'];?></td>
                      </tr>
                      <tr>
                        <td align="right">Nama Mata Kuliah : </td>
                        <td class="labelContent">&nbsp;<? $nama=getDetailMk($kls['kode_mk']);
								echo $nama['nama'];?></td>
                      </tr>
                      <tr>
                        <td align="right">Bobot : </td>
                        <td class="labelContent">&nbsp;<? echo $nama['sks']." SKS";?></td>
                      </tr>
                      <tr>
                        <td align="right">KP : </td>
                        <td class="labelContent">&nbsp;<? echo $kls['kp'];?></td>
                      </tr>
                      <tr>
                        <td align="right">Kapasitas : </td>
                        <td class="labelContent">&nbsp;<? echo $kls['kapasitas'];?></td>
                      </tr>
                      <tr>
                        <td align="right">Isi : </td>
                        <td class="labelContent">&nbsp;<? echo $kls['isi'];?></td>
                      </tr>
                      <tr>
                        <td align="right">Jumlah Peminat : </td>
                        <td class="labelContent">&nbsp;<? 
						$fpp = getAktifFpp();
						echo getPendaftarKls($fpp['kode_fpp'], $kls['kode_kelas'])?></td>
                      </tr>
                      <tr>
                        <td align="right">Status kelas :</td>
                        <td class="labelContent">&nbsp;<? if($kls['dmb']==1)	{
										echo "Dmb";
									}
									else	{
										echo "Tidak Dmb";
									}?></td>
                      </tr>
                      <tr>
                        <td align="right">Mata Kuliah Prasyarat : </td>
                        <td class="labelContent"><? $prasyarat = selectMkPrasyaratJur($kls['kode_mk'],getJurusanMhs($_SESSION['mhs_id']));
							if($prasyarat)	{
								foreach($prasyarat as $mk)	{
									$namaMk = getDetailMk($mk['mk_prasyarat']);
									echo "&nbsp;".$mk['mk_prasyarat']." ".$namaMk['nama']." (".$mk['nilai_min'].")<br>";
								}
							}
							else	{
								echo "-";
							}
						?></td>
                      </tr>
                    </table></td>
                  </tr>
				  <tr>
                    <td class="subHeaderMenu">Jadwal Ujian</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
				  <tr>
                    <td align="center"><div class="listTable">
					<table width="345" cellspacing="0" cellpadding="0">
                      <tr align="center" class="headerTable">
                        <td width="97">Minggu</td>
                        <td width="171">Hari </td>
                        <td width="75">Jam </td>
       				</tr>
                      <tr>
                        <td align="center"><? $ujian = getDetailUjianKls($kls['kode_kelas']);
											if($ujian)	{
												echo $ujian['minggu'];
											}
											else	{
												echo "-";
											}?></td>
                        <td align="center"><?
								
							  if($ujian['hari']=='1')	{
							  	echo "Senin";
							  }
							  else if($ujian['hari']=='2')	{
							  	echo "Selasa";
							  }
							  else if($ujian['hari']=='3')	{
							  	echo "Rabu";
							  }
							  else if($ujian['hari']=='4')	{
							  	echo "Kamis";
							  }
							  else if($ujian['hari']=='5')	{
							  	echo "Jumat";
							  }
							  else if($ujian['hari']=='6')	{
							  	echo "Sabtu";
							  }
							  else	{
							  	echo "-";
							  }
							  ?></td>
                        <td align="center"><? if($ujian)	{
												echo $ujian['jam'];
											}
											else	{
												echo "-";
											}?></td>
                      </tr>
                    </table></div></td>
                  </tr>
				  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="subHeaderMenu">Jadwal Kuliah</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">
					<div class="listTable">
					<table width="345" cellspacing="0" cellpadding="0">
                      <tr class="headerTable">
                        <td width="37">Hari</td>
                        <td width="76">Jam Masuk </td>
                        <td width="75">Jam Keluar </td>
                        <td width="96">Kode Ruang </td>
                      </tr>
                      <?
	  	$result = selectJadwalKls($kls['kode_kelas']);
		if($result)	{
			foreach($result as $display)	{
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
                        <td align="center"><? echo $display['kode_ruang'];?></td>
                      </tr>
                      <?
	  		}
	  	}
		else	{
	  ?>
                      <tr align="center">
                        <td colspan="4">Tidak ada Jadwal Kuliah</td>
                      </tr>
                      <?
	  }
	  ?>
                    </table></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="subHeaderMenu">Dosen Pengajar Kelas Mata Kuliah</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><div class="listTable"><table width="380" cellspacing="0" cellpadding="0">
                      <tr class="headerTable">
                        <td width="118">Kode Dosen </td>
                        <td width="291">Nama Dosen </td>
                      </tr>
                      <?
		$result = selectDosenKls($kls['kode_kelas']);
		if($result)	{
			foreach($result as $display)	{
	?>
                      <tr>
                        <td align="center"><? echo $display['kode_dosen'];?></td>
                        <td><?
			$dosen = getDetailDosen($display['kode_dosen']);
			echo $dosen['nama'];
		?></td>
                      </tr>
                      <?
			}
		}
		else	{ ?>
                      <tr align="center">
                        <td colspan="2">Dosen pengajar tidak ada</td>
                      </tr>
                      <?
		}
	?>
                    </table></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="subHeaderMenu">Setting Nrp Kelas Mata Kuliah </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><div class="listTable"><table width="285" cellspacing="0" cellpadding="0">
                      <tr class="headerTable">
                        <td width="131">Nrp Awal </td>
                        <td width="114">Nrp Akhir </td>
                      </tr>
                      <?
	  	$result = selectSettingKls($kls['kode_kelas']);
		if($result)	{
			foreach($result as $display)	{
	  ?>
                      <tr>
                        <td align="center"><? echo $display['nrp_awal'];?></td>
                        <td align="center"><? echo $display['nrp_akhir'];?></td>
                      </tr>
                      <?
	  		}
	  	}
		else	{
	  ?>
                      <tr align="center">
                        <td colspan="2">Tidak ada setting nrp </td>
                      </tr>
                      <?
	  }
	  ?>
                    </table></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">
					
					<?php
					/*
					<form name="frmDaftarKelas" method="post" action="daftar_mk.php">
					<? 	$fpp =  getAktifFpp(); 
						if($fpp['jenis']=='KK')	{
							echo "<input type='hidden' name='addKK' value='".$kls['kode_kelas']."'>";
						}
						else	{
							echo "<input type='hidden' name='add' value='".$kls['kode_kelas']."'>";
						}?>
						<input type="submit" class="sbutton" name="cmdAdd" value="Daftar Kelas Mata Kuliah">
					</form>
					*/
					?>
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><?
					if($_GET['inf'])	{
						echo  "<a href='information.php?kode_mk=".base64_encode($kls['kode_mk'])."'>[Kembali]</a>";
					}
					else	{
						echo  "<a href='jadwal.php'>[Kembali]</a>";
					}
					?></td>
                  </tr>
                </table>
