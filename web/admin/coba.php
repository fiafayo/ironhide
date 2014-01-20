<?php
require('../style/fpdf.php');
include('../inc/functions/f_laporan.php');
include('../inc/functions/connectdb.php');
include('../inc/functions/f_kls_mk.php');
include('../inc/functions/f_mk.php');
include('../inc/functions/f_jurusan.php');
include('../inc/functions/f_fpp.php');
include('../inc/functions/f_mhs.php');
	
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$baris=10;
$kolom=10;
$lap = selectAllKlsMk();
if($lap)	{
	foreach($lap as $display)	{
		//$kolom=10;
		$pdf->Cell($kolom,$baris,'Kode Mata Kuliah :'.$display['kode_mk']);
		$nama= getDetailMk($display['kode_mk']);
		$baris+=20;
		$pdf->Cell($kolom,$baris,'Nama Mata Kuliah :'.$nama['nama']);
		$baris+=20;
		
	}
}



$pdf->Output();
?>

