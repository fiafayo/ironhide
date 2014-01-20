<?php
$kodeSemester=$penjadwalan->thsms->getKodePerwalian();
$c=new Criteria();
$c->add(MataKuliahPeer::KODE_MK,MataKuliahPeer::KODE_MK." IN (SELECT DISTINCT kode_mk FROM tk_kelas_mk WHERE status_buka=1 and kode_kelas LIKE '%$kodeSemester')",Criteria::CUSTOM);
$c->addAscendingOrderByColumn(MataKuliahPeer::KODE_MK);
$mks=MataKuliahPeer::doSelect($c);
unset($c);
$kuliahs=array();
foreach ($mks as $mk)
{
    $kuliahs[$mk->getKodeMk()]=$mk->getNama();
}

?>
<style type="text/css">
.border_kiri {
border-left: 1px solid gray;
/* border-right: 1px solid gray; */
}
.border_kirikanan {
border-left: 1px solid gray;
border-right: 1px solid gray;
}
.border_kiriatas {
border-left: 1px solid gray;
border-top: 1px solid gray;
/* border-right: 1px solid gray; */
}
.border_kirikananatas {
border-top: 1px solid gray;
border-left: 1px solid gray;
border-right: 1px solid gray;
}
</style>
<div id="sf_admin_container">
<h1>Jadwal Ujian <?php echo $penjadwalan->thsms->__toString()?></h1>
<table border="0" cellpadding="2" cellspacing="0">
    <thead>
        <tr>
            <th class="border_kiriatas">Hari</th>
            <th class="border_kiriatas">Jam</th>
            <th class="border_kiriatas">Kode MK</th>
            <th class="border_kiriatas">Nama Mata Kuliah</th>
            <th class="border_kiriatas">KP</th>
            <th class="border_kiriatas">Ruang</th>
            <th class="border_kiriatas">Isi</th>
            <th class="border_kiriatas">Pengawas I</th>
            <th class="border_kirikananatas">Pengawas II</th>
        </tr>
    </thead>
    <tbody>
<?php
$currHari=0;
$currJam=0;
$currMcode=0;
$currDosen=0;
foreach ( $penjadwalan->haris as $hari )
{
    for ($jam=1; $jam<=4; $jam++)
    {
        foreach($penjadwalan->ruanganMK[$hari][$jam] as $mcode=>$kps)
        {
            $keys=array_keys($kps);
            foreach ($keys as $kp)
            {
                $rcode=$kps[$kp]['r'];
                $jmlMhs=$kps[$kp]['n'];
                if ( isset($penjadwalan->jadwalUjians[$hari][$jam]['dos'][$rcode]) ) $dcode=$penjadwalan->jadwalUjians[$hari][$jam]['dos'][$rcode]; else $dcode=0;
                if ( isset($penjadwalan->jadwalUjians[$hari][$jam]['kar'][$rcode]) ) $kcode=$penjadwalan->jadwalUjians[$hari][$jam]['kar'][$rcode]; else $kcode=0;
                $idxHari=$hari % 10;
                $hariName=$penjadwalan->hariNames[$idxHari];
?>
        <tr>
            
<?php
$mkName='&nbsp;';
$classKiri='border_kiri';
$classKanan='border_kirikanan';
if ($currHari!=$hari)
{
    
    $currHari=$hari;
    $currJam=0;
    $currMcode=0;
$classKiri='border_kiriatas';
$classKanan='border_kirikananatas';
echo '<td align="center" class="'.$classKiri.'">'.$hariName;
} else {
echo '<td align="center" class="'.$classKiri.'">';
}
?>

                &nbsp;</td>
            
<?php
$jamText='&nbsp;';
if ($currJam!=$jam)
{
    $jamText=$jam;
    $currJam=$jam;
    $currMcode=0;
$classKiri='border_kiriatas';
$classKanan='border_kirikananatas';
}
?>
                <td align="center" class="<?php echo $classKiri?>"><?php echo $jamText; ?>
                </td>
            <td align="center" class="<?php echo $classKiri?>">
<?php
if ($currMcode!=$mcode)
{
    echo $mcode;
    $currMcode=$mcode;
    if ( isset( $kuliahs[$mcode] ) )  $mkName=$kuliahs[$mcode];
}
?>
                &nbsp;</td>
            <td class="<?php echo $classKiri?>">
                 <?php echo $mkName; ?>
            </td>
            <td align="center" class="<?php echo $classKiri?>"><?php echo $kp; ?></td>
            <td align="center" class="<?php echo $classKiri?>"><?php echo $rcode; ?></td>
            <td align="center" class="<?php echo $classKiri?>"><?php echo $jmlMhs; ?></td>
            <td align="center" class="<?php echo $classKiri?>"><?php echo $dcode; ?></td>
            <td align="center" class="<?php echo $classKanan?>"><?php echo $kcode; ?></td>
            
        </tr>
<?php
            }
        }
    }
}
?>
    </tbody>
</table>
</div>
 