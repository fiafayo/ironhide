<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="/templates/colourful/css/blue.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/templates/colourful/css/template.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/css/heloz.css" />
    <title>Konversi MK</title>
</head>
<body style="margin-left: 10px; margin-top: 10px">
    <div id="sf_admin_container">
        <h1>Hasil Konversi</h1>
        <pre>
<?php
include('konversiMatkulFunctions.php');

$kodeJur=$_REQUEST['kode_jur'];
$tahun=$_REQUEST['tahun'];
konversiMataKuliah($kodeJur,$tahun);

?>
</pre>

    </div>
</body>
</html>