<?php
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_asisten.php');
	include('../inc/functions/f_mhs.php');
	include('../inc/functions/f_member.php');
	include('../inc/functions/f_jurusan.php');
	if($_GET['del']!="")
	{
		$result = deleteAsisten($_GET['del']);
		if($result)	{
			$error = "Data asisten telah berhasil dihapus";
		}

	}
	if($_GET['as']!="")
	{
		$result = assignAsisten($_GET['as']);
		if($result)	{
			$inf = "Data asisten telah berhasil ditambah";
		}
	}
	
?>


<?php
include_once '../inc/_top.php';
?>
 
              <table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
            <tr>
              <td width="514" class="headerMenu">Manage Asisten</td>
            </tr>
            <tr>
              <td align="center"><table width="527" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><a href="asisten.php">Input Asisten</a> | <a href="asisten.php?lihat=1">Lihat Daftar Asisten</a></td>
                  </tr>
                  <tr>
                    <td align="center"><span class="labelContent">
                      <?
			if($error)
			{
				echo "<div class='warning'>".$error."</div>";
			}
			elseif($inf)
			{
				echo "<div class='information'>".$inf."</div>";
			}
		?>
                    </span></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?
		if(!$_GET['lihat'])
		{
			if($_GET['cari'])	{
				$cmhs = $_GET['cmhs'];
				$cjur = $_GET['cjur'];
				$cang = $_GET['cang'];
			}
	?>
                        <form name="frmAsisten" method="get">
                          <table width="462" border="0" cellspacing="0" cellpadding="0">
                            <tr align="center">
                              <td colspan="3" class="subHeaderMenu">Input Asisten </td>
                            </tr>
                            <tr>
                              <td >&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right" >Cari berdasarkan Nama / Nrp : </td>
                              <td colspan="2"><input type="text" name="cmhs" value="<? echo $cmhs; ?>" class="stext"></td>
                            </tr>
                            <tr>
                              <td align="right" >Jurusan :</td>
                              <td colspan="2"><select name="cjur" class="stext">
                                <option value="">- Pilih Jurusan -</option>
                                <?
									$piljur = getJurusan();
									foreach($piljur as $display)	{
										if($cjur==$display['kode_jur'])	{	
											echo "<option value='".$display['kode_jur']."' selected>".$display['nama']."</option>";
										}
										else	{
											echo "<option value='".$display['kode_jur']."'>".$display['nama']."</option>";
										}
									}
					?>
                              </select></td>
                            </tr>
                            <tr>
                              <td align="right" >Angkatan :</td>
                              <td colspan="2"><input name="cang" type="text" class="stext" value="<? echo $cang; ?>" size="4" maxlength="4"></td>
                            </tr>
                            <tr>
                              <td width="195" ><div align="right"></div></td>
                              <td width="267" colspan="2"><input type="submit" name="cari" value=" Cari " class="sbutton"></td></tr>
                            <tr>
                              <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr align="center">
                              <td colspan="3"><div class="listTable">
                                  <table width="445" cellspacing="0" cellpadding="0">
                                    <tr class="headerTable">
                                      <td width="63" nowrap>Nrp</td>
                                      <td width="242" nowrap>Nama</td>
                                      <td width="37" nowrap>IPK</td>
                                      <td width="101" nowrap>Status Asisten</td>
                                    </tr>
                                    <?
		  	if($_GET['page']) {
				$page = $_GET['page']-1;
			}
			else {
				$page = 0;
			}
			
	  		$pages = ($page)*LM_DISPLAY;
			$displayMhs = searchMhs($cmhs,$cjur,$cang,$pages);
			if($displayMhs)	{
				foreach($displayMhs as $display)
				{
				?>
					<tr>
					  <td align="center"><? echo $display['nrp'];?></td>
					  <td><? echo $display['nama'];?></td>
					  <td align="center"><? echo $display['ipk'];?></td>
					  <td align="center"><?	if($display['asisten']=='1')
						{
							echo "<img src='../images/ico/user.png'>";
						}
						else
						{
							$nrp = $display['nrp'];
							echo "<a href='asisten.php?cmhs=$cmhs&input=1&as=".$nrp."'><img src='../images/ico/add.png'></a>";
						}
					?></td>
                                    </tr>
                                    <?
				}
			}
			else	{
			  	?>
                                    <tr align="center">
                                      <td colspan="4">Tidak ada Mahasiswa</td>
                                    </tr>
                                    <?
			}
			?>
                                    <tr align="center">
                                      <td colspan="4"><? 
			if(getPageCountMhs($cmhs,$cjur,$cang)>1)	{
		      if(($_GET['page']!=1)&&(($_GET['page'])))	{
					echo "<a href='asisten.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&input=1&page=".(($page+1)-1)."'> ".Back." </a>";
			  }
				for($i=getPagingMhs($page);$i<=(getPageSearchMhs($cmhs,$cjur,$cang,$page)+1);$i++)
				{
					if($i==getPagingMhs($page)){
						if($page+1==$i) {
							echo "<b>".$i."</b>";
						}
						else {
							echo "<a href='asisten.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&input=1&page=$i'>".$i."</a>";
						}
					}
					else{
						if($page+1==$i) {
							echo " - <b>".$i."</b>";
						}
						else {
							echo " - <a href='asisten.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&input=1&page=$i'>".$i."</a>";
						}
					}
					
				}
			if(($_GET['page']<=(getPageSearchMhs($cmhs,$cjur,$cang,$page))) && (getPageSearchMhs($cmhs,$cjur,$cang,$page)>1)) 	{
				echo "<a href='asisten.php?cmhs=$cmhs&cjur=$cjur&cang=$cang&input=1&page=".(($page+1)+1)."'> ".Next." </a>";
			}
		}
		?></td>
                                    </tr>
                                    <tr align="center">
                                      <td colspan="4">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMhs($cmhs,$cjur,$cang);?> </td>
                                    </tr>
                                  </table>
                              </div></td>
                            </tr>
                            <tr align="center">
                              <td colspan="3">&nbsp;</td>
                            </tr>
                          </table>
                        </form>
                        <?
		}
		else
		{
			if($_POST['cmdCariAs'])	{
				$cas = $_POST['cas'];
			}
			else	{
				$cas = $_GET['cas'];
			}
	?>
					<form name="frmCariAsisten" method="post" action="asisten.php">
                        <table width="477" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td colspan="2" align="center" class="subHeaderMenu">Daftar Asisten </td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="171" align="right">Cari berdasarkan Nama / Nrp : </td>
                            <td width="306"><input type="text" name="cas" value="<? echo $cas; ?>" class="stext">
                              <input type="submit" name="cmdCariAs" value=" Cari " class="sbutton"></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center"><div class="listTable">
                                <table width="459" cellspacing="0" cellpadding="0">
                                  <tr class="headerTable">
                                    <td width="66" nowrap>Nrp</td>
                                    <td width="311" nowrap>Nama</td>
                                    <td width="80" nowrap>Hapus Status </td>
                                  </tr>
                                  <?
		  	if($_GET['page']) {
				$page = $_GET['page']-1;
			}
			else {
				$page = 0;
			}
			
			
			
	  		$pages = ($page)*LM_DISPLAY;
		  	$displayAsisten = selectAsisten($cas,$pages);
			if($displayAsisten)
			{
				foreach($displayAsisten as $display)
				{
				?>
                                  <tr>
                                    <td align="center"><? echo $display['nrp'];?></td>
                                    <td><? echo $display['nama'];?></td>
                                    <td align="center"><a href="asisten.php?cas=<? echo $cas;?>&lihat=1&del=<? echo $display['nrp'];?>"><img src="../images/ico/delete.png"></a></td>
                                  </tr>
                                  <?
				}
			}
			else
			{
				?>
                                  <tr align="center">
                                    <td colspan="3">Tidak ada asisten</td>
                                  </tr>
                                  <?
			}
		  ?>
                                  <tr align="center">
                                    <td colspan="3"><? 
		if(getPageCountAsisten($cas)>1)	{
			  if(($_GET['page']!=1)&&(($_GET['page'])))	{
					echo "<a href='asisten.php?cas=$cas&lihat=1&page=".(($page+1)-1)."'> ".Back." </a>";
			  }
		for($i=getPagingMhs($page);$i<(getPageAsisten($cas,$page)+1);$i++)
		{
			if($i==getPagingMhs($page))	{
				if($page+1==$i) {
					echo "<b>".$i."</b>";
				}
				else {
					echo "<a href='asisten.php?cas=$cas&lihat=1&page=$i'>".$i."</a>";
				}
			}
			else{
				if($page+1==$i) {
					echo " - <b>".$i."</b>";
				}
				else {
					echo " - <a href='asisten.php?cas=$cas&lihat=1&page=$i'>".$i."</a>";
				}
			}
			
		}
			if(($_GET['page']<=(getPageAsisten($cas,$page))) && (getPageAsisten($cas,$page)>1)) 	{
				echo "<a href='asisten.php?cas=$cas&lihat=1&page=".(($page+1)+1)."'> ".Next." </a>";
			}
	}
		?></td>
                                  </tr>
                                  <tr align="center">
                                    <td colspan="3">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountAsisten($cas);?> </td>
                                  </tr>
                                </table>
                            </div></td>
                          <tr>
                          <tr>
                            <td colspan="2" align="center">&nbsp;</td>
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
              </table></td>
            </tr>
          </table>

<?php
include_once '../inc/_bottom.php';
?>
