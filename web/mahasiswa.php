<?
	session_start();
	include('inc/functions/connectdb.php');
	include('inc/functions/f_mhs.php');
	include('inc/functions/f_jurusan.php');

include_once('inc/_top.php');
$result = getDetailMhs($_SESSION['mhs_id']);
?>

            <table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
          <tr>
            <td width="508" class="headerMenu">Profil Mahasiswa</td>
          </tr>
          <tr>
            <td align="center">              <table width="519" border="0" cellspacing="0" cellpadding="0" class="content">
                <tr>
                  <td width="519">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><table width="484" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                      <td colspan="2" class="subHeaderMenu">Profile Mahasiswa </td>
                      </tr>
                    <tr>
                      <td width="166">&nbsp;</td>
                      <td width="316">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right">NRP : </td>
                      <td>&nbsp;<b><? echo $result['nrp']; ?></b></td>
                    </tr>
                    <tr>
                      <td align="right">Nama : </td>
                      <td>&nbsp;<strong><? echo $result['nama']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">SKS Max : </td>
                      <td>&nbsp;<strong><? echo $result['sksmax']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">IPS :</td>
                      <td>&nbsp;<a href="https://my.ubaya.ac.id">Lihat di my.ubaya.ac.id</a> </td>
                    </tr>
                    <tr>
                      <td align="right">IPK : </td>
                      <td>&nbsp;<a href="https://my.ubaya.ac.id">Lihat di my.ubaya.ac.id</a> </td>
                    </tr>
                    <tr>
                      <td align="right">SKS Kum : </td>
                      <td>&nbsp;<strong><? echo $result['skskum']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Status :</td>
                      <td>&nbsp;<strong><? echo $result['status']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" class="subHeaderMenu"><strong>Status Perkuliahan </strong></td>
                    </tr>
                    <tr>
                      <td align="left">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right">Jurusan : </td>
                      <td>&nbsp;<strong><? 
					  $jurusan  = getDetailJurusan($result['jurusan']);
					  echo $jurusan['nama']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Angkatan : </td>
                      <td>&nbsp;<strong><? echo getAngkatanMhs($_SESSION['mhs_id']); ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Total BSS : </td>
                      <td>&nbsp;<strong><? echo $result['totbss']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Alamat : </td>
                      <td>&nbsp;<strong><? echo $result['alamat']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Telepon : </td>
                      <td>&nbsp;<strong><? echo $result['telepon']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" class="subHeaderMenu"><strong> Data Pribadi</strong></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right">Jenis Kelamin :</td>
                      <td>&nbsp;<strong><? echo $result['kelamin']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Nama SMA : </td>
                      <td>&nbsp;<strong><? echo $result['namasma']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Nama orang tua : </td>
                      <td>&nbsp;<strong><? echo $result['namaortu']; ?></strong></td>
                    </tr>
                    <tr>
                      <td align="right">Tempat / Tanggal Lahir : </td>
                      <td>&nbsp;<strong><? echo $result['tmplahir'].",".$result['tgllahir']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
        </table>

<?php
include_once('inc/_bottom.php');

?>