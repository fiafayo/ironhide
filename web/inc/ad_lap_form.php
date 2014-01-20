<table width="520" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="subHeaderMenu"><a href="lap_perwalian.php">Daftar Periode Perwalian</a> &gt; <a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>"> Jenis Laporan </a> &gt; Form Rekap Peserta Kuliah </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
<?		
	$lap = selectAllKlsMk();
	if($lap)	{
		foreach($lap as $display)	{
	?>
	<table width="509" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="123" align="right">&nbsp;</td>
        <td width="123" align="left">Kode Mata Kuliah : </td>
        <td width="263" class="labelContent"><? echo $display['kode_mk'];?></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">Nama Mata Kuliah : </td>
        <td class="labelContent"> <? $nama= getDetailMk($display['kode_mk']);
				echo $nama['nama'];?></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">Kp : </td>
        <td class="labelContent"><? echo $display['kp'];?></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">Kapasitas : </td>
        <td class="labelContent"><? echo $display['kapasitas'];?></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">Status : </td>
        <td class="labelContent"><? if($display['dmb']=='1')	{
					echo "DMB";
				}
				else	{
					echo "Non DMB";
				}?></td>
      </tr>
      <tr>
        <td colspan="2" align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <?
		  unset($ass);unset($tua);unset($lainnya);
		  $jml=0;
	  	$result = selectTerimaMhs($_GET['semester'],$_GET['tahun'],$display['kode_kelas']);
		if($result)	{
			
			
			foreach($result as $tampil)	{
				$detail = getDetailMhs($tampil['nrp']);
				
				if($detail['asisten']==1)	{
					$ass[count($ass)]['nrp'] = $tampil['nrp'];
				}
				else if((substr($_GET['tahun'],0,4)-getAngkatanMhs($tampil['nrp']))>=2)	{
					$tua[count($tua)]['nrp'] = $tampil['nrp'];
				}
				else	{
					$lainnya[count($lainnya)]['nrp']  = $tampil['nrp'];
				}
				$jml++;
			}
		}
	?>
      <tr align="left">
	  	<td colspan="3"> <strong>Mahasiswa Asisten </strong> </td>
	 </tr>
	 <tr>
      <td colspan="3"><? 
	  if(count($ass)>0 && $ass)	{
		  foreach($ass as $tampil) 	{
			echo $tampil['nrp']." ";
		  }
	  }
	  else	{
	  	echo "-";
	  }
	  ?></td>
	  
       </tr>
	<tr align="left">
	  	<td colspan="3"> <strong>Mahasiswa Angkatan Tua </strong> </td>
	 </tr>
	 <tr>
      <td colspan="3"><? 
	  if(count($tua)>0 && $tua)	{
		  foreach($tua as $tampil) 	{
			echo $tampil['nrp']."  ";
		  }
	  }
	  else	{
	  	echo "-";
	  }
	  ?></td>
       </tr>
	   
	<tr align="left">
	  	<td colspan="3"> <strong>Lainnya </strong> </td>
	 </tr>
	 <tr>
      <td colspan="3"><? 
	  if(count($lainnya)>0 && $lainnya)	{
		  foreach($lainnya as $tampil) 	{
			echo $tampil['nrp']."  ";
		  }
	  }
	  else	{
	  	echo "-";
	  }
	  ?></td>
       </tr>
	   
      <tr>
        <td colspan="3" align="right"><strong>Total :</strong> <? echo $jml ?> Mahasiswa</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="right"><hr></td>
        </tr>
    </table>
	<?
		}
	}
	?>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left">
	<div class="listTable"><a href="lap_perwalian.php?semester=<? echo $_GET['semester'];?>&tahun=<? echo $_GET['tahun'];?>">[Kembali]</a>	</div></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>