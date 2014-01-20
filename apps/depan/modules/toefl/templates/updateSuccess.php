<div id="sf_admin_container">
<?php
echo '<h2>Update hasil kelulusan TOEFL</h2>';
echo '<p>Tuliskan NRP mahasiswa yang lulus TOEFL, dipisahkan oleh "ENTER"</p>';
echo '<div style="margin-left:20px">';
echo form_tag('toefl/update');
echo '<textarea name="nrps"></textarea><br/>';
echo '<input type="submit" name="Commit" value="Update" /></form>';
echo '</div>';
if ($sf_request->getMethod()==sfRequest::POST) echo "<h1>Hasil Update kelulusan TOEFL</h1>";
?>
<table border="1" class="sf_admin_container" style="margin-left:20px">
<?php
$genap=0;
$sel=0;
foreach ($logs as $log):
  if ($sel % 10==0) {
    $sel=0;
    if (!$genap) $genap=1; else $genap=0;
    echo '<TR class="sf_admin_row_'.$genap.'">';
  }
?>
<TD><?php echo $log;?></TD>
<?php
  if ($sel % 10==9) {
    echo '</TR>';

  }
  $sel++;
endforeach;
?>
</table>
</div>