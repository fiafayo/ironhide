<?
	function selectDropMkJur($kode_mk,$kodeJur)	{
		createConnection();
		$sql = "SELECT kode_mk FROM tk_mk_jur WHERE kode_mk!='$kode_mk' AND kode_jur='$kodeJur'";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectMkPrasyarat($kode_mk)	{
		createConnection();
		$sql = "SELECT * FROM tk_mk_prasyarat WHERE kode_mk ='$kode_mk'";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectMkPrasyaratJur($kode_mk,$kode_jur)	{
		createConnection();
		if($kode_jur!="")	{
			$addSql = " AND kode_jur = '$kode_jur' ";
		}
		$sql = "SELECT * FROM tk_mk_prasyarat WHERE kode_mk ='$kode_mk' ".$addSql;
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getMkPrasyaratJur($kode_mk,$kode_jur)	{
		createConnection();
		if($kode_jur!="")	{
			$addSql = " AND kode_jur = '$kode_jur' ";
		}
		$sql = "SELECT * FROM tk_mk_prasyarat WHERE kode_mk ='$kode_mk' ".$addSql;
		$result = getCountQueryResult($sql);
		return($result);
	}
	
	function selectAllPrasyarat($page)	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT * FROM tk_mk_prasyarat LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectPageAllPrasyarat()	{
		createConnection();
		$sql = "SELECT * FROM tk_mk_prasyarat";
		$result = getCountQueryResult($sql);
		return($result);
	}
	
	function insertPrasyarat($kode_mk,$mk_prasyarat,$kode_jur,$nilai_min,$status)	{
		createConnection();
		$sql = "INSERT INTO tk_mk_prasyarat(kode_mk,mk_prasyarat,kode_jur,nilai_min,status) 
				VALUES('$kode_mk','$mk_prasyarat','$kode_jur','$nilai_min','$status')";
		$result = createQuery($sql);
		return $result;
	}
	
	function deletePrasyarat($kode_mk,$mk_prasyarat,$kode_jur)	{
		createConnection();
		$sql = "DELETE FROM tk_mk_prasyarat WHERE kode_mk='$kode_mk' AND mk_prasyarat='$mk_prasyarat' AND kode_jur = '$kode_jur'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicatePrasyarat($kode_mk,$mk_prasyarat,$kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_mk_prasyarat WHERE kode_mk = '$kode_mk' AND mk_prasyarat = '$mk_prasyarat' AND kode_jur = '$kode_jur'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
?>