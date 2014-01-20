<?
	// BUAT MASTER JURUSAN
	function getJurusan()	{
		createConnection();
		$sql = "SELECT * FROM tk_jurusan ORDER BY kode_jur";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getMinat($kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_jurusan WHERE MID(kode_jur,1,2)=MID('$kode_jur',1,2) ORDER BY kode_jur";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getDetailJurusan($kode)	{
		createConnection();
		$sql = "SELECT * FROM tk_jurusan WHERE kode_jur='$kode'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	function insertJurusan($kode_jurusan,$nama)	{
		createConnection();
		$sql = "INSERT INTO tk_jurusan(kode_jur,nama) 
				VALUES('$kode_jurusan','$nama')";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteJurusan($kode_jurusan)	{
		createConnection();
		$sql = "DELETE FROM tk_jurusan WHERE kode_jur='$kode_jurusan'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateJur($kode_jur)	{
		createConnection();
		$sql = "SELECT kode_jur FROM tk_jurusan WHERE kode_jur='$kode_jur'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkUsedJur($kode_jur)	{
		createConnection();
		$sql = "SELECT kode_jur FROM tk_kls_jur WHERE kode_jur ='$kode_jur'";
		$result = getCountQueryResult($sql);
		if($result > 0)	{
			return false;
		}
		else	{ 
			$sql = "SELECT kode_jur FROM tk_mk_prasyarat WHERE kode_jur='$kode_jur'";
			$result = getCountQueryResult($sql);
			if($result > 0)	{
				return false;
			}
			else	{
				return true;
			}
		}
		return $result;
	}
	
	//BUAT MASTER KONSENTRASI
	/*function generateKodeKonsentrasi($kode_jur)	{
		createConnection();
		$sql = "SELECT kode_konsentrasi FROM tk_konsentrasi WHERE kode_jur='$kode_jur' ORDER BY kode_konsentrasi DESC";
		$result = getQueryResult($sql);
		if($result)	{
			$kode_akhir = $result[0]['kode_konsentrasi'];
			$nomor=substr($kode_akhir,3,1);
			$nomor++;
			$kode_baru = $kode_jur."-".$nomor;
			return $kode_baru;
		}
		else	{
			return $kode_jur."-1";
		}
		
	}
	
	function getKonsentrasi()	{
		createConnection();
		$sql = "SELECT * FROM tk_konsentrasi ORDER BY kode_jur";
		$result = getQueryResult($sql);
		return($result);
	}
	
	function getDetailKonsentrasi($kode,$kode_jur)	{
		createConnection();
		$sql = "SELECT * FROM tk_konsentrasi WHERE kode_konsentrasi='$kode' AND kode_jur='$kode_jur'";
		$result = getQueryResult($sql);
		return($result[0]);
	}
	
	function insertKonsentrasi($kode_jur,$nama)	{
		createConnection();
		$kode_konsentrasi = generateKodeKonsentrasi($kode_jur);
		$sql = "INSERT INTO tk_konsentrasi(kode_konsentrasi,kode_jur,nama) 
				VALUES('$kode_konsentrasi','$kode_jur','$nama')";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteKonsentrasi($kode_konsentrasi)	{
		createConnection();
		$sql = "DELETE FROM tk_konsentrasi WHERE kode_konsentrasi='$kode_konsentrasi'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateKonsentrasi($nama)	{
		createConnection();
		$sql = "SELECT kode_konsentrasi FROM tk_konsentrasi WHERE nama='$nama'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkUsedKonsentrasi($kode_konsentrasi)	{
		createConnection();
		$sql = "SELECT kode_konsentrasi FROM tk_mk_prasyarat WHERE kode_konsentrasi ='$kode_konsentrasi'";
		$result = getCountQueryResult($sql);
		if($result > 0)	{
			return false;
		}
		else	{ 
			$sql = "SELECT kode_konsentrasi FROM tk_mk_jur WHERE kode_konsentrasi='$kode_konsentrasi'";
			$result = getCountQueryResult($sql);
			if($result > 0)	{
				return false;
			}
			else	{
				return true;
			}
		}
		return $result;
	}*/
	
	
	
?>