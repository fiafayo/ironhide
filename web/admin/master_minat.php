<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_member.php');
	include('../inc/functions/f_mhs.php');
	include('../inc/functions/f_jurusan.php');
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
          <tr>
            <td width="541" class="headerMenu">Manage Penjurusan </td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="528" border="0" cellspacing="0" cellpadding="0" class="content">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="526" align="center"><?
				  	if($_GET['nrp'])	{
						include("../inc/ad_detail_mhs.php");
					}
					else	{
					  	include("../inc/ad_list_mhs_jur.php");
					}
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