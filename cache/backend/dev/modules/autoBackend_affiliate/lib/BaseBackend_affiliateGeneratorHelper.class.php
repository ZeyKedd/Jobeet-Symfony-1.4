<?php

/**
 * backend_affiliate module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage backend_affiliate
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBackend_affiliateGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'jobeet_affiliate' : 'jobeet_affiliate_'.$action;
  }
}
