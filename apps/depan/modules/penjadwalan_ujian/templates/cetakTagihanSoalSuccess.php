<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title><?php echo $params['halSurat']; ?></title>
 
    </head>    
    <body  >
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div>
<?php
$kodeDosens = array_keys($tagihans);
foreach ($kodeDosens as $kodeDosen) :
?>
        <p>&nbsp;</p>            <p>&nbsp;</p>             
        <div id="tabel_matkul" >
        <p>
Nomor: &nbsp;<?php echo $params['noSurat']; ?>/WD/FT/<?php $bulan=intval(date('m')); echo DataFormatter::$romawiNames[$bulan]; ?>/<?php echo date('Y');?> <br/>
Lamp.	:  1 (satu) lembar  <br/>                              																	
H a l	:  <?php echo $params['halSurat']; ?> <br/>
        </p> <p>&nbsp;</p>  
        <p>
            Yth. Bpk./Ibu <strong><?php echo $tagihans[$kodeDosen]['n'];?></strong> <br/>
Tenaga Edukatif Fakultas Teknik <br/>
Universitas Surabaya <br/>
Surabaya                  <br/>  <br/>    </p>                
<p>        
Dengan hormat, <br/>
				Bersama ini kami sampaikan <?php echo $params['halSurat']; ?> sebagai berikut :                                           
        </p>
        <div id="tabel_matkuls" >
            <table border="1" cellspacing="0" cellpadding="2" >
                <thead>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Minggu</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                </thead>
                <tbody>
                    <?php
                    $sudahAda=array(); 
                    foreach ($tagihans[$kodeDosen]['d'] as $kelas) :
                        $kodeMk = $kelas->getKodeMk();
                        if ( in_array($kodeMk,$sudahAda) ) {
                            continue;
                        }
                        $sudahAda[]=$kodeMk;
                        $namaMk = $kelas->getMataKuliah()->getNama();
                        $minggu=$kelas->getMinggu();
                        $hari=$kelas->getHari();
                        $jam=$kelas->getJam();
                     
                    ?>
                    <tr>
                        <td align="center"><?php echo $kodeMk;?></td>
                        <td><?php echo $namaMk;?></td>
                        <?php
                        
                        
                        //PenjadwalanUjian::kodeSlotKeMinggu($slot,$minggu,$hari,$jam);
                        $tglAwal = $params['tanggal'];
                        $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
                        $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari);
                        ?>
                        <td align="center"><?php echo DataFormatter::$romawiNames[$minggu]; ?></td>
                        <td align="center"><?php 
      $isUasGenap20132014 = sfConfig::get('app_uas_genap_20132014',0);
      if ($isUasGenap20132014) {
        if (($hari==2) && ($minggu==2)) {
            $hari=1;
        }
      }                              
                        echo DataFormatter::$dayNames[$hari] ;  
                        
                        ?></td>
                        <td align="center"><?php echo DataFormatter::dateToMyString($tglUjian); ?></td>
                        <td align="center"><?php echo DataFormatter::$romawiNames[$jam]; ?></td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
            <p>Kami beritahukan bahwa salah satu kriteria keberhasilan yang dijaminkan dalam ISO Fakultas Teknik adalah soal ujian diterima panitia 2 (dua) hari kerja sebelum tanggal ujian. Kami berharap Bapak/Ibu turut mendukung implementasi ISO di Fakultas Teknik.</p>
            <ul>
<!--                <li>Kuliah I (pertama) berakhir tanggal  <?php echo $params['kuliah1']; ?> *</li>
<!--                <li>Kuliah I (pertama) berakhir tanggal  <?php echo $params['kuliah1']; ?> *</li>
                <li>Kuliah II (ke dua) dimulai tanggal  <?php echo $params['kuliah2']; ?>*</li>-->                
                <li>Kuliah II (ke dua) berakhir tanggal  <?php echo $params['kuliah1']; ?>*</li>
            </ul>
            
            <p>Contoh  halaman  depan  soal/naskah ujian dapat dilihat dibalik surat ini.</p>
            <p>Demikian atas perhatian dan kerjasama yang baik, kami sampaikan terima kasih. </p>
            <p>&nbsp;</p>             

            <div  style="position:absolute; margin-left: 12cm; width: 50%;">
                Wakil Dekan, <br/>
                <img src="/images/hudiyo.jpg" width="200" /><br/>
                <b><u>Dr. Hudiyo Firmanto</u></b>
                
                
                
                
                
            </div>
        <p style="margin-top: 5cm;">

Catatan :<br/>
        <ul> 
            <li>Jam I    di mulai  pk. 07.30  WIB</li>
            <li>Jam II   di mulai	pk.	10.30  WIB</li>
            <li>Jam III di mulai	 pk. 	13.30  WIB</li>
            <li>Jam IV  di mulai  pk.	16.00  WIB</li>
        </ul>
            
        </p>
        </div>
<?php
                    endforeach;
?>                    
    </body>
</html>



