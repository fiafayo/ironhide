<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
$penjadwalan=new PenjadwalanUjian();
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title><?php echo $params['judul']; ?></title>
 
    </head>    
    <body style="width: 21cm; margin:1cm 1cm 1cm 1cm;">
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div>
        
        
<?php
$isAwal=true;
$minggus=array_keys($jadwalUjians);
$mingguAktif = 0;
$tglAwal = $params['tanggal'];
foreach ($minggus as $minggu) :
     $haris = array_keys($jadwalUjians[$minggu]['d']);
     $hariAktif=0;
     foreach($haris as $hari) :
         $jamAktif=0;
         $jams=array_keys($jadwalUjians[$minggu]['d'][$hari]['d']);
         foreach($jams as $jam):
             $kodeMkAktif=0;
             $kodeMks=array_keys( $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'] ) ;
             foreach($kodeMks as $kodeMk) :
                 $kodeKpAktif=0;
                 $namaMk = $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['namaMk'];
                 $kps = array_keys ($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'] );
                 foreach($kps as $kp) :
                     $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
                     $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari);
                     if ($hariAktif!=$hari) {
                            if (!$isAwal) {
                                akhirTabel();
                            } else {
                                $isAwal=false;
                            }
                            $namaHari=DataFormatter::$dayNames[$hari];
      $isUasGenap20132014 = sfConfig::get('app_uas_genap_20132014',0);
      if ($isUasGenap20132014) {
        if (($hari==2) && ($minggu==2)) {
            $namaHari=DataFormatter::$dayNames[1];
        } else {
            $namaHari=DataFormatter::$dayNames[$hari];
        }
      }    
                            
                            $params['sub_judul']=$namaHari.', '.DataFormatter::dateToMyString($tglUjian).'<br/>'.
                                    'Piket: '.$jadwalUjians[$minggu]['d'][$hari]['p'];
                            awalTabel($params);                         
                     }
    
?>
                    <tr>
                        <?php
                        if ($mingguAktif!=$minggu) {
                            $mingguAktif=$minggu;
                         
                            
                        }
                        
                        if ($hariAktif!=$hari) {
                            $hariAktif=$hari;
                            
                            
                            //echo '<td align="center" valign="top" rowspan="'.$jadwalUjians[$minggu]['d'][$hari]['c'].'" >'.DataFormatter::$romawiNames[$minggu].'</td>';
                            //echo '<td align="center" valign="top" rowspan="'.($jadwalUjians[$minggu]['d'][$hari]['c']).'" >'.DataFormatter::$dayNames[$hari].', '.DataFormatter::dateToMyString($tglUjian).'</td>';
                        }
                        
                        if($jamAktif!=$jam) {
                            $jamAktif=$jam;                                    
                            echo '<td class="jamCell" align="center" valign="top" rowspan="'.($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['c']).'">'.DataFormatter::$romawiNames[$jam].'</td>';
                        }
                        if($kodeMkAktif!=$kodeMk) {
                            $kodeMkAktif=$kodeMk;                                    
                            echo '<td align="left" valign="top" rowspan="'.($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['c']).'">'."$namaMk ($kodeMk)".'</td>';
                        }
                        ?>
                         
                        <?php
                        if ($kodeKpAktif != $kodeMk.$kp ) :
                            $kodeKpAktif=$kodeMk.$kp;
                        ?>
                        
                        <td align="center" valign="top" rowspan="<?php echo $jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]['c']; ?>"><?php echo $kp; ?></td>
                         
                        <?php
                        endif;
                        ?>
                             <?php 
                        foreach ($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp]['d'] as $ruang=>$dr) {
                            $isi=$dr['i'];
                            $bgn=$dr['b'];
                            $end=$dr['e'];
                            $kodeDosen=$dr['d'];
                            $kodeKaryawan=$dr['k'];
                            $namaDosen = ( isset( $penjadwalan->dosenReffs[$kodeDosen] ) ) ? $penjadwalan->dosenReffs[$kodeDosen] : '';
                            $namaKaryawan = ( isset( $penjadwalan->karyawanReffs[$kodeKaryawan] ) ) ? $penjadwalan->karyawanReffs[$kodeKaryawan] : '';
                            echo "<td nowrap='true' align='center'>$ruang($isi)</td> <td align='center'>$namaDosen($kodeDosen)</td><td  align='center'>$namaKaryawan($kodeKaryawan)</td></tr>";
                            
                        }
                        ?>  
                          
                    
<?php
                endforeach;
            endforeach;
        endforeach;
    endforeach;
endforeach;
akhirTabel();
?>
    </body>
</html>

<?php
function awalTabel($params) {
     
?>
        <div id="tabel_matkul">
            <p><b><?php 
            
            echo $params['judul'].'<br/>'.$params['sub_judul'];
            ?></b></p> 
            <table border="1" cellspacing="0" cellpadding="2"  style="width: 18cm;">
                <thead>
<!--                    <th>Minggu</th>
                    <th>Hari dan Tanggal</th> -->
                    <th>Jam</th>
                    <th>Mata Kuliah</th>      
                    <th>KP</th>
                    <th>Ruang</th><th>Dosen</th><th>Karyawan</th>
                     
                     
                </thead>
                <tbody>
<?
}
function akhirTabel() {
?>
                </tbody>
            </table>
        </div>

<?
}
?>
