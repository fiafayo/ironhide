<?
	function getPeriodeFpp()	{
		createConnection();
		$sql = "SELECT DISTINCT semester, tahun FROM tk_fpp";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function selectTerimaMhs($semester,$tahun,$kode_kls)	{
		createConnection();
		$sql = "SELECT DK.nrp FROM tk_daftar_kls DK, tk_fpp FPP 
				WHERE DK.kode_fpp=FPP.kode_fpp AND DK.kode_kelas='$kode_kls' 
					  AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND DK.status='1'
				ORDER BY DK.nrp DESC";
		$result = getQueryResult($sql);
		return $result;
	}
	
?>