<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
	<?
		if(($_GET['proses'])&&($_GET['fpp'])&&(!$_GET['kode_kls'])&&(!$_GET['kode_mk']))	{
			include("ad_proses_fpp.php");
		}
		else if(($_GET['preview'])&($_GET['fpp'])&&(!$_GET['kode_kls'])&&(!$_GET['kode_mk']))	{
			if($_POST['cariDaftar'])	{
				$cdaftar = $_POST['cdaftar'];
			}
			else	{
				$cdaftar = $_GET['cdaftar'];
			}
		?>
			<form name="frmCariDaftar" method="post" action="perwalian.php?preview=1&fpp=<? echo $_GET['fpp']?>">
			<table width="466" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td colspan="2" align="center" class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt; Daftar Mata Kuliah </td>
				  </tr>
				  <tr>
				    <td colspan="2">&nbsp;</td>
		      </tr>
				  <tr class="content">
                    <td width="214" align="right" valign="middle">Cari berdasarkan nama / kode : </td>
                    <td width="252"><input type="text" name="cdaftar" class="stext" value="<? echo $cdaftar;?>">
                        <input type="submit" name="cariDaftar" class="sbutton" value=" Cari "></td>
		      </tr>
				  <tr>
					<td colspan="2">&nbsp;</td>
				  </tr>
				  <tr>
				    <td colspan="2" align="center">
					<div class="listTable">
					<table width="439" cellspacing="0" cellpadding="0">
                      <tr class="headerTable">
                        <td width="68">Kode MK</td>
                        <td width="267">Nama MK </td>
                        <td width="45">Jml Kls </td>
                        <td width="57">Overload</td>
                      </tr>
                      <?
						if($_GET['page']) {
							$page = $_GET['page']-1;
						}
						else {
							$page = 0;
						}
						
						
						
						$pages = ($page)*LM_DISPLAY;
						$mk = selectMkBuka($pages,$cdaftar);
						if($mk)	{
							foreach($mk as $display)	{
						  ?>
                      <tr>
                        <td align="center"><? echo $display['kode_mk'];?></td>
                        <td><a href="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_mk=<? echo $display['kode_mk'];?>">
                          <?	$namaMk = getDetailMk($display['kode_mk']);
									echo $namaMk['nama'];
							?>
                        </a></td>
                        <td align="center"><?	$jml = getJmlKlsMK($display['kode_mk']);
									echo $jml;
							?></td>
                        <td align="center"><? $over = getOverloadMk($display['kode_mk']);
												echo $over;?>
                        </td>
                      </tr>
                      <?
							}
						}
						else	{
							?>
                      <tr align="center">
                        <td colspan="4">Tidak ada mata kuliah buka</td>
                      </tr>
                      <?
						}
						?>
                      <tr>
                        <td colspan="5" align="center"><? 
						if(getPageCountMkBuka($cdaftar)>1)	{
								if(($_GET['page']!=1)&&(($_GET['page'])))	{
									echo "<a href='perwalian.php?cdaftar=$cdaftar&preview=1&fpp=".$_GET['fpp']."&page=".(($page+1)-1)."'> ".Back." </a>";
								 }
									for($i=getPagingFpp($page);$i<(getPageMkBuka($page,$cdaftar)+1);$i++)
									{
										if($i==getPagingFpp($page)){
											if($page+1==$i) {
												echo "<b>".$i."</b>";
											}
											else {
												echo "<a href='perwalian.php?cdaftar=$cdaftar&preview=1&fpp=".$_GET['fpp']."&page=$i'>".$i."</a>";
											}
										}
										else{
											if($page+1==$i) {
												echo " - <b>".$i."</b>";
											}
											else {
												echo " - <a href='perwalian.php?cdaftar=$cdaftar&preview=1&fpp=".$_GET['fpp']."&page=$i'>".$i."</a>";
											}
										}
									}
								if(($_GET['page']<=(getPageMkBuka($page,$cdaftar))) && (getPageMkBuka($page,$cdaftar)>1)) 	{
									echo "<a href='perwalian.php?cdaftar=$cdaftar&preview=1&fpp=".$_GET['fpp']."&page=".(($page+1)+1)."'> ".Next." </a>";
								}
							}
								?></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="center">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMkBuka($cdaftar);?></td>
                      </tr>
                    </table>
					</div></td>
		      </tr>
				  <tr align="left">
				    <td colspan="2">&nbsp;</td>
		      </tr>
				  <tr align="left">
				    <td colspan="2"><b>* Keterangan:</b>
				      <ul>
                        <li> Klik pada <b> Nama MK </b> untuk melihat kelas-kelas yang dibuka.</li>
                        <li><strong> Overload </strong>adalah jumlah kelas yang isinya melebihi kapasitas.</li>
		            </ul></td>
		      </tr>
				  <tr align="left">
					<td colspan="2">
					<a href="perwalian.php">[Kembali]</a></td>
				  </tr>
				  
	  </table>
	  </form>
		<?
		}
		elseif(($_GET['kode_mk']) && (!$_GET['nrp']))	{
			?>
			<table width="472" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td colspan="2" align="center" class="subHeaderMenu"><a href="perwalian.php">Daftar Perwalian </a>&gt;<a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>"> Daftar Mata Kuliah</a> &gt; Daftar Kelas Mata Kuliah </td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
			    <td width="239" align="right">Kode Mata Kuliah : </td>
		        <td width="233" class="labelContent"><? echo $_GET['kode_mk'];?></td>
			  </tr>
			  <tr>
			    <td align="right" >Nama Mata Kuliah : </td>
		        <td class="labelContent"><? $mk = getDetailMk($_GET['kode_mk']);
						echo $mk['nama'];?></td>
			  </tr>
			  <tr>
			    <td colspan="2">&nbsp;</td>
		      </tr>
			  <tr align="center">
				<td colspan="2">
				<div class="listTable">
				<table width="462" cellspacing="0" cellpadding="0">
                  <tr class="headerTable">
                    <td width="45">Kp</td>
                    <td width="157">Jadwal Kuliah </td>
                    <td width="75">Kapasitas</td>
                    <td width="90">Jml Pendaftar </td>
                    <td width="93">Pindah Kelas </td>
                  </tr>
				  <? 
				  	$kls_mk = selectKpMk($_GET['kode_mk']);
					if($kls_mk)	{
						foreach($kls_mk as $display)	{
							$jml_daftar = getPendaftarKls($_GET['fpp'], $display['kode_kelas']);
				  ?>
                  <tr>
                    <td align="center"><a href="perwalian.php?fpp=<? echo $_GET['fpp'];?>&kode_kls=<? echo $display['kode_kelas'];?>"><? echo $display['kp'];?></a></td>
					
                    <td align="center">
					<?
						
						$jadwal = selectJadwalKls($display['kode_kelas']);
						foreach($jadwal as $kul)	{
							  if($kul['hari']=='1')	{
							  	echo "Senin, ";
							  }
							  else if($kul['hari']=='2')	{
							  	echo "Selasa, ";
							  }
							  else if($kul['hari']=='3')	{
							  	echo "Rabu, ";
							  }
							  else if($kul['hari']=='4')	{
							  	echo "Kamis, ";
							  }
							  else if($kul['hari']=='5')	{
							  	echo "Jumat, ";
							  }
							  else if($kul['hari']=='6')	{
							  	echo "Sabtu, ";
							  }
							  echo $kul['jam_masuk']."-".$kul['jam_keluar']."<br>";
						}
					?></td>
                    <td align="center"><? echo $display['kapasitas'];?></td>
                    <td align="center" <? if($jml_daftar>$display['kapasitas'])	{ echo " class='warning' ";}?>><? echo $jml_daftar;?></td>
                    <td align="center"><a href="perwalian.php?pindah=1&fpp=<? echo $_GET['fpp'];?>&kode_kls=<? echo $display['kode_kelas'];?>">Proses</a></td>
                  </tr>
				  <?
				  		}
					}
					else	{
					?>
						<tr align="center">
							<td colspan="5">Tidak ada KP yang dibuka pada mk ini</td>
				  </tr>
					<?
					}
				  ?>
                </table>
				</div></td>
			  </tr>
			  <tr>
			    <td colspan="2">&nbsp;</td>
		      </tr>
			  <tr>
			    <td colspan="2"><div align="justify">
						  <b>* Keterangan:</b><ul>
							<li> Klik pada <b> KP </b> untuk melihat mahasiswa pendaftar mata kuliah. </li>
							<li> Klik pada pindah kelas <b>(Proses)</b> untuk melakukan pemindahan mahasiswa ke kelas mata kuliah yang lain. </li>
							
						</ul>
					</div></td>
		      </tr>
			  <tr>
			    <td colspan="2">&nbsp;</td>
		      </tr>
			  <tr>
				<td colspan="2"><a href="perwalian.php?preview=1&fpp=<? echo $_GET['fpp'];?>">[Kembali]</a></td>
			  </tr>
			</table>

			<?
		}
		else if(($_GET['kode_kls']) && ($_GET['pindah'])){
				include("../inc/ad_pindah_kls.php");
		}
		else if(($_GET['kode_kls']) && (!$_GET['pindah']))	{
				include("../inc/ad_mhs_fpp.php");
		}
		else {
			?>
	 
			<table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="subHeaderMenu">Proses Hasil Perwalian</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"> <div class="listTable"><table width="391" cellspacing="0" cellpadding="0">
                  <tr class="headerTable">
                    <td width="57">Jenis</td>
                    <td width="84">Semester</td>
                    <td width="127">Tahun</td>
                    <td width="49">Display</td>
                    <td width="50">Manage</td>
                  </tr>
                  <?
				 if($_GET['page']) {
					$page = $_GET['page']-1;
				}
				else {
					$page = 0;
				}
				$pages = ($page)*LM_DISPLAY;
				$result = selectFpp($pages);
				if($result)	{
					foreach($result as $display)	{
					
				  ?>
                  <tr>
                    <td><? echo $display['jenis'];?></td>
                    <td><? echo $display['semester'];?></td>
                    <td><? echo $display['tahun'];?></td>
					
				<?	if($display['jenis']=='KK')	{
						if(date("Y-m-d H:i:s")>date("Y-m-d H:i:s",strtotime($display['waktu_buka'])))	{
							
						
					?>
					 <td align="center"><a href="perwalian.php?preview=1&fpp=<? echo $display['kode_fpp'];?>"><img src="../images/ico/preview.png"></a></td>
					   <td align="center"><a href="perwalian.php?proses=1&fpp=<? echo $display['kode_fpp'];?>"><img src="../images/ico/config.png"></a></td>
					<?
						}
						else	{
					?>
						 <td align="center"><img src="../images/ico/none.png"></a></td>
						  <td align="center"><a href="perwalian.php?proses=1&fpp=<? echo $display['kode_fpp'];?>"><img src="../images/ico/config.png"></a></td>
					<?
						}
				}
				else	{
				?>
							<td align="center">
							<?
								
								if(getStatusProses($display['kode_fpp'])>0)	{
								?>
									<a href="perwalian.php?preview=1&fpp=<? echo $display['kode_fpp'];?>"><img src="../images/ico/preview.png"></a>
								<?
								}
								else	{
								?>
									  <img src="../images/ico/none.png">
								  <?
								}
							?></td>
							<td align="center"><?
								if(getStatusProses($display['kode_fpp'])>0)	{
							?>
								<a href="perwalian.php?proses=1&fpp=<? echo $display['kode_fpp'];?>"><img src="../images/ico/config.png"></a></td>
								<?
									}
									else	{
										?>
									  <img src="../images/ico/none.png">
									  <?
									} 
						}?>
                  </tr>
                  <?
						}
					}
				else	{
				  ?>
                  <tr align="center">
                    <td colspan="5"> Tidak ada data perwalian </td>
                  </tr>
                  <?
					}
				  ?>
                  <tr align="center">
                    <td colspan="5"> <? 
			for($i=1;$i<(getPageFpp()/LM_DISPLAY)+1;$i++)
			{
				if($i==1){
					if($page+1==$i) {
						echo "<b>".$i."</b>";
					}
					else {
						echo "<a href='perwalian.php?input=1&page=$i'>".$i."</a>";
					}
				}
				else{
					if($page+1==$i) {
						echo " - <b>".$i."</b>";
					}
					else {
						echo " - <a href='perwalian.php?input=1&page=$i'>".$i."</a>";
					}
				}
			}
			?></td>
                  </tr>
                </table></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><b>* Keterangan:</b>
                  <ul>
                    <li> Klik pada <b> Display </b> untuk melihat mahasiswa pendaftar mata kuliah. </li>
                    <li> Klik pada <strong>Manage</strong> untuk melakukan pemrosesan data perwalian. </li>
                </ul></td>
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
</table>
