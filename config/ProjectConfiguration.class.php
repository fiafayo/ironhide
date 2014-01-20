<?php

//require_once  dirname(__FILE__). './../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
//sfCoreAutoload::register();


$dir = dirname(__FILE__);
if (file_exists("$dir/require-core.php"))
{
  // Look for a custom Symfony require directive in require-core.php
  require_once 'require-core.php';
}
else
{
  // Use copy checked out via svn:externals
  require_once "$dir/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php";
}

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');
  }
}
