<?
	
	if($_GET['jur'])	{
		$jur = $_GET['jur'];
	}
	
	if($_POST['cmdSimpanAlur'])	{
		$jurusan = $jur;
		if(($_POST['slcMk']!="0")  && ($_POST['slcSem']!="0") && ($_POST['txtKurikulum']) && ($jurusan!=""))	{
			$mk = $_POST['slcMk'];
			$sem =  $_POST['slcSem'];
			$kurikulum = $_POST['txtKurikulum'];
			$jenis = $_POST['slcJenis'];
			if($_POST['txtSksMin']!="")	{
				$sksMin = $_POST['txtSksMin'];
			}
			else	{
				$sksMin = 0;	
			}
			
			if($_POST['chkBebas']==1)	{
				$status = '1';
			}
			else	{
				$status = '0';
			}
			
			if(checkDuplicateMkJur($mk,$jurusan)==0)	{
				$result = insertMkJur($mk,$jurusan,$jenis,$status,$sem,$sksMin,$kurikulum);
				if($result)	{
					$inf = "Data telah tersimpan";
				}
			}
			else	{
				$error = "Terjadi duplikasi data mata kuliah jurusan";
			}

			
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_GET['delmanage'])	{
		$result = deleteMkJur($_GET['delmanage'],$_GET['jur']);
		if($result)	{
			$inf = "Data berhasil dihapus";
		}
	}
	
	
	if($_POST['cmdEditAlur'])	{
		if(($_POST['slcSem']!="0") && ($_POST['txtKurikulum']) && ($jur!=""))	{
			$mk = $_GET['edit'];
			$sem =  $_POST['slcSem'];
			$kurikulum = $_POST['txtKurikulum'];
			$jenis = $_POST['slcJenis'];
			if($_POST['txtSksMin']!="")	{
				$sksMin = $_POST['txtSksMin'];
			}
			else	{
				$sksMin = 0;	
			}
			
			if($_POST['chkBebas']==1)	{
				$status = '1';
			}
			else	{
				$status = '0';
			}
			$result = editMkJur($mk,$jur,$jenis,$status,$sem,$sksMin,$kurikulum);
			if($result)	{
				$inf = "Data telah berhasil diubah";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
?>

<table width="513" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
	<?
		if($jur)	{
	?><table width="513" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="545" align="center"><?
	if(($_GET['input']) && ($_GET['manage']))	{
?>
            <form name="frmManage" method="post" action="master_mk.php?manage=1&input=1&jur=<? echo $jur;?>">
              <table width="500" border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td colspan="2" class="subHeaderMenu"><a href="master_mk.php?manage=1">Manage Mata Kuliah
                      
                  </a> > Input Mata Kuliah Jurusan 
                  <? 
	$jurusan=getDetailJurusan($jur);
	echo " ".$jurusan['nama'];
	?>
                  </td>
                </tr>
                <tr align="center">
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr align="center">
                  <td colspan="2"><a href="master_mk.php?manage=1&input=1&jur=<? echo $jur;?>">Input Mata Kuliah Jurusan</a> | <a href="master_mk.php?manage=1&jur=<? echo $jur;?>">Lihat Mata Kuliah Jurusan </a></td>
                </tr>
                <tr align="center">
                  <td colspan="2"><?
		if($error)	{
			echo "<div class='warning'>".$error."</div>";
		}
		elseif($inf)	{
			echo "<div class='information'>".$inf."</div>";
		}
	?></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="188" align="right">Kode Mata Kuliah : </td>
                  <td width="312"><select name="slcMk" class="stext" id="kodeMk" onChange="getNamaMk()">
                      <option value="0">- Pilih MK -</option>
                      <?
			$mk = selectManageMkDrop($jur);
			foreach($mk as $select)
			{
				$nama = getDetailMk($select['kode_mk']);
		?>
                      <option value="<? echo $select['kode_mk']; ?>" ><? echo $select['kode_mk']." - ".$nama['nama']; ?></option>
                      <?
		  }
		?>
                  </select>
                  <a href="cari_mk.php" onClick="javascipt:popup_window(this.href,450,300);return false;" target="_blank"><img src="../images/ico/cari.png"></a></td>
                </tr>
                <tr>
                  <td align="right">Nama Mata Kuliah : </td>
                  <td class="labelContent">&nbsp;<span id="namaMk">None</span></td>
                </tr>
                <tr>
                  <td align="right">SKS Minimum : </td>
                  <td><input name="txtSksMin" type="text" class="stext" id="txtSksMin" size="5"> 
                  (kosongkan apabila tidak ada) </td>
                </tr>
                <tr>
                  <td align="right">Semester : </td>
                  <td><select name="slcSem" class="stext">
                      <option value="0">- Sem -</option>
                      <?
			for($i=1;$i<9;$i++)	{
		?>
                      <option value="<? echo $i; ?>"><? echo $i; ?></option>
                      <?
		  }
		?>
                  </select>
                    </td>
                </tr>
                <tr>
                  <td align="right">Kurikulum : </td>
                  <td><input name="txtKurikulum" type="text" class="stext" id="txtKurikulum" size="7"></td>
                </tr>
                <tr>
                  <td align="right">Jenis : </td>
                  <td><select name="slcJenis" class="stext">
					    <option value="WAJIB">WAJIB</option>
                      <option value="PILIHAN">PILIHAN</option>
                    
                  </select></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">Status  : </td>
                  <td valign="middle" ><input type="checkbox" value="1" name="chkBebas" >Mata Kuliah Bebas</td>
                </tr>
                <tr>
                  <td align="right" valign="top">Jurusan : </td>
                  <td class="labelContent">&nbsp;<? 
					$jurusan=getDetailJurusan($jur);
					echo $jurusan['nama'];
				?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="cmdSimpanAlur" type="submit" class="sbutton" id="cmdSimpan" value="Simpan">
                      <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><b>Keterangan : </b> Pengisian <i> Semester </i> untuk mata kuliah pilihan disesuaikan dengan semester ideal untuk mengambil mata kuliah pilihan. <b>Status mata kuliah bebas</b> digunakan untuk mata kuliah yang sks nya tidak masuk dalam perhitungan pada saat perwalian. </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><a href="master_mk.php?manage=1&jur=<? echo $jur;?>">[Kembali]</a></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>
            <?
	}
	else if(($_GET['edit']) && ($_GET['manage']))	{
		$mkJur = detailMkJur($_GET['edit'],$jur);
	?>
		<form name="frmEditManage" method="post" action="master_mk.php?manage=1&edit=<? echo $_GET['edit'];?>&jur=<? echo $jur;?>">
              <table width="500" border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td colspan="2" class="subHeaderMenu"><a href="master_mk.php?manage=1">Manage Mata Kuliah
                      
                  </a> > Edit Mata Kuliah Jurusan 
                  <? 
	$jurusan=getDetailJurusan($jur);
	echo " ".$jurusan['nama'];
	?>
                  </td>
                </tr>
                <tr align="center">
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr align="center">
                  <td colspan="2"><a href="master_mk.php?manage=1&input=1&jur=<? echo $jur;?>">Input Mata Kuliah Jurusan</a> | <a href="master_mk.php?manage=1&jur=<? echo $jur;?>">Lihat Mata Kuliah Jurusan </a></td>
                </tr>
                <tr align="center">
                  <td colspan="2"><?
		if($error)	{
			echo "<div class='warning'>".$error."</div>";
		}
		elseif($inf)	{
			echo "<div class='information'>".$inf."</div>";
		}
	?></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="231" align="right">Kode Mata Kuliah : </td>
                  <td width="269" class="labelContent">&nbsp;<? echo $mkJur['kode_mk'];?></td>
                </tr>
                <tr>
                  <td align="right">Nama Mata Kuliah : </td>
                  <td class="labelContent">&nbsp;<? $nama = getDetailMk($mkJur['kode_mk']);
				  									echo $nama['nama'];?></td>
                </tr>
                <tr>
                  <td align="right">SKS Minimum : </td>
                  <td><input name="txtSksMin" type="text" class="stext" id="txtSksMin" size="5" value="<? echo $mkJur['sks_min'];?>"> 
                  (kosongkan apabila tidak ada) </td>
                </tr>
                <tr>
                  <td align="right">Semester : </td>
                  <td><select name="slcSem" class="stext">
                      <option value="0">- Sem -</option>
                      <?
			for($i=1;$i<9;$i++)	{
		?>
                      <option value="<? echo $i; ?>" <? if($i==$mkJur['semester']){	echo "selected"; }?>><? echo $i; ?></option>
                      <?
		  }
		?>
                  </select>
                    </td>
                </tr>
                <tr>
                  <td align="right">Kurikulum : </td>
                  <td><input name="txtKurikulum" type="text" class="stext" id="txtKurikulum" size="7" value="<? echo $mkJur['kurikulum'];?>"></td>
                </tr>
                <tr>
                  <td align="right">Jenis : </td>
                  <td><select name="slcJenis" class="stext">
					    <option value="WAJIB" <? if($mkJur['jenis']=='WAJIB')	{ echo "selected"; }?>>WAJIB</option>
                      <option value="PILIHAN" <? if($mkJur['jenis']=='PILIHAN')	{ echo "selected"; }?>>PILIHAN</option>
                    
                  </select></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">Status  : </td>
                  <td valign="middle" ><input type="checkbox" value="1" name="chkBebas" <? if($mkJur['status_bebas']=='1') { echo "checked"; }?> >Mata Kuliah Bebas</td>
                </tr>
                <tr>
                  <td align="right" valign="top">Jurusan : </td>
                  <td class="labelContent">&nbsp;<? 
					$jurusan=getDetailJurusan($jur);
					echo $jurusan['nama'];
				?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><input name="cmdEditAlur" type="submit" class="sbutton" id="cmdEdit" value=" Edit ">
                      <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><b>Keterangan : </b> Pengisian <i> Semester </i> untuk mata kuliah pilihan disesuaikan dengan semester ideal untuk mengambil mata kuliah pilihan. <b>Status mata kuliah bebas</b> digunakan untuk mata kuliah yang sks nya tidak masuk dalam perhitungan pada saat perwalian. </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><a href="master_mk.php?manage=1&jur=<? echo $jur;?>">[Kembali]</a></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form>
	<?
	}
	else	{
	?>
            <table width="513" border="0" cellspacing="0" cellpadding="0">
              <tr align="center">
                <td colspan="2"><? if($error)	{
			echo "<div class='warning'>".$error."</div>";
		}
		elseif($inf)	{
			echo "<div class='information'>".$inf."</div>";
		}?></td>
              </tr>
              <form name="frmCariMkJur" method="post" action="master_mk.php?page=1&manage=1&jur=<? echo $jur;?>">
			  <tr align="left">
			    <td colspan="2" valign="middle" class="subHeaderMenu"><a href="master_mk.php?manage=1">Manage Mata Kuliah           
                </a> > Lihat Mata Kuliah Jurusan 
                <? 
	$jurusan=getDetailJurusan($jur);
	echo " ".$jurusan['nama'];
	
	?>
                </td>
			    </tr>
			  <tr align="center">
			    <td colspan="2" valign="middle">&nbsp;</td>
			    </tr>
			  <tr align="center">
			    <td colspan="2" valign="middle"><a href="master_mk.php?manage=1&input=1&jur=<? echo $jur;?>">Input Mata Kuliah Jurusan</a> | <a href="master_mk.php?manage=1&jur=<? echo $jur;?>">Lihat Mata Kuliah Jurusan </a></td>
			    </tr>
			  <tr>
			    <td align="right" valign="middle">&nbsp;</td>
			    <td>&nbsp;</td>
			    </tr>
			  <tr>
				<td width="216" align="right" valign="middle">Cari berdasarkan nama / kode : </td>
				<td width="297"><input type="text" name="mkJur" class="stext"><input type="submit" name="cariMkJur" class="sbutton" value=" Cari "></td>
			  </tr>
			  
              <tr align="center">
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr align="center">
                <td colspan="2"><div class="listTable">
                    <table width="505" cellspacing="0" cellpadding="0">
                      <tr class="headerTable">
                        <td width="20">No</td>
                        <td width="61">Kode Mk </td>
                        <td width="237">Nama Mk </td>
                        <td width="84">Mk Prasyarat </td>
                        <td width="33">Smtr</td>
                        <td width="29">Edit</td>
                        <td width="39">Hapus</td>
                      </tr>
                      <?
			if($_POST['cariMkJur'])	{
				$mkJur = $_POST['mkJur'];
			}
			else	{
				$mkJur = $_GET['mkJur'];
			}
		  	if($_GET['page']) {
				$page = $_GET['page']-1;
			}
			else {
				$page = 0;
			}
			$pages = ($page)*LM_DISPLAY;
			
		  	$mkJurusan = selectMkJur($jur,$pages,$mkJur);
			if($mkJurusan)	{
				$i=$pages;
				foreach($mkJurusan as $display)	{
					$i++;
		  ?>
                      <tr>
                        <td align="center"><? echo $i;?></td>
                        <td align="center"><? echo $display['kode_mk'];?></td>
                        <td><a href="master_mk.php?tambah=1&detail=1&kode_mk=<? echo $display['kode_mk'];?>&jur=<? echo $jur;?>"><?	$namaMk = getDetailMk($display['kode_mk']);
					echo $namaMk['nama'];
			?></a></td>
                        <td><? $prasyarat = selectMkPrasyaratJur($display['kode_mk'],$jur);
						$jml = getMkPrasyaratJur($display['kode_mk'],$jur);
					if($prasyarat)	{
						$pra=0;
						foreach($prasyarat as $tampil)	{
							
							$tanda = "";
							if($tampil['status']=='AND')	{
								$pra++;
								if($pra%2==1 && $jml>1)
								{
									$tanda = " , ";
								}
								
							}
							else if($tampil['status']=='OR')	{
								$tanda = " (or) ";
							}
							else if($tampil['status']=='P')	{
								$tanda = " (p) ";
							}
							echo $tampil['mk_prasyarat']." - ".$tampil['nilai_min'].$tanda."<br>";
							
						}
					}
					else	{
						echo "-";
					}
			?></td>
                        <td align="center"><? echo $display['semester'];?></td>
                        <td align="center"><a href="master_mk.php?manage=1&edit=<? echo  $display['kode_mk'];?>&jur=<? echo $jur;?>"> <img src="../images/ico/edit.png"></a></td>
                        <td align="center"><a href="master_mk.php?manage=1&delmanage=<? echo  $display['kode_mk'];?>&jur=<? echo $jur;?>"><img src="../images/ico/delete.png"></a></td>
                      </tr>
                      <?
		  		}
		  	}
			else	{
			?>
                      <tr align="center">
                        <td colspan="7">Tidak ada data mata kuliah</td>
                      </tr>
                      <?
			}
		  ?>
                      <tr align="center">
                        <td colspan="7"><? 
						if(getPageCountMkJur($jur,$mkJur)>1)	{
							if(($_GET['page']!=1)&&(($_GET['page'])))	{
								echo "<a href='master_mk.php?mkJur=$mkJur&jur=$jur&manage=1&page=".(($page+1)-1)."'> ".Back." </a>";
							  }
									for($i=getPagingMk($page);$i<=(getPageMkJur($jur,$mkJur,$page)+1);$i++)
									{
										if($i==getPagingMk($page)){
											if($page+1==$i) {
												echo "<b>".$i."</b>";
											}
											else {
												echo "<a href='master_mk.php?mkJur=$mkJur&jur=$jur&manage=1&page=$i'>".$i."</a>";
											}
										}
										else{
											if($page+1==$i) {
												echo " - <b>".$i."</b>";
											}
											else {
												echo " - <a href='master_mk.php?mkJur=$mkJur&jur=$jur&manage=1&page=$i'>".$i."</a>";
											}
										}
									}
							if($_GET['page']<=(getPageMkJur($jur,$mkJur,$page)) && (getPageMkJur($jur,$mkJur,$page)>1))	{
								echo "<a href='master_mk.php?mkJur=$mkJur&jur=$jur&manage=1&page=".(($page+1)+1)."'> ".Next." </a>";
							}
						}
					?></td>
                      </tr>
                      <tr align="center">
                        <td height="18" colspan="7">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMkJur($jur,$mkJur);?> </td>
                      </tr>
                    </table>
                </div></td>
              </tr>
			  </form>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
			  
              <tr>
                <td colspan="2"><b>*Keterangan :</b> Klik pada <i> Nama MK </i> untuk melakukan pengaturan MK Prasyarat pada masing-masing mata kuliah</td>
              </tr>
			  <tr>
			    <td colspan="2">&nbsp;</td>
		      </tr>
			  <tr>
                <td colspan="2"><a href="master_mk.php?manage=1">[Kembali]</a></td>
              </tr>
            </table>
            <?
	}
	
	?>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <?
}
else	{
	include("../inc/jurusan.php");
}
	?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
