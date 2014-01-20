<?
	if($_POST['cmdSimpanUjian'])	{
		if(($_POST['slcMk']!="0") &&($_POST['slcHari']) && ($_POST['slcJam']) && ($_POST['slcMinggu']))	{
			if((($_POST['slcHari']=='5') && ($_POST['slcJam']=='2')) || ((($_POST['slcHari']=='6') && ($_POST['slcJam']=='4'))))	{
				$error = "Pada hari ".$_POST['slcHari']." jam ke ".$_POST['slcJam']." tidak diperkenankan diadakan ujian";
			}
			else	{
				$semester = getSemester();
				$tahun = getTahunAjaran();
				if(checkDuplicateUjian($_POST['slcMk'],$semester,$tahun)==0)	{
					$kode_mk = $_POST['slcMk'];
					$hari = $_POST['slcHari'];
					$jam = $_POST['slcJam'];
					$minggu = $_POST['slcMinggu'];
					
					$result = insertUjian($kode_mk,$hari,$jam,$minggu,$semester,$tahun);
					if($result)	{
						$inf = "Data Ujian telah berhasil disimpan";
					}
					else	{
						$error = "Data Ujian gagal disimpan";
					}
				}
				else	{
					$error = "Data Ujian telah ada";
				}
			}
		}
		else {
			$error = "Pengisian data kurang lengkap";
		}
	}
?>


<form name="frmTambahUjian"  method="post" action="jadwal_ujian.php?jur=<? echo $jur;?>&tambah=1">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td colspan="2" class="subHeaderMenu"><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='jadwal_ujian.php?ujian=1'>";
		}?>Manage Jadwal Ujian
        </a> &gt; Input Jadwal Ujian <? $nama = getDetailJurusan($jur);
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
	}?></td>
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
        <td width="253">&nbsp;</td>
        <td width="247">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right">Kode Mata Kuliah :</div></td>
        <td><select name="slcMk" class="stext" id="kodeMk" onChange="getUjian('<? echo $jur;?>')">
          <option value="0">- Pilih MK -</option>
          <?
		  	
			$mk = selectMkJurAktifDrop($jur);
			
			foreach($mk as $select)
			{
				$nama = getDetailMk($select['kode_mk']);
		?>
          <option value="<? echo $select['kode_mk']; ?>"><? echo $select['kode_mk']." - ".$nama['nama']; ?></option>
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
        <td align="right">Semester : </td>
        <td class="labelContent">&nbsp;<span id="semMk">None</span></td>
      </tr>
      <tr>
        <td><div align="right">Hari : </div></td>
        <td><select name="slcHari" class="stext">
          <option value="1">Senin</option>
		  <option value="2">Selasa</option>
		  <option value="3">Rabu</option>
		  <option value="4">Kamis</option>
	   	  <option value="5">Jumat</option>
	      <option value="6">Sabtu</option>
        </select></td>
      </tr>
      <tr>
        <td><div align="right">Jam Ke : </div></td>
        <td><select name="slcJam" class="stext" id="slcJam">
          <option value="1">1</option>
          <option value="2">2</option>
		  <option value="3">3</option>
     	  <option value="4">4</option>
        </select></td>
      </tr>
      <tr>
        <td><div align="right">Minggu Ke : </div></td>
        <td><select name="slcMinggu" class="stext" id="slcMinggu">
          <option value="1">1</option>
          <option value="2">2</option>
        </select></td>
      </tr>
      <tr>
        <td><div align="right">Semester :</div></td>
        <td class="labelContent">&nbsp;<? echo getSemester();?></td>
      </tr>
      <tr>
        <td><div align="right">Tahun : </div></td>
        <td class="labelContent">&nbsp;<? echo getTahunAjaran();?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="cmdSimpanUjian" value="Simpan" class="sbutton">
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
      <tr>
        <td colspan="2"><b>* Keterangan:</b>
          <ul>
            <li>Pada hari <strong>Jumat</strong> jam ke <strong>2</strong> dan hari <strong>Sabtu</strong> jam ke <strong>4</strong> tidak diperkenankan diadakan ujian. </li>
        </ul></td>
      </tr>
      <tr>
        <td><? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='jadwal_ujian.php?ujian=1'>";
		}?>[Kembali]</a></td>
        <td>&nbsp;          </td>
      </tr>
    </table>
</form>