<div id="sf_admin_container">
<h1>Daftar mahasiswa yang lulus TOEFL</h1>
<div style="margin-left:20px">
<?php
 
echo form_tag('toefl/index');
echo 'Nrp : <input type="text" name="nrp" size="20" value="'.$nrp.'" />';
echo '<input type="submit" name="Commit" value="Cari" />';
echo '<input type="reset" name="Reset" value="Reset" />';
echo '</form>';
echo '<p>'.button_to('Klik di sini untuk upload file ','toefl/upload');

?>







</div>
<div style="border:2px groove;background-color: #ddd; padding: 10px" >
    <h2>Update hasil kelulusan TOEFL</h2><p>Tuliskan NRP mahasiswa yang lulus TOEFL, dipisahkan oleh "ENTER"</p>
    <form method="post" action="/toefl/update">
        <textarea name="nrps"></textarea><br>
        <input name="Commit" value="Update" type="submit">
    </form>
</div>
<table border="1" class="sf_admin_list">
<?php
$genap=0;
$sel=0;
foreach ($toefls as $toefl):
  if ($sel % 10==0) {
    $sel=0;
    if (!$genap) $genap=1; else $genap=0;
    echo '<TR class="sf_admin_row_'.$genap.'">';
  }
?>
<TD><?php echo $toefl->getNrp();?></TD>
<?php
  if ($sel % 10==9) {
    echo '</TR>';

  }
  $sel++;
endforeach;
?>
</table>
</div>