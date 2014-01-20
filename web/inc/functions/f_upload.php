<?
	function readSqlDb($filePath)	{
		createConnection();
		$readSql = fopen($filePath, 'r');
		
		while ($read = fgets($readSql,10000)) {
			$result = createQuery($read);
		}
	
		return $result;
	}

function readCsvFile($filepath)
{
    $fin=fopen($filepath,'r') or die ("Tidak bisa mengakses file $filepath");
    $result=array();
    $headers=fgetcsv($fin, 1000, ';', "'");
    $mks=array();
    $baris=1;
    while ( !feof($fin) )
    {
          $baris++;
          $row=fgetcsv($fin,10000,";","'");
          if (!$row || (count($row)<>3) ) continue;
          try {
            $kode=trim($row[0]);
            $nama=trim($row[1]);
            $sks=intval($row[2]);
            $mks[$kode]=array(0=>$nama,$sks);
            $result[]= 'Baris ke- '.$baris.'::Memproses  matkul '.$kode.'.'.$nama.'.'.$sks.'<br/>';
          } catch (Exception $e) {
              $result[]= 'Baris ke- '.$baris.'::Gagal Memproses matkul, data= '.join(';',$row).'<br/>';
          }


    }
    fclose($fin);




    if ( count($mks) )
    {
        $upKeys=array_keys($mks);

        $keyText='';
        foreach($upKeys as $key)
        {
            $keyText.="'$key',";
        }
        if ($keyText)
        {
            $keyText=substr($keyText,0,strlen($keyText)-1 );
        }

        createConnection();
        $sql = "SELECT kode_mk FROM tk_master_mk  where kode_mk in ($keyText) ";
        $rows = getQueryResult($sql);
        $currKeys=array();
        foreach ($rows as $rs)
        {
            $currKeys[]=$rs['kode_mk'];
        }


        $newKeys=array_diff($upKeys,$currKeys  );
        $editKeys=array_intersect($currKeys,$upKeys );
        foreach ($newKeys as $key)
        {
            $sql="INSERT INTO tk_master_mk (kode_mk,nama,sks) VALUES ('$key','".$mks[$key][0]."',".$mks[$key][1].")";
//            print($sql).'<br/>';
            $hsl=createQuery($sql);
            
        }
        foreach ($editKeys as $key)
        {

            $sql="UPDATE tk_master_mk SET nama='".$mks[$key][0]."'  ,sks=".intval($mks[$key][1])." WHERE kode_mk='$key'";
//            print($sql).'<br/>';
            $hsl=createQuery($sql);

        }
        return $result;
        



    }
    
}
?>