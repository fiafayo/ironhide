<?
	include("var/config.php");
	function createConnection()
	{
		$mylink = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('Could not connect: ' .mysql_error());
		$conn = mysql_select_db(DB_NAME,$mylink);
		return($conn);
	}
	function createQuery($query)// Buat insert and update (PRIVATE)
	{
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		return($result);
	}
	function getResult($result)// Buat convert ke array
	{
		$arrResult = array();
		while($line=mysql_fetch_assoc($result))
		{
			array_push($arrResult,$line);
		}
		return($arrResult);
	}
	function getCountQueryResult($query)// Buat jumlah SELECT
	{
		$result = createQuery($query);
		if($result)
		{
			$QueryResult = mysql_num_rows($result);
			return ($QueryResult);
		}
	}
	function getQueryResult($query)  // Buat hasil SELECT
	{
		$result = createQuery($query);
		if($result)
		{
			$QueryResult = getResult($result);
			return ($QueryResult);
		}
	}
	function closeConnection()
	{
		mysql_close($mylink);
		unset($result,$mylink,$conn,$arrResult,$line);
	}
?>