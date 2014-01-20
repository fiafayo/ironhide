<?
	if($_GET['del'])	{
		$result = deleteMember($_GET['del']);
		if($result)	{
			$inf = "Data member berhasil dihapus";
		}
		else	{
			$error = "Data member gagal dihapus";
		}
	}
		
	if($_POST['cmdEditAdmin'])	{
		if($_POST['txtNama']!="")	{
				$nama= $_POST['txtNama'];
				$password = $_POST['txtPassword'];
				$jabatan = $_POST['slcJabatan'];
				$kode_jur = $_POST['slcJurusan'];
				$nik = $_GET['edit'];
				if($kode_jur==0)	{
					$kode_jur='-';
				}
				$result = editMember($nik,$nama,$kode_jur,$password,$jabatan);
				if($result)	{
					$inf = "Edit member berhasil";
				}
				else	{
					$error = "Edit member gagal";
				}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
	
	if($_POST['cmdSimpanAdmin'])	{
		if(($_POST['txtNik']!="") && ($_POST['txtNama']!=""))	{
			if(checkDuplicateMember($_POST['txtNik'])!=1)	{
				$nik = $_POST['txtNik'];
				$nama= $_POST['txtNama'];
				$password = $_POST['txtPassword'];
				$jabatan = $_POST['slcJabatan'];
				$kode_jur = $_POST['slcJurusan'];
				if($kode_jur==0)	{
					$kode_jur='-';
				}
				$result = inputMember($nik,$nama,$kode_jur,$password,$jabatan);
				if($result)	{
					$inf = "Input member berhasil";
				}
				else	{
					$error = "Input member gagal";
				}
			}
			else	{
				$error = "Terjadi duplikasi data member";
			}
		}
		else	{
			$error = "Pengisian data kurang lengkap";
		}
	}
?>
<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
	<?
		if($_GET['edit'])	{
		$data = getDetailMember($_GET['edit']);
		?>
		<form name="frmEditAdmin" method="post" action="setting_admin.php?edit=<? echo $_GET['edit'];?>">
		<table width="500" border="0" cellspacing="0" cellpadding="0">
		  <tr align="left">
		    <td colspan="2" class="subHeaderMenu">Edit Member </td>
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
		    <td align="right">&nbsp;</td>
		    <td class="labelContent">&nbsp;</td>
	      </tr>
		  <tr>
			<td width="220" align="right">NIK : </td>
			<td width="280" class="labelContent">&nbsp;<? echo $data['nik'];?></td>
		  </tr>
		  <tr>
			<td align="right">Nama : </td>
			<td><input type="text" name="txtNama" class="stext" value="<? echo $data['nama'];?>" ></td>
		  </tr>
		  <tr>
			<td align="right">Password : </td>
			<td><input type="text" name="txtPassword" class="stext" size="5" value="<? echo $data['password'];?>"></td>
		  </tr>
		  <tr>
			<td align="right">Jabatan : </td>
			<td><select name="slcJabatan" class="stext" id="slcJabatan">
			 
			  <option value="ADMINISTRATOR">ADMINISTRATOR</option>
			  <option value="PAJ" <? if($data['jabatan']=='PAJ')
			 	{	
					echo "selected";
				}?>>PAJ</option>
			</select></td>
		  </tr>
		  <tr>
			<td align="right">Jurusan : </td>
			<td><select name="slcJurusan" class="stext">
			  <option value="0">- Pilih Jurusan -</option>
			  <?
						$jur = getJurusan();
						foreach($jur as $display)	{
							if($data['kode_jur']==$display['kode_jur'])	{	
								echo "<option value='".$display['kode_jur']."' selected>".$display['nama']."</option>";
							}
							else	{
								echo "<option value='".$display['kode_jur']."'>".$display['nama']."</option>";
							}
						}
					?>
			</select></td>
		  </tr>
		  <tr>
			<td align="right">&nbsp;</td>
			<td><input type="submit" name="cmdEditAdmin" class="sbutton" value=" Edit ">
			<input type="reset" name="cmdReset" class="sbutton" value="Reset"></td>
		  </tr>
		</table>
		</form>
		<?
		}
		else	{
	?>
	<form name="frmAdmin" method="post" action="setting_admin.php">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr align="left">
        <td colspan="2" class="subHeaderMenu">Input Member </a></td>
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
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="220" align="right">NIK : </td>
        <td width="280"><input type="text" name="txtNik" class="stext" size="5"></td>
      </tr>
      <tr>
        <td align="right">Nama : </td>
        <td><input type="text" name="txtNama" class="stext" ></td>
      </tr>
      <tr>
        <td align="right">Password : </td>
        <td><input type="text" name="txtPassword" class="stext" size="5"></td>
      </tr>
      <tr>
        <td align="right">Jabatan : </td>
        <td><select name="slcJabatan" class="stext" id="slcJabatan">
          <option value="ADMINISTRATOR">ADMINISTRATOR</option>
		  <option value="PAJ">PAJ</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">Jurusan : </td>
        <td><select name="slcJurusan" class="stext">
          <option value="0">- Pilih Jurusan -</option>
          <?
					$jur = getJurusan();
					foreach($jur as $display)	{
						echo "<option value='".$display['kode_jur']."'>".$display['nama']."</option>";
					}
				?>
        </select></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" name="cmdSimpanAdmin" class="sbutton" value=" Save ">
		<input type="reset" name="cmdReset" class="sbutton" value="Reset"></td>
      </tr>
    </table>
	</form>
	<?
	}
	?>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="500" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="52" nowrap>NIK</td>
        <td width="146" nowrap>Nama</td>
        <td width="77" nowrap>Jabatan</td>
        <td width="152" nowrap>Jurusan</td>
        <td width="30" nowrap>Edit</td>
        <td width="41" nowrap>Hapus</td>
      </tr>
	<?
		$admin = selectMember();
		if($admin)	{
			foreach($admin as $display)	{
	?>
      <tr>
        <td><? echo $display['nik'];?></td>
        <td><? echo $display['nama'];?></td>
        <td><? echo $display['jabatan'];?></td>
        <td><? $detilJur = getDetailJurusan($display['kode_jur']);
				if($detilJur['nama']=='')	{
					echo "-";
				}
				else	{
					echo $detilJur['nama'];
				}?></td>
        <td align="center"><a href="setting_admin.php?edit=<? echo $display['nik'];?>"><img src="../images/ico/edit.png"></a>		</td>
        <td align="center"><a href="setting_admin.php?del=<? echo $display['nik'];?>"><img src="../images/ico/delete.png"></a></td>
      </tr>
	<?
			}
		}
		else	{
			?>
			 <tr align="center">
				<td colspan="6">Tidak ada data admin</td>
		  </tr>
			<?
		}
	?>
    </table>
	</div>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
