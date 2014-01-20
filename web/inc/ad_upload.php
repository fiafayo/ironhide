<?
	
	if($_POST['btnUpload'])	{
		if($_FILES['db']['tmp_name']!="")	{
			//if(($_FILES['db']['type']=='text/plain') || ($_FILES['db']['type']=='application/x-zip-compressed'))	{
				$fileName = "mhs.sql";
				$filePath = "../db/".$fileName;
				move_uploaded_file($_FILES['db']['tmp_name'],$filePath);
				
				$result = readSqlDb($filePath);
				if($result)	{
					$inf=" Upload database universitas berhasil";
				}
				else	{
					$error =" Upload database universitas gagal";
				}
			//}
		}
		else	{
			$error =" Tidak ada file yang diupload";
		}
	}
?>
<form name="frmUploadMhs" method="post" enctype="multipart/form-data" >
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" class="subHeaderMenu">Database Universitas </td>
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="239" align="right">Input file database universitas : </td>
    <td width="261" align="left"><input type="file" name="db" class="stext"></td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td align="left"><input type="submit" class="sbutton" name="btnUpload" value="Upload"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2">
	</td>
  </tr>
  <tr>
    <td colspan="2"><b>* Keterangan:</b><ul>
		    <li>Tipe database yang dapat diupload adalah file dengan ekstensi *.sql dan *.txt. </li>
			 <li>Database universitas yang ber-ekstensi *.dbf dapat di-convert menjadi ekstensi *.sql dengan menggunakan sofware yang telah disertakan. </li>
	    </ul>
    </td>
  </tr>
</table>
</form>