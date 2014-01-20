<?
	session_start();
	include('inc/functions/connectdb.php');
	include('inc/functions/f_mhs.php');
	include('inc/functions/f_mk.php');
	$result = getDetailMhs($_SESSION['mhs_id']);
	
	if($_POST['cariTranskrip'])	{
		$ctrans = $_POST['ctrans'];
	}
	else	{
		$ctrans = $_GET['ctrans'];
	}
?>

<?php
include_once('inc/_top.php');

?>
 <table width="532" height="237" border="0" cellpadding="0" cellspacing="0"  class="contentWrapper">
          <tr>
            <td width="551" class="headerMenu">Transkrip Mahasiswa </td>
          </tr>
          <tr>
            <td align="center"><table width="526" border="0" cellspacing="0" cellpadding="0" class="content">
                <tr>
                  <td width="524" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><table width="511" border="0" cellspacing="0" cellpadding="0" >
                      <tr>
                        <td colspan="2" class="subHeaderMenu">Data Transkrip Mahasiswa </td>
                        </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="labelContent">&nbsp;</td>
                      </tr>
                      <tr>
                        <td><div align="right">Nrp : </div></td>
                        <td width="259" class="labelContent">&nbsp;<? echo $result['nrp'];?></td>
                      </tr>
                      <tr>
                        <td><div align="right">Nama : </div></td>
                        <td class="labelContent">&nbsp;<? echo $result['nama'];?></td>
                      </tr>
 
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
				<form name="frmCariTranskrip" method="post" action="transkrip.php">
                <tr>
                  <td align="right" valign="middle">Cari berdasarkan nama / kode : </td>
                  <td><input type="text" name="ctrans" class="stext" value="<? echo $ctrans;?>">
                      <input type="submit" name="cariTranskrip" class="sbutton" value=" Cari "></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><div class="listTable">
                      <table width="512" cellspacing="0" cellpadding="0">
                        <tr class="headerTable">
                          <td width="26">No</td>
                          <td width="62">Kode MK </td>
                          <td width="246">Nama MK </td>
                          <td width="59">Semester</td>
                          <td width="73">Tahun</td>
                          <td width="52">Nisbi</td>
                        </tr>
                        <?
	  		if($_GET['page']) {
				$page = $_GET['page']-1;
			}
			else {
				$page = 0;
			}
			
			
			
	  		$pages = ($page)*LM_DISPLAY;
	  		$result = getTranskripAsli($_SESSION['mhs_id'],$ctrans,$pages);
			if($result)	{
				$i = $pages;
				foreach($result as $tampil)	{
				$i++;
			  ?>
                        <tr>
                          <td align="center"><? echo $i;?></td>
                          <td align="center"><? echo $tampil['kode_mk'];?></td>
                          <td><? echo $tampil['nama'];?></td>
                          <td align="center"><? echo $tampil['semester'];?></td>
                          <td align="center"><? echo $tampil['tahun'];?></td>
                          <td align="center"><? echo $tampil['nilai'];?></td>
                        </tr>
                        <?
			  }
			}
			else	{
				?>
                        <tr align="center">
                          <td colspan="6">Tidak ada nilai mata kuliah</td>
                        </tr>
                        <?
			}
	  ?>
                        <tr align="center">
                          <td colspan="6"><? 
		if(getPageCountTranskripAsli($_SESSION['mhs_id'],$ctrans)>1)	{
			if(($_GET['page']!=1)&&(($_GET['page'])))	{
				echo "<a href='transkrip.php?ctrans=$ctrans&page=".(($page+1)-1)."'> ".Back." </a>";
			}
			for($i=getPagingMhs($page);$i<=(getPageTranskripAsli($_SESSION['mhs_id'],$ctrans,$page)+1);$i++)
			{
				if($i==getPagingMhs($page)){
					if($page+1==$i) {
						echo "<b>".$i."</b>";
					}
					else {
						echo "<a href='transkrip.php?ctrans=$ctrans&page=$i'>".$i."</a>";
					}
				}
				else{
					if($page+1==$i) {
						echo " - <b>".$i."</b>";
					}
					else {
						echo " - <a href='transkrip.php?ctrans=$ctrans&page=$i'>".$i."</a>";
					}
				}
			}
			
			if(($_GET['page']<=(getPageTranskripAsli($_SESSION['mhs_id'],$ctrans,$page))) && (getPageTranskripAsli($_SESSION['mhs_id'],$ctrans,$page)>1)) 	{
				echo "<a href='transkrip.php?ctrans=$ctrans&page=".(($page+1)+1)."'> ".Next." </a>";
			}
		}
			?></td>
                        </tr>
                        <tr align="center">
                          <td colspan="6">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountTranskripAsli($_SESSION['mhs_id'],$ctrans);?> 
                          </td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
				</form>
            </table></td>
          </tr>
		  
        </table> 
<?php
include_once('inc/_bottom.php');

?>