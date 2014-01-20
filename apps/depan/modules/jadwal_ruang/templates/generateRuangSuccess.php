<div id="sf_admin_container">
    <h1>Hasil Generate Jadwal Ujian</h1>
    <h2>Informasi :</h2>
    <table border="1" cellpadding="2" cellspacing="0" >
<?php
foreach ($infos as $info)
{
    echo '<tr><td>'.$info.'</td></tr>';
}
?>
    </table>
<!--
    <h2>Error :</h2>
    <table border="1" cellpadding="2" cellspacing="0" >
<?php
foreach ($errors as $info)
{
    echo '<tr><td>'.$info.'</td></tr>';
}
?>
    </table>
-->
</div>



<?php

include_partial('jadwal_ujian/jadwal', array('penjadwalan'=>$penjadwalan) );
?>