<?
	function generateKodeDispensasi()	{
		createConnection();
		$sql = "SELECT id FROM tk_tambah_sks ORDER BY id DESC";
		$result = getQueryResult($sql);
		if($result)	{
			$kodeAkhir = substr($result[0]['id'],1,3);
			$angka = $kodeAkhir+1;
			if($angka>1 && $angka<10)	{
				$kodeBaru = "D00".$angka;
			}
			else if($angka>=10 && $angka<100)	{
				$kodeBaru = "D0".$angka;
			}
			else if($angka>=100 && $angka<1000)	{
				$kodeBaru = "D".$angka;
			}
			return $kodeBaru;
		}
		else	{
			return "D001";
		}
	}
	
	function selectSks($semester,$tahun,$page)	{
		createConnection();
		$display = LM_DISPLAY;
		$sql = "SELECT * FROM tk_tambah_sks WHERE semester='$semester' AND tahun='$tahun' LIMIT $page,$display ";
		$result = getQueryResult($sql);
		return $result;
	}
	
	function getDetailSks($semester,$tahun,$nrp)	{
		createConnection();
		$sql = "SELECT * FROM tk_tambah_sks WHERE semester='$semester' AND tahun='$tahun' AND nrp='$nrp'";
		$result = getQueryResult($sql);
		return $result[0];
	}
	
	function getPageSks($semester,$tahun)	{
		createConnection();
		$sql = "SELECT * FROM tk_tambah_sks WHERE semester='$semester' AND tahun='$tahun'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function insertSks($nrp,$jml_sks,$keterangan,$semester,$tahun)	{
		createConnection();
		$id = generateKodeDispensasi($sql);
		$sql = "INSERT INTO tk_tambah_sks(id,nrp,jml_sks,keterangan,semester,tahun) 
				VALUES('$id','$nrp',$jml_sks,'$keterangan','$semester','$tahun')";
		$result = createQuery($sql);
		return $result;
	}
	
	function deleteSks($id)	{
		createConnection();
		$sql = "DELETE FROM tk_tambah_sks WHERE id='$id'";
		$result = createQuery($sql);
		return $result;
	}
	
	function checkDuplicateSks($nrp,$semester,$tahun)	{
		createConnection();
		$sql = "SELECT id FROM tk_tambah_sks WHERE nrp='$nrp' AND semester='$semester' AND tahun='$tahun'";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
	function checkAvailableMhs($nrp)	{
		createConnection();
		$sql = "SELECT nrp FROM tk_mhs WHERE nrp='$nrp' ";
		$result = getCountQueryResult($sql);
		return $result;
	}
	
?>