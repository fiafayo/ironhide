<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_member.php');
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
          <tr>
            <td width="541" class="headerMenu">Welcome</td>
          </tr>
          <tr>
            <td align="center"><table width="528" border="0" cellspacing="0" cellpadding="0" class="content">
                <tr>
                  <td width="526">&nbsp;</td>
                </tr>
                <tr>
                  <td>Selamat Datang,
                    <b><? $detail = getDetailLogin();echo $detail['nama'];?></b> sebagai <? echo $detail['jabatan'];?><br>
					Klik disini untuk keluar - <a href='/depan/logout'> Keluar </a></td>
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