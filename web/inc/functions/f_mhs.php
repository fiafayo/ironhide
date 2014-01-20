<?
	function selectAllMhs()
	{
		createConnection();
		$sql = "SELECT * FROM tk_mhs ";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectAllPesertaFpp($jurusan)
	{
		createConnection();
		$sql = "SELECT DISTINCT DK.nrp FROM tk_mhs MHS, tk_daftar_kls DK WHERE DK.nrp=MHS.nrp AND MHS.jurusan='$jurusan' AND DK.status='1' ORDER BY DK.nrp ASC";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function editJurMhs($kode_jur,$nrp)	
	{
		createConnection();
		$sql = "UPDATE tk_mhs SET jurusan = '$kode_jur' WHERE nrp='$nrp'";
		$result = createQuery($sql);
		return($result);
	}
	
	function editStatusMhs($nrp,$statusBaru)	
	{
		createConnection();
		$sql = "UPDATE tk_mhs SET status = '$statusBaru' WHERE nrp='$nrp'";
		$result = createQuery($sql);
		return($result);
	}
	
	function getDetailMhs($nrp)
	{
		createConnection();
		$sql = "SELECT * FROM tk_mhs WHERE nrp='$nrp'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	function getTranskrip($nrp,$cari,$page)
	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_transkrip TT, tk_master_mk MK 
				WHERE MK.kode_mk=TT.kode_mk AND TT.nrp='$nrp' ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	
	
	function getPageTranskrip($nrp,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_transkrip TT, tk_master_mk MK 
				WHERE MK.kode_mk=TT.kode_mk AND TT.nrp='$nrp' ".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountTranskrip($nrp,$cari)	{
		createConnection();
		
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_transkrip TT, tk_master_mk MK 
				WHERE MK.kode_mk=TT.kode_mk AND TT.nrp='$nrp' ".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function getTranskripAsli($nrp,$cari,$page)
	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_transkrip_asli TT, tk_master_mk MK 
				WHERE MK.kode_mk=TT.kode_mk AND TT.nrp='$nrp' ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getPageTranskripAsli($nrp,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_transkrip_asli TT, tk_master_mk MK 
				WHERE MK.kode_mk=TT.kode_mk AND TT.nrp='$nrp' ".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountTranskripAsli($nrp,$cari)	{
		createConnection();
		
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_transkrip_asli TT, tk_master_mk MK 
				WHERE MK.kode_mk=TT.kode_mk AND TT.nrp='$nrp' ".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function searchMhs($cari,$cjur,$cang,$page)	{
		createConnection();
		$display = LM_DISPLAY;
		
		if($cari!="")
		{	
			$addSql = " WHERE (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		if($cjur!="")
		{	
			if($cari!="")	{
				$addSql = $addSql." AND jurusan = '$cjur' ";
			}
			else	{
				$addSql = " WHERE jurusan = '$cjur' ";
			}
		}
		if($cang!="")
		{	
			if($cari!="" || $cjur!="")	{
				$addSql = $addSql." AND MID(nrp,2,2) = MID('$cang',3,2)";
			}
			else	{
				$addSql = " WHERE MID(nrp,2,2) = MID('$cang',3,2) ";
			}
		}
		$sql = "SELECT * FROM tk_mhs ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getPagingMhs($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}

	function getPageSearchMhs($cari,$cjur,$cang,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		
		if($cari!="")
		{	
			$addSql = " WHERE (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		if($cjur!="")
		{	
			if($cari!="")	{
				$addSql = $addSql." AND jurusan = '$cjur' ";
			}
			else	{
				$addSql = " WHERE jurusan = '$cjur' ";
			}
		}
		if($cang!="")
		{	
			if($cari!="" || $cjur!="")	{
				$addSql = $addSql." AND MID(nrp,2,2) = MID('$cang',3,2)";
			}
			else	{
				$addSql = " WHERE MID(nrp,2,2) = MID('$cang',3,2) ";
			}
		}
		$sql = "SELECT * FROM tk_mhs ".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountMhs($cari,$cjur,$cang)	{
		createConnection();
		if($cari!="")
		{	
			$addSql = " WHERE (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		if($cjur!="")
		{	
			if($cari!="")	{
				$addSql = $addSql." AND jurusan = '$cjur' ";
			}
			else	{
				$addSql = " WHERE jurusan = '$cjur' ";
			}
		}
		if($cang!="")
		{	
			if($cari!="" || $cjur!="")	{
				$addSql = $addSql." AND MID(nrp,2,2) = MID('$cang',3,2)";
			}
			else	{
				$addSql = " WHERE MID(nrp,2,2) = MID('$cang',3,2) ";
			}
		}
		$sql = "SELECT * FROM tk_mhs ".$addSql;
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	
	
	function searchMhsMinat($cari,$cjur,$cang,$page,$kode_jur)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")
		{	
			$addSql = " AND (nrp LIKE '%$cari%' OR nama LIKE '%$cari%')";
		}
		if($cjur!="")
		{	
			$addSql =  $addSql." AND jurusan = '$cjur' ";
		}
		if($cang!="")
		{	
			$addSql =  $addSql." AND  MID(nrp,2,2) = MID('$cang',3,2)";
		}
		$sql = "SELECT * FROM tk_mhs  WHERE  MID(jurusan,1,2)=MID('$kode_jur',1,2) ".$addSql."LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getPageSearchMhsMinat($cari,$cjur,$cang,$page,$kode_jur)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")
		{	
			$addSql = " AND (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		if($cjur!="")
		{	
			$addSql = $addSql." AND jurusan = '$cjur' ";
		}
		if($cang!="")
		{	
			$addSql = $addSql." AND  MID(nrp,2,2) = MID('$cang',3,2)";
		}
		$sql = "SELECT * FROM tk_mhs WHERE MID(jurusan,1,2)=MID('$kode_jur',1,2) ".$addSql."  LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountMhsMinat($cari,$cjur,$cang,$kode_jur)	{
		createConnection();
		if($cari!="")
		{	
			$addSql = " AND (nrp LIKE '%$cari%' OR nama LIKE '%$cari%') ";
		}
		if($cjur!="")
		{	
			$addSql = $addSql." AND jurusan = '$cjur' ";
		}
		if($cang!="")
		{	
			$addSql = $addSql." AND  MID(nrp,2,2) = MID('$cang',3,2)";
		}
		$sql = "SELECT * FROM tk_mhs WHERE MID(jurusan,1,2)=MID('$kode_jur',1,2) ".$addSql;
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function getJurusanMhs($nrp)	{
		createConnection();
		$kode_jur = getDetailMhs($nrp);
		return($kode_jur['jurusan']);
	}
	
	function getSemesterMhs($nrp)	{
		createConnection();
		$tahun = substr($nrp,1,2);
		if($tahun <= 50)	{
			$tahun = '20'.$tahun;
		}
		else	{
			$tahun = '19'.$tahun;
		}
		$semester =  date('Y')-$tahun;
		$semester *= 2;
		if(getSemester()=='GASAL')	{
			$semester++;
		}
		return $semester;
	}
	
	function getAngkatanMhs($nrp)	{
		createConnection();
		$tahun = substr($nrp,1,2);
		if($tahun <= 50)	{
			$tahun = '20'.$tahun;
		}
		else	{
			$tahun = '19'.$tahun;
		}
		return $tahun;
	}
	
	function getSksTerpakaiMhs($nrp,$semester,$tahun)	{
		createConnection();
		$jurusan = getJurusanMhs($nrp);
		$sql = "SELECT SUM(MK.sks) as total
				FROM tk_daftar_kls DK, tk_fpp FPP , tk_kelas_mk KLS, tk_master_mk MK, tk_mk_jur MJ
				WHERE KLS.kode_kelas=DK.kode_kelas AND KLS.kode_mk=MK.kode_mk AND MJ.kode_mk = MK.kode_mk AND MJ.kode_jur  = '$jurusan' AND
					  DK.kode_fpp=FPP.kode_fpp AND nrp='$nrp' AND DK.status='1' AND MJ.status_bebas='0'
					  AND FPP.semester='$semester' AND FPP.tahun='$tahun'
				GROUP BY DK.nrp";
		$terpakai = getQueryResult($sql);
		return $terpakai[0]['total'];
	}
?>