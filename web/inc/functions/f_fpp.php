<?php
define ('IS_DEBUG',false);
define ('IS_DEBUG_TAMBAHSKS', true);
	function generateKodeFpp($jenis,$semester,$tahun)	{
		createConnection();
		$tahunAjaran = getTahunAjaran();
		if($tahun!=$tahunAjaran) {
			$tahunAjaran = $tahun;
		}
		$semester = getSemester();
		if($sem==$semester)	{
			$semester = $sem;
		}
		$kodeBaru = $jenis.substr($tahunAjaran,2,2).substr($semester,0,2);
		return $kodeBaru;
	}

	function checkStatusPerwalian()	{
		createConnection();
		$fpp = getAktifFpp();
		if($fpp)	{
			if((date("Y-m-d H:i:s")>date("Y-m-d H:i:s",strtotime($fpp['waktu_tutup']))) || (date("Y-m-d H:i:s")<date("Y-m-d H:i:s",strtotime($fpp['waktu_buka'])))){
				$sql = "UPDATE tk_fpp SET status_aktif=0 WHERE kode_fpp='".$fpp['kode_fpp']."'";
				$ubah = createQuery($sql);
			}
		}
		else	{
			$semester = getSemester();
			$tahun = getTahunAjaran();
			$sql = "SELECT * FROM tk_fpp WHERE semester='".$semester."' AND tahun='".$tahun."' AND '".date("Y-m-d H:i:s")."'>=waktu_buka AND '".date("Y-m-d H:i:s")."'<=waktu_tutup";
			$result = getQueryResult($sql);
			if($result) 	{
				$sql = "UPDATE tk_fpp SET status_aktif=1 WHERE kode_fpp='".$result[0]['kode_fpp']."'";
				$ubah = createQuery($sql);
			}
		}
	}

	function insertDefaultProritasI($kode_fpp)	{
		createConnection();
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','SN',1)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','AS',2)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','MS',3)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','AT',4)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','AR',5)";
		$result = createQuery($sql);
		return $result;
	}

	function insertDefaultProritasII($kode_fpp)	{
		createConnection();
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','AR',1)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','SN',2)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','AS',3)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','MS',4)";
		$result = createQuery($sql);
		$sql = "INSERT INTO tk_prioritas(kode_fpp,nama,prioritas) VALUES('$kode_fpp','AT',5)";
		$result = createQuery($sql);
		return $result;
	}

	function selectPrioritas($kode_fpp)	{
		createConnection();
		$sql = "SELECT DISTINCT * FROM tk_prioritas WHERE kode_fpp='$kode_fpp' ORDER BY prioritas ASC";
		$result = getQueryResult($sql);
		return($result);
	}

	function editPrioritas($status,$kode_prioritas)	{
		createConnection();
		$sql = "SELECT prioritas,kode_fpp FROM tk_prioritas WHERE kode_prioritas='$kode_prioritas'";
		$result = getQueryResult($sql);
		$prioritas = $result[0]['prioritas'];
		$kode_fpp = $result[0]['kode_fpp'];

		if($status=='up') {
			$prioritasBaru=$prioritas-1;
		}
		else if($status=='down') {
			$prioritasBaru=$prioritas+1;
		}

		$sql = "SELECT prioritas,kode_prioritas FROM tk_prioritas WHERE prioritas='$prioritasBaru' AND kode_fpp='$kode_fpp'";
		$hasil = getQueryResult($sql);
		$kodePengganti = $hasil[0]['kode_prioritas'];
		if(($kodePengganti!="") &&($prioritasBaru<=5) )	{
			$sql = "UPDATE tk_prioritas SET prioritas='$prioritasBaru' WHERE kode_prioritas='$kode_prioritas'";
			$result = createQuery($sql);

			$sql = "UPDATE tk_prioritas SET prioritas='$prioritas' WHERE kode_prioritas='$kodePengganti'";
			$result = createQuery($sql);
		}
	}

	function selectFpp($page)	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT * FROM tk_fpp ORDER BY tahun,semester LIMIT $page,$display";
		$result = getQueryResult($sql);
		return($result);
	}

	function selectJadwalFpp($semester,$tahun)	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT * FROM tk_fpp WHERE semester='$semester' AND tahun='$tahun' ORDER BY jenis";
		$result = getQueryResult($sql);
		return($result);
	}

	function getPageFpp()	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT kode_fpp FROM tk_fpp ";
		$result = getCountQueryResult($sql);
		return($result);
	}

	function insertFpp($jenis,$semester,$tahun,$waktuBuka,$waktuTutup)	{
		createConnection();
		$kode_fpp = generateKodeFpp($jenis,$semester,$tahun);
		$sql = "INSERT INTO tk_fpp(kode_fpp,jenis,semester,tahun,waktu_buka,waktu_tutup,status_aktif) VALUES('$kode_fpp','$jenis','$semester','$tahun','$waktuBuka','$waktuTutup','0')";
		$result = createQuery($sql);
		if($jenis=='I')	{
			insertDefaultProritasI($kode_fpp);
		}
		else if($jenis=='II')	{
			insertDefaultProritasII($kode_fpp);
		}
		else if($jenis='KK')	{
			inputManageKK($kode_fpp);
		}
		return $result;
	}

	function deleteFpp($kode_fpp)	{
		createConnection();
		$sql = "DELETE FROM tk_fpp WHERE kode_fpp ='$kode_fpp'";
		$result = createQuery($sql);

		$sql = "DELETE FROM tk_prioritas WHERE kode_fpp ='$kode_fpp'";
		$result = createQuery($sql);

		$sql = "DELETE FROM tk_kk WHERE kode_fpp ='$kode_fpp'";
		$result = createQuery($sql);
		return $result;
	}

	function editFpp($kode_fpp,$jenis,$semester,$tahun)	{
		createConnection();
		$sql = "UPDATE tk_fpp SET jenis='$jenis', semester=$semester, tahun='$tahun' WHERE kode_fpp='$kode_fpp'";
		$result = createQuery($sql);
		return $result;
	}

	function checkDuplicateFpp($jenis,$semester,$tahun)	{
		createConnection();
		$kode = generateKodeFpp($jenis,$semester,$tahun);
		$sql = "SELECT * FROM tk_fpp WHERE kode_fpp='$kode'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function checkStatusFpp($kode_fpp)	{
		createConnection();
		$sql = "SELECT status_aktif FROM tk_fpp WHERE kode_fpp='$kode_fpp'";
		$result = getQueryResult($sql);
		return $result[0];
	}

	function checkUsedFpp($kode_fpp)	{
		createConnection();
		$sql = "SELECT * FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function statusFpp($kode_fpp,$status)	{
		createConnection();
		if($status=='0')	{
			$sql = "UPDATE tk_fpp SET status_aktif='0'";
			$result = createQuery($sql);
			$sql = "UPDATE tk_fpp SET status_aktif='1' WHERE kode_fpp='$kode_fpp'";
			$result = createQuery($sql);
		}
		else	{
			$sql = "UPDATE tk_fpp SET status_aktif='0' WHERE kode_fpp='$kode_fpp'";
			$result = createQuery($sql);
		}
		return $result;
	}

	//UNTUK PROSES PERWALIAN MAHASISWA
	function getAktifFpp()	{
		createConnection();
		$sql = "SELECT * FROM tk_fpp WHERE status_aktif='1'";
		$result = getQueryResult($sql);
		return $result[0];
	}

	function getDetailFpp($kode_fpp)	{
		createConnection();
		$sql = "SELECT * FROM tk_fpp WHERE kode_fpp='$kode_fpp'";
		$result = getQueryResult($sql);
		return $result[0];
	}

	/*function getSksBebas($tahun,$semester,$nrp)	{
		createConnection();
		$jurusan = getJurusanMhs($nrp);
		$sql = "SELECT SUM(MK.sks) as sks_bebas
				FROM tk_master_mk MK, tk_kelas_mk KLS, tk_daftar_kls DK , tk_fpp FPP , tk_mk_jur MJ
				WHERE MK.kode_mk=KLS.kode_mk AND KLS.kode_kelas=DK.kode_kelas AND DK.kode_fpp=FPP.kode_fpp AND DK.nrp='$nrp'
					  AND MJ.kode_mk=MK.kode_mk AND MJ.kode_jur='$jurusan' AND MJ.status_bebas='1'
					  AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND DK.status!='2' AND DK.status!='3'";
		$result = getQueryResult($sql);
		return $result[0]['sks_bebas'];
	}*/
	function getSksBebas($list_mk,$nrp)	{
                $sksDmb=0;
		if(count($list_mk)>0)	{
			foreach($list_mk as $kls)	{
				$mk = getDetailKlsMk($kls['kode_kelas']);
				$sks = getDetailMk($mk['kode_mk']);

				$dmb = getDetailMkJur($mk['kode_mk'],getJurusanMhs($nrp));
				if($dmb['status_bebas']=='1')	{
					$sksDmb +=$sks['sks'];
				}
			}
			
		}
                return $sksDmb;
	}

	function getTotalSks($tahun,$semester,$nrp)	{
		createConnection();
		$sql = "SELECT SUM(MK.sks) as total_sks
				FROM tk_master_mk MK, tk_kelas_mk KLS, tk_daftar_kls DK , tk_fpp FPP
				WHERE MK.kode_mk = KLS.kode_mk AND KLS.kode_kelas=DK.kode_kelas AND DK.kode_fpp=FPP.kode_fpp AND DK.nrp='$nrp'
					  AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND DK.status!='2' AND DK.status!='3'";
		$result = getQueryResult($sql);
		return $result[0]['total_sks'];
	}

	function getStatusDaftar($kode_fpp,$kode_kls,$nrp)	{
		createConnection();
		$sql = "SELECT status FROM tk_daftar_kls DK, tk_fpp FPP WHERE DK.kode_kelas='$kode_kls' AND DK.kode_fpp=FPP.kode_fpp AND DK.nrp='$nrp' AND FPP.semester='".getSemester()."' AND FPP.tahun='".getTahunAjaran()."'";
		$result = getQueryResult($sql);
		return $result[0];
	}

	function editStatusDaftar($kode_fpp,$kode_kls,$nrp,$status)	{
		createConnection();
		$sql = "UPDATE tk_daftar_kls SET status='$status' WHERE kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp' AND nrp='$nrp'";
		$result = createQuery($sql);
		return $result;
	}


	function checkAvailable($kode_mk,$kp,$kode_jur)	{
		createConnection();
		$sql ="SELECT KLS.kode_mk, KLS.kp
				FROM tk_kelas_mk KLS, tk_kls_jur KJ
				WHERE KLS.kode_kelas = KJ.kode_kelas AND KLS.kode_mk ='$kode_mk'
					  AND KLS.kp='$kp' AND KJ.kode_jur ='$kode_jur' AND KLS.status_buka='1'";
		$result = getCountQueryResult($sql);
		return $result;
	}


	function inputMhsKls($kode_fpp,$list_kls,$nrp)	{
		createConnection();
		$sql = "DELETE FROM tk_daftar_kls WHERE nrp='$nrp' AND kode_fpp='$kode_fpp'";
		$result = createQuery($sql);
		if(count($list_kls)>0)	{
			foreach($list_kls as $kode_kelas)	{
				if($kode_kelas['status']=='0')	{
					$kode_mk=getDetailKlsMk($kode_kelas['kode_kelas']);
					$jurusan = getJurusanMhs($nrp);
					$mkJur = detailMkJur($kode_mk['kode_mk'],$jurusan);
					/*if($mkJur['status_bebas']=='1')	{
						$terima='1';
					}
					else	{*/
						$terima='0';
					//}
                                                $kodeKelas=$kode_kelas['kode_kelas'];
					$sql = "INSERT INTO tk_daftar_kls(kode_fpp,kode_kelas,nrp,status) VALUES('$kode_fpp','$kodeKelas','$nrp','$terima')";
					$result = createQuery($sql);

                                        $userId=$nrp;
                                        if ( isset( $_SESSION['symfony/user/sfUser/attributes'] ) )
                                        {
                                            $userDetails=$_SESSION['symfony/user/sfUser/attributes'];
                                            if ( isset( $userDetails['id'] ) )  $userId=$userDetails['id'];
                                        }


                                        $sql = "INSERT INTO user_log(username,action,description,address,created_at,nrp,kode_fpp,kode_kelas) VALUES('$userId','add','tambah mata kuliah $kodeKelas','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d H:i:s')."','$nrp', '$kode_fpp', '$kodeKelas')";
					$result = createQuery($sql);


                                        }
			}
		}
		return $result;
	}

	function deleteMhsKls($kode_fpp,$kode_kelas,$nrp)	{
		createConnection();
		/*$sql = "SELECT KLS.kode_kelas
				 FROM tk_daftar_kls DK, tk_kelas_mk KLS , tk_mk_prasyarat TT
				 WHERE DK.kode_kelas=KLS.kode_kelas AND DK.kode_fpp='$kode_fpp'
				 	   AND TT.kode_mk=KLS.kode_mk AND DK.nrp='$nrp' AND TT.status='P'";
		$result = getQueryResult($sql);
		$kodePrasyarat = $result[0]['kode_kelas'];
		$sql = "DELETE FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND kode_kelas ='$kodePrasyarat' AND nrp ='$nrp'";

		$result = createQuery($sql);*/

		$sql = "DELETE FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND kode_kelas ='$kode_kelas' AND nrp ='$nrp'";
		$result = createQuery($sql);

                $userId=$nrp;
                if ( isset( $_SESSION['symfony/user/sfUser/attributes'] ) )
                {
                    $userDetails=$_SESSION['symfony/user/sfUser/attributes'];
                    if ( isset( $userDetails['id'] ) )  $userId=$userDetails['id'];
                }
                
                $sql = "INSERT INTO user_log(username,action,description,address,created_at,nrp,kode_fpp,kode_kelas) VALUES('$userId','del','hapus mata kuliah $kode_kelas','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d H:i:s')."','$nrp', '$kode_fpp', '$kode_kelas')";
                $result = createQuery($sql);
		return $result;
	}

	function inputKKPlus($kode_fpp,$kode_kelas,$nrp)	{
		createConnection();

                $userId=$nrp;
                if ( isset( $_SESSION['symfony/user/sfUser/attributes'] ) )
                {
                    $userDetails=$_SESSION['symfony/user/sfUser/attributes'];
                    if ( isset( $userDetails['id'] ) )  $userId=$userDetails['id'];
                }

                $sql = "INSERT INTO user_log(username,action,description,address,created_at,nrp,kode_fpp,kode_kelas) VALUES('$userId','add_kk','tambah mata kuliah KK $kode_kelas','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d H:i:s')."','$nrp', '$kode_fpp', '$kode_kelas')";
                $result = createQuery($sql);
                
		$sql = "INSERT INTO tk_daftar_kls(kode_fpp,kode_kelas,nrp,status) VALUES('$kode_fpp','$kode_kelas','$nrp','1')";
		$result = createQuery($sql);

		return $result;
	}

	function deleteKKPlus($kode_kelas,$nrp)	{
		createConnection();

                $userId=$nrp;
                if ( isset( $_SESSION['symfony/user/sfUser/attributes'] ) )
                {
                    $userDetails=$_SESSION['symfony/user/sfUser/attributes'];
                    if ( isset( $userDetails['id'] ) )  $userId=$userDetails['id'];
                }

                $sql = "INSERT INTO user_log(username,action,description,address,created_at,nrp,kode_fpp,kode_kelas) VALUES('$userId','del_kk','hapus mata kuliah KK $kode_kelas','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d H:i:s')."','$nrp', '$kode_fpp', '$kode_kelas')";
                $result = createQuery($sql);

		$sql = "DELETE FROM tk_daftar_kls WHERE kode_kelas ='$kode_kelas' AND nrp ='$nrp'";
		$result = createQuery($sql);
		return $result;
	}

	function checkMkParalel($list_kls,$kode_kelas,$nrp)	{
		createConnection();
		$jurusan = getJurusanMhs($nrp);
		$kodeMk = getDetailKlsMk($kode_kelas);
		$mkPrasyarat = $kodeMk['kode_mk'];
		if(count($list_kls)>0)	{
			foreach($list_kls as $kls)	{

				if($kls['kode_kelas']!=$kode_kelas && $kls['status']=='0')	{
					$mk=getDetailKlsMk($kls['kode_kelas']);
					$sql = "SELECT * FROM tk_mk_prasyarat WHERE mk_prasyarat ='$mkPrasyarat' AND status='P' AND kode_mk='".$mk['kode_mk']."'";
					$result = getCountQueryResult($sql);
					if($result>0)	{
						return 1;
					}
				}
			}
		}
		return 0;
	}

	function selectDaftarKls($kode_fpp,$nrp)	{
		createConnection();
		$sql = "SELECT * FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND nrp ='$nrp' AND  status!='2' ORDER BY status DESC";
		$result = getQueryResult($sql);
		return $result;
	}

	function selectTerimaKls($kode_fpp,$nrp)	{
		createConnection();
		$sql = "SELECT * FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND nrp ='$nrp' AND status='1'";
		$result = getQueryResult($sql);
		return $result;
	}

	function selectAllTerimaKls($nrp,$semester,$tahun)	{
		createConnection();
		$sql = "SELECT KLS.*, DK.*
				FROM tk_kelas_mk KLS, tk_daftar_kls DK, tk_fpp FPP
				WHERE DK.kode_fpp=FPP.kode_fpp AND DK.nrp ='$nrp' AND DK.status='1' AND FPP.semester='$semester' AND FPP.tahun='$tahun'
					  AND KLS.kode_kelas=DK.kode_kelas";
		$result = getQueryResult($sql);
		return $result;
	}



	//UNTUK FPP I
	function selectMkBuka($page,$cari)		{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT DISTINCT MK.kode_mk
				FROM tk_master_mk MK, tk_kelas_mk KLS
				WHERE MK.kode_mk = KLS.kode_mk AND KLS.status_buka='1' ".$addSql." LIMIT $page,$display";
		$result = getQueryResult($sql);
		return $result;
	}

	function getPagingFpp($page)	{
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING;
		if($awal==0)	{
			$awal++;
		}
		return $awal;
	}

	function getPageMkBuka($page,$cari)		{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT DISTINCT MK.kode_mk
				FROM tk_master_mk MK, tk_kelas_mk KLS
				WHERE MK.kode_mk = KLS.kode_mk AND KLS.status_buka='1'".$addSql." LIMIT $awal,$paging";
		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}

	function getPageCountMkBuka($cari)		{
		createConnection();
		if($cari!="")	{
			$addSql = " AND (MK.kode_mk LIKE '%$cari%' OR MK.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT DISTINCT MK.kode_mk
				FROM tk_master_mk MK, tk_kelas_mk KLS
				WHERE MK.kode_mk = KLS.kode_mk AND KLS.status_buka='1'".$addSql." ";
		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}

	function getJmlKlsMK($kode_mk)	{
		createConnection();
		$sql = "SELECT KLS.kode_kelas FROM tk_master_mk MK, tk_kelas_mk KLS WHERE MK.kode_mk = KLS.kode_mk AND MK.kode_mk='$kode_mk' AND KLS.status_buka='1'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getOverloadMk($kode_mk)	{
		createConnection();
		$semester = getSemester();
		$tahun = getTahunAjaran();
		$sql = "SELECT KLS.kode_kelas
				FROM tk_kelas_mk KLS , tk_daftar_kls DK , tk_fpp FPP
				WHERE DK.kode_kelas=KLS.kode_kelas AND KLS.kode_mk='$kode_mk' AND KLS.status_buka='1'
					  AND FPP.kode_fpp=DK.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun'
				GROUP BY KLS.kode_kelas, KLS.kapasitas
				HAVING COUNT(DK.nrp) > KLS.kapasitas";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function selectPendaftarMk($kode_kelas,$cari,$page)	{
		createConnection();
		$display = LM_DISPLAY;
		if($cari!="")	{
			$addSql = " AND (MHS.nrp LIKE '%$cari%' OR MHS.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT MHS.nrp,MHS.nama,MHS.asisten
				FROM tk_mhs MHS, tk_daftar_kls DK , tk_fpp FPP
				WHERE MHS.nrp = DK.nrp AND DK.kode_kelas='$kode_kelas'
					  AND DK.kode_fpp=FPP.kode_fpp
					  AND FPP.semester='".getSemester()."'
					  AND FPP.tahun='".getTahunAjaran()."' ".$addSql."
					  ORDER BY DK.kode_fpp ASC LIMIT $page,$display";
		$result = getQueryResult($sql);
		return $result;
	}

	function getPagePendaftarMk($kode_kelas,$kode_fpp,$cari,$page)	{
		createConnection();
		$hal = floor(($page+1)/LM_PAGING);
		$awal = $hal * LM_PAGING * LM_DISPLAY;
		$paging = LM_DISPLAY * LM_PAGING;
		if($cari!="")	{
			$addSql = " AND (MHS.nrp LIKE '%$cari%' OR MHS.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT MHS.nrp,MHS.nama,MHS.asisten
				FROM tk_mhs MHS, tk_daftar_kls DK , tk_fpp FPP
				WHERE MHS.nrp = DK.nrp AND DK.kode_kelas='$kode_kelas'
					  AND DK.kode_fpp=FPP.kode_fpp
					  AND FPP.semester='".getSemester()."'
					  AND FPP.tahun='".getTahunAjaran()."' ".$addSql."
					  ORDER BY DK.kode_fpp ASC  LIMIT $awal,$paging";


		$result = getCountQueryResult($sql);
		return(($awal/LM_DISPLAY)+($result/LM_DISPLAY));
	}

	function getPageCountPendaftarMk($kode_kelas,$kode_fpp,$cari)	{
		createConnection();
		if($cari!="")	{
			$addSql = " AND (MHS.nrp LIKE '%$cari%' OR MHS.nama LIKE '%$cari%') ";
		}
		$sql = "SELECT MHS.nrp,MHS.nama,MHS.asisten
				FROM tk_mhs MHS, tk_daftar_kls DK , tk_fpp FPP
				WHERE MHS.nrp = DK.nrp AND DK.kode_kelas='$kode_kelas'
					  AND DK.kode_fpp=FPP.kode_fpp
					  AND FPP.semester='".getSemester()."'
					  AND FPP.tahun='".getTahunAjaran()."' ".$addSql."
					  ORDER BY DK.kode_fpp ASC";



		$result = getCountQueryResult($sql);
		$page = floor($result/LM_DISPLAY);
		return($page+1);
	}

	function generateHasilPerwalian($kode_fpp)	{
		createConnection();
		$sql = "SELECT DISTINCT * FROM tk_prioritas WHERE kode_fpp='$kode_fpp' ORDER BY prioritas ASC";
		$result = getQueryResult($sql);
		foreach($result as $prioritas)	{
			$hasil =prosesPerwalian($kode_fpp,$prioritas['nama']);
		}
		subProsesRejected($kode_fpp);
		updateIsiKelas();
		return true;
	}

	function updateIsiKelas() 	{
		createConnection();
		$sql = "SELECT KM.kode_kelas
				FROM tk_kelas_mk KM
				WHERE KM.status_buka='1'";
		$result = getQueryResult($sql);
		foreach($result as $update)	{
			$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_kelas='".$update['kode_kelas']."' AND status='1'";

			$jml = getCountQueryResult($sql);

			$sql = "UPDATE tk_kelas_mk SET isi=$jml WHERE kode_kelas='".$update['kode_kelas']."'";
			$proses = createQuery($sql);
		}
	}

	function prosesPerwalian($kode_fpp,$prioritas)	{
		$sql = "SELECT distinct DM.kode_kelas, KLS.dmb, KLS.kapasitas
				FROM tk_kelas_mk KLS, tk_daftar_kls DM
				WHERE DM.kode_fpp='$kode_fpp' AND KLS.kode_kelas = DM.kode_kelas
					  AND KLS.status_buka='1'";
		$kode_kls = getQueryResult($sql);
		if($kode_kls)	{
			foreach($kode_kls as $kls)	{
                            if (IS_DEBUG) {
                                if ( $kls['kode_kelas']!='60B104B10GE' ) continue;
                            }
				if($kls['dmb']=='1')	{
					subProsesDmb($kode_fpp,$kls['kode_kelas']);
				}
				else	{
					$limit = getKursiKosong($kls['kode_kelas'],$kls['kapasitas']);
					if($limit>0)	{
						if($prioritas=='AS')	{
                                                        appendLog('proses', 'prioritas AS', $kls['kode_kelas'].' kapasitas='.$kls['kapasitas'].' kursi kosong='.$limit, 'debug', $kode_fpp, $kls['kode_kelas']);
							subProsesAsisten($kode_fpp,$kls['kode_kelas'],$limit);
						}
						else if($prioritas=='SN')	{
                                                        appendLog('proses', 'prioritas SN', $kls['kode_kelas'].' kapasitas='.$kls['kapasitas'].' kursi kosong='.$limit, 'debug', $kode_fpp, $kls['kode_kelas']);
							subProsesSettingNrp($kode_fpp,$kls['kode_kelas'],$limit);
						}
						else if($prioritas=='MS')	{
                                                        appendLog('proses', 'prioritas MS', $kls['kode_kelas'].' kapasitas='.$kls['kapasitas'].' kursi kosong='.$limit, 'debug', $kode_fpp, $kls['kode_kelas']);
							subProsesMkSemester($kode_fpp,$kls['kode_kelas'],$limit);
						}
						else if($prioritas=='AT')	{
                                                        appendLog('proses', 'prioritas AT', $kls['kode_kelas'].' kapasitas='.$kls['kapasitas'].' kursi kosong='.$limit, 'debug', $kode_fpp, $kls['kode_kelas']);
							subProsesAngkatanTua($kode_fpp,$kls['kode_kelas'],$limit);
						}
						else if($prioritas=='AR')	{
                                                        appendLog('proses', 'prioritas AR', $kls['kode_kelas'].' kapasitas='.$kls['kapasitas'].' kursi kosong='.$limit, 'debug', $kode_fpp, $kls['kode_kelas']);
							subProsesAllRandom($kode_fpp,$kls['kode_kelas'],$limit);
						}
					}

				}
			}
		}
	}

	function getKursiKosong($kode_kls,$kapasitas)	{
		createConnection();
		$sql = "SELECT DK.nrp FROM tk_daftar_kls DK, tk_kelas_mk KLS, tk_fpp FPP WHERE DK.kode_kelas=KLS.kode_kelas AND DK.kode_kelas='$kode_kls' AND FPP.kode_fpp=DK.kode_fpp AND FPP.semester = '".getSemester()."'
					  AND FPP.tahun = '".getTahunAjaran()."'
					  AND DK.status='1'";
		$kursiIsi = getCountQueryResult($sql);
		$kursiKosong = $kapasitas-$kursiIsi;
		if($kursiKosong>0)	{
			return $kursiKosong;
		}
		else	{
			return 0;
		}
	}

	function subProsesDmb($kode_fpp,$kode_kelas)	{
		createConnection();
		$sql = "UPDATE tk_daftar_kls SET status='1' WHERE kode_kelas='$kode_kelas' AND kode_fpp='$kode_fpp'";
		$result = createQuery($sql);
		if(!result)	{
			echo "Error di bagian proses Dmb";
		}
	}

	function subProsesSettingNrp($kode_fpp,$kode_kelas,$jatah)	{
		createConnection();
		$sql = "SELECT SN.nrp_awal, SN.nrp_akhir
				FROM tk_kelas_mk KLS, tk_setting_nrp SN
				WHERE SN.kode_kelas=KLS.kode_kelas AND KLS.kode_kelas='$kode_kelas'";
		$setting = getQueryResult($sql);
		if($setting)	{
			$count=1;
			foreach ($setting as $cekSetting)	{
				$sql = "SELECT nrp ,kode_kelas
						FROM tk_daftar_kls
						WHERE kode_kelas='".$kode_kelas."' AND kode_fpp='$kode_fpp' AND status='0'
							  AND nrp>='".$cekSetting['nrp_awal']."' AND nrp<='".$cekSetting['nrp_akhir']."'";
				$mhs = getQueryResult($sql);
				foreach($mhs as $nrp)	{
					if($count<=$jatah)	{
						$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$nrp['nrp']."' AND kode_kelas='".$nrp['kode_kelas']."' AND kode_fpp='$kode_fpp'";
						$result = createQuery($sql);
						$count++;
						if(!result)	{
							echo "Error di bagian proses setting nrp";
						}
					}
				}
			}
		}
	}

	function subProsesAsisten($kode_fpp,$kode_kelas,$jatah)	{
		createConnection();

		$sql = "SELECT DISTINCT DM.kode_kelas, MHS.nrp
				FROM tk_daftar_kls DM , tk_mhs MHS
				WHERE DM.kode_fpp='$kode_fpp' AND DM.nrp=MHS.nrp AND DM.kode_kelas='$kode_kelas'
					  AND MHS.asisten='1' AND DM.status='0'
				LIMIT 0,$jatah";
		$kode_kls = getQueryResult($sql);
		if($kode_kls)	{
			foreach($kode_kls as $kls)	{
				$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$kls['nrp']."' AND kode_kelas='".$kls['kode_kelas']."' AND kode_fpp='$kode_fpp'";
				$result = createQuery($sql);
				if(!result)	{
					echo "Error di bagian proses asisten";
				}
			}
		}
	}

	function subProsesMkSemester($kode_fpp,$kode_kls,$jatah)	{
		createConnection();
		$sql = "SELECT MK.kode_mk,MJ.semester,MJ.kode_jur FROM tk_master_mk MK, tk_mk_jur MJ, tk_kelas_mk KLS WHERE MK.kode_mk=MJ.kode_mk AND KLS.kode_kelas='$kode_kls' AND KLS.kode_mk=MK.kode_mk";
                //SELECT MK.kode_mk,MJ.semester FROM tk_master_mk MK, tk_mk_jur MJ, tk_kelas_mk KLS WHERE MK.kode_mk=MJ.kode_mk AND KLS.kode_kelas='60B104B10GE' AND KLS.kode_mk=MK.kode_mk
		$result = getQueryResult($sql);

		if($result)	{
                    $jurusanSemesters=array();
                    $defaultSemester=0;
                    foreach ($result as $rs)
                    {
                        if (!$defaultSemester) $defaultSemester=$rs['semester']; //default adalah mengikuti record pertama;
                        $kodeJur= substr($rs['kode_jur'],1,1);
                        $jurusanSemesters[$kodeJur]=$rs['semester'];
                    }
			
			$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp' AND status='0'";
                        //SELECT nrp FROM tk_daftar_kls WHERE kode_kelas='60B104B10GE' AND kode_fpp='I10GE' AND status='0'
			$mhs = getQueryResult($sql);
			$count=1;
			foreach($mhs as $cekSem)	{
				if($count<=$jatah)	{
                                    $semesterMhs=getSemesterMhs($cekSem['nrp']);
                                    $jurusanMhs=substr($cekSem['nrp'],3,1 );
                                    if ( isset($jurusanSemesters[$jurusanMhs])  )
                                    {
                                        $semMk=$jurusanSemesters[$jurusanMhs];
                                    } else {
                                        $semMk=$defaultSemester;
                                    }

                                     
                                    
					if($semesterMhs==$semMk)	{

                                            if (IS_DEBUG) appendLog('proses_terima', 'TERIMA proses mhs semesternya, nrp='.$cekSem['nrp'].' semester mk='.$semMk.' semester mhs='.$semesterMhs, $kode_kls, 'debug', $kode_fpp, $kode_kls);
							$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$cekSem['nrp']."' AND kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp'";
							$result = createQuery($sql);
							if(!result)	{
								echo "Error di bagian proses semester";
							}
							$count++;
					} else {
                                            if (IS_DEBUG) appendLog('proses_tolak', 'TOLAK proses mhs semesternya, nrp='.$cekSem['nrp'].' semester mk='.$semMk.' semester mhs='.$semesterMhs, $kode_kls, 'debug', $kode_fpp, $kode_kls);
                                        }
				}
				else	{
                                    
					return 0;
				}
			}
		}
	}

	function subProsesAngkatanTua($kode_fpp,$kode_kls,$jatah)	{
		createConnection();
		$angkatanTua =  substr(getTahunAjaran(),0,4) - 2;
		$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp' AND status='0'";
		$mhs = getQueryResult($sql);
		$count=1;
		foreach($mhs as $cekAngkatan)	{
			if($count<=$jatah)	{
				if(getAngkatanMhs($cekAngkatan['nrp'])<=$angkatanTua)	{
						$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$cekAngkatan['nrp']."' AND kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp'";
						$result = createQuery($sql);
						if(!result)	{
							echo "Error di bagian proses Angkatan Tua";
						}
						$count++;
				}
			}
			else	{
				return 0;
			}
		}
	}

	function subProsesAllRandom($kode_fpp,$kode_kls,$jatah)	{
		createConnection();
		$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp' AND status='0' ORDER BY RAND() LIMIT 0,$jatah";
		$mhs = getQueryResult($sql);
		foreach($mhs as $random)	{
			$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$random['nrp']."' AND kode_kelas='$kode_kls' AND kode_fpp='$kode_fpp'";
			$result = createQuery($sql);
		}
	}

	function subProsesRejected($kode_fpp)	{
		createConnection();
		$sql = "UPDATE tk_daftar_kls SET status='2' WHERE kode_fpp='$kode_fpp' AND status='0'";
		$result = createQuery($sql);
		return $result;
	}

	/*function prosesSettingNrp($kode_fpp)	{
		createConnection();
		$sql = "SELECT DISTINCT DM.kode_kelas, SN.nrp_awal, SN.nrp_akhir, KLS.kapasitas
				FROM tk_kelas_mk KLS, tk_daftar_kls DM , tk_setting_nrp SN
				WHERE DM.kode_fpp='$kode_fpp' AND SN.kode_kelas=KLS.kode_kelas AND KLS.kode_kelas = DM.kode_kelas
					  AND KLS.status_buka='1'";
		$kode_kls = getQueryResult($sql);
		if($kode_kls)	{
			foreach($kode_kls as $kls)	{
				$sql = "SELECT nrp ,kode_kelas
						FROM tk_daftar_kls
						WHERE kode_kelas='".$kls['kode_kelas']."' AND nrp>='".$kls['nrp_awal']."'
							  AND nrp<='".$kls['nrp_akhir']."' AND status='0'";
				$mhs = getQueryResult($sql);
				foreach($mhs as $nrp)	{
					$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$nrp['nrp']."' AND kode_kelas='".$nrp['kode_kelas']."'";
					$result = createQuery($sql);
					if(!result)	{
						echo "Error di bagian proses setting nrp";
					}
				}
			}
		}
		$jml = getCountQueryResult($sql);
		return ($jml);
	}

	function prosesAsisten($kode_fpp)	{
		createConnection();
		$sql = "SELECT DISTINCT DM.kode_kelas, MHS.nrp
				FROM tk_kelas_mk KLS, tk_daftar_kls DM , tk_mhs MHS
				WHERE DM.kode_fpp='$kode_fpp' AND KLS.kode_kelas = DM.kode_kelas
					  AND status_buka='1' AND DM.nrp=MHS.nrp AND MHS.asisten='1' AND DM.status='0'";
		$kode_kls = getQueryResult($sql);
		if($kode_kls)	{
			foreach($kode_kls as $kls)	{
				$sql = "UPDATE tk_daftar_kls SET status='1' WHERE nrp='".$kls['nrp']."' AND kode_kelas='".$kls['kode_kelas']."'";
				$result = createQuery($sql);
				if(!result)	{
					echo "Error di bagian proses setting nrp";
				}
			}
		}
	}*/

	function getStatusProses($kode_fpp)	{
		createConnection();
		$sql = "SELECT * FROM tk_daftar_kls WHERE status='0' AND kode_fpp='$kode_fpp'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getPendaftarKls($kode_fpp,$kode_kls)	{
		createConnection();
		$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND kode_kelas='$kode_kls' AND (status='0' || status='1')";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getAllPendaftarKls($kode_kls,$semester,$tahun)	{
		createConnection();
		$sql = "SELECT KLS.nrp FROM tk_daftar_kls KLS, tk_fpp FPP WHERE KLS.kode_kelas='$kode_kls' AND KLS.kode_fpp=FPP.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND (KLS.status='1' OR KLS.status='0')";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function selectAllPendaftarKls($kode_kls,$semester,$tahun)	{
		createConnection();
		$sql = "SELECT KLS.nrp FROM tk_daftar_kls KLS, tk_fpp FPP WHERE KLS.kode_kelas='$kode_kls' AND KLS.kode_fpp=FPP.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND (KLS.status='1' OR KLS.status='0')";
		$result = getQueryResult($sql);
		return $result;
	}

	function getTolakKls($kode_fpp,$kode_kls)	{
		createConnection();
		$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND kode_kelas='$kode_kls' AND status='2'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getTerimaKls($kode_fpp,$kode_kls)	{
		createConnection();
		$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND kode_kelas='$kode_kls' AND status='1'";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function getAllTerimaKls($kode_kls,$semester,$tahun)	{
		createConnection();
		$sql = "SELECT KLS.nrp FROM tk_daftar_kls KLS, tk_fpp FPP WHERE KLS.kode_kelas='$kode_kls' AND KLS.kode_fpp=FPP.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND KLS.status='1'";
		$result = getCountQueryResult($sql);
		return $result;
	}


	//SEGALA MACAM PENGECEKAN DI PERWALIAN
	function convertWaktu($waktu)	{
		$jam = substr($waktu,0,2);
		$menit = substr($waktu,3,2);
		$menitKeJam = $menit/60;
		return $jam+$menitKeJam;
	}

	/*function checkDuplicateDaftar($semester,$tahun,$kode_kelas,$nrp)	{ OLD VERSION
		createConnection();
		$kode_mk = getDetailKlsMk($kode_kelas);
		$sql = "SELECT KLS.kode_mk
				FROM tk_daftar_kls DK, tk_kelas_mk KLS, tk_fpp FPP
				WHERE DK.kode_kelas=KLS.kode_kelas AND DK.kode_fpp=FPP.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun'
					  AND DK.nrp ='$nrp' AND KLS.kode_mk='".$kode_mk['kode_mk']."' AND status!='2'";
		$result = getCountQueryResult($sql);
		return $result;
	}*/

	function checkDuplicateDaftar($list_kls,$kode_kelas)	{
		createConnection();
		$kode_mk = getDetailKlsMk($kode_kelas);
		if(count($list_kls)>0)	{
			foreach($list_kls as $cek)	{
				$list_mk = getDetailKlsMk($cek['kode_kelas']);
				if(
                                        (
                                          ($list_mk['kode_mk']==$kode_mk['kode_mk']) && ($cek['status']=='0' || $cek['status']=='1')
                                        )
                                        || (($kode_kelas==$cek['kode_kelas']) && ($cek['status']=='3') )
                                        )	{
					return 1;
				}
			}
		}
		return 0;
	}

	function checkJadwalTubrukan($list_kls,$nrp,$semester,$tahun,$kode_kelas)	{
		createConnection();
                 

		if(count($list_kls)>0)	{
			$jadwalNya = selectJadwalKls($kode_kelas);
			foreach($jadwalNya as $menubruk)	{
				foreach($list_kls as $ditubruk)		{
					if(($ditubruk['status']==0 || $ditubruk['status']==1) && ($kode_kelas != $ditubruk['kode_kelas']) && ($ditubruk['status']!=3))
					{
						$klsDitubruk = selectJadwalKls($ditubruk['kode_kelas']);

						foreach($klsDitubruk as $jadwalDitubruk)	{
							if($menubruk['hari']==$jadwalDitubruk['hari'])	{
								$jam_masuk_menubruk = convertWaktu($menubruk['jam_masuk']);
								$jam_keluar_menubruk = convertWaktu($menubruk['jam_keluar']);

								$jam_masuk_ditubruk = convertWaktu($jadwalDitubruk['jam_masuk']);
								$jam_keluar_ditubruk = convertWaktu($jadwalDitubruk['jam_keluar']);
								//KONDISI 1 : JAM MASUK YANG MENUBRUK DIANTARA JAM MASUK DAN KELUAR YANG UDA ADA
								//KONDISI 2 : JAM KELUAR YANG MENUBRUK DIATARA JAM MASUK DAN KELUAR YANG UDA ADA
								if((($jam_masuk_menubruk >= $jam_masuk_ditubruk) && ($jam_masuk_menubruk < $jam_keluar_ditubruk)) ||
								   (($jam_keluar_menubruk > $jam_masuk_ditubruk) && ($jam_keluar_menubruk <= $jam_keluar_ditubruk)))
								{

                                                                    $_SESSION['infDetail'] = "Terjadi tubrukan jadwal kuliah ".  extractKodeKelas($kode_kelas) ." dengan ". extractKodeKelas($ditubruk['kode_kelas']);

								    return true;
								}
							}
						}
					}
				}
			}
			return false;
		}
		else	{
			return false;
		}
	}

	function checkUjianTubrukan($list_kls,$nrp,$semester,$tahun,$kode_kelas)	{
		createConnection();

		if(count($list_kls)>0)	{
			$menubruk = getDetailUjianKls($kode_kelas);
			if($menubruk)	{
				foreach($list_kls as $ditubruk)	{
					if(($ditubruk['status']=='0' || $ditubruk['status']=='1') && ($ditubruk['kode_kelas']!=$kode_kelas) && ($ditubruk['status']!=3))	{
						$jadwalDitubruk=getDetailUjianKls($ditubruk['kode_kelas']);
						$mk = getDetailKlsMk($ditubruk['kode_kelas']);
						$sql = "SELECT DK.kode_kelas FROM tk_daftar_kls DK, tk_fpp FPP , tk_kelas_mk KLS
								WHERE KLS.kode_kelas=DK.kode_kelas AND DK.kode_fpp=FPP.kode_fpp AND nrp='$nrp' AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND KLS.kode_mk='".$mk['kode_mk']."' AND DK.status='3'";
						$cek = getCountQueryResult($sql);
						if($cek==0)	{
							if(($menubruk['minggu'] == $jadwalDitubruk['minggu']) && ($menubruk['hari'] == $jadwalDitubruk['hari']) && ($menubruk['jam']==$jadwalDitubruk['jam']))	{
                                                                $_SESSION['infDetail'] = "Terjadi tubrukan jadwal ujian dengan mata kuliah ". extractKodeKelas($ditubruk['kode_kelas']);
								return true;
							}
						}
					}
				}
			}
			return false;
		}
		else	{
			return false;
		}
	}

	function checkKelasPenuh($kode_kelas,$nrp)	{
		createConnection();
		$sql = "SELECT isi,kapasitas,kode_mk FROM tk_kelas_mk WHERE kode_kelas='$kode_kelas'";
		$result=getQueryResult($sql);
		$isi = $result[0]['isi'];
		$kapasitas = $result[0]['kapasitas'];
		$kode_mk = $result[0]['kode_mk'];

		$jur = getJurusanMhs($nrp);
		$sql = "SELECT status_bebas FROM tk_mk_jur WHERE kode_mk='$kode_mk' AND kode_jur='$jur'";
		$status = getQueryResult($sql);
		$cekStatus= $status[0]['status_bebas'];
		if($cekStatus=='1')	{
			return false;
		}

		if($isi==$kapasitas)	{
			return false;
		}
		else	{
			return true;
		}

	}

	function checkJumlahSks($list_mk,$nrp,$kode_fpp,$kode_kelas)	{
		createConnection();
		//DARI SKS YANG AKAN DI DAFTARKAN
		$sql = "SELECT MK.sks,MK.kode_mk FROM tk_master_mk MK, tk_kelas_mk KLS
				WHERE MK.kode_mk = KLS.kode_mk AND KLS.kode_kelas = '$kode_kelas'";
		$result = getQueryResult($sql);
		$sksDmb =  0;
		$fpp = getAktifFpp();
		$tahun = $fpp['tahun'];
		$semester = $fpp['semester'];

		//DARI TOTAL SKS MHS
		$detailMhs = getDetailMhs($_SESSION['mhs_id']);
		$sksMax = $detailMhs['sksmax'];

		//DARI TOTAL SKS YANG TELAH DIDAFTARKAN
		if(count($list_mk)>0)	{
			$sksTotal=0;
			$sksBatal=0;
			foreach($list_mk as $kls)	{
				$mk = getDetailKlsMk($kls['kode_kelas']);
				$sks = getDetailMk($mk['kode_mk']);
				$dmb = getDetailMkJur($mk['kode_mk'],$detailMhs['jurusan']);
				if($kls['status']=='1' || $kls['status']=='0')	{
					$sksTotal += $sks['sks'];
					if($dmb['status_bebas']=='1')	{
						$sksDmb +=$sks['sks'];
					}
				}
				else if($kls['status']=='3')	{
					if($dmb['status_bebas']=='0')	{
						$sksBatal+=$sks['sks'];
					}
				}

			}
		}

		//DARI TAMBAHAN SKS
		$sql = "SELECT TTS.jml_sks
				FROM tk_tambah_sks TTS, tk_fpp FPP
				WHERE FPP.kode_fpp='$kode_fpp' AND TTS.nrp='$nrp' AND FPP.semester=TTS.semester AND FPP.tahun=TTS.tahun AND FPP.jenis!='I'";
		$tambah = getQueryResult($sql);
		if($tambah)	{
			$sks_tambah = $tambah[0]['jml_sks'];
                        if (IS_DEBUG_TAMBAHSKS  && ($nrp == '6097704')) {
                            tambahDebugLog("nrp $nrp dapat tambah sks sejumlah $sks_tambah");
                        }
		}
		else	{
			$sks_tambah = 0;
                        if (IS_DEBUG_TAMBAHSKS  && ($nrp == '6097704')) {
                            tambahDebugLog("nrp $nrp tidak dapat tambah sks ERR  ");
                        }
		}

		$cekDmb = getDetailMkJur($result[0]['kode_mk'],$detailMhs['jurusan']);
		if($cekDmb['status_bebas']=='1')	{
			return true;
		}
		else	{
			if(($result[0]['sks']+$sksTotal-$sksBatal-$sksDmb)>($sksMax+$sks_tambah))	{
				return false;
			}
			else	{
				return true;
			}
		}
	}

	function checkStatusMhs($nrp)	{
		$status = getDetailMhs($nrp);
			return $status['status'];
	}

	function convertNilai($nisbi)	{
		if($nisbi=='A')	{
			return 4;
		}
		else if($nisbi=='AB')	{
			return 3.5;
		}
		else if($nisbi=='B')	{
			return 3;
		}
		else if($nisbi=='BC')	{
			return 2.5;
		}
		else if($nisbi=='C')	{
			return 2;
		}
		else if($nisbi=='D')	{
			return 1;
		}
		else if($nisbi=='E')	{
			return 0;
		}
	}

	/*function checkParalel($semester,$tahun)	{ // INI DILAKUKAN SETELAH PROSES PERWALIAN UNTUK MENOLAK MK YANG PARARELNYA KRTOLAK
		createConnection();
		$sql = "SELECT P.mk_prasyarat,DK.nrp, DK.kode_kelas, DK.kode_fpp
				FROM tk_daftar_kls DK, tk_kelas_mk KLS, tk_master_mk MK, tk_mk_prasyarat P
				WHERE DK.kode_kelas=KLS.kode_kelas AND KLS.kode_mk=MK.kode_mk AND MK.kode_mk=P.kode_mk AND P.status='P'";
		$result = getQueryResult($sql);
		if($result)	{
			foreach($result as $mkPrasyarat)	{
				$sql = "SELECT DISTINCT KLS.kode_mk
						FROM tk_daftar_kls DK, tk_fpp FPP, tk_kelas_mk KLS
						WHERE DK.kode_fpp=FPP.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND KLS.kode_kelas=DK.kode_kelas
							  AND Dk.nrp='".$mkPrasyarat['nrp']."' AND KLS.kode_mk='".$mkPrasyarat['mk_prasyarat']."' AND status='2'";
				$cek = getCountQueryResult($sql);
				if($cek>0)	{
					$sql = "UPDATE tk_daftar_kls SET status='2'
							WHERE kode_kelas='".$mkPrasyarat['kode_kelas']."' AND nrp='".$mkPrasyarat['nrp']."' AND kode_fpp='".$mkPrasyarat['kode_fpp']."'";
					$update=createQuery($sql);
					if(!$update)	{
						echo "Check Paralel Error";
					}
				}
			}
		}
		else	{
			return true;
		}
	}*/



	function checkPrasyarat($list_kls,$nrp,$kode_fpp,$kode_kelas)	{
		createConnection();
		$kode_mk = getDetailKlsMk($kode_kelas);
		$jurusan = getJurusanMhs($nrp);
		$check = selectMkPrasyaratJur($kode_mk['kode_mk'],$jurusan);
		$or = 0;
		$statusOr = false;
		$komentar=array();
		if($check)	{

			foreach($check as $cari)	{
                            $kodeMkPrasyarat = $cari['mk_prasyarat'];

				if($cari['status']=='AND')	{
					if($cari['nilai_min']=='P')	{
						$sqlP = "SELECT kode_mk,nilai
								 FROM tk_transkrip WHERE nrp='$nrp'
									  AND kode_mk='".$cari['mk_prasyarat']."'";
						$statusP = getCountQueryResult($sqlP);
						if($statusP==0)	{
							
							$cekP=0;
							if(count($list_kls)>0)	{
								foreach($list_kls as $kls)	{
									if($kls['status']=='0' || $kls['status']=='1')	{
										$kode_mk = getDetailKlsMk($kls['kode_kelas']);
										if($kode_mk['kode_mk']==$cari['mk_prasyarat'])	{
											$cekP=1;
										}
									}
								}
							}
							if($cekP==0)	{
                                                                $kodeMkPrasyarat=getNamaMk($kodeMkPrasyarat); 
								$_SESSION['infDetail']="Mata kuliah $kodeMkPrasyarat belum diambil!";
								return false;
							}
						}
					}
					else	{
						$sqlAnd = "SELECT kode_mk,nilai
								   FROM tk_transkrip WHERE nrp='$nrp'
								   AND kode_mk='".$cari['mk_prasyarat']."' AND nilai <='".$cari['nilai_min']."'";
						$statusAnd = getCountQueryResult($sqlAnd);

						if($statusAnd==0)	{
                                                    $kodeMkPrasyarat=getNamaMk($kodeMkPrasyarat); 
                                                    $_SESSION['infDetail']="Belum dipenuhi, prasyarat berupa mata kuliah $kodeMkPrasyarat dengan nilai minimum ".$cari['nilai_min'];
							return false;
						}
					}
				}
				else if($cari['status']=='OR')	{
					$statusOr = true;
					if($cari['nilai_min']=='P')	{
						$sqlP = "SELECT kode_mk,nilai
								 FROM tk_transkrip WHERE nrp='$nrp'
									  AND kode_mk='".$cari['mk_prasyarat']."'";
						$statusP = getCountQueryResult($sqlP);
						if($statusP==0)	{
							$cekP=0;
							if(count($list_kls)>0)	{
								foreach($list_kls as $kls)	{
									if($kls['status']=='0' || $kls['status']=='1')	{
										$kode_mk = getDetailKlsMk($kls['kode_kelas']);
										if($kode_mk['kode_mk']==$cari['mk_prasyarat'])	{
											$cekP=1;
										}
									}
								}
							}
							if($cekP!=0)	{
								$or = 1;
							}
						}
					}
					else	{
						$addSql = "SELECT kode_mk,nilai
								   FROM tk_transkrip
								   WHERE ( kode_mk ='".$cari['mk_prasyarat']."' AND nilai<='".$cari['nilai_min']."' ) ";
						$statusOr = getCountQueryResult($sqlOr);
						if($statusOr!=0)	{
							$or = 1;
						}
					}
				}
			}
			if($or!=1 && $statusOr==true)	{

				return false;
			}
		} else {
			$komentar[]='Tidak ada data mengenai mata kuliah prasyarat';
		}

		//CEK SKS MINIMUM
		$jurusan = getJurusanMhs($nrp);
		$mhs = getDetailMhs($nrp);
		$mkJur= detailMkJur($kode_mk['kode_mk'],$jurusan);
		if($mhs['skskum']<$mkJur['sks_min'])	{
                        $_SESSION['infDetail']="Belum dipenuhi, prasyarat berupa SKS minimum ".$mkJur['sks_min']." sedangkan SKS kumulatif anda ".$mhs['skskum'];
			return false;
		}
		return true;
	}

	//PENGUMUMAN HASIL FPP
	function hasilPerwalianMhs($jenis,$semester,$tahun,$nrp)	{
		createConnection();
		$sql = "SELECT * FROM tk_fpp FPP, tk_daftar_kls DM
				WHERE FPP.kode_fpp=DM.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun' AND FPP.jenis='$jenis'
					  AND DM.nrp='$nrp' ";
		$result = getQueryResult($sql);
		return $result;
	}

	function pendingPerwalianMhs($semester,$tahun,$nrp)	{
		createConnection();
		$sql = "SELECT kode_kelas,status FROM tk_fpp FPP, tk_daftar_kls DM
				WHERE FPP.kode_fpp=DM.kode_fpp AND FPP.semester='$semester' AND FPP.tahun='$tahun'
					  AND nrp='$nrp' AND (DM.status='0' OR DM.status='1')";
		$result = getQueryResult($sql);
		return $result;
	}

	function getPending($list_kls)	{
		$statusPending=0;
		if(count($list_kls)>0)	{
			foreach($list_kls as $klsPending)	{
				if($klsPending['status']=='0')	{
					return 1;
				}
			}
			return 0;
		}
		return 1;
	}

	//UNTUK PINDAH KELAS
	function checkPindahKls($kode_fpp,$kode_kelas)	{
		createConnection();
		$sql = "SELECT KLS.kode_mk,TJ.jam_masuk, TJ.jam_keluar, TJ.hari, KLS.kp
				FROM tk_daftar_kls DK, tk_kelas_mk KLS, tk_jadwal_kul TJ
				WHERE DK.kode_kelas=KLS.kode_kelas AND KLS.kode_kelas=TJ.kode_kelas AND DK.kode_fpp='$kode_fpp' AND DK.kode_kelas='$kode_kelas'";
		$result = getQueryResult($sql);

		$sql = "SELECT KLS.kode_kelas
				FROM tk_kelas_mk KLS
				WHERE KLS.kode_mk='".$result[0]['kode_mk']."' AND KLS.status_buka='1' AND KLS.isi < KLS.kapasitas AND KLS.kp!='".$result[0]['kp']."'";

		$klsBaru = getQueryResult($sql);
		$jmlSama=0;
		foreach($klsBaru as $kls)	{
			$statusCek=1;
			foreach($result as $cekJadwal)	{
					$sql = "SELECT kode_kelas FROM tk_jadwal_kul
							WHERE hari=".$cekJadwal['hari']." AND jam_masuk='".$cekJadwal['jam_masuk']."' AND jam_keluar='".$cekJadwal['jam_keluar']."'
								  AND kode_kelas='".$kls['kode_kelas']."'";
					$cekSama = getCountQueryResult($sql);
					if($cekSama==0)	{
						$statusCek=0;
					}
			}
			if($statusCek==1)	{
				$jmlSama++;
			}
		}
		return $jmlSama;
	}

	function selectKpPengganti($kode_mk,$kp)	{
		createConnection();
		$sql = "SELECT KLS.kode_kelas, KLS.kp
				FROM tk_kelas_mk KLS
				WHERE KLS.kode_mk='$kode_mk' AND KLS.status_buka='1' AND KLS.isi < KLS.kapasitas AND KLS.kp!='$kp'";
		$klsBaru = getQueryResult($sql);
		return $klsBaru;
	}

	function checkJadwalPengganti($kode_kelas,$kode_kelas_pengganti)	{
		createConnection();
		$result = selectJadwalKls($kode_kelas);
		$statusCek=1;
		foreach($result as $cekJadwal)	{
				$sql = "SELECT kode_kelas FROM tk_jadwal_kul
						WHERE hari=".$cekJadwal['hari']." AND jam_masuk='".$cekJadwal['jam_masuk']."' AND jam_keluar='".$cekJadwal['jam_keluar']."'
							  AND kode_kelas='".$kode_kelas_pengganti."'";
				$cekSama = getCountQueryResult($sql);
				if($cekSama==0)	{
					$statusCek=0;
				}
		}
		if($statusCek==1)	{
			return true;
		}
		return false;
	}

	function prosesPindahKls($kode_fpp,$kls_lama,$kls_baru,$jml)	{
		createConnection();
		$sql = "SELECT nrp FROM tk_daftar_kls WHERE kode_kelas='$kls_lama' AND kode_fpp='$kode_fpp' ORDER BY RAND() LIMIT 0,$jml";
		$pindah = getQueryResult($sql);
		foreach($pindah as $proses)	{
			$sql = "UPDATE tk_daftar_kls SET kode_kelas='$kls_baru' WHERE kode_kelas='$kls_lama' AND kode_fpp='$kode_fpp' AND nrp='".$proses['nrp']."'";
			$result = createQuery($sql);
			if(!$result)	{
				return false;
			}
		}
		return true;
	}

	//KASUS KHUSUS OHH KASUS KHUSUS

	function checkDuplicateBatal($list_kls,$kode_kls)	{
		createConnection();
		if(count($list_kls)>0)	{
			foreach($list_kls as $kls)	{
				if($kls['status']=='3' && $kls['kode_kelas']==$kode_kls)	{
					return 1;
				}
			}
		}
		return 0;
	}

	function checkMkParalelKK($list_kls,$kode_kelas,$nrp)	{
		createConnection();
		$kodeMk = getDetailKlsMk($kode_kelas);
		$mkPrasyarat = $kodeMk['kode_mk'];
		$cek = false;
		$sql = "SELECT KLS.kode_kelas
				 FROM tk_daftar_kls DK, tk_kelas_mk KLS , tk_mk_prasyarat TT, tk_fpp FPP
				 WHERE FPP.kode_fpp=DK.kode_fpp AND DK.kode_kelas=KLS.kode_kelas AND FPP.semester='".getSemester()."' AND FPP.tahun='".getTahunAjaran()."'
				 	   AND TT.kode_mk=KLS.kode_mk AND DK.nrp='$nrp' AND TT.nilai_min='P' AND TT.status='AND' AND TT.mk_prasyarat='".$mkPrasyarat."' AND DK.status='1'";
		$result = getQueryResult($sql);
		if($result)	{
			foreach($result as $kode_mk)	{
				if(count($list_kls)>0)	{
					foreach($list_kls as $kls)	{
						$kode_cek = $kode_mk['kode_kelas'];
						if($kode_cek==$kls['kode_kelas'] && $kls['status']=='3')	{
							$cek = true;
						}
					}
				}
			}
		}
		else	{
			return true;
		}
		if($cek==true)	{
			return true;
		}
		else	{
			return false;
		}
	}


	function checkMkHapusKK($list_kls,$kode_kelas)	{
		createConnection();
		$getKodeMk = getDetailKlsMk($kode_kelas);
		$kodeMk = $getKodeMk['kode_mk'];
		//PENCARIAN KODE MK YANG SAMA
		if(count($list_kls)>0)	{
			foreach($list_kls as $kls)	{
				if($kls['kode_kelas']==$kode_kelas)	{
					$status = $kls['status'];
				}
			}
		}

		if(count($list_kls)>0 && $status=='3')	{
			foreach($list_kls as $kls)	{
				$mkList = getDetailKlsMk($kls['kode_kelas']);
				if($mkList['kode_mk']==$kodeMk && $kls['status']=='0')	{
					return 1;
				}
			}
		}
		return 0;
	}


	function prosesKK($list_mk,$kode_fpp,$nrp)	{
		createConnection();
		if(count($list_mk)>0)	{
			foreach($list_mk as $kk)	{
				if($kk['status']=='0')	{
					$kls = getDetailKlsMk($kk['kode_kelas']);
                                        
                                        $kursiKosong=getKursiKosong($kk['kode_kelas'], $kls['kapasitas']);
                                        
					if($kursiKosong<=0)	{
						$pesan =  $pesan."Tidak ada kursi kosong pada kelas ".$kls['kode_mk']." KP ".$kls['kp']." isi=".$kls['isi']." kapasitas=".$kls['kapasitas']."<br>";
					}

				}
			}
			if($pesan)	{
				return $pesan;
			}
			else	{
				$sql = "DELETE FROM tk_daftar_kls WHERE nrp='$nrp' AND kode_fpp='".$batal['kode_fpp']."'";
				$delete = createQuery($sql);
				foreach($list_mk as $proses)	{
					$kls = getDetailKlsMk($proses['kode_kelas']);
					if($proses['status']=='0')	{
						$sql = "INSERT INTO tk_daftar_kls(kode_fpp,kode_kelas,nrp,status) VALUES('$kode_fpp','".$proses['kode_kelas']."','$nrp','1')";
						$hasil=createQuery($sql);
						$sql = "UPDATE tk_kelas_mk SET isi='".($kls['isi']+1)."' WHERE kode_kelas='".$proses['kode_kelas']."'";
						$hasil=createQuery($sql);
					}
					else if($proses['status']=='3')	{

						$sql = "SELECT DISTINCT FPP.kode_fpp FROM tk_daftar_kls DK, tk_fpp FPP WHERE DK.nrp='$nrp' AND DK.kode_kelas='".$proses['kode_kelas']."' AND FPP.kode_fpp=DK.kode_fpp AND FPP.semester='".getSemester()."' AND FPP.tahun='".getTahunAjaran()."'";
						$fpp = getQueryResult($sql);
						$sql = "DELETE FROM tk_daftar_kls WHERE nrp='$nrp' AND kode_fpp='".$fpp[0]['kode_fpp']."' AND kode_kelas='".$proses['kode_kelas']."'";
						$delete = createQuery($sql);

						$sql = "UPDATE tk_kelas_mk SET isi='".($kls['isi']-1)."' WHERE kode_kelas='".$proses['kode_kelas']."'";
						$hasil=createQuery($sql);
					}
				}
				return 1;
			}
		}
	}

	function checkStatusKK($kode_fpp,$nrp)	{
		createConnection();
		$sql = "SELECT * FROM tk_daftar_kls WHERE kode_fpp='$kode_fpp' AND nrp='$nrp' AND (status='1' OR status='2')";
		$result = getCountQueryResult($sql);
		return $result;
	}

	function tutupKelas($kode_kelas)	{
		createConnection();

		$sql = "SELECT DK.nrp,DK.kode_fpp FROM tk_daftar_kls DK, tk_fpp FPP
				WHERE DK.kode_kelas='$kode_kelas'
					  AND FPP.kode_fpp=DK.kode_fpp
					  AND FPP.tahun='".getTahunAjaran()."'
					  AND FPP.semester='".getSemester()."'";
		$result = getQueryResult($sql);
		foreach($result as $tutup)	{
			$sql = "UPDATE tk_daftar_kls SET status=2 WHERE kode_kelas='$kode_kelas' AND kode_fpp='".$tutup['kode_fpp']."' AND nrp='".$tutup['nrp']."'";

			$ubah = createQuery($sql);
			if(!$ubah)	{
				echo "Terjadi kesalahan pada penutupan kelas";
			}
		}
		$sql = "UPDATE tk_kelas_mk SET status_buka=0 WHERE kode_kelas='$kode_kelas'";

		$kls = createQuery($sql);
		if(!$kls)	{
			echo "Terjadi kesalahan kelas pada penutupan kelas";
		}
		else	{
			return true;
		}

	}

	function inputManageKK($kode_kk)	{
		createConnection();
		$sql = "INSERT INTO tk_kk(kode_fpp,jwd_kul,jwd_ujian,mk_p) VALUES('$kode_kk','1','1','1')";
		$result = createQuery($sql);
		return $result;
	}

	function getDetailManageKK($kode_kk)	{
		createConnection();
		$sql = "SELECT * FROM tk_kk WHERE kode_fpp='$kode_kk'";
		$result = getQueryResult($sql);
		return $result[0];
	}

	function ubahManageKK($status,$kode_kk)	{
		createConnection();
		$kk = getDetailManageKK($kode_kk);
		if($status==1)	{
			if($kk['jwd_kul']=='1')	{
				$sql = "UPDATE tk_kk SET jwd_kul='0' WHERE kode_fpp='$kode_kk'";
			}
			elseif ($kk['jwd_kul']=='0')	{
				$sql = "UPDATE tk_kk SET jwd_kul='1' WHERE kode_fpp='$kode_kk'";
			}
		}
		else if($status==2)	{
			if($kk['jwd_ujian']=='1')	{
				$sql = "UPDATE tk_kk SET jwd_ujian='0' WHERE kode_fpp='$kode_kk'";
			}
			elseif ($kk['jwd_ujian']=='0')	{
				$sql = "UPDATE tk_kk SET jwd_ujian='1' WHERE kode_fpp='$kode_kk'";
			}
		}
		else if($status==3)	{
			if($kk['mk_p']=='1')	{
				$sql = "UPDATE tk_kk SET mk_p='0' WHERE kode_fpp='$kode_kk'";
			}
			elseif ($kk['mk_p']=='0')	{
				$sql = "UPDATE tk_kk SET mk_p='1' WHERE kode_fpp='$kode_kk'";
			}
		}
		$result = createQuery($sql);
		return $result;
	}

	function checkTelahDaftar($list_kls,$kode_kelas)	{
		createConnection();
		if(count($list_kls)>0)	{
			foreach($list_kls as $cek)	{
				if($cek['kode_kelas']==$kode_kelas && ($cek['status']=='0' || $cek['status']=='1') && ($cek['status']!='3'))	{
					return 1;
				}
			}
		}
		return 0;
	}

        function appendLog($action,$subject,$description,$nrp,$kode_fpp,$kode_kelas)
        {
            createConnection();
            $userId=null;
            if ( isset( $_SESSION['symfony/user/sfUser/attributes'] ) )
            {
                $userDetails=$_SESSION['symfony/user/sfUser/attributes'];
                if ( isset( $userDetails['id'] ) )  $userId=$userDetails['id'];
            }
            if (!$userId) {
                $userId=$_SESSION['paj_id'].$_SESSION['admin_id'].$_SESSION['mhs_id'];
            }
            if (!$userId) {
                $userId=$nrp;
            }



            $sql = "INSERT INTO user_log(username,action,description,subject,address,created_at,nrp,kode_fpp,kode_kelas) VALUES('$userId','$action','$description', '$subject','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d H:i:s')."','$nrp', '$kode_fpp', '$kode_kelas')";
            $result = createQuery($sql);
            return $result;

        }

	function isSudahToefl($nrp)	{
		createConnection();
		$sql = "SELECT lulus FROM lulus_toefl WHERE  nrp='$nrp'";
		$result = getQueryResult($sql);
                if ( $result && (is_array($result) ) && ( isset($result[0]['lulus'] )) && ($result[0]['lulus']) ) {
                    return true;
                } else return false;
	}


        function extractKodeKelas($kodeKelas) {
            $kodeMk=substr($kodeKelas,0,6);
            $kp=substr($kodeKelas,6,1);
            createConnection();
            $sql = "SELECT nama FROM tk_master_mk WHERE  kode_mk='$kodeMk'";
	    $result = getQueryResult($sql);
            if ( $result && (is_array($result) ) ) {
                $namaMk = $result[0]['nama'];
            } else {
                $namaMk = '';
            }
            return "$kodeMk-$namaMk ($kp)";
        }

        function getNamaMk($kodeMk) {

            createConnection();
            $sql = "SELECT nama FROM tk_master_mk WHERE  kode_mk='$kodeMk'";
	    $result = getQueryResult($sql);
            if ( $result && (is_array($result) ) ) {
                $namaMk = $result[0]['nama'];
            } else {
                $namaMk = 'tidak diketahui';
            }
            return "$kodeMk-$namaMk";
        }


        function tambahDebugLog($pesan) {
            $flog=fopen('/tmp/perwalianft_debug.log','a');
            if ($flog) {
                fwrite($flog, date("YmdHis").": $pesan \n");
                fclose($flog);
            }
        }

         
?>
