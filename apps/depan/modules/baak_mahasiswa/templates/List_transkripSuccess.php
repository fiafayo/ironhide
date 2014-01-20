<div id="sf_admin_container">
<h1>Transkrip Mahasiswa</h1>
<table class="sf_admin_list" border="0" cellpadding="2" cellspacing="2" >
    <tr>
        <td>Nrp :</td>
        <td><?php echo $mhs['NRP'];?></td>
    </tr>
</table>
<?php
$data=$sf_data->getRaw('data');
$transkrips=$data['transkrips'];
print_r($transkrips);

?>
</div>