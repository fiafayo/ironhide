<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title><?php echo $params['judul']; ?></title>
        <style media="print" type="text/css" >
          
        </style>
    </head>    
    <body style="width: 21cm; margin:1cm 1cm 1cm 1cm;">
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div>
        
        
<?php
$isAwal=true;
$kodeHaris=array_keys($jadwalUjians);
$hariAktif=0; 
$tglAwal = $params['tanggal'];
foreach ($kodeHaris as $kodeHari) :
   $jamAktif=0;  
   $hari=substr($kodeHari,1,1);   
   $minggu=substr($kodeHari,0,1);
   $jams=array_keys( $jadwalUjians[$kodeHari]['d'] );
   foreach ($jams as $jam) :

        $kodeRuangAktif=0;
        $kodeRuangs = array_keys( $jadwalUjians[$kodeHari]['d'][$jam]['d'] );
        foreach ($kodeRuangs as $kodeRuang) :
            $kodeDos = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['dos'];
            $namaDosen = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['nd'];
            $kodeKar = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['kar'];
            $namaKaryawan = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['nk'];
            //$isi = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['isi'];
            $mks = array_keys( $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['d'] ) ;      
            foreach($mks as $mk) :
                  
                  
                     if ($hariAktif!=$hari) {
                            if (!$isAwal) {
                                akhirTabel();
                            } else {
                                $isAwal=false;
                            }
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
      
                            
                            $params['sub_judul']=$namaHari.', '.DataFormatter::dateToMyString($tglUjian).'<br/>Pengawas: '.$jadwalUjians[$kodeHari]['p'];
                            // //$params['sub_judul']=DataFormatter::$dayNames[$hari].', '.DataFormatter::dateToMyString($tglUjian);
                            awalTabel($params);                         
                     }
    
?>
                    <tr>
                        <?php
 
                        
                        if ($hariAktif!=$hari) {
                            $hariAktif=$hari;
                            
                            //echo '<td align="center" valign="top" rowspan="'.($jadwalUjians[$kodeHari]['c']).'" >'.DataFormatter::$dayNames[$hari].', '.DataFormatter::dateToMyString($tglUjian).'<br/>Pengawas:<br/>'.$jadwalUjians[$kodeHari]['p'].'</td>';
                        }
                        
                        if($jamAktif!=$jam) {
                            $jamAktif=$jam;                                    
                            echo '<td class="jamCell" align="center" valign="top" rowspan="'.($jadwalUjians[$kodeHari]['d'][$jam]['c']).'">'.DataFormatter::$romawiNames[$jam].'</td>';
                        }
                        
                        if ($kodeRuangAktif!==$kodeRuang) {
                            
                        ?>
                         
                        
                         
                        <td align="center" valign="top" rowspan="<?php echo $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c']?>" ><?php  echo $kodeRuang; ?></td>
                        <td align="center" valign="top" rowspan="<?php echo $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c']?>" ><?php  echo $namaDosen."($kodeDos)"; ?></td>
                        <td rowspan="<?php echo $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c']?>" >&nbsp;</td>
                        <td align="center" valign="top" rowspan="<?php echo $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c']?>" ><?php  echo $namaKaryawan."($kodeKar)"; ?></td>
                        <td rowspan="<?php echo $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['c']?>" >&nbsp;</td>
                        <?php
                            $kodeRuangAktif=$kodeRuang;
                        }
                        list($kodeMk,$kp) = explode('_', $mk);
                        $namaMk = ( isset( $penjadwalan->mataKuliahReffs[$kodeMk] ) ) ? $penjadwalan->mataKuliahReffs[$kodeMk] : '';
                        ?>
                        <td align="center" valign="top" ><?php echo $namaMk."($kodeMk) ";?></td>  
                        <td align="center" valign="top" ><?php echo  $kp ;?></td>  
                    </tr>
<?php
                  
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
            <p><b><?php echo $params['judul'].'<br/>PRESENSI PETUGAS JAGA UJIAN : '.$params['sub_judul'];?></b></p> 
            <table border="1" cellspacing="0" cellpadding="2" style="width: 18cm;">
                <thead>

<!--                    <th>Hari dan Tanggal</th>-->
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Dosen</th>
                    <th>Tanda Tangan</th>
                    <th>Karyawan</th>
                    <th>Tanda Tangan</th>
                    <th>Mata Kuliah</th>      
                    <th>KP</th>
                    
                     
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
