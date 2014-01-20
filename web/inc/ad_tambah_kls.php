<?

		//PROSES PENGUBAHAN STATUS
		if($_GET['status']==1)	{
			bukaTutupKelas($_GET['kode'],0);
		}
		else if($_GET['status']==0){
			bukaTutupKelas($_GET['kode'],1);
		}
		
		//PROSES PENGHAPUSAN
		if($_GET['del'])	{
			$kode_kelas = $_GET['kodeDel'];
			if(checkUsedKlsMk($kode_kelas)==0)	{
				$kelas = deleteKlsMk($kode_kelas);
				if($kelas)	{
					$inf = "Data telah terhapus";
				}
			}
			else	{
				$error = "Data telah terpakai";
			}
		}
		//PROSES PENYIMPANAN
	if($_POST['cmdSimpan'])	{
		$kodeMk = $_POST['slcKodeMk'];
		$jurLain = getCheckJurMk($kodeMk);
		$status = 0;
		foreach($jurLain as $check)
		{
			$temp = "chkJurusan".$check['kode_jur'];
			if($_POST[$temp]!="")	{
				$status =1;
			}
		}
		
		if(($_POST['slcKodeMk']!="") && ($_POST['txtKp']!="") && ($_POST['txtKapasitas']!="") && ($status==1))
		{
			$sem = getSemester();
			$thnAjaran = getTahunAjaran();
			if(checkDuplicateKlsMk($_POST['slcKodeMk'],$_POST['txtKp'],$sem,$thnAjaran)>0)	{
				$error = "Kelas Mata kuliah tersebut telah ada";
			}
			else	{
				$kp = strtoupper($_POST['txtKp']);
				$kap = $_POST['txtKapasitas'];
				
				if($_POST['chkDmb']==1)	{
					$dmb = 1;
				}
				else	{
					$dmb = 0;
				}
				$result = insertKlsMk($kodeMk,$kp,$kap,$sem,$thnAjaran,$dmb);
				

				foreach($jurLain as $insert)	{
					$temp = "chkJurusan".$insert['kode_jur'];
					if($_POST[$temp]!="")	{
						$result=insertKlsMkJur($kodeMk,$kp,$sem,$thnAjaran,$insert['kode_jur']);
					}
				}
				
				if($result)	{
					$inf = "Kelas Mata kuliah telah berhasil disimpan";
				}
				else	{
					$error = "Kelas Mata kuliah gagal disimpan";
				}
				
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
		
	if($_POST['cmdEdit'])	{
		$kode_kelas = $_GET['kode'];
		$kls = getDetailKlsMk($_GET['kode']);
		$jurLain = getCheckJurMk($kls['kode_mk']);
		$status = 0;
		foreach($jurLain as $check)
		{
			$temp = "chkJurusan".$check['kode_jur'];
			if($_POST[$temp]!="")	{
				$status =1;
			}
		}
		
		
		if(($_POST['txtKapasitas']!="") && ($status==1))
		{
			$kap = $_POST['txtKapasitas'];
			if($_POST['chkDmb']==1)	{
				$dmb = 1;
			}
			else	{
				$dmb = 0;
			}
			
			$result = editKlsMk($kode_kelas,$kap,$dmb);
			$delKelas = deleteKlsJur($kode_kelas);
			
			foreach($jurLain as $insert)	{
				$temp = "chkJurusan".$insert['kode_jur'];
				if($_POST[$temp]!="")	{
					$result = insertKlsMkJur($kls['kode_mk'],$kls['kp'],getSemester(),getTahunAjaran(),$insert['kode_jur']);
				}
			}
			
			
			if($result)	{
				$inf = "Kelas Mata kuliah telah berhasil diubah";
			}
			else	{
				$error = "Kelas Mata kuliah gagal diubah";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
?>

<table width="654" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="658" align="center">
	<?
		if($_GET['new'])	{ ?>
		<form name="frmTambahKelas" method="post" action="kelas_mk.php?tambah=1&jur=<? echo $jur;?>&new=1">
		<table width="619" border="0" cellpadding="0" cellspacing="0">
              <tr align="center">
					<td colspan="2" class="subHeaderMenu"><? if($_SESSION['paj_id'])	{
				echo "<a href='index.php'>";
			}
			else	{
				echo "<a href='kelas_mk.php?kelas=1'>";
			}?>Manage Jadwal Kelas Mata Kuliah
                  </a>
                &gt; Input Kelas Mata Kuliah                
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
	?></td>
              </tr>
              <tr align="center">
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr align="center">
                <td colspan="2"><?
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
                <td width="306">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right"> Kode Mata Kuliah : </td>
                <td width="313"><select name="slcKodeMk" class="stext" id="kodeMk" onChange="getMkJur('<? echo $jur;?>')">
					<option>- pilih kode MK - </option>
					<? $mk = selectMkJurDrop($jur);
						foreach($mk as $display)	{
							$nama = getDetailMk($display['kode_mk']);
					?>
					<option value="<? echo $display['kode_mk'];?>"><? echo $display['kode_mk']." - ".$nama['nama'];?></option>
					<?
					}
					?>
				</select></td>
              </tr>
              <tr>
                <td align="right">Nama Mata Kuliah : </td>
                <td class="labelContent">&nbsp;<span id="namaMk">None</span></td>
              </tr>
              <tr>
                <td><div align="right">KP : </div></td>
                <td><input name="txtKp" type="text" class="stext" size="4" maxlength="2"></td>
              </tr>
              <tr>
                <td><div align="right">Kapasitas : </div></td>
                <td><input type="text" name="txtKapasitas" class="stext" size="5"></td>
              </tr>
              <tr>
                <td align="right">Status : </td>
                <td class="labelContent"><input type="checkbox" value="1" name="chkDmb" >
                  Dmb</td>
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
                <td align="right" valign="middle">Jurusan : </td>
                <td class="labelContent"><span id="cbJurusan">None</span>
				</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="cmdSimpan" value="Simpan" class="sbutton">
                <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='kelas_mk.php?kelas=1'>";
		}?>[Kembali]</a></td>
                <td>&nbsp;				</td>
              </tr>
          </table>
	    </form>
 <?
	}
	elseif($_GET['edit'])	{
	
		$kode_kelas = $_GET['kode'];
		$kls = getDetailKlsMk($_GET['kode']);
		?>
		<form name="frmEditKelas" method="post" action="kelas_mk.php?tambah=1&edit=1&jur=<? echo $jur;?>&kode=<? echo $_GET['kode'];?>">
		<table width="623" border="0" cellpadding="0" cellspacing="0">
              <tr align="center">
                <td colspan="2" class="subHeaderMenu"><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='kelas_mk.php?kelas=1'>";
		}?>Manage Jadwal Kelas Mata Kuliah
                </a> &gt; Edit Kelas Mata Kuliah 
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
	?></td>
              </tr>
              <tr align="center">
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr align="center">
                <td colspan="2"><?
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
                <td width="261">&nbsp;</td>
                <td width="334">&nbsp;</td>
              </tr>
              <tr>
                <td align="right" >Kode Mata Kuliah : </td>
                <td class="labelContent">&nbsp;<? echo $kls['kode_mk'];?></td>
              </tr>
              <tr>
                <td><div align="right">KP : </div></td>
                <td class="labelContent">&nbsp;<? echo $kls['kp'];?></td>
              </tr>
              <tr>
                <td><div align="right">Kapasitas : </div></td>
                <td><input type="text" name="txtKapasitas" class="stext" size="5" value="<? echo $kls['kapasitas'];?>"></td>
              </tr>
              <tr>
                <td align="right">Status : </td>
                <td><input type="checkbox" value="1" name="chkDmb" <? 
					if($kls['dmb'] == '1')	{
						echo " checked";
					}
				?>>
                  DMB</td>
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
                <td align="right" valign="middle">Jurusan : </td>
                <td>
				<?
					
					$jurLain = getCheckJurMk($kls['kode_mk']);
					foreach($jurLain as $tampil)
					{
						if(checkKlsMkJur($kls['kode_kelas'],$tampil['kode_jur'])==1)	{
							echo "<input type='checkbox' value='".$tampil['kode_jur']."' name='chkJurusan".$tampil['kode_jur']."' checked>".$tampil['nama']."<br>";
						}
						else	{
							echo "<input type='checkbox' value='".$tampil['kode_jur']."' name='chkJurusan".$tampil['kode_jur']."'>".$tampil['nama']."<br>";
						}
					}
				?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="cmdEdit" value=" Edit " class="sbutton">
				<input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          </table>
	    </form>
		<?
	}
	else	{
		if($_GET['jadwal'])	{
			include('../inc/ad_jadwal_kls.php');
		}
		else if($_GET['setting'])	{
			include('../inc/ad_setting_nrp.php');
		}
		else if($_GET['dosen'])	{
			include('../inc/ad_dosen_kls.php');
		}
		else	{

               
?>
			<table width="632" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td colspan="2" align="center" class="subHeaderMenu"><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='kelas_mk.php?kelas=1'>";
		}?>Manage Jadwal Kelas Mata Kuliah
				</a> &gt; Status Kelas Mata Kuliah 
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
	?></td>
			  </tr>
			  <tr>
			    <td colspan="2" align="center">&nbsp;</td>
		      </tr>
			  <tr>
			    <td colspan="2" align="center"><?
			if($error)
			{
				echo "<div class='warning'>".$error."</div>";
			}
			else if($inf)
			{
				echo "<div class='information'>".$inf."</div>";
			}
		?></td>
		      </tr>
			  <tr>
			    <td width="639" align="right" valign="middle">&nbsp;</td>
			    <td width="639">&nbsp;</td>
		      </tr>
			  <form name="frmCariKls" method="post" action="kelas_mk.php?tambah=1&jur=<? echo $jur;?>&page=1">
			  <tr>
                <td align="right" valign="middle">Cari berdasarkan nama / kode : </td>
                <td><input type="text" name="ckls" class="stext">
                    <input type="submit" name="cariKls" class="sbutton" value=" Cari ">
                    </td>
		      </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
				<td colspan="2">
				<div class="listTable">
				<table width="646" cellspacing="0" cellpadding="0">
				  <tr class="headerTable">
					<td width="53" >Kode MK </td>
					<td width="203">Nama</td>
					<td width="21">KP</td>
					<td colspan="2">Status Jadwal </td>
					<td colspan="2">Setting Nrp </td>
					<td colspan="2">Status Dosen </td>
					<td width="32">Buka</td>
				    <td width="32">Edit</td>
				    <td width="41">Hapus</td>
				  </tr>
				  <?
						if($_GET['page']) {
							$page = $_GET['page']-1;
						}
						else {
							$page = 0;
						}
						$pages = ($page)*LM_DISPLAY;
						
						if($_POST['cariKls'])	{
							$ckls = $_POST['ckls'];
						}
						else	{
							$ckls = $_GET['ckls'];
						}
						$kelasMk = selectKlsJur($pages,$jur,$ckls);
						if($kelasMk)	{
							foreach($kelasMk as $display)	{
							?>
				  <tr>
					<td align="center"><? echo $display['kode_mk'];?></td>
					<td><? echo $display['nama'];?></td>
					<td align="center"><? echo $display['kp'];?>					  </td>
					<td width="62" align="center"><?
						$jadwal = checkJadwalKls($display['kode_kelas']);
						if($jadwal>0)	{
							echo "<img src='../images/ico/done.png'";
						}
						else	{
							echo "<img src='../images/ico/none.png'";
						}
					?></td>
					<td width="29"><a href="kelas_mk.php?tambah=1&jadwal=1&jur=<? echo $jur;?>&kode=<? echo $display['kode_kelas'];?>"><img src="../images/ico/edit.png"></a></td>
					<td width="54" align="center"><?
						$dosen = checkSettingKls($display['kode_kelas']);
						if($dosen>0)	{
							echo "<img src='../images/ico/done.png'";
						}
						else	{
							echo "<img src='../images/ico/none.png'";
						}?>
					</td>
					<td width="29"><a href="kelas_mk.php?tambah=1&setting=1&jur=<? echo $jur?>&kode=<? echo $display['kode_kelas'];?>"><img src="../images/ico/edit.png"></a></td>
					<td width="59" align="center"><?
						$setting = checkDosenKls($display['kode_kelas']);
						if($setting>0)	{
							echo "<img src='../images/ico/done.png'";
						}
						else	{
							echo "<img src='../images/ico/none.png'";
						}?></td>
					<td width="29"><a href="kelas_mk.php?tambah=1&dosen=1&jur=<? echo $jur;?>&kode=<? echo $display['kode_kelas'];?>"><img src="../images/ico/edit.png"></a></td>
					<td align="center">
					<? if($display['status_buka']=='1')	{ 
							///echo"<a href='kelas_mk.php?tambah=1&status=1&jur=$jur&kode=".$display['kode_kelas']."'><img src='../images/ico/done.png'></a>";
							echo"<img src='../images/ico/done.png'>";
					 	}
						else if($display['status_buka']=='0')	{
							echo "<a href='kelas_mk.php?tambah=1&status=0&jur=$jur&kode=".$display['kode_kelas']."'><img src='../images/ico/none.png'></a>";
							
						}
					 ?>
					</td>
				    <td align="center"><a href="kelas_mk.php?tambah=1&edit=1&jur=<? echo $jur;?>&kode=<? echo $display['kode_kelas'];?>"><img src="../images/ico/edit.png"></a>					</td>
				    <td align="center"><a href="kelas_mk.php?tambah=1&del=1&jur=<? echo $jur;?>&kodeDel=<? echo $display['kode_kelas'];?>"><img src="../images/ico/delete.png"></a></td>
				  </tr>
				  <?
							}
						}
						else	{
						?>
				  <tr align="center">
					<td colspan="12">Tidak ada kelas yang dibuka</td>
				  </tr>
				  <?
						}
						?>
				  <tr align="center">
				    <td colspan="12"><? 
			if( getPageCountKlsJur($jur,$ckls)>1)	{
			  if(($_GET['page']!=1)&&(($_GET['page'])))	{
				echo "<a href='kelas_mk.php?ckls=$ckls&tambah=1&jur=".$jur."&page=".(($page+1)-1)."'> ".Back." </a>";
			  }
					for($i=getPagingKls($page);$i<=(getPageKlsJur($jur,$ckls,$page)+1);$i++)
					{
						if($i==getPagingKls($page)){
							if($page+1==$i) {
								echo "<b>".$i."</b>";
							}
							else {
								echo "<a href='kelas_mk.php?ckls=$ckls&tambah=1&jur=".$jur."&page=$i'>".$i."</a>";
							}
						}
						else{
							if($page+1==$i) {
								echo " - <b>".$i."</b>";
							}
							else {
								echo " - <a href='kelas_mk.php?ckls=$ckls&tambah=1&jur=".$jur."&page=$i'>".$i."</a>";
							}
						}
					}
			if($_GET['page']<=(getPageKlsJur($jur,$ckls,$page)) &&(getPageKlsJur($jur,$ckls,$page)>1) )	{
				echo "<a href='kelas_mk.php?ckls=$ckls&tambah=1&jur=".$jur."&page=".(($page+1)+1)."'> ".Next." </a>";
			}
		}
					?></td>
			      </tr>
				  <tr align="center">
					<td colspan="12">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountKlsJur($jur,$ckls);?></td>
				  </tr>
				  
				</table>
				</div>
				</td>
			  </tr>
			  </form>
			  <tr>
			    <td colspan="2">&nbsp;</td>
		      </tr>
			  <tr>
			    <td colspan="2"><b>* Keterangan:</b>
                  <ul>
					<li>Status Jadwal menunjukan jadwal kuliah dari mata kuliah tersebut. </li>
					<li>Status Setting menunjukan Setting Nrp dari mata kuliah tersebut. </li>
					<li>Status Dosen menunjukan dosen pengajar dari mata kuliah tersebut. </li>
                    <li>Pengisian jadwal, setting nrp, dan dosen pengajar dilakukan dengan meng-klik tombol dilakukan dengan meng-klik <img src="../images/ico/edit.png" width="13" height="13">, apabila status sudah terisi maka tanda akan berubah menjadi <img src="../images/ico/done.png" height="13"> . apabila belum maka akan muncul tanda <img src="../images/ico/none.png" width="13" height="13"></li>
                </ul></td>
		      </tr>
			  <tr>
				<td colspan="2"><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='kelas_mk.php?kelas=1'>";
		}?>[Kembali]</a></td>
			  </tr>
	</table>
			<?
		}
	}
	?></td>
  </tr>
  
		  <tr>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
		  </tr>
</table>
	