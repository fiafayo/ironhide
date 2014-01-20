<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="lap_perwalian.php">Daftar Periode Perwalian</a> &gt; <a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Jenis Laporan </a> &gt; Daftar Isi Kelas Sampai Dengan Kasus Khusus </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">- <img src="../images/ico/pdf_button.png" width="16" height="16"><a href="pdf_isi_kls.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Cetak Laporan </a>-</td>
  </tr>
  <tr>
    <td align="center">
	<div class="listTable">
	<table width="505" border="0" cellspacing="0" cellpadding="0">
      <tr class="headerTable">
        <td width="39">Kode </td>
        <td width="288">Nama Mata Kuliah </td>
        <td width="20">Kp</td>
        <td width="20">Kap.</td>
        <td width="33">Fpp1</td>
        <td width="37">Fpp2 </td>
        <td width="45">Khusus</td>
        <td width="43">Jumlah</td>
        <td width="43">Sisa</td>
        
      </tr>
	  <?
	  	$lap = selectAllKlsMk();
		if($lap)	{
			foreach($lap as $display)	{
				$jumlah=0;
	  ?>
      <tr>
        <td align="center"><? echo $display['kode_mk'];?></td>
        <td><? $nama= getDetailMk($display['kode_mk']);
				echo $nama['nama'];?></td>
        <td align="center"><? echo $display['kp'];?></td>
        <td align="center"><? echo $display['kapasitas'];?></td>
        <td align="right"><?
			$kode = "I".substr($_GET['tahun'],2,2).substr($_GET['semester'],0,2);
			$number = getTerimaKls($kode,$display['kode_kelas']);
			if (!$number) echo $number;
      else print '<A target="pendaftar" href="/perwalianft.php/pendaftar.html?fpp='.$kode.'&status=1&kode_jur=ALL&kelas='.$display['kode_kelas'].'">'.$number.'</A>';
			$jumlah+=$number;
		?></td>
        <td align="right"><?
			$kode = "II".substr($_GET['tahun'],2,2).substr($_GET['semester'],0,2);
			$number = getTerimaKls($kode,$display['kode_kelas']);
      if (!$number) echo $number;
      else print '<A target="pendaftar" href="/perwalianft.php/pendaftar.html?fpp='.$kode.'&status=1&kode_jur=ALL&kelas='.$display['kode_kelas'].'">'.$number.'</A>';
			$jumlah+=$number;
		?></td>
        <td align="right"><?
			$kode = "KK".substr($_GET['tahun'],2,2).substr($_GET['semester'],0,2);
			$number = getTerimaKls($kode,$display['kode_kelas']);
      if (!$number) echo $number;
      else print '<A target="pendaftar" href="/perwalianft.php/pendaftar.html?fpp='.$kode.'&status=1&kode_jur=ALL&kelas='.$display['kode_kelas'].'">'.$number.'</A>';
			$jumlah+=$number;
		?></td>
        <td align="right"><?
			 
      if (!$jumlah) echo $jumlah;
      else print '<A target="pendaftar" href="/perwalianft.php/pendaftar.html?fpp=ALL&status=1&kode_jur=ALL&kelas='.$display['kode_kelas'].'">'.$jumlah.'</A>';
		?></td>
        <td align="right"><?
      echo $display['kapasitas']-$jumlah;
    ?></td>
      </tr>
	  <?
	  	}
	  }
	  else	{
	  	?>
		<td colspan="7" align="center">Tidak ada data kelas perkuliahan</td>
      </tr>
		<?
	  }
	  ?>
    </table>
	</div></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>">[Kembali]</a></td>
  </tr>
</table>
