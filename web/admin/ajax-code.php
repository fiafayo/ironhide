<?
	include('../inc/functions/connectdb.php');
	include('../inc/functions/f_mk.php');
	include('../inc/functions/f_kls_mk.php');
	include('../inc/functions/f_dosen.php');
	
	if($_GET['kodeMk'])	{
		$nama = getDetailMk($_GET['kodeMk']);
		echo $nama['nama'];
	}
	
	if($_GET['semMk'] && $_GET['jur'])	{
		$sem = getDetailMkJur($_GET['semMk'],$_GET['jur']);
		echo $sem['semester'];
	}
	
	if($_GET['kodeKls'])	{
		$kelas = getDetailKlsMk($_GET['kodeKls']);
		echo $kelas['kapasitas']-$kelas['isi'];
	}

	if($_GET['kodeDos'])	{
		$dosen = getDetailDosen($_GET['kodeDos']);
		echo $dosen['nama'];
	}	
	
	if(($_GET['jur']) && ($_GET['kode']))	{
		$jur = getCheckJurMk($_GET['kode']);
		foreach($jur as $tampil)
		{
			if($tampil['kode_jur']==$_GET['jur'])	{
				echo "<input type='checkbox' value='".$tampil['kode_jur']."' name='chkJurusan".$tampil['kode_jur']."' checked>".$tampil['nama']."<br>";
			}
			else	{
				echo "<input type='checkbox' value='".$tampil['kode_jur']."' name='chkJurusan".$tampil['kode_jur']."'>".$tampil['nama']."<br>";
			}
		}
	}
?>