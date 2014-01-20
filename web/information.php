<?
	session_start();
	include('inc/functions/connectdb.php');
	include('inc/functions/f_mhs.php');
	include('inc/functions/f_mk.php');
	include('inc/functions/f_jurusan.php');
	include('inc/functions/f_kls_mk.php');
	include('inc/functions/f_fpp.php');
	include('inc/functions/f_prasyarat.php');
	include('inc/functions/f_ujian.php');
	include('inc/functions/f_dosen.php');
	$fpp = getAktifFpp();
        include_once 'inc/_top.php';
?>
<table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
          <tr>
            <td width="539" class="headerMenu">Informasi Mata Kuliah </td>
          </tr>
          <tr>
            <td align="center"> 
                <table width="530" border="0" cellspacing="0" cellpadding="0" class="content">
                <tr>
                  <td width="526">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center">  
        <?php
	if($_GET['kode_mk'])	{
	?>
                      <table width="510" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="2" align="center" class="subHeaderMenu">
						  	<?php if($_GET['hasil'])	{
									echo "<a href='hasil_perwalian.php'>Hasil Perwalian</a> ";									
								}
								else	{
									echo "<a href='information.php'>Informasi Mata Kuliah</a> ";
								}
							?>&gt; Daftar Kelas Mata Kuliah</td>
                        </tr>
                        <tr>
                          <td width="253" align="right">&nbsp;</td>
                          <td class="labelContent">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right">Kode Mata Kuliah :</td>
                          <td width="257" class="labelContent"><?php echo base64_decode($_GET['kode_mk']);?></td>
                        </tr>
                        <tr>
                          <td align="right" >Nama Mata Kuliah : </td>
                          <td class="labelContent"><?php $mk = getDetailMk(base64_decode($_GET['kode_mk']));
						echo $mk['nama'];?></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr align="center">
                          <td colspan="2"><div class="listTable">
                              <table width="362" cellspacing="0" cellpadding="0">
                                <tr class="headerTable">
                                  <td width="43">Kp</td>
                                  <td width="142">Kapasitas</td>
                                  <td width="99">Jml Pendaftar </td>
                                  </tr>
                                <?php
				  	$kls_mk = selectKpMk(base64_decode($_GET['kode_mk']));
					if($kls_mk)	{
						foreach($kls_mk as $display)	{
				  ?>
                                <tr align="center">
                                  <td><a href="information.php?inf=1&detail_kls=<?php echo base64_encode($display['kode_kelas']);?>"><?php echo $display['kp'];?></a></td>
                                  <td><?php echo $display['kapasitas'];?></td>
                                  <td><?php $jml_daftar = getPendaftarKls($fpp['kode_fpp'], $display['kode_kelas']);
							echo $jml_daftar;?></td>
                                  </tr>
                                <?
				  		}
					}
					else	{
					?>
                                <tr align="center">
                                  <td colspan="3">Tidak ada KP yang dibuka pada mk ini</td>
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
                          <td colspan="2"><b>* Keterangan:</b>
                            <ul>
                              <li>Klik pada <strong>KP</strong> untuk melihat detail kelas mata kuliah dan melakukan pendaftaran kelas mata kuliah </li>
                              </ul></td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2"><?
						  	if($_GET['hasil'])	{
								echo "<a href='hasil_perwalian.php'>[Kembali]</a>";
							}
							else	{
								echo "<a href='information.php'>[Kembali]</a>";
							}
						  ?></td>
                        </tr>
                      </table>
                    <?
	}
	else if($_GET['detail_kls'])	{
		include("inc/detail_kls.php");
	}
	else	{
		if($_POST['cmdCariMk'])	{
			$cmk = $_POST['cmk'];
		}	
		else	{
			$cmk = $_GET['cmk'];
		}
		
	?>
                      <form name="frmCariMkJur" method="post" action="information.php">
                          <table width="500" border="0" cellspacing="0" cellpadding="0">
                          <tr align="center" class="content">
                            <td colspan="2" valign="middle" class="subHeaderMenu">Informasi Mata Kuliah </td>
                          </tr>
                          <tr align="center" class="content">
                            <td colspan="2" valign="middle"><table width="443" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td align="right">&nbsp;</td>
                                <td class="labelContent">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="232" align="right">Jurusan : </td>
                                <td width="268" class="labelContent">&nbsp;
                                    <?php $jur = getJurusanMhs($_SESSION['mhs_id']);
							$nama = getDetailJurusan($jur);
							echo $nama['nama'];?></td>
                              </tr>
                              <tr>
                                <td align="right">Tahun Ajaran : </td>
                                <td class="labelContent">&nbsp;<?php echo getSemester()." ".getTahunAjaran();?></td>
                              </tr>
                            </table></td>
                            </tr>
                          <tr class="content">
                            <td align="right" valign="middle">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr class="content">
                            <td width="181" align="right" valign="middle">Cari berdasarkan nama / kode : </td>
                            <td width="319"><input type="text" name="cmk" class="stext" value="<?php echo $cmk;?>">
                                <input type="submit" name="cmdCariMk" class="sbutton" value=" Cari "></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center"><div class="listTable"><table width="492" cellspacing="0" cellpadding="0">
                              <tr class="headerTable">
                                <td width="25">No</td>
                                <td width="51">Kode Mk </td>
                                <td width="231">Nama Mk </td>
                                <td width="31">Sem</td>
                                <td width="77">Status Buka </td>
                                <td width="74">Jml Kelas</td>
                              </tr>
                              <?
  		if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		
		
		$pages = ($page)*LM_DISPLAY;
	  	$result = selectMkJurAktif(getJurusanMhs($_SESSION['mhs_id']),$pages,$cmk);
		if($result)	{
			$i=$pages;
			foreach($result as $display) {
				$i++;
	  ?>
                              <tr>
                                <td align="center"><?php echo $i;?></td>
                                <td align="center"><?php echo $display['kode_mk'];?></td>
                                <td><a href="information.php?kode_mk=<?php echo base64_encode($display['kode_mk']);?>">
                                  <?	$namaMk = getDetailMk($display['kode_mk']);
									echo $namaMk['nama'];
							?>
                                </a></td>
                                <td align="center"><?php echo $display['semester'];?></td>
                                <td align="center"><?php $status = getStatusBukaMkJur(getJurusanMhs($_SESSION['mhs_id']),$display['kode_mk']);
				if($status>0)	{
					echo "BUKA";
				}
				else	{
					echo "TUTUP";
				}?></td>
                                <td align="center"><?php if($status==0)	{
			echo "-";
		}
		else	{
			echo $status;
		}?></td>
                              </tr>
                              <?
	  		}
		}
		else	{
			?>
                              <tr align="center">
                                <td colspan="6">Tidak ada informasi mata kuliah</td>
                              </tr>
                              <?
		}
	  ?>
                              <tr align="center">
                                <td colspan="6"><?php
		if(getPageCountMkJur(getJurusanMhs($_SESSION['mhs_id']),$cmk)>1)	{
			if(($_GET['page']!=1)&&(($_GET['page'])))	{
				echo "<a href='information.php?cmk=$cmk&page=".(($page+1)-1)."'> ".Back." </a>";
		 	}
			for($i=getPagingMk($page);$i<=(getPageMkJurAktif(getJurusanMhs($_SESSION['mhs_id']),$cmk,$page)+1);$i++)
			{
				if($i==getPagingMk($page)){
					if($page+1==$i) {
						echo "<b>".$i."</b>";
					}
					else {
						echo "<a href='information.php?cmk=$cmk&page=$i'>".$i."</a>";
					}
				}
				else{
					if($page+1==$i) {
						echo " - <b>".$i."</b>";
					}
					else {
						echo " - <a href='information.php?cmk=$cmk&page=$i'>".$i."</a>";
					}
				}
			}
	if(($_GET['page']<(getPageMkJurAktif(getJurusanMhs($_SESSION['mhs_id']),$cmk,$page))) && (getPageMkJurAktif(getJurusanMhs($_SESSION['mhs_id']),$cmk,$page)>1)) 	{
		echo "<a href='information.php?cmk=$cmk&page=".(($page+1)+1)."'> ".Next." </a>";
	}
}
			?></td>
                              </tr>
                              <tr align="center">
                                <td colspan="6">Halaman <b><?php echo ($page+1);?></b> dari <?php echo getPageCountMkJurAktif(getJurusanMhs($_SESSION['mhs_id']),$cmk);?> </td>
                              </tr>
                            </table> 
                            </div></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2"><b>* Keterangan:</b>
                              <ul>
                                <li>Klik pada <strong>Nama Mata Kuliah </strong> untuk melihat daftar KP yang dibuka pada mata kuliah tersebut </li>
                              </ul></td>
                          </tr>
                        </table>
                     </form>
                    <?
	}
	?> 
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
            </table>      </td>
          </tr>
        </table>
<?php
include_once 'inc/_bottom.php';
?>