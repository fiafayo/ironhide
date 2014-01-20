<?
	if($_POST['cmdTambah'])	{
		if(($_POST['slcMk']!="0") && ($_POST['txtNilaiMin']!="") && ($_GET['jur']))	{
			$mk =strtoupper($_GET['kode_mk']);
			$nilaiMin = strtoupper($_POST['txtNilaiMin']);
			$mkPrasyarat = strtoupper($_POST['slcMk']);
			$jurusan = strtoupper($_GET['jur']);
			$status = strtoupper($_POST['slcStatus']);

			if(checkDuplicatePrasyarat($mk,$mkPrasyarat,$jurusan)==1)	{
				$error = "Mata kuliah Prasyarat tersebut telah ada";
			}
			else	{
				$insert = insertPrasyarat($mk,$mkPrasyarat,$jurusan,$nilaiMin,$status);
				if($insert) {
					$inf = "Mata kuliah Prasyarat telah berhasil disimpan";
				}
				else {
					$error = "Mata kuliah Prasyarat gagal disimpan";
				}
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if(($_GET['del']) && ($_GET['jur']))	{
		$result = deletePrasyarat($_GET['kode_mk'],$_GET['del'],$_GET['jur']);
		if($result)	{
			$inf = "Data telah terhapus";
		}
	}
	
	if($_POST['cmdSimpan'])
	{
		if(($_POST['txtKodeMk']!="") && ($_POST['txtNamaMk']!="") && ($_POST['txtSks']!=""))
		{
			if(checkDuplicateMk($_POST['txtKodeMk'])>0)	{
				$error = "Mata kuliah tersebut telah ada";
			}
			else {
				$kodeMk = strtoupper($_POST['txtKodeMk']);
				$namaMk = strtoupper($_POST['txtNamaMk']);
				$sks = strtoupper($_POST['txtSks']);
				$insert = insertMk($kodeMk,$namaMk,$sks,$jenis);
				if($insert) {
					$inf = "Mata kuliah telah berhasil disimpan";
				}
				else {
					$error = "Mata kuliah gagal disimpan";
				}
			}
		}
		else {
				$error = "Pengisian data kurang lengkap";
		}
	}
?>


<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="566" align="center">
	<?
	if(($_GET['kode_mk']) || ($_GET['detail']) ) {
		$mk = getDetailMk($_GET['kode_mk']);
		
	?>
	<form name="frmPrasyarat" method="post" action="master_mk.php?tambah=1&detail=1&kode_mk=<? echo $_GET['kode_mk'];?>&jur=<? echo $_GET['jur']?>">
	<table width="514" border="0" cellpadding="0" cellspacing="0">
      <tr align="center">
        <td colspan="2" class="subHeaderMenu"><a href="master_mk.php?manage=1">Manage Mata Kuliah
            
        </a> > <a href="master_mk.php?manage=1&jur=<? echo $jur;?>">Daftar Mata Kuliah Jurusan 
        <? 
	$jurusan=getDetailJurusan($jur);
	echo " ".$jurusan['nama'];
	?> </a>       &gt; Input Prasyarat 
        </td>
        </tr>
      <tr>
        <td width="246">&nbsp;</td>
        <td width="268">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">Kode Mata Kuliah : </td>
        <td><b><? echo $_GET['kode_mk'];?></b></td>
      </tr>
      <tr>
        <td align="right">Nama Mata Kuliah : </td>
        <td><b><? echo $mk['nama'];?></b></td>
      </tr>
      <tr>
        <td align="right">SKS : </td>
        <td><b><? echo $mk['sks'];?></b></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr align="center">
        <td colspan="2" class="subHeaderMenu">Daftar Prasyarat</td>
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
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right">Mata Kuliah Prasyarat :</div></td>
        <td><select name="slcMk" class="stext" id="kodeMk" onChange="getNamaMk()">
          <option value="0">- Pilih MK -</option>
          <?
			$mk = selectDropMkJur($_GET['kode_mk'],$_GET['jur']);
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
        <td align="right">Nama Mata Kuliah Prasyarat : </td>
        <td class="labelContent">&nbsp;<span id="namaMk">None</span></td>
      </tr>
      <tr>
        <td align="right">Status : </td>
        <td><select name="slcStatus" class="stext">
          	<option value="AND">Harus</option>
         	<option value="OR">Tidak Harus</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">Nilai Minimum : </td>
        <td><select name="txtNilaiMin" class="stext">
			<option value="A">A</option>
			<option value="AB">AB</option>
			<option value="B">B</option>
			<option value="BC">BC</option>
			<option value="C">C</option>
			<option value="D">D</option>
			<option value="E">E</option>
			<option value="P">[Paralel]</option>
		</select>
    (isi dengan [Paralel] apabila  paralel)</td>
      </tr>
      <tr>
        <td><div align="right">Jurusan : </div></td>
        <td class="labelContent">&nbsp;<? $jurusan=getDetailJurusan($_GET['jur']);
	echo $jurusan['nama'];
	?>
       </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" name="cmdTambah" value="Tambah" class="sbutton">
        <input type="reset" value="Reset" class="sbutton"></td>
      </tr>
      <tr align="center">
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr align="center">
        <td colspan="2">
		<div class="listTable">
		<table width="506" cellspacing="0" cellpadding="0">
          <tr class="headerTable">
            <td width="74">Kode MK</td>
            <td width="191">Nama MK </td>
            <td width="61">Nilai Min </td>
            <td width="37">Status</td>
            <td width="29">Hapus</td>
          </tr>
		  <?
			$prasyarat = selectMkPrasyaratJur($_GET['kode_mk'],$_GET['jur']);	
			if($prasyarat)	{
				foreach($prasyarat as $display)	{
		?>
          <tr>
            <td align="center"><? echo $display['mk_prasyarat'];?></td>
            <td><? $namaPrasyarat = getDetailMk($display['mk_prasyarat']);
				   echo $namaPrasyarat['nama'];?></td>
            <td align="center"><? echo $display['nilai_min'];?></td>
            <td align="center"><?
			if($display['status']=='AND')	{
				echo "HARUS";
			}
			else if($display['status']=='OR')	{
				echo "TIDAK HARUS";
			}
			else if($display['status']=='P')	{
				echo "Paralel";
			}
			else	{
				echo "-";
			}?></td>
            <td align="center"><a href="master_mk.php?jur=<? echo  $display['kode_jur'];?>&del=<? echo $display['mk_prasyarat'];?>&tambah=1&detail=1&kode_mk=<? echo $_GET['kode_mk'];?>">
				<img src="../images/ico/delete.png"></a></td>
          </tr>
		  <?
		  	}
		  }
		  else	{
		  	?>
				<tr align="center">
					<td colspan="5">Tidak ada mata kuliah prasyarat yang terdaftar</td>
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
        <td colspan="2"><a href="master_mk.php?manage=1&jur=<? echo $_GET['jur']?>">[Kembali]</a></td>
        </tr>
    </table>
	<?
	} else {
	?>
	<form name="frmTambahMk" method="post" >
		<table width="502" border="0" cellpadding="0" cellspacing="0">
      <tr align="center">
        <td colspan="2" class="subHeaderMenu">Input Mata Kuliah Baru </td>
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
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="256" align="right"><div align="right">Kode Mata Kuliah : </div></td>
        <td width="246"><input type="text" name="txtKodeMk" class="stext" size="10"></td>
      </tr>
      <tr>
        <td><div align="right">Nama Mata Kuliah : </div></td>
        <td><input name="txtNamaMk" type="text" class="stext" size="30"></td>
      </tr>
      <tr>
        <td><div align="right">SKS : </div></td>
        <td><input type="text" name="txtSks" class="stext" size="4"></td>
      </tr>
      <tr align="center">
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="cmdSimpan" value="Simpan" class="sbutton">
          <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
      </tr>
    </table>
	</form>
	<?	}
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
<p>&nbsp;</p>
