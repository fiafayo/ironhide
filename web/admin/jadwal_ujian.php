<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_jurusan.php');
	include('../inc/functions/f_mk.php');
	include('../inc/functions/f_kls_mk.php');
	include('../inc/functions/f_ujian.php');
	include('../inc/functions/f_member.php');

	checkSecurity($_GET['jur']);
	$checkLogin = getDetailLogin();

	$status = $checkLogin['jabatan'];
	if($status=='PAJ')	{
		$jur = $checkLogin['kode_jur'];
	}

	if($_GET['jur'])	{
		$jur = $_GET['jur'];
	}
  if(!$_GET['tambah'] && !$_GET['old'] && !$_GET['ujian']  && !$_GET['list'] ) {
    //header('location: http://sfperwalian/perwalianft.php/jadwal.html?jurusan_id='.$jur);
    header('location: /index.php/jadwal_ujian?jurusan_id='.$jur);
  }


?>
<?php
include_once '../inc/_top.php';
?>
<table width="685" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
      <tr>
        <td width="691" class="headerMenu">Master Ujian Mata Kuliah </td>
      </tr>
      <tr>
        <td align="center"><table width="681" border="0" cellspacing="0" cellpadding="0" class="content">
            <tr>
              <td width="681" align="center" >&nbsp;</td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td align="center"><?
		if($jur)	{
		?>
                  <table width="656" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center" ><a href="jadwal_ujian.php?jur=<? echo $jur;?>&tambah=1">Input Jadwal Ujian</a> - <a href="jadwal_ujian.php?jur=<? echo $jur;?>&list=1"> Daftar Jadwal Ujian </a> - <a href="jadwal_ujian.php?jur=<? echo $jur;?>">Lihat Jadwal Ujian </a></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><?
		if($_GET['tambah'])	{
			include ('../inc/ad_tambah_ujian.php');
		}
		else if($_GET['list']) {
			include('../inc/ad_list_ujian.php');
		}
		else {
			include('../inc/ad_lihat_ujian.php');
		}?>
                      </td>
                    </tr>
                  </table>
                  <?
		  }
		  else	{
				echo "Pilih Jurusan yang akan di manage : <br><br>";
				include("../inc/jurusan.php");
		  }
		  ?>
              </td>
            </tr>
            <tr>
              <td><?
			  	if($_GET['ujian'] && !$_SESSION['paj_id'])	{
					echo "<a href='index.php'>[Kembali]</b>";
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