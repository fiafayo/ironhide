<?php

?>
<div id="sf_admin_container">
    <h1>Tambah Hasil Konversi Transkrip</h1>
    <form action="<?php echo url_for('transkrip/tambahKonversi');?>" method="POST">
        <table border="0" >
            <tr>
                <td>Mata kuliah asal :</td><td>
                    <select name="mk_asal" id="mk_asal">
<?php
foreach( $mataKuliahs as $kode=>$nama )
{
    echo '<OPTION value="'.$kode.'">'.$kode.'. '.$nama.'</OPTION>';
}
?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mata kuliah hasil :</td><td>
                    <select name="mk_hasil" id="mk_hasil">
<?php
foreach( $mataKuliahs as $kode=>$nama )
{
    echo '<OPTION value="'.$kode.'">'.$kode.'. '.$nama.'</OPTION>';
}
?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="commit" value="Tambahkan Hasil Konversi" />
    </form>
<?php
$n=count($logs);
if ($n>0)
{
    ?>
    <h2>Hasil Konversi :</h2>
    <table border="1" cellspacing="0" cellpadding="2" class="sf_admin_list">
<?php
foreach ($logs as $log)
{
    echo '<TR><td>'.$log.'</td></TR>';
}
?>
    </table>
    <?php
}
?>
</div>
<?php
if ( $sf_request->getMethod()==sfRequest::POST )
{
    $mk_asal=$sf_request->getParameter('mk_asal');
    $mk_hasil=$sf_request->getParameter('mk_hasil');
?>
<script language="javascript" type="text/javascript">
    var mk_asal=document.getElementById('mk_asal');
    var mk_hasil=document.getElementById('mk_hasil');
    mk_hasil.value='<?php echo $mk_hasil;?>';
    mk_asal.value='<?php echo $mk_asal;?>';
</script>
<?php
}
?>