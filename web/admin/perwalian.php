<?
  ini_set('max_execution_time',300);
  ini_set('memory_limit','512M');
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_kls_mk.php');
	include('../inc/functions/f_fpp.php');
	include('../inc/functions/f_mk.php');
	include('../inc/functions/f_mhs.php');
	include('../inc/functions/f_tambah_sks.php');
  
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td class="headerMenu">Manage Perwalian</td>
            </tr>
            <tr>
              <td align="center"><table width="532" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="599" align="center"><a href="perwalian.php?input=1">Input Perwalian</a> | <a href="perwalian.php">Daftar Perwalian </a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?
		if($_GET['input'])	{
			include("../inc/ad_tambah_fpp.php");
		}
		else	{
			include("../inc/ad_preview_fpp.php");
		}
	?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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