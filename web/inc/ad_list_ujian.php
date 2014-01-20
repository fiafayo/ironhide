<?
	$semester = getSemester();
	$tahun = getTahunAjaran();
				
	if($_GET['delujian'])	{
		$kode_ujian =$_GET['delujian'];
		if(checkUsedUjian($kode_ujian,$semester,$tahun)==0)	{
			$resultDelete = deleteUjian($kode_ujian);
			if($resultDelete)	{
				$inf = "Data ujian telah dihapus";
			}
			else	{
				$error = "Terjadi kesalahan dalam proses hapus";
			}
		}
		else	{
			$error = "Data ujian sedang digunakan";
		}
	}
	
	
	
	if($_POST['cmdEditUjian'])	{
		$resultEdit = editUjian($_GET['editujian'],$_GET['kode'],$_POST['slcJam'],$_POST['slcHari'],$_POST['slcMinggu'],getSemester(),getTahunAjaran());
		if($resultEdit)	{
			$inf = "Data ujian telah diubah";
		}
		else	{
			$error = "Terjadi kesalahan dalam proses edit";
		}
	}
	
	if($_GET['editujian'])	{
		$ujianSelected= getDetailUjian($_GET['editujian']);
	}
?>
<table width="615" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1332" colspan="2" align="center">
	<?
		if($_GET['editujian'])	{
			?>
				<form name="frmEditUjian"  method="post" action="jadwal_ujian.php?list=1&jur=<? echo $jur;?>&kode=<? echo $ujianSelected['kode_mk'];?>&editujian=<? echo $_GET['editujian'];?>">
				<table width="596" border="0" cellspacing="0" cellpadding="0">
				  <tr align="center">
				    <td colspan="2" class="subHeaderMenu">
				    
			<a href='jadwal_ujian.php?list=1&jur=<? echo $jur;?>'>
				      Daftar Jadwal Ujian  </a> &gt; Edit Jadwal Ujian
<? $nama = getDetailJurusan($jur);
	if($nama)	{
		echo " ".$nama['nama'];
	}
	else if($jur=='MIPA')	{
		echo "MIPA";
	}
	else if($jur=='MKU')	{
		echo "MKU";
	}
	else if($jur=='ALL')	{
		echo "Fakultas Teknik";
	}?>
				    </td>
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
				    <td width="317">&nbsp;</td>
				    <td class="labelContent">&nbsp;</td>
			      </tr>
				  <tr>
					<td><div align="right">Kode Mata Kuliah :</div></td>
					<td width="279" class="labelContent">&nbsp;<? echo $ujianSelected['kode_mk'];?></td>
				  </tr>
				  <tr>
				    <td align="right">Nama Mata Kuliah : </td>
				    <td class="labelContent">&nbsp;<? $nama=getDetailMk($ujianSelected['kode_mk']);
							echo $nama['nama'];?></td>
			      </tr>
				  <tr>
					<td><div align="right">Hari : </div></td>
					<td><select name="slcHari" class="stext">
					  <option value="1" <?
					  if($ujianSelected['hari']=='1')	{ echo " selected";}
					  ?>>Senin</option>
					  <option value="2" <?
					  if($ujianSelected['hari']=='2')	{ echo " selected";}
					  ?>>Selasa</option>
					  <option value="3" <?
					  if($ujianSelected['hari']=='3')	{ echo " selected";}
					  ?>>Rabu</option>
					  <option value="4" <?
					  if($ujianSelected['hari']=='4')	{ echo " selected";}
					  ?>>Kamis</option>
					  <option value="5" <?
					  if($ujianSelected['hari']=='5')	{ echo " selected";}
					  ?>>Jumat</option>
					  <option value="6" <?
					  if($ujianSelected['hari']=='6')	{ echo " selected";}
					  ?>>Sabtu</option>
					</select></td>
				  </tr>
				  <tr>
					<td><div align="right">Jam Ke : </div></td>
					<td><select name="slcJam" class="stext">
						  <option value="1" <?
						  if($ujianSelected['jam']=='1')	{ echo " selected";}
						  ?>>1</option>
						  <option value="2" <?
						  if($ujianSelected['jam']=='2')	{ echo " selected";}
						  ?>>2</option>
						  <option value="3" <?
						  if($ujianSelected['jam']=='3')	{ echo " selected";}
						  ?>>3</option>
						  <option value="4" <?
						  if($ujianSelected['jam']=='4')	{ echo " selected";}
						  ?>>4</option>
					  </select></td>
				  </tr>
				  <tr>
					<td><div align="right">Minggu Ke : </div></td>
					<td><select name="slcMinggu" class="stext">
						  <option value="1" <?
						  if($ujianSelected['minggu']=='1')	{ echo " selected";}
						  ?>>1</option>
						  <option value="2" <?
						  if($ujianSelected['minggu']=='2')	{ echo " selected";}
						  ?>>2</option>
					  </select></td>
				  </tr>
				  <tr>
					<td><div align="right">Semester :</div></td>
					<td class="labelContent">&nbsp;<? echo getSemester();?>
					</td>
				  </tr>
				  <tr>
					<td><div align="right">Tahun : </div></td>
					<td class="labelContent">&nbsp;<? echo $ujianSelected['tahun'];?></td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td><input type="submit" name="cmdEditUjian" value=" Edit " class="sbutton">
			        <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
			      </tr>
				  <tr>
				    <td align="left">&nbsp;</td>
				    <td>&nbsp;</td>
			      </tr>
				  <tr>
					<td align="left"><? if($_SESSION['paj_id'])	{
						echo "<a href='index.php'>";
					}
					else	{
						echo "<a href='jadwal_ujian.php?list=1&jur=".$jur."'>";
					}?>[Kembali]</a></td>
					<td>&nbsp;					  </td>
				  </tr>
				</table>
				</form>
			<?
		}
		else	{
		?>
		<?
		if($error)	{
			echo "<div class='warning'>".$error."</div>";
		}
		elseif($inf)	{
			echo "<div class='information'>".$inf."</div>";
		}
	?>
	 <form name="frmCariujian" method="post" class="jadwal_ujian.php?list=1&jur=<? echo $jur;?>">
		<table width="597" border="0" cellspacing="0" cellpadding="0">
          <tr align="left" class="content">
            <td colspan="2" valign="middle" class="subHeaderMenu"><a href="jadwal_ujian.php?ujian=1">Manage Jadwal Ujian
                  
            </a> &gt; Daftar Data Ujian
            <? $nama = getDetailJurusan($jur);
	if($nama)	{
		echo " ".$nama['nama'];
	}?>
            </td>
          </tr>
          <tr class="content">
            <td width="207" align="right" valign="middle">&nbsp;</td>
            <td width="390">&nbsp;</td>
          </tr>
          <tr class="content">
            <td align="right" valign="middle">Cari berdasarkan nama / kode : </td>
            <td><input type="text" name="cujian" class="stext">
                <input type="submit" name="cariUjian" class="sbutton" value=" Cari "></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"> <div class="listTable">
			<table width="507" cellspacing="0" cellpadding="0">
              <tr align="center" >
                <td colspan="8"></td>
              </tr>
              <tr class="headerTable">
                <td width="36" rowspan="2">No</td>
                <td width="39" rowspan="2">Kode Mk </td>
                <td width="243" rowspan="2">Nama Mk </td>
                <td colspan="3">Waktu</td>
                <td width="33" rowspan="2">Edit</td>
                <td width="44" rowspan="2">Hapus</td>
              </tr>
              <tr class="headerTable">
                <td width="45">Minggu</td>
                <td width="38">Hari</td>
                <td width="27">Jam</td>
                </tr>
              <?
				if($_GET['page']) {
					$page = $_GET['page']-1;
				}
				else {
					$page = 0;
				}
				$pages = ($page)*LM_DISPLAY;
				
				if($_POST['cariUjian'])	{
					$cujian = $_POST['cujian'];
				}
				else	{
					$cujian = $_GET['cujian'];
				}

				
				$listUjian = selectUjianJur($jur,$pages,$cujian);
				if($listUjian)	{
					$i=$pages;
					foreach($listUjian as $displayUjian)	{					
						$i++;
					  ?>
              <tr>
                <td align="center"><? echo $i;?></td>
                <td align="center"><? echo $displayUjian['kode_mk'];?></td>
                <td><? echo $displayUjian['nama'];?></td>
                <td align="center"><? echo $displayUjian['minggu'];?></td>
                <td align="center"><? echo $displayUjian['hari'];?></td>
                <td align="center"><? echo $displayUjian['jam'];?></td>
                <td align="center"><a href="jadwal_ujian.php?list=1&jur=<? echo $jur;?>&editujian=<? echo $displayUjian['kode_ujian'];?>"><img src="../images/ico/edit.png"></a> </td>
                <td align="center"><a href="jadwal_ujian.php?list=1&jur=<? echo $jur;?>&delujian=<? echo $displayUjian['kode_ujian'];?>"><img src="../images/ico/delete.png"></a></td>
              </tr>
              <?
				}
			}
			else	{ ?>
              <tr align="center">
                <td colspan="8" >Tidak ada jadwal ujian</td>
              </tr>
              <?
			}
				?>
              <tr align="center">
                <td colspan="8"><? 
			if(getPageCountUjianJur($jur,$cujian)>1)	{
			  if(($_GET['page']!=1)&&(($_GET['page'])))	{
				echo "<a href='jadwal_ujian.php?cujian=$cujian&list=1&jur=".$jur."&page=".(($page+1)-1)."'> ".Back." </a>";
			  }
					for($i=getPagingUjian($page);$i<(getPageUjianJur($jur,$cujian,$page)+1);$i++)
					{
						if($i==getPagingUjian($page)){
							if($page+1==$i) {
								echo "<b>".$i."</b>";
							}
							else {
								echo "<a href='jadwal_ujian.php?cujian=$cujian&list=1&jur=".$jur."&page=$i'>".$i."</a>";
							}
						}
						else{
							if($page+1==$i) {
								echo " - <b>".$i."</b>";
							}
							else {
								echo " - <a href='jadwal_ujian.php?cujian=$cujian&list=1&jur=".$jur."&page=$i'>".$i."</a>";
							}
						}
					}
			if(($_GET['page']<=(getPageUjianJur($jur,$cujian,$page))) && (getPageUjianJur($jur,$cujian,$page)>1)) 	{
				echo "<a href='jadwal_ujian.php?cujian=$cujian&list=1&jur=".$jur."&page=".(($page+1)+1)."'> ".Next." </a>";
			}
		}
					?></td>
              </tr>
              <tr align="center">
                <td colspan="8">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountUjianJur($jur,$cujian);?> </td>
              </tr>
            </table>
            </div></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='jadwal_ujian.php?ujian=1'>";
		}?>[Kembali]</a></td>
          </tr>
        </table>
</form>
	<?
	}
	?>
	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
