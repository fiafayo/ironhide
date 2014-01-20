<?
	session_start();
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_mk.php');
?>

<?php
include_once '../inc/_top.php';
?>

<table width="420" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <form name="frmCariMk" method="post" action="cari_mk.php">
    <tr>
      <td width="212" align="right" valign="middle">Cari berdasarkan nama / kode : </td>
      <td width="252"><input type="text" name="mk" class="stext">
          <input type="submit" name="cari" class="sbutton" value=" Cari "></td>
    </tr>
  </form>
  <tr align="center">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="2"><div class="listTable">
        <table width="406" cellspacing="0" cellpadding="0">
          <tr class="headerTable">
            <td>No</td>
            <td>Kode </td>
            <td width="297">Nama MK</td>
            <td width="44">SKS</td>
          </tr>
          <?
		if($_GET['page']) {
			$page = $_GET['page']-1;
		}
		else {
			$page = 0;
		}
		$pages = ($page)*LM_DISPLAY;
		if($_POST['cari'])	{
			$mk = $_POST['mk'];
		}
		else	{
			$mk = $_GET['mk'];
		}
		$displayMk = selectMk($pages,$mk);
		if($displayMk)
		{
			$i = $pages;
			foreach($displayMk as $display)
			{
				$i++;
		?>
          <tr>
            <td width="21" align="center"><? echo $i;?></td>
            <td width="42" align="center"><? echo $display['kode_mk'];?></td>
            <td><a href="javascript:window.opener.frmManage.slcMk.value='<? echo $display['kode_mk'];?>'; window.close();"><? echo $display['nama'];?></a></td>
            <td align="center"><? echo $display['sks'];?></td>
          </tr>
          <?	
			
			}
		}
		else
		{	?>
          <tr align="center">
            <td colspan="5">Tidak ada data mata kuliah</td>
          </tr>
          <?
		}
	?>
          <tr align="center">
            <td colspan="5"><? 
			  if(getPageCountMk($mk)>1)	{
				  if(($_GET['page']!=1)&&(($_GET['page'])))	{
					echo "<a href='cari_mk.php?mk=$mk&page=".(($page+1)-1)."'> ".Back." </a>";
				  }
						for($i=getPagingMk($page);$i<=getPageMk($mk,$page)+1;$i++)
						{
							if($i==getPagingMk($page)){
								if($page+1==$i) {
									echo "<b>".$i."</b>";
								}
								else {
									echo "<a href='cari_mk.php?mk=$mk&page=$i'>".$i."</a>";
								}
							}
							else{
								if($page+1==$i) {
									echo " - <b>".$i."</b>";
								}
								else {
									echo " - <a href='cari_mk.php?mk=$mk&page=$i'>".$i."</a>";
								}
							}
						}
				if($_GET['page']<=(getPageMk($mk,$page)) && (getPageMk($mk,$page)>1))	{
					echo "<a href='cari_mk.php?mk=$mk&page=".(($page+1)+1)."'> ".Next." </a>";
				}
			}
					?></td>
          </tr>
          <tr align="center">
            <td colspan="5">Halaman <b><? echo ($page+1);?></b> dari <? echo getPageCountMk($mk);?></td>
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
</table>

<?php
include_once '../inc/_bottom.php';
?>