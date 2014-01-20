<?php
use_helper('Url');
$hariNames=array(1=>'Senin','Selasa','Rabu','Kamis','Jumat');
$isEditable=false;
if ( $sf_user->isAdministrator() ) $isEditable=true;

$xls=$sf_request->getParameter('xls');
if ($xls) {
    $isEditable=false;
} else {
    echo "<input type=\"button\" name=\"xlsButton\" value=\"Export ke XLS\" onclick=\"document.location='/index.php/jadwal_ujian/jadwalRinci?xls=1'\" />";
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
<div id="sf_printout_container">
    
    


    <table class="sf_admin_list2" border="0" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <td colspan="10"><h1>Rincian Jadwal Ujian</h1></td>
        </tr>
        <tr>
            <td colspan="10"><h2>Semester <?php echo $thsms->getSemester();?> Tahun Ajaran <?php echo $thsms->getTahun() ;?></h2></td>
        </tr>
        <tr>
            <th class="border_kiriatas">Hari</th>
            <th class="border_kiriatas">Jam</th>
            <th class="border_kiriatas">Kode MK</th>
            <th class="border_kiriatas">Nama Mata Kuliah</th>
            <th class="border_kiriatas">KP</th>
            <th class="border_kiriatas">Kapasitas</th>
            <th class="border_kiriatas">Ruang</th>
            <th class="border_kiriatas">Isi</th>
            <th class="border_kiriatas">Dosen</th>
            <th class="border_kirikananatas">Karyawan</th>
        </tr>
    </thead>
    <tbody>
<?php
$currHari=0;
$currJam=0;
$currMcode=0;
$currDosen=0;
$currMkKp=0;
//echo '<pre>';
//print_r($arRuang);
//echo '</pre>';
 
foreach ($arRuang as $kodeHari=>$kelases)
{
  ksort($kelases);

  foreach ($kelases as $kdKelas=>$data)
  {
    ?>
        <tr>
        <?php
    $minggu=substr($kodeHari,0,1);
    $hari=substr($kodeHari,1,1);
    $jam=substr($kodeHari,2,1);

    $classKiri='border_kiri';
    $classKanan='border_kirikanan';
    if ($hari!=$currHari)
    {
        $currHari=$hari;
        $classKiri='border_kiriatas';
        $classKanan='border_kirikananatas';
        if ( isset($hariNames[$hari]) ) $hariName=$hariNames[$hari]; else $hariName='Undefined';
        echo '<td align="center" class="'.$classKiri.'">'.$hariName.'&nbsp;</td>';
    } else {
        echo '<td align="center" class="'.$classKiri.'">&nbsp;</td>';
    }

$jamText='&nbsp;';
if ($currJam!=$jam)
{
    $jamText=$jam;
    $currJam=$jam;
    $currMcode=0;
$classKiri='border_kiriatas';
$classKanan='border_kirikananatas';
$dosenSudahAda=array();
}
?>
                <td align="center" class="<?php echo $classKiri?>"><?php echo $jamText; ?>
                </td>

<td align="center" class="<?php echo $classKiri?>">
<?php
$mcode=$data['mk'];
if ($currMcode!=$mcode)
{
    echo $mcode;
    $currMcode=$mcode;
    $mkName=$data['nmk'];
} else {
    $mkName='&nbsp;';
}
?>
                &nbsp;</td>
            <td class="<?php echo $classKiri?>">
                 <?php echo $mkName; ?>
            </td>
            <td align="center" class="<?php echo $classKiri?>"><?php 
             
if ($currMkKp != $mcode.$data['kp']) {
   echo $data['kp'];
   
} else {
    echo '&nbsp;';
}
            ?></td>
            <td align="center" class="<?php echo $classKiri?>"><?php
if ($currMkKp != $mcode.$data['kp']) {
   echo $data['kap'];
   $currMkKp=$mcode.$data['kp'];
} else {
    echo '&nbsp;';
}

            ?></td>
            <td align="center" class="<?php echo $classKiri?>">
            <?php
                if ($isEditable)
                {
                    echo link_to( $data['rua'], 'jadwal_ujian/updateRuang?id='.$data['rid'].'&mk='.$data['mk'].'&kp='.$data['kp'] );
                } else {
                    echo $data['rua'];
                }
            ?></td>
            <td align="center" class="<?php echo $classKiri?>">
            <?php
                if ($isEditable)
                {
                    echo link_to( $data['isi'], 'jadwal_ujian/updateIsi?id='.$data['rid'].'&mk='.$data['mk'].'&kp='.$data['kp'] );
                } else {
                    echo $data['isi'];
                }
            ?></td>
            <td align="center" class="<?php echo $classKiri?>">
            <?php
            if ( !in_array($data['rua'], $dosenSudahAda) )
            {
                $namaDosen='';
                if ( isset( $dosenNames[ $data['dos'] ] ) )  $namaDosen='title="'.$dosenNames[ $data['dos'] ].'"';
                $tampilkan='<span '.$namaDosen.'>'. $data['dos'].'</span>';
                $dosenSudahAda[]=$data['rua'];

                if ($isEditable)
                {
                    echo link_to( $tampilkan, 'jadwal_ujian/updateDosen?id='.$data['rid'].'&dos='.$data['dos'] );
                } else {
                    echo $tampilkan;
                }


            } else {
                $tampilkan='&nbsp;';
                echo $tampilkan;
            }
                    
            ?></td>
            <td align="center" class="<?php echo $classKanan?>"><?php 
               if ($tampilkan!=='&nbsp;') 
               {

                $namaKaryawan='';
                if ( isset( $karyawanNames[ $data['kar'] ] ) )  $namaKaryawan='title="'.$karyawanNames[ $data['kar'] ].'"';
                $tampilkan='<span '.$namaKaryawan.'>'. $data['kar'].'</span>';


                if ($isEditable)
                {
                    echo link_to( $tampilkan, 'jadwal_ujian/updateKaryawan?id='.$data['rid'].'&kar='.$data['kar'] );
                } else {
                    echo $tampilkan;
                }
               } else {
                   echo $tampilkan;
               }
            ?></td>

        </tr>

<?php
  }
}
?>
        </tbody>
    </table>
</div>