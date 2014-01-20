<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr align="left">
    <td colspan="2" class="subHeaderMenu">
	<? if($_SESSION['paj_id'])	{
		echo "<a href='index.php'>";
	}
	else	{
		echo "<a href='jadwal_ujian.php?ujian=1'>";
	}?>Manage Jadwal Ujian
    </a> &gt; Jadwal Ujian    
    <? $nama = getDetailJurusan($jur);
	if($nama)	{
		echo " ".$nama['nama'];
	}
	else if($jur=='MIPA')	{
		echo "MIPA";
	}
	else if($jur=='MKU')	{
		echo "MKU";
	}
	else if($jur=='ALL')	{
		echo "Fakultas Teknik";
	}?></td>
  </tr>
  <tr>
    <td width="81" align="right">&nbsp;</td>
    <td width="585">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	<?
		
		if($jur)	{
			$jurusan = $jur;
			$semester = getSemester();
			$tahun = getTahunAjaran();
			for($minggu=1;$minggu<3;$minggu++)	{
				
			?>
				<br>
					<div class="listTable">
					<table width="666" cellspacing="0" cellpadding="0">
					  <tr class="headerTable">
					    <td colspan="7" nowrap><? echo "Minggu ke : ".$minggu;?></td>
				      </tr>
					  <tr class="headerTable">
						<td width="90" nowrap>Jam \ Hari</td>
						<td width="90" nowrap>Senin</td>
						<td width="90" nowrap>Selasa</td>
						<td width="90" nowrap>Rabu</td>
						<td width="90" nowrap>Kamis</td>
						<td width="90" nowrap>Jum'at</td>
						<td width="90" nowrap>Sabtu</td>
					  </tr>
				<? 	for($jam=1;$jam<5;$jam++)	{
					?>
					  <tr>
						<td align="center"><? echo $jam;?></td>
						<? for($hari=1;$hari<7;$hari++) { 
							
						?>
						<td><? $ujian = displayUjian($jurusan,$jam,$hari,$minggu,$semester,$tahun);
							   if($ujian)	{
							   		$i=0;
									foreach($ujian as $display)	{
										$i++;
										$namaMk = getDetailMk($display['kode_mk']);
										if($i % 2 != 0)	{
										echo "<span class='genap'>";
										}
										else	{
											echo "<span class='ganjil'>";
										}
										echo $namaMk['nama']." (".getTotalKap($display['kode_mk']).")<span><br>";
									}
							   }
							   else	{
									echo "-";
							   }
						?></td> 
						<?	
						}
						?>
					  </tr>
					<?
					}
					?>
		  </table>
					</div>
			<?
				}
			}
	?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<? if($_SESSION['paj_id'])	{
			echo "<a href='index.php'>";
		}
		else	{
			echo "<a href='jadwal_ujian.php?ujian=1'>";
		}?>[Kembali]</a></td>
  </tr>
</table>