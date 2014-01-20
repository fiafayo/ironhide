<?php
$actionName = sfContext::getInstance()->getActionName();

?>
<ul class="nav nav-tabs">
    <li   <?php echo ( $actionName=='petugas' ) ? ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/petugas'); ?>">Petugas Jaga</a></li>
    <li   <?php echo ( $actionName=='ruang' ) ?   ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/ruang');   ?>">Ruang</a></li>
    <li   <?php echo ( $actionName=='jadwal' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/jadwal');  ?>">Jadwal</a></li>
    <li   <?php echo ( $actionName=='matkul' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/matkul');  ?>">Kelas</a></li>
    <li   <?php echo ( $actionName=='proses' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/proses');  ?>">Proses</a></li>
    <li   <?php echo ( $actionName=='karyawanJaga' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/karyawanJaga');  ?>">Karyawan Jaga</a></li>
    <li   <?php echo ( $actionName=='dosenJaga' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/dosenJaga');  ?>">Dosen Jaga</a></li>
    <li   <?php echo ( $actionName=='cetak' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/cetak');  ?>">Cetak</a></li>
    <li   <?php echo ( $actionName=='monitor' ) ?  ' class="active" ' : ''; ?>><a  style="padding: 0 10px 0 0;" href="<?php echo url_for('penjadwalan_ujian/monitor');  ?>">Monitor</a></li>
</ul>   