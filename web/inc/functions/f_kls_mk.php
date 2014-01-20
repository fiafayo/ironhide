<?
	function getSemester()	{
		$bulan = date('m');
		//if($bulan>=2 && $bulan<7)
                //
                if( $bulan<7) {
			return "GENAP";
		}
		else  	{
			return "GASAL";
		}
	}

	function getTahunAjaran()	{
		$bulan = date('m');
		$tahun = date('Y');
		if($bulan < 7)	{
			return ($tahun-1)."-".$tahun;
		}
		else {
			return $tahun."-".($tahun+1);
		}
	}

	function generateKodeKelas($kodeMk,$kp,$sem,$tahun)	{
		$tahunAjaran = getTahunAjaran();
		if($tahun!=$tahunAjaran) {
			$tahunAjaran = $tahun;
		}
		$semester = getSemester();
		if($sem==$semester)	{
			$semester = $sem;
		}
		$kodeBaru = $kodeMk.$kp.substr($tahunAjaran,2,2).substr($semester,0,2);
		return $kodeBaru;
	}

	function selectAllKlsMk()	{
		createConnection();
		$sql = "SELECT * FROM tk_kelas_mk ORDER BY kode_kelas";
		$result = getQueryResult($sql);
		return($result);
	}

	function selectKlsMk($page)	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT * FROM tk_kelas_mk LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}

	function getPageKlsMk()	{
		createConnection();
		$sql = "SELECT * FROM tk_kelas_mk";
		$result = getCountQueryResult($sql);
		return($result);
	}

	//UNTUK MENGAMBIL MATA KULIAH YANG DIAKUI JURUSAN
	function selectKlsJur($page,$kode_jur,$cari)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (KLS.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND MID(KLS.kode_mk,1,2)='00' ".$addSql."
					ORDER BY KLS.kode_mk  ASC
					LIMIT $page,$display";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND MID(KLS.kode_mk,1,2)='60' ".$addSql."
					ORDER BY KLS.kode_mk  ASC
					LIMIT $page,$display";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas ".$addSql."
					ORDER BY KLS.kode_mk  ASC
					LIMIT $page,$display";
		}
		else	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp,MK.nama, KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND KJ.kode_jur='$kode_jur'  ".$addSql."
				  	ORDER BY KLS.kode_mk  ASC
					LIMIT $page,$display";
		}
                 
		$result = getQueryResult($sql);
		return($result);
	}

	function getPagingKls($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}

	function getPageKlsJur($kode_jur,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (KLS.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND MID(KLS.kode_mk,1,2)='00'".$addSql;
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND MID(KLS.kode_mk,1,2)='60' ".$addSql;
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas ".$addSql;
		}
		else	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp,MK.nama, KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND KJ.kode_jur='$kode_jur' AND MID(KLS.kode_mk,1,2)!='60'
						  AND MID(KLS.kode_mk,1,2)!='00'".$addSql;
		}
		$sql =$sql." ORDER BY KLS.kode_mk ASC LIMIT $awal,$paging";

		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}

	function getPageCountKlsJur($kode_jur,$cari)	{
		createConnection();

		if($cari!="")	{
			$addSql = " AND (KLS.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND MID(KLS.kode_mk,1,2)='00'".$addSql;
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND MID(KLS.kode_mk,1,2)='60' ".$addSql;
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp ,MK.nama , KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas ".$addSql;
		}
		else	{
			$sql = "SELECT DISTINCT KLS.kode_mk,KLS.kp,MK.nama, KLS.kode_kelas, KLS.status_buka
					FROM tk_kelas_mk KLS,tk_kls_jur KJ , tk_master_mk MK
					WHERE KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND
						  KLS.kode_mk = MK.kode_mk AND KLS.kode_kelas=KJ.kode_kelas AND KJ.kode_jur='$kode_jur' AND MID(KLS.kode_mk,1,2)!='60'
						  AND MID(KLS.kode_mk,1,2)!='00'".$addSql;
		}
		$sql =$sql." ORDER BY KLS.kode_mk ASC ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}

	function selectKlsMkJur($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_kls_jur WHERE kode_kelas='$kode_kelas'";
		$result = getQueryResult($sql);
		return($result);
	}

	function bukaTutupKelas($kode,$status)	{
		createConnection();
		$sql = "UPDATE tk_kelas_mk SET status_buka = '$status' WHERE kode_kelas='$kode'";
		$result = createQuery($sql);
		return($result);
	}

	function insertKlsMk($kode_mk,$kp,$kapasitas,$semester,$tahun,$dmb)	{
		createConnection();
		$kodeKls = generateKodeKelas($kode_mk,$kp,$semester,$tahun);
		$sql = "INSERT INTO tk_kelas_mk(kode_kelas,kode_mk,kp,kapasitas,semester,tahun,status_buka,dmb,waktu_buka)
				VALUES('$kodeKls','$kode_mk','$kp',$kapasitas,'$semester','$tahun','1','$dmb',CURRENT_TIMESTAMP())";
		$result = createQuery($sql);
		return $result;
	}

	function editKlsMk($kode_kelas,$kapasitas,$dmb)	{
		createConnection();
		$sql = "UPDATE tk_kelas_mk SET kapasitas=$kapasitas, dmb='$dmb'
				WHERE kode_kelas='$kode_kelas'";
		$result = createQuery($sql);
		return $result;
	}

	function deleteKlsMk($kode_kelas)	{
		createConnection();
		//Hapus Ujian
		$mk = getDetailKlsMk($kode_kelas);
		$sql = "SELECT kode_mk FROM tk_kelas_mk WHERE kode_mk='".$mk['kode_mk']."'";
		$check = getCountQueryResult($sql);

		$sql = "DELETE FROM tk_kelas_mk WHERE kode_kelas = '$kode_kelas'";
		$result = createQuery($sql);

		$sql = "DELETE FROM tk_kls_jur WHERE kode_kelas = '$kode_kelas'";
		$result = createQuery($sql);

		$sql = "DELETE FROM tk_jadwal_kul WHERE kode_kelas = '$kode_kelas'";
		$result = createQuery($sql);

		$sql = "DELETE FROM tk_setting_nrp WHERE kode_kelas = '$kode_kelas'";
		$result = createQuery($sql);

		$sql = "DELETE FROM tk_dsn_kls WHERE kode_kelas = '$kode_kelas'";
		$result = createQuery($sql);



		if($check<=1)	{
			$sql = "DELETE FROM tk_jadwal_ujian WHERE kode_mk = '".$mk['kode_mk']."'";
			$result = createQuery($sql);
		}
		return $result;
	}

	function checkUsedKlsMk($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_daftar_kls WHERE kode_kelas='$kode_kelas'";
		$result = getCountQueryResult($sql);
		return($result);
	}

	// MATA KULIAH YANG DIBUKA PADA TIAP JURUSAN
	function insertKlsMkJur($kode_mk,$kp,$semester,$tahun,$kode_jur)	{
		createConnection();
		$kodeKls = generateKodeKelas($kode_mk,$kp,$semester,$tahun);
		$sql = "INSERT INTO tk_kls_jur(kode_kelas,kode_jur)
				VALUES('$kodeKls','$kode_jur')";
		$result = createQuery($sql);
		return $result;
	}

	//DIPAKE DI DAFTAR_MK.PHP
	function selectKlsBuka($kode_jur)	{
		createConnection();
		$sql = "SELECT KM.kode_mk
				FROM tk_kls_jur KJ, tk_kelas_mk KM
				WHERE KM.kode_kelas = KJ.kode_kelas AND KM.status_buka='1' AND kode_jur='$kode_jur'";
		$result = getQueryResult($sql);
		return($result);
	}

	//UNTUK EDIT KLS
	function deleteKlsJur($kode_kelas)	{
		createConnection();
		$sql = "DELETE FROM tk_kls_jur WHERE kode_kelas='$kode_kelas'";
		$result = createQuery($sql);
		return($result);
	}


	function checkDuplicateKlsMk($kode_mk,$kp,$semester,$tahun)	{
		createConnection();
		$kodeKls = generateKodeKelas($kode_mk,$kp,$semester,$tahun);
		$sql = "SELECT * FROM tk_kelas_mk WHERE kode_kelas='$kodeKls'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	// UNTUK PENGISIAN KELAS MATA KULAH
	function checkJadwalKls($kode_kls)	{
		createConnection();
		$sql = "SELECT * FROM tk_jadwal_kul WHERE kode_kelas='$kode_kls'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function checkDosenKls($kode_kls)	{
		createConnection();
		$sql = "SELECT * FROM tk_dsn_kls WHERE kode_kelas='$kode_kls'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function checkSettingKls($kode_kls)	{
		createConnection();
		$sql = "SELECT * FROM tk_setting_nrp WHERE kode_kelas='$kode_kls'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	//FUNGSI KHUSUS YANG SYA BUAT UNTUK JADWAL.He3..
	function getJadwalKlsMkJur($kode_jur,$cari,$page)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas,KLS.isi, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND MID(KLS.kode_mk,1,2)='00' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $page,$display";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas,KLS.isi, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND MID(KLS.kode_mk,1,2)='60' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $page,$display";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas,KLS.isi, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $page,$display";
		}
		else	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas,KLS.isi, KLS.kode_mk, KJ.kode_jur, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_kls_jur KJ, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas AND KLS.kode_kelas = KJ.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."'  AND KJ.kode_jur='$kode_jur' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $page,$display";
		}
                file_put_contents('/tmp/jadwal.sql', $sql);
		$result = getQueryResult($sql);
		return($result);
	}


	function getPageJadwalKlsMkJur($kode_jur,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND MID(KLS.kode_mk,1,2)='00' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $awal,$paging";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas AND
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND MID(KLS.kode_mk,1,2)='60'".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $awal,$paging";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						 AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $awal,$paging";
		}
		else	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KJ.kode_jur, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_kls_jur KJ, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas AND KLS.kode_kelas = KJ.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."'  AND KJ.kode_jur='$kode_jur' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					LIMIT $awal,$paging";
		}

		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}


	function getPageCountJadwalKlsMkJur($kode_jur,$cari)	{
		createConnection();

		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		if($kode_jur=='MKU')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND MID(KLS.kode_mk,1,2)='00' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					";
		}
		else if($kode_jur=='MIPA')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' AND MID(KLS.kode_mk,1,2)='60'".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					";
		}
		else if($kode_jur=='ALL')	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					";
		}
		else	{
			$sql = "SELECT JDW.*, KLS.kp, KLS.kapasitas, KLS.kode_mk, KJ.kode_jur, KLS.kode_kelas, KLS.waktu_buka, MK.nama, KLS.status_buka
					FROM tk_kelas_mk KLS, tk_jadwal_kul JDW, tk_kls_jur KJ, tk_master_mk MK
					WHERE KLS.kode_mk = MK.kode_mk AND
						  KLS.kode_kelas = JDW.kode_kelas AND KLS.kode_kelas = KJ.kode_kelas
						  AND KLS.semester = '".getSemester()."'
						  AND KLS.tahun ='".getTahunAjaran()."'  AND KJ.kode_jur='$kode_jur' ".$addSql."
					ORDER BY JDW.hari, JDW.jam_masuk
					";
		}

		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}

	// UNTUK AMBIL DETAIL KELAS MATA KULAH
	function getDetailKlsMk($kode_kelas)	{
		createConnection();
		
                //$sql2="SELECT count(nrp) AS jml FROM tk_daftar_kls WHERE kode_kelas = '$kode_kelas' AND status=1";
		/*$sql = "SELECT KLS.*,JDW.*,SN.*,DSN.*
				FROM tk_kelas_mk KLS,tk_jadwal_kul JDW,tk_setting_nrp SN,tk_dsn_kls DSN, tk_dosen MD
				WHERE KLS.kode_kelas = JDW.kode_kelas AND KLS.kode_kelas = SN.kode_kelas AND KLS.kode_kelas = DSN.kode_kelas
				AND DSN.kode_dosen=MD.kode_dosen AND KLS.kode_kelas = '$kode_kls'";*/
                //$res=getQueryResult($sql2);
                
                //$row=$res[0];
                //$isi=$row['jml'];
                
                //echo "isinya=$isi";
//                $sql="UPDATE tk_kelas_mk SET isi=$isi WHERE kode_kelas = '$kode_kelas' ";
//                $res=getQueryResult($sql);
                
                $sql = "SELECT * FROM tk_kelas_mk WHERE kode_kelas = '$kode_kelas'";
		$result = getQueryResult($sql);
                //$result[0]['isi']=$isi;
                $hasil=$result[0];
                //$hasil['isi']=$isi;
		return($hasil);
	}

	//UINTUK EDIT KELAS
	function checkKlsMkJur($kode_kelas,$kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_kls_jur WHERE kode_kelas = '$kode_kelas' AND kode_jur='$kode_jur'";
		$result = getCountQueryResult($sql);
		return($result);
	}

	function getDetailJadwalKlsMk($kode_kls)	{
		createConnection();
		$sql = "SELECT * FROM tk_jadwal_kul WHERE kode_kelas = '$kode_kelas'";
		$result = getQueryResult($sql);
		return($result[0]);
	}

	function getDetailSettingKlsMk($kode_kls)	{
		createConnection();
		$sql = "SELECT * FROM tk_kelas_mk WHERE kode_kelas = '$kode_kelas'";
		$result = getQueryResult($sql);
		return($result[0]);
	}


	//UNTUK JADWAL KELAS MK
	function generateKodeJadwal()	{
		createConnection();
		$sql = "SELECT kode_jadwal FROM tk_jadwal_kul ORDER BY kode_jadwal DESC";
		$result = getQueryResult($sql);
		if($result)	{
			$kodeAkhir = substr($result[0]['kode_jadwal'],1,4);
			$angka = $kodeAkhir+1;
			if($angka>1 && $angka<10)	{
				$kodeBaru = "J000".$angka;
			}
			else if($angka>=10 && $angka<100)	{
				$kodeBaru = "J00".$angka;
			}
			else if($angka>=100 && $angka<1000)	{
				$kodeBaru = "J0".$angka;
			}
			else if($angka>=1000 && $angka<10000)	{
				$kodeBaru = "J".$angka;
			}
			return $kodeBaru;
		}
		else	{
			return "J0001";
		}

	}

	function insertJadwalKls($kode_kls,$kode_ruang,$jam_masuk,$jam_keluar,$hari)	{
		createConnection();
		$kodeJadwal = generateKodeJadwal();
		$sql = "INSERT INTO tk_jadwal_kul(kode_jadwal,kode_kelas,kode_ruang,jam_masuk,jam_keluar,hari)
				VALUES('$kodeJadwal','$kode_kls','$kode_ruang','$jam_masuk','$jam_keluar',$hari)";
		$result = createQuery($sql);
		return $result;
	}

	function selectJadwalKls($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_jadwal_kul WHERE kode_kelas='$kode_kelas' ORDER BY hari,jam_masuk,jam_keluar";
		$result = getQueryResult($sql);
		return($result);
	}

	function deleteJadwalKls($kode_jadwal)	{
		createConnection();
		$sql = "DELETE FROM tk_jadwal_kul WHERE kode_jadwal='$kode_jadwal'";
		$result = createQuery($sql);
		return $result;
	}



	function checkDuplicateJadwalKls($kode_kelas,$jam_masuk,$jam_keluar,$hari)	{
		createConnection();
		$sql = "SELECT * FROM tk_jadwal_kul WHERE kode_kelas='$kode_kelas' AND jam_masuk='$jam_masuk' AND jam_keluar='$jam_keluar' AND hari=$hari";
		$result = getCountQueryResult($sql);
		return $result;
	}

	//UNTUK SETTING NRP MK
	function generateKodeSetting()	{
		createConnection();
		$sql = "SELECT id FROM tk_setting_nrp ORDER BY id DESC";
		$result = getQueryResult($sql);
		if($result)	{
			$kodeAkhir = substr($result[0]['id'],1,3);
			$angka = $kodeAkhir+1;
			if($angka>1 && $angka<10)	{
				$kodeBaru = "S00".$angka;
			}
			else if($angka>=10 && $angka<100)	{
				$kodeBaru = "S0".$angka;
			}
			else if($angka>=100 && $angka<1000)	{
				$kodeBaru = "S".$angka;
			}
			return $kodeBaru;
		}
		else	{
			return "S001";
		}
	}

	function insertSettingKls($kode_kelas,$nrp_awal,$nrp_akhir)	{
		createConnection();
		$id = generateKodeSetting();
		$sql = "INSERT INTO tk_setting_nrp(id,kode_kelas,nrp_awal,nrp_akhir)
				VALUES('$id','$kode_kelas','$nrp_awal','$nrp_akhir')";
		$result = createQuery($sql);
		return $result;
	}

	function selectSettingKls($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_setting_nrp WHERE kode_kelas='$kode_kelas'";
		$result = getQueryResult($sql);
		return($result);
	}

	function deleteSettingKls($id)	{
		createConnection();
		$sql = "DELETE FROM tk_setting_nrp WHERE id='$id'";
		$result = createQuery($sql);
		return $result;
	}

	function checkDuplicateSettingKls($kode_kelas,$nrp_awal,$nrp_akhir)	{
		createConnection();
		$sql = "SELECT * FROM tk_setting_nrp WHERE kode_kelas='$kode_kelas' AND nrp_awal='$nrp_awal' AND nrp_akhir='$nrp_akhir'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getSettingKls($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_setting_nrp WHERE kode_kelas='$kode_kelas'";
		$result = getQueryResult($sql);
		return $result;
	}

	//UNTUK DOSEN MK
	function insertDosenKls($kode_kelas,$kode_dosen)	{
		createConnection();
		$sql = "INSERT INTO tk_dsn_kls(kode_dosen,kode_kelas)
				VALUES('$kode_dosen','$kode_kelas')";
		$result = createQuery($sql);
		return $result;
	}

	function selectDosenKls($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_dsn_kls WHERE kode_kelas='$kode_kelas'";
		$result = getQueryResult($sql);
		return($result);
	}

	function deleteDosenKls($kode_kelas,$kode_dosen)	{
		createConnection();
		$sql = "DELETE FROM tk_dsn_kls WHERE kode_kelas='$kode_kelas' AND kode_dosen='$kode_dosen'";
		$result = createQuery($sql);
		return $result;
	}

	function checkDuplicateDosenKls($kode_kelas,$kode_dosen)	{
		createConnection();
		$sql = "SELECT * FROM tk_dsn_kls WHERE kode_kelas='$kode_kelas' AND kode_dosen='$kode_dosen'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getDosenKls($kode_kelas)	{
		createConnection();
		$sql = "SELECT * FROM tk_dsn_kls WHERE kode_kelas='$kode_kelas'";
		$result = getQueryResult($sql);
		return $result;
	}

?>