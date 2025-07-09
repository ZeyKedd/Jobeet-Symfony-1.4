<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());


$browser->
  get('/backend/category')->
  with('request')->begin()->
    isParameter('module', 'backend_category')->
    isParameter('action', 'index')->
  end()
;
