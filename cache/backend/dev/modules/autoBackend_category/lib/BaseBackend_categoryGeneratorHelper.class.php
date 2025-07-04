<?php

/**
 * backend_category module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage backend_category
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBackend_categoryGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'jobeet_category' : 'jobeet_category_'.$action;
  }
}
