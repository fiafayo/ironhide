<?php
$baseUrl = sfConfig::get('sf_relative_url_root','');
$params=$sf_request->getParameter('surat');

?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/previewCetak.css"   />
        <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/cetakSurat.css" media="print" />
        <title>Pengantar Berkas Ujian</title>
        <style type="text/css" >
            p,td,th,div {
           font-family: Georgia, "Times New Roman", serif;
           font-size:   medium;
       }
       .kecil {
           font-size: smaller;
       }
        </style>
 
    </head>    
    <body style="margin:1cm 1cm 1cm 1cm"  >
        <div class="noPrint">
            <input type="button" name="cetak" value="Cetak" onclick="window.print();" />
        </div> 
<?php
$kodeMks = array_keys($mataKuliahReffs);
$tglAwal = $params['tanggalAwal'];
foreach ($kodeMks as $kodeMk) {
?>
        <div id="isi_surat" style="width:18cm">
        <p><br/><br/>
Nomor: &nbsp;<?php echo $params['noSurat']; ?>/WD/FT/<?php $bulan=intval(date('m')); echo DataFormatter::$romawiNames[$bulan]; ?>/<?php echo date('Y');?> <br/>
Lamp.	:  1 (satu) berkas  <br/>                              																	
H a l	:  <?php echo $params['halSurat']; ?>  
        </p>
<?php
$dosens = MataKuliahPeer::getPengajars($kodeMk);

?>
        <div>
Yang terhormat, <br/>
Bapak/Ibu   </div>
        
<?php
$no=1;
$n=count($dosens);
if ($n>1) {
    echo '<div style="margin-left: 1cm">';
    foreach($dosens as $kodeDosen=>$namaDosen) {
        if ($no>9) break;
        echo  $no++.". $namaDosen ($kodeDosen)<br/>";
    }
    echo '</div>';
} else {
    echo '<div>';
    foreach($dosens as $kodeDosen=>$namaDosen) {
        echo  "<b>$namaDosen ($kodeDosen)</b><br/>";
    }     
    echo '</div>';
}
?>     
        <div>
Dosen  Fakultas Teknik <br/>
Universitas  Surabaya <br/>
Surabaya             <br/> 
               
        
        </div>
        <p>
Dengan hormat, <br/>
Bersama ini kami kirimkan  berkas penyelesaian <?php echo $params['ujian']; ?> <br/>
        <div align="center">
<table border="1" cellspacing="0" cellpadding="2">
    <tr>
        <td>Mata Kuliah</td>
        <td><?php echo $mataKuliahReffs[$kodeMk]['n'];?></td>        
    </tr>
    <tr>
        <td>Tanggal Ujian</td>
        <td><?php 
        $minggu= $mataKuliahReffs[$kodeMk]['m'];
        $hari = $mataKuliahReffs[$kodeMk]['h'];
        $tambahanHari = ($minggu-1)*7 + ($hari - 1) ;
        $tglUjian = DataFormatter::addDaysWithDate($tglAwal, $tambahanHari);  
        echo DataFormatter::dateToMyString($tglUjian);
        ?></td>        
    </tr>
    <tr>
        <td>Jumlah </td>
        <td>&nbsp;</td>
    </tr>
</table>
        </div>
        </p>        
        <p>
Kami mohon Nilai Ujian langsung diinputkan di <b>http://my.ubaya.ac.id</b> sesuai petunjuk pengisian yang pernah kami sampaikan, kemudian hasil input nilai divalidasi. Setelah itu, mohon daftar peserta ujian yang diisi tanggal dan ditanda tangani diserahkan  kepada kami selambat – lambatnya :            
        </p>
        <div align="center">
        <div style="border: 2px solid black; padding: 10px; width: 10cm; font-size: large; text-align: center" align="center" >
            <?php 
            $deadline = $params['deadline'];
            echo ($deadline);
            ?>
        </div>
            </div>
        <p>Atas perhatian dan kerjasama yang baik, kami sampaikan terima kasih.</p>
        <div align="center">
        <table border="0" cellpadding="10" style="width: 17cm" >
            <tr>
                <td   align="left" valign="top"><?php tabelNilai(); ?></td>
                <td   align="center" valign="top"><?php tabelPenerima(); ?></td>
                <td   align="right" valign="top"><?php tabelTandaTangan($params); ?></td>
            </tr>
        </table>
        </div>
    </div>
<?php
} //foreach $kodeMks
?>
    </body>
     
</html>

<?php
function tabelNilai() {
?>
<div style="width: 7cm"  class="kecil" >
<b>Batas Nilai Sistem Penilaian Akademik</b><br/>
<table border="1" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <th class="kecil">Kategori</th>
            <th class="kecil">NR</th>
            <th class="kecil">Rentang Nilai <br/>Mentah Akhir (NMA)</th>
             
        </tr>
    </thead>
    <tbody>
<?php
$nilais=array(
    "Istimewa,A,NMA ≥ 8I",
    "Amat Baik,AB,73 ≤ NMA < 8l",
    "Baik,B,66 ≤ NMA < 73",
    "Cukup Baik,BC,60 ≤ NMA < 66",
    "Sedang,C,55 ≤ NMA < 60",
    "Kurang,D,40 ≤ NMA < 55",
    "Gagal,E,NMA < 40"    
);
foreach ($nilais as $nilai) {
    list($kat,$kode,$rentang) = explode(',',$nilai);

?>        
        <tr>
            <td class="kecil"><?php echo $kat;?></td>
            <td class="kecil"><?php echo $kode;?></td>
            <td class="kecil"><?php echo $rentang;?></td>
        </tr>
<?php
}
?>
    </tbody>
</table>
</div>
<?php
}

function tabelPenerima() {
?>
<table border="0" style="width: 5cm">
    <tr>
        <td align="center">Tanggal Diterima:<br/>
        ___________________<br/>

        Penerima,<br/><br/><br/><br/><br/>
        ___________________<br/>
        Nama Terang
        </td>
    </tr>
</table>
<?php } 
function tabelTandaTangan($params){
?>
<table border="0" style="width: 5cm">
    <tr>
        <td align="center">Sekretaris Panitia Ujian,<br/>
        <img src="/images/hudiyo_stempel.jpg" width="180" /> 
        <?php echo $params['wd'];?><br/>
         
        </td>        
    </tr>
</table>

<?php } ?>





