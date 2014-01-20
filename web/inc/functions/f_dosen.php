<?
	function selectAllDosen()	{
		createConnection();
		$sql = "SELECT * FROM tk_dosen";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectDosen($page,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " WHERE (kode_dosen LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_dosen ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getPagingDosen($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}
	
	function getPageDosen($cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " WHERE (kode_dosen LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_dosen ".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountDosen($cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " WHERE (kode_dosen LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_dosen ".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function getDetailDosen($kode_dosen)	{
		createConnection();
		$sql = "SELECT * FROM tk_dosen WHERE kode_dosen='$kode_dosen'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	function insertDosen($kode_dosen,$nama,$status)	{
		createConnection();
		$sql = "INSERT INTO tk_dosen(kode_dosen,nama,status) 
				VALUES('$kode_dosen','$nama','$status')";
		$result = createQuery($sql);
		return $result;
	}
	
	function editDosen($kode_dosen,$nama,$status)	{
		createConnection();
		$sql = "UPDATE tk_dosen SET nama='$nama', status='$status' WHERE kode_dosen='$kode_dosen'";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteDosen($kode_dosen)	{
		createConnection();
		$sql = "DELETE FROM tk_dosen WHERE kode_dosen ='$kode_dosen'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateDosen($kode_dosen)	{
		createConnection();
		$sql = "SELECT * FROM tk_dosen WHERE kode_dosen='$kode_dosen'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkUsedDosen($kode_dosen)	{
		createConnection();
		$sql = "SELECT * FROM tk_dsn_kls WHERE kode_dosen='$kode_dosen'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
?>