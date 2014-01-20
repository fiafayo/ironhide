<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
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
                            
                            $params['sub_judul']=$namaHari.', '.DataFormatter::dateToMyString($tglUjian);
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
                            echo '<td align="center" valign="top" rowspan="'.($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['c']).'">'."$namaMk ($kodeMk)".'</td>';
                        }
                        ?>
                         
                        
                         
                        <td align="center"><?php echo $kp; ?></td>
                        <td align="center" nowrap="true"><table border="0"><?php 
                        foreach ($jadwalUjians[$minggu]['d'][$hari]['d'][$jam]['d'][$kodeMk]['ruangs'][$kp] as $ruang=>$dr) {
                            $isi=$dr['i'];
                            $bgn=$dr['b'];
                            $end=$dr['e'];
                            echo "<tr><td nowrap='true'>$ruang($isi)</td><td nowrap='true'>$bgn-$end</td></tr>";
                        }
                        ?></table></td>
                          
                    </tr>
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
            <p><b><?php echo $params['judul'].'<br/>'.$params['sub_judul'];?></b></p> 
            <table border="1" cellspacing="0" cellpadding="2"  style="width: 18cm;">
                <thead>
<!--                    <th>Minggu</th>
                    <th>Hari dan Tanggal</th> -->
                    <th>Jam</th>
                    <th>Mata Kuliah</th>      
                    <th>KP</th>
                    <th>Ruang</th>
                     
                </thead>
                <tbody>
<?
}
function akhirTabel() {
?>
                    <tr>
                        <td colspan="4" align="center">
                            <table border="0" cellspacing="0" cellpadding="2" width="100%">
                                <tr>
                                    <td colspan="4" align="center"><strong>Keterangan :</strong></td>
                                </tr>
                                <tr>
                                    <td width="25%" align="center"><div style="border:1px black"> Jam I  mulai  pk. 07.30 </div></td>
                                    <td width="25%" align="center"><div  style="border:1px black"> Jam II mulai	pk.	10.30  </div></td>
                                    <td width="25%" align="center"><div  style="border:1px black"> Jam III mulai	 pk. 	13.30 </div></td>
                                    <td width="25%" align="center"><div  style="border:1px black"> Jam IV  mulai  pk.	16.00 </div> </td>
                                </tr>
                            </table>
                             
 
         
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<?
}
?>
