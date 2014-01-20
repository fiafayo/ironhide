<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_jurusan.php');
	include('../inc/functions/f_member.php');
	include('../inc/functions/f_mk.php');
	include('../inc/functions/f_prasyarat.php');
	
	checkSecurity($_GET['jur']);
?>
<?php
include_once '../inc/_top.php';
?>

              <table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td class="headerMenu">Master Mata Kuliah</td>
            </tr>
            <tr>
              <td align="center">
                  <table width="530" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><div align="center"><a href="master_mk.php?tambah=1">Input Mata Kuliah Baru</a> | <a href="master_mk.php?lihat=1">Lihat Daftar Mata Kuliah</a> |
                            <?
										$checkLogin = getDetailLogin();
										$status = $checkLogin['jabatan'];
										if($status=='PAJ')	{ 
											$jur = $checkLogin['kode_jur'];
										?>
                            <a href="master_mk.php?manage=1&jur=<? echo $jur;?>">Manage Mata Kuliah Jurusan </a>
                            <?
										}
										elseif($status=='ADMINISTRATOR')	{
										?>
                            <a href="master_mk.php?manage=1">Manage Mata Kuliah Jurusan </a>
                            <?
										}
										?>
                    </div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><? 
					if($_GET['tambah'])	{
						include('../inc/ad_tambah_mk.php');
					}
					elseif($_GET['lihat']){
						include('../inc/ad_lihat_mk.php');
					}
					elseif($_GET['manage'])	{
						include('../inc/ad_manage_mk.php');
					}
					?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="486">&nbsp;

                        <form action="upload_mk.php" method="post" enctype="multipart/form-data">
                            File Mata Kuliah (.CSV) : <input type="file" name="filecsv" /><input type="submit" />
                        </form>
                    </td>
                  </tr>
                  <tr>
                    <td width="486">&nbsp;
Format: Kode MK;Nama MK; SKS  (baris pertama judul kolom, akan diabaikan, pemisah string bisa memakai petik tunggal)
                    </td>
                  </tr>
              </table></td>
            </tr>
          </table>
<?php
include_once '../inc/_bottom.php';
?>