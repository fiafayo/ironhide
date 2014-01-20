<?

	function getDetailMk($kode_mk)	{
		createConnection();
		$sql = "SELECT * FROM tk_master_mk WHERE kode_mk='$kode_mk'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	function selectMkAktif()	{
		createConnection();
		$sql = "SELECT DISTINCT MK.* FROM tk_master_mk MK, tk_kelas_mk KM WHERE KM.kode_mk = MK.kode_mk AND KM.status_buka='1'";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectMk($page,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " WHERE kode_mk LIKE '%$cari%' OR nama LIKE '%$cari%' ";
		}
		$sql = "SELECT * FROM tk_master_mk ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getPagingMk($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}
	
	function getPageMk($cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " WHERE kode_mk LIKE '%$cari%' OR nama LIKE '%$cari%' ";
		}
		$sql = "SELECT * FROM tk_master_mk".$addSql." ORDER BY kode_mk LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountMk($cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " WHERE kode_mk LIKE '%$cari%' OR nama LIKE '%$cari%' ";
		}
		$sql = "SELECT * FROM tk_master_mk".$addSql." ORDER BY kode_mk ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function selectMkDrop()	{
		createConnection();
		$sql = "SELECT * FROM tk_master_mk ";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectManageMkDrop($kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_master_mk MM WHERE MM.kode_mk NOT IN (SELECT kode_mk FROM tk_mk_jur WHERE kode_jur='$kode_jur')";
		$result = getQueryResult($sql);
		return($result);
	}
	
	//BUAT PENYUSUNAN JADWAL JANGAN DIUBAH
	function selectMkJurDrop($kode_jur)	{
		createConnection();
		if($kode_jur=='MKU')	{
			$sql = "SELECT * 
					FROM tk_master_mk
					WHERE MID(kode_mk,1,2)='00'";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT * 
					FROM tk_master_mk
					WHERE MID(kode_mk,1,2)='60'";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT * 
					FROM tk_master_mk";
		}
		else	{
			//$sql = "SELECT * FROM tk_mk_jur WHERE kode_jur='$kode_jur' AND MID(kode_mk,1,2)!='60' AND MID(kode_mk,1,2)!='00'";
			$sql = "SELECT * FROM tk_mk_jur WHERE kode_jur='$kode_jur' AND MID(kode_mk,1,2)=MID(kode_jur,1,2)";
		}
		$result = getQueryResult($sql);
		return($result);
	}
	
	function selectMkJurAktifDrop($kode_jur)	{
		createConnection();
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT MK.kode_mk
					FROM tk_master_mk MK, tk_kelas_mk KM
					WHERE KM.kode_mk = MK.kode_mk AND KM.status_buka='1' AND MID(MK.kode_mk,1,2)='00'";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT MK.kode_mk
					FROM tk_master_mk MK, tk_kelas_mk KM
					WHERE KM.kode_mk = MK.kode_mk AND KM.status_buka='1' AND MID(MK.kode_mk,1,2)='60' ";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT MK.kode_mk
					FROM tk_master_mk MK, tk_kelas_mk KM
					WHERE KM.kode_mk = MK.kode_mk AND KM.status_buka='1' ";
		}
		else	{
			$sql = "SELECT DISTINCT MK.kode_mk
					FROM tk_master_mk MK, tk_kelas_mk KM, tk_mk_jur MJ 
					WHERE MJ.kode_mk=MK.kode_mk AND KM.kode_mk = MK.kode_mk AND KM.status_buka='1' AND MJ.kode_jur='$kode_jur'
						  AND MID(MK.kode_mk,1,2)!='60' AND MID(MK.kode_mk,1,2)!='00'";
		}
		$result = getQueryResult($sql);
		return($result);
	}
	
	
	
	function insertMk($kode_mk,$nama,$sks)	{
		createConnection();
		$sql = "INSERT INTO tk_master_mk(kode_mk,nama,sks) VALUES('$kode_mk','$nama',$sks)";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteMk($kode_mk)	{
		createConnection();
		$sql = "DELETE FROM tk_master_mk WHERE kode_mk ='$kode_mk'";
		$result = createQuery($sql);
		
		$sql = "DELETE FROM tk_mk_jur WHERE kode_mk ='$kode_mk'";
		$result = createQuery($sql);
		
		$sql = "DELETE FROM tk_mk_prasyarat WHERE kode_mk ='$kode_mk' OR mk_prasyarat='$kode_mk'";
		$result = createQuery($sql);
		return $result;
	}
	
	function editMk($kode_mk,$nama,$sks)	{
		createConnection();
		$sql = "UPDATE tk_master_mk SET nama='$nama', sks=$sks WHERE kode_mk='$kode_mk'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkUsedMk($kode_mk)	{
		createConnection();
		$sql = "SELECT kode_mk FROM tk_transkrip WHERE kode_mk ='$kode_mk'";
		$result = getCountQueryResult($sql);
		if($result > 0)	{
			return false;
		}
		else	{ 
			$sql = "SELECT kode_mk FROM tk_kelas_mk WHERE kode_mk='$kode_mk'";
			$result = getCountQueryResult($sql);
			if($result > 0)	{
				return false;
			}
			else	{
				return true;
			}
		}
	}
	
	function checkDuplicateMk($kode)	{
		createConnection();
		$sql = "SELECT * FROM tk_master_mk WHERE kode_mk='$kode'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	//BUAT MK YANG DIAKUI JURUSAN
	function insertMkJur($kode_mk,$kode_jur,$jenis,$status,$semester,$sks_min,$kurikulum)	{
		createConnection();
		$sql = "INSERT INTO tk_mk_jur(kode_jur,kode_mk,jenis,status_bebas,semester,sks_min,kurikulum) 
				VALUES('$kode_jur','$kode_mk','$jenis','$status',$semester,$sks_min,'$kurikulum')";
		$result = createQuery($sql);
		return $result;
	}
	
	function editMkJur($kode_mk,$kode_jur,$jenis,$status,$semester,$sks_min,$kurikulum)	{
		createConnection();
		$sql = "UPDATE tk_mk_jur SET jenis='$jenis',status_bebas='$status',semester=$semester,sks_min=$sks_min,kurikulum='$kurikulum'
				WHERE kode_jur='$kode_jur' AND kode_mk='$kode_mk'";
		$result = createQuery($sql);
		return $result;
	}
	
	function detailMkJur($kode_mk,$kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_mk_jur WHERE kode_mk='$kode_mk' AND kode_jur='$kode_jur'";
		$result = getQueryResult($sql);
		return $result[0];
	}
	
	function deleteMkJur($kode_mk,$kode_jur)	{
		createConnection();
		$sql = "DELETE FROM tk_mk_jur WHERE kode_mk ='$kode_mk' AND kode_jur='$kode_jur'";
		$result = createQuery($sql);
		
		$sql = "DELETE FROM tk_mk_prasyarat WHERE kode_mk ='$kode_mk' AND kode_jur='$kode_jur'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateMkJur($kode_mk,$kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_mk_jur WHERE kode_mk='$kode_mk' AND kode_jur='$kode_jur'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkUsedMkJur($kode_mk)	{
		createConnection();
		$sql = "SELECT * FROM tk_kelas_mk WHERE kode_mk='$kode_mk' AND status='1'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	
	function selectMkJur($kode_jur,$page,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_mk_jur MJ, tk_master_mk MK WHERE MK.kode_mk=MJ.kode_mk AND MJ.kode_jur ='$kode_jur' ".$addSql."  ORDER BY semester LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	
	function getPageMkJur($kode_jur,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_mk_jur MJ, tk_master_mk MK WHERE MK.kode_mk=MJ.kode_mk AND MJ.kode_jur ='$kode_jur'".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountMkJur($kode_jur,$cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT * FROM tk_mk_jur MJ, tk_master_mk MK WHERE MK.kode_mk=MJ.kode_mk AND MJ.kode_jur ='$kode_jur'".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	
	function getStatusBukaMkJur($kode_jur,$kode_mk)	{
		createConnection();
		$sql = "SELECT DISTINCT KLS.kode_kelas 
				FROM tk_mk_jur MJ, tk_master_mk MK, tk_kelas_mk KLS 
				WHERE MJ.kode_jur ='$kode_jur' AND MK.kode_mk='$kode_mk' AND MK.kode_mk=MK.kode_mk AND MK.kode_mk=KLS.kode_mk
				ORDER BY MJ.semester";
		$result = getCountQueryResult($sql);
		return($result);
	}
	
	function selectKpMk($kode_mk)	{
		createConnection();
		$sql = "SELECT KLS.kode_kelas,KLS.kp,KLS.kapasitas FROM tk_master_mk MK, tk_kelas_mk KLS WHERE MK.kode_mk = KLS.kode_mk AND MK.kode_mk='$kode_mk' AND KLS.status_buka='1'";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function getCheckJurMk($kode_mk)	{
		createConnection();
		$sql = "SELECT TJ.kode_jur,TJ.nama FROM tk_mk_jur MJ, tk_jurusan TJ WHERE MJ.kode_jur=TJ.kode_jur AND MJ.kode_mk ='$kode_mk'";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getDetailMkJur($kode_mk,$jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_mk_jur MJ WHERE MJ.kode_jur='$jur' AND MJ.kode_mk ='$kode_mk'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	function selectMkJurAktif($kode_jur,$page,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT MJ.semester, MK.nama, MK.kode_mk FROM tk_mk_jur MJ, tk_master_mk MK, tk_kelas_mk KLS 
				WHERE KLS.kode_mk = MK.kode_mk AND KLS.status_buka = '1' 
					  AND MK.kode_mk=MJ.kode_mk AND MJ.kode_jur ='$kode_jur' ".$addSql."  ORDER BY MJ.semester LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}
	
	
	function getPageMkJurAktif($kode_jur,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT MJ.semester, MK.nama, MK.kode_mk FROM tk_mk_jur MJ, tk_master_mk MK , tk_kelas_mk KLS 
				WHERE KLS.kode_mk = MK.kode_mk AND KLS.status_buka = '1' 
					  AND MK.kode_mk=MJ.kode_mk AND MJ.kode_jur ='$kode_jur'".$addSql." ORDER BY MJ.semester LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountMkJurAktif($kode_jur,$cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT MJ.semester, MK.nama, MK.kode_mk FROM tk_mk_jur MJ, tk_master_mk MK , tk_kelas_mk KLS 
				WHERE KLS.kode_mk = MK.kode_mk AND KLS.status_buka = '1' 
					  AND MK.kode_mk=MJ.kode_mk AND MJ.kode_jur ='$kode_jur'".$addSql." ORDER BY MJ.semester ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
?>