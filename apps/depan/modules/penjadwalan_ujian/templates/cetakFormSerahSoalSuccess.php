<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title>Form Penyerahan Soal <?php echo $params['judul']; ?></title>
        <style media="print" type="text/css" >
          
        </style>
    </head>    
    <body style="width: 21cm; margin:1cm 1cm 1cm 1cm;">
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div>
 
<?php
 

//$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
$tglAwal=$params['tanggal'];

//array mkUjians yang ada di penjadwalan, memiliki redundansi karena tergantung pada
//ruangan ujian, dimana satu kelas paralel bisa ditempatkan di lebih dari satu ruang
//oleh karenanya harus dinormalisasikan dulu
$slots=array_keys($penjadwalan->mkUjians);
$mkUjians=array();
foreach($slots as $slot) {
    $minggu=substr($slot,0,1);
    $hari=substr($slot,1,1);
    $jam=substr($slot,2,1);
    $kodeHari=$minggu.$hari;
    if ( !isset( $mkUjians[$kodeHari] ) ) {
        $mkUjians[$kodeHari]=array('c'=>0, 'p'=>null, 'd'=>array());
    }
    if ( !isset( $mkUjians[$kodeHari]['d'] [$jam] ) ) {
        $mkUjians[$kodeHari]['d'] [$jam]=array('c'=>0, 'd'=>array());
    }
    
    
    $kodeMks = array_keys($penjadwalan->mkUjians[$slot]);
    foreach ($kodeMks as $kodeMk){
        if ( !isset( $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk] ) ) {
            $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk] =array('c'=>0, 'n'=>'', 'd'=>array());            
        }
        $namaMk = (isset( $penjadwalan->mataKuliahReffs[$kodeMk] )) ? $penjadwalan->mataKuliahReffs[$kodeMk] : '';
        $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['n'] = $namaMk;
        $kps = array_keys ($penjadwalan->mkUjians[$slot][$kodeMk]['isi']);
        foreach($kps as $kp) {
            if ( !isset( $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['d'][$kp] ) ) {
                $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['d'][$kp] = 0;
                $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['c'] =
                        $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['c'] + 1;
                $mkUjians[$kodeHari]['d'] [$jam]['c'] =
                        $mkUjians[$kodeHari]['d'] [$jam]['c'] + 1;
                $mkUjians[$kodeHari]['c'] =
                        $mkUjians[$kodeHari]['c'] + 1;                
            }
            $isi = $penjadwalan->mkUjians[$slot][$kodeMk]['isi'][$kp];
            $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['d'][$kp] = 
                    $mkUjians[$kodeHari]['d'] [$jam]['d'][$kodeMk]['d'][$kp]+
                    $isi;
        }//foreach $kps
        
    } //foreach $kodeMks

} //foreach slot
//ready to print, I miss U, D

$pikets=  PiketUjianPeer::doSelectJoinDosen(new Criteria());
foreach ($pikets as $piket) {
    $minggu=$piket->getMinggu();
    $hari = $piket->getHari();
    $kodeDos = $piket->getKodeDosen();
    $dosen = $piket->getDosen();
    $namaDos = ( $dosen ) ? $dosen->getNama()  : '';
    $mkUjians[$minggu.$hari]['p']=$namaDos."($kodeDos)";
}

