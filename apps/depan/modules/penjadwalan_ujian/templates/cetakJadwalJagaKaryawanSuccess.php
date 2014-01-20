<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title>Jadwal Jaga Karyawan</title>
 
    </head>    
    <body style="width: 21cm; margin:1cm 1cm 1cm 1cm;">
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div>
        
        
<?php

$mkNames=array();
$isAwal=true;
$kodeDss=array_keys($jadwalJagaDosens);
$kodeDsAktif = -1;
$tglAwal = $params['tanggal'];
foreach ($kodeDss as $kodeDs) :
    $no=1;
    $namaDs = $jadwalJagaDosens[$kodeDs]['n'];
    $slots = array_keys( $jadwalJagaDosens[$kodeDs]['d'] );
    $slotAktif = 0;
    foreach ($slots as $slot) :
        $kodeRu = $jadwalJagaDosens[$kodeDs]['d'][$slot]['r'];
        $kodeMks = array_keys($jadwalJagaDosens[$kodeDs]['d'][$slot]['m']);
        foreach($kodeMks as $kodeKelas) :
            $isi=$jadwalJagaDosens[$kodeDs]['d'][$slot]['m'][$kodeKelas];
            list($kodeMk,$kp)=explode('_',$kodeKelas);
                     if ($kodeDsAktif!=$kodeDs) {
                            if (!$isAwal) {
                                akhirTabel();
                            } else {
                                $isAwal=false;
                            }
                            awalTabel($params,$kodeDs,$namaDs);                         
                     }            
?> 
        <tr> 
            <?php
            if ($kodeDsAktif!=$kodeDs) {
                $kodeDsAktif=$kodeDs;
                 
            }
            if ($slotAktif!=$slot) {
                $slotAktif=$slot;
                $minggu=substr($slot,0,1);
                $hari=substr($slot,1,1);
                $jam=substr($slot,2,1);
                $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
                $n=count($jadwalJagaDosens[$kodeDs]['d'][$slot]['m']);
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
                
                echo '<td align="center" valign="top" rowspan="'.$n.'">'.$no++.'</td>';
                echo '<td align="center" valign="top" rowspan="'.$n.'">';
                echo $namaHari.', '.DataFormatter::dateToMyString($tglUjian).'</td>';
                echo '<td align="center" valign="top" rowspan="'.$n.'">';
                echo DataFormatter::$romawiNames[$jam].'</td>';
                echo '<td align="center" valign="top" rowspan="'.$n.'">';
                echo $kodeRu.'</td>';                
            }
            $mkName='';
            if ( isset( $mkNames[$kodeMk] ) ) {
                $mkName = '.'.$mkNames[$kodeMk] ;
            } else {
                $mk = MataKuliahPeer::retrieveByPK($kodeMk);
                if ($mk) {
                    $mkName='.'.$mk->getNama();
                }
            }
            echo '<td align="left">'.$kodeMk.$mkName."</td>";
            echo '<td align="center">'."$kp</td>";
            echo '<td align="center">'."$isi</td>";
            ?>
        </tr>
<?php
        endforeach;
    endforeach; 
endforeach;
akhirTabel();
?>
    </body>
</html>

<?php
function awalTabel($params,$kodeDs,$namaDs) {
     
?>
        <div id="tabel_utuh">
            <p><b><?php echo $params['judul']; ?></b><br/> 
            <b><?php 
            if ($kodeDs==0) {
                echo "Karyawan belum terjadwal";
            } else {
            echo $kodeDs.'.'.$namaDs; 
            }
            ?></b></p> 
            
            <table border="1" cellspacing="0" cellpadding="2"  style="width: 18cm">
                <thead>
                    <th>No.</th>
                    <th>Hari dan Tanggal</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Mata Kuliah</th>      
                    <th>KP</th>
                    <th>Isi</th>
                </thead>
                <tbody>
<?
}
function akhirTabel() {
?>
                </tbody>
            </table>
        </div>

<div>&nbsp;</div>
<hr />
<div>&nbsp;</div>

<?
}
?>
