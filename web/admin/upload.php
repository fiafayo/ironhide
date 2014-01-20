<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_upload.php');
	include('../inc/functions/f_mhs.php');
  if ( !isset($_SESSION['admin_id']) || !$_SESSION['admin_id'] ) header('Location: /index.php');
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td class="headerMenu">Upload Database Universitas</td>
            </tr>
            <tr>
              <td align="center"><table width="530" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td width="509">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?
				 include("../inc/ad_upload.php");
			   ?></td>
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