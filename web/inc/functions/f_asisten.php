<?
	function selectAsisten($cari,$page)
	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{	
			$addSql = " AND (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_mhs WHERE asisten='1' ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function getPageAsisten($cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{	
			$addSql = " AND (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_mhs WHERE asisten='1'".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountAsisten($cari)	{
		createConnection();
		if($cari!="")	{	
			$addSql = " AND (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_mhs WHERE asisten='1'".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function deleteAsisten($nrp)
	{
		createConnection();
		$sql = "UPDATE tk_mhs SET asisten='0' WHERE nrp=$nrp";
		$result = createQuery($sql);
		return $result;
	}
	
	function assignAsisten($nrp)
	{
		createConnection();
		$sql = "UPDATE tk_mhs SET asisten='1' WHERE nrp=$nrp";
		$result = createQuery($sql);
		return $result;
	}
	
?>