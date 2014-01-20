<?php
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_upload.php');
	 
  if ( !isset($_SESSION['admin_id']) || !$_SESSION['admin_id'] ) header('Location: /index.php');
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td class="headerMenu">Upload Mata Kuliah</td>
            </tr>
            <tr>
              <td align="center"><table width="530" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td width="509">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">

<?php

$inf="";
$error='';

	if($_SERVER['REQUEST_METHOD']=='POST')	{
		if($_FILES['filecsv']['tmp_name']!="")	{
			//if(($_FILES['db']['type']=='text/plain') || ($_FILES['db']['type']=='application/x-zip-compressed'))	{
				$fileName = "matakuliah_".date('YmdHis').".csv";
				$filePath = "/tmp/".$fileName;
				move_uploaded_file($_FILES['filecsv']['tmp_name'],$filePath);

				$result = readCsvFile($filePath);
                                if ( is_array($result) )  $inf=implode('<br/>',$result);

			//}
		}
		else	{
			$inf =" Tidak ada file yang diupload";
		}
                echo $inf;

	}


?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table>
<?php
include_once '../inc/_bottom.php';
?>