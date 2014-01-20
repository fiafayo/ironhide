<?
	session_start();
	include_once('../inc/functions/connectdb.php');
	include_once('../inc/functions/f_laporan.php');
	include_once('../inc/functions/f_kls_mk.php');
	include_once('../inc/functions/f_mk.php');
	include_once('../inc/functions/f_jurusan.php');
	include_once('../inc/functions/f_fpp.php');
	include_once('../inc/functions/f_mhs.php');

	//header("Location:coba.php")
?>
<?php
include_once '../inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
              <tr>
                <td width="541" class="headerMenu">Laporan Perwalian </td>
              </tr>
              <tr>
                <td align="center">
                    <table width="530" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">
					<?
						if(($_GET['semester']) && ($_GET['tahun']) &&(!$_GET['lap']))	{
					?>

					<table width="514" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="subHeaderMenu"><a href="lap_perwalian.php">Daftar Perode Perwalian</a> &gt; Jenis Laporan</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center">
                            <table width="500" border="0" cellspacing="0" cellpadding="0">
                          <tr class="content">
                            <td align="center" class="headerTable">Daftar Laporan Perwalian Periode <? echo $_GET['semester']." / ".$_GET['tahun'];?></td>
                          </tr>
                          <tr class="content">
                            <td align="center"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=4">Laporan Mahasiswa</a> </td>
                          </tr>
                          <tr class="content">
                            <td align="center"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=5">Laporan Kapasitas Kelas</a></td>
                          </tr><tr>
			  <td align="center"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=6">Laporan Kelas Tutup </a></td>
                          </tr>
                          <tr class="content">
                            <td align="center"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=1">Daftar Rekapitulasi Peseta Mata Kuliah</a> </td>
                          </tr>
                          <tr class="content">
                            <td align="center"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=2">Daftar Isi Kelas Sampai Dengan Kasus Khusus </a></td>
                          </tr>
                          <tr class="content">
                            <td align="center"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=3">Form Rekap Peseta Kuliah</a> </td>
                          </tr>

                          <tr class="content">
                            <td align="center"><a href="/index.php/pendaftar">Daftar Mahasiswa Per MK</a> </td>
                          </tr>

                        </table>
                        </td>
                      </tr>
                                        </table>




					<?
					}
					elseif(($_GET['semester']) && ($_GET['tahun']) &&($_GET['lap']==1))	{
						include_once("../inc/ad_lap_peserta.php");
					}
					elseif(($_GET['semester']) && ($_GET['tahun']) &&($_GET['lap']==2))	{
						include_once("../inc/ad_lap_isi.php");
					}
					elseif(($_GET['semester']) && ($_GET['tahun']) &&($_GET['lap']==3))	{
						include_once("../inc/ad_lap_form.php");
					}
					elseif(($_GET['semester']) && ($_GET['tahun']) &&($_GET['lap']==4))	{
						include_once("../inc/ad_lap_mahasiswa.php");
					}
					elseif(($_GET['semester']) && ($_GET['tahun']) &&($_GET['lap']==5))	{
						include_once("../inc/ad_lap_kapasitas.php");
					}
					elseif(($_GET['semester']) && ($_GET['tahun']) &&($_GET['lap']==6))	{
						include_once("../inc/ad_kls_tutup.php");
					}
					else	{
						?>

						<table width="517" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="subHeaderMenu">Daftar Perode Perwalian </td>
                          </tr>
                          <tr>
                            <td align="center">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center"><div class="listTable"><table width="309" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="headerTable">Laporan Perwalian Periode</td>
                              </tr>
                              <?
						  	$lap = getPeriodeFpp();
							if($lap)	{
								foreach($lap as $display)	{
						  ?>
                              <tr>
                                <td align="center"><a href="lap_perwalian.php?semester=<? echo $display['semester'];?>&tahun=<? echo $display['tahun'];?>"><? echo $display['semester']." / ".$display['tahun'];?></a></td>
                              </tr>
                              <?
						  		}
						  	}
							else	{
								?>
                              <tr>
                                <td align="center">Tidak ada data fpp</td>
                              </tr>
                              <?
						    }?>
                            </table></div></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>

						<?

					}
					?>

                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><a href="lap_perwalian.php">[Kembali]</a></td>
                      </tr>
                    </table>
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
<?php
include_once '../inc/_bottom.php';
?>