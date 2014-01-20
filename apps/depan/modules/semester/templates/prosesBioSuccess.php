<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div id="sf_admin_container">
    <h1>Hasil Sinkronisasi Data Bio Mahasiswa</h1>
    <table class="sf_admin_list">
<?php
foreach($logs as $log){
?>
        <tr>
            <td><?php echo $log;?></td>
        </tr>
        <?php
}
?>
    </table>
</div>
