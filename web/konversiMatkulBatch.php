<?php
include('konversiMatkulFunctions.php');
$jurusanNames = array(
        '61-61'=>'Teknik Elektro',
        '62-62'=>'Teknik Kimia',
        '62-01'=>'Teknologi Proses Pangan',
        '62-02'=>'Teknologi dan Ilmu Lingkungan',
        '63-63'=>'Teknik Industri',
        '64-64'=>'Teknik Informatika',
        '65-65'=>'Teknik Manufaktur',
        '66-66'=>'Desain dan Manajemen Produk',
        '67-67'=>'Sistem Informasi',
        '68-68'=>'Multimedia',
        '69-69'=>'IT Dual Degree'
    );
foreach ( array_keys($jurusanNames) as $kodeJur ) {
   echo "MULAI jurusan ".$jurusanNames[$kodeJur]."... \n";
   konversiMataKuliah($kodeJur, '2005');
}
foreach ( array_keys($jurusanNames) as $kodeJur ) {
   echo "MULAI jurusan ".$jurusanNames[$kodeJur]."... \n";
   konversiMataKuliah($kodeJur, '2010');
}
?>
