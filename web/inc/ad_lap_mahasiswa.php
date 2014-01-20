
<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="lap_perwalian.php">Daftar Periode Perwalian</a> &gt; <a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Jenis Laporan </a> &gt; Laporan Hasil Perwalian Mahasiswa </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	<? 
	if($_GET['jur'])	{
	?>
	
	<table width="508" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center">- <img src="../images/ico/pdf_button.png" width="16" height="16"><a href="pdf_mhs.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&jur=<? echo $_GET['jur'];?>"> Cetak Laporan </a>-</td>
      </tr>
      <tr>
        <td align="center"><div class="listTable"><table width="495" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="508" align="center" class="headerTable">Tabel Daftar Mahasiswa </td>
          </tr>
          <?
	  	$mhs = selectAllPesertaFpp($_GET['jur']);
		if($mhs)	{  	
			foreach($mhs as $display)	{
	  ?>
          <tr>
            <td><? echo $display['nrp']." &nbsp;&nbsp;&nbsp;  "; 
			    $mk=selectAllTerimaKls($display['nrp'],$_GET['semester'],$_GET['tahun']);
				foreach($mk as $input)	{
					echo $input['kode_mk'].$input['kp']."&nbsp;&nbsp;&nbsp; ";
				}
			  ?></td>
          </tr>
          <?
	  		}
	  	}
		else	{
		?>
          <tr>
            <td align="center">Tidak ada data peserta mata kuliah</td>
          </tr>
          <?
		}
	  ?>
        </table></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>&lap=<? echo $_GET['lap'];?>"> [Kembali]</a></td>
      </tr>
    </table>
	
	<?
	}
	else	{
		include("../inc/jurusan.php");
	}
	?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
