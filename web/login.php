<?
	session_start();
	include 'inc/functions/connectdb.php'; 
	include 'inc/functions/f_member.php'; 
	$result = checkLogin($_POST['txtNrp'], $_POST['txtPassword']);
	checkLogout ();
	if ($_SESSION['mhs_id']) {
		header("Location:daftar_mk.php");
	} 
	elseif($_SESSION['admin_id']) {
		header("Location:admin/index.php");
	}
	elseif($_SESSION['paj_id']) {
		header("Location:admin/index.php");
	}
	else {
		header("Location:/depan/login");
	}
?>

<?php
include_once('inc/_top.php');

?>
	<form method="post" name="frmLogin" action="<? echo $PHP_SELF; ?>" >
	<table width="455" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
      <tr>
        <td width="671" class="headerMenu">Form Login </td>
      </tr>
      <tr>
        <td align="center">
          <table width="447" border="0" cellpadding="0" cellspacing="0" class="content">
            <tr>
              <td colspan="2"><div align="center" class="warning">
                  <? 
	if(isset($error)) {
		echo $error; 
	}?>
              </div></td>
            </tr>
            <tr>
              <td width="307" ><div align="right">NRP/NIK : </div></td>
              <td width="360" ><input type="text" name="txtNrp" class="stext" ></td>
            </tr>
            <tr>
              <td><div align="right">Password : </div></td>
              <td><input type="password" name="txtPassword" class="stext"></td>
            </tr>
            <tr>
              <td colspan="2"><center>
                  <input type="submit" name="cmdSubmit" value="Login" class="sbutton">
                            </center></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr align="center">
              <td colspan="2">* Apabila ada masalah dengan login anda silakan menghubungi petugas</td>
            </tr>
            <tr align="center">
              <td colspan="2">&nbsp;</td>
              </tr>
          </table>
        </td>
      </tr>
    </table></form>
<?php
include_once('inc/_bottom.php');

?>