<?
	function selectRuang($page,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " WHERE (kode_ruang LIKE '%$cari%' OR kapasitas=$cari) ";
		}
		$sql = "SELECT * FROM tk_ruang ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function getPagingRuang($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}
	
	function getPageRuang($cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " WHERE (kode_ruang LIKE '%$cari%' OR kapasitas = $cari) ";
		}
		$sql = "SELECT * FROM tk_ruang".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountRuang($cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " WHERE (kode_ruang LIKE '%$cari%' OR kapasitas = $cari) ";
		}
		$sql = "SELECT * FROM tk_ruang".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function selectDropRuang()	{
		createConnection();
		$sql = "SELECT * FROM tk_ruang";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function getDetailRuang($kode_ruang)	{
		createConnection();
		$sql = "SELECT * FROM tk_ruang WHERE kode_ruang ='$kode_ruang'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	
	
	function insertRuang($kode_ruang,$jenis,$kapasitas)	{
		createConnection();
		$sql = "INSERT INTO tk_ruang(kode_ruang,jenis,kapasitas) VALUES('$kode_ruang','$jenis',$kapasitas)";
		$result = createQuery($sql);
		return $result;
	}
	
	function editRuang($kode_ruang,$jenis,$kapasitas)	{
		createConnection();
		$sql = "UPDATE tk_ruang SET jenis='$jenis', kapasitas=$kapasitas WHERE kode_ruang='$kode_ruang'";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteRuang($kode_ruang)	{
		createConnection();
		$sql = "DELETE FROM tk_ruang WHERE kode_ruang ='$kode_ruang'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateRuang($kode_ruang)	{
		createConnection();
		$sql = "SELECT * FROM tk_ruang WHERE kode_ruang='$kode_ruang'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkUsedRuang($kode_ruang)	{
		createConnection();
		$sql = "SELECT * FROM tk_jadwal_kul WHERE kode_ruang='$kode_ruang'";
		$result = getCountQueryResult($sql);
		return $result;
	}
?>