<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/backend/affiliate')->
  with('request')->begin()->
    isParameter('module', 'backend_affiliate')->
    isParameter('action', 'index')->
  end()
;
