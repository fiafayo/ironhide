<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="lap_perwalian.php">Daftar Periode Perwalian</a> &gt; <a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Jenis Laporan </a> &gt; Daftar Rekapitulasi Peserta Mata Kuliah </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">- <img src="../images/ico/pdf_button.png" width="16" height="16"><a href="pdf_rekap_peserta.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Cetak Laporan </a>-</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="39">Kode </td>
        <td width="20">Kp</td>
        <td width="317">Nama Mata Kuliah </td>
        <td width="62">Kapasitas</td>
        <td width="62">Terdaftar</td>
      </tr>
	  <?
	  	$lap = selectAllKlsMk();
		if($lap)	{
			foreach($lap as $display)	{
	  ?>
      <tr>
        <td align="center"><? echo $display['kode_mk'];?></td>
        <td align="center"><? echo $display['kp'];?></td>
        <td><? $nama= getDetailMk($display['kode_mk']);
				echo $nama['nama'];?></td>
        <td align="right"><? echo $display['kapasitas'];?></td>
        <td align="right"><? echo getAllPendaftarKls($display['kode_kelas'],$_GET['semester'],$_GET['tahun']);?></td>
      </tr>
	  <?
	  	}
	  }
	  else	{
	  ?>
	  	<tr>
			<td align="center" colspan="5">Tidak ada data kelas perkuliahan</td>
		  </tr>
	  <?
	  }
	  ?>
    </table></div></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>">[Kembali]</a></td>
  </tr>
</table>
