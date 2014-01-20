<div id="sf_admin_container">
<?php
echo '<h2>Upload file hasil kelulusan TOEFL</h2>';
echo '<p>File harus dalam format CSV, dengan kolom pertama berisi NRP</p>';
echo '<div style="margin-left:20px">';
echo form_tag('toefl/upload', 'multipart=true');
echo '<input type="file" name="csvFile" />';
echo '<input type="submit" name="Commit" value="Upload" /></form>';
echo '</div>';
if ($sf_request->getMethod()==sfRequest::POST) echo "<h1>Hasil Upload kelulusan TOEFL</h1>";
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