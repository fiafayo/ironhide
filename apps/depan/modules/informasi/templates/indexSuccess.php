<style type="text/css">
#judul_informasi
{
  font-size: large;
  font-weight: bold;
  text-align: left;
  color: navy;
  margin-top: 8px;
}
#isi_informasi
{
   font-size: small;
   font-weight: normal;
   text-align: left;
   color: black;
}
#waktu_informasi
{
   font-size: smaller;
   font-weight: normal;
   text-align: right;
   color: olive;
   
}
</style>
<div class="sf_admin_container">
<?php
$c=new Criteria;
$c->addDescendingOrderByColumn(FPPPeer::KODE_FPP);
$kk=FPPPeer::doSelectOne($c);
unset($c);
if ($kk)
{
    $kode=$kk->getKodeFpp();
    if ( strlen($kode)==6 ) {
        $ksemester=substr($kode,4,2);
        $tahun=substr($kode,2,2);
    } else {
        $ksemester=substr($kode,3,2);
        $tahun=substr($kode,1,2);
    }
    if ($ksemester=='GA') $semester='GASAL'; else $semester='GENAP';
    $tahun1=intval('20'.$tahun);
    $tahun2=$tahun1+1;
    $c=new Criteria;
    $c->addAscendingOrderByColumn(FPPPeer::KODE_FPP);
    $c->add(FPPPeer::KODE_FPP,'%'.$tahun.$ksemester,Criteria::LIKE);
    $fpps=FPPPeer::doSelect($c);
    unset($c);

?>
                  <div id="judul_informasi">Jadwal Perwalian Semester <?php echo $semester.' '.$tahun1.'/'.$tahun2;?></div>
                  <hr width="100%" />
    <table cellspacing="0" style="width: 760px;" border="0">
        <thead>
            <tr> <th>Tahap</th>  <th>Waktu</th> </tr>
        </thead>
        <tbody>
<?php
foreach ($fpps as $fpp)
{
?>
            <tr><td><?php
            $kode= substr($fpp->getKodeFpp(),0,2);
            switch ($kode)
            {
                case 'II' :
                    $tahap = 'FPP II';
                    break;
                case 'KK' :
                    $tahap = 'Kasus Khusus';
                    break;
                default : $tahap = 'FPP I';
            }
            echo $tahap;
            ?>
                </td>
                <td>
<?php
echo $fpp->getWaktuBuka('d/M/Y H:i:s').' s.d. '.$fpp->getWaktuTutup('d/M/Y H:i:s');
?>
                </td></tr>

<?php
}
?>
        </tbody>
    </table>
                  <p>&nbsp;</p>
<?php
}
?>
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo 'Tidak ada informasi saat ini'; ?></p>
  <?php else: ?>
    <table cellspacing="0" style="width: 760px;" border="0">
      <thead>
      </thead>
<!--
      <tfoot>
        <tr>
          <th colspan="6">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('informasi/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php //echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
-->
      <tbody>
        <?php foreach ($pager->getResults() as $i => $Informasi): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row_<?php echo $odd ?>">
              <td>
                  <div id="judul_informasi"><?php echo $Informasi->getJudul(); ?></div>
                  <hr width="100%" />
                  <div id="isi_informasi"><?php echo $Informasi->getIsi();?></div>
                  <div id="waktu_informasi">Update : <?php echo $Informasi->getUpdatedAt('d/M/Y')  ;?> Oleh: <?php echo $Informasi->getPenulis()  ;?></div>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
