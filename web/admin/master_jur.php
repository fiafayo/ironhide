<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_jurusan.php');
	
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td width="576" class="headerMenu">Master Jurusan </td>
            </tr>
            <tr>
              <td align="center"><table width="529" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td width="545">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?
						include("../inc/ad_jur.php");
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
