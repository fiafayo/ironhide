<?php
$script=$_SERVER['PHP_SELF'] ;
if ( strpos($script,'/admin/')===0 )
{
    $isAdmin=( isset( $_SESSION['admin_id'] ) && $_SESSION['admin_id'] );
    $isPaj=( isset( $_SESSION['paj_id'] ) && $_SESSION['paj_id'] );
    $isDosen=( isset( $_SESSION['dosen_id'] ) && $_SESSION['dosen_id'] );
    if ( !$isAdmin && !$isPaj && !$isDosen  )
    {
       header('Location:/login');
       exit;
    }
} else {
  $isLogin=(strpos($script,'login.php') !== false);
  $isLogout=(strpos($script,'logout.php') !== false);
  if ( !$isLogin && !$isLogout)
  {
    $isAdmin=( isset( $_SESSION['admin_id'] ) && $_SESSION['admin_id'] );
    $isPaj=( isset( $_SESSION['paj_id'] ) && $_SESSION['paj_id'] );
    $isDosen=( isset( $_SESSION['dosen_id'] ) && $_SESSION['dosen_id'] );
    $isMhs=( isset( $_SESSION['mhs_id'] ) && $_SESSION['mhs_id'] );
    if ( !$isAdmin && !$isPaj && !$isDosen && !$isMhs  )
    {
       header('Location:/login');
       exit;
    }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="Perwalian Fakultas Teknik Ubaya" />
<meta name="description" content="Perwalian Fakultas Teknik Ubaya" />
<meta name="keywords" content="perwalian, teknik, ubaya" />
<meta name="language" content="en" />
<meta name="robots" content="index, follow" />
    <title>Perwalian Fakultas Teknik Ubaya</title>
    <link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/heloz.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/js/ThemeGray/themeAdmin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/templates/colourful/css/blue.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/templates/colourful/css/template.css" />
    <script type="text/javascript" src="/js/effect.js"></script>
<script type="text/javascript" src="/js/JSCookMenu.js"></script>
<script type="text/javascript" src="/js/theme.js"></script>
<script type="text/javascript">
  var currenttime = '<?php print date("F j, Y H:i:s", time())?>';
</script>
<script type="text/javascript" src="/js/date.js"></script>
<script language="javascript" src="/style/function.js" type="text/javascript"></script>

  </head>
<body id="page_bg">
<a name="up" id="up"></a>
<div id="main_bg">
	<img src="/templates/colourful/images/blue/top.png" alt="top" /><div id="logo_bg">

    	<img src="/templates/colourful/images/blue/logo.png" alt="logo" align="left" hspace="5" />
        <a href="index.php" class="logo">Sistem Perencanaan Studi</a>
          <div id="user4"><jdoc:include type="modules" name="user4" /><font id="jam-server"></font></div>
        <br clear="all" />
    </div>
<?php
                include_once '_menu.php';
?>
    <div id="banner"><jdoc:include type="modules" name="top" /></div>
	<div id="leftcolumn">

        <div align="center"></div>
    </div>
	<div id="maincolumn">
           <!--
    	<div class="path"><div id="breadcrumbs"><p><span class="breadcrumbs pathway">
<?php echo $_SERVER['PHP_SELF']  ?>
        </span>

				</p>

			</div>
</div>  -->
<div class="nopad">
