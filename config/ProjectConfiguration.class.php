<?php

require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{


  //Registar Loader De zend en el proyecto para no hacer required cada que se necesite

  static protected $zendLoaded = false;

  static public function registerZend()
  {
    if (self::$zendLoaded) {
      return;
    }

    set_include_path(sfConfig::get('sf_lib_dir') . '/vendor' . PATH_SEPARATOR . get_include_path());
    require_once sfConfig::get('sf_lib_dir') . '/vendor/Zend/Loader/Autoloader.php';
    Zend_Loader_Autoloader::getInstance();
    self::$zendLoaded = true;
  }


  public function setup()
  {
    
    $this->enablePlugins(array(
      'sfDoctrinePlugin',
      'sfDoctrineGuardPlugin',
      'sfFormExtraPlugin',
      'sfJobeetPlugin'
    ));
  }
}
