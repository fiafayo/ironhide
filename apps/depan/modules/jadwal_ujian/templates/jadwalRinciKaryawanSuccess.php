<?php
use_helper('Url');
$hariNames=array(1=>'Senin','Selasa','Rabu','Kamis','Jumat');
$isEditable=false;
if ( $sf_user->isAdministrator() ) $isEditable=true;



$print=$sf_request->getParameter('print');
if ($print) {
    $isEditable=false;
} else {
    $xls=$sf_request->getParameter('xls');
    if ($xls) {
        $isEditable=false;
    } else {
        echo "<input type=\"button\" name=\"xlsButton\" value=\"Export ke XLS\" onclick=\"document.location='/index.php/jadwal_ujian/jadwalRinciKaryawan?xls=1'\" />";
    }
    echo "<input type=\"button\" name=\"printButton\" value=\"Print\" onclick=\"document.location='/index.php/jadwal_ujian/jadwalRinciKaryawan?print=1'\" />";
}
function printHeaderDosen()
{
    echo "<tr>
            <th class=\"border_kiriatas\">Hari</th>
            <th class=\"border_kiriatas\">Jam</th>
            <th class=\"border_kiriatas\">Kode MK</th>
            <th class=\"border_kiriatas\">Nama Mata Kuliah</th>
            <th class=\"border_kiriatas\">KP</th>
            <th class=\"border_kiriatas\">Jml Mhs</th>
            <th class=\"border_kirikananatas\">Ruang</th>
        </tr>";
}
function romawi($angka)
{
    if ($angka==1) return 'I'; else return 'II';
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
.border_kirikananbawah {
border-bottom: 1px solid gray;
border-left: 1px solid gray;
border-right: 1px solid gray;
border-top: 1px solid gray;
}
.border_kiribawah {
border-left: 1px solid gray;
border-bottom: 1px solid gray;
/* border-right: 1px solid gray; */
}
</style>
<div id="sf_printout_container">




    <table class="sf_admin_list2" border="0" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <td colspan="6"><h1>Jadwal Jaga Ujian Untuk Karyawan</h1></td>
        </tr>
        <tr>
            <td colspan="6"><h2>Semester <?php echo $thsms->getSemester();?> Tahun Ajaran <?php echo $thsms->getTahun() ;?></h2></td>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($arRuang as $kdos=>$data)
{
    if (isset($karyawanNames[$kdos]) ) $namaDosen = $karyawanNames[$kdos] ; else $namaDosen= $kdos;
?>
        <tr>
            <th colspan="6" style="padding-top: 20px">
                <?php echo "Kode : ".$kdos."&nbsp;&nbsp; Nama : ".$namaDosen; ?>
            </th>
        </tr>        
<?php
    //if ( count($data) == 0 ) continue;
    printHeaderDosen();
//    echo '<tr><td colspan="6"><pre>';
//    print_r($data);
//    echo '</pre></td></tr>';
    foreach ($data as $id=>$jadwal)
    {
        $ruang=$jadwal['rua'];
        $mk=$jadwal['mk'];
        $ruangText='<td class="border_kiriatas">'.$hariNames[$ruang->getHari()].' '.romawi($ruang->getMinggu()).'</td>'.
            '<td class="border_kiriatas">'.$ruang->getJam().'</td>';

        foreach ( $mk as $kode=>$dataMk )
        {
?>
        <tr>
<?php
if ($ruangText)
{
    echo $ruangText;
    
} else {
    echo '<td class="border_kiri">&nbsp;</td><td class="border_kiri">&nbsp;</td>';
}
?>
            <td class="border_kiri<?php if ($ruangText) echo 'atas'; ?>" align="center"><?php echo $dataMk['mk']; ?></td>
            <td class="border_kiri<?php if ($ruangText) echo 'atas'; ?>" align="center"><?php echo $arMk[$dataMk['mk']]; ?></td>
            <td class="border_kiri<?php if ($ruangText) echo 'atas'; ?>" align="center"><?php echo $dataMk['kp']; ?></td>
            <td class="border_kiri<?php if ($ruangText) echo 'atas'; ?>" align="center"><?php echo $dataMk['isi']; ?></td>
            <td class="border_kirikanan<?php if ($ruangText) echo 'atas'; ?>" align="center"><?php if ($ruangText) echo $ruang->getKodeRuang(); else echo '&nbsp;' ?></td>
        </tr>
<?php
if ($ruangText) $ruangText=null;
        }
    }
?>
        <tr>
            <td colspan="7" class="border_kirikananbawah">
                Jumlah jaga : <?php echo count($data);?>
            </td>
        </tr>

        <?php

}
?>
    </tbody>
    </table>
</div>
 