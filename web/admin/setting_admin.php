<?
	session_start();
	include('../inc/functions/connectdb.php');
	include("../inc/functions/f_jurusan.php");
	include("../inc/functions/f_member.php");
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr >
              <td class="headerMenu">Setting Administrator </td>
            </tr>
            <tr>
              <td align="center"><table width="525" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <!--<tr>
                    <td align="center"><a href="setting_admin.php">Master Administrator</a> | <a href="setting_admin.php?jadwal=1">Atur jadwal</a> </td>
                  </tr>-->
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?
						if($_GET['jadwal'])	{
							include("../inc/ad_jdw_admin.php");
						}
						else	{
							include("../inc/ad_admin.php");
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