<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$baseurl='';
$template='colourful';
$colorVariation='blue';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
<script type="text/javascript">
  var currenttime = '<?php print date("F j, Y H:i:s", time())?>';
</script>
<script type="text/javascript" src="/js/date.js"></script>
  </head>
<body id="page_bg">
<a name="up" id="up"></a>
<div id="main_bg">
	<img src="<?php echo $baseurl ?>/templates/<?php echo $template ?>/images/<?php echo $colorVariation; ?>/top.png" alt="top" /><div id="logo_bg">
    	<img src="<?php echo $baseurl ?>/templates/<?php echo $template ?>/images/<?php echo $colorVariation; ?>/logo.png" alt="logo" align="left" hspace="5" />
        <a href="/index.php" class="logo"><?php echo 'Sistem Perencanaan Studi' ;?></a>
        <div id="user4"><jdoc:include type="modules" name="user4" /><font id="jam-server"></font></div>
        <br clear="all" />
    </div> <!--
    <div id="user3"><?php //include_partial('global/pullmenu');?><div id="pillmenu"></div></div> -->
    <div id="banner"><jdoc:include type="modules" name="top" /></div>
	<div id="leftcolumn">
    <?php 
    include_partial('global/left');
    ?>
    <div align="center"><?php  include_partial('global/syndicate') ?></div>
    </div>
	<div id="maincolumn">
    	<div class="path"><?php  include_partial('global/path') ?></div>
       <?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice" style="text-align: center">
    <?php echo $sf_user->getFlash('notice');

    ?>
  </div>

<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_error" style="text-align: center">
    <?php echo $sf_user->getFlash('error') ?>
  </div>
<?php endif; ?>


    	<div class="nopad"><?php echo $sf_content ?></div>
    </div>
	<div id="rightcolumn">
    <?php  include_partial('global/right') ?>
    </div>

     <br clear="all" />
    <img id="main_bottom" src="<?php echo $baseurl ?>/templates/<?php echo $template ?>/images/<?php echo $colorVariation; ?>/bottom.png" alt="bottom" align="bottom" /></div>
<script language="javascript" type="text/javascript">
//cmDraw ('pillmenu', myMenu, 'hbr', cmThemeGray);


<?php
$msgText='';
if ($sf_user->hasFlash('notice'))
{
    $msgText='"'. $sf_user->getFlash('notice').' "';
}
if ($sf_user->hasFlash('error'))
{
    if ($msgText)
    {
        $msgText.='+';
    }
    $msgText.='"'.$sf_user->getFlash('error').'"';
}
if ($msgText)
{
    //echo '<script language="javascript">';
    echo "alert($msgText);";
    //echo '</script>';
}
    ?>
</script>


</body>
  
</html>