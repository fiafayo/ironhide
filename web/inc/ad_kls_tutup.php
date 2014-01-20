<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="lap_perwalian.php">Daftar Periode Perwalian</a> &gt; <a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Jenis Laporan </a> &gt; Laporan Kelas Tutup </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">- <img src="../images/ico/pdf_button.png" width="16" height="16"><a href="pdf_kls_tutup.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Cetak Laporan </a>-</td>
  </tr>
  <tr>
    <td align="center">
		<span class="listTable">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr class="headerTable">
            <td width="69" nowrap>Kode MK </td>
            <td width="249" nowrap>Nama </td>
            <td width="26" nowrap>KP</td>
            <td width="60" nowrap>Kapasitas</td>
           
          </tr>
		  <?
		  $lap = selectAllKlsMk();
		  if($lap)	{
			foreach($lap as $display)	{
				if($display['status_buka']=='0')	{
		  ?>
          	<tr>
           		 <td align="center"><? echo $display['kode_mk'];?></td>
            		<td><? $nama= getDetailMk($display['kode_mk']);
				echo $nama['nama'];?></td>
            		<td align="center"><? echo $display['kp'];?></td>
            		<td align="right"><? echo $display['kapasitas'];?></td>
          	</tr>
		  <?
				}
			}
		}
		  ?>
        </table></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>">[Kembali]</a></td>
  </tr>
</table>
