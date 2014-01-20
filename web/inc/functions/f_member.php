<?
	function checkMhsPassword ($nrp, $password) {
		$sql = "SELECT nrp, password FROM tk_mhs WHERE nrp='$nrp' AND password='$password'";
		$hasil = getCountQueryResult($sql);
		
		if ($hasil==1) {
			return true;
		} else {
			return false;
		}
	}
	
	function checkDosenPassword ($nik, $password) {
		$sql = "SELECT kode_dosen, password FROM tk_dosen WHERE kode_dosen='$nik' AND password='$password'";
		$hasil = getCountQueryResult($sql);
		
		if ($hasil==1) {
			return true;
		} else {
			return false;
		}
	}
	
	function checkAdminPassword ($nik, $password) {
		$sql = "SELECT nik, password FROM tk_admin WHERE nik='$nik' AND password='$password' AND jabatan='ADMINISTRATOR'";
		$hasil = getCountQueryResult($sql);
		
		if ($hasil==1) {
			return true;
		} else {
			return false;
		}
	}
	
	function checkPetugasPassword ($nik, $password) {
		$sql = "SELECT nik, password FROM tk_admin WHERE nik='$nik' AND password='$password' AND jabatan='PAJ'";
		$hasil = getCountQueryResult($sql);
		
		if ($hasil==1) {
			return true;
		} else {
			return false;
		}
	}
	
	function checkLogin ($username, $password) {
		if (($username != "") && ($password != "")) {
			createConnection();
			if (checkMhsPassword($username, $password)) {
				//session_register ('mhs_id');
				$_SESSION['mhs_id'] = "$username";
				return true;
			} 
			else	{
				if (checkAdminPassword($username, $password)) {
					$_SESSION['admin_id'] = "$username";
					return true;
				}
				else	{
					if (checkPetugasPassword($username, $password)) {
						$_SESSION['paj_id'] = "$username";
						return true;
					}
					return false;
				}
			}
				
		}
		return false;
	}
	
	function getDetailLogin()	{
		createConnection();
                $sql ="SELECT * FROM tk_mhs WHERE nrp='".intval($_SESSION['mhs_id'])."'";
		if(isset($_SESSION['admin_id']))	{
			$sql ="SELECT * FROM tk_admin WHERE nik='".$_SESSION['admin_id']."'";
		}
		elseif(isset($_SESSION['dosen_id']))	{
			$sql ="SELECT * FROM tk_dosen WHERE kode_dosen='".$_SESSION['dosen_id']."'";
		}
		elseif(isset($_SESSION['mhs_id']))	{
			$sql ="SELECT * FROM tk_mhs WHERE nrp='".$_SESSION['mhs_id']."'";
		}
		elseif(isset($_SESSION['paj_id']))	{
			$sql ="SELECT * FROM tk_admin WHERE nik='".$_SESSION['paj_id']."'";
		}
		$result = getQueryResult($sql);
		return $result[0];
	}
	
	function checkSecurity($kode_jur)	{
		createConnection();
		if((isset($_SESSION['paj_id'])) && ($kode_jur!=""))	{
			$sql ="SELECT * FROM tk_admin WHERE nik='".$_SESSION['paj_id']."'";
			$result = getQueryResult($sql);
			if($result[0]['kode_jur']!=$kode_jur)	{
				header("Location:peringatan.php");
			}
		}
		
	}
	
	function checkLogout () {
		if ($_POST['btnLogout']) {
			session_unregister ('mhs_id');
		}
	}
	
	function selectMember()	{
		createConnection();
		$sql =  "SELECT * FROM tk_admin";
		$result = getQueryResult($sql);
		return $result;
	}
	
	
	function inputMember($nik,$nama,$kode_jur,$password,$jabatan)	{
		createConnection();
		$sql =  "INSERT INTO tk_admin(nik,nama,kode_jur,password,jabatan) VALUES('$nik','$nama','$kode_jur','$password','$jabatan')";
		$result = createQuery($sql);
		return $result;
	}
	
	function editMember($nik,$nama,$kode_jur,$password,$jabatan)	{
		createConnection();
		$sql =  "UPDATE tk_admin SET kode_jur='$kode_jur', nama='$nama', password='$password', jabatan='$jabatan' WHERE nik='$nik'";
		$result = createQuery($sql);
		return $result;
	}
	
	function getDetailMember($nik)	{
		createConnection();
		$sql =  "SELECT * FROM tk_admin WHERE nik='$nik'";
		$result = getQueryResult($sql);
		return $result[0];
	}
	
	function deleteMember($nik)	{
		createConnection();
		$sql =  "DELETE FROM tk_admin WHERE nik='$nik'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateMember($nik)	{
		createConnection();
		$sql = "SELECT * FROM tk_admin WHERE nik='$nik'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function inputJadwal($keterangan,$waktu_buka,$waktu_tutup)	{
		createConnection();
		$sql =  "INSERT INTO tk_admin_jadwal(keterangan,waktu_buka,waktu_tutup) VALUES('$keterangan','$waktu_buka','$waktu_tutup')";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteJadwal($no)	{
		createConnection();
		$sql =  "DELETE FROM tk_admin_jadwal WHERE no='$no'";
		$result = createQuery($sql);
		return $result;
	}
	
	function selectJadwal()	{
		createConnection();
		$sql = "SELECT * FROM tk_admin_jadwal";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function checkMinat($kode_jur)	{
		createConnection();
		$sql = "SELECT kode_jur FROM tk_jurusan WHERE MID(kode_jur,1,2)!=MID(kode_jur,4,2) AND MID(kode_jur,1,2)=MID('$kode_jur',1,2)";
		$result = getCountQueryResult($sql);
		return $result;
	}
?>