$kodeHariAktif=0;
$isAwalHari=true;
$kodeHaris = array_keys($mkUjians);
$isHariAwal = true;
$classText = '';
foreach($kodeHaris as $kodeHari) {
    echo "\n";
    if ( $classText=='' ) $classText=' class="warning" '; else $classText='';
    if ($isHariAwal) {
        $isHariAwal=false;
        
    } else {
        akhirTabel(); //pindah halaman berikutnya
    }
    $minggu = substr($kodeHari,0,1);
    $hari   = substr($kodeHari,1,1);  
    $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
    $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari);  
    
      $namaHari=DataFormatter::$dayNames[$hari];                      
      $isUasGenap20132014 = sfConfig::get('app_uas_genap_20132014',0);
      if ($isUasGenap20132014) {
        if (($hari==2) && ($minggu==2)) {
            $namaHari=DataFormatter::$dayNames[1];
        } else {
            $namaHari=DataFormatter::$dayNames[$hari];
        }
      }    
       
    
    $params['sub_judul']=$namaHari.', '.DataFormatter::dateToMyString($tglUjian);
    awalTabel($params);
    $rowSpan=$mkUjians[$kodeHari]['c'];
    //echo '<tr '.$classText." id='hari_$kodeHari' ".'><td align="center" valign="top" rowspan="'.$rowSpan.'" >'.DataFormatter::$dayNames[$hari].', '.DataFormatter::dateToMyString($tglUjian)." </td>";
    $jamAktif=0;
    $isJamAwal=true;
    $jams = array_keys($mkUjians[$kodeHari]['d']);
    foreach($jams as $jam) {
        $rowSpan = $mkUjians[$kodeHari]['d'][$jam]['c'];
        if ($rowSpan==0) continue;
        if ($isJamAwal) {
            $isJamAwal=false;
        } else {
            echo '<tr '.$classText." id='jam_$jam' ".'>';
        }
        if ($jamAktif!=$jam) {
            $jamAktif=$jam;
            
            echo '<td  align="center" valign="top" rowspan="'.$rowSpan.'">'.DataFormatter::$romawiNames[$jam]." </td>";
        }
        $kodeMkAktif=0;
        $isKodeMkAwal = true;
        $kodeMks =  array_keys($mkUjians[$kodeHari]['d'][$jam]['d'] );
        foreach ($kodeMks as $kodeMk) {
            $namaMk = $mkUjians[$kodeHari]['d'][$jam]['d'][$kodeMk]['n'];
            $rowSpan = $mkUjians[$kodeHari]['d'][$jam]['d'][$kodeMk]['c'];
            if ($rowSpan==0) continue;
            
            if ( $isKodeMkAwal ) {
                $isKodeMkAwal=false;
            } else {
                echo '<tr '.$classText." id='mk_$kodeMk' ".'>';
            }
            if ($kodeMkAktif!=$kodeMk) {
                $kodeMkAktif!=$kodeMk;
                if ($rowSpan>0) {
                   echo "<td align='left' rowspan='$rowSpan' valign='top' >$namaMk ($kodeMk) </td>";
                }
            }
            $kps=array_keys( $mkUjians[$kodeHari]['d'][$jam]['d'][$kodeMk]['d'] );
            $rowSpan=count($mkUjians[$kodeHari]['d'][$jam]['d'][$kodeMk]['d'] );
            if ($rowSpan>0) {
                $isKpAwal = true;
                foreach($kps as $kp) {
                    $isi = $mkUjians[$kodeHari]['d'][$jam]['d'][$kodeMk]['d'][$kp];
                    if ($isi>0) {
                        if ($isKpAwal) {
                            $isKpAwal=false;
                        } else {
                            echo '<tr '.$classText." id='kp_$kp' ".'>';
                        }
                        echo "<td align='center' valign='top' >$kp</td>";
                        echo "<td class='tandatangan_cell'>&nbsp;</td>";
                        echo "<td class='tandatangan_cell'>&nbsp;</td>";
                        echo "</tr>\n";
                    }
                }//foreach $kps
            }
        }//foreach $kodeMks
    }//foreach $jams
    
} // foreach($kodeHaris)
akhirTabel();
?>

    </body>
    
<?php

function awalTabel($params) {
?>
    <div id="tabel_matkul">
        <p><b><?php echo $params['judul'].'<br/>'.$params['sub_judul'];?></b><br/>
            <b>Form Penyerahan Soal Ujian</b></p>
        <table border="1" cellpadding="2" cellspacing="0" class="tabel_jadwal"  style="width: 18cm;">
            <thead>
                <tr>
<!--                    <th>Hari,Tanggal</th>-->
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>KP</th>
                    <th>Tanda tangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
<?php
}
?>
<?php
function akhirTabel() {
?>
            </tbody>     
        </table>
    </div>
<?php
}
?>
</html>
