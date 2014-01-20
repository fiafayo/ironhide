<?
	require('../style/fpdf.php');
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_laporan.php');
	include('../inc/functions/f_kls_mk.php');
	include('../inc/functions/f_mk.php');
	include('../inc/functions/f_jurusan.php');
	include('../inc/functions/f_fpp.php');
	include('../inc/functions/f_mhs.php');
	
	$pdf=new FPDF();
	$pdf->AddPage();
	$baris=10;
	$kolom=190;
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell($kolom,$baris,"Print time : ".date("j F Y - g:i a"),0,1,'L');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell($kolom,$baris,'DAFTAR ISI KELAS SAMPAI DENGAN KASUS KHUSUS',0,1,'C');
	$pdf->Cell($kolom,$baris,$_GET['semester']." ".$_GET['tahun'],0,1,'C');
	$baris=6;
	$pdf->Cell($kolom,$baris," ",0,1,'L');

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(15,$baris,'KODE ',1,0,'C');
	$pdf->Cell(95,$baris,'NAMA MK ',1,0,'C');
	$pdf->Cell(10,$baris,'KP ',1,0,'C');
	$pdf->Cell(12,$baris,'KAP ',1,0,'C');
	$pdf->Cell(12,$baris,'FPP1 ',1,0,'C');
	$pdf->Cell(12,$baris,'FPP2 ',1,0,'C');
	$pdf->Cell(12,$baris,'KK ',1,0,'C');
	$pdf->Cell(12,$baris,'JML',1,0,'C');
	$pdf->Cell(12,$baris,'SISA',1,1,'C');
	$pdf->SetFont('Arial','',10);
	$lap = selectAllKlsMk();
	if($lap)	{
		foreach($lap as $display)	{
			$jumlah=0;
			$pdf->Cell(15,$baris,$display['kode_mk'],1,0,'C');
			$nama= getDetailMk($display['kode_mk']);
			$pdf->Cell(95,$baris,$nama['nama'],1,0,'L');
			$pdf->Cell(10,$baris,$display['kp'],1,0,'C');
			$pdf->Cell(12,$baris,$display['kapasitas'],1,0,'C');
			$kode = "I".substr($_GET['tahun'],2,2).substr($_GET['semester'],0,2);
			$number = getTerimaKls($kode,$display['kode_kelas']);
			$jumlah+=$number;
			$pdf->Cell(12,$baris,$number,1,0,'R');
			$kode = "II".substr($_GET['tahun'],2,2).substr($_GET['semester'],0,2);
			$number = getTerimaKls($kode,$display['kode_kelas']);
			$jumlah+=$number;
			$pdf->Cell(12,$baris,$number,1,0,'R');
			$kode = "KK".substr($_GET['tahun'],2,2).substr($_GET['semester'],0,2);
			$number = getTerimaKls($kode,$display['kode_kelas']);
			$jumlah+=$number;
			$pdf->Cell(12,$baris,$number,1,0,'R');
			$pdf->Cell(12,$baris,$jumlah,1,0,'R');
			$pdf->Cell(12,$baris,$display['kapasitas']-$jumlah,1,1,'R');

		}
	}
	$pdf->Cell($kolom,$baris,' ',0,1,'C');
	$pdf->Cell($kolom,$baris,'---------------------------------------------------------------------------------------------------------',0,1,'C');
	
	$pdf->Output();
?>