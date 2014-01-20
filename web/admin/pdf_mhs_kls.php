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
$baris=20;
$kolom=200;
$pdf->SetFont('Arial','B',7);
$pdf->Cell($kolom,$baris,"Print time : ".date("j F Y - g:i a"),0,1,'L');

$pdf->SetFont('Arial','B',14);
$pdf->Cell($kolom,$baris,'LAPORAN PENDAFTAR KELAS MATA KULIAH',0,1,'C');
$baris=6;
$lap = getDetailKlsMk($_GET['kls']);
$pdf->SetFont('Arial','',12);

$pdf->Cell($kolom/2,$baris,'Kode Mata Kuliah :',0,0,'R');
$pdf->Cell($kolom/2,$baris,$lap['kode_mk'],0,1,'L');
$nama= getDetailMk($lap['kode_mk']);
$pdf->Cell($kolom/2,$baris,'Nama Mata Kuliah :',0,0,'R');
$pdf->Cell($kolom/2,$baris,$nama['nama'],0,1,'L');
$pdf->Cell($kolom/2,$baris,'KP :',0,0,'R');
$pdf->Cell($kolom/2,$baris,$lap['kp'],0,1,'L');
$pdf->Cell($kolom/2,$baris,'Kapasitas :',0,0,'R');
$pdf->Cell($kolom/2,$baris,$lap['kapasitas'],0,1,'L');

$jml_daftar = getPendaftarKls($_GET['fpp'], $_GET['kls']);
$pdf->Cell($kolom/2,$baris,'Jumlah Pendaftar :',0,0,'R');
$pdf->Cell($kolom/2,$baris,$jml_daftar+$lap['isi'],0,1,'L');
$pdf->Cell($kolom,$baris,' ',0,1,'C');
$nrp = selectAllPendaftarKls($_GET['kls'],getSemester(),getTahunAjaran());

unset($ass);unset($tua);unset($sn);unset($sem);unset($lainnya);
$jml=0;
if($nrp)	{
	foreach($nrp as $tampil)	{
		$detail = getDetailMhs($tampil['nrp']);
		
		
		//CHECK SETTING NRP
		$checkSettingNrp = getSettingKls($_GET['kls']);
		if($checkSettingNrp)	{
			foreach($checkSettingNrp as $nrpKls)	{
				if(($tampil['nrp'] >= $nrpKls['nrp_awal']) && ($tampil['nrp'] <= $nrpKls['nrp_akhir']))	{
					$setting=true;
				}
				else	{
					$setting=false;
				}
			}
		}
		else	{
			$setting=false;
		}
		
		//CHECK SEMESTER
		$mkJur = getDetailMkJur($lap['kode_mk'],$detail['jurusan']);
		$semesterMhs =  getSemesterMhs($tampil['nrp']);
		
		if($detail['asisten']==1)	{
			$ass[count($ass)]['nrp'] = $tampil['nrp'];
		}
		
		else if($setting==true)	{
			$sn[count($sn)]['nrp'] = $tampil['nrp'];
		}
		else if($mkJur['semester']==$semesterMhs)	{
			$sem[count($sem)]['nrp'] = $tampil['nrp'];
		}
		else if((substr(getTahunAjaran(),0,4)-getAngkatanMhs($tampil['nrp']))>=2)	{
			$tua[count($tua)]['nrp'] = $tampil['nrp'];
		}
		else	{
			$lainnya[count($lainnya)]['nrp']  = $tampil['nrp'];
		}
		$jml++;
	}
}
$i=0;
$pdf->SetFont('Arial','B',12);
$pdf->Cell($kolom,$baris,'Asisten :',0,1,'L');
$pdf->SetFont('Arial','',12);
if(count($ass)>0 && $ass)	{
  	foreach($ass as $tampil) 	{
		$i++;
		if($i%5==0)	{
			$pdf->Cell($kolom,$baris,$tampil['nrp'],0,1,'L');
		}
		else	{
			$pdf->Cell($kolom/5,$baris,$tampil['nrp'],0,0,'L');
		}
  	}
	$pdf->Cell($kolom,$baris,'Jumlah Asisten = '.$i,0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}
else	{
	$pdf->Cell($kolom/5,$baris,"-",0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}

$i=0;
$pdf->SetFont('Arial','B',12);
$pdf->Cell($kolom,$baris,'Setting Nrp :',0,1,'L');
$pdf->SetFont('Arial','',12);

if(count($sn)>0 && $sn)	{
  foreach($sn as $tampil) 	{
		$i++;
		if($i%5==0)	{
			$pdf->Cell($kolom,$baris,$tampil['nrp'],0,1,'L');
		}
		else	{
			$pdf->Cell($kolom/5,$baris,$tampil['nrp'],0,0,'L');
		}
  }
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
 $pdf->Cell($kolom,$baris,'Jumlah Setting Nrp = '.$i,0,1,'L');
 $pdf->Cell($kolom,$baris,' ',0,1,'L');
}
else	{
	$pdf->Cell($kolom/5,$baris,"-",0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}

$i=0;
$pdf->SetFont('Arial','B',12);
$pdf->Cell($kolom,$baris,'Semester Mata Kuliah :',0,1,'L');
$pdf->SetFont('Arial','',12);
if(count($sem)>0 && $sem)	{
  	foreach($sem as $tampil) 	{
		$i++;
		if($i%5==0)	{
			$pdf->Cell($kolom,$baris,$tampil['nrp'],0,1,'L');
		}
		else	{
			$pdf->Cell($kolom/5,$baris,$tampil['nrp'],0,0,'L');
		}
  	}
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
  	$pdf->Cell($kolom,$baris,'Jumlah Semester Mata Kuliah = '.$i,0,1,'L');
  	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}
else	{
	$pdf->Cell($kolom/5,$baris,"-",0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}


$i=0;
$pdf->SetFont('Arial','B',12);
$pdf->Cell($kolom,$baris,'Angkatan Tua :',0,1,'L');
$pdf->SetFont('Arial','',12);
if(count($tua)>0 && $tua)	{
  foreach($tua as $tampil) 	{
		$i++;
		if($i%5==0)	{
			$pdf->Cell($kolom,$baris,$tampil['nrp'],0,1,'L');
		}
		else	{
			$pdf->Cell($kolom/5,$baris,$tampil['nrp'],0,0,'L');
		}
  }
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
  $pdf->Cell($kolom,$baris,'Angkatan Tua = '.$i,0,1,'L');
  $pdf->Cell($kolom,$baris,' ',0,1,'L');
}
else	{
	$pdf->Cell($kolom/5,$baris,"-",0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}


$i=0;
$pdf->SetFont('Arial','B',12);
$pdf->Cell($kolom,$baris,'Lainnya :',0,1,'L');
$pdf->SetFont('Arial','',12);
if(count($lainnya)>0 && $lainnya)	{
  	foreach($lainnya as $tampil) 	{
		$i++;
		if($i%5==0)	{
			$pdf->Cell($kolom,$baris,$tampil['nrp'],0,1,'L');
		}
		else	{
			$pdf->Cell($kolom/5,$baris,$tampil['nrp'],0,0,'L');
		}
  	}
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
	$pdf->Cell($kolom,$baris,'Jumlah Lainnya = '.$i,0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}
else	{
	$pdf->Cell($kolom/5,$baris,"-",0,1,'L');
	$pdf->Cell($kolom,$baris,' ',0,1,'L');
}
$pdf->Cell($kolom,$baris,' ',0,1,'C');
$pdf->Cell($kolom,$baris,'---------------------------------------------------------------------------------------------------------',0,1,'C');

$pdf->Output();
?>

