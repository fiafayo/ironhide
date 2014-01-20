<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php use_helper('Url');?>
<script language="javascript">
var myMenu =
[
  [null,'Home','<?php echo url_for('/');?>',null,'Halaman Utama',null],
 <?php
  if ($sf_user->isAuthenticated()) {
?>

<?php
  if ( $sf_user->isAdministrator()  ) :
?>
     
<?php
  endif;

?>

  [null,'Ganti Password','<?php echo url_for('depan/change_password');?>',null,'ganti Password',null],

<?php
  } else {
?>

<?php
  }
?>
];
</script>