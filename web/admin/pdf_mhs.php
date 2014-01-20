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
	$kolom=200;
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell($kolom,$baris,"Print time : ".date("j F Y - g:i a"),0,1,'L');
	$pdf->SetFont('Arial','B',14);
	$nama = getDetailJurusan($_GET['jur']);
	$pdf->Cell($kolom,$baris,'LAPORAN HASIL PERWALIAN '.$nama['nama']." ",0,1,'C');
	$pdf->Cell($kolom,$baris,$_GET['semester']." ".$_GET['tahun'],0,1,'C');
	$baris=6;
	$lap = getDetailKlsMk($_GET['kls']);
	
	$mhs = selectAllPesertaFpp($_GET['jur']);
	$pdf->Cell($kolom,$baris," ",0,1,'L');
	$i=0;
	if($mhs)	{  	
		foreach($mhs as $display)	{
			$i++;
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell($kolom/16,$baris,$i." ",0,0,'R');		
			$pdf->Cell($kolom/16,$baris,$display['nrp']." ",0,0,'L');
			$mk=selectAllTerimaKls($display['nrp'],$_GET['semester'],$_GET['tahun']);
			$pdf->SetFont('Arial','',8);
			foreach($mk as $input)	{
				$pdf->Cell($kolom/16,$baris,$input['kode_mk'].$input['kp'],0,0,'L');
			}
			$pdf->Cell($kolom/16,$baris," ",0,1,'L');
		}
	}
	$pdf->Cell($kolom,$baris,' ',0,1,'C');
	$pdf->Cell($kolom,$baris,'---------------------------------------------------------------------------------------------------------',0,1,'C');
	
	$pdf->Output();
?>