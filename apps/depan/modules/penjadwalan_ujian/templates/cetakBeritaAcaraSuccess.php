<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
$tglAwal=$params['tanggal'];
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title><?php echo $params['judul']; ?></title>
        <style type="text/css" >
            #logo_ubaya {
                width: 2.25cm;
                height: 2.5cm;
                position: absolute;
                margin-left: 0;
                margin-top: 0;
/*                background-image:  url('/images/logo/logo_ubaya_bw_no_text.png');
                background-repeat: no-repeat;*/
                
            }
            .header_berita_acara {
                text-align: left;
                margin-left: 0.5cm;
                font-family: Tahoma, Verdana, Arial, sans-serif;
                position: absolute;
                left: 2.1cm;
            }
            .judul_berita_acara {
                margin: 0 0 0 0.4cm;
                font-size: larger;
                font-weight: bold;
            }
            .sub_judul_berita_acara {
                margin: 0cm 0 0 0.4cm;
                font-size: large;
                font-weight: bold;
            }
            .kotak_atas {
                width: 18cm;
/*                border: solid 2px #0A246A;*/
                margin-top: 3cm;
                position:absolute;
                width: 18cm;
                height: 4cm;
            }
            .kotak_atas_kiri {
                width: 18cm;
                margin-left: 0px;
                position:absolute;
                border: solid 2px #0A246A;
            }
            .kotak_atas_kanan {
                width: 9cm;
                right: 0px;
                position:absolute;
                border: solid 2px #0A246A;
                 
            }
            p,td,th {
           font-family: Georgia, "Times New Roman", serif;
           font-size:   medium;
       }
        </style>
 
    </head>    
    <body style="margin:1cm 1cm 1cm 1cm"  >
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div>
<?php
$isAwal=true;
$kodeHaris=array_keys($jadwalUjians);
$hariAktif=0; 
$tglAwal = $params['tanggal'];
foreach ($kodeHaris as $kodeHari) {
   $jamAktif=0;  
   $hari=substr($kodeHari,1,1);   
   $minggu=substr($kodeHari,0,1);
   $jams=array_keys( $jadwalUjians[$kodeHari]['d'] );
   foreach ($jams as $jam) {

        $kodeRuangAktif=0;
        $kodeRuangs = array_keys( $jadwalUjians[$kodeHari]['d'][$jam]['d'] );
        foreach ($kodeRuangs as $kodeRuang) {
            //$kodeDos = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['dos'];
            $namaDosen = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['nd'];
            //$kodeKar = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['kar'];
            $namaKaryawan = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['nk'];
            //$isi = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['isi'];
            $mks = array_keys( $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['d'] ) ;      
            foreach($mks as $mk) {
                  
                  
                     if ($hariAktif!=$hari) {
                            if (!$isAwal) {
                                //akhirTabel();
                            } else {
                                $isAwal=false;
                            }
                                                    
                     }
    
?>  
                        <?php
 
                        
                        if ($hariAktif!=$hari) {
                            $hariAktif=$hari;
                            
                            $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
                            $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari);                            
                            //echo '<td align="center" valign="top" rowspan="'.($jadwalUjians[$kodeHari]['c']).'" >'.DataFormatter::$dayNames[$hari].', '.DataFormatter::dateToMyString($tglUjian).'<br/>Pengawas:<br/>'.$jadwalUjians[$kodeHari]['p'].'</td>';
                        }
                        
                        if($jamAktif!=$jam) {
                            $jamAktif=$jam;                                    
                            //echo '<td class="jamCell" align="center" valign="top" rowspan="'.($jadwalUjians[$kodeHari]['d'][$jam]['c']).'">'.DataFormatter::$romawiNames[$jam].'</td>';
                        }
                        
                        if ($kodeRuangAktif!==$kodeRuang) {
                            
                        ?>
                         
                        
                         
                        <?php
                            $kodeRuangAktif=$kodeRuang;
                        }
                        list($kodeMk,$kp) = explode('_', $mk);
                        $namaMk = ( isset( $penjadwalan->mataKuliahReffs[$kodeMk] ) ) ? $penjadwalan->mataKuliahReffs[$kodeMk] : '';
                        ?>
        
        <div id="tabel_matkul" >
            <table border="0">
                <tbody>
                    <tr>
                    <td  >
                        <img src="/images/logo/logo_ubaya_bw_no_text.png" border="0" style="width:2.2cm" />
                    </td>
                    <td  >
                        <div class="judul_berita_acara">UNIVERSITAS SURABAYA<br/>Fakultas Teknik<br/><?php echo $params['judul'];?></div>
                        <div class="sub_judul_berita_acara">BERITA ACARA</div>
                    </td>
                    </tr>
                </tbody>
            </table>    
            <table border="1" cellspacing="0" cellpadding="2" style="width: 18cm;">
                <tbody>
                    <tr>
                        <td style="width: 11cm" colspan="6">
                            <b>Mata Kuliah : </b><?php echo $namaMk ;?>
                        </td>
                        <td style="width: 4cm" colspan="6">
                            <b>Kode : </b><?php echo "$kodeMk ($kp)";?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="12">
                            JENIS SOAL	:	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1.  GANDA	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	  2.  ESSAY	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	    3.  KOMBINASI
                        </td>
                    </tr>
 
                    <tr>
                        <td colspan="12" align="left">
                            <div align="center"><b>Dosen Penguji:</b></div>
<?php
 
    $no=1;
    foreach (MataKuliahPeer::getPengajars($kodeMk)  as $kodeDosen=>$namaDosen) {
        echo $no++.". ";
         
        echo $namaDosen." ($kodeDosen)<br/>";
    }

?>
                        </td>
                    </tr>
                    
                </tbody>
            </table>    
            <table border="1" cellspacing="0" cellpadding="2" style="width: 18cm; margin-top: 0.2cm">
                <tbody>
                    
                    <tr>
                        <td colspan="6" align="center">
                            Ruang:<br/>
                            <?php 
                            $isi = $jadwalUjians[$kodeHari]['d'][$jam]['d'][$kodeRuang]['d'][$mk];
                            echo $kodeRuang." ($isi)";?>
                        </td>
                        <td colspan="6" align="center">
<?php                    
      $namaHari=DataFormatter::$dayNames[$hari];
      $isUasGenap20132014 = sfConfig::get('app_uas_genap_20132014',0);
      if ($isUasGenap20132014) {
        if (($hari==2) && ($minggu==2)) {
            $namaHari=DataFormatter::$dayNames[1];
        } else {
            $namaHari=DataFormatter::$dayNames[$hari];
        }
      }    
?>                            
                            <b>Hari/Tanggal : </b><?php echo $namaHari.', '.DataFormatter::dateToMyString($tglUjian);?><br/>
                            <b>Waktu :</b>  .................. s.d  ................... (....... menit)
                             
                        </td>
                        
                    </tr>
                </tbody>
            </table>    
            <table border="1" cellspacing="0" cellpadding="2" style="width: 18cm; margin-top: 0.2cm">
                <tbody>
                    <tr>
                        <td colspan="6" align="center"><b>PESERTA</b></td>
                        <td colspan="6" rowspan="2" align="center">
                            <b>NRP YANG TIDAK HADIR : </b><br/>
                                    .............................................................................. <br/>
                                    .............................................................................. <br/>
                                    .............................................................................. <br/>
                                    .............................................................................. <br/>
                                    .............................................................................. <br/>
                                    .............................................................................. <br/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center">
                            <table border="0">
                                <tr><td>Terdaftar</td><td>:</td><td>...........</td><td>orang</td></tr>
                                    <tr><td>Hadir</td><td>:</td><td>...........</td><td>orang</td></tr>
                                    <tr><td>BSS/MSS/Tilang</td><td>:</td><td>...........</td><td>orang</td></tr>
                                    <tr><td>Tidak Hadir</td><td>:</td><td>...........</td><td>orang</td></tr>
                                 
                            </table>
                                
                        </td>
                    </tr>
                </tbody>
            </table>    
            <table border="1" cellspacing="0" cellpadding="2" style="width: 18cm; margin-top: 0.2cm">
                <tbody>
                    <tr>
                        <td><div align="center"><b>Kejadian Penting Selama Ujian Berlangsung</b></div>

                        &nbsp;<br/><br/><br/></td>
                    </tr>
                 
                </tbody>

            </table>
            <table border="1" cellspacing="0" cellpadding="2" style="width: 18cm; margin-top: 0.2cm">
                <tbody>
                    <tr>
                        <td align="center"><div align="center"><b>PENGAWAS / PEMBANTU PENGAWAS</b></div>
                            <table border="0">
                                <tr>
                                    <th>NPK</th>
                                    <th>Nama</th>
                                    <th colspan="2">Tanda tangan</th>
                                </tr>
                                <tr>
                                    <td>1. ............................</td>
                                    <td>...........................................................................</td>
                                    <td>&nbsp;</td>
                                    <td>1. ...............</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>2. ............................</td>
                                    <td>...........................................................................</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>2. ...............</td>
                                </tr>
                                <tr>
                                    <td>3. ............................</td>
                                    <td>...........................................................................</td>
                                    <td>&nbsp;</td>
                                    <td>3. ...............</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>4. ............................</td>
                                    <td>...........................................................................</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>4. ...............</td>
                                </tr>
                            </table>

                            
                    </tr>
                 
                </tbody>

            </table>
            <div align="center" style="margin-top:0.3cm; width: 10cm; margin-left: 7cm;" >
                Dosen Piket, <br/><br/><br/><br/>
                <b>
                <?php
                echo $jadwalUjians[$kodeHari]['p'];
                ?>
                </b>
                
                
            </div>
            <div>&nbsp;<br/></div>
        </div>
        
  
<?php
                  
            } // kodeMk 
        } //kodeRuang
   } //jam   
} //kodeHari;
 
?>
        
    </body>
     
</html>