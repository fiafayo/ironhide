<?php
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_mk.php');
	include('../inc/functions/f_kls_mk.php');
	include('../inc/functions/f_jurusan.php');
	include('../inc/functions/f_dosen.php');
	include('../inc/functions/f_ruang.php');
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

  if(!$_GET['tambah'] && !$_GET['old'] && !$_GET['kelas'] ) {
    //header('location: http://sfperwalian/perwalianft.php/jadwal.html?jurusan_id='.$jur);
    header('location: /index.php/jadwal?jurusan_id='.$jur);
  }
?>
<?php
include_once '../inc/_top.php';
//print_r( $_SESSION );
?>
<table width="695" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
      <tr>
        <td width="693" class="headerMenu">Master Kelas Mata Kuliah </td>
      </tr>
      <tr>
        <td align="center"><table width="679" border="0" cellspacing="0" cellpadding="0" class="content">
            <tr>
              <td width="678" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><?
		if($jur)	{
	?>
                  <table width="674" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="674" align="center"><a href="kelas_mk.php?tambah=1&jur=<? echo $_GET['jur'];?>&new=1">Input Kelas Mata Kuliah</a> - <a href="kelas_mk.php?tambah=1&jur=<? echo $jur;?>&page=1">Lihat Status Kelas Mata Kuliah</a> - <a href="kelas_mk.php?jur=<? echo $jur;?>">Lihat Jadwal Mata Kuliah</a> </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><?
		if($_GET['tambah'])	{
			include ('../inc/ad_tambah_kls.php');
		}
		else {
			include('../inc/ad_lihat_kls.php');
		}



	?></td>
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
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
			  <?
			  	if($_GET['kelas'] && !$_SESSION['paj_id'])	{
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
