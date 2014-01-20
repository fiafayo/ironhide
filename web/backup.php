<?php
$output=array();
exec('/home/heloz/backup/sql/backup_daily.sh',$output);
echo `date`;
print_r($output);

