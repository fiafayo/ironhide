<?
	
	function selectUjian($semester,$tahun,$page)	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk 
				FROM tk_jadwal_ujian JU , tk_kelas_mk KM
				WHERE JU.kode_mk = KM.kode_mk AND JU.semester='$semester' AND JU.tahun='$tahun' 
				ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $page,$display ";
		$result = getQueryResult($sql);
		return $result;
	}
	
	
	
	function getPageUjian($semester,$tahun)	{
		createConnection();
		$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk 
				FROM tk_jadwal_ujian JU , tk_kelas_mk KM
				WHERE JU.kode_mk = KM.kode_mk AND JU.semester='$semester' AND JU.tahun='$tahun' 
				ORDER BY  JU.minggu, JU.hari, JU.jam";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	
	
	function selectUjianJur($kode_jur,$page,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(KM.kode_mk,1,2)='00' ".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $page,$display ";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(KM.kode_mk,1,2)='60'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $page,$display ";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  ".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $page,$display ";
		}
		else	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk, MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_mk_jur MJ, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND MJ.kode_mk=KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(MJ.kode_mk,1,2)!='60' AND MID(MJ.kode_mk,1,2)!='00' AND MJ.kode_jur='$kode_jur'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $page,$display ";
		}
		$result = getQueryResult($sql);
		return $result;
	}
	
	function getPagingUjian($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}
	
	
	function getPageUjianJur($kode_jur,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(KM.kode_mk,1,2)='00'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $awal,$paging";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(KM.kode_mk,1,2)='60'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $awal,$paging";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  ".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $awal,$paging";
		}
		else	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk, MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_mk_jur MJ, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND MJ.kode_mk=KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(MJ.kode_mk,1,2)!='60' AND MID(MJ.kode_mk,1,2)!='00' AND MJ.kode_jur='$kode_jur'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam LIMIT $awal,$paging";
		}
		
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}
	
	function getPageCountUjianJur($kode_jur,$cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(KM.kode_mk,1,2)='00'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(KM.kode_mk,1,2)='60'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam ";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk , MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  ".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam";
		}
		else	{
			$sql = "SELECT DISTINCT JU.kode_ujian, JU.hari, JU.jam, JU.minggu, JU.jam, JU.semester, JU.tahun , KM.kode_mk, MK.nama
					FROM tk_jadwal_ujian JU , tk_kelas_mk KM, tk_mk_jur MJ, tk_master_mk MK
					WHERE MK.kode_mk = KM.kode_mk AND MJ.kode_mk=KM.kode_mk AND JU.kode_mk = KM.kode_mk AND JU.semester='".getSemester()."' AND JU.tahun='".getTahunAjaran()."' 
						  AND MID(MJ.kode_mk,1,2)!='60' AND MID(MJ.kode_mk,1,2)!='00' AND MJ.kode_jur='$kode_jur'".$addSql."
					ORDER BY  JU.minggu, JU.hari, JU.jam";
		}
		
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}
	
	function getDetailUjianKls($kode_kelas)	{
		createConnection();
		$sql = "SELECT JU.* FROM tk_jadwal_ujian JU, tk_kelas_mk KLS WHERE KLS.kode_mk = JU.kode_mk AND KLS.semester = JU.semester 
				AND JU.tahun=KLS.tahun AND KLS.kode_kelas = '$kode_kelas'";
		$result = getQueryResult($sql);
		return $result[0];
	}
	
	function getDetailUjian($kode_ujian)	{
		createConnection();
		$sql = "SELECT * FROM tk_jadwal_ujian WHERE kode_ujian='$kode_ujian'";
		$result = getQueryResult($sql);
		return $result[0];
	}
	
	//UNTUK DITAMPILKAN DI TABEL YANG SUDAH DISET
	function displayUjian($jurusan,$jam,$hari,$minggu,$semester,$tahun)	{
		createConnection();
		if($jurusan=='MKU')	{
			$sql = "SELECT DISTINCT KM.kode_mk 
					FROM tk_jadwal_ujian JU, tk_kelas_mk KM 
					WHERE JU.kode_mk = KM.kode_mk AND MID(KM.kode_mk,1,2)='00'
						  AND JU.jam = $jam AND JU.hari=$hari AND JU.minggu=$minggu AND JU.semester='$semester' AND JU.tahun='$tahun'";
						  
		}
		else if($jurusan=='MIPA')	{
			$sql = "SELECT DISTINCT KM.kode_mk 
					FROM tk_jadwal_ujian JU, tk_kelas_mk KM 
					WHERE JU.kode_mk = KM.kode_mk AND MID(KM.kode_mk,1,2)='60'
						  AND JU.jam = $jam AND JU.hari=$hari AND JU.minggu=$minggu AND JU.semester='$semester' AND JU.tahun='$tahun'";
						  
		}
		else if($jurusan=='ALL')	{
			$sql = "SELECT DISTINCT KM.kode_mk 
					FROM tk_jadwal_ujian JU, tk_kelas_mk KM 
					WHERE JU.kode_mk = KM.kode_mk 
						  AND JU.jam = $jam AND JU.hari=$hari AND JU.minggu=$minggu AND JU.semester='$semester' AND JU.tahun='$tahun'";
						  
		}
		else	{
			$sql = "SELECT DISTINCT KM.kode_mk 
					FROM tk_jadwal_ujian JU, tk_kls_jur KJ , tk_kelas_mk KM , tk_master_mk  MK
					WHERE MK.kode_mk=KM.kode_mk AND JU.kode_mk = KM.kode_mk AND KM.kode_kelas = KJ.kode_kelas AND KJ.kode_jur = '$jurusan'
						  AND JU.jam = $jam AND JU.hari=$hari AND JU.minggu=$minggu AND JU.semester='$semester' AND JU.tahun='$tahun'";
		}
		$result = getQueryResult($sql);
		return $result;
			
	}
	
	function insertUjian($kode_mk,$hari,$jam,$minggu,$semester,$tahun)	{
		createConnection();
		$kode_ujian = generateKodeUjian($kode_mk,$semester,$tahun);
		$sql = "INSERT INTO tk_jadwal_ujian(kode_ujian,kode_mk,hari,jam,minggu,semester,tahun) 
				VALUES('$kode_ujian','$kode_mk',$hari,$jam,$minggu,'$semester','$tahun')";
		$result = createQuery($sql);
		return $result;
	}
	
	function editUjian($kode_ujian,$kode_mk,$jam,$hari,$minggu,$semester,$tahun)	{
		createConnection();
		$sql = "UPDATE tk_jadwal_ujian SET hari=$hari, jam=$jam, minggu=$minggu, semester='$semester', tahun='$tahun' 
				WHERE kode_ujian = '$kode_ujian' AND kode_mk='$kode_mk'";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteUjian($kode_ujian)	{
		createConnection();
		$sql = "DELETE FROM tk_jadwal_ujian WHERE kode_ujian ='$kode_ujian'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateUjian($kode_mk,$semester,$tahun)	{
		createConnection();
		$kode = generateKodeUjian($kode_mk,$semester,$tahun);
		$sql = "SELECT * FROM tk_jadwal_ujian WHERE kode_ujian='$kode'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkUsedUjian($kode_mk,$semester,$tahun)	{
		createConnection();
		$sql = "SELECT KLS.kode_mk 
				FROM tk_daftar_kls DK, tk_kelas_mk KLS  
				WHERE DK.kode_kelas = KLS.kode_kelas AND KLS.kode_mk='$kode_mk' AND KLS.semester='$semester' AND KLS.tahun='$tahun'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function generateKodeUjian($kodeMk,$sem,$tahun)	{
		$tahunAjaran = getTahunAjaran();
		if($tahun!=$tahunAjaran) {
			$tahunAjaran = $tahun;
		}
		$semester = getSemester();
		if($sem==$semester)	{
			$semester = $sem;
		}
		$kodeBaru = "JU".$kodeMk.substr($tahunAjaran,2,2).substr($semester,0,2);
		return $kodeBaru;
	}
	
	function getTotalKap($kode_mk)	{
		createConnection();
		$sql = "SELECT SUM(kapasitas) AS total_kap FROM tk_kelas_mk WHERE kode_mk='$kode_mk'";
		$result = getQueryResult($sql);
		return $result[0]['total_kap'];
	}
?>