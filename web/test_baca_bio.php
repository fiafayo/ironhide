<html>
<body>
<h1>Test Baca Data Biodata Mahasiswa</h1>
<form action="<?php echo $_SERVER['SCRIPT_NAME']?>" method="post">
<table border="0">
<TR><TD>URL</TD><TD>:</TD><TD><INPUT type="text" name="url" value="http://poodle.ubaya.ac.id/sia/webx/mhsstatus.php" size="40"></TD></TR>
<TR><TD>Nrp</TD><TD>:</TD><TD><INPUT type="text" name="nrp" value="<?php echo $_REQUEST['nrp'] ? $_REQUEST['nrp'] : '6084040'; ?>" size="20"></TD></TR>
</table>
<INPUT type="submit">
</form>

<?php

if ( $_SERVER['REQUEST_METHOD']=='POST'  ) {
  $nrp = $_REQUEST['nrp'];
  $url =  $_REQUEST['url'];
  $nrp64 = base64_encode($nrp);
  $hasil=file_get_contents($url.'?nrp='.$nrp64);
  echo "<h2>Hasil</h2><pre>$hasil</pre>";
  $hasilU=strtoupper($hasil);
  if ( substr($hasilU,0,3) == 'OK=' ){
    $info64=substr($hasil,3);
    $info=base64_decode($info64);
    echo "BERHASIL mendapatkan data untuk nrp=$nrp yaitu <br/>base64='$info64'  <br/>text asli='$info'";
  } else {
    echo "Gagal mendapatkan data untuk nrp=$nrp";
  }
}
?>
</body>
</html>